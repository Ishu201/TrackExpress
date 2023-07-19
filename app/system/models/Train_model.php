<?php

class Train {

  public function get_all() {
      $con = $GLOBALS['con'];
      $sql = "SELECT * FROM tbl_train WHERE status='active'";
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

        $sql_check = "SELECT * FROM tbl_train WHERE code='$code' and id !='$tid'";
        $result_check = $con->query($sql_check);
        $count_chk = $result_check->num_rows;

        if($count_chk != 0){
          $msg = $tid;
        } else{
          $sql = "UPDATE tbl_train SET `code`='$code', `name`='$name', `gps_link`='$gps_link', `type`='$type', `class_1`='$class_1', `class_2`='$class_2', `class_3`='$class_3' WHERE id ='$tid'";
          $result = $con->query($sql) or die($con->error);
          $msg = 'success';
        }
      return $msg;
  }


  public function remove_single($tid) {
      $con = $GLOBALS['con'];
      $sql = "UPDATE tbl_train SET `status`='no' WHERE id ='$tid'";
      $result = $con->query($sql) or die($con->error);
      $sql = "UPDATE tbl_schedule SET `train_id`='0' WHERE train_id ='$tid'";
      $result = $con->query($sql) or die($con->error);
  }


  function add() {
    $con = $GLOBALS['con'];
      $code = $_POST['code'];
      $name = $_POST['name'];
      $gps_link = $_POST['gps_link'];
      $type = $_POST['type'];
      $class_1 = $_POST['class_1'];
      $class_2 = $_POST['class_2'];
      $class_3 = $_POST['class_3'];
      
        $sql_query = "SELECT * FROM tbl_train WHERE code='$code' and status='active'";
        $result_query = $con->query($sql_query);
        $count = $result_query->num_rows;

        if($count != 0){
          $msg = '1';
        }
        else{
          $sql = "INSERT INTO tbl_train (`code`, `name`, `gps_link`, `type`, `class_1`, `class_2`, `class_3`) VALUES('$code','$name','$gps_link','$type','$class_1','$class_2','$class_3')";
          $result = $con->query($sql) or die($con->error);

          $msg = '2';
        }
      return $msg;
  }


  public function viewTrainselected($id){
    $con = $GLOBALS['con'];
    $sql = "SELECT * FROM tbl_train WHERE id='$id'";
    $result = $con->query($sql);
    return $result;
  }

}

 ?>


