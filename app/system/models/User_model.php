<?php

class User {

  public function login_check(){
    $con = $GLOBALS['con'];
    $email = $con->real_escape_string($_POST['Username']);
    $pass = md5($con->real_escape_string($_POST['Password']));

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


  
  public function get_all() {
    $con = $GLOBALS['con'];
    $sql = "SELECT * FROM tbl_user WHERE verify='yes' and status='active'";
    $result = $con->query($sql);
    return $result;
}

}
