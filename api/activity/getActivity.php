<?php


require_once __DIR__ . '/../DataBaseManager.php';
require_once __DIR__ . '/../manager/ActivityManager.php';
require_once __DIR__ . '/../manager/AccountManager.php';

    header("Access-Control-Allow-Origin: *");
    header('Content-type: application/json');

session_start();

$manager = new DatabaseManager();
// $accountManager = new AccountManager($manager);
$activityManager = new ActivityManager($manager);

if(isset($_SESSION['idMember'])){
  // $idMemberArray = $accountManager->getIdMemberFromToken($_SESSION['token']);  // crochet ?
  // $idMember = $idMemberArray['idMember'];
  $idMember = $_SESSION['idMember'];

  $activity = $activityManager->getActivity($idMember);

}

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
