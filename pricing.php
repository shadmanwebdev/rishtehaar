<?php include './partials/header.php'; ?>
<?php include './partials/navigation.php'; ?>

<style>
    .booking-wrapper {
        width: 100%;
        margin: 20px auto 50px auto;
        display: flex;
        flex-flow: column nowrap;
        row-gap: 60px;
        align-items: center;
        justify-content: center;
    }
    .booking_header {
        text-align: center;
        width: 500px;
        display: flex;
        flex-flow: column nowrap;
        row-gap: 20px;
    }
    .booking_page-heading {
        font-size: 40px;
        letter-spacing: 0;
        color: var(--color8);
        
    }
    .booking_text {
        font-size: 18px;
        line-height: 1;
        color: var(--color7);
    }
    .plans {
        width: 100%;
        display: flex;
        flex-flow: row nowrap;
        column-gap: 20px;
    }
    .pricing_plan {
        border: 2px solid #B2AFAF;
        border-radius: 20px;
        padding: 50px 0 50px 0;
        background-color: rgb(246,246,246);
        display: flex;
        flex-flow: column nowrap;
        justify-content: center;
        row-gap: 50px;
        width: 300px;
    }
    .pricing_plan.pricing_plan_2 {
        background-color: rgb(254,124,0);
        color: #fff;
    }
    .plan_header {
        display: flex;
        flex-flow: column nowrap;
        row-gap: 10px;
        text-align: center;
    }
    .pricing_plan-heading {
        font-size: 30px;
        line-height: 1;
    }
    .pricing_plan-subheading {
        font-size: 20px;
        line-height: 1;
    }
    .plan_body {
        display: flex;
        flex-flow: column nowrap;
        row-gap: 12px;
        justify-content: center;
        width: 170px;
        margin: 0 auto;
    }
    p.plan-info {
        font-size: 18px;
        line-height: 1;
        color: #303030;
        display: flex;
        flex-flow: row nowrap;
        align-items: center;
        column-gap: 8px;
        margin-left: -3px;
    }
    .pricing_plan.pricing_plan_2 p.plan-info  {
        color: #fff;
    }
    p.plan-info:before {
        content: '\f418';
        color: #959595;
        font-size: 25px;
        font-family: 'Genericons';
        display: grid;
    }
    .pricing_plan.pricing_plan_2 p.plan-info:before {
        color: #fff;
    }
    .plan_footer {
        text-align: center;
    }
    .price {
        font-size: 30px;
        line-height: 1;
        text-align: center;
    }


    .save-info-all {
        display: flex;
        flex-flow: row nowrap;
        justify-content: center;
        column-gap: 30px;
    }
    .save-info-wrapper {
        width: 300px;
        display: flex;
        justify-content: center;
    }
    .save-info {
        margin-top: -10px;
        width: 150px;
        background-color: rgb(42,42,42);
        color: rgb(228,228,228);
        font-size: 15px;
        padding: 8px 10px;
        text-align: center;
    }
    .save-info-wrapper:nth-child(1) .save-info {
        display: none;
    }
    @media screen and (max-width: 1560px) {
        .booking-wrapper {
            width: 100%;
            margin: 20px auto 50px auto;
            row-gap: 30px;
        }
        .booking_header {
            width: 400px;
            row-gap: 15px;
        }
        .booking_page-heading {
            font-size: 30px;
        }
        .booking_text {
            font-size: 15px;
        }
        .plans {
            width: 100%;
            column-gap: 15px;
        }
        .pricing_plan {
            border-radius: 15px;
            padding: 40px 0 40px 0;
            row-gap: 30px;
            width: 260px;
        }
        .plan_header {
            row-gap: 10px;
        }
        .pricing_plan-heading {
            font-size: 25px;
            line-height: 1;
        }
        .pricing_plan-subheading {
            font-size: 18px;
            line-height: 1;
        }
        .plan_body {
            row-gap: 10px;
            width: 150px;
            margin: 0 auto;
        }
        p.plan-info {
            font-size: 15px;
            line-height: 1;
            column-gap: 8px;
            margin-left: -3px;
            margin-bottom: 0;
        }
        p.plan-info:before {
            font-size: 20px;
        }
        .price {
            font-size: 25px;
        }
        .save-info-all {
            column-gap: 20px;
        }
        .save-info-wrapper {
            width: 260px;
        }
        .save-info {
            margin-top: -10px;
            width: 130px;
            color: rgb(228,228,228);
            font-size: 12px;
            padding: 6px 10px;
        }
    }
    @media screen and (max-width: 600px) {
        .booking_header {
            width: 90%;
        }
        .booking_page-heading {
            font-size: 30px;
        }
        .booking_text {
            font-size: 16px;
            line-height: 2;
            padding: 0 20px;
        }
        .plans {
            width: 100%;
            display: flex;
            flex-flow: column nowrap;
            row-gap: 20px;
        }
        .save-info-all {
            margin-top: -30px;
            display: flex;
            flex-flow: column nowrap;
            justify-content: center;
        }
    }
