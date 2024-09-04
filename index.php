<?php include './partials/header.php'; ?>


<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-8HK3TCNCVX"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-8HK3TCNCVX');
</script>



<?php include './partials/navigation.php'; ?>



<?php
    if(!isset($_SESSION['user'])) {
?>
<!-- Hero Section -->
<div class='hero-section'>
    <div class='inner-div'>
        <h1>
            Matrimonial Website for <span class='orn'>Pakistani</span> Rishta
        </h1>
        <p>Find Online Online Rishta in Respectful Families and Well-Settled Individuals from all Castes and Professions in Pakistan and Abroad.</p>
        <a href="./" class='cta' onclick="scroll_to_element('proposals', event)">View Proposals</a>
        <div class="goto" onclick="scroll_to_element('proposals', event)">
            <img src="./assets/svg/down-arrow-3.svg" alt="Down Arrow">
        </div>
    </div>
</div>

<style>
    a {
        cursor: pointer;
    }
</style>


<!-- Quick Search -->
<div class='quick-search-section'>
    <div class='quick-search-inner'>
        <div class='row'>
            <div class='heading'>Search for Rishta in Pakistan</div>
        </div>
        <div class='row'>
            <div class='cities'>
                <div class='row-title'>
                    Cities
                </div>
                <div class='links-row'>
                    <a onclick="filter_by_city(event, '1', 'Karachi')">Karachi Rishta</a>
                    <a onclick="filter_by_city(event, '1', 'Lahore')">Lahore Rishta</a>
                    <a onclick="filter_by_city(event, '1', 'Islamabad')">Islamabad Rishta</a>
                    <a onclick="filter_by_city(event, '1', 'Faisalabad')">Faisalabad Rishta</a>
                    <a onclick="filter_by_city(event, '1', 'Peshawar')">Peshawar Se Rishta</a>
                    <a onclick="filter_by_city(event, '1', 'Gujranwala')">Gujranwala</a>
                    <a onclick="filter_by_city(event, '1', 'Multan')">Rishta Multan </a>
                    <a onclick="filter_by_city(event, '1', 'Sargodha')">Sargodha Rishta</a>
                </div>
            </div>
        </div>
        <div class='row'>
            <div class='categories'>
                <div class='row-title'>
                    Categories
                </div>
                <div class='links-row'>
                    <a onclick="filter_by_marital_status_gender_occupation(event, '1', 'Never Married', 'Male', 'Any')">Male Single</a>
                    <a onclick="filter_by_marital_status_gender_occupation(event, '1', 'Never Married', 'Female', 'Any')">Female Single</a>
                    <a onclick="filter_by_marital_status_gender_occupation(event, '1', 'divorced', 'Male', 'Any')">Male Divorced Rishta</a>
                    <a onclick="filter_by_marital_status_gender_occupation(event, '1', 'divorced', 'Female', 'Any')">Female Divorced Rishta</a>
                    <a onclick="filter_by_marital_status_gender_occupation(event, '1', 'widowed', 'Any', 'Any')">Widowed</a>
                    <a onclick="filter_by_marital_status_gender_occupation(event, '1', 'separated', 'Any', 'Any')">Separated</a>
                    <a onclick="filter_by_marital_status_gender_occupation(event, '1', 'Any', 'Any', 'Doctor')">Doctor Rishta</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php      
    }
?>

