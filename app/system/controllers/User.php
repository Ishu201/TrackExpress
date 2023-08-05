<?php
session_start();
include 'db_connect.php';
include '../models/User_model.php';

$ob = new dbconnection();
$con = $ob->connection();
$obj = new User();

$status = $_REQUEST['status'];


switch ($status) {
    // case "add":
    //     $msg = $obj->add();
    //     // $code = 'success';
    //       if ($msg == '1') {
    //          $_SESSION['error'] = 'This User is Already Registered';
    //         // $code = 'error';
    //       } else if($msg == '2'){
    //          $_SESSION['success'] =  'Successfully Registered ..!!';
    //         // $code = 'error';
    //       } 

    //     header("Location:../views/user_reg.php");
    //     break;


  case "loginAdmin":
    $msg = $obj->login_check();

    if ($msg == 'verified') {

      if ($_SESSION['userType'] == 'station') {
        header("Location:../views/cancel_schedule.php");
      } 
      else if ($_SESSION['userType'] == 'train') {
        header("Location:../views/train_location.php");
      } 
      else {
        header("Location:../views/admin_home.php");
      }
    } else if ($msg == 'notverified') {
      $_SESSION['error'] = 'This Account is not Verified';
      header("Location:../views");
    } else {
      $_SESSION['error'] = 'This Username or Password is Incorrect';
      header("Location:../views");
    }


    break;

    // case "remove":
    //   $tid = $_REQUEST['id'];
    //     $msg = $obj->remove_single($tid);
    //         $_SESSION['success'] = 'User data is removed ..!!';
    //         header("Location:../views/user_list.php");
    //     break;


}
