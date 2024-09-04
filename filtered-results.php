<?php
    include './partials/functions.php';
    include './Classes/Db.php';
    include './Classes/User.php';
    $user = new User();

    if(isset($_POST['filter'])) {
        echo $user->showFilteredProposals($_POST['gender'], $_POST['marital_status'], $_POST['age'], $_POST['education'],  $_POST['city'], $_POST['occupation']);
    }
?>