<?php

require_once('vendor/autoload.php');

require_once __DIR__ . '/../api/DataBaseManager.php';
require_once __DIR__ . '/../api/manager/ServiceManager.php';
require_once __DIR__ . '/../api/models/PaymentService.php';



session_start();

  \Stripe\Stripe::setApiKey('sk_test_43SYZInY9tX2lsg26AKzN2Lf00XPo3OYfF');

 // Sanitize POST Array
 $POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);

 $cardHolder = $POST['cardHolder'];
 $token = $POST['stripeToken'];

// Create Customer In Stripe
$customer = \Stripe\Customer::create(array(
  "source" => $token
));

$manager = new DataBaseManager();
$serviceManager = new ServiceManager($manager);


if(isset($_SESSION['amount']) && isset($_SESSION['idRequest'])){    // && isset idcusto
  $amount = $_SESSION['amount']*100;
  $idRequest = $_SESSION['idRequest'];
}


// Charge Customer
$charge = \Stripe\Charge::create(array(
  "amount" => $amount,
  "currency" => "eur",
  "customer" => $customer->id
));

 // Customer Data
 $customerData = [
   'id' => $charge->customer,
    'cardHolder' => $cardHolder
 ];



// Transaction Data
$paymentData = [
  'id' => $charge->id,
  'customer_id' => $charge->customer,
  // 'product' => $charge->description,
  'amount' => $charge->amount,
  'currency' => $charge->currency,
  'status' => $charge->status,
  'idRequest' => $idRequest
];

// Instantiate Transaction
$paymentService = new PaymentService();

// Add Transaction To DB
$paymentService->addPaymentService($paymentData);

$updateStateRequest = $serviceManager->updateStateRequest($idRequest, $amount);
if($updateStateRequest == "ok"){

  // Redirect to success
  // header("Location: ../html/successService.php?id='.$charge->id.'&cardHolder='.$cardHolder.'&idRequest='.$idRequest");
  header('Location: ../html/successService.php?id='.$charge->id.'&cardHolder='.$cardHolder.'&idRequest='.$idRequest);

}
else {
  header('Location: index.html');
}
