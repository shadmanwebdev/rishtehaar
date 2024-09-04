<?php include './header.php'; ?>
<link rel="stylesheet" href="../css/register.css?v=200">

<style>
    a.del-link {
        display: block;
        font-size: 15px;
        color: red;
        margin-bottom: 20px;
    }
    .blog-form.edit-blog-popup {
        max-width: 1260px;
        height: 90vh;
        border-radius: 9px;
        overflow-y: scroll;
        padding: 50px;
        position: fixed;
        top: 50%;
        left: 50%;
        background-color: #fff;
        margin-top: -45vh;
        margin-left: -630px;
    }
    form.edit-blog-popup .form-title h3 {
        text-align: center;
    }
    .edit-form-title {
        margin-bottom: 30px;
        font-size: 18px;
        font-weight: 500;
        line-height: 26px;
        letter-spacing: 0em;
        text-align: center;
    }
    .edit-blog-popup .form-inner-div {
        width: 100%;
        padding: 50px 50px 20px 50px;
    }
    .edit-blog-popup .input-group {
        margin-bottom: 20px;
    }
    .edit-blog-popup .input-col.input-col-1 {
        width: 100%;
        margin-bottom: 8px;
    }
    .edit-blog-popup .input-col label {
        font-size: 15px;
    }

    .showDropdown {
        top: 45px;
    }
    .edit-blog-popup .submit-wrapper {
        padding: 30px 0;
        border-top: 1px solid #DEDEDE
    }
    .edit-blog-popup div.update-user-btn {
        color: #0E0E0E !important;
        background-color: #FFB600 !important;
        width: 160px;
        font-size: 16px;
        padding: 12px 0;
        text-align: center;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        margin: 0 auto;
    }
    .edit-blog-popup .submit-wrapper {
        padding: 0;
        border-top: none;
    }
    .blog-tab .profiles-wrapper .profile .profile-head {
        grid-template-columns: 30px calc(100% - 330px) 250px;
    }
</style>

<style>
    .tab { 
        padding: 50px 0 0 50px;
        width: 82vw;
    }
    .tab-inner-div { 
        margin: 0 auto;
        width: 1300px;
        border-bottom: 1px solid #DEDEDE;
        display: flex;
        flex-flow: row nowrap;
    }
    .tab-link {
        font-size: 18px;
        font-weight: 500;
        line-height: 26px;
        letter-spacing: 0em;
        text-align: left;
        cursor: pointer;
        color: #858585;
        padding: 10px 15px;
    }

    .tab-link.selected {
        color: #FFB600;
        border-bottom: 4px solid #FFB600;
    }

    .admin-content {
        display: none;
    }
    @media screen and (max-width: 1560px) {
        .tab { 
            padding: 20px 0 0 50px;
            width: 82vw;
        }
        .tab-inner-div { 
            margin: 0 auto;
            width: 1100px;
            border-bottom: 1px solid #DEDEDE;
            display: flex;
            flex-flow: row nowrap;
        }
    }
    @media screen and (max-width: 1280px) {
        .tab {
            width: 90%;
            margin: 0 auto;
        }
        .tab-inner-div { 
            width: 100%;
        }
    }
</style>

<div id="loader"></div>

<style>
    .profiles-wrapper .profile .profile-head {
        width: 100%;
        display: grid;
        grid-template-columns: 30px calc(100% - 300px) 200px;
        column-gap: 15px;
    }
    .profiles-wrapper .profile .profile-head > div:nth-child(2) {
        width: 90% !important;
    }
    .profiles-wrapper .profile .actions {
        width: 100% !important;
        margin-left: auto;
    }

</style>


