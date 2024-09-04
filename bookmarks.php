<?php include './partials/header.php'; ?>
<?php include './partials/navigation.php'; ?>


<style>
    #content-wrapper {
        min-height: 40vh;
    }
    #proposals-body {
        border-top: none;
    }
</style>

<!-- Bookmarks -->
<div id='content-wrapper'>
    <div class='main'>

        <div id='proposals'>
            <div id='proposals-head'>
                <div class='proposals-head-row1' style='margin-bottom: 20px;'>
                    <div class='proposals-title'>
                        <div class='proposals-title-main'>
                           <span style='font-size: 30px;'>Bookmarks</span>
                        </div>
                    </div>
                </div>
            </div>
            <div id='proposals-body'>
                <div class='proposals-content'>
                    <?php 
                        $bookmark = new Bookmark;
                        $bookmark->show_bookmarks();
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>




<?php include './partials/footer.php'; ?>