</style>

<style>
    .pricing-page-wrapper {
        max-width: 1100px;
        margin: 50px auto;
        letter-spacing: .3px;
    }
    .pricing-card {
        width: auto;
        /* height: 366px; */
        border-radius: 17px;
        border: 1px solid #B5B5B5;
        background: #FFFFFF;
        display: flex;
        flex-flow: row nowrap;
    }
    .pricing-card .col-30 {
        width: 35%;
        padding: 50px 50px;
        height: 100%;
    }
    .pricing-card .col-70 {
        width: 65%;
        height: 100%;
        padding: 50px 50px;
        border-left: 1px solid #B5B5B5;
    }
    .amount {   
        font-size: 45px;
        font-weight: 600;
        line-height: 1.5;
        text-align: right;
        color: #000000;
    }
    .currency {
        font-size: 18px;
        font-weight: 600;
        line-height: 25px;
        letter-spacing: 0em;
        text-align: center;
        color: #00863E;
    }
    .main-feature {
        font-size: 18px;
        font-weight: 400;
        line-height: 1.5;
        margin-bottom: 20px;
        letter-spacing: 0em;
        text-align: center;

    }
    a.become-member-btn {
        font-size: 16px;
        width: 240px;
        height: 50px;
        border-radius: 9px;
        background: #00863E;
        color: #FFFFFF;
        border: none;
        outline: none;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
    }

    .pricing-title {
        font-size: 25px;
        font-weight: 700;
        line-height: 35px;
        letter-spacing: 0em;
        margin-bottom: 15px;
        text-align: left;
        color: #000000;
    }
    .pricing-subtitle {
        font-size: 18px;
        font-weight: 400;
        line-height: 23px;
        letter-spacing: 0em;
        text-align: left;
        color: #4A4A4A;
        margin-bottom: 45px;
    }
    .become-member-btn-wrapper {
        display: flex;
        justify-content: center;
    }
    .features-row {
        display: flex;
        flex-flow: row nowrap;
    }
    .features-column:first-child {
        margin-right: 60px;
    }
    .feature {
        display: flex;
        flex-flow: row nowrap;
        margin-bottom: 15px;
        color: #000000;
        font-family: 'Roboto', sans-serif;
        font-size: 16px;
        font-weight: 400;
        line-height: 1.5;
        text-align: left;

    }
    .feature img {
        margin-right: 10px;
    }
    /* Terms & Conditions */
    .terms-and-conditions {
        margin: 80px 0;
    }
    .terms-and-conditions h3 {
        font-size: 18px;
        font-weight: 600;
        line-height: 30px;
        letter-spacing: 0em;
        text-align: left;
        color: #000000;

        margin-bottom: 20px;
        letter-spacing: 1.5px;
    }
    .terms-and-conditions ul {
        list-style: disc;
    }
    .terms-and-conditions ul li {
        margin-left: 30px;
        margin-bottom: 10px;
    }
    .terms-and-conditions p, 
    .terms-and-conditions li {
        font-size: 14px;
        font-weight: 400;
        line-height: 25px;
        letter-spacing: 0em;
        text-align: left;
        color: #5F5F5F;
        letter-spacing: .7px;
    }
    .terms-and-conditions li span.darker {
        color: #000000;
    }
    @media screen and (max-width: 1280px) {
        .pricing-page-wrapper {
            max-width: 800px;
        }
        .pricing-card {
            max-width: 800px;
            display: flex;
            flex-flow: row nowrap;
            align-items: center;
            margin: 0 auto;
        }
        .pricing-card {
            display: flex;
            flex-flow: column nowrap;
            align-items: center;
        }
        .pricing-card .col-30 {
            width: 100%;
            padding: 50px 50px 0 50px;
        }
        .pricing-card .col-70 {
            width: 100%;
            padding: 40px 50px 50px 50px;
        }
        .features-row {
            display: flex;
            flex-flow: column nowrap;
        }
        .features-column:first-child {
            margin-right: 0px;
        }
        .pricing-subtitle {
            font-size: 16px;
            line-height: 1.5;
            margin-bottom: 25px;
        }
    }
    @media screen and (max-width: 768px) {
        .page-wrapper {
            width: 95%;
        }
        .pricing-card .col-30 {
            padding: 40px 40px 40px 40px;
        }
        .pricing-card .col-70 {
            padding: 0px 40px 40px 40px;
        }
    }
    @media screen and (max-width: 576px) {
        /* .page-wrapper {
            width: 100%;
        } */
        .pricing-card .col-30 {
            padding: 30px 30px 30px 30px;
        }
        .pricing-card .col-70 {
            padding: 0px 30px 30px 30px;
        }
    }
