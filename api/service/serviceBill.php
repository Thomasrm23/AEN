<?php

require __DIR__.'/../../html2pdf/vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;
ob_start();

// $html2pdf = new Html2Pdf();
// $html2pdf->writeHTML('<h1>HelloWorld</h1>This is my first test');
// $html2pdf->output();

require_once __DIR__ . '/../DataBaseManager.php';
require_once __DIR__ . '/../manager/ServiceManager.php';

require_once __DIR__ . '/../pdo.php';
header("Access-Control-Allow-Origin: *");

// Verifier si une ligne est selectionnee
if(isset($_POST["serviceChecked"])){

  // Recuperation des donnees de la facture
  $idRequest = $_POST["serviceChecked"];
  $manager = new DatabaseManager();
  $serviceManager = new ServiceManager($manager);
  $serviceBill = $serviceManager->getServiceBill($idRequest);

  //
  $user = array(
      "id" => 1,
      "firstname" => "AEN",
      "lastname" => "Aerodrome",
      "phoneNumber" => "02 32 37 52 80",
      "address" => "rue de Damville\n27220 Les Authieux"
  );


  $i=0;
  while($row = mysqli_fetch_array($serviceBill)) {


  $client = array(
      "id" => 1,
      "firstname" => $row['lastName'],
      "lastname" => $row['firstName'],
      "phoneNumber" => $row['phoneNumber'],
      "address" => $row['address'],
      "postalCode" => $row['postalCode'],
      "city" => $row['city'],
      "country" => $row['country'],
      "idRequest" => $row['idRequest']
    );

  $tasks[] = array(
      "id" => 1,
      "serviceName" => $row['serviceName'],
      "priceHT" => $row['priceHT'],
      "priceTTC" => $row['priceTTC']
    );

$i++;
}

  $total = 0;
  $total_tva = 0;

}
?>

<style type="text/css">
    table {
        width: 100%;
        color: #717375;
        font-family: helvetica;
        line-height: 5mm;
        border-collapse: collapse;
    }

    h2 {
        margin: 0;
        padding: 0;
    }

    p {
        margin: 5px;
    }

    .border th {
        border: 1px solid #000;
        color: white;
        background: #000;
        padding: 5px;
        font-weight: normal;
        font-size: 14px;
        text-align: center;
    }

    .border td {
        border: 1px solid #CFD1D2;
        padding: 5px 10px;
        text-align: center;
    }

    .no-border {
        border-right: 1px solid #CFD1D2;
        border-left: none;
        border-top: none;
        border-bottom: none;
    }

    .space {
        padding-top: 250px;
    }

    .10
    p {
        width: 10%;
    }

    .15
    p {
        width: 15%;
    }

    .25
    p {
        width: 25%;
    }

    .50
    p {
        width: 50%;
    }

    .60
    p {
        width: 60%;
    }

    .75
    p {
        width: 75%;
    }
</style>
<page backtop="10mm" backleft="10mm" backright="10mm" backbottom="10mm" footer="page;">

    <page_footer>
        <hr/>
        <p>Evreux, le <?php echo date("d/m/y"); ?></p>
        <p>Signature du client, suivie de la mention manuscrite "Bon pour accord"</p>
    </page_footer>


    <div>
      <div style="display:flex; justify-content:flex-end;">
        <p></p>
        <p><strong><?php echo $user['firstname'] . " " . $user['lastname']; ?></strong><br>
        <?php echo nl2br($user['address']); ?><br/>
        <?php echo ($user['phoneNumber']); ?></p>
      </div>
      <div style="text-align:right;">
          <p><strong><p><?php echo $client['firstname'] . " " . $client['lastname']; ?></p></strong><br>
          <?php echo ($client['address']); ?><br/>
          <?php echo ($client['postalCode']); ?><br/>
          <?php echo ($client['city']); ?><br/>
          <?php echo ($client['country']); ?><br/>
          <?php echo ($client['phoneNumber']); ?><br/></p>
      </div>
    </div>

            <h2 style="margin-top: 30px;">Facture</h2>
            <h5>Emis le <?php echo date("d/m/y"); ?></h5>
            <h5>Reference Commande : <?php echo ($client['idRequest']); ?></h5>


    <!-- </table> -->

    <table style="margin-top: 50px;" class="border">
        <thead>
        <tr>
            <th class="60p">Service</th>
            <th class="10p">Prix HT</th>
            <th class="15p">Prix TTC</th>
        </tr>
      </thead>
       <?php
            $totalHT = 0;
            $totalTTC = 0;
       ?>
        <tbody>
        <?php foreach ($tasks as $task): ?>
            <tr>
                <td><?php echo $task['serviceName']; ?></td>
                <td><?php echo $task['priceHT']; ?> €</td>
                <td><?php echo $task['priceTTC']; ?> €</td>
                <?php
                $totalHT += $task['priceHT'];
                $totalTTC += $task['priceTTC']; ?>
            </tr>
        <?php endforeach ?>

        <!-- <tr>
            <td class="space"></td>
            <td></td>
            <td></td>
            <td></td>
        </tr> -->

        <tr>
            <!-- <td colspan="2" class="no-border"></td> -->
            <td><strong>Total </strong></td>
            <td><?php echo $totalHT; ?> €</td>
            <td> <?php echo $totalTTC; ?> €</td>

        </tr>
        <!-- <tr> -->
            <!-- <td colspan="2" class="no-border"></td> -->
        <!-- </tr> -->
        </tbody>
    </table>

</page>

<?php
 // $content = ob_get_clean();

  // $html2pdf = new Html2Pdf();
  // $html2pdf->writeHTML('<h1>HelloWorld</h1>This is my first test');
  // $html2pdf->output();


  $content = ob_get_clean();

try {

    // $html2pdf = new Html2Pdf();
    // $html2pdf->writeHTML('<h1>HelloWorld</h1>This is my first test');
    // $html2pdf->output();

    $html2pdf = new Html2Pdf();
    $html2pdf->pdf->SetAuthor('AEN');
    $html2pdf->pdf->SetTitle('Facture');
    $html2pdf->pdf->SetKeywords('HTML2PDF, Facture, PHP');
    $html2pdf->writeHTML($content);
    $html2pdf->output();



//$pdfContent = $html2pdf->output('my_doc.pdf', 'S');
//$contentPdf = $pdf->output();

    //echo $content;
} catch (\Spipu\Html2Pdf\Exception\Html2PdfException $e) {
    echo $e->getMessage();
}
http_response_code(200);
die();
