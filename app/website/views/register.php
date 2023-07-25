<!DOCTYPE html>
<html lang="en">

<head>
  <title>Track Express</title>

  <?php include('links.php') ?>
  <style>
    .overlay {
      position: absolute;
      width: 100%;
      height: 100%;
      background: linear-gradient(161deg, #d960d1, #040c0f);
      opacity: 0.3;
    }

    .card {
      background: linear-gradient(45deg, white, #dd9a9a29);
      border: none;
      box-shadow: 0px 0px 9px 3px #a97b7b57;
    }

    img.img-fluid {
      width: 100%;
      height: 100%;
      object-fit: cover;
      object-position: initial;
    }

    .img-overlay {
      position: absolute;
      width: 92.5%;
      height: 100%;
      background: #5a444475;
      border-radius: 1rem 0 0 1rem;
    }

    img.logo-img {
      width: 80px;
      height: 80px;
      object-fit: contain;
      object-position: center;
    }

    h3.login-title {
      font-size: 33px;
      font-weight: 600;
    }

    label.form-label {
      color: white;
    }
  </style>
</head>

<body>

  <?php //include('header.php') 
  ?>
  <!-- END nav -->

  <section class="vh-100" style="background-image:url(login/images/background-img.jpg) ;">
    <div class="overlay"></div>
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-xl-10">
          <div class="card" style="border-radius: 1rem;">
            <div class="row g-0">
              <div class="col-md-6 col-lg-5 d-none d-md-block">
                <div class="img-overlay"></div>
                <img src="login/images/ybg_1.jpg" alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
              </div>
              <div class="col-md-6 col-lg-7 d-flex align-items-center">
                <div class="card-body p-4 p-lg-5 text-black">

                  <form>

                    <!-- Existing form elements -->

                    <div class="form-outline mb-4">
                      <label class="form-label" for="form2Example27">Password</label>
                      <div class="input-group">
                        <input type="password" id="form2Example27" class="form-control form-control-lg" />
                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                          <i class="bi bi-eye"></i>
                        </button>
                      </div>
                    </div>

                    <div class="form-outline mb-4">
                      <label class="form-label" for="confirmPassword">Confirm Password</label>
                      <div class="input-group">
                        <input type="password" id="confirmPassword" class="form-control form-control-lg" />
                        <button class="btn btn-outline-secondary" type="button" id="toggleConfirmPassword">
                          <i class="bi bi-eye"></i>
                        </button>
                      </div>
                    </div>

                    <div class="pt-1 mb-4">
                      <button class="btn btn-danger btn-lg btn-block" type="button" onclick="checkPasswordsMatch()">Register</button>
                      <div id="passwordError" style="display: none; color: #b30f00; text-align: center;">
                        Passwords do not match.
                      </div>
                    </div>


                    <!-- Existing login button and other elements -->

                    <p class="mb-5 pb-lg-2" style="color: #393f81;text-align:center">Already have an account? <a href="login.php" style="color: #1B337A;">Register here</a></p>

                  </form>


                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


  <script>
    // Function to check if passwords match
    function checkPasswordsMatch() {
      var password = document.getElementById('form2Example27').value;
      var confirmPassword = document.getElementById('confirmPassword').value;

      if (password !== confirmPassword) {
        // Display error message
        document.getElementById('passwordError').style.display = 'block';
        return false;
      } else {
        // Hide error message
        document.getElementById('passwordError').style.display = 'none';
        return true;
      }
    }

    // Function to toggle password visibility
    function togglePasswordVisibility() {
      var passwordInput = document.getElementById('form2Example27');
      var toggleBtn = document.getElementById('togglePassword');
      if (passwordInput.type === "password") {
        passwordInput.type = "text";
        toggleBtn.innerHTML = '<i class="bi bi-eye-slash"></i>';
      } else {
        passwordInput.type = "password";
        toggleBtn.innerHTML = '<i class="bi bi-eye"></i>';
      }
    }

    function toggleConfirmPasswordVisibility() {
      var confirmPasswordInput = document.getElementById('confirmPassword');
      var toggleBtn = document.getElementById('toggleConfirmPassword');
      if (confirmPasswordInput.type === "password") {
        confirmPasswordInput.type = "text";
        toggleBtn.innerHTML = '<i class="bi bi-eye-slash"></i>';
      } else {
        confirmPasswordInput.type = "password";
        toggleBtn.innerHTML = '<i class="bi bi-eye"></i>';
      }
    }

    // Attach event listeners
    document.getElementById('form2Example17').addEventListener('input', checkPasswordsMatch);
    document.getElementById('form2Example27').addEventListener('input', checkPasswordsMatch);
    document.getElementById('confirmPassword').addEventListener('input', checkPasswordsMatch);

    document.getElementById('togglePassword').addEventListener('click', togglePasswordVisibility);
    document.getElementById('toggleConfirmPassword').addEventListener('click', toggleConfirmPasswordVisibility);
  </script>

  <?php //include('footer.php') 
  ?>

  <?php include('scripts.php') ?>
</body>

</html>