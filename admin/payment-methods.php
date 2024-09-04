<?php include '../partials/header.php'; ?>
 

<style>
    .payment-methods-wrapper {
        display: flex;
        flex-flow: column nowrap;
        row-gap: 20px;
    }
    .payment-method {
        width: 100%;
        border-radius: 4px;
        background-color: transparent;
    }
    .payment-head {
        width: 100%;
        padding: 15px 30px;
        display: flex;
        flex-flow: row nowrap;
        align-items: center;
        justify-content: space-between;
        cursor: pointer;
        width: 100%;
        border-radius: 4px;
        background-color: #fff;    
        border: 1px solid rgb(210,208,207);
    }
    .payment-body {
        display: none;
        padding: 20px;
    }
    .payment-body-inner {
        display: flex;
        flex-flow: column nowrap;
        row-gap: 35px;
    }
    .method-icons{
        display: flex;
        flex-flow: row nowrap;
        column-gap: 20px;
        align-items: center;
        justify-content: center;
    }
    .method-img.bank-img {
        width: 30px;
        height: 25px;
    }
    .method-img.jazzcash-img {
        width: 60px;
        height: 25px;
    }
    .method-img.easypaisa-img {
        width: 130px;
        height: 25px;
    }
    .method-img img {
        width: inherit;
        height: inherit;
    }
    .method-form-inner {
        display: flex;
        flex-flow: row nowrap;
        column-gap: 5%;
    }
    .method-form-column {
        width: 50%;
        display: flex;
        flex-flow: column nowrap;
        row-gap: 15px;
    }
    .method-form-row {
        width: 100%;
        display: flex;
        flex-flow: column nowrap;
        row-gap: 10px;
    }
    .method-form-row input[type=text]{
        background-color: #fff;
        border: 1px solid rgb(168,168,168);
        border-radius: 8px;
    }
    
    .payment-body-title {
        color: rgb(81,80,79);
        font-size: 15px;
    }
    #updateProfileBtn {
        margin-top: 30px;
        margin-left: auto;
        color: var(--bg-2);
        height: 50px;
        display: flex;
        flex-flow: row nowrap;
        text-align: center;
        justify-content: center;
        align-items: center;
        /* color: #fff; */
        font-weight: 500;
        border: 1px solid rgb(213,211,210);
        border-radius: 8px;
        text-transform: capitalize;
        
        cursor: pointer;
        background-color: #FFB600;
        font-size: 18px;
        width: 150px;
    }
</style>

<div id="loader"></div>

<div class="admin_page-wrapper">
    <?php include './admin-sidebar.php'; ?>
    <div class="admin-content">
        <div class='admin-page'>
            <div class='admin-page-header'>
                <div>Payment Methods</div>
                <div>Configure Packages</div>
            </div>
            <div class='admin-page-content'>
                <div class='payment-methods-wrapper'>
                    <?php
                        $payment = new Payment();
                        echo $payment->show_details_form();
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
    $(document).ready(function() {
        $(".payment-head").on("click", function(e) {
            e.preventDefault();
            if ($(this).hasClass("active")) {
                $(this).removeClass("active");
                $(this).siblings(".payment-body").slideUp(200);
                $(this).find("i").removeClass("ion-chevron-up").addClass("ion-chevron-down");
            } else {
                // $(".payment-head > i").removeClass("ion-chevron-up").addClass("ion-chevron-down");
                $(this).find("i").removeClass("ion-chevron-down").addClass("ion-chevron-up");
                $(".payment-head").removeClass("active");
                $(this).addClass("active");
                $(".payment-body").slideUp(200);
                $(this).siblings(".payment-body").slideDown(200);
            }
        });
    });

    function update_payment_details($method_id) {
        var loader = document.getElementById('loader');
        loader.classList.add('loader-animation');
        
        setTimeout(function(){ 
            if($method_id == 1) {
                var form = $('form')[0];
            } else if ($method_id == 2) {
                var form = $('form')[1];
            } else if ($method_id == 3) {
                var form = $('form')[2];
            }
            var formData = new FormData(form);
            $.ajax({
                url : './controllers/payment-handler',
                type: 'POST', 
                data : formData,
                async: false,
                cache : false,
                contentType: false,
                processData: false,
                success: function(response, textStatus, jqXHR) {
                    // console.log(response);
                    window.location.href = './payment-methods';
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR);
                    console.log(textStatus);
                    console.log(errorThrown);
                }
            });
        }, 3000);
    }
</script>
<?php include './footer.php'; ?>