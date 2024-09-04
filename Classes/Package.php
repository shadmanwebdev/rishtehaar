<?php
    /*
        get_packages_status
        update_package_1
        update_package_2
        update_packages_status
    */
    class Package extends Db {
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
        public function get_package_1() {
            $i = 1;
            $stmt = $this->con->prepare("SELECT * FROM package WHERE id=?");
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
                    $package1_array = array(
                        'id' => $row['id'],
                        'duration' => $row['duration'],
                        'price' => $row['price']
                    );
                endforeach;
            }
            $stmt->close();
            return $package1_array;
        }
        public function get_package_2() {
            $i = 2;
            $stmt = $this->con->prepare("SELECT * FROM package WHERE id=?");
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
                    $package2_array = array(
                        'id' => $row['id'],
                        'duration' => $row['duration'],
                        'price' => $row['price']
                    );
                endforeach;
            }
            $stmt->close();
            $this->con->close();
            return $package2_array;
        }
        public function update_package_1() {
            $duration = $_POST['duration_1'];
            $price = $_POST['price_1'];
            $id = 1;
            $stmt = $this->con->prepare("UPDATE package SET duration=?, price=? WHERE id=?");
            $stmt->bind_param('ssi', $duration, $price, $id);
            $stmt->execute();
            $stmt->close();
            $this->con->close();
        }
        public function update_package_2() {
            $duration = $_POST['duration_2'];
            $price = $_POST['price_2'];
            $id = 2;
            $stmt = $this->con->prepare("UPDATE package SET duration=?, price=? WHERE id=?");
            $stmt->bind_param('ssi', $duration, $price, $id);
            $stmt->execute();
            $stmt->close();
            $this->con->close();
        }
        public function update_packages_status() {
            $id = 1;
            $packages_status = $_POST['packages'];
            $stmt = $this->con->prepare("UPDATE packages_status SET package_status=? WHERE id=?");
            $stmt->bind_param('si', $packages_status, $id);
            $stmt->execute();
            $stmt->close();
            $this->con->close();
        }
    }
?>