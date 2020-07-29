<?php

require_once __DIR__ . '/../../api/pdo.php';
require_once __DIR__ . '/../DataBaseManager.php';
require_once  __DIR__ . '/../models/Member.php';

// header('Content-type: application/json');

class RegisterMemberManager{
    private DataBaseManager $manager;


    public function __construct($manager)
    {
        $this->manager = $manager;
    }

    public function ifExistEmail(string $email){
        $found = $this->manager->find('SELECT idUser FROM user WHERE email = ?', [$email]);
        return $found !== null;
    }

    public function ifExistLogin(string $login){
        $found = $this->manager->find('SELECT idUser FROM user WHERE login = ?', [$login]);
        return $found !== null;
    }

    public function timestampToDate($mon_timestamp) {
        return date('Ymd', $mon_timestamp);
    }

    public function getNewDate($ma_date, $decalage) {
        return  $ma_date + ($decalage * 3600 * 24);
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

      public function getTypeContribution($birthDate, $memberOutside) {
          $now = new DateTime();
          $diff = date_diff($now, new DateTime($birthDate)); // new datetime
          $age = $diff->format('%y');
          if ($age < 21 || $memberOutside == 1){
            $typeContribution = 2;
          } else {
            $typeContribution = 1;
          }
          return  $typeContribution;
      }

      public function getContribution($idMember){
        $found = $this->manager->getAll('SELECT feeContribution
          FROM membercontribution
          INNER JOIN member ON member.idMemberContribution = membercontribution.idMemberContribution
          WHERE idMember = ?', [$idMember]);
        return $found;
      }

      public function getAccountMember($idMember){
        $found = $this->manager->getAll("SELECT idMember, firstName, lastName, address, postalCode, city, phoneNumber, login, password, email,
          birthDate, (CASE WHEN memberOutside = 1 THEN 'OUI' ELSE 'NON' END) as 'memberOutside', clubOutside, license,
          (CASE
            WHEN (YEAR(contributionDate) = YEAR(NOW())) THEN 'OUI'
            ELSE 'NON'
            END) as 'contributionPayed', contributionDate
          FROM member
          INNER JOIN user ON member.idUser = user.idUser
          WHERE idMember = $idMember");
        return $found;
      }

      public function getAccountAdmin(){
        $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $query = "SELECT idMember, firstName, lastName, address, postalCode, city, phoneNumber, login, password, email,
          birthDate, (CASE WHEN memberOutside = 1 THEN 'OUI' ELSE 'NON' END) as 'memberOutside', clubOutside, license,
          (CASE
            WHEN (YEAR(contributionDate) = YEAR(NOW())) THEN 'OUI'
            ELSE 'NON'
            END) as 'contributionPayed', contributionDate
          FROM member
          INNER JOIN user ON member.idUser = user.idUser";
        $result = mysqli_query($link, $query);
        return $result;
      }

      public function deleteMember($idMember){
          $selectIduser = $this->manager->getAll("SELECT idUser from member WHERE idMember = $idMember");
          $idUser = $selectIduser[0]['idUser'];

          $deleteMember = $this->manager->exec("DELETE FROM member WHERE idMember = $idMember");
          if($deleteMember == 0) {
            $error = "ErreurDeleteMember";
            return $error;
          } else {
              $deleteUser = $this->manager->exec("DELETE FROM user WHERE idUser = $idUser");
              if($deleteUser == 0) {
                $error = "ErreurDeleteUser";
                return $error;
              } else {
                return "ok";
              }
          }
      }

    public function updateContributionDate($idMember){
        $update = $this->manager->exec("UPDATE member SET contributionDate = now() WHERE idMember = $idMember");
        if($update == 0) {
          $error = "ErreurUpdateContributionDate";
          return $error;
        } else {
          return "ok";
        }
      }


      public function register($idUser, $idMember, $lastName, $firstName, $address, $postalCode, $city, $phoneNumber, $birthDate, $memberOutside, $clubOutside, $license, $email, $login, $password, $confirmPassword){

        // Initialisation du nombre d'erreurs
        $error = new ArrayObject();

        if ($this->ifExistLogin($login)){
            $error->append("loginExist");
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $error->append("emailError");
        }

        if ($this->ifExistEmail($email)){
            $error->append("emailExist");
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
                $error->append("birthdateError");
            }

            $dateMin  = $this->timestampToDate($this->getNewDate(time(), - (15 * 365) ));
            $dateMin = date_create($dateMin);
            if($dateMin < $date){
                $error->append("tooYoung");
            }

        } else {
          $error->append("birthdateError");
        }

        if (preg_match('/\A(?=[\x20-\x7E]*?[A-Z])(?=[\x20-\x7E]*?[a-z])(?=[\x20-\x7E]*?[0-9])[\x20-\x7E]{6,}\z/', $password) != 1){
            $error->append("passwordError");
        }

        if (strcmp($password, $confirmPassword) !== 0){
            $error->append("confirmPasswordError");
        }

        if (count($error) == 0) {
            $passwordSha = hash('sha256', $password);

            // Calcul type contribution
            $typeContribution = $this->getTypeContribution($birthDate, $memberOutside);

            // Si member deja existant, update
            if($idMember > 0) {

            // Update member
            $update = $this->manager->exec('UPDATE member
              SET birthDate = $birthDate, memberOutside = $memberOutside, clubOutside = $clubOutside,
              license = $license, idMemberContribution, typeContribution = $typeContribution
              WHERE idMember = $idMember');

              if($update == 0) {
                $error->append("ErreurUpdateMember");
                return $error;
              } else {

                // Update user
                $update = $this->manager->exec('UPDATE user
                  SET lastName = (string)$lastName, firstName = (string)$firstName,
                  address = (string)$address, postalCode = (string)$postalCode, city = (string)$city, phoneNumber = (string)$phoneNumber,
                  email = (string)$email, login = (string)$login, password = (string)$passwordSha
                  WHERE idUser = $idUser');
                if($update == 0) {
                  $error->append("ErreurUpdateUser");
                  return $error;
                } else {
                return "ok";
                }
              }

            // Si member non existant, insert
            } else {

            // Insert User
            $insert = $this->manager->exec('INSERT INTO user (lastName, firstName, address, postalCode, city, phoneNumber, email, login, password, type) VALUES (?,?,?,?,?,?,?,?,?,?)', [
                (string)$lastName,
                (string)$firstName,
                (string)$address,
                (string)$postalCode,
                (string)$city,
                (string)$phoneNumber,
                (string)$email,
                (string)$login,
                (string)$passwordSha,
                2
            ]);

            if($insert == 0) {
              $error->append("ErreurInsertUser");
              return $error;
              } else {

              $newId = $this->manager->getLastInsertId();

              // Insert Member
              $insert = $this->manager->exec('INSERT INTO member (birthDate, memberOutside, clubOutside, license, contributionPayed, idUser, idMemberContribution) VALUES (?,?,?,?,?,?,?)', [
                    $birthDate,
                    $memberOutside,
                    $clubOutside,
                    $license,
                    0,
                    $newId,
                    $typeContribution
                ]);
                if($insert == 0) {
                  $error->append("ErreurInsertMember");
                  return $error;
                } else {

                  // Passage de l'identifiant membre en variable de session pour le paiement
                  $newIdMember = $this->manager->getLastInsertId();
                  session_start();
                  $_SESSION['idMember'] = $newIdMember;

                  return "ok";
                }
              }



            // Fin if($idMember > 0)
            }

          // Fin if (count($error) != 0)
          } else {
             return $error;
          }
    }

}
