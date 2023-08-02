<?php include('sidebar.php') ?>

<?php include('header.php') ?>

<?php 
  include('../models/Station_model.php');
  $obj = new Station;
  $result = $obj->get_all();
?>

<script>
  $(document).ready(function() {
    $("#Train").addClass("active");
    $("#Trainmenu").attr("style", "display: block;");
    $("#station_reg").addClass("current-page");
  });
</script>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left"><br>
        <p>Train Details Mgt / Station List</p>
        </div>
        <a href="station_reg.php" class="btn btn-sm btn-info" style="float:right;margin-top:10px;">Station Register</a>
   </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
          <div class="x_title">
            <h2><b>Station List</b></h2>
            <div class="clearfix">
            <?php include('session_msg.php') ?>
            </div>
          </div>
          <div class="x_content">
            <table id="datatable" class="table table-bordered" style="width:100%">
              <thead>
                <tr>
                  <th>Station Name</th>
                  <th>Type</th>
                  <th>Contact Mail</th>
                  <th>User Account</th>
                  <th style="text-align:right">Action</th>
                </tr>
              </thead>
              <tbody>
              <?php
                while ($row_des = $result->fetch_array()) {
                  $result2 = $obj->viewStation_user($row_des['id']);
                  $row_user = $result2->fetch_array();
                  ?>
                <tr>
                  <td><?php echo $row_des['name']; ?></td>
                  <td><?php echo $row_des['type']; ?></td>
                  <td><?php echo $row_des['contact']; ?></td>
                  <td style="text-transform:capitalize;text-align:center"><span style="cursor: pointer;" data-toggle="tooltip" data-placement="left" <?php if($row_des['user'] == 'yes'){ ?>title="  <?php echo $row_user['username']; ?>  " <?php } ?>><?php echo $row_des['user']; ?></span></td>
                  <td style="text-align:right">
                    <button onclick="window.location.href = 'station_reg.php?id=<?php echo $row_des['id']; ?>';" class="btn btn-sm btn-success editbtn">Edit</button>
                    <button disabled onclick="confirmRemove('../controllers/Station.php?status=remove&id=<?php echo $row_des['id']; ?>');" class="btn btn-sm btn-danger removebtn">Remove</button>
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