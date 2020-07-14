<?php

require_once __DIR__ . '/../DataBaseManager.php';
require_once  __DIR__ . '/../models/Member.php';

class RegisterMemberManager{
    private DataBaseManager $manager;


    public function __construct($manager)
    {
        $this->manager = $manager;
    }

    public function ifExist(string $email){
        $found = $this->manager->find('SELECT idUser FROM user WHERE email = ?', [$email]);
        return $found !== null;
    }

    public function timestampToDate($mon_timestamp) {
        return date('Ymd', $mon_timestamp);
    }

    public function getNewDate($ma_date, $decalage) {
        return  $ma_date + ($decalage * 3600 * 24);
    }

    public function register($lastName, $firstName, $birthDate, $memberOutside, $clubOutside, $license, $email, $login, $password, $confirmPassword){

        $error = new ArrayObject();
        if ($this->ifExist($email)){
            $error->append("emailExist");
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $error->append("emailError");
        }


        if (!ctype_alpha($lastName)){
            $error->append("lastNameError");   // las
        }
        if (!ctype_alpha($firstName)){
            $error->append("firstNameError");
        }

        $date = date_create($birthDate);
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

        if (preg_match('/\A(?=[\x20-\x7E]*?[A-Z])(?=[\x20-\x7E]*?[a-z])(?=[\x20-\x7E]*?[0-9])[\x20-\x7E]{6,}\z/', $password) != 1){
            $error->append("passwordError");
        }

        if (strcmp($password, $confirmPassword) !== 0){
            $error->append("confirmPasswordError");
        }

        if (count($error) == 0) {
            $passwordSha = hash('sha256', $password);

            $error->append($lastName);
            $error->append($firstName);
            $error->append($email);
            $error->append($birthDate);
            $error->append($password);


            $this->manager->exec('INSERT INTO user (lastName, firstName, email, login, password, type) VALUES (?,?,?,?,?,?)', [
                (string)$lastName,
                (string)$firstName,
                (string)$email,
                (string)$login,
                (string)$passwordSha,
                2
            ]);

            $newId = $this->manager->getLastInsertId();

            $this->manager->exec('INSERT INTO member (birthDate, memberOutside, clubOutside, license, idUser) VALUES (?,?,?,?,?)', [
                  $birthDate,
                  $memberOutside,
                  $clubOutside,
                  $license,
                  $newId
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

  //  public function getContribution($birthDate, $memberOutside){
      public function getContribution(){


$date1 =  new DateTime(07-13-2000);
$now = new DateTime();
      //  $today = date('m-d-Y');
    //    $diff = date_diff(date_create($birthDate), date_create($today));
        $diff = date_diff($now, $date1);
        $age = $diff->format('%y');

        if ($age < 21 || $memberOutside == 1){
          $typeContribution = 2;
        }else{
          $typeContribution = 1;
        }

        $found = $this->manager->getAll('SELECT feeContribution FROM membercontribution WHERE idMemberContribution = ?', [$typeContribution]);
        return $found;

    }


}
