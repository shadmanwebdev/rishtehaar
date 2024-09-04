<?php 
    if(!isset($_SESSION)) { 
        ob_start();
        session_start(); 
        
    }


    error_reporting(E_ALL);
    ini_set("display_errors","On");

    include '../../partials/functions.php';
    include '../../Classes/Db.php';
    include '../../Classes/User.php';
    include '../../Classes/PayfastPayment.php';


    if(isset($_GET['payerid']) && isset($_GET['pid'])) {
        $pp = new PayfastPayment;
        $pp->manual_payment_update($_GET['payerid'], $_GET['pid']);
    }

?>
