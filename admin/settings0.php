<?php include '../partials/header.php'; ?>
 

<style>
    .update-user-form-heading {
        font-size: 21px;
        
    }
    .change-password {
        padding: 80px 20px 80px 20px;
    }
    form#change_pwd {
        display: flex;
        flex-flow: column nowrap;
    }

    #pwd-row {
        display: flex;
        flex-flow: row nowrap;
        align-items: center;
        column-gap: 20px;
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
    .pwd-inner {
        display: flex;
        flex-flow: column nowrap;
        row-gap: 10px;
    }
    #updateProfileBtn, #pwdBtn, #deactivateBtn, #deleteBtn {
        margin-top: 30px;
        margin-left: auto;
        color: var(--bg-2);
        height: 45px;
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
        font-size: 16px;
        width: 130px;
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

<div id="loader"></div>

<?php 
    $userdata = json_decode($_SESSION['user'], true);
    $id = $userdata['uid'];
?>

<div class="admin_page-wrapper">
    <?php include './admin-sidebar.php'; ?>
    <div class="admin-content">
        <div class='admin-page'>
            <div class='admin-page-header'>
                <div>Admin Settings</div>
                <div>Change Admin Panel Settings</div>
            </div>
            <div class='admin-page-content'>
                <div class='admin-page-content-title'>
                    Change Admin Password
                </div>
                <div class='change-password'>
                    <form id='change_pwd' method='post'>
                        <input type='hidden' name='pwd_user_id' id='pwd_user_id' value='<?= $id; ?>'>
                        <div class='update-user-form-heading'>
                            Change Password
                        </div>
                        <div id='pwd-row'>
                            <div class='pwd-inner'>
                                <div id='pwd_inputs'>
                                    <input onchange='validatePwd(event)' type='password' name='old_pwd' id='old_pwd' value='' placeholder='Old Password'>
                                    <input onchange='validatePwd(event)' type='password' name='new_pwd' id='new_pwd' value='' placeholder='New Password'>
                                    <input onchange='validatePwd(event)' type='password' name='repeat_pwd' id='repeat_pwd' value='' placeholder='Confirm Password'>
                                </div>
                                <div id='pwd-error'>

                                </div>
                                <div style='margin-top: 0;' id='pwdBtn' onclick='changePwd(event);'>Update</div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    function validatePwd(event) {
        var user_id = document.getElementById('pwd_user_id').value;
        var old_pwd = document.getElementById('old_pwd');
        var new_pwd = document.getElementById('new_pwd');
        var repeat_pwd = document.getElementById('repeat_pwd');
        var pwdError = document.getElementById('pwd-error');
        
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
                var loader = document.getElementById('loader');
                loader.classList.add('loader-animation');
                setTimeout(function(){ 
                    $.ajax({
                        url : "./controllers/user-handler", // Url of backend (can be python, php, etc..)
                        type: "POST", // data type (can be get, post, put, delete)
                        // headers: {  'Access-Control-Allow-Origin': 'http://localhost/samba_jiu_jitsu/' },
                        data : $('#change_pwd').serialize(), // data in json format
                        async : false, // enable or disable async (optional, but suggested as false if you need to populate data afterwards)
                        success: function(response, textStatus, jqXHR) {
                            window.location.href = './settings';
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            console.log(jqXHR);
                            console.log(textStatus);
                            console.log(errorThrown);
                        }
                    });
                }, 2000);
            }
        }
    }
</script>



<?php include './footer.php'; ?>