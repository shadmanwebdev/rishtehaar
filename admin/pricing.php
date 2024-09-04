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
    .price-form {
        min-width: 350px;
        max-width: 760px;
        padding: 100px 0;
        margin: 20px auto 20px auto;
        row-gap: 0px;
    }

    .price-form .title {
        font-size: 22px;
        font-weight: 500;
        line-height: 18px;
        letter-spacing: 0em;
        text-align: left;
        color: #000;
        margin-bottom: 20px;
    }

    label {
        font-size: 16px;
        font-weight: 400;
        line-height: 30px;
        letter-spacing: 0em;
        text-align: left;
    }
    .input-group input {
        font-family: 'Roboto', sans-serif;
        border: 2px solid rgb(0, 134, 62);
        color: #000;
        font-size: 14px;
        padding: 15px 15px;
        border-radius: 8px;
        outline: none;
        border: 1px solid rgb(105,105,105);
        background-color: #FFFFFF;
        font-size: 16px;
        width: 100%;
        border-radius: 8px;
        display: flex;
        align-items: center;
    }

    .input-group input {
        height: 45px;
    }
    input {
        border: 2px solid #ADADAD;
    }
    .apply-btn {
        margin-top: 30px;
        width: 150px;
        padding: 15px 15px;
        text-align: center;
        font-size: 14px;
        border-radius: 4px;
        border: none;
        box-shadow: none;
        font-weight: 600;
        color: #000;
        background: #FFB600;
        cursor: pointer;
    }
</style>

<?php
    $pricing = new Pricing();
    $price = $pricing->get_price();
?>


<div class="admin_page-wrapper">
    <?php include './admin-sidebar.php'; ?>
    <div>



        <div class="admin-content">

            <form class="price-form">
                

                <div class="title">
                    Price
                </div>
                <div class="input-group">
                    <input type="text" class="price" name="price" id="price"  value="<?= $price; ?>">
                    <div class="error" id="priceError"></div>
                </div>

                <div class="submit-wrapper">
                    <div class="apply-btn" onclick="update_price()">
                        Save
                    </div>
                </div>


                <div style='margin-top: 20px;' id="msg-response"></div>
            </form>

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