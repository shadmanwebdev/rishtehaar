<?php include '../partials/header.php'; ?>
 

<style>
    /* Search */
    .searchWrapper {
        width: 900px;
        display: flex;
        justify-content: center;
        margin-bottom: 10px;
    }
    .searchWrapper form .form-group {
        width: 300px;
        display: flex;
        flex-flow: row nowrap;
        column-gap: 5px;
        position: relative;
    }
    input[type=text].search-content {
        border-radius: 25px;
        padding: 8px 50px 10px 20px;
        border: 1px solid #c0c0c0;
    }
    .searchWrapper form .form-group button[type=submit] {
        position: absolute;
        right: 0;
        top: 0;
        padding: 8px 10px;
        border: none;
        border-left: 1px solid #c0c0c0;
        border-radius: 50%;
        background-color: transparent;
        /* background-color: #107895; */
    }
    .searchWrapper form .form-group button[type=submit]:before {   
        color: #c0c0c0;
        font-family: 'Genericons';
        content: '\f400';
        font-size: 20px;
    }
    @media screen and (max-width: 800px) {
        .searchWrapper form .form-group {
            width: 300px;
        }
    }
    @media screen and (max-width: 414px) {
        .searchWrapper form .form-group {
            width: 350px;
        }
    }
</style>

<div class="admin_page-wrapper">
    <?php include './admin-sidebar.php'; ?>
    <div class="admin-content">
        <!-- <div class='admin-page-heading'>
            <h1>Messages</h1>
        </div> -->
        <?php
            include '../Classes/Db.php';
            include '../Classes/User.php';
            if(isset($_POST['submit'])) {
                $user = new User();
                echo $user->showSearchUsers($_POST['search-content']);
            }
        ?>
    </div>
</div>




<?php include './footer.php'; ?>