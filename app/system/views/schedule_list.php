<?php include('sidebar.php') ?>

<?php include('header.php') ?>


<script>
  $(document).ready(function() {
    $("#Schedule").addClass("active");
    $("#Schedulemenu").attr("style", "display: block;");
    $("#schedule_trains").addClass("current-page");
  });
</script>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left"><br>
        <p>Train Schedule Mgt / Schedule Trains</p>
        </div>
        <a href="schedule_trains.php" class="btn btn-sm btn-info" style="float:right;margin-top:10px;">Schedule Register</a>
   </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
          <div class="x_title">
            <h2><b>Train Schedule List</b></h2>
            <div class="clearfix">
            <?php include('session_msg.php') ?>
            </div>
          </div>

          <div class="form-group row" style="padding-left:10px;">
          <div class="col-md-4 col-sm-4 ">
              <label class="control-label"><span>* </span>Day</label>
              <select id="day" name="day" class="form-control" onchange="loadTextFromPage(this.value)">
                  <option value="">- select a day -</option>
                  <option value="Sunday">Sunday</option>
                  <option value="Monday">Monday</option>
                  <option value="Tuesday">Tuesday</option>
                  <option value="Wednesday">Wednesday</option>
                  <option value="Thursday">Thursday</option>
                  <option value="Friday">Friday</option>
                  <option value="Saturday">Saturday</option>
              </select>
          </div>
          </div> <br>
          

          <div id="table_schedule">
          
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->

<script>
    function loadTextFromPage(selectedValue) {
        if (selectedValue === "") {
            document.getElementById("table_schedule").innerHTML = ""; // Clear the content
            return;
        }

        // Make an AJAX request to fetch the content from another page
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("table_schedule").innerHTML = this.responseText; // Update the content
            }
        };
        xhttp.open("GET", "schedule_list_data.php?day=" + selectedValue, true); // Replace with the actual URL and query parameters
        xhttp.send();
    }

    </script>
    <script>

      function confirmRemove2(url,status,id,val) {
        // alert('asd')
      swal({
        title: "Are you sure?",
        text: "Deactivating and Activating will effect the trains on the run..!!",
        icon: "info",
        buttons: ["Cancel", "Process"],
        dangerMode: true,
      }).then((willRemove) => {
        if (willRemove) {

    $.ajax({
        url: url, // Replace with the URL of your PHP controller
        type: 'GET',
        data: {status:status,id:id,val:val },
        success: function(response) {
          selectedValue = $('#day').val()
          loadTextFromPage(selectedValue)
        },
        error: function(xhr, status, error) {
            // Handle the error response from the server
            alert('Error updating station:', error);
            // Additional error handling or UI updates
        }
    });

          
        } else {
          swal("Scedule Status is not Changed.");
        }
      });
    }
</script>

<?php include('footer.php') ?>