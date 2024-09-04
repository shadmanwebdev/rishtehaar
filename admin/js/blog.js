function create_post(event) {
    event.preventDefault();
    var formData = new FormData();

    var titleInput = document.getElementById('title');
    var descriptionInput = document.getElementById('description');
    var tagsInput = document.getElementById('tags');
    var contentInput = document.getElementById('content');
    
    if(
        titleInput.value &&
        descriptionInput.value &&
        tagsInput.value &&
        contentInput.value
    ) {

        var errElement = document.getElementById('err-1');
            
        const input = document.getElementById('image');
        if (input.files && input.files[0] && !errElement.classList.contains('s')) {
            const file = input.files[0];
            const reader = new FileReader();
        
            reader.onload = function(e) {
                const img = new Image();
                img.src = e.target.result;
        
                img.onload = function() {
                    // Calculate new dimensions for resizing
                    const maxWidth = 900; // Change this to your desired width
                    const maxHeight = 900; // Change this to your desired height
        
                    let newWidth = img.width;
                    let newHeight = img.height;
        
                    if (img.width > maxWidth) {
                        newWidth = maxWidth;
                        newHeight = (img.height * maxWidth) / img.width;
                    }
        
                    if (newHeight > maxHeight) {
                        newHeight = maxHeight;
                        newWidth = (img.width * maxHeight) / img.height;
                    }
        
                    // Create a canvas and resize the image
                    const canvas = document.createElement('canvas');
                    canvas.width = newWidth;
                    canvas.height = newHeight;
                    const ctx = canvas.getContext('2d');
                    ctx.drawImage(img, 0, 0, newWidth, newHeight);
        
                    // Convert the canvas data to a Blob
                    canvas.toBlob(function(blob) {
                        // Append the resized image blob to the original formData object
                        formData.append('photo', blob, 'resized_image.webp');

                        load_start();

                        formData.append('create_post', 'true');
                        formData.append('title', titleInput.value);
                        formData.append('description', descriptionInput.value);
                        formData.append('tags', tagsInput.value);
                        formData.append('content', contentInput.value);

                        fetch('./controllers/blog-handler', {
                            method: 'POST',
                            body: formData
                        })
                        .then(response => {
                            return response.text()      
                        })
                        .then(response => {
                            setTimeout(function() {
                                load_end();

                                console.log(response);
                                if($.trim(response) == '1') {
                                    $('#message-response-1').html("<div class='success'>New post created!</div></div>");
                                } else {
                                    $('#message-response-1').html("<div class='error'>There was an error</div>");
                                }
                            }, 500);
                        })
                        .catch( err => console.log(err));
                    }, 'image/jpeg', 0.8); // Change 'image/jpeg' and 0.8 to match your desired image format and quality
                };
            };
    
            reader.readAsDataURL(file);
            
        } else {
            load_start();

            formData.append('create_post', 'true');
            formData.append('title', titleInput.value);
            formData.append('description', descriptionInput.value);
            formData.append('tags', tagsInput.value);
            formData.append('content', contentInput.value);
    
            fetch('./controllers/blog-handler', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                return response.text()      
            })
            .then(response => {
                setTimeout(function() {
                    load_end();

                    if($.trim(response) == '1') {
                        $('#message-response').html("<div class='success'>New post created!</div></div>");
                    } else {
                        $('#message-response').html("<div class='error'>There was an error</div>");
                    }
                }, 500);
            })
            .catch( err => console.log(err));
        }
    }
    else {
        // Title
        if(titleInput.value) {
            titleInput.style.border = '1px solid #00863E';
            titleInput.style.backgroundColor = '#ffff';
        } else {
            titleInput.style.border = '1px solid red';
            titleInput.style.backgroundColor = 'rgb(254,220,224)';
        }
        // Description
        if(descriptionInput.value) {
            descriptionInput.style.border = '1px solid #00863E';
            descriptionInput.style.backgroundColor = '#ffff';
        } else {
            descriptionInput.style.border = '1px solid red';
            descriptionInput.style.backgroundColor = 'rgb(254,220,224)';
        }
        // Tags
        if(tagsInput.value) {
            tagsInput.style.border = '2px solid #00863E';
            tagsInput.style.backgroundColor = '#fff';
            var tagsValue = tagsInput.value;
            if (tagsValue === '') {
                tagsInput.style.border = '2px solid red';
                tagsInput.style.backgroundColor = 'rgb(254,220,224)';
            }
            var pieces = tagsValue.split(',');
            console.log(pieces);
            // Check array items
            if (pieces.length > 5) {
                tagsInput.style.border = '2px solid red';
                tagsInput.style.backgroundColor = 'rgb(254,220,224)';
            } else {
                tagsInput.style.border = '2px solid #00863E';
                tagsInput.style.backgroundColor = '#fff';
            }
        } else {
            tagsInput.style.border = '2px solid red';
            tagsInput.style.backgroundColor = 'rgb(254,220,224)';
        }
        // Content
        if(contentInput.value) {
            contentInput.style.border = '1px solid #00863E';
            contentInput.style.backgroundColor = '#ffff';
        } else {
            contentInput.style.border = '1px solid red';
            contentInput.style.backgroundColor = 'rgb(254,220,224)';
        }
    }
}

