<?php
require_once __DIR__ . '/../api/DataBaseManager.php';
require_once __DIR__ . '/../api/manager/ServiceManager.php';

require_once __DIR__ . '/../api/pdo.php';
header("Access-Control-Allow-Origin: *");

// Verifier si une ligne est selectionnee
if(isset($_POST["serviceChecked"])){

  // Recuperation des donnees de la facture
  $idRequest = $_POST["serviceChecked"];
  $manager = new DatabaseManager();
  $serviceManager = new ServiceManager($manager);
  $row = $serviceManager->getServiceBill($idRequest);

  //
  $user = array(
      "id" => 1,
      "firstname" => "AEN",
      "lastname" => "Aerodrome",
      "phoneNumber" => "02 32 37 52 80",
      "address" => "Rue de Damville\n27220 Les Authieux"
  );

  $client = array(
      "id" => 1,
      "firstname" => $row['lastName'],
      "lastname" => $row['firstName'],
      "phoneNumber" => $row['phoneNumber'],
      "address" => $row['address'] . " " . $row['postalCode'] . " " . $row['city'],
      "country" => $row['country'],
      "idRequest" => $row['idRequest']
    );

  $tasks[] = array(
      "id" => 1,
      "serviceName" => $row['serviceName'],
      "priceHT" => $row['priceHT'],
      "priceTTC" => $json['priceTTC']
    );


  ob_start();
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

    <table style="vertical-align: top;">
        <tr>
            <td class="75p">
              <strong><?php echo $user['firstname'] . " " . $user['lastname']; ?></strong><br/>
              <?php echo nl2br($user['address']); ?><br/>
              <?php echo ($user['phoneNumber']); ?><br/>
            </td>
            <td class="25p">
                <strong><?php echo $client['firstname'] . " " . $client['lastname']; ?></strong><br/>
                <?php echo nl2br($client['address']); ?><br/>
                <?php echo ($client['country']); ?><br/>
                <?php echo ($client['phoneNumber']); ?><br/>
            </td>
        </tr>
    </table>

    <table style="margin-top: 50px;">
        <tr>
            <td class="50p"><h2>Facture</h2></td>
            <td class="50p" style="text-align: right;">Emis le <?php echo date("d/m/y"); ?></td>
            <td class="50p" style="text-align: right;">Reference Commande : <?php echo ($client['idRequest']); ?></td>
        </tr>

    </table>

    <table style="margin-top: 30px;" class="border">
        <thead>
        <tr>
            <th class="60p">Service</th>
            <th class="10p">Prix HT</th>
            <th class="15p">Prix TTC</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($tasks as $task): ?>
            <tr>
                <td><?php echo $task['serviceName']; ?> €</td>
                <td><?php echo $task['priceHT']; ?> €</td>
                <td><?php echo $task['priceTTC']; ?> €</td>
                <?php
                $totalHT += $task['priceHT'];
                $totalTTC += $task['priceTTC']; ?>
            </tr>
        <?php endforeach ?>

        <tr>
            <td class="space"></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>

        <tr>
            <td colspan="2" class="no-border"></td>
            <td style="text-align: center;" rowspan="3"><strong>Total:</strong></td>
            <td>Total HT : <?php echo $totalHT; ?> €</td>
        </tr>
        <tr>
            <td colspan="2" class="no-border"></td>
            <td>Total TTC : <?php echo $totalTTC; ?> €</td>
        </tr>
        </tbody>
    </table>

</page>

<?php
$content = ob_get_clean();

try {
    $pdf = new Html2Pdf();
    $pdf->pdf->SetAuthor('DOE John');
    $pdf->pdf->SetTitle('Facture');
    $pdf->pdf->SetSubject('Facture' . $row['idRequest']);
    $pdf->pdf->SetKeywords('HTML2PDF, Facture, PHP');
    $pdf->writeHTML($content);

//$pdfContent = $html2pdf->output('my_doc.pdf', 'S');
//$contentPdf = $pdf->output();

    echo $content;
} catch (\Spipu\Html2Pdf\Exception\Html2PdfException $e) {
    echo $e->getMessage();
}
http_response_code(200);
die();
