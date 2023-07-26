<?php

class Timetable {

  public function get_list($date,$start,$end){
    $con = $GLOBALS['con'];
    $sql = "SELECT * FROM tbl_train WHERE id='$date'";
    $result = $con->query($sql);
    return $result;
  }

  public function station_list(){
    $con = $GLOBALS['con'];
      $sql = "SELECT * FROM tbl_station WHERE status='active' ORDER BY name";
      $result = $con->query($sql);
      return $result;
  }

}

 ?>