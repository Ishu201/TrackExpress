<?php

class Timetable {

//   Station details
  public function station_list(){
    $con = $GLOBALS['con'];
      $sql = "SELECT * FROM tbl_station WHERE status='active' ORDER BY name";
      $result = $con->query($sql);
      return $result;
  }

  public function station_single($id){
    $con = $GLOBALS['con'];
      $sql = "SELECT * FROM tbl_station WHERE status='active' and id='$id'";
      $result = $con->query($sql);
      $row_des = $result->fetch_array();
      $st_name = $row_des['name'];
      return $st_name;
  }

}

 ?>