<style>
    #timer-wrapper {
        font-size: 15px;
        margin-bottom: 10px;
    }
    #timer {
        color: #000;
        /* font-weight: 600; */
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
        position: static;
        margin: 50px auto;
        /* height: 455px; */
        /* display: flex;
        align-items: center;
        justify-content: center; */
        /* position: fixed;
        top: 300px;
        left: 50%; 
        z-index: 100;
        margin-left: -219px; */
        border-radius: 21px;
        background: #FFFFFF;
        /* box-shadow: 0px 2px 10px 0px #00000026; */
        text-align: center;
        
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
    form.verify-code input {
        color: #000000;
        border: 2px solid #ADADAD;
        padding: 10px 20px;
        radius: 7px;
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
    form.verify-code div.submit {
        padding: 10px 20px;
        border-radius: 7px;
        background: #FFB600;
        color: #0E0E0E;
        width: 100%;
        cursor: pointer;
        transition: .4s;
    }
    form.verify-code div.submit:hover {
        background: #ffc73c;
    }
    .popup .icon {
        width: 65px;
        height: 65px;
        margin: 0 auto 10px auto;
    }
    @media screen and (max-width: 768px) {
        .popup {
            max-width: 90%;
            padding: 30px;
        }
    }
</style>


<style>
    #msg-response > div.alert-success {
        color: #14A44D;
        border: 1px solid #14A44D;
        background: #eafff2;
    }
</style>

<?php
if(isset($_SESSION['user'])) {
    // var_dump($_SESSION['user']);
    $user = new User;
    $account_status = $user->get_account_status();
    // $account_status = 'Not Approved';
    if($account_status == 'Not Approved') {
        $email = $user->get_user_email();
?>

    <input type="hidden" name='remaining' id='remaining' value=''>



    <div class='popup' id='post-register-popup'>
        <div class='popup-inner-div'>
            <div class='icon'>
                <img src="./assets/svg/email-confirmation-icon.svg" alt="Email confirmation icon">
            </div>
            <div class='popup-title'>Email Confirmation</div>
            <div class='popup-subtitle'>
                <p>We have Sent a Code at your Email</p>
                <p><?= $email; ?></p>
            </div>
            <form id="verify-code" class="verify-code" method='POST'>
                <input type="hidden" name='verify_email' id='verify_email' value='true'>
                <div class="form-group">
                    <label for="code"></label>
                    <input class="code" type="number" id="code" name="code" placeholder="Enter code" autocomplete="off">
                    <div class='error' id='codeError'></div>
                </div>
                <div class="form-group">
                    <div onclick='verify_email(event)' class="submit">Submit</div>
                </div>
            </form>
            <div class='not-recieved'>Not Received?</div>
            <!-- Timer -->
            <div id='timer-wrapper' style="display: none;">
                <span>Time remaining: </span>
                <span id="timer"></span>
                <span>seconds</span>
            </div>
            <!-- Resend -->
            <div class='resend-link'>
                <div id='submitButton'>Resend Code</div>
            </div>
            <div id='msg-response'></div>
        </div>
    </div>
<?php
    }
?>


<?php
    // var_dump($_SESSION['user']);
    $user = new User;
    $account_status = $user->get_account_status();
    $payment_status = $user->get_payment_status();
    $basket_id = $user->get_basket_id();
    $order_date = $user->get_order_date($basket_id);
    // $account_status = 'Not Approved';

    // var_dump($_SESSION);
    

    if($account_status == 'Under Verification' && $payment_status != 'success') {
        $email = $user->get_user_email();
?>


    <div class='popup' id='post-register-popup'>
        <div class='popup-inner-div'>
            <!-- <div class='icon'>
                <img src="./assets/svg/email-confirmation-icon.svg" alt="Email confirmation icon">
            </div> -->
            <div class='popup-title'>Become a Member</div>
            <div class='popup-subtitle' style='margin-bottom: 20px;'>
                <p>To have Full Access & View Contact Numbers</p>
            </div>
            
            <div class='form-card-footer'>
                <div class='form-card-btns'>
                    <a href='./payment' style='
                        display: block;
                        color: #000;
                        background: #FFB600;
                        border: 1px solid #FFB600;
                        font-size: 16px;
                        padding: 12px 0;
                        text-align: center;
                        border-radius: 8px;
                        cursor: pointer;
                        margin: 0 auto;
                        font-weight: 600;
                        width: 200px;' class='formSubmit packageSubmit'>Become a Member</a>
                </div>
            </div>
        </div>
    </div>



<?php
    } else if ($order_date != '') {
        $hasYearDifference = hasYearDifference($tz='Asia/Karachi');
        if($hasYearDifference == true) {
?>



<div class='popup' id='post-register-popup'>
    <div class='popup-inner-div'>
        <!-- <div class='icon'>
            <img src="./assets/svg/email-confirmation-icon.svg" alt="Email confirmation icon">
        </div> -->
        <div class='popup-title'>Update your subscription</div>
        <div class='popup-subtitle' style='margin-bottom: 20px;'>
            <p>Update your yearly subscription to have full access & view contact numbers</p>
        </div>
        
        <div class='form-card-footer'>
            <div class='form-card-btns'>
                <a href='./payment' style='
                display: block;
                color: #000;
                background: #FFB600;
                border: 1px solid #FFB600;
                font-size: 16px;
                padding: 12px 0;
                text-align: center;
                border-radius: 8px;
                cursor: pointer;
                margin: 0 auto;
                font-weight: 600;
                width: 200px;' class='formSubmit packageSubmit'>Update Subscription</a>
            </div>
        </div>
    </div>
</div>

<?php     
        }
    }
?>


<?php



if($account_status == 'Under Verification' && $payment_status == 'success' && $order_date != '') {
        
?>
    <div class='popup' id='post-register-popup'>
        <div class='popup-inner-div'>
            <div class='icon'>
                <img src="./assets/svg/under-verification.svg" alt="Under Verification">
            </div>
            <div class='popup-title'>Under Verification</div>
            <div class='popup-subtitle'>
                <p>Please wait.. Our Team is Reviewing Your Account</p>
            </div>
        </div>
    </div>

<?php
    }
}
?>


