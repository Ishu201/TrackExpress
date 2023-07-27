<!-- edify-wonder-adroit-leads    - stripe login

{
  "id": "prod_OAhXSHoEWCkdl2",
  "object": "product",
  "active": true,
  "attributes": [],
  "created": 1688050043,
  "default_price": null,
  "description": "Shopee Order Payment",
  "images": [],
  "livemode": false,
  "metadata": {},
  "name": "Total Amount",
  "package_dimensions": null,
  "shippable": null,
  "statement_descriptor": null,
  "tax_code": null,
  "type": "service",
  "unit_label": null,
  "updated": 1688050043,
  "url": null
}

stripe products create  --name="Total Amount"  --description="Shopee Order Payment"
stripe prices create  --unit-amount=3000  --currency=lkr  --product="{{prod_OAhXSHoEWCkdl2}}" -->

<?php

$id = $_GET['id'];
$price = $_GET['price'];
$name = $_GET['name'];

$price = (int)($price * 100); // Convert the price to an integer without decimals and in the smallest currency unit (e.g., cents).



require_once('../../../vendor/autoload.php');

$stripe = new \Stripe\StripeClient("sk_test_51NHnWuSCKBfIrcyXwCr4xfCHmluqrABBmnYVIrUb5THCneO8jGlcFjOisxovzAiun9tssDqKe0tfwzKQCbv64FOe00KnoL3VTD");

// $customer = $stripe->customers->create([
//     'name' => 'customer',
//     'email' => 'ishu@gmail.com',
//     'address' => [
//         'city' => 'Theldeniya',
//         'country' => 'SR',
//         'line1' => 'Address 1',
//         'line2' => 'Address 2',
//         'postal_code' => '+94',
//       ],
//   ]);


$product = $stripe->products->create([
  'name' => 'TrackExpress',
  'description' => 'Train Journey Booking',
  'images' => ['images/title.png'],
]);

$price = $stripe->prices->create([
  'unit_amount' => $price, //use .00 without the .
  'currency' => 'lkr',
  'product' => $product['id'],
]);

$session = $stripe->checkout->sessions->create([
    'payment_method_types' => ['card'],
    'line_items' => [
        [
            'price' => $price->id,
            'quantity' => 1,
        ],
    ],
    'customer_email' => $name,
    'success_url' => 'http://localhost/TrackExpress/app/website/views/success.php?session_id={CHECKOUT_SESSION_ID}',
    'cancel_url' => 'http://localhost/TrackExpress/app/website/views/index.php',
    'billing_address_collection' => 'required',
    'payment_intent_data' => [
        'description' => 'Booking ID',
    ],
    'metadata' => [
        'custom_message' => 'Thank you for your payment.',
        'booking_id' => $id,
    ],
    'mode' => 'payment',
]);


  
  $paymentLink = $session->url;

  header("Location: $paymentLink");

?>