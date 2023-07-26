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
            background: #5c6664;
            background-image: none;
            flex: 1;
            padding: 0 .5em;
            color: #fff;
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
            background: #5c6664;
            overflow: hidden;
            border-radius: .25em;
        }

        .select::after {
            content: '\25BC';
            position: absolute;
            top: 0;
            right: 0;
            padding: 0 1em;
            background: #2b2e2e;
            cursor: pointer;
            pointer-events: none;
            transition: .25s all ease;
        }

        .select:hover::after {
            color: #23b499;
        }

        .form-control{
            background-color: #5c6664 !important;
            border:none !important;
            color:lightcyan !important;
            height: 48px !important;
            font-size:13px;
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
                    <h1 class="mb-3 bread">Train Schedules</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section" style="background-color: #F8F9FA;">
        <div class="container">

            <div class="row no-gutters">
                <div class="col-md-12 d-flex align-items-center">
                    <div  class="bg-primary" style="width:100% !important;padding:25px">
                        <center>
                            <h4 style="color:aliceblue">Find Schedule</h4> <br>
                        </center>

                        <div class="form-group row">
                            <div class="col-md-3">
                                <label for="mySelect"><span>*</span> Start Location</label>
                                <div class="select">
                                    <select name="format" id="start_location" onchange="updateFinalLocation()">
                                        <option selected disabled>Choose a Destination</option>
                                        <?php
                                            while ($row_des = $start_stations->fetch_array()) {
                                        ?>
                                        <option value="<?php echo $row_des['id']; ?>"><?php echo $row_des['name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="mySelect"><span>*</span> Final Location</label>
                                <div class="select">
                                    <select name="format" id="final_location" onchange="updateStartLocation()">
                                        <option selected disabled>Choose a Destination</option>
                                        <?php
                                            while ($row_des = $final_stations->fetch_array()) {
                                        ?>
                                        <option value="<?php echo $row_des['id']; ?>"><?php echo $row_des['name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="book_pick_date" class="label"><span>*</span> Date</label>
                                    <input type="date" id="datepicker" class="form-control">
                            </div>
                            <div class="col-md-3">
                                <br>
                                <button class="btn btn-secondary py-3 px-4" onclick="submitForm()">Find Available Trains</button>
                            </div>
                        </div>
                                            </div>
                </div>

                <div class="col-md-12">
                <div id="table_schedule">
          
          </div>

                </div>
            </div>
        </div>
    </section>


    <?php include('footer.php') ?>

    <?php include('scripts.php') ?>


    <script>
        // Function to disable the selected option in the other select input (Start Location)
        function updateFinalLocation() {
            const startLocation = document.getElementById("start_location").value;
            const finalLocationSelect = document.getElementById("final_location");

            // Enable all options in the final location select input
            finalLocationSelect.querySelectorAll("option").forEach(option => {
                option.removeAttribute("disabled");
            });

            // Disable the selected option in the final location select input
            finalLocationSelect.querySelector(`option[value="${startLocation}"]`).setAttribute("disabled", "disabled");
        }

        // Function to disable the selected option in the other select input (Final Location)
        function updateStartLocation() {
            const finalLocation = document.getElementById("final_location").value;
            const startLocationSelect = document.getElementById("start_location");

            // Enable all options in the start location select input
            startLocationSelect.querySelectorAll("option").forEach(option => {
                option.removeAttribute("disabled");
            });

            // Disable the selected option in the start location select input
            startLocationSelect.querySelector(`option[value="${finalLocation}"]`).setAttribute("disabled", "disabled");
        }
    </script>

    <script>
        function submitForm() {
            const startLocation = document.getElementById("start_location").value;
            const finalLocation = document.getElementById("final_location").value;
            const pickDate = document.getElementById("datepicker").value;

            // Validate the form data
           // Validate the form data
           if (startLocation === "" || finalLocation === "" || pickDate === "") {
                document.getElementById("table_schedule").innerHTML = "<br><center><p style='color:#B30F00'>Please fill in all fields.</p></center>";

                // Hide the error message after two seconds
                setTimeout(function() {
                    document.getElementById("table_schedule").innerHTML = "";
                }, 2000);

                return;
            }

            // Make an AJAX request to fetch the content from another page
            const xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                    document.getElementById("table_schedule").innerHTML = this.responseText; // Update the content
                }
            };
            xhttp.open("GET", "timetable_list.php?start_location=" + startLocation + "&final_location=" + finalLocation + "&date=" + pickDate, true);
            xhttp.send();
        }
    </script>


    <script>
        // Function to save the scroll position to sessionStorage
        function saveScrollPosition() {
            const scrollPosition = window.scrollY || window.pageYOffset;
            sessionStorage.setItem('scrollPosition', scrollPosition);
        }

        // Function to restore the scroll position from sessionStorage
        function restoreScrollPosition() {
            const scrollPosition = sessionStorage.getItem('scrollPosition');
            if (scrollPosition) {
                window.scrollTo(0, scrollPosition);
                sessionStorage.removeItem('scrollPosition'); // Remove the saved position to prevent it from affecting future visits
            }
        }

        // Event listener to save the scroll position when the page is unloaded (refreshed or closed)
        window.addEventListener('beforeunload', saveScrollPosition);

        // Event listener to restore the scroll position when the page is fully loaded
        window.addEventListener('load', restoreScrollPosition);
    </script>

</body>

</html>