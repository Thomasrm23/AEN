<?php

require_once __DIR__ . '/../DataBaseManager.php';
require_once __DIR__ . '/../manager/ServiceManager.php';
require_once  __DIR__ . '/../manager/AccountManager.php';

    header("Access-Control-Allow-Origin: *");
     // header('Content-type: application/json');

 $json = json_decode($_POST['data'], true);
 // echo $json['endDate'];
 // echo $json['beginDate'];
 // echo $json['parkingType'];
 // echo $json['endDate'];

// echo $json['serviceDate'];
// echo $json['landing'];
//  echo $json['planeTypeChoice'];
//  echo $json['basedChoice'];
//  echo $json['markupDuration'];
//  echo $json['provisioning'];
//  echo $json['petrole'];
//  echo $json['quantity'];
//  echo $json['parking'];
//  echo $json['parkingType'];
//  echo $json['beginDate'];
//  echo $json['endDate'];

// echo $json['acousticGroup'];

$error = new ArrayObject();

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
 if (isset($idCustomer) && isset($json['serviceDate']) && isset($json['basedChoice'])){


    $service = $serviceManager->addServiceRequest($idCustomer, $json['serviceDate'], $json['landing'], $json['planeTypeChoice'], $json['acousticGroup'], $json['basedChoice'], $json['dayweek'], $json['markupDuration'], $json['provisioning'], $json['petrole'],
    $json['quantity'], $json['parking'], $json['parkingType'], $json['tariffType'], $json['groundArea'], $json['mass'], $json['beginDate'], $json['endDate'], $json['cleaning'], $json['weather']);

    if($service == "ok"){
        http_response_code(200);
        die();
    }else{
    http_response_code(402);
    echo json_encode($service);
    die();
    }
  }
  else{
    $error->append("requireService");
    http_response_code(400);
    echo json_encode($error);
    die();
}
