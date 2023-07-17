<?php

class Schedule {

  public function get_all() {
      $con = $GLOBALS['con'];
      $sql = "SELECT * FROM tbl_schedule WHERE status='active'";
      $result = $con->query($sql);
      return $result;
  }


  public function update_single() {
      $con = $GLOBALS['con'];
      $schedule_name = $_POST['schedule_name'];
      $total_distance = $_POST['total_distance'];
      $total_price_1st = $_POST['total_price_1st'];
      $total_price_2nd = $_POST['total_price_2nd'];
      $total_price_3rd = $_POST['total_price_3rd'];
      $start_station_id = $_POST['start_station_id'];
      $final_station_id = $_POST['final_station_id'];
      $sp_note = $_POST['sp_note'];
      $tid = $_POST['tid'];
      $intst_no = $_POST['intst_no'];

        $sql_check = "SELECT * FROM tbl_schedule WHERE schedule_name='$schedule_name' and id !='$tid'";
        $result_check = $con->query($sql_check);
        $count_chk = $result_check->num_rows;

        if($count_chk != 0){
          $msg = $tid;
        } else{
          $sql = "UPDATE tbl_schedule SET `schedule_name`='$schedule_name', `total_distance`='$total_distance', `total_price_1st`='$total_price_1st', `total_price_2nd`='$total_price_2nd', `total_price_3rd`='$total_price_3rd', `start_station_id`='$start_station_id', `final_station_id`='$final_station_id', `sp_note`='$sp_note' WHERE id ='$tid'";
          $result = $con->query($sql) or die($con->error);
          $msg = 'success';

        }
      return $msg;
  }

  public function update_intst($tid,$station,$distance) {
      $con = $GLOBALS['con'];
          $sql = "UPDATE tbl_schedule_stations SET `station_id`='$station', `distance`='$distance' WHERE id ='$tid'";
          $result = $con->query($sql) or die($con->error);
          
  }


  public function remove_single($tid) {
      $con = $GLOBALS['con'];
      $sql = "UPDATE tbl_schedule SET `status`='no' WHERE id ='$tid'";
      $result = $con->query($sql) or die($con->error);
  }

  public function rem_intst($tid) {
      $con = $GLOBALS['con'];
      $sql = "UPDATE tbl_schedule_stations SET `status`='no' WHERE id ='$tid'";
      $result = $con->query($sql) or die($con->error);
  }


  function add() {
    $con = $GLOBALS['con'];
      $schedule_name = $_POST['schedule_name'];
      $total_distance = $_POST['total_distance'];
      $total_price_1st = $_POST['total_price_1st'];
      $total_price_2nd = $_POST['total_price_2nd'];
      $total_price_3rd = $_POST['total_price_3rd'];
      $start_station_id = $_POST['start_station_id'];
      $final_station_id = $_POST['final_station_id'];
      $sp_note = $_POST['sp_note'];
      $intst_no = $_POST['intst_no'];
      
        $sql_query = "SELECT * FROM tbl_schedule WHERE schedule_name='$schedule_name' and status='active'";
        $result_query = $con->query($sql_query);
        $count = $result_query->num_rows;

        if($count != 0){
          $msg = '1';
        }
        else{
          $sql = "INSERT INTO `tbl_schedule`( `schedule_name`, `start_station_id`, `final_station_id`, `total_price_1st`,`total_price_2nd`,`total_price_3rd`, `total_distance`, `sp_note`) VALUES ('$schedule_name','$start_station_id','$final_station_id','$total_price_1st','$total_price_2nd','$total_price_3rd','$total_distance','$sp_note')";
          $result = $con->query($sql) or die($con->error);
          $lastInsertedId = $con->insert_id;
          
          if($intst_no > 0){
            for ($i = 0; $i < $intst_no; $i++) {
              $stationId = $_POST['station_id'][$i];
              $distance = $_POST['distance'][$i];

              $sql = "INSERT INTO `tbl_schedule_stations`(`schedule_id`, `station_id`, `distance`) VALUES ('$lastInsertedId','$stationId','$distance')";
              $result = $con->query($sql) or die($con->error);
          }
          }

          $msg = '2';
        }
      return $msg;
  }


  public function viewScheduleselected($id){
    $con = $GLOBALS['con'];
    $sql = "SELECT * FROM tbl_schedule WHERE id='$id'";
    $result = $con->query($sql);
    return $result;
  }

}

 ?>