<!-- Write blog -->
<style>
    form {
        display: block;
    }
    .blog-form {
        width: 1260px;
        margin: 20px auto;
    }
    .blog-form label {
        font-size: 16px;
        font-weight: 400;
        line-height: 30px;
        letter-spacing: 0em;
        text-align: left;
    }
    .blog-form .input-group {
        margin-bottom: 20px;
    }
    .blog-form input {
        border: 2px solid #ADADAD;
    }
    .blog-form .apply-btn {
        margin-top: 30px;
        width: 150px;
        padding: 15px 15px;
        text-align: center;
        font-size: 14px;
        border-radius: 4px;
        border: none;
        box-shadow: none;
        font-weight: 600;
        color: #000;
        background: #FFB600;
        cursor: pointer;
    }
    .blog-form .input-group input {
        height: 45px;
    }
    .blog-form .input-group input,
    .blog-form .input-group textarea {
        font-family: 'Roboto', sans-serif;
        border: 2px solid rgb(0, 134, 62);
        color: #000;
        font-size: 14px;
        padding: 15px 15px;
        border-radius: 8px;
        outline: none;
        border: 1px solid rgb(105,105,105);
        background-color: #FFFFFF;
        font-size: 16px;
        width: 100%;
        border-radius: 8px;
        display: flex;
        align-items: center;
    }
    @media screen and (max-width: 768px) {  
        .admin_page-wrapper > div {
            
            margin: 0 auto;
        }
        .tab {
            padding: 0;
            width: 350px;
            margin: 20px auto 0 auto;
        }
        .admin-content {
            padding: 0;
            width: 350px;
            margin: 20px auto;
        }
        .profiles-body {
            padding: 0;
            width: 350px;
            overflow-x: scroll;
        }
        .profile {
            width: 1200px;
        }
        .pagination {
            width: 350px;
            margin: 0;
        }
        .blog-form {
            width: 350px;
            margin: 20px auto;
        }
    }
    @media screen and (max-width: 768px) {  
        form.edit-blog-popup .form-title h3 {
            margin-bottom: 20px;
        }
        .blog-form.edit-blog-popup {
            max-width: 95%;
            height: 90vh;
            margin-left: -42.5%;
            padding: 30px 20px;
        }
    }
</style>

<style>
    .cross {
        position: absolute;
        z-index: 101;
        top: 15px;
        right: 15px;
        width: 28px;
        height: 28px;
        cursor: pointer;
    }
</style>

<!-- Verification Pop Ups -->
<style>
    .not-recieved {
        
        font-size: 14px;
        font-weight: 400;
        line-height: 30px;
        letter-spacing: 0em;
        text-align: center;
        color: #7E7E7E;
        margin-top: 20px;
    }
    .resend-link {
        
        font-size: 16px;
        font-weight: 500;
        line-height: 30px;
        letter-spacing: 0em;
        text-align: center;
        color: #FFB600;
        text-align: center;
        cursor: pointer;
        transition: .4s;
    }
    .resend-link:hover {
        color: #f0ab00;
    }
    #success-popup {
        padding: 50px;
        width: 438px;
        /* height: 455px; */
        /* display: flex;
        align-items: center;
        justify-content: center; */
        position: fixed;
        top: 300px;
        left: 50%;
        margin-left: -219px;
        border-radius: 21px;
        background: #FFFFFF;
        box-shadow: 0px 2px 10px 0px #00000026;
        text-align: center;
        z-index: 100;
    }
    .popup-title {  
        
        font-size: 18px;
        font-weight: 600;
        line-height: 30px;
        letter-spacing: 0em;
        text-align: center;
        color: #000;
    }
    .popup-subtitle {
        margin: 10px 0;
    }
    .popup-subtitle p {
        
        font-size: 16px;
        font-weight: 400;
        line-height: 22px;
        letter-spacing: 0em;
        text-align: center;
        margin-bottom: 5px;
    }
    form.verify-code input {
        color: #ADADAD;
        border: 2px solid #ADADAD;
        padding: 10px 20px;
        radius: 7px;
    }
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
    input[type=number] {
        -moz-appearance: textfield;
    }
    form.verify-code .form-group {
        display: flex;
        flex-direction: column;
    }
    form.verify-code div.submit {
        padding: 10px 20px;
        border-radius: 7px;
        background: #FFB600;
        color: #0E0E0E;
        width: 100%;
        cursor: pointer;
        transition: .4s;
    }
    form.verify-code div.submit:hover {
        background: #ffc73c;
    }
    #success-popup .icon {
        width: 65px;
        height: 65px;
        margin: 0 auto 10px auto;
    }
    @media screen and (max-width: 768px) {
        #success-popup {
            max-width: 350px;
            left: 50%;
            margin-left: -175px;
            padding: 30px;
        }
    }
</style>



