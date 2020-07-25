<?php

require_once __DIR__ . '/../DataBaseManager.php';
require_once __DIR__ . '/../manager/ActivityManager.php';

header("Access-Control-Allow-Origin: *");
header('Content-type: application/json');

$json = json_decode($_POST['data'], true);

$manager = new DatabaseManager();
$activityManager = new ActivityManager($manager);

// Recherche si l'instructeur ou l'avion n'est pas deja reserve sur ce creneau
$exist = $activityManager->ifExistActivity($json['idAircraft'], $json['idInstructor'], $json['dateBegin'], $json['dateEnd']);

 if($exist == "ok"){
  // Mise a jour de l'activite avec les valeurs
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
  // Message si c'est le cas - demander de confirmer oui/non
  // Faire afficher le message contenu dans $exist (array)
  echo "ACTIVITE TROUVEE!";
  echo json_encode($exist);

 }



?>
