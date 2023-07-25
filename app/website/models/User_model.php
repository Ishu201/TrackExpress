<?php
require '../../../vendor/PHPMailer-master/src/PHPMailer.php';
require '../../../vendor/PHPMailer-master/src/SMTP.php';
require '../../../vendor/PHPMailer-master/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


class User
{

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


  public function add()
  {
    $con = $GLOBALS['con'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = md5($_POST['pass']);

    $sql_check = "SELECT * FROM tbl_customer WHERE usermail='$email'";
    $result_check = $con->query($sql_check);
    $count_chk = $result_check->num_rows;

    $length = 6;
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $code = '';

    $charactersLength = strlen($characters);
    for ($i = 0; $i < $length; $i++) {
      $code .= $characters[rand(0, $charactersLength - 1)];
    }

    if ($count_chk != 0) {
      $msg = 'error';
    } else {
      $sql = "INSERT INTO `tbl_customer`(`cus_name`, `usermail`, `password`, `verification_code`) VALUES('$name','$email','$pass','$code')";
      $result = $con->query($sql) or die($con->error);
      $msg = $email;
      $nemail = base64_encode($email);

      // Email configuration
      $recipient = $email; // Replace with the recipient's email address
      $subject = 'Verification Code';
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
            <h1 style="color:#AA1826 !important">Email Verification</h1>
            <p>Hello ' . $recipient . ',</p>
            <p>Thank you for signing up. Your verification code is:</p>
            <div class="verification-code" style="font-size:25px;color: #AA1826;font-weight:bold">' . $code . '</div>
            <p>Please use this code to complete your registration process.</p>
            <div class="cta-button">
                <a style="color:white" href="http://localhost/TrackExpress/app/website/views/login/login.php?id=' . $nemail . '">Verify Account</a>
            </div>
            <div class="footer">
                If you did not sign up for this service, you can ignore this email.
            </div>
        </div>
    </body>
    </html>';

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
    }




    return $msg;
  }


  // public function remove_single($tid) {
  //     $con = $GLOBALS['con'];
  //     $sql = "UPDATE tbl_user SET `status`='no' WHERE id ='$tid'";
  //     $result = $con->query($sql) or die($con->error);
  //     $sql = "UPDATE tbl_schedule SET `user_id`='0' WHERE user_id ='$tid'";
  //     $result = $con->query($sql) or die($con->error);
  // }


  public function login_check()
  {
    $con = $GLOBALS['con'];
    $username = $_POST['username'];
    if($_POST['chklog'] != ''){ 
    $verify = $_POST['verify'];
    }else{
      $verify = '';
    }
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM `tbl_customer` where usermail='$username'";
      $result = $con->query($sql) or die($con->error);
      $count = $result->num_rows;
      if ($count != 0) { //if customer there
        $row_des = $result->fetch_array();

      $verification_code = $row_des['verification_code'];
      $password_db = $row_des['password'];
      $cus_id = $row_des['id'];

      if($verification_code == 'yes'){
        if ($password_db == $password) {
          $msg = 'okay';
          $_SESSION['customerID'] =  $cus_id;
        }else{
          $msg = 'incorrectpw';
        }
      }else{
        if ($verification_code == $verify) {
          if ($password_db == $password) {
          $sql = "UPDATE `tbl_customer` SET `verification_code`='yes' where usermail='$username'";
          $result = $con->query($sql) or die($con->error);
          $msg = 'okay';
          $_SESSION['customerID'] =  $cus_id;

          $recipient = $username; // Replace with the recipient's email address
      $subject = 'Verification Code';
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
            <h1 style="color:#AA1826 !important">Welcome to TrackExpress</h1>
            <p>Hello ' . $recipient . ',</p>
            <h4>Your Account is Verified Successfully !!!</h4>
            <div class="footer">
                If you did not verify your account please contact our support service.
            </div>
        </div>
    </body>
    </html>';

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
    }else{
        $msg = 'incorrectpwvc';
        $_SESSION['mailid'] =  base64_encode($username);
      }


        }else{
          $msg = 'incorrectvc';
          $_SESSION['mailid'] =  base64_encode($username);
        }
      }
      }else{
        $msg = 'nouser';
      }
      
    return $msg;
  }
}
