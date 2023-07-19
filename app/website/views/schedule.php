<!DOCTYPE html>
<html lang="en">

<head>
    <title>Track Express</title>

    <?php include('links.php') ?>
</head>

<body>

    <?php include('header.php') ?>
    <!-- END nav -->
   

    <section style="background-image: url('<?php echo $web_assets_base_url; ?>images/lg_3.jpg');height:450px !important;background-size:cover" data-stellar-background-ratio="0.5">
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
                    <form action="#" class="bg-primary" style="width:100% !important;padding:25px">
                        <h4 style="color:aliceblue">Find Schedule</h4><br>
                        <div class="form-group row">
                            <div class="col-md-4">
                            <label for="mySelect">Start Location</label>
                                    <select class="form-control" id="mySelect">
                                        <option value="1">Option 1</option>
                                        <option value="2">Option 2</option>
                                        <option value="3">Option 3</option>
                                        <!-- Add more options as needed -->
                                    </select>
                            </div>
                            <div class="col-md-4">
                            <label for="mySelect">Final Location</label>
                                    <select class="form-control" id="mySelect">
                                        <option value="1">Option 1</option>
                                        <option value="2">Option 2</option>
                                        <option value="3">Option 3</option>
                                        <!-- Add more options as needed -->
                                    </select>
                            </div>
                            <div class="col-md-4">
                            <label for="" class="label">Pick-up date</label>
                            <input type="text" class="form-control" id="book_pick_date" placeholder="Date">
                            </div>
                        </div>
                        <div class="form-group"> <br>
                            <center><input type="submit" value="Find Available Trains" class="btn btn-secondary py-3 px-4"></center>
                        </div>
                    </form>
                </div>

                <div class="col-md-12">
                    <div class="row no-gutters">

                        <div class="col-md-8 d-flex align-items-center">
                            <div class="services-wrap rounded-right w-100">
                                <h3 class="heading-section mb-4">Better Way to Rent Your Perfect Cars</h3>
                                <div class="row d-flex mb-4">
                                    <div class="col-md-4 d-flex align-self-stretch ftco-animate">
                                        <div class="services w-100 text-center">
                                            <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-route"></span></div>
                                            <div class="text w-100">
                                                <h3 class="heading mb-2">Choose Your Pickup Location</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 d-flex align-self-stretch ftco-animate">
                                        <div class="services w-100 text-center">
                                            <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-handshake"></span></div>
                                            <div class="text w-100">
                                                <h3 class="heading mb-2">Select the Best Deal</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 d-flex align-self-stretch ftco-animate">
                                        <div class="services w-100 text-center">
                                            <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-rent"></span></div>
                                            <div class="text w-100">
                                                <h3 class="heading mb-2">Reserve Your Rental Car</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <p><a href="#" class="btn btn-primary py-3 px-4">Reserve Your Perfect Car</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <?php include('footer.php') ?>

    <?php include('scripts.php') ?>

</body>

</html>