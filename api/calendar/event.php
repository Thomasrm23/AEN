<?php

require_once __DIR__ . '/../DataBaseManager.php';

//header('Content-type: application/json');

// Connexion BDD
$manager = new DatabaseManager();

  try {

    // Connect to database
    $connection = $manager->getPdo();

    // Requete pour recuperer les activites
      $query = "SELECT idActivity, activitytype.name AS 'nameActivity', dateBegin, dateEnd, idAircraft AS 'resource', 'A' AS 'type'
      FROM activity INNER JOIN activitytype ON activity.idActivityType = activitytype.idActivityType
      WHERE (idAircraft IS NOT NULL) AND (dateBegin > CURDATE())
      UNION SELECT idActivity, activitytype.name AS 'nameActivity', dateBegin, dateEnd, idInstructor AS 'resource', 'I' AS 'type'
      FROM activity INNER JOIN activitytype ON activity.idActivityType = activitytype.idActivityType
      WHERE (idInstructor IS NOT NULL) AND (dateBegin > CURDATE())
      ORDER BY idActivity";

      $sth = $connection->prepare($query);
      $sth->execute();

      // Returning array
      $events = array();

      // Fetch results
      //{ id: '1', resourceId: 'b', start: '2020-06-07T02:00:00', end: '2020-06-07T07:00:00', title: 'event 1' }
      while ($row = $sth->fetch(PDO::FETCH_ASSOC)) {
          $e = array();
          $e['id'] = $row['idActivity'];
          $e['resourceId'] = $row['type'].$row['resource'];
          $e['start'] = $row['dateBegin'];
          $e['end'] = $row['dateEnd'];
          $e['title'] = $row['nameActivity'].$row['idActivity'];
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
