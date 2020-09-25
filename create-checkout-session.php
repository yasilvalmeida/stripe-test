<?php
	ini_set('display_errors',1);
	error_reporting(E_ALL);
	
	require_once 'shared.php';
	
	$quantity = $body->quantity;
	$price = $body->price;
	$url = "http://$_SERVER[HTTP_HOST]/stripe-test/";
	// Create new Checkout Session for the order
	// Other optional params include:
	// [billing_address_collection] - to display billing address details on the page
	// [customer] - if you have an existing Stripe Customer ID
	// [customer_email] - lets you prefill the email input in the form
	// For full details see https://stripe.com/docs/api/checkout/sessions/create
	// ?session_id={CHECKOUT_SESSION_ID} means the redirect will have the session ID set as a query param
	
	$session = \Stripe\Checkout\Session::create(
		[
			'payment_method_types' => ['card'],
			'line_items' => [[
			'price_data' => [
				'currency' => 'usd',
				'product_data' => [
				'name' => 'T-shirt',
				],
				'unit_amount' => $price * 100,
			],
			'quantity' => $quantity,
			]],
			'mode' => 'payment',
			'success_url' => $url.'success.html',
			'cancel_url' => $url.'cancel.html',
		]
	);
	echo json_encode(['sessionId' => $session['id']]);
?>