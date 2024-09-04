<?php 
    if(!isset($_SESSION)) { 
        ob_start();
        session_start(); 
        
    }


    error_reporting(E_ALL);
    ini_set("display_errors","On");

    include './partials/functions.php';
    include './Classes/Db.php';
    include './Classes/User.php';
    include './Classes/PayfastPayment.php';


?>






<?php
    // var_dump($_SESSION['user']);
    $email = get_user_email();
    $phone = get_whatsapp();

    $pp = new PayfastPayment;
    $pp->payment_form($email, $phone);
?>



<script defer>

    var form = document.getElementById('my-payment-form');
    console.log(form);
    form.submit();

</script>


