<?php

require_once __DIR__ . "/../DataBaseManager.php";

class PaymentService {

  private DataBaseManager $manager;

  private int $id;
  private string $customer_id;
  private string $amount;
  private string $currency;
  private string $status;
  private string $idRequest;

  public function __construct() {
       $this->manager = new DatabaseManager();
     }

  public function addPaymentService($paymentData){

    // Prepare Query
    $this->manager->query('INSERT INTO paymentservice (id, customer_id, amount, currency, status, idRequest) VALUES (:id, :customer_id, :amount, :currency, :status, :idRequest)');

    // Bind Values
    $this->manager->bind(':id', $paymentData['id']);
    $this->manager->bind(':customer_id', $paymentData['customer_id']);
    $this->manager->bind(':amount', $paymentData['amount']);
    $this->manager->bind(':currency', $paymentData['currency']);
    $this->manager->bind(':status', $paymentData['status']);
    $this->manager->bind(':idRequest', $paymentData['idRequest']);

    // Execute
        if($this->manager->execute()) {
          return true;
        } else {
          return false;
        }
      }

}

 ?>
