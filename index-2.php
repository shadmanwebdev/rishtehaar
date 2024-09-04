<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    if(!isset($_SESSION)) { 
        ob_start();
        session_start(); 
    }

?>



<?php
    function getAccessToken($merchant_id, $secured_key, $basket_id, $trans_amount) {
        $tokenApiUrl = 
        'https://ipguat.apps.net.pk/Ecommerce/api/Transaction/GetAccessToken';

        $urlPostParams = sprintf(
            'MERCHANT_ID=%s&SECURED_KEY=%s&TXNAMT=%s&BASKET_ID=%s',
            $merchant_id,
            $secured_key,
            $trans_amount,
            $basket_id
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $tokenApiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $urlPostParams);
        curl_setopt($ch, CURLOPT_USERAGENT, 'CURL/PHP PayFast Example');
        $response = curl_exec($ch);
        curl_close($ch);
        $payload = json_decode($response);
        $token = isset($payload->ACCESS_TOKEN) ? $payload->ACCESS_TOKEN : '';
        return $token;
    }

    // $merchant_id = '15871';
    $merchant_id = '102';
    // $secured_key = 'xkoq8gELbARFm1L5X1fvE0';
    $secured_key = 'zWHjBp2AlttNu1sK';
    $amount = '99';
    $basket_id = 'sdsdfw343';
    $token = getAccessToken($merchant_id, $secured_key, $basket_id, $amount);
?>



 <!--
 Actual Payment Request
 -->
 <form id='PayFast_payment_form' name='PayFast-payment-form' id='my-form' method='post' content-type='application/x-www-form-urlencoded'
    action="https://ipguat.apps.net.pk/Ecommerce/api/Transaction/PostTransaction">
    Currency Code: <input type="TEXT" name="CURRENCY_CODE" 
    value="PKR" /><br />
    Merchant ID: <input type="TEXT" name="MERCHANT_ID" value="<?php 
    echo $merchant_id; ?>" /><br />
    Merchant Name: <input type="TEXT" name="MERCHANT_NAME" 
    value="Rishtehaar Matrimony" /><br />
    Token: <input type="TEXT" name="TOKEN" value="<?php echo $token; ?>" /><br />
    Success URL: <input type="TEXT" name="SUCCESS_URL" 
    value="http://rishtehaar.com" /><br/>
    Failure URL: <input type="TEXT" name="FAILURE_URL" 
    value="http://rishtehaar.com" /><br/>
    Checkout URL: <input type="TEXT" name="CHECKOUT_URL" 
    value="http://rishtehaar.com" /><br/>
    Customer Email: <input type="TEXT" 
    name="CUSTOMER_EMAIL_ADDRESS" value="some-email@example.com" 
    /><br />
    Customer Mobile: <input type="TEXT" name="CUSTOMER_MOBILE_NO"
    value="+9203224206421" /><br />
    Transaction Amount: <input type="TEXT" name="TXNAMT" 
    value="<?php echo $amount; ?>" /><br />
    Basket ID: <input type="TEXT" name="BASKET_ID" value="<?php echo $basket_id; ?>" /><br />
    14 | P a g e PayFast
    Transaction Date: <input type="TEXT" name="ORDER_DATE" 
    value="<?php echo date('Y-m-d H:i:s', time()); ?>" /><br />
    Signature: <input type="TEXT" name="SIGNATURE" value="SOME-RANDOM-STRING" /><br />
    Version: <input type="TEXT" name="VERSION" value="MERCHANT-CART-0.1" /><br />
    Item Description: <input type="TEXT" name="TXNDESC" value="Item 
    Purchased from Cart" /><br />
    Proccode: <input type="TEXT" name="PROCCODE" value="00" /><br />
    Transaction Type: <input type="TEXT" name="TRAN_TYPE" 
    value='ECOMM_PURCHASE' /><br />
    <!-- Store ID/Terminal ID (optional): <input type="TEXT" name="STORE_ID" 
    value='102-ZEOJDZS3V' /><br /> -->
    <INPUT TYPE="HIDDEN" NAME="MERCHANT_USERAGENT" value="<?php echo $_SERVER['HTTP_USER_AGENT']; ?>">
    <INPUT TYPE="HIDDEN" NAME="ITEMS[0][SKU]" value="SAMPLE-SKU-01">
    <INPUT TYPE="HIDDEN" NAME="ITEMS[0][NAME]" value="An Awesome 
    Dress">
    <INPUT TYPE="HIDDEN" NAME="ITEMS[0][PRICE]" value="99">
    <INPUT TYPE="HIDDEN" NAME="ITEMS[0][QTY]" value="1">
    <input type="SUBMIT" value="SUBMIT">
 </form>



 <!-- <script
    src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
    crossorigin="anonymous"></script>
 <script defer>

function go(event) {
    event.preventDefault();

    var form = $('#my-form')[0];
    var formData = new FormData(form);

    fetch('https://ipguat.apps.net.pk/Ecommerce/api/Transaction/PostTransaction', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams(formData).toString(),
    })
    .then(response => {
        return response.text();
    })
    .then(response => {
        console.log(response); 
    })
    .catch(err => console.log(err));
}

 </script> -->

</body>
</html>