<?php
    /*
        get_packages_status
        update_package_1
        update_package_2
        update_packages_status
    */
    class Settings extends Db {
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
        public function get_setting() {
            $i = 1;
            $stmt = $this->con->prepare("SELECT * FROM settings WHERE id=?");
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
                    $setting = $row['setting'];
                endforeach;
            }
            $stmt->close();
            return $setting;
        }
        public function update_settings() {
            $id = 1;
            $settings = $_POST['settings'];
            $stmt = $this->con->prepare("UPDATE settings SET setting=? WHERE id=?");
            $stmt->bind_param('si', $settings, $id);
            $stmt->execute();
            $stmt->close();
            echo '1';
        }
    }
?>