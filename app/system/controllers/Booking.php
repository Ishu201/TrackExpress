<?php
session_start();
include 'db_connect.php';
include '../models/Booking_model.php';

$ob = new dbconnection();
$con = $ob->connection();
$obj = new Booking();


$status = $_REQUEST['status'];

switch ($status) {

        // case "start":
        //   $msg = $obj->start();
        //     if ($msg == 'err') {
        //        $_SESSION['error'] = 'Something went wrong.. Try Again..!';
        //        header("Location:../views/cancel_schedule.php");
        //     } else{
        //        $_SESSION['success'] =  'Train Time Table Successfully Registered ..!!';
        //        header("Location:../views/cancel_schedule.php");
        //     } 
          
        //   break;
}
