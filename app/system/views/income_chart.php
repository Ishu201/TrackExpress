<?php include('sidebar.php') ?>

<?php include('header.php') ?>

<?php

if (isset($_GET['id'])) {
  $date = $_GET['id'];
} else {
  $date = date('Y');
}


?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left"><br>
        <p>Revenue Mgt / Income Details Chart</p>
      </div>
      <!-- <a href="train_list.php" class="btn btn-sm btn-info" style="float:right;margin-top:10px;">Train List</a> -->
    </div>

    <div class="clearfix"> </div>



    <div class="row">
      <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
          <div class="x_title">
            <h2><b>Income Analyse</b></h2>
            <div class="clearfix"></div>

          </div>
          <div class="x_content">
            <div class="row">
              <div class="col-md-6 col-sm-4 ">
                <label for="datetime">Enter Year</label>
                <input type="number" min='2023' max='2024' value="<?php echo $date; ?>" style="width:50%" id="datetime" class="form-control" onchange="redirectToPage(this)">
              </div>
              <div class="col-md-6 col-sm-4 "> </div>
            </div>

            <?php 
            $year = $date;
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

            <div class="row">
              <div class="col-sm-12">
                <div class="card-box "> <br><br>
                  <canvas id="bar-chart" style="width:500 !important;height:300px !important"></canvas>

                  <script>
                    // Bar chart
                    new Chart(document.getElementById("bar-chart"), {
                      type: 'bar',
                      data: {
                        labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
                        datasets: [{
                          label: "Income (Rs.)",
                          backgroundColor: ["#1A857D", "#3CA59D", "#7AD4A9", "#38A16F", "#167C4C","#1A857D", "#3CA59D", "#7AD4A9", "#38A16F", "#167C4C","#1A857D", "#3CA59D", "#7AD4A9", "#38A16F", "#167C4C"],
                          data: [<?php echo implode( ", ", $sal ); ?>,0,30000]
                        }]
                      },
                      options: {
                        legend: {
                          display: false
                        },
                        title: {
                          display: true,
                          text: 'Total Income from Trackexpress Booking System'
                        }
                      }
                    });
                  </script>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->

<script>
  function redirectToPage(element) {
    // Replace "https://example.com/redirect-url" with the URL you want to redirect to.
    var val = $(element).val()
    window.location.href = "http://localhost/TrackExpress/app/system/views/income_chart.php?id=" + val;
  }
</script>

<?php include('footer.php') ?>