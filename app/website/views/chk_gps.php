<!DOCTYPE html>
<html>
<head>
    <title>Geolocation Example</title>
</head>
<body>
    <?php
    $id = '7'; 
    include('links.php');

    include '../models/Train_model.php';
    $train = new Train();
    $train_data = $train->viewTrainselected($id);
    $row_train = $train_data->fetch_array();
    ?>

    <p id="demo"></p>

    <script>
        var x = document.getElementById("demo");

        // Call the getLocation() function after the page loads.
        document.addEventListener("DOMContentLoaded", getLocation);

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                x.innerHTML = "Geolocation is not supported by this browser.";
            }
        }

        function showPosition(position) {
            x.innerHTML = "Latitude: " + position.coords.latitude +
                "<br>Longitude: " + position.coords.longitude;

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
                    console.log(xhr.responseText);
                }
            };
            // Send the data in the request body.
            xhr.send("id=" + encodeURIComponent(id) + "&latitude=" + encodeURIComponent(latitude) + "&longitude=" + encodeURIComponent(longitude));
        }
    </script>

    <div class="col-md-6">
        <!-- Display your train information or other content here as needed -->
        <br> <br>
    </div>

</body>
</html>
