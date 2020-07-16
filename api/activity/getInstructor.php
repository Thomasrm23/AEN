<?php


require_once __DIR__ . '/../DataBaseManager.php';
require_once __DIR__ . '/../manager/ActivityManager.php';

    header("Access-Control-Allow-Origin: *");
    header('Content-type: application/json');

$manager = new DataBaseManager();
$activityManager = new ActivityManager($manager);
$instructor = $activityManager->getInstructor();

if ($instructor != null) {
    echo json_encode($instructor);
    http_response_code(200);
    die();
}

http_response_code(400);
die();
