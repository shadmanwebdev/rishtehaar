<?php
    include '../Classes/Db.php';
    include '../Classes/User.php';

    if(isset($_POST['email']) && isset($_POST['password'])) {
        $user = new User();
        $user->login();
    }

?>