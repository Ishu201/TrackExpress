<?php
session_start();
include 'db_connect.php';
include '../models/Timetable_model.php';

$ob = new dbconnection();
$con = $ob->connection();
$obj = new Timetable();

$status = $_REQUEST['status'];


switch ($status) {

  case "get_list":
    $msg = $obj->get_list($date,$start,$end);
    if ($msg == 'success') {
      $_SESSION['success'] =  'Successfully Updated ..!!';
      header("Location:../views/train_list.php");
    } else {
      $_SESSION['error'] = 'This Train Code is Already Registered';
      $tid = $_SESSION['tid'];
      header("Location:../views/train_reg.php?id=$tid");
    }
}
