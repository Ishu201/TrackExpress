<?php
include('common.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Track Express</title>
  <link rel="icon" type="image/x-icon" href="<?php echo $web_assets_base_url; ?>images/logo.png">

  <!-- Bootstrap -->
  <link href="<?php echo $system_assets_base_url; ?>vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="<?php echo $system_assets_base_url; ?>vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- NProgress -->
  <link href="<?php echo $system_assets_base_url; ?>vendors/nprogress/nprogress.css" rel="stylesheet">
  <!-- Animate.css -->
  <link href="<?php echo $system_assets_base_url; ?>vendors/animate.css/animate.min.css" rel="stylesheet">

  <!-- Custom Theme Style -->
  <link href="<?php echo $system_assets_base_url; ?>build/css/custom.min.css" rel="stylesheet">

  <style>
    .alert-dismissible {
      padding-right: 15px;
    }
  </style>
</head>

<body class="login">
  <div>

    <div class="login_wrapper">
      <div class="animate form login_form">
        <section class="login_content"><img src="<?php echo $web_assets_base_url; ?>images/translogo.png" alt="">
          <form action="../controllers/User.php?status=loginAdmin" method="post">
            <h1>Log In to<br> <br>
              TrackExpress</h1>
            <div>
              <input type="email" name="Username" id="Username" class="form-control" placeholder="Username" required="" />
            </div>
            <div>
              <input type="password" name="Password" id="Password" class="form-control" placeholder="Password" required="" />
            </div>
            <div>
              <button class="btn btn-danger" type="submit">Log in</button>
              <button class="btn btn-dark" type="reset">Reset</button>
            </div>

            <div class="clearfix"></div>

            <div class="separator">
              <div class="row" style="text-align:center">
                <?php if (isset($_SESSION['error'])) { ?>
                  <div class="alert alert-warning alert-dismissible" id="warning" style="width:100%;float:right;color:black;font-size:14px;text-shadow:none;font-weight:bold" role="alert">
                    Error..! <?php echo $_SESSION['error']; ?>
                  </div>

                <?php unset($_SESSION['error']);
                } ?>
              </div>
              <br>
              <p class="change_link">Track Express
                <a href="#" class="to_register"> Keep People Connected </a>
              </p>

              <div class="clearfix"></div>
              <br />

              <div>
                <p><?php echo date('Y-m-d'); ?> All Rights Reserved. Trackexpress automates the Train Booking system.</p>
              </div>
            </div>
          </form>
        </section>
      </div>


    </div>
  </div>
  <!-- JavaScript code -->
<script>
  // Function to hide the alert after 2 seconds
  function hideAlert() {
    var alertElement = document.getElementById("warning");
    alertElement.style.display = "none";
  }

  // Call the hideAlert function after 2 seconds
  setTimeout(hideAlert, 1000); // 2000 milliseconds = 2 seconds
</script>
</body>

</html>