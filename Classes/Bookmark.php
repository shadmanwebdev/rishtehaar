<?php

class Bookmark extends User {
    public function __construct() {
        $this->con = $this->con();
    }
    public function get_bookmark_by_id($bookmark_id) {
        $stmt = $this->con->prepare("SELECT * FROM bookmarks WHERE id=? LIMIT 1");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        return $data[0];
    }
    public function get_bookmarks_by_user_id($bookmarked_by_id) {
        $stmt = $this->con->prepare("SELECT * FROM bookmarks WHERE bookmarked_by_id=? ORDER BY id DESC");
        $stmt->bind_param('i', $bookmarked_by_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        return $data;
    }
    public function get_bookmarks_and_users() {
        $bookmarked_by_id = $this->get_uid();
        $users_array = array();
        // Prepare the SQL statement with the JOIN clause
        $stmt = $this->con->prepare("SELECT u.*, b.* FROM user_account u LEFT JOIN bookmarks b ON u.id = b.profile_id WHERE b.bookmarked_by_id=?");
        if (!$stmt) {
            die("Error in SQL: " . $this->con->error);
        }
        $stmt->bind_param("i", $bookmarked_by_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        if(isset($data)) {
            if(intval($result->num_rows) > 0) {
                foreach($data as $row) {
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
                        'payment_proof' => $row['payment_proof']
                    );
                    array_push($users_array, $user_array);
                }
            }
        }
        return $users_array;
    }
    public function show_bookmarks() {
        $logged_in = $this->is_logged_in();
        $bookmarked_by_id = $this->get_uid();
        $users_array = $this->get_bookmarks_and_users(11);

        $logged_in_user = $this->get_uid();
        $user_account_status = $this->get_account_status();
        
        $num_of_rows = count($users_array);
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

        
        $profile_ids_array = $this->bookmarks_by_user($logged_in_user);


        if($num_of_rows > 0) {
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
    
            $proposalFooter = "<div class='pagination'>
            <div>
                <a class='page-num arrow' href='./bookmarks?page=" . ($page > 1 ? ($page - 1) : 1) . "'>
                    <i class='fas fa-arrow-left'></i>
                </a>
            </div>
            <div class='pagination-links'>";
        
            // Show links only if there is more than one page
            if ($num_of_pages > 1) {
                // Show the current page and links for next 2 pages
                for ($p = $page; $p <= min($num_of_pages, $page + 2); $p++) {
                    if ($p != $page) {
                        $proposalFooter .= "<a class='page-num' href='./bookmarks?page=" . $p . "'>" . $p . "</a> ";
                    } else {
                        $proposalFooter .= "<a class='page-num current-page' href='./bookmarks?page=" . $p . "'>" . $p . "</a> ";
                    }
                }
            
                // Skip links for 2 pages
                if ($page + 5 < $num_of_pages) {
                    $proposalFooter .= "<span>...</span> ";
                }
            
                // Show the link for the 6th page if available
                if ($page + 4 < $num_of_pages) {
                    $proposalFooter .= "<a class='page-num' href='./bookmarks?page=" . ($page + 4) . "'>" . ($page + 4) . "</a> ";
                } 
                else if ($page + 3 < $num_of_pages) {
                    $proposalFooter .= "<a class='page-num' href='./bookmarks?page=" . ($page + 3) . "'>" . ($page + 3) . "</a> ";
                }
            } else {
                // If there's only one page, show the link for the current page and previous/next page links
                $proposalFooter .= "<a class='page-num current-page' href='./bookmarks?page=" . $page . "'>" . $page . "</a> ";
            }
            
            $proposalFooter .= "</div>
                <div>
                    <a class='page-num arrow' href='./bookmarks?page=" . ($page < $num_of_pages ? ($page + 1) : $num_of_pages) . "'>
                        <i class='fas fa-arrow-right'></i>
                    </a>
                </div>
            </div>";
    
            $proposalsStr .= $proposalFooter;
            echo $proposalsStr;
        } else {
            echo '</div>No bookmarks yet</div>';
        }
    }
    public function bookmark() {  
        $this->startSession();
        $profile_id = $_POST['profile_id'];
        $bookmarked_by_id = $this->get_uid();
        if(isset($bookmarked_by_id)) {
            $bookmark_exists = $this->bookmark_exists($profile_id, $bookmarked_by_id);
            if($bookmark_exists == '0') {
                $created_at = datetime_now();
                
                $stmt = $this->con->prepare("INSERT INTO bookmarks(profile_id, bookmarked_by_id, created_at) VALUES (?, ?, ?)");
                $stmt->bind_param("iis", $profile_id, $bookmarked_by_id, $created_at);
                if($stmt->execute()) {   
                    $status = '1';
                } else {
                    $status = '0';
                    die('prepare() failed: ' . htmlspecialchars($this->con->error));
                    die('bind_param() failed: ' . htmlspecialchars($stmt->error));
                    die('execute() failed: ' . htmlspecialchars($stmt->error));
                }
                $stmt->close();
            } else {
                $stmt = $this->con->prepare("DELETE FROM bookmarks WHERE profile_id=? AND bookmarked_by_id=?");
                $stmt->bind_param('ii', $profile_id, $bookmarked_by_id);
                $stmt->execute();
                $stmt->close();
                $status = '0';
            }
        } else {
            $status = '3';
        }
        
        echo $status;
    }
    function bookmark_exists($profile_id, $bookmarked_by_id) {
        $stmt = $this->con->prepare("SELECT COUNT(*) as count FROM bookmarks WHERE profile_id = ? AND bookmarked_by_id = ?");
        $stmt->bind_param("si", $profile_id, $bookmarked_by_id);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();
        return $count > 0 ? '1' : '0';
    }

}