<?php
require_once __DIR__ . '/../api/pdo.php';
require_once __DIR__ . '/../api/DataBaseManager.php';
require_once __DIR__ . '/../api/manager/RegisterMemberManager.php';

header("Access-Control-Allow-Origin: *");

// Connect to database
$link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Mise en place de la connexion
$manager = new DataBaseManager();
// Recuperation des donnees de tous les membres
$registerMember = new RegisterMemberManager($manager);
$account = $registerMember->getAccountAdmin();
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
  <form name="frmAccountAdmin" method="" action="">
	<section class="banner-area relative about-banner" id="home">
		<img class="cta-img img-fluid" src="img/cta-img.png" alt="">
		<div class="overlay overlay-bg"></div>
		<div class="container">
			<div class="row d-flex align-items-center justify-content-center">
				<div class="about-content col-lg-12">
					<h1>
						Consulter les comptes des membres
					</h1>
					<p class="link-nav"><a href="index.html">Accueil </a>
						<span class="lnr lnr-arrow-right"></span> <a href="activityPlan.php">
						  Consulter les comptes des membres </a></p>
				</div>
			</div>
		</div>
	</section>
	<section class="contact-page-area section-gap">
		<div class="container">
			<div class="row justify-content-center">
        <div class="table-wrap col-lg-10">
					<table class="schdule-table table table-bordered">
						<thead class="thead-light">
              <th></th>
              <th class="head" scope="col">Nom</th>
              <th class="head" scope="col">Prénom</th>
              <th class="head" scope="col">Date de naissance</th>
              <th class="head" scope="col">Adresse mail</th>
              <th class="head" scope="col">Cotisation à jour</th>
              <th class="head" scope="col">Date du dernier règlement de cotisation</th>
              <th class="head" scope="col">N° Licence FFA</th>
              <th class="head" scope="col">Membre d'un autre club</th>
              <th class="head" scope="col">Nom du club</th>
						</thead>
              <?php
              $i=0;
              while($row = mysqli_fetch_array($account)) {
                if($i%2==0)
                $classname="evenRow";
                else
                $classname="oddRow";
              ?>
              <tr class="<?php if(isset($classname)) echo $classname;?>">
              <td><input type="radio" name="memberChecked" id="idMember" value="<?php echo $row["idMember"]; ?>" ></td>
              <td><?php echo $row["idMember"]; ?></td>
              <td><?php echo $row["lastName"]; ?></td>
              <td><?php echo $row["firstName"]; ?></td>
              <td><?php echo $row["birthDate"]; ?></td>
              <td><?php echo $row["email"]; ?></td>
              <td><?php echo $row["contributionPayed"]; ?></td>
              <td><?php echo $row["contributionDate"]; ?></td>
              <td><?php echo $row["license"]; ?></td>
              <td><?php echo $row["memberOutside"]; ?></td>
              <td><?php echo $row["clubOutside"]; ?></td>
              </tr>
              <?php
              $i++;
              echo $i;
              }
              ?>
				  </table>
			  </div>
      </div>
        <div class="row justify-content-center">
          <td>
            <button type="button" name="buttonDelete" id="buttonDelete">Supprimer</td>
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

   // Clic sur Supprimer du formulaire
   $(document).on('click','#buttonDelete', function(event){

     event.preventDefault();

     var data1 = {
       idMember: $('#idMember').val(),
     };

     $.ajax({
       url: '../api/register/deleteMember.php',
       dataType: 'text',
       method: "POST",
       data : {data: JSON.stringify(data1)},
       success: function(data, status, xhr){
         console.log(data1);
         window.location.replace("accountAdmin.php");
       },
      error: function(xhr, status, error){
          console.log(xhr.responseText);
          // showError(JSON.parse(xhr.responseText));
          window.location.replace("accountAdmin.php");
      }
     })
    })
 })

 </script>
</form>
</body>
</html>
