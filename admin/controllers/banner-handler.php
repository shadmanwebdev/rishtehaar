<?php
    include '../../Classes/Db.php';
    include '../../Classes/Banner.php';                        
    
    // if(isset($_POST['submit_banner'])) {
        $banner = new Banner();
        $banner->update_banners();   
    // }
?>