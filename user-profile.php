<?php include './partials/header.php'; ?>
<?php include './partials/navigation.php'; ?>

<?php
    if(isset($_SESSION['user'])) {
        $userdata = json_decode($_SESSION['user'], true);
        if(intval($userdata['uid']) !== intval($_GET['i'])) {
            header('location: ./');
        }
    } else {
        header('location: ./');
    }
?>
<link rel="stylesheet" href="./css/popup.css">
<style>
    .profile-page-wrapper {
        width: 100%;
        display: flex;
        flex-flow: column nowrap;
        align-items: center;
        justify-content: center;
    }
    .profile-page-header {
        width: 100%;
        padding: 50px;
        display: flex;
        flex-flow: column nowrap;
        align-items: center;
        justify-content: center;
        border-bottom: 1px solid rgb(239,234,229);
    }
    .profile-page-content {
        width: 100%;
        padding: 0;
        display: flex;
        flex-flow: column nowrap;
        align-items: center;
        justify-content: center;
    }
    .profile-tabs {
        height: 65px; 
        width: 350px;
        border: 1px solid rgb(213,211,210);
        border-radius: 12px;
        background-color: #fff;
        display: flex;
        flex-flow: row nowrap;
        align-items: center;
        justify-content: center;
        column-gap: 50px;
    }
    .profile-tab {
        font-size: 16px;
        
        color: rgb(21,21,21);
        line-height: 1;
        cursor: pointer;
    }
    /* .profile-section {
        position: absolute;
        z-index: -10;
        opacity: 0;
    } */
    #profile-section-1.profile-section {
        width: 500px;
        display: flex;
        flex-flow: column nowrap;
    }
    .user_update_form {
        width: 100%;
        display: flex;
        flex-flow: column nowrap;
        row-gap: 30px;
    }
    .profile-section-header {
        display: flex;
        flex-flow: column nowrap;
        row-gap: 25px;
    }
    .p-header {
        display: flex;
        flex-flow: row nowrap;
        align-items: center;
        column-gap: 20px;
    }
    .p-body {
        width: 100%;
    }
    .profile-page-content .p-card {  
        width: 100%;  
        background-color: var(--bg-2);
        padding: 50px 60px;
        display: flex;
        flex-flow: column nowrap;
        row-gap: 25px;
        border-radius: 12px;
        box-shadow: var(--box-shadow-1);
    }
    .profile-page-content .input-row {
        display: flex;
        flex-flow: row nowrap;
        column-gap: 10%;
    }   
    .profile-page-content .input-col {
        display: flex;
        align-items: center;
    }
    .profile-page-content .input-col.input-col-1 {
        width: 35%;
    }
    .profile-page-content .input-col.input-col-2 {
        width: 55%;
    }
    .profile-page-content .input-col.input-col-3 {
        width: 100%;
        display: flex;
        flex-flow: column nowrap;
        row-gap: 10px;
        align-items: flex-start;
    }
    .selection-trigger {
        outline: none;
        border: var(--input-border-1);
        font-size: 16px;
        height: 45px;
        padding: 0 15px;
        background-color: var(--input-bg-1);
        width: 100%;
        letter-spacing: .3px;
        border-radius: 8px;
        line-height: 1;
        display: flex;
        flex-flow: row nowrap;
        justify-content: space-between;
        align-items: center;
        width: 100%;
        cursor: pointer;
        color: var(--color3);
    }
    .selection-trigger > div:nth-child(1) {
        
        color: #000;
        text-transform: capitalize;
    }
    .dropdown {
        width: 100%;
        border-left: var(--border-2);
        border-right: var(--border-2);
        border-top: var(--border-2);
        border-bottom: var(--border-2);
        top: 45px;
    }
    .input-col label {
        
    }
    .form-card-btns {
        display: flex;
        flex-flow: row nowrap;
        justify-content: space-between;
    }
    .form-card-btns div.formSubmit {
        margin: 0;
    }
    .pfp {
        display: flex;
        flex-flow: row nowrap;
        align-items: center;
        column-gap: 20px;
    }
    /* Profile pic */
    .pfp-placeholder {
        width: 180px;
        height: 180px;
        border-radius: 10px;
        overflow: hidden;
        position: relative;
    }
    .pfp-placeholder img {
        width: inherit;
        height: inherit;
        object-fit: cover;
        position: absolute;
    }
    #updateProfileBtn, #pwdBtn, #deactivateBtn, #deleteBtn {
        margin-top: 30px;
        margin-left: auto;
        color: var(--bg-2);
        height: 50px;
        display: flex;
        flex-flow: row nowrap;
        text-align: center;
        justify-content: center;
        align-items: center;
        /* color: #fff; */
        font-weight: 500;
        border: 1px solid rgb(213,211,210);
        border-radius: 8px;
        text-transform: capitalize;
        
        cursor: pointer;
    }
    #updateProfileBtn, #pwdBtn {
        background-color: #FFB600;
        font-size: 18px;
        width: 150px;
    }
    #deactivateBtn {
        background-color: rgb(21,21,21);
        margin-top: 10px;
        margin-left: 0px;
        font-size: 15px;
        width: 250px;
    }
    #deleteBtn {
        background-color: rgb(255,65,65);
        margin-top: 10px;
        margin-left: 0px;
        font-size: 15px;
        width: 250px;
    }
    /* Profile Section 2 */
    #profile-section-1 {
        padding: 60px 0;
    }
    #profile-section-2 {
        display: flex;
        flex-flow: column nowrap;
        width: 1100px;
    }
    .update-user-form-heading {
        font-size: 21px;
        
    }
    .update-user-form-subheading {
        font-size: 18px;
        color: rgb(106,106,106);
        
        line-height: 1.6;
    }
    .change-password,
    .deactivate-account,
    .delete-account {
        padding: 30px 0 80px 0;
        border-bottom: 1px solid rgb(213,211,210);
    }
    .deactivate-account,
    .delete-account {
        display: flex;
        flex-flow: column nowrap;
        row-gap: 20px;
    }
    form#change_pwd {
        display: flex;
        flex-flow: column nowrap;
    }
    .pwd-inner {
        display: flex;
        flex-flow: column nowrap;
        row-gap: 10px;
    }
    #pwd-row {
        display: flex;
        flex-flow: row nowrap;
        column-gap: 20px;
    }
    #pwd-error {
        /* height: 45px; */
        display: flex;
        align-items: center;
    }
    #pwd_inputs {
        display: flex;
        flex-flow: row nowrap;
        column-gap: 20px;
    }
    #pwd_inputs input[type=password] {
        width: 100%;
        background-color: #fff;
    }
    div.formSubmit {
        width: 160px;
        color: #0E0E0E;
        background-color: var(--bg-3);
        padding: 12px 0;
        text-align: center;
        font-size: 18px;
        border-radius: 8px;
        
        cursor: pointer;
        margin-left: auto;
    }
    div.formSubmit.formBack {
        background-color: #0E0E0E;
        color: var(--bg-3);
        border: 1px solid var(--bg-3);
        width: 140px;
    }
    .radio-group {
        display: flex;
        flex-flow: row nowrap;
        column-gap: 20px;
    }
    .radio-group p {
        display: flex;
        flex-flow: row nowrap;
        align-items: center;
        column-gap: 10px;
        margin-bottom: 0;
    }

    input[type='radio']:checked:after {
        width: 14px;
        height: 14px;
        left:1px;
        top:1px;
        border-radius: 14px;
        position: relative;
        background-color: #ffa500;
        content: '';
        display: inline-block;
        visibility: visible;
        border: 2px solid white;
    }
    .profile-page-content .showDropdown {
        top: 45px;
    }
    .profile-page-content .option {
        padding: 0 15px;
        height: 45px;
        font-size: 16px;
    }
    #pfpBtn {
        width: 140px;
        color: #fff;
        background-color: rgb(0,130,243);
        padding: 12px 0;
        text-align: center;
        font-size: 15px;
        border-radius: 8px;
        
        cursor: pointer;
        margin-left: auto;
        border: none;
        display: flex;
        flex-flow: row nowrap;
        align-items: center;
        justify-content: center;
        column-gap: 10px;
    }
    #pfpRemoveBtn {
        width: 140px;
        color: #fff;
        background-color: rgb(255,65,65);
        padding: 12px 0;
        text-align: center;
        font-size: 15px;
        border-radius: 8px;
        
        cursor: pointer;
        margin-left: auto;
        border: none;
        display: flex;
        flex-flow: row nowrap;
        align-items: center;
        justify-content: center;
        column-gap: 10px;
    }
    #pfpBtn i.fa-long-arrow-alt-up:before {
        font-size: 16px;
    }
    @media screen and (max-width: 1560px) { 
        .profile-page-header {
            width: 100%;
            padding: 30px;
        }
        .profile-tabs {
            height: 50px;
            width: 300px;
        }
        .pfp-placeholder {
            width: 160px;
            height: 160px;
        }
        .input-col label {
            font-size: 14px;
        }
        #profile-section-1.profile-section {
            width: 420px;
            padding: 30px 0 50px 0;
        }
        .profile-page-content .p-card {
            width: 100%;
            padding: 40px 40px;
            row-gap: 15px
        }
        .user_update_form {
            width: 100%;
            row-gap: 20px;
        }
        .selection-trigger {
            font-size: 14px;
            height: 38px;
            padding: 0 15px;
            width: 100%;
            letter-spacing: .3px;
            border-radius: 8px;
            width: 100%;
        }
        .dropdown {
            width: 100%;
            top: 38px;
        }
        .profile-page-content .showDropdown {
            top: 38px;
        }
        .profile-page-content .option {
            padding: 0 15px;
            min-height: 38px;
            font-size: 14px;
        }
        #pfpBtn {
            width: 120px;
            padding: 10px 0;
            font-size: 13px;
        }
        #updateProfileBtn, #pwdBtn {
            font-size: 15px;
            width: 130px;
            height: 45px;
        }
        .update-user-form-heading {
            font-size: 18px;
            
        }
        .update-user-form-subheading {
            font-size: 15px;
        }
        #deleteBtn {
            font-size: 14px;
            width: 220px;
        }
        input[type='radio']:checked:after {
            width: 10px;
            height: 10px;
            left: 1px;
            top: 1px;
            border-radius: 14px;
        }
    }
    @media screen and (max-width: 800px) {
        #profile-section-1.profile-section {
            width: 90%;
            margin: 0 auto;
        }
        #profile-section-2 {
            width: 85%;
            margin: 0 auto;
        }
        .profile-page-content .p-card {
            padding: 40px 30px;
        }
        #pwd-row {
            width: 100%;
        }
        .pwd-inner {
            width: 100%;
        }
        #pwd_inputs {
            display: flex;
            flex-flow: column nowrap;
            row-gap: 10px;
        }
    }



