<?php

class Customer {

  public function get_all() {
      $con = $GLOBALS['con'];
      $sql = "SELECT * FROM tbl_customer WHERE verification_code='yes'";
      $result = $con->query($sql);
      return $result;
  }



}
