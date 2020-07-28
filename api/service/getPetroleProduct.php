<?php


require_once __DIR__ . '/../DataBaseManager.php';
require_once __DIR__ . '/../manager/ServiceManager.php';

    header("Access-Control-Allow-Origin: *");
    header('Content-type: application/json');

$manager = new DataBaseManager();
$serviceManager = new ServiceManager($manager);
$petrole = $serviceManager->getPetroleProduct();

if ($petrole != null) {
    echo json_encode($petrole);
    http_response_code(200);
    die();
}

http_response_code(400);
die();
