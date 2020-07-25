<?php

require_once __DIR__ . '/../DataBaseManager.php';
require_once __DIR__ . '/../manager/ActivityManager.php';

header("Access-Control-Allow-Origin: *");
 // header('Content-type: application/json');

// Verifier si une ligne est cochee
if(isset($_POST["activityChecked"])){
  $idActivity = $_POST["activityChecked"];
  echo $idActivity;
  $manager = new DatabaseManager();
  $activityManager = new ActivityManager($manager);
  $activity = $activityManager->deleteActivity($idActivity);
}

if($activity == "ok"){
  header("Location: ../../html/activityPlan.php");
}

?>
