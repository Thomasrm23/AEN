<?php

require_once __DIR__ . '/../DataBaseManager.php';
require_once __DIR__ . '/../manager/ActivityManager.php';

header("Access-Control-Allow-Origin: *");
header('Content-type: application/json');

$json = json_decode($_POST['data'], true);

$manager = new DatabaseManager();
$activityManager = new ActivityManager($manager);
$result = $activityManager->updateActivity($json['idActivity'], $json['idInstructor'], $json['idAircraft'], $json['dateBegin'], $json['dateEnd'], $json['instructorNeeded']);

if($result == "ok"){
  http_response_code(200);
  die();
}
  http_response_code(402);
  //echo json_encode($result);
  die();


?>