<!-- Proposals -->
<style>
    .proposals-label {
        display: block;
        max-width: 80px;
        border-radius: 5px;
        margin-bottom: 10px;
        font-size: 15px; 
        color: #fff;
        background: #1B68FF;
        padding: 8px 10px;
        text-align: center;
    }
    .mb {
        display: none;
    } 
    @media screen and (max-width: 1280px) {    
        #filter {
            display: none;
        }
        #filter.active {
            display: flex;
        }
        .dsk {
            display: none;
        }
        .mb {
            display: block;
        }
    }
</style>

<!-- Bookmarks -->
<style>
    .proposal-contact-col {
        cursor: pointer;
    }
</style>

<div id='content-wrapper'>
    <div class='main'>
        <?php 
            include './proposals.php'; 
        ?>
    </div>
</div>

<?php
    if(!isset($_SESSION['user'])) {
?>


<!-- HOW IT WORKS -->
<div class='how-it-works'>
    <div class='section-head'>
        <div class='title'>
            <h2>Follow these 3-Steps</h2>
        </div>
        <div class='subtitle'>
            <p>And Find your Perfect Match Today</p>
        </div>
    </div>
    <div class='section-body'>
        <div class='section-items'>
            <div class='section-item'>
                <div class='icon'>
                    <img src='./assets/svg/create-profile.svg' alt='Create Profile' />
                </div>
                <div class='item-title'>
                    Create Profile
                </div>
                <div class='item-description'>
                    Register a Genuine Rishta Profile with Real WhatsApp Number and Photo.
                </div>
            </div>
            <div class='section-item'>
                <div class='icon'>
                    <img src='./assets/svg/view-rishta.svg' alt='View Rishta' />
                </div>
                <div class='item-title'>
                    Find Rishta
                </div>
                <div class='item-description'>
                    Find Online Pakistani Rishta and Marriage Proposals from Abroad with Ease.
                </div>
            </div>
            <div class='section-item'>
                <div class='icon'>
                    <img src='./assets/svg/whatsapp-contact.svg' alt='Whatsapp Contact' />
                </div>
                <div class='item-title'>
                    WhatsApp Contact
                </div>
                <div class='item-description'>
                    View Phone number of people and contact them directly, no third party involved.
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Banner -->
<div class='banner'>
    <div class='inner-div'>
        <div class='banner-text'>
            <div>
                <h2>Find your Partner Today</h2>
                <p>Create your profile & start getting calls</p>
            </div>
            <div class='banner-photo-mobile'>
                <img src="./assets/img/middle-banner-photo.webp?v=2" alt="Find your Partner">
            </div>
            <div class='cta-row'>
                <a href="./registration" class='cta'>Register Now!</a>
                <a href="./login" class='cta cta-login'>Log In</a>
            </div>
        </div>
        <div class='banner-photo'>
            <img src="./assets/img/middle-banner-photo.webp?v=2" alt="Find your Partner">
        </div>
    </div>
</div>




<!-- Cities -->
<?php
    // Array of cities in each column

    // First Column
    $column1 = array(
        "Abbottabad", "Ahmedpur East", "Arif Wala", "Attock", "Badin", "Bahawalnagar", "Bahawalpur", "Bhakkar", "Bhalwal", "Burewala", "Chakwal", "Chaman", "Charsadda"
    );
    // Second Column
    $column2 = array( 
        "Chiniot", "Chishtian", "Dadu", "Daharki", "Daska", "Dera Ghazi Khan", "Dera Ismail Khan", "Faisalabad", "Ferozwala", "Ghotki", "Gojra", "Gujranwala", "Gujranwala Cantonment"
    );
    // Third Column
    $column3 = array( 
        "Gujrat", "Gwadar", "Hafizabad", "Haroonabad", "Hasilpur", "Hub", "Hyderabad", "Islamabad", "Jacobabad", "Jaranwala", "Jatoi", "Jhang", "Jhelum"
    );
    // Fourth Column
    $column4 = array(
        "Kabal", "Kamalia", "Kamber Ali Khan", "Kāmoke", "Kandhkot", "Karachi", "Kasur", "Khairpur", "Khanewal", "Khanpur", "Khushab", "Khuzdar", "Kohat"
    );
    // Fifth Column
    $column5 = array( 
        "Kot Abdul Malik", "Kot Addu", "Kotri", "Lahore", "Larkana", "Layyah", "Lodhran", "Mandi Bahauddin", "Mansehra", "Mardan", "Mianwali", "Mingora", "Mirpur"
    );
    // Sixth Column
    $column6 = array( 
        "Mirpur Khas", "Mirpur Mathelo", "Multan", "Muridke", "Muzaffarabad", "Muzaffargarh", "Narowal", "Nawabshah", "Nowshera", "Okara", "Pakpattan", "Peshawar", "Quetta"
    );
    // Seventh Column
    $column7 = array( 
        "Rahim Yar Khan", "Rawalpindi", "Sadiqabad", "Sahiwal", "Sambrial", "Samundri", "Sargodha", "Shahdadkot", "Sheikhupura", "Shikarpur", "Sialkot", "Sukkur", "Swabi"
    );
    // Eighth Column
    $column8 = array( 
        "Tando Adam", "Tando Allahyar", "Tando Muhammad Khan", "Taxila", "Turbat", "Umerkot", "Vehari", "Wah Cantonment", "Wazirabad"
    );

    // Loop through each column and echo out the HTML code for each city
    $columns = array($column1, $column2, $column3, $column4, $column5, $column6, $column7, $column8);

?>



<div class='cities-section'>
    <div class='inner-div'>
        <h2>Proposals by Cities</h2>
        <div class='row-title'>
            Single Male Rishta, Divorced Female Marriage Proposals from:
        </div>
        <div class='cities-row'>
            <?php
                foreach ($columns as $column) {
                    $columnStr = "<div class='cities-column'>";
                    foreach ($column as $city) {
                        $columnStr .= "
                            <div class='col-item'>
                                <a onclick=\"filter_by_city(event, '1', '$city')\">
                                    $city
                                </a>
                            </div>";
                    }
                    $columnStr .= "</div>";
                    echo $columnStr;
                }
            ?>
        </div>
    </div>
</div>



<?php
    }