</style>
<style>
    .profile-tabs {
        height: 50px;
        width: 200px;
    }
</style>
<div class='profile-page-wrapper'>
    <!-- <div class='profile-page-header'>
        <div class='profile-tabs'>
            <div class='profile-tab' id='profile-tab-1' onclick='profileSection(this.id)'>
                My Profile
            </div>
            <div class='profile-tab' id='profile-tab-2' onclick='profileSection(this.id)'>
                Settings
            </div>
        </div>
    </div> -->
    <div class='profile-page-content'>  
        <?php 
        // include './template-parts/profile-section1.php'; 
        ?>
        <?php include './template-parts/profile-section2.php'; ?>
    </div>
</div>


<div id='loader'></div>


<div id="popBg" onclick="hidePopupBg();"></div>


<div id="deactivatePopup" class="popup hide_popup">
    <div id="popupInnerDiv">
        <div class="popup-text">
            <h5 class="popup-heading">Are you sure you want to deactivate your account? Click OK to continue or CANCEL to quit.</h5>
        </div>
        <div class="popup-btns-wrapper">
            <div class='cancel' onclick="closePopup();">Cancel</div>
            <input type="submit" class="submit" id="del_submit" name="deactivate_submit" onclick='submit_deactivation(event)' value="Ok">
        </div>
    </div>
