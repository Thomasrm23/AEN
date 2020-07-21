<?php

require_once __DIR__ . '/../DataBaseManager.php';
require_once __DIR__ . '/../manager/ActivityManager.php';

header("Access-Control-Allow-Origin: *");
header('Content-type: application/json');

// Connexion BDD
$manager = new DatabaseManager();
$activityManager = new ActivityManager($manager);
$aircraft = $activityManager->getAircraftName();

// Liste des evenements
//$json = array();

// Requete pour recuperer les evenements
// $requete = "SELECT idAircarft, name
//   FROM aircraft
//   ORDER BY idAircraft";

// Execution requete
//$resultat = $this->manager->getAll($requete);

if ($aircraft != null){
    echo json_encode($aircraft);
    http_response_code(200);
    die();
}

http_response_code(400);
die();

 ?>
