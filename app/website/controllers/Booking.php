<?php
session_start();
include 'db_connect.php';
include '../models/Booking_model.php';

$ob = new dbconnection();
$con = $ob->connection();
$obj = new Booking();


$status = $_REQUEST['status'];

switch ($status) {

        
}
