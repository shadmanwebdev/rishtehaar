<?php
    include '../partials/functions.php';
    include '../Classes/Db.php';
    include '../Classes/User.php';
    include '../Classes/Bookmark.php';

    if(isset($_POST['bookmark'])) {
        $bookmark = new Bookmark;
        $bookmark->bookmark();
    }
?>