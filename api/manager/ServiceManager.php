<?php

require_once __DIR__ . '/../pdo.php';
require_once __DIR__ . '/../DataBaseManager.php';

class ServiceManager{
    private DataBaseManager $manager;

    public function __construct($manager)
    {
        $this->manager = $manager;
    }

    public function getServiceAll(){
      $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
      $query = "SELECT idRequest, lastName, firstName, nameFr as 'country',
      serviceDate, requestDate, stateRequest,
      (CASE WHEN basedChoice = 1 THEN 'OUI' ELSE 'NON' END) as 'basedChoice',
      servicerequest.idCustomer as 'idCustomer', customer.idUser as 'idUser'
      FROM servicerequest
      INNER JOIN customer ON servicerequest.idCustomer = customer.idCustomer
      INNER JOIN user ON customer.idUser = user.idUser
      INNER JOIN country ON customer.idCountry = country.idCountry";
      $result = mysqli_query($link, $query);
      return $result;
    }

    public function getServiceCustomer($idCustomer){
      $found = $this->manager->getAll("SELECT idRequest, lastName, firstName, nameFr as 'country',
      serviceDate, requestDate, stateRequest,
      (CASE WHEN basedChoice = 1 THEN 'OUI' ELSE 'NON' END) as 'basedChoice',
      servicerequest.idCustomer as 'idCustomer', customer.idUser as 'idUser'
      FROM servicerequest
      INNER JOIN customer ON servicerequest.idCustomer = customer.idCustomer
      INNER JOIN user ON customer.idUser = user.idUser
      INNER JOIN country ON customer.idCountry = country.idCountry
      WHERE servicerequest.idCustomer = $idCustomer");
      return $found;
    }
    public function getServiceBill($idRequest){
      $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
      $query = "SELECT servicerequest.idRequest as 'idRequest',
        lastName, firstName,  address, postalCode, city, nameFr as 'country',  phoneNumber,
        linerequest.idService as 'idservice', service.name as 'serviceName', linerequest.priceHT, linerequest.priceTTC
        FROM servicerequest
        INNER JOIN customer ON servicerequest.idCustomer = customer.idCustomer
        INNER JOIN user ON customer.idUser = user.idUser
        INNER JOIN linerequest ON servicerequest.idRequest = linerequest.idRequest
        INNER JOIN service ON linerequest.idService = service.idService
        INNER JOIN country ON customer.idCountry = country.idCountry
        WHERE servicerequest.idRequest = $idRequest";
      $result = mysqli_query($link, $query);
      return $result;
    }

    // public function getServiceBillbad($idRequest){
    //     $found = $this->manager->getAll("SELECT servicerequest.idRequest as 'idRequest',
    //       lastName, firstName,  address, postalCode, city, nameFr as 'country',  phoneNumber,
    //       linerequest.idService as 'idservice', service.name as 'serviceName', linerequest.priceHT, linerequest.priceTTC
    //       FROM servicerequest
    //       INNER JOIN customer ON servicerequest.idCustomer = customer.idCustomer
    //       INNER JOIN user ON customer.idUser = user.idUser
    //       INNER JOIN linerequest ON servicerequest.idRequest = linerequest.idRequest
    //       INNER JOIN service ON linerequest.idService = service.idService
    //       INNER JOIN country ON customer.idCountry = country.idCountry
    //       WHERE servicerequest.idRequest = $idRequest");
    //     return $found;
    // }


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

    public function getPetroleProduct(){
      $found = $this->manager->getAll('SELECT * from petroleproduct');
      return $found;
    }

    public function getPriceService($idService){
      $found = $this->manager->getAll('SELECT priceHT, priceTTC FROM service WHERE idService = ?', [$idService]);
      return $found;
    }

    public function getTariffLanding($planeType, $based, $dayweek){
      $found = $this->manager->getAll("SELECT idTariffLanding, priceHT, priceTTC FROM tarifflanding WHERE ((planeType = '" . $planeType . "') AND (basedChoice = $based) AND (dayweek = '" . $dayweek . "') )");
      return $found;
    }

    public function getCoeff($acousticGroup){
      $found = $this->manager->getAll("SELECT coeffDay, coeffNight FROM acousticGroup WHERE idAcousticGroup = '" . $acousticGroup . "'");
      return $found;
    }

    public function getMarkup(){
      $found = $this->manager->getAll("SELECT priceHT, priceTTC FROM tariffmarkup WHERE idTariffMarkup = 1");
      return $found;
    }

    public function getPetrole($petrole){
      $found = $this->manager->getAll("SELECT priceHT, priceTTC FROM petroleproduct WHERE idPetroleProduct = $petrole");
      return $found;
    }

    public function getTariffOutside(){
      $found = $this->manager->getAll("SELECT priceHT, priceTTC FROM tariffOutside WHERE idTariffOutside = 1");
      return $found;
    }

    public function getCategory($groundArea, $mass){
      $found = $this->manager->getAll("SELECT category FROM categorytype WHERE ($groundArea BETWEEN groundAreaMin AND groundAreaMax) AND ($mass BETWEEN massMin AND massMax)");
      return $found;
    }

    public function getTariffCovered($category, $based, $tariffType){
      $found = $this->manager->getAll("SELECT idTariffCovered, priceHT, priceTTC FROM tariffCovered WHERE (category = $category) AND (basedChoice = $based) AND (tariffType = '" . $tariffType . "')");
      return $found;
    }

    public function getMonthDiff($start, $end){

    	$start = new DateTime($start);
    	$end   = new DateTime($end);
    	$diff  = $start->diff($end);

    	return $diff->format('%y') * 12 + $diff->format('%m');
    }

    public function getDayDiff($start, $end){
      $start = new DateTime($start);
      $end   = new DateTime($end);
      $diff  = $start->diff($end);

      return $diff->format('%y') * 365 + $diff->format('%d');
    }

    public function getWeekDiff($start, $end){
      $start = new DateTime($start);
      $end   = new DateTime($end);
      $diff  = $start->diff($end);

      return $diff->format('%y') * 52 + $diff->format('%W');
    }

    public function updateStateRequest($idRequest, $amount){
      $update = $this->manager->exec("UPDATE servicerequest SET stateRequest = 2, amount = $amount WHERE idRequest = $idRequest");
      if($update == 0) {
        $error = "ErreurUpdateStateRequest";
        return $error;
      } else {
        return "ok";
      }
    }


    public function addServiceRequest($idCustomer, $serviceDate, $landing, $planeTypeChoice, $acousticGroup, $basedChoice, $dayweek, $markupDuration, $provisioning, $petrole, $quantity, $parking, $parkingType, $tariffType, $groundArea, $mass, $beginDate, $endDate, $cleaning, $weather){

      // Initialisation du nombre d'erreurs
      $error = new ArrayObject();

      $validate = false;
      $amount = 0;

      $serviceDateCreate = date_create($serviceDate);

// echo $serviceDate;
//echo '<br>';
// $serviceDateStr = date("Y-m-d H:i:s",strtotime($serviceDate));
$serviceDateStr = date("Y-m-d H:i",strtotime($serviceDate));
// echo $serviceDateStr;
// echo '<br>';

// echo $serviceDateCreate;
      // a tester

      // $date = date("Y-m-d H:i:s",strtotime("2020-07-26T05:06"));
      $date = date("Y-m-d H:i:s",strtotime($serviceDate));

      //echo $hour;
      // echo "date :";
       // echo $date;
      $today = date("Y-m-d H:i:s");
      //$diff = abs($date2 - $today);
      // echo '<br>';
      //  echo "today : ";
      //  echo $today;
      // echo '<br>';

      $datetimetoday = new DateTime($today);
      $datetimetoday->modify('+1 day');
      // echo "today+1 : ";
       // echo $datetimetoday->format('Y-m-d H:i:s');

      $datetime1 = new DateTime($date);

      // if ($datetimetoday > $datetime1) {
      //   $error->append("datePassed");
      // }

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
          // return $error;
          $validate = false;
        } else {
          $idRequest = $this->manager->getLastInsertId();
          $validate = true;
        }

      }else{
           // return $error;
           $validate = false;
      }

