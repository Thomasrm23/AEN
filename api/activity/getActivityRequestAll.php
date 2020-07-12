<?php


require_once __DIR__ . '/../DataBaseManager.php';
require_once __DIR__ . '/../manager/ActivityManager.php';
require_once __DIR__ . '/../manager/AccountManager.php';

    header("Access-Control-Allow-Origin: *");
    header('Content-type: application/json');

session_start();

$manager = new DatabaseManager();
$accountManager = new AccountManager($manager);
$activityManager = new ActivityManager($manager);

$activity = $activityManager->getActivityRequestAll();

?>
<?php
if ($activity != null){
    echo json_encode($activity);
    http_response_code(200);
    die();
}

http_response_code(400);
die();

?>
