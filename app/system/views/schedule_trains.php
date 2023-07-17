<?php include('sidebar.php') ?>

<?php include('header.php') ?>

<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    include('../models/Schedule_model.php');
    $obj = new Schedule;
    $result = $obj->viewScheduleselected($id);
    $row_des = $result->fetch_array();
} else {
    $id = '';
}
?>

<?php
include('../models/Station_model.php');
$obj = new Station;
$station = $obj->get_all();

include('../models/Train_model.php');
$obj2 = new Train;
$trains = $obj2->get_all();

include('../models/Route_model.php');
$obj3 = new Route;
$routes = $obj3->get_all();
?>

<style>
    .intstations option:disabled {
        color: #a6a6a6;
        /* Desired background color for disabled options */
        cursor: not-allowed;
        /* Desired cursor style for disabled options */
    }

    #start_station_id option:disabled {
        color: #a6a6a6;
        /* Desired background color for disabled options */
        cursor: not-allowed;
        /* Desired cursor style for disabled options */
    }

    #final_station_id option:disabled {
        color: #a6a6a6;
        /* Desired background color for disabled options */
        cursor: not-allowed;
        /* Desired cursor style for disabled options */
    }
</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left"><br>
                <p>Train Schedule Mgt / Schedule Trains</p>
            </div>
            <a href="schedule_list.php" class="btn btn-sm btn-info" style="float:right;margin-top:10px;">Schedule List</a>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><b>Create Schedule</b></h2>
                        <div class="clearfix">
                            <?php include('session_msg.php') ?>
                        </div>
                    </div>
                    <div class="x_content" style="padding:10px"> <br>
                        <?php if ($id != '') { ?>
                            <form action="../controllers/Schedule.php?status=update" method="post" data-parsley-validate>
                                <input type="hidden" name="tid" id="tid" value="<?php echo $row_des['id'];  ?>">
                            <?php } else { ?>
                                <form action="../controllers/Schedule.php?status=add" method="post" data-parsley-validate>
                                <?php } ?>
                                <div class="form-group row ">
                                    <div class="col-md-3 col-sm-4 ">
                                        <label class="control-label"><span>* </span>Day</label>
                                        <select id="day" name="day" class="form-control" required>
                                            <option value="">- select a day -</option>
                                            <option value="1">Sunday</option>
                                            <option value="2">Monday</option>
                                            <option value="3">Tuesday</option>
                                            <option value="4">Wednessday</option>
                                            <option value="5">Thursday</option>
                                            <option value="6">Friday</option>
                                            <option value="7">Saturday</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 col-sm-6 ">
                                        <label class="control-label"><span>* </span>Train</label>
                                        <select id="train_id" name="train_id" class="form-control" required>
                                            <option value="">- select a train -</option>
                                            <?php
                                            while ($row_trains = $trains->fetch_array()) {
                                            ?>
                                                <option <?php if ($id != '') {
                                                            if ($row_des['train_id'] == $row_trains['id']) {
                                                                echo 'selected';
                                                            }
                                                        } ?> value="<?php echo $row_trains['id']; ?>"><?php echo $row_trains['code']; ?> - <?php echo $row_trains['name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-4 col-sm-6 ">
                                        <label class="control-label"><span>* </span>Train Route</label>
                                        <select id="route_id" name="route_id" class="form-control" required>
                                            <option value="">- select a route -</option>
                                            <?php
                                            while ($row_routes = $routes->fetch_array()) {
                                            ?>
                                                <option <?php if ($id != '') {
                                                            if ($row_des['route_id'] == $row_routes['id']) {
                                                                echo 'selected';
                                                            }
                                                        } ?> value="<?php echo $row_routes['id']; ?>"><?php echo $row_routes['route_name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-2 col-sm-6 "> <br>
                                        <button style="float:right" type="submit" class="btn btn-success">Add</button>
                                    </div>
                                </div> <br> <br>
                                
                                <div class="form-group row ">
                                    <div class="col-md-1 col-sm-4 ">
                                    </div>
                                    <div class="col-md-3 col-sm-4 ">
                                        <label class="control-label">Station</label>
                                    </div>
                                    <div class="col-md-2 col-sm-4 ">
                                        <label class="control-label">Distance (km)</label>
                                    </div>
                                    <div class="col-md-2 col-sm-4 ">
                                        <label class="control-label">Arrival</label>
                                    </div>
                                    <div class="col-md-2 col-sm-4 ">
                                        <label class="control-label">Departure</label>
                                    </div>
                                </div>
                                
                                <div class="form-group row ">
                                    <div class="col-md-1 col-sm-4 ">
                                        <label class="control-label">Start</label>
                                    </div>
                                    <div class="col-md-3 col-sm-4 ">
                                        <input readonly id="start_st" name="start_st" type="text" class="form-control" value="<?php if ($id != '') { echo $row_des['name']; } ?>" >
                                    </div>
                                    <div class="col-md-2 col-sm-4 ">
                                        <input readonly id="" name="" type="text" class="form-control" >
                                    </div>
                                    <div class="col-md-2 col-sm-4 ">
                                        <input readonly id="" name="" type="text" class="form-control" >
                                    </div>
                                    <div class="col-md-2 col-sm-4 ">
                                        <input id="start_st_departure" name="start_st_departure" type="text" class="form-control" value="<?php if ($id != '') { echo $row_des['departure']; } ?>">
                                    </div>
                                </div> <br>
                                
                                <div class="form-group row ">
                                    <div class="col-md-1 col-sm-4 ">
                                        <label class="control-label">Int</label>
                                    </div>
                                    <div class="col-md-3 col-sm-4 ">
                                        <input readonly id="int_st1" name="int_st1" type="text" class="form-control" value="<?php if ($id != '') { echo $row_des['name']; } ?>" >
                                    </div>
                                    <div class="col-md-2 col-sm-4 ">
                                        <input readonly id="" name="" type="text" class="form-control" >
                                    </div>
                                    <div class="col-md-2 col-sm-4 ">
                                    <input id="int_st_arrival1" name="int_st_arrival1" type="text" class="form-control" value="<?php if ($id != '') { echo $row_des['departure']; } ?>">
                                    </div>
                                    <div class="col-md-2 col-sm-4 ">
                                        <input id="int_st_departure1" name="int_st_departure1" type="text" class="form-control" value="<?php if ($id != '') { echo $row_des['departure']; } ?>">
                                    </div>
                                </div> <br>
                                
                                <div class="form-group row ">
                                    <div class="col-md-1 col-sm-4 ">
                                        <label class="control-label">End</label>
                                    </div>
                                    <div class="col-md-3 col-sm-4 ">
                                        <input readonly id="end_st" name="end_st" type="text" class="form-control" value="<?php if ($id != '') { echo $row_des['name']; } ?>" >
                                    </div>
                                    <div class="col-md-2 col-sm-4 ">
                                        <input readonly id="end_st_distance" name="end_st_distance" type="text" class="form-control" >
                                    </div>
                                    <div class="col-md-2 col-sm-4 ">
                                        <input  id="end_st_arrival" name="end_st_arrival" type="text" class="form-control" value="<?php if ($id != '') { echo $row_des['arrival']; } ?>">
                                    </div>
                                    <div class="col-md-2 col-sm-4 ">
                                        <input readonly id="" name="" type="text" class="form-control" >
                                    </div>
                                </div> <br>

                                </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->

<script>
    $(document).ready(function() {
        // Trigger the initial check on page load
        checkSelectedOptions();

        // Bind the change event to the start_station_id and final_station_id elements
        $("#start_station_id, #final_station_id").change(function() {
            checkSelectedOptions();
            checkSelectedOptions2();
        }); // Bind the change event to the start_station_id and final_station_id elements

        function checkSelectedOptions() {
            var startStationValue = $("#start_station_id").val();
            var finalStationValue = $("#final_station_id").val();

            $(".intstations").find("option").each(function() {
                var optionValue = $(this).val();

                if (optionValue === startStationValue || optionValue === finalStationValue) {
                    $(this).prop("disabled", true);
                } else {
                    $(this).prop("disabled", false);
                }
            });
        }

        function checkSelectedOptions2() {
            var startStationValue = $("#start_station_id").val();
            var finalStationValue = $("#final_station_id").val();

            $("#start_station_id").find("option").each(function() {
                var optionValue = $(this).val();

                if (optionValue === finalStationValue) {
                    $(this).prop("disabled", true);
                } else {
                    $(this).prop("disabled", false);
                }
            });

            $("#final_station_id").find("option").each(function() {
                var optionValue = $(this).val();

                if (optionValue === startStationValue) {
                    $(this).prop("disabled", true);
                } else {
                    $(this).prop("disabled", false);
                }
            });
        }
    });
</script>

<script>
    $(document).ready(function() {
  var stationIndex = 2; // Starting index for additional stations

  // Add Station button click event
  $('#addst').click(function() {
    var newStationDiv = $('#new_stations').find('.form-group').first().clone(); // Clone the first station div
    newStationDiv.find('select').attr('id', 'station_id_' + stationIndex).val(''); // Update select ID and empty its value
    newStationDiv.find('input').attr('id', 'distance_' + stationIndex).val(''); // Update input ID and empty its value
    newStationDiv.find('.remove-station').attr('data-station-index', stationIndex); // Add data attribute for tracking
    newStationDiv.appendTo('#new_stations'); // Append the new station div
    stationIndex++; // Increment the station index
    $('#intst_no').val(parseInt($('#intst_no').val()) + 1); // Increment intst_no value
  });

  // Remove Station button click event
  $(document).on('click', '.remove-station', function() {
    var stationIndex = $(this).data('station-index');
    $(this).closest('.form-group').remove(); // Remove the corresponding station div
    reindexStationElements(stationIndex); // Reindex station elements
    $('#intst_no').val(parseInt($('#intst_no').val()) - 1); // Decrement intst_no value
  });

  // Function to reindex station elements
  function reindexStationElements(startIndex) {
    $('.remove-station').each(function() {
      var currentStationIndex = parseInt($(this).data('station-index'));
      if (currentStationIndex > startIndex) {
        $(this).data('station-index', currentStationIndex - 1); // Decrement data-station-index
        $(this).closest('.form-group').find('select').attr('id', 'station_id_' + (currentStationIndex - 1)); // Update select ID
        $(this).closest('.form-group').find('input').attr('id', 'distance_' + (currentStationIndex - 1)); // Update input ID
      }
    });
  }
});

</script>

<script>
    function updateStation(id,no) {
        var station = $("#edit_station_id_"+no).val();
        var distance = $("#edit_distance_"+no).val();
    $.ajax({
        url: '../controllers/Schedule.php?status=station', // Replace with the URL of your PHP controller
        type: 'POST',
        data: { station: station, distance: distance, id:id },
        success: function(response) {
            // Handle the success response from the server
            alert('Update query successful!');
            // Additional actions or UI updates after the update query
        },
        error: function(xhr, status, error) {
            // Handle the error response from the server
            console.error('Error updating station:', error);
            // Additional error handling or UI updates
        }
    });
}

    function remintst(id) {
    $.ajax({
        url: '../controllers/Schedule.php?status=rem_station', // Replace with the URL of your PHP controller
        type: 'POST',
        data: {id:id },
        success: function(response) {
            // Handle the success response from the server
            alert('Update query successful!');
            // Additional actions or UI updates after the update query
        },
        error: function(xhr, status, error) {
            // Handle the error response from the server
            console.error('Error updating station:', error);
            // Additional error handling or UI updates
        }
    });
}

</script>


<?php include('footer.php') ?>