<?php include './partials/header.php'; ?>
<?php include './partials/navigation.php'; ?>

<link rel="stylesheet" href="./css/register.css?v=50">

<style>
    .packages-all {
        display: flex;
        flex-flow: row nowrap;
        justify-content: center;
        column-gap: 30px;
    }
    .package-group {
        background-color: rgb(246,246,246);
        border: 1px solid rgb(138,138,138);
        display: flex;
        flex-flow: column nowrap;
        row-gap: 25px;
        align-items: center;
        justify-content: center;
        padding: 25px 20px;
        text-align: center;
        letter-spacing: .3px;
        border-radius: 25px;
        width: 200px;
        position: relative;
    }
    .save-info-all {
        display: flex;
        flex-flow: row nowrap;
        justify-content: center;
        column-gap: 30px;
    }
    .save-info-wrapper {
        width: 200px;
        display: flex;
        justify-content: center;
    }
    .save-info {
        margin-top: -10px;
        width: 120px;
        background-color: rgb(42,42,42);
        color: rgb(228,228,228);
        font-size: 14px;
        padding: 5px 10px;
        text-align: center;
    }
    .save-info-wrapper:nth-child(1) .save-info {
        display: none;
    }
    .package-duration {
        color: rgb(42,42,42);
        font-size: 21px;
        
    }
    .package-description {
        color: rgb(125,125,125);
        font-size: 16px;
        
        width: 80px;
    }
    .package-price {
        color: rgb(42,42,42);
        font-size: 26px;
        
        margin-left: 5px;
    }
    div.packageSubmit {
        color: #0E0E0E;
        background-color: #FFB600;
        font-size: 18px;
        width: 150px;
        padding: 12px 0;
        text-align: center;
        border-radius: 8px;
        
        cursor: pointer;
        margin-left: auto;
    }
    .selected.package-group {
        background-color: rgb(255,239,226);
        border: 2px solid rgb(255,125,0);
    }
    .pay-method-column {
        display: flex;
        flex-flow: column nowrap;
    }
    .pay-method-row {
        width: 100%;
        padding: 25px 0;
        display: flex;
        flex-flow: row nowrap;
        align-items: center;
        justify-content: space-between;
        border-bottom: 1px solid rgb(213,213,213);
    }
    .pay-method-name {
        
        font-size: 18px;
        display: flex;
        flex-flow: row nowrap;
        align-items: center;
        column-gap: 12px;
    }
    .pay-method-img.bank-img {
        width: 30px;
        height: 28px;
    }
    .pay-method-img.jazzcash-img {
        width: 80px;
        height: 30px;
    }
    .pay-method-img.easypaisa-img {
        width: 120px;
        height: 23px;
    }
    .method-img img {
        width: inherit;
        height: inherit;
    }
    /* Selected package info */
    #selected-package {
        background-color: rgb(249,249,249);
        border: 1px solid rgb(224,224,224);
        padding: 14px 20px 18px 20px;
        display: flex;
        flex-flow: column nowrap;
        row-gap: 10px;
    }
    .selected-package-header {
        
        font-size: 16px;
        color: rgb(211,211,211);
        line-height: 1;
    }
    .selected-package-row {
        display: flex;
        flex-flow: row nowrap;
        align-items: flex-end;
        column-gap: 10px;
        
    }
    .selected-package-price {
        color: rgb(89,89,89);
        font-size: 25px;
        
        letter-spacing: 0;
        line-height: 1;
        margin-bottom: -2px;
    }
    .selected-package-duration {
        color: rgb(70,70,70);
        font-size: 16px;
        
        letter-spacing: 0;
        line-height: 1;
    }
    .pay-info-wrapper {
        display: flex;
        flex-flow: column nowrap;
        row-gap: 20px;
    }
    .pay-info-row {
        display: flex;
        flex-flow: row nowrap;
        align-items: center;
        column-gap: 5%;
    }
    .pay-info-wrapper .input-col:nth-child(1) {
        width: 40%;
    }
    .pay-info-wrapper .input-col:nth-child(2) {
        width: 60%;
    }
    .pay-info-wrapper .input-col:nth-child(1) {
        color: rgb(138,138,138);
    }
    .pay-info-wrapper .input-col:nth-child(2) {
        color: rgb(42,42,42);
        
    }
    .reminder {
        color: rgb(24,146,40);
        text-align: center;
        font-size: 17px;
        line-height: 1.6;
    }
    .problems {
        margin: 20px 0;
        color: rgb(59,57,56);
        padding: 20px 50px;
        border: 1px solid rgb(191,187,184);
        font-size: 14px;
        line-height: 1.8;
        text-align: center;
        background-color: rgb(255,238,222);
    }
    #pfpBtn {
        background-color: rgb(9,183,43);
        border: none;
        color: #fff;
    }
    .img-input-row {
        width: 100%;
        display: flex;
        flex-flow: row nowrap;
        column-gap: 10px;
    }
    input[type=text]#img-name-display {
        background-color: rgb(246,246,246);
        border: none;
        color: rgb(42,42,42);
        font-size: 18px;
    }
    .proof-text-column {
        display: flex;
        flex-flow: column nowrap;
        row-gap: 10px;
        text-align: center;
        margin-top: 20px;
        margin-bottom: 10px;
    }
    .proof-heading {
        font-size: 16px;
        color: black;
        
    }
    .proof-para {
        font-size: 15px;
        line-height: 1.6;
        color: #464646;
    }
    @media screen and (max-width: 1560px) {
        .packages-all {
            column-gap: 30px;
        }
        .package-group {
            row-gap: 15px;
            padding: 25px 20px;
            letter-spacing: .3px;
            border-radius: 25px;
            width: 200px;
        }
        .save-info-all {
            column-gap: 30px;
        }
        .save-info-wrapper {
            width: 200px;
        }
        .save-info {
            margin-top: -10px;
            width: 120px;
            font-size: 12px;
            padding: 5px 10px;
        }
        .package-duration {
            font-size: 18px;
        }
        .package-description {
            font-size: 14px;
            width: 80px;
        }
        .package-price {
            font-size: 22px;
            margin-left: 8px;
        }
        div.packageSubmit {
            font-size: 15px;
            width: 130px;
            padding: 10px 0;
            border-radius: 8px;
        }
        .pay-method-row {
            width: 100%;
            padding: 20px 0;
        }
        .pay-method-name {
            font-size: 16px;
            column-gap: 12px;
        }
        .pay-method-img.bank-img {
            width: 28px;
            height: 25px;
        }
        .pay-method-img.jazzcash-img {
            width: 70px;
            height: 28px;
        }
        .pay-method-img.easypaisa-img {
            width: 100px;
            height: 20px;
        }
        /* Selected package info */
        #selected-package {
            padding: 14px 20px 18px 20px;
            row-gap: 10px;
        }
        .selected-package-header {
            font-size: 14px;
        }
        .selected-package-row {
            column-gap: 8px;
        }
        .selected-package-price {
            font-size: 21px;
            letter-spacing: 0;
            line-height: 1;
            margin-bottom: -2px;
        }
        .selected-package-duration {
            font-size: 14px;
        }
        .pay-info-wrapper {
            row-gap: 15px;
        }
        .pay-info-row {
            column-gap: 5%;
        }
        .pay-info-wrapper .input-col:nth-child(1) {
            width: 40%;
        }
        .pay-info-wrapper .input-col:nth-child(2) {
            width: 60%;
        }
        .reminder {
            font-size: 17px;
            line-height: 1.6;
        }
        .problems {
            margin: 20px 0;
            padding: 20px 50px;
            font-size: 14px;
            line-height: 1.8;
        }
        .img-input-row {
            column-gap: 10px;
        }
        input[type=text]#img-name-display {
            font-size: 16px;
        }
        .proof-text-column {
            row-gap: 10px;
            margin-top: 20px;
            margin-bottom: 10px;
        }
        .proof-heading {
            font-size: 16px;
        }
        .proof-para {
            font-size: 15px;
        }
    }
    /* @media screen and (max-width: 414px) {
        .packages-all {
            column-gap: 30px;
        }
        .package-group {
            row-gap: 15px;
            padding: 25px 10px;
            letter-spacing: .3px;
            border-radius: 25px;
            width: 180px;
        }
        .save-info-all {
            column-gap: 30px;
        }
        .save-info-wrapper {
            width: 200px;
        }
        .save-info {
            margin-top: -10px;
            width: 120px;
            font-size: 13px;
            padding: 5px 10px;
        }
        .package-duration {
            font-size: 16px;
        }
        .package-description {
            font-size: 13px;
            width: 80px;
        }
        .package-price {
            font-size: 18px;
            margin-left: 5px;
        }
    } */
