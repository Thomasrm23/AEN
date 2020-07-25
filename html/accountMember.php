<?php
require_once __DIR__ . '/../api/DataBaseManager.php';
require_once __DIR__ . '/../api/manager/AccountManager.php';
require_once __DIR__ . '/../api/manager/RegisterMemberManager.php';

header("Access-Control-Allow-Origin: *");
session_start();
// Mise en place de la connexion
$manager = new DataBaseManager();

// Recuperation IdMember
$accountManager = new AccountManager($manager);
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
  <form name="frmEditAccountMember" method="post" action="" onsubmit="">
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
			<!-- <div class="row justify-content-center"> -->
      <div class="row">
        <div class="col-lg-10">
          <form class="form-area contact-form text-right" id="FormAccount" >
					<!-- <table class="schdule-table table table-bordered" id="AccountMember"> -->
          <div class="row">
            <div class="col-lg-6 form-group">
              <tr>
              <td><label>Nom</label></td>
              <td><input type="hidden" name="idMember" value="<?php echo $row['idMember']; ?>"><input type="text" name="lastName" id="lastName" required="" value="<?php echo $row['lastName']; ?>"></td>
              </tr>
              <tr>
              <td><label>Date de naissance</label></td>
              <td><input type="date" name="birthDate" id="birthDate" required="" value="<?php echo $row['birthDate']; ?>"></td>
              </tr>
              <tr>
              <td><label>Cotisation à jour</label></td>
              <td><label id="contributionPayed"><?php echo $row['contributionPayed']; ?></label></td>
              </tr>
              <tr>
              <td><label>Nom d'utilisateur</label></td>
              <td><input type="text" name="login" id="email" required="" value="<?php echo $row['login']; ?>"></td>
              </tr>
              <tr>
              <td>Pour changer le mot de passe, saisir les champs ci-dessous</td>
              <td><label>Mot de passe</label></td>
              <td><input type="password" name="password" id="password" required="" value="<?php echo $row['password']; ?>"></td>
              </tr>
              <tr>
              <td><label>Confirmation de mot de passe</label></td>
              <td><input type="password" name="confirmPassword" id="confirmPassword" required="" value="<?php echo $row['password']; ?>"></td>
              </tr>
            </div>
            <div class="col-lg-6 form-group">
              <tr>
              <td><label>N° Licence FFA</label></td>
              <td><input type="text" name="license" id="license" required="" value="<?php echo $row['license']; ?>"></td>
              </tr>
              <tr>
              <td><label>Prénom</label></td>
              <td><input type="text" name="firstName" id="firstName" required="" value="<?php echo $row['firstName']; ?>"></td>
              </tr>
              <tr>
              <td><label>Adresse mail</label></td>
              <td><input type="email" name="email" id="email" required="" value="<?php echo $row['email']; ?>"></td>
              </tr>
              <tr>
              <td><label>Date du dernier règlement de cotisation</label></td>
              <td><?php echo $row['contributionDate']; ?></td>
              </tr>
              <tr>
              <td><input type="checkbox" name="memberOutside" id="memberOutside" required="" value="<?php echo $row['memberOutside']; ?>"><label for="memberOutside">"Membre d'un autre club ?"</label></td>
              </tr>
              <tr>
              <td><label>Nom du club</label></td>
              <td><input type="text" name="clubOutside" id="clubOutside" value="<?php echo $row['clubOutside']; ?>"></td>
              </tr>
            </div>
            </div>
            </form>
    			  </div>
            </div>
            <div class="row justify-content-center">
                <button type="button" name="buttonSubmit" id="buttonSubmit">Valider</button>
                <button type="button" name="buttonPay" id="buttonPay">Payer la cotisation</button>
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
