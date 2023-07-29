<style>
    /* Font import */
@import url("https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap");

/* Variables */
:root {
  --container: #e0e2e8;
  --topbg: #B30F00;
  --bottombg: #fff;
  --font: "Open Sans", sans-serif;
  --grey: #6c6c6c;
}

/* Global styles */
body, p, h1 {
  margin: 0;
  padding: 0;
  font-family: var(--font);
}

.container {
  background: var(--container);
  position: relative;
  width: 100%;
  height: 100vh;
}

.container .ticket {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}

.container .basic {
  display: none;
}

/* Airline ticket styles */
.airline {
  display: block;
  height: 575px;
  width: 270px;
  box-shadow: 5px 5px 30px rgba(0, 0, 0, 0.3);
  border-radius: 25px;
  z-index: 3;
}

.airline .top {
  height: 200px;
  background: var(--topbg);
  border-top-right-radius: 25px;
  border-top-left-radius: 25px;
}

.airline .top h1 {
  text-transform: uppercase;
  font-size: 12px;
  letter-spacing: 2;
  text-align: center;
  position: absolute;
  top: 30px;
  left: 50%;
  transform: translateX(-50%);
}

.airline .bottom {
  height: 410px;
  background: var(--bottombg);
  border-bottom-right-radius: 25px;
  border-bottom-left-radius: 25px;
}

.airline .top .big {
  position: absolute;
  top: 90px;
  font-size: 65px;
  font-weight: 700;
  line-height: 0.8;
}

.airline .top .big .from {
  color: var(--topbg);
  text-shadow: -1px 0 #000, 0 1px #000, 1px 0 #000, 0 -1px #000;
}

.airline .top .big .to {
  position: absolute;
  left: 32px;
  font-size: 35px;
  display: flex;
  flex-direction: row;
  align-items: center;
}

.airline .top .big .to i {
  margin-top: 5px;
  margin-right: 10px;
  font-size: 15px;
}

.airline .top--side {
  position: absolute;
  right: 35px;
  top: 110px;
  text-align: right;
}

.airline .top--side i {
  font-size: 25px;
  margin-bottom: 18px;
}

.airline .top--side p {
  font-size: 10px;
  font-weight: 700;
}

.airline .top--side p + p {
  margin-bottom: 8px;
}

.airline .bottom p {
  display: flex;
  flex-direction: column;
  font-size: 13px;
  font-weight: 700;
}

.airline .bottom span {
  font-weight: 400;
  font-size: 11px;
  color: var(--grey);
}

.airline .bottom .column {
  margin: 0 auto;
  width: 80%;
  padding: 2rem 0;
}

.airline .bottom .row {
  display: flex;
  justify-content: space-between;
}

.airline .bottom .row--right {
  text-align: right;
}

.airline .bottom .row--center {
  text-align: center;
}

.airline .bottom .row-2 {
  margin: 30px 0 60px 0;
  position: relative;
}

.airline .bottom .row-2::after {
  content: "";
  position: absolute;
  width: 100%;
  bottom: -30px;
  left: 0;
  background: #000;
  height: 1px;
}

.airline .bottom .bar--code {
  height: 50px;
  width: 80%;
  margin: 0 auto;
  position: relative;
}

.airline .bottom .bar--code::after {
  content: "";
  position: absolute;
  width: 6px;
  height: 100%;
  background: #000;
  top: 0;
  left: 0;
  box-shadow: 10px 0 #000, 30px 0 #000, 40px 0 #000, 67px 0 #000, 90px 0 #000, 100px 0 #000, 180px 0 #000, 165px 0 #000, 200px 0 #000, 210px 0 #000, 135px 0 #000, 120px 0 #000;
}

.airline .bottom .bar--code::before {
  content: "";
  position: absolute;
  width: 3px;
  height: 100%;
  background: #000;
  top: 0;
  left: 11px;
  box-shadow: 12px 0 #000, -4px 0 #000, 45px 0 #000, 65px 0 #000, 72px 0 #000, 78px 0 #000, 97px 0 #000, 150px 0 #000, 165px 0 #000, 180px 0 #000, 135px 0 #000, 120px 0 #000;
}

