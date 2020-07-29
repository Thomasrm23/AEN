<?php

require_once __DIR__ . '/../DataBaseManager.php';
require_once __DIR__ . '/../manager/ActivityManager.php';

//header('Content-type: application/json');

// Recuperation de l'activite a Supprimer
// $idActivity = $_POST['event.id'];
$idActivity = $_POST['pk'];

// Connexion BDD
$manager = new DatabaseManager();
$activityManager = new ActivityManager($manager);

$result = $activityManager->deleteActivity($idActivity);

if($result == "ok"){
  header("Location: ../../html/planning.html");
}
else{
  http_response_code(402);
  echo json_encode($result);
  die();
}

 ?>
