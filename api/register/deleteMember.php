<?php

require_once __DIR__ . '/../DataBaseManager.php';
require_once __DIR__ . '/../manager/RegisterMemberManager.php';

header("Access-Control-Allow-Origin: *");
// header('Content-type: application/json');

// Verifier si une ligne est cochee
if(isset($_POST["memberChecked"])){
  $idMember = $_POST["memberChecked"]
  $manager = new DatabaseManager();
  $registerMember = new RegisterMemberManager($manager);
  $account = $registerMember->deleteMember($idMember);
}

if($account == "ok"){
  header("Location: ../../html/accountAdmin.php");
}

?>
