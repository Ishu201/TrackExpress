<?php

class User {

  // public function get_all() {
  //     $con = $GLOBALS['con'];
  //     $sql = "SELECT * FROM tbl_user WHERE status='active'";
  //     $result = $con->query($sql);
  //     return $result;
  // }


  // public function update_single() {
  //     $con = $GLOBALS['con'];
  //     $tid = $_POST['tid'];
  //     $code = $_POST['code'];
  //     $name = $_POST['name'];
  //     $gps_link = $_POST['gps_link'];
  //     $type = $_POST['type'];
  //     $class_1 = $_POST['class_1'];
  //     $class_2 = $_POST['class_2'];
  //     $class_3 = $_POST['class_3'];

  //       $sql_check = "SELECT * FROM tbl_user WHERE code='$code' and id !='$tid'";
  //       $result_check = $con->query($sql_check);
  //       $count_chk = $result_check->num_rows;

  //       if($count_chk != 0){
  //         $msg = $tid;
  //       } else{
  //         $sql = "UPDATE tbl_user SET `code`='$code', `name`='$name', `gps_link`='$gps_link', `type`='$type', `class_1`='$class_1', `class_2`='$class_2', `class_3`='$class_3' WHERE id ='$tid'";
  //         $result = $con->query($sql) or die($con->error);
  //         $msg = 'success';
  //       }
  //     return $msg;
  // }


  // public function remove_single($tid) {
  //     $con = $GLOBALS['con'];
  //     $sql = "UPDATE tbl_user SET `status`='no' WHERE id ='$tid'";
  //     $result = $con->query($sql) or die($con->error);
  //     $sql = "UPDATE tbl_schedule SET `user_id`='0' WHERE user_id ='$tid'";
  //     $result = $con->query($sql) or die($con->error);
  // }


  public function login_check(){
    $con = $GLOBALS['con'];
    $email = $_POST['Username'];
    $pass = md5($_POST['Password']);

    $sql = "SELECT * FROM tbl_user WHERE username='$email' AND password='$pass'";
    $result = $con->query($sql);
    $row_des = $result->fetch_array();
    $count = $result->num_rows;
    if($count != 0){
      if($row_des['verify'] == 'yes'){
        $msg = 'verified';
        $_SESSION['userID'] = $row_des['station_id'];
        $_SESSION['userType'] = $row_des['type'];
        $_SESSION['userName'] = $row_des['first_name'];
      }else{
        $msg = 'notverified';
      }
    }
    else{
      $msg = 'error';
    }
    return $msg;
  }

}

 ?>


