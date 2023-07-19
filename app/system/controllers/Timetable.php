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
      // $tid = $_REQUEST['id'];
      // $val = $_REQUEST['val'];
      //   $msg = $obj->deactivate($tid,$val);
      //       // $_SESSION['success'] = 'The timetable is deactivated ..!!';
      //       header("Location:../views/timetable_list.php");
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
