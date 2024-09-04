<?php include './partials/header.php'; ?>
<?php include './partials/navigation.php'; ?>

<style>
    .contact-page-wrapper {  
        max-width: 1100px;
    }

    .page-text-content {
        display: flex;
        flex-flow: row nowrap;
    }
    
    .divider {
        height: 300px;
        width: 1px;
        background: #CBCBCB;
        margin: 30px 80px;
    }
    .contact-page-title h1 {
        margin-bottom: 40px;
    }

    #contactForm {
        width: 70%;
        margin: 0px auto 50px auto;
    }
</style>

<style>
    .page-title h1 {
        font-size: 32px;
        font-weight: 700;
        line-height: 36px;
        letter-spacing: .05em;
        text-align: center;
    }
    #contactForm {
        margin: 0px auto 50px auto;
    }
    #contactForm label {
        font-size: 16px;
        font-weight: 400;
        line-height: 20px;
        letter-spacing: 0em;
        text-align: left;

    }
    #contactForm input,
    #contactForm textarea {
        font-family: 'Roboto', sans-serif;
        border: 2px solid #ADADAD;
        font-weight: 500;
    }
    #contactForm input {
        font-size: 16px;
        border-radius: 7px;
        height: 50px;
    }
    #contactForm textarea {
        font-size: 17px;
    }
    #contactForm .send {

        background: #FFB600;
        color: #000;
        margin-left: auto;
        border: none;
        text-transform: capitalize;


        font-size: 15px;
        font-weight: 600;
        line-height: 35px;
        letter-spacing: 0em;
        text-align: center;

        width: 135px;
        height: 50px;
        border-radius: 9px;

        text-transform: uppercase;

    }
    label {
        display: block;
        margin-bottom: 10px;
    }
</style>

<!-- Verification Pop Ups -->
<style>
    .not-recieved {
        
        font-size: 14px;
        font-weight: 400;
        line-height: 30px;
        letter-spacing: 0em;
        text-align: center;
        color: #7E7E7E;
        margin-top: 20px;
    }
    .resend-link {
        
        font-size: 16px;
        font-weight: 500;
        line-height: 30px;
        letter-spacing: 0em;
        text-align: center;
        color: #FFB600;
        text-align: center;
        cursor: pointer;
        transition: .4s;
    }
    .resend-link:hover {
        color: #f0ab00;
    }
    .popup {
        padding: 50px;
        width: 438px;
        /* height: 455px; */
        /* display: flex;
        align-items: center;
        justify-content: center; */
        position: fixed;
        top: 300px;
        left: 50%;
        margin-left: -219px;
        border-radius: 21px;
        background: #FFFFFF;
        box-shadow: 0px 2px 10px 0px #00000026;
        text-align: center;
        z-index: 100;
    }
    .popup-title {  
        
        font-size: 18px;
        font-weight: 600;
        line-height: 30px;
        letter-spacing: 0em;
        text-align: center;
        color: #000;
    }
    .popup-subtitle {
        margin: 10px 0;
    }
    .popup-subtitle p {
        
        font-size: 16px;
        font-weight: 400;
        line-height: 22px;
        letter-spacing: 0em;
        text-align: center;
        margin-bottom: 5px;
    }
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
    input[type=number] {
        -moz-appearance: textfield;
    }
    form.verify-code .form-group {
        display: flex;
        flex-direction: column;
    }
    .popup .icon {
        width: 65px;
        height: 65px;
        margin: 0 auto 10px auto;
    }
    .popup .submit {
        width: 135px;
        height: 45px;
        border-radius: 7px;
        background: #FFB600;
        color: #000;
        border: none;
        text-transform: capitalize;
        font-size: 16px;
        font-weight: 500;
        line-height: 35px;
        letter-spacing: 0em;
        text-align: center;
        margin: 10px auto 0 auto;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }
    .popup .submit:hover {
        background: #ffc73c;
    }
    @media screen and (max-width: 768px) {
        .popup {
            max-width: 350px;
            left: 50%;
            margin-left: -175px;
            padding: 30px;
        }
    }
</style>

<div id='popBg' onclick='closePopup(event)'></div>
<div class='popup hide_popup' id='contact-success-popup'>
    <div class='popup-inner-div'>
        <div class='icon'>
            <img src="./assets/svg/check-round.svg" alt="Email confirmation icon">
        </div>
        <div class='popup-title'>Message Sent Succesfully</div>
        <div class="form-group">
            <div onclick='closePopup(event)' class="submit">Ok</div>
        </div>
    </div>
</div>


<!-- INFORMATION -->
<style>
    .contact-info {
        
    }
    .contact-info .info-title {
        font-size: 22px;
        font-weight: 500;
        line-height: 24px;
        letter-spacing: -0.015em;
        text-align: left;
        text-transform: uppercase;
        margin-bottom: 30px;
    }
    .contact-info .list-unstyled li.info-row {
        text-align: left;
        display: flex;
        flex-flow: row nowrap;
        margin-bottom: 20px;
    }
    .contact-info {
        font-size: 18px;
        font-weight: 400;
        line-height: 40px;
        letter-spacing: -0.015em;
        text-align: left;
    }
    .contact-info .label {
        width: 20%;
        margin-right: 20px;
    }
    .contact-info .value {
        width: 80%;
        color: #000000;
    }
</style>



<style>
    @media screen and (max-width: 1280px) {
        .divider {
            display: none;
        }
        .contact-info {
            margin-right: 100px;
        }
    }
    @media screen and (max-width: 996px) {
        .contact-page-wrapper {
            max-width: 80%;
        }

        .page-text-content {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
        }
        .divider {
            margin: 50px auto;
            display: flex;
            width: 50px;
            height: 1px;
        }
        .contact-info {
            margin-right: 0px;
            margin-bottom: 0px;
        }
        .contact-info .list-unstyled li.info-row:last-child {
            margin-bottom: 0px;
        }
        #contactForm {
            width: 100%;
        }
    }
