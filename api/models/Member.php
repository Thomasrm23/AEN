<?php

require_once __DIR__ . "/../DataBaseManager.php";
require_once __DIR__ . '/User.php';

class Member extends User{

    private DataBaseManager $manager;

    private string $birthDate;
    private string $memberOutside;
    private string $license;

    public function __construct($firstName, $lastName, $email, $login, $password, $confirmPassword, $token, $type, $birthDate, $memberOutside, $license, $clubOutside){

    	parent::__construct($firstName, $lastName, $email, $login, $password, $confirmPassword, $token, $type);

    	$this->manager = new DataBaseManager();
        $this->birthDate = $birthDate;
        $this->memberOutside = $memberOutside;
        $this->license = $license;
        $this->clubOutside = $clubOutside;

    }

	public function __toString(){
        $result = parent::__toString();
        return  $result . json_encode(get_object_vars($this));
    }


}