</div>
<div id="delPopup" class="popup hide_popup">
    <div id="popupInnerDiv">
        <div class="popup-text">
            <h5 class="popup-heading">Are you sure you want to permanently delete your account? Click OK to continue or CANCEL to quit.</h5>
        </div>
        <div class="popup-btns-wrapper">
            <div class='cancel' onclick="closePopup();">Cancel</div>
            <input type="submit" class="submit" id="del_submit" name="del_submit" onclick='submit_deletion(event)' value="Ok">
        </div>
    </div>
</div>

<script src='./js/popup.js'></script>

<script>
        var old_img = document.getElementById('old_img');
    var pfpRemoveBtn = document.getElementById('pfpRemoveBtn');
    var pfpBtn = document.getElementById('pfpBtn');
    var noPhoto = document.getElementById('no-photo-avi');
    var noPhotoSrc = document.getElementById('no-photo-avi').src;
    var previewImg = document.getElementById('pfp-img-preview');
    var previewImgSrc = document.getElementById('pfp-img-preview').src;
    
    previewImg.style.display = 'none';
    if(noPhotoSrc.endsWith('avi.png')) {
        pfpRemoveBtn.style.display = 'none';
        pfpBtn.style.display = 'flex';
    } else {
        pfpRemoveBtn.style.display = 'flex';
        pfpBtn.style.display = 'none';
    }


    
    function submit_deactivation() {
        event.preventDefault();
        document.getElementById('deactivation_form').submit();
    }
    function submit_deletion() {
        event.preventDefault();
        document.getElementById('delete_form').submit();
    }
    function validatePwd(event) {
        var user_id = document.getElementById('pwd_user_id').value;
        var old_pwd = document.getElementById('old_pwd');
        var new_pwd = document.getElementById('new_pwd');
        var repeat_pwd = document.getElementById('repeat_pwd');
        var pwdError = document.getElementById('pwd-error');
        console.log(user_id, old_pwd.value);
        if(old_pwd.value) {
            $.ajax({
                url : "./controllers/user-handler", // Url of backend (can be python, php, etc..)
                type: "POST", // data type (can be get, post, put, delete)
                // headers: {  'Access-Control-Allow-Origin': 'http://localhost/samba_jiu_jitsu/' },
                data : "old_pwd="+old_pwd.value+"&pwd_user_id="+user_id+"&validate_pass=true", // data in json format
                async : false, // enable or disable async (optional, but suggested as false if you need to populate data afterwards)
                success: function(response, textStatus, jqXHR) {
                    $('#pwd-error').html(response);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR);
                    console.log(textStatus);
                    console.log(errorThrown);
                }
            });
        } 
        if(new_pwd.value && repeat_pwd.value) {
            if(new_pwd.value !== repeat_pwd.value) {
                pwdError.innerHTML = "<div class=error>Passwords dont match</div>";
            } else {
                pwdError.innerHTML = "";
                $.ajax({
                    url : "./controllers/user-handler", // Url of backend (can be python, php, etc..)
                    type: "POST", // data type (can be get, post, put, delete)
                    // headers: {  'Access-Control-Allow-Origin': 'http://localhost/samba_jiu_jitsu/' },
                    data : "old_pwd="+old_pwd.value+"&pwd_user_id="+user_id+"&validate_pass=true", // data in json format
                    async : false, // enable or disable async (optional, but suggested as false if you need to populate data afterwards)
                    success: function(response, textStatus, jqXHR) {
                        $('#pwd-error').html(response);
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log(jqXHR);
                        console.log(textStatus);
                        console.log(errorThrown);
                    }
                });
            }
        }
    } 
    function changePwd(event) {
        var user_id = document.getElementById('pwd_user_id').value;
        var old_pwd = document.getElementById('old_pwd');
        var new_pwd = document.getElementById('new_pwd');
        var repeat_pwd = document.getElementById('repeat_pwd');
        var pwdError = document.getElementById('pwd-error');

        if(pwdError.innerHTML == '') {
            if(old_pwd.value && new_pwd.value && repeat_pwd.value) {
                $.ajax({
                    url : "./controllers/user-handler", // Url of backend (can be python, php, etc..)
                    type: "POST", // data type (can be get, post, put, delete)
                    // headers: {  'Access-Control-Allow-Origin': 'http://localhost/samba_jiu_jitsu/' },
                    data : $('#change_pwd').serialize(), // data in json format
                    async : false, // enable or disable async (optional, but suggested as false if you need to populate data afterwards)
                    success: function(response, textStatus, jqXHR) {
                        window.location.href = './user-profile?i='+user_id;
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log(jqXHR);
                        console.log(textStatus);
                        console.log(errorThrown);
                    }
                });
            }
        }
    }

    document.getElementById('profile-tab-1').style.color = 'rgb(255,138,26)';
    document.getElementById('profile-section-1').style.display = 'flex';
    document.getElementById('profile-section-2').style.display = 'none';
    function profileSection(id) {
        document.getElementById(id).style.color = 'rgb(255,138,26)';
        idArr = id.split('-');
        var i = idArr['2'];
        if(i == 1) {
            document.getElementById('profile-tab-2').style.color = 'rgb(21,21,21)';
            document.getElementById('profile-section-1').style.display = 'flex';
            document.getElementById('profile-section-2').style.display = 'none';
        } else if (i == 2) {
            document.getElementById('profile-tab-1').style.color = 'rgb(21,21,21)';
            document.getElementById('profile-section-1').style.display = 'none';
            document.getElementById('profile-section-2').style.display = 'flex';
        }
    }
    var ageInput = document.getElementById('age');
    var casteInput = document.getElementById('caste');
    var occupationInput = document.getElementById('occupation');
    var descriptionInput = document.getElementById('description');

    if(typeof(ageInput) != 'undefined' && ageInput != null) {
        ageInput.addEventListener('change', function() {
            if(ageInput.value && (ageInput.value >= 18 && ageInput.value <= 80)) {
                ageInput.style.backgroundColor = 'rgb(249,249,249)';
                ageInput.style.border = '1px solid rgb(255,130,9)';
            } else {
                ageInput.style.border = '1px solid red';
                ageInput.style.backgroundColor = 'rgb(254,220,224)';
            }
        });
    }
    if(typeof(descriptionInput) != 'undefined' && descriptionInput != null) {
        descriptionInput.addEventListener('change', function() {
            // document.getElementById('descCount').innerHTML = descriptionInput.value.length + '/200';
            if(descriptionInput.value && descriptionInput.value.length <= 500) {
                descriptionInput.style.backgroundColor = 'rgb(249,249,249)';
                descriptionInput.style.border = '1px solid rgb(255,130,9)';
            } else {
                descriptionInput.style.border = '1px solid red';
                descriptionInput.style.backgroundColor = 'rgb(254,220,224)';
            }
        });
    }
    if(typeof(casteInput) != 'undefined' && casteInput != null) {
        casteInput.addEventListener('change', function() {
            if(casteInput.value && casteInput.value.match(/^(?![\s.]+$)[a-zA-Z\s.]*$/)) {
                casteInput.style.border = '1px solid rgb(255,130,9)';
                casteInput.style.backgroundColor = 'rgb(249,249,249)';
            } else {
                casteInput.style.border = '1px solid red';
                casteInput.style.backgroundColor = 'rgb(254,220,224)';
            }
        });
    }
    if(typeof(occupationInput) != 'undefined' && occupationInput != null) {
        occupationInput.addEventListener('change', function() {
            if(occupationInput.value && occupationInput.value.match(/^(?![\s.]+$)[a-zA-Z\s.]*$/)) {
                occupationInput.style.border = '1px solid rgb(255,130,9)';
                occupationInput.style.backgroundColor = 'rgb(249,249,249)';
            } else {
                occupationInput.style.border = '1px solid red';
                occupationInput.style.backgroundColor = 'rgb(254,220,224)';
            }
        });
    }
    function updateUserProfile() {

        if(
            ageInput.value && (ageInput.value >= 18 && ageInput.value <= 80) &&
            occupationInput.value && occupationInput.value.match(/^(?![\s.]+$)[a-zA-Z\s.]*$/) && 
            casteInput.value && casteInput.value.match(/^(?![\s.]+$)[a-zA-Z\s.]*$/) && 
            descriptionInput.value && descriptionInput.value.length <= 500
        ) {

            var user_id = document.getElementById('user_id').value;
            var loader = document.getElementById('loader');
            loader.classList.add('loader-animation');
            setTimeout(function(){ 
                var form = $('form')[0];
                var formData = new FormData(form);
                $.ajax({
                    url : './controllers/user-handler.php',
                    type: 'POST', 
                    data : formData,
                    async: false,
                    cache : false,
                    contentType: false,
                    processData: false,
                    success: function(response, textStatus, jqXHR) {
                        window.location.href = './user-profile?i='+user_id;
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log(jqXHR);
                        console.log(textStatus);
                        console.log(errorThrown);
                    }
                });
            }, 3000);
        } else {
            if(ageInput.value && (ageInput.value >= 18 && ageInput.value <= 80)) {
                ageInput.style.border = '1px solid rgb(255,130,9)';
                ageInput.style.backgroundColor = 'rgb(249,249,249)';
            } else {
                ageInput.style.border = '1px solid red';
                ageInput.style.backgroundColor = 'rgb(254,220,224)';
            }
            if(casteInput.value && casteInput.value.match(/^(?![\s.]+$)[a-zA-Z\s.]*$/)) {
                casteInput.style.border = '1px solid rgb(255,130,9)';
                casteInput.style.backgroundColor = 'rgb(249,249,249)';
            } else {
                casteInput.style.border = '1px solid red';
                casteInput.style.backgroundColor = 'rgb(254,220,224)';
            }
            if(occupationInput.value && occupationInput.value.match(/^(?![\s.]+$)[a-zA-Z\s.]*$/)) {
                occupationInput.style.border = '1px solid rgb(255,130,9)';
                occupationInput.style.backgroundColor = 'rgb(255,255,255)';
            } else {
                occupationInput.style.border = '1px solid red';
                occupationInput.style.backgroundColor = 'rgb(254,220,224)';
            }
            if(descriptionInput.value && descriptionInput.value.length <= 200) {
                descriptionInput.style.backgroundColor = 'rgb(249,249,249)';
                descriptionInput.style.border = '1px solid rgb(255,130,9)';
            } else {
                descriptionInput.style.border = '1px solid red';
                descriptionInput.style.backgroundColor = 'rgb(254,220,224)';
            }
            return;
        }
    }
    function hideProfileCards() {
        var pSecNodelist = document.querySelectorAll('.profile-section');   
        for (let i = 0; i < pSecNodelist.length; i++) {
            pSecNodelist[i].style.zIndex = -10;
            pSecNodelist[i].style.opacity = 0;
        }
    }
    document.getElementById('profile-section-1').style.zIndex = 1;
    document.getElementById('profile-section-1').style.opacity = 1;


    function fireButton(event) {
        event.preventDefault();
        document.getElementById('image').click();
    }
    function readPfpURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#pfp-img-preview').attr('src', e.target.result);
                noPhoto.style.display = 'none';
                previewImg.style.display = 'flex';
                pfpRemoveBtn.style.display = 'flex';
                pfpBtn.style.display = 'none';
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#image").change(function(){
        readPfpURL(this);
    });
    function removeImg(event) {
        event.preventDefault();
        $('#pfp-img-preview').attr('src', previewImgSrc);
        if(old_img.value) {
            old_img.value = '';
        }
        $('#no-photo-avi').attr('src', './assets/img/avi.png');
        pfpRemoveBtn.style.display = 'none';
        pfpBtn.style.display = 'flex';
        noPhoto.style.display = 'flex';
        previewImg.style.display = 'none';
        document.getElementById('image').value = null;

        // previewImg.style.display = 'none';
        // noPhoto.style.display = 'flex';
        // if(noPhotoSrc.endsWith('avi.png')) {
        //     pfpRemoveBtn.style.display = 'none';
        //     pfpBtn.style.display = 'flex';
        // } else {
        //     pfpRemoveBtn.style.display = 'flex';
        //     pfpBtn.style.display = 'none';
        // }
    }
    function radioVal(radioVal) {
        var genderInput = document.getElementById('gender');
        var femaleRadio = document.getElementById('gender-female');
        var maleRadio = document.getElementById('gender-male');

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
</script>



<?php include './partials/footer.php'; ?>