<?php
require_once __DIR__ . '/../api/DataBaseManager.php';
require_once __DIR__ . '/../api/manager/RegisterMemberManager.php';

header("Access-Control-Allow-Origin: *");
session_start();

// Mise en place de la connexion
$manager = new DataBaseManager();

// Recuperation IdMember
if(isset($_SESSION['idMember'])){
    $idMember = $_SESSION['idMember'];
}
else{
    http_response_code(402);
    die();
}

// Recuperation des donnees du membre
$registerMember = new RegisterMemberManager($manager);
$account = $registerMember->getAccountMember($idMember);
$row = $account[0];
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
  <form name="frmEditAccountMember" method="post" action="">
	<section class="banner-area relative about-banner" id="home">
		<img class="cta-img img-fluid" src="img/cta-img.png" alt="">
		<div class="overlay overlay-bg"></div>
		<div class="container">
			<div class="row d-flex align-items-center justify-content-center">
				<div class="about-content col-lg-12">
					<h1>
						Mon Compte
					</h1>
					<p class="link-nav"><a href="index.html">Accueil </a>
						<span class="lnr lnr-arrow-right"></span> <a href="accountMember.php">
						  Mon Compte </a></p>
				</div>
			</div>
		</div>
	</section>
	<section class="contact-page-area section-gap">
		<div class="container">
			<div class="row justify-content-center">
        <div class="col-lg-12">
          <form class="form-area contact-form text-left" id="FormAccount" >
					<!-- <table class="schdule-table table table-bordered" id="AccountMember"> -->
          <div class="row">
            <div class="col-lg-6 form-group">
              <label>Nom :</label>
              <input type="hidden" name="idMember" value="<?php echo $row['idMember']; ?>"><input type="text" name="lastName" id="lastName" required="" value="<?php echo $row['lastName']; ?>">
              <br><label>Adresse : </label>
              <input type="text" name="address" id="address" required="" value="<?php echo $row['address']; ?>">
              <br><label>Date de naissance :</label>
              <input type="date" name="birthDate" id="birthDate" required="" value="<?php echo $row['birthDate']; ?>">
              <br>Téléphone : </label>
              <input type="text" name="phoneNumber" id="phoneNumber" required="" value="<?php echo $row['phoneNumber']; ?>">
              <br><label>Nom d'utilisateur :</label>
              <input type="text" name="login" id="email" required="" value="<?php echo $row['login']; ?>">
              <br>Pour changer le mot de passe, saisir les champs ci-dessous :
              <br><label>Mot de passe :</label>
              <input type="password" name="password" id="password" required="" value="<?php echo $row['password']; ?>">
              <br><label>Confirmation de mot de passe :</label>
              <input type="password" name="confirmPassword" id="confirmPassword" required="" value="<?php echo $row['password']; ?>">
            </div>
            <div class="col-lg-6 form-group">
              <label>Prénom :</label>
              <input type="text" name="firstName" id="firstName" required="" value="<?php echo $row['firstName']; ?>">
              <br><label>Code Postal :</label>
              <input type="text" name="postalCode" id="postalCode" required="" value="<?php echo $row['postalCode']; ?>">
              <label>Ville :</label></td>
              <input type="text" name="city" id="city" required="" value="<?php echo $row['city']; ?>">
              <br><label>N° Licence FFA :</label>
              <input type="text" name="license" id="license" required="" value="<?php echo $row['license']; ?>">
              <br>Membre d'un autre club  <input type="checkbox" name="memberOutside" id="memberOutside" required="" value="<?php echo $row['memberOutside']; ?>"><label for="memberOutside"></label>
              <br><label>Nom du club :</label><input type="text" name="clubOutside" id="clubOutside" value="<?php echo $row['clubOutside']; ?>">
              <br><label>Adresse mail :</label>
              <input type="email" name="email" id="email" required="" value="<?php echo $row['email']; ?>">
              <br><label>Cotisation à jour :</label><label id="contributionPayed"><?php echo $row['contributionPayed']; ?></label>
              <br><label>Date du dernier règlement de cotisation :</label><?php echo $row['contributionDate']; ?>
            </div>
            </div>
            </form>
    			  </div>
          </div>
          <div class="row justify-content-center">
              <button type="button" name="buttonSubmit" id="buttonSubmit">Valider</button>
              <button type="button" name="buttonPay" id="buttonPay">Payer ma cotisation</button>
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

       $(function(){

        //  Clic sur Valider du formulaire
        $(document).on('click','#buttonSubmit' ,function(event){
          event.preventDefault();

          var data1 = {
            idMember: $('#idMember').val(),
            lastName: $('#lastName').val(),
            lastName: $('#lastName').val(),
            firstName: $('#firstName').val(),
            address: $('#address').val(),
            postalCode: $('#postalCode').val(),
            city: $('#city').val(),
            phoneNumber: $('#phoneNumber').val(),
            birthDate: $('#birthDate').val(),
            memberOutside: $('#memberOutside').val(),
            clubOutside: $('#clubOutside').val(),
            license: $('#license').val(),
            email: $('#email').val(),
            login: $('#login').val(),
            password: $('#password').val(),
            confirmPassword: $('#confirmPassword').val()
    			};

          $.ajax({
            url: '../api/register/editMember.php',
            dataType: 'text',
            method: "POST",
            data : {data: JSON.stringify(data1)},
            success: function(data, status, xhr){
              console.log(data1);
              window.location.replace("index.html");
            },
           error: function(xhr, status, error){
               console.log(xhr.responseText);
               showError(JSON.parse(xhr.responseText));
               window.location.replace("accountMember.php");
           }
          })
         })

         // Clic sur Payer la contribution du formulaire
         $(document).on('click','#buttonPay',function(){
           if(document.getElementById("contributionPayed").value = "OUI") {
             alert('Votre cotisation est deja réglée');
          } else{
            window.location.replace("paymentContribution.php");
          }

         })

         // Clic sur quiiter
         $(document).on('click','#buttonQuit',function(){
            window.location.replace("index.html");
         })

      })

      window.onload = function() {

        // Afficher en rouge "NON" si contribution non payee
        if(document.getElementById("contributionPayed").value = "NON")
        {
          document.getElementById("contributionPayed").style.color="red";
        }
        else
        {
          document.getElementById("contributionPayed").style.color="#777777";
        }

      };

      </script>
      </form>
    </body>
    </html>
