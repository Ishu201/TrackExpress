<?php include('sidebar.php') ?>

<?php include('header.php') ?>

<?php
if(isset($_GET['id'])){
    $id = $_GET['id'];

    include('../models/Station_model.php');
    $obj = new Station;
    $result = $obj->viewStationselected($id);
    $row_des = $result->fetch_array();
} else{
    $id = '';
}
?>

<!-- page content -->
<div class="right_col" role="main">
    <div class=""> 
        <div class="page-title"> 
            <div class="title_left"><br>
                <p>Station Details Mgt / Station Register</p>
            </div>
            <a href="station_list.php" class="btn btn-sm btn-info" style="float:right;margin-top:10px;">Station List</a>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><b>Station Details</b></h2>
                        <div class="clearfix">
            <?php include('session_msg.php') ?>
            </div>
                    </div>
                    <div class="x_content" style="padding:10px"> <br>
                    <?php  if($id != ''){ ?>
                        <form action="../controllers/Station.php?status=update" method="post"  data-parsley-validate>
                            <input type="hidden" name="tid" id="tid" value="<?php  echo $row_des['id'];  ?>">
                      <?php }else{ ?>
                        <form action="../controllers/Station.php?status=add" method="post"  data-parsley-validate>
                        <?php } ?>
                            <div class="form-group row ">
                                <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label"><span>*</span> Name</label>
                                    <input id="name" name="name" type="text" class="form-control" value="<?php  if($id != ''){ echo $row_des['name']; } ?>" placeholder="Name of the Station" data-parsley-trigger="change" required >
                                </div>
                                <div class="col-md-4 col-sm-6 ">
                                    <label class="control-label"><span>*</span> Station Type</label>
                                    <select id="type" name="type"  class="form-control" required >
                                        <option <?php  if($id != ''){ if($row_des['type'] == '') { echo 'selected'; } } ?> value=""> -Choose option- </option>
                                        <option <?php  if($id != ''){ if($row_des['type'] == 'Main Station') { echo 'selected'; } } ?> value="Main Station">Main Station</option>
                                        <option <?php  if($id != ''){ if($row_des['type'] == 'Sub Station') { echo 'selected'; } } ?> value="Sub Station">Sub Station</option>
                                    </select>
                                </div>
                            </div> <br>
                            
                            <div class="ln_solid"></div>
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


<?php include('footer.php') ?>