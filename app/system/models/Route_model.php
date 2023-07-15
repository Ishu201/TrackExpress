<?php

class Route {

  public function get_all() {
      $con = $GLOBALS['con'];
      $sql = "SELECT * FROM tbl_route WHERE status='active'";
      $result = $con->query($sql);
      return $result;
  }


  public function update_single() {
      $con = $GLOBALS['con'];
      $tid = $_POST['tid'];
      $code = $_POST['code'];
      $name = $_POST['name'];
      $gps_link = $_POST['gps_link'];
      $type = $_POST['type'];
      $class_1 = $_POST['class_1'];
      $class_2 = $_POST['class_2'];
      $class_3 = $_POST['class_3'];

        $sql_check = "SELECT * FROM tbl_route WHERE code='$code' and id !='$tid'";
        $result_check = $con->query($sql_check);
        $count_chk = $result_check->num_rows;

        if($count_chk != 0){
          $msg = $tid;
        } else{
          $sql = "UPDATE tbl_route SET `code`='$code', `name`='$name', `gps_link`='$gps_link', `type`='$type', `class_1`='$class_1', `class_2`='$class_2', `class_3`='$class_3' WHERE id ='$tid'";
          $result = $con->query($sql) or die($con->error);
          $msg = 'success';
        }
      return $msg;
  }


  public function remove_single($tid) {
      $con = $GLOBALS['con'];
      $sql = "UPDATE tbl_route SET `status`='no' WHERE id ='$tid'";
      $result = $con->query($sql) or die($con->error);
  }


  function add() {
    $con = $GLOBALS['con'];
      $route_name = $_POST['route_name'];
      $total_distance = $_POST['total_distance'];
      $total_price = $_POST['total_price'];
      $start_station_id = $_POST['start_station_id'];
      $final_station_id = $_POST['final_station_id'];
      $sp_note = $_POST['sp_note'];
      $intst_no = $_POST['intst_no'];
      
        $sql_query = "SELECT * FROM tbl_route WHERE route_name='$route_name' and status='active'";
        $result_query = $con->query($sql_query);
        $count = $result_query->num_rows;

        if($count != 0){
          $msg = '1';
        }
        else{
          $sql = "INSERT INTO `tbl_route`( `route_name`, `start_station_id`, `final_station_id`, `total_distance`, `total_price`, `sp_note`) VALUES ('$route_name','$start_station_id','$final_station_id','$total_distance','$total_price','$sp_note')";
          $result = $con->query($sql) or die($con->error);
          $sql = "INSERT INTO `tbl_route_stations`(`id`, `route_id`, `station_id`, `distance`, `status`) VALUES ('[value-1]','[value-2]','[value-3]','[value-4]','[value-5]')";
          $result = $con->query($sql) or die($con->error);

          if($intst_no > 0){
            for ($i = 1; $i <= $intst_no; $i++) {
              $stationId = $_POST['station_id'][$i];
              $distance = $_POST['distance'][$i];
      
              // Do something with the station_id and distance values
              // For example, you can insert them into a database
              // using prepared statements or perform any other desired operation
          }
          }

          $msg = '2';
        }
      return $msg;
  }


  public function viewRouteselected($id){
    $con = $GLOBALS['con'];
    $sql = "SELECT * FROM tbl_route WHERE id='$id'";
    $result = $con->query($sql);
    return $result;
  }

}

 ?>


