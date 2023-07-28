<?php

class Booking {

  public function get_all_by_date($date) {
      $con = $GLOBALS['con'];
      $sql = "SELECT tbl_bookings.*, tbl_daily_trains.*, tbl_bookings.id AS mainID
      FROM tbl_bookings
      INNER JOIN tbl_daily_trains ON tbl_bookings.daily_train_id = tbl_daily_trains.id
      WHERE tbl_daily_trains.`date` = '$date'";
      $result = $con->query($sql);
      return $result;
  }

  public function get_all_by_temp($id) {
      $con = $GLOBALS['con'];
      $sql = "SELECT * FROM temp_booking_details WHERE booking_id='$id'";
      $result = $con->query($sql);
      return $result;
  }

  public function customer($id) {
      $con = $GLOBALS['con'];
      $sql = "SELECT * FROM tbl_customer WHERE id='$id'";
      $result = $con->query($sql);
      $row_data = $result->fetch_array();
      $name = $row_data['cus_name'];
      return $name;
  }


  

}