</style>

<div id="loader"></div>

<?php
    $uid = $user->get_uid();
?>

<form id="create-profile" runat='server' method='post' class='form' autocomplete='off' runat="server" enctype="multipart/form-data" action='./controllers/registration-handler.php'>
    <input type="hidden" name='user_id' id='user_id' value='<?= $uid; ?>'>
    <div class='register'>
        <div class='form-cards'>

            <!-- Card 1 -->
            <div class='form-card' id='form-card-1'>

                <div class='form-card-header'>
                    <div class='form-heading'>
                        <h3>Choose Your Package</h3>
                    </div>
                    <div class='form-subheading'>
                        <p>Affordable rates for everyone</p>
                    </div>
                </div>
                <div class='form-card-body'>
                    <div class='packages-all'>
                        <input type="hidden" name='package' id='package' value='2'>
                        <?php
                            $package = new Package();
                            $package_1 = $package->get_package_1();
                            $package_2 = $package->get_package_2();
                        ?>
                    
                        <div class='package-group' id='package-group-1'>
                            <input onchange='radioVal(this.value)' type='radio' value='1' id='package_1'>
                            <div class='package-duration'>
                                <?= $package_1['duration']; ?> months
                            </div>
                            <div class='package-description'>
                                Unlimited Access
                            </div>
                            <div class='package-price'>
                                Rs <?= $package_1['price']; ?>.
                            </div>
                        </div>
                        <div class='package-group selected' id='package-group-2'>
                            <input onchange='radioVal(this.value)' type='radio' value='2' id='package_2'>
                            <div class='package-duration'>
                                <?= $package_2['duration']; ?> months
                            </div>
                            <div class='package-description'>
                                Unlimited Access
                            </div>
                            <div class='package-price'>
                                Rs <?= $package_2['price']; ?>.
                            </div>
                        </div>
                    </div>

                    <div class='save-info-all'>                     
                        <div class='save-info-wrapper'>
                            <div class='save-info'>
                                
                            </div>
                        </div>
                        <div class='save-info-wrapper'>
                            <div class='save-info'>
                                Most Popular
                            </div>
                        </div>         
                    </div>

                </div>


                <div class='form-card-footer'>
                    <div id='card-1-next' class='packageSubmit' onclick='toggleCards(this.id);'>
                        Next
                    </div>
                </div>
            </div>
            <!-- Card 2 -->
            <div class='form-card' id='form-card-2'>
                <div class='form-card-header'>
                    <div class='form-heading'>
                        <h3>Payment Method</h3>
                    </div>
                    <div class='form-subheading'>
                        <p>Choose from available methods</p>
                    </div>
                </div>
                <div class='form-card-body'>
                    <input type="hidden" name='pay_method' id='pay_method' value='bank'>
                    <div class='pay-method-column'>
                        <div class='pay-method-row'>
                            <div class='pay-method-name'>
                                <input onchange='payMethodVal(this.value)' type='radio' value='bank' id='bank' checked> Bank Transfer
                            </div>
                            <div class='pay-method-img bank-img'>
                                <img src="./assets/img/bank.png" alt="">
                            </div>
                        </div>
                        <div class='pay-method-row'>
                            <div class='pay-method-name'>
                                <input onchange='payMethodVal(this.value)' type='radio' value='easypaisa' id='easypaisa'> EasyPaisa
                            </div>
                            <div class='pay-method-img easypaisa-img'>
                                <img src="./assets/img/easypaisa.png" alt="">
                            </div>
                        </div>
                        <div class='pay-method-row'>
                            <div class='pay-method-name'>
                                <input onchange='payMethodVal(this.value)' type='radio' value='jazzcash' id='jazzcash'> JazzCash
                            </div>
                            <div class='pay-method-img jazzcash-img'>
                                <img src="./assets/img/jazzcash.png" alt="">
                            </div>
                        </div>
                        <input type="hidden" name='pay_method' id='pay_method'>
                    </div>
                    <!-- Selected Package info -->
                    <div id='selected-package'>
                        <div class='selected-package-header'>
                            Package
                        </div>
                        <div class='selected-package-row'>
                            <div class='selected-package-price'>
                                
                            </div>
                            <div class='selected-package-duration'>

                            </div>
                        </div>
                    </div>
                </div>
                <div class='form-card-footer'>
                    <div class='form-card-btns'>
                        <div id='card-2-back' class='formSubmit formBack' onclick='toggleCards(this.id);'>
                            Back
                        </div>
                        <div id='card-2-next' class='packageSubmit' onclick='toggleCards(this.id);'>
                            Next
                        </div>
                    </div>
                </div>
            </div>
            <!-- Card 3 -->
            <div class='form-card' id='form-card-3'>
                <div class='form-card-header'>
                    <div class='form-heading'>
                        <h3>Make Payment</h3>
                    </div>
                    <div class='form-subheading'>
                        <p>Transfer funds to account below</p>
                    </div>
                </div>
                <div class='form-card-body'>
                    <?php
                        $payment = new Payment();
                        echo $payment->show_bank_info();
                    ?>
                </div>
                <div class='reminder'>
                    Remember to take Screenshot or Picture 
                    of the transaction as a proof
                </div>
                <div id='selected-package'>
                    <div class='selected-package-header'>
                        Package
                    </div>
                    <div class='selected-package-row'>
                        <div class='selected-package-price'>
                            
                        </div>
                        <div class='selected-package-duration'>

                        </div>
                    </div>
                </div>
                <div class='form-card-footer'>
                    <div class='form-card-btns'>
                        <div id='card-3-back' class='formSubmit formBack' onclick='toggleCards(this.id);'>
                            Back
                        </div>
                        <div id='card-3-next' class='packageSubmit' onclick='toggleCards(this.id);'>
                            Transferred
                        </div>
                    </div>
                </div>
            </div>
            <!-- Card 4 -->
            <div class='form-card' id='form-card-4'>
                <div class='form-card-header'>
                    <div class='form-heading'>
                        <h3>Make Payment</h3>
                    </div>
                    <div class='form-subheading'>
                        <p>Transfer funds to account below</p>
                    </div>
                </div>
                <div class='form-card-body'>
                    <?php
                        echo $payment->show_easypaisa_info();
                    ?>
                </div>
                <div class='reminder'>
                    Remember to take Screenshot or Picture 
                    of the transaction as a proof
                </div>
                <div id='selected-package'>
                    <div class='selected-package-header'>
                        Package
                    </div>
                    <div class='selected-package-row'>
                        <div class='selected-package-price'>
                            
                        </div>
                        <div class='selected-package-duration'>

                        </div>
                    </div>
                </div>
                <div class='form-card-footer'>
                    <div class='form-card-btns'>
                        <div id='card-4-back' class='formSubmit formBack' onclick='toggleCards(this.id);'>
                            Back
                        </div>
                        <div id='card-4-next' class='packageSubmit' onclick='toggleCards(this.id);'>
                            Transferred
                        </div>
                    </div>
                </div>
            </div>
            <!-- Card 5 -->
            <div class='form-card' id='form-card-5'>
                <div class='form-card-header'>
                    <div class='form-heading'>
                        <h3>Make Payment</h3>
                    </div>
                    <div class='form-subheading'>
                        <p>Transfer funds to account below</p>
                    </div>
                </div>
                <div class='form-card-body'>
                    <?php
                        echo $payment->show_jazzcash_info();
                    ?>
                </div>
                <div class='reminder'>
                    Remember to take Screenshot or Picture 
                    of the transaction as a proof
                </div>
                <div id='selected-package'>
                    <div class='selected-package-header'>
                        Package
                    </div>
                    <div class='selected-package-row'>
                        <div class='selected-package-price'>
                            
                        </div>
                        <div class='selected-package-duration'>

                        </div>
                    </div>
                </div>
                <div class='form-card-footer'>
                    <div class='form-card-btns'>
                        <div id='card-5-back' class='formSubmit formBack' onclick='toggleCards(this.id);'>
                            Back
                        </div>
                        <div id='card-5-next' class='packageSubmit' onclick='toggleCards(this.id);'>
                            Transferred
                        </div>
                    </div>
                </div>
            </div>
            <!-- Card 7 -->
            <div class='form-card' id='form-card-6'>
                <div class='form-card-header'>
                    <div class='form-heading'>
                        <h3>Upload Proof</h3>
                    </div>
                    <div class='form-subheading'>
                        <p>Screenshot or Picture of the Transaction</p>
                    </div>
                </div>
                <div class='form-card-body'>    
                    <div class='img-input-row'>
                        <input type="text" disabled id='img-name-display' placeholder='Format jpg, png'>
                        <button id='pfpBtn' onclick="return fireButton(event);">Upload</button>
                        
                        <input class="input" id="image" type="file" name="image" style="display: none;">
                    </div>
                    <div class='proof-text-column'>
                        <div class='proof-heading'>
                            What is Proof?
                        </div>
                        <div class='proof-para'>
                            Screenshot of Bank app or Email form Bank or 
                            Reciept from Shop/Retailer or SMS recieved
                        </div>
                    </div>
                </div>
                <div class='form-card-footer'>
                    <div class='form-card-btns'>
                        <div id='card-6-back' class='formSubmit formBack' onclick='toggleCards(this.id);'>
                            Back
                        </div>
                        <div id='card-6-next' class='formSubmit' onclick='toggleCards(this.id);'>
                            Submit
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div>
            <div class='problems'>
                For any problems faced or questions contacts us on WhatsApp Helpline or Email
            </div>
        </div>
    </div>

