<?php

require_once __DIR__ . '/../DataBaseManager.php';
require_once __DIR__ . '/../manager/ActivityManager.php';

header("Access-Control-Allow-Origin: *");
 // header('Content-type: application/json');

$json = json_decode($_POST['data'], true);

$manager = new DatabaseManager();
$activityManager = new ActivityManager($manager);
$activity = $activityManager->deleteActivity($json['idActivity']);

  }

 }


?>