function update_post(event) {
    event.preventDefault();
    var formData = new FormData();

    var postIdInput = document.getElementById('post_id2');
    var titleInput = document.getElementById('title2');
    var descriptionInput = document.getElementById('description2');
    var tagsInput = document.getElementById('tags2');
    var contentInput = document.getElementById('content2');
    
    if(
        postIdInput.value &&
        titleInput.value &&
        tagsInput.value &&
        contentInput.value
    ) {

        var errElement = document.getElementById('err-2');
            
        const input = document.getElementById('image2');

        if (input.files && input.files[0] && !errElement.classList.contains('s')) {
            const file = input.files[0];
            const reader = new FileReader();
        
            reader.onload = function(e) {
                const img = new Image();
                img.src = e.target.result;
        
                img.onload = function() {
                    // Calculate new dimensions for resizing
                    const maxWidth = 900; // Change this to your desired width
                    const maxHeight = 900; // Change this to your desired height
        
                    let newWidth = img.width;
                    let newHeight = img.height;
        
                    if (img.width > maxWidth) {
                        newWidth = maxWidth;
                        newHeight = (img.height * maxWidth) / img.width;
                    }
        
                    if (newHeight > maxHeight) {
                        newHeight = maxHeight;
                        newWidth = (img.width * maxHeight) / img.height;
                    }
        
                    // Create a canvas and resize the image
                    const canvas = document.createElement('canvas');
                    canvas.width = newWidth;
                    canvas.height = newHeight;
                    const ctx = canvas.getContext('2d');
                    ctx.drawImage(img, 0, 0, newWidth, newHeight);
        
                    // Convert the canvas data to a Blob
                    canvas.toBlob(function(blob) {
                        // Append the resized image blob to the original formData object
                        formData.append('photo', blob, 'resized_image.webp');

                        load_start();

                        formData.append('update_post', 'true');
                        formData.append('post_id', postIdInput.value);
                        formData.append('title', titleInput.value);
                        formData.append('description', descriptionInput.value);
                        formData.append('tags', tagsInput.value);
                        formData.append('content', contentInput.value);

                        fetch('./controllers/blog-handler', {
                            method: 'POST',
                            body: formData
                        })
                        .then(response => {
                            return response.text()      
                        })
                        .then(response => {
                            setTimeout(function() {
                                load_end();

                                if (response === '1') {
                                    window.location.href = './blog?tab=blog';
                                } else {
                                    console.log('There was an error');
                                }

                            }, 500);
                        })
                        .catch( err => console.log(err));
                    }, 'image/jpeg', 0.8); // Change 'image/jpeg' and 0.8 to match your desired image format and quality
                };
            };
    
            reader.readAsDataURL(file);
            
        } else {
            load_start();

            formData.append('update_post', 'true');
            formData.append('post_id', postIdInput.value);
            formData.append('title', titleInput.value);
            formData.append('description', descriptionInput.value);
            formData.append('tags', tagsInput.value);
            formData.append('content', contentInput.value);
    
            fetch('./controllers/blog-handler', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                return response.text()      
            })
            .then(response => {
                setTimeout(function() {
                    load_end();
    
                    if (response === '1') {
                        window.location.href = './blog?tab=blog';
                    } else {
                        console.log('There was an error');
                    }

                }, 500);
            })
            .catch( err => console.log(err));
        }
    } else {
        // Title
        if(titleInput.value) {
            titleInput.style.border = '1px solid #00863E';
            titleInput.style.backgroundColor = '#ffff';
        } else {
            titleInput.style.border = '1px solid red';
            titleInput.style.backgroundColor = 'rgb(254,220,224)';
        }
        // Description
        if(descriptionInput.value) {
            descriptionInput.style.border = '1px solid #00863E';
            descriptionInput.style.backgroundColor = '#ffff';
        } else {
            descriptionInput.style.border = '1px solid red';
            descriptionInput.style.backgroundColor = 'rgb(254,220,224)';
        }
        // Tags
        if(tagsInput.value) {
            tagsInput.style.border = '2px solid #00863E';
            tagsInput.style.backgroundColor = '#fff';
            var tagsValue = tagsInput.value;
            if (tagsValue === '') {
                tagsInput.style.border = '2px solid red';
                tagsInput.style.backgroundColor = 'rgb(254,220,224)';
            }
            var pieces = tagsValue.split(',');
            console.log(pieces);
            // Check array items
            if (pieces.length > 5) {
                tagsInput.style.border = '2px solid red';
                tagsInput.style.backgroundColor = 'rgb(254,220,224)';
            } else {
                tagsInput.style.border = '2px solid #00863E';
                tagsInput.style.backgroundColor = '#fff';
            }
        } else {
            tagsInput.style.border = '2px solid red';
            tagsInput.style.backgroundColor = 'rgb(254,220,224)';
        }

        // Content
        if(contentInput.value) {
            contentInput.style.border = '1px solid #00863E';
            contentInput.style.backgroundColor = '#ffff';
        } else {
            contentInput.style.border = '1px solid red';
            contentInput.style.backgroundColor = 'rgb(254,220,224)';
        }
    }
}

function load_start() {
    var loader = document.getElementById('loader');
    loader.classList.add('loader-animation');
    var popBg = document.getElementById('popBg');
    if(!popBg.classList.contains('dark')) {
        if(popBg.classList.contains('light')) {
            popBg.classList.remove('light');
        }
        popBg.classList.add('dark');
    }
}
function load_end() {
    var loader = document.getElementById('loader');
    loader.classList.remove('loader-animation');
    var popBg = document.getElementById('popBg');
    if(popBg.classList.contains('dark')) {
        popBg.classList.remove('dark');
    }
    popBg.classList.add('light');
}