</style>

<?php
    $pricing = new Pricing();
    $price = $pricing->get_price();
?>

<div class='page-wrapper pricing-page-wrapper'>

    <div class='pricing-card'>
        <div class='col-30'>
            <div class='price'>
                <span class='amount'><?= $price; ?></span>
                <span class='currency'>PKR</span>
            </div>
            <div class='main-feature'>
                For 1 Year Membership
            </div>
            <div class='become-member-btn-wrapper'>
                <a class='become-member-btn' href='./registration'>
                    Become a Member
                </a>
            </div>
        </div>
        <div class='col-70'>
            <div class='pricing-title'>
                Find Your Perfect Match with Exclusive Benefits
            </div>
            <div class='pricing-subtitle'>
                Connect Directly and Seamlessly with Your Future Life Partner
            </div>
            <div class='pricing-features'>    
                <div class='features-row'>
                    <div class='features-column'>
                        <div class='feature'>
                            <img src='assets/svg/check.svg' alt='Check' />
                            <span>Full 1 Year Access</span>
                        </div>
                        <div class='feature'>
                            <img src='assets/svg/check.svg' alt='Check' />
                            <span>View Unlimited Contacts</span>
                        </div>
                    </div>
                    <div class='features-column'>
                        <div class='feature'>
                            <img src='assets/svg/check.svg' alt='Check' />
                            <span>Customer Support</span>
                        </div>
                        <div class='feature'>
                            <img src='assets/svg/check.svg' alt='Check' />
                            <span>No hidden Fees</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class='terms-and-conditions'>
        <h3>Terms & Conditions Applied</h3>
        <ul>
            <li><span class='darker'>Non-Refundable Fee:</span> Payments made for our services are non-refundable.</li>
            <li><span class='darker'>Non-Exchangeable Fee:</span> The fees paid for our services are non-exchangeable.</li>
            <li><span class='darker'>Account Ownership:</span> Account ownership is non-transferable, and sharing login credentials with others is at your discretion.</li>
            <li><span class='darker'>Termination of Accounts:</span> Rishtehaar.com reserves the right to suspend any account at any time if suspicious or unethical behavior is observed or reported.</li>
            <li><span class='darker'>Online Payments Only:</span> We exclusively accept online payments through our website. We do not accept payments offline, whether in cash or by check. All subscriptions must be purchased through our website.</li>
            <li><span class='darker'>Disclaimer of Responsibility:</span> While we facilitate connections and interactions, we do not guarantee the accuracy, completeness, or suitability of the information provided by users. Users are responsible for their interactions and decisions.</li>
            <li><span class='darker'>Subscription Renewal:</span> Upon the expiration of your subscription term, you will need to renew your membership or create a new account to continue accessing our services</li>
            <li><span class='darker'>Intellectual Property:</span> All content and materials on our website, unless otherwise stated, are the intellectual property of Rishtehaar.com and may not be used, copied, or reproduced without permission. In the event of a violation of these intellectual property rights, legal action will be taken in accordance with applicable government laws.</li>
            <li><span class='darker'>Changes to Terms and Conditions:</span> We reserve the right to update or modify these terms and conditions at any time. Users will be notified of changes, and continued use of our platform implies acceptance of the updated terms.</li>
        </ul>  
    </div>
    
</div>




<?php include './partials/footer.php'; ?>