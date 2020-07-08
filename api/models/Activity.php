<?php

require_once __DIR__ . "/../DataBaseManager.php";

class Activity{

  private $dateRequest;
  private $activity;

    private $error = [
        "dateRequest" => 0,
        "activity" => 0
        ];

    public function __construct($dateRequest, $activity){

   		$this->manager = new DatabaseManager();
      $this->dateRequest = $dateRequest;
      $this->activity = $activity;

    }
    

}
