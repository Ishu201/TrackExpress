<?php include('sidebar.php') ?>

<?php include('header.php') ?>

<?php
include('../models/User_model.php');
$obj = new User;
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
                <p>User List</p>
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
                        <h2><b>User List</b></h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table id="datatable" class="table table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>User ID</th>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th style="text-align:center">Type</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row_des = $result->fetch_array()) {
                                    $cusid = str_pad($row_des['id'], 4, "0", STR_PAD_LEFT);
                                ?>
                                    <tr>
                                        <td><?php echo $cusid; ?></td>
                                        <td><?php echo $row_des['first_name']; ?></td>
                                        <td><?php echo $row_des['username']; ?></td>
                                        <td style="text-align:center">
                                            <?php
                                            // Assuming $row_des['level'] contains the traveler type
                                            $travelerType = $row_des['type'];

                                            // Display badges based on the traveler type
                                            if ($travelerType == 'station') {
                                                echo '<span class="badge badge-traveler">Station User</span>';
                                            } elseif ($travelerType == 'train') {
                                                echo '<span class="badge badge-traveler-plus">Train User</span>';
                                            } elseif ($travelerType == 'admin') {
                                                echo '<span class="badge badge-elite-traveler">Admin User</span>';
                                            }
                                            ?>
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