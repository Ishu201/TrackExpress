<?php include('links.php') ?>

<?php
$cusName = $_POST['cusName'];
$date = date('Y-m-d');
$customer = $_POST['customer'];
$passengers = $_POST['passengers'];
$daily_train_id = $_POST['daily_train_id'];
$class_name = $_POST['class_name'];
$seat_type = $_POST['seat_type'];
$checked_lc = $_POST['checked_lc'];
$Tname = $_POST['Tname'];
$train_name = $_POST['train_name'];
$start_station_id = $_POST['start_station_id'];
$final_station_id = $_POST['final_station_id'];
$dailydate = $_POST['dailydate'];

 $sql_train_record = "SELECT * FROM tbl_station WHERE id='$start_station_id'";
$result_train_record = $con->query($sql_train_record);
$row_train_record = $result_train_record->fetch_array();
$start_station = $row_train_record['name'];

$sql_train_record = "SELECT * FROM tbl_station WHERE id='$final_station_id'";
$result_train_record = $con->query($sql_train_record);
$row_train_record = $result_train_record->fetch_array();
$final_station = $row_train_record['name'];

if ($checked_lc == 'yes') {
    $bonus = $_POST['bonus'];
    $stat = 'accessed';
} else {
    $bonus = '';
    $stat = 'not accessed';
}

$total = $_POST['total'];

$sql_check = "INSERT INTO `tbl_bookings`(`date`, `customer_id`, `daily_train_id`, `booked_seats`, `class`, `seat`, `discount`, `total_payment`) 
VALUES ('$date ','$customer','$daily_train_id','$passengers','$class_name','$seat_type','$bonus','$total')";
$result_check = $con->query($sql_check);
$lastInsertedId = $con->insert_id;

$sql_check = "UPDATE `tbl_customer` SET loyalty_status='$stat' where id='$customer'";
$result_check = $con->query($sql_check);


 $sql_check = "INSERT INTO `temp_booking_details`(`customer_id`, `customer_name`, `train`,`train_name`, `start`, `end`, `date`, `class`, `seat`, `passenger`,`booking_id`)
VALUE('$customer','$cusName','$Tname','$train_name','$start_station','$final_station','$dailydate','$class_name','$seat_type','$passengers','$lastInsertedId')";
$result_check = $con->query($sql_check);


header("Location:checkout.php?id=$lastInsertedId&price=$total&name=$cusName");


?>