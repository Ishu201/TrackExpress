<?php

class Schedule {

  public function get_all($day) {
      $con = $GLOBALS['con'];
      $sql = "SELECT * FROM tbl_schedule WHERE  day='$day'";
      $result = $con->query($sql);
      return $result;
  }



  public function remove_single($tid) {
      $con = $GLOBALS['con'];
      $sql = "DELETE FROM tbl_schedule  WHERE id ='$tid'";
      $result = $con->query($sql) or die($con->error);

      $sql = "DELETE FROM tbl_schedule_stations WHERE schedule_id ='$tid'";
      $result = $con->query($sql) or die($con->error);
  }


  function add() {
    $con = $GLOBALS['con'];
      $day = $con->real_escape_string($_POST['day']);
      $train_id = $con->real_escape_string($_POST['train_id']);
      $route_id = $con->real_escape_string($_POST['route_id']);
      
          $sql = "INSERT INTO `tbl_schedule`( `day`, `train_id`, `route_id`) VALUES('$day','$train_id','$route_id')";
          $result = $con->query($sql) or die($con->error);
          $lastInsertedId = $con->insert_id;

          $sql2 = "SELECT * FROM tbl_route_stations WHERE route_id='$route_id'";
          $result2 = $con->query($sql2);
          while ($row_route_station = $result2->fetch_array()) {
              $int_stationId = $row_route_station['id'];
              
              $sql = "INSERT INTO `tbl_schedule_stations`(`schedule_id`, `int_station_id`) VALUES ('$lastInsertedId','$int_stationId')";
              $result = $con->query($sql) or die($con->error);
          }
          
          if ($result) {
            $msg = $lastInsertedId;
          }else{
            $msg = 'err';
          }
          
        
      return $msg;
  }


 

  public function update_time($value,$table,$col,$id){
    $con = $GLOBALS['con'];

     $sql = "UPDATE $table SET $col='$value' WHERE id='$id'";
    $result = $con->query($sql);
    return $result;
  }

  public function viewScheduleselected($id){
    $con = $GLOBALS['con'];
    $sql = "SELECT * FROM tbl_schedule WHERE id='$id'";
    $result = $con->query($sql);
    return $result;
  }

  public function viewSchedule_intselected($id,$int){
    $con = $GLOBALS['con'];
    $sql = "SELECT * FROM tbl_schedule_stations WHERE schedule_id='$id' and int_station_id='$int'";
    $result = $con->query($sql);
    return $result;
  }


  public function deactivate($id,$val){
    $con = $GLOBALS['con'];

     $sql = "UPDATE tbl_schedule SET status='$val' WHERE id='$id'";
    $result = $con->query($sql);
    return $result;
  }

  public function route_available($id) {
    $con = $GLOBALS['con'];
    $sql = "SELECT * FROM tbl_schedule WHERE route_id='$id'";
    $result = $con->query($sql);
    $count = $result->num_rows;
    return $count;
}

}
