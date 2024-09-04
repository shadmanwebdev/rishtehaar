


    const input = document.getElementById('image');
    if (input.files && input.files[0]) {
        const file = input.files[0];
        const reader = new FileReader();

        reader.onload = function(e) {
            const img = new Image();
            img.src = e.target.result;

            img.onload = function() {
                // Calculate new dimensions for resizing
                const maxWidth = 800; // Change this to your desired width
                const maxHeight = 800; // Change this to your desired height

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
                    // Create a new FormData object and append the resized image blob
                    const formData = new FormData();
                    formData.append('resized_image', blob, 'resized_image.jpg');
                }, 'image/jpeg', 0.8); // Change 'image/jpeg' and 0.8 to match your desired image format and quality
            };
        };

        reader.readAsDataURL(file);
    }