</style>



<div class='page-wrapper contact-page-wrapper'>
    <div class='page-title contact-page-title'>
        <h1>Contact Us</h1>
    </div>
    <div class='page-text-content'>
        <div class='contact-info'>
            <h5 class='info-title'>information</h5>
            <ul class='list-unstyled mb-5'>   
                <li class='info-row'>
                    <span class='label'>Email</span>
                    <span class='value'>services@rishtehaar.com</span>
                </li>    
                <li class='info-row'>
                    <span class='label'>Phone</span>
                    <span class='value'>+92 3125259269</span>
                </li>
                <li class='info-row'>
                    <span class='label'>Address</span>
                    <span class='value'>Plot 13, Street No. 35, Sector E-16/3 Cabinet Division Housing Society, Peshawar Road Islamabad</span>
                </li>
            </ul>
        </div>
        <div class='divider'></div>
        <form onsubmit='return send_message(event)' autocomplete='off' action='' id='contactForm' class='contact' method='POST'>
            <div class='input-group'>
                <label for="msg">Email</label>
                <input type='text' class='email' name='email' id='email' placeholder='usman12@gmail.com'>
                <div class='error' id='emailError'></div>
            </div>
            <div class='input-group'>
                <label for="msg">Mobile Number</label>
                <input type='number' class='phone' name='phone' id='phone' placeholder='03335521451'>
                <div class='error' id='phoneError'></div>
            </div>
            <div class='input-group'>
                <label for="msg">Message</label>
                <textarea name='msg' id='msg' cols='30' rows='6' placeholder='I want to ask this question...'></textarea>
                <div class='error' id='msgError'></div>
            </div>
            <div class='input-group'>
                <input type='submit' class='send' name='send' value='Send'>
            </div>
            <div id='msg-response'></div>
        </form>
    </div>
</div>










<script defer>
    var emailInp = document.getElementById('email');
    var phoneInp = document.getElementById('phone');
    var msgInp = document.getElementById('msg');

    if(typeof(emailInp) != 'undefined' && emailInp != null) {
        emailInp.addEventListener('change', function() {
            if(emailInp.value) {
                emailInp.style.border = '2px solid #00863E';
                emailInp.style.backgroundColor = '#fff';
            } else {
                emailInp.style.border = '2px solid red';
                emailInp.style.backgroundColor = 'rgb(254,220,224)';
            }
        });
    }
    if(typeof(phoneInp) != 'undefined' && phoneInp != null) {
        phoneInp.addEventListener('change', function() {
            if(phoneInp.value) {
                phoneInp.style.border = '2px solid #00863E';
                phoneInp.style.backgroundColor = '#fff';
            } else {
                phoneInp.style.border = '2px solid red';
                phoneInp.style.backgroundColor = 'rgb(254,220,224)';
            }
        });
    }
    if(typeof(msgInp) != 'undefined' && msgInp != null) {
        msgInp.addEventListener('change', function() {
            if(msgInp.value) {
                msgInp.style.border = '2px solid #00863E';
                msgInp.style.backgroundColor = '#fff';
            } else {
                msgInp.style.border = '2px solid red';
                msgInp.style.backgroundColor = 'rgb(254,220,224)';
            }
        });
    }
    function send_message(event) {
        event.preventDefault();

        var formData = new FormData();

        // Email
        var emailInp = document.getElementById('email');
        var emailValue = document.getElementById('email').value;
        var emailError = document.getElementById('emailError');
        // Phone
        var phoneInp = document.getElementById('phone');
        var phoneValue = document.getElementById('phone').value;
        var phoneError = document.getElementById('phoneError');
        // Message
        var msgInp = document.getElementById('msg');
        var msgValue = document.getElementById('msg').value;
        var msgError = document.getElementById('msgError');

        if(emailValue && emailValue.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/) && phoneValue && msgValue) {

            formData.append('send_message', 'true');
            formData.append('email', emailValue);
            formData.append('phone', phoneValue);
            formData.append('message', msgValue);

            fetch('./controllers/contact-handler.php', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                return response.text()      
            })
            .then(response => {
                var alert = document.getElementById('msg-response');
                alert.classList.add('alert');

                if($.trim(response) == '1') {
                    popup('contact-success-popup')
                } else if ($.trim(response) == '2') {
                    alert.innerHTML = "<div class='error'>This email is not registered</div>";
                } else {
                    alert.innerHTML = "<div class='error'>There was an error.</div>";
                }
            })
            .catch( err => console.log(err));

        } else {
            // Email
            if(emailValue && emailValue.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/)) {
                emailInp.style.border = '2px solid #00863E';
                emailInp.style.backgroundColor = 'rgb(249,249,249)';
            } else {
                emailInp.style.border = '2px solid red';
                emailInp.style.backgroundColor = 'rgb(254,220,224)';
            }
            // Phone
            if(phoneValue) {
                phoneInp.style.border = '2px solid #00863E';
                phoneInp.style.backgroundColor = 'rgb(249,249,249)';
            } else {
                phoneInp.style.border = '2px solid red';
                phoneInp.style.backgroundColor = 'rgb(254,220,224)';
            }
            // Message
            if(msgValue) {
                msgInp.style.border = '2px solid #00863E';
                msgInp.style.backgroundColor = 'rgb(249,249,249)';
            } else {
                msgInp.style.border = '2px solid red';
                msgInp.style.backgroundColor = 'rgb(254,220,224)';
            }
        }
    }
</script>




<?php include './partials/footer.php'; ?>