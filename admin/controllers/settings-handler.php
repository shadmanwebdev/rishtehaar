<?php
    include '../../Classes/Db.php';
    include '../../Classes/Settings.php';

    if(isset($_POST['settings'])) {
        $settings = new Settings();
        $settings->update_settings();
    }
?>
