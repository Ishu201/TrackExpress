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