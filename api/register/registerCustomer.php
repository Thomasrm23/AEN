<?php

require_once __DIR__ . '/../DataBaseManager.php';
require_once __DIR__ . '/../manager/RegisterCustomerManager.php';

    header("Access-Control-Allow-Origin: *");
    header('Content-type: application/json');

$json = json_decode($_POST['data'], true);


if (isset($json['lastName']) && isset($json['firstName']) && isset($json['email']) && isset($json['country']) && isset($json['login']) && isset($json['password']) && isset($json['confirmPassword'])){


    $manager = new DataBaseManager();
    $registerCustomer = new RegisterCustomerManager($manager);

    $result = $registerCustomer->register($json['lastName'] ,
    $json['firstName'],
    $json['email'],
    $json['country'],
    $json['login'],
    $json['password'],
    $json['confirmPassword']
);


    if($result == "ok"){
        http_response_code(200);
        die();
    }
    http_response_code(402);
    echo json_encode($result);
    die();
}
http_response_code(400);
echo "empty";
die();
