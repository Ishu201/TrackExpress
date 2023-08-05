<?php include('sidebar.php') ?>

<?php include('header.php') ?>



<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left"><br>
        <p>Train Location</p>
      </div>
      <!-- <a href="train_list.php" class="btn btn-sm btn-info" style="float:right;margin-top:10px;">Train List</a> -->
    </div>

    <div class="clearfix">
      <?php include('session_msg.php') ?>
    </div>

    <?php 
                            $id = $_SESSION['userID'];
                             $sql = "SELECT * FROM tbl_train WHERE id='$id'";
                  $result = $con->query($sql);
                  
                  $row_track = $result->fetch_array();
                  $longitude = $row_track['longitude'];
                  $latitude = $row_track['latitude'];
                  date_default_timezone_set('Asia/Colombo');
            ?>

    <div class="row">
      <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
          <div class="x_title">
            <h2><b>Train Location on Google Map - &nbsp; <?php echo $row_track['name']; ?></b></h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="row">
              <div class="col-md-12 col-sm-12  ">
                <br><br>
              <center><div>
              <?php

                  // $longitude = 80.76436507450855;
                  // $latitude = 7.308269992699617;

                  $mapLink = "https://maps.google.com/maps?q=$latitude,$longitude&output=embed";
                  $iframe = '<iframe width="80%" height="450px" frameborder="0" style="border:0" src="' . $mapLink . '" allowfullscreen></iframe>';
                  echo $iframe;
              ?>

              </div></center>
              <br><br>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->

<br><br><br><br><br>


<?php $id = $_SESSION['userID']; ?>

    <script>
        // Call the getLocation() function after the page loads.
        document.addEventListener("DOMContentLoaded", function() {
        getLocation(); // Call immediately on page load
        setInterval(getLocation, 60000); // Call every 1 minute (60 seconds * 1000 milliseconds)
    });

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        }

        function showPosition(position) {

            // Use AJAX to send the data to the server.
            var id = <?php echo json_encode($id); ?>; // Pass the PHP variable to JavaScript.
            var latitude = position.coords.latitude;
            var longitude = position.coords.longitude;

            // AJAX request to send data to the server
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "update_gps.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                    // Handle the server response here if needed.
                    alert(xhr.responseText);
                }
            };
            // Send the data in the request body.
            xhr.send("id=" + encodeURIComponent(id) + "&latitude=" + encodeURIComponent(latitude) + "&longitude=" + encodeURIComponent(longitude));
        }
    </script>



<?php include('footer.php') ?>