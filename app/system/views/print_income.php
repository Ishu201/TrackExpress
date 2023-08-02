<?php include('common.php'); session_start(); ?>

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

<!DOCTYPE html>
<html>
<head>
  <title>TrackExpress - Report</title>
  <!-- Add Bootstrap CSS link here -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      padding: 20px;
    }
    .header {
      text-align: center;
    }
    .logo {
      max-width: 100px;
    }
    .report-title {
      margin-top: 20px;
      font-size: 24px;
      font-weight: bold;
    }
    .table-container {
      margin-top: 30px;
    }
    .footer {
      margin-top: 50px;
      text-align: center;
    }

    td{
      font-size: 11px;
    }

    th{
      font-size: 13px;

    }
  </style>
</head>
<body onload="print()">
  <div class="header">
    <img class="logo" src="images/translogo.png" alt="Logo">
    <h3>TrackExpress</h3>
    <div class="report-title" style="font-size:15px">Monthly Income Report - <?php $date = new DateTime($date.'-01');
          echo $month = $date->format('F Y'); ?></div>
  </div>

  <div class="table-container">
  <table id="datatable" class="table table-bordered" style="width:100%">
                    <thead>
                      <tr>
                        <th>Booking ID</th>
                        <th>Date</th>
                        <th>Route</th>
                        <th>Customer</th>
                        <th>Bonus</th>
                        <th style="text-align:right">Total Amount (Rs.)</th>
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
                        <td colspan="5"><b>
                          Total Income (Rs).</b>
                        </td>
                        <td style="text-align:right"><b>
                        <?php echo number_format($totval, 2); ?></b>
                        </td>
                      </tr>
                      </tfoot>
                    </tbody>
                  </table>
  </div>

  <div class="footer">
    <p>TrackExpress</p>
  </div>

  <!-- Add Bootstrap JS and jQuery links here -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
