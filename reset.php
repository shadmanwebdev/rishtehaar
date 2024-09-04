<?php include './partials/header.php'; ?>
<?php include './partials/navigation.php'; ?>

<link rel="stylesheet" href="css/reset.css?v=3">


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

<div id='reset'>
    <div class='form-header'>
        <div class='form-heading'>
            <h3>Forgot Password</h3>
        </div>
        <div class='form-subheading'>
            <p>Enter email you used to register</p>
        </div>
    </div>
    <form autocomplete='off' action='' id='signUpForm' class='sign_up' method='POST'>                        
        <div class='input-group'>
            <div class='input-label-row'>
                <div>Email</div>
            </div>
            <input type='text' class='email' name='email' id='email' placeholder='umar123@gmail.com' value=''>
            <div class='error' id='emailError'></div>
        </div>
        <div class='input-group'>
            <span onclick='fgt_password(event);' class='send'>Submit</span>
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

<script>
    // echo $_GET['error']
    // var err = "";
    // if(err == 'wrongpassword') {
    //     var em = document.getElementById('email');
    //     var pass = document.getElementById('password');
    //     em.classList.add('login-error');
    //     pass.classList.add('login-error');
    // }

</script>


<?php include './partials/footer.php'; ?>