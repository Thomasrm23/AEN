<?php

require_once __DIR__ . '/../DataBaseManager.php';
require_once __DIR__ . '/../manager/RegisterCustomerManager.php';

    header("Access-Control-Allow-Origin: *");
    header('Content-type: application/json');

//echo var_dump($_POST['data']);
//echo(json_decode($_GET['data']));
$json = json_decode($_POST['data'], true);
//$json = json_encode($_POST['data'], true);
//var_dump($json);
//print_r($json);
//echo($json['data']);
//var_dump($json['lastName']);
echo($json['lastname']);

if (isset($json['lastName'])){

    echo "is seettt";

    $manager = new DataBaseManager();
    $registerCustomer = new RegisterCustomerManager($manager);

    $result = $registerCustomer->register($json['lastName']);


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
