<?php
    include '../../Classes/Db.php';
    include '../../Classes/User.php';
    
    $user = new User();
    
    if(isset($_POST['update_user_status'])) {
        $user->update_status($_POST['status'], $_POST['id']);
    }
    if(isset($_POST['validate_pass'])) {
        $user->check_pwd($_POST['old_pwd'], $_POST['pwd_user_id']);
    }
    if(isset($_POST['new_pwd'])) {
        $user->change_password($_POST['new_pwd'], $_POST['pwd_user_id']);
    }
    if(isset($_POST['delete_user_img'])) {
        $user->del_photo($_POST['photo'], $_POST['user_id']);
    }
?>