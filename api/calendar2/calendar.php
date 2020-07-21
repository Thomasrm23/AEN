<?php

require_once __DIR__ . '/../DataBaseManager.php';

header('Content-type: application/json');

// Connexion BDD
$manager = new DatabaseManager();

// Liste des evenements
$json = array();

// Requete pour recuperer les evenements
$requete = "SELECT idActivity, name, dateBegin, dateEnd
  FROM activity INNER JOIN activitytype ON activity.idActivityType = activitytype.idActivityType
  WHERE (idAircraft IS NOT NULL AND dateBegin >= CURDATE())
  ORDER BY idActivity";

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
