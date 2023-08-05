<?php include('sidebar.php') ?>

<?php include('header.php') ?>


<?php
include('../models/Customer_model.php');
$obj_customer = new Customer;
$result_customer = $obj_customer->get_all();
$random_customers = $obj_customer->get_random();


$count_customer = mysqli_num_rows($result_customer);


include('../models/Booking_model.php');
$obj_booking = new Booking;
$sum_booking = $obj_booking->count_all_month();
$sum_booking_all = $obj_booking->count_all();



include('../models/Train_model.php');
$obj_train = new Train;
$result_train = $obj_train->get_all();
$count_train = mysqli_num_rows($result_train);


?>



<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    $(document).ready(function() {
        $("#home").addClass("active");;
    });
</script>

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="row" style="display: inline-block;width:100%;padding-top:20px">
            <div class="top_tiles">
                <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 ">
                    <div class="tile-stats" style="background-color:#325694;padding:17px">
                        <div class="icon"><i class="fa fa-users"></i></div>
                        <div class="count" style="color:whitesmoke"><?php echo $count_customer ?></div><br>
                        <h3 style="color:whitesmoke;font-size:25px">Total Customers</h3> <br>
                    </div>
                </div>
                <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 ">
                    <div class="tile-stats" style="background-color:#1196B4;padding:15px">
                        <div class="icon"><i class="fa fa-usd"></i></div>
                        <div class="count" style="color:whitesmoke;font-size:30px">Rs. <?php echo number_format($sum_booking,2); ?></div><br><br>
                        <h3 style="color:whitesmoke;font-size:25px">Monthly Revenue</h3> <br>
                    </div>
                </div>
                <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 ">
                    <div class="tile-stats" style="background-color:#056A54;padding:17px">
                        <div class="icon"><i class="fa fa-bus"></i></div>
                        <div class="count" style="color:whitesmoke"><?php echo $count_train ?></div><br>
                        <h3 style="color:whitesmoke;font-size:25px">Total Train Count</h3> <br>
                    </div>
                </div>
                <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 ">
                    <div class="tile-stats" style="background-color:#B0A8A7;padding:15px">
                        <div class="icon"><i class="fa fa-usd"></i></div>
                        <div class="count" style="color:whitesmoke;font-size:30px">Rs. <?php echo number_format($sum_booking_all,2); ?></div><br><br>
                        <h3 style="color:whitesmoke;font-size:25px">Gross Earnings</h3> <br>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" style="padding-top:15px">
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Transaction Summary <small>Weekly progress</small></h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="col-md-9 col-sm-12 ">

                        <?php 
                            $month = date('Y');
            $year = $month;
            $sal = [];

              for ($i=1; $i < 13; $i++) {
                $month = $year.'-'.sprintf("%02d", $i);
                $expo_amt = 0;
                 $sql = "SELECT SUM(tbl_bookings.total_payment) AS totalPay
                FROM tbl_bookings
                INNER JOIN tbl_daily_trains ON tbl_bookings.daily_train_id = tbl_daily_trains.id
                WHERE tbl_daily_trains.`date` like '$month%'";
                
                  $result = $con->query($sql);
                    $row_expo = $result->fetch_array();
                    $expo_amt = $row_expo['totalPay'];
                    $sal[] = $expo_amt;
              }
            ?>
                            <canvas id="lineChart" width="100%" height="400px"></canvas>

                            <script>
                                // Sample data for the line chart
                                var data = {
                                    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                                    datasets: [{
                                        label: 'Monthly Income',
                                        borderColor: 'rgb(75, 192, 192)',
                                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                        data: [<?php echo implode( ", ", $sal ); ?>,0,50],
                                        fill: true,
                                    }]
                                };

                                // Configuration options for the line chart
                                var options = {
                                    responsive: true,
                                    maintainAspectRatio: false,
                                    scales: {
                                        y: {
                                            beginAtZero: true,
                                        }
                                    }
                                };

                                // Get the canvas element and create the line chart
                                var ctx = document.getElementById('lineChart').getContext('2d');
                                var myLineChart = new Chart(ctx, {
                                    type: 'line',
                                    data: data,
                                    options: options
                                });
                            </script>

                        </div>

                        <div class="col-md-3 col-sm-12 ">
                            <div>
                                <div class="x_title">
                                    <h2>Recent Customers</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <ul class="list-unstyled top_profiles scroll-view">
                                <?php while ($row_random_customers = $random_customers->fetch_array()) {
    $level = $row_random_customers['level'];
?>

<?php if ($level === 'Traveler') { ?>
    <li class="media event">
        <a class="pull-left border-aero profile_thumb">
            <i class="fa fa-user aero"></i>
        </a>
        <div class="media-body">
            <a class="title" href="#"><?php echo $row_random_customers['cus_name']; ?></a>
            <p>Traveler</p>
            <p><small><?php echo  $row_random_customers['no_of_bookings']; ?> Bookings</small></p>
        </div>
    </li>
<?php } elseif ($level === 'Traveler Plus') { ?>
    <li class="media event">
        <a class="pull-left border-green profile_thumb">
            <i class="fa fa-user green"></i>
        </a>
        <div class="media-body">
            <a class="title" href="#"><?php echo $row_random_customers['cus_name']; ?></a>
            <p>Traveler Plus</p>
            <p><small><?php echo  $row_random_customers['no_of_bookings']; ?> Bookings</small></p>
        </div>
    </li>
<?php } elseif ($level === 'Elite Traveler') { ?>
    <li class="media event">
        <a class="pull-left border-blue profile_thumb">
            <i class="fa fa-user blue"></i>
        </a>
        <div class="media-body">
            <a class="title" href="#"><?php echo $row_random_customers['cus_name']; ?></a>
            <p>Elite Traveler</p>
            <p><small><?php echo  $row_random_customers['no_of_bookings']; ?> Bookings</small></p>
        </div>
    </li>
<?php } ?>

<?php } ?>

                                    
                                </ul>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- /page content -->


<?php include('footer.php') ?>