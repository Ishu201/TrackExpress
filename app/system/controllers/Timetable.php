<?php
session_start();
include 'db_connect.php';
include '../models/Timetable_model.php';

$ob = new dbconnection();
$con = $ob->connection();
$obj = new Timetable();


$status = $_REQUEST['status'];

switch ($status) {

    case "cancel":
      $tid = $_REQUEST['id'];
        // $msg = $obj->remove_single($tid);
        //     $_SESSION['success'] = 'timetable data is removed ..!!';
        //     header("Location:../views/timetable_trains.php");
        break;


    case "delay":
      $time_input = $con->real_escape_string($_POST['delay_time']);
      $reason     = $con->real_escape_string($_POST['reason']);
      $booking_id = $con->real_escape_string($_POST['booking_id']);
      $date = $con->real_escape_string($_POST['date']);

        $msg = $obj->delay($time_input,$reason,$booking_id);
            $_SESSION['success'] = 'The Train is Delayed ..!!';
            header("Location:../views/cancel_schedule.php?id=$date");
        break;

    case "alter":
      $train_id     = $con->real_escape_string($_POST['train_id']);
      $booking_id = $con->real_escape_string($_POST['booking_id2']);
      $day = $_GET['day'];

        $msg = $obj->alter($train_id,$booking_id);
            $_SESSION['success'] = 'The Train is Changed ..!!';
            header("Location:../views/cancel_schedule.php?id=$day");
        break;


        case "start":
          $msg = $obj->start();
            if ($msg == 'err') {
               $_SESSION['error'] = 'Something went wrong.. Try Again..!';
               header("Location:../views/cancel_schedule.php");
            } else{
               $_SESSION['success'] =  'Train Time Table Successfully Registered ..!!';
               header("Location:../views/cancel_schedule.php");
            } 
          
          break;
}
