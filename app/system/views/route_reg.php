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
                <p>Train Details Mgt / Route Register</p>
            </div>
            <a href="route_list.php" class="btn btn-sm btn-info" style="float:right;margin-top:10px;">Route List</a>
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
                                        <input id="route_name" name="route_name" type="text" class="form-control" value="<?php if ($id != '') {
                                                                                                                                echo $row_des['route_name'];
                                                                                                                            } ?>" placeholder="Route Name..." data-parsley-trigger="change" required>
                                    </div>
                                    <div class="col-md-3 col-sm-6 ">
                                        <label class="control-label"><span>* </span>Total Distance (Km)</label>
                                        <input id="total_distance" onchange="chk_total_main()" name="total_distance" type="text" class="form-control" value="<?php if ($id != '') {
                                                                                                                                        echo $total_distance = $row_des['total_distance'];
                                                                                                                                    } ?>" placeholder="Total Distance..." data-parsley-trigger="change" required pattern="[0-9]+(\.[0-9]+)?">
                                    </div>
                                </div> <br>
                                
                                <div class="form-group row ">
                                    <div class="col-md-3 col-sm-4 ">
                                        <label class="control-label"><span>* </span>1st Class Price</label>
                                        <input id="total_price_1st" name="total_price_1st" type="text" class="form-control" value="<?php if ($id != '') { echo $row_des['total_price_1st']; } ?>" placeholder="Total Price (Rs)..." data-parsley-trigger="change"  pattern="[0-9]+(\.[0-9]+)?">
                                    </div>
                                    <div class="col-md-3 col-sm-4 ">
                                        <label class="control-label"><span>* </span>2nd Class Price</label>
                                        <input id="total_price_2nd" name="total_price_2nd" type="text" class="form-control" value="<?php if ($id != '') { echo $row_des['total_price_2nd']; } ?>" placeholder="Total Price (Rs)..." data-parsley-trigger="change" required pattern="[0-9]+(\.[0-9]+)?">
                                    </div>
                                    <div class="col-md-3 col-sm-4 ">
                                        <label class="control-label"><span>* </span>3rd Class Price</label>
                                        <input id="total_price_3rd" name="total_price_3rd" type="text" class="form-control" value="<?php if ($id != '') { echo $row_des['total_price_3rd']; } ?>" placeholder="Total Price (Rs)..." data-parsley-trigger="change" required pattern="[0-9]+(\.[0-9]+)?">
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
                                        <textarea name="sp_note" id="sp_note" cols="30" rows="4" class="form-control"><?php if ($id != '') {
                                                                                                                            echo $row_des['sp_note'];
                                                                                                                        } ?></textarea>
                                    </div>
                                </div>
                                <br>
                                <div class="ln_solid"></div>
                                <h6><b>Intermediate Stations</b></h6> <br>

                                <?php 
                                
                                    if ($id != '') {
                                        $sql2 = "SELECT * FROM tbl_route_stations WHERE route_id='$id' and status='active'";
                                        $result2 = $con->query($sql2);
                                        if ($result2->num_rows > 0) {
                                    ?>

                                    <div class="form-group row">
                                        <div class="col-md-3 col-sm-6">
                                            <label class="control-label"><span>*</span> Station</label>
                                        </div>
                                        <div class="col-md-2 col-sm-6">
                                            <label class="control-label"><span>*</span> Distance From Start (Km)</label>
                                        </div>
                                        <div class="col-md-2 col-sm-6">
                                            <label class="control-label"><span>*</span> 1st Class Ticket (Rs)</label>
                                        </div>
                                        <div class="col-md-2 col-sm-6">
                                            <label class="control-label"><span>*</span> 2nd Class Ticket (Rs)</label>
                                        </div>
                                        <div class="col-md-2 col-sm-6">
                                            <label class="control-label"><span>*</span> 3rd Class Ticket (Rs)</label>
                                        </div>
                                    </div>

                                    <?php 
                                    $no = 1;
                                    while ($row_Intermediate = $result2->fetch_array()) {
                                ?>

                                    <div> <br>
                                        <div class="form-group row">
                                            <div class="col-md-3 col-sm-6">
                                                <select id="edit_station_id_<?php echo $no; ?>"  class="form-control intstations" onchange="updateStation('<?php echo $row_Intermediate['id']; ?>','<?php echo $no; ?>')">
                                                    <option value="">- select station -</option>
                                                    <?php
                                                    $sql = "SELECT * FROM tbl_station WHERE status='active' ORDER BY name";
                                                    $result = $con->query($sql);
                                                    while ($row_station2 = $result->fetch_array()) {
                                                    ?>
                                                        <option <?php if ($id != '') {
                                                                    if ($row_Intermediate['station_id'] == $row_station2['id']) {
                                                                        echo 'selected';
                                                                    }
                                                                } ?> value="<?php echo $row_station2['id']; ?>"><?php echo $row_station2['name']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <?php $total_distance = $total_distance - $row_Intermediate['distance']; ?>
                                            <div class="col-md-2 col-sm-6">
                                                <input id="edit_distance_<?php echo $no; ?>"  type="text" class="form-control Idist"  onchange="chk_total_dist(this);updateStation('<?php echo $row_Intermediate['id']; ?>','<?php echo $no; ?>')" value="<?php if ($id != '') { echo $row_Intermediate['distance']; } ?>" placeholder="Distance Upto the Station..." data-parsley-trigger="change" pattern="[0-9]+(\.[0-9]+)?">
                                            </div>
                                            <div class="col-md-2 col-sm-6">
                                                <input id="price_1st<?php echo $no; ?>"  type="text" class="form-control" onchange="updateStation('<?php echo $row_Intermediate['id']; ?>','<?php echo $no; ?>')"  placeholder="Price..." data-parsley-trigger="change" pattern="[0-9]+(\.[0-9]+)?" value="<?php if ($id != '') { echo $row_Intermediate['price_1st']; } ?>">
                                            </div>
                                            <div class="col-md-2 col-sm-6">
                                                <input id="price_2nd<?php echo $no; ?>"  type="text" class="form-control" onchange="updateStation('<?php echo $row_Intermediate['id']; ?>','<?php echo $no; ?>')"  placeholder="Price..." data-parsley-trigger="change" pattern="[0-9]+(\.[0-9]+)?" value="<?php if ($id != '') { echo $row_Intermediate['price_2nd']; } ?>">
                                            </div>
                                            <div class="col-md-2 col-sm-6">
                                                <input id="price_3rd<?php echo $no; ?>"  type="text" class="form-control" onchange="updateStation('<?php echo $row_Intermediate['id']; ?>','<?php echo $no; ?>')"  placeholder="Price..." data-parsley-trigger="change" pattern="[0-9]+(\.[0-9]+)?" value="<?php if ($id != '') { echo $row_Intermediate['price_3rd']; } ?>">
                                            </div>

                                            <div class="col-md-1 col-sm-6">
                                                <button id='edit_remove_<?php echo $no; ?>' type="button" class="btn btn-sm btn-danger remove-station" onclick="remintst('<?php echo $row_Intermediate['id']; ?>','<?php echo $no; ?>')">Remove</button>
                                            </div>

                                            <div id='msg_<?php echo $no; ?>' class="col-md-12 col-sm-6" style="text-align: center;padding-top:5px;display:none">
                                                <label style='color:limegreen'>Station Data Updated ..!!</label>
                                            </div>
                                        </div>
                                    </div> 
                                <?php $no++; }  echo '<br> <hr>'; } ?>
                                    <?php } ?>

                                <div id="intst"> 
                                    <div class="form-group row">
                                        <div class="col-md-3 col-sm-6">
                                            <label class="control-label"><span>*</span> Station</label>
                                        </div>
                                        <div class="col-md-2 col-sm-6">
                                            <label class="control-label"><span>*</span> Distance From Start (Km)</label>
                                        </div>
                                        <div class="col-md-2 col-sm-6">
                                            <label class="control-label"><span>*</span> 1st Class Ticket (Rs)</label>
                                        </div>
                                        <div class="col-md-2 col-sm-6">
                                            <label class="control-label"><span>*</span> 2nd Class Ticket (Rs)</label>
                                        </div>
                                        <div class="col-md-2 col-sm-6">
                                            <label class="control-label"><span>*</span> 3rd Class Ticket (Rs)</label>
                                        </div>
                                    </div>

                                    <div id="new_stations">
                                        <div class="form-group row">
                                            <div class="col-md-3 col-sm-6">
                                                <select id="station_id_1" name="station_id[]" class="form-control intstations">
                                                    <option value="">- select station -</option>
                                                    <?php
                                                    $sql = "SELECT * FROM tbl_station WHERE status='active' ORDER BY name";
                                                    $result = $con->query($sql);
                                                    while ($row_station2 = $result->fetch_array()) {
                                                    ?>
                                                        <option value="<?php echo $row_station2['id']; ?>"><?php echo $row_station2['name']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="col-md-2 col-sm-6">
                                                <input id="distance_1" name="distance[]" onchange="chk_total_dist(this)" type="text" class="form-control Idist" placeholder="To the Station..." data-parsley-trigger="change" pattern="[0-9]+(\.[0-9]+)?">
                                            </div>
                                            <div class="col-md-2 col-sm-6">
                                                <input id="price_1st_1" name="price_1st[]"  type="text" class="form-control"  placeholder="Price..." data-parsley-trigger="change" pattern="[0-9]+(\.[0-9]+)?">
                                            </div>
                                            <div class="col-md-2 col-sm-6">
                                                <input id="price_2nd_1"  name="price_2nd[]"  type="text" class="form-control"  placeholder="Price..." data-parsley-trigger="change" pattern="[0-9]+(\.[0-9]+)?">
                                            </div>
                                            <div class="col-md-2 col-sm-6">
                                                <input id="price_3rd_1" name="price_3rd[]"  type="text" class="form-control"  placeholder="Price..." data-parsley-trigger="change" pattern="[0-9]+(\.[0-9]+)?">
                                            </div>

                                            <div class="col-md-1 col-sm-6">
                                                <button type="button" class="btn btn-sm btn-danger remove-station" style="display:none">Remove</button>
                                            </div>
                                        </div>
                                    </div> <br>
                                </div>

                                <br>
                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12">
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

    function chk_total_dist(element) {

    var total_distance = $('#total_distance').val();
    var distance1Input = $(element).val();

    if(distance1Input == ''){
        distance1Input= 0.00;
    }else{
        distance1Input = parseFloat(distance1Input);
    }

    var intDistInput = 0;

    $('.Idist').each(function() {
        var intDistInput2 = $(this).val();

        if(intDistInput2 == ''){
            intDistInput2 = 0.00;
        }else{
            intDistInput2 = parseFloat(intDistInput2);
        }

        intDistInput += intDistInput2
    });

    // alert(intDistInput)

    if (total_distance < intDistInput) {
        // Show the HTML error message
        alert('Insufficient Distance Value')
        $(element).val(total_distance-(intDistInput-distance1Input))
    } 
}


function chk_total_main() {
var total_distance = $('#total_distance').val();

var intDistInput = 0;

$('.Idist').each(function() {
    var intDistInput2 = $(this).val();

    if(intDistInput2 == ''){
        intDistInput2 = 0.00;
    }else{
        intDistInput2 = parseFloat(intDistInput2);
    }

    intDistInput += intDistInput2
});

// alert(intDistInput)

if (total_distance < intDistInput) {
    // Show the HTML error message
    alert('Insufficient Total Distance')
    $('#total_distance').val(intDistInput)
} 
}
</script>

<script>
    $(document).ready(function() {
  var stationIndex = 2; // Starting index for additional stations

  // Add Station button click event
  $('#addst').click(function() {
    var newStationDiv = $('#new_stations').find('.form-group').first().clone(); // Clone the first station div
    newStationDiv.find('select').attr('id', 'station_id_' + stationIndex).val(''); // Update select ID and empty its value
    newStationDiv.find('input').attr('id', 'distance_' + stationIndex).val(''); // Update input ID and empty its value
    newStationDiv.find('.remove-station').attr('data-station-index', stationIndex).css('display', 'block'); // Add data attribute and set display to block
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
        var price_1st = $("#price_1st"+no).val();
        var price_2nd = $("#price_2nd"+no).val();
        var price_3rd = $("#price_3rd"+no).val();
    $.ajax({
        url: '../controllers/Route.php?status=station', // Replace with the URL of your PHP controller
        type: 'POST',
        data: { station: station, distance: distance, price_1st:price_1st, price_2nd:price_2nd, price_3rd:price_3rd, id:id },
        success: function(response) {
            // Handle the success response from the server

            var messageDiv = $('#msg_'+no);
            messageDiv.fadeIn().delay(1000).fadeOut();
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
        url: '../controllers/Route.php?status=rem_station', // Replace with the URL of your PHP controller
        type: 'POST',
        data: {id:id },
        success: function(response) {
            // Handle the success response from the server
            alert('Station Removed successfully!');
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