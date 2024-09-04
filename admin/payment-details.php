<?php include './header.php'; ?>
 

<style>
    .update-user-form-heading {
        font-size: 21px;
        
    }
    .change-password {
        padding: 80px 20px 80px 20px;
    }
    form#change_pwd {
        display: flex;
        flex-flow: column nowrap;
    }

    #pwd-row {
        display: flex;
        flex-flow: row nowrap;
        align-items: center;
        column-gap: 20px;
    }
    #pwd_inputs {
        display: flex;
        flex-flow: row nowrap;
        column-gap: 20px;
    }
    #pwd_inputs input[type=password] {
        width: 100%;
        background-color: #fff;
    }
    .pwd-inner {
        display: flex;
        flex-flow: column nowrap;
        row-gap: 10px;
    }
    #updateProfileBtn, #pwdBtn, #deactivateBtn, #deleteBtn {
        margin-top: 30px;
        margin-left: auto;
        color: var(--bg-2);
        height: 45px;
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
    }
    #updateProfileBtn, #pwdBtn {
        background-color: #FFB600;
        font-size: 16px;
        width: 130px;
    }
    @media screen and (max-width: 800px) {
        #profile-section-1.profile-section {
            width: 90%;
            margin: 0 auto;
        }
        #profile-section-2 {
            width: 85%;
            margin: 0 auto;
        }
        .profile-page-content .p-card {
            padding: 40px 30px;
        }
        #pwd-row {
            width: 100%;
        }
        .pwd-inner {
            width: 100%;
        }
        #pwd_inputs {
            display: flex;
            flex-flow: column nowrap;
            row-gap: 10px;
        }
    }
</style>

<div id="loader"></div>

<?php 
    $userdata = json_decode($_SESSION['user'], true);
    $id = $userdata['uid'];
?>


<style>
    .card {
        border: 1px solid #ddd;
        border-radius: 8px;
        margin: 10px;
        padding: 10px;
        max-width: 900px;
        min-width: 900px;
        margin: 100px auto;
        background: #fff;
    }

    .list-group {
        list-style: none;
        padding: 0;
    }

    .list-group-item {
        display: flex;
        justify-content: space-between;
        padding: 8px;
        border-bottom: 1px solid #ddd;
        word-break: break-all;
    }

    /* .list-group-item:last-child {
        border-bottom: none;
    } */

    strong {
        font-weight: bold;
    }
    @media screen and (max-width: 1200px) {
        .admin_page-wrapper > div {
            width: 80%;
            margin: 0 auto;
        }
        .admin-content {
            padding: 0;
            width: 100%;
            margin: 20px auto;
        }
        .card {
            width: 100%;
            max-width: 100%;
            min-width: 100%;
        }
        .list-group-item > div:first-child {
            margin-right: 20px;
        }
    }
</style>


<style>
    .update-btn-wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 10px 0;
    }
    .update-payment-btn {
        display: block;
        color: #0E0E0E !important;
        background-color: #FFB600 !important;
        min-width: 160px;
        font-size: 16px;
        padding: 12px 10px;
        text-align: center;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        margin: 0 auto;
    }
</style>


<div class="admin_page-wrapper">
    <?php include './admin-sidebar.php'; ?>
    <div>



        <div class="admin-content">

            <?php
                $pp = new PayfastPayment();
                $pp->displayPaymentDetails($_GET['pid']);
            ?>


        </div>

    </div>

</div>






<script defer>
    function update_price() {
  
        const price = document.getElementById('price').value;
        const msgResponse = document.getElementById('msg-response');

        if(price) {
            var formData = new FormData();

            formData.append('update_price', 'true');
            formData.append('price', price);
    
            fetch('./controllers/price-handler.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(response => {
                
                console.log(response);
    
                if ($.trim(response) == '1') {
                    // window.location.href = './pricing';
                    msgResponse.innerHTML = "<div class='success'>Price updated successfully</div>";
                } else {
                    msgResponse.innerHTML = "<div class='error'>Failed to update Price</div>";
                }
            })
            .catch(err => console.log(err));
        } else {
            // Price
            if(price) {
                $('#priceError').html('');
                $('#price').removeClass('invalid');
            } else {
                $('#priceError').html('<div>*Required</div>');
                $('#price').addClass('invalid');
            }
        }

    }
        

</script>


<?php include './footer.php'; ?>