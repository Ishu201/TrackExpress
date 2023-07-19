<?php
include '../controllers/db_connect.php';
$ob = new dbconnection();
$con = $ob->connection();

$id = $_GET['id'];
$value = $_GET['value'];
$col = $_GET['col'];

if ($col == 'password') {
    $value = md5($value);
}

echo $sql = "UPDATE tbl_user SET $col='$value' WHERE station_id ='$id'";
$result = $con->query($sql) or die($con->error);
