<?php
    /*
        get_banners
    */
    class Banner extends Db {
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
        
        public function get_banners() {
            $banner_array = array();
            $i = 1;
            $stmt = $this->con->prepare("SELECT * FROM banner WHERE id=?");
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
                    $banner_array = array(
                        '1' => $row['banner_1'],
                        '2' => $row['banner_2'],
                        '3' => $row['banner_3'],
                        '4' => $row['banner_4']
                    );
                endforeach;
            }
            $stmt->close();
            return $banner_array;
        }
        public function update_banners() {
            $banner_array = $this->get_banners();

            $banner_1 = $_FILES['image_1']['name'];
            $banner_2 = $_FILES['image_2']['name'];
            $banner_3 = $_FILES['image_3']['name'];
            $banner_4 = $_FILES['image_4']['name'];

            if(!empty($banner_1)) {
                $allowed = array('png', 'jpg', 'jpeg', 'webp', 'jfif');
                $ext = pathinfo($banner_1, PATHINFO_EXTENSION);
                // CHECK IF FILE TYPE IS ALLOWED
                if (!in_array($ext, $allowed)) {
                    echo 'upsupported-filetype';
                } else {
                    $imagePath = '../../img/';
                    $uniquesavename=time().uniqid(rand());
                    $destFile = $imagePath . $uniquesavename . '.'.$ext;
                    $tempname = $_FILES['image_1']['tmp_name'];
                    list($width, $height) = getimagesize( $tempname );
                    move_uploaded_file($tempname,  $destFile);
                    $filename_1 = $uniquesavename . '.'.$ext;

                    // Delete old image
                    $old_file_1 = $banner_array['1'];
                    unlink("../../img/$old_file_1");
                }
            } else {
                $filename_1 = $banner_array['1'];
            }
            if(!empty($banner_2)) {
                $allowed = array('png', 'jpg', 'jpeg', 'webp', 'jfif');
                $ext = pathinfo($banner_2, PATHINFO_EXTENSION);
                // CHECK IF FILE TYPE IS ALLOWED
                if (!in_array($ext, $allowed)) {
                    echo 'upsupported-filetype';
                } else {
                    $imagePath = '../../img/';
                    $uniquesavename=time().uniqid(rand());
                    $destFile = $imagePath . $uniquesavename . '.'.$ext;
                    $tempname = $_FILES['image_2']['tmp_name'];
                    list($width, $height) = getimagesize( $tempname );
                    move_uploaded_file($tempname,  $destFile);
                    $filename_2 = $uniquesavename . '.'.$ext;

                    // Delete old image
                    $old_file_2 = $banner_array['2'];
                    unlink("../../img/$old_file_2");
                }
            } else {
                $filename_2 = $banner_array['2'];
            }
            if(!empty($banner_3)) {
                $allowed = array('png', 'jpg', 'jpeg', 'webp', 'jfif');
                $ext = pathinfo($banner_3, PATHINFO_EXTENSION);
                // CHECK IF FILE TYPE IS ALLOWED
                if (!in_array($ext, $allowed)) {
                    echo 'upsupported-filetype';
                } else {
                    $imagePath = '../../img/';
                    $uniquesavename=time().uniqid(rand());
                    $destFile = $imagePath . $uniquesavename . '.'.$ext;
                    $tempname = $_FILES['image_3']['tmp_name'];
                    list($width, $height) = getimagesize( $tempname );
                    move_uploaded_file($tempname,  $destFile);
                    $filename_3 = $uniquesavename . '.'.$ext;

                    // Delete old image
                    $old_file_3 = $banner_array['3'];
                    unlink("../../img/$old_file_3");
                }
            } else {
                $filename_3 = $banner_array['3'];
            }
            if(!empty($banner_4)) {
                $allowed = array('png', 'jpg', 'jpeg', 'webp', 'jfif');
                $ext = pathinfo($banner_4, PATHINFO_EXTENSION);
                // CHECK IF FILE TYPE IS ALLOWED
                if (!in_array($ext, $allowed)) {
                    echo 'upsupported-filetype';
                } else {
                    $imagePath = '../../img/';
                    $uniquesavename=time().uniqid(rand());
                    $destFile = $imagePath . $uniquesavename . '.'.$ext;
                    $tempname = $_FILES['image_4']['tmp_name'];
                    list($width, $height) = getimagesize( $tempname );
                    move_uploaded_file($tempname,  $destFile);
                    $filename_4 = $uniquesavename . '.'.$ext;

                    // Delete old image
                    $old_file_4 = $banner_array['4'];
                    unlink("../../img/$old_file_4");
                }
            } else {
                $filename_4 = $banner_array['4'];
            }
            $id = 1;
            $stmt = $this->con->prepare("UPDATE banner SET banner_1=?, banner_2=?, banner_3=?, banner_4=? WHERE id=?");
            $stmt->bind_param('ssssi', $filename_1, $filename_2, $filename_3, $filename_4, $id);
            $stmt->execute();
            $stmt->close();
        }
    }
?>