      if ($validate == true){

        if ($landing){

          if ($planeTypeChoice == 1){
            $planeType = "TURBINE";
          }
          else if ($planeTypeChoice == 2){
            $planeType = "REACTEUR";
          }
          else {
            $error->append("planeTypeNotSet");
            // return $error;
          }

          if(count($error) == 0) {
            $tariffLanding = $this->getTariffLanding($planeType, $based, $dayweek);

            $idTariffLanding = $tariffLanding[0]['idTariffLanding'];
            $tariffLandingHT = $tariffLanding[0]['priceHT'];
            $tariffLandingTTC = $tariffLanding[0]['priceTTC'];


            $getMarkup = $this->getMarkup();

            $idTariffMarkup = 1;
            $markupHT = $getMarkup[0]['priceHT'];
            $markupTTC = $getMarkup[0]['priceTTC'];


            $getCoeff = $this->getCoeff($acousticGroup);

            $coeffDay = $getCoeff[0]['coeffDay'];
            $coeffNight = $getCoeff[0]['coeffNight'];

            $hourLanding = date("H",strtotime($serviceDate));

            if (($hourLanding < 22) && ($hourLanding >= 6)){
              $coeff = $coeffDay;
            }
            else{
              $coeff = $coeffNight;
            }

            $tariffLandingHTFinal = $tariffLandingHT * $coeff + ($markupHT * $markupDuration);
            $tariffLandingTTCFinal = $tariffLandingTTC * $coeff + ($markupTTC * $markupDuration);
            $amount += $tariffLandingTTCFinal;

            $insertLRL = $this->manager->exec('INSERT INTO linerequest (idRequest, idService, priceHT, priceTTC) VALUES (?,?,?,?)', [
              $idRequest,
              1,
              $tariffLandingHTFinal,
              $tariffLandingTTCFinal
            ]);
            if($insertLRL == 0) {
              $error->append("ErreurInsertLineRequestLanding");
              // return $error;
            }
          }

          if(count($error) == 0) {

            $insertL = $this->manager->exec('INSERT INTO landing (idRequest, planeType, dayweek, markupDuration, idTariffLanding, idTariffMarkup, idAcousticGroup) VALUES (?,?,?,?,?,?)', [
              $idRequest,
              $planeType,
              $dayweek,
              $markupDuration,
              $idTariffLanding,
              $idTariffMarkup,
              $acousticGroup
            ]);
            if($insertL == 0) {
              $error->append("ErreurInsertLanding");
              return $error;
            } else {
              $validate = true;
            }
          }
        }


        if ($provisioning){

          $getPetrole = $this->getPetrole($petrole);

          $pricePetroleHT = $getPetrole[0]['priceHT'];
          $pricePetroleTTC = $getPetrole[0]['priceTTC'];

          $priceProvisioningHT = $pricePetroleHT * $quantity;
          $priceProvisioningTTC = $pricePetroleTTC * $quantity;
          $amount += $priceProvisioningTTC;

          $insertLRPR = $this->manager->exec('INSERT INTO linerequest (idRequest, idService, priceHT, priceTTC) VALUES (?,?,?,?)', [
            $idRequest,
            2,
            $priceProvisioningHT,
            $priceProvisioningTTC
          ]);
          if($insertLRPR == 0) {
            $error->append("ErreurInsertLineRequestProvisioning");
            return $error;
          } else {

          }

          if(count($error) == 0) {

            $insertPR = $this->manager->exec('INSERT INTO provisioning (idRequest, idPetroleProduct, quantity) VALUES (?,?,?)', [
              $idRequest,
              $petrole,
              $quantity
            ]);
            if($insertPR == 0) {
              $error->append("ErreurInsertProvisioning");
              return $error;
            } else {
              // return "ok";
            }
          }
        }

        if ($parking){

          //feeCovered
          if ($parkingType == "COV"){

            $mass = (float)($mass / 1000);
            $getCategory = $this->getCategory($groundArea, $mass);

            $category = $getCategory[0]['category'];

            $tariffCovered = $this->getTariffCovered($category, $based, $tariffType);

            $idTariffCovered = $tariffCovered[0]['idTariffCovered'];
            $tariffCoveredHT = $tariffCovered[0]['priceHT'];
            $tariffCoveredTTC = $tariffCovered[0]['priceTTC'];

            if ($tariffType == "J"){
              //date_diff() nb jours
              $day = $this->getDayDiff($beginDate, $endDate);
              $tariffHT = $tariffCoveredHT * $day + 1;
              $tariffTTC = $tariffCoveredTTC * $day + 1;
              $amount += $tariffTTC;
            }

            else if ($tariffType == "M"){
              //date_diff() nb mois
              $month = $this->getMonthDiff($beginDate, $endDate);
              $tariffHT = $tariffCoveredHT * $month + 1;
              $tariffTTC = $tariffCoveredTTC * $month + 1;
              $amount += $tariffTTC;
            }

          }

          //feeOutside
          if ($parkingType == "OUT"){

        //     $weekBegin = date("W",strtotime($beginDate));
          //   $weekEnd = date("W",strtotime($endDate));
            // $weekNumber = $weekEnd - $weekBegin + 1;
            $weekNumber = $this->getWeekDiff($beginDate, $endDate);


            // année a ajouter
            if ($weekNumber == 1){
              $weekNumber = 2;
            }

            $tariffOutside = $this->getTariffOutside();

            $idTariffOutside = 1;
            $tariffOutsideHT = $tariffOutside[0]['priceHT'];
            $tariffOutsideTTC = $tariffOutside[0]['priceTTC'];

            $tariffHT = $tariffOutsideHT * $groundArea * $weekNumber + 1;
            $tariffTTC = $tariffOutsideTTC * $groundArea * $weekNumber + 1;
            $amount += $tariffTTC;
          }

          $insertLRPA = $this->manager->exec('INSERT INTO linerequest (idRequest, idService, priceHT, priceTTC) VALUES (?,?,?,?)', [
            $idRequest,
            3,
            $tariffHT,
            $tariffTTC
          ]);
          if($insertLRPA == 0) {
            $error->append("ErreurInsertLineRequestParking");
            return $error;
          } else {

          }

          if(count($error) == 0) {

            $insertPA = $this->manager->exec('INSERT INTO parking (idRequest, parkingType, beginDate, endDate) VALUES (?,?,?,?)', [
              $idRequest,
              $parkingType,
              $beginDate,
              $endDate
            ]);
            if($insertPA == 0) {
              $error->append("ErreurInsertParking");
              return $error;
            } else {

            }
          }

          if ($parkingType == "COV"){
            $insertFC = $this->manager->exec('INSERT INTO feecovered (idRequest, groundArea, mass, category, basedChoice, tariffType, idTariffCovered) VALUES (?,?,?,?,?,?,?)', [
              $idRequest,
              $groundArea,
              $mass,
              $category,
              $based,
              $tariffType,
              $idTariffCovered
            ]);
            if($insertFC == 0) {
              $error->append("ErreurInsertFeeCovered");
              return $error;
            } else {

            }

          }

          if ($parkingType == "OUT"){
            $insertFO = $this->manager->exec('INSERT INTO feeoutside (idRequest, groundArea, weekNumber, idTariffOutside) VALUES (?,?,?,?)', [
              $idRequest,
              $groundArea,
              $weekNumber,
              $idTariffOutside
            ]);
            if($insertFO == 0) {
              $error->append("ErreurInsertFeeOutside");
              return $error;
            } else {

            }

          }

        }
        //fin parking



        if ($cleaning){

          $priceCleaning = $this->getPriceService(4);

          $priceCleaningHT = $priceCleaning[0]['priceHT'];
          $priceCleaningTTC = $priceCleaning[0]['priceTTC'];
          $amount += $priceCleaningTTC;


          $insertLRC = $this->manager->exec('INSERT INTO linerequest (idRequest, idService, priceHT, priceTTC) VALUES (?,?,?,?)', [
            $idRequest,
            4,
            $priceCleaningHT,
            $priceCleaningTTC
          ]);
          if($insertLRC == 0) {
            $error->append("ErreurInsertLineRequestCleaning");
            return $error;
          } else {

          }
        }

        if ($weather){

          $priceWeather = $this->getPriceService(5);

          $priceWeatherHT = $priceWeather[0]['priceHT'];
          $priceWeatherTTC = $priceWeather[0]['priceTTC'];
          $amount += $priceWeatherTTC;

          $insertLRW = $this->manager->exec('INSERT INTO linerequest (idRequest, idService, priceHT, priceTTC) VALUES (?,?,?,?)', [
            $idRequest,
            5,
            $priceWeatherHT,
            $priceWeatherTTC
          ]);
          if($insertLRW == 0) {
            $error->append("ErreurInsertLineRequestWeather");
            return $error;
          } else {
            // passage des infos pour le paiement
            session_start();
            $_SESSION['amount'] = $amount;
            $_SESSION['idRequest'] = $idRequest;

            return "ok";
          }
        }

      }
      else {
        return $error;
      }


    }

}
