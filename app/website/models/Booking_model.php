<?php

class Booking {

  public function get_all_by_user($id) {
      $con = $GLOBALS['con'];
      $sql = "SELECT temp_booking_details.*,tbl_bookings.daily_train_id 
      FROM temp_booking_details JOIN tbl_bookings ON temp_booking_details.booking_id = tbl_bookings.id 
      WHERE temp_booking_details.customer_id = '$id'";
      $result = $con->query($sql);
      return $result;
  }

  public function get_date_by_user($id) {
      $con = $GLOBALS['con'];
      $date = date('Y-m-d');
    // $date = '2023-08-01';
      $sql = "SELECT temp_booking_details.*,tbl_bookings.daily_train_id 
      FROM temp_booking_details JOIN tbl_bookings ON temp_booking_details.booking_id = tbl_bookings.id 
      WHERE temp_booking_details.customer_id = '$id' and temp_booking_details.date>='$date'";
      $result = $con->query($sql);
      return $result;
  }

  public function get_single_by_user($id) {
      $con = $GLOBALS['con'];
      $date = date('Y-m-d');
    // $date = '2023-08-01';
      $sql = "SELECT temp_booking_details.*,tbl_bookings.daily_train_id 
      FROM temp_booking_details JOIN tbl_bookings ON temp_booking_details.booking_id = tbl_bookings.id 
      WHERE temp_booking_details.booking_id = '$id'";
      $result = $con->query($sql);
      return $result;
  }

  public function get_time_by_booking($id) {
    $con = $GLOBALS['con'];

    // First Query: Get data from tbl_daily_trains using $id
    $sql = "SELECT * FROM tbl_daily_trains WHERE id='$id'";
    $result = $con->query($sql);
    $row_data = $result->fetch_array();
    $schedule_id = $row_data['schedule_id'];
    $date = $row_data['date']; // Get the date from tbl_daily_trains
    
    // Second Query: Get data from tbl_schedule using $schedule_id and add date column
    $sql = "SELECT *, '$date' AS date FROM tbl_schedule WHERE id='$schedule_id'";
    $result = $con->query($sql);
    
    return $result;
    
  }

  public function chk_delay($id) {
      $con = $GLOBALS['con'];
      $sql = "SELECT * FROM tbl_daily_trains WHERE id='$id'";
      $result = $con->query($sql);
      $row_data = $result->fetch_array();
      $delay = $row_data['delay'];
      return $delay;
  }

  public function train_track($id) {
      $con = $GLOBALS['con'];
      $sql = "SELECT * FROM tbl_train WHERE id='$id'";
      $result = $con->query($sql);
      return $result;
  }


  

}
