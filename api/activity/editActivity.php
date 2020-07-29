<?php

require_once __DIR__ . '/../DataBaseManager.php';
require_once __DIR__ . '/../manager/ActivityManager.php';

header("Access-Control-Allow-Origin: *");
// header('Content-type: application/json');

$json = json_decode($_POST['data'], true);
$error = new ArrayObject();

$manager = new DatabaseManager();
$activityManager = new ActivityManager($manager);

// Si engin selectionnee et dates
if (empty($json['idAircraft']) == false) {
    if( (empty($json['dateBegin']) == false) && (empty($json['dateEnd']) == false) ){

      if( ($json['instructorNeeded'] == 1) && ($json['idInstructor']) == "" ) {
        $error->append("InstructorNeeded");
        http_response_code(400);
        echo json_encode($error);
        die();
      }

      $result = $activityManager->updateActivity($json['idActivity'], $json['idInstructor'], $json['idAircraft'], $json['dateBegin'], $json['dateEnd'], $json['instructorNeeded']);

      if($result == "ok"){
        http_response_code(200);
        die();

        }else{
          http_response_code(402);
          echo json_encode($result);
          die();
        }

      }else{
        $error->append("DatesNeeded");
        http_response_code(400);
        echo json_encode($error);
        die();
      }
  }else{
    $error->append("AircraftNeeded");
    http_response_code(400);
    echo json_encode($error);
    die();
}

?>
