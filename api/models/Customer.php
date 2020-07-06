<?php

require_once __DIR__ . "/../DataBaseManager.php";
require_once __DIR__ . '/User.php';

class Customer extends User{

    private DataBaseManager $manager;

    private string $country;

    public function __construct($firstName, $lastName, $email, $login, $password, $confirmPassword, $token, $type, $country){

    	parent::__construct($firstName, $lastName, $email, $login, $password, $confirmPassword, $token, $type);

    	$this->manager = new DataBaseManager();
    	$this->country = $country;

    }

	public function __toString(){
        $result = parent::__toString();
        return  $result . json_encode(get_object_vars($this));
    }


}
