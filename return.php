<?php 
    if(!isset($_SESSION)) { 
        ob_start();
        session_start(); 
        
    }

    error_reporting(E_ALL);
    ini_set("display_errors","On");

    include './partials/functions.php';
    include './Classes/Db.php';
    include './Classes/User.php';
    include './Classes/PayfastPayment.php';

?>

<?php

// Get values from the query parameters
$errCode = isset($_GET['err_code']) ? $_GET['err_code'] : '';
$errMsg = isset($_GET['err_msg']) ? $_GET['err_msg'] : '';
$transactionId = isset($_GET['transaction_id']) ? $_GET['transaction_id'] : '';
$basketId = isset($_GET['basket_id']) ? $_GET['basket_id'] : '';
$orderDate = isset($_GET['order_date']) ? $_GET['order_date'] : '';
$rdvMessageKey = isset($_GET['Rdv_Message_Key']) ? $_GET['Rdv_Message_Key'] : '';
$responseKey = isset($_GET['Response_Key']) ? $_GET['Response_Key'] : '';
$validationHash = isset($_GET['validation_hash']) ? $_GET['validation_hash'] : '';
$transactionAmount = isset($_GET['transaction_amount']) ? $_GET['transaction_amount'] : '';
$merchantAmount = isset($_GET['merchant_amount']) ? $_GET['merchant_amount'] : '';
$discountedAmount = isset($_GET['discounted_amount']) ? $_GET['discounted_amount'] : '';
$issuerName = isset($_GET['issuer_name']) ? $_GET['issuer_name'] : '';
$transactionCurrency = isset($_GET['transaction_currency']) ? $_GET['transaction_currency'] : '';
$paymentType = isset($_GET['PaymentType']) ? $_GET['PaymentType'] : '';
$paymentName = isset($_GET['PaymentName']) ? $_GET['PaymentName'] : '';
$billNumber = isset($_GET['BillNumber']) ? $_GET['BillNumber'] : '';
$customerId = isset($_GET['CustomerId']) ? $_GET['CustomerId'] : '';
$recurringTxn = isset($_GET['Recurring_txn']) ? $_GET['Recurring_txn'] : '';
$additionalValue = isset($_GET['additional_value']) ? $_GET['additional_value'] : '';
$additionalFee = isset($_GET['additional_fee']) ? $_GET['additional_fee'] : '';

// Now you can use these variables as needed in your PHP code

// For example, you can print them to check the values
// echo "errCode: $errCode<br>";
// echo "errMsg: $errMsg<br>";
// echo "transactionId: $transactionId<br>";
// echo "basketId: $basketId<br>";
// echo "orderDate: $orderDate<br>";
// echo "rdvMessageKey: $rdvMessageKey<br>";
// echo "responseKey: $responseKey<br>";
// echo "validationHash: $validationHash<br>";
// echo "transactionAmount: $transactionAmount<br>";
// echo "merchantAmount: $merchantAmount<br>";
// echo "discountedAmount: $discountedAmount<br>";
// echo "issuerName: $issuerName<br>";
// echo "transactionCurrency: $transactionCurrency<br>";
// echo "paymentType: $paymentType<br>";
// echo "paymentName: $paymentName<br>";
// echo "billNumber: $billNumber<br>";
// echo "customerId: $customerId<br>";
// echo "recurringTxn: $recurringTxn<br>";
// echo "additionalValue: $additionalValue<br>";
// echo "additionalFee: $additionalFee<br>";

// $paymentStatus = $_GET['status'];

// $pp = new PayfastPayment;
// $pp->update_database_by_basket_id($basketId, $transactionId, $customerId, $paymentStatus, $transactionAmount, $merchantAmount, $transactionCurrency, $orderDate, $errCode, $errMsg);
// $pp->response_message($errCode, $transactionAmount, $basketId, $transactionId, $rdvMessageKey);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&family=Roboto:ital@0;1&display=swap" rel="stylesheet">
    <title>Rishtehaar</title>

</head>
<body>

    <style>
        #reset-success {
            padding: 50px;
            max-width: 438px;
            position: static;
            margin: 100px auto;
            border-radius: 21px;
            background: #FFFFFF;
            box-shadow: 0px 2px 10px 0px #00000026;
            text-align: center;
            font-family: Poppins, sans-serif;
        }
        #reset-success .popup-title {  
            font-size: 23px;
            font-weight: 500;
            line-height: 30px;
            letter-spacing: 0em;
            text-align: center;
            color: #000;
            margin-bottom: 20px;
            font-weight: 600;
        }
        #reset-success .popup-subtitle {
            margin: 10px 0;
        }
        #reset-success form.verify-code input {
            color: #ADADAD;
            border: 2px solid #ADADAD;
            padding: 10px 20px;
            radius: 7px;
        }
        #reset-success input::-webkit-outer-spin-button,
        #reset-success input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        #reset-success input[type=number] {
            -moz-appearance: textfield;
        }
        #reset-success form.verify-code .form-group {
            display: flex;
        }
        #reset-success form.verify-code div.submit {
            padding: 10px 20px;
            border-radius: 7px;
            background: #FFB600;
            color: #0E0E0E;
            width: 100%;
            cursor: pointer;
            transition: .4s;
        }
        #reset-success form.verify-code div.submit:hover {
            background: #ffc73c;
        }
        #reset-success .icon {
            width: 65px;
            height: 65px;
            margin: 0 auto 10px auto;
        }

        .popup-content p {
            margin: 0 0 10px 0;
        }
        .btn-container a {
            margin-top: 20px;
            text-decoration: none;
            text-transform: none;
            width: 180px; 
            color: #0E0E0E !important;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
            padding: 10px 0;
            border-radius: 4px;
            font-weight: 600;
            background-color: #FFB600 !important;
        }
        @media screen and (max-width: 500px) {
            #reset-success {
                padding: 30px 10px;
                max-width: 438px;
                position: static;
                margin: 50px auto;
                border-radius: 21px;
                background: #FFFFFF;
                box-shadow: 0px 2px 10px 0px #00000026;
                text-align: center;
                font-family: Poppins, sans-serif;
            }
        }
    </style>


    <?php
        $paymentStatus = $_GET['status'];

        $pp = new PayfastPayment;
        $pp->update_database_by_basket_id($basketId, $transactionId, $customerId, $paymentStatus, $transactionAmount, $merchantAmount, $transactionCurrency, $orderDate, $errCode, $errMsg);
        $pp->response_message($errCode, $errMsg, $transactionAmount, $basketId, $transactionId, $rdvMessageKey);
    ?>


</body>
</html>


