<?php

require_once __DIR__ . '/../DataBaseManager.php';
require_once __DIR__ . '/../manager/ActivityManager.php';
require_once  __DIR__ . '/../manager/AccountManager.php';

header("Access-Control-Allow-Origin: *");
// header('Content-type: application/json');

session_start();
$json = json_decode($_POST['data'], true);
$error = new ArrayObject();

if(isset($_SESSION['idMember'])){
    $idMember = $_SESSION['idMember'];
}
else{
    http_response_code(402);
    die();
}

// Si activite selectionnee
 if(empty($json['activity']) == false){

  // Si activite location d'avion ou lecon de pilotage, verifier les champs utilisation et nb heures renseignes
  if(($json['activity'] == "4") || ($json['activity'] == "5")){
    // if((empty($json['utility']) == false) && (empty($json['nbHours']) == false)) {
    if(($json['nbHours'] > 0) && (($json['utility'] == "ECOLE") || ($json['utility'] == "VOYAGE"))) {
      $validate = true;
    } else {
      $validate = false;
    }
  } else {
    $validate = true;
  }

  // Si verification precedente validee, on continue
  if ($validate == true){

      $manager = new DataBaseManager();
      $activityManager = new ActivityManager($manager);

      $result = $activityManager->addActivity($json['activity'], $json['utility'], $json['nbHours'], $idMember);

      if($result == "ok"){
          http_response_code(200);
          die();
      }
      else{
        http_response_code(402);
        echo json_encode($result);
        die();
      }

  // Si verification precedente non validee, retour
  } else {
    $error->append("requiredplane");
    http_response_code(400);
    echo json_encode($error);
    die();
  }

}
else{
  $error->append("requiredfields");
  http_response_code(400);
  echo json_encode($error);
  // echo json_encode($);
  die();
}
