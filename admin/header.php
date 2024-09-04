<?php
    if(!isset($_SESSION)) { 
        ob_start();
        session_start(); 
    }

    error_reporting(E_ALL);
    ini_set("display_errors","On");
    // $type = gettype(extension_loaded('mysqli'));
    // var_dump($type);

    $server = $_SERVER['SERVER_NAME']; // localhost
    $uriArray = explode('/', $_SERVER['REQUEST_URI']);

    $pagename = basename($_SERVER["SCRIPT_FILENAME"], '.php');

    
    // TITLE & DESCRIPTION
    $title = 'Rishtehaar.com | Find online Rishta in Pakistan and Abroad'; 
    $meta_tags = '<meta name="description" content="Rishtehaar.com is a Popular Matrimonial Platform to Find Marriage Proposals in Pakistan and abroad.">'; 
    
    
    if($server === 'localhost') {
        $folder = $uriArray[2]; // Folder name
        if($folder === "admin") {
            $path = '../';
            $scriptArray = explode('/', $_SERVER['SCRIPT_NAME']);
            $scriptFull = explode('.', $scriptArray[3]);
            $scriptName = $scriptFull[0];  
            $scriptType = $scriptFull[1]; 
        } else {
            $path = './';
            $scriptArray = explode('/', $_SERVER['SCRIPT_NAME']);
            $scriptFull = explode('.', $scriptArray[2]);
            $scriptName = $scriptFull[0];  
            $scriptType = $scriptFull[1]; 
        }
    } else {
        $folder = $uriArray[1];
        if($folder === "admin") {
            $path = '../';
            $scriptArray = explode('/', $_SERVER['SCRIPT_NAME']);
            $scriptFull = explode('.', $scriptArray[2]);  
            $scriptName = $scriptFull[0];  
            $scriptType = $scriptFull[1]; 
        } else {
            $path = './';
            $scriptArray = explode('/', $_SERVER['SCRIPT_NAME']);
            $scriptFull = explode('.', $scriptArray[1]);
            $scriptName = $scriptFull[0];
            $scriptType = $scriptFull[1];
        }
    }

    include $path.'partials/functions.php';
    include $path.'Classes/Db.php';
    include $path.'Classes/User.php';
    include $path.'Classes/Package.php';
    include $path.'Classes/Payment.php';
    include $path.'Classes/Settings.php';
    include $path.'Classes/Blog.php';
    include $path.'Classes/Pricing.php';
    include $path.'Classes/PayfastPayment.php';
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-EQ3RN3HECV"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-EQ3RN3HECV');
    </script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= $meta_tags ?>
    <title><?= $title ?></title>

    <link rel="icon" href="<?= $path; ?>assets/img/favicon.webp?v=2" type="image/icon type">
    <!-- JQUERY -->
    <script
    src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
    crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/bf13f55ede.js" crossorigin="anonymous"></script>

    <!-- STYLE -->
    <link rel="stylesheet" href="../css/ionicons.min.css">
    <link rel="stylesheet" href="../css/__base.css?v=63">
    <link rel="stylesheet" href="../css/style.css?v=101">
    <link rel="stylesheet" href="./proposal.css?v=63">
    <link rel="stylesheet" href="../css/selectors.css?v=63">
    <link rel="stylesheet" href="../css/filters.css?v=63">
    <link rel="stylesheet" href="./style.css?v=64">
    <link rel="stylesheet" href="../css/popup.css?v=63">
    <link rel="stylesheet" href="./css/form-response.css?v=63">
    <!-- JS -->
    <script src="../js/main.js?v=38" defer></script>
    <script src="../js/filters.js?v=38" defer></script>
    <script src="../js/admin.js?v=38" defer></script>
    <script src="../js/popup.js?v=38" defer></script>
    <script src="./validate.js?v=38" defer></script>
    
    <style>
        .logo {
            padding: 5px 0;
            width: 200px;
        }
        @media screen and (max-width: 800px) {
            .logo {
                width: 150px;
            }
        }
    </style>
</head>
<body>


<div id='bgOverlay'></div>
<div id='popBg' onclick='closePopup()'></div>

<!-- Admin Check -->
<?php
    $user = new User();
    $user->check_user_cookie();
    $user->check_user_session();
?>

<style>
    /* Loader */
    #loader {
        border: 5px solid rgb(179, 179, 179);
        border-radius: 50%;
        border-top: 5px solid rgb(195,139,0);
        border-left: 5px solid rgb(195,139,0);
        width: 50px;
        height: 50px;
        position: fixed;
        top: 50%;
        left: 50%;
        margin-top: -25px;
        margin-left: -25px;
        display: none;
        z-index: 1000;
    }
    .loader-animation {
        display: block !important;
        -webkit-animation: spin 2s linear infinite; /* Safari */
        animation: spin 2s linear infinite;
    }
    @media screen and (max-width: 1560px) {
        #loader {
            border: 5px solid rgb(179, 179, 179);
            border-radius: 50%;
            border-top: 5px solid rgb(195,139,0);
            border-left: 5px solid rgb(195,139,0);
            width: 50px;
            height: 50px;
            position: fixed;
            top: 50%;
            left: 50%;
            margin-top: -25px;
            margin-left: -25px;
            display: none;
            z-index: 1000;
        } 
    }
    /* Safari */
    @-webkit-keyframes spin {
        0% { -webkit-transform: rotate(0deg); }
        100% { -webkit-transform: rotate(720deg); }
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(720deg); }
    }
</style>

<div id='loader'></div>