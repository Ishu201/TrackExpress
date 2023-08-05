<?php
// Start the session (if not already started)
session_start();

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect the user to the login page or any other desired page after logging out
header("Location: http://localhost/TrackExpress/app/system/views/"); // Replace "login.php" with your desired page
exit();
?>
