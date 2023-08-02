<?php include('sidebar.php') ?>

<?php include('header.php') ?>

<?php
if (isset($_GET['id'])) {
  $id = $_GET['id'];
} else {
  $id = date('Y-m-d');
}


include('../models/Timetable_model.php');
$timetable_obj = new Timetable;
$timetable = $timetable_obj->get_all_by_date($id);

include('../models/Schedule_model.php');
$Schedule_obj = new Schedule;

include('../models/Route_model.php');
$route_obj = new Route;

include('../models/Station_model.php');
$station_obj = new Station;

include('../models/Train_model.php');
$train_obj = new Train;
?>


<script>
  $(document).ready(function() {
    $("#Schedule").addClass("active");
    $("#Schedulemenu").attr("style", "display: block;");
    $("#cancel_schedule").addClass("current-page");
  });
</script>


<style>
  .input-with-tickmark {
    display: flex;
    align-items: center;
  }

  .input-with-tickmark input {
    margin-right: 5px;
  }
</style>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.6/dist/flatpickr.min.css">
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left"><br>
        <p>Train Schedule Mgt / Train Tracking </p>
      </div>
      <div style="float: right;text-align:center">&nbsp;
      </div>

    </div>
    <br>
    <div class="clearfix"></div>

    <div class="row"> <br>
      <div class="col-md-12 col-sm-12  "><br>
        <div class="x_panel">
          <div class="x_title">
          <h2><b>Train Locations</b></h2>
            <div class="clearfix">
              <?php include('session_msg.php') ?>
            </div>
          </div>

          <div id="table_schedule">
            <div class="x_content" id="table-container">
            <table id="datatable" class="table table-bordered" style="width:100%">
                  <thead>
                    <tr>
                      <th>Route Name</th>
                      <th>Train</th>
                      <th style="text-align:center">Start Station</th>
                      <th style="text-align:center">GPS Location</th>
                      <th style="text-align:center">End Station</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    while ($row_des = $timetable->fetch_array()) {
                      $schedule_id = $row_des['schedule_id'];
                      $schedule = $Schedule_obj->viewScheduleselected($schedule_id);
                      $row_schedule = $schedule->fetch_array();
                    ?>
                      <tr>
                        <!-- routename -->
                        <td>
                          <?php
                          $route_id = $row_schedule['route_id'];

                          $route = $route_obj->viewRouteselected($route_id);
                          $row_route = $route->fetch_array();
                          echo $row_route['route_name'];
                          ?>
                        </td>
                        <!-- train -->
                        <td style="text-align:center">
                          <?php
                          $alter_train = $row_des['alter_train'];
                          if ($alter_train != '') {
                            $train_id = $alter_train;
                          } else {
                            $train_id = $row_schedule['train_id'];
                          }


                          $train = $train_obj->viewTrainselected($train_id);
                          $row_train = $train->fetch_array();
                          echo $row_train['name'];
                          ?>
                        </td>
                        <!-- start station -->
                        <td style="text-align:center">
                          <?php
                          $start_station_id = $row_route['start_station_id'];
                          $start_station = $station_obj->viewStationselected($start_station_id);
                          $row_start_station = $start_station->fetch_array();
                          echo $row_start_station['name'];
                          ?>
                        </td>

                        <td style="text-align:center"><a href="train_tracking.php?track=<?php echo $train_id; ?>"><i class="fa fa-map-marker"></i></a></td>

                        <!--  arrival station -->
                        <td style="text-align:right">
                          <?php
                          $final_station_id = $row_route['final_station_id'];
                          $final_station = $station_obj->viewStationselected($final_station_id);
                          $row_final_station = $final_station->fetch_array();
                          echo $row_final_station['name'];
                          ?>
                        </td>

                      </tr>
                    <?php } ?>

                  </tbody>
                </table>
            </div>
          </div>

        </div>
      </div>
    </div>

    
  </div>
</div>
<!-- /page content -->



<!-- Bootstrap Modal -->
 <!-- Modal --><?php if (isset($_GET['track'])) { ?>
    <div class="modal fade bd-example-modal-lg" id="locationModel" tabindex="-1" role="dialog" aria-labelledby="locationModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header" style="background-color: #67101C; border-bottom: none;">
            <h5 class="modal-title" id="locationModalLabel" style="color:white !important;font-size:17px">Train Location</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: darkslategray;">
              <span aria-hidden="true" style="color:whitesmoke">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <?php
                  $id = $_GET['track'];
                   $sql = "SELECT * FROM tbl_train WHERE id='$id'";
                  $result = $con->query($sql);
                  
                  $row_track = $result->fetch_array();
                  $longitude = $row_track['longitude'];
                  $latitude = $row_track['latitude'];
                  date_default_timezone_set('Asia/Colombo');
            ?>
            <p style="color: #67101C;"><?php echo $row_track['name'];
                                        echo '&nbsp;';
                                        echo date('H:i') ?> </p>
            <div>
              <?php

                  // $longitude = 80.76436507450855;
                  // $latitude = 7.308269992699617;

                  $mapLink = "https://maps.google.com/maps?q=$latitude,$longitude&output=embed";
                  $iframe = '<iframe width="100%" height="350px" frameborder="0" style="border:0" src="' . $mapLink . '" allowfullscreen></iframe>';
                  echo $iframe;
              ?>
            </div>
          </div>

        </div>
      </div>
    </div>
  <?php } ?>


  <script>
    <?php if (isset($_GET['track'])) { ?>
      $(document).ready(function() {
        $('#locationModel').modal('show');
      });
    <?php }  ?>
  </script>






<script>
  // JavaScript code
  function startLoading() {
    // Show the loading image and the loading overlay div
    document.getElementById('loadingImage').style.display = 'inline';
    document.getElementById('loadingOverlay').style.display = 'block';
    $('#btnload').hide()

    // Slight delay before navigating to the specified URL
    setTimeout(function() {
      window.location.href = '../controllers/Timetable.php?status=start';
    }, 200); // 200 milliseconds (adjust this value as needed)
  }


  // JavaScript code

  function loadTextFromPage(selectedValue) {
    if (selectedValue === "") {
      document.getElementById("table_schedule").innerHTML = ""; // Clear the content
      return;
    }

    // Make an AJAX request to fetch the content from another page
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("table_schedule").innerHTML = this.responseText; // Update the content
      }
    };
    xhttp.open("GET", "schedule_list_data.php?day=" + selectedValue, true); // Replace with the actual URL and query parameters
    xhttp.send();
  }
</script>


<?php include('footer.php') ?>