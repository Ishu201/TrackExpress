<?php
include('common.php'); session_start(); 

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  // Get the data from the AJAX request
  $id = $_POST["id"];
  $latitude = $_POST["latitude"];
  $longitude = $_POST["longitude"];

  $sql = "UPDATE tbl_train SET longitude='$longitude',latitude='$latitude' WHERE id ='$id'";
    $result = $con->query($sql);

  echo "Data received successfully!";
}
?>
