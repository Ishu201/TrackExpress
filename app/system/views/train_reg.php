<?php include('sidebar.php') ?>

<?php include('header.php') ?>

<?php
include('../models/Train_model.php');
$obj = new Train;
$codeNo = $obj->get_max();
                      
if(isset($_GET['id'])){
    $id = $_GET['id'];
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
                <p>Train Details Mgt / Train Register</p>
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
                                    <input id="code" name="code" type="text" readonly class="form-control" value="<?php  if($id != ''){ echo $row_des['code']; } else{ echo $codeNo;} ?>" placeholder="Train Code" data-parsley-trigger="change" required >
                                </div>
                                <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label"><span>*</span> Name</label>
                                    <input id="name" name="name" type="text" class="form-control" value="<?php  if($id != ''){ echo $row_des['name']; } ?>" placeholder="Name of the Train" data-parsley-trigger="change" required >
                                </div>
                            </div> <br>
                            <div class="form-group row">
                            <div class="col-md-5 col-sm-6 ">
                                    <label class="control-label"><span>*</span> Spped in kmh<sup>-1</sup></label>
                                    <input id="speed" name="speed" required type="text" class="form-control" value="<?php  if($id != ''){ echo $row_des['speed']; } ?>" placeholder="Train Average speed"  pattern="[0-9]+(\.[0-9]+)?">
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
                            <br><br>

                            <div class="form-group row" >
                                <label class="col-md-3 col-sm-3  control-label" style="font-size:16px">
                                    <br><br>Select Train Seats
                                    <br>
                                    <small class="text-navy" style="font-size:13px">Relavant to Class</small>
                                </label>

                                <div class="col-md-2 col-sm-2 "> <br><br><br>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox"  name='train_class1' checked readonly class="flat" >&nbsp;  First Class
                                        </label>
                                    </div>
                                    <br>
                                    <div class="checkbox" style="margin-top:10px">
                                        <label> 
                                            <input type="checkbox" name='train_class2' checked  readonly class="flat" > &nbsp; Standard Class
                                        </label>
                                    </div>
                                    <br>
                                    <div class="checkbox" style="margin-top:10px">
                                        <label> 
                                            <input type="checkbox" name='train_class3' checked  readonly class="flat" > &nbsp; General Class
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="col-md-2 col-sm-9" style="padding:0px"><br> Window Seats<br><br>
                                    <input  id="wclass_1" name="wclass_1" type="number" class="form-control" required min='1' placeholder="No of Seats" oninput="updateTotalSeats('1')"  value="<?php  if($id != ''){ echo $row_des['wclass_1']; } ?>">
                                    
                                    <input style="margin-top:15px"  id="wclass_2" name="wclass_2" type="number" class="form-control" required min='1' oninput="updateTotalSeats('2')" placeholder="No of Seats"  value="<?php  if($id != ''){ echo $row_des['wclass_2']; } ?>">
                                    
                                    <input style="margin-top:15px"  id="wclass_3" name="wclass_3" type="number" class="form-control" required min='1' oninput="updateTotalSeats('3')" placeholder="No of Seats" value="<?php  if($id != ''){ echo $row_des['wclass_3']; } ?>" >
                                </div>

                                <div class="col-md-2 col-sm-9 "><br> Middle Seats<br><br>
                                    <input  id="mclass_1" name="mclass_1" type="number" class="form-control" required min='1' placeholder="No of Seats" oninput="updateTotalSeats('1')"  value="<?php  if($id != ''){ echo $row_des['mclass_1']; } ?>">
                                    
                                    <input style="margin-top:15px"  id="mclass_2" name="mclass_2" type="number" class="form-control" required min='1' oninput="updateTotalSeats('2')" placeholder="No of Seats"  value="<?php  if($id != ''){ echo $row_des['mclass_2']; } ?>">
                                    
                                    <input style="margin-top:15px"  id="mclass_3" name="mclass_3" type="number" class="form-control" required min='1' oninput="updateTotalSeats('3')" placeholder="No of Seats" value="<?php  if($id != ''){ echo $row_des['mclass_3']; } ?>" >
                                </div>

                                <div class="col-md-2 col-sm-9 "><br> Total Seats<br><br>
                                    <input  id="total_seats1" name="total_seats1" type="number" class="form-control" required  placeholder="Total Seats"  readonly>
                                    
                                    <input style="margin-top:15px"  id="total_seats2" name="total_seats2" type="number" required class="form-control"  placeholder="Total Seats"  readonly>
                                    
                                    <input style="margin-top:15px"  id="total_seats3" name="total_seats3" type="number"required  class="form-control"  placeholder="Total Seats" readonly>

                                    <input style="margin-top:15px"  id="total" name="total" type="number"required  class="form-control"  placeholder="Final Total Seats" readonly>
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

<script>
    $(document).ready(function() {
            updateTotalSeats('1');
            updateTotalSeats('2');
            updateTotalSeats('3');

    });
function updateTotalSeats(classNumber) {
  var wclass = parseInt(document.getElementById('wclass_' + classNumber).value);
  var mclass = parseInt(document.getElementById('mclass_' + classNumber).value);

  // Calculate the total seats for the given class number
  var totalSeats = wclass + mclass;

  // Update the corresponding total seats input field
  document.getElementById('total_seats' + classNumber).value = totalSeats;
  calculateTotal()
}
</script>

<script>
function calculateTotal() {
  var totalSeats1 = parseInt(document.getElementById('total_seats1').value) || 0;
  var totalSeats2 = parseInt(document.getElementById('total_seats2').value) || 0;
  var totalSeats3 = parseInt(document.getElementById('total_seats3').value) || 0;

  // Calculate the final total seats by adding the values from the three inputs
  var finalTotalSeats = totalSeats1 + totalSeats2 + totalSeats3;

  // Update the "Final Total Seats" input field
  document.getElementById('total').value = finalTotalSeats;
}
</script>


<?php include('footer.php') ?>


