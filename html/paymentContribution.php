<?php

require_once __DIR__ . '/../api/DataBaseManager.php';
require_once __DIR__ . '/../api/manager/RegisterMemberManager.php';

session_start();

$manager = new DataBaseManager();
$contributionManager = new RegisterMemberManager($manager);

// Recuperation de la cotisation
if(isset($_SESSION['idMember'])){
    $idMember = $_SESSION['idMember'];
    $contribution = $contributionManager->getContribution($_SESSION['idMember']);
    $amount = $contribution[0]['feeContribution'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="author" content="">

	<title>Paiement de la cotisation</title>

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
  <link rel="stylesheet" href="../css/payment.css">


</head>
<body>

	<header id="header">
	</header>

	<section class="banner-area relative about-banner" id="home">
		<img class="cta-img img-fluid" src="img/cta-img.png" alt="">
		<div class="overlay overlay-bg"></div>
		<div class="container">
			<div class="row d-flex align-items-center justify-content-center">
				<div class="about-content col-lg-12">
					<h1>
						Paiement de la cotisation
					</h1>
					<p class="link-nav"><a href="index.html">Accueil </a>
						<span class="lnr lnr-arrow-right"></span> <a href="paymentContribution.php">
							Paiement de la cotisation</a></p>
				</div>
			</div>
		</div>
	</section>
	<section class="contact-page-area section-gap">
		<div class="container">
			<div class="row">
        <div class="col-lg-12 form-group" style="display:flex; justify-content:center">
          <form action="../payment/chargeContribution.php" method="post" id="payment-form">
            <div class="form-row">
              <div style="display:flex; justify-content:flex-start;">
                  <h3> Montant : <?php echo $amount ?> </h3>
                  <!-- <h3 value="" id="amount" name="amount"></h3> -->
                  <h3> €</h3>

              </div>
              <input type="text" name="cardHolder" class="form-control mb-3 StripeElement StripeElement--empty" placeholder="Titulaire de la carte">

              <div id="card-element" class="form-control">
                <!-- a Stripe Element will be inserted here. -->
              </div>

              <!-- Used to display form errors -->
              <div id="card-errors" role="alert"></div>
            </div>
            <div style="display:flex; justify-content:space-between;;">
            <button style="width:40%;">Payer</button>

            <button class="btn btn-primary btn-block mt-4" style="width:40%;" onclick="window.location.href='index.html'"> Annuler </button>
            </div>
          </form>
        </div>
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


  <script src="https://js.stripe.com/v3/"></script>

  <script src="../js/chargeContribution.js"></script>

</body>
</html>
