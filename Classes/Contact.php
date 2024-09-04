<?php
class Contact extends User {
    public function send_message() {
        if($_SERVER['SERVER_NAME'] != 'localhost') {
            $subject = 'Rishtehaar Email';
            $msgBody = $_POST['message'];
            $this->sendEmailSwiftMailer($_POST['email'], $subject, $msgBody);
            echo '1';
        } else {
            echo '1';
        }
    }
}