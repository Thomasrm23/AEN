<?php

require_once __DIR__ . '/../DataBaseManager.php';
require_once __DIR__ . '/../manager/ActivityManager.php';


    header("Access-Control-Allow-Origin: *");
    //header('Content-type: application/json');

 $json = json_decode($_POST['data'], true);
  //echo $json['idActivity'];


  // if (isset($json['idActivity'])){
    if (isset($json['idActivity']) && isset($json['dateBegin']) && isset($json['dateEnd'])){

    $manager = new DataBaseManager();
    $activityManager = new ActivityManager($manager);

    // $activityManager->updateActivity($json['idActivity']);
    $activityManager->updateActivity($json['idActivity'], $json['dateBegin'], $json['dateEnd']);

    // if($result == "ok"){
         http_response_code(200);
         die();
     //}
     http_response_code(402);
       echo json_encode($result);
     die();
 }

 http_response_code(400);
 // echo $json['idActivity'];
 // echo $json['dateBegin'];
 // echo $json['dateEnd'];
 // echo "empty";
 die();
