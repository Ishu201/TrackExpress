<?php

class Support {

  public function get_list() {
      $con = $GLOBALS['con'];
      $sql = "SELECT * FROM customer_mails GROUP BY customer_id";
      $result = $con->query($sql);
      return $result;
  }

  public function get_message($cusid) {
    $con = $GLOBALS['con'];
    $sql = "SELECT * FROM customer_mails WHERE customer_id='$cusid' ORDER BY id";
    $result = $con->query($sql);
    return $result;
}



  public function get_new_msg($cusid) {
    $con = $GLOBALS['con'];
    $sql = "SELECT * FROM customer_mails WHERE customer_id='$cusid' AND status='pending'";
    $result = $con->query($sql);
    $count = mysqli_num_rows($result);
    return $count;
}


  public function customer($id) {
      $con = $GLOBALS['con'];
      $sql = "SELECT * FROM tbl_customer WHERE id='$id'";
      $result = $con->query($sql);
      return $result;
  }



  public function add() {
      $con = $GLOBALS['con'];
      $customer = $_POST['cusid'];
      $message = $_POST['message'];
      date_default_timezone_set('Asia/Colombo');
      $date = date('Y-m-d');
      $time = date('H:i');
      $sql = "INSERT INTO `customer_mails`(`customer_id`, `subject`, `message`, `from`, `date`, `time`,`status`) VALUES('$customer','','$message','customer','$date','$time','pending')";
      $result = $con->query($sql);
      return $customer;
  }


  

}
