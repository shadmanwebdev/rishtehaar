<?php
    class Pricing extends Db {
        public function __construct() {
            $this->con = $this->con();
        }
        public function update_price() {
            $id = 1;
            $price = $_POST['price'];
            $stmt = $this->con->prepare("UPDATE pricing SET price=? WHERE id=?");
            $stmt->bind_param('si', $price, $id);
            if($stmt->execute()) { 
                $status = '1';
            } else {
                $status = '0';
            }
            $stmt->close();
            echo $status;
        }
        public function get_price() {
            $id = 1;
            $stmt = $this->con->prepare("SELECT * FROM pricing WHERE id=? LIMIT 1");
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $data = $result->fetch_all(MYSQLI_ASSOC);
            return $data[0]['price'];
        }
    }
?>