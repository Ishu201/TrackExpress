<?php include('common.php'); session_start(); ?>

<?php 
$userID = $_SESSION['userID'];
$userType = $_SESSION['userType'];
$userName = $_SESSION['userName'];

if ($userID == '') {
  header("Location:home.php");
}

?>
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

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include jQuery UI CSS -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- Include jQuery UI JavaScript -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    
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

    /* Custom checkbox style */
    .checkbox-custom {
      display: inline-block;
      position: relative;
      padding-left: 30px; /* Add padding to the left for the checkbox */
      cursor: pointer;
    }
    
    /* Hide the default checkbox */
    .checkbox-custom input {
      position: absolute;
      opacity: 0;
      cursor: pointer;
    }
    
    /* Custom checkbox design */
    .checkbox-custom .checkmark {
      position: absolute;
      top: 0;
      left: 0;
      height: 20px;
      width: 20px;
      background-color: #bfbfbf; /* Default checkbox background color */
    }
    
    /* Checkbox label style */
    .checkbox-custom .checkbox-label {
      margin-left: 5px; /* Add margin to the left for the checkbox label */
    }
    
    /* Checkbox checked style */
    .checkbox-custom input:checked ~ .checkmark {
      background-color: #26B899; /* Change the checkbox background color when checked */
    }
    
    /* Checkmark design */
    .checkbox-custom .checkmark:after {
      content: "";
      position: absolute;
      display: none;
    }
    
    /* Show the checkmark when the checkbox is checked */
    .checkbox-custom input:checked ~ .checkmark:after {
      display: block;
    }
    
    /* Checkmark design */
    .checkbox-custom .checkmark:after {
      left: 7px;
      top: 3px;
      width: 5px;
      height: 10px;
      border: solid white;
      border-width: 0 2px 2px 0;
      transform: rotate(45deg);
    }


    /* Define custom properties for scrollbar width and colors */
:root {
  --scrollbar-width: 8px;
  --scrollbar-color: #1ABB9C;
  --scrollbar-background: lightgray;
}

/* Style the scrollbar */
/* Note that this only works in webkit-based browsers (Chrome, Safari) */
/* Use ::-webkit-scrollbar for styling the scrollbar */
/* Use ::-webkit-scrollbar-thumb for styling the scrollbar handle (thumb) */
/* Use ::-webkit-scrollbar-track for styling the scrollbar track */
/* Use ::-webkit-scrollbar-corner for styling the scrollbar corner */
/* Use ::-webkit-scrollbar-thumb:hover for styling the scrollbar handle on hover */

/* Scrollbar */
::-webkit-scrollbar {
  width: var(--scrollbar-width);
}

/* Scrollbar Handle (Thumb) */
::-webkit-scrollbar-thumb {
  background-color: var(--scrollbar-color);
}

/* Scrollbar Track */
::-webkit-scrollbar-track {
  background-color: var(--scrollbar-background);
}

/* Scrollbar Corner */
::-webkit-scrollbar-corner {
  background-color: var(--scrollbar-background);
}

/* Scrollbar Handle (Thumb) on Hover */
::-webkit-scrollbar-thumb:hover {
  /* background-color: darken(var(--scrollbar-color), 10%); */
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
                <h2><?php echo $userName; ?></h2>
              </div>
              <div class="clearfix"></div>
            </div>
            <!-- /menu profile quick info -->

            <br />

<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
          <?php if($userType == 'admin'){ ?>
              <div class="menu_section">
                <ul class="nav side-menu">
                  <li id="home"><a href="admin_home.php"><i class="fa fa-home"></i> Home </a>
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
                      <li id="cancel_schedule"><a href="cancel_schedule.php">Train Time Table</a></li>
                      <li id="train_tracking"><a href="train_tracking.php">Train Tracking</a></li>
                    </ul>
                  </li>
                  <li id="Passenger"><a><i class="fa fa-group"></i> Passenger Mgt <span class="fa fa-chevron-down"></span></a>
                    <ul id="Passengermenu" class="nav child_menu">
                      <li id="customers"><a href="customers.php">Customer List</a></li>
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
              <?php }else{ ?>
                <div class="menu_section">
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-home"></i> Home </a>
                  </li>
                  <li id="Schedule"><a href="cancel_schedule.php"><i class="fa fa-list"></i> Cancel & Delay Schedule</a></li>
                  <li id="Booking"><a href="booking_list.php"><i class="fa fa-bar-chart-o"></i> Check Booking Tickets</a></li>
                  <li id="Revenue"><a href="booking_list.php"><i class="fa fa-clone"></i>Train Trcking Details </li>
                </ul>
              </div>

              <?php } ?>

            </div>
            <!-- /sidebar menu -->

          </div>
        </div>