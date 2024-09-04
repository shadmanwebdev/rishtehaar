// Input group 1
var relationshipInput = document.getElementById('relationship');
var maritalStatusInput = document.getElementById('marital_status');
var genderInput = document.getElementById('gender');
var ageInput = document.getElementById('age');
var feetInput = document.getElementById('feet');
var inchInput = document.getElementById('inch');
// Input group 2
var educationInput = document.getElementById('education');
var occupationInput = document.getElementById('occupation');
var casteInput = document.getElementById('caste');
var cityInput = document.getElementById('city');
var descriptionInput = document.getElementById('description');
// Input group 3
var emailInput = document.getElementById('email');
var whatsappInput = document.getElementById('whatsapp');
var pwdInput = document.getElementById('password');
var confirmPwdInput = document.getElementById('confirm_password');


var tosInput = document.getElementById('tos_agreement');

// Errors
var emailError = document.getElementById('email-error');
var descriptionError = document.getElementById('descriptionError');
var citySelectCheck = document.getElementById('city_selected');


// var genderRadioGroup =  document.getElementById('gender-radio-group');
tosWrapper = document.getElementById('agreement-check-wrapper');

function fireButton(event) {
    event.preventDefault();
    document.getElementById('image').click()
}



// Preview Profile Photo
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#img-preview').attr('src', e.target.result);
            $('.choose-photo').css({"display":"none"});
            $('#selected-img').css({"display":"block"});
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#image").change(function () {
    var allowed = ['png', 'jpg', 'jpeg', 'webp', 'jfif'];
    var imageInput = document.getElementById('image');
    var imgErrorElement = document.getElementById('img-error');
    var errElement = document.getElementById('err');

    if (imageInput.files.length === 0) {
        imgErrorElement.innerHTML = '';
        errElement.classList.remove('s');
        return;
    }

    var file = imageInput.files[0];
    var imgType = file.name.split('.').pop(); // Get the file extension
    var imgSize = file.size; // Get the file size in bytes

    if (!allowed.includes(imgType)) {
        errElement.classList.add('s');
        imgErrorElement.innerHTML = '<div class="error">Incorrect File Type</div>';
    } else if (imgSize > 1500000) { // 1.5MB in bytes
        errElement.classList.add('s');
        imgErrorElement.innerHTML = '<div class="error">Image is too large (max 1.5MB)</div>';
    } else {
        errElement.classList.remove('s');
        imgErrorElement.innerHTML = '';
        readURL(this); // Assuming readURL is a function to handle image preview
    }
});



