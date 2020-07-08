<?php

require_once __DIR__ . '/../DataBaseManager.php';
require_once  __DIR__ . '/../models/Customer.php';

class AccountManager{

	private DataBaseManager $manager;

	public function __construct($manager)
    {
        $this->manager = $manager;
    }

    public function log($login, $password){
        $passSha = hash("sha256", $password);
        $result = $this->manager->find("SELECT idUser FROM user WHERE login = ? AND password = ?", [$login, $passSha]);

        if ($result['idUser']){
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

		function getIdMemberFromToken($token){
				 return $this->manager->find("SELECT idMember FROM member INNER JOIN user ON user.idUser = member.idUser where token = ?", [$token]);//['idUser'];
		}

		public function getTypeFromToken($token){
		    $result = $this->manager->find("SELECT type FROM user INNER JOIN member ON user.idUser = member.idUser where token = ?", [$token]);
				return $result;
		}



}
