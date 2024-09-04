<?php

function filterProposals($marital_status, $age, $education, $city) {
    $users_array = array();
    $user_status = 'member';
    $account_status = 'approved';

    // var_dump($marital_status, $age, $education, $city);

    if(
        strtolower($marital_status) === 'any' && 
        strtolower($age) === 'any' && 
        strtolower($education) === 'any' && 
        strtolower($city) === 'any'
    ) {
        $stmt = $this->con->prepare("SELECT * FROM user_account WHERE user_status=? AND account_status=? ORDER BY id DESC");
        $stmt->bind_param('ss', $user_status, $account_status);
    } 
    elseif(
        strtolower($marital_status) === 'any' && 
        strtolower($age) === 'any' && 
        strtolower($education) === 'any' && 
        strtolower($city) !== 'any'
    ) {
        $stmt = $this->con->prepare("SELECT * FROM user_account WHERE user_status=? AND account_status=? AND city=? ORDER BY id DESC");
        $stmt->bind_param('sss', $user_status, $account_status, $city);
    } 
    elseif(
        strtolower($marital_status) === 'any' && 
        strtolower($age) === 'any' && 
        strtolower($education) !== 'any' && 
        strtolower($city) === 'any'
    ) {
        $stmt = $this->con->prepare("SELECT * FROM user_account WHERE user_status=? AND account_status=? AND education=? ORDER BY id DESC");
        $stmt->bind_param('sss', $user_status, $account_status, $education);
    } 
    elseif(
        strtolower($marital_status) === 'any' && 
        strtolower($age) !== 'any' && 
        strtolower($education) === 'any' && 
        strtolower($city) === 'any'
    ) {
        if($age == 40) {
            $ageLowest = 40;
        } else {
            $ageArr = explode('-', $age);
            $ageLowest = intval($ageArr[0]);
            $ageHighest = intval($ageArr[1]);
        }
        // var_dump($ageLowest);
        
        if($ageLowest == 40) {
            $stmt = $this->con->prepare("SELECT * FROM user_account WHERE user_status=? AND account_status=? AND age>? ORDER BY id DESC");
            $stmt->bind_param('sss', $user_status, $account_status, $ageLowest);
        } else {
            $stmt = $this->con->prepare("SELECT * FROM user_account WHERE user_status=? AND account_status=? AND age BETWEEN ? AND ? ORDER BY id DESC");
            $stmt->bind_param('ssss', $user_status, $account_status, $ageLowest, $ageHighest);
        }
    } 
    elseif(
        strtolower($marital_status) !== 'any' && 
        strtolower($age) === 'any' && 
        strtolower($education) === 'any' && 
        strtolower($city) === 'any'
    ) {
        $stmt = $this->con->prepare("SELECT * FROM user_account WHERE user_status=? AND account_status=? AND marital_status=? ORDER BY id DESC");
        $stmt->bind_param('sss', $user_status, $account_status, $marital_status);
    }
    elseif(
        strtolower($marital_status) !== 'any' && 
        strtolower($age) !== 'any' && 
        strtolower($education) === 'any' && 
        strtolower($city) === 'any'
    ) {
        if($age == 40) {
            $ageLowest = 40;
        } else {
            $ageArr = explode('-', $age);
            $ageLowest = intval($ageArr[0]);
            $ageHighest = intval($ageArr[1]);
        }
        if($ageLowest == 40) {
            $stmt = $this->con->prepare("SELECT * FROM user_account WHERE user_status=? AND account_status=? AND marital_status=? AND age>? ORDER BY id DESC");
            $stmt->bind_param('ssss', $user_status, $account_status, $marital_status, $ageLowest);
        } else {
            $stmt = $this->con->prepare("SELECT * FROM user_account WHERE user_status=? AND account_status=? AND marital_status=? AND age BETWEEN ? AND ? ORDER BY id DESC");
            $stmt->bind_param('sssss', $user_status, $account_status, $marital_status, $ageLowest, $ageHighest);
        }
    }
    elseif(
        strtolower($marital_status) !== 'any' && 
        strtolower($age) == 'any' && 
        strtolower($education) !== 'any' && 
        strtolower($city) === 'any'
    ) {
        $stmt = $this->con->prepare("SELECT * FROM user_account WHERE user_status=? AND account_status=? AND marital_status=? AND education=? ORDER BY id DESC");
        $stmt->bind_param('ssss', $user_status, $account_status, $marital_status, $education);
    }
    elseif(
        strtolower($marital_status) !== 'any' && 
        strtolower($age) === 'any' && 
        strtolower($education) === 'any' && 
        strtolower($city) !== 'any'
    ) {
        $stmt = $this->con->prepare("SELECT * FROM user_account WHERE user_status=? AND account_status=? AND marital_status=? AND cityn=? ORDER BY id DESC");
        $stmt->bind_param('ssss', $user_status, $account_status, $marital_status, $city);
    }
    elseif(
        strtolower($marital_status) !== 'any' && 
        strtolower($age) !== 'any' && 
        strtolower($education) !== 'any' && 
        strtolower($city) === 'any'
    ) {
        if($age == 40) {
            $ageLowest = 40;
        } else {
            $ageArr = explode('-', $age);
            $ageLowest = intval($ageArr[0]);
            $ageHighest = intval($ageArr[1]);
        }
        if($ageLowest == 40) {
            $stmt = $this->con->prepare("SELECT * FROM user_account WHERE user_status=? AND account_status=? AND marital_status=? AND age>? AND education=? ORDER BY id DESC");
            $stmt->bind_param('sssss', $user_status, $account_status, $marital_status, $ageLowest, $education);
        } else {
            $stmt = $this->con->prepare("SELECT * FROM user_account WHERE user_status=? AND account_status=? AND marital_status=? AND age BETWEEN ? AND ? AND education=? ORDER BY id DESC");
            $stmt->bind_param('ssssss', $user_status, $account_status, $marital_status, $ageLowest, $ageHighest, $education);
        }
    }
    elseif(
        strtolower($marital_status) !== 'any' && 
        strtolower($age) !== 'any' && 
        strtolower($education) !== 'any' && 
        strtolower($city) !== 'any'
    ) {
        if($age == 40) {
            $ageLowest = 40;
        } else {
            $ageArr = explode('-', $age);
            $ageLowest = intval($ageArr[0]);
            $ageHighest = intval($ageArr[1]);
        }
        if($ageLowest == 40) {
            $stmt = $this->con->prepare("SELECT * FROM user_account WHERE user_status=? AND account_status=? AND marital_status=? AND age>? AND education=? AND city=? ORDER BY id DESC");
            $stmt->bind_param('ssssss', $user_status, $account_status, $marital_status, $ageLowest, $education, $city);
        } else {
            $stmt = $this->con->prepare("SELECT * FROM user_account WHERE user_status=? AND account_status=? AND marital_status=? AND age BETWEEN ? AND ? AND education=? AND city=? ORDER BY id DESC");
            $stmt->bind_param('sssssss', $user_status, $account_status, $marital_status, $ageLowest, $ageHighest, $education, $city);
        }
    }
    elseif(
        strtolower($marital_status) === 'any' && 
        strtolower($age) !== 'any' && 
        strtolower($education) !== 'any' && 
        strtolower($city) === 'any'
    ) {
        if($age == 40) {
            $ageLowest = 40;
        } else {
            $ageArr = explode('-', $age);
            $ageLowest = intval($ageArr[0]);
            $ageHighest = intval($ageArr[1]);
        }
        if($ageLowest == 40) {
            $stmt = $this->con->prepare("SELECT * FROM user_account WHERE user_status=? AND account_status=? AND age>? AND education=? ORDER BY id DESC");
            $stmt->bind_param('ssss', $user_status, $account_status, $ageLowest, $education);
        } else {
            $stmt = $this->con->prepare("SELECT * FROM user_account WHERE user_status=? AND account_status=? AND age BETWEEN ? AND ? AND education=? ORDER BY id DESC");
            $stmt->bind_param('sssss', $user_status, $account_status, $ageLowest, $ageHighest, $education);
        }
    }
    elseif(
        strtolower($marital_status) === 'any' && 
        strtolower($age) !== 'any' && 
        strtolower($education) === 'any' && 
        strtolower($city) !== 'any'
    ) {
        if($age == 40) {
            $ageLowest = 40;
        } else {
            $ageArr = explode('-', $age);
            $ageLowest = intval($ageArr[0]);
            $ageHighest = intval($ageArr[1]);
        }
        if($ageLowest == 40) {
            $stmt = $this->con->prepare("SELECT * FROM user_account WHERE user_status=? AND account_status=? AND age>? AND city=? ORDER BY id DESC");
            $stmt->bind_param('ssss', $user_status, $account_status, $ageLowest, $city);
        } else {
            $stmt = $this->con->prepare("SELECT * FROM user_account WHERE user_status=? AND account_status=? AND age BETWEEN ? AND ? AND city=? ORDER BY id DESC");
            $stmt->bind_param('sssss', $user_status, $account_status, $ageLowest, $ageHighest, $city);
        }
    }
    elseif(
        strtolower($marital_status) === 'any' && 
        strtolower($age) === 'any' && 
        strtolower($education) !== 'any' && 
        strtolower($city) !== 'any'
    ) {
        if($age == 40) {
            $ageLowest = 40;
        } else {
            $ageArr = explode('-', $age);
            $ageLowest = intval($ageArr[0]);
            $ageHighest = intval($ageArr[1]);
        }

        $stmt = $this->con->prepare("SELECT * FROM user_account WHERE user_status=? AND account_status=? AND education=? AND city=? ORDER BY id DESC");
        $stmt->bind_param('ssss', $user_status, $account_status, $education, $city);
    } 
    elseif(
        strtolower($marital_status) !== 'any' && 
        strtolower($age) === 'any' && 
        strtolower($education) !== 'any' && 
        strtolower($city) !== 'any'
    ) {

        $stmt = $this->con->prepare("SELECT * FROM user_account WHERE user_status=? AND account_status=? AND marital_status=? AND education=? AND city=? ORDER BY id DESC");
        $stmt->bind_param('sssss', $user_status, $account_status, $marital_status, $education, $city);
    }
    elseif(
        strtolower($marital_status) === 'any' && 
        strtolower($age) !== 'any' && 
        strtolower($education) !== 'any' && 
        strtolower($city) !== 'any'
    ) {
        if($age == 40) {
            $ageLowest = 40;
        } else {
            $ageArr = explode('-', $age);
            $ageLowest = intval($ageArr[0]);
            $ageHighest = intval($ageArr[1]);
        }
        if($ageLowest == 40) {
            $stmt = $this->con->prepare("SELECT * FROM user_account WHERE user_status=? AND account_status=? AND age>? AND education=? AND city=? ORDER BY id DESC");
            $stmt->bind_param('sssss', $user_status, $account_status, $ageLowest, $education, $city);
        } else {
            $stmt = $this->con->prepare("SELECT * FROM user_account WHERE user_status=? AND account_status=? AND age BETWEEN ? AND ? AND education=? AND city=? ORDER BY id DESC");
            $stmt->bind_param('ssssss', $user_status, $account_status, $ageLowest, $ageHighest, $education, $city);
        }
    }
    

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
                    $elapsed = strval($elapsed_array[8]) . ' minute ago';
                } else {
                    $elapsed = strval($elapsed_array[8]) . ' minutes ago';
                }
            } elseif(intval($elapsed_array[10]) > 0) {
                if(intval($elapsed_array[10]) == 1) {
                    $elapsed = strval($elapsed_array[10]) . ' second ago';
                } else {
                    $elapsed = strval($elapsed_array[10]) . ' seconds ago';
                }
            }

            // Check if photo exists
            if(!isset($row['photo']) || empty($row['photo'])) {
                $photo = 'avi.png';
            } else {
                $photo = $row['photo'];
            }
            $phone_str_1 = substr($row['whatsapp'], 0, 4);
            $phone_str_2 = substr($row['whatsapp'], 6, 8);
            $phone_str_3 = '****';
            $phone_redacted = $phone_str_1.'-'.$phone_str_2.' '.$phone_str_3;

            $user_array = array(
                'id' => $row['id'],
                'relationship' => $row['relationship'],
                'fullname' => $row['fullname'],
                'email' => $row['email'],
                'pwd' => $row['pwd'],
                'whatsapp' => $row['whatsapp'],
                'phone_redacted' => $phone_redacted,
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

function showFilteredProposals($marital_status, $age, $education, $city) {
    
    $users_array = filterProposals($marital_status, $age, $education, $city);
    
    // $users_array = $this->filterProposals($marital_status, $age, $education, $city);
    $num_of_rows = count($users_array);

    $logged_in_user = get_uid();
    $user_account_status = get_account_status();
    
    $results_per_page = 5;
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

    $proposalsStr = "";

    for($x=$starting_limit_number; $x<$starting_limit_number+$results_per_page; $x++) {
        if($x < $num_of_rows) {
            $user_array = $users_array[$x];
            $user_description = nl2br($user_array['user_description']);
            
            if(!empty($user_array['photo'])) {
                if(!empty($user_account_status) && isset($user_account_status) && $user_account_status == 'approved') {
                    $photoStr = "<div class='proposal-photo'>
                        <img src='./img/{$user_array['photo']}' alt='{$user_array['fullname']}'>
                    </div>";
                } else {
                    $photoStr = "<div class='proposal-photo'>
                        <img src='./img/{$user_array['photo']}' alt='{$user_array['fullname']}'>
                        <div class='img-overlay-outer'>
                            <div class='img-overlay'>
                                <div class='img-overlay-inner'>
                            
                                </div>
                            </div>
                        </div>
                    </div>";
                }
            } else {
                $photoStr = "<div class='proposal-photo'>
                    <img src='./assets/img/avi.png?v=2' alt='{$user_array['fullname']}'>
                </div>";
            }
            if(!empty($user_account_status) && isset($user_account_status) && $user_account_status == 'approved') {
                $whatsappStr = "<div class='proposal-contact'>
                    <div class='proposal-contact-col' id='proposal-contact-col-1'>
                        <div>
                            Contact Number
                        </div>
                        <div>
                            <img src='./assets/svg/whatsapp-2.svg' alt='whatsapp-icon'>
                            <div>{$user_array['whatsapp']}</div>
                        </div>
                    </div>     
                    <div class='proposal-contact-col' id='proposal-contact-col-2'>
                        
                    </div>     
                </div>";
                $whatsappStrMob = "<div class='proposal-contact' id='proposal-contact-{$user_array['id']}'>
                    <div class='proposal-contact-col' id='proposal-contact-col-1'>
                        <div>
                            Contact Number
                        </div>
                        <div>
                            <img src='./assets/svg/whatsapp-2.svg' alt='whatsapp-icon'>
                            <div>{$user_array['whatsapp']}</div>
                        </div>
                    </div>     
                    <div class='proposal-contact-col' id='proposal-contact-col-2'>
                        
                    </div>     
                </div>";
            } else {
                $whatsappStr = "<div class='proposal-contact'>
                    <div class='proposal-contact-col' id='proposal-contact-col-1'>
                        <div>
                            Contact Number
                        </div>
                        <div>
                            <img src='./assets/svg/whatsapp-2.svg' alt='whatsapp-icon'>
                            <div>{$user_array['phone_redacted']}</div>
                        </div>
                    </div>     
                    <div class='proposal-contact-col' id='proposal-contact-col-2'>
                        <div>
                            To view Number
                        </div>
                        <a class='btn-link register-link' href='./registration'>
                            Register Yourself
                        </a>
                    </div>     
                </div>";
                $whatsappStrMob = "<div class='proposal-contact' id='proposal-contact-{$user_array['id']}'>
                    <div class='proposal-contact-col' id='proposal-contact-col-1'>
                        <div>
                            Contact Number
                        </div>
                        <div>
                            <img src='./assets/svg/whatsapp-2.svg' alt='whatsapp-icon'>
                            <div>{$user_array['phone_redacted']}</div>
                        </div>
                    </div>     
                    <div class='proposal-contact-col' id='proposal-contact-col-2'>
                        <div>
                            To view Number
                        </div>
                        <a class='btn-link register-link' href='./registration'>
                            Register Yourself
                        </a>
                    </div>     
                </div>";
            }

            $proposalsStr .= "
            <div class='proposal'>
                <div class='proposal-head'>
                    <div class='col' id='col-1'>
                        <span>Posted By: </span>
                        <span>{$user_array['relationship']}</span>
                    </div>
                    <div class='col' id='col-2'>
                        <span>{$user_array['elapsed']}</span>
                    </div>
                </div>
                <div class='proposal-body'>
                    <div class='col' id='col-1'>
                        <div class='proposal-description'>
                            <div>Description</div>
                            <div>{$user_array['user_description']}</div>     
                        </div>
                        $whatsappStr
                    </div>

                    <div class='proposal-info-col col' id='col-2'>
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
                    </div>
                    <div class='col' id='col-3'>
                        $photoStr
                    </div>
                </div>              
            </div>
            <div class='proposal proposal-mobile'>
                <div class='proposal-head'>
                    <div class='col' id='col-1'>
                        <span>Posted By: </span>
                        <span>{$user_array['relationship']}</span>
                    </div>
                    <div class='col' id='col-2'>
                        <span>{$user_array['elapsed']}</span>
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
                    </div>
                    $whatsappStrMob
                    <div id='{$user_array['id']}' class='show-details show-details-{$user_array['id']}' onclick='proposalDetails(this.id);'>
                        Show Details
                    </div>
                </div>              
            </div>";         
        // endforeach;
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
    $proposalFooter = "<div class='pagination'>
        <div>
            <a class='page-num arrow' href='./index?marital_status=$marital_status&age=$age&education=$education&city=$city&page=".$prev."'>
                <i class='fas fa-arrow-left'></i>
            </a>
        </div>
    <div class='pagination-links'>";
    for($p=1;$p<=$num_of_pages;$p++) {
        if($page == $p) {
            $proposalFooter .= "<a class='page-num current-page' href='./index?marital_status=$marital_status&age=$age&education=$education&city=$city&page=".$p."'>".$p."</a> ";
        } else {
            if($page == $num_of_pages) {
                if($p >= $page - 3) {
                    $proposalFooter .= "<a class='page-num' href='./index?marital_status=$marital_status&age=$age&education=$education&city=$city&page=".$p."'>".$p."</a> ";
                } 
            } else {
                if($page < 4) {
                    if($p < 5) {
                        $proposalFooter .= "<a class='page-num' href='./index?marital_status=$marital_status&age=$age&education=$education&city=$city&page=".$p."'>".$p."</a> ";
                    }
                } else {
                    if( ($p > $page - 3 && $p < $page) || ($p > $page && $p < $page + 2)) {
                        $proposalFooter .= "<a class='page-num' href='./index?marital_status=$marital_status&age=$age&education=$education&city=$city&page=".$p."'>".$p."</a> ";
                    }
                }                
            }
        }
    }
    $proposalFooter .= "</div>
        <div>
            <a class='page-num arrow' href='./index?marital_status=$marital_status&age=$age&education=$education&city=$city&page=".$next."'>
                <i class='fas fa-arrow-right'></i>
            </a>
        </div>
    </div>";
    $proposalsStr .= $proposalFooter;
    return $proposalsStr;
}

?>