/* Info section styles */
.info {
  position: absolute;
  left: 50%;
  transform: translateX(-50%);
  bottom: 10px;
  font-size: 14px;
  text-align: center;
  z-index: 1;
}

.info a {
  text-decoration: none;
  color: #000;
  background: var(--topbg);
}

</style>

<?php 
include '../controllers/db_connect.php';
$db = new dbconnection();
 $con = $db->connection();
session_start();

$booking_id = $_GET['id'];
// $cusid = $_SESSION['customerID'];
$cusid = '10';
include '../models/User_model.php';
$user = new User();
$user_details = $user->show_single($cusid);
$row_user = $user_details->fetch_array();

include '../models/Booking_model.php';
$booking = new Booking();
$booking_data = $booking->get_single_by_user($booking_id);

$row_booking = $booking_data->fetch_array();
$dbooking_idNew = str_pad($row_booking['booking_id'], 5, "0", STR_PAD_LEFT);

$originalString = $row_booking['train'];
$position = strpos($originalString, '-');
if ($position !== false) {
    $trimmedString = substr($originalString, 0, $position);
} else {
    $trimmedString = $originalString;
}


$daily_train_id = $row_booking['daily_train_id'];
$train_times = $booking->get_time_by_booking($daily_train_id);
$row_times = $train_times->fetch_array();


$twentyFourHourTime = $row_times['departure'];
$departure = date("g:i A", strtotime($twentyFourHourTime));

$twentyFourHourTime = $row_times['arrival'];
$arrival = date("g:i A", strtotime($twentyFourHourTime));


$class = $row_booking['class'];
$seat = $row_booking['seat'];

if ($class == '1') {
    $classname = 'First Class';
} else if ($class == '2') {
    $classname = 'Standard';
} else {
    $classname = 'General Class';
}

if ($seat == 'w') {
    $seatname = 'Window Seat';
} else {
    $seatname = 'Middle Seat';
}
?>


<title>Train Ticket</title>
<link rel="icon" type="image/x-icon" href="http://localhost/TrackExpress/assets/website/images/logo.png">


<div class="container">
    <div class="ticket airline" style="width:320px;height:fit-content">
        <div class="top" >
            <h1>Online Ticket<br><?php echo $dbooking_idNew; ?></h1>
            <div class="big">
                <p class="from">TRACK</p>
                <p class="to"><i class="fas fa-arrow-right"></i> EXPRESS</p>
            </div>
            <div class="top--side">
                <i class="fas fa-plane"></i> <br>
                <p><?php echo $row_times['date']; ?> </p>
                
            </div>
        </div>
        <div class="bottom">
            <div class="column">
                <div class="row row-1">
                    <p><span>Train</span><?php echo $row_booking['train_name']; ?></p>
                    <p class="row--right" style="width:50%"><span>Route</span><?php echo $trimmedString; ?></p>
                </div>
                <div class="row row-2">
                    <p><span>Departure</span><?php echo $departure ?><br><?php echo $row_booking['start']; ?></p>
                    <!-- <p class="row--center"><span>Departs</span>11:00 AM</p> -->
                    <p class="row--right"><span>Arrives</span><?php echo $arrival ?><br><?php echo $row_booking['end']; ?></p>
                </div>
                <div class="row row-3">
                    <p><span>Passenger</span><?php echo $row_user['cus_name']; ?><br><?php echo $row_user['mobile']; ?></p>
                    <p class="row--right"><span>Seats</span><span style="font-size: 40px;font-weight:bold;color:#B30F00"><?php echo $row_booking['passenger']; ?></span><?php echo $classname; ?> / <?php echo $seatname; ?></p>
                </div>
            </div> <br>
            <center><p style="font-size: 11px;">Thank you for booking with us. Have a safe journey!<br>Track Express</p></center>
            
        </div>
    </div>

</div>