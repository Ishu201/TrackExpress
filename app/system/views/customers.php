<?php include('sidebar.php') ?>

<?php include('header.php') ?>

<?php
include('../models/Customer_model.php');
$obj = new Customer;
$result = $obj->get_all();
?>

<style>
    .badge-traveler {
      background-color: #3498db;
    }
    .badge-traveler-plus {
      background-color: #27ae60;
    }
    .badge-elite-traveler {
      background-color: #f39c12;
    }
    /* Additional styling for badges */
    .badge {
      font-size: 12px;
      padding: 6px 8px;
    }
    /* Optional: Center the badges */
    .badge-container {
      text-align: center;
    }
</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left"><br>
                <p>Passenger Mgt / Customer List</p>
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
                        <h2><b>Blank card</b></h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table id="datatable" class="table table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Customer ID</th>
                                    <th>Customer Name</th>
                                    <th>Customer Email</th>
                                    <th>User Level</th>
                                    <th>Total Booking</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row_des = $result->fetch_array()) {
                                    $cusid = str_pad($row_des['id'], 4, "0", STR_PAD_LEFT);
                                ?>
                                    <tr>
                                        <td><?php echo $cusid; ?></td>
                                        <td><?php echo $row_des['cus_name']; ?></td>
                                        <td><?php echo $row_des['usermail']; ?></td>
                                        <td>
                                            <?php
                                            // Assuming $row_des['level'] contains the traveler type
                                            $travelerType = $row_des['level'];

                                            // Display badges based on the traveler type
                                            if ($travelerType == 'Traveler') {
                                                echo '<span class="badge badge-traveler">Traveler</span>';
                                            } elseif ($travelerType == 'Traveler Plus') {
                                                echo '<span class="badge badge-traveler-plus">Traveler Plus</span>';
                                            } elseif ($travelerType == 'Elite Traveler') {
                                                echo '<span class="badge badge-elite-traveler">Elite Traveler</span>';
                                            }
                                            ?>
                                        </td>
                                        <td><?php echo $row_des['no_of_bookings']; ?></td>
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