<?php  
    /*
    =================================================================
        SESSIONS & COOKIES
        FILE UPLOAD
        DATE & TIME
        DATA MANIPULATION
        FOLDERS & DIRECTORIES
    =================================================================  
    */
    /*
    =================================================================
        SESSIONS & COOKIES
    =================================================================  
    */
    function get_order_date() {
        if(isset($_COOKIE['user'])) {
            $userdata = json_decode($_COOKIE['user'], true);
            $order_date = $userdata['order_date'];
            return $order_date;
        } else if(isset($_SESSION['user'])) {
            $userdata = json_decode($_SESSION['user'], true);
            $order_date = $userdata['order_date'];
            return $order_date;
        }
    }
    function get_basket_id() {
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
    function get_payment_status() {
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
    function get_whatsapp() {
        if(isset($_COOKIE['user'])) {
            $userdata = json_decode($_COOKIE['user'], true);
            $whatsapp = $userdata['whatsapp'];
            return $whatsapp;
        } else if(isset($_SESSION['user'])) {
            $userdata = json_decode($_SESSION['user'], true);
            $whatsapp = $userdata['whatsapp'];
            return $whatsapp;
        }
        return false;
    }
    function is_logged_in() {
        if(isset($_COOKIE['user'])) {
            $userdata = json_decode($_COOKIE['user'], true);
            $logged = $userdata['logged'];
            return $logged;
        } else if(isset($_SESSION['user'])) {
            $userdata = json_decode($_SESSION['user'], true);
            $logged = $userdata['logged'];
            return $logged;
        }
        return false;
    }
    function get_uid() {
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
    function get_user_status() {
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
    function get_account_status() {
        if(isset($_COOKIE['user'])) {
            $userdata = json_decode($_COOKIE['user'], true);
            $account_status = $userdata['account_status'];
            return $account_status;
        } else if(isset($_SESSION['user'])) {
            $userdata = json_decode($_SESSION['user'], true);
            $account_status = $userdata['account_status'];
            return $account_status;
        }
    } 
    function get_firstname() {
        if(isset($_COOKIE['user'])) {
            $userdata = json_decode($_COOKIE['user'], true);
            $firstname = $userdata['firstname'];
        } else if(isset($_SESSION['user'])) {
            $userdata = json_decode($_SESSION['user'], true);
            $firstname = $userdata['firstname'];
        }
        return $firstname;
    }
    function get_lastname() {
        if(isset($_COOKIE['user'])) {
            $userdata = json_decode($_COOKIE['user'], true);
            $lastname = $userdata['lastname'];
        } else if(isset($_SESSION['user'])) {
            $userdata = json_decode($_SESSION['user'], true);
            $lastname = $userdata['lastname'];
        }
        return $lastname;
    }
    function fullname() {
        if(isset($_COOKIE['user'])) {
            $userdata = json_decode($_COOKIE['user'], true);
            $fullname = $userdata['fullname'];
            return $fullname;
        } else if(isset($_SESSION['user'])) {
            $userdata = json_decode($_SESSION['user'], true);
            $fullname = $userdata['fullname'];
            return $fullname;
        }
    }
    function get_user_photo() {
        if(isset($_COOKIE['user'])) {
            $userdata = json_decode($_COOKIE['user'], true);
            $photo = $userdata['photo'];
        } else if(isset($_SESSION['user'])) {
            $userdata = json_decode($_SESSION['user'], true);
            $photo = $userdata['photo'];
        }
        return $photo;
    }
    function get_user_email() {
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

    function bookingCheck($dbpath) {
        include $dbpath;
        $id = 1;
        $stmt = $con->prepare("SELECT * FROM booking_link WHERE id=?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);

        foreach($data as $row): 
            $booking_value = intval($row['display']);
        endforeach;

        $stmt->close();
        $con->close();
        return $booking_value;
    }
    function contactCheck($dbpath) {
        include $dbpath;
        $id = 1;
        $stmt = $con->prepare("SELECT * FROM contact_link WHERE id=?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);

        foreach($data as $row): 
            $contact_value = intval($row['display']);
        endforeach;

        $stmt->close();
        $con->close();

        return $contact_value;
    }
    function waiver_less($more) {
        $less = substr($more, 0, 180);
        return $less;
    }

    /*
    =================================================================
        FILE UPLOAD
    =================================================================  
    */
    function add_img($n) {
        $img = $_FILES[$n]['name'];

        // CHECK IF INPUT IS EMPTY
        if(!empty($img)) {
            $allowed = array('png', 'jpg', 'jpeg', 'jfif', 'webp');
            $ext = pathinfo($img, PATHINFO_EXTENSION);

            // CHECK IF FILE TYPE IS ALLOWED
            if (!in_array($ext, $allowed)) {
                echo '0';
                return;
            } else {
                $imagePath = '../../img/blog/';
                $uniquesavename = time() . uniqid(rand(10, 20));
                $tempname = $_FILES[$n]['tmp_name'];

                list($width, $height) = getimagesize($tempname);

                // Convert the image to WebP format
                if ($ext == 'png') {
                    $source = imagecreatefrompng($tempname);
                } elseif (in_array($ext, array('jpg', 'jpeg', 'jfif'))) {
                    $source = imagecreatefromjpeg($tempname);
                }

                // Check if image conversion succeeded
                if ($source) {
                    $destFile = $imagePath . $uniquesavename . '.webp';
                    imagewebp($source, $destFile, 80); // 80 is the quality, you can adjust it
                    imagedestroy($source);
                    
                    // Use move_uploaded_file to move the converted WebP image to the destination folder
                    move_uploaded_file($tempname, $destFile);

                    // Delete the original image if needed
                    // unlink($tempname);

                    $filename = $uniquesavename . '.webp';
                } else {
                    return 'failed';
                }
            }
        } else {
            $filename = '';
        }

        return $filename;
    }

    function add_profile_img($n) {
        $img = $_FILES[$n]['name'];

        // CHECK IF INPUT IS EMPTY
        if(!empty($img)) {
            $allowed = array('png', 'jpg', 'jpeg', 'jfif', 'webp');
            $ext = pathinfo($img, PATHINFO_EXTENSION);

            // CHECK IF FILE TYPE IS ALLOWED
            if (!in_array($ext, $allowed)) {
                echo '0';
                return;
            } else {
                $imagePath = '../img/';
                $uniquesavename = time() . uniqid(rand(10, 20));
                $tempname = $_FILES[$n]['tmp_name'];

                list($width, $height) = getimagesize($tempname);

                // Convert the image to WebP format
                if ($ext == 'png') {
                    $source = imagecreatefrompng($tempname);
                } elseif (in_array($ext, array('jpg', 'jpeg', 'jfif'))) {
                    $source = imagecreatefromjpeg($tempname);
                }

                // Check if image conversion succeeded
                if ($source) {
                    $destFile = $imagePath . $uniquesavename . '.webp';
                    imagewebp($source, $destFile, 80); // 80 is the quality, you can adjust it
                    imagedestroy($source);
                    
                    // Use move_uploaded_file to move the converted WebP image to the destination folder
                    move_uploaded_file($tempname, $destFile);

                    // Delete the original image if needed
                    // unlink($tempname);

                    $filename = $uniquesavename . '.webp';
                } else {
                    return 'failed';
                }
            }
        } else {
            $filename = '';
        }

        return $filename;

        // Example usage: add_profile_img('image', 300, 300);

    }


    /*
    =================================================================
        DATE & TIME
    =================================================================  
    */
    function hasYearDifference($tz='Asia/Karachi') {
        $inputDate = get_order_date();
        if(!empty($inputDate)) {

            // Get the current date
            $currentDate = new DateTime("now", new DateTimeZone($tz) );
        
            // Convert the input date to a DateTime object
            $inputDateTime = DateTime::createFromFormat('Y-m-d', $inputDate);
        
            // Calculate the difference in years
            $yearDifference = $currentDate->diff($inputDateTime)->y;
        
            // Check if the difference is at least 1 year
            return $yearDifference >= 1;
        } else {
            return true;
        }
    }
    function date_now($tz='Asia/Karachi') {
        $now = new DateTime("now", new DateTimeZone($tz) );
        $date = $now->format('Y-m-d');
        return $date;
    }
    function datetime_now($tz='Asia/Karachi') {
        $now = new DateTime("now", new DateTimeZone($tz) );
        $datetime = $now->format('Y-m-d H:i:s');
        return $datetime;
    }
    function datetime_mjy($dt, $tz='Asia/Karachi') {
        $new_dt = new DateTime($dt, new DateTimeZone('Asia/Karachi') );
        return $new_dt->format("M j, Y h:i A");
    }
    /*
    =================================================================
        DATA MANIPULATION
    =================================================================  
    */
    function getFullURL() {
        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
        $hostname = $_SERVER['SERVER_NAME'];
        $port = $_SERVER['SERVER_PORT'] != '80' ? ':' . $_SERVER['SERVER_PORT'] : '';
        $path = $_SERVER['REQUEST_URI'];

        return $protocol . $hostname . $port . $path;
    }
    function getCities() {
        $cities = array("Karachi","Lahore","Faisalabad","Rawalpindi","Multan","Gujranwala","Hyderabad","Peshawar","Islamabad","Quetta","Sargodha","Sialkot","Bahawalpur","Sukkur","Jhang","Sheikhupura","Mardan","Gujrat","Larkana","Kasur","Rahim Yar Khan","Sahiwal","Okara","Wah","Dera Ghazi Khan","Mingora","Chiniot","Mirpur Khas","Nawabshah","Kamoke","Burewala","Jhelum","Sadiqabad","Khanewal","Hafizabad","Kohat","Jacobabad","Shikarpur","Muzaffargarh","Khanpur","Gojra","Bahawalnagar","Abbottabad","Muridke","Khuzdar","Pakpattan","Jaranwala","Chishtian","Daska","Mandi Bahauddin","Ahmadpur East","Kamalia","Tando Adam","Khairpur","Dera Ismail Khan","Vehari","Nowshera","Dadu, Pakistan","Wazirabad","Khushab","Charsadda","Swabi","Chakwal","Mianwali","Turbat","Tando Allahyar","Kot Adu","Chaman","Hub, Balochistan","Arifwala","Chichawatni","Kharian","Taxila","Layyah","Hasilpur","Attock","Jalalpur","Bhakkar","Lodhran","Mian Channu","Shorkot","Harunabad","Bhalwal","Kandhkot","Lalamusa","Kot Abdul Malik","Toba Tek Singh","Pattoki","Kahror Pacca","Chuhar Kana","Gujar Khan","Narowal","Tando Muhammad Khan","Shujabad","Sibi","Badin","Kotri","Dipalpur","Pano Aqil","Shabqadar","Shahdadkot","Phool Nagar","Moro","Ferozwala","Sammundri","Mailsi","Shahdadpur","Mansehra","Qambar","Haveli Lakha","Zhob","Gwadar","Jampur","Takht-i-Bahi","Shakargarh","Sangla Hill","Nankana Sahib","Sambrial","Haripur, Pakistan","Bannu","Hujra Shah Muqeem","Ghotki","Kabirwala","Sanghar","Chunian","Gakhars","Timergara","Dera Murad Jamali","Pasrur","Dera Allah Yar","Usta Mohammad","Rajanpur","Rabwah","Dullewala","Qila Didar Singh","Rohri","Shahkot, Pakistan","Hadali","Jauharabad","Batkhela","Alipur Chatha","Kot Radha Kishan","Kahna Nau","Dina, Pakistan","Matli","Jatoi","Taunsa Sharif","Abdul Hakeem","Hasan Abdal","Mirpur Mathelo","Sarai Alamgir","Loralai","Kamra","Mustafabad, Punjab","Hala, Sindh","Talagang","Ratodero","Basirpur","Khalabat Township","Tank, Pakistan","Fort Abbas","Kot Moman","Nowshera Virkan","Tandlianwala","Thatta","Ludhewala Waraich","Dinga","Kundian","Pasni (city)","Chowk Azam","Havelian","Risalpur","Umerkot","Sahiwal","Pabbi","Jalalpur Pirwala","Chak Jhumra","Liaqauatpur","Renala Khurd","Sehwan Sharif","Jehangira","Bhera","Lakki Marwat","Topi, Khyber Pakhtunkhwa","Malakwal","Hangu, Pakistan","Chitral","Daharki","Kharan, Pakistan","Pir Mahal","Khurrianwala","Pindigheb","Pindi Bhattian","Badah","Narang, Gujrat","Zāhir Pīr","Dunyapur","Mastung, Pakistan","Alipur Chatha","Lalian");
        if (!is_array($cities)) {
            return false;
        }
        sort($cities, SORT_STRING | SORT_FLAG_CASE);
        return $cities;
    }

    function createHTMLStringFromArray($textArray) {
        $htmlString = '';

        foreach ($textArray as $textItem) {
            // Escape the text item to prevent HTML injection
            $escapedTextItem = htmlspecialchars($textItem, ENT_QUOTES, 'UTF-8');

            // Append the HTML string for each text item to the main string
            $htmlString .= "<span class='option' id='$escapedTextItem' onclick='filterCity(this.id);'>$escapedTextItem</span>";
        }

        return $htmlString;
    }
    function createHTMLStringFromArrayRegister($textArray) {
        $htmlString = '';

        foreach ($textArray as $textItem) {
            // Escape the text item to prevent HTML injection
            $escapedTextItem = htmlspecialchars($textItem, ENT_QUOTES, 'UTF-8');
            // Append the HTML string for each text item to the main string
            $htmlString .= "<span class='option select-option' id='$escapedTextItem' onclick='selectCity(this.id);'>$escapedTextItem</span>";
        }

        return $htmlString;
    }
    function generateSlug($input) {
        $slug = strtolower($input);
        $slug = preg_replace('/[^a-z0-9-]+/', '-', $slug);
        $slug = trim($slug, '-');
        return $slug;
    }



        /*
    =================================================================

        DATA MANIPULATION & VALIDATION
    
    =================================================================  
    */ 
    function parseStringToArray($string) {
        return explode("|", $string);
    }
    function parseStringToArray2($string) {
        $lines = explode("|", $string);
        $data = [];
      
        foreach ($lines as $line) {
            $line = trim($line);
      
            if (!empty($line)) {
                list($label, $value) = explode(':', $line, 2);
                $label = trim($label);
                $value = trim($value);
        
                $data[] = [
                    'label' => $label,
                    'value' => $value
                ];
            }
        }
      
        return $data;
    }
    function remove_array_item_by_key($array, $key) {
        unset($array[$key]);
    }
    function remove_array_item($array, $item) {
        $myArray = array_filter($array, function ($item) {
            return $value !== $item;
        });
    }
    function first_char($str) {
        return substr($str, 0, 1);
    }
    function sortAlphabetically($array) {
        if (!is_array($array)) {
            return false;
        }       
        sort($array, SORT_STRING | SORT_FLAG_CASE);
        return $array;
    }
    function getFirstParagraph($text) {
        // Split the text into paragraphs
        $paragraphs = preg_split('/\n\s*\n/', $text);
    
        // Get the first paragraph
        $firstParagraph = trim($paragraphs[0]);
    
        // Return the first paragraph
        return $firstParagraph;
    }
    function paragraphs($content) {
        $paragraphs = preg_split('/\n/', $content);

        $pStr = "";
        foreach($paragraphs as $paragraph):
            $pStr .= "<p>$paragraph</p>";
        endforeach;
        return $pStr;
    }
    function jsonToStr($a) {  
        /*
            The function takes a JSON-encoded string, decodes it into an array, 
            and then concatenates the array elements into a new string separated by commas and spaces. 
            The resulting string is returned by the function.
        */
        $new_str = '';
        $b = json_decode($a, true);
        // $new_array = explode(",", $new_array);
        if(is_array($b)) {
            if(count($b) > 0) {
                for($s=0; $s < count($b); $s++) {
                    if($s == 0) {
                        $new_str .= $b[$s];
                    } else {
                        $new_str .= ', '.$b[$s];
                    }
                }
                $new_str .= '';
            }
        }
        return $new_str;
    }
    function empty_array($arr) {
        /*
            Unsets an array and returns an empty array
        */
        unset($arr);
        $arr = array();
        return $arr;
    }
    /*
        This function takes a string of content and a desired length as input. It removes 
        any HTML or PHP tags from the content and, if necessary, truncates the content to 
        the specified length with an ellipsis. The resulting modified content is then 
        returned by the function.
    */
    function segment($content, $len) {
        $length = strlen($content);
        $content = strip_tags($content);
        if($length > $len) {
            $content = substr($content, 0, $len).'...'; 
        }  
        return $content;
    }
    function read_time($content) {
        $words = explode(' ',$content);
        $time = count($words) / 200;
        $time = explode('.', $time);
        return $time[0];
    } 
    /*
    =================================================================
        FOLDERS & DIRECTORIES
    =================================================================  
    */
    function get_pagename() {
        $pagename = basename($_SERVER["SCRIPT_FILENAME"], '.php');
        return $pagename;
    }
?>