<?php

require_once __DIR__ . '/../DataBaseManager.php';

header("Access-Control-Allow-Origin: *");
header('Content-type: application/json');

// Connexion BDD
$manager = new DatabaseManager();

// Liste des evenements
$json = array();
echo 'zdh';
// Requete pour recuperer les evenements
$requete = "SELECT idAircarft, name
  FROM aircraft
  ORDER BY idAircraft";

// Execution requete
$resultat = $this->manager->getAll($requete);

if ($resultat != null){
    echo json_encode($resultat);
    http_response_code(200);
    die();
}

http_response_code(400);
die();

 ?>
