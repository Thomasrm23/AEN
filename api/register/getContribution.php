<?php


require_once __DIR__ . '/../DataBaseManager.php';
require_once __DIR__ . '/../manager/RegisterMemberManager.php';

header("Access-Control-Allow-Origin: *");
//  header('Content-type: application/json');

session_start();

$manager = new DataBaseManager();
$contributionManager = new RegisterMemberManager($manager);

// Recuperation cotisation
if(isset($_SESSION['idMember'])){
    $idMember = $_SESSION['idMember'];
    $contribution = $contributionManager->getContribution($idMember);
}

if ($contribution != null) {
    echo json_encode($contribution);
    http_response_code(200);
    die();
}

http_response_code(400);
die();
