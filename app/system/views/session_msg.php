<?php if (isset($_SESSION['error'])) { ?>
    <div class="alert alert-danger alert-dismissible" style="width:fit-content;float:right" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <strong>Error..!</strong> <?php echo $_SESSION['error']; ?>
    </div>
<?php unset($_SESSION['error']);
} ?>

<?php if (isset($_SESSION['success'])) { ?>
    <div class="alert alert-success alert-dismissible" style="width:fit-content;float:right" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <strong>Done..!</strong> <?php echo $_SESSION['success']; ?>
    </div>
<?php unset($_SESSION['success']);
} ?>

<!-- Place this JavaScript code inside your HTML file, preferably just before the closing </body> tag -->
<script>
    // Function to remove the alert element after a specified delay
    function removeAlert(alertElement) {
        alertElement.style.display = 'none';
    }

    // Check if the error alert exists and set a timeout to remove it
    var errorAlert = document.querySelector('.alert-danger');
    if (errorAlert) {
        setTimeout(function() {
            removeAlert(errorAlert);
        }, 2000); // 2000 milliseconds = 2 seconds
    }

    // Check if the success alert exists and set a timeout to remove it
    var successAlert = document.querySelector('.alert-success');
    if (successAlert) {
        setTimeout(function() {
            removeAlert(successAlert);
        }, 2000); // 2000 milliseconds = 2 seconds
    }
</script>
