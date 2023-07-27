<?php
require '../../../vendor/autoload.php';
$stripe = new \Stripe\StripeClient('sk_test_51NHnWuSCKBfIrcyXwCr4xfCHmluqrABBmnYVIrUb5THCneO8jGlcFjOisxovzAiun9tssDqKe0tfwzKQCbv64FOe00KnoL3VTD');

try {
    $session_id = $_GET['session_id'];

    $session = $stripe->checkout->sessions->retrieve($session_id, []);
    $bookID = $session->metadata->booking_id;

    echo "<h1>Thanks for your Booking, $session->customer_email! Your Booking is Completed</h1>";
  http_response_code(200);
  header("Location:complete_checkout.php?id=$bookID&name=$session->customer_email");
} catch (Error $e) {
  http_response_code(500);
  echo json_encode(['error' => $e->getMessage()]);
  header("Location:error_checkout.php");
}