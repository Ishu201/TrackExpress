<?php

class Customer {

  public function get_all() {
      $con = $GLOBALS['con'];
      $sql = "SELECT * FROM tbl_customer WHERE verification_code='yes'";
      $result = $con->query($sql);
      return $result;
  }

  public function get_random() {
      $con = $GLOBALS['con'];
      $sql = "SELECT * FROM tbl_customer
      WHERE verification_code = 'yes'
      ORDER BY RAND()
      LIMIT 5;
      ";
      $result = $con->query($sql);
      return $result;
  }



}
