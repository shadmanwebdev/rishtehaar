<?php
    session_start();
    include '../partials/functions.php';
    include '../Classes/Db.php';
    include '../Classes/User.php';
    
    $user = new User();
    if(isset($_POST['relationship']) && isset($_POST['email']) && isset($_POST['whatsapp'])) {
        // var_dump($_POST);
        $user->create();
    }
    if(isset($_POST['verify_email'])) {
        $user->verify_email();
    }

    // Check if the "resend_code" form has been submitted
    if (isset($_POST['resend_code'])) {
        if($_POST['remaining'] <= 1) {
            // Your logic to handle the form submission here
            // Execute the resend_code() function to delete previous code and create a new code
            $user->resend_code();
            exit;
        } else {
            echo '2';
        }
    }
    
    // // Check if the timer session variable is set
    // if (isset($_SESSION['timer_start'])) {
    //     $timerStart = $_SESSION['timer_start'];
    //     $currentTime = time();
    //     $remainingSeconds = 60 - ($currentTime - $timerStart);
        
    //     // Check if the timer has expired
    //     if ($remainingSeconds <= 0) {
    //         unset($_SESSION['timer_start']);
    //         $user->resend_code();
    //         exit;
    //     }
    // }


?>