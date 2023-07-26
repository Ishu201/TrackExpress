<?php
include '../controllers/db_connect.php';
$ob = new dbconnection();
$con = $ob->connection();

$date = $_GET['date'];
$start = $_GET['start_location'];
$end = $_GET['final_location'];

$timestamp = strtotime($date);
$dayInWords = date("l", $timestamp);

include('../models/Timetable_model.php');
$Timetable_obj = new Timetable;

$start_st_name = $Timetable_obj->station_single($start);
$end_st_name = $Timetable_obj->station_single($end);

?>

<style>
    h1 {
        font-size: 20px;
        text-align: center;
        margin-top: 40px;
        margin-bottom: 20px;
    }

    .panel-default>.panel-heading {
        background-color: #ffffff;
        color: rgba(0, 0, 0, .40);
        padding: 15px;

    }

    .panel {
        box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, .40);
    }

    .panel-group .panel {
        margin-bottom: 20px;
    }

    .panel-title {
        font-size: 18px;
    }

    .panel-title a,
    .panel-title a:hover,
    .panel-title a:focus {
        text-decoration: none;
    }

    .panel-body p {
        font-size: 16px;
        padding: 15px;
        color: #2B2E2E !important;
    }

    td {
        color: #2B2E2E
    }
</style>

<div class="x_content" id="table-container">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true" style="margin-top: 40px;">
                    <h5><b><?php echo $start_st_name; ?> to <?php echo $end_st_name; ?></b></h5>
                    <h5>Train (Railway) schedule</h5>
                    <h6>Date : <?php echo $date; ?></h6> <br>

                    <?php
                    $sql_daily_record = "SELECT * FROM tbl_daily_trains WHERE date='$date' and status='active'";
                    $result_daily_record = $con->query($sql_daily_record);
                    $rowno = 1;
                    $count = 0;
                    while ($row_daily_record = $result_daily_record->fetch_array()) {
                        $MAINID = $row_daily_record['id'];
                        $schedule_id = $row_daily_record['schedule_id'];
                        $booked_seats = $row_daily_record['booked_seats'];

                        $sql_schedule_record = "SELECT * FROM tbl_schedule WHERE id='$schedule_id'";
                        $result_schedule_record = $con->query($sql_schedule_record);
                        $row_schedule_record = $result_schedule_record->fetch_array();
                        $train_id = $row_schedule_record['train_id'];
                        $route_id = $row_schedule_record['route_id'];

                        $departure = $row_schedule_record['departure'];
                        $arrival = $row_schedule_record['arrival'];
                        $twelveHourTime = date("h:i A", strtotime($departure));

                        $sql_train_record = "SELECT * FROM tbl_train WHERE id='$train_id'";
                        $result_train_record = $con->query($sql_train_record);
                        $row_train_record = $result_train_record->fetch_array();
                        $train_name = $row_train_record['name'];
                        $train_type = $row_train_record['type'];

                        $sum_seats = (!empty($row_train_record['mclass_1']) ? $row_train_record['mclass_1'] : 0) +
                            (!empty($row_train_record['mclass_2']) ? $row_train_record['mclass_2'] : 0) +
                            (!empty($row_train_record['mclass_3']) ? $row_train_record['mclass_3'] : 0) +
                            (!empty($row_train_record['wclass_1']) ? $row_train_record['wclass_1'] : 0) +
                            (!empty($row_train_record['wclass_2']) ? $row_train_record['wclass_2'] : 0) +
                            (!empty($row_train_record['wclass_3']) ? $row_train_record['wclass_3'] : 0);

                        $sql_route_record = "SELECT * FROM tbl_route WHERE id='$route_id'";
                        $result_route_record = $con->query($sql_route_record);
                        $row_route_record = $result_route_record->fetch_array();
                        $route_name = $row_route_record['route_name'];
                        $start_station_id = $row_route_record['start_station_id'];
                        $final_station_id = $row_route_record['final_station_id'];

                        //start station
                        $sql_startname_record = "SELECT * FROM tbl_station WHERE id='$start_station_id'";
                        $result_startname_record = $con->query($sql_startname_record);
                        $row_startname_record = $result_startname_record->fetch_array();
                        $start_station_name = $row_startname_record['name'];

                        //end station
                        $sql_endname_record = "SELECT * FROM tbl_station WHERE id='$final_station_id'";
                        $result_endname_record = $con->query($sql_endname_record);
                        $row_endname_record = $result_endname_record->fetch_array();
                        $end_station_name = $row_endname_record['name'];


                        $sql_route_in_record = "SELECT * FROM tbl_route_stations WHERE route_id='$route_id' and (station_id='$start' or station_id='$end')";
                        $result_route_in_record = $con->query($sql_route_in_record);
                        $row_route_in_chk = mysqli_num_rows($result_route_in_record);
                        if ($row_route_in_chk > 0) {
                            $int_stat = 'yes';
                            $sql_route_in_record;
                        } else {
                            $int_stat = 'no';
                        }

                        if (($start == $start_station_id) and ($end == $final_station_id)) {
                            $org_stat = 'yes';
                        } else if (($start == $start_station_id) or ($end == $final_station_id)) {
                            $org_stat = 'no';
                        } else {
                            $org_stat = 'null';
                        }

                        if ((($int_stat == 'yes') and ($org_stat == 'no')) or (($int_stat == 'no') and ($org_stat == 'yes'))) {
                            $count = 1;
                    ?>
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingOne">
                                    <h5 class="panel-title" style="font-size:15px">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne<?php echo $rowno; ?>" aria-expanded="true" aria-controls="collapseOne<?php echo $rowno; ?>">
                                            <b><?php echo $route_name; ?> - <?php echo $twelveHourTime; ?> &nbsp; &nbsp; <i class="fas fa-caret-down"></i></b>
                                        </a>
                                    </h5>
                                </div>
                                <div style="border-top:1px solid gray;background-color:#cccccc" id="collapseOne<?php echo $rowno; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                    <div class="panel-body" style="padding-left: 20px;padding-right: 20px;padding-top:10px">
                                        <table style="width:100%">
                                            <tbody>
                                                <tr>
                                                    <td style="width:30%">Start Station</td>
                                                    <td><?php echo $start_station_name; ?></td>
                                                    <td style="text-align:right"><a href="booking.php?id=<?php echo $MAINID; ?>" class="btn btn-info" style="color:whitesmoke">Book the Train</a></td>
                                                </tr>

                                                <tr>
                                                    <td>Departure Time</td>
                                                    <td colspan="2"><?php echo $departure; ?>:00</td>
                                                </tr>

                                                <?php
                                                if ($row_route_in_chk > 0) {
                                                    while ($row_int_stations = $result_route_in_record->fetch_array()) {
                                                        $station_id_int = $row_int_stations['station_id'];
                                                        $station_id = $row_int_stations['id'];
                                                        //station name
                                                        $sql_intst_record = "SELECT * FROM tbl_station WHERE id='$station_id_int'";
                                                        $result_intst_record = $con->query($sql_intst_record);
                                                        $row_intst_record = $result_intst_record->fetch_array();
                                                        $int_station_name = $row_intst_record['name'];

                                                        //station time
                                                        $sql_intst_record2 = "SELECT * FROM tbl_schedule_stations WHERE schedule_id='$schedule_id' and int_station_id='$station_id'";
                                                        $result_intst_record2 = $con->query($sql_intst_record2);
                                                        $row_intst_record2 = $result_intst_record2->fetch_array();
                                                        $int_station_arrival = $row_intst_record2['arrival'];
                                                ?>
                                                        <tr>
                                                            <td>Arrival to <?php echo $int_station_name; ?></td>
                                                            <td colspan="2"><?php echo $int_station_arrival; ?>:00</td>
                                                        </tr>
                                                <?php }
                                                } ?>

                                                <tr>
                                                    <td>Final Station</td>
                                                    <td colspan="2"><?php echo $end_station_name; ?></td>
                                                </tr>

                                                <tr>
                                                    <td>Arrival at Final Station</td>
                                                    <td colspan="2"><?php echo $arrival; ?>:00</td>
                                                </tr>

                                                <tr>
                                                    <td>Train</td>
                                                    <td colspan="2" style="text-transform:capitalize"><?php echo $train_name ?> - <?php echo $train_type ?></td>
                                                </tr>

                                                <tr>
                                                    <td>Available Classes</td>
                                                    <td colspan="2">
                                                        <?php if ($row_train_record['mclass_1'] > 0) { ?>
                                                        <span style="background-color:#4E2419;padding:5px;color:white;font-size:10px">General Class</span>
                                                        <?php } ?>
                                                        <?php if ($row_train_record['mclass_2'] > 0) { ?>
                                                        <span style="background-color:#2A431B;padding:5px;color:white;font-size:10px">Standard Class</span>
                                                        <?php } ?>
                                                        <?php if ($row_train_record['mclass_3'] > 0) { ?>
                                                        <span style="background-color:#BE252A;padding:5px;color:white;font-size:10px">First Class</span>
                                                        <?php } ?>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>Available Seats</td>
                                                    <td colspan="2">
                                                        <?php echo $sum_seats - $booked_seats ?> / <?php echo $sum_seats; ?>
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                    <br>
                                </div>
                            </div>
                        <?php } ?>
                    <?php
                        $rowno++;
                    } ?>

                    <?php if ($count == 0) {  ?>
                        <center>
                            <p style='color:#B30F00'>We are Sorry... No train Schedules for your Search..</p>
                        </center>
                    <?php } ?>
                </div>
            </div>

        </div>
    </div>

</div>