<?php
    if(isset($_SESSION['user'])) {
        $userdata = json_decode($_SESSION['user'], true);
                
        $user = new User();
        echo $user->profile_section_2($userdata['uid']); 
    }
?>