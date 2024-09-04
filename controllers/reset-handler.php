<?php
    include '../Classes/Db.php';
    include '../Classes/User.php';

    if(isset($_POST['email'])) {
        $user = new User();
        $user->reset();
    }
?>