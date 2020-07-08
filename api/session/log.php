<?php
//ini_set('display_errors', 1);
//error_reporting(E_ALL);

require_once __DIR__ . '/../DataBaseManager.php';
require_once __DIR__ . '/../manager/AccountManager.php';

    header("Access-Control-Allow-Origin: *");
    header('Content-type: application/json');


$json = json_decode($_POST['data'], true);

if (isset($json['login']) && isset($json['password'])){
    $manager = new DataBaseManager();
    $accountManager = new AccountManager($manager);

    $result = $accountManager->log($json['login'], $json['password']);

    if ($result){
        session_start();
        $_SESSION['token'] = $result;
        echo $result;
        http_response_code(200);
        die();
    }
    else{
        http_response_code(400);
        die();
    }
}
