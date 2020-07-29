<?php
require_once __DIR__ . '/../api/pdo.php';
require_once __DIR__ . '/../api/DataBaseManager.php';
require_once __DIR__ . '/../api/manager/ServiceManager.php';

header("Access-Control-Allow-Origin: *");

// Mise en place de la connexion
$manager = new DataBaseManager();

// Recuperation des donnees de tous les membres
$serviceManager = new ServiceManager($manager);
$services = $serviceManager->getServiceAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
	<title>AEN</title>
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,200,300,400,500,700" rel="stylesheet">
	<link rel="stylesheet" href="../css/linearicons.css">
	<link rel="stylesheet" href="../css/font-awesome.min.css">
	<link rel="stylesheet" href="../css/bootstrap.css">
	<link rel="stylesheet" href="../css/magnific-popup.css">
	<link rel="stylesheet" href="../css/nice-select.css">
	<link rel="stylesheet" href="../css/animate.min.css">
	<link rel="stylesheet" href="../css/owl.carousel.css">
	<link rel="stylesheet" href="../css/jquery-ui.css">
	<link rel="stylesheet" href="../css/main.css">
</head>
<body>
	<header id="header">
	</header>
  <form name="frmServiceViewAll" method="post" action="">
    <section class="banner-area relative about-banner" id="home">
  		<img class="cta-img img-fluid" src="img/cta-img.png" alt="">
  		<div class="overlay overlay-bg"></div>
  		<div class="container">
  			<div class="row d-flex align-items-center justify-content-center">
  				<div class="about-content col-lg-12">
  					<h1>
  						Consulter les commandes de service
  					</h1>
  					<p class="link-nav"><a href="index.html">Accueil </a>
  						<span class="lnr lnr-arrow-right"></span> <a href="serviceViewAll.php">
  						  Consulter les commandes de service</a></p>
  				</div>
  			</div>
  		</div>
  	</section>
    <section class="contact-page-area section-gap">
  		<div class="container">
  			<div class="row justify-content-center">
          <div><b><p align="center">VEUILLEZ SELECTIONNER UNE LIGNE</p></b></div>
          <div class="table-wrap col-lg-10">
  					<table class="schdule-table table table-bordered">
  						<thead class="thead-light">
                <th></th>
                <th class="head" scope="col">Reference commande</th>
                <th class="head" scope="col">Nom</th>
                <th class="head" scope="col">Prénom</th>
                <th class="head" scope="col">Pays</th>
                <th class="head" scope="col">Date de passage</th>
                <th class="head" scope="col">Date de la commande</th>
                <th class="head" scope="col">Statut</th>
                <th class="head" scope="col">Basé</th>
  						</thead>
              <?php
              $i=0;
              while($row = mysqli_fetch_array($services)) {
              ?>
              <td><input type="radio" name="serviceChecked" id="serviceChecked" value="<?php echo $row["idRequest"]; ?>" ></td>
              <td ><?php echo $row["idRequest"]; ?></td>
              <td><?php echo $row["lastName"]; ?></td>
              <td><?php echo $row["firstName"]; ?></td>
              <td><?php echo $row["country"]; ?></td>
              <td><?php echo $row["serviceDate"]; ?></td>
              <td><?php echo $row["requestDate"]; ?></td>
              <td><?php echo $row["stateRequest"]; ?></td>
              <td><?php echo $row["basedChoice"]; ?></td>
              </tr>
              <?php
              $i++;
              }
              ?>
          </table>
       </div>
      </div>
        <div class="row justify-content-center">
          <td>
            <button type="submit" name="buttonDelete" id="buttonDelete" onclick="setViewBill()">Voir la facture</td>
            <button type="button" name="buttonQuit" id="buttonQuit">Quitter</button>
        </div>
   </div>
  </section>
  <footer>
  </footer>
  <script src="../jquery/jquery-3.2.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
   crossorigin="anonymous"></script>
  <script src="../js/vendor/bootstrap.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA"></script>
  <script src="../js/easing.min.js"></script>
  <script src="../js/hoverIntent.js"></script>
  <script src="../js/superfish.min.js"></script>
  <script src="../js/jquery.ajaxchimp.min.js"></script>
  <script src="../js/jquery.magnific-popup.min.js"></script>
  <script src="../js/jquery.tabs.min.js"></script>
  <script src="../js/jquery.nice-select.min.js"></script>
  <script src="../js/owl.carousel.min.js"></script>
  <script src="../js/main.js"></script>
  <script src="../js/isCo.js"></script>
  <script type="text/javascript">

  function setViewBill() {
     // document.frmAccountAdmin.action = "../api/service/viewBill.php";
     // document.frmAccountAdmin.submit();
   }

  </script>
  </form>
</body>
</html>
