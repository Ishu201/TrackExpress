
<?php include('sidebar.php') ?>
            
<?php include('header.php') ?>

<?php 
  include('../models/Booking_model.php');
  $obj = new Booking;

  $date = date('Y-m-d');
  // $date = '2023-07-30';
  $result = $obj->get_all_by_date($date);
 $count = mysqli_num_rows($result);
 
?> 

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
          <div class="page-title"> 
            <div class="title_left"><br>
                <p>Ticket Booking Mgt / Booking Hostory</p>
            </div>
            <!-- <a href="train_list.php" class="btn btn-sm btn-info" style="float:right;margin-top:10px;">Train List</a> -->
        </div>

        <div class="clearfix">
            <?php include('session_msg.php') ?>
            </div>
            
            <div class="row">
              <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                  <div class="x_title">
                  <h2><b>Booking Details <?php echo date('Y-m-d') ?></b></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  <div class="row">
                      <div class="col-sm-12">
                        <div class="card-box table-responsive">
                        <table id="datatable" class="table table-bordered" style="width:100%">
                            <thead>
                              <tr>
                                <th>Booking ID</th>
                                <th>Route</th>
                                <th>Train</th>
                                <th>Customer Mail</th>
                                <th>Booked Seats</th>
                                <th>Seat Option</th>
                                <th>Bonus</th>
                                <th>Total Amount(Rs.)</th>
                              </tr>
                            </thead>
                            <tbody>
                            <?php
                            
                            if ($count > 0) {
                            while ($row_des = $result->fetch_array()) {
                              $book_id = $row_des['mainID'];
                               $bookid = str_pad($book_id, 5, "0", STR_PAD_LEFT);
                              echo "SELECT * FROM temp_booking_details WHERE booking_id='$book_id'";
                              $result2 = $obj->get_all_by_temp($book_id);
                              $row_data = $result2->fetch_array();
                              $customerid = $row_data['customer_id'];
                              $class = $row_data['class'];
                              $seat = $row_data['seat'];

                              if ($class == '1') {
                                  $classname = 'First Class';
                              }else if($class == '2'){
                                  $classname = 'Standard';
                              }else{
                                  $classname = 'General Class';
                              }
                              
                              if ($seat == 'w') {
                                  $seatname = 'Window Seat';
                              }else{
                                  $seatname = 'Middle Seat';
                              }
                              
                              ?>
                              <tr>
                                <td><?php echo $bookid; ?></td>
                                <td><?php echo $row_data['train']; ?></td>
                                <td><?php echo $row_data['train_name']; ?></td>
                                <td><?php echo $row_data['customer_name']; ?></td>
                                <td style="text-align:center"><?php echo $row_data['passenger']; ?></td>
                                <td style="text-align:center"><?php echo $classname .' - '. $seatname; ?></td>
                                <td style="text-align:right"><?php echo number_format($row_des['discount'],2); ?></td>
                                <td style="text-align:right"><?php echo number_format($row_des['total_payment'],2); ?></td>
                              </tr>
                              <?php } }?>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

        <?php include('footer.php') ?>

        
