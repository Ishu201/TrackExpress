<?php

class Timetable {

  public function get_all() {
      $con = $GLOBALS['con'];
      $sql = "SELECT * FROM tbl_daily_trains WHERE status='active' ORDER BY name";
      $result = $con->query($sql);
      return $result;
  }


  function start() {
    $con = $GLOBALS['con'];

    $sql_last_date = "SELECT MAX(DATE_FORMAT(STR_TO_DATE(date, '%Y-%m-%d'), '%Y-%m-%d')) AS max_date FROM tbl_daily_trains"; //sunday
    $result_last_date = $con->query($sql_last_date);
    $row_last_date = $result_last_date->fetch_array();
    $row_last_date = $row_last_date['max_date'];

    $newDate = date('Y-m-d', strtotime($row_last_date . ' + ' . 1 . ' days'));

    $month = date('m', strtotime($newDate));
    $year = date('Y', strtotime($newDate));


    // Get the total number of days in the specified month and year
    $totalDays = date('t', strtotime("$year-$month-01"));

    // Loop through each day of the month
    for ($day = 1; $day <= $totalDays; $day++) {
        // Format the current date in the desired way
        $date = date('Y-m-d', strtotime("$year-$month-$day"));

        $timestamp = strtotime($date);
        $dayInWords = date("l", $timestamp);

        $sql_day_schedule = "SELECT * FROM tbl_schedule WHERE day='$dayInWords' and status='active' ORDER BY departure"; //sunday
        $result_day_schedule = $con->query($sql_day_schedule);
        $num = 1;
        while ($row_day_schedule = $result_day_schedule->fetch_array()) {
          $scheduleId = $row_day_schedule['id'];
          $train_id = $row_day_schedule['train_id'];

          $sql_train_dt = "SELECT * FROM tbl_train WHERE id='$train_id'";
              $result_train_dt = $con->query($sql_train_dt);
              $row_train_seats  = $result_train_dt->fetch_array();
              $total_seats = (!empty($row_train_seats['class_1']) ? $row_train_seats['class_1'] : 0) +
              (!empty($row_train_seats['class_2']) ? $row_train_seats['class_2'] : 0) +
              (!empty($row_train_seats['class_3']) ? $row_train_seats['class_3'] : 0);
              
              $date2 = new DateTime($date);
              $convertedDate = $date2->format("ymd");
              $convertedDay =  substr($dayInWords, 0, 3);
              $paddedNumber = str_pad($num, 2, '0', STR_PAD_LEFT);

              $code = $convertedDate.'-'.$convertedDay.$paddedNumber;
          
          $sql = "INSERT INTO `tbl_daily_trains`( `daily_code`,`date`,`day`, `schedule_id`, `delay`, `remainning_seats`) VALUES ('$code','$date','$dayInWords','$scheduleId','00.00','$total_seats')";
          $result = $con->query($sql) or die($con->error);
          $num++;
      }

        // Perform your desired actions with the $date
        echo $date . PHP_EOL;
    }

    
          if ($result) {
            $msg = '2';
          }else{
            $msg = '1';
          }
          
        
      return $msg;
  }


}

 ?>


