<?php
    include '../../Classes/Db.php';
    include '../../Classes/Pricing.php';
    
    if(isset($_POST['update_price'])) {
        $pricing = new Pricing();
        $pricing->update_price();
    }
?>