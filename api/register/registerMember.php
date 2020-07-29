<?php

require_once __DIR__ . '/../DataBaseManager.php';
require_once __DIR__ . '/../manager/RegisterMemberManager.php';

header("Access-Control-Allow-Origin: *");
header('Content-type: application/json');


$json = json_decode($_POST['data'], true);

$error = new ArrayObject();

if (isset($json['lastName']) &&
    isset($json['firstName']) &&
    isset($json['address']) &&
    isset($json['postalCode']) &&
    isset($json['city']) &&
    isset($json['phoneNumber']) &&
    isset($json['birthDate']) &&
    isset($json['license']) &&
    isset($json['email']) &&
    isset($json['login']) &&
    isset($json['password']) &&
    isset($json['confirmPassword'])){

    $manager = new DataBaseManager();
    $registerMember = new RegisterMemberManager($manager);

    $result = $registerMember->register(
        0,
        0,
        $json['lastName'],
        $json['firstName'],
        $json['address'],
        $json['postalCode'],
        $json['city'],
        $json['phoneNumber'],
        $json['birthDate'],
        $json['memberOutside'],
        $json['clubOutside'],
        $json['license'],
        $json['email'],
        $json['login'],
        $json['password'],
        $json['confirmPassword']);

    if($result == "ok"){
      http_response_code(200);
      die();
    }
    else{
      http_response_code(402);
      echo json_encode($result);
      die();
    }
}
else{
  $error->append("requiredfields");
  http_response_code(400);
  echo json_encode($error);
  die();
}
