<?php

class Station {

  public function get_all() {
      $con = $GLOBALS['con'];
      $sql = "SELECT * FROM tbl_station WHERE status='active'";
      $result = $con->query($sql);
      return $result;
  }


  public function update_single() {
      $con = $GLOBALS['con'];
      $sid = $_POST['sid'];
      $name = $_POST['name'];
      $type = $_POST['type'];

        $sql_check = "SELECT * FROM tbl_station WHERE name='$name' and id !='$sid'";
        $result_check = $con->query($sql_check);
        $count_chk = $result_check->num_rows;

        if($count_chk != 0){
          $msg = $sid;
        } else{
          $sql = "UPDATE tbl_station SET `name`='$name', `type`='$type' WHERE id ='$sid'";
          $result = $con->query($sql) or die($con->error);
          $msg = 'success';
        }
      return $msg;
  }


  public function remove_single($sid) {
      $con = $GLOBALS['con'];
      $sql = "UPDATE tbl_station SET `status`='no' WHERE id ='$sid'";
      $result = $con->query($sql) or die($con->error);
  }


  function add() {
    $con = $GLOBALS['con'];
    $name = $_POST['name'];
    $type = $_POST['type'];
      
        $sql_query = "SELECT * FROM tbl_station WHERE name='$name' and status='active'";
        $result_query = $con->query($sql_query); 
        $count = $result_query->num_rows;

        if($count != 0){
          $msg = '1';
        }
        else{
          $sql = "INSERT INTO tbl_station ( `name`, `type`) VALUES('$name','$type')";
          $result = $con->query($sql) or die($con->error);

          $msg = '2';
        }
      return $msg;
  }


  public function viewStationselected($id){
    $con = $GLOBALS['con'];
    $sql = "SELECT * FROM tbl_station WHERE id='$id'";
    $result = $con->query($sql);
    return $result;
  }

}

 ?>


