<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification Code Email</title>
    <style>
        /* Set a white background color for the email */
        body {
            margin: 0;
            padding: 0;
            background-color: #ffffff;
            font-family: Arial, sans-serif;
        }

        /* Container styles */
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            box-sizing: border-box;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
        }

        /* Heading styles */
        h1 {
            color: #4285F4;
            text-align: center;
        }

        /* Button styles */
        .cta-button {
            display: inline-block;
            background-color: #4285F4;
            color: #ffffff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
        }

        /* Footer styles */
        .footer {
            color: #666666;
            text-align: center;
            margin-top: 20px;
        }
    </style>
    </style>
</head>

<body>
    <div class="container">
        <h1 style="color:#AA1826 !important">Train Booking Confirmation - ['.daily_train_id2.']</h1>
        <p>Dear ' . $recipient . ',</p>
        <p>Thank you for choosing our services to book your train journey. We are excited to confirm your booking and provide you with all the necessary details for your upcoming trip. Below are the specifics of your train reservation:</p>
        <table>
            <tr>
                <th style="text-align:left">Booking ID</th>
                <td style="padding-left:20px"><b>'.daily_train_id2.'</b></td>
            </tr>
            <tr>
                <th style="text-align:left">Train Name</th>
                <td style="padding-left:20px">'.$train.'</td>
            </tr>
            <tr>
                <th style="text-align:left">Departure Date</th>
                <td style="padding-left:20px">'.$date.'</td>
            </tr>
            <tr>
                <th style="text-align:left">From</th>
                <td style="padding-left:20px">'.$start.'</td>
            </tr>
            <tr>
                <th style="text-align:left">To</th>
                <td style="padding-left:20px">'.$end.'</td>
            </tr>
            <tr>
                <th style="text-align:left">Seat/Class</th>
                <td style="padding-left:20px">'.$seatname.'/'.$classname.'</td>
            </tr>
        </table><br> <br>
        <div class="footer">
        Please ensure that you arrive at the station at least 30 minutes before the departure time. Boarding gates will close 10 minutes prior to the departure time. If you have any questions or need assistance, please don't hesitate to reach out to our customer support team at info@trackexpress.com
        <br>Best Regards,<br><b>TrackExpress</b>
    </div>
    </div>
</body>

</html>