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

    public function check_weekend($value) {
        $dateDay = $value->format('N');
        if ($dateDay == "6" || $dateDay == "7") return 1;
        else return 0;
    }

    public  function jour_ferie($timestamp){
    $jour = date("d", $timestamp);
    $mois = date("m", $timestamp);
    $annee = date("Y", $timestamp);
    $EstFerie = 0;
    // dates fériées fixes
    if($jour == 1 && $mois == 1) $EstFerie = 1; // 1er janvier
    if($jour == 1 && $mois == 5) $EstFerie = 1; // 1er mai
    if($jour == 8 && $mois == 5) $EstFerie = 1; // 8 mai
    if($jour == 14 && $mois == 7) $EstFerie = 1; // 14 juillet
    if($jour == 15 && $mois == 8) $EstFerie = 1; // 15 aout
    if($jour == 1 && $mois == 11) $EstFerie = 1; // 1 novembre
    if($jour == 11 && $mois == 11) $EstFerie = 1; // 11 novembre
    if($jour == 25 && $mois == 12) $EstFerie = 1; // 25 décembre
    // fetes religieuses mobiles
    $pak = easter_date($annee);
    $jp = date("d", $pak);
    $mp = date("m", $pak);
    if($jp == $jour && $mp == $mois){ $EstFerie = 1;} // Pâques
    $lpk = mktime(date("H", $pak), date("i", $pak), date("s", $pak), date("m", $pak)
    , date("d", $pak) +1, date("Y", $pak) );
    $jp = date("d", $lpk);
    $mp = date("m", $lpk);
    if($jp == $jour && $mp == $mois){ $EstFerie = 1; }// Lundi de Pâques
    $asc = mktime(date("H", $pak), date("i", $pak), date("s", $pak), date("m", $pak)
    , date("d", $pak) + 39, date("Y", $pak) );
    $jp = date("d", $asc);
    $mp = date("m", $asc);
    if($jp == $jour && $mp == $mois){ $EstFerie = 1;}//ascension
    $pe = mktime(date("H", $pak), date("i", $pak), date("s", $pak), date("m", $pak),
     date("d", $pak) + 49, date("Y", $pak) );
    $jp = date("d", $pe);
    $mp = date("m", $pe);
    if($jp == $jour && $mp == $mois) {$EstFerie = 1;}// Pentecôte
    $lp = mktime(date("H", $asc), date("i", $pak), date("s", $pak), date("m", $pak),
     date("d", $pak) + 50, date("Y", $pak) );
    $jp = date("d", $lp);
    $mp = date("m", $lp);
    if($jp == $jour && $mp == $mois) {$EstFerie = 1;}// lundi Pentecôte
    // Samedis et dimanches
    $jour_sem = jddayofweek(unixtojd($timestamp), 0);
    if($jour_sem == 0 || $jour_sem == 6) $EstFerie = 1;
    // ces deux lignes au dessus sont à retirer si vous ne désirez pas faire
    // apparaitre les
    // samedis et dimanches comme fériés.
    return $EstFerie;
  }


    public function addActivity($activityType, $utility, $nbHours, $idMember){
      //
    //   $error = new ArrayObject();




// verif date

//$date = ('2020-05-08');
// $datetime = date_create($dateRequest);
//
// $date23 = explode("-", $dateRequest);
//explode pour mettre la date du jour en format numerique: 31/05/2009  -> 31052009
// echo $date23[0];
// echo $date23[1];
// echo $date23[2];

//
// 	if(strtotime($dateRequest) > time()){
// 	   echo 'OK';
//
//      $datemd = $datetime->format('md');
//
//      if(($datemd >= '0415') && ($datemd <= '1015')) {
//      	echo 'Ouvert tous les jours';
//      }
//      else
//      {
//          echo 'Hors-saison ouvert samedi, dimanche et jf';
//          if((check_weekend($datetime) == 1) || jour_ferie(mktime(0,0,0,$date23[1],$date23[2],$date23[0])) == 1){
//      	echo 'Nous sommes un jour férié, samedi ou dimanche !! OK !!';
//          }else{
//            $error->append("dateRequestError");
//          }
//      }
//  }else{
//    $error->append("dateRequestError");
// }

//entre le 15 avril et le 15 octobre
//echo $datetime->format('md');

// verifier si jour = samedi, dimanche
//6 = Samedi ou 7 = Dimanche




 //echo jour_ferie(mktime(0,0,0,$date23[1],$date23[2],$date23[0]));


//fin verif date





        //      if (count($error) == 0) {
          //       $error->append($dateRequest);

            $this->manager->exec('INSERT INTO activity (utility, nbHours, idActivityType, idMember ) VALUES (?,?,?,?)', [
                $utility,
                $nbHours,
                $activityType,
                $idMember
            ]);

            return "ok";
        // }else{
        //     return $error;
        //  }

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

    public function getActivityType(){
        $found = $this->manager->getAll('SELECT * from activitytype');
        return $found;
    }

  //  SELECT `idActivity`, `dateRequested`, `booked`, `activity`.`name` FROM `activity` INNER JOIN `activity` ON `activity`.`idActivity` = `activity`.`idActivity`
  public function getActivity($idMember){
  //  public function getActivity($idMember){
      $found = $this->manager->getAll('SELECT idActivity, utility, nbHours, activitytype.name from activity INNER JOIN activitytype ON activity.idActivityType = activitytype.idActivityType WHERE idMember = ?', [$idMember]);
        return $found;
    }

    public function getActivityAll(){
    //    $found = $this->manager->getAll('SELECT idActivity, dateBegin, aircraft.utility AS "utility", dateEnd, nbHours, idMember, activitytype.name AS "nameActivityType", activitytype.instructorNeeded, aircrafttype.name AS "nameAircrafttype" from activity INNER JOIN activitytype ON activity.idActivityType = activitytype.idActivityType INNER JOIN aircraft ON activity.idAircraft = aircraft.idAircraft INNER JOIN aircrafttype ON aircraft.idAircraftType = aircrafttype.idAircraftType');
        $found = $this->manager->getAll('SELECT idActivity, idMember, activitytype.name AS "nameActivityType", instructorNeeded, nbHours, utility from activity INNER JOIN activitytype ON activity.idActivityType = activitytype.idActivityType WHERE dateBegin IS NULL ORDER BY idActivity DESC');
        return $found;
        // INNER JOIN aircrafttype ON  aircrafttype.idAircraftType = activity.idAircraftType
    }

    public function getInstructor(){
        $found = $this->manager->getAll('SELECT * from instructor');
        return $found;
    }

    public function getAircraft(){
        $found = $this->manager->getAll('SELECT * from aircraft');
        return $found;
    }

    // public function updateActivity($idActivity, $idAircraft, $idInstructor, $dateBegin, $dateEnd){
     public function updateActivity($idActivity, $dateBegin, $dateEnd){
      // public function updateActivity($idActivity){

      //  $error = new ArrayObject();


  //
  //
  // //verif date
  //
  // //$date = ('2020-05-08');
  // $datetime = date_create($dateBegin);
  //
  // $date23 = explode("-", $dateBegin);
  // //explode pour mettre la date du jour en format numerique: 31/07/2020  -> 31052009
  // echo $date23[0];
  // echo $date23[1];
  // echo $date23[2];
  //
  //
  // 	if(strtotime($dateBegin) > time()){
  // 	   echo 'OK';
  //
  //      $datemd = $datetime->format('md');
  //
  //      if(($datemd >= '0415') && ($datemd <= '1015')) {
  //      	echo 'Ouvert tous les jours';
  //      }
  //      else
  //      {
  //          echo 'Hors-saison ouvert samedi, dimanche et jf';
  //          if((check_weekend($datetime) == 1) || jour_ferie(mktime(0,0,0,$date23[1],$date23[2],$date23[0])) == 1){
  //      	echo 'Nous sommes un jour férié, samedi ou dimanche !! OK !!';
  //          }else{
  //            $error->append("dateBeginError");
  //          }
  //      }
  //  }else{
  //    $error->append("dateBeginError");
  // }
  //
  // //entre le 15 avril et le 15 octobre
  // echo $datetime->format('md');
  //
  // //verifier si jour = samedi, dimanche
  // //6 = Samedi ou 7 = Dimanche
  //
  //
  //
  //
  //  echo jour_ferie(mktime(0,0,0,$date23[1],$date23[2],$date23[0]));
  //

  //fin verif date

    //  if (count($error) == 0) {
          // $error->append($dateBegin);

        //     $affectedRows = $this->manager->exec("UPDATE activity SET idAircraft = '$idAircraft', idInstructor = '$idInstructor', dateBegin = '$dateBegin', dateEnd = '$dateEnd' WHERE idActivity = '$idActivity'");
        $affectedRows = $this->manager->exec("UPDATE activity SET dateBegin = '$dateBegin', dateEnd = '$dateEnd' WHERE idActivity = '$idActivity'");
        // $affectedRows = $this->manager->exec("UPDATE activity SET dateBegin = '20200710' , dateEnd = '202007' WHERE idActivity = '$idActivity'");
        if($affectedRows === 0){
              return null;
        }
    //  }else{
        return $error;
    //  }
    }


}
