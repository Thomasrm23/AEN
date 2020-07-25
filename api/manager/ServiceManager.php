<?php

require_once __DIR__ . '/../DataBaseManager.php';

class ServiceManager{
    private DataBaseManager $manager;

    public function __construct($manager)
    {
        $this->manager = $manager;
    }

    public function timestampToDate($mon_timestamp) {
        return date('Ymd', $mon_timestamp);
    }

    public function getNewDate($ma_date, $decalage) {
        return  $ma_date + ($decalage * 3600 * 24);
    }

    public function getService(){
        $found = $this->manager->getAll('SELECT * from service');
        return $found;
    }

    public function addServiceRequest($idCustomer, $serviceDate, $landing, $planeTypeChoice, $basedChoice, $markupDuration){

      // Initialisation du nombre d'erreurs
      $error = new ArrayObject();

      $serviceDateCreate = date_create($serviceDate);

echo $serviceDate;
echo '<br>';
       $serviceDateStr = date("Y-m-d H:i:s",strtotime($serviceDate));
// echo $serviceDateStr;
echo '<br>';

// echo $serviceDateCreate;
      // a tester

      // $date = date("Y-m-d H:i:s",strtotime("2020-07-26T05:06"));
      $date = date("Y-m-d H:i:s",strtotime($serviceDate));
      echo "date :";
       echo $date;
      $today = date("Y-m-d H:i:s");
      //$diff = abs($date2 - $today);
      echo '<br>';
       echo "today : ";
       echo $today;
      // echo '<br>';

      $datetimetoday = new DateTime($today);
      $datetimetoday->modify('+1 day');
      // echo "today+1 : ";
       echo $datetimetoday->format('Y-m-d H:i:s');

      $datetime1 = new DateTime($date);

      if ($datetimetoday > $datetime1) {
        $error->append("datePassed");
      }

      // $interval = $datetimetoday->diff($datetime1);
      // echo $interval->format('%Y-%m-%d %H:%i:%s');
      //
      // if ( $interval->format('%H') < 24 ){
      // echo "oui";
      // }else echo "non";

      //fin a tester



      $dateLand = date_create($serviceDate);

      if (checkdate($dateLand->format('m'), $dateLand->format('d'), $dateLand->format('Y'))){
          //
          // $dateLandPlus  = $this->timestampToDate($this->getNewDate(time(), + 1));
          // $dateLandPlusCreate = date_create($dateLandPlus);
          // if($dateLandPlusCreate > $dateLand){
          //     $error->append("datePassed");
          // }
      }else {
        $error->append("dateInvalid");
      }



      //creation service request
      if ($basedChoice == 1){
        $based = 1;
      }
      else if ($basedChoice = 2){
        $based = 0;
      }
      else {
        $error->append("basedNotSet");
      }

      if(count($error) == 0) {
        $insertSR = $this->manager->exec('INSERT INTO servicerequest (serviceDate, stateRequest, basedChoice, idCustomer) VALUES (?,?,?,?)', [
            $serviceDateStr,
            1,
            $based,
            $idCustomer
        ]);
        if($insertSR == 0) {
          $error->append("ErreurInsertServiceRequest");
          return $error;
        } else {
          $idRequest = $this->manager->getLastInsertId();
        }

      }else{
           return $error;
      }

//insert linerequest
      // if(isset($idRequest)){
      //
      // }
      // else{
      //   return $error;
      // }
      if ($landing){

        $insertLR = $this->manager->exec('INSERT INTO linerequest (idRequest, idService) VALUES (?,?)', [
          $idRequest,
          1
        ]);
        if($insertLR == 0) {
          $error->append("ErreurInsertLineRequest");
          return $error;
        } else {

        }



        //insert landing


        if ($planeTypeChoice == 1){
          $planeType = "TURBINE";
        }
        else if ($planeTypeChoice == 2){
          $planeType = "REACTEUR";
        }
        else {
          $error->append("planeTypeNotSet");
        }

        if(count($error) == 0) {

          $insertL = $this->manager->exec('INSERT INTO landing (idRequest, planeType, markupDuration) VALUES (?,?,?)', [
            $idRequest,
            $planeType,
            $markupDuration
          ]);
          if($insertL == 0) {
            $error->append("ErreurInsertLanding");
            return $error;
          } else {
            return "ok";
          }
        }
      }

    }

}
