<!DOCTYPE html>
<html lang="en">

<head>
    <title>Track Express</title>

    <?php include('links.php') ?>

    <?php
    $cusName = $row_user['cus_name'];

    include '../models/Booking_model.php';
    $booking = new Booking();
    $booking_data = $booking->get_all_by_user($cusid);
    $count = mysqli_num_rows($booking_data);

    ?>
</head>

<body>

    <?php include('header.php') ?>
    <!-- END nav -->

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
            color: white;
            font-weight: normal;
        }

        /* Optional: Center the badges */
        .badge-container {
            text-align: center;
        }

        th {
            font-size: 15px;
        }
        td{
            padding:3px;
            font-size: 13px;
        }

        .table tbody tr td {
            padding: 5px 3px !important;
        }
    </style>

    <!-- Font Awesome icon library -->
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>


    <section class="hero-wrap" style="height: 360px;background-image: url(login/images/background-img.jpg);">
        <div class="overlay" style="height: 360px;"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-end justify-content-start" style="height:360px !important;">
                <div class="col-md-9 ftco-animate pb-5">
                    <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>My Account <i class="ion-ios-arrow-forward"></i></span></p>
                    <h1 class="mb-3 bread">Booking History</h1>
                </div>
            </div>
        </div>
    </section>

    <section style="background-color: #eee;">
        <div class="container py-5">
            
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-header" >
                                <h6>
                                    Train Booking List
                                </h6>
                            </div>
                            <div class="card-content mt-3">
                                <table class="table table-bordered" style="min-width: unset!important;">
                                    <thead style="background-color: #bfbfbf;">
                                            <th> # </th>
                                            <th>Route </th>
                                            <th>Train</th>
                                            <th>Departure</th>
                                            <th>Time</th>
                                            <th>Arrival</th>
                                            <th>Time</th>
                                            <th>Delays</th>
                                            <th>Seats</th>
                                            <th>Seating Option</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if ($count > 0) {
                                            while ($row_booking = $booking_data->fetch_array()) {
                                                $get_booking_id = $row_booking['booking_id'];
                                                $dbooking_idNew = str_pad($row_booking['booking_id'], 5, "0", STR_PAD_LEFT);

                                                $daily_train_id = $row_booking['daily_train_id'];
                                                $train_times = $booking->get_time_by_booking($daily_train_id);
                                                $row_times = $train_times->fetch_array();

                                                 $train_delay = $booking->chk_delay($daily_train_id);

                                                if (($train_delay > 0) and ($train_delay != '00:00')) {
                                                    $originalTime = $row_times['departure'];
                                                    $dateTime = DateTime::createFromFormat('H:i', $originalTime);
                                                    $dateTime->add(new DateInterval('PT' . $train_delay . 'M'));
                                                    // Get the updated time in the desired format (24-hour format)
                                                    $updatedTime = $dateTime->format('H:i');
                                                    $actual_dep = '<span style="color:red">' . $updatedTime . '</span>';

                                                    $originalTime = $row_times['arrival'];
                                                    $dateTime = DateTime::createFromFormat('H:i', $originalTime);
                                                    $dateTime->add(new DateInterval('PT' . $train_delay . 'M'));
                                                    // Get the updated time in the desired format (24-hour format)
                                                    $updatedTime = $dateTime->format('H:i');
                                                    $actual_arr =  '<span style="color:red">' . $updatedTime . '</span>';
                                                    $br = '<br>';
                                                } else {
                                                    $br = '';
                                                    $actual_dep = '';
                                                    $actual_arr =  '';
                                                }

                                        ?>
                                                <tr>
                                                    <td><?php echo $dbooking_idNew; ?></td>
                                                    <td><?php echo $row_booking['train']; ?></td>
                                                    <td><?php echo $row_booking['train_name']; ?></td>
                                                    <td><?php echo $row_booking['start']; ?></td>
                                                    <td style="text-align: center;"><?php echo $row_times['departure']; ?><?php echo $br;
                                                                                                                            echo $actual_dep; ?></td>
                                                    <td><?php echo $row_booking['end']; ?></td>
                                                    <td style="text-align: center;"><?php echo $row_times['arrival']; ?><?php echo $br;
                                                                                                                        echo $actual_arr; ?></td>
                                                    <td style="text-align: center;"><?php echo $train_delay ?> Mins</td>
                                                    <td style="text-align: center;"><?php echo $row_booking['passenger']; ?></td>

                                                    <?php
                                                    $class = $row_booking['class'];
                                                    $seat = $row_booking['seat'];

                                                    if ($class == '1') {
                                                        $classname = 'First Class';
                                                    } else if ($class == '2') {
                                                        $classname = 'Standard';
                                                    } else {
                                                        $classname = 'General Class';
                                                    }

                                                    if ($seat == 'w') {
                                                        $seatname = 'Window Seat';
                                                    } else {
                                                        $seatname = 'Middle Seat';
                                                    }
                                                    ?>
                                                    <td style="text-align: center;"><?php echo $classname; ?><br><?php echo $seatname; ?></td>
                                                    <td style="text-align: center;">
                                                        <a target="_blank" href="ticket.php?id=<?php echo $get_booking_id; ?>"><i class='far fa-credit-card'></i></a> &nbsp;
                                                        <a target="_blank" href="your_bill_link_url"><i class='fas fa-map-marker-alt'></i></a>
                                                    </td>
                                                </tr>
                                            <?php }
                                        } else { ?>
                                            <tr>
                                                <td colspan="12" style="text-align: center;"> There is no Booking for Today..</td>
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
    </section>


    <!-- Modal -->
    <!-- Modal -->
    <div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #67101C; border-bottom: none;">
                    <h5 class="modal-title" id="editProfileModalLabel" style="color:white !important;font-size:17px">Edit Profile</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: darkslategray;">
                        <span aria-hidden="true" style="color:whitesmoke">&times;</span>
                    </button>
                </div>
                <form id="editProfileForm" method="post" action="../controllers/User.php?status=edit_user&id=<?php echo $cusid; ?>">
                    <div class="modal-body">
                        <center><img src="login/images/redlogo.jpg" alt="avatar" class="rounded-circle img-fluid" style="width: 100px;"></center>
                        <div class="form-group"> <br>
                            <center><label for="fullName" style="color: darkslategrey;font-size:15px">Full Name</label></center>
                            <input type="text" style="width:80%;margin:auto;font-size:15px" class="form-control" id="fullName" name="fullName" value="<?php echo $cusName; ?>" required>
                        </div>
                        <div class="form-group">
                            <center><label for="mobile" style="color: darkslategrey;font-size:15px">Mobile</label></center>
                            <input type="tel" style="width:80%;margin:auto;font-size:15px" class="form-control" id="mobile" name="mobile" value="<?php echo $row_user['mobile']; ?>" pattern="[0-9]{10}" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="background-color: lightslategray;">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="saveChangesBtn" style="background-color: #007bff; border-color: #007bff;"">Save Changes</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Handle form submission
        $(" #saveChangesBtn").on("click", function() { 
            var fullName=$("#fullName").val(); 
            var email=$("#email").val(); 
            var mobile=$("#mobile").val(); 
            var numOrders=$("#numOrders").val(); 
            
            $(".modal-body p.mb-0").eq(0).text(fullName); 
            $(".modal-body p.mb-0").eq(1).text(email); 
            $(".modal-body p.mb-0").eq(2).text(mobile); 
            $(".modal-body p.mb-0").eq(3).text(numOrders); 
            $("#editProfileModal").modal("hide"); 
        }); 
    }); 
</script>

                            <?php include('footer.php') ?>

                            <?php include('scripts.php') ?>
</body>

</html>