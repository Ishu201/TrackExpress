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
      $route_name = mysqli_real_escape_string($con,$_POST['route_name']);
      $total_distance = mysqli_real_escape_string($con,$_POST['total_distance']);
      $total_price_1st = mysqli_real_escape_string($con,$_POST['total_price_1st']);
      $total_price_2nd = mysqli_real_escape_string($con,$_POST['total_price_2nd']);
      $total_price_3rd = mysqli_real_escape_string($con,$_POST['total_price_3rd']);
      $start_station_id = mysqli_real_escape_string($con,$_POST['start_station_id']);
      $final_station_id = mysqli_real_escape_string($con,$_POST['final_station_id']);
      $sp_note = mysqli_real_escape_string($con,$_POST['sp_note']);
      $tid = mysqli_real_escape_string($con,$_POST['tid']);
      $intst_no = mysqli_real_escape_string($con,$_POST['intst_no']);

        $sql_check = "SELECT * FROM tbl_route WHERE route_name='$route_name' and id !='$tid' and status='Active'";
        $result_check = $con->query($sql_check);
        $count_chk = $result_check->num_rows;

        if($count_chk != 0){
          $msg = $tid;
        } else{
          $sql = "UPDATE tbl_route SET `route_name`='$route_name', `total_distance`='$total_distance', `total_price_1st`='$total_price_1st', `total_price_2nd`='$total_price_2nd', `total_price_3rd`='$total_price_3rd', `start_station_id`='$start_station_id', `final_station_id`='$final_station_id', `sp_note`='$sp_note' WHERE id ='$tid'";
          $result = $con->query($sql) or die($con->error);

          if($intst_no > 0){
            for ($i = 0; $i < $intst_no; $i++) {
              $stationId = mysqli_real_escape_string($con,$_POST['station_id'][$i]);
              $distance = mysqli_real_escape_string($con,$_POST['distance'][$i]);
              $price_1st = mysqli_real_escape_string($con,$_POST['price_1st'][$i]);
              $price_2nd = mysqli_real_escape_string($con,$_POST['price_2nd'][$i]);
              $price_3rd = mysqli_real_escape_string($con,$_POST['price_3rd'][$i]);
               if($stationId > 0){ 
              $sql = "INSERT INTO `tbl_route_stations`(`route_id`, `station_id`, `distance`,`price_1st`,`price_2nd`,`price_3rd`) VALUES ('$tid','$stationId','$distance','$price_1st','$price_2nd','$price_3rd')";
              $result = $con->query($sql) or die($con->error);
               }
          }
          }

          $msg = 'success';

        }
      return $msg;
  }

  public function update_intst($tid,$station,$distance,$price_1st,$price_2nd,$price_3rd) {
      $con = $GLOBALS['con'];
          $sql = "UPDATE tbl_route_stations SET `station_id`='$station', `distance`='$distance',`price_1st`='$price_1st',`price_2nd`='$price_2nd',`price_3rd`='$price_3rd' WHERE id ='$tid'";
          $result = $con->query($sql) or die($con->error);
          
  }


  public function remove_single($tid) {
      $con = $GLOBALS['con'];
      $sql = "UPDATE tbl_route SET `status`='no' WHERE id ='$tid'";
      $result = $con->query($sql) or die($con->error);
  }

  public function rem_intst($tid) {
      $con = $GLOBALS['con'];
      $sql = "UPDATE tbl_route_stations SET `status`='no' WHERE id ='$tid'";
      $result = $con->query($sql) or die($con->error);
  }


  function add() {
    $con = $GLOBALS['con'];
      $route_name = mysqli_real_escape_string($con,$_POST['route_name']);
      $total_distance = mysqli_real_escape_string($con,$_POST['total_distance']);
      $total_price_1st = mysqli_real_escape_string($con,$_POST['total_price_1st']);
      $total_price_2nd = mysqli_real_escape_string($con,$_POST['total_price_2nd']);
      $total_price_3rd = mysqli_real_escape_string($con,$_POST['total_price_3rd']);
      $start_station_id = mysqli_real_escape_string($con,$_POST['start_station_id']);
      $final_station_id = mysqli_real_escape_string($con,$_POST['final_station_id']);
      $sp_note = mysqli_real_escape_string($con,$_POST['sp_note']);
      $intst_no = mysqli_real_escape_string($con,$_POST['intst_no']);
      
        $sql_query = "SELECT * FROM tbl_route WHERE route_name='$route_name' and status='active'";
        $result_query = $con->query($sql_query);
        $count = $result_query->num_rows;

        if($count != 0){
          $msg = '1';
        }
        else{
          $sql = "INSERT INTO `tbl_route`( `route_name`, `start_station_id`, `final_station_id`, `total_price_1st`,`total_price_2nd`,`total_price_3rd`, `total_distance`, `sp_note`) VALUES ('$route_name','$start_station_id','$final_station_id','$total_price_1st','$total_price_2nd','$total_price_3rd','$total_distance','$sp_note')";
          $result = $con->query($sql) or die($con->error);
          $lastInsertedId = $con->insert_id;
          
          if($intst_no > 0){
            for ($i = 0; $i < $intst_no; $i++) {
              $stationId = mysqli_real_escape_string($con,$_POST['station_id'][$i]);
              $distance = mysqli_real_escape_string($con,$_POST['distance'][$i]);
              $price_1st = mysqli_real_escape_string($con,$_POST['price_1st'][$i]);
              $price_2nd = mysqli_real_escape_string($con,$_POST['price_2nd'][$i]);
              $price_3rd = mysqli_real_escape_string($con,$_POST['price_3rd'][$i]);
               if($stationId > 0){ 
              $sql = "INSERT INTO `tbl_route_stations`(`route_id`, `station_id`, `distance`,`price_1st`,`price_2nd`,`price_3rd`) VALUES ('$lastInsertedId','$stationId','$distance','$price_1st','$price_2nd','$price_3rd')";
              $result = $con->query($sql) or die($con->error);
               }
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


  public function view_total_intst($id){
    $con = $GLOBALS['con'];
    $sql = "SELECT tbl_route_stations.*, tbl_station.name FROM tbl_route_stations INNER JOIN tbl_station ON tbl_station.id = tbl_route_stations.station_id WHERE tbl_route_stations.route_id = '$id';";
    $result = $con->query($sql);
    return $result;
  }

}

 ?>


