<?php include './partials/header.php'; ?>
<?php include './partials/navigation.php'; ?>

<link rel="stylesheet" href="css/reset.css?v=2">

<div id='login-error'>
    <div id='msg-response'>
        <?php
            
            if(isset($_GET['status'])) {
                if($_GET['status'] == 'error') {
                    echo "<div>Email not registered in our system</div>";
                }
            }

        ?>
    </div>
</div>

<?php
    $selector = $_GET['selector'];
    $validator = $_GET['validator'];

    // if(empty($selector) || empty($validator)) {
    //     echo 'Could not validate your request';
    // } else {
    //     if(ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false) {      
?> 

    <div id='reset'>
        <div class='form-header'>
            <div class='form-heading'>
                <h3>Password Rest</h3>
            </div>
            <div class='form-subheading'>
                <p>Set your new password</p>
            </div>
        </div>
        <form autocomplete='off' action='' id='signUpForm' class='sign_up' method='POST'>
            <input type="hidden" name="selector" id="selector" value="<?php echo $selector; ?>">
            <input type="hidden" name="validator" id="validator" value="<?php echo $validator; ?>">
            <div class='input-group'>
                <label for="password">New Password</label>
                <input type='password' class='password' name='password' id='password' placeholder=''>
                <div class='error' id='pwdError'></div>
            </div>
            <div class='input-group'>
                <label for="repeat_password">Confirm New Password</label>
                <input type='password' class='repeat_password' name='repeat_password' id='repeat_password' placeholder=''>
                <div class='error' id='repeatPwdError'></div>
            </div>
            <div class='input-group'>
                <span onclick='update_password(event)' class='send'>Submit</span>
            </div>
            <div id='not-a-member'>
                <p style='margin-bottom:0;'>
                    Go back to
                    <a class='not-member-register' href='./login'>
                        Login
                    </a>
                </p>
            </div>

        </form>
    </div>
    
<?php
    //     }
    // }
?>

<script>
    var err = '<?php echo $_GET['error'] ?>';
    if(err == 'wrongpassword') {
        var em = document.getElementById('email');
        var pass = document.getElementById('password');
        em.classList.add('login-error');
        pass.classList.add('login-error');
    }
</script>



<?php include './partials/footer.php'; ?>