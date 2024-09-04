<?php include './partials/header.php'; ?>
<?php include './partials/navigation.php'; ?>


<?php
    if(isset($_GET['reset'])) {
?>


    <div id='reset-success'>
        <div class='popup-inner-div'>
            <div class='icon'>
                <img src="./assets/svg/check-round.svg" alt="Checked Icon">
            </div>
            <div class='popup-title'>Password Reset Successful</div>
        </div>
    </div>



<?php
    }
?>



<?php include './partials/footer.php'; ?>