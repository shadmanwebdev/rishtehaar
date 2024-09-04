<?php
    include '../partials/functions.php';
    include '../Classes/Db.php';
    include '../Classes/User.php';

    if(isset($_POST['bookmark'])) {
        $user = new User();
        $user->bookmark();
    }
    if(isset($_POST['update_user'])) {
        $user = new User();
        $user->update();
    }
    if(isset($_POST['update_password'])) {
        $user = new User();
        $user->update_password();
    }
    // if(isset($_POST['reset_pwd_submit'])) {
    //     $user = new User();
    //     $user->create_new_password();
    // }
    if(isset($_POST['check_duplicate'])) {
        $user = new User();
        $user->check_duplicate_user($_POST['email']);
    }
    if(isset($_POST['update_user_profile'])) {
        $user = new User();
        $user->updateUserById($_POST['user_id']);
    }
    // if(isset($_POST['deactivation_user_id'])) {
    //     $user = new User();
    //     $user->deactivate_account($_POST['deactivation_user_id']);
    // }
    if(isset($_POST['delete_user_id'])) {
        $user = new User();
        $user->delete_account($_POST['delete_user_id']);
    } 
    if(isset($_POST['validate_pass'])) {
        $user = new User();
        $user->check_pwd($_POST['old_pwd'], $_POST['pwd_user_id']);
    }
    if(isset($_POST['new_pwd'], $_POST['pwd_user_id'])) {
        $user = new User();
        $user->change_password($_POST['new_pwd'], $_POST['pwd_user_id']);
    }
    if(isset($_POST['pay_method'], $_POST['package'], $_POST['user_id'])) {
        $user = new User();
        $user->update_user_payment();
    }
    if(isset($_POST['forgot_password'])) {
        $user = new User();
        // Check if email exists
        $check_email = $user->email_exists($_POST['email']);
        if($check_email == '1') {
            // Create URL
            $url = $user->generatePwdLink($_POST['email']);
            // Send email if we're in live mode
            if($_SERVER['SERVER_NAME'] != 'localhost') {
                $subject = 'Password Reset Email';
                $msgBody = "<p style='font-size: 15px; margin-bottom: 20px;'>Password Reset</p>";
                $msgBody .= "<p style='font-size: 15px; margin-bottom: 20px;'>To Reset your Password, Just press the button below and follow the instructions.</p>";
                $msgBody .= "<a style='text-align: center; display: flex; max-width: 160px; text-align: center; text-decoration: none; padding: 13px 20px; margin: 20px 0; background-color: rgb(119,119,119); border:1px solid rgb(119,119,119); color:#fff; border-radius:4px; font-size:14px;' href='$url'>
                    <span style='margin: 0 auto;' href='$url'>Reset Password</span>
                </a>";
                $msgBody .= "<p style='font-size: 15px; margin-bottom: 20px;'>OR</p>";
                $msgBody .= "<p style='font-size: 15px; margin-bottom: 5px;'>Copy and paste this link in your browser:</p>";
                $msgBody .= "<a style='font-size: 15px; margin-bottom: 5px;' href='$url'>$url</a>";
                $msgBody .= "<p style='color: gray; font-size: 15px; margin-bottom: 10px;'>(Remove this line of link, if not necessary, just use button above)</p>";
                $msgBody .= "<p style='font-size: 15px;'>Thanks</p>";
                $user->sendEmailSwiftMailer($_POST['email'], $subject, $msgBody);
                echo '1';
            } else {
                echo '1';
            }
        } else {
            echo '0';
        }
    }
?>