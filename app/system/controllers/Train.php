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
    case "add":
        $msg = $obj->add();
        // $code = 'success';
          if ($msg == '1') {
             $_SESSION['error'] = 'This Train is Already Registered';
            // $code = 'error';
          } else if($msg == '2'){
             $_SESSION['success'] =  'Successfully Registered ..!!';
            // $code = 'error';
          } else{
            $_SESSION['error'] =  $msg;
          }
        
        header("Location:../views/train_reg.php");
        break;

    case "update":
        $msg = $obj->update_single();
          if ($msg == 'success') {
            $_SESSION['success'] =  'Successfully Updated ..!!';
            header("Location:../views/train_list.php");
          }else{
            $_SESSION['error'] = 'This Train Code is Already Registered';
            $tid = $_SESSION['tid'];
            header("Location:../views/train_reg.php?id=$tid");
          }
          
        
        break;

    case "remove":
      $tid = $_REQUEST['id'];
        $msg = $obj->remove_single($tid);
            $_SESSION['success'] = 'Train data is removed ..!!';
            header("Location:../views/train_list.php");
        break;


}
