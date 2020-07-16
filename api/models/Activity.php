<?php

require_once __DIR__ . "/../DataBaseManager.php";

class Activity{

  private $activityType;

    private $error = [
        "activityType" => 0
        ];

    public function __construct($activityType){

   		$this->manager = new DatabaseManager();
      $this->activityType = $activityType;

    }


}
