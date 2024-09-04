<?php
    include '../../Classes/Db.php';
    include '../../Classes/Package.php';
    
    if(isset($_POST['duration_1']) && isset($_POST['price_1'])) {
        $package = new Package();
        $package->update_package_1();
    }
    if(isset($_POST['duration_2']) && isset($_POST['price_2'])) {
        $package = new Package();
        $package->update_package_2();
    }
?>