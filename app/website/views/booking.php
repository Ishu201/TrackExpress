<!DOCTYPE html>
<html lang="en">

<head>
    <title>Track Express</title>

    <?php include('links.php') ?>
    <?php
    include('../models/Timetable_model.php');
    $obj = new Timetable;

    
    $id = $_GET['id'];
    $start = $_GET['start'];
    $end = $_GET['end'];
    $Tname = $_GET['name'];

    if (!isset($_SESSION['customerID'])) {
        header("Location:index.php");
      }else{
        $reward = $row_user['loyalty_reward'];
        $accessed = $row_user['loyalty_status'];
        $usermail = $row_user['usermail'];
      }

    ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        .ftco-section {
            padding: 5%;
        }

        select {
            -webkit-appearance: none;
            -moz-appearance: none;
            -ms-appearance: none;
            appearance: none;
            outline: 0;
            box-shadow: none;
            border: 0 !important;
            background: #bfbfbf;
            background-image: none;
            flex: 1;
            padding: 0 .5em;
            color: black;
            cursor: pointer;
            font-size: 1em;
            font-family: 'Open Sans', sans-serif;
        }

        select::-ms-expand {
            display: none;
        }

        .select {
            position: relative;
            display: flex;
            width: 100%;
            height: 3em;
            line-height: 3;
            background: #bfbfbf;
            overflow: hidden;
            border-radius: .25em;
        }

        .select::after {
            content: '\25BC';
            position: absolute;
            top: 0;
            right: 0;
            padding: 0px 1em;
            background: #2b2e2e;
            cursor: pointer;
            pointer-events: none;
            transition: .25s all ease;
        }

        .select:hover::after {
            color: #23b499;
        }

        .form-control {
            background-color: #bfbfbf !important;
            border: none !important;
            color: black !important;
            height: 48px !important;
            font-size: 13px;
        }

        /* Hide the default checkbox */
        input[type="checkbox"] {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }

        /* Style the custom checkbox */
        input[type="checkbox"]+label {
            position: relative;
            padding-left: 30px;
            /* Space for custom checkbox appearance */
            cursor: pointer;
            display: inline-block;
            width: 20px;
            height: 20px;
        }

        /* Style the custom checkbox appearance */
        input[type="checkbox"]+label::before {
            content: "\2713";
            /* Unicode checkmark symbol */
            position: absolute;
            top: 0;
            left: 0;
            width: 20px;
            height: 20px;
            border: 2px solid #000;
            background-color: #fff;
            border-radius: 5px;
            color: #fff;
            /* White color for the tick mark */
            font-size: 16px;
            text-align: center;
            line-height: 20px;
        }

        /* Style the custom checkbox when checked */
        input[type="checkbox"]:checked+label::before {
            background-color: #A20F00;
            /* Change this to the desired color when checked */
            border-color: #A20F00;
            /* Change this to the desired color when checked */
        }
    </style>


    <script>
        $(document).ready(function() {
            $("#schedule").addClass("active");
        });
    </script>

    <link rel="stylesheet" href="<?php echo $web_assets_base_url; ?>css/datepicker.sass">


</head>

