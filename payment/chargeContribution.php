<?php

require_once('vendor/autoload.php');

require_once __DIR__ . '/../api/DataBaseManager.php';
require_once __DIR__ . '/../api/manager/RegisterMemberManager.php';

require_once __DIR__ . '/../api/models/PaymentContribution.php';

// tout a changer

  // require_once __DIR__ . '\..\DataBaseManager.php';

session_start();

  \Stripe\Stripe::setApiKey('sk_test_43SYZInY9tX2lsg26AKzN2Lf00XPo3OYfF');

 // Sanitize POST Array
 $POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);

 $cardHolder = $POST['cardHolder'];
 $token = $POST['stripeToken'];

// Create Customer In Stripe
$customer = \Stripe\Customer::create(array(
  // "email" => $email,
  "source" => $token
));

// $manager = new DatabaseManager();
// $interventionManage = new InterventionManage($manager);
// $intervention = $interventionManage->getInterventionPay();

$manager = new DataBaseManager();
//$contributionManager = new RegisterMemberManager($manager);

if(isset($_SESSION['contribution'])){
  $amount = $_SESSION['contribution'];
}
//
// if(isset($_SESSION['idMember'])){
//
//     $contribution = $contributionManager->getContribution($_SESSION['idMember']);
// }
// $amount = $contribution[0]['feeContribution'];

//$amount = $intervention['duration'] * $intervention['price']*100;

// Charge Customer
$charge = \Stripe\Charge::create(array(
  "amount" => $amount,
  "currency" => "eur",
  // "description" => $intervention['title'],
  "customer" => $customer->id
));

 // Customer Data
 $customerData = [
   'id' => $charge->customer,
    'cardHolder' => $cardHolder,
//   // 'last_name' => $last_name,
//   // 'email' => $email
 ];
//
// // Instantiate Customer
// $customerPay = new CustomerPay();
//
// // Add Customer To DB
// $customerPay->addCustomerPay($customerData);


// Transaction Data
$paymentData = [
  'id' => $charge->id,
  'customer_id' => $charge->customer,
  // 'product' => $charge->description,
  'amount' => $charge->amount,
  'currency' => $charge->currency,
  'status' => $charge->status,
  'idMember' => $_SESSION['idMember']
];

// Instantiate Transaction
$paymentContribution = new PaymentContribution();

// Add Transaction To DB
$paymentContribution->addPaymentContribution($paymentData);



// Redirect to success
header('Location: ../html/success.php?id='.$charge->id.'&cardHolder='.$cardHolder);
// header('Location: index.html');
