<?php include '../partials/header.php'; ?>
 

<div id="loader"></div>


<div class="admin_page-wrapper">
    <?php include './admin-sidebar.php'; ?>
    <div class="admin-content">
        <div class='users-top-section'>
            <div id='show-user-count'>

            </div>
            <!-- Search -->
            <div class='searchWrapper'>
                <form action='./search-users?page=1' method='get'>
                    <input type="hidden" name='status' value='approved'>
                    <input type="hidden" name='page' value='1'>
                    <div class='search'>
                        <div class='form-group'>
                            <input name='s' id='search-content' class='search-content' type='text' placeholder='Search by Name, Email or WhatsApp #'>
                            <button name='submit' class='search-btn' id='search-btn' type='submit' value='1'><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <?php  
            if(isset($_GET['status'])) {
                if($_GET['status'] == 'new') {
                    $user = new User();
                    echo $user->searchUsers('member', 'new', $_GET['s']);        
                }
                if($_GET['status'] == 'approved') {
                    $user = new User();
                    echo $user->searchUsers('member', 'approved', $_GET['s']);        
                }
                if($_GET['status'] == 'Not Approved') {
                    $user = new User();
                    echo $user->searchUsers('member', 'Not Approved', $_GET['s']);        
                }
                if($_GET['status'] == 'deleted') {
                    $user = new User();
                    echo $user->searchUsers('member', 'deleted', $_GET['s']);        
                }
            }
        ?>
    </div>
</div>



<?php include './footer.php'; ?>