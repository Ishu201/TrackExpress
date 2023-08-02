<?php

class Station {

  public function get_all() {
      $con = $GLOBALS['con'];
      $sql = "SELECT * FROM tbl_station WHERE status='active' ORDER BY name";
      $result = $con->query($sql);
      return $result;
  }


  public function update_single() {
      $con = $GLOBALS['con'];
      $sid = $con->real_escape_string($_POST['tid']);
      $name = $con->real_escape_string($_POST['name']);
      $contact = $con->real_escape_string($_POST['contact']);
      $type = $con->real_escape_string($_POST['type']);

         $sql_check = "SELECT * FROM tbl_station WHERE name='$name' and id !='$sid' and status='active'";
        $result_check = $con->query($sql_check);
         $count_chk = $result_check->num_rows;

        if($count_chk != 0){
          $msg = $sid;
        } else{
          $sql = "UPDATE tbl_station SET `name`='$name', `type`='$type' , `contact`='$contact' WHERE id ='$sid'";
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
    $name = $con->real_escape_string($_POST['name']);
    $contact = $con->real_escape_string($_POST['contact']);
    $type = $con->real_escape_string($_POST['type']);
      
        $sql_query = "SELECT * FROM tbl_station WHERE (name='$name' or contact='$contact') and status='active'";
        $result_query = $con->query($sql_query); 
        $count = $result_query->num_rows;

        if($count != 0){
          $msg = '1';
        }
        else{
          $sql = "INSERT INTO tbl_station ( `name`,`contact`, `type`) VALUES('$name','$contact','$type')";
          $result = $con->query($sql) or die($con->error);
          $lastInsertID = $con->insert_id;
          
          if (isset($_POST['chkuser']) and ($type == 'Main Station')) {
          $username = $con->real_escape_string($_POST['username']);
          $password = md5($con->real_escape_string($_POST['password']));

          $sql = "INSERT INTO `tbl_user`(`station_id`,`username`, `password`, `first_name`, `mobile`, `type`) VALUES ('$lastInsertID','$username','$password','$name','$contact','station')";
          $result = $con->query($sql) or die($con->error);

          $sql = "UPDATE`tbl_station` SET `user`='yes' where id='$lastInsertID'";
          $result = $con->query($sql) or die($con->error);

          }
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

  public function viewStationname($id) {
    $con = $GLOBALS['con'];
    $sql = "SELECT * FROM tbl_station WHERE id='$id'";
    $resultrow = $con->query($sql);

    if ($resultrow->num_rows > 0) {
        $row = $resultrow->fetch_assoc();
        $result = $row['name'];
        return $result;
    } else {
        return null; // or any other appropriate value if the result is not found
    }
}


  public function viewStation_user($stid){
    $con = $GLOBALS['con'];
    $sql = "SELECT * FROM tbl_user WHERE station_id='$stid'";
    $result = $con->query($sql);
    return $result;
    
  }

}

 ?>


