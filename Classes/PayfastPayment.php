<?php
    class PayfastPayment extends Db {
        public function __construct() {
            $this->con = $this->con();
        }
        /*
        =================================================================
            CRUD (create, read, update, delete)
        =================================================================  
        */ 
        public function get_order_date($basket_id) {
            if($basket_id != '') {

                $stmt = $this->con->prepare("SELECT * FROM payfast_payment WHERE basket_id=?");        
                if (!$stmt) {
                    die("Prepare failed: " . $this->con->error);
                }
                $stmt->bind_param("s", $basket_id);
                $stmt->execute();
                $result = $stmt->get_result();
                $payfastPaymentDetails = $result->fetch_assoc();
                $stmt->close();
    
                if(count($payfastPaymentDetails)) {
                    return $payfastPaymentDetails[0]['order_date'];
                } else {
                    return '';
                }
            } else {
                return '';
            }

            
        }
        public function manual_payment_update($user_account_id, $basket_id) {
            $payment_status = 'success';
            $updated_at = datetime_now();
        
            // Update user_account table
            $stmtUser = $this->con->prepare("UPDATE user_account SET updated_at=?, payment_status=? WHERE basket_id=?");
            if (!$stmtUser) {
                die("User Account Prepare failed: " . $this->con->error);
            }  
        
            $stmtUser->bind_param("sss", $updated_at, $payment_status, $user_account_id);
            if ($stmtUser->execute()) {
                
                $stmtUser->close();
            
                // Update payfast_payment table
                $stmtPayfast = $this->con->prepare("UPDATE payfast_payment 
                    SET 
                        payment_status=?,
                        order_date=?
                    WHERE user_account_id=?");
            
                if (!$stmtPayfast) {
                    die("Payfast Prepare failed: " . $this->con->error);
                }  

                $order_date = date_now();
            
                $stmtPayfast->bind_param("sss", $payment_status, $order_date, $user_account_id);
            
                if ($stmtPayfast->execute()) {
                    $status = "1"; // Success    
                    
                    $userdata = json_decode($_SESSION['user'], true);
                    $userdata = array(
                        'logged' => 1,
                        'uid' =>  $userdata['uid'],
                        'email' =>  $userdata['email'],
                        'user_img' =>  $userdata['user_img'],
                        'user_status' =>  $userdata['user_status'],
                        'account_status' => $userdata['account_status'],
                        'gender' => $userdata['gender'],
                        'basket_id' => $userdata['basket_id'],
                        'payment_status' => $payment_status,
                        'order_date' => $order_date
                    );
                    $_SESSION['user'] = json_encode($userdata, true);

                } else {
                    die('Payfast Execute failed: ' . htmlspecialchars($stmtPayfast->error));
                }
            
                $stmtPayfast->close();
            } else {
                die('User Account Execute failed: ' . htmlspecialchars($stmtUser->error));
            }

            header('location: ../payment-details?pid='.$basket_id);
        }
        public function update_basket_id($basket_id) { 
            $user_account_id = get_uid();
            $updated_at = datetime_now();
                
            // Create new payments row
            $stmt = $this->con->prepare("INSERT INTO payfast_payment(basket_id, user_account_id) VALUES (?, ?)");
            $stmt->bind_param("si", $basket_id, $user_account_id);
            if($stmt->execute()) { 
                $payment_id = $stmt->insert_id;
                $stmt->close();  

                // Update user account
                $stmt = $this->con->prepare("UPDATE user_account SET updated_at=?, basket_id=?, payment_id=? WHERE id=?");
                $stmt->bind_param("sssi", $updated_at, $basket_id, $payment_id, $user_account_id);
                if($stmt->execute()) {
                    $stmt->close();
                    $status = '1';
                } else {
                    $status = '0';
                    die('prepare() failed: ' . htmlspecialchars($this->con->error));
                    die('bind_param() failed: ' . htmlspecialchars($stmt->error));
                    die('execute() failed: ' . htmlspecialchars($stmt->error));
                }
            } else {
                $status = '0';
                die('prepare() failed: ' . htmlspecialchars($this->con->error));
                die('bind_param() failed: ' . htmlspecialchars($stmt->error));
                die('execute() failed: ' . htmlspecialchars($stmt->error));
            }

            

        }
        public function update_database_by_basket_id(
            $basket_id, 
            $transaction_id, 
            $customer_id, 
            $payment_status, 
            $transaction_amount, 
            $merchant_amount, 
            $transaction_currency, 
            $order_date, 
            $err_code, 
            $err_msg
        ) {
            $user_account_id = get_uid(); // Assuming get_uid() returns the user_account_id
            $updated_at = datetime_now(); // Assuming datetime_now() returns the current datetime
        
            // Update user_account table
            $stmtUser = $this->con->prepare("UPDATE user_account SET updated_at=?, payment_status=? WHERE basket_id=?");
            if (!$stmtUser) {
                die("User Account Prepare failed: " . $this->con->error);
            }  
        
            $stmtUser->bind_param("sss", $updated_at, $payment_status, $basket_id);
            if ($stmtUser->execute()) {
                
                $stmtUser->close();
            
                // Update payfast_payment table
                $stmtPayfast = $this->con->prepare("UPDATE payfast_payment 
                    SET transaction_id=?, 
                        customer_id=?, 
                        payment_status=?, 
                        transaction_amount=?, 
                        merchant_amount=?, 
                        transaction_currency=?, 
                        order_date=?, 
                        err_code=?, 
                        err_msg=?
                    WHERE basket_id=?");
            
                if (!$stmtPayfast) {
                    die("Payfast Prepare failed: " . $this->con->error);
                }  
            
                $stmtPayfast->bind_param("ssssssssss", 
                $transaction_id, $customer_id, 
                $payment_status, $transaction_amount, 
                $merchant_amount, $transaction_currency, 
                $order_date, $err_code, $err_msg, 
                $basket_id);
            
                if ($stmtPayfast->execute()) {
                    $status = "1"; // Success    
                    
                    $userdata = json_decode($_SESSION['user'], true);
                    $userdata = array(
                        'logged' => 1,
                        'uid' =>  $userdata['uid'],
                        'email' =>  $userdata['email'],
                        'user_img' =>  $userdata['user_img'],
                        'user_status' =>  $userdata['user_status'],
                        'whatsapp' => $userdata['whatsapp'],
                        'account_status' => $userdata['account_status'],
                        'gender' => $userdata['gender'],
                        'basket_id' => $basket_id,
                        'payment_status' => $payment_status,
                        'order_date' => $order_date
                    );
                    $_SESSION['user'] = json_encode($userdata, true);

                } else {
                    die('Payfast Execute failed: ' . htmlspecialchars($stmtPayfast->error));
                }
            
                $stmtPayfast->close();
            } else {
                die('User Account Execute failed: ' . htmlspecialchars($stmtUser->error));
            }
        }
        function response_message($errCode, $errMsg, $transactionAmount, $basketId, $transactionId, $rdvMessageKey) {
            if ($basketId != '' && $errCode != '') {
                // var_dump($errCode, $transactionAmount, $basketId, $transactionId, $rdvMessageKey);
                if ($errCode == '00' || $errCode == '000') {
                                
                    $message = "<div id='reset-success'>
                        <div class='popup-inner-div'>
                            <div class='icon'>
                                <img src='./assets/svg/check-round.svg' alt='Checked Icon'>
                            </div>
                            <div class='popup-title'>A payment transaction was done via PayFast. Transaction was successful.</div>
                            <div class='popup-content'>
                                <p>Total Amount: $transactionAmount /-</p>
                            </div>
                            <div class='btn-container' style='display: flex; justify-content: center;'>
                                <a href='./'>Back to home</a>
                            </div>
                        </div>
                    </div>";
                } else {
                    $message = "<div id='reset-success'>
                        <div class='popup-inner-div'>
                            <div class='icon' style='width: 65px; height: 55px;'>
                                <img src='./assets/img/close.png' alt='Close Icon'>
                            </div>
                            <div class='popup-title'>$errMsg</div>
                            <div class='btn-container' style='display: flex; justify-content: center;'>
                                <a href='./'>Back to home</a>
                            </div>
                        </div>
                    </div>";
                }
            } else {
                $message = "<div id='reset-success'>
                    <div class='popup-inner-div'>
                        <div class='icon' style='width: 65px; height: 55px;'>
                            <img src='./assets/img/close.png' alt='Close Icon'>
                        </div>
                        <div class='popup-title'>$errMsg</div>
                        <div class='btn-container' style='display: flex; justify-content: center;'>
                            <a href='./'>Back to home</a>
                        </div>
                    </div>
                </div>";
            }

            echo $message;
        }

        function generateBasketId() {

            $sitename = 'rishtehaar';
            $sitename = substr($sitename, 0, 5);
            $sitename .= date('YmdHi');
            
            return $sitename;
        }

        public function get_payment_details($basket_id) {
            $stmt = $this->con->prepare("SELECT * FROM payfast_payment WHERE basket_id=?");        
            if (!$stmt) {
                die("Prepare failed: " . $this->con->error);
            }
            $stmt->bind_param("s", $basket_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $payfastPaymentDetails = $result->fetch_assoc();
            $stmt->close();

            return $payfastPaymentDetails;
        }
        
        /*
        =================================================================
            cURL
        =================================================================  
        */
        function getAccessToken($merchant_id, $secured_key, $basket_id, $trans_amount) {
            // $tokenApiUrl = 
            // 'https://ipguat.apps.net.pk/Ecommerce/api/Transaction/GetAccessToken';
            $tokenApiUrl = 
            'https://ipg1.apps.net.pk/Ecommerce/api/Transaction/GetAccessToken';

            $urlPostParams = sprintf(
                'MERCHANT_ID=%s&SECURED_KEY=%s&TXNAMT=%s&BASKET_ID=%s',
                $merchant_id,
                $secured_key,
                $trans_amount,
                $basket_id
            );

            // var_dump($urlPostParams);
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

            // var_dump($token);
            return $token;
        }
        /*
        =================================================================
            DISPLAY
        =================================================================  
        */
        public function displayPaymentDetails($basket_id) {
            $paymentDetails = $this->get_payment_details($basket_id);

            $transIdStart = segment($paymentDetails['transaction_id'], 8);

            echo "<div class='card flex-fill'>
                <ul class='list-group subscription'>
                    <li class='list-group-item'>
                        <div><strong>Transaction Id</strong></div>
                        <div>{$paymentDetails['transaction_id']}</div>
                    </li>
                    <li class='list-group-item'>
                        <div><strong>Customer Id</strong></div>
                        <div>{$paymentDetails['customer_id']}</div>
                    </li>
                    <li class='list-group-item'>
                        <div><strong>Payment Status</strong></div>
                        <div>{$paymentDetails['payment_status']}</div>
                    </li>
                    <li class='list-group-item'>
                        <div><strong>Transaction Amount</strong></div>
                        <div>{$paymentDetails['transaction_amount']}</div>
                    </li>
                    <li class='list-group-item'>
                        <div><strong>Merchant Amount</strong></div>
                        <div>{$paymentDetails['merchant_amount']}</div>
                    </li>
                    <li class='list-group-item'>
                        <div><strong>Transaction Currency</strong></div>
                        <div>{$paymentDetails['transaction_currency']}</div>
                    </li>
                    <li class='list-group-item'>
                        <div><strong>Order Date</strong></div>
                        <div>{$paymentDetails['order_date']}</div>
                    </li>
                    <li class='list-group-item'>
                        <div><strong>Error Code</strong></div>
                        <div>{$paymentDetails['err_code']}</div>
                    </li>
                    <li class='list-group-item'>
                        <div><strong>Error Message</strong></div>
                        <div>{$paymentDetails['err_msg']}</div>
                    </li>
                    <!-- Add similar lines for other columns -->
                </ul>
                <div class='update-btn-wrapper'>
                    <a href='./controllers/payment-handler?pid=$basket_id&payerid={$paymentDetails['user_account_id']}' class='update-payment-btn'>Verify Payment</a>
                </div>
            </div>";

        }
        /*
        =================================================================
            FORMS
        =================================================================  
        */  
        public function get_amount() {
            $id = 1;
            $stmt = $this->con->prepare("SELECT * FROM pricing WHERE id=? LIMIT 1");
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $data = $result->fetch_all(MYSQLI_ASSOC);
            return $data[0]['price'];
        }
        function payment_form($email, $phone) {
            // // Test
            // $merchant_id = '102';
            // $secured_key = 'zWHjBp2AlttNu1sK';
            // Live
            $merchant_id = '15871';
            $secured_key = '6AHQ0WRA_yKAXR5IOiVLe5wTW4';
            // $amount = '1290';
            $amount = $this->get_amount();

            $basket_id = $this->generateBasketId();
            $token = $this->getAccessToken($merchant_id, $secured_key, $basket_id, $amount);

            $date = date('Y-m-d H:i:s', time());

            $user_agent = $_SERVER['HTTP_USER_AGENT'];

            if($_SERVER['SERVER_NAME'] == 'localhost') {
                $base_url = "http://localhost/rishtehaar";
            } else {
                $base_url = "https://rishtehaar.com";
            }

            // Update basket id
            $this->update_basket_id($basket_id);

            // echo "<h1 style='font-family: sans-serif;'>Redirecting to payment gateway<br>Please wait...</h1>
            // <form name='PayFast-payment-form' id='my-payment-form' method='post' content-type='application/x-www-form-urlencoded'
            // action='https://ipguat.apps.net.pk/Ecommerce/api/Transaction/PostTransaction'>
            echo "<h1 style='font-family: sans-serif;'>Redirecting to payment gateway<br>Please wait...</h1>
            <form name='PayFast-payment-form' id='my-payment-form' method='post' content-type='application/x-www-form-urlencoded'
            action='https://ipg1.apps.net.pk/Ecommerce/api/Transaction/PostTransaction'>
            
                <input type='hidden' name='CURRENCY_CODE' value='PKR' />
                <input type='hidden' name='MERCHANT_ID' value='$merchant_id' />
                <input type='hidden' name='MERCHANT_NAME' value='Rishtehaar Matrimony' />
                <input type='hidden' name='TOKEN' value='$token' />
                <input type='hidden' name='SUCCESS_URL' 
                value='$base_url/return?status=success&' />
                <input type='hidden' name='FAILURE_URL' 
                value='$base_url/return?status=failed&' />
                <input type='hidden' name='CHECKOUT_URL' 
                value='$base_url/return?status=checkout&' />
                <input type='hidden' name='CUSTOMER_EMAIL_ADDRESS' value='$email' />
                <input type='hidden' name='CUSTOMER_MOBILE_NO' value='$phone' />
                <input type='hidden' name='TXNAMT' value='$amount' />
                <input type='hidden' name='BASKET_ID' value='$basket_id' />
                <input type='hidden' name='ORDER_DATE' value='$date' />
                <input type='hidden' name='SIGNATURE' value='SOME-RANDOM-STRING' />
                <input type='hidden' name='VERSION' value='MERCHANT-CART-0.1' />
                <input type='hidden' name='TXNDESC' value='Item Purchased from Cart' />
                <input type='hidden' name='PROCCODE' value='00' />
                <input type='hidden' name='TRAN_TYPE' value='ECOMM_PURCHASE' />
                <!-- Store ID/Terminal ID (optional): <input type='hidden' name='STORE_ID' value='102-ZEOJDZS3V' /> -->
                <INPUT TYPE='HIDDEN' NAME='MERCHANT_USERAGENT' value='$user_agent'>
                <INPUT TYPE='HIDDEN' NAME='ITEMS[0][SKU]' value='SAMPLE-SKU-01'>
                <INPUT TYPE='HIDDEN' NAME='ITEMS[0][NAME]' value='Rishtehaar Membership'>
                <INPUT TYPE='HIDDEN' NAME='ITEMS[0][PRICE]' value='$amount'>
                <INPUT TYPE='HIDDEN' NAME='ITEMS[0][QTY]' value='1'>
            </form>
            ";
            // </form>
        }

    }

?>