?>



<!-- Include the JavaScript code here -->
<script defer>
    // Function to set the cookie with the current timestamp
    function setCookie(name, value, days) {
        const now = new Date();
        now.setTime(now.getTime() + days * 24 * 60 * 60 * 1000);
        const expires = `expires=${now.toUTCString()}`;
        document.cookie = `${name}=${value}; ${expires}; path=/`;
    }

    // Function to get the cookie value
    function getCookie(name) {
        const cookies = document.cookie.split(';');
        for (let i = 0; i < cookies.length; i++) {
            const cookie = cookies[i].trim();
            if (cookie.startsWith(name + '=')) {
                return cookie.substring(name.length + 1);
            }
        }
        return null;
    }

    // Function to clear the cookie
    function clearCookie(name) {
        document.cookie = `${name}=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;`;
    }

    // Function to start the timer
    function startTimer(seconds) {
        const timerWrapper = document.getElementById("timer-wrapper");
        timerWrapper.style.display = "block";
        const timerElement = document.getElementById("timer");
        const msgResponseElement = document.getElementById("msg-response");

        // Clear the #msg-response content when the timer starts
        msgResponseElement.innerHTML = "";

        let remainingSeconds = seconds;


        function updateTimer() {
            if (remainingSeconds > 0) {
                timerElement.textContent = `${remainingSeconds}`;
                remainingSeconds--;
                if(remainingSeconds) {
                    document.getElementById("remaining").value = remainingSeconds;
                }
                setTimeout(updateTimer, 1000); // Update every 1 second    
            } else {
                if(timerElement.textContent == '1') { 
                    timerWrapper.style.display = "none";
                }
                clearCookie("timerCookie");
                document.getElementById("submitButton").disabled = false;
            }
        }

        updateTimer();


    }



    var account_status = "<?= $account_status; ?>";
    if(account_status == 'Not Approved') {
        // clearCookie("timerCookie");
        // clearCookie("pageLoadCookie");
        const pageLoadCookie = getCookie("pageLoadCookie");
        if (!pageLoadCookie) {
            const currentTime = new Date().getTime();
            setCookie("pageLoadCookie", currentTime, 1);
            
            // // Set the cookie on page load if it doesn't exist
            // const timerCookie = getCookie("timerCookie");
            // if (!timerCookie) {
            setCookie("timerCookie", currentTime, 1);
            // }

            const previousClickTime = getCookie("timerCookie");

            if (previousClickTime) {
                const currentTime = new Date().getTime();
                const timeDifference = currentTime - parseInt(previousClickTime);
                
                if (timeDifference < 60000) { // 60 seconds
                    const remainingTime = Math.ceil((60000 - timeDifference) / 1000);
                    startTimer(remainingTime);
                    if(remainingTime) {
                        document.getElementById("remaining").value = remainingTime;
                    }
                    document.getElementById("submitButton").disabled = true;
                } else {
                    setCookie("timerCookie", currentTime, 1);
                    resend_code(event);
                }
            }
            document.getElementById("remaining").value = 60;
            console.log(getCookie("pageLoadCookie"));
        }
    } else {
        clearCookie("timerCookie");
        clearCookie("pageLoadCookie");
        console.log('No account status found');
    }
    function resend_code(event) {
        event.preventDefault();
        var formData = new FormData();

        var remaining = $('#remaining').val();

        formData.append('resend_code', 'true');
        formData.append('remaining', remaining);

        fetch('./controllers/registration-handler', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            return response.text();
        })
        .then(response => {
            console.log(response);
            if ($.trim(response) == '1') {
                const timerWrapper = document.getElementById("timer-wrapper");
                timerWrapper.style.display = "none";
                $('#msg-response').html("<div class='alert alert-success alert-dismissible' role='alert'><div class='alert-message'><strong>Success!</strong> New code was sent!</div></div>");
            } else if ($.trim(response) == '2') {
                console.log('Timer running');
                // $('#msg-response').html("<div class='alert alert-danger alert-dismissible' role='alert'><div class='alert-message'><strong>Error!</strong> Failed to send code!</div></div>");
            } else {
                $('#msg-response').html("<div class='alert alert-danger alert-dismissible' role='alert'><div class='alert-message'><strong>Error!</strong> Failed to send code!</div></div>");
            }
        })
        .catch(err => console.log(err));
    }
    if(typeof(document.getElementById("submitButton")) && document.getElementById("submitButton") != null) {
        document.getElementById("submitButton").addEventListener("click", function (event) {
            event.preventDefault();
            const previousClickTime = getCookie("timerCookie");
    
            if (previousClickTime) {
                const currentTime = new Date().getTime();
                const timeDifference = currentTime - parseInt(previousClickTime);
                
                if (timeDifference < 60000) { // 60 seconds
                    const remainingTime = Math.ceil((60000 - timeDifference) / 1000);
                    startTimer(remainingTime);
                    if(remainingTime) {
                        document.getElementById("remaining").value = remainingTime;
                    }
                    document.getElementById("submitButton").disabled = true;
                } else {
                    setCookie("timerCookie", currentTime, 1);
                    resend_code(event);
                }
            } else {
                const currentTime = new Date().getTime();
                setCookie("timerCookie", currentTime, 1);
                resend_code(event);
                document.getElementById("remaining").value = 60;
            }
        });
    }