<body>

    <?php include('header.php') ?>
    <!-- END nav -->


    <?php
    $sql_daily_record = "SELECT * FROM tbl_daily_trains WHERE id='$id'";
    $result_daily_record = $con->query($sql_daily_record);

    $row_daily_record = $result_daily_record->fetch_array();
    $MAINID = $row_daily_record['id'];
    $schedule_id = $row_daily_record['schedule_id'];
    $booked_seats = $row_daily_record['booked_seats'];

    $daily_mclass_1 = $row_daily_record['mclass_1'];
    $daily_mclass_2 = $row_daily_record['mclass_2'];
    $daily_mclass_3 = $row_daily_record['mclass_3'];
    $daily_wclass_1 = $row_daily_record['wclass_1'];
    $daily_wclass_2 = $row_daily_record['wclass_2'];
    $daily_wclass_3 = $row_daily_record['wclass_3'];

    $sql_schedule_record = "SELECT * FROM tbl_schedule WHERE id='$schedule_id'";
    $result_schedule_record = $con->query($sql_schedule_record);
    $row_schedule_record = $result_schedule_record->fetch_array();
    $train_id = $row_schedule_record['train_id'];
    $route_id = $row_schedule_record['route_id'];

    $sql_train_record = "SELECT * FROM tbl_train WHERE id='$train_id'";
    $result_train_record = $con->query($sql_train_record);
    $row_train_record = $result_train_record->fetch_array();
    $train_image = $row_train_record['image'];
    $train_type = $row_train_record['type'];
    $train_name = $row_train_record['name'];
    $train_total_seats = $row_train_record['total'];

    $mclass_1 = $row_train_record['mclass_1'];
    $mclass_2 = $row_train_record['mclass_2'];
    $mclass_3 = $row_train_record['mclass_3'];
    $wclass_1 = $row_train_record['wclass_1'];
    $wclass_2 = $row_train_record['wclass_2'];
    $wclass_3 = $row_train_record['wclass_3'];

    $mclass_1_remain = $mclass_1 - $daily_mclass_1;
    $mclass_2_remain = $mclass_2 - $daily_mclass_2;
    $mclass_3_remain = $mclass_3 - $daily_mclass_3;
    $wclass_1_remain = $wclass_1 - $daily_wclass_1;
    $wclass_2_remain = $wclass_2 - $daily_wclass_2;
    $wclass_3_remain = $wclass_3 - $daily_wclass_3;

    $sql_route_record = "SELECT * FROM tbl_route WHERE id='$route_id'";
    $result_route_record = $con->query($sql_route_record);
    $row_route_record = $result_route_record->fetch_array();
    $start_station_id = $row_route_record['start_station_id'];
    $final_station_id = $row_route_record['final_station_id'];

    if (($start == $start_station_id) and ($end == $final_station_id)) {
        $total_price_1st = $row_route_record['total_price_1st'];
        $total_price_2nd = $row_route_record['total_price_2nd'];
        $total_price_3rd = $row_route_record['total_price_3rd'];
    } else {
         $sql_route_record2 = "SELECT * FROM tbl_route_stations WHERE route_id='$route_id'  and (station_id='$start' or station_id='$end')";
        $result_route_record2 = $con->query($sql_route_record2);
        $row_route_record2 = $result_route_record2->fetch_array();

        $total_price_1st = $row_route_record2['price_1st'];
        $total_price_2nd = $row_route_record2['price_2nd'];
        $total_price_3rd = $row_route_record2['price_3rd'];
    }

    

    $available = $train_total_seats - $booked_seats;

    ?>

    <section style="background-image: url('<?php echo $web_assets_base_url; ?>images/rail4.jpg');height:450px !important;background-size:cover" data-stellar-background-ratio="0.5">
        <div class="overlay" style="background-color: rgba(0,0,0,.25);width:100%;height:100%"></div>
        <div class="container">
            <div class="row no-gutters slider-text  justify-content-start" style="position:absolute;top:40%;width:100%">
                <div class="col-md-9 ftco-animate pb-5">
                    <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Train Schedule <i class="ion-ios-arrow-forward"></i></span></p>
                    <h1 class="mb-3 bread">Booking Your Journey</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section" style="background-color: #f2f2f2;">
        <div class="container">

            <div class="row no-gutters">
                <div class="col-md-1"></div>
                <div class="col-md-11 d-flex align-items-center">
                    <div class="bg-primary" style="width:100% !important;padding:25px;background-color:#6C6C6C !important">

                        <div class="form-group row">
                            <div class="col-md-6" style="text-align:right"></div>
                            <div class="col-md-6">
                                <center>
                                    <h4 style="color:aliceblue">Confirm Booking</h4>
                                    <hr style="background-color: #bfbfbf;">
                                </center>
                            </div>
                        </div>
                        <img src="<?php echo $web_assets_base_url; ?>images/upload/<?php echo $train_image; ?>" alt="" style="object-fit: cover;position:absolute;left:-10%;top:15%;z-index:99;width:55%;height:75%;">
                        <form method="post" action="submit_booking.php" >
                        <input type="hidden" name="customer" value="<?php echo $cusid; ?>">
                        <input type="hidden" name="daily_train_id" value="<?php echo $id; ?>">
                        <input type="hidden" name="cusName" value="<?php echo $usermail; ?>">
                        <input type="hidden" name="Tname" value="<?php echo $Tname; ?>">
                        <input type="hidden" name="train_name" value="<?php echo $train_name; ?>">
                        <input type="hidden" name="start_station_id" value="<?php echo $start_station_id; ?>">
                        <input type="hidden" name="final_station_id" value="<?php echo $final_station_id; ?>">
                        <input type="hidden" name="dailydate" value="<?php echo $row_daily_record['date'];; ?>">


                        <div class="form-group row">
                            <div class="col-md-6" style="text-align:right"></div>
                            <div class="col-md-3">
                                <label for="mySelect" style="color:whitesmoke"><span>*</span> Preferred Class</label>
                                <div class="select">
                                    <select name="class_name" required id="class_name">
                                        <option selected value="" disabled>Choose the Class</option>
                                        <option style="padding:15px !important" data-price='<?php echo number_format($total_price_1st, 2); ?>' value="1">First Class </option>
                                        <option style="padding:15px !important" data-price='<?php echo number_format($total_price_2nd, 2); ?>' value="2">Standard </option>
                                        <option style="padding:15px !important" data-price='<?php echo number_format($total_price_3rd, 2); ?>' value="3">General Class </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="mySelect" style="color:whitesmoke"><span>*</span> Seating Options</label>
                                <div class="select" id="class1_seats">
                                    <select name="seat_type" required id="seat_type">
                                        <option selected value="" disabled>Choose Seating</option>
                                        <option value="w">Window Seat</option>
                                        <option value="m">Middle Seat</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6" style="text-align:right"></div>
                            <div class="col-md-3">
                                <label for="book_pick_date" class="label" style="color:whitesmoke"><span>*</span> No of Passengers</label>
                                <input type="number" id="passengers" name="passengers" min="1" value="1" class="form-control">
                            </div>
                            <div class="col-md-3"> <br>
                                <input type="hidden" id="available_seats">
                                <label for="book_pick_date" class="label" style="color:whitesmoke"> Available Seats : <span id="preview_seats"></span> <br> Ticket Price : <span id="preview_value"></span> </label>
                            </div>
                        </div>

                        <br><br>
                        <div class="form-group row">
                            <div class="col-md-9" style="text-align:right;color:whitesmoke">Ticket Price</div>
                            <div class="col-md-3">
                                <input type="text" id="subtotal" required readonly class="form-control" value="0.00" style="float:right;text-align:right">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-9" style="text-align:right;color:whitesmoke">
                                Loyalty Bonus 
                                <?php  if (($reward > 0) and ($accessed == 'not accessed')) {
                                    echo $reward.'%'; 
                                    
                                }else{
                                    $reward = '0';
                                }
                                ?> <br> <input type="hidden" id="loyaltyperc" value="<?php echo $reward; ?>"><input type="hidden" id="checked_lc" name="checked_lc" value="no">
                                <div style="margin-right:30px">
                                    <input type="checkbox" id="customCheckbox">
                                    <label for="customCheckbox"></label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <input type="text" id="bonus" name="bonus" readonly class="form-control" value="100.00" style="float:right;text-align:right">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-9" style="text-align:right;color:whitesmoke">Total Price</div>
                            <div class="col-md-3">
                                <input type="text" name="total" id="total" required readonly class="form-control" value="0.00" style="float:right;text-align:right">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6" style="text-align:right;color:whitesmoke"></div>
                            <div class="col-md-6">
                                <center> <br>
                                <input type="submit" class="btn btn-danger" style="border-color:#A20F00;width:250px;;padding:15px;font-size:13px;background-color:#B30F00" value='Proceed for Payments'>
                                </center>
                            </div>
                        </div>
                            </form>
                    </div>
                </div>

                <div class="col-md-1"></div>
            </div>
        </div>
    </section>

    <script>
        $(document).ready(function() {
            $("#class_name, #passengers, #seat_type, #customCheckbox").on("change keyup", function() {
                var price = $("#class_name option:selected").data("price");
                var price2 = parseFloat(price.replace(/,/g, ''));
                var passengers = parseFloat($('#passengers').val());

                var mclass_1_remain = parseFloat('<?php echo $mclass_1_remain; ?>');
                var mclass_2_remain = parseFloat('<?php echo $mclass_2_remain; ?>');
                var mclass_3_remain = parseFloat('<?php echo $mclass_3_remain; ?>');
                var wclass_1_remain = parseFloat('<?php echo $wclass_1_remain; ?>');
                var wclass_2_remain = parseFloat('<?php echo $wclass_2_remain; ?>');
                var wclass_3_remain = parseFloat('<?php echo $wclass_3_remain; ?>');

                var class_no = $("#class_name").val();
                var seat_type = $("#seat_type").val();

                var available_seats = 0;

                if (class_no && seat_type) {
                    if (class_no == '1' && seat_type == 'w') {
                        available_seats = wclass_1_remain;
                    } else if (class_no == '1' && seat_type == 'm') {
                        available_seats = mclass_1_remain;
                    } else if (class_no == '2' && seat_type == 'w') {
                        available_seats = wclass_2_remain;
                    } else if (class_no == '2' && seat_type == 'm') {
                        available_seats = mclass_2_remain;
                    } else if (class_no == '3' && seat_type == 'w') {
                        available_seats = wclass_3_remain;
                    } else if (class_no == '3' && seat_type == 'm') {
                        available_seats = mclass_3_remain;
                    }
                }

                $("#available_seats").val(available_seats);

                var previewValueElement = $('#preview_seats');
                previewValueElement.text(available_seats);

                // Ensure passengers value does not exceed available_seats
                if (passengers > available_seats) {
                    passengers = available_seats;
                    $('#passengers').val(passengers);
                }

                var subtotal = price2 * passengers;
                $("#subtotal").val(subtotal.toFixed(2));
                
                var perc =  parseFloat($('#loyaltyperc').val());
                if(perc > 0){
                    var percval = perc/100*subtotal
                    $('#bonus').val(percval)
                }else{
                    var percval = 0;
                    $('#bonus').val(percval)
                }

                if ($('#customCheckbox').is(':checked')) {
                    var total = subtotal-percval;
                    $('#checked_lc').val('yes')
                } else {
                    var total = subtotal;
                }
                
                $("#total").val(total.toFixed(2));

                var previewValueElement = $('#preview_value');
                previewValueElement.text('Rs. ' + price2.toFixed(2));
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $("#passengers").on("blur", function() {
                var inputValue = $(this).val();
                if (inputValue === "" || parseFloat(inputValue) <= 0) {
                    $(this).val(1);
                }
            });
        });
    </script>

    <?php include('footer.php') ?>

    <?php include('scripts.php') ?>



</body>

</html>