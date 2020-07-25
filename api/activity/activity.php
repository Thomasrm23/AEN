<?php

require_once __DIR__ . '/../DataBaseManager.php';
require_once __DIR__ . '/../manager/ActivityManager.php';
require_once  __DIR__ . '/../manager/AccountManager.php';

    header("Access-Control-Allow-Origin: *");
    header('Content-type: application/json');


session_start();
 $json = json_decode($_POST['data'], true);
// echo $json['utility'];


$manager = new DataBaseManager();
$activityManager = new ActivityManager($manager);

// $accountManager = new AccountManager($manager);

if(isset($_SESSION['idMember'])){
  // $idMemberArray = $accountManager->getIdMemberFromToken($_SESSION['token']);
  // $idMember = $idMemberArray['idMember'];
    $idMember = $_SESSION['idMember'];
}
else{
    http_response_code(402);
    die();
}

if (isset($json['activity'])){


    $result = $activityManager->addActivity($json['activity'], $json['utility'], $json['nbHours'], $idMember);

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
