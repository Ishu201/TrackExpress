<?php include('common.php'); session_start(); ?>

<!DOCTYPE html>
<!-- <php lang="en"> -->
  <head>
    <meta http-equiv="Content-Type" content="text/php; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Track Express</title>
    <link rel="icon" type="image/x-icon" href="<?php echo $web_assets_base_url; ?>images/logo.png">
    <!-- Bootstrap -->
    <link href="<?php echo $system_assets_base_url; ?>vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <!-- Font Awesome -->
    <link href="<?php echo $system_assets_base_url; ?>vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo $system_assets_base_url; ?>vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?php echo $system_assets_base_url; ?>vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- bootstrap-wysiwyg -->
    <link href="<?php echo $system_assets_base_url; ?>vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
    <!-- Select2 -->
    <link href="<?php echo $system_assets_base_url; ?>vendors/select2/dist/css/select2.min.css" rel="stylesheet">
    <!-- Switchery -->
    <link href="<?php echo $system_assets_base_url; ?>vendors/switchery/dist/switchery.min.css" rel="stylesheet">
    <!-- starrr -->
    <link href="<?php echo $system_assets_base_url; ?>vendors/starrr/dist/starrr.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="<?php echo $system_assets_base_url; ?>vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Datatables -->
    <link href="<?php echo $system_assets_base_url; ?>vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $system_assets_base_url; ?>vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $system_assets_base_url; ?>vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $system_assets_base_url; ?>vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $system_assets_base_url; ?>vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">


    <!-- Custom Theme Style -->
    <link href="<?php echo $system_assets_base_url; ?>build/css/custom.min.css" rel="stylesheet">

    <script src="https://unpkg.com/sweetalert@2.1.2/dist/sweetalert.min.js"></script>
    <style>
      .right_col {
      min-height: 100vh;
      background-color: lightgray;
    }
      /* Targeting all input and textarea elements */
      input::placeholder,
      textarea::placeholder {
        color: gray; /* Placeholder text color */
        font-style: italic; /* Placeholder text style */
        font-size:14px
      }

      th,td{
        font-weight: normal !important;
      }

      td{
        padding:8px !important;
        vertical-align: middle !important;
      }

      thead{
        background-color:cadetblue !important;
        color:white;
      }

      table{
        border-spacing: 0;
      }

      .alert-success{
        background-color: #00cc66 !important;
      }

      .alert-danger{
        background-color: #ff1a1a !important;
      }

      .editbtn{
        background-color: #00b359 !important;
        border:none !important;
        font-size:13px !important
      }

      .removebtn{
        background-color: #ff4d4d !important;
        border:none !important;
        font-size:13px !important
      }

    
    </style>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
  function confirmRemove(action) {
    swal({
      title: "Are you sure?",
      text: "Once removed, you cannot recover this item!",
      icon: "warning",
      buttons: ["Cancel", "Remove"],
      dangerMode: true,
    }).then((willRemove) => {
      if (willRemove) {
        window.location.href = action
        
      } else {
        swal("Item not removed.");
      }
    });
  }
</script>
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.php" class="site_title"><span> &nbsp; &nbsp;Track Express</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="<?php echo $web_assets_base_url; ?>images/translogo.png" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>Admin</h2>
              </div>
              <div class="clearfix"></div>
            </div>
            <!-- /menu profile quick info -->

            <br />

<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-home"></i> Home </a>
                  </li>
                  <li id="Train"><a><i class="fa fa-edit"></i> Train Details Mgt<span class="fa fa-chevron-down"></span></a>
                    <ul id="Trainmenu" class="nav child_menu">
                      <li id="train_reg"><a href="train_reg.php">Train Register</a></li>
                      <li id="station_reg"><a href="station_reg.php">Station Register</a></li>
                      <li id="route_reg"><a href="route_reg.php">Route Register</a></li>
                    </ul>
                  </li>
                  <li id="Schedule"><a><i class="fa fa-list"></i> Train Schedule Mgt <span class="fa fa-chevron-down"></span></a>
                    <ul id="Schedulemenu" class="nav child_menu">
                      <li id="schedule_trains"><a href="schedule_trains.php">Schedule Trains</a></li>
                      <li id="scheduled_list"><a href="scheduled_start.php">Start Schedule</a></li>
                      <li id="train_availability"><a href="train_availability.php">Train Availability</a></li>
                      <li id="train_tracking"><a href="train_tracking.php">Train Tracking</a></li>
                    </ul>
                  </li>
                  <li id="Passenger"><a><i class="fa fa-group"></i> Passenger Mgt <span class="fa fa-chevron-down"></span></a>
                    <ul id="Passengermenu" class="nav child_menu">
                      <li id="customers"><a href="customers.php">Customer List</a></li>
                      <li id="loyalty"><a href="loyalty.php">Loyalty Customer</a></li>
                      <li id="supports"><a href="supports.php">Customer Support</a></li>
                    </ul>
                  </li>
                  <li id="Booking"><a><i class="fa fa-bar-chart-o"></i> Ticket Booking Mgt <span class="fa fa-chevron-down"></span></a>
                    <ul id="Bookingmenu" class="nav child_menu">
                      <li id="booking_list"><a href="booking_list.php">Booking List</a></li>
                      <li id="booking_history"><a href="booking_history.php">Booking History</a></li>
                    </ul>
                  </li>
                  <li id="Revenue"><a><i class="fa fa-clone"></i>Revenue Mgt <span class="fa fa-chevron-down"></span></a>
                    <ul id="Revenuemenu" class="nav child_menu">
                      <li id="income_rep"><a href="income_rep.php">Income Report</a></li>
                      <li id="booking_rep"><a href="booking_rep.php">Online Booking Report</a></li>
                      <li id="income_chart"><a href="income_chart.php">Income Chart</a></li>
                    </ul>
                  </li>
                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->

          </div>
        </div>