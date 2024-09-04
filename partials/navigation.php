<?php include './partials/functions.php'; ?>


<style>
    a.active-link {
        color: #000;
        text-decoration: underline;
    }
    #mobList > .list-item a.active-link {
        color: #000;
        text-decoration: underline;
    }
</style>


<?php
    $a = 1;
    $page = get_pagename();
    // var_dump($page);
    if($page == 'index') {
        $indexLinkClass = "active-link";
        $servicesLinkClass = "";
        $pricingLinkClass = "";
        $contactLinkClass = "";
        $bookmarksLinkClass = "";
    } else if($page == 'services') {
        $indexLinkClass = "";
        $servicesLinkClass = "active-link";
        $pricingLinkClass = "";
        $contactLinkClass = "";
        $bookmarksLinkClass = "";
    } else if($page == 'pricing') {
        $indexLinkClass = "";
        $servicesLinkClass = "";
        $pricingLinkClass = "active-link";
        $contactLinkClass = "";
        $bookmarksLinkClass = "";
    } else if($page == 'contact-us') {
        $indexLinkClass = "";
        $servicesLinkClass = "";
        $pricingLinkClass = "";
        $contactLinkClass = "active-link";
        $bookmarksLinkClass = "";
    } else if($page == 'bookmarks') {
        $indexLinkClass = "";
        $servicesLinkClass = "";
        $pricingLinkClass = "";
        $contactLinkClass = "";
        $bookmarksLinkClass = "active-link";
    } else {
        $indexLinkClass = "";
        $servicesLinkClass = "";
        $pricingLinkClass = "";
        $contactLinkClass = "";
        $bookmarksLinkClass = "";
    }
?>





<div id="bgOverlay">

</div>

<div class="nav-outer nav-outer-lrg">
    <div class="nav-inner">
        
        <div class="logo">                
            <div class='logo-text'>
                <a href="./">
                    <!-- Logo Here -->
                    <img src="./assets/img/logo/logo-2x.webp" alt="Rishtehaar">
                    <!-- <div class="m">Rishtehaar</div>
                    <div class="sub">find online rishta in pakistan</div> -->
                </a>
            </div>
        </div>
        <div class="navigation_wrapper">
            <nav class="navigation">
                <ul class="navigation_list">
                    <li class="list-item"><a href="./" class='<?= $indexLinkClass; ?>'>Home</a></li>
                    <?php
                        if(isset($_SESSION['user'])) {
                            $logged_in = $user->is_logged_in();
                            // if($logged_in == '1') {
                                echo "<li class='list-item'><a href='./pricing' class='$pricingLinkClass'>Pricing</a></li>";
                                echo "<li class='list-item'><a href='./bookmarks' class='$bookmarksLinkClass'>Saved</a></li>";
                            // }
                        }
                    ?>
                    <?php
                        if(!isset($_SESSION['user'])) {
                    
                            echo "
                            <li class='list-item'><a class='$servicesLinkClass' href='./services'>Services</a></li>
                            <li class='list-item'><a class='$pricingLinkClass' href='./pricing'>Pricing</a></li>
                            <li class='list-item'><a class='$contactLinkClass' href='./contact-us'>Contact Us</a></li>
                            ";
                            // <li class='list-item'><a href='./pricing'>Pricing</a></li>
                    
                        }
                    ?>
                    <?php
                        // if(isset($_SESSION['Logged']) && isset($_SESSION['user_status'])) {
                        //     echo "<li class='list-item'><a href='./controllers/signout-handler'>Sign Out</a></li>";
                        // } else {
                        //     echo "<li class='list-item'><a href='./signup'>Sign Up</a></li>";
                        // }
                    ?>
                </ul>
            </nav>
        </div>
        <?= $user->show_user_profile_nav(); ?>
    </div>
</div>



<div class="nav-outer nav-outer-mobile">
    <div class="nav-inner">
        <div class="logo">                
            <div class='logo-text'>
                <a href="./">
                    <!-- Logo Here -->
                    <img src="./assets/img/logo/logo.webp" alt="Rishtehaar">
                    <!-- <div class="m">Rishtehaar</div>
                    <div class="sub">find online rishta in pakistan</div> -->
                </a>
            </div>
        </div>
        <div class="navigation_wrapper"></div>
            <nav class="navigation">
                <?php
                    if(!isset($_SESSION['user'])) {
                ?>
                        <div class='signup-btn'>
                            <a id='nav-login' href='./login'>Log In</a>
                        </div>
                <?php
                    }
                ?>
                <ul id="mobList">
                    
                    <?= $user->show_user_profile_mob(); ?>
                    <li class="list-item"><a href="./" class='<?= $indexLinkClass; ?>'>Home</a></li>
                    <?php
                        if(isset($_SESSION['user'])) {
                            $logged_in = $user->is_logged_in();
                            // if($logged_in == '1') {
                                echo "<li class='list-item'><a href='./pricing' class='$pricingLinkClass'>Pricing</a></li>";
                                echo "<li class='list-item'><a href='./bookmarks' class='$bookmarksLinkClass'>Saved</a></li>";
                            // }
                        }
                    ?>
                    <?php
                        if(!isset($_SESSION['user'])) {
                    
                            echo "
                            <li class='list-item'><a class='$servicesLinkClass' href='./services'>Services</a></li>
                            <li class='list-item'><a class='$pricingLinkClass' href='./pricing'>Pricing</a></li>
                            <li class='list-item'><a class='$contactLinkClass' href='./contact-us'>Contact Us</a></li>
                            ";
                            // <li class='list-item'><a href='./pricing'>Pricing</a></li>
                    
                        }
                        
                    ?>
                </ul>
            </nav>
            <div id="navBtn">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>



    </div>
</div>
