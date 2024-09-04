<?php include './partials/header.php'; ?>
<?php include './partials/navigation.php'; ?>

<link rel="stylesheet" href="./css/register.css?v=5">


<?php

if(isset($_SESSION['user'])) {
    $uid = $user->get_uid();
    $account_status = $user->get_and_update_account_status($uid);
    if($account_status == 'Not Approved') {
        $status_text = 'Under Verification';
    } else if($account_status == 'approved') {
        $status_text = 'Verified';
    } else {
        header('location: ./');
    }
} else {
    header('location: ./');
}

?>


<style>
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
</style>
<style>
    .average {
        color: gray;
        width: 100%;
        text-align: center;
        text-transform: italic;
    }
    .submitted-div {
        display: flex;
        flex-flow: column nowrap;
        align-items: center;
        justify-content: center;
        row-gap: 10px;
    }
    .icon-outer-circle {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background-color: rgb(254,244,244);
        display: flex;
        flex-flow: column nowrap;
        align-items: center;
        justify-content: center;
        text-align: center;
    }
    .submitted-div div:nth-child(2){
        font-size: 30px;
        
    }
    .icon-outer-circle div:nth-child(1) {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: rgb(0,181,36);
    }
    .icon-outer-circle .fas.fa-check:before {
        color: #fff;
    }
    .awaiting {
        font-size: 20px;
        line-height: 1.6;
        text-align: center;
        color: rgb(70,70,70);
        
        margin-top: -10px;
        margin-bottom: 20px;
    } 
    #selected-package.verification {
        border: 2px solid rgb(255,206,71);
        padding: 20px 30px 25px 30px;
    }
    .selected-package-duration.verification {
        
        color: rgb(70,70,70);
        font-size: 22px;
    }
</style>



<div id="loader"></div>

<form id="create-profile" runat='server' method='post' class='form' autocomplete='off' runat="server" enctype="multipart/form-data" action='./controllers/registration-handler.php'>
    <div class='register'>
        <div class='form-cards'>
            <!-- Card 7 -->
            <div class='form-card' id='form-card-1'>
                <div class='form-card-header'>
                    <div class='submitted-div'>
                        <div class='icon-outer-circle'>
                            <div><i class="fas fa-check"></i></div>
                        </div>
                        <div>Submitted</div>
                    </div>
                </div>
                <div class='form-card-body'>    
                    <div class='awaiting'>
                        Your payment will be confirmed in less than 24 hours
                    </div>
                    <div id='selected-package' class='verification'>
                        <div class='selected-package-header'>
                            Status
                        </div>
                        <div class='selected-package-row'>
                            <!-- <div class='selected-package-price'>
                                
                            </div> -->
                            <div class='selected-package-duration verification'>
                                <?= $status_text ?>
                            </div>
                        </div>
                    </div>
                    <div class='average'>
                        Average approval time is 2 hours
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



<?php include './partials/footer.php'; ?>