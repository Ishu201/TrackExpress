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
        .error {
            color: #CB283A;
        }

        .signup-image {
            margin-top: 0px;
        }
    </style>
</head>

<body style="background-image:url(../login/images/background-img.jpg) ;">

    <div class="main" style="padding:40px;background-image:url(../login/images/background-img.jpg) ;">

        <!-- Sing in  Form -->
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Sign up</h2>
                        <form method="POST" class="register-form" id="register-form" action="../../controllers/User.php?status=add" onsubmit="return validateForm()">
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="name" id="name" placeholder="Your Name" />
                                <div class="error" id="nameError"></div>
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="text" name="email" id="email" placeholder="Your Email" />
                                <div class="error" id="emailError"></div>
                            </div>
                            <div class="form-group">
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="pass" id="pass" placeholder="Password" />
                                <div class="error" id="passError"></div>
                            </div>
                            <div class="form-group">
                                <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input type="password" name="re_pass" id="re_pass" placeholder="Repeat your password" />
                                <div class="error" id="rePassError"></div>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
                                <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in <a href="#" class="term-service">Terms of service</a></label>
                                <div class="error" id="agreeTermError"></div>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signup" id="signup" class="form-submit" value="Register" />
                                <img id="loadImg" src="images/load.gif" style="display:none;width:150px">
                            </div>
                        </form>

                    </div>
                    <div class="signup-image">
                        <center>
                            <?php if (isset($_SESSION['error'])) { ?>
                                <p style="background-color: #CB283A;color:white;padding:10px;"><?php echo $_SESSION['error']; ?></p>
                            <?php unset($_SESSION['error']);
                            } ?>

                            <?php if (isset($_SESSION['success'])) { ?>
                                <p style="background-color: #00b386;color:white;padding:10px;"><?php echo $_SESSION['success']; ?></p>
                            <?php unset($_SESSION['success']);
                            } ?>

                        </center>
                        <figure><img src="images/register.AVIF" alt="sing up image"></figure>
                        <a href="login.php" class="signup-image-link">I am already member</a>
                    </div>
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>

    <script>
        function validateForm() {
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const password = document.getElementById('pass').value;
            const confirmPassword = document.getElementById('re_pass').value;
            const agreeTerm = document.getElementById('agree-term').checked;

            let isValid = true;

            // Reset errors
            document.querySelectorAll('.error').forEach((errorDiv) => {
                errorDiv.innerHTML = '';
            });

            // Check for empty fields
            if (name.trim() === '') {
                displayError('name', 'Name is required.');
                isValid = false;
            }

            if (email.trim() === '') {
                displayError('email', 'Email is required.');
                isValid = false;
            } else if (!isValidEmail(email)) {
                displayError('email', 'Invalid email format.');
                isValid = false;
            }

            if (password.trim() === '') {
                displayError('pass', 'Password is required.');
                isValid = false;
            } else if (password.trim().length < 6) {
                displayError('pass', 'Password must have at least 6 characters.');
                isValid = false;
            }

            if (confirmPassword.trim() === '') {
                displayError('rePass', 'Please repeat your password.');
                isValid = false;
            } else if (password !== confirmPassword) {
                displayError('rePass', 'Passwords do not match.');
                isValid = false;
            }

            if (!agreeTerm) {
                displayError('agreeTerm', 'Please agree to the Terms of Service.');
                isValid = false;
            }

            return isValid;
        }

        function isValidEmail(email) {
            // Simple email format validation using a regular expression
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailPattern.test(email);
        }

        function displayError(inputFieldId, errorMessage) {
            const errorDiv = document.getElementById(inputFieldId + 'Error');
            errorDiv.innerHTML = errorMessage;
        }
    </script>

    <script>
        $(document).ready(function() {
            $('#signup').on('click', function(event) {
                // Prevent form submission
                event.preventDefault();

                // Validate the form using your validateForm function
                if (validateForm()) {
                    // Show the loading image and hide the button
                    $('#loadImg').show();
                    $('#signup').hide();

                    // Simulate form submission (replace this with your actual form submission code)
                    setTimeout(function() {
                        // This is just a simulated delay for demonstration purposes.
                        // Replace the following line with your actual form submission code.
                        $('#register-form').submit();

                        // Once the form submission is done, hide the loading image and show the button again
                        // $('#loadImg').hide();
                        // $('#signup').show();
                    }, 2000); // Change the delay time to the time it takes to submit the form
                }
            });
        });
    </script>


</body>

</html>