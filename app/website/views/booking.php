<!DOCTYPE html>
<html lang="en">

<head>
    <title>Track Express</title>

    <?php include('links.php') ?>
    <?php
    include('../models/Timetable_model.php');
    $obj = new Timetable;
    $start_stations = $obj->station_list();
    $final_stations = $obj->station_list();
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
            color: #595959;
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
            color: lightcyan !important;
            height: 48px !important;
            font-size: 13px;
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

    <section class="ftco-section" style="background-color: #F8F9FA;">
        <div class="container">

            <div class="row no-gutters">
                <div class="col-md-12 d-flex align-items-center">
                    <div class="bg-primary" style="width:100% !important;padding:25px;background-color:#2d8659 !important">
                        <center>
                            <h4 style="color:aliceblue">Confirm Booking</h4> <br>
                        </center>

                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="mySelect" style="color:whitesmoke"><span>*</span> Preferred Class</label>
                                <div class="select">
                                    <select name="format" id="start_location">
                                        <option selected value="" disabled>Choose Your Preferred Class
                                        <option value="First Class">First Class (Rs.250.00)</option>
                                        <option value="Standard  Class">Standard Class (Rs.250.00)</option>
                                        <option value="General Class">General Class (Rs.250.00)</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label for="mySelect" style="color:whitesmoke"><span>*</span> Seating Options</label>
                                <div class="select">
                                    <select name="format" id="start_location">
                                        <option selected value="" disabled>Choose Your Seating Option
                                        <option value="First Class">Window Seats (25 Seats)</option>
                                        <option value="Standard  Class">Middle Seats (25 Seats)</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="book_pick_date" class="label" style="color:whitesmoke"><span>*</span> No of Passengers</label>
                                <input type="text" id="seats" class="form-control">
                            </div>
                            <div class="col-md-4"></div>
                            <div class="col-md-4"> <br><br>
                                <input type="text" id="seats" class="form-control" style="float:right;">
                            </div>
                        </div>
                    </div>
                </div>

                <a href="checkout.php?total=price&id=id" class="btn btn-success" style="border-radius:0px;width:250px;padding:8px;font-size:13px;background-color:#00b359">Proceed for Payments</a>

                <div class="col-md-12">
                    <div id="table_schedule">

                    </div>

                </div>
            </div>
        </div>
    </section>


    <?php include('footer.php') ?>

    <?php include('scripts.php') ?>



</body>

</html>