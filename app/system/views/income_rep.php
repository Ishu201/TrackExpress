<?php include('sidebar.php') ?>

<?php include('header.php') ?>

<?php
include('../models/Booking_model.php');
$obj = new Booking;

if (isset($_GET['id'])) {
  $date = $_GET['id'];
} else {
  $date = date('Y-m');
}
$result = $obj->get_all_by_date2($date);


?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left"><br>
        <p>Revenue Mgt / Income Report</p>
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
            <h2><b>Booking Income <?php echo $date ?></b></h2>
            <div class="clearfix"></div>

          </div>
          <div class="x_content">
          <div class="row">
            <div class="col-md-6 col-sm-4 ">
              <label for="datetime">Select Month</label>
              <input type="month" value="<?php echo $date ?>" style="width:50%" id="datetime" class="form-control" onchange="redirectToPage(this)">
            </div>
            <div class="col-md-6 col-sm-4 ">
            <a target="_blank" href="print_income.php?date=<?php echo $date; ?>" class="btn btn-sm btn-info" style="float:right;margin-top:10px;">Print Income Report</a>
            </div>
          </div>

            
            <div class="row">
              <div class="col-sm-12">
                <div class="card-box table-responsive"> <br><br>
                  <table id="datatable" class="table table-bordered" style="width:100%">
                    <thead>
                      <tr>
                        <th>Booking ID</th>
                        <th>Date</th>
                        <th>Route</th>
                        <th>Customer</th>
                        <th>Bonus</th>
                        <th>Total Amount (Rs.)</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $totval = 0;
                      while ($row_des = $result->fetch_array()) {
                        $book_id = $row_des['mainID'];
                        $bookid = str_pad($book_id, 5, "0", STR_PAD_LEFT);

                        $result2 = $obj->get_all_by_temp($book_id);
                        $row_data = $result2->fetch_array();
                        $customerid = $row_data['customer_id'];

                        $totval = $totval + $row_des['total_payment'];
                      ?>
                        <tr>
                          <td><?php echo $bookid; ?></td>
                          <td><?php echo $row_des['date']; ?></td>
                          <td><?php echo $row_data['train']; ?></td>
                          <td><?php echo $row_data['customer_name']; ?></td>
                          <td style="text-align:right"><?php echo number_format($row_des['discount'], 2); ?></td>
                          <td style="text-align:right"><?php echo number_format($row_des['total_payment'], 2); ?></td>
                        </tr>
                      <?php } ?>
                        <tfoot>
                      <tr>
                        <td><b>
                          Total Income (Rs).</b>
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td style="text-align:right"><b>
                        <?php echo number_format($totval, 2); ?></b>
                        </td>
                      </tr>
                      </tfoot>
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

<script>
  function redirectToPage(element) {
    // Replace "https://example.com/redirect-url" with the URL you want to redirect to.
    var val = $(element).val()
    window.location.href = "http://localhost/TrackExpress/app/system/views/income_rep.php?id=" + val;
  }
</script>

<?php include('footer.php') ?>