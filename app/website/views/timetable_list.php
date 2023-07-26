<?php
include '../controllers/db_connect.php';
$ob = new dbconnection();
$con = $ob->connection();

$date = $_GET['date'];
$start = $_GET['start_location'];
$end = $_GET['final_location'];

include('../models/Timetable_model.php');
$Schedule_obj = new Timetable;
$schedule = $Schedule_obj->get_list($date, $start, $end);

?>

<style>
    h1 {
        font-size: 20px;
        text-align: center;
        margin-top: 40px;
        margin-bottom: 20px;
    }

    .panel-default>.panel-heading {
        background-color: #ffffff;
        color:rgba(0, 0, 0, .40);
        padding: 15px;
        
    }

    .panel {
        box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, .40);
    }

    .panel-group .panel {
        margin-bottom: 20px;
    }

    .panel-title {
        font-size: 18px;
    }

    .panel-title a,
    .panel-title a:hover,
    .panel-title a:focus {
        text-decoration: none;
    }

    .panel-body p {
        font-size: 16px;
        padding: 15px;
        color:#2B2E2E !important;
    }

    td{
        color:#2B2E2E
    }
</style>

<div class="x_content" id="table-container">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true" style="margin-top: 40px;">
                <h5><b>Anuradapura to Kandy</b></h5>
                            <h5>Train (Railway) schedule</h5>
                            <h6>Date : 2023-05-14</h6>
                            <h6>Distance : 12.7km</h6>    
                <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingOne">
                            <h5 class="panel-title" style="font-size:15px">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <b>Costal Line  - 08:25AM &nbsp; &nbsp; <i class="fas fa-caret-down"></i></b>
                                </a>
                            </h5>
                        </div>
                        <div style="border-top:1px solid gray;background-color:#cccccc" id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                            <div class="panel-body" style="padding-left: 20px;padding-right: 20px;padding-top:10px">
                                <table  style="width:100%">
                                    <tbody>
                                        <tr>
                                            <td style="width:30%">Start Station</td>
                                            <td>station</td>
                                            <td style="text-align:right"><a href="booking.php?id=" class="btn btn-info" style="color:whitesmoke">Book the Train</a></td>
                                        </tr>

                                        <tr>
                                            <td>Departure Time</td>
                                            <td colspan="2">20:25:00</td>
                                        </tr>
                                        
                                        <tr>
                                            <td>Arrival to Kandy</td>
                                            <td colspan="2">25:00:00</td>
                                        </tr>
                                        
                                        <tr>
                                            <td>Final Station</td>
                                            <td colspan="2">Station</td>
                                        </tr>
                                        
                                        <tr>
                                            <td>Arrival at Final Station</td>
                                            <td colspan="2">Artichoke</td>
                                        </tr>
                                        
                                        <tr>
                                            <td>Train</td>
                                            <td colspan="2">Podi Manike - Intercity</td>
                                        </tr>
                                        
                                        <tr>
                                            <td>Available Classes</td>
                                            <td colspan="2">
                                                <span style="background-color:#4E2419;padding:5px;color:white;font-size:10px">1st Class</span> 
                                                <span style="background-color:#2A431B;padding:5px;color:white;font-size:10px">2nd Class</span> 
                                                <span style="background-color:#BE252A;padding:5px;color:white;font-size:10px">3rd Class</span>
                                            </td>
                                        </tr>
                                        
                                        <tr>
                                            <td>Available Seats</td>
                                            <td colspan="2">
                                                450
                                            </td>
                                        </tr>
                                        
                                    </tbody>
                                </table>
                            </div>
                            <br>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingTwo">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Fruits calories chart
                                </a>
                            </h4>
                        </div>
                        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                            <div class="panel-body">
                                <p>All fruits are mostly made of carbohydrates, although calories in fruit can also come from fats and small amounts of protein. The carbs, however, are not all the same and are usually a mix of complex carbohydrates (i.e., made of three or more bonded sugars) and simple carbohydrates (i.e., simple sugars).</p>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Fruit</th>
                                            <th>Serving</th>
                                            <th>Calories</th>
                                            <th>Kilojoule</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">#FRU1201</th>
                                            <td>Pineapple</td>
                                            <td>1 pineapple (905g)</td>
                                            <td>453 cal</td>
                                            <td>1901 kJ</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">#FRU1202</th>
                                            <td>Raisins</td>
                                            <td>1 cup (145g)</td>
                                            <td>434 cal</td>
                                            <td>1821 kJ</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">#FRU1203</th>
                                            <td>Pomegranate</td>
                                            <td>1 pomegranate (283g)</td>
                                            <td>234 cal</td>
                                            <td>984 kJ</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">#FRU1204</th>
                                            <td>Mango</td>
                                            <td>1 mango (336g)</td>
                                            <td>201 cal</td>
                                            <td>849 kJ</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">#FRU1205</th>
                                            <td>Grapes</td>
                                            <td>1 cup (151g)</td>
                                            <td>107 cal</td>
                                            <td>439 kJ</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">#FRU1206</th>
                                            <td>Apricot</td>
                                            <td>1 apricot (35g)</td>
                                            <td>17 cal</td>
                                            <td>71 kJ</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    
                </div>
            </div>

            <div class="col-md-12">
                <p style="font-style: italic; color: #2196f3; font-size: 18px; text-align: center; margin-top: 50px; margin-bottom: 20px;">Follow me on Twitter: <a href="https://twitter.com/mrdogra007/" target="_blank">@mrdogra007</a></p>
            </div>
        </div>
    </div>

</div>