<?php include './header.php'; ?>
 

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

<style>


    .settings-wrapper {
        display: flex;
        flex-direction: column;
        padding: 100px 0;
        max-width: 700px;
    }
    .settings-wrapper .title {
        
        font-size: 28px;
        font-weight: 600;
        line-height: 18px;
        letter-spacing: 0em;
        text-align: left;
        color: #000;
        margin-bottom: 30px;
    }
    .settings-input-group {
        max-width: 500px;
        border-radius: 8.758585929870605px;

        box-shadow: 0px 2.021212100982666px 4.716161727905273px 0px #00000029;
        display: flex;
        align-items: center;
        padding: 13px 20px;
        background: #fff;
    }
    .setting-option .text-wrapper {
        margin: 20px 0;
    }
    .setting-option p {
        
        font-size: 18px;
        font-weight: 500;
        line-height: 2;
        letter-spacing: 0em;
        text-align: left;
    }
    .setting-option .settings-input-inner {
        margin-right: 10px;
    }
    .update-settings-btn {
        width: 175px;
        /* height: 50px; */
        border-radius: 9px;
        color: #0E0E0E;
        background: #FFB600;
        padding: 10px 20px;
        text-align: center;
        cursor: pointer;
    }
    @media screen and (max-width: 1280px) {
        .admin-content {
            padding-left: 0;
        }
    }
</style>

<style>
    /* Style for the radio inputs */
    input[type="radio"] {
        display: none; /* Hide the default radio input */
    }

    /* Style for the radio label */
    .radio-label {
        display: inline-block;
        width: 20px;
        height: 20px;
        padding: 2px; /* Adjust the padding to add spacing */
        border: 2px solid #FFB600;
        color: #FFB600;
        cursor: pointer;
        border-radius: 50%;
        position: relative;
    }

    /* Style for the selected radio label */
    .radio-label.selected {
        background-color: white;
        color: white;
    }
    /* Style for the inner circle of the selected radio label */
    .radio-label.selected::before {
        content: "";
        display: block;
        width: 10px;
        height: 10px;
        background-color: #FFB600;
        border-radius: 50%;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
</style>

<?php
    $settings = new Settings;
    $setting = $settings->get_setting();
    
    $free = ($setting == 'free') ? 'selected' : '';
    $free2 = ($setting == 'free') ? 'checked' : '';
    $paid = ($setting == 'paid') ? 'selected' : '';
    $paid2 = ($setting == 'paid') ? 'checked' : '';
    
?>


<div class="admin_page-wrapper">
    <?php include './admin-sidebar.php'; ?>
    <div>



        <div class="admin-content">

            <div class="settings-wrapper">
                

                <div class="title">Choose a Setting</div>

                <div class="setting-option">
                    <div class='settings-input-group'>
                        <div class='settings-input-inner'>
                            <input name="settings" id="free" type="radio" value="free" <?= $free2; ?> >
                            <label class="radio-label <?= $free; ?>" for="free" onclick="handleRadioSelection(this)" for="free"></label>
                        </div>
                        <div>FREE</div>
                    </div>
                    <div class='text-wrapper'>
                        <p>User Comes on site > Sign ups (Fills the registration form) > Email Confirmation > Waits for Approval from Admin (Under Verification). > Verified (when admin approves)</p>
                    </div>
                </div>

                <div class="setting-option">
                    <div class='settings-input-group'>
                        <div class='settings-input-inner'>
                            <input name="settings" id="paid" type="radio" value="paid" <?= $paid2; ?>>
                            <label class="radio-label <?= $paid; ?>" for="paid" onclick="handleRadioSelection(this)" for="paid"></label>
                        </div>
                        <div>PAID</div>
                    </div>
                    <div class='text-wrapper'>
                        <p>All Flow will be Same except this > After User’s Email Confirmation > Next Step will be > Payment Method will come  > After successful payment user will be automatically verified</p>
                    </div>
                </div>

                <div class="update-settings-btn" onclick="update_settings(event);">
                    Apply Changes
                </div>
                <div style='margin-top: 20px;' id="msg-response"></div>
            </div>
        </div>

    </div>

</div>






<script defer>
    function handleRadioSelection(label) {
        const radioInput = label.previousElementSibling;
        const allLabels = document.querySelectorAll('.radio-label');

        // Unselect all labels
        allLabels.forEach((label) => {
            label.classList.remove('selected');
            label.previousElementSibling.checked = false;
        });

        // Select the clicked label
        label.classList.add('selected');

        // Update the radio input's checked property
        radioInput.checked = true;
    }
    function update_settings() {
        event.preventDefault();

        var formData = new FormData();
        const selectedValue = document.querySelector('input[name="settings"]:checked').value;

        formData.append('settings', selectedValue);

        fetch('./controllers/settings-handler.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(response => {
            var alert = document.getElementById('msg-response');

            if ($.trim(response) == '1') {
                window.location.href = './settings';
                // alert.innerHTML = "<div class='success'>Settings updated successfully</div>";
            } else {
                console.log(response);
                alert.innerHTML = "<div class='error'>Failed to update settings</div>";
            }
        })
        .catch(err => console.log(err));
    }
        

</script>


<?php include './footer.php'; ?>