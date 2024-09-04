<?php
    include '../Classes/Db.php';
    include '../Classes/User.php';


    $user = new User();
    $user->get_edit_form($_POST['id']);
?>



