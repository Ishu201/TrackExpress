<?php
include('common.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up to TrackExpress</title>
    <link rel="icon" type="image/x-icon" href="<?php echo $web_assets_base_url; ?>images/logo.png">

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/style.css">
    <style>
        #success_msg {
            opacity: 1;
            transition: opacity 0.5s ease;
        }
    </style>
</head>

<body style="background-image:url(../login/images/background-img.jpg) ;">

    <div class="main" style="padding:60px;background-image:url(../login/images/background-img.jpg) ;">

        <!-- Sing in  Form -->
        <section class="sign-in">
            <div class="container">
                <div class="signin-content">
                    <div class="signin-image">
                        <center>
                            <?php if (isset($_SESSION['error'])) { ?>
                                <p style="background-color: #CB283A;color:white;padding:10px;"><?php echo $_SESSION['error']; ?></p>
                            <?php unset($_SESSION['error']);
                            } ?>

                            <?php //$_SESSION['success'] =  'Please Check Your Emails to Verify Your Account..!!'; 
                            ?>
                            <?php if (isset($_SESSION['success'])) { ?>
                                <p id="success_msg" style="background-color: #00b386;color:white;padding:10px;"><?php echo $_SESSION['success']; ?></p>
                            <?php unset($_SESSION['success']);
                            } ?>

                        </center>
                        <figure><img src="images/login.png" alt="sing up image"></figure>
                        <a href="register.php" class="signup-image-link">Create an account</a>
                    </div>

                    <div class="signin-form">
                        <h2 class="form-title">Log In</h2>
                        <form method="POST" action="../../controllers/User.php?status=login" class="register-form" id="login-form" onsubmit="return validateLogin()">
                            <?php if (isset($_GET['id'])) {
                                $mail = base64_decode($_REQUEST['id']);
                                $stat = 'readonly';
                            } else {
                                $mail = '';
                                $stat = '';
                            }
                            ?>
                            <div class="form-group">
                                <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" required  name="username"  <?php echo $stat ?> value="<?php echo $mail ?>" id="username" placeholder="Username" />
                                <span class="error" id="usernameError"></span><!-- Error message for username -->
                            <input type="hidden" id="chklog" name="chklog" value="<?php 
                            if (isset($_GET['id'])) {
                                echo 'yes';
                            }else{
                                echo 'no';
                            }
                            ?>">
                            </div>
                            <?php if (isset($_GET['id'])) {
                                $msg = base64_decode($_REQUEST['id']);
                            ?>
                                <div class="form-group">
                                    <label for="your_pass"><i class="zmdi zmdi-email"></i></label>
                                    <input type="text" name="verify" id="verify" placeholder="Verify Code" />
                                    <span class="error" id="verifyError"></span><!-- Error message for verify code -->
                                </div>
                            <?php } ?>
                            <div class="form-group">
                                <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" required  name="password" id="password" placeholder="Password" />
                                <span class="error" id="passwordError"></span><!-- Error message for password -->
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signin" id="signin" class="form-submit" value="Log in" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>

    <script>
        // Function to fade out the element after 2 seconds
        function fadeOutElement() {
            var element = document.getElementById("success_msg");
            element.style.opacity = 0;
        }

        // Wait for 2 seconds and then call the fadeOutElement function
        setTimeout(fadeOutElement, 2000);
    </script>

    <script>
        function validateLogin() {
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;
            const verify = document.getElementById('verify').value;
            const chklog = document.getElementById('chklog').value;

            let isValid = true;

            // Reset errors
            document.querySelectorAll('.error').forEach((errorDiv) => {
                errorDiv.innerHTML = '';
            });

            // Check for empty fields
            if (username.trim() === '') {
                displayError('name', 'Username is required.');
                isValid = false;
            }

            // Check for empty fields
            if (password.trim() === '') {
                displayError('name', 'Password is required.');
                isValid = false;
            }

            if(chklog = 'yes'){ 
            // Check for empty fields
            if (verify.trim() === '') {
                displayError('name', 'Verification Code is required.');
                isValid = false;
            }
        }

            // Check if "verify" input exists
            return isValid;
        }
    </script>

    <script>
        function displayError(inputFieldId, errorMessage) {
            const errorDiv = document.getElementById(inputFieldId + 'Error');
            errorDiv.innerHTML = errorMessage;
        }

        // Rest of your code...
    </script>


</body>

</html>