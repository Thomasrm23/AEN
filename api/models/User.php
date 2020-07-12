<?php

require_once __DIR__ . "/../DataBaseManager.php";

class User{
	private $manager;
    private $firstName;
    private $lastName;
    private $email;
    private $login;
    private $password;
    private $confirmPassword;
    private $token;
    private $type;


    // private $error = [
    //     "firstName" => 0,
    //     "lastName" => 0,
    //     "email" => 0,
    //     "login" => 0,
    //     "password" => 0,
    //     "confirmPassword" => 0,
    //     "token" => 0,
    //     "type" => 0
		//
    //     ];

    public function __construct($firstName, $lastName, $email, $login, $password, $confirmPassword, $token, $type){

   		$this->manager = new DatabaseManager();
   		$this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->login = $login;
        $this->password = $password;
        $this->confirmPassword = $confirmPassword;
        $this->token = $token;
        $this->type = $type;

    }

}
