<?php

echo "123";
require_once __DIR__ . '/../DataBaseManager.php';
require_once  __DIR__ . '/../models/Member.php';
////// tout
class RegisterMemberManager{
    private DataBaseManager $manager;


    public function __construct( $manager)
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

    public function register($lastName, $firstName, $email, $birthDate, $login, $license, $password, $confirmPassword, $memberOutside, $clubOutside){
echo "ouiiii";

      //  $this->manager->exec('INSERT INTO user (lastName, firstName, email, login, password) VALUES ('aa','bb', 'b@b', 'a1', 'aaaaa')');
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

        if (strcmp($password, $confirmPass) !== 0){
            $error->append("confirmPasswordError");
        }

        if (count($error) == 0) {
            $passwordSha = hash('sha256', $password);
//            $verifemail = $this->getRandomStr(6);

            $error->append($lastName);
            $error->append($firstName);
            $error->append($email);
            $error->append($birthDate);
            $error->append($password);
//            $error->append($verifemail);

/*
            $this->manager->exec('INSERT INTO user (lastName, firstName, email, login, password) VALUES (?,?,?,?,?)', [
                (string)$lastName,
                (string)$firstName,
                (string)$email,
                (string)$login,
                (string)$passwordSha
            ]);
*/
            $newId = $this->manager->getLastInsertId();

            $this->manager->exec('INSERT INTO member (birthDate, memberOutside, clubOutside, license, id_person) VALUES (?,?,?,?)', [
                $birthDate,
                $memberOutside,
                $clubOutside,
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


}
