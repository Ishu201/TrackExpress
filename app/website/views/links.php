<?php 
$web_assets_base_url = 'http://localhost/TrackExpress/assets/website/';
 
include '../controllers/db_connect.php';
$db = new dbconnection();
 $con = $db->connection();
session_start();

if (isset($_SESSION['customerID'])) {
  $cusid = $_SESSION['customerID'];
include '../models/User_model.php';
$user = new User();
$user_details = $user->show_single($cusid);
$row_user = $user_details->fetch_array();

$cusName = $row_user['cus_name'];
$userLevel = $row_user['level'];
}else{
  $cusid = '';
  $cusName = '';
  $userLevel = '';
}
date_default_timezone_set('Asia/Colombo');
?>

<link rel="icon" type="image/x-icon" href="<?php echo $web_assets_base_url; ?>images/logo.png">
<meta charset="utf-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> -->
    
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo $web_assets_base_url; ?>css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo $web_assets_base_url; ?>css/animate.css">
    
    <link rel="stylesheet" href="<?php echo $web_assets_base_url; ?>css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo $web_assets_base_url; ?>css/owl.theme.default.min.css">
    <link rel="stylesheet" href="<?php echo $web_assets_base_url; ?>css/magnific-popup.css">

    <link rel="stylesheet" href="<?php echo $web_assets_base_url; ?>css/aos.css">

    <link rel="stylesheet" href="<?php echo $web_assets_base_url; ?>css/ionicons.min.css">

    <link rel="stylesheet" href="<?php echo $web_assets_base_url; ?>css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="<?php echo $web_assets_base_url; ?>css/jquery.timepicker.css">

    
    <link rel="stylesheet" href="<?php echo $web_assets_base_url; ?>css/flaticon.css">
    <link rel="stylesheet" href="<?php echo $web_assets_base_url; ?>css/icomoon.css">
    <link rel="stylesheet" href="<?php echo $web_assets_base_url; ?>css/style.css">

    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!--   
  --tp-white: #e7e9e9;
  --tp-blue: #111c2f;
  --tp-black: #061124;
  --tp-red: #b30f00;
  --tp-gray: #838b94;
 -->

 <style>
    /* Define custom properties for scrollbar width and colors */
:root {
  --scrollbar-width: 5px;
  --scrollbar-color: #111C2F;
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
  background-color: #B31219;
}

body{
  overflow-x: hidden;
}

 </style>

    