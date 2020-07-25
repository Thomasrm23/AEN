<?php
// require_once('../../manager/ActivityManager.php');
require_once __DIR__ . '/../api/DataBaseManager.php';
require_once __DIR__ . '/../api/manager/ActivityManager.php';

require_once __DIR__ . '/../api/pdo.php';
header("Access-Control-Allow-Origin: *");

// Fonction ALert Message
function function_alert($message) {
    // Display the alert box
    echo "<script>alert('$message');</script>";
}

// Verifier si une ligne est cochee
if(isset($_POST["activityChecked"])){
  $idActivity = $_POST["activityChecked"];
  $manager = new DatabaseManager();
  $activityManager = new ActivityManager($manager);
  $row = $activityManager->getActivityToEdit($idActivity);
}
else {
  // Function call
  header("Location: activityPlan.php");
  //function_alert("Veuillez cocher une ligne");
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
  <form name="frmEditActivity" method="post" action="" onsubmit="">
	<section class="banner-area relative about-banner" id="home">
		<img class="cta-img img-fluid" src="img/cta-img.png" alt="">
		<div class="overlay overlay-bg"></div>
		<div class="container">
			<div class="row d-flex align-items-center justify-content-center">
				<div class="about-content col-lg-12">
					<h1>
						Mettre à jour les activités
					</h1>
					<p class="link-nav"><a href="index.html">Accueil </a>
						<span class="lnr lnr-arrow-right"></span> <a href="activityEdit.php">
						  Mettre à jour les activités </a></p>
				</div>
			</div>
		</div>
	</section>
	<section class="contact-page-area section-gap">
		<div class="container">
			<div class="row justify-content-center">
        <div class="table-wrap col-lg-10">
					<table class="schdule-table table table-bordered" id="listActvity">
              <tr>
              <thead class="thead-light">
                <th class="head" scope="col">Nom activité</th>
                <th class="head" scope="col">Identifiant membre</th>
                <th class="head" scope="col">Nom membre</th>
                <th class="head" scope="col">Nombre d'heures</th>
                <th class="head" scope="col">Utilisation</th>
                <th class="head" scope="col">Instructeur requis ?</th>
  						</thead>
              </tr>
              <td><input type="hidden" name="idActivity" id="idActivity" class="number" value="<?php echo $row['idActivity']; ?>"><?php echo $row["nameActivityType"]; ?></td>
              <td ><?php echo $row["idMember"]; ?></td>
              <td><?php echo $row["userName"]; ?></td>
              <td><?php echo $row["nbHours"]; ?></td>
              <td><?php echo $row["utility"]; ?></td>
              <td><input type="hidden" name="instructorNeeded" id="instructorNeeded" class="number" value="<?php echo $row['instructorNeeded']; ?>"><?php echo $row["instructorNeededString"]; ?></td>
              <tr>
              <td><label>Instructeur</label></td>
              <td>
                <select type="text" name="idInstructor" id="idInstructor">
                  <option value="">Votre choix</option>
                </select>
              </tr>
              <tr>
              <td><label>Engin</label></td>
              <td>
                <select type="text" name="idAircraft" id="idAircraft">
                  <option value="">Votre choix</option>
                </select>
              </tr>
              <tr>
              <td><label>Date début</label></td>
              <td><input type="datetime-local" name="dateBegin" id="dateBegin" value="<?php echo $row['dateBegin']; ?>"></td>
              </tr>
              <tr>
              <td><label>Date fin</label></td>
              <td><input type="datetime-local" name="dateEnd" id="dateEnd" value="<?php echo $row['dateEnd']; ?>"></td>
              </tr>
              </table>
    			  </div>
          </div>
            <div class="row justify-content-center">
                <button type="button" name="buttonSubmit" id="buttonSubmit">Valider</button>
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

      window.onload = function() {

        var option = {
          url: '../api/activity/getInstructor.php',
          dataType: "text",
          type: "POST",
          success: function(data, status, xhr){
            let instructor = JSON.parse(xhr.responseText);
            let optionElement;
            for ( let i = 0; i < instructor.length; i++){
              optionElement = document.createElement("option");
              optionElement.setAttribute( "value", instructor[i]['idInstructor']);
              optionElement.innerHTML = instructor[i]['name'];
              $('#idInstructor').append(optionElement);
            }
            //  console.log();
          },
          error: function( xhr, status, error ){

          }
        };
        $.ajax(option);

        var option = {
          url: '../api/activity/getAircraft.php',
          dataType: "text",
          type: "POST",
          success: function(data, status, xhr){
            let aircraft = JSON.parse(xhr.responseText);
            let optionElement;
            for ( let i = 0; i < aircraft.length; i++){
              optionElement = document.createElement("option");
              optionElement.setAttribute( "value", aircraft[i]['idAircraft']);
              optionElement.innerHTML = aircraft[i]['name'];
              $('#idAircraft').append(optionElement);
            }
            //  console.log();
          },
          error: function( xhr, status, error ){

          }
        };
        $.ajax(option);

      };

       $(function(){

        //  Clic sur Valider du formulaire
        $(document).on('click','#buttonSubmit' ,function(event){
          event.preventDefault();

          var data1 = {
            idActivity: $('#idActivity').val(),
            idInstructor: $('#idInstructor').val(),
            idAircraft: $('#idAircraft').val(),
            dateBegin: $('#dateBegin').val(),
            dateEnd: $('#dateEnd').val(),
            instructorNeeded: $('#instructorNeeded').val()
    			};

          $.ajax({
            url: '../api/activity/editActivity.php',
            dataType: 'text',
            method: "POST",
            data : {data: JSON.stringify(data1)},
            success: function(data, status, xhr){
              console.log(data1);
              window.location.replace("activityPlan.php");
            },
           error: function(xhr, status, error){
               console.log(xhr.responseText);
               console.log(data1);

               // showError(JSON.parse(xhr.responseText));
               window.location.replace("activityEdit.php");
           }
          })
         })

        // Clic sur Annuler du formulaire
        $(document).on('click','#buttonQuit',function(){
          window.location.replace("activityPlan.php");
        })

      })

      </script>
      </form>
    </body>
    </html>
