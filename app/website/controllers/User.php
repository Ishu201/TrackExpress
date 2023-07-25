<?php
session_start();
include 'db_connect.php';
include '../models/User_model.php';

$ob = new dbconnection();
$con = $ob->connection();
$obj = new User();

$status = $_REQUEST['status'];


switch ($status) {
    case "add":
        $msg = $obj->add();
        // $code = 'success';
          if ($msg == 'error') {
             $_SESSION['error'] = 'This Email is Already Registered';
             header("Location:../views/login/register.php");
          } else{
             $_SESSION['success'] =  'Please Check Your Emails to Verify Your Account..!!';
             $msg = base64_encode($msg);
             header("Location:../views/login/login.php?id=$msg");
            } 
        
        
        break;


    case "login":
         $msg = $obj->login_check();
        
          if ($msg == 'okay') {
            header("Location:../views/index.php");
          }
          else if ($msg == 'incorrectpw'){
             $_SESSION['error'] = 'The Password is Incorrect..!!';
            header("Location:../views/login/login.php");
          }
          else if ($msg == 'incorrectvc'){
             $_SESSION['error'] = 'The Verification Code is Incorrect..!!';
            header("Location:../views/login/login.php?id=". $_SESSION['mailid']."");
          }
          else if ($msg == 'incorrectpwvc'){
             $_SESSION['error'] = 'The Password is Incorrect..!!';
            header("Location:../views/login/login.php?id=". $_SESSION['mailid']."");
          }
          else{
             $_SESSION['error'] = 'This User is not registered with TrackExpress';
             header("Location:../views/login/login.php");
          }
          
        
        break;

    // case "remove":
    //   $tid = $_REQUEST['id'];
    //     $msg = $obj->remove_single($tid);
    //         $_SESSION['success'] = 'User data is removed ..!!';
    //         header("Location:../views/user_list.php");
    //     break;


}
