<?php include './partials/header.php'; ?>
<?php include './partials/navigation.php'; ?>

<style>
    #login-error {
        width: 300px;
        margin: 100px auto 30px auto;
    }
    #login input.email.login-error[type=text],
    #login input.password.login-error[type=password] {
        background-color: var(--error-bg);
        color: var(--error-color);
        border: 1px solid var(--error-color);
    }
    #login {
        width: 410px;
        display: flex;
        flex-flow: column nowrap;
        row-gap: 40px;
        margin: 0px auto 100px auto;
        padding: 50px;
        background-color: #fff;
        box-shadow: 0px 2px 10px 0px #00000026;
        border-radius: 12px;
    }
    #login .form-heading h3 {
        font-size: 35px;
    }
    #login form {
        width: 100%;
        margin: 0 auto;
        display: flex;
        flex-flow: column nowrap;
        row-gap: 15px;
    }
    #login form .input-group:nth-child(1)  {
        margin-bottom: 5px;
    }
    #login form .input-group:nth-child(2) {
        margin-bottom: 0;
    }
    #login input[type="text"],
    #login input[type="number"],
    #login input[type="date"],
    #login input[type="password"] {
        background-color: #fff;
        border: 2px solid rgb(191,191,191);
    }
    #login input[type="submit"] {
        font-size: 16px;
        height: 45px;
        border-radius: 4px;
        text-transform: capitalize;
        background: #FFB600;
        color: #0E0E0E;
        box-shadow: 0px 4px 4px 0px #00000040;
        font-weight: 600;
    }
    .input-label-row {
        display: flex;
        flex-flow: row nowrap;
        justify-content: space-between;
    }
    .input-label-row div:nth-child(1) {
        margin-bottom: 5px;
        font-size: 17px;
        color: #000;
    }
    .input-label-row div:nth-child(2) a {
        font-size: 15px;
        color: #000;
        text-decoration: underline;
    }
    #remember-login p {
        font-size: 16px;
        display: flex;
        align-items: center;
        column-gap: 10px;
    }
    #remember {
        border: var(--checkbox-bg-1);
        width: 18px;
        height: 18px;
        border-radius: 8px;
    }
    #not-a-member p {
        font-size: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        column-gap: 10px;
    }
    a.not-member-register {
        color: #000;
        text-decoration: underline;
    }
    @media screen and (max-width: 1560px) {
        #login-error {
            width: 300px;
            font-size: 14px;
            margin: 50px auto 30px auto;
        }
        #login {
            width: 350px;
            row-gap: 30px;
            margin: 0px auto 100px auto;
            padding: 40px;
            background-color: #fff;
            box-shadow: var(--box-shadow-1);
            border-radius: 12px;
        }
        #login .form-heading h3 {
            font-size: 30px;
        }
        #login form {
            width: 100%;
            row-gap: 12px;
        }
        #login form .input-group:nth-child(1)  {
            margin-bottom: 5px;
        }
        #login form .input-group:nth-child(2) {
            margin-bottom: 0;
        }
        #login input[type="submit"] {
            font-size: 15px;
            height: 40px;
            border-radius: 4px;
        }
        .input-label-row {
            display: flex;
            flex-flow: row nowrap;
            justify-content: space-between;
        }
        .input-label-row div {
            font-size: 17px;
            color: #000000;
        }
        .input-label-row div:nth-child(1) {
            margin-bottom: 10px;
        }
        .input-label-row div:nth-child(2) a {
            font-size: 15px;
            text-decoration: underline;
        }
        #remember-login p {
            font-size: 16px;
            display: flex;
            align-items: center;
            column-gap: 10px;
        }
        #remember {
            border: var(--checkbox-bg-1);
            width: 18px;
            height: 18px;
            border-radius: 8px;
        }
    }
    @media screen and (max-width: 800px) {
        #login {     
            margin: 50px auto;
        }
    }
    @media screen and (max-width: 414px) {
        #login {
            width: 95%;
            padding: 30px;
        }
    }
</style>

<div id="loader"></div>

<div id='login-error'>
    <div id='msg-response'>
        <?php
            
            if(isset($_GET['error'])) {
                if($_GET['error'] == 'wrongpassword') {
                    echo "<div>Incorrect email or password</div>";
                }
            }

        ?>
    </div>
</div>

<div id='login'>
    <div class='form-header'>
        <div class='form-heading'>
            <h3>Login</h3>
        </div>
    </div>
    <form onsubmit='return validateSignIn(event)' autocomplete='off' action='./controllers/login-handler' id='signUpForm' class='sign_up' method='POST'>                        
        <div class='input-group'>
            <div class='input-label-row'>
                <div>Email</div>
            </div>
            <input type='text' class='email' name='email' id='email' placeholder='umar123@gmail.com' value=''>
            <div class='error' id='emailError'></div>
        </div>
        <div class='input-group'>
            <div class='input-label-row'>
                <div>Password</div>
                <div><a href="reset">Password Reset</a></div>
            </div>
            <input type='password' class='password' name='password' id='password' placeholder='' value=''>
            <div class='error' id='pwdError'></div>
        </div>
        <div id='remember-login'>
            <p style='margin-bottom:0;'>
                <input class='input' id='remember' type='checkbox' name='remember'>
                Keep me logged in
            </p>
        </div>
        <div class='input-group'>
            <input type='submit' class='send' name='send' value='Login'>
        </div>
        <div id='not-a-member'>
            <p style='margin-bottom:0;'>
                Not a Member? 
                <a class='not-member-register' href='./registration'>
                    Register
                </a>
            </p>
        </div>

    </form>
</div>

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