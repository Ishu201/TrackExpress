<?php
session_start();
include 'db_connect.php';
include '../models/Route_model.php';

$ob = new dbconnection();
$con = $ob->connection();
$obj = new Route();
//$result = $obj->viewAemployee($name);

$status = $_REQUEST['status'];


switch ($status) {
    case "add":
        $msg = $obj->add();
        $code = 'success';
          if ($msg == '1') {
            echo $_SESSION['error'] = 'This Route is Already Registered';
            $code = 'error';
          } else if($msg == '2'){
            echo $_SESSION['success'] =  'Successfully Registered ..!!';
            $code = 'error';
          } 
        
        header("Location:../views/route_reg.php");
        break;

    case "update":
        $msg = $obj->update_single();
        $code = 'success';
          if ($msg == 'success') {
            $_SESSION['success'] =  'Successfully Updated ..!!';
            header("Location:../views/route_list.php");
          }else{
            $_SESSION['error'] = 'This Route Code is Already Registered';
            header("Location:../views/route_reg.php?id=$msg");
          }
          
        
        break;

    case "remove":
      $tid = $_REQUEST['id'];
        $msg = $obj->remove_single($tid);
            $_SESSION['success'] = 'Route data is removed ..!!';
            header("Location:../views/route_list.php");
        break;

    case "station":
      $tid = $_POST['id'];
      $station = $_POST['station'];
      $distance = $_POST['distance'];
        $msg = $obj->update_intst($tid,$station,$distance);
            header("Location:../views/route_list.php");
        break;

    case "rem_station":
      $tid = $_POST['id'];
        $msg = $obj->rem_intst($tid);
            header("Location:../views/route_list.php");
        break;


}
