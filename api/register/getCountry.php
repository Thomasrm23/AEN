<?php


require_once __DIR__ . '/../DataBaseManager.php';
require_once __DIR__ . '/../manager/RegisterCustomerManager.php';

    header("Access-Control-Allow-Origin: *");
    header('Content-type: application/json');

$manager = new DataBaseManager();
$countryManager = new RegisterCustomerManager($manager);
$country = $countryManager->getCountry();

if ($country != null) {
    echo json_encode($country);
    http_response_code(200);
    die();
}

http_response_code(400);
die();
