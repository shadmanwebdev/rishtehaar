<?php include '../partials/header.php'; ?>
 



<?php
    $package = new Package();
    $package_status = $package->get_packages_status();
    if($package_status == 'enabled') {
        $pr = 2;
    } elseif ($package_status == 'disabled') {
        $pr = 1;
    }
    $package1 = $package->get_package_1();
    $package2 = $package->get_package_2(); 
?>
<div id="loader"></div>

<div class="admin_page-wrapper">
    <?php include './admin-sidebar.php'; ?>
    <div class="admin-content">
        <div class='admin-page'>
            <div class='admin-page-header'>
                <div>Packages</div>
                <div>Configure Packages</div>
            </div>
            <div class='admin-page-content'>
                <div class='admin-page-content-title'>
                    List of Packages
                </div>
            </div>
            <div class='package-list'>
                <div class='package' id='package-1'>
                    <div class='package-title'>
                        Package 1
                    </div>
                    <form id="update-package1" method='post' class='form' autocomplete='off' enctype="multipart/form-data" action='./controllers/packages-handler'>
                        <div class='input-group'>
                            <label for="duration_1">Duration (Months)</label>
                            <input type='number' id='duration_1' name='duration_1' value='<?= $package1['duration']; ?>'>
                        </div>
                        <div class='input-group'>
                            <label for="price_1">Price (Rs)</label>
                            <input type='number' id='price_1' name='price_1' value='<?= $package1['price']; ?>'>
                        </div>
                        <div class='adminFormBtn' onclick='updatePackage(0);'>Update</div>
                    </form>
                </div>
                <div class='package' id='package-2'>
                    <div class='package-title'>
                        Package 2
                    </div>
                    <form id="update-package1" method='post' class='form' autocomplete='off' enctype="multipart/form-data" action='./controllers/packages-handler'>
                        <div class='input-group'>
                            <label for="duration_2">Duration (Months)</label>
                            <input type='number' id='duration_2' name='duration_2' value='<?= $package2['duration']; ?>'>
                        </div>
                        <div class='input-group'>
                            <label for="price_2">Price (Rs)</label>
                            <input type='number' id='price_2' name='price_2' value='<?= $package2['price']; ?>'>
                        </div>
                        <div class='adminFormBtn' onclick='updatePackage(1);'>Update</div>
                    </form>
                </div>
            </div>
            <div class='customization-info'>
                <div class='custom-info-heading'>
                    <div>Disable/Enable Packages</div>
                    <div class='packages-status'><?= $package_status; ?></div>
                    <div class="range-container">
                        <input onchange="changePackageStatus();" type="range" min="1" max="2" value="<?= $pr; ?>" class="packages_status" id="packages_status" name="packages_status">
                    </div>
                </div>
                <div class='custom-info-subheading'>
                    If turned off will make the site free
                </div>
                <div class='custom-info-content'>
                    (menaing every user registered for the <br>
                    site will bypass thep ayment steps after<br>
                    he/she logins, and will directly have full<br>
                    access to everything just like a paid user<br>
                    does)
                </div>
            </div>
        </div>
    </div>
</div>
<!-- <input type="hidden" value=''> -->


<?php include './footer.php'; ?>