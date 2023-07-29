<!DOCTYPE html>
<html>
<head>
    <title>IP Geolocation Example</title>
</head>
<body>
    <h1>IP Geolocation Example</h1>
    <p>Loading geolocation data...</p>

    <script>
        // Function to make an API request and process the response
        function fetchGeolocationData() {
            var xhr = new XMLHttpRequest();

            // Replace 'YOUR_TOKEN' with your actual token from ipinfo.io (sign up for a free token)
            var token = '7fce20ccfa62b0';

            xhr.open('GET', 'https://ipinfo.io?token=' + token);

            xhr.onload = function () {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    displayGeolocationData(response);
                } else {
                    console.log('Request failed. Status:', xhr.status);
                }
            };

            xhr.send();
        }

        // Function to display the geolocation data on the page
        function displayGeolocationData(data) {
            var content = 'IP Address: ' + data.ip + '<br>' +
                          'Location: ' + data.city + ', ' + data.region + ', ' + data.country + '<br>' +
                          'Latitude: ' + data.loc.split(',')[0] + '<br>' +
                          'Longitude: ' + data.loc.split(',')[1];

            document.body.innerHTML = '<h1>IP Geolocation Example</h1>' + content;
        }

        // Call the fetchGeolocationData function after the page loads.
        document.addEventListener('DOMContentLoaded', fetchGeolocationData);
    </script>
</body>
</html>
