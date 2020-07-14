<?php


require_once __DIR__ . '/../DataBaseManager.php';
require_once __DIR__ . '/../manager/RegisterMemberManager.php';

    header("Access-Control-Allow-Origin: *");
  //  header('Content-type: application/json');

    session_start();

//  $json = json_decode($_POST['data'], true);

$manager = new DataBaseManager();
$contributionManager = new RegisterMemberManager($manager);

//if (isset($json['birthDate']) && isset($json['memberOutside']) && checkdate($json['birthDate']->format('m'), $json['birthDate']->format('d'), $json['birthDate']->format('Y'))) {
if(isset($_SESSION['idMember'])){

    $contribution = $contributionManager->getContribution($_SESSION['idMember']);
}
//}
if ($contribution != null) {
    echo json_encode($contribution);
    http_response_code(200);
    die();
}

http_response_code(400);
die();
