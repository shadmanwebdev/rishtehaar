<?php
    if(!isset($_SESSION)) { 
        ob_start();
        session_start();
    }

    error_reporting(E_ALL);
    ini_set("display_errors","On");

    $server = $_SERVER['SERVER_NAME'];
    $uriArray = explode('/', $_SERVER['REQUEST_URI']);
    $pagename = basename($_SERVER["SCRIPT_FILENAME"], '.php');
    

    
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

    include $path.'Classes/Db.php';
    include $path.'Classes/User.php';
    include $path.'Classes/PayfastPayment.php';
    include $path.'Classes/Bookmark.php';
    include $path.'Classes/Package.php';
    include $path.'Classes/Blog.php';
    include $path.'Classes/Pricing.php'; 
    

    // Titles and Meta Descriptions
    switch ($pagename) {
        case 'index':
            $title = 'Rishtehaar.com | Find online Rishta in Pakistan and Abroad'; 
            $meta_tags = '<meta name="description" content="Rishtehaar.com is a Popular Matrimonial Platform to Find Marriage Proposals in Pakistan and abroad.">'; 
            break;
        case 'pricing':
            $title = 'Membership Pricing'; 
            $meta_tags = '<meta name="description" content="Explore Rishtehaar.com\'s membership plan for just 1000 PKR/year. Enjoy full access, unlimited contacts, and customer support with no hidden fees. Terms and conditions apply.">'; 
            break;
        case 'services':
            $title = 'Rishtehaar Matrimonial Services'; 
            $meta_tags = '<meta name="description" content="Discover genuine marriage proposals on Rishtehaar.com. We offer secure, affordable matchmaking with advanced filtering, ensuring a safe and authentic search for your life partner.">';
            break;
        case 'contact-us':
            $title = 'Contact Team Rishtehaar'; 
            $meta_tags = '<meta name="description" content="Get in touch for any inquiries. Reach us via email, phone, or visit us in Islamabad. We\'re here to assist with your matrimonial needs">'; 
            break;
        case 'blog': 
            $title = 'Marriage & Relationship Blogs'; 
            $meta_tags = '<meta name="description" content="Explore articles on love, relationships, marriage, and cultural insights. Get valuable tips and advice for finding a life partner and building a strong married life.">'; 
            break;
        case 'single-post':    
            $blog = new Blog;
            $single_post = $blog->get_single_post($_GET['slug']);

            $title = $single_post['title'];
            $description = $single_post['post_description'];

            $meta_tags = "<meta name='description' content=\"{$description}\">"; 
            break;
        case 'registration':
            $title = 'Create an Account'; 
            $meta_tags = '<meta name="description" content="Create your profile on Rishtehaar.com to start your journey towards finding a life partner. Join our secure platform today and connect with genuine matrimonial prospects.">'; 
            break;
        case 'login':
            $title = 'Login to Your Account'; 
            $meta_tags = '<meta name="description" content="Log in to your Rishtehaar.com account to connect with genuine marriage prospects. Access your profile and continue your search for a life partner today.">'; 
            break;
        case 'terms-of-service':
            $title = 'Terms of Service'; 
            $meta_tags = '<meta name="description" content="Terms of Service to understand the rules, rights, and responsibilities for using our matrimonial platform. Ensure you meet eligibility criteria before registering.">'; 
            break;
        case 'privacy-policy':
            $title = 'Privacy Policy'; 
            $meta_tags = '<meta name="description" content="Review Privacy Policy to understand how we protect your personal information and data. Learn about our practices for ensuring your privacy and security on our platform.">'; 
            break;
        case 'disclaimer':
            $title = 'Disclaimer'; 
            $meta_tags = '<meta name="description" content="Disclaimer to understand the limitations of our services and the accuracy of information provided. Ensure you are aware of our responsibilities and your own before using the platform.">'; 
            break;
        case 'reset':
            $title = 'Reset Your Password'; 
            $meta_tags = '<meta name="description" content="Reset your Rishtehaar Account password easily to regain access. Follow our simple steps to create a new password and continue your search for a life partner.">'; 
            break;
        default:
            $title = 'Rishtehaar.com | Find online Rishta in Pakistan and Abroad'; 
            $meta_tags = '<meta name="description" content="Rishtehaar.com is a Popular Matrimonial Platform to Find Marriage Proposals in Pakistan and abroad.">'; 
            break;
    }
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
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&family=Roboto:ital@0;1&display=swap" rel="stylesheet">

    <link rel="icon" href="<?= $path; ?>assets/img/favicon.webp?v=2" type="image/icon type">
    <!-- JQUERY -->
    <script
    src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
    crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    
    <!-- STYLE -->
    <link rel="stylesheet" href="<?= $path; ?>css/ionicons.min.css">
    
    <link rel="stylesheet" href="<?= $path; ?>font/icomoon/style.css?v=100">
    <link rel="stylesheet" href="<?= $path; ?>css/style.css?v=30">
    <!-- JS -->
    <script src="https://kit.fontawesome.com/bf13f55ede.js" crossorigin="anonymous"></script>
    <script src="<?= $path; ?>js/main.js?v=80" defer></script>
    <script src="<?= $path; ?>js/filters.js?v=80" defer></script>
    <script src="<?= $path; ?>js/admin.js?v=80" defer></script>
    <script src="<?= $path; ?>js/popup.js?v=80" defer></script>

    <?php
        $files = array("index", "blog", "login", "contact-us", "registration");
        $pagename = basename($_SERVER["SCRIPT_FILENAME"], '.php');
        if (in_array($pagename, $files)) {
    ?>

        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-8HK3TCNCVX"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', 'G-8HK3TCNCVX');
        </script>

    <?php
        }
    ?>
    
</head>
<body>

<!-- Admin Check -->
<?php
    $user = new User();
    $user->check_user_cookie();
    $user->check_user_session();

    if(isset($_SESSION['user'])) {
        $uid = $user->get_uid();
        $account_status = $user->get_account_status();
        if($account_status != 'approved') {
            $cur_account_status = $user->current_account_status($uid);
            if($cur_account_status == 'approved') {
                $user->update_session($cur_account_status);
            }
        }
    }
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