if(typeof(feetInput) != 'undefined' && feetInput != null) {
    feetInput.addEventListener('change', function() {
        if(feetInput.value) {
            feetInput.style.border = '2px solid #00863E';
            feetInput.style.backgroundColor = 'rgb(249,249,249)';
        } else {
            feetInput.style.border = '2px solid red';
            feetInput.style.backgroundColor = 'rgb(254,220,224)';
        }
    });
}
if(typeof(cityInput) != 'undefined' && cityInput != null) {
    cityInput.addEventListener('change', function() {
        document.getElementById('city_selected').value = '';
    });
}
if(typeof(inchInput) != 'undefined' && inchInput != null) {
    inchInput.addEventListener('change', function() {
        if(inchInput.value) {
            inchInput.style.border = '2px solid #00863E';
            inchInput.style.backgroundColor = 'rgb(249,249,249)';
        } else {
            inchInput.style.border = '2px solid red';
            inchInput.style.backgroundColor = 'rgb(254,220,224)';
        }
    });
}
if(typeof(emailInput) != 'undefined' && emailInput != null) {
    emailInput.addEventListener('change', function() {
        if(emailInput.value && emailInput.value.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/)) {
            emailInput.style.border = '2px solid #00863E';
            emailInput.style.backgroundColor = 'rgb(249,249,249)';
        } else {
            emailInput.style.border = '2px solid red';
            emailInput.style.backgroundColor = 'rgb(254,220,224)';
        }
    });
}
if(typeof(whatsappInput) != 'undefined' && whatsappInput != null) {
    whatsappInput.addEventListener('change', function() {
        if(whatsappInput.value && whatsappInput.value.match(/^[0-9]*$/) && whatsappInput.value.length >= 10) {
            whatsappInput.style.backgroundColor = 'rgb(249,249,249)';
            whatsappInput.style.border = '2px solid #00863E';
        } else {
            whatsappInput.style.border = '2px solid red';
            whatsappInput.style.backgroundColor = 'rgb(254,220,224)';
        }
    });
}
if(typeof(ageInput) != 'undefined' && ageInput != null) {
    ageInput.addEventListener('change', function() {
        if(ageInput.value && (ageInput.value >= 18 && ageInput.value <= 80)) {
            ageInput.style.backgroundColor = 'rgb(249,249,249)';
            ageInput.style.border = '2px solid #00863E';
        } else {
            ageInput.style.border = '2px solid red';
            ageInput.style.backgroundColor = 'rgb(254,220,224)';
        }
    });
}
if(typeof(descriptionInput) != 'undefined' && descriptionInput != null) {
    descriptionInput.addEventListener('change', function() {
        if(descriptionInput.value && descriptionInput.value.length <= 500 && descriptionInput.value.length >= 50) {
            descriptionInput.style.backgroundColor = 'rgb(249,249,249)';
            descriptionInput.style.border = '2px solid #00863E';
            descriptionError.innerHTML = "";
        } else if(descriptionInput.value && descriptionInput.value.length <= 50) {
            descriptionInput.style.border = '2px solid red';
            descriptionInput.style.backgroundColor = 'rgb(254,220,224)';
            descriptionError.innerHTML = "<div>Description too short</div>";
        } else {
            descriptionInput.style.border = '2px solid red';
            descriptionInput.style.backgroundColor = 'rgb(254,220,224)';
            descriptionError.innerHTML = "<div>Description too long</div>";
        }
    });
}
if(typeof(casteInput) != 'undefined' && casteInput != null) {
    casteInput.addEventListener('change', function() {
        if(casteInput.value && casteInput.value.match(/^(?![\s.]+$)[a-zA-Z\s.]*$/)) {
            casteInput.style.border = '2px solid #00863E';
            casteInput.style.backgroundColor = 'rgb(249,249,249)';
        } else {
            casteInput.style.border = '2px solid red';
            casteInput.style.backgroundColor = 'rgb(254,220,224)';
        }
    });
}
if(typeof(occupationInput) != 'undefined' && occupationInput != null) {
    occupationInput.addEventListener('change', function() {
        if(occupationInput.value && occupationInput.value.match(/^(?![\s.]+$)[a-zA-Z\s.]*$/)) {
            occupationInput.style.border = '2px solid #00863E';
            occupationInput.style.backgroundColor = 'rgb(249,249,249)';
        } else {
            occupationInput.style.border = '2px solid red';
            occupationInput.style.backgroundColor = 'rgb(254,220,224)';
        }
    });
}

if(typeof(pwdInput) != 'undefined' && pwdInput != null) {
    pwdInput.addEventListener('change', function() {
        if(pwdInput.value) {
            pwdInput.style.border = '2px solid #00863E';
            pwdInput.style.backgroundColor = 'rgb(249,249,249)';
        } else {
            pwdInput.style.border = '2px solid red';
            pwdInput.style.backgroundColor = 'rgb(254,220,224)';
        }
        if(typeof(confirmPwdInput) != 'undefined' && confirmPwdInput != null) {
            // Check if passwords match
            if(confirmPwdInput.value) { 
                if(pwdInput.value == confirmPwdInput.value) {
                    pwdInput.style.border = '2px solid #00863E';
                    pwdInput.style.backgroundColor = 'rgb(249,249,249)';
                    confirmPwdInput.style.border = '2px solid #00863E';
                    confirmPwdInput.style.backgroundColor = 'rgb(249,249,249)';
                } else {
                    pwdInput.style.border = '2px solid red';
                    pwdInput.style.backgroundColor = 'rgb(254,220,224)';
                    confirmPwdInput.style.border = '2px solid red';
                    confirmPwdInput.style.backgroundColor = 'rgb(254,220,224)';
                }
            } 
        }
    });
}
if(typeof(confirmPwdInput) != 'undefined' && confirmPwdInput != null) {
    confirmPwdInput.addEventListener('change', function() {
        if(confirmPwdInput.value) {
            confirmPwdInput.style.border = '2px solid #00863E';
            confirmPwdInput.style.backgroundColor = 'rgb(249,249,249)';
        } else {
            confirmPwdInput.style.border = '2px solid red';
            confirmPwdInput.style.backgroundColor = 'rgb(254,220,224)';
        }
        if(typeof(pwdInput) != 'undefined' && pwdInput != null) {
            // Check if passwords match
            if(pwdInput.value) {
                if(pwdInput.value == confirmPwdInput.value) {
                    pwdInput.style.border = '2px solid #00863E';
                    pwdInput.style.backgroundColor = 'rgb(249,249,249)';
                    confirmPwdInput.style.border = '2px solid #00863E';
                    confirmPwdInput.style.backgroundColor = 'rgb(249,249,249)';
                } else {
                    pwdInput.style.border = '2px solid red';
                    pwdInput.style.backgroundColor = 'rgb(254,220,224)';
                    confirmPwdInput.style.border = '2px solid red';
                    confirmPwdInput.style.backgroundColor = 'rgb(254,220,224)';
                }
            } 
        }
    });
}


