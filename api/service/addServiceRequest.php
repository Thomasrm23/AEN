<?php

require_once __DIR__ . '/../DataBaseManager.php';
require_once __DIR__ . '/../manager/ServiceManager.php';
require_once  __DIR__ . '/../manager/AccountManager.php';

    header("Access-Control-Allow-Origin: *");
    // header('Content-type: application/json');

 $json = json_decode($_POST['data'], true);
  // echo $json['serviceDate'];

 session_start();

// var_dump($json);
$manager = new DataBaseManager();
$serviceManager = new ServiceManager($manager);

if(isset($_SESSION['idCustomer'])){
    $idCustomer = $_SESSION['idCustomer'];
}
else{
    http_response_code(402);
    die();
}
// verifier si au moins 1 service coché
// if (isset($json['landing'])){


    $service = $serviceManager->addServiceRequest($idCustomer, $json['serviceDate'], $json['landing'], $json['planeTypeChoice'], $json['basedChoice'], $json['markupDuration']);

    if($service == "ok"){
        http_response_code(200);
        die();
    }
    http_response_code(402);
      echo json_encode($service);
    die();
// }

http_response_code(400);
echo "empty";
die();
