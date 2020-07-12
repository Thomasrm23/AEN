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

    public function addActivityRequest($dateRequest, $activity, $utility, $nbHours, $idMember){
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


              // $date = date_create($dateRequest);
              // if (checkdate($date->format('m'), $date->format('d'), $date->format('Y'))){
              //     $dateMin = date_create("01-01-1920");
              //     if($dateMin > $date){
              //         $error->append("dateError");
              //     }
              //
              //     $dateMin  = $this->timestampToDate($this->getNewDate(time(), - (10 * 365) ));
              //     $dateMin = date_create($dateMin);
              //     if($dateMin < $date){
              //         $error->append("tooYoung");
              //     }
              //
              // }

              if (count($error) == 0) {
                // $error->append($dateRequest);

            $this->manager->exec('INSERT INTO activityrequest (dateRequested, utility, nbHours, idActivity, idMember ) VALUES (?,?,?,?,?)', [
                $dateRequest,
                $utility,
                $nbHours,
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

  //  SELECT `idActivityRequest`, `dateRequested`, `booked`, `activity`.`name` FROM `activityrequest` INNER JOIN `activity` ON `activityrequest`.`idActivity` = `activity`.`idActivity`
  public function getActivityRequest($idMember){
  //  public function getActivityRequest($idMember){
      $found = $this->manager->getAll('SELECT idActivityRequest, dateRequested, booked, utility, nbHours, activity.name from activityrequest INNER JOIN activity ON activityrequest.idActivity = activity.idActivity WHERE idMember = ?', [$idMember]);
        return $found;
    }

    public function getActivityRequestAll(){
        $found = $this->manager->getAll('SELECT idActivityRequest, dateRequested, booked, utility, nbHours, activity.name AS "nameActivity", activity.instructorNeeded, aircrafttype.name AS "nameAircrafttype" from activityrequest INNER JOIN activity ON activityrequest.idActivity = activity.idActivity INNER JOIN aircrafttype ON  aircrafttype.idAircraftType = activity.idAircraftType WHERE booked = 0');
        return $found;
        // INNER JOIN aircrafttype ON  aircrafttype.idAircraftType = activity.idAircraftType
    }

    public function getActivityRequestAllBooked(){
      $found = $this->manager->getAll('SELECT idActivityRequest, dateRequested, booked, utility, nbHours, activity.name AS "nameActivity", activity.instructorNeeded, aircrafttype.name AS "nameAircrafttype" from activityrequest INNER JOIN activity ON activityrequest.idActivity = activity.idActivity INNER JOIN aircrafttype ON  aircrafttype.idAircraftType = activity.idAircraftType WHERE booked = 1');
      return $found;
    }

}
