<?php

require_once __DIR__ . '/../DataBaseManager.php';
require_once  __DIR__ . '/../models/Activity.php';
//require_once  __DIR__ . '/../manager/AccountManager.php';

class ActivityManager{
    private DataBaseManager $manager;

    public function __construct($manager)
    {
        $this->manager = $manager;
    }

    public function addActivityRequest($dateRequest, $activity, $idMember){
      //
       $error = new ArrayObject();
      //
      //
      // $dateRequest = date_create($dateRequest);
      // if (checkdate($dateRequest->format('m'), $dateRequest->format('d'), $dateRequest->format('Y'))){
      //     $dateMin = date_create("01-01-1920"); //today
      //     if($dateMin > $dateRequest){
      //         $error->append("dateError");
      //     }
      // }
      //
      // if (count($error) == 0) {
      //
      //   $error->append($dateRequest);


              $date = date_create($dateRequest);
              if (checkdate($date->format('m'), $date->format('d'), $date->format('Y'))){
                  $dateMin = date_create("01-01-1920");
                  if($dateMin > $date){
                      $error->append("dateError");
                  }

                  $dateMin  = $this->timestampToDate($this->getNewDate(time(), - (10 * 365) ));
                  $dateMin = date_create($dateMin);
                  if($dateMin < $date){
                      $error->append("tooYoung");
                  }

              }

              if (count($error) == 0) {
                $error->append($dateRequest);

            $this->manager->exec('INSERT INTO activityrequest (dateRequested, idActivity, idMember) VALUES (?,?,?)', [
                $dateRequest,
                $activity,
                $idMember
            ]);

            return "ok";
        }else{
            return $error;
        }

    }

    public function getRandomStr($n) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }

        return $randomString;
    }

    public function getActivity(){
        $found = $this->manager->getAll('SELECT * from activity');
        return $found;
    }

}
