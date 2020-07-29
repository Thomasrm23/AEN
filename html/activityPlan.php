<?php
require_once __DIR__ . '/../api/pdo.php';
require_once __DIR__ . '/../api/DataBaseManager.php';
require_once __DIR__ . '/../api/manager/ActivityManager.php';

header("Access-Control-Allow-Origin: *");

// Mise en place de la connexion
$manager = new DataBaseManager();
// Recuperation des donnees de tous les membres
$activityManager = new ActivityManager($manager);
$result = $activityManager->getActivityToPlan();

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
  <form name="frmActivityPlan" method="post" action="">
	<section class="banner-area relative about-banner" id="home">
		<img class="cta-img img-fluid" src="img/cta-img.png" alt="">
		<div class="overlay overlay-bg"></div>
		<div class="container">
			<div class="row d-flex align-items-center justify-content-center">
				<div class="about-content col-lg-12">
					<h1>
						Planifier les activités
					</h1>
					<p class="link-nav"><a href="index.html">Accueil </a>
						<span class="lnr lnr-arrow-right"></span> <a href="activityPlan.php">
						  Planifier les activités </a></p>
				</div>
			</div>
		</div>
	</section>
	<section class="contact-page-area section-gap">
		<div class="container">
			<div class="row justify-content-center">
        <div class="table-wrap col-lg-12">
          <div><b><p align="center">VEUILLEZ SELECTIONNER UNE LIGNE</p></b></div>
					<table class="schdule-table table table-bordered">
						<thead class="thead-light">
              <th></th>
              <th class="head" scope="col">Nom activité</th>
              <th class="head" scope="col">Identifiant membre</th>
              <th class="head" scope="col">Nom membre</th>
              <th class="head" scope="col">Nombre d'heures</th>
              <th class="head" scope="col">Utilisation</th>
              <th class="head" scope="col">Instructeur requis ?</th>
						</thead>
              <?php
              $i=0;
              while($row = mysqli_fetch_array($result)) {
              // if($i%2==0)
              // $classname="evenRow";
              // else
              // $classname="oddRow";
              ?>
              <!-- <tr class="<?php if(isset($classname)) echo $classname;?>"> -->
              <td><input type="radio" name="activityChecked" id="activityChecked" value="<?php echo $row["idActivity"]; ?>" ></td>
              <td><?php echo $row["nameActivityType"]; ?></td>
              <td><?php echo $row["idMember"]; ?></td>
              <td><?php echo $row["userName"]; ?></td>
              <td><?php echo $row["nbHours"]; ?></td>
              <td><?php echo $row["utility"]; ?></td>
              <td><?php echo $row["instructorNeeded"]; ?></td>
              </tr>
              <?php
              $i++;
              }
              ?>
				  </table>
			  </div>
      </div>
        <div class="row justify-content-center" >
            <button class="genric-btn primary" type="submit" name="buttonUpdate" id="buttonUpdate" onClick="setUpdateAction()">Mettre à jour</button>
            <button class="genric-btn primary" type="submit" name="buttonDelete" id="buttonDelete" onClick="setDeleteAction()">Supprimer</button>
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

 function setDeleteAction() {
    // if(confirm("Voulez-vous vraiment supprimer cette activité ?")) {
      document.frmActivityPlan.action = "../api/activity/deleteActivity.php";
      document.frmActivityPlan.submit();
    // }
  }

  function setUpdateAction() {
      document.frmActivityPlan.action = "activityEdit.php";
      document.frmActivityPlan.submit();
  }

 </script>
</form>
</body>
</html>
