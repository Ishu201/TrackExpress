<?php
session_start();
include 'db_connect.php';
include '../models/Schedule_model.php';

$ob = new dbconnection();
$con = $ob->connection();
$obj = new Schedule();


$status = $_REQUEST['status'];

switch ($status) {
    case "add":
        $msg = $obj->add();
          if ($msg == 'err') {
             $_SESSION['error'] = 'Something went wrong.. Try Again..!';
             header("Location:../views/schedule_trains.php");
          } else{
             $_SESSION['success'] =  'Successfully Registered ..!!';
             header("Location:../views/schedule_trains.php?id=$msg");
          } 
        
        break;


    case "update_time":
      $value = $_REQUEST['value'];
      $table   = $_REQUEST['table'];
      $col     = $_REQUEST['col'];
      $id      = $_REQUEST['id'];
      $msg = $obj->update_time($value,$table,$col,$id);
          if ($msg == 'success') {
            header("Location:../views/schedule_trains.php?id=$msg");
          }
          
        break;


    case "delete":
      $tid = $_REQUEST['id'];
        $msg = $obj->remove_single($tid);
            $_SESSION['success'] = 'Schedule data is removed ..!!';
            header("Location:../views/schedule_trains.php");
        break;


    case "deactivate":
      $tid = $_REQUEST['id'];
      $val = $_REQUEST['val'];
        $msg = $obj->deactivate($tid,$val);
            // $_SESSION['success'] = 'The Schedule is deactivated ..!!';
            header("Location:../views/schedule_list.php");
        break;


        
}