</form>


<script>
    // We'll insert selected price and duration inside these
    var priceDiv = document.querySelectorAll('.selected-package-price');
    var durationDiv = document.querySelectorAll('.selected-package-duration');


    package1_price = <?php echo $package_1['price']; ?>;
    package1_duration = <?php echo $package_1['duration']; ?>;
    package2_price = <?php echo $package_2['price']; ?>;
    package2_duration = <?php echo $package_2['duration']; ?>;

    for (let i = 0; i < priceDiv.length; i++) {
        priceDiv[i].textContent = 'Rs '+package2_price;
    }
    for (let i = 0; i < durationDiv.length; i++) {
        durationDiv[i].textContent = package2_duration + ' months';
    }

    document.getElementById('package_2').checked = true;
    function radioVal(radioVal) {
        var packageInput = document.getElementById('package');
        var package1Radio = document.getElementById('package_1');
        var package2Radio = document.getElementById('package_2');

        var package1 = document.getElementById('package-group-1');
        var package2 = document.getElementById('package-group-2');

        if(radioVal == '2') {
            package1Radio.checked = false;
            package2Radio.checked = true;
            packageInput.value = '2';
            if(package1.classList.contains('selected')) {
                package1.classList.remove('selected');
            }
            if(!package2.classList.contains('selected')) {
                package2.classList.add('selected');
            }
            for (let i = 0; i < priceDiv.length; i++) {
                priceDiv[i].textContent = 'Rs '+package2_price;
            }
            for (let i = 0; i < durationDiv.length; i++) {
                durationDiv[i].textContent = package2_duration + ' months';
            }    
            
            return;
        }
        if(radioVal == '1') {
            package2Radio.checked = false;
            package1Radio.checked = true;
            packageInput.value = '1';
            if(package2.classList.contains('selected')) {
                package2.classList.remove('selected');
            }
            if(!package1.classList.contains('selected')) {
                package1.classList.add('selected')
            }
            for (let i = 0; i < priceDiv.length; i++) {
                priceDiv[i].textContent = 'Rs '+package1_price;
            }
            for (let i = 0; i < durationDiv.length; i++) {
                durationDiv[i].textContent = package1_duration + ' months';
            }    
            
            return;
        }
    }
    function payMethodVal(radioVal) {
        // console.log(radioVal); // bank, easypaisa, jazzcash
        var payMethodInp = document.getElementById('pay_method');
        var bankRadio = document.getElementById('bank');
        var easypaisaRadio = document.getElementById('easypaisa');
        var jazzcashRadio = document.getElementById('jazzcash');

        if(radioVal == 'bank') {
            jazzcashRadio.checked = false;
            easypaisaRadio.checked = false;
            bankRadio.checked = true;
            payMethodInp.value = 'bank';
            console.log('bank checked');
            return;
        }
        if(radioVal == 'easypaisa') {
            jazzcashRadio.checked = false;
            easypaisaRadio.checked = true;
            bankRadio.checked = false;
            payMethodInp.value = 'easypaisa';
            return;
        }
        if(radioVal == 'jazzcash') {
            jazzcashRadio.checked = true;
            easypaisaRadio.checked = false;
            bankRadio.checked = false;
            payMethodInp.value = 'jazzcash';
            return;
        }
    }
</script>
<script src="./js/package.js?v=17"></script>


<?php include './partials/footer.php'; ?>