<?php

echo "123";
require_once __DIR__ . '/../DataBaseManager.php';
require_once  __DIR__ . '/../models/Customer.php';
////// tout
class RegisterCustomerManager{
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

    public function register($lastName){

        echo "fctttt";

        $this->manager->exec('INSERT INTO user (lastName) VALUES (?)',[$lastName]);



            return "ok";

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
