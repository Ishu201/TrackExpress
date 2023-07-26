<?php
include '../controllers/db_connect.php';
$ob = new dbconnection();
$con = $ob->connection();

$day = $_GET['day'];

  include('../models/Schedule_model.php');
  $Schedule_obj = new Schedule;
  $schedule = $Schedule_obj->get_all($day);

  include('../models/Route_model.php');
  $route_obj = new Route;

  include('../models/Station_model.php');
  $station_obj = new Station;

  include('../models/Train_model.php');
  $train_obj = new Train;
?>



<div class="x_content" id="table-container">
            <table id="datatable" class="table table-bordered" style="width:100%">
              <thead>
                <tr>
                  <th>Route Name</th>
                  <th>Train</th>
                  <th style="text-align:center">Start Station</th>
                  <th style="text-align:center">Departure</th>
                  <th style="text-align:center">End Station</th>
                  <th style="text-align:center">Arrival</th>
                  <th style="text-align:center">Distance</th>
                  <th style="text-align:center">Intermediate Stations</th>
                  <th style="text-align:center">Passangers</th>
                  <th style="text-align:right">Action</th>
                </tr>
              </thead>
              <tbody>
              <?php
              
              if($schedule->num_rows > 0){ 
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
                    if($train_id != '0'){
                      $train = $train_obj->viewTrainselected($train_id);
                      $row_train = $train->fetch_array();
                      echo $row_train['name'];
                    }else{
                      echo '-';
                    }

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
                            echo $sum = (!empty($row_train['mclass_1']) ? $row_train['mclass_1'] : 0) +
                                        (!empty($row_train['mclass_2']) ? $row_train['mclass_2'] : 0) +
                                        (!empty($row_train['mclass_3']) ? $row_train['mclass_3'] : 0)+
                                        (!empty($row_train['wclass_1']) ? $row_train['wclass_1'] : 0) +
                                        (!empty($row_train['wclass_2']) ? $row_train['wclass_2'] : 0) +
                                        (!empty($row_train['wclass_3']) ? $row_train['wclass_3'] : 0);
                     
                        ?>
                    </td>
                    <td style="text-align:right">
                        <button onclick="window.location.href = 'schedule_trains.php?id=<?php echo $row_des['id']; ?>';" class="btn btn-sm btn-success editbtn">Edit</button>
                        <?php if ($row_des['status'] == 'active') { ?>
                            <button onclick="confirmRemove2('../controllers/Schedule.php','deactivate','<?php echo $row_des['id']; ?>','no');" class="btn btn-sm btn-warning">Deactivate</button>
                        <?php }else { ?>
                            <button onclick="confirmRemove2('../controllers/Schedule.php','deactivate','<?php echo $row_des['id']; ?>','active');" class="btn btn-sm btn-info">Activate</button>
                        <?php } ?>
                    </td>
                </tr>
              <?php } }else{ ?>
                <tr>
                  <th style="text-align:right" colspan="10">There is No record for this Day..</th>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>