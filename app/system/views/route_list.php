<?php include('sidebar.php') ?>

<?php include('header.php') ?>

<?php 
  include('../models/Route_model.php');
  $obj = new Route;
  $result = $obj->get_all();

  include('../models/Station_model.php');
  $obj2 = new Station;

  include('../models/Schedule_model.php');
  $Schedule_obj = new Schedule;
  
?>

<script>
  $(document).ready(function() {
    $("#Train").addClass("active");
    $("#Trainmenu").attr("style", "display: block;");
    $("#route_reg").addClass("current-page");
  });
</script>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left"><br>
        <p>Train Details Mgt / Route List</p>
        </div>
        <a href="Route_reg.php" class="btn btn-sm btn-info" style="float:right;margin-top:10px;">Route Register</a>
   </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
          <div class="x_title">
            <h2><b>Route List</b></h2>
            <div class="clearfix">
            <?php include('session_msg.php') ?>
            </div>
          </div>
          <div class="x_content" id="table-container">
            <table id="datatable" class="table table-bordered" style="width:100%">
              <thead>
                <tr>
                  <th>Route Name</th>
                  <th style="text-align:center">Start Station</th>
                  <th style="text-align:center">End Station</th>
                  <th style="text-align:center">Distance</th>
                  <th style="text-align:center">1st Class</th>
                  <th style="text-align:center">2nd Class</th>
                  <th style="text-align:center">3rd Class</th>
                  <th style="text-align:center">Intermediate Stations</th>
                  <th style="text-align:right">Action</th>
                </tr>
              </thead>
              <tbody>
              <?php
                while ($row_des = $result->fetch_array()) {
                  ?>
                <tr>
                  <td><?php echo $row_des['route_name']; ?></td>
                  <td style="text-align:center">
                    <?php 
                    $start_station_id = $row_des['start_station_id'];
                    $start_station = $obj2->viewStationselected($start_station_id);
                    $row_start_station = $start_station->fetch_array();
                    echo $row_start_station['name'];
                    ?>
                  </td>
                  <td style="text-align:center">
                    <?php 
                    $final_station_id = $row_des['final_station_id'];
                    $final_station = $obj2->viewStationselected($final_station_id);
                    $row_final_station = $final_station->fetch_array();
                    echo $row_final_station['name'];
                    ?>
                  </td>
                  <td style="text-align:right"><?php echo $row_des['total_distance']; ?>km</td>
                  <td style="text-align:right">Rs.<?php if($row_des['total_price_1st'] == ''){ $total_price_1st = '0'; }else{ $total_price_1st = $row_des['total_price_1st']; } echo number_format($total_price_1st,2); ?></td>
                  <td style="text-align:right">Rs.<?php if($row_des['total_price_2nd'] == ''){ $total_price_2nd = '0'; }else{ $total_price_2nd = $row_des['total_price_2nd']; } echo number_format($total_price_2nd,2); ?></td>
                  <td style="text-align:right">Rs.<?php if($row_des['total_price_3rd'] == ''){ $total_price_3rd = '0'; }else{ $total_price_3rd = $row_des['total_price_3rd']; } echo number_format($total_price_3rd,2); ?></td>
                  <td style="text-align:right">
                  <?php 
                  $interst = $obj->view_total_intst($row_des['id']);
                  $output = '';
                    while ($row_int = $interst->fetch_array()) {
                        $output .= $row_int['name'] . ', ';
                    }
                    $output = rtrim($output, ', '); // Remove the trailing comma and space
                    echo $output;
                  ?>
                  </td>
                  <td style="text-align:right">
                    <button onclick="window.location.href = 'Route_reg.php?id=<?php echo $row_des['id']; ?>';" class="btn btn-sm btn-success editbtn">Edit</button>
                    <button <?php if($Schedule_obj->route_available($row_des['id']) > 0){ ?>  data-toggle="tooltip" data-placement="left" title="Remove the Train Schedules associated with this route first" style='background-color:#ff8080 !important'<?php } else{  ?> onclick="confirmRemove('../controllers/Route.php?status=remove&id=<?php echo $row_des['id']; ?>');" <?php } ?> class="btn btn-sm btn-danger removebtn">Remove</button>
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
<!-- /page content -->

<?php include('footer.php') ?>