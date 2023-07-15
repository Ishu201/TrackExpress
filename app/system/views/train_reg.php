<?php include('sidebar.php') ?>

<?php include('header.php') ?>

<?php
if(isset($_GET['id'])){
    $id = $_GET['id'];

    include('../models/Train_model.php');
    $obj = new Train;
    $result = $obj->viewTrainselected($id);
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
                <p>Train Details Mgt / Train Details Register</p>
            </div>
            <a href="train_list.php" class="btn btn-sm btn-info" style="float:right;margin-top:10px;">Train List</a>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><b>Train Details</b></h2>
                        <div class="clearfix">
            <?php include('session_msg.php') ?>
            </div>
                    </div>
                    <div class="x_content" style="padding:10px"> <br>
                    <?php  if($id != ''){ ?>
                        <form action="../controllers/Train.php?status=update" method="post"  data-parsley-validate>
                            <input type="hidden" name="tid" id="tid" value="<?php  echo $row_des['id'];  ?>">
                      <?php }else{ ?>
                        <form action="../controllers/Train.php?status=add" method="post"  data-parsley-validate>
                        <?php } ?>
                            <div class="form-group row ">
                                <div class="col-md-4 col-sm-6 ">
                                    <label class="control-label"><span>*</span> Code</label>
                                    <input id="code" name="code" type="text" class="form-control" value="<?php  if($id != ''){ echo $row_des['code']; } ?>" placeholder="Train Code" data-parsley-trigger="change" required >
                                </div>
                                <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label"><span>*</span> Name</label>
                                    <input id="name" name="name" type="text" class="form-control" value="<?php  if($id != ''){ echo $row_des['name']; } ?>" placeholder="Name of the Train" data-parsley-trigger="change" required >
                                </div>
                            </div> <br>
                            <div class="form-group row">
                            <div class="col-md-5 col-sm-6 ">
                                    <label class="control-label">GPS Device Link</label>
                                    <input id="gps_link" name="gps_link" type="text" class="form-control" value="<?php  if($id != ''){ echo $row_des['gps_link']; } ?>" placeholder="Tracking GPS"  >
                                </div>
                                <div class="col-md-4 col-sm-6 ">
                                    <label class="control-label"><span>*</span> Train Type</label>
                                    <select id="type" name="type"  class="form-control" required >
                                        <option <?php  if($id != ''){ if($row_des['type'] == '') { echo 'selected'; } } ?> value=""> -Choose option- </option>
                                        <option <?php  if($id != ''){ if($row_des['type'] == 'express') { echo 'selected'; } } ?> value="express">Express Train</option>
                                        <option <?php  if($id != ''){ if($row_des['type'] == 'intercity') { echo 'selected'; } } ?> value="intercity">Intercity</option>
                                        <option <?php  if($id != ''){ if($row_des['type'] == 'ac') { echo 'selected'; } } ?> value="ac">A.C. Intercity</option>
                                        <option <?php  if($id != ''){ if($row_des['type'] == 'cc') { echo 'selected'; } } ?> value="cc">Colombo Commuter</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label class="col-md-3 col-sm-3  control-label" style="font-size:16px">
                                    <br><br>Select Train Seats
                                    <br>
                                    <small class="text-navy" style="font-size:13px">Relavant to Class</small>
                                </label>

                                <div class="col-md-2 col-sm-2 "> <br><br>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox"  name='train_class1' checked readonly class="flat" >&nbsp;  1st Class
                                        </label>
                                    </div>
                                    <br>
                                    <div class="checkbox" style="margin-top:10px">
                                        <label> 
                                            <input type="checkbox" name='train_class2' checked  readonly class="flat" > &nbsp; 2nd Class
                                        </label>
                                    </div>
                                    <br>
                                    <div class="checkbox" style="margin-top:10px">
                                        <label> 
                                            <input type="checkbox" name='train_class3' checked  readonly class="flat" > &nbsp; 3rd Class
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-9 "><br><br>
                                    <input  id="class_1" name="class_1" type="number" class="form-control" required min='1' placeholder="No of Seats"  value="<?php  if($id != ''){ echo $row_des['class_1']; } ?>">
                                    
                                    <input style="margin-top:15px"  id="class_2" name="class_2" type="number" class="form-control" required min='1' placeholder="No of Seats"  value="<?php  if($id != ''){ echo $row_des['class_2']; } ?>">
                                    
                                    <input style="margin-top:15px"  id="class_3" name="class_3" type="number" class="form-control" required min='1' placeholder="No of Seats" value="<?php  if($id != ''){ echo $row_des['class_3']; } ?>" >
                                </div>
                            </div>
                            

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