</script>





<script defer>
    function dropFilter() {
        var mobileFilter = document.querySelector('.proposals-head-row2 #filter');
        if(!mobileFilter.classList.contains('active')) {
            mobileFilter.classList.add('active');
            return;
        } else {
            mobileFilter.classList.remove('active');
            return;
        }
    }
    function verify_email(event) {
        event.preventDefault();
        var formData = new FormData();

        const code = $('#code').val();

        formData.append('code', code);
        formData.append('verify_email', 'true');

        if (code) {
            fetch('./controllers/registration-handler', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                return response.text();
            })
            .then(response => {
                console.log(response);
                if ($.trim(response) == '1') {
                    setTimeout(() => {
                        window.location.href = './';
                    }, 500);
                    // $('#msg-response').html("<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><div class='alert-message'><strong>Success!</strong> New FAQ created!</div></div>");
                } else {
                    $('#msg-response').html("<div class='alert alert-danger alert-dismissible' role='alert'><div class='alert-message'><strong>Error!</strong> Incorrect Code!</div></div>");
                }
            })
            .catch(err => console.log(err));
        } else {
            $('#code').addClass('invalid');
            $('#codeError').html('<div>Code cannot be blank</div>');
        }
    }

</script>


<script defer>
    function bookmark(id) {
        var formData = new FormData();
        if (id) {
            formData.append('profile_id', id);
            formData.append('bookmark', 'true');

            fetch('./controllers/bookmark-handler', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                return response.text();
            })
            .then(response => {
                // console.log(response);
                if ($.trim(response) == '1') {
                    $('.bookmark-filled-' + id).css({ 'display': 'block' });
                    $('.bookmark-'+id).css({ 'display': 'none' });
                } else {
                    console.log(response);
                    $('.bookmark-filled-'+id).css({ 'display': 'none' });
                    $('.bookmark-'+id).css({ 'display': 'block' });
                }
            })
            .catch(err => console.log(err));
        } else {
            $('#code').addClass('invalid');
            $('#codeError').html('<div>Code cannot be blank</div>');
        }
    }
    function redirect_to_register() {
        window.location.href = './registration';
    }


</script>


<?php
    if(isset($_SESSION['user'])) {
        // var_dump($_SESSION['user']);
?>
        <script>
            var slideOuterWrapper = document.getElementById('slider-outer-wrapper');
            if(slideOuterWrapper) {
                slideOuterWrapper.style.display = 'none'
            }
        </script>
<?php
    }
?>



<?php include './partials/footer.php'; ?>