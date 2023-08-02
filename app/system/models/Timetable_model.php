<?php

require '../../../vendor/PHPMailer-master/src/PHPMailer.php';
require '../../../vendor/PHPMailer-master/src/SMTP.php';
require '../../../vendor/PHPMailer-master/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


class Timetable {

  public function get_all_by_date($date) {
      $con = $GLOBALS['con'];
      $sql = "SELECT * FROM tbl_daily_trains WHERE date='$date' and status='active' ORDER BY schedule_id";
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


  public function delay($time_input,$reason,$booking_id) {
    $con = $GLOBALS['con'];
    $sql = "UPDATE tbl_daily_trains SET `delay`='$time_input', `emergency_message` = '$reason',`delay_stat` = 'yes' WHERE id='$booking_id'";
    $result = $con->query($sql);

    $sql_st = "SELECT * FROM tbl_bookings where daily_train_id='$booking_id'"; //sunday
    $res_result = $con->query($sql_st);
    $row_data = $res_result->fetch_array();
    $cusID = $row_data['customer_id'];
    $tbl_bookings_id = $row_data['id'];
    $daily_train_id2 = str_pad($tbl_bookings_id, 5, "0", STR_PAD_LEFT);

    $sql_st2 = "SELECT * FROM tbl_customer where id='$cusID'"; //sunday
    $res_result2 = $con->query($sql_st2);
    $row_data2 = $res_result2->fetch_array();
    $usermail = $row_data2['usermail'];


    $recipient      =  $usermail; // Replace with the recipient's email address
      $subject = 'Delayed Train';
      $body = '
      <!DOCTYPE html>
      <html lang="en">
      
      <head>
          <meta charset="UTF-8">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <title>Verification Code Email</title>
          <style>
              /* Set a white background color for the email */
              body {
                  margin: 0;
                  padding: 0;
                  background-color: #ffffff;
                  font-family: Arial, sans-serif;
              }
      
              /* Container styles */
              .container {
                  max-width: 600px;
                  margin: 0 auto;
                  padding: 20px;
                  box-sizing: border-box;
                  border: 1px solid #e0e0e0;
                  border-radius: 8px;
              }
      
              /* Heading styles */
              h1 {
                  color: #4285F4;
                  text-align: center;
              }
      
              /* Button styles */
              .cta-button {
                  display: inline-block;
                  background-color: #4285F4;
                  color: #ffffff;
                  text-decoration: none;
                  padding: 10px 20px;
                  border-radius: 5px;
              }
      
              /* Footer styles */
              .footer {
                  color: #666666;
                  text-align: center;
                  margin-top: 20px;
              }
          </style>
          </style>
      </head>
      
      <body>
          <div class="container">
              <h1 style="color:#AA1826 !important">Train Delay Notification - ['.$daily_train_id2.']</h1>
              <p>Dear ' . $recipient . ',</p>
              <p>We hope this email finds you well. We regret to inform you that there has been a delay in the schedule of your upcoming train journey.</p>
              <br>
              <p style="color:#AA1826 !important"><b>Please Check your Order List From TrackExpress to show the delay Details.. </b></p>
              <br>
              <div class="footer">
              We understand that this delay may cause inconvenience, and we sincerely apologize for any inconvenience caused. Our team is working diligently to resolve the situation and ensure a smooth journey for all passengers.</p>
            <p>If you have any questions or require further assistance, please do not hesitate to contact our customer support team at info@trackexpress.com
              <br>Best Regards,<br><b>TrackExpress</b>
          </div>
          </div>
      </body>
      
      </html>
      ';

      $mail = new PHPMailer();
      // Set the mailer to use SMTP
      $mail->isSMTP();

      // SMTP settings (replace with your email provider's settings)
      $mail->Host = 'smtp.gmail.com';
      $mail->SMTPAuth = true;
      $mail->Username = 'ishutest201@gmail.com'; // Replace with your Gmail email address
      $mail->Password = 'fccfsuedwfcogoqf'; // Replace with your Gmail password
      $mail->SMTPSecure = 'ssl';
      $mail->Port = 465; // Use the appropriate port for your email provider

      // Sender and recipient
      $mail->setFrom('TrackExpress@support.com', 'Track Express');
      $mail->addAddress($recipient);

      // Step 5: Add the HTML content to the email body.
      $mail->msgHTML($body);

      // Email content
      $mail->Subject = $subject;
      $mail->Body = $body;

      // Send the email
      if (!$mail->send()) {
        echo 'Mailer Error: ' . $mail->ErrorInfo;
      } else {
        echo 'Message sent!';
      }
    
    return $result;
}




  public function alter($train_id,$booking_id) {
    $con = $GLOBALS['con'];
    $sql = "UPDATE tbl_daily_trains SET `alter_train`='$train_id'  WHERE id='$booking_id'";
    $result = $con->query($sql);

    $sql_st = "SELECT * FROM tbl_bookings where daily_train_id='$booking_id'"; //sunday
    $res_result = $con->query($sql_st);
    $row_data = $res_result->fetch_array();
    $cusID = $row_data['customer_id'];
    $tbl_bookings_id = $row_data['id'];
    $daily_train_id2 = str_pad($tbl_bookings_id, 5, "0", STR_PAD_LEFT);

    $sql_st2 = "SELECT * FROM tbl_customer where id='$cusID'"; //sunday
    $res_result2 = $con->query($sql_st2);
    $row_data2 = $res_result2->fetch_array();
    $usermail = $row_data2['usermail'];


    $recipient      =  $usermail; // Replace with the recipient's email address
      $subject = 'Changed Train Information';
      $body = '
      <!DOCTYPE html>
      <html lang="en">
      
      <head>
          <meta charset="UTF-8">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <title>Verification Code Email</title>
          <style>
              /* Set a white background color for the email */
              body {
                  margin: 0;
                  padding: 0;
                  background-color: #ffffff;
                  font-family: Arial, sans-serif;
              }
      
              /* Container styles */
              .container {
                  max-width: 600px;
                  margin: 0 auto;
                  padding: 20px;
                  box-sizing: border-box;
                  border: 1px solid #e0e0e0;
                  border-radius: 8px;
              }
      
              /* Heading styles */
              h1 {
                  color: #4285F4;
                  text-align: center;
              }
      
              /* Button styles */
              .cta-button {
                  display: inline-block;
                  background-color: #4285F4;
                  color: #ffffff;
                  text-decoration: none;
                  padding: 10px 20px;
                  border-radius: 5px;
              }
      
              /* Footer styles */
              .footer {
                  color: #666666;
                  text-align: center;
                  margin-top: 20px;
              }
          </style>
          </style>
      </head>
      
      <body>
          <div class="container">
              <h1 style="color:#AA1826 !important">Train Change Notification - ['.$daily_train_id2.']</h1>
              <p>Dear ' . $recipient . ',</p>
              <p>We hope this email finds you well. We regret to inform you that there has been a change in the train of your upcoming train journey due some unavoidable reasons.</p>
              <br>
              <p style="color:#AA1826 !important"><b>Please Check your Order List From TrackExpress to show the changed Train Details.. </b></p>
              <br>
              <div class="footer">
              We understand that this change may cause inconvenience, and we sincerely apologize for any inconvenience caused. Our team is working diligently to resolve the situation and ensure a smooth journey for all passengers.</p>
            <p>If you have any questions or require further assistance, please do not hesitate to contact our customer support team at info@trackexpress.com
              <br>Best Regards,<br><b>TrackExpress</b>
          </div>
          </div>
      </body>
      
      </html>
      ';

      $mail = new PHPMailer();
      // Set the mailer to use SMTP
      $mail->isSMTP();

      // SMTP settings (replace with your email provider's settings)
      $mail->Host = 'smtp.gmail.com';
      $mail->SMTPAuth = true;
      $mail->Username = 'ishutest201@gmail.com'; // Replace with your Gmail email address
      $mail->Password = 'fccfsuedwfcogoqf'; // Replace with your Gmail password
      $mail->SMTPSecure = 'ssl';
      $mail->Port = 465; // Use the appropriate port for your email provider

      // Sender and recipient
      $mail->setFrom('TrackExpress@support.com', 'Track Express');
      $mail->addAddress($recipient);

      // Step 5: Add the HTML content to the email body.
      $mail->msgHTML($body);

      // Email content
      $mail->Subject = $subject;
      $mail->Body = $body;

      // Send the email
      if (!$mail->send()) {
        echo 'Mailer Error: ' . $mail->ErrorInfo;
      } else {
        echo 'Message sent!';
      }
    
    return $result;
}



}
