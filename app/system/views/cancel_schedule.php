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
        <p>Train Schedule Mgt / Cancel & Delayed Trains </p>
      </div>
      <div style="float: right;text-align:center">
        <?php
        $sql_last_date = "SELECT MAX(DATE_FORMAT(STR_TO_DATE(date, '%Y-%m-%d'), '%Y-%m-%d')) AS max_date FROM tbl_daily_trains"; //sunday
        $result_last_date = $con->query($sql_last_date);
        $row_last_date = $result_last_date->fetch_array();
        $row_last_date = $row_last_date['max_date'];

        $newDate = date('Y-m-d', strtotime($row_last_date . ' +1 month'));
        // Get the year and month after adding one month
        $newYear = date('Y', strtotime($newDate));
        $newMonth = date('F', strtotime($newDate));
        ?>
        <!-- HTML code -->
        <!-- HTML code -->
        <img src="images/Loading2.gif" alt="" style="width: 50px; display: none;" id="loadingImage">
        <div style="display: none; cursor: not-allowed; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.15); z-index: 99999" id="loadingOverlay"></div>
        <a href="#" id='btnload' class="btn btn-sm btn-info" id="startButton" onclick="startLoading()">Start for <?php echo $newYear ?>-<?php echo $newMonth ?></a>

        <br><span>Time Table is created untill <?php echo $row_last_date ?></span>
      </div>

    </div>
    <br>
    <div class="clearfix"></div>

    <div class="row"> <br>
      <div class="col-md-12 col-sm-12  "><br>
        <div class="x_panel">
          <div class="x_title">
            <h2><b>Scheduled Train List  -  <?php echo $id ?></b></h2>
            <div class="clearfix">
              <?php include('session_msg.php') ?>
            </div>
          </div>

          <div class="col-md-6 col-sm-4 ">
            <label for="datetime">Select Date</label>
            <input type="date" value="<?php echo $id ?>" min="<?php echo date('Y-m-d'); ?>" style="width:50%" id="datetime" class="form-control" onchange="redirectToPage(this)">
          </div>

          <br><br><br> <br>
          <hr>
          <div id="table_schedule">
            <div class="x_content" id="table-container">
              <table id="datatable" class="table table-bordered" style="width:100%">
                <thead>
                  <tr>
                    <th>Route Name</th>
                    <th>Train</th>
                    <th style="text-align:center">Start Station</th>
                    <th style="text-align:center;width:8%">Original Departure</th>
                    <th style="text-align:center;width:8%">Delayed Departure</th>
                    <th style="text-align:center">Booked Seats</th>
                    <th style="text-align:center">End Station</th>
                    <th style="text-align:center;width:8%">Original Arrival</th>
                    <th style="text-align:center;width:8%">Delayed Arrival</th>
                    <th style="text-align:right;width:12%">Action</th>
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
                        $train_id = $row_schedule['train_id'];

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
                      <!-- original departure -->
                      <td style="text-align:center"><?php echo $row_schedule['departure']; ?></td>
                      <!-- delays -->
                      <td style="text-align:center">
                        <?php
                        if ($row_des['delay'] == '00.00') {
                          echo '-';
                        } else {
                          $originalTime = $row_schedule['departure'];
                          $intervalInMinutes = $row_des['delay'];
                          $dateTime = DateTime::createFromFormat('H:i', $originalTime);
                          $dateTime->add(new DateInterval('PT' . $intervalInMinutes . 'M'));
                          // Get the updated time in the desired format (24-hour format)
                          $updatedTime = $dateTime->format('H:i');
                          echo $updatedTime;
                        }
                        ?>
                      </td>
                      <!-- booked seats -->
                      <td style="text-align:center"><?php echo $row_des['booked_seats']; ?></td>
                      <!--  arrival station -->
                      <td style="text-align:right">
                        <?php
                        $final_station_id = $row_route['final_station_id'];
                        $final_station = $station_obj->viewStationselected($final_station_id);
                        $row_final_station = $final_station->fetch_array();
                        echo $row_final_station['name'];
                        ?>
                      </td>
                      <!-- original arrival -->
                      <td style="text-align:center"><?php echo $row_schedule['arrival']; ?></td>

                      <!-- delayed arrival -->
                      <td style="text-align:center">
                      <?php
                        if ($row_des['delay'] == '00.00') {
                          echo '-';
                        } else {
                          $originalTime = $row_schedule['arrival'];
                          $intervalInMinutes = $row_des['delay'];
                          $dateTime = DateTime::createFromFormat('H:i', $originalTime);
                          $dateTime->add(new DateInterval('PT' . $intervalInMinutes . 'M'));
                          // Get the updated time in the desired format (24-hour format)
                          $updatedTime = $dateTime->format('H:i');
                          echo $updatedTime;
                        }
                          ?>
                      </td>
                      <td style="text-align:right;width:fit-content">
                        <button class="btn btn-sm btn-info editbtn" data-toggle="modal" data-target="#delayModal" data-id="<?php echo $row_des['id']; ?>">Delay</button>
                        <!-- <a class="btn btn-sm btn-danger" href="../controllers/Timetable.php?status=cancel&id=<?php echo $row_des['id']; ?>">Cancel</a> -->
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
<!-- ... -->
<div class="modal fade" id="delayModal" tabindex="-1" role="dialog" aria-labelledby="delayModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="../controllers/Timetable.php?status=delay" method="POST">
        <div class="modal-header">
          <h5 class="modal-title" id="delayModalLabel">Add Delay Details</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <label for="time_input">Delay Time in Mins : </label>
          <input type="hidden" value="<?php echo $id; ?>" id="date" name="date">
          <input type="text" id="time_input" pattern="\d{2,3}" name="delay_time" class="form-control times" required>

          <label for="reason_input">Reason : </label>
          <textarea id="reason_input" name="reason" class="form-control" rows="4" required></textarea>

          <!-- Hidden input to store the ID value passed from the button -->
          <input type="hidden" id="modal_id_input" name="booking_id" value="">
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" style="background-color:#1ABB9C;border-color:#1ABB9C">Submit</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  // JavaScript/jQuery code to handle the modal show event
  $(document).on('click', '.editbtn', function() {
    var idValue = $(this).data('id'); // Extract the ID value from the button's data-* attribute
    // Update the hidden input value in the modal with the ID value
    $('#modal_id_input').val(idValue);
  });
</script>
<!-- ... -->

<script>
  document.addEventListener("DOMContentLoaded", function() {
    // Initialize the datepicker
    flatpickr(".dates", {
      dateFormat: "Y-m-d", // Customize the date format (optional)
      // Add any other options as needed
    });

    // Initialize the timepicker
    flatpickr(".times", {
      enableTime: true,
      noCalendar: true,
      dateFormat: "H:i", // Customize the time format (optional)
      // Add any other options as needed
    });
  });
</script>



<script>
  function redirectToPage(element) {
    // Replace "https://example.com/redirect-url" with the URL you want to redirect to.
    var val = $(element).val()
    window.location.href = "http://localhost/TrackExpress/app/system/views/cancel_schedule.php?id=" + val;
  }
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