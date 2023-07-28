<?php include('links.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

?>

<?php
$id = $_GET['id'];
$usermail = $_GET['name'];

$sql_book = "SELECT * FROM tbl_bookings WHERE id='$id'";
$res_book = $con->query($sql_book);
$row_book = $res_book->fetch_array();
$class = $row_book['class'];
$seat = $row_book['seat'];
$booked_seats = $row_book['booked_seats'];
$daily_train_id = $row_book['daily_train_id'];

$colname = $seat.'class_'.$class;

$sql_check = "UPDATE `tbl_daily_trains` SET booked_seats=(booked_seats+$booked_seats), $colname=($colname+$booked_seats) where id='$daily_train_id'";
$result_check = $con->query($sql_check);

$sql_check = "UPDATE `tbl_bookings` SET payment_status='yes' where id='$id'";
$result_check = $con->query($sql_check);

$sql_cus = "SELECT * FROM tbl_customer WHERE usermail='$usermail'";
$res_cus = $con->query($sql_cus);
$row_cus = $res_cus->fetch_array();
$no_of_bookings = $row_cus['no_of_bookings'];
$book = $no_of_bookings + 1;

if ($book < 50) {
    $user_level = 'Traveler';
    $bonus_perc = 2;
}else if($book < 100) {
    $user_level = 'Traveler Plus';
    $bonus_perc = 5;
}else{
    $user_level = 'Elite Traveler';
    $bonus_perc = 10;
}


if ($book%10 == 0) {
    $reward = $bonus_perc;
}else{
    $reward = 0;
}

$sql_check = "UPDATE `tbl_customer` SET loyalty_reward='$reward',level='$user_level' where usermail='$usermail'";
$result_check = $con->query($sql_check);


$sql_daily_record = "SELECT * FROM temp_booking_details WHERE customer_name='$usermail'";
    $result_daily_record = $con->query($sql_daily_record);
    $row_daily_record = $result_daily_record->fetch_array();

    $customer_id    =  $row_daily_record['customer_id'];
    $customer_name  =  $row_daily_record['customer_name'];
    $train          =  $row_daily_record['train'];
    $start          =  $row_daily_record['start'];
    $end            =  $row_daily_record['end'];
    $date           =  $row_daily_record['date'];
    $class          =  $row_daily_record['class'];
    $seat           =  $row_daily_record['seat'];
    $passenger      =  $row_daily_record['passenger'];
    $booking_id      =  $row_daily_record['booking_id'];


    $daily_train_id2 = str_pad($booking_id, 5, "0", STR_PAD_LEFT);

    if ($class == '1') {
        $classname = 'First Class';
    }else if($class == '2'){
        $classname = 'Standard';
    }else{
        $classname = 'General Class';
    }
    
    if ($seat == 'w') {
        $seatname = 'Window Seat';
    }else{
        $seatname = 'Middle Seat';
    }


    $recipient      =  $usermail; // Replace with the recipient's email address
      $subject = 'Booking Confirmation';
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
              <h1 style="color:#AA1826 !important">Train Booking Confirmation - ['.$daily_train_id2.']</h1>
              <p>Dear ' . $recipient . ',</p>
              <p>Thank you for choosing our services to book your train journey. We are excited to confirm your booking and provide you with all the necessary details for your upcoming trip. Below are the specifics of your train reservation:</p>
              <table>
                  <tr>
                      <th style="text-align:left">Booking ID</th>
                      <td style="padding-left:20px"><b>'.$daily_train_id2.'</b></td>
                  </tr>
                  <tr>
                      <th style="text-align:left">Train Name</th>
                      <td style="padding-left:20px">'.$train.'</td>
                  </tr>
                  <tr>
                      <th style="text-align:left">Departure Date</th>
                      <td style="padding-left:20px">'.$date.'</td>
                  </tr>
                  <tr>
                      <th style="text-align:left">From</th>
                      <td style="padding-left:20px">'.$start.'</td>
                  </tr>
                  <tr>
                      <th style="text-align:left">To</th>
                      <td style="padding-left:20px">'.$end.'</td>
                  </tr>
                  <tr>
                      <th style="text-align:left">Seat/Class</th>
                      <td style="padding-left:20px">'.$seatname.'/'.$classname.'</td>
                  </tr>
              </table><br> <br>
              <div class="footer">
              Please ensure that you arrive at the station at least 30 minutes before the departure time. Boarding gates will close 10 minutes prior to the departure time. If you have any questions or need assistance, please dont hesitate to reach out to our customer support team at info@trackexpress.com
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
    




header("Location:my_account.php");


?>