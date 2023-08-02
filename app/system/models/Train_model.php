<?php

class Train {

  public function get_all() {
      $con = $GLOBALS['con'];
      $sql = "SELECT * FROM tbl_train WHERE status='active'";
      $result = $con->query($sql);
      return $result;
  }

  public function get_max() {
    $con = $GLOBALS['con'];
    $sql = "SELECT * FROM tbl_train WHERE status='active' ORDER BY code DESC LIMIT 1";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $biggestCode = $row['code'];
        
        // Extract the numeric part from the biggest code
        $numericPart = intval(substr($biggestCode, 2));

        // Increment the numeric part to get the next number
        $nextNumber = $numericPart + 1;

        // Combine with the code prefix (e.g., "TC") to get the next code
        $nextCode = 'TC' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        return $nextCode;
    } else {
        // If no rows are found, return the default code (e.g., "TC001")
        return 'TC001';
    }
}



  public function update_single() {
    $con = $GLOBALS['con'];
    $tid = $con->real_escape_string($_POST['tid']);
    $code = $con->real_escape_string($_POST['code']);
    $name = $con->real_escape_string($_POST['name']);
    $speed = $con->real_escape_string($_POST['speed']);
    $type = $con->real_escape_string($_POST['type']);
    $wclass_1 = $con->real_escape_string($_POST['wclass_1']);
    $wclass_2 = $con->real_escape_string($_POST['wclass_2']);
    $wclass_3 = $con->real_escape_string($_POST['wclass_3']);
    $mclass_1 = $con->real_escape_string($_POST['mclass_1']);
    $mclass_2 = $con->real_escape_string($_POST['mclass_2']);
    $mclass_3 = $con->real_escape_string($_POST['mclass_3']);
    $total = $con->real_escape_string($_POST['total']);

    // File upload handling
    $targetDir = "../../../assets/website/images/upload/";
    $fileName = basename($_FILES["image"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    if ($_FILES["image"]["name"] != "") {
        // Check if the file is an actual image or fake image
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            // Allow only certain file formats
            $allowedTypes = array('jpg', 'jpeg', 'png', 'gif','webp');
            if (in_array($fileType, $allowedTypes)) {
                // Move the uploaded file to the destination directory
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
                    // Perform database update
                    $sql = "UPDATE tbl_train SET `code`='$code', `name`='$name', `speed`='$speed', `type`='$type', `wclass_1`='$wclass_1', `wclass_2`='$wclass_2', `wclass_3`='$wclass_3', `mclass_1`='$mclass_1', `mclass_2`='$mclass_2', `mclass_3`='$mclass_3', `total`='$total', `image`='$fileName' WHERE id ='$tid'";
                    $result = $con->query($sql) or die($con->error);
                    $msg = 'success';
                } else {
                    $msg = 'Error occurred while uploading the file.';
                }
            } else {
                $msg = 'Invalid file format. Only JPG, JPEG, PNG, and GIF images are allowed.';
            }
        } else {
            $msg = 'File is not an image.';
        }
    } else {
        // No new image uploaded, perform database update without changing the image
        $sql = "UPDATE tbl_train SET `code`='$code', `name`='$name', `speed`='$speed', `type`='$type', `wclass_1`='$wclass_1', `wclass_2`='$wclass_2', `wclass_3`='$wclass_3', `mclass_1`='$mclass_1', `mclass_2`='$mclass_2', `mclass_3`='$mclass_3', `total`='$total' WHERE id ='$tid'";
        $result = $con->query($sql) or die($con->error);
        $msg = 'success';
    }
    $_SESSION['tid'] = $tid;
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
    $code = $con->real_escape_string($_POST['code']);
    $name = $con->real_escape_string($_POST['name']);
    $speed = $con->real_escape_string($_POST['speed']);
    $type = $con->real_escape_string($_POST['type']);
    $wclass_1 = $con->real_escape_string($_POST['wclass_1']);
    $wclass_2 = $con->real_escape_string($_POST['wclass_2']);
    $wclass_3 = $con->real_escape_string($_POST['wclass_3']);
    $mclass_1 = $con->real_escape_string($_POST['mclass_1']);
    $mclass_2 = $con->real_escape_string($_POST['mclass_2']);
    $mclass_3 = $con->real_escape_string($_POST['mclass_3']);
    $total = $con->real_escape_string($_POST['total']);

    $username = $code.'@trackexpress.com';
    $password = $code.'@tc';

    // File upload handling
    $targetDir = "../../../assets/website/images/upload/";
    $fileName = basename($_FILES["image"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    // Check if the file is an actual image or fake image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        // Allow only certain file formats
        $allowedTypes = array('jpg', 'jpeg', 'png', 'gif'.'webp');
        if (in_array($fileType, $allowedTypes)) {
            // Move the uploaded file to the destination directory
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
                // Perform database insertion
                $sql_query = "SELECT * FROM tbl_train WHERE code='$code' AND status='active'";
                $result_query = $con->query($sql_query);
                $count = $result_query->num_rows;

                if ($count != 0) {
                    $msg = '1';
                } else {
                    $sql = "INSERT INTO tbl_train (`code`, `name`, `speed`, `type`, `wclass_1`, `wclass_2`, `wclass_3`, `mclass_1`, `mclass_2`, `mclass_3`, `total`, `image`) 
                            VALUES ('$code', '$name', '$speed', '$type', '$wclass_1', '$wclass_2', '$wclass_3', '$mclass_1', '$mclass_2', '$mclass_3', '$total', '$fileName')";
                    $result = $con->query($sql) or die($con->error);
                    $lastInsertID = $con->insert_id;

                    $sql = "INSERT INTO tbl_user (`station_id`, `username`, `password`,`first_name`, `type`) 
                            VALUES ('$lastInsertID', '$username', '$password','$name', 'train')";
                    $result = $con->query($sql) or die($con->error);

                    $msg = '2';
                }
            } else {
                $msg = 'Error occurred while uploading the file.';
            }
        } else {
            $msg = 'Invalid file format. Only JPG, JPEG, PNG, and GIF images are allowed.';
        }
    } else {
        $msg = 'File is not an image.';
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


