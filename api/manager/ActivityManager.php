<?php
require_once __DIR__ . '/../../api/pdo.php';
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
        if($dateDay == "6" || $dateDay == "7") return 1;
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

    public function ifExistActivity($idAircraft, $idInstructor, $dateBegin, $dateEnd){
      // Initialisation du nombre d'erreurs
      $error = new ArrayObject();

      // Conversion des dates en chaines de caracteres
      $dateBeginTime = date("Y-m-d H:i:s",strtotime($dateBegin));
      $dateEndTime = date("Y-m-d H:i:s",strtotime($dateEnd));

      // Verifier si chevauchement des dates avec un créneau existant pour l'instructeur choisi
      $foundInstructor = $this->manager->find("SELECT idActivity
        FROM activity
        WHERE ((dateBegin BETWEEN '" . $dateBeginStr . "' AND '" . $dateEndStr . "')
        OR (dateEnd BETWEEN '" . $dateBeginStr . "' AND '" . $dateEndStr . "')
        OR ('" . $dateBeginStr . "' BETWEEN dateBegin AND dateEnd))
        AND idInstructor = ?', [$idInstructor]");

      if($foundInstructor !== null){
        $error->append("Attention ! L'instructeur est déjà reservé sur ce creneau.");
      }

      // Verifier si chevauchement des dates avec un créneau existant pour l'avion choisi
      $foundAircraft = $this->manager->find("SELECT idActivity
        FROM activity
        WHERE ((dateBegin BETWEEN '" . $dateBeginStr . "' AND '" . $dateEndStr . "')
        OR (dateEnd BETWEEN '" . $dateBeginStr . "' AND '" . $dateEndStr . "')
        OR ('" . $dateBeginStr . "' BETWEEN dateBegin AND dateEnd))
        AND $idAircraft = ?', [$idAircraft]");

      if($foundAircraft !== null){
        $error->append("Attention ! L'avion est déjà reservé sur ce creneau.");
      }

      if(count($error) == 0) {
        return "ok";
      }else{
        return $error;
      }
    }

    public function addActivity($activityType, $utility, $nbHours, $idMember){
        $add = $this->manager->exec('INSERT INTO activity (utility, nbHours, idActivityType, idMember ) VALUES (?,?,?,?)', [
                $utility,
                $nbHours,
                $activityType,
                $idMember
            ]);

        if($add == 0) {
          $error = "ErreurAddActivity";
          return $error;
        } else {
          return "ok";
        }

    }

    public function deleteActivity($idActivity){
        $delete = $this->manager->exec("DELETE FROM activity WHERE idActivity = $idActivity");

        if($delete == 0) {
          $error = "ErreurDeleteActivity";
          return $error;
        } else {
          return "ok";
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

    public function getActivityType(){
        $found = $this->manager->getAll('SELECT * from activitytype');
        return $found;
    }

    public function getActivity($idMember){
        $found = $this->manager->getAll("SELECT idActivity, activitytype.name as 'activityName',
          IFNULL(activity.utility,'') as 'utility', IFNULL(nbHours,'') as 'nbHours',
          IFNULL(dateBegin,'') as 'dateBegin', IFNULL(dateEnd,'') as 'dateEnd',
          (CASE WHEN ((dateBegin IS NOT NULL) AND (dateEnd IS NOT NULL)) THEN 'OUI' else 'NON' END) AS 'booked',
          IFNULL(instructor.name,'') as 'instructorName', IFNULL(aircraft.name,'') as 'aircraftName'
          FROM activity INNER JOIN activitytype ON activity.idActivityType = activitytype.idActivityType
          LEFT JOIN instructor ON activity.idInstructor = instructor.idInstructor
          LEFT JOIN aircraft ON activity.idAircraft = aircraft.idAircraft
          WHERE idMember = ?", [$idMember]);
          return $found;
      }

    public function getActivityToEdit($idActivity){

        // Connect to database
        $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

        // Requete pour recuperer l'activite a modifier
        $querySelect = "SELECT idActivity, activitytype.name AS 'nameActivityType',
        activity.idMember as 'idMember', concat(lastname,' ',firstname) as 'userName',
        nbHours, utility, instructorNeeded, (CASE WHEN instructorNeeded = 1 THEN 'OUI' ELSE 'NON' END) AS 'instructorNeededString',
        idInstructor, idAircraft, dateBegin, dateEnd
        from activity
        INNER JOIN activitytype ON activity.idActivityType = activitytype.idActivityType
        INNER JOIN member ON activity.idMember = member.idMember
        INNER JOIN user ON member.idUser = user.idUser
        WHERE idActivity = $idActivity";

        // Renvoie du resultat
        $result = mysqli_query($link, $querySelect);
        $row = mysqli_fetch_array($result);
        return $row;
      }

    public function getActivityToPlan(){

      // Connect to database
      $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

      // Requete pour recuperer les activites à planifier
      $query = "SELECT idActivity, activitytype.name AS 'nameActivityType',
      activity.idMember as 'idMember', concat(lastname,' ',firstname) as 'userName',
      nbHours, utility, (CASE WHEN instructorNeeded = 1 THEN 'OUI' ELSE 'NON' END) AS 'instructorNeeded'
      from activity
      INNER JOIN activitytype ON activity.idActivityType = activitytype.idActivityType
      INNER JOIN member ON activity.idMember = member.idMember
      INNER JOIN user ON member.idUser = user.idUser
      WHERE dateBegin IS NULL ORDER BY idActivity";
      $result = mysqli_query($link, $query);

      // Renvoie du resultat
      $result = mysqli_query($link, $query);
      return $result;
    }

    public function getInstructor(){
        $found = $this->manager->getAll('SELECT * from instructor');
        return $found;
    }

    public function getAircraft(){
        $found = $this->manager->getAll('SELECT * from aircraft');
        return $found;
    }

    public function updateActivity($idActivity, $idAircraft, $idInstructor, $dateBegin, $dateEnd, $instructorNeeded){

      $error = new ArrayObject();

      if(($instructorNeeded == 1) && (!isset($idInstructor))) {
        $error->append("InstructorNeeded");
      }

      if(!isset($idAircraft)) {
        $error->append("AircraftNeeded");
      }

      $dateBeginCheck = date_create($dateBegin);
      $dateEndCheck = date_create($dateEnd);
      $dateBeginOK = checkdate($dateBeginCheck->format('m'), $dateBeginCheck->format('d'), $dateBeginCheck->format('Y'));
      $dateEndOK = checkdate($dateEndCheck->format('m'), $dateEndCheck->format('d'), $dateEndCheck->format('Y'));

      if(($dateBeginOK) && ($dateEndOK)){
        $dateBeginStr = date("Y-m-d H:i:s",strtotime($dateBegin));
        $dateEndStr = date("Y-m-d H:i:s",strtotime($dateEnd));
        // Meme jour
        $dateBeginDay = date("Y-m-d",strtotime($dateBegin));
        $dateEndDay = date("Y-m-d",strtotime($dateEnd));
        if(strcmp($dateBeginDay, $dateEndDay) !== 0) {
          $error->append("DatesNoEgal");
        } else {
          // Debut verif week end jf
          // $date = ('2020-05-08');
          // Date de l'activite
          $dateActivity = $dateBeginDay;
          $datetime = date_create($dateActivity);
          $dateDMY = explode("-", $dateActivity);
          // explode pour mettre la date du jour en format numerique: 31/05/2009  -> 31052009
          // echo $dateDMY[0];
          // echo $dateDMY[1];
          // echo $dateDMY[2];
          // Verif date future
          if(strtotime($dateActivity) > time()){
            // echo 'OK';
            // Verif saison
            $datemd = $datetime->format('md');
            if(($datemd >= '0415') && ($datemd <= '1015')) {
              // echo 'Ouvert tous les jours';
            } else {
              // echo 'Hors-saison ouvert samedi, dimanche et jf';
              if((check_weekend($datetime) == 1) || jour_ferie(mktime(0,0,0,$dateDMY[1],$dateDMY[2],$dateDMY[0])) == 1){
                // echo 'Nous sommes un jour férié, samedi ou dimanche !! OK !!';
                // verifier si jour = samedi, dimanche
                // 6 = Samedi ou 7 = Dimanche
                // echo jour_ferie(mktime(0,0,0,$dateDMY[1],$dateDMY[2],$dateDMY[0]));
                // fin verif date
              } else {
                $error->append("HorsSaisonError");
              }
            }
          } else {
            $error->append("DatePassedError");
          }
        }

      } else {
         $error->append("DatesNotValid");
      }

      if(count($error) == 0) {
        // Update des donnees
        $update = $this->manager->exec("UPDATE activity
          SET idInstructor = $idInstructor, idAircraft = $idAircraft, dateBegin = '" . $dateBeginStr . "', dateEnd = '" . $dateEndStr . "'
          WHERE idActivity = $idActivity");
          // $update = $this->manager->exec("UPDATE activity
          //   SET idInstructor = $idInstructor, idAircraft = $idAircraft, dateBegin = '20200804', dateEnd = '20200804'
          //   WHERE idActivity = $idActivity");
          // Test retour
          if($update == 0) {
            $error->append("ErreurUpdate");
            return $error;
          } else {
            return "ok";
          }

        } else {
          return $error;
        }
      }
  }
