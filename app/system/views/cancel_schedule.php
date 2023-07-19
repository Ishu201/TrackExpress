<?php include('sidebar.php') ?>

<?php include('header.php') ?>

<?php 



include('../models/Schedule_model.php');
$Schedule_obj = new Schedule;
// $schedule = $Schedule_obj->get_all($day);

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

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left"><br>
        <p>Train Schedule Mgt / Cancel & Delayed Trains </p>
        </div>
        <a href="../controllers/Schedule.php?status=start" class="btn btn-sm btn-info" style="float:right;margin-top:10px;">Start &nbsp; <?php echo date('Y-m-d'); ?></a>
   </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
          <div class="x_title">
            <h2><b>Scheduled Train List</b></h2>
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
                  <th style="text-align:center">Original Departure</th>
                  <th style="text-align:center">Delayed Departure</th>
                  <th style="text-align:center">Booked Seats</th>
                  <th style="text-align:center">End Station</th>
                  <th style="text-align:center">Original Arrival</th>
                  <th style="text-align:center">Delayed Arrival</th>
                  <th style="text-align:right">Action</th>
                </tr>
              </thead>
              <tbody>
              <?php
                while ($row_des = $schedule->fetch_array()) {

                  ?>
                <tr>
                  <td>
                  <?php 
                    $route_id = $row_des['route_id'];

                    $route = $route_obj->viewRouteselected($route_id);
                    $row_route = $route->fetch_array();
                    echo $row_route['route_name'];
                    ?>
                  </td>
                  <td style="text-align:center">
                    <?php 
                    $train_id = $row_des['train_id'];

                    $train = $train_obj->viewTrainselected($train_id);
                    $row_train = $train->fetch_array();
                    echo $row_train['name'];
                    ?>
                  </td>
                  <td style="text-align:center">
                    <?php 
                    $start_station_id = $row_route['start_station_id'];
                    $start_station = $station_obj->viewStationselected($start_station_id);
                    $row_start_station = $start_station->fetch_array();
                    echo $row_start_station['name'];
                    ?>
                  </td>
                  <td style="text-align:right"><?php echo $row_des['departure']; ?></td>
                  <td style="text-align:right">
                  <?php 
                    $final_station_id = $row_route['final_station_id'];
                    $final_station = $station_obj->viewStationselected($final_station_id);
                    $row_final_station = $final_station->fetch_array();
                    echo $row_final_station['name'];
                    ?>
                    </td>
                    <td style="text-align:right"><?php echo $row_des['arrival']; ?></td>
                    <td style="text-align:right"><?php echo $row_route['total_distance']; ?></td>
                    <td style="text-align:right">
                    <?php 
                    $interst = $route_obj->view_total_intst($row_route['id']);
                    $output = '';
                        while ($row_int = $interst->fetch_array()) {
                            $output .= $row_int['name'] . ', ';
                        }
                        $output = rtrim($output, ', '); // Remove the trailing comma and space
                        echo $output;
                    ?>
                    </td>
                    <td style="text-align:center">
                        <?php 
                            echo $sum = (!empty($row_train['class_1']) ? $row_train['class_1'] : 0) +
                                        (!empty($row_train['class_2']) ? $row_train['class_2'] : 0) +
                                        (!empty($row_train['class_3']) ? $row_train['class_3'] : 0);
                     
                        ?>
                    </td>
                    <td style="text-align:right">
                        <button onclick="window.location.href = 'schedule_trains.php?id=<?php echo $row_des['id']; ?>';" class="btn btn-sm btn-success editbtn">Edit</button>
                        <?php if ($row_des['status'] == 'Active') { ?>
                            <button onclick="confirmRemove2('../controllers/Schedule.php','deactivate','<?php echo $row_des['id']; ?>','no');" class="btn btn-sm btn-warning">Deactivate</button>
                        <?php }else { ?>
                            <button onclick="confirmRemove2('../controllers/Schedule.php','deactivate','<?php echo $row_des['id']; ?>','Active');" class="btn btn-sm btn-info">Activate</button>
                        <?php } ?>
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

<script>
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
    <script>

      function confirmRemove2(url,status,id,val) {
        // alert('asd')
      swal({
        title: "Are you sure?",
        text: "Deactivating and Activating will effect the trains on the run..!!",
        icon: "info",
        buttons: ["Cancel", "Process"],
        dangerMode: true,
      }).then((willRemove) => {
        if (willRemove) {

    $.ajax({
        url: url, // Replace with the URL of your PHP controller
        type: 'GET',
        data: {status:status,id:id,val:val },
        success: function(response) {
          selectedValue = $('#day').val()
          loadTextFromPage(selectedValue)
        },
        error: function(xhr, status, error) {
            // Handle the error response from the server
            console.error('Error updating station:', error);
            // Additional error handling or UI updates
        }
    });

          
        } else {
          swal("Scedule Status is not Changed.");
        }
      });
    }
</script>

<?php include('footer.php') ?>