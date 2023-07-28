<?php
session_start();
include 'db_connect.php';
include '../models/Support_model.php';

$ob = new dbconnection();
$con = $ob->connection();
$obj = new Support();
//$result = $obj->viewAemployee($name);

$status = $_REQUEST['status'];


switch ($status) {

    case "read":
      $id = $_REQUEST['id'];
        $msg = $obj->read($id);
            header("Location:../views/supports.php?id=$id");
        break;

    case "add":
        $id = $_REQUEST['id'];
        $msg = $obj->add();
            header("Location:../views/supports.php?id=$id");
        break;


}
