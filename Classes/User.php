<?php
    /*
    =================================================================
        SESSIONS & COOKIES
        CRUD
        SMTP
        VERIFICATION & VALIDATION
        LOGIN & LOGOUT
        DISPLAY
        FORMS
        EMAIL

    =================================================================  
    */

    class User extends Db {
        public function __construct() {
            $this->con = $this->con();
        }
        public function startSession() {
            if(!isset($_SESSION)) { 
                ob_start();
                session_start(); 
            }
        }
        public function endSession() {
            session_unset();
            session_destroy();
        }
        /*
        =================================================================
            SESSIONS & COOKIES
        =================================================================  
        */
        public function get_basket_id() {
            if(isset($_COOKIE['user'])) {
                $userdata = json_decode($_COOKIE['user'], true);
                $basket_id = $userdata['basket_id'];
                return $basket_id;
            } else if(isset($_SESSION['user'])) {
                $userdata = json_decode($_SESSION['user'], true);
                $basket_id = $userdata['basket_id'];
                return $basket_id;
            }
        }
        public function get_payment_status() {
            if(isset($_COOKIE['user'])) {
                $userdata = json_decode($_COOKIE['user'], true);
                $payment_status = $userdata['payment_status'];
                return $payment_status;
            } else if(isset($_SESSION['user'])) {
                $userdata = json_decode($_SESSION['user'], true);
                $payment_status = $userdata['payment_status'];
                return $payment_status;
            }
        }
        public function is_logged_in() {
            if(isset($_COOKIE['user'])) {
                $userdata = json_decode($_COOKIE['user'], true);
                $logged = $userdata['logged'];
                return $logged;
            } else if(isset($_SESSION['user'])) {
                $userdata = json_decode($_SESSION['user'], true);
                $logged = $userdata['logged'];
                return $logged;
            }
        }
        public function get_uid() {
            if(isset($_COOKIE['user'])) {
                $userdata = json_decode($_COOKIE['user'], true);
                $uid = $userdata['uid'];
                return $uid;
            } else if(isset($_SESSION['user'])) {
                $userdata = json_decode($_SESSION['user'], true);
                $uid = $userdata['uid'];
                return $uid;
            }
        }
        public function get_user_email() {
            if(isset($_COOKIE['user'])) {
                $userdata = json_decode($_COOKIE['user'], true);
                $email = $userdata['email'];
                return $email;
            } else if(isset($_SESSION['user'])) {
                $userdata = json_decode($_SESSION['user'], true);
                $email = $userdata['email'];
                return $email;
            }
        }  
        public function get_user_status() {
            if(isset($_COOKIE['user'])) {
                $userdata = json_decode($_COOKIE['user'], true);
                $user_status = $userdata['user_status'];
                return $user_status;
            } else if(isset($_SESSION['user'])) {
                $userdata = json_decode($_SESSION['user'], true);
                $user_status = $userdata['user_status'];
                return $user_status;
            }
        }
        public function get_user_gender() {
            if(isset($_COOKIE['user'])) {
                $userdata = json_decode($_COOKIE['user'], true);
                $user_gender = $userdata['gender'];
                return $user_gender;
            } else if(isset($_SESSION['user'])) {
                $userdata = json_decode($_SESSION['user'], true);
                $user_gender = $userdata['gender'];
                return $user_gender;
            }
        }
        public function get_account_status() {
            if(isset($_COOKIE['user']) && $_COOKIE['user'] == null) {
                $userdata = json_decode($_COOKIE['user'], true);
                $account_status = $userdata['account_status'];
                return $account_status;
            } else if(isset($_SESSION['user'])) {
                $userdata = json_decode($_SESSION['user'], true);
                $account_status = $userdata['account_status'];
                return $account_status;
            }
        } 
        
        public function is_registered() {
            if(isset($_COOKIE['user'])) {
                return '1';
            } else if(isset($_SESSION['user'])) {
                return '1';
            } else {
                return '0';
            }
        }
        public function check_user_session() {
            $server = $_SERVER['SERVER_NAME'];
            $uriArray = explode('/', $_SERVER['REQUEST_URI']);
            $pagename = basename($_SERVER["SCRIPT_FILENAME"], '.php');
            $files = array("index");
            
            $package_status = $this->get_packages_status();

            // Check if server is localhost
            if($server === 'localhost') {
                $folder = $uriArray[2];
            }  else {
                $folder = $uriArray[1];
            }
            if($folder === "admin") {     
                $adminNavBtn = "<div id='navBtn'>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>";
                $path = '../';
            } else {
                $adminNavBtn = "";
                $path = './';
            }
            /*
                1. Check if user is logged in
                2. Check if user is admin
                3. Check if this is the admin directory
                4. If user isn't admin check if they are a member
                5. If they are member and trying to access admin directory then 
                    redirect to home page
                6. If user isn't logged in at all redirect to home page
            */
            if(isset($_SESSION['user'])) {
                $userdata = json_decode($_SESSION['user'], true);
                $user_img = $userdata['user_img'];
                $payment_proof = $this->check_payment_proof($userdata['uid']);
                if(empty($user_img)) {
                    $user_img = 'admin.png';
                }
                if($userdata['user_status'] == 'admin') {  
                    if($folder == 'admin') {
                        echo "<div class='admin_bar'>
                            <div class='inner_div'>
                                <div class='site-links'>
                                    <div class='logo'>                
                                        <div class='logo-text'>
                                            <a href='../' aria-label='Go to home page'>
                                                <img src='../assets/img/logo/logo-header.png.png' alt='Rishtehaar'>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                $adminNavBtn
                                <div class='profile-btn'>
                                    <div id='profile-trigger'>
                                        <div><a href='../user-profile?i={$userdata['uid']}'>Admin</a></div>
                                        <div id='profile-pic-wrapper'>
                                            <img src='../assets/img/$user_img'> 
                                        </div>
                                        <div>
                                            <i onclick='profileTrigger();' class='fas fa-angle-down'></i>
                                        </div>
                                    </div>
                                    <div id='profile-dropdown'>
                                        <a style='color:#000;' href='../controllers/logout-handler'>Logout</a>
                                    </div>
                                </div>
                            </div>
                        </div>";
                    } else {
                        return;
                    }
                } else if ($userdata['user_status'] == 'member') {
                    if ($folder == "admin") {
                        if ($userdata['account_status'] == 'Not Approved') {
                            if($payment_proof != '') {
                                if($pagename != 'status') {
                                    header('location: ../status');
                                } else {
                                    return;
                                }
                            } else {
                                if(in_array($pagename, $files)) {
                                    header('location: ../package');
                                    exit();
                                }
                            }
                        } else if($userdata['account_status'] == 'approved') {
                            if($pagename == 'package') {
                                header('location: ./');
                            }
                        }
                    } else {
                        if ($package_status == 'enabled') {
                            if ($userdata['account_status'] == 'Not Approved') {
                                if($payment_proof != '') {
                                    if($pagename != 'status') {
                                        header('location: ./status');
                                    } else {
                                        return;
                                    }
                                } else {
                                    if(in_array($pagename, $files)) {
                                        header('location: ./package');
                                        exit();
                                    }
                                }
                            } else if($userdata['account_status'] == 'approved') {
                                if($pagename == 'package') {
                                    header('location: ./');
                                }
                            }
                        } else {
                            if($pagename == 'package') {
                                header('location: ./');
                            }
                        }
                    }
                }
            } else if (!isset($_SESSION['user'])) {
                /* 
                    Redirect when user is not logged in
                    1. If user tries to access admin page
                    2. When user tries see pages after 2 (commented out)
                */
                if($folder == "admin") {
                    header('location: ../');
                    exit();
                } 
                // elseif($pagename == "index") {
                //     if(isset($_GET['page'])) {
                //         if($_GET['page'] > 2) {
                //             header('location: ./registration');
                //             exit();
                //         }
                //     }
                // }
            }
            // var_dump($userdata);
        }
        public function update_session($current_status) {
            $this->startSession();
            $old_user_session = json_decode($_SESSION['user'], true);
            if(isset($_SESSION['user'])) {
                $userdata = array(
                    'logged' => 1,
                    'uid' => $old_user_session['uid'],
                    'email' => $old_user_session['email'],
                    'user_img' => $old_user_session['user_img'],
                    'user_status' => $old_user_session['user_status'],
                    'account_status' => $current_status,
                    'gender' => $old_user_session['gender'],
                    'whatsapp' => $old_user_session['whatsapp'],
                    'basket_id' => $old_user_session['basket_id'],
                    'payment_status' => $old_user_session['payment_status'],
                    'order_date' => $old_user_session['order_date']
                );
                $_SESSION['user'] = json_encode($userdata, true);
            }
            if(isset($_COOKIE['user'])) {
                setcookie("user", json_encode($userdata, true), time() + (10 * 365 * 24 * 60 * 60), '/');
            }
        }
        /*
        =================================================================
            CRUD (create, read, update, delete)
        =================================================================  
        */      
        public function create() {
            $this->startSession();

            // Retrieve other form fields
            $relationship = $_POST['relationship'];
            $email = $_POST['email'];
            $whatsapp = $_POST['whatsapp'];
            $gender = $_POST['gender'];
            $age = intval($_POST['age']);
            $description = $_POST['description'];
            $marital_status = $_POST['marital_status'];
            $caste = $_POST['caste'];
            $education = $_POST['education'];
            $occupation = $_POST['occupation'];
            $city = $_POST['city'];
            $password = $_POST['password'];
            $feet = $_POST['feet'];
            $inch = $_POST['inch'];
        
            // Check if the 'image' field exists in the POST data
            if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
                // Handle the uploaded image
                $tempFilePath = $_FILES['photo']['tmp_name'];
            
                // Define the directory where you want to save the image
                $imageDirectory = '../img/'; // Update this path to your desired directory
            
                // Generate a unique filename for the image (you can use a UUID, timestamp, etc.)
                $newFilename = time() . uniqid(rand(10, 20)) . '.webp'; // Use WebP format
            
                // Construct the full path to save the image
                $imagePath = $imageDirectory . $newFilename;
            
                // Move the temporary uploaded file to the desired location
                if (move_uploaded_file($tempFilePath, $imagePath)) {
                    // Image uploaded successfully
                } else {
                    // Handle the case where the image could not be moved
                    $newFilename = '';
                }
            } else {
                // Handle the case where no image was provided
                $newFilename = '';
            }
        
            // var_dump($newFilename);

            // Additional data
            $user_status = 'member';
            $package_status = $this->get_packages_status();
            $account_status = 'Not Approved';
            $now = new DateTime("now", new DateTimeZone('Asia/Karachi'));
            $created_at = $now->format('Y-m-d H:i:s');
            $updated_at = $created_at;
        
            // Insert data into the database
            $stmt = $this->con->prepare("INSERT INTO user_account(relationship, email, pwd, whatsapp, gender, age, user_description, marital_status, caste, education, occupation, city, feet, inch, photo, user_status, account_status, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            if (!$stmt) {
                die("Prepare error: " . $this->con->error); // Print out the error message
            }
            $stmt->bind_param("sssssisssssssssssss", $relationship, $email, $password, $whatsapp, $gender, $age, $description, $marital_status, $caste, $education, $occupation, $city, $feet, $inch, $newFilename, $user_status, $account_status, $created_at, $updated_at);
        
            if ($stmt->execute()) {
                $user_id = $stmt->insert_id;

                $_SESSION['email'] = $email;
        
                $userdata = array(
                    'logged' => 0,
                    'uid' => $user_id,
                    'email' => $email,
                    'user_img' => $newFilename,
                    'user_status' => $user_status,
                    'account_status' => $account_status,
                    'gender' => $gender,
                    'whatsapp' => $whatsapp,
                    'basket_id' => '',
                    'payment_status' => '',
                    'order_date' => ''
                );
                $_SESSION['user'] = json_encode($userdata, true);

                // SEND EMAIL
                if($_SERVER['SERVER_NAME'] != 'localhost') {
                    $this->send_verification_code($email, $user_id);
                }
                
            } else {
                die('prepare() failed: ' . htmlspecialchars($this->con->error));
                die('bind_param() failed: ' . htmlspecialchars($stmt->error));
                die('execute() failed: ' . htmlspecialchars($stmt->error));
            }
            $stmt->close();
            // } else {
            //     echo '3';
            // }

            // var_dump($email);
            // SEND THE EMAIL
            // $this->signup_email($email);
            
        }
        public function update() {
            $user_id = $_POST['user_id'];
            $relationship = $_POST['relationship'];
            $email = $_POST['email'];
            $whatsapp = $_POST['whatsapp0'];
            $gender = $_POST['gender'];
            $age = $_POST['age'];
            $user_description = $_POST['description'];
            $marital_status = $_POST['marital_status'];
            $caste = $_POST['caste'];
            $education = $_POST['education'];
            $occupation = $_POST['occupation'];
            $city = $_POST['city'];
            $feet = $_POST['feet'];
            $inch = $_POST['inch'];

            $stmt = $this->con->prepare("UPDATE user_account SET relationship=?, email=?, whatsapp=?, gender=?, age=?, user_description=?, marital_status=?, caste=?, education=?, occupation=?, city=?, feet=?, inch=? WHERE id=?");
            $stmt->bind_param('ssssissssssssi', $relationship, $email, $whatsapp, $gender, $age, $user_description, $marital_status, $caste, $education, $occupation, $city, $feet, $inch, $user_id);
            $stmt->execute();
            $stmt->close();

            echo '1';
        } 
        public function reset() {
            $this->startSession();
            $email = $_POST['email'];

            $exclude_status = 'deleted';

            $stmt = $this->con->prepare("SELECT * FROM user_account WHERE email=? AND account_status!=?");
            $stmt->bind_param('ss', $email, $exclude_status);
            $stmt->execute();
            
            $meta = $stmt->result_metadata();
            $result = array();
            while ($field = $meta->fetch_field()) {
                $parameters[] = &$row[$field->name];
            }
            call_user_func_array(array($stmt, 'bind_result'), $parameters);
            while ($stmt->fetch()) {
                foreach($row as $key => $val) {
                    $x[$key] = $val;
                }
                $result[] = $x;
            }
            if(count($result) == 0) {
                header('Location: ../reset?status=error');
                exit();
            } else {
                $password = $this->generate_pwd(4);

                $stmt = $this->con->prepare("UPDATE user_account SET pwd=? WHERE email=? AND account_status!=?");
                $stmt->bind_param('sss', $password, $email, $exclude_status);
                if($stmt->execute()) {
                    unset($_SESSION['email']);
                    $_SESSION['email'] = $email;
                }
                $stmt->close();
                // SEND THE EMAIL
                $to = $email;
                $subject = 'Rishtehar Password Reset';
                $msgBody = "<p>Your new password is: $password</p>";
                $this->sendEmailSwiftMailer($to, $subject, $msgBody);
                header('Location: ../confirmation?reset=success');   
            }
        }
        public function get_order_date($basket_id) {
            if($basket_id != '') {

                $stmt = $this->con->prepare("SELECT * FROM payfast_payment WHERE basket_id=?");        
                if (!$stmt) {
                    die("Prepare failed: " . $this->con->error);
                }
                $stmt->bind_param("s", $basket_id);
                $stmt->execute();
                $result = $stmt->get_result();
                $payfastPaymentDetails = $result->fetch_all(MYSQLI_ASSOC);
                $stmt->close();
    
                if(count($payfastPaymentDetails) > 0) {
                    return $payfastPaymentDetails[0]['order_date'];
                } else {
                    return '';
                }
            } else {
                return '';
            }         
        }
        public function update_password() {
            $selector = $_POST['selector'];
            $validator = $_POST['validator'];
            $password = $_POST['new_password'];
            $password_repeat = $_POST['repeat_password'];
            
            if(empty($password) || empty($password_repeat)) {
                $status = '4';
            } else if ($password != $password_repeat) {
                $status = '5';
            } else {
                $current_date = date("U"); 
            
                // SELECT
                $stmt = $this->con->prepare("SELECT * FROM pwd_reset WHERE pwd_reset_selector=? AND pwd_reset_expires>=?");
                $stmt->bind_param('ss', $selector, $current_date);
                $stmt->execute();
            
                $meta = $stmt->result_metadata();
                $result = array();
                while ($field = $meta->fetch_field()) {
                    $parameters[] = &$row[$field->name];
                }
                call_user_func_array(array($stmt, 'bind_result'), $parameters);
                while ($stmt->fetch()) {
                    foreach($row as $key => $val) {
                        $x[$key] = $val;
                    }
                    $result[] = $x;
                }
                if(count($result) == 0) {
                    $status = '8';
                } else {
                    foreach($result as $row):
                        $token_bin = hex2bin($validator);
                        $token_check = password_verify($token_bin, $row['pwd_reset_token']);
                    endforeach;
    
                    if($token_check === false) {
                        $status = '7';
                        // echo "You need to resubmit your reset request.";
                        // exit();
                    } elseif($token_check === true) {
                        $token_email = $row['pwd_reset_email'];
        
                        // SELECT FROM users TABLE
                        $stmt2 = $this->con->prepare("SELECT * FROM user_account WHERE email=?");
                        $stmt2->bind_param('s', $token_email);
                        $stmt2->execute();
            
                        $meta2 = $stmt2->result_metadata();
                        $result2 = array();
                        while ($field2 = $meta2->fetch_field()) {
                            $parameters2[] = &$row2[$field2->name];
                        }
                        call_user_func_array(array($stmt2, 'bind_result'), $parameters2);
                        while ($stmt2->fetch()) {
                            foreach($row2 as $key2 => $val2) {
                                $y[$key2] = $val2;
                            }
                            $result2[] = $y;
                        }
                        if(count($result2) == 0) {
                            $status = '0';
                        } else {
                            // UPDATE PASSWORD
                            $password = $_POST['new_password'];
                            // $pwdHash = password_hash($_POST['new_password'], PASSWORD_BCRYPT);
                            $stmt3 = $this->con->prepare("UPDATE user_account SET pwd=? WHERE email=?");
                            $stmt3->bind_param('ss', $password, $token_email);
                            $stmt3->execute();
                            // DELETE TOKEN
                            $stmt4 = $this->con->prepare("DELETE FROM pwd_reset WHERE pwd_reset_email=?");
                            $stmt4->bind_param('s', $token_email);
                            $stmt4->execute();
                            
                            $status = '1';
                        }
                        $stmt->close();
                    }
                }      
            }      
            echo $status;
        }
        public function get_and_update_account_status($user_id) {
            $user_array = $this->getUserById($user_id);
            $account_status = $user_array['account_status'];
            if($account_status == 'approved') {
                $userdata = json_decode($_SESSION['user'], true);
                $userdata = array(
                    'logged' => 1,
                    'uid' =>  $userdata['uid'],
                    'email' =>  $userdata['email'],
                    'user_img' =>  $userdata['user_img'],
                    'user_status' =>  $userdata['user_status'],
                    'account_status' => $account_status,
                    'gender' => $userdata['gender'],
                    'basket_id' => $userdata['basket_id'],
                    'payment_status' => $userdata['payment_status'],
                    'order_date' => $userdata['order_date']
                );
                $_SESSION['user'] = json_encode($userdata, true);
            }
            return $account_status;
        }
        public function whatsapp_icon($admin=null) {
            if($admin == null) {
                return "
                <img class='whatsapp-icon' src='./assets/svg/whatsapp_logo_icon 1.svg' alt='whatsapp icon' />";
            } else {
                return "
                <img class='whatsapp-icon' src='../assets/svg/whatsapp_logo_icon 1.svg' alt='whatsapp icon' />";
            }
        }  
        public function update_status($status, $id) {
            if($status == 'deleted') {
                $stmt = $this->con->prepare("DELETE FROM user_account WHERE id=?");
                $stmt->bind_param('i', $id);
                if($stmt->execute()) {
                    $stmt->close();
                    echo '1';
                } else {
                    echo '0';
                }
            } else {
                $stmt = $this->con->prepare("UPDATE user_account SET account_status=? WHERE id=?");
                $stmt->bind_param('si', $status, $id);
                if($stmt->execute()) {
                    $stmt->close();
                    if($status == 'approved') {
                        if(
                            $_SERVER['SERVER_NAME'] != 'localhost'
                        ) {
                            $user_array = $this->getUserById($id);
                            $this->send_approval_email($user_array['email']);
                        }
                    }
                    echo '1';
                } else {
                    echo '0';
                }
            }
        }
        public function update_user_payment() {
            $user_id = intval($_POST['user_id']);
            $package_id = intval($_POST['package']);
            $pay_method = $_POST['pay_method'];
            if($pay_method == 'bank') {
                $payment_method_id = 1;
            } else if($pay_method == 'jazzcash') {
                $payment_method_id = 2;
            } else if($pay_method == 'easypaisa') {
                $payment_method_id = 3;
            }

            $img = $_FILES['image']['name'];
            // CHECK IF INPUT IS EMPTY
            if(!empty($img)) {
                $allowed = array('png', 'jpg', 'jpeg');
                $ext = pathinfo($img, PATHINFO_EXTENSION);
                // CHECK IF FILE TYPE IS ALLOWED
                if (!in_array($ext, $allowed)) {
                    header("location: ./package?filetype=incorrect");
                    exit();
                } else {
                    $imagePath = '../img/';
                    $uniquesavename = time().uniqid(rand());
                    $destFile = $imagePath . $uniquesavename . '.'.$ext;
                    $tempname = $_FILES['image']['tmp_name'];
                    list($width, $height) = getimagesize( $tempname );
                    move_uploaded_file($tempname,  $destFile);
                    $newFilename = $uniquesavename . '.'.$ext;
                }
            } else {
                $newFilename = '';
            }
            $now = new DateTime("now", new DateTimeZone('Asia/Karachi') );
            $updated_at = $now->format('Y-m-d H:i:s');

            $stmt = $this->con->prepare("UPDATE user_account SET updated_at=?, package_id=?, payment_method_id=?, payment_proof=? WHERE id=?");
            $stmt->bind_param("siisi", $updated_at, $package_id, $payment_method_id, $newFilename, $user_id);
            $stmt->execute();
            $stmt->close();
        }
        public function check_pwd($pass, $id) {
            $stmt = $this->con->prepare("SELECT * FROM user_account WHERE id=? LIMIT 1");
            $stmt->bind_param('i', $id);
            $stmt->execute();

            $meta = $stmt->result_metadata();
            $result = array();
            while ($field = $meta->fetch_field()) {
                $parameters[] = &$row[$field->name];
            }
            call_user_func_array(array($stmt, 'bind_result'), $parameters);
            while ($stmt->fetch()) {
                foreach($row as $key => $val) {
                    $x[$key] = $val;
                }
                $result[] = $x;
            }
            if(count($result) > 0) {
                foreach($result as $row):
                    $pwd = $row['pwd'];
                endforeach;
                $stmt->close();
                if($pass !== $pwd) {
                    echo "<div class='error'>Invalid Password</div>";
                } else {
                    echo "";
                }
                return;
            } else {
                echo "<div class='error'>Invalid Password</div>";
                return;
            }
        }
        public function change_password($pwd, $id) {
            $stmt = $this->con->prepare("UPDATE user_account SET pwd=? WHERE id=?");
            $stmt->bind_param('si', $pwd, $id);
            $stmt->execute();
            $stmt->close();
        }
        public function delete_account($id) {
            $account_status = 'deleted';
            $stmt = $this->con->prepare("UPDATE user_account SET account_status=? WHERE id=?");
            $stmt->bind_param('si', $account_status, $id);
            $stmt->execute();
            $stmt->close();
            $this->con->close();
            $this->logout();
            header('location: ../');
        }
        public function updateUserById($id) {
            $user_id = intval($id);
            $oldImg = $_POST['old_img'];

            $gender = $_POST['gender'];
            $age = intval($_POST['age']);
            $description = $_POST['description'];
            $marital_status = $_POST['marital_status'];
            $caste = $_POST['caste'];
            $education = $_POST['education'];
            $occupation = $_POST['occupation'];
            $city = $_POST['city'];

            $img = $_FILES['image']['name'];

            // CHECK IF INPUT IS EMPTY
            if(!empty($img)) {
                if($img !== $oldImg) {
                    $allowed = array('png', 'jpg', 'jpeg', 'webp', 'jfif');
                    $ext = pathinfo($img, PATHINFO_EXTENSION);
                    // CHECK IF FILE TYPE IS ALLOWED
                    if (!in_array($ext, $allowed)) {
                        header("location: ./user-profile?i=$id&filetype=incorrect");
                        exit();
                    } else {
                        $imagePath = '../img/';
                        $uniquesavename = time().uniqid(rand());
                        $destFile = $imagePath . $uniquesavename . '.'.$ext;
                        $tempname = $_FILES['image']['tmp_name'];
                        list($width, $height) = getimagesize( $tempname );
                        move_uploaded_file($tempname,  $destFile);
                        $newFilename = $uniquesavename . '.'.$ext;
                    }
                } else {
                    $newFilename = $oldImg;
                }
            } else {
                if(!empty($oldImg)) {
                    $newFilename = $oldImg;
                } else {
                    $newFilename = '';
                }
            }
            
            $now = new DateTime("now", new DateTimeZone('Asia/Karachi') );
            $updated_at = $now->format('Y-m-d H:i:s');
            // var_dump( $gender, $age, $user_description, $marital_status, $caste, $education, $occupation, $city, $newFilename, $updated_at, $id);

            $stmt = $this->con->prepare("UPDATE user_account SET gender=?, age=?, user_description=?, marital_status=?, caste=?, education=?, occupation=?, city=?, photo=?, updated_at=? WHERE id=?");
            $stmt->bind_param('sissssssssi', $gender, $age, $description, $marital_status, $caste, $education, $occupation, $city, $newFilename, $updated_at, $user_id);
            $stmt->execute();
            $stmt->close();
            $this->con->close();
        }
        public function check_payment_proof($id) {
            $package_status = $this->get_packages_status();
            $pagename = basename($_SERVER["SCRIPT_FILENAME"], '.php');
            $exclude = 'deleted';
            $stmt = $this->con->prepare("SELECT * FROM user_account WHERE id=? AND account_status!=? ORDER BY id DESC");
            $stmt->bind_param('is', $id, $exclude);
            $stmt->execute();

            $meta = $stmt->result_metadata();
            $result = array();
            while ($field = $meta->fetch_field()) {
                $parameters[] = &$row[$field->name];
            }
            call_user_func_array(array($stmt, 'bind_result'), $parameters);
            while ($stmt->fetch()) {
                foreach($row as $key => $val) {
                    $x[$key] = $val;
                }
                $result[] = $x;
            }
            if(count($result) > 0) {
                foreach($result as $row):
                    $payment_proof = $row['payment_proof'];
                endforeach;
                $stmt->close();
            } else {
                $payment_proof = '';
            }
            return $payment_proof;
        }
        public function del_photo($photo, $id) {
            unlink("../../img/$photo");
            $stmt = $this->con->prepare("UPDATE user_account SET photo=NULL WHERE id=?");
            $stmt->bind_param('i', $id);
            if($stmt->execute()) {
                $status = '1';
            } else {
                $status = '0';
            }
            $stmt->close();
            echo $status;
        }
        public function getUserById($id) {
            $stmt = $this->con->prepare("SELECT * FROM user_account WHERE id=? ORDER BY id DESC");
            $stmt->bind_param('i', $id);
            $stmt->execute();

            $meta = $stmt->result_metadata();
            $result = array();
            while ($field = $meta->fetch_field()) {
                $parameters[] = &$row[$field->name];
            }
            call_user_func_array(array($stmt, 'bind_result'), $parameters);
            while ($stmt->fetch()) {
                foreach($row as $key => $val) {
                    $x[$key] = $val;
                }
                $result[] = $x;
            }
            if(count($result) > 0) {
                foreach($result as $row):

                    $elapsed = $this->elapsed($row['created_at']);

                    $phoneNumber = $row['whatsapp'];
                    // Format 1: 0333-5265024
                    $formatted1 = substr($phoneNumber, 0, 4) . "-" . substr($phoneNumber, 4);
                    // Format 2: 0333-5265 ***
                    $formatted2 = substr($phoneNumber, 0, 4) . "-" . substr($phoneNumber, 4, 4) . " ***";

                    $user_array = array(
                        'id' => $row['id'],
                        'relationship' => $row['relationship'],
                        'fullname' => $row['fullname'],
                        'email' => $row['email'],
                        'pwd' => $row['pwd'],
                        'whatsapp0' => $row['whatsapp'],
                        'whatsapp' => $formatted1,
                        'phone_redacted' => $formatted2,
                        'gender' => $row['gender'],
                        'age' => $row['age'],
                        'user_description' => $row['user_description'],
                        'marital_status' => $row['marital_status'],
                        'caste' => $row['caste'],
                        'education' => $row['education'],
                        'occupation' => $row['occupation'],
                        'city' => $row['city'],
                        'feet' => $row['feet'],
                        'inch' => $row['inch'],
                        'photo' => $row['photo'],
                        'user_status' => $row['user_status'],
                        'account_status' => $row['account_status'],
                        'created_at' => $row['created_at'],
                        'updated_at' => $row['updated_at'],
                        'package_id' => $row['package_id'],
                        'payment_method_id' => $row['payment_method_id'], 
                        'elapsed' => $elapsed, 
                    );
                endforeach;
                $stmt->close();
            } else {
                $user_array = array();
            }
            return $user_array;
        } 
        private function getUsersAll($user_status) {
            /*
                getUsersAll() is used inside showUser() to get all the users
                for displaying in the admin area
            */
            $users_array = array();
            $stmt = $this->con->prepare("SELECT * FROM user_account WHERE user_status=? ORDER BY id DESC");
            $stmt->bind_param('s', $user_status);
            $stmt->execute();

            $meta = $stmt->result_metadata();
            $result = array();
            while ($field = $meta->fetch_field()) {
                $parameters[] = &$row[$field->name];
            }
            call_user_func_array(array($stmt, 'bind_result'), $parameters);
            while ($stmt->fetch()) {
                foreach($row as $key => $val) {
                    $x[$key] = $val;
                }
                $result[] = $x;
            }
            if(count($result) > 0) {
                foreach($result as $row):

                    // Get interval between now and account creation
                    $elapsed = $this->elapsed($row['created_at']);

                    // Check if photo exists
                    if(!isset($row['photo']) || empty($row['photo'])) {
                        $photo = 'avi.jpg';
                    } else {
                        $photo = $row['photo'];
                    }

                    
                    $phoneNumber = $row['whatsapp'];
                    // Format 1: 0333-5265024
                    $formatted1 = substr($phoneNumber, 0, 4) . "-" . substr($phoneNumber, 4);
                    // Format 2: 0333-5265 ***
                    $formatted2 = substr($phoneNumber, 0, 4) . "-" . substr($phoneNumber, 4, 4) . " ***";

                    $user_array = array(
                        'id' => $row['id'],
                        'relationship' => $row['relationship'],
                        'fullname' => $row['fullname'],
                        'email' => $row['email'],
                        'pwd' => $row['pwd'],
                        'whatsapp' => $formatted1,
                        'phone_redacted' => $formatted2,
                        'gender' => $row['gender'],
                        'age' => $row['age'],
                        'user_description' => $row['user_description'],
                        'marital_status' => $row['marital_status'],
                        'caste' => $row['caste'],
                        'education' => $row['education'],
                        'occupation' => $row['occupation'],
                        'city' => $row['city'],
                        'photo' => $row['photo'],
                        'user_status' => $row['user_status'],
                        'account_status' => $row['account_status'],
                        'created_at' => $row['created_at'],
                        'updated_at' => $row['updated_at'],
                        'package_id' => $row['package_id'],
                        'payment_method_id' => $row['payment_method_id'], 
                        'elapsed' => $elapsed, 
                        'payment_proof' => $row['payment_proof'],
                        'basket_id' => $row['basket_id'],
                        'payment_id' => $row['payment_id'],
                        'payment_status' => $row['payment_status']
                    );
                    array_push($users_array, $user_array);
                endforeach;
                $stmt->close();
            } else {
                $users_array = array();
            }
            return $users_array;
        }
        private function getUsersByStatus($user_status, $account_status) {
            if($account_status == 'new') {
                $account_status = 'Under Verification';
            }
            $users_array = array();
            $stmt = $this->con->prepare("SELECT * FROM user_account WHERE user_status=? AND account_status=? ORDER BY id DESC");
            $stmt->bind_param('ss', $user_status, $account_status);
            $stmt->execute();
            
            $meta = $stmt->result_metadata();
            $result = array();
            while ($field = $meta->fetch_field()) {
                $parameters[] = &$row[$field->name];
            }
            call_user_func_array(array($stmt, 'bind_result'), $parameters);
            while ($stmt->fetch()) {
                foreach($row as $key => $val) {
                    $x[$key] = $val;
                }
                $result[] = $x;
            }
            if(count($result) > 0) {
                foreach($result as $row):

                    // Get interval between now and account creation
                    $elapsed = $this->elapsed($row['created_at']);

                    // Phone
                    $phoneNumber = $row['whatsapp'];
                    // Format 1: 0333-5265024
                    $formatted1 = substr($phoneNumber, 0, 4) . "-" . substr($phoneNumber, 4);
                    // Format 2: 0333-5265 ***
                    $formatted2 = substr($phoneNumber, 0, 4) . "-" . substr($phoneNumber, 4, 4) . " ***";

                    $user_array = array(
                        'id' => $row['id'],
                        'relationship' => $row['relationship'],
                        'fullname' => $row['fullname'],
                        'email' => $row['email'],
                        'pwd' => $row['pwd'],
                        'whatsapp' => $formatted1,
                        'phone_redacted' => $formatted2,
                        'gender' => $row['gender'],
                        'age' => $row['age'],
                        'user_description' => $row['user_description'],
                        'marital_status' => $row['marital_status'],
                        'caste' => $row['caste'],
                        'education' => $row['education'],
                        'occupation' => $row['occupation'],
                        'city' => $row['city'],       
                        'feet' => $row['feet'],
                        'inch' => $row['inch'],
                        'photo' => $row['photo'],
                        'user_status' => $row['user_status'],
                        'account_status' => $row['account_status'],
                        'created_at' => $row['created_at'],
                        'updated_at' => $row['updated_at'],
                        'package_id' => $row['package_id'],
                        'payment_method_id' => $row['payment_method_id'], 
                        'elapsed' => $elapsed,
                        'payment_proof' => $row['payment_proof'],
                        'basket_id' => $row['basket_id'],
                        'payment_id' => $row['payment_id'],
                        'payment_status' => $row['payment_status']
                    );
                    array_push($users_array, $user_array);
                endforeach;
                $stmt->close();
            } else {
                $users_array = array();
            }
            return $users_array;
            // var_dump($contacts_array);
        }
        private function getUsersByGender($user_status, $account_status, $gender) {
            $users_array = array();
            $stmt = $this->con->prepare("SELECT * FROM user_account WHERE user_status=? AND account_status=? AND gender=? ORDER BY id DESC");
            $stmt->bind_param('sss', $user_status, $account_status, $gender);
            $stmt->execute();
            
            $meta = $stmt->result_metadata();
            $result = array();
            while ($field = $meta->fetch_field()) {
                $parameters[] = &$row[$field->name];
            }
            call_user_func_array(array($stmt, 'bind_result'), $parameters);
            while ($stmt->fetch()) {
                foreach($row as $key => $val) {
                    $x[$key] = $val;
                }
                $result[] = $x;
            }
            if(count($result) > 0) {
                foreach($result as $row):

                    // Get interval between now and account creation
                    $created_at = new DateTime($row['created_at'], new DateTimeZone('Asia/Karachi') );

                    $date = new DateTime("now", new DateTimeZone('Asia/Karachi') );

                    $interval = $date->diff($created_at);
                    $elapsed_str = $interval->format('%y years %m months %a days %h hours %i minutes %s seconds');
                    $elapsed_array = explode(' ', $elapsed_str);
                    $elapsed = '';
                    if(intval($elapsed_array[0]) > 0) {
                        if(intval($elapsed_array[0]) == 1) {
                            $elapsed = strval($elapsed_array[0]) . ' yr ago';
                        } else {
                            $elapsed = strval($elapsed_array[0]) . ' yrs ago';
                        }
                    } elseif(intval($elapsed_array[2]) > 0) {
                        if(intval($elapsed_array[2]) == 1) {
                            $elapsed = strval($elapsed_array[2]) . ' month ago';
                        } else {
                            $elapsed = strval($elapsed_array[2]) . ' months ago';
                        }
                    } elseif(intval($elapsed_array[4]) > 0) {
                        if(intval($elapsed_array[4]) == 1) {
                            $elapsed = strval($elapsed_array[4]) . ' day ago';
                        } else {
                            $elapsed = strval($elapsed_array[4]) . ' days ago';
                        }
                    } elseif(intval($elapsed_array[6]) > 0) {
                        if(intval($elapsed_array[6]) == 1) {
                            $elapsed = strval($elapsed_array[6]) . ' hr ago';
                        } else {
                            $elapsed = strval($elapsed_array[6]) . ' hrs ago';
                        }
                    } elseif(intval($elapsed_array[8]) > 0) {
                        if(intval($elapsed_array[8]) == 1) {
                            $elapsed = strval($elapsed_array[8]) . ' min ago';
                        } else {
                            $elapsed = strval($elapsed_array[8]) . ' mins ago';
                        }
                    } elseif(intval($elapsed_array[10]) > 0) {
                        if(intval($elapsed_array[10]) == 1) {
                            $elapsed = strval($elapsed_array[10]) . ' second ago';
                        } else {
                            $elapsed = strval($elapsed_array[10]) . ' seconds ago';
                        }
                    }

                    // Check if photo exists
                    // if(!isset($row['photo']) || empty($row['photo'])) {
                    //     $photo = 'avi.jpg';
                    // } else {
                    //     $photo = $row['photo'];
                    // }
                    $phone_str_1 = substr($row['whatsapp'], 0, 4);
                    $phone_str_2 = substr($row['whatsapp'], 6, 8);
                    $phone_str_3 = '****';
                    $phone_redacted = $phone_str_1.'-'.$phone_str_2.' '.$phone_str_3;



                    $phoneNumber = $row['whatsapp'];

                    // Format 1: 0333-5265024
                    $formatted1 = substr($phoneNumber, 0, 4) . "-" . substr($phoneNumber, 4);
                    // Format 2: 0333-5265 ***
                    $formatted2 = substr($phoneNumber, 0, 4) . "-" . substr($phoneNumber, 4, 4) . " ***";





                    $user_array = array(
                        'id' => $row['id'],
                        'relationship' => $row['relationship'],
                        'fullname' => $row['fullname'],
                        'email' => $row['email'],
                        'pwd' => $row['pwd'],
                        'whatsapp' => $formatted1,
                        'phone_redacted' => $formatted2,
                        'gender' => $row['gender'],
                        'age' => $row['age'],
                        'user_description' => $row['user_description'],
                        'marital_status' => $row['marital_status'],
                        'caste' => $row['caste'],
                        'education' => $row['education'],
                        'occupation' => $row['occupation'],
                        'city' => $row['city'],
                        'photo' => $row['photo'],
                        'user_status' => $row['user_status'],
                        'account_status' => $row['account_status'],
                        'created_at' => $row['created_at'],
                        'updated_at' => $row['updated_at'],
                        'package_id' => $row['package_id'],
                        'payment_method_id' => $row['payment_method_id'], 
                        'elapsed' => $elapsed,
                        'payment_proof' => $row['payment_proof']
                    );
                    array_push($users_array, $user_array);
                endforeach;
                $stmt->close();
            } else {
                $users_array = array();
            }
            return $users_array;
            // var_dump($contacts_array);
        }
        public function current_account_status($id) {
            $stmt = $this->con->prepare("SELECT * FROM user_account WHERE id=? LIMIT 1");
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $data = $result->fetch_all(MYSQLI_ASSOC);
            if(count($data) > 0) {
                foreach($data as $row) {
                    $account_status = $row['account_status'];
                }
            }
            return $account_status;
        }
        // User Bookmrk functions
        public function bookmarks_by_user($bookmarked_by_id) {
            $stmt = $this->con->prepare("SELECT profile_id FROM bookmarks WHERE bookmarked_by_id=? ORDER BY bookmark_id DESC");
            $stmt->bind_param('i', $bookmarked_by_id);
            $stmt->execute();
            $result = $stmt->get_result();
            
            // Initialize an empty array to store the profile_ids
            $profile_ids = array();
        
            // Loop through the result set and extract the profile_id values
            while ($row = $result->fetch_assoc()) {
                // Add the profile_id to the array
                $profile_ids[] = $row['profile_id'];
            }
        
            // Close the statement
            $stmt->close();
        
            // Return the array of profile_ids
            return $profile_ids;
        }    
        public function check_proposal_in_bookmarks($proposal_id, $profile_ids_array) {
            if (in_array($proposal_id, $profile_ids_array)) {
                return true;
            } else {
                return false;
            }
        } 
        /*
        =================================================================
            VERIFICATION & VALIDATION
        =================================================================  
        */
        public function check_duplicate_user($email) {
            $exclude_status = 'deleted';
            $stmt = $this->con->prepare("SELECT * FROM user_account WHERE email=? AND account_status!=?");
            $stmt->bind_param('ss', $email, $exclude_status);
            $stmt->execute();
            
            $meta = $stmt->result_metadata();
            $result = array();
            while ($field = $meta->fetch_field()) {
                $parameters[] = &$row[$field->name];
            }
            call_user_func_array(array($stmt, 'bind_result'), $parameters);
            while ($stmt->fetch()) {
                foreach($row as $key => $val) {
                    $x[$key] = $val;
                }
                $result[] = $x;
            }
            if(count($result) > 0) {
                echo "<div style='margin-top:4px;' class=error>Email already exists</div>";
            } else {
                echo "";
            }
        }
        public function generate_code($user_id) {
            // Generate a 6-digit code
            $code = mt_rand(100000, 999999);
            
            // Calculate the expiration time (30 minutes from now)
            $expires = date("U") + 1800;
            
            // Prepare the SQL statement
            $stmt = $this->con->prepare("INSERT INTO email_verify (user_id, code, expires) VALUES (?, ?, ?)");
            
            // Bind parameters to the statement
            $stmt->bind_param("iss", $user_id, $code, $expires);
            
            // Execute the statement
            $stmt->execute();
            
            // Close the statement and database connection
            $stmt->close();
            
            // Return the generated code
            return $code;
        }
        public function send_approval_email($email) {
            $to = $email;
            $subject = 'Congratulations! Your profile has been approved.';
            $msgBody = "
                <p style='font-size: 15px; margin-bottom: 20px;'>Your profile at <a href='https://rishtehaar.com' aria-label='Rishtehaar.com'>Rishtehaar.com</a> where you find online rishta in Pakistan and abroad has been successfully approved by our admin team.</p>
                <p style='font-size: 15px; margin-bottom: 20px;'>Login now at: <a href='https://rishtehaar.com/login'>Rishtehaar.com/login</a></p>
                <p style='font-size: 15px; margin-bottom: 20px;'>Regards,<br>Team Rishtehaar</p>
                <p style='font-size: 15px; margin-bottom: 20px;'>For any questions, contact us at <a href='mailto:services@rishtehaar.com' aria-label='Rishtehaar.com'>services@rishtehaar.com</a></p>
            ";
            $this->sendEmailSwiftMailer($to, $subject, $msgBody);
        }
        public function check_user_cookie() {
            if(!isset($_SESSION['user'])) {
                if(isset($_COOKIE['uid']) && isset($_COOKIE['user_email']) && isset($_COOKIE['user_password'])){
                    $uid = $_COOKIE['uid'];
                    $user_email = $_COOKIE['user_email'];
                    $user_password = $_COOKIE['user_password'];

                    $exclude_status = 'deleted';

                    $stmt = $this->con->prepare("SELECT * FROM user_account WHERE id=? AND email=? AND pwd=? AND account_status!=?");
                    $stmt->bind_param('isss', $uid, $user_email, $user_password, $exclude_status);
                    $stmt->execute();       
                    $meta = $stmt->result_metadata();
                    $result = array();
                    while ($field = $meta->fetch_field()) {
                        $parameters[] = &$row[$field->name];
                    }
                    call_user_func_array(array($stmt, 'bind_result'), $parameters);
                    while ($stmt->fetch()) {
                        foreach($row as $key => $val) {
                            $x[$key] = $val;
                        }
                        $result[] = $x;
                    }
                    if(count($result) == 0) {
                        return;
                    } else {
                        foreach($result as $row):
                            if($user_password === $row['pwd']) {
                            // if($pwd_check == true) {
                                $userdata = array(
                                    'logged' => 1,
                                    'uid' => $row['id'],
                                    'email' => $row['email'],
                                    'user_img' => $row['photo'],
                                    'user_status' => $row['user_status'],
                                    'account_status' => $row['account_status'],
                                    'gender' => $row['gender']
                                );
                                $_SESSION['user'] = json_encode($userdata);       
                            }
                        endforeach;
                    }        
                    $stmt->close();
                } else {
                    return;
                }
            }
        }
        public function send_verification_code($email, $user_id) {
            // Generate Code
            $code = $this->generate_code($user_id);
            // Reciever
            $to = $email;
            // Subject
            $subject = 'Rishtehaar Verification Code';
            // Message
            $msgBody = "<div style='width: 500px; margin: 0 auto;'>
                <h1 style='line-height: 1;
                color: rgb(0,134,62); font-weight: 600; font-size: 30px; margin-bottom: 0px;'>Rishtehaar</h1>
                <h2 style='font-size: 25px; color: rgb(227,54,24); margin-top: 10px; margin-bottom: 10px;'>Please Verify Your Email Address</h2>
                <p style='margin-bottom: 20px; color: #707076;'>To finish creating your Rishtehaar account, copy the verification code below and paste it into the \"Verify the Email Address\" screen in your browser: </p>
                <div style='margin-bottom: 20px; width: 100%; text-align: center; color: #707076; border: 1px solid #707076; background: #f4f4f4; padding: 10px; font-size: 20px;'>$code</div>
                <p style='color: #707076;'>If you need any assistance with your account, please <a style='color: rgb(227,54,24);' href='mailto:services@rishtehaar.com'>contact support</a></p>
            </div>";
            // Send Email
            $this->sendEmailSwiftMailer($to, $subject, $msgBody);
        }
        public function verify_email() {
    
            // Get the user ID from the get_uid() function
            $user_id = $this->get_uid(); // Assuming you have implemented the get_uid() function
            
            // Get the verification code from the $_POST['code'] variable
            $verification_code = $_POST['code']; // Assuming the verification code is sent via POST
            
            // Get the current timestamp
            $current = date("U"); 
            
            
            // Prepare the SELECT statement to fetch the matching row
            $stmt = $this->con->prepare("SELECT * FROM email_verify WHERE user_id = ? AND code = ? AND expires >= ? LIMIT 1");
            $stmt->bind_param('iss', $user_id, $verification_code, $current);
            $stmt->execute();
            
            // Get the result
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
                // Fetch the row
                $row = $result->fetch_assoc();
                
                // Check if the verification code matches
                if ($verification_code === $row['code']) {
                    // Check if the current timestamp is smaller than or equal to the expiration timestamp
                    if ($current <= $row['expires']) {


                        $new_status = 'Under Verification';
                        $stmt2 = $this->con->prepare("UPDATE user_account SET account_status=? WHERE id=?");
                        $stmt2->bind_param('si', $new_status, $user_id);
                        if($stmt2->execute()) {
                            // Close the statement
                            $stmt2->close();

                            // Delete rows with the matching user ID
                            $stmt3 = $this->con->prepare("DELETE FROM email_verify WHERE user_id = ?");
                            $stmt3->bind_param('i', $user_id);
                            $stmt3->execute();
                            $stmt3->close();

                            $status = '1';
                            // Update the session data
                            $userdata = json_decode($_SESSION['user'], true);

                            $order_date = get_order_date();

                            $new_userdata = array(
                                'logged' => 1,
                                'uid' =>  $userdata['uid'],
                                'email' =>  $userdata['email'],
                                'user_img' =>  $userdata['user_img'],
                                'user_status' =>  $userdata['user_status'],
                                'account_status' => 'Under Verification',
                                'gender' => $userdata['gender'],
                                'whatsapp' => $userdata['whatsapp'],
                                'basket_id' => $userdata['basket_id'],
                                'payment_status' => $userdata['payment_status'],
                                'order_date' => $order_date
                            );
                            // Set the new user session data
                            $_SESSION['user'] = json_encode($new_userdata);
                            
                            // Update the user cookie if it is set
                            if (isset($_COOKIE['user'])) {
                                $cookieData = json_decode($_COOKIE['user'], true);
                                $cookieData['logged'] = 1;
                                $cookieData['account_status'] = 'Under Verification';
                                setcookie("user", json_encode($cookieData), time() + (10 * 365 * 24 * 60 * 60), '/');
                            }


                            // Notify admin through email
                            $msgBody = "<div>
                                <p style='color: #707076; margin-bottom: 10px; '>A new user has registered and waiting for approval.</p>
                                <p style='color: #707076;'>Email Address: {$userdata['email']}</p>
                            </div>";
                            // $this->sendEmailSwiftMailer('testemail6329@gmail.com', 'Rishtehaar User Registration', $msgBody);
                            $this->sendEmailSwiftMailer('jessipinkmanabq@gmail.com', 'Rishtehaar User Registration', $msgBody);
                        } else {
                            $status = '5';
                        }      
                    } else {
                        $status = '2';
                    }
                } else {
                    $status = '3';
                }
            } else {
                $status = '4';
            }


    
            echo $status;
        }
        public function delete_code($user_id) {
            $stmt = $this->con->prepare("DELETE FROM email_verify WHERE user_id = ?");
            $stmt->bind_param('i', $user_id);
            $stmt->execute();
            $stmt->close();
        }
        public function resend_code() {
            $this->startSession();
            $_SESSION['timer_start'] = time();
            // USER ID
            $user_id = $this->get_uid();
            $email = $this->get_user_email();
            // DELETE OLD CODE
            $this->delete_code($user_id);
            // SEND EMAIL
            if($_SERVER['SERVER_NAME'] != 'localhost') {
                $this->send_verification_code($email, $user_id);
            }
            echo '1';
        }
        public function signup_email($email) {
            $selector = bin2hex(random_bytes(8));
            $token = random_bytes(32);
            $hashedToken = password_hash($token, PASSWORD_DEFAULT);
            // This link will be sent to the user by email
            $url = "https://rishtehaar.com/confirmation?selector=".$selector."&validator=".bin2hex($token);
    
            // var_dump($selector, $hashedToken, $email);

            $stmt = $this->con->prepare("UPDATE user_account SET selector=?, validator=? WHERE email=?");
            $stmt->bind_param('sss', $selector, $hashedToken, $email);
            $stmt->execute();

            
            $to = $email;
            $subject = 'Email from Rishtehaar'; 
            $msgBody = "<h1 style='text-align: center; font-family: sans-serif; font-size: 40px; margin-bottom: 20px;'>Hi, Rishtehaar user</h1>";
            $msgBody .= "<p style='font-size: 16px; text-align: center; margin-bottom: 10px;'>Thank you for signing up.</p>";
            $msgBody .= "<p style='font-size: 16px; text-align: center; margin-bottom: 10px;'>Please click on the button below to confirm your email address.</p>";
            $msgBody .= "<a style='text-align: center; display: flex; max-width: 160px; text-align: center; text-decoration: none; padding: 15px 20px; margin: 20px auto; background-color:rgb(195, 139, 0); border:1px solid rgb(195,139,0); color:#fff; border-radius:4px; font-size:14px;' href='$url'>
                <span style='margin: 0 auto;'>Confirm my Email</span>
            </a>";
            $msgBody .= "<p style='font-size: 16px; text-align: center; margin-bottom: 10px;'>Regards,</p>";
            $msgBody .= "<p style='font-size: 16px; text-align: center; margin-bottom: 10px;'>Rishtehaar support team</p>";
            $this->sendEmailSwiftMailer($to, $subject, $msgBody);    


            $to_2 = 'israrulhaq67@gmail.com';
            $this->sendEmailSwiftMailer($to_2, $subject, $msgBody);  
            // var_dump($to, $subject, $msgBody, $to_2);
        }
        public function generatePwdLink($email) {
            // GENERATE PASSWORD LINK
            $selector = bin2hex(random_bytes(8));
            $token = random_bytes(32);
            
            // This link will be sent to the user by email
            $url = "https://rishtehaar.com/create-new-password?selector=".$selector."&validator=".bin2hex($token);
            // Expiration date for token (1800ms = 1hr)
            $expires = date("U") + 1800;
    
            // Insert token in the database (we'll need a new table for this)
            // DELETE EXISTING TOKENS
            $stmt = $this->con->prepare("DELETE FROM pwd_reset WHERE pwd_reset_email=?");
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $stmt->close();
    
            // INSERT NEW TOKEN
            $stmt = $this->con->prepare("INSERT INTO pwd_reset (pwd_reset_email, pwd_reset_selector, pwd_reset_token, pwd_reset_expires) VALUES (?, ?, ?, ?);");
            $hashedToken = password_hash($token, PASSWORD_DEFAULT);
            $stmt->bind_param('ssss', $email, $selector, $hashedToken, $expires);
            $stmt->execute();
            $stmt->close();
    
            return $url;
            
        }
        public function verify_email_2() {
            $selector = $_GET['selector'];
            $validator = $_GET['validator'];
    
            $stmt = $this->con->prepare("SELECT * FROM user_account WHERE selector=? LIMIT 1");
            $stmt->bind_param('s', $selector);
            $stmt->execute();
            $meta = $stmt->result_metadata();
            $result = array();
            while ($field = $meta->fetch_field()) {
                $parameters[] = &$row[$field->name];
            }
            call_user_func_array(array($stmt, 'bind_result'), $parameters);
            while ($stmt->fetch()) {
                foreach($row as $key => $val) {
                    $x[$key] = $val;
                }
                $result[] = $x;
            }
            if(count($result) > 0) {
                foreach($result as $row):
                    $token_bin = hex2bin($validator);
                    $email = $row['email'];
                    $token_check = password_verify($token_bin, $row['validator']);
                endforeach;
            }
            $stmt->close();
            if($token_check) {
                $account_status = 'approved';
                
                $stmt = $this->con->prepare("UPDATE user_account SET account_status=? WHERE email=?");
                $stmt->bind_param('ss', $account_status, $email);
                if($stmt->execute()) {
                    $status = '1';
                } else {
                    $status = '0';
                }
            } else {
                $status = '2';
            }
            return $status;
        }
        public function generate_pwd( $length ) {

            $chars = "0123456789";
            // $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            return substr(str_shuffle($chars), 0, $length);
        
        }
        /*
        =================================================================
            EMAIL
        =================================================================  
        */
        public function sendEmail($to, $subject, $text, $html) {
            require_once '../vendor/autoload.php';
 
            $transport = new SendmailTransport(); 
            $mailer = new Mailer($transport); 
            
            // $email = (new Email())
            //     ->from('services@rishtehaar.com')
            //     ->to('shadmanwebdev@gmail.com')
            //     ->priority(Email::PRIORITY_HIGHEST)
            //     ->subject('New Email')
            //     ->text('This is a test message!')
            //     ->html('<strong>This is a test message!</strong>');
            $email = (new Email())
                ->from('services@rishtehaar.com')
                ->to($to)
                ->priority(Email::PRIORITY_HIGHEST)
                ->subject($subject)
                ->text($text)
                ->html($html);
            
            $mailer->send($email); 
        }
        public function email_exists($email) {
            // Check if email exists
            $account_status = 'approved';
            $stmt = $this->con->prepare("SELECT * FROM user_account WHERE email=?");
            $stmt->bind_param('s', $email);
            $stmt->execute();
            
            $meta = $stmt->result_metadata();
            $result = array();
            while ($field = $meta->fetch_field()) {
                $parameters[] = &$row[$field->name];
            }
            call_user_func_array(array($stmt, 'bind_result'), $parameters);
            while ($stmt->fetch()) {
                foreach($row as $key => $val) {
                    $x[$key] = $val;
                }
                $result[] = $x;
            }
            if(count($result) > 0) {
                return '1';
            } else {
                return '0';
            }
        }
        // public function sendEmailSwiftMailer($to, $subject, $msgBody) {
        //     // Swiftmailer            
        //     // require_once '../vendor/autoload.php';
        //     $currentDirectory = __DIR__;
        //     $autoloadPath = $currentDirectory . '/../vendor/autoload.php';

        //     if (file_exists($autoloadPath)) {
        //         require_once $autoloadPath;
        //         // Create the Transport
        //         $transport = (new Swift_SmtpTransport('mail.privateemail.com', 465, 'ssl'))
        //         ->setUsername('services@rishtehaar.com')
        //         ->setPassword('?i$b90EP753')
        //         ;
        //         // Create the Mailer using your created Transport
        //         $mailer = new Swift_Mailer($transport);
                
        //         $message = (new Swift_Message($subject))
        //         ->setFrom(['services@rishtehaar.com' => 'Rishtehaar'])
        //         ->setTo([$to])
        //         ->setBody($msgBody,'text/html')
        //         ;
        //         // Send the message
        //         $result = $mailer->send($message);
        //     } else {
        //         die("Unable to locate or include vendor/autoload.php");
        //     }
        // }
        public function sendEmailSwiftMailer($to, $subject, $msgBody) {
            // Load config file
            $config = require __DIR__ . '/../config.php';
        
            // Swiftmailer
            $currentDirectory = __DIR__;
            $autoloadPath = $currentDirectory . '/../vendor/autoload.php';
        
            if (file_exists($autoloadPath)) {
                require_once $autoloadPath;
        
                // Create the Transport
                $transport = (new Swift_SmtpTransport(
                    $config['SMTP_SERVER'], 
                    $config['SMTP_PORT'], 
                    $config['SMTP_ENCRYPTION']
                ))
                ->setUsername($config['SMTP_USERNAME'])
                ->setPassword($config['SMTP_PASSWORD']);
        
                // Create the Mailer using your created Transport
                $mailer = new Swift_Mailer($transport);
        
                // Create a message
                $message = (new Swift_Message($subject))
                    ->setFrom([$config['EMAIL_FROM'] => $config['EMAIL_FROM_NAME']])
                    ->setTo([$to])
                    ->setBody($msgBody, 'text/html');
        
                // Send the message
                $result = $mailer->send($message);
                return $result;
            } else {
                die("Unable to locate or include vendor/autoload.php");
            }
        }
        /*
        =================================================================
            DISPLAY
        =================================================================  
        */
        public function createProposalHTML($user_array, $profile_ids_array) {
            $logged_in = is_logged_in();
            $user_account_status = get_account_status();
            $payment_status = get_payment_status();

            $user_description = nl2br($user_array['user_description']);

            // Photo
            $photoStr = $this->get_photo_str_2($user_array['photo'], $user_account_status, $user_array['gender']);

            // WhatsApp + Bookmarks
            $whatsapp_icon = $this->whatsapp_icon();
            $whatsapp_content = $this->whatsapp_content($user_array['id'], $user_array['phone_redacted'], $user_array['whatsapp']);
            if($logged_in == '1') {
                $proposal_bookmark_check = $this->check_proposal_in_bookmarks($user_array['id'], $profile_ids_array);
                if($proposal_bookmark_check) {
                    $bookStr = "<div class='bookmark-icon-wrapper'>
                        <img class='bookmark-icon bookmark-{$user_array['id']}' src='./assets/svg/bookmark.svg' alt='bookmark' style='display: none;' />
                        <img class='bookmark-icon-filled bookmark-filled-{$user_array['id']}' src='./assets/svg/bookmark-filled.svg' style='display: block;' alt='bookmark' />
                    </div>
                    <div class='bookmark-text'>
                        <p>Save</p>
                    </div>";
                } else {
                    $bookStr = "<div class='bookmark-icon-wrapper'>
                        <img class='bookmark-icon bookmark-{$user_array['id']}' src='./assets/svg/bookmark.svg' style='display: block;' alt='bookmark' />
                        <img class='bookmark-icon-filled bookmark-filled-{$user_array['id']}' src='./assets/svg/bookmark-filled.svg' style='display: none;' alt='bookmark' />
                    </div>
                    <div class='bookmark-text'>
                        <p>Save</p>
                    </div> ";
                }
            } else {
                $bookStr = "<div class='bookmark-icon-wrapper'>
                    <img class='bookmark-icon bookmark-{$user_array['id']}' src='./assets/svg/bookmark.svg' style='display: block;' alt='bookmark' onclick='redirect_to_register()' />
                    <img class='bookmark-icon-filled bookmark-filled-{$user_array['id']}' src='./assets/svg/bookmark-filled.svg' style='display: none;' alt='bookmark' />
                </div>
                <div class='bookmark-text'>
                    <p>Save</p>
                </div>";
            }
            $onclick = "onclick='bookmark(\"{$user_array['id']}\")'";
            if(!empty($user_account_status) && isset($user_account_status) && $payment_status == 'success') {
                
                $whatsappStr = "<div class='proposal-contact'>
                    <div class='proposal-contact-col' id='proposal-contact-col-1'>
                        <div>
                            Contact Number
                        </div>
                        <div>
                            $whatsapp_icon
                            $whatsapp_content
                        </div>
                    </div>     
                    <div class='proposal-contact-col' id='proposal-contact-col-2' $onclick>
                        $bookStr
                    </div>     
                </div>";
                $whatsappStrMob = "<div class='proposal-contact' id='proposal-contact-{$user_array['id']}'>
                    <div class='proposal-contact-col' id='proposal-contact-col-1'>
                        <div>
                            Contact Number
                        </div>
                        <div>
                            $whatsapp_icon
                            $whatsapp_content
                        </div>
                    </div>     
                    <div class='proposal-contact-col' id='proposal-contact-col-2' $onclick>
                        $bookStr
                    </div>   
                </div>";
            } else {
                
                $whatsappStr = "<div class='proposal-contact'>
                    <div class='proposal-contact-col' id='proposal-contact-col-1'>
                        <div>
                            Contact Number
                        </div>
                        <div>
                            $whatsapp_icon
                            $whatsapp_content
                        </div>
                    </div>   
                    <div class='proposal-contact-col' id='proposal-contact-col-2' $onclick>
                        $bookStr 
                    </div> 
                </div>";
                $whatsappStrMob = "<div class='proposal-contact' id='proposal-contact-{$user_array['id']}'>
                    <div class='proposal-contact-col' id='proposal-contact-col-1'>
                        <div>
                            Contact Number
                        </div>
                        <div>
                            $whatsapp_icon
                            $whatsapp_content
                        </div>
                    </div>   
                    <div class='proposal-contact-col' id='proposal-contact-col-2' $onclick>
                        $bookStr
                    </div> 
                </div>";
            }


            // Height
            if(empty($user_array['inch']) && !empty($user_array['inch'])) {
                $height = $user_array['feet'] . ' ft';
            } else if(!empty($user_array['feet']) && !empty($user_array['inch'])) {
                $height = $user_array['feet'] . ' ft, ' . $user_array['inch'] . ' in';
            } else {
                $height = '';
            }


            $proposalHTML = "
            <div class='proposal'>
                <div class='proposal-head'>
                    <div class='col' id='col-1'>
                        <span>Profile for: </span>
                        <span>{$user_array['relationship']}</span>
                    </div>
                    <div class='col proposal-status' id='col-2'>
                        <span class='verify-span'>
                            <img src='./assets/img/verified.png' alt='verify-img'>
                            <span>Verified</span>
                        </span>
                    </div>
                </div>
                <div class='proposal-body'>
                    <div class='proposal-info-col col' id='col-1'>
                        <div class='proposal-info'>
                            <span>Gender</span>
                            <span>{$user_array['gender']}</span>
                        </div>
                        <div class='proposal-info'>
                            <span>Age</span>
                            <span>{$user_array['age']}</span>
                        </div>
                        <div class='proposal-info'>
                            <span>Marital Status</span>
                            <span>{$user_array['marital_status']}</span>
                        </div>
                        <div class='proposal-info'>
                            <span>Caste</span>
                            <span>{$user_array['caste']}</span>
                        </div>
                    </div>
    
                    <div class='proposal-info-col col' id='col-2'>
                        <div class='proposal-info'>
                            <span>Education</span>
                            <span>{$user_array['education']}</span>
                        </div>
                        <div class='proposal-info'>
                            <span>Occupation</span>
                            <span>{$user_array['occupation']}</span>
                        </div>
                        <div class='proposal-info'>
                            <span>City</span>
                            <span>{$user_array['city']}</span>
                        </div>
                        <div class='proposal-info'>
                            <span>Height</span>
                            <span style='text-transform: lowercase;'>$height</span>
                        </div>
                    </div>
                    <div class='col' id='col-3'>
                        $photoStr
                    </div>
                </div>             
                <div class='proposal-footer'>
                    <div class='proposal-description'>
                        <div>Description</div>
                        <div>{$user_description}</div>     
                    </div>     
                    $whatsappStr    
                </div>     
            </div>
            <div class='proposal proposal-mobile'>
                <div class='proposal-head'>
                    <div class='col' id='col-1'>
                        <span>Profile for: </span>
                        <span>{$user_array['relationship']}</span>
                    </div>
                    <div class='col proposal-status' id='col-2'>
                        <span class='verify-span'>
                            <img src='./assets/img/verified.png' alt='verify-img'>
                            <span>Verified</span>
                        </span>
                    </div>
                </div>
                <div class='proposal-body'>
                    <div class='col' id='col-3'>
                        $photoStr
                    </div>
                    <div class='col' id='col-1'>
                        <div class='proposal-description'>
                            <div>Description</div>
                            <div>{$user_description}</div>     
                        </div>
                    </div>
                    <div class='proposal-info-col col' id='col-2 proposal-info-{$user_array['id']}'>
                        <div class='proposal-info'>
                            <span>Gender</span>
                            <span>{$user_array['gender']}</span>
                        </div>
                        <div class='proposal-info'>
                            <span>Age</span>
                            <span>{$user_array['age']}</span>
                        </div>
                        <div class='proposal-info'>
                            <span>Marital Status</span>
                            <span>{$user_array['marital_status']}</span>
                        </div>
                        <div class='proposal-info'>
                            <span>Caste</span>
                            <span>{$user_array['caste']}</span>
                        </div>
                        <div class='proposal-info'>
                            <span>Education</span>
                            <span>{$user_array['education']}</span>
                        </div>
                        <div class='proposal-info'>
                            <span>Occupation</span>
                            <span>{$user_array['occupation']}</span>
                        </div>
                        <div class='proposal-info'>
                            <span>City</span>
                            <span>{$user_array['city']}</span>
                        </div>
                        <div class='proposal-info'>
                            <span>Height</span>
                            <span style='text-transform: lowercase;'>$height</span>
                        </div>
                    </div>
                    $whatsappStrMob
                </div> 
                
                <div class='show-details-wrapper'>
                    <div id='{$user_array['id']}' class='show-details show-details-{$user_array['id']}' onclick='proposalDetails(this.id);'>
                        <img src='./assets/svg/show-proposal-icon.svg' alt='Show Proposal' />
                        Show Details
                    </div>
                </div>             
            </div>";
        
            return $proposalHTML;
        }
        public function showProposals() {
            $this->startSession();
            $logged_in = $this->is_logged_in();
            $logged_in_user = $this->get_uid();
            $user_gender = $this->get_user_gender();

            // if(!isset($user_gender) || empty($user_gender)) {
                $users_array = $this->getUsersByStatus('member', 'approved');
            // }
            // else if($user_gender == 'male') {
            //     $users_array = $this->getUsersByGender('member', 'approved', 'female');
            // } else if($user_gender == 'female') {
            //     $users_array = $this->getUsersByGender('member', 'approved', 'male');
            // }

            
            $num_of_rows = count($users_array);
            $results_per_page = 5;
            // Number of total pages available
            $num_of_pages = ceil($num_of_rows/$results_per_page);
            // Determine which page user is currently on
            if(!isset($_POST['page'])) {
                $page = 1;
            } else {
                if($_POST['page'] == 0) {
                    $page = 1;
                } else {
                    $page = intval($_POST['page']);
                }
            }
            $starting_limit_number = ($page-1)*$results_per_page;

            $proposalsStr = "";
            
            $profile_ids_array = $this->bookmarks_by_user($logged_in_user);

            for($x=$starting_limit_number; $x<$starting_limit_number+$results_per_page; $x++) {
                if($x < $num_of_rows) {
                    $user_array = $users_array[$x];
                    $proposalsStr .= $this->createProposalHTML($user_array, $profile_ids_array);
                }
            }
            if($page == 1) {
                $prev = $page;
            } else {
                $prev = $page - 1;
            }
            if($page == $num_of_pages) {
                $next = $page;
            } else {
                $next = $page + 1;
            }

            $p = ($page > 1 ? ($page - 1) : 1);
            $proposalFooter = "<div class='pagination'>
            <div>
                <a class='page-num arrow'  onclick=\"filter(event, $p)\">
                    <i class='fas fa-arrow-left'></i>
                </a>
            </div>
            <div class='pagination-links'>";
        
            // Show links only if there is more than one page
            if ($num_of_pages > 1) {
                // Show the current page and links for next 2 pages
                for ($p = $page; $p <= min($num_of_pages, $page + 2); $p++) {
                    if ($p != $page) {
                        $proposalFooter .= "<a class='page-num' onclick=\"filter(event, $p)\">" . $p . "</a> ";
                    } else {
                        $proposalFooter .= "<a class='page-num current-page' onclick=\"filter(event, $p)\">" . $p . "</a> ";
                    }
                }
            
                // Skip links for 2 pages
                if ($page + 4 < $num_of_pages) {
                    $proposalFooter .= "<span>...</span> ";
                }
            
                // Show the link for the 6th page if available
                if ($page + 4 < $num_of_pages) {
                    $p = $page + 4;
                    $proposalFooter .= "<a class='page-num' onclick=\"filter(event, $p)\">" . $p . "</a> ";
                } 
                else if ($page + 3 < $num_of_pages) {
                    $p = $page + 3;
                    $proposalFooter .= "<a class='page-num' onclick=\"filter(event, $p)\">" . $p . "</a> ";
                }
            } else {
                // If there's only one page, show the link for the current page and previous/next page links
                $proposalFooter .= "<a class='page-num current-page' onclick=\"filter(event, $page)\">" . $page . "</a> ";
            }

            $p = ($page < $num_of_pages ? ($page + 1) : $num_of_pages);

            $proposalFooter .= "</div>
                <div>
                    <a class='page-num arrow' onclick=\"filter(event, $p)\">
                        <i class='fas fa-arrow-right'></i>
                    </a>
                </div>
            </div>";

            $proposalsStr .= $proposalFooter;
            return $proposalsStr;
        }
        private function filterProposals($gender, $marital_status, $age, $education, $city, $occupation) {
            $users_array = array();
            $user_status = 'member';
            $account_status = 'approved';
        
            $conditions = array(); // Array to store the conditions for the query
        
            // Add conditions based on the search parameters
            // Marital Status
            if (strtolower($marital_status) !== 'any') {
                $conditions[] = "marital_status = '{$marital_status}'";
            }
            // Age
            if (strtolower($age) !== 'any') {
                if ($age == '40') {
                    $conditions[] = "age > 40";
                } else {
                    $ageArr = explode('-', $age);
                    $ageLowest = intval($ageArr[0]);
                    $ageHighest = intval($ageArr[1]);
                    $conditions[] = "age BETWEEN {$ageLowest} AND {$ageHighest}";
                }
            }
            // Gender
            if (strtolower($gender) !== 'any') {
                $conditions[] = "gender = '{$gender}'";
            }
            // City
            if (strtolower($city) !== 'any') {
                $conditions[] = "city = '{$city}'";
            }
            // Occupation
            if (strtolower($occupation) !== 'any') {
                $conditions[] = "occupation = '{$occupation}'";
            }
            // Education
            if (strtolower($education) !== 'any') {
                $conditions[] = "education = '{$education}'";
            }
        
            // Construct the WHERE clause
            $whereClause = '';
            if (!empty($conditions)) {
                $whereClause = ' ' . implode(' AND ', $conditions);
            }
            if(!empty($whereClause)) {
                $whereClause = 'AND ' . $whereClause;
            }

            // Construct the final SQL query
            $sql = "SELECT * FROM user_account 
                    WHERE user_status = ? AND account_status = ? {$whereClause} 
                    ORDER BY id DESC";

            // var_dump($sql);


            // Prepare the statement
            $stmt = $this->con->prepare($sql);

            // Check if the prepare() function returned false
            if ($stmt === false) {
                die('Error in SQL statement: ' . $this->con->error);
            }

            
            $stmt->bind_param('ss', $user_status, $account_status);
            
        
            // Execute the query and fetch the results
            $stmt->execute();
            $result = $stmt->get_result();
            
            while ($row = $result->fetch_assoc()) {
                // Phone
                $phoneNumber = $row['whatsapp'];
                // Format 1: 0333-5265024
                $formatted1 = substr($phoneNumber, 0, 4) . "-" . substr($phoneNumber, 4);
                // Format 2: 0333-5265 ***
                $formatted2 = substr($phoneNumber, 0, 4) . "-" . substr($phoneNumber, 4, 4) . " ***";


                $user_array = array(
                    'id' => $row['id'],
                    'relationship' => $row['relationship'],
                    'fullname' => $row['fullname'],
                    'email' => $row['email'],
                    'pwd' => $row['pwd'],
                    'whatsapp' => $formatted1,
                    'phone_redacted' => $formatted2,
                    'gender' => $row['gender'],
                    'age' => $row['age'],
                    'user_description' => $row['user_description'],
                    'marital_status' => $row['marital_status'],
                    'caste' => $row['caste'],
                    'education' => $row['education'],
                    'occupation' => $row['occupation'],
                    'city' => $row['city'],
                    'feet' => $row['feet'],
                    'inch' => $row['inch'],
                    'photo' => $row['photo'],
                    'user_status' => $row['user_status'],
                    'account_status' => $row['account_status'],
                    'created_at' => $row['created_at'],
                    'updated_at' => $row['updated_at'],
                    'package_id' => $row['package_id'],
                    'payment_method_id' => $row['payment_method_id'], 
                    'elapsed' => $this->elapsed($row['created_at'])
                );
                array_push($users_array, $user_array);
            }
            return $users_array;
        } 
        public function showFilteredProposals($gender, $marital_status, $age, $education, $city, $occupation) {
            $logged_in = $this->is_logged_in();
            $logged_in_user = $this->get_uid();
            $user_gender = $this->get_user_gender();

            // Filtered Users
            $users_array = $this->filterProposals($gender, $marital_status, $age, $education, $city, $occupation);
  
            $num_of_rows = count($users_array);

            
            $user_account_status = $this->get_account_status();
            
            $results_per_page = 5;
            // Number of total pages available
            $num_of_pages = ceil($num_of_rows/$results_per_page);
            // var_dump($num_of_pages);
            // Determine which page user is currently on
            if(!isset($_POST['page'])) {
                $page = 1;
            } else {
                if($_POST['page'] == 0) {
                    $page = 1;
                } else {
                    $page = intval($_POST['page']);
                }
            }
            $starting_limit_number = ($page-1)*$results_per_page;

            $proposalsStr = "";

            $profile_ids_array = $this->bookmarks_by_user($logged_in_user);

            for($x=$starting_limit_number; $x<$starting_limit_number+$results_per_page; $x++) {
                if($x < $num_of_rows) {
                    $user_array = $users_array[$x];
                    $proposalsStr .= $this->createProposalHTML($user_array, $profile_ids_array);    
                }
            }
            if($page == 1) {
                $prev = $page;
            } else {
                $prev = $page - 1;
            }
            if($page == $num_of_pages) {
                $next = $page;
            } else {
                $next = $page + 1;
            }

            $p = ($page > 1 ? ($page - 1) : 1);
            $proposalFooter = "<div class='pagination'>
            <div>
                <a class='page-num arrow'  onclick=\"filter(event, $p)\">
                    <i class='fas fa-arrow-left'></i>
                </a>
            </div>
            <div class='pagination-links'>";
        
            // Show links only if there is more than one page
            if ($num_of_pages > 1) {
                // Show the current page and links for next 2 pages
                for ($p = $page; $p <= min($num_of_pages, $page + 2); $p++) {
                    if ($p != $page) {
                        $proposalFooter .= "<a class='page-num' onclick=\"filter(event, $p)\">" . $p . "</a> ";
                    } else {
                        $proposalFooter .= "<a class='page-num current-page' onclick=\"filter(event, $p)\">" . $p . "</a> ";
                    }
                }
            
                // Skip links for 2 pages
                if ($page + 4 < $num_of_pages) {
                    $proposalFooter .= "<span>...</span> ";
                }
            
                // Show the link for the 6th page if available
                if ($page + 4 < $num_of_pages) {
                    $p = $page + 4;
                    $proposalFooter .= "<a class='page-num' onclick=\"filter(event, $p)\">" . $p . "</a> ";
                } 
                else if ($page + 3 < $num_of_pages) {
                    $p = $page + 3;
                    $proposalFooter .= "<a class='page-num' onclick=\"filter(event, $p)\">" . $p . "</a> ";
                }
            } else {
                // If there's only one page, show the link for the current page and previous/next page links
                $proposalFooter .= "<a class='page-num current-page' onclick=\"filter(event, $page)\">" . $page . "</a> ";
            }

            $p = ($page < $num_of_pages ? ($page + 1) : $num_of_pages);

            $proposalFooter .= "</div>
                <div>
                    <a class='page-num arrow' onclick=\"filter(event, $p)\">
                        <i class='fas fa-arrow-right'></i>
                    </a>
                </div>
            </div>";


            $proposalsStr .= $proposalFooter;
            return $proposalsStr;
        }
        public function showUsers($param) {
            
            if($param == 'member') {
                $users_array = $this->getUsersAll('member');
            } 
            else if($param == 'new') {
                $users_array = $this->getUsersByStatus('member', 'Under Verification');
            } 
            else if($param == 'approved') {
                $users_array = $this->getUsersByStatus('member', 'approved');
            } 
            else if($param == 'deleted') {
                $users_array = $this->getUsersByStatus('member', 'deleted');
            } else {
                $users_array = array();
            }

            $num_of_rows = count($users_array);
            $results_per_page = 50;
            // Number of total pages available
            $num_of_pages = ceil($num_of_rows/$results_per_page);
            // var_dump($num_of_pages);
            // Determine which page user is currently on
            if(!isset($_GET['page'])) {
                $page = 1;
            } else {
                if($_GET['page'] == 0) {
                    $page = 1;
                } else {
                    $page = intval($_GET['page']);
                }
            }
            $starting_limit_number = ($page-1)*$results_per_page;

            $scriptname = $_SERVER["SCRIPT_FILENAME"];
            $pagename = basename($_SERVER["SCRIPT_FILENAME"], '.php');

            $proposalsStr = "<div class='profiles-wrapper'>
            <input type='hidden' id='user_count' value='$num_of_rows'>
            <div class='profiles-body'>";

            for($x=$starting_limit_number; $x<$starting_limit_number+$results_per_page; $x++) {
                if($x < $num_of_rows) {
                    $user_array = $users_array[$x];

                    $photoStr = $this->get_photo_str($user_array['photo'], $user_array['gender']);
                    // Whatsapp Icon
                    $whatsapp_icon = $this->whatsapp_icon('true');

                    if($user_array['account_status'] == 'approved') {
                        $actionsStr = "<div class='actions'>
                            <div class='approve disabled'>
                                <img src='./assets/svg/verify.svg' alt='approve' />
                                <span>Approve</span>
                            </div>
                            <div class='delete' onclick='update_status(\"$pagename\", \"deleted\", {$user_array['id']});'>
                                <img src='../assets/svg/delete.svg' alt='delete' />
                                <span>Delete</span>
                            </div>
                            <div class='edit' onclick='get_edit_form(event, \"{$user_array['id']}\")'>
                                <img src='../assets/svg/edit.svg' alt='edit' />
                                <span>Edit</span>
                            </div>
                        </div>";

                    } 
                    elseif($user_array['account_status'] == 'deleted') {
                        $actionsStr = "<div class='actions'>
                            <div class='approve disabled'>
                                <img src='../assets/svg/verify.svg' alt='approve' />
                                <span>Approve</span>
                            </div>
                            <div class='delete disabled'>
                                <img src='../assets/svg/delete.svg' alt='delete' />
                                <span>Delete</span>
                            </div>
                            <div class='edit disabled'>
                                <img src='../assets/svg/edit.svg' alt='edit' />
                                <span>Edit</span>
                            </div>
                        </div>";
                    } 
                    else {
                        $actionsStr = "<div class='actions'>
                            <div class='approve' onclick='update_status(\"$pagename\", \"approved\", {$user_array['id']});'>
                                <img src='../assets/svg/verify.svg' alt='approve' />
                                <span>Approve</span>
                             </div>
                            <div onclick='update_status(\"$pagename\", \"deleted\", {$user_array['id']});' class='delete'>
                                <img src='../assets/svg/delete.svg' alt='delete' />
                                <span>Delete</span>
                            </div>
                            <div class='edit' onclick='get_edit_form(event, \"{$user_array['id']}\")'>
                                <img src='../assets/svg/edit.svg' alt='edit' />
                                <span>Edit</span>
                            </div>
                        </div>";
                    }


                    if(isset($user_array['account_status'])) {
                        if($user_array['account_status'] == 'Under Verification') {
                            $statusStr = "<span style='color: #FFB600;'>{$user_array['account_status']}</span>";
                        } else if($user_array['account_status'] == 'approved') {
                            $statusStr = "<span style='color: #11C564;'>Aprroved</span>";
                        } else if($user_array['account_status'] == 'deleted') {
                            $statusStr = "<span style='color: #F60000;'>Parmanently Deleted</span>";
                        }
                    }

                    // Photo
                    if(!empty($user_array['photo'])) {
                        $img_str = "<div>
                            <a style='display: flex; justify-content: center; color: #F60000; font-size: 15px; margin: 10px auto 0 auto;' onclick='delete_user_img(event, \"{$user_array['photo']}\", \"{$user_array['id']}\", \"{$user_array['gender']}\")' title='delete' class='del-link' href=''>Delete</a>
                        </div>";
                    } else {
                        $img_str = "";
                    }

                    if(!empty($user_array['basket_id'])) {
                        $basket = substr($user_array['basket_id'], 0, 10) . '...';
                    } else {
                        $basket = "";
                    }

                    $proposalsStr .= "
                    <div class='profile'>
                        <div class='profile-head'>
                            <div class='profile-arrow'>
                                <i class='fa fa-angle-down'></i>                             
                            </div>
                            <div>
                                <span>{$user_array['email']}</span>
                            </div>
                            <div>
                                <span>{$user_array['elapsed']}</span>
                            </div>
                            <div>
                                <span class='status-label'>Status:</span> 
                                $statusStr
                            </div>
                            $actionsStr
                        </div>
                        <div class='profile-body'>
                            <div class='proposal-description'>
                                <div>Description</div>
                                <div>{$user_array['user_description']}</div>     
                            </div>
                            <div class='profile-body-inner'>
                                <div class='profile-body-row'>
                                    <div class='proposal-info-col col' id='col-1'>

                                        <div class='proposal-info'>
                                            <span>Gender</span>
                                            <span>{$user_array['gender']}</span>
                                        </div>
                                        <div class='proposal-info'>
                                            <span>Age</span>
                                            <span>{$user_array['age']}</span>
                                        </div>
                                        <div class='proposal-info'>
                                            <span>Marital Status</span>
                                            <span>{$user_array['marital_status']}</span>
                                        </div>
                                        <div class='proposal-info'>
                                            <span>Caste</span>
                                            <span>{$user_array['caste']}</span>
                                        </div>
                                    </div>

                                    <div class='proposal-info-col col' id='col-2'>

                                        <div class='proposal-info'>
                                            <span>Education</span>
                                            <span>{$user_array['education']}</span>
                                        </div>
                                        <div class='proposal-info'>
                                            <span>Occupation</span>
                                            <span>{$user_array['occupation']}</span>
                                        </div>
                                        <div class='proposal-info'>
                                            <span>City</span>
                                            <span>{$user_array['city']}</span>
                                        </div>
                                        <div class='proposal-info'>
                                            <span>Payment</span>
                                            <span><a style='color: gray; font-size: 16px;' href='./payment-details?pid={$user_array['basket_id']}'>$basket</a></span>
                                        </div>
                                        <div class='proposal-info'>
                                            <span>Pay status</span>
                                            <span>{$user_array['payment_status']}</span>
                                        </div>
                                    </div>
                                    <div class='col' id='col-3'>
                                        $photoStr
                                        $img_str
                                    </div>
                                </div>
                            </div>
                            <div class='profile-footer'>
                                <div class='contact-number'>
                                    Contact Number
                                </div>
                                <div class='whatsapp'>
                                    <style>
                                        .whatsapp-icon {
                                            margin-right: 10px;
                                        }
                                    </style>
                                    $whatsapp_icon
                                    <div id='whatsapp-mob-{$user_array['id']}' class='whatsapp-num'>{$user_array['whatsapp']}</div>
                                </div>    
                            </div>
                        </div>              
                    </div>";         
                // endforeach;
                }
            }
            $proposalsStr .= "</div>";
            
            $selectedTab = isset($_GET['tab']) ? $_GET['tab'] : 'new';

            if($page == 1) {
                $prev = $page;
            } else {
                $prev = $page - 1;
            }
            if($page == $num_of_pages) {
                $next = $page;
            } else {
                $next = $page + 1;
            }

            $proposalFooter = "<div class='pagination'>
            <div>
                <a class='page-num arrow' href='./users?tab=$selectedTab&page=" . ($page > 1 ? ($page - 1) : 1) . "'>
                    <i class='fas fa-arrow-left'></i>
                </a>
            </div>
            <div class='pagination-links'>";
        
            // Show links only if there is more than one page
            if ($num_of_pages > 1) {
                // Show the current page and links for next 2 pages
                for ($p = $page; $p <= min($num_of_pages, $page + 2); $p++) {
                    if ($p != $page) {
                        $proposalFooter .= "<a class='page-num' href='./users?tab=$selectedTab&page=" . $p . "'>" . $p . "</a> ";
                    } else {
                        $proposalFooter .= "<a class='page-num current-page' href='./users?tab=$selectedTab&page=" . $p . "'>" . $p . "</a> ";
                    }
                }
                // Skip links for 2 pages
                if ($page + 4 < $num_of_pages) {
                    $proposalFooter .= "<span>...</span> ";
                }
            
                // Show the link for the 6th page if available
                if ($page + 4 < $num_of_pages) {
                    $proposalFooter .= "<a class='page-num' href='./users?tab=$selectedTab&page=" . ($page + 4) . "'>" . ($page + 4) . "</a> ";
                } 
                else if ($page + 3 < $num_of_pages) {
                    $proposalFooter .= "<a class='page-num' href='./users?tab=$selectedTab&page=" . ($page + 3) . "'>" . ($page + 3) . "</a> ";
                }
            } else {
                // If there's only one page, show the link for the current page and previous/next page links
                $proposalFooter .= "<a class='page-num current-page' href='./users?tab=$selectedTab&page=" . $page . "'>" . $page . "</a> ";
            }
            
            $proposalFooter .= "</div>
                <div>
                    <a class='page-num arrow' href='./users?tab=$selectedTab&page=" . ($page < $num_of_pages ? ($page + 1) : $num_of_pages) . "'>
                        <i class='fas fa-arrow-right'></i>
                    </a>
                </div>
            </div>";

            $proposalsStr .= $proposalFooter;
            $proposalsStr .= "</div>";
            return $proposalsStr;
        }
        public function elapsed($datetime) {
            $created_at = new DateTime($datetime, new DateTimeZone('Asia/Karachi') );

            $date = new DateTime("now", new DateTimeZone('Asia/Karachi') );

            $interval = $date->diff($created_at);
            $elapsed_str = $interval->format('%y years %m months %a days %h hours %i minutes %s seconds');
            $elapsed_array = explode(' ', $elapsed_str);
            $elapsed = '';
            if(intval($elapsed_array[0]) > 0) {
                if(intval($elapsed_array[0]) == 1) {
                    $elapsed = strval($elapsed_array[0]) . ' yr ago';
                } else {
                    $elapsed = strval($elapsed_array[0]) . ' yrs ago';
                }
            } elseif(intval($elapsed_array[2]) > 0) {
                if(intval($elapsed_array[2]) == 1) {
                    $elapsed = strval($elapsed_array[2]) . ' month ago';
                } else {
                    $elapsed = strval($elapsed_array[2]) . ' months ago';
                }
            } elseif(intval($elapsed_array[4]) > 0) {
                if(intval($elapsed_array[4]) == 1) {
                    $elapsed = strval($elapsed_array[4]) . ' day ago';
                } else {
                    $elapsed = strval($elapsed_array[4]) . ' days ago';
                }
            } elseif(intval($elapsed_array[6]) > 0) {
                if(intval($elapsed_array[6]) == 1) {
                    $elapsed = strval($elapsed_array[6]) . ' hr ago';
                } else {
                    $elapsed = strval($elapsed_array[6]) . ' hrs ago';
                }
            } elseif(intval($elapsed_array[8]) > 0) {
                if(intval($elapsed_array[8]) == 1) {
                    $elapsed = strval($elapsed_array[8]) . ' min ago';
                } else {
                    $elapsed = strval($elapsed_array[8]) . ' mins ago';
                }
            } elseif(intval($elapsed_array[10]) > 0) {
                if(intval($elapsed_array[10]) == 1) {
                    $elapsed = strval($elapsed_array[10]) . ' second ago';
                } else {
                    $elapsed = strval($elapsed_array[10]) . ' seconds ago';
                }
            }
            return $elapsed;
        }
        public function whatsapp_content($user_id, $phone_redacted, $whatsapp) {
            $logged = is_logged_in();
            if(isset($_SESSION['user'])) {
                if($logged == '1') {
                    $account_status = get_account_status();
                    $payment_status = get_payment_status();
                    if($account_status != 'Not Approved' && $payment_status == 'success') {
                        $whatsapp_content = "<div id='reducted-{$user_id}' class='reducted-{$user_id} show-ph'>{$phone_redacted}</div>
                        <div id='whatsapp-{$user_id}' class='whatsapp-{$user_id} hide-ph'>{$whatsapp}</div>
                        <div data-href='{$user_id}' class='show-btn' onclick='togglePhone(this, event);'>
                            <img class='view-icon' src='./assets/svg/view.svg' alt='View' />
                            Show
                        </div>";
                    } else {
                        $whatsapp_content = "<div id='reducted-{$user_id}' class='reducted-{$user_id} show-ph'>{$phone_redacted}</div>
                        <a class='show-btn' onclick='scroll_to_element(\"post-register-popup\", event)'>
                            <img class='view-icon' src='./assets/svg/view.svg' alt='View' />
                            Show
                        </a>";
                    }
                } else {
                    $whatsapp_content = "<div id='reducted-{$user_id}' class='reducted-{$user_id} show-ph'>{$phone_redacted}</div>
                    <a class='show-btn' onclick='scroll_to_element(\"post-register-popup\", event)'>
                        <img class='view-icon' src='./assets/svg/view.svg' alt='View' />
                        Show
                    </a>";
                }
            } else {
                $whatsapp_content = "<div id='reducted-{$user_id}' class='reducted-{$user_id} show-ph'>{$phone_redacted}</div>
                <a href='./registration' class='show-btn'>
                    <img class='view-icon' src='./assets/svg/view.svg' alt='View' />
                    Show
                </a>";
            }
            return $whatsapp_content;
        }
        public function get_photo_str($photo, $gender) {
            if(!empty($photo)) {
                $file = './img/' . $photo; 
                if (file_exists($file)) {
                    $photoStr = "<div class='proposal-photo'>
                        <img id='default-female' style='display: none;' src='../assets/svg/female.svg' alt='Default female'>
                        <img id='default-male' style='display: none;' src='../assets/svg/male.svg' alt='Default male'>
                        <img id='user-uploaded-img' src='../img/{$photo}' alt='User uploaded Image'>
                    </div>";
                } else {
                    if(strtolower($gender) == 'female') {
                        $photoStr = "<div class='proposal-photo'>
                            <img src='../assets/svg/female.svg' alt='Female'>
                        </div>";
                    } else {
                        $photoStr = "<div class='proposal-photo'>
                            <img src='../assets/svg/male.svg' alt='Male'>
                        </div>";
                    }
                }
            } else {
                if(strtolower($gender) == 'female') {
                    $photoStr = "<div class='proposal-photo'>
                        <img src='../assets/svg/female.svg' alt='Female'>
                    </div>";
                } else {
                    $photoStr = "<div class='proposal-photo'>
                        <img src='../assets/svg/male.svg' alt='Male'>
                    </div>";
                }
            }
            return $photoStr;
        }
        public function get_photo_str_2($photo, $account_status, $gender) {
            if(!empty($photo)) {
                $file = './img/' . $photo; 
                if (file_exists($file)) {
                    $photoStr = "<div class='proposal-photo'>
                        <img src='./img/{$photo}' alt='User Photo'>
                    </div>";
                } else {
                    if(strtolower($gender) == 'female') {
                        $photoStr = "<div class='proposal-photo'>
                            <img src='./assets/svg/female.svg' alt='female'>
                        </div>";
                    } else {
                        $photoStr = "<div class='proposal-photo'>
                            <img src='./assets/svg/male.svg' alt='male'>
                        </div>";
                    }
                }
            } else {
                if(strtolower($gender) == 'female') {
                    $photoStr = "<div class='proposal-photo'>
                        <img src='./assets/svg/female.svg' alt='female'>
                    </div>";
                } else {
                    $photoStr = "<div class='proposal-photo'>
                        <img src='./assets/svg/male.svg' alt='male'>
                    </div>";
                }

            }
            return $photoStr;
        }

        public function get_packages_status() {
            $i = 1;
            $stmt = $this->con->prepare("SELECT * FROM packages_status WHERE id=?");
            $stmt->bind_param('i', $i);
            $stmt->execute();
            $meta = $stmt->result_metadata();
            $result = array();
            while ($field = $meta->fetch_field()) {
                $parameters[] = &$row[$field->name];
            }
            call_user_func_array(array($stmt, 'bind_result'), $parameters);
            while ($stmt->fetch()) {
                foreach($row as $key => $val) {
                    $x[$key] = $val;
                }
                $result[] = $x;
            }
            if(count($result) > 0) {
                foreach($result as $row):
                    $package_status = $row['package_status'];
                endforeach;
            }
            $stmt->close();
            $_SESSION['package_status'] = $package_status;
            return $package_status;
        }
        public function show_user_profile_nav() {
            if(isset($_SESSION['user'])) {
                $userdata = json_decode($_SESSION['user'], true);
                if(isset($userdata['logged']) && isset($userdata['uid']) && isset($userdata['email']) && isset($userdata['user_status']) && isset($userdata['account_status'])) {

                    if($userdata['logged'] == 1) { 
                        $package_status = $this->get_packages_status();
                        
                        if($userdata['account_status'] == 'Under Verification') {
                            $status_str = "<div style='color: #000000; font-size: 15px;'>(Under Verification)</div>";
                        }
                        if($userdata['account_status'] == 'approved') {
                            $status_str = "<div style='display: flex; flex-flow: row nowrap; align-items: center;'>
                                <img src='./assets/svg/verify.svg' alt='Verify' />
                                <div style='color: #11C564; font-size: 15px;'>(Verified)</div>
                            </div>";
                        }    
      
                        $profileBtn = "<div class='profile-btn user-area-pfp-btn'>
                            <div id='profile-trigger'>
                                $status_str
                                <div><a style='color: #FFB600' href='./user-profile?i={$userdata['uid']}'>My Profile</a></div>

                                <div>
                                    <i onclick='profileTrigger();' class='fas fa-angle-down'></i>
                                </div>
                            </div>
                            <div id='profile-dropdown'>
                                <a style='color: #000;' href='./controllers/logout-handler'>Logout</a>
                            </div>
                        </div>";

                        return $profileBtn;
                    } else if($userdata['logged'] == 0) { 
                        $package_status = $this->get_packages_status();
                        
                        if($userdata['account_status'] == 'Not Approved') {
                            $status_str = "<div style='color: #000000; font-size: 15px;'>(Under Verification)</div>";
                        }   
         
                        $profileBtn = "<div class='profile-btn user-area-pfp-btn'>
                            <div id='profile-trigger'>
                                $status_str
                                <div><a style='color: #FFB600;' href='./user-profile?i={$userdata['uid']}'>My Profile</a></div>

                                <div>
                                    <i onclick='profileTrigger();' class='fas fa-angle-down'></i>
                                </div>
                            </div>
                            <div id='profile-dropdown'>
                                <a style='color: #000;' href='./controllers/logout-handler'>Logout</a>
                            </div>
                        </div>";
                        return $profileBtn;
                    } else {
                        $profileBtn = "<div class='signup-btn'>
                        <a id='nav-register' href='./registration'>Create Account</a>
                        <a id='nav-login' href='./login'>Log In</a>
                        </div>";
                        return $profileBtn;
                    }
                } else {
                    $profileBtn = "<div class='signup-btn'>
                    <a id='nav-register' href='./registration'>Create Account</a>
                    <a id='nav-login' href='./login'>Log In</a>
                    </div>";
                    return $profileBtn;
                }
            } else {
                $profileBtn = "<div class='signup-btn'>
                <a id='nav-register' href='./registration'>Create Account</a>
                <a id='nav-login' href='./login'>Log In</a>
                </div>";
                return $profileBtn;
            }
        }
        public function show_user_profile_mob() {
            if(isset($_SESSION['user'])) {
                $userdata = json_decode($_SESSION['user'], true);
                if($userdata['account_status'] == 'Not Approved' || $userdata['account_status'] == 'Under Verification') {
                    $status_str = "<div style='color: #000000; font-size: 15px;'>Under Verification</div>";
                } else if($userdata['account_status'] == 'approved') {
                    $status_str = "<div style='display: flex; flex-flow: row nowrap; align-items: center;'>
                        <img style='margin-left: -5px;' src='./assets/svg/verify.svg' alt='Verify' />
                        <div style='color: #11C564; font-size: 15px;'>Verified</div>
                    </div>";
                }   
                if(isset($userdata['logged']) && isset($userdata['uid']) && isset($userdata['email']) && isset($userdata['user_status']) && isset($userdata['account_status'])) {
                    $profileBtn = "<div class='profile-btn user-area-pfp-mob'>
                        $status_str
                        <div id='profile-trigger'>
                            <div><a style='color: #000;' href='./user-profile?i={$userdata['uid']}'>My Profile</a></div>
                        </div>
                        <div id='logout-btn'>
                            <a href='./controllers/logout-handler'>Logout</a>
                        </div>
                    </div>";
                    return $profileBtn;         
                } 
            } else {
                $profileBtn = "
                <div id='mob-register'>
                    <div class='signup-btn'>
                        <a id='nav-register' href='./registration'>Register Yourself</a>
                    </div>
                </div>";
                return $profileBtn;
            }
        }
        
        public function profile_section_1($id) {
            $user_array = $this->getUserById($id);
            // Photo
            if(empty($user_array['photo'])) {
                $pfpImg = 'avi.jpg';
            } else {
                $pfpImg = $user_array['photo'];
            }
            // Gender
            if($user_array['gender'] =='female') {
                $genderInpStr = "<div class='input-group'>
                    <div class='input-row'>
                        <div class='input-col input-col-1'>
                            <label for='gender'>Gender</label>
                        </div>
                        <div class='radio-group'>
                            <input type='hidden' name='gender' id='gender' value='female'>
                            <p>
                                <input onchange='radioVal(this.value)' type='radio' value='female' id='gender-female' checked> Female
                            </p>
                            <p>
                                <input onchange='radioVal(this.value)' type='radio' value='male' id='gender-male'> Male
                            </p>
                        </div>
                    </div>           
                </div>";
            } else {
                $genderInpStr = "<div class='input-group'>
                    <div class='input-row'>
                        <div class='input-col input-col-1'>
                            <label for='gender'>Gender</label>
                        </div>
                        <div class='radio-group'>
                            <input type='hidden' name='gender' id='gender' value='male'>
                            <p>
                                <input onchange='radioVal(this.value)' type='radio' value='female' id='gender-female'> Female
                            </p>
                            <p>
                                <input onchange='radioVal(this.value)' type='radio' value='male' id='gender-male' checked> Male
                            </p>
                        </div>
                    </div>           
                </div>";
            }
            
            // Description
            $user_description = nl2br($user_array['user_description']);
            return "<div class='profile-section' id='profile-section-1'>
                <form id='user_update_form' runat='server' id='profile-img-update-form' method='post' enctype='multipart-formdata'>
                    <input type='hidden' id='old_img' name='old_img' value='{$user_array['photo']}'>
                    <input type='hidden' name='update_user_profile' value='true'>
                    <input type='hidden' id='user_id' name='user_id' value='$id'>
                    <div class='p-header'>
                        <div class='pfp-placeholder'>
                            <img id='no-photo-avi' src='./img/$pfpImg' alt='Profile Photo'>
                            <img id='pfp-img-preview' src='#' alt='your image' />
                        </div>                 
                        <div id='pfp-update-btns'>
                            <button id='pfpBtn' onclick='return fireButton(event);'><i class='fas fa-long-arrow-alt-up'></i>Upload</button>       
                            <input class='input' id='image' type='file' name='image' value='' style='display: none;'>
                            <button id='pfpRemoveBtn' onclick='return removeImg(event);'>Remove</button>
                        </div>               
                    </div>
                    <div class='p-body'>
                        <div class='p-card'>

                            $genderInpStr
                            <div class='input-group'>
                                <div class='input-row'>
                                    <div class='input-col input-col-1'>
                                        <label for='age'>Age</label>
                                    </div>
                                    <div class='input-col input-col-2'>
                                        <input type='number' step='1' min='18' max='80' class='age' name='age' id='age' value='{$user_array['age']}'>
                                        <div class='error' id='ageError'></div>
                                    </div>
                                </div>           
                            </div>
                            <div class='input-group'>
                                <div class='input-row'>
                                    <div class='input-col input-col-3'>
                                        <label for='description'>Description</label>
                                        <textarea name='description' id='description' class='description' cols='30' rows='5'>$user_description</textarea>
                                        <div class='error' id='whatsappError'></div>
                                    </div>
                                </div>           
                            </div>

                            <div class='input-group'>
                                <div class='input-row'>
                                    <div class='input-col input-col-1'>
                                        <label for='marital_status'>Marital Status</label>
                                    </div>
                                    <div class='input-col input-col-2'>                            
                                        <div class='selection'>
                                            <div id='maritalStatusTrigger' class='selection-trigger' onclick='selectDropdown(this.id);'>
                                                <div id='selectedMaritalStatus'>{$user_array['marital_status']}</div> 
                                                <i style='color: gray;margin-top:3px;' class='ion-chevron-down' aria-hidden='true'></i>
                                            </div>
                                            <div class='dropdown hideDropdown' id='maritalStatusDropdown'>
                                                <input type='hidden' id='marital_status' name='marital_status' value='{$user_array['marital_status']}'>
                                                <span class='option select-option' id='Never Married' onclick='selectMaritalStatus(this.id);'>Never Married</span>
                                                <span class='option select-option' id='Married' onclick='selectMaritalStatus(this.id);'>Married</span>
                                                <span class='option select-option' id='Divorced' onclick='selectMaritalStatus(this.id);'>Divorced</span>
                                                <span class='option select-option' id='Widowed' onclick='selectMaritalStatus(this.id);'>Widowed</span>
                                                <span class='option select-option' id='Separated' onclick='selectMaritalStatus(this.id);'>Separated</span>
                                            </div>
                                        </div>
                                        <div class='error' id='fullnameError'></div>
                                    </div>
                                </div>           
                            </div>
                            <div class='input-group'>
                                <div class='input-row'>
                                    <div class='input-col input-col-1'>
                                        <label for='caste'>Caste</label>
                                    </div>
                                    <div class='input-col input-col-2'>
                                        <input type='text' class='caste' name='caste' id='caste' value='{$user_array['caste']}'>
                                        <div class='error' id='casteError'></div>
                                    </div>
                                </div>           
                            </div>
                            <div class='input-group'>
                                <div class='input-row'>
                                    <div class='input-col input-col-1'>
                                        <label for='education'>Education</label>
                                    </div>
                                    <div class='input-col input-col-2'>                            
                                        <div class='selection'>
                                            <div id='educationTrigger' class='selection-trigger' onclick='selectDropdown(this.id);'>
                                                <div id='selectedEducation'>{$user_array['education']}</div> 
                                                <i style='color: gray;margin-top:3px;' class='ion-chevron-down' aria-hidden='true'></i>
                                            </div>
                                            <div class='dropdown hideDropdown' id='educationDropdown'>
                                                <input type='hidden' id='education' name='education' value='{$user_array['education']}'>
                                                <span class='option select-option' id='Under matric' onclick='selectEducation(this.id);'>Under matric</span>
                                                <span class='option select-option' id='Matric' onclick='selectEducation(this.id);'>Matric</span>
                                                <span class='option select-option' id='Intermediate' onclick='selectEducation(this.id);'>Intermediate</span>
                                                <span class='option select-option' id='Bachelors' onclick='selectEducation(this.id);'>Bachelors</span>
                                                <span class='option select-option' id='Masters' onclick='selectEducation(this.id);'>Masters</span>
                                                <span class='option select-option' id='PhD' onclick='selectEducation(this.id);'>PhD</span>
                                            </div>
                                        </div>
                                        <div class='error' id='fullnameError'></div>
                                    </div>
                                </div>           
                            </div>
                            <div class='input-group'>
                                <div class='input-row'>
                                    <div class='input-col input-col-1'>
                                        <label for='occupation'>Occupation</label>
                                    </div>
                                    <div class='input-col input-col-2'>
                                        <input type='text' class='occupation' name='occupation' id='occupation' value='{$user_array['occupation']}'>
                                        <div class='error' id='occupationError'></div>
                                    </div>
                                </div>           
                            </div>
                            <div class='input-group'>
                                <div class='input-row'>
                                    <div class='input-col input-col-1'>
                                        <label for='city'>City</label>
                                    </div>
                                    <div class='input-col input-col-2'>                            
                                        <div class='selection'>
                                            <div id='cityTrigger' class='selection-trigger' onclick='selectDropdown(this.id);'>
                                                <div id='selectedCity'>{$user_array['city']}</div> 
                                                <i style='color: gray;margin-top:3px;' class='ion-chevron-down' aria-hidden='true'></i>
                                            </div>
                                            <div style='height: 280px; overflow-Y: scroll;' class='dropdown hideDropdown' id='cityDropdown'>
                                                <input type='hidden' id='city' name='city' value='{$user_array['city']}'>
                                                <span class='option select-option' id='Karachi' onclick='selectCity(this.id);'>Karachi</span>
                                                <span class='option select-option' id='Lahore' onclick='selectCity(this.id);'>Lahore</span>
                                                <span class='option select-option' id='Faisalabad' onclick='selectCity(this.id);'>Faisalabad</span>
                                                <span class='option select-option' id='Rawalpindi' onclick='selectCity(this.id);'>Rawalpindi</span>
                                                <span class='option select-option' id='Gujranwala' onclick='selectCity(this.id);'>Gujranwala</span>
                                                <span class='option select-option' id='Peshawar' onclick='selectCity(this.id);'>Peshawar</span>
                                                <span class='option select-option' id='Multan' onclick='selectCity(this.id);'>Multan</span>
                                                <span class='option select-option' id='Hyderabad' onclick='selectCity(this.id);'>Hyderabad</span>
                                                <span class='option select-option' id='Islamabad' onclick='selectCity(this.id);'>Islamabad</span>
                                                <span class='option select-option' id='Quetta' onclick='selectCity(this.id);'>Quetta</span>
                                                <span class='option select-option' id='Bahawalpur' onclick='selectCity(this.id);'>Bahawalpur</span>
                                                <span class='option select-option' id='Sargodha' onclick='selectCity(this.id);'>Sargodha</span>
                                                <span class='option select-option' id='Sialkot' onclick='selectCity(this.id);'>Sialkot</span>
                                                <span class='option select-option' id='Sukkur' onclick='selectCity(this.id);'>Sukkur</span>
                                                <span class='option select-option' id='Larkana' onclick='selectCity(this.id);'>Larkana</span>
                                                <span class='option select-option' id='Sheikhupura' onclick='selectCity(this.id);'>Sheikhupura</span>
                                                <span class='option select-option' id='Rahim Yar Khan' onclick='selectCity(this.id);'>Rahim Yar Khan</span>
                                                <span class='option select-option' id='Jhang' onclick='selectCity(this.id);'>Jhang</span>
                                                <span class='option select-option' id='Dera Ghazi Khan' onclick='selectCity(this.id);'>Dera Ghazi Khan</span>
                                                <span class='option select-option' id='Gujrat' onclick='selectCity(this.id);'>Gujrat</span>
                                                <span class='option select-option' id='Sahiwal' onclick='selectCity(this.id);'>Sahiwal</span>
                                                <span class='option select-option' id='Wah Cantonment' onclick='selectCity(this.id);'>Wah Cantonment</span>
                                                <span class='option select-option' id='Mardan' onclick='selectCity(this.id);'>Mardan</span>
                                                <span class='option select-option' id='Kasur' onclick='selectCity(this.id);'>Kasur</span>
                                                <span class='option select-option' id='Okara' onclick='selectCity(this.id);'>Okara</span>
                                                <span class='option select-option' id='Mingora' onclick='selectCity(this.id);'>Mingora</span>
                                                <span class='option select-option' id='Nawabshah' onclick='selectCity(this.id);'>Nawabshah</span>
                                                <span class='option select-option' id='Chiniot' onclick='selectCity(this.id);'>Chiniot</span>
                                                <span class='option select-option' id='Kotri' onclick='selectCity(this.id);'>Kotri</span>
                                                <span class='option select-option' id='Kāmoke' onclick='selectCity(this.id);'>Kāmoke</span>
                                                <span class='option select-option' id='Hafizabad' onclick='selectCity(this.id);'>Hafizabad</span>
                                                <span class='option select-option' id='Sadiqabad' onclick='selectCity(this.id);'>Sadiqabad</span>
                                                <span class='option select-option' id='Mirpur Khas' onclick='selectCity(this.id);'>Mirpur Khas</span>
                                                <span class='option select-option' id='Burewala' onclick='selectCity(this.id);'>Burewala</span>
                                                <span class='option select-option' id='Kohat' onclick='selectCity(this.id);'>Kohat</span>
                                                <span class='option select-option' id='Khanewal' onclick='selectCity(this.id);'>Khanewal</span>
                                                <span class='option select-option' id='Dera Ismail Khan' onclick='selectCity(this.id);'>Dera Ismail Khan</span>
                                                <span class='option select-option' id='Turbat' onclick='selectCity(this.id);'>Turbat</span>
                                                <span class='option select-option' id='Muzaffargarh' onclick='selectCity(this.id);'>Muzaffargarh</span>
                                                <span class='option select-option' id='Abbotabad' onclick='selectCity(this.id);'>Abbotabad</span>
                                                <span class='option select-option' id='Mandi Bahauddin' onclick='selectCity(this.id);'>Mandi Bahauddin</span>
                                                <span class='option select-option' id='Shikarpur' onclick='selectCity(this.id);'>Shikarpur</span>
                                                <span class='option select-option' id='Jacobabad' onclick='selectCity(this.id);'>Jacobabad</span>
                                                <span class='option select-option' id='Jhelum' onclick='selectCity(this.id);'>Jhelum</span>
                                                <span class='option select-option' id='Khanpur' onclick='selectCity(this.id);'>Khanpur</span>
                                                <span class='option select-option' id='Khairpur' onclick='selectCity(this.id);'>Khairpur</span>
                                                <span class='option select-option' id='Khuzdar' onclick='selectCity(this.id);'>Khuzdar</span>
                                                <span class='option select-option' id='Pakpattan' onclick='selectCity(this.id);'>Pakpattan</span>
                                                <span class='option select-option' id='Hub' onclick='selectCity(this.id);'>Hub</span>
                                                <span class='option select-option' id='Daska' onclick='selectCity(this.id);'>Daska</span>
                                                <span class='option select-option' id='Gojra' onclick='selectCity(this.id);'>Gojra</span>
                                                <span class='option select-option' id='Dadu' onclick='selectCity(this.id);'>Dadu</span>
                                                <span class='option select-option' id='Muridke' onclick='selectCity(this.id);'>Muridke</span>
                                                <span class='option select-option' id='Bahawalnagar' onclick='selectCity(this.id);'>Bahawalnagar</span>
                                                <span class='option select-option' id='Samundri' onclick='selectCity(this.id);'>Samundri</span>
                                                <span class='option select-option' id='Tando Allahyar' onclick='selectCity(this.id);'>Tando Allahyar</span>
                                                <span class='option select-option' id='Tando Adam' onclick='selectCity(this.id);'>Tando Adam</span>
                                                <span class='option select-option' id='Jaranwala' onclick='selectCity(this.id);'>Jaranwala</span>
                                                <span class='option select-option' id='Chishtian' onclick='selectCity(this.id);'>Chishtian</span>
                                                <span class='option select-option' id='Muzaffarabad' onclick='selectCity(this.id);'>Muzaffarabad</span>
                                                <span class='option select-option' id='Attock' onclick='selectCity(this.id);'>Attock</span>
                                                <span class='option select-option' id='Vehari' onclick='selectCity(this.id);'>Vehari</span>
                                                <span class='option select-option' id='Kot Abdul Malik' onclick='selectCity(this.id);'>Kot Abdul Malik</span>
                                                <span class='option select-option' id='Ferozwala' onclick='selectCity(this.id);'>Ferozwala</span>
                                                <span class='option select-option' id='Chakwal' onclick='selectCity(this.id);'>Chakwal</span>
                                                <span class='option select-option' id='Gujranwala Cantonment' onclick='selectCity(this.id);'>Gujranwala Cantonment</span>
                                                <span class='option select-option' id='Kamalia' onclick='selectCity(this.id);'>Kamalia</span>
                                                <span class='option select-option' id='Umerkot' onclick='selectCity(this.id);'>Umerkot</span>
                                                <span class='option select-option' id='Ahmedpur East' onclick='selectCity(this.id);'>Ahmedpur East</span>
                                                <span class='option select-option' id='Kot Addu' onclick='selectCity(this.id);'>Kot Addu</span>
                                                <span class='option select-option' id='Wazirabad' onclick='selectCity(this.id);'>Wazirabad</span>
                                                <span class='option select-option' id='Mansehra' onclick='selectCity(this.id);'>Mansehra</span>
                                                <span class='option select-option' id='Layyah' onclick='selectCity(this.id);'>Layyah</span>
                                                <span class='option select-option' id='Mirpur' onclick='selectCity(this.id);'>Mirpur</span>
                                                <span class='option select-option' id='Swabi' onclick='selectCity(this.id);'>Swabi</span>
                                                <span class='option select-option' id='Chaman' onclick='selectCity(this.id);'>Chaman</span>
                                                <span class='option select-option' id='Taxila' onclick='selectCity(this.id);'>Taxila</span>
                                                <span class='option select-option' id='Nowshera' onclick='selectCity(this.id);'>Nowshera</span>
                                                <span class='option select-option' id='Khushab' onclick='selectCity(this.id);'>Khushab</span>
                                                <span class='option select-option' id='Shahdadkot' onclick='selectCity(this.id);'>Shahdadkot</span>
                                                <span class='option select-option' id='Mianwali' onclick='selectCity(this.id);'>Mianwali</span>
                                                <span class='option select-option' id='Kabal' onclick='selectCity(this.id);'>Kabal</span>
                                                <span class='option select-option' id='Lodhran' onclick='selectCity(this.id);'>Lodhran</span>
                                                <span class='option select-option' id='Hasilpur' onclick='selectCity(this.id);'>Hasilpur</span>
                                                <span class='option select-option' id='Charsadda' onclick='selectCity(this.id);'>Charsadda</span>
                                                <span class='option select-option' id='Bhakkar' onclick='selectCity(this.id);'>Bhakkar</span>
                                                <span class='option select-option' id='Badin' onclick='selectCity(this.id);'>Badin</span>
                                                <span class='option select-option' id='Arif Wala' onclick='selectCity(this.id);'>Arif Wala</span>
                                                <span class='option select-option' id='Ghotki' onclick='selectCity(this.id);'>Ghotki</span>
                                                <span class='option select-option' id='Sambrial' onclick='selectCity(this.id);'>Sambrial</span>
                                                <span class='option select-option' id='Jatoi' onclick='selectCity(this.id);'>Jatoi</span>
                                                <span class='option select-option' id='Haroonabad' onclick='selectCity(this.id);'>Haroonabad</span>
                                                <span class='option select-option' id='Daharki' onclick='selectCity(this.id);'>Daharki</span>
                                                <span class='option select-option' id='Narowal' onclick='selectCity(this.id);'>Narowal</span>
                                                <span class='option select-option' id='Tando Muhammad Khan' onclick='selectCity(this.id);'>Tando Muhammad Khan</span>
                                                <span class='option select-option' id='Kamber Ali Khan' onclick='selectCity(this.id);'>Kamber Ali Khan</span>
                                                <span class='option select-option' id='Mirpur Mathelo' onclick='selectCity(this.id);'>Mirpur Mathelo</span>
                                                <span class='option select-option' id='Kandhkot' onclick='selectCity(this.id);'>Kandhkot</span>
                                                <span class='option select-option' id='Bhalwal' onclick='selectCity(this.id);'>Bhalwal</span>
                                                <span class='option select-option' id='Kundian' onclick='selectCity(this.id);'>Kundian</span>
                                            </div>
                                        </div>
                                        <div class='error' id='fullnameError'></div>
                                    </div>
                                </div>           
                            </div>
                        </div>     
                        <div id='updateProfileBtn' onclick='updateUserProfile();'>
                            Update
                        </div>
                    </div>
                </form>
            </div>
            ";
        }
        public function profile_section_2($id) {
            $user_array = $this->getUserById($id);
            return "<div class='profile-section' id='profile-section-2'>
                <div class='change-password'>
                    <form id='change_pwd' method='post'>
                        <input type='hidden' id='pwd_user_id' name='pwd_user_id' value='$id'>
                        <div class='update-user-form-heading'>
                            Change Password
                        </div>
                        <div id='pwd-row'>
                            <div class='pwd-inner'>
                                <div id='pwd_inputs'>
                                    <input onchange='validatePwd(event)' type='password' name='old_pwd' id='old_pwd' value='' placeholder='Old Password'>
                                    <input onchange='validatePwd(event)' type='password' name='new_pwd' id='new_pwd' value='' placeholder='New Password''>
                                    <input onchange='validatePwd(event)' type='password' name='repeat_pwd' id='repeat_pwd' value='' placeholder='Confirm Password'>
                                </div>
                                <div id='pwd-error'>

                                </div>
                                <div style='margin-top: 0;' id='pwdBtn' onclick='changePwd(event);'>Update</div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class='delete-account'>
                    <form id='delete_form' method='post' action='./controllers/user-handler'>
                        <input type='hidden' name='delete_user_id' value='$id'>
                        <div class='update-user-form-heading'>
                            Delete Account
                        </div>
                        <div class='update-user-form-subheading'>
                            This will permanently delete your account and all its settings, you will also lose your membership and will have to register again
                        </div>
                        <div id='deleteBtn' onclick='popup(\"delPopup\");'>Delete Account</div>
                    </form>
                </div>
            </div>";
        }
        /*
        =================================================================
            LOGIN & LOGOUT
        =================================================================  
        */
        public function login() {
            $this->startSession();

            $email = $_POST['email'];
            $password = $_POST['password'];     
            
            $exclude_status = 'deleted';

            $stmt = $this->con->prepare("SELECT * FROM user_account WHERE email=? AND account_status!=?");
            $stmt->bind_param('ss', $email, $exclude_status);
            $stmt->execute();
            
            $meta = $stmt->result_metadata();
            $result = array();
            while ($field = $meta->fetch_field()) {
                $parameters[] = &$row[$field->name];
            }
            call_user_func_array(array($stmt, 'bind_result'), $parameters);
            while ($stmt->fetch()) {
                foreach($row as $key => $val) {
                    $x[$key] = $val;
                }
                $result[] = $x;
            }
            if(count($result) == 0) {
                header("location: ../login?error=wrongpassword");
                exit();
            } else {            
                foreach($result as $row):
                    if($password === trim($row['pwd'])) {
                    // if($pwd_check == true) {
                        if (isset($_POST["remember"]) && !empty($_POST["remember"])) {
                            setcookie("user", json_encode($userdata, true), time() + (10 * 365 * 24 * 60 * 60), '/');      
                        }
                        if($row['account_status'] == 'Not Approved') {
                            $userdata = array(
                                'logged' => 0,
                                'uid' => $row['id'],
                                'email' => $email,
                                'user_img' => $row['photo'],
                                'user_status' => $row['user_status'],
                                'account_status' => $row['account_status'],
                                'gender' => $row['gender'],
                                'whatsapp' => $row['whatsapp'],
                                'basket_id' => $row['basket_id'],
                                'payment_status' => $row['payment_status'],
                                'order_date' => ''
                            );
                        } else {
                            $order_date = $this->get_order_date($row['basket_id']);
                            $userdata = array(
                                'logged' => 1,
                                'uid' => $row['id'],
                                'email' => $email,
                                'user_img' => $row['photo'],
                                'user_status' => $row['user_status'],
                                'account_status' => $row['account_status'],
                                'gender' => $row['gender'],
                                'whatsapp' => $row['whatsapp'],
                                'basket_id' => $row['basket_id'],
                                'payment_status' => $row['payment_status'],
                                'order_date' => $order_date
                            );
                        }

                        $_SESSION['user'] = json_encode($userdata, true);
                        
                        if($row['user_status'] == 'admin') {
                            header('location: ../admin/users');
                            exit();
                        } else {
                            header('location: ../');
                        }
                    } else {
                        header("location: ../login?error=wrongpassword");
                        exit();
                    }
                endforeach;
            }        
            $stmt->close();
        }
        public function logout() {
            $this->startSession();
            $this->endSession();
            setcookie('user', '', time() - 3600, '/');
            unset($_COOKIE['user']);
            header('location: ../'); 
        }
        
        /*
        =================================================================
            FORMS
        =================================================================  
        */  
        public function get_edit_form($id) {
            $user = $this->getUserById($id);
            $relationship = $user['relationship'];
            $email = $user['email'];
            $whatsapp = $user['whatsapp0'];
            $gender = $user['gender'];
            $age = $user['age'];
            $user_description = $user['user_description'];
            $marital_status = $user['marital_status'];
            $caste = $user['caste'];
            $education = $user['education'];
            $occupation = $user['occupation'];
            $city = $user['city'];
            $feet = $user['feet'];
            $inch = $user['inch'];
            echo "<div id='edit-popup' class='popup hide_popup edit-popup'>
                <form action=''>  
                    <input type='hidden' name='user_id' id='user_id' value='$id'>
                    <div class='form-inner-div'>
                        <div class='edit-form-title'>
                            <h3>Editing Profile Details</h3>
                        </div>
                        <div class='input-group'>
                            <div class='input-row'>
                                <div class='input-col input-col-1'>
                                    <label for='relationship'>Profile for</label>
                                </div>
                                <div class='input-col input-col-2'>                            
                                    <div class='selection'>
                                        <div id='relationshipTrigger' class='selection-trigger' onclick='selectDropdown(this.id);'>
                                            <div id='selectedRelationship'>$relationship</div> 
                                            <i style='color: gray;margin-top:3px;' class='ion-chevron-down' aria-hidden='true'></i>
                                        </div>
                                        <div class='dropdown hideDropdown' id='relationshipDropdown'>
                                            <input value='$relationship' type='hidden' id='relationship' name='relationship' value=''>
                                            <span class='option select-option' id='Myself' onclick='selectRelationship(this.id);'>Myself</span>
                                            <span class='option select-option' id='Daughter' onclick='selectRelationship(this.id);'>Daughter</span>
                                            <span class='option select-option' id='Son' onclick='selectRelationship(this.id);'>Son</span>
                                            <span class='option select-option' id='Brother' onclick='selectRelationship(this.id);'>Brother</span>
                                            <span class='option select-option' id='Sister' onclick='selectRelationship(this.id);'>Sister</span>
                                        </div>
                                    </div>
                                    <div class='error' id='fullnameError'></div>
                                </div>
                            </div>           
                        </div>
                        <div class='input-group'>
                            <div class='input-row'>
                                <div class='input-col input-col-1'>
                                    <label for='relationship'>$marital_status</label>
                                </div>
                                <div class='input-col input-col-2'>                            
                                    <div class='selection'>
                                        <div id='maritalStatusTrigger' class='selection-trigger' onclick='selectDropdown(this.id);'>
                                            <div id='selectedMaritalStatus'>$marital_status</div> 
                                            <i style='color: gray;margin-top:3px;' class='ion-chevron-down' aria-hidden='true'></i>
                                        </div>
                                        <div class='dropdown hideDropdown' id='maritalStatusDropdown'>
                                            <input value='$marital_status' type='hidden' id='marital_status' name='marital_status' value=''>
                                            <span class='option select-option' id='Never Married' onclick='selectMaritalStatus(this.id);'>Never Married</span>
                                            <span class='option select-option' id='Married' onclick='selectMaritalStatus(this.id);'>Married</span>
                                            <span class='option select-option' id='Divorced' onclick='selectMaritalStatus(this.id);'>Divorced</span>
                                            <span class='option select-option' id='Widowed' onclick='selectMaritalStatus(this.id);'>Widowed</span>
                                            <span class='option select-option' id='Separated' onclick='selectMaritalStatus(this.id);'>Separated</span>
                                        </div>
                                    </div>
                                    <div class='error' id='fullnameError'></div>
                                </div>
                            </div>           
                        </div>
                        <div class='input-group'>
                            <div class='input-row'>
                                <div class='input-col input-col-1'>
                                    <label for='gender'>Gender</label>
                                </div>
                                <div class='input-col input-col-2'>                            
                                    <div class='selection'>
                                        <div id='genderTrigger' class='selection-trigger' onclick='selectDropdown(this.id);'>
                                            <div id='selectedGender'>$gender</div> 
                                            <i style='color: gray;margin-top:3px;' class='ion-chevron-down' aria-hidden='true'></i>
                                        </div>
                                        <div class='dropdown hideDropdown' id='genderDropdown'>
                                            <input value='$gender' type='hidden' id='gender' name='gender' value=''>
                                            <span class='option select-option' id='male' onclick='selectGender(this.id);'>Male</span>
                                            <span class='option select-option' id='female' onclick='selectGender(this.id);'>Female</span>
                                        </div>
                                    </div>
                                    <div class='error' id='genderError'></div>
                                </div>
                            </div>           
                        </div>
                        <div class='input-group'>
                            <div class='input-row'>
                                <div class='input-col input-col-1'>
                                    <label for='age'>Age</label>
                                </div>
                                <div class='input-col input-col-2'>
                                    <input value='$age' type='number' step='1' min='18' max='80' class='age' name='age' id='age' placeholder='25'>
                                    <div class='error' id='ageError'></div>
                                </div>
                            </div>           
                        </div>
                        <div class='input-group'>
                            <div class='input-row'>
                                <div class='input-col input-col-1'>
                                    <label for='height'>Height</label>
                                </div>
                                <style>
                                    .input-row-group {
                                        width: 100%;
                                        display: grid;
                                        grid-template-columns: 1fr 1fr;
                                        column-gap: 20px;
                                    }
                                </style>
                                <div class='input-row-group'>
                                    <div class='input-col'>
                                        <input value='$feet' type='number' step='1' min='1' max='8' class='feet' name='feet' id='feet' placeholder='Feet'>
                                        <div class='error' id='feetError'></div>
                                    </div>
                                    <div class='input-col'>
                                        <input value='$inch' type='number' step='1' min='0' max='11' class='inch' name='inch' id='inch' placeholder='Inch'>
                                        <div class='error' id='inchError'></div>
                                    </div>
                                </div>
                            </div>           
                        </div>
                        <div class='input-group'>
                            <div class='input-row'>
                                <div class='input-col input-col-1'>
                                    <label for='education'>Education</label>
                                </div>
                                <div class='input-col input-col-2'>                            
                                    <div class='selection'>
                                        <div id='educationTrigger' class='selection-trigger' onclick='selectDropdown(this.id);'>
                                            <div id='selectedEducation'>$education</div> 
                                            <i style='color: gray;margin-top:3px;' class='ion-chevron-down' aria-hidden='true'></i>
                                        </div>
                                        <div class='dropdown hideDropdown' id='educationDropdown'>
                                            <input value='$education' type='hidden' id='education' name='education' value=''>
                                            <span class='option select-option' id='Under matric' onclick='selectEducation(this.id);'>Under matric</span>
                                            <span class='option select-option' id='Matric' onclick='selectEducation(this.id);'>Matric</span>
                                            <span class='option select-option' id='Intermediate' onclick='selectEducation(this.id);'>Intermediate</span>
                                            <span class='option select-option' id='Bachelors' onclick='selectEducation(this.id);'>Bachelors</span>
                                            <span class='option select-option' id='Masters' onclick='selectEducation(this.id);'>Masters</span>
                                            <span class='option select-option' id='PhD' onclick='selectEducation(this.id);'>PhD</span>
                                        </div>
                                    </div>
                                    <div class='error' id='fullnameError'></div>
                                </div>
                            </div>           
                        </div>
                        <div class='input-group'>
                            <div class='input-row'>
                                <div class='input-col input-col-1'>
                                    <label for='occupation'>Occupation/Profession</label>
                                </div>
                                <div class='input-col input-col-2'>
                                    <input value='$occupation' type='text' class='occupation' name='occupation' id='occupation' placeholder='Business, Job, Doctor etc'>
                                    <div class='error' id='occupationError'></div>
                                </div>
                            </div>           
                        </div>
                        <div class='input-group'>
                            <div class='input-row'>
                                <div class='input-col input-col-1'>
                                    <label for='caste'>Caste</label>
                                </div>
                                <div class='input-col input-col-2'>
                                    <input value='$caste' type='text' class='caste' name='caste' id='caste' placeholder='Hashmi, Rajpoot, Arain etc'>
                                    <div class='error' id='casteError'></div>
                                </div>
                            </div>           
                        </div>
                        <div class='input-group'>
                            <div class='input-row'>
                                <div class='input-col input-col-1'>
                                    <label for='city'>City</label>
                                </div>
                                <div class='input-col input-col-2'>                            
                                    <div class='selection'>
                                        <input type='hidden' id='city_selected' name='city_selected' value='1' />
                                        <input type='text' value='$city' id='city' name='city' oninput='searchCity()' />
                                        <div style='max-height: 280px; overflow-Y: scroll;' class='dropdown hideDropdown' id='cityDropdown'>

                                        </div>
                                    </div>
                                    <div class='error' id='fullnameError'></div>
                                </div>
                            </div>           
                        </div>
                        <div class='input-group'>
                            <div class='input-row'>
                                <div class='input-col input-col-1'>
                                    <label for='description'>Description</label>
                                </div>
                                <div class='input-col input-col-3 desc-input'>
                                    <textarea name='description' id='description' class='description' cols='30' rows='5' placeholder='Example: Our daughter/son is educated, have govt job. We are looking for a respectful and educated family.'>$user_description</textarea>
                                    <div class='count' id='descCount'></div>
                                    <div class='error' id='descriptionError'></div>
                                </div>
                            </div>           
                        </div>
                        <div class='input-group'>
                            <div class='input-row'>
                                <div class='input-col input-col-1'>
                                    <label for='email'>Email</label>
                                </div>
                                <div class='input-col email-col input-col-2'>
                                    <input value='$email' onchange='checkDuplicateEmail(event);' type='text' class='email' name='email' id='email' placeholder='suleyman1@gmail.com'>
                                    <div class='error' id='email-error'></div>
                                </div>
                            </div>           
                        </div>
                        <div class='input-group'>
                            <div class='input-row'>
                                <div class='input-col input-col-1'>
                                    <label for='whatsapp'>WhatsApp #</label>
                                </div>
                                <div class='input-col input-col-2'>
                                    <input value='$whatsapp' type='number' class='whatsapp' name='whatsapp' id='whatsapp' placeholder='03335528850'>
                                    <div class='error' id='whatsappError'></div>
                                </div>
                            </div>           
                        </div>
                    </div>
                    <div class='submit-wrapper'>
                        <div class='update-user-btn' onclick='update_user(event)'>
                            Apply Changes
                        </div>
                    </div>
                </form>
            </div>";
        }
    }
?>