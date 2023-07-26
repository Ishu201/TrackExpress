<?php

class Train {

  public function get_all() {
      $con = $GLOBALS['con'];
      $sql = "SELECT * FROM tbl_train WHERE status='active'";
      $result = $con->query($sql);
      return $result;
  }


  public function viewTrainselected($id){
    $con = $GLOBALS['con'];
    $sql = "SELECT * FROM tbl_train WHERE id='$id'";
    $result = $con->query($sql);
    return $result;
  }

}

 ?>


