<?php
//
// $nameError = 0;
// $firstNameError = 0;
// $mailError = 0;
// $passwordError = 0;
// $passwordConfirmError = 0;
// $captchaError = 0;
// $error = 0;
// $ageError = 0;
// $priceError = 0;
// $postaleCodeError = 0;
// $distanceError = 0;


if (empty($_POST['lastName']) == 0 && empty($_POST['firstName']) == 0){

$lastName = trim($_POST['lastName']);
$firstName = trim($_POST['firstName']);
$birthDate = trim($_POST['birthDate']);
$memberOutside = trim($_POST['memberOutside']);
$clubOutside = trim($_POST['clubOutside']);
$license = trim($_POST['license']);
$email = trim($_POST['email']);
$login = trim($_POST['login']);
$password = trim($_POST['password']);
$confirmPassword = trim($_POST['password']);
echo $lastName;
}
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

	<section class="banner-area relative about-banner" id="home">
		<img class="cta-img img-fluid" src="img/cta-img.png" alt="">
		<div class="overlay overlay-bg"></div>
		<div class="container">
			<div class="row d-flex align-items-center justify-content-center">
				<div class="about-content col-lg-12">
					<h1>
						Inscription Membre
					</h1>
					<p class="link-nav"><a href="index.html">Accueil </a>
						<span class="lnr lnr-arrow-right"></span> <a href="registerMember.html">
							Inscription Membre</a></p>
				</div>
			</div>
		</div>
	</section>
  <section class="contact-page-area section-gap">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
          <form class="form-area contact-form text-right" action="paymentContribution.php" method="post" enctype="multipart/form-data">
            <div class="row">
              <div class="col-lg-6 form-group">

                <input name="lastName" placeholder="Nom" id="lastName" class="common-input mb-20 form-control" required="" type="text">
                <input name="firstName" placeholder="Prénom" id="firstName" class="common-input mb-20 form-control" required="" type="text">
                <input name="birthDate" placeholder="Date de naissance" id="birthDate" class="common-input mb-20 form-control" required="" type="date">

                <div class="common-input mb-20 form-control" style="text-align:left">
                  <input name="memberOutside" placeholder="" id="memberOutside" class="common-input mb-20 form-control" type="checkbox"
                  value="0" onclick="if (this.checked) this.value=1; else this.value=0;">
                  <label class="common-input mb-20 form-control">"Membre d'un autre club ?"</label>
                </div>

                <input name="clubOutside" placeholder="Nom du Club" id="clubOutside" class="common-input mb-20 form-control" type="text">

              </div>
              <div class="col-lg-6 form-group">
                <input name="license" placeholder="N° Licence FFA" id="license" class="common-input mb-20 form-control" type="text">


                <input name="email" placeholder="Adresse mail" id="email" class="common-input mb-20 form-control" required="" type="email">

                <input name="login" placeholder="Nom d'utilisateur" id="login" class="common-input mb-20 form-control" required="" type="text">

                <input name="password" placeholder="Mot de passe" id="password" class="common-input mb-20 form-control" required="" type="password">

                <input name="confirmPassword" placeholder="Confirmation de mot de passe" id="confirmPassword" class="common-input mb-20 form-control" required="" type="password">

                <!-- <button onclick="getContribution()" class="genric-btn primary">Calculer ma cotisation</button> -->


              </div>

              <div class="col-lg-12">
                <button onclick="validateRegistration()" class="genric-btn primary" style="float: right;">M'inscrire</button>
              </div>


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

  <script src="../js/isCo.js">

  </script>



</body>
</html>
