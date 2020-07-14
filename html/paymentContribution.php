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

	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>


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
						<span class="lnr lnr-arrow-right"></span> <a href="paymentContribution.html">
							Paiement de la cotisation</a></p>
				</div>
			</div>
		</div>
	</section>
	<section class="contact-page-area section-gap">
		<div class="container">
			<div class="row">
				<div class="col-lg-8">



                <!-- <li value="" class="amount"></li> -->
<?php

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
echo $firstName;

//
// header("Access-Control-Allow-Origin: *");
// // header('Content-type: application/json');
//
//
// $json = NULL;
// $json = json_decode($_POST['data'], true);
// echo $json_decode['lastName'];
// echo $json['lastName'];

 ?>


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
<!--
	<script>
		isCo();
		function isCo(){

		    let option = {
		        url: '../api/session/isCo.php',
		        dataType: 'text',
		        type: "POST",
		        success: function(data, status, xhr){
		            $('#header').html(xhr.responseText);
		        },
		        error: function(xhr, status, error){;
		            $('#header').html(xhr.responseText);
		        }
		    };

		    $.ajax(option);
		}
	</script> -->

	<script type="text/javascript">
  //
  // window.onload = function() {
  //
  //   var option = {
  //     url: '../api/register/registerMember.php',
  //     dataType: "text",
  //     type: "POST",
  //     data: {},
  //     success: function(data, status, xhr){
  //       let amount = JSON.parse(xhr.responseText);
  //       let optionElement;
  //       for ( let i = 0; i < activity.length; i++){
  //         optionElement = document.createElement("option");
  //         optionElement.setAttribute( "value", amount[i]['feeContribution']);
  //         optionElement.innerHTML = amount[i]['feeContribution'];
  //         $('#amount').append(optionElement);
  //       }
  //       //  console.log();
  //     },
  //     error: function( xhr, status, error ){
  //
  //     }
  //   };
  //   $.ajax(option);
  // };


    //
    // function getContribution(){
    //
    //   var items = {
    //     birthDate: $('#birthDate').val(),
    //     memberOutside: $('#memberOutside').val(),
    //   }
    //
    //   var option = {
		// 		url: '../api/register/getContribution.php',
		// 		dataType: 'text',
		// 		type: "POST",
		// 		data: {data: JSON.stringify(items)},
		// 		success: function(data, status, xhr){
    //       console.log( JSON.stringify(items));
		// 		},
		// 		error: function(xhr, status, error){
    //
    //       if(xhr.status != 200){
    //       console.log( JSON.stringify(items));
    //
		// 				console.log(xhr.responseText);
		// 				showError(JSON.parse(xhr.responseText));
		// 			}
    //
		// 		}
		// 	};
    //
		// $.ajax(option);
		// }



	</script>

</body>
</html>