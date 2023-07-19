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
include('../models/Train_model.php');
$obj2 = new Train;
$trains = $obj2->get_all();

include('../models/Route_model.php');
$obj3 = new Route;
$routes = $obj3->get_all();

include('../models/Station_model.php');
$obj4 = new Station;

?>

<style>
.input-with-tickmark {
  display: flex;
  align-items: center;
}

.input-with-tickmark input {
  margin-right: 5px;
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
            <div class="col-md-12 col-sm-12" >
                <div class="x_panel">
                    <div class="x_title">
                        <h2><b>Create Schedule</b></h2>
                        <div class="clearfix">
                            <?php include('session_msg.php') ?>
                        </div>
                    </div>
                    <div class="x_content" style="padding:10px"> <br>
                         
                                <form <?php if ($id == '') { ?> action="../controllers/Schedule.php?status=add" <?php } ?> method="post" data-parsley-validate>
                                
                                <div class="form-group row ">
                                    <div class="col-md-3 col-sm-4 ">
                                        <label class="control-label"><span>* </span>Day</label>
                                        <select id="day" name="day" class="form-control" required>
                                            <option value="">- select a day -</option>
                                            <option <?php if ($id != '') { if ($row_des['day'] == 'Sunday') { echo 'selected'; } } ?> value="Sunday">Sunday</option>
                                            <option <?php if ($id != '') { if ($row_des['day'] == 'Monday') { echo 'selected'; } } ?> value="Monday">Monday</option>
                                            <option <?php if ($id != '') { if ($row_des['day'] == 'Tuesday') { echo 'selected'; } } ?> value="Tuesday">Tuesday</option>
                                            <option <?php if ($id != '') { if ($row_des['day'] == 'Wednessday') { echo 'selected'; } } ?> value="Wednessday">Wednessday</option>
                                            <option <?php if ($id != '') { if ($row_des['day'] == 'Thursday') { echo 'selected'; } } ?> value="Thursday">Thursday</option>
                                            <option <?php if ($id != '') { if ($row_des['day'] == 'Friday') { echo 'selected'; } } ?> value="Friday">Friday</option>
                                            <option <?php if ($id != '') { if ($row_des['day'] == 'Saturday') { echo 'selected'; } } ?> value="Saturday">Saturday</option>
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
                                    <div class="col-md-2 col-sm-6 " style="text-align:right"> <br>
                                        <?php if ($id == '') { ?> 
                                            <button type="submit" class="btn btn-success">Add</button>
                                        <?php } ?>
                                        <?php if ($id != '') { ?> 
                                            <button onclick="confirmRemove('../controllers/Schedule.php?status=delete&id=<?php echo $id; ?>')" type="button" class="btn btn-danger">Cancel</button>
                                        <?php } ?>
                                    </div>
                                </div>
                                </form> 
                                <br> <br>

                                <?php if ($id != '') { 

                                    $route = $row_des['route_id'];
                                    $sql_route_main = "SELECT * FROM tbl_route WHERE id='$route'";
                                    $result_route_main = $con->query($sql_route_main);
                                    $row_route_main = $result_route_main->fetch_array();

                                    $sql_route_int = "SELECT * FROM tbl_route_stations WHERE route_id='$route'";
                                    $result_route_int = $con->query($sql_route_int);
                                    
                                    ?> 
                                <div id="station_data" style="width:90%">
                                <div class="form-group row ">
                                    <div class="col-md-1 col-sm-4 ">
                                    </div>
                                    <div class="col-md-3 col-sm-4 ">
                                        <label class="control-label">Station</label>
                                    </div>
                                    <div class="col-md-2 col-sm-4 ">
                                        <label class="control-label">Distance (km)</label>
                                    </div>
                                    <div class="col-md-3 col-sm-4 ">
                                        <label class="control-label">Arrival</label>
                                    </div>
                                    <div class="col-md-3 col-sm-4 ">
                                        <label class="control-label">Departure</label>
                                    </div>
                                </div>
                                
                                
                                <div class="form-group row ">
                                    <div class="col-md-1 col-sm-4 ">
                                        <label class="control-label">Start</label>
                                    </div>
                                    <div class="col-md-3 col-sm-4 ">
                                        <input readonly type="text" style="cursor: not-allowed;" class="form-control" value="<?php  $param = $row_route_main['start_station_id']; echo $obj4->viewStationname($param); ?>" >
                                    </div>
                                    <div class="col-md-2 col-sm-4 ">
                                        <input readonly style="cursor: not-allowed;" type="text" class="form-control"  >
                                    </div>
                                    <div class="col-md-3 col-sm-4 ">
                                        <input readonly style="cursor: not-allowed;" type="text" class="form-control" >
                                    </div>
                                    <div class="col-md-3 col-sm-4 ">
                                    <div class="input-with-tickmark">
                                        <input id="start_st_departure" onchange="validateTime(this);update_time(this,'tbl_schedule','departure','<?php echo $id; ?>','starttick')" name="start_st_departure" type="time" class="form-control" value="<?php if ($id != '') { echo $row_des['departure']; } ?>">
                                        <span style="color:limegreen;display:none;font-size:20px" id="starttick">&#10004;</span>
                                </div>
                                    </div>
                                </div> <br>
                               
                                <?php $nno = 1; while ($row_route_int = $result_route_int->fetch_array()) { 
                                        $int_station_id = $row_route_int['id'];
                                        $sql = "SELECT * FROM tbl_schedule_stations WHERE schedule_id='$id' and int_station_id='$int_station_id'";
                                        $result_int_schedule = $con->query($sql);
                                        $row_int_schedule = $result_int_schedule->fetch_array();
                                    ?>
                                <div class="form-group row ">
                                    <div class="col-md-1 col-sm-4 ">
                                        <label class="control-label">Int</label>
                                    </div>
                                    <div class="col-md-3 col-sm-4 ">
                                        <input readonly style="cursor: not-allowed;" type="text" class="form-control" value="<?php $param = $row_route_int['station_id']; echo $obj4->viewStationname($param); ?>" >
                                    </div>
                                    <div class="col-md-2 col-sm-4 ">
                                        <input readonly style="cursor: not-allowed;" class="form-control" value="<?php echo number_format($row_route_int['distance'],2);  ?>">
                                    </div>
                                    <div class="col-md-3 col-sm-4 "> 
                                        <div class="input-with-tickmark">
                                        <input id="int_st_arrival1" name="int_st_arrival1" onchange="validateTime(this);update_time(this,'tbl_schedule_stations','arrival','<?php echo $row_int_schedule['id']; ?>','inttick_arr<?php echo $nno; ?>')"  type="time" class="form-control" value="<?php if ($id != '') { echo $row_int_schedule['arrival']; } ?>">
                                        <span style="color:limegreen;display:none;font-size:20px"  id="inttick_arr<?php echo $nno; ?>">&#10004;</span>
                                    </div>
                                </div>
                                    <div class="col-md-3 col-sm-4 ">
                                        <div class="input-with-tickmark">
                                        <input id="int_st_departure1" name="int_st_departure1" onchange="validateTime(this);update_time(this,'tbl_schedule_stations','departure','<?php echo $row_int_schedule['id']; ?>','inttick_dep<?php echo $nno; ?>')" type="time" class="form-control" value="<?php if ($id != '') { echo $row_int_schedule['departure']; } ?>">
                                        <span style="color:limegreen;display:none;font-size:20px" id="inttick_dep<?php echo $nno; ?>">&#10004;</span>
                                        </div>
                                    </div>
                                </div> <br>
                                <?php $nno++; } ?>


                                <div class="form-group row ">
                                    <div class="col-md-1 col-sm-4 ">
                                        <label class="control-label">End</label>
                                    </div>
                                    <div class="col-md-3 col-sm-4 ">
                                        <input readonly style="cursor: not-allowed;" type="text" class="form-control" value="<?php  $param = $row_route_main['final_station_id']; echo $obj4->viewStationname($param); ?>" >
                                    </div>
                                    <div class="col-md-2 col-sm-4 ">
                                        <input readonly style="cursor: not-allowed;" type="text" class="form-control" value="<?php echo number_format($row_route_main['total_distance'],2); ?>">
                                    </div>
                                    <div class="col-md-3 col-sm-4 ">
                                        <div class="input-with-tickmark">
                                        <input  id="end_st_arrival" name="end_st_arrival" type="time" onchange="validateTime(this);update_time(this,'tbl_schedule','arrival','<?php echo $id; ?>','endtick')" class="form-control" value="<?php if ($id != '') { echo $row_des['arrival']; } ?>">
                                        <span style="color:limegreen;display:none;font-size:20px"  id="endtick">&#10004;</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-4 ">
                                        <input readonly style="cursor: not-allowed;" type="text" class="form-control" >
                                    </div>
                                </div>
                                </div>
                                <?php } ?>
                                 <br>

                                
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->

<script>

function update_time(element,table,col,id,tickid) {
    // alert(tickid)
    var value = $(element).val()
    $.ajax({
        url: '../controllers/Schedule.php?status=update_time', // Replace with the URL of your PHP controller
        type: 'GET',
        data: {value:value,table:table,col:col,id:id },
        success: function(response) {
            var usernameStat = $('#'+tickid);
                    usernameStat.fadeIn(); // Show the element
                    setTimeout(function() {
                        usernameStat.fadeOut(); // Hide the element
                    }, 1000);
        },
        error: function(xhr, status, error) {
            // Handle the error response from the server
            console.error('Error updating station:', error);
            // Additional error handling or UI updates
        }
    });
}

</script>

<script>
    // Function to check if the entered time has minutes that are multiples of 5
function validateTime(element) {
    var timeValue = $(element).val(); // Get the entered time value
    var timeParts = timeValue.split(':'); // Split the time into hours and minutes

    // Check if minutes are not multiples of 5
    if (timeParts.length === 2 && timeParts[1] % 5 !== 0) {
        // Reset the input value to the nearest lower multiple of 5
        var nearestMultiple = Math.floor(timeParts[1] / 5) * 5;
        timeParts[1] = (nearestMultiple < 10 ? '0' : '') + nearestMultiple; // Pad with leading zero if necessary
        $(element).val(timeParts.join(':')); // Update the input value
    }
}

</script>


<?php include('footer.php') ?>