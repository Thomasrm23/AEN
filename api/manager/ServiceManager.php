<?php

require_once __DIR__ . '/../DataBaseManager.php';

class ServiceManager{
    private DataBaseManager $manager;

    public function __construct($manager)
    {
        $this->manager = $manager;
    }

    public function getService(){
        $found = $this->manager->getAll('SELECT * from service');
        return $found;
    }


}
