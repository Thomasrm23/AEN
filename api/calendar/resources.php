<?php

require_once __DIR__ . '/../DataBaseManager.php';

//header('Content-type: application/json');

// Connexion BDD
$manager = new DatabaseManager();

  try {

    // Connect to database
    $connection = $manager->getPdo();

    // Requete pour recuperer les resources Avions et Instructeurs
    $query = "(SELECT 'A' as 'type', '0' as 'id', 'ENGINS :' as 'name' FROM aircraft)
      UNION (SELECT 'A' as 'type', idAircraft as 'id', name as 'name' FROM aircraft)
      UNION (SELECT 'I' as 'type', '0' as 'id', 'INSTRUCTEURS :' as 'name' FROM instructor)
      UNION (SELECT 'I' as 'type', idInstructor as 'id', name as 'name' FROM instructor)";

      $sth = $connection->prepare($query);
      $sth->execute();

      // Returning array
      $events = array();

      // Fetch results
      while ($row = $sth->fetch(PDO::FETCH_ASSOC)) {
          $e = array();
          $e['id'] = $row['type'].$row['id'];
          $e['title'] = $row['name'];
          // Merge the event array into the return array
          array_push($events, $e);
      }

      // Output json for our calendar
      echo json_encode($events);
      exit();

  } catch (PDOException $e){
      echo $e->getMessage();
  }

 ?>
