<?php

require_once __DIR__ . '/../DataBaseManager.php';
require_once __DIR__ . '/../manager/RegisterMemberManager.php';

header("Access-Control-Allow-Origin: *");
// header('Content-type: application/json');

$json = json_decode($_POST['data'], true);

$manager = new DatabaseManager();
$registerMember = new RegisterMemberManager($manager);

$result = $registerMember->register(
    $json['idUser'],
    $json['idMember'],
    $json['lastName'],
    $json['firstName'],
    $json['birthDate'],
    $json['memberOutside'],
    $json['clubOutside'],
    $json['license'],
    $json['contributionPayed'],
    $json['contributionDate'],
    $json['email'],
    $json['login'],
    $json['password'],
    $json['confirmPassword']);

if($result == "ok"){
    http_response_code(200);
    die();
}
else {
    http_response_code(402);
    echo json_encode($result);
    die();
}

?>
