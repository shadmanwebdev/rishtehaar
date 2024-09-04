
<?php
    $a = 1;
    $page = get_pagename();
    // var_dump($page);
    if($page == 'users') {
        $usersLinkClass = "active-link";
        $settingsLinkClass = "";
        $pricingLinkClass = "";
        $blogLinkClass = "";
    } else if($page == 'settings') {
        $usersLinkClass = "";
        $settingsLinkClass = "active-link";
        $pricingLinkClass = "";
        $blogLinkClass = "";
    } else if($page == 'pricing') {
        $usersLinkClass = "";
        $settingsLinkClass = "";
        $pricingLinkClass = "active-link";
        $blogLinkClass = "";
    } else if($page == 'blog') {
        $usersLinkClass = "";
        $settingsLinkClass = "";
        $pricingLinkClass = "";
        $blogLinkClass = "active-link";
    } else {
        $usersLinkClass = "";
        $settingsClass = "";
        $pricingLinkClass = "";
        $blogLinkClass = "";
    }
?>


<style>
    .item-group.active-link {
        color: #000;
        border: 1px solid #FFB600;
        background-color: #FFB600;
    }
</style>


<div class="side" id="mobList">
    <div class='item-section-title'>
        All Users
    </div>
    <div class="item-group <?= $usersLinkClass; ?>">
        <a href="./users">
            <li id='item-group-users'>Users</li>
        </a>
    </div>
    <div class="item-group <?= $settingsLinkClass; ?>">
        <a href="./settings">
            <li id='item-group-settings'>Settings</li>
        </a>
    </div>
    <div class="item-group <?= $pricingLinkClass; ?>">
        <a href="./pricing">
            <li id='item-group-pricing'>Pricing</li>
        </a>
    </div>
    <div class="item-group <?= $blogLinkClass; ?>">
        <a href="./blog">
            <li id='item-group-blog'>Blog</li>
        </a>
    </div>
    
</div>