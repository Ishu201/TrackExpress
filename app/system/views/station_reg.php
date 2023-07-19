<?php include('sidebar.php') ?>

<?php include('header.php') ?>

<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    include('../models/Station_model.php');
    $obj = new Station;
    $result = $obj->viewStationselected($id);
    $row_des = $result->fetch_array();
    $station = $row_des['id'];

    $result2 = $obj->viewStation_user($station);
    $row_user = $result2->fetch_array();
} else {
    $id = '';
}
?>

<style>
    .password-input-container {
        position: relative;
    }

    .password-toggle-icon {
        position: absolute;
        top: 50%;
        right: 10px;
        transform: translateY(-50%);
        cursor: pointer;
    }
</style>

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left"><br>
                <p>Station Details Mgt / Station Register</p>
            </div>
            <a href="station_list.php" class="btn btn-sm btn-info" style="float:right;margin-top:10px;">Station List</a>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><b>Station Details</b></h2>
                        <div class="clearfix">
                            <?php include('session_msg.php') ?>
                        </div>
                    </div>
                    <div class="x_content" style="padding:10px"> <br>
                        <?php if ($id != '') { ?>
                            <form action="../controllers/Station.php?status=update" method="post" data-parsley-validate>
                                <input type="hidden" name="tid" id="tid" value="<?php echo $row_des['id'];  ?>">
                            <?php } else { ?>
                                <form action="../controllers/Station.php?status=add" method="post" data-parsley-validate>
                                <?php } ?>
                                <div class="form-group row ">
                                    <div class="col-md-5 col-sm-6 ">
                                        <label class="control-label"><span>*</span> Name</label>
                                        <input id="name" name="name" type="text" class="form-control" value="<?php if ($id != '') {
                                                                                                                    echo $row_des['name'];
                                                                                                                } ?>" placeholder="Name of the Station" data-parsley-trigger="change" required>
                                    </div>
                                    <div class="col-md-4 col-sm-6 ">
                                        <label class="control-label"><span>*</span> Station Type</label>
                                        <select id="type" name="type" class="form-control" required>
                                            <option <?php if ($id != '') {
                                                        if ($row_des['type'] == '') {
                                                            echo 'selected';
                                                        }
                                                    } ?> value=""> -Choose option- </option>
                                            <option <?php if ($id != '') {
                                                        if ($row_des['type'] == 'Main Station') {
                                                            echo 'selected';
                                                        }
                                                    } ?> value="Main Station">Main Station</option>
                                            <option <?php if ($id != '') {
                                                        if ($row_des['type'] == 'Sub Station') {
                                                            echo 'selected';
                                                        }
                                                    } ?> value="Sub Station">Sub Station</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 col-sm-6">
                                        <label class="control-label" style="margin-top:10px">&nbsp;</label> <br>
                                        &nbsp;&nbsp; <label class="checkbox-custom">
                                            <input type="checkbox" id="chkuser" name="chkuser" <?php if ($id != '') {
                                                                                                    if ($row_des['user'] == 'yes') {
                                                                                                        echo 'checked';
                                                                                                    }
                                                                                                } ?> value="1" onchange="toggleUserDiv()">
                                            <span class="checkmark"></span>
                                            <span class="checkbox-label">Create a User</span>
                                        </label>
                                    </div>
                                    <div class="col-md-4 col-sm-6 "> <br>
                                        <label class="control-label"><span>*</span> Contact No</label>
                                        <input id="contact" name="contact" type="text" class="form-control" value="<?php if ($id != '') {
                                                                                                                        echo $row_des['contact'];
                                                                                                                    } ?>" placeholder="Contact No of the Station" data-parsley-trigger="change" required pattern="^\d{10}$">
                                    </div>
                                </div> <br>

                                <div class="form-group row " id="userdiv" style="display:none">
                                    <div class="col-md-4 col-sm-6 ">
                                        <label class="control-label"><span>*</span> Username &nbsp; &nbsp;<span style="color:limegreen;display:none" id="usernamestat"><b>Updated Successfully..!!</b></span></label>
                                        <input id="username" name="username" type="text" class="form-control" <?php if ($id != '') { ?>onchange='updateuser(<?php echo $id; ?>,"username",this)' <?php } ?> value="<?php if ($id != '') {
                                                                                                                                                                    echo $row_user['username'];
                                                                                                                                                                } ?>" placeholder="Username for the station account.." data-parsley-trigger="change">
                                    </div>
                                    <div class="col-md-4 col-sm-6 ">
                                        <label class="control-label"><span>*</span> Password &nbsp; &nbsp;<span style="color:limegreen;display:none" id="passwordstat"><b>Updated Successfully..!!</b></span></label>
                                        <div class="password-input-container">
                                            <input id="password" name="password" type="password" <?php if ($id != '') { ?>onchange='updateuser(<?php echo $id; ?>,"password",this)' <?php } ?> class="form-control" placeholder="Password.." data-parsley-trigger="change">
                                            <span id="password-toggle" class="password-toggle-icon" onclick="togglePasswordVisibility()"><i class="fa fa-eye"></i></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12 " style="text-align:right">
                                        <button type="reset" class="btn btn-dark">Reset</button>
                                        <button type="submit" class="btn btn-success">Submit</button>
                                    </div>
                                </div>

                                </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->

<script>
    <?php if ($id != '') {  ?>
        toggleUserDiv()
    <?php }  ?>

    function toggleUserDiv() {
        var checkbox = document.getElementById('chkuser');

        if (checkbox.checked) {
            $('#userdiv').show()
            var name = $('#name').val()
            <?php if ($id == '') {  ?>
                $('#username').val('admin@' + name)
            <?php }  ?>
        } else {
            $('#userdiv').hide()
            <?php if ($id == '') {  ?>
                $('#username').val('')
            <?php }  ?>
        }
    }
</script>

<script>
    function togglePasswordVisibility() {
        var passwordInput = document.getElementById("password");
        var passwordToggle = document.getElementById("password-toggle");

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            passwordToggle.innerHTML = '<i class="fa fa-eye-slash"></i>';
        } else {
            passwordInput.type = "password";
            passwordToggle.innerHTML = '<i class="fa fa-eye"></i>';
        }
    }

    function updateuser(id, col, element) {
        var val = $(element).val()
        $.ajax({
            url: 'update_station_user.php', // Replace with the URL of your PHP controller
            type: 'GET',
            data: {
                id: id,
                value: val,
                col: col
            },
            success: function(response) {

                if (col == 'username') {
                    var usernameStat = $("#usernamestat");
                    usernameStat.fadeIn(); // Show the element
                    setTimeout(function() {
                        usernameStat.fadeOut(); // Hide the element
                    }, 1000);
                }else{
                    var usernameStat = $("#passwordstat");
                    usernameStat.fadeIn(); // Show the element
                    setTimeout(function() {
                        usernameStat.fadeOut(); // Hide the element
                    }, 1000);
                }
            },
            error: function(xhr, status, error) {
                // Handle the error response from the server
                console.error('Error updating station:', error);
                // Additional error handling or UI updates
            }
        });
    }
</script>

<?php include('footer.php') ?>