<?php
session_start();
include 'db_connect.php';
include '../models/Station_model.php';

$ob = new dbconnection();
$con = $ob->connection();
$obj = new Station();
//$result = $obj->viewAemployee($name);

$status = $_REQUEST['status'];


switch ($status) {
    case "add":
        $msg = $obj->add();
        
          if ($msg == '1') {
             $_SESSION['error'] = 'This Station or Contact is Already Registered';
          } else if($msg == '2'){
             $_SESSION['success'] =  'Successfully Registered ..!!';
          } 
        
        header("Location:../views/station_reg.php");
        break;

    case "update":
        $msg = $obj->update_single();
        $code = 'success';
          if ($msg == 'success') {
            $_SESSION['success'] =  'Successfully Updated ..!!';
            header("Location:../views/Station_list.php");
          }else{
            $_SESSION['error'] = 'This Station Code is Already Registered';
            header("Location:../views/Station_reg.php?id=$msg");
          }
          
        
        break;

    case "remove":
      $sid = $_REQUEST['id'];
        $msg = $obj->remove_single($sid);
            $_SESSION['success'] = 'Station data is removed ..!!';
            header("Location:../views/Station_list.php");
        break;


}
