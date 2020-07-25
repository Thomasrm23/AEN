<?php

require_once __DIR__ . '/../DataBaseManager.php';
require_once __DIR__ . '/../manager/RegisterMemberManager.php';

header("Access-Control-Allow-Origin: *");
 // header('Content-type: application/json');

$json = json_decode($_POST['data'], true);
echo $json['idMember'];
//
// $manager = new DatabaseManager();
// $registerMember = new RegisterMemberManager($manager);
// $account = $registerMember->deleteMember($json['idMember']);
//
// if($account == "ok"){
//   http_response_code(200);
//   die();
// }
//   http_response_code(402);
//   echo json_encode($result);
//   die();

?>
