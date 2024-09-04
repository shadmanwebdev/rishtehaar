<?php
    include '../partials/functions.php';
    include '../Classes/Db.php';
    include '../Classes/User.php';
    include '../Classes/Contact.php';

    if(isset($_POST['send_message'])) {
        $contact = new Contact();
        $contact->send_message();
    }

?>