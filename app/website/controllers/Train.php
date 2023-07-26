<?php
session_start();
include 'db_connect.php';
include '../models/Train_model.php';

$ob = new dbconnection();
$con = $ob->connection();
$obj = new Train();
//$result = $obj->viewAemployee($name);

$status = $_REQUEST['status'];


switch ($status) {

  // case "update":
  //   $msg = $obj->view_all();
  //   if ($msg == 'success') {
  //     $_SESSION['success'] =  'Successfully Updated ..!!';
  //     header("Location:../views/train_list.php");
  //   } else {
  //     $_SESSION['error'] = 'This Train Code is Already Registered';
  //     $tid = $_SESSION['tid'];
  //     header("Location:../views/train_reg.php?id=$tid");
  //   }
}
