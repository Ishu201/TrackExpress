<?php include('sidebar.php') ?>

<?php include('header.php') ?>

<?php 
  include('../models/Train_model.php');
  $obj = new Train;
  $result = $obj->get_all();
?>

<script>
  $(document).ready(function() {
    $("#Train").addClass("active");
    $("#Trainmenu").attr("style", "display: block;");
    $("#train_reg").addClass("current-page");
  });
</script>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left"><br>
        <p>Train Details Mgt / Train List</p>
        </div>
        <a href="train_reg.php" class="btn btn-sm btn-info" style="float:right;margin-top:10px;">Train Register</a>
   </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
          <div class="x_title">
            <h2><b>Train List</b></h2>
            <div class="clearfix">
            <?php include('session_msg.php') ?>
            </div>
          </div>
          <div class="x_content" id="table-container">
            <table id="datatable" class="table table-bordered" style="width:100%">
              <thead>
                <tr>
                  <th>Train Name</th>
                  <th>Code</th>
                  <th>Type</th>
                  <th>GPS Link</th>
                  <th>1st Class St</th>
                  <th>2nd Class St</th>
                  <th>3rd Class St</th>
                  <th style="text-align:right">Action</th>
                </tr>
              </thead>
              <tbody>
              <?php
                while ($row_des = $result->fetch_array()) {
                  ?>
                <tr>
                  <td><?php echo $row_des['name']; ?></td>
                  <td><?php echo $row_des['code']; ?></td>
                  <td><?php echo $row_des['type']; ?></td>
                  <td><?php echo $row_des['gps_link']; ?></td>
                  <td><?php echo $row_des['class_1']; ?></td>
                  <td><?php echo $row_des['class_2']; ?></td>
                  <td><?php echo $row_des['class_3']; ?></td>
                  <td style="text-align:right">
                    <button onclick="window.location.href = 'train_reg.php?id=<?php echo $row_des['id']; ?>';" class="btn btn-sm btn-success editbtn">Edit</button>
                    <button onclick="confirmRemove('../controllers/Train.php?status=remove&id=<?php echo $row_des['id']; ?>');" class="btn btn-sm btn-danger removebtn">Remove</button>
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