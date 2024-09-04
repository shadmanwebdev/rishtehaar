<?php

    class Blog extends Db {
        public function __construct() {
            $this->con = $this->con();
        }
        private function startSession() {
            ob_start();
            session_start();
        }
        private function endSession() {
            session_unset();
            session_destroy();
        }


        // Function to check if a session is set for a post
        public function isPostViewed($post_id) {
            return isset($_SESSION['post_views'][$post_id]);
        }

        // Function to mark a post as viewed and update the database
        public function markPostAsViewed($post_id) {

            if(isset($_SESSION['post_views'][$post_id])) {
                return;
            } else {
                $_SESSION['post_views'][$post_id] = 1;
                // Check if a row for this post exists in the 'postviews' table
                $sql = "SELECT * FROM postviews WHERE views_post_id = ? LIMIT 1";
                $stmt = $this->con->prepare($sql);
                $stmt->bind_param('i', $post_id);
                $stmt->execute();
                $result = $stmt->get_result();
    
                if($result->num_rows > 0) {
                    $data = $result->fetch_all(MYSQLI_ASSOC);
                    $row = $data[0];
                    if ($row) {
                        // Update the existing row
                        $views_count = $row['views_count'] + 1;
                        $sql = "UPDATE postviews SET views_count = ? WHERE views_post_id = ?";
                        $stmt = $this->con->prepare($sql); 
                        $stmt->bind_param('ii', $views_count, $post_id);
                        $stmt->execute();
                    } else {
                        // Insert a new row
                        $sql = "INSERT INTO postviews (views_post_id, views_count) VALUES (?, 1)";
                        $stmt = $this->con->prepare($sql);
                        $stmt->bind_param('i', $post_id);
                        $stmt->execute();
                    }
                } else {
                    // Insert a new row
                    $sql = "INSERT INTO postviews (views_post_id, views_count) VALUES (?, 1)";
                    $stmt = $this->con->prepare($sql);
                    $stmt->bind_param('i', $post_id);
                    $stmt->execute();
                }
            }


        }

        // Display a blog post
        // public function displayBlogPost($post_id) {
        //     // Fetch the blog post content from your database
        //     // You can join the 'blog_posts' table with 'postviews' to get the view count
        //     $sql = "SELECT blog_posts.*, postviews.views_count 
        //             FROM blog_posts 
        //             LEFT JOIN postviews ON blog.id = postviews.post_id
        //             WHERE blog.id = ?";
        //     $stmt = $pdo->prepare($sql);
        //     $stmt->execute([$post_id]);
        //     $post = $stmt->fetch(PDO::FETCH_ASSOC);

        //     // Display the blog post content and view count
        //     echo "<h1>{$post['title']}</h1>";
        //     echo "<p>{$post['content']}</p>";
        //     echo "<p>Views: {$post['views_count']}</p>";
        // }

        public function create() {  
            // echo 'create';
            $title = $_POST['title'];
            $description = $_POST['description'];
            $tags = $_POST['tags'];
            $slug = generateSlug($title);
            $content = $_POST['content'];

            if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
                // Handle the uploaded image
                $tempFilePath = $_FILES['photo']['tmp_name'];
            
                // Define the directory where you want to save the image
                $imageDirectory = '../../img/blog/'; // Update this path to your desired directory
            
                // Generate a unique filename for the image (you can use a UUID, timestamp, etc.)
                $thumbnail = time() . uniqid(rand(10, 20)) . '.webp'; // Use WebP format
            
                // Construct the full path to save the image
                $imagePath = $imageDirectory . $thumbnail;
            
                // Move the temporary uploaded file to the desired location
                if (move_uploaded_file($tempFilePath, $imagePath)) {
                    // Image uploaded successfully
                } else {
                    // Handle the case where the image could not be moved
                    $thumbnail = '';
                }
            } else {
                // Handle the case where no image was provided
                $thumbnail = '';
            }
            $created_at = datetime_now();
            
            $stmt = $this->con->prepare("INSERT INTO blog(title, post_description, content, tags, slug, thumbnail, created_at) VALUES (?, ?, ?, ?, ?, ?, ?)");
            if (!$stmt) {
                die("Prepare failed: " . $this->con->error);
            }  
            $stmt->bind_param("sssssss", $title, $description, $content, $tags, $slug, $thumbnail, $created_at);
            if($stmt->execute()) {   
                $status = '1';
            } else {
                $status = '0';
                die('prepare() failed: ' . htmlspecialchars($this->con->error));
                die('bind_param() failed: ' . htmlspecialchars($stmt->error));
                die('execute() failed: ' . htmlspecialchars($stmt->error));
            }
            $stmt->close();
            echo $status;
        }
        public function update($id) {  
            $single_post = $this->get_single_post_by_id($id);

            $title = $_POST['title'];
            $description = $_POST['description'];
            $tags = $_POST['tags'];
            $slug = generateSlug($title);
            $content = $_POST['content'];
            $updated_at = datetime_now();

            if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
                // Handle the uploaded image
                $tempFilePath = $_FILES['photo']['tmp_name'];
            
                // Define the directory where you want to save the image
                $imageDirectory = '../../img/blog/'; // Update this path to your desired directory
            
                // Generate a unique filename for the image (you can use a UUID, timestamp, etc.)
                $thumbnail = time() . uniqid(rand(10, 20)) . '.webp'; // Use WebP format
            
                // Construct the full path to save the image
                $imagePath = $imageDirectory . $thumbnail;
            
                // Move the temporary uploaded file to the desired location
                if (move_uploaded_file($tempFilePath, $imagePath)) {
                    // Image uploaded successfully
                } else {
                    // Handle the case where the image could not be moved
                    $thumbnail = '';
                }
            } else {
                // Handle the case where no image was provided
                $thumbnail = $single_post['thumbnail'];
            }

            $stmt = $this->con->prepare("UPDATE blog SET title=?, post_description=?, content=?, tags=?, slug=?, thumbnail=?, updated_at=? WHERE id=?");
            $stmt->bind_param("sssssssi", $title, $description, $content, $tags, $slug, $thumbnail, $updated_at, $id);
            if($stmt->execute()) {
                $status = '1';
            } else {
                $status = '0';
                die('prepare() failed: ' . htmlspecialchars($this->con->error));
                die('bind_param() failed: ' . htmlspecialchars($stmt->error));
                die('execute() failed: ' . htmlspecialchars($stmt->error));
            }
            $stmt->close();
            echo $status;
        }
        public function delete($id) {
            $stmt = $this->con->prepare("DELETE FROM blog WHERE id=?");
            $stmt->bind_param('i', $id);
            if($stmt->execute()) {
                $status = '1';
            } else {
                $status = '0';
            }
            $stmt->close();
            echo $status;
        }
        public function del_thumbnail($thumbnail, $id) {
            unlink("../../img/blog/$thumbnail");
            $stmt = $this->con->prepare("UPDATE blog SET thumbnail=NULL WHERE id=?");
            $stmt->bind_param('i', $id);
            if($stmt->execute()) {
                $status = '1';
            } else {
                $status = '0';
            }
            $stmt->close();
            echo $status;
        }
        public function segment($content, $len) {
            $length = strlen($content);
            $content = strip_tags($content);
            if($length > $len) {
                $content = substr($content, 0, $len).'...'; 
            }  
            return $content;
        }
        public function get_single_post($slug) {
            $stmt = $this->con->prepare("SELECT * FROM blog WHERE slug=? LIMIT 1");
            $stmt->bind_param('s', $slug);
            $stmt->execute();
            $result = $stmt->get_result();
            $data = $result->fetch_all(MYSQLI_ASSOC);
            $post_id = $data[0]['id'];

            $stmt2 = $this->con->prepare("SELECT * FROM postviews WHERE views_post_id=? LIMIT 1");
            $stmt2->bind_param('i', $post_id);
            $stmt2->execute();
            $result2 = $stmt2->get_result();
            $data2 = $result2->fetch_all(MYSQLI_ASSOC);
            if($result2->num_rows > 0) {
                $data[0]['postviews'] = $data2[0];
            }
                
            return $data[0];
        }
        public function get_single_post_by_id($id) {
            $stmt = $this->con->prepare("SELECT * FROM blog WHERE id=? LIMIT 1");
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $data = $result->fetch_all(MYSQLI_ASSOC);
            $post_id = $data[0]['id'];

            $stmt2 = $this->con->prepare("SELECT * FROM postviews WHERE views_post_id=? LIMIT 1");
            $stmt2->bind_param('i', $post_id);
            $stmt2->execute();
            $result2 = $stmt2->get_result();
            $data2 = $result2->fetch_all(MYSQLI_ASSOC);
            if($result2->num_rows > 0) {
                $data[0]['postviews'] = $data2[0];
            }
                
            return $data[0];
        }
        public function get_blog_posts() {
            $stmt = $this->con->prepare("SELECT * FROM blog ORDER BY id DESC");
            $stmt->execute();
            $result = $stmt->get_result();
            $data = $result->fetch_all(MYSQLI_ASSOC);
            return $data;
        }
        public function get_related_posts($tag, $slug) {
            $post = $this->get_single_post($slug);
            $id = $post['id'];
            $stmt = $this->con->prepare("SELECT * FROM blog WHERE tags LIKE CONCAT('%', ?, '%') AND id <> ? ORDER BY id DESC LIMIT 2");
            $stmt->bind_param("si", $tag, $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $data = $result->fetch_all(MYSQLI_ASSOC);
            return $data;
        }
        public function blog_admin() {
            $scriptname = $_SERVER["SCRIPT_FILENAME"];
            $pagename = basename($_SERVER["SCRIPT_FILENAME"], '.php');

            $blog_posts = $this->get_blog_posts();
            // var_dump($blog_posts);

            $num_of_rows = count($blog_posts);
            $results_per_page = 10;
            // Number of total pages available
            $num_of_pages = ceil($num_of_rows/$results_per_page);
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


            $blogStr = "<div class='profiles-wrapper'>
            <input type='hidden' id='user_count' value='$num_of_rows'>
            <div class='profiles-body'>";

            foreach($blog_posts as $blog_post) {
                $actionsStr = "<div class='actions'>
                    <div onclick='delete_post({$blog_post['id']});' class='delete'>
                        <img src='../assets/svg/delete.svg' alt='delete' />
                        <span>Delete</span>
                    </div>
                    <div class='edit' onclick='edit_post_form(event, \"{$blog_post['id']}\")'>
                        <img src='../assets/svg/edit.svg' alt='edit' />
                        <span>Edit</span>
                    </div>
                </div>";

                $blogStr .= "<div class='profile'>
                    <div class='profile-head'>
                        <div class='profile-arrow'>
                            <i class='fas fa-angle-down'></i>                             
                        </div>
                        <div>
                            <span>{$blog_post['title']}</span>
                        </div>
                        $actionsStr
                    </div>
                </div>";
            }
            $blogStr .= "</div>";

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


            $blogFooter = "
            <div class='profiles-footer' style='margin-left: auto; color:rgb(94,92,91); font-size: 16px;'>
                <div>
                    Showing $page of $num_of_pages
                </div>
            </div>
            ";
            $blogFooter .= "
            <style>
                .pagination div:nth-child(1) a {
                    color: rgb(138,138,138);
                    background-color: #FFB600;
                    border: 1px solid rgb(138,138,138);
                }
                .pagination div:nth-child(2) a {
                    color: rgb(255,255,255);
                    background-color: rgb(255,158,65);
                    border: none;
                }
            </style>
            <div class='pagination'>
                <div>
                    <a class='page-num arrow' href='./blog?tab=blog&page=".$prev."'>
                        <i class='fas fa-angle-left'></i>
                    </a>
                </div>
                <div>
                    <a class='page-num arrow' href='./blog?tab=blog&page=".$next."'>
                        <i class='fas fa-angle-right'></i>
                    </a>
                </div>
            </div>";
            $blogStr .= $blogFooter;
            $blogStr .= "</div>";

            echo $blogStr;
        }
        public function fetchSlugFromDatabase($id) {
            $single_post = $this->get_single_post($id);
            return $single_post['slug'];
        }
        public function single_post($slug) {
            $single_post = $this->get_single_post($slug);

            $this->markPostAsViewed($single_post['id']);

            // Tags
            $tags = "";
            $tags_str = $single_post['tags'];
            $tags_array = explode(", ", $tags_str);
            foreach ($tags_array as $t) {
                $tags .= "<li>$t</li>";
            }
            $content = nl2br($single_post['content']);

            if(isset($single_post['postviews'])) {
                $views = $single_post['postviews']['views_count'];
            } else {
                $views = 1;
            }
            
            echo "<div class='single-post'>
                <div class='thumbnail'>
                    <img src='./img/blog/{$single_post['thumbnail']}' alt='Blog thumbnail'>
                </div>
                <div class='title'>
                    <h3>
                        {$single_post['title']}
                    </h3>
                </div>
                <div class='content'>
                    <p>
                        {$content}
                    </p>
                </div>
                <div class='post-footer'>
                    <ul class='tags'>
                        $tags
                    </ul>
            
                    <div class='views'>
                        <i class='ion-ios-eye-outline'></i>
                        <span id=''>$views<span>
                    </div>
                
                </div>
            </div>";

            echo "
            
                <div class='share-links'>
                    <h2>Share this post:</h2>
                    <div class='share-buttons'>
                        <button id='whatsappBtn'>
                            <img src='./assets/svg/whatsapp-share.svg' alt='Whatsapp Share' />
                            <span>WhatsApp</span>
                        </button>
                        <button id='facebookBtn'>
                            <img src='./assets/svg/facebook-share.svg' alt='Facebook Share' />
                            <span>Facebook</span>
                        </button>
                        <button id='twitterBtn'>
                            <img src='./assets/svg/twitter-share.svg' alt='Twitter Share' />
                            <span>Twitter</span>
                        </button>
                        <button id='copyLinkBtn'>
                            <img src='./assets/svg/link-share.svg' alt='Link Share' />
                            <span>Link</span>
                        </button>
                    </div>
                </div>";

            $related_posts = $this->related_posts($tags_str, $slug);
            echo $related_posts;
        }
        public function blog() {
            $blog_posts = $this->get_blog_posts();

            $num_of_rows = count($blog_posts);
            $results_per_page = 10;
            // Number of total pages available
            $num_of_pages = ceil($num_of_rows/$results_per_page);
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

            $blog = "<div class='blog'>";
            foreach($blog_posts as $blog_post) {
                $summary = $this->segment($blog_post['content'], 220);
                $blog .= "<div class='post'>
                    <div class='thumbnail'>
                        <img src='./img/blog/{$blog_post['thumbnail']}' alt='Blog thumbnail'>
                    </div>
                    <div class='title'>
                        <h3>
                            {$blog_post['title']}
                        </h3>
                    </div>
                    <div class='summary'>
                        <p>
                            $summary
                        </p>
                    </div>
                    <a class='read-more' href='./{$blog_post['slug']}'>Continue Reading</a>
                </div>";
            }
            $blog .= "</div>";

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

            $blogFooter = "";
            $blogFooter .= "
            <style>
                .pagination {
                    margin: 0px auto 50px auto;
                }
                .pagination > div {
                    display: flex;
                    flex-flow: row nowrap;
                    align-items: center;
                    column-gap: 10px;
                }
            </style>
            <div class='pagination'>
                <div>
                    <span>Previous</span>
                    <a class='page-num arrow' onclick='blogpage(event, $prev)'>
                        <img src='./assets/svg/arrow-left.svg' alt='Arrow' />
                    </a>
                </div>
                <div>
                    <a class='page-num arrow' onclick='blogpage(event, $next)'>
                        <img src='./assets/svg/arrow-right.svg' alt='Arrow' />
                    </a>
                    <span>Next</sapn>
                </div>
            </div>";
            $blog .= $blogFooter;
            $blog .= "</div>";
            return $blog;
        }
        public function related_posts($tags, $slug) {
            $blog_posts = $this->get_related_posts($tags, $slug);
            $blog = "<div class='blog'>";
            foreach($blog_posts as $blog_post) {
                $summary = $this->segment($blog_post['content'], 220);
                $blog .= "<div class='post'>
                    <div class='thumbnail'>
                        <img src='./img/blog/{$blog_post['thumbnail']}' alt='Blog thumbnail'>
                    </div>
                    <div class='title'>
                        <h3>
                            {$blog_post['title']}
                        </h3>
                    </div>
                    <div class='summary'>
                        <p>
                            $summary
                        </p>
                    </div>
                    <a class='read-more' href='./single-post?id={$blog_post['id']}'>Continue Reading</a>
                </div>";
            }
            $blog .= "</div>";
            echo $blog;
        }
        // Forms
        public function create_form() {
            echo "<form class='blog-form'>
                <div class='input-group'>
                    <label for='title'>Title of the Blog</label>
                    <input type='text' class='title' name='title' id='title' placeholder='Top 5 decoration tips for preparing your mehndi stage' value=''>
                    <div class='error' id='titleError'></div>
                </div>
                <div class='input-group'>
                    <label for='description'>Description</label>
                    <textarea name='description' id='description' class='description' rows='4' placeholder='Description for this blog'></textarea>
                    <div class='error' id='descriptionError'></div>
                </div>
                <div class='input-group'>
                    <label for='tags'>Tags</label>
                    <input type='text' class='tags' name='tags' id='tags' placeholder='tag1, tag2, tag3, tag4, tag5' value=''>
                    <div class='error' id='tagsError'></div>
                </div>
                <div class='input-group'>
                    <label for='content'>Actual Blog Article</label>
                    <textarea name='content' id='content' class='content' rows='20' placeholder='Start your blog here'></textarea>
                    <div class='error' id='contentError'></div>
                </div>
                <div class='img-preview-wrapper'>
                    <div class='choose-photo' style='margin-bottom: 10px;'>
                        <div class='profile-placeholder' id='profile-placeholder'>
                            <div class='err' id='err-1'>Error</div>
                            <img src='../assets/img/thumbnail-lg.jpg' alt=''>
                        </div>   
                        <div class='selected-img' id='selected-img'>
                            <img class='img-preview' id='img-preview' src='' alt='' />     
                        </div>  
                    </div>
                    <div class='img-error' id='img-error-1'></div>
                    <span style='cursor:pointer;' onclick='return fireButton(event);'>
                        <i class='fas fa-paperclip'></i>
                        <span>Thumbnail</span>
                    </span> 
                    <input class='input image-input' id='image' type='file' name='image' value='' style='display: none;'>
                </div>
                
                <div class='submit-wrapper'>
                    <div class='apply-btn' onclick='create_post(event)'>
                        Post Now!
                    </div>
                </div>
                <div style='margin-top: 10px;' id='message-response-1' class='message-response'></div>
            </form>";
        }
        public function get_edit_post_form($id) {
            $single_post = $this->get_single_post_by_id($id);

            // Description
            $description = '';
            if($single_post['post_description'] != NULL) {
                $description = $single_post['post_description'];
            }

            // Image
            if(!empty($single_post['thumbnail'])) {
                
                $style1 = " style='display: none;'";
                $style2 = " style='display: block;'";
                // $img_str = "<div id='update-img-div' style='width:200px;height:auto;'>
                //     <img style='width:100%;height:100%;' src='../img/blog/{$single_post['thumbnail']}?v=$v' alt=''>
                // </div>
                // <div>
                //     <a onclick='delete_post_img(event, \"{$single_post['thumbnail']}\", $id)' title='delete' class='del-link' href=''>Delete</a>
                // </div>";
            } else {
                // $img_str = "";
                $style1 = " style='display: block;'";
                $style2 = " style='display: none;'";
            }
            
            echo "<form id='edit-blog-popup' class='popup hide_popup edit-blog-popup blog-form' method='post' enctype='multipart-formdata'>
                <div class='form-title'>
                    <h3>Editing Blog Post</h3>
                </div>
                <input type='hidden' name='update_post' id='update_post' value='true'>
                <input type='hidden' name='post_id' id='post_id2' value='{$id}'>
                <div class='input-group'>
                    <label for='title'>Title of the Blog</label>
                    <input type='text' class='title' name='title' id='title2' placeholder='Top 5 decoration tips for preparing your mehndi stage' value='{$single_post['title']}'>
                    <div class='error' id='titleError'></div>
                </div>
                <div class='input-group'>
                    <label for='description'>Description</label>
                    <textarea name='description' id='description2' class='description' rows='4' placeholder='Description for this blog'>$description</textarea>
                    <div class='error' id='descriptionError'></div>
                </div>
                <div class='input-group'>
                    <label for='tags'>Tags</label>
                    <input type='text' class='tags' name='tags' id='tags2' placeholder='tag1, tag2, tag3, tag4, tag5' value='{$single_post['tags']}'>
                    <div class='error' id='tagsError'></div>
                </div>
                <div class='input-group'>
                    <label for='content'>Actual Blog Article</label>
                    <textarea name='content' id='content2' class='content' rows='20' placeholder='Start your blog here'>{$single_post['content']}</textarea>
                    <div class='error' id='contentError'></div>
                </div>
                <div class='img-preview-wrapper'>
                    <div class='choose-photo' style='margin-bottom: 10px;'>
                        <div class='profile-placeholder' id='profile-placeholder-2' $style1>
                            <div class='err' id='err-2'>Error</div>
                            <img src='../assets/img/thumbnail-lg.jpg' alt=''>
                        </div>   
                        <div class='selected-img' id='selected-img-2' $style2>
                            <img id='img-preview-2' src='../img/blog/{$single_post['thumbnail']}?v=$v' class='img-preview' alt='' />     
                        </div>  
                    </div>
                    <div>
                        <a onclick='delete_post_img(event, \"{$single_post['thumbnail']}\", $id)' title='delete' class='del-link' href=''>Delete</a>
                    </div>
                    <div class='img-error' id='img-error-2'></div>
                    <span style='cursor:pointer;' onclick='return fireButton2(event);'>
                        <i class='fas fa-paperclip'></i>
                        <span>Change Thumbnail</span>
                    </span> 
                    <input class='input image-input-2' id='image2' type='file' name='image' value='' style='display: none;'>
                </div>
                <div class='submit-wrapper'>
                    <div class='apply-btn' onclick='update_post(event)'>
                        Update Now
                    </div>
                </div>
                <div style='margin-top: 10px;' id='message-response-2' class='message-response'></div>
            </form>";
        }
    }
?>