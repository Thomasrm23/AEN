<?php


require_once __DIR__ . '/../DataBaseManager.php';
require_once __DIR__ . '/../manager/ActivityManager.php';

    header("Access-Control-Allow-Origin: *");
    header('Content-type: application/json');

$manager = new DataBaseManager();
$activityManager = new ActivityManager($manager);
$activity = $activityManager->getActivityType();

if ($activity != null) {
    echo json_encode($activity);
    http_response_code(200);
    die();
}

http_response_code(400);
die();
