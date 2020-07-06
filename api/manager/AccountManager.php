<?php

require_once __DIR__ . '/../DataBaseManager.php';
require_once  __DIR__ . '/../models/Customer.php';

class AccountManager{

	private DataBaseManager $manager;

	public function __construct($manager)
    {
        $this->manager = $manager;
    }

    public function log($mail, $password){
        $passSha = hash("sha256", $password);
        $result = $this->manager->find("SELECT idUser, type FROM user WHERE email = ? AND password = ?", [$mail, $passSha]);

        if ($result['idUser'] ){
            $token = bin2hex(random_bytes(32));
            $affectedRows = $this->manager->exec('UPDATE user SET token = ? WHERE idUser = ?', [
                $token,
                $result['idUser']
            ]);

            return $token;
        }

        else{
            return 0;
        }

    }

    function isCo($token){
        $result = $this->manager->find("SELECT idUser FROM user WHERE token = ?", [$token]);
        if ($result){
            return 1;
        }
        else{
            return 0;
        }
    }

    function getIdFromToken($token){
         return $this->manager->find("SELECT idUser FROM user WHERE token = ?", [$token])['idUser'];
    }


}

