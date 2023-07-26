<!DOCTYPE html>
<html lang="en">

<head>
  <title>Track Express</title>

  <?php include('links.php') ?>
  <?php 
  include('../models/Train_model.php');
  $obj = new Train;
  $result = $obj->get_all();
?>
</head>

<body>

  <?php include('header.php') ?>
  <!-- END nav -->

  <div class="hero-wrap ftco-degree-bg" style="background-image: url('<?php echo $web_assets_base_url; ?>images/lg_1.jpg');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
      <div class="row no-gutters slider-text justify-content-start align-items-center justify-content-center">
        <div class="col-lg-8 ftco-animate">
          <div class="text w-100 text-center mb-md-5 pb-md-5">
            <h1 class="mb-4">Fast &amp; Easy Way To Book A Train</h1>
            <p style="font-size: 18px;">Track Express: Redefining Train Travel - Unleash the Power of Seamless Booking and Real-Time Tracking for Unforgettable Journeys!</p>

          </div>
        </div>
      </div>
    </div>
  </div>

  <section class="ftco-section ftco-no-pt bg-light">
    <div class="container">
      <div class="row no-gutters">
        <div class="col-md-12 featured-top">
          <div class="row no-gutters">
            <div class="col-md-12 d-flex align-items-center">
              <div class="services-wrap rounded-right w-100">
                <center>
                <h3 class="heading-section mb-4">The Best Way to Book Train Tickets</h3>
                </center>
                <div class="row d-flex mb-4">

                  <div class="col-md-3 d-flex align-self-stretch ftco-animate">
                    <div class="services w-100 text-center">
                      <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-route"></span></div>
                      <div class="text w-100">
                        <h3 class="heading mb-2">Select Your Departure Station</h3>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3 d-flex align-self-stretch ftco-animate">
                    <div class="services w-100 text-center">
                      <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-route"></span></div>
                      <div class="text w-100">
                        <h3 class="heading mb-2">Select Your Arrival Station</h3>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-3 d-flex align-self-stretch ftco-animate">
                    <div class="services w-100 text-center">
                      <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-handshake"></span></div>
                      <div class="text w-100">
                        <h3 class="heading mb-2">Choose the Best Seating Options</h3>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3 d-flex align-self-stretch ftco-animate">
                    <div class="services w-100 text-center">
                      <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-rent"></span></div>
                      <div class="text w-100">
                        <h3 class="heading mb-2">Book Your Train Journey</h3>
                      </div>
                    </div>
                  </div>
                </div>
                <center><p><a href="schedule.php" class="btn btn-primary py-3 px-4">Find Your Train Now</a></p></center>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


  <section class="ftco-section ftco-no-pt bg-light">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-12 heading-section text-center ftco-animate mb-5">
          <span class="subheading">What we offer</span>
          <h2 class="mb-2">Our Elite Train Collections</h2>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="carousel-car owl-carousel">

          <?php
                while ($row_des = $result->fetch_array()) {
                  ?>
            <div class="item">
              <div class="car-wrap rounded ftco-animate">
                <div class="img rounded d-flex align-items-end" style="background-image: url('<?php echo $web_assets_base_url; ?>images/upload/<?php echo $row_des['image']; ?>');"></div>
                <div class="text">
                  <h2 class="mb-0"><a href="#"><?php echo $row_des['name']; ?> Train</a></h2>
                  <div class="d-flex mb-3">
                    <span class="cat" style="color:gray !important;text-transform:capitalized"><?php echo $row_des['type']; ?></span>
                    <p class="price ml-auto" style="color:gray !important"><?php echo $row_des['total']; ?> <span style="color:gray !important">/Seats</span></p>
                  </div>
                  <p class="d-flex mb-0 d-block"></p>
                </div>
              </div>
            </div>
                  <?php } ?>

           
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="ftco-section ftco-about">
    <div class="container">
      <div class="row no-gutters">
        <div class="col-md-6 p-md-5 img img-2 d-flex justify-content-center align-items-center" style="background-image: url('<?php echo $web_assets_base_url; ?>images/221.jpg');">
        </div>
        <div class="col-md-6 wrap-about ftco-animate">
          <div class="heading-section heading-section-white pl-md-5">
            <span class="subheading">About us</span>
            <h2 class="mb-4">Welcome to Track Express</h2>

            <p>We are thrilled to introduce Track Express, your premier destination for train booking and tracking. As a newly developed and cutting-edge train booking and tracking system, we bring you an exceptional travel experience like never before.</p>
            <p>With Track Express, you can effortlessly book your train tickets, making your journey planning seamless and stress-free. Our user-friendly platform offers a wide range of options, ensuring you find the perfect train to suit your preferences and travel needs.
              But that's not all! Track Express takes your journey to the next level with our innovative tracking system. Stay informed and updated about your train's real-time status, ensuring you're always in the know, whether you're on the move or eagerly waiting to board.</p>
            <p>Experience the convenience, efficiency, and reliability of Track Express as we revolutionize the way you travel by train. Join us on this exciting journey and let us make your train travel an unforgettable one!
              Embark on a remarkable train travel experience with Track Express - where booking and tracking your journey is just a click away.</p>
            <!-- <p><a href="#" class="btn btn-primary py-3 px-4">Book Your Train Now</a></p> -->
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="ftco-section">
    <div class="container">
      <div class="row justify-content-center mb-5">
        <div class="col-md-7 text-center heading-section ftco-animate">
          <span class="subheading">Services</span>
          <h2 class="mb-3">Our Latest Services</h2>
        </div>
      </div>
      <div class="row">
        <div class="col-md-3">
          <div class="services services-2 w-100 text-center">
            <div class="text w-100">
              <h3 class="heading mb-2">Train Schedule</h3>
              <p>Explore our seamless Train Schedule for hassle-free ticket booking with Track Express. Wide range of options available</p>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="services services-2 w-100 text-center">
            <div class="text w-100">
              <h3 class="heading mb-2">Ticket Reservations</h3>
              <p>Reserve your train tickets in advance with Track Express. Secure your seats for a hassle-free journey.</p>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="services services-2 w-100 text-center">
            <div class="text w-100">
              <h3 class="heading mb-2">Seat Selection</h3>
              <p>Choose your preferred seats on the train with Track Express. Enjoy a comfortable and personalized journey.</p>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="services services-2 w-100 text-center">
            <div class="text w-100">
              <h3 class="heading mb-2">Train Tracking</h3>
              <p>Track your trains in real-time with Track Express. Experience live train tracking for hassle-free journeys</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>




  <section class="ftco-counter ftco-section img bg-light" id="section-counter">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
                  <?php 
                  $sql = "SELECT * FROM tbl_customer WHERE status='Active'";
                  $result = $con->query($sql);
                  $count1 = mysqli_num_rows($result);
                  ?>
        <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
          <div class="block-18">
            <div class="text text-border d-flex align-items-center">
              <strong class="number" data-number="<?php echo $count1; ?>">0</strong>
              <span>Happy <br>Passengers</span>
            </div>
          </div>
        </div>
        <?php 
                  $sql = "SELECT * FROM tbl_train WHERE status='active'";
                  $result = $con->query($sql);
                  $count2 = mysqli_num_rows($result);
                  ?>
        <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
          <div class="block-18">
            <div class="text text-border d-flex align-items-center">
              <strong class="number" data-number="<?php echo $count2; ?>">0</strong>
              <span>Total <br>Trains</span>
            </div>
          </div>
        </div>
        <?php 
                  $sql = "SELECT * FROM tbl_route WHERE status='active'";
                  $result = $con->query($sql);
                  $count3 = mysqli_num_rows($result);
                  ?>
        <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
          <div class="block-18">
            <div class="text text-border d-flex align-items-center">
              <strong class="number" data-number="<?php echo $count3; ?>">0</strong>
              <span>Total <br>Routes</span>
            </div>
          </div>
        </div>
        <?php 
                  $sql = "SELECT * FROM tbl_station WHERE status='active'";
                  $result = $con->query($sql);
                  $count4 = mysqli_num_rows($result);
                  ?>
        <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
          <div class="block-18">
            <div class="text d-flex align-items-center">
              <strong class="number" data-number="<?php echo $count4; ?>">0</strong>
              <span>Total <br>Destinations</span>
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