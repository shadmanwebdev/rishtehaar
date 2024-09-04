<?php
    class Payment extends Db {
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
        public function update_bank() {
            // var_dump($_POST);
            $bank_array = array(
                'bank_name' => $_POST['bank_name'],
                'branch_code' => $_POST['branch_code'],
                'account_no' => $_POST['account_no'],
                'iban' => $_POST['iban'],
                'account_title' => $_POST['account_title']
            );
            $details = json_encode($bank_array, true);

            var_dump($details);

            $id = 1;
            $stmt = $this->con->prepare("UPDATE payment_methods SET details=? WHERE id=?");
            $stmt->bind_param("si", $details, $id);
            $stmt->execute();
            $stmt->close();
        }
        public function update_jazzcash() {
            $jazzcash_array = array(
                'bank_name' => $_POST['bank_name'],
                'account_no' => $_POST['account_no'],
                'account_title' => $_POST['account_title']
            );
            $details = json_encode($jazzcash_array, true);

            $id = 2;
            $stmt = $this->con->prepare("UPDATE payment_methods SET details=? WHERE id=?");
            $stmt->bind_param("si", $details, $id);
            $stmt->execute();
            $stmt->close();
        }
        public function update_easypaisa() {
            $easypaisa_array = array(
                'bank_name' => $_POST['bank_name'],
                'til_id' => $_POST['til_id'],
                'account_title' => $_POST['account_title']
            );
            $details = json_encode($easypaisa_array, true);

            $id = 3;
            $stmt = $this->con->prepare("UPDATE payment_methods SET details=? WHERE id=?");
            $stmt->bind_param("si", $details, $id);
            $stmt->execute();
            $stmt->close();
        }
        private function get_payment_methods() {
            $payment_methods = array();
            $stmt = $this->con->prepare("SELECT * FROM payment_methods");
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
                    $payment_method = array(
                        'id' => $row['id'],
                        'method_name' => $row['method_name'],
                        'details' => $row['details']
                    );
                    array_push($payment_methods, $payment_method);
                endforeach;
            }
            $stmt->close();
            return $payment_methods;
        }
        public function show_details_form() {
            $payment_methods = $this->get_payment_methods();
            $bank_array = $payment_methods[0];
            $jazzcash_array = $payment_methods[1];
            $easypaisa_array = $payment_methods[2];


            $bank_details = json_decode($bank_array['details'], true);
            $jazzcash_details = json_decode($jazzcash_array['details'], true);
            $easypaisa_details = json_decode($easypaisa_array['details'], true);

            // {$bank_details['bank_name']}
            // {$bank_details['branch_code']}
            // {$bank_details['account_no']}
            // {$bank_details['iban']}
            // {$bank_details['account_title']}
            $bank = "<div class='payment-method'>
                <div class='payment-head'>
                    <div class='method-title'>
                        Bank Transfer
                    </div>
                    <div class='method-icons'>
                        <div class='method-img bank-img'>
                            <img src='../assets/img/bank.png' alt=''>                            
                        </div>
                        <div class='profile-arrow'>
                            <i class='fas ion-chevron-down' aria-hidden='true'></i>                             
                        </div>
                    </div>
                </div>
                <div class='payment-body'>
                    <div class='payment-body-inner'>
                        <div class='payment-body-title'>
                            List of Banks
                        </div>
                        <form class='method-form' id='bank-form' action=''>
                            <div class='method-form-inner'>
                                <input type='hidden' name='update_bank' value='true'>
                                <div class='method-form-column'>
                                    <div class='method-form-row'>
                                        <label for='bank_name'>Bank Name</label>
                                        <input type='text' name='bank_name' id='bank_name' value='{$bank_details['bank_name']}'>
                                    </div>
                                    <div class='method-form-row'>
                                        <label for='account_no'>Account No.</label>
                                        <input type='text' name='account_no' id='account_no' value='{$bank_details['account_no']}'>
                                    </div>
                                    <div class='method-form-row'>
                                        <label for='account_title'>Account Title</label>
                                        <input type='text' name='account_title' id='account_title' value='{$bank_details['account_title']}'>
                                    </div>
                                </div>
                                <div class='method-form-column'>
                                    <div class='method-form-row'>
                                        <label for='branch_code'>Branch Code</label>
                                        <input type='text' name='branch_code' id='branch_code' value='{$bank_details['branch_code']}'>
                                    </div>
                                    <div class='method-form-row'>
                                        <label for='iban'>IBAN</label>
                                        <input type='text' name='iban' id='iban' value='{$bank_details['iban']}'>
                                    </div>
                                </div>
                            </div>
                            <div class='method-form-row'>
                                <div class='adminFormBtn' onclick='update_payment_details(1);'>Update</div>
                            </div>
                        </form>
                    </div>
                </div>              
            </div>";
            // JazzCash
            $jazzcash = "<div class='payment-method'>
                <div class='payment-head'>
                    <div class='method-title'>
                        JazzCash
                    </div>
                    <div class='method-icons'>
                        <div class='method-img jazzcash-img'>
                            <img src='../assets/img/jazzcash.png' alt=''>                            
                        </div>
                        <div class='profile-arrow'>
                            <i class='fas ion-chevron-down' aria-hidden='true'></i>                             
                        </div>
                    </div>
                </div>
                <div class='payment-body'>
                    <div class='payment-body-inner'>
                        <form class='method-form' id='jazzcash-form' action=''>
                            <div class='method-form-inner'>
                                <input type='hidden' name='update_jazzcash' value='true'>
                                <div class='method-form-column'>
                                    <div class='method-form-row'>
                                        <label for='bank_name'>Bank Name</label>
                                        <input type='text' name='bank_name' id='bank_name' value='{$jazzcash_details['bank_name']}'>
                                    </div>
                                    <div class='method-form-row'>
                                        <label for='account_no'>Account No.</label>
                                        <input type='text' name='account_no' id='account_no' value='{$jazzcash_details['account_no']}'>
                                    </div>
                                    <div class='method-form-row'>
                                        <label for='account_title'>Account Title</label>
                                        <input type='text' name='account_title' id='account_title' value='{$jazzcash_details['account_title']}'>
                                    </div>
                                </div>
                            </div>
                            <div class='method-form-row'>
                                <div class='adminFormBtn' onclick='update_payment_details(2);'>Update</div>
                            </div>
                        </form>
                    </div>
                </div>              
            </div>";
            // EasyPaisa
            $easypaisa = "<div class='payment-method'>
                <div class='payment-head'>
                    <div class='method-title'>
                        EasyPaisa
                    </div>
                    <div class='method-icons'>
                        <div class='method-img easypaisa-img'>
                            <img src='../assets/img/easypaisa.png' alt=''>                            
                        </div>
                        <div class='profile-arrow'>
                            <i class='fas ion-chevron-down' aria-hidden='true'></i>                             
                        </div>
                    </div>
                </div>
                <div class='payment-body'>
                    <div class='payment-body-inner'>
                        <form class='method-form' id='easypaisa-form' action=''>
                            <div class='method-form-inner'>
                                <input type='hidden' name='update_easypaisa' value='true'>
                                <div class='method-form-column'>
                                    <div class='method-form-row'>
                                        <label for='bank_name'>Bank Name</label>
                                        <input type='text' name='bank_name' id='bank_name' value='{$easypaisa_details['bank_name']}'>
                                    </div>
                                    <div class='method-form-row'>
                                        <label for='til_id'>TIL ID#</label>
                                        <input type='text' name='til_id' id='til_id' value='{$easypaisa_details['til_id']}'>
                                    </div>
                                    <div class='method-form-row'>
                                        <label for='account_title'>Account Title</label>
                                        <input type='text' name='account_title' id='account_title' value='{$easypaisa_details['account_title']}'>
                                    </div>
                                </div>
                            </div>
                            <div class='method-form-row'>
                                <div class='adminFormBtn' onclick='update_payment_details(3);'>Update</div>
                            </div>
                        </form>
                    </div>
                </div>              
            </div>";

            $payment_mthods_str = $bank.$jazzcash.$easypaisa;
            return $payment_mthods_str;
        }
        public function show_bank_info() {
            $payment_methods = $this->get_payment_methods();
            $bank_array = $payment_methods[0];

            $bank_details = json_decode($bank_array['details'], true);

            $bank_str = "<div class='pay-info-wrapper'>
                <div class='pay-info-row'>
                    <div class='input-col input-col-1'>
                        Bank Name
                    </div>
                    <div class='input-col input-col-2'>                            
                        {$bank_details['bank_name']}
                    </div>
                </div>           
                <div class='pay-info-row'>
                    <div class='input-col input-col-1'>
                        Account No.
                    </div>
                    <div class='input-col input-col-2'>                            
                        {$bank_details['account_no']}
                    </div>
                </div>           
                <div class='pay-info-row'>
                    <div class='input-col input-col-1'>
                        Account Title
                    </div>
                    <div class='input-col input-col-2'>                            
                        {$bank_details['account_title']}
                    </div>
                </div>           
                <div class='pay-info-row'>
                    <div class='input-col input-col-1'>
                        Branch Code
                    </div>
                    <div class='input-col input-col-2'>                            
                        {$bank_details['branch_code']}
                    </div>
                </div>           
                <div class='pay-info-row'>
                    <div class='input-col input-col-1'>
                        IBAN
                    </div>
                    <div class='input-col input-col-2'>                            
                        {$bank_details['iban']}
                    </div>
                </div>           
            </div>";

            return $bank_str;
        }
        public function show_jazzcash_info() {
            $payment_methods = $this->get_payment_methods();
            $jazzcash_array = $payment_methods[1];

            $jazzcash_details = json_decode($jazzcash_array['details'], true);

            $jazzcash_str = "<div class='pay-info-wrapper'>
                <div class='pay-info-row'>
                    <div class='input-col input-col-1'>
                        Bank Name
                    </div>
                    <div class='input-col input-col-2'>                            
                        {$jazzcash_details['bank_name']}
                    </div>
                </div>           
                <div class='pay-info-row'>
                    <div class='input-col input-col-1'>
                        Account No.
                    </div>
                    <div class='input-col input-col-2'>                            
                        {$jazzcash_details['account_no']}
                    </div>
                </div>           
                <div class='pay-info-row'>
                    <div class='input-col input-col-1'>
                        Account Title
                    </div>
                    <div class='input-col input-col-2'>                            
                        {$jazzcash_details['account_title']}
                    </div>
                </div>         
            </div>";

            return $jazzcash_str;
        }
        public function show_easypaisa_info() {
            $payment_methods = $this->get_payment_methods();
            $easypaisa_array = $payment_methods[2];

            $easypaisa_details = json_decode($easypaisa_array['details'], true);

            $easypaisa_str = "<div class='pay-info-wrapper'>
                <div class='pay-info-row'>
                    <div class='input-col input-col-1'>
                        Bank Name
                    </div>
                    <div class='input-col input-col-2'>                            
                        {$easypaisa_details['bank_name']}
                    </div>
                </div>           
                <div class='pay-info-row'>
                    <div class='input-col input-col-1'>
                        TIL ID#
                    </div>
                    <div class='input-col input-col-2'>                            
                        {$easypaisa_details['til_id']}
                    </div>
                </div>           
                <div class='pay-info-row'>
                    <div class='input-col input-col-1'>
                        Account Title
                    </div>
                    <div class='input-col input-col-2'>                            
                        {$easypaisa_details['account_title']}
                    </div>
                </div>         
            </div>";

            return $easypaisa_str;
        }
    }
?>