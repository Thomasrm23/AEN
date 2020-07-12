<?php

require_once __DIR__ . '/../DataBaseManager.php';
require_once __DIR__ . '/../manager/RegisterMemberManager.php';

  //  header("Access-Control-Allow-Origin: *");
    //header('Content-type: application/json');

$json = json_decode($_POST['data'], true);

if (isset($json['lastName']) &&
    isset($json['firstName']) &&
    isset($json['birthDate']) &&
    isset($json['memberOutside']) &&
    isset($json['clubOutside']) &&
    isset($json['license']) &&
    isset($json['email']) &&
    isset($json['login']) &&
    isset($json['password']) &&
    isset($json['confirmPassword'])){

    $manager = new DataBaseManager();
    $registerMember = new RegisterMemberManager($manager);

    $result = $registerMember->register($json['lastName'],
        $json['firstName'],
        $json['birthDate'],
        $json['memberOutside'],
        $json['clubOutside'],
        $json['license'],
        $json['email'],
        $json['login'],
        $json['password'],
        $json['confirmPassword']);



    if($result == "ok"){
      // repasser l'amount vers la page de payment

      if (checkdate($json['birthDate']->format('m'), $json['birthDate']->format('d'), $json['birthDate']->format('Y'))){
        $contribution = $registerMember->getContribution($json['birthDate'],
        $json['memberOutside']);  // peut etre tabbbb
        if ($contribution != null) {
            echo json_encode($contribution);
        }

      }

        http_response_code(200);
        die();
    }
    else{
    http_response_code(402);
    echo json_encode($result);
    die();
    }
}
else{

http_response_code(400);
echo "empty";
//echo json_encode($contribution);
die();
}