if(typeof(tosInput) != 'undefined' && tosInput != null) {
    tosInput.addEventListener('change', function() {
        if(tosInput.checked) {
            tosWrapper.style.padding = '0';
            tosWrapper.style.border = 'none';
            tosWrapper.style.backgroundColor = 'rgb(255,255,255)';
        } else {
            tosWrapper.style.padding = '2px 10px';
            tosWrapper.style.border = '2px solid red';
            tosWrapper.style.backgroundColor = 'rgb(254,220,224)';
        }
    });
}






function hideCards() {
    var cardNodelist = document.querySelectorAll('.form-card');   
    for (let i = 0; i < cardNodelist.length; i++) {
        cardNodelist[i].style.position = 'absolute';
        cardNodelist[i].style.zIndex = -10;
        cardNodelist[i].style.opacity = 0;
    }
}

document.getElementById('form-card-1').style.position = 'static';
document.getElementById('form-card-1').style.opacity = 1;


function toggleCards(id) {
    var idArr = id.split('-');
    cardNo = idArr[1];
    direction = idArr[2];
    console.log(cardNo, direction);

    
    var card1 = document.getElementById('form-card-1');
    var card2 = document.getElementById('form-card-2');
    var card3 = document.getElementById('form-card-3');
    var card4 = document.getElementById('form-card-4');
    var card5 = document.getElementById('form-card-5');


    if(cardNo == 1 && direction == 'next') {
        // Validate Inputs
        if(
            relationshipInput.value &&
            maritalStatusInput.value &&
            genderInput.value &&
            ageInput.value && (ageInput.value >= 18 && ageInput.value <= 80) &&
            feetInput.value &&
            inchInput.value
        ) {
            hideCards();
            console.log(emailError.innerHTML);
            card2.style.position = 'static';
            card2.style.opacity = 1;
            console.log(genderInput.value, $('.profile-placeholder img'));
            if(genderInput.value == 'male' || genderInput.value == 'Male' ) {
                $('.profile-placeholder img').attr('src', './assets/svg/male.svg');
            } else if(genderInput.value == 'female' || genderInput.value == 'Female') {
                $('.profile-placeholder img').attr('src', './assets/svg/female.svg');
            }
            return;
        } else {
            if(relationshipInput.value) {
                document.getElementById('relationshipTrigger').style.border = '2px solid #00863E';
                document.getElementById('relationshipTrigger').style.backgroundColor = 'rgb(249,249,249)';
            } else {
                document.getElementById('relationshipTrigger').style.border = '2px solid red';
                document.getElementById('relationshipTrigger').style.backgroundColor = 'rgb(254,220,224)';
            }
            if(maritalStatusInput.value) {
                document.getElementById('maritalStatusTrigger').style.border = '2px solid #00863E';
                document.getElementById('maritalStatusTrigger').style.backgroundColor = 'rgb(249,249,249)';
            } else {
                document.getElementById('maritalStatusTrigger').style.border = '2px solid red';
                document.getElementById('maritalStatusTrigger').style.backgroundColor = 'rgb(254,220,224)';
            }
            if(genderInput.value) {
                document.getElementById('genderTrigger').style.border = '2px solid #00863E';
                document.getElementById('genderTrigger').style.backgroundColor = 'rgb(249,249,249)';
            } else {
                document.getElementById('genderTrigger').style.border = '2px solid red';
                document.getElementById('genderTrigger').style.backgroundColor = 'rgb(254,220,224)';
            }
            if(ageInput.value && (ageInput.value >= 18 && ageInput.value <= 80)) {
                ageInput.style.border = '2px solid #00863E';
                ageInput.style.backgroundColor = 'rgb(249,249,249)';
            } else {
                ageInput.style.border = '2px solid red';
                ageInput.style.backgroundColor = 'rgb(254,220,224)';
            }
            if(feetInput.value) {
                feetInput.style.border = '2px solid #00863E';
                feetInput.style.backgroundColor = 'rgb(249,249,249)';
            } else {
                feetInput.style.border = '2px solid red';
                feetInput.style.backgroundColor = 'rgb(254,220,224)';
            }
            if(inchInput.value) {
                inchInput.style.border = '2px solid #00863E';
                inchInput.style.backgroundColor = 'rgb(249,249,249)';
            } else {
                inchInput.style.border = '2px solid red';
                inchInput.style.backgroundColor = 'rgb(254,220,224)';
            }
            // if(fullnameInput.value && fullnameInput.value.match(/^(?![\s.]+$)[a-zA-Z\s.]*$/)) {
            //     fullnameInput.style.border = '2px solid #00863E';
            //     fullnameInput.style.backgroundColor = 'rgb(249,249,249)';
            // } else {
            //     fullnameInput.style.border = '2px solid red';
            //     fullnameInput.style.backgroundColor = 'rgb(254,220,224)';
            // }     
            return;
        }
    }
    if(cardNo == 2 && direction == 'next') {
        // Validate Inputs
        if(        
            educationInput.value && 
            occupationInput.value && occupationInput.value.match(/^(?![\s.]+$)[a-zA-Z\s.]*$/) && 
            casteInput.value && casteInput.value.match(/^(?![\s.]+$)[a-zA-Z\s.]*$/) && 
            cityInput.value && citySelectCheck.value &&
            descriptionInput.value && descriptionInput.value.length <= 500 && descriptionInput.value.length >= 50
        ) {
            hideCards();
            card3.style.position = 'static';
            card3.style.opacity = 1;
            return;
        } else {

            if(educationInput.value) {
                document.getElementById('educationTrigger').style.border = '2px solid #00863E';
                document.getElementById('educationTrigger').style.backgroundColor = 'rgb(249,249,249)';
            } else {
                document.getElementById('educationTrigger').style.border = '2px solid red';
                document.getElementById('educationTrigger').style.backgroundColor = 'rgb(254,220,224)';
            }
            if(occupationInput.value && occupationInput.value.match(/^(?![\s.]+$)[a-zA-Z\s.]*$/)) {
                occupationInput.style.border = '2px solid #00863E';
                occupationInput.style.backgroundColor = 'rgb(255,255,255)';
            } else {
                occupationInput.style.border = '2px solid red';
                occupationInput.style.backgroundColor = 'rgb(254,220,224)';
            }
            if(casteInput.value && casteInput.value.match(/^(?![\s.]+$)[a-zA-Z\s.]*$/)) {
                casteInput.style.border = '2px solid #00863E';
                casteInput.style.backgroundColor = 'rgb(249,249,249)';
            } else {
                casteInput.style.border = '2px solid red';
                casteInput.style.backgroundColor = 'rgb(254,220,224)';
            }
            if(citySelectCheck.value) {
                if(cityInput.value) {
                    document.getElementById('city').style.border = '2px solid #00863E';
                    document.getElementById('city').style.backgroundColor = 'rgb(249,249,249)';
                } else {
                    document.getElementById('city').style.border = '2px solid red';
                    document.getElementById('city').style.backgroundColor = 'rgb(254,220,224)';
                }
            } else {
                document.getElementById('city').style.border = '2px solid red';
                document.getElementById('city').style.backgroundColor = 'rgb(254,220,224)';
            }

            if(descriptionInput.value && descriptionInput.value.length <= 500 && descriptionInput.value.length >= 50) {
                descriptionInput.style.backgroundColor = 'rgb(249,249,249)';
                descriptionInput.style.border = '2px solid #00863E'; 
                descriptionError.innerHTML = "";
            } else if(descriptionInput.value && descriptionInput.value.length <= 50) {
                descriptionInput.style.border = '2px solid red';
                descriptionInput.style.backgroundColor = 'rgb(254,220,224)';
                descriptionError.innerHTML = "<div>Description too short</div>";
            } else {
                descriptionInput.style.border = '2px solid red';
                descriptionInput.style.backgroundColor = 'rgb(254,220,224)';
                descriptionError.innerHTML = "<div>Description too long</div>";
            }
                
            return;
        }
    }
    if(cardNo == 3 && direction == 'next') {
        // console.log(maritalStatusInput.value, casteInput.value, educationInput.value, occupationInput.value, cityInput.value);
        // Validate Inputs
        if(
            emailInput.value && emailInput.value.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/) && 
            emailError.innerHTML == '' &&
            whatsappInput.value && whatsappInput.value.match(/^[0-9]*$/) && whatsappInput.value.length >= 10 &&
            pwdInput.value &&
            confirmPwdInput.value &&
            pwdInput.value == confirmPwdInput.value &&
            tosInput.checked
        ) {
            hideCards();
            card4.style.position = 'static';
            card4.style.opacity = 1;
            return;
        } else {
            // Email
            if(emailInput.value && emailInput.value.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/)) {
                emailInput.style.border = '2px solid #00863E';
                emailInput.style.backgroundColor = 'rgb(249,249,249)';
            } else {
                emailInput.style.border = '2px solid red';
                emailInput.style.backgroundColor = 'rgb(254,220,224)';
            }
            // Contact
            if(whatsappInput.value && whatsappInput.value.match(/^[0-9]*$/) && whatsappInput.value.length >= 10) {
                whatsappInput.style.border = '2px solid #00863E';
                whatsappInput.style.backgroundColor = 'rgb(249,249,249)';
            } else {
                whatsappInput.style.border = '2px solid red';
                whatsappInput.style.backgroundColor = 'rgb(254,220,224)';
            }
            // Password
            if(pwdInput.value) {
                pwdInput.style.border = '2px solid #00863E';
                pwdInput.style.backgroundColor = 'rgb(249,249,249)';
            } else {
                pwdInput.style.border = '2px solid red';
                pwdInput.style.backgroundColor = 'rgb(254,220,224)';
            }
            // Confirm Password
            if(confirmPwdInput.value) {
                confirmPwdInput.style.border = '2px solid #00863E';
                confirmPwdInput.style.backgroundColor = 'rgb(249,249,249)';
            } else {
                confirmPwdInput.style.border = '2px solid red';
                confirmPwdInput.style.backgroundColor = 'rgb(254,220,224)';
            }
            // Check if passwords match
            if(pwdInput.value && confirmPwdInput.value && pwdInput.value == confirmPwdInput.value) { 
                pwdInput.style.border = '2px solid #00863E';
                pwdInput.style.backgroundColor = 'rgb(249,249,249)';
                confirmPwdInput.style.border = '2px solid #00863E';
                confirmPwdInput.style.backgroundColor = 'rgb(249,249,249)';
            } else {
                pwdInput.style.border = '2px solid red';
                pwdInput.style.backgroundColor = 'rgb(254,220,224)';
                confirmPwdInput.style.border = '2px solid red';
                confirmPwdInput.style.backgroundColor = 'rgb(254,220,224)';
            }
            // TOS
            if(tosInput.checked) {
                tosWrapper.style.padding = '0';
                tosWrapper.style.border = 'none';
                tosWrapper.style.backgroundColor = 'rgb(255,255,255)';
            } else {
                tosWrapper.style.padding = '2px 10px';
                tosWrapper.style.border = '2px solid red';
                tosWrapper.style.backgroundColor = 'rgb(254,220,224)';
            }
            return;
        }
    }
    if(cardNo == 2 && direction == 'back') {
        hideCards();
        card1.style.position = 'static';
        card1.style.opacity = 1;
    }
    if(cardNo == 3 && direction == 'back') {
        hideCards();
        card2.style.position = 'static';
        card2.style.opacity = 1;
    }
    if(cardNo == 4 && direction == 'back') {
        hideCards();
        card3.style.position = 'static';
        card3.style.opacity = 1;
    }
    
    if(cardNo == 4 && direction == 'next') {
        // var loader = document.getElementById('loader');
        // loader.classList.add('loader-animation');
        popup('confirmation-success');
        var loadingSvg = document.getElementById('loading-svg');
        console.log(loadingSvg);
        loadingSvg.classList.add('rotate');
        setTimeout(function() {
            // var form = $('form')[0];
            // var formData = new FormData(form);

            // Create a FormData object
            var formData = new FormData();

            // Append the form fields to the formData object
            formData.append('relationship', relationshipInput.value);
            formData.append('marital_status', maritalStatusInput.value);
            formData.append('gender', genderInput.value);
            formData.append('age', ageInput.value);
            formData.append('feet', feetInput.value);
            formData.append('inch', inchInput.value);
            formData.append('education', educationInput.value);
            formData.append('occupation', occupationInput.value);
            formData.append('caste', casteInput.value);
            formData.append('city', cityInput.value);
            formData.append('description', descriptionInput.value);
            formData.append('email', emailInput.value);
            formData.append('whatsapp', whatsappInput.value);
            formData.append('password', pwdInput.value);

            var errElement = document.getElementById('err');
            
            const input = document.getElementById('image');
            if (input.files && input.files[0] && !errElement.classList.contains('s')) {
                const file = input.files[0];
                const reader = new FileReader();
            
                reader.onload = function(e) {
                    const img = new Image();
                    img.src = e.target.result;
            
                    img.onload = function() {
                        // Calculate new dimensions for resizing
                        const maxWidth = 500; // Change this to your desired width
                        const maxHeight = 500; // Change this to your desired height
            
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
            
                            // Now, you can send the formData with the image to your PHP server
                            $.ajax({
                                url: './controllers/registration-handler.php',
                                type: 'POST',
                                data: formData,
                                cache: false,
                                contentType: false,
                                processData: false,
                                success: function(response, textStatus, jqXHR) {
                                    console.log(response);
                                    console.log('We are rotating');
                                    $('#loading-svg').removeClass('rotate');
                                    // Handle the response as needed
                                    window.location.href = './';
                                    // hidePopupBg();
            
                                    // hideCards();
                                    // card5.style.position = 'static';
                                    // card5.style.opacity = 1;
                                },
                                error: function(jqXHR, textStatus, errorThrown) {
                                    console.log(jqXHR);
                                    console.log(textStatus);
                                    console.log(errorThrown);
                                }
                            });
                        }, 'image/jpeg', 0.8); // Change 'image/jpeg' and 0.8 to match your desired image format and quality
                    };
                };
            
                reader.readAsDataURL(file);
            } else {
                // If no image is selected, you can still send the other form data
                $.ajax({
                    url: './controllers/registration-handler.php',
                    type: 'POST',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(response, textStatus, jqXHR) {
                        console.log(response);
                        console.log('We are rotating');
                        $('#loading-svg').removeClass('rotate');
                        // Handle the response as needed
                        window.location.href = './';
                        // hidePopupBg();

                        // hideCards();
                        // card5.style.position = 'static';
                        // card5.style.opacity = 1;
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(jqXHR);
                        console.log(textStatus);
                        console.log(errorThrown);
                    }
                });
            }
        }, 2000);
    }
}

function radioVal(radioVal) {
    var genderInput = document.getElementById('gender');
    var femaleRadio = document.getElementById('gender-female');
    var maleRadio = document.getElementById('gender-male');

    genderRadioGroup.style.padding = '0';
    genderRadioGroup.style.borderRadius = '0';
    genderRadioGroup.style.border = 'none';
    genderRadioGroup.style.backgroundColor = 'rgb(255,255,255)';

    if(radioVal == 'male') {
        femaleRadio.checked = false;
        maleRadio.checked = true;
        genderInput.value = 'male';
        return;
    }
    if(radioVal == 'female') {
        maleRadio.checked = false;
        femaleRadio.checked = true;
        genderInput.value = 'female';
        return;
    }
}



