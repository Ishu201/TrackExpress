<?php include('sidebar.php') ?>

<?php include('header.php') ?>

<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    include('../models/Route_model.php');
    $obj = new Route;
    $result = $obj->viewRouteselected($id);
    $row_des = $result->fetch_array();
} else {
    $id = '';
}
?>

<?php
include('../models/Station_model.php');
$obj = new Station;
$result = $obj->get_all();
$result2 = $obj->get_all();
$result3 = $obj->get_all();
?>

<style>
    .intstations option:disabled {
        color: #a6a6a6; /* Desired background color for disabled options */
        cursor:not-allowed; /* Desired cursor style for disabled options */
    }

</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left"><br>
                <p>Train Details Mgt / Route Register</p>
            </div>
            <a href="train_list.php" class="btn btn-sm btn-info" style="float:right;margin-top:10px;">Route List</a>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><b>Route Details</b></h2>
                        <div class="clearfix">
                            <?php include('session_msg.php') ?>
                        </div>
                    </div>
                    <div class="x_content" style="padding:10px"> <br>
                        <?php if ($id != '') { ?>
                            <form action="../controllers/Route.php?status=update" method="post" data-parsley-validate>
                                <input type="hidden" name="tid" id="tid" value="<?php echo $row_des['id'];  ?>">
                            <?php } else { ?>
                                <form action="../controllers/Route.php?status=add" method="post" data-parsley-validate>
                                <?php } ?>
                                <div class="form-group row ">
                                    <div class="col-md-5 col-sm-6 ">
                                        <label class="control-label"><span>* </span>Route Name</label>
                                        <input id="route_name" name="route_name" type="text" class="form-control" value="<?php if ($id != '') { echo $row_des['route_name']; } ?>" placeholder="Route Name..." data-parsley-trigger="change" required>
                                    </div>
                                    <div class="col-md-3 col-sm-6 ">
                                        <label class="control-label"><span>* </span>Total Distance (Km)</label>
                                        <input id="total_distance" name="total_distance" type="text" class="form-control" value="<?php if ($id != '') { echo $row_des['total_distance']; } ?>" placeholder="Total Distance..." data-parsley-trigger="change" required  pattern="[0-9]+(\.[0-9]+)?">
                                    </div>
                                    <div class="col-md-3 col-sm-6 ">
                                        <label class="control-label"><span>* </span>Total Price</label>
                                        <input id="total_price" name="total_price" type="text" class="form-control" value="<?php if ($id != '') {  echo $row_des['total_price']; } ?>" placeholder="Total Price (Rs)..." data-parsley-trigger="change" required  pattern="[0-9]+(\.[0-9]+)?">
                                    </div>
                                </div> <br>
                                <div class="form-group row">
                                    <div class="col-md-4 col-sm-6 ">
                                        <label class="control-label"><span>*</span> Start Station</label>
                                        <select id="start_station_id" name="start_station_id" class="form-control" required>
                                            <option value="">- select station -</option>
                                            <?php
                                            while ($row_station = $result->fetch_array()) {
                                            ?>
                                                <option <?php if ($id != '') {
                                                            if ($row_des['start_station_id'] == $row_station['id']) {
                                                                echo 'selected';
                                                            }
                                                        } ?> value="<?php echo $row_station['id']; ?>"><?php echo $row_station['name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-4 col-sm-6 ">
                                        <label class="control-label"><span>*</span> Final Station</label>
                                        <select id="final_station_id" name="final_station_id" class="form-control" required>
                                            <option value="">- select station -</option>
                                            <?php
                                            while ($row_station2 = $result2->fetch_array()) {
                                            ?>
                                                <option <?php if ($id != '') {
                                                            if ($row_des['final_station_id'] == $row_station2['id']) {
                                                                echo 'selected';
                                                            }
                                                        } ?> value="<?php echo $row_station2['id']; ?>"><?php echo $row_station2['name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-11 col-sm-12 "><br><br>
                                        <label class="control-label">Special Note</label>
                                        <textarea name="sp_note" id="sp_note" cols="30" rows="4" class="form-control"></textarea>
                                    </div>
                                </div>
                                <br>
                                <div class="ln_solid"></div>
                                <h6><b>Intermediate Stations</b></h6> <br>

                                <div id="intst">
                                    <div class="form-group row">
                                        <div class="col-md-4 col-sm-6">
                                            <label class="control-label"><span>*</span> Station</label>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <label class="control-label"><span>*</span> Distance From Start (Km)</label>
                                        </div>
                                        <div class="col-md-4 col-sm-6">&nbsp;</div>
                                    </div>

                                    <div id="new_stations">
                                        <div class="form-group row">
                                            <div class="col-md-4 col-sm-6">
                                                <select id="station_id_1" name="station_id[]" class="form-control intstations">
                                                    <option value="">- select station -</option>
                                                    <?php
                                                    $sql = "SELECT * FROM tbl_station WHERE status='active' ORDER BY name";
                                                    $result = $con->query($sql);
                                                    while ($row_station2 = $result->fetch_array()) {
                                                    ?>
                                                        <option <?php if ($id != '') {
                                                                    if ($row_des['final_station_id'] == $row_station2['id']) {
                                                                        echo 'selected';
                                                                    }
                                                                } ?> value="<?php echo $row_station2['id']; ?>"><?php echo $row_station2['name']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="col-md-4 col-sm-6">
                                                <input id="distance_1" name="distance[]" type="text" class="form-control" placeholder="Distance Upto the Station..." data-parsley-trigger="change" pattern="[0-9]+(\.[0-9]+)?">
                                            </div>
                                            
                                            <div class="col-md-3 col-sm-6">
                                                <button type="button" class="btn btn-sm btn-danger remove-station">Remove</button>
                                            </div>
                                        </div>
                                    </div> <br>
                                </div>

                                <br>
                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12">
                                        <br>
                                        <button type="button" id="addst" class="btn btn-sm btn-info">Add Station</button>
                                    </div>
                                </div>
                                <input type="text" name="intst_no" id="intst_no" value="1">

                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12 " style="text-align:right">
                                        <button type="reset" class="btn btn-dark">Reset</button>
                                        <button type="submit" class="btn btn-success">Submit</button>
                                    </div>
                                </div>

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
  });

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
});

</script>

<script>
    $(document).ready(function() {
        var stationIndex = 2; // Starting index for additional stations

        // Add Station button click event
        $('#addst').click(function() {
            var newStationDiv = $('#new_stations').find('.form-group').first().clone(); // Clone the first station div
            newStationDiv.find('select').attr('id', 'station_id_' + stationIndex); // Update select ID
            newStationDiv.find('input').attr('id', 'distance_' + stationIndex); // Update input ID
            newStationDiv.find('.remove-station').attr('data-station-index', stationIndex); // Add data attribute for tracking
            newStationDiv.appendTo('#new_stations'); // Append the new station div
            stationIndex++; // Increment the station index
            $('#intst_no').val(parseInt($('#intst_no').val()) + 1); // Increment intst_no value
        });

        // Remove Station button click event
        $(document).on('click', '.remove-station', function() {
            var stationIndex = $(this).data('station-index');
            $('#station_id_' + stationIndex).closest('.form-group').remove(); // Remove the corresponding station div
            $('#intst_no').val(parseInt($('#intst_no').val()) - 1); // Decrement intst_no value
        });
    });
</script>
<?php include('footer.php') ?>