<!-- User Avatar -->
<style>
    /* Profile pic */
    .choose-photo {
        width: 250px;
        height: 250px;
        margin: 0;
        display: flex;
        flex-flow: column nowrap;
        justify-content: center;
        align-items: center;
        row-gap: 30px;
        border-radius: 20px;
        overflow: hidden;
        box-sizing: content-box;
        border: 1px solid rgba(200, 200, 200, .5);
    }
    /* .choose-photo svg {
        margin-bottom: -40px;
        color: rgba(200, 200, 200, .5);
    } */
    .selected-img#selected-img,
    .selected-img#selected-img-2 {
        position: relative;
        width: 250px;
        height: 250px;
        display: none;
        margin: 0;
        border-radius: 20px;
        overflow: hidden;
    }
    .selected-img img {
        width: inherit;
        height: inherit;
        object-fit: cover;
    }
    .selected-img img.img-success {
        width: 35px;
        height: 35px;
        position: absolute;
        top: 5px;
        right: 5px;
    }
    .profile-placeholder {
        width: 250px;
        height: 250px;
        overflow: hidden;
        margin: 0;
        border-radius: 20px;
    }
    .profile-placeholder img {
        width: 100%;
        height: 100%;    
        object-fit: cover;
    }
    .register-btn-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
    }
    #pfpBtn {
        width: 250px;
        color: #1B68FF;
        background-color: #fff;
        padding: 8px 0;
        text-align: center;
        font-size: 14px;
        border-radius: 4px;
        cursor: pointer;
        border: none;
        border: 1px solid #1B68FF;
    }
    .profile-placeholder {
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .err {
        display: none;
        padding: 8px 30px;
        border-radius: 30px;
        background: #D70000;
        margin: 0 auto;
        font-size: 16px;
        position: absolute;
        color: #fff;
    }
    .err.s {
        display: block;
    }
    .selected-option {
        font-weight: 500;
    }
    textarea#description {
        font-weight: 500;
    }
    .img-error .error {
        color: #ff6060;
        font-size: 12px;
        letter-spacing: .6px;
        line-height: 20px;
        padding: 0 12px;
        text-align: center;
        margin-bottom: 10px;
    }
    /* #selected-img img.img-success {
        width: 35px;
        height: 35px;
        position: absolute;
        top: 5px;
        right: 5px;
    } */
</style>


<div class='popup hide_popup' id='success-popup'>

    <img src="../assets/svg/cross.svg" alt="Close Icon" class='cross' onclick='closePopup()'>

    <div class='popup-inner-div'>
        <div class='icon'>
            <img src="../assets/svg/check-round.svg" alt="Email confirmation icon">
        </div>
        <div class='popup-title'>Article Updated Successfully</div>
    </div>
</div>


<div class="admin_page-wrapper">
    <?php include './admin-sidebar.php'; ?>
    <div>
        <div class="tab">
            <div class="tab-inner-div">
                <?php
                    $selectedTab = isset($_GET['tab']) ? $_GET['tab'] : 'write-blog';
                    // Write blog tab selected
                    if($selectedTab == "write-blog") {
                        $style1 = " style='display: block;'";
                    } else {
                        $style1 = " style='display: none;'";
                    }
                    // Blog tab selected
                    if($selectedTab == 'blog') {
                        $style2 = " style='display: block !important;'";
                    } else {
                        $style2 = '';
                    }
                ?>

                <div class="tab-link <?php if ($selectedTab === 'write-blog') echo 'selected'; ?>" data-tab="write-blog" onclick="showTab('write-blog')">Write Blog</div>
                <div class="tab-link <?php if ($selectedTab === 'blog') echo 'selected'; ?>" data-tab="blog" onclick="showTab('blog')">List of Blogs</div>

            </div>
        </div>
        <div class="admin-content" id="write-blog-tab" <?= $style1; ?>>
            <?php
                $blog = new Blog();
                echo $blog->create_form();
            ?>
        </div>
        <div class="admin-content" id="blog-tab" <?= $style2; ?>>
            <?php
                $blog = new Blog();
                echo $blog->blog_admin();
            ?>
        </div>
    </div>
</div>


<div id='formContainer2'>

</div>





 

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script defer>
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
                $('#profile-placeholder').css({"display":"none"});
                $('#selected-img').css({"display":"block"});
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#image").change(function () {
        var allowed = ['png', 'jpg', 'jpeg', 'webp', 'jfif'];
        var imageInput = document.getElementById('image');
        var imgErrorElement = document.getElementById('img-error-1');
        var errElement = document.getElementById('err-1');

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
        } else if (imgSize > 5000000) { // 5MB in bytes
            errElement.classList.add('s');
            imgErrorElement.innerHTML = '<div class="error">Image is too large (max 5MB)</div>';
        } else {
            errElement.classList.remove('s');
            imgErrorElement.innerHTML = '';
            readURL(this); // Assuming readURL is a function to handle image preview
        }
    });





    function fireButton2(event) {
        event.preventDefault();
        document.getElementById('image2').click()
    }


    // Preview Profile Photo
    function readURL2(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#img-preview-2').attr('src', e.target.result);
                $('#profile-placeholder-2').css({"display":"none"});
                $('#selected-img-2').css({"display":"block"});
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

</script>

<script defer>



    var adminContent1 = document.getElementsByClassName('admin-content')[0];

    // Check what the selected tab is when page is refreshed
    var selectedTab = '<?= $selectedTab; ?>';
    console.log('Selected tab: ', selectedTab);
    if(selectedTab == 'write-blog') {
        adminContent1.style.display = 'block';
    }
    
    function showTab(tabName) {
        window.location.href = './blog?tab='+tabName;
    }
    function edit_post_form(event, id) {
        event.preventDefault();
        // Create a new FormData object
        var formData = new FormData();

        // Append the arguments to the FormData object
        formData.append('get_edit_post', 'true');
        formData.append('id', id);

        // Send the AJAX request using fetch
        fetch('./controllers/blog-handler.php', {
            method: 'POST',
            body: formData
        })
        .then(function(response) {
            return response.text();
        })
        .then(function(data) {
            document.getElementById('formContainer2').innerHTML = data;
            popup('edit-blog-popup');

            $("#image2").change(function () {
                console.log(1);
                var allowed = ['png', 'jpg', 'jpeg', 'webp', 'jfif'];
                var imageInput = document.getElementById('image2');
                
                var imgErrorElement = document.getElementById('img-error-2');
                var errElement = document.getElementById('err-2');

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
                } else if (imgSize > 5000000) { // 5MB in bytes
                    errElement.classList.add('s');
                    imgErrorElement.innerHTML = '<div class="error">Image is too large (max 5MB)</div>';
                } else {
                    errElement.classList.remove('s');
                    imgErrorElement.innerHTML = '';
                    readURL2(this); // Assuming readURL is a function to handle image preview
                }
            });
        })
        .catch(function(error) {
            console.error('Error:', error);
        });
    }

    function delete_post(id) {
        // Create FormData object
        var formData = new FormData();
        formData.append('delete_post', 'true');
        formData.append('post_id', id);

        // Send AJAX request
        fetch('./controllers/blog-handler.php', {
            method: 'POST',
            body: formData
        })
        .then(function(response) {
            return response.text();
        })
        .then(function(data) {
            console.log(data);
            // Handle response
            if (data === '1') {
                window.location.href = './blog?tab=blog';
            } else {
                console.log('There was an error');
            }
        })
        .catch(function(error) {
            console.error(error);
            // Handle error
        });
    }

    function delete_post_img(event, thumbnail, id) {
        event.preventDefault();

        // Create FormData object
        var formData = new FormData();
        formData.append('delete_post_img', 'true');
        formData.append('thumbnail', thumbnail);
        formData.append('post_id', id);

        // Send AJAX request
        fetch('./controllers/blog-handler.php', {
            method: 'POST',
            body: formData
        })
        .then(function(response) {
            return response.text();
        })
        .then(function(data) {
            console.log(data);
            // Handle response
            if (data === '1') {
                $('#profile-placeholder-2').css({"display":"block"});
                $('#selected-img-2').css({"display":"none"});
                // document.getElementById('update-img-div').style.display = 'none';
                // $('#update-img-div').css('display: none');
                console.log('Image deleted');
            } else {
                console.log('There was an error');
            }
        })
        .catch(function(error) {
            console.error(error);
            // Handle error
        });
    }




    var titleInput = document.getElementById('title');
    var tagsInput = document.getElementById('tags');
    var contentInput = document.getElementById('content');

    if(typeof(titleInput) != 'undefined' && titleInput != null) {
        titleInput.addEventListener('change', function() {
            if(titleInput.value) {
                titleInput.style.border = '2px solid #00863E';
                titleInput.style.backgroundColor = '#fff';
            } else {
                titleInput.style.border = '2px solid red';
                titleInput.style.backgroundColor = 'rgb(254,220,224)';
            }
        });
    }
    if(typeof(tagsInput) != 'undefined' && tagsInput != null) {
        tagsInput.addEventListener('change', function() {
            
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
        });
    }
    if(typeof(contentInput) != 'undefined' && contentInput != null) {
        contentInput.addEventListener('change', function() {
            if(contentInput.value) {
                contentInput.style.border = '2px solid #00863E';
                contentInput.style.backgroundColor = '#fff';
            } else {
                contentInput.style.border = '2px solid red';
                contentInput.style.backgroundColor = 'rgb(254,220,224)';
            }
        });
    }
</script>

<script src="js/blog.js?v=22" defer></script>



<?php include './footer.php'; ?>