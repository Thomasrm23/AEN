<?php

require_once __DIR__ . "/../DataBaseManager.php";

class PaymentContribution {

  private DataBaseManager $manager;

  // private int $id;
  // private string $customer_id;
  private string $amount;
  private string $currency;
  private string $status;

  public function __construct() {
       $this->manager = new DatabaseManager();
     }

  public function addPaymentContribution($paymentData){

    // Prepare Query
    $this->manager->query('INSERT INTO paymentcontribution (amount, currency, status) VALUES(:amount, :currency, :status)');

    // Bind Values
    $this->manager->bind(':amount', $data['amount']);
    $this->manager->bind(':currency', $data['currency']);
    $this->manager->bind(':status', $data['status']);

    // Execute
        if($this->manager->execute()) {
          return true;
        } else {
          return false;
        }
      }
  }


}

 ?>
