<?php
require_once __DIR__ . '/../api/DataBaseManager.php';
require_once __DIR__ . '/../api/manager/ServiceManager.php';

$manager = new DataBaseManager();
$serviceManager = new ServiceManager($manager);

if(isset($_SESSION['idCustomer'])){
    $idCustomer = $_SESSION['idCustomer'];

}

$serviceList = $serviceManager->getService();
// echo $serviceList[0]['name'];
// echo $serviceList[1]['name'];
// echo $serviceList[2]['name'];
// echo $serviceList[3]['name'];
// echo $serviceList[4]['name'];
 var_dump($serviceList);

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
            Commander un service
          </h1>
          <p class="link-nav"><a href="index.html">Accueil </a>
            <span class="lnr lnr-arrow-right"></span> <a href="serviceRequest.html">
              Commander un service</a></p>
            </div>
          </div>
        </div>
      </section>
      <section class="contact-page-area section-gap">
        <div class="container">
          <div class="row">
            <div class="col-lg-8">
              <form class="form-area contact-form text-right" id="myForm" >
                <div class="row">
                  <div class="col-lg-6 form-group">

                    <div class="common-input mb-20 form-control" style="display:flex;">
                      <input name="landing" placeholder="" id="landing" type="checkbox"
                        value="0" onclick="showLanding()"><label style="display:flex; align-items:flex-end; padding-left:10px;" for="landing"><?php echo $serviceList[0]['name']?></label>
                    </div>
                      <input name="landing1" placeholder="champ 1" id="landing1" class="common-input mb-20 form-control" type="text">
                      <input name="landing2" placeholder="champ 2" id="landing2" class="common-input mb-20 form-control" type="text">

                      <div class="common-input mb-20 form-control" style="display:flex;">
                      <input name="provisioning" placeholder="" id="provisioning" type="checkbox"
                        value="0" onclick="showProvisioning()"><label for="provisioning"><?php echo $serviceList[1]['name']?></label>
                    </div>
                      <input name="provisioning1" placeholder="champ 1" id="provisioning1" class="common-input mb-20 form-control" type="text">
                      <input name="provisioning2" placeholder="champ 2" id="provisioning2" class="common-input mb-20 form-control" type="text">

                      <div class="common-input mb-20 form-control" style="display:flex;">
                      <input name="parking" placeholder="" id="parking" type="checkbox"
                        value="0" onclick="showParking()"><label for="parking"><?php echo $serviceList[2]['name']?></label>
                    </div>
                      <input name="parking1" placeholder="champ 1" id="parking1" class="common-input mb-20 form-control" type="text">
                      <input name="parking2" placeholder="champ 2" id="parking2" class="common-input mb-20 form-control" type="text">

                      <div class="common-input mb-20 form-control" style="display:flex;">
                      <input name="cleaning" placeholder="" id="cleaning" type="checkbox"
                        value="0" onclick="showCleaning()"><label for="cleaning"><?php echo $serviceList[3]['name']?></label>
                    </div>
                      <input name="cleaning1" placeholder="champ 1" id="cleaning1" class="common-input mb-20 form-control" type="text">
                      <input name="cleaning2" placeholder="champ 2" id="cleaning2" class="common-input mb-20 form-control" type="text">

                      <div class="common-input mb-20 form-control" style="display:flex;">
                      <input name="weather" placeholder="" id="weather" type="checkbox"
                        value="0" onclick="showWeather()"><label for="weather"><?php echo $serviceList[4]['name']?></label>
                    </div>
                      <input name="weather1" placeholder="champ 1" id="weather1" class="common-input mb-20 form-control" type="text">
                      <input name="weather2" placeholder="champ 2" id="weather2" class="common-input mb-20 form-control" type="text">


          <!--          <select type="text" class="common-input mb-20 form-control" name="utility" id="utility">
                      <option>Utilisation de l'avion</option>
                      <option value="ECOLE">ECOLE</option>
                      <option value="VOYAGE">VOYAGE</option>
                    </select> -->

                    <!-- <input name="utility" placeholder="1:ecole 2:voyage" id="utility" class="common-input mb-20 form-control" required="" type="number"> -->
                    <!-- <input name="nbHours" placeholder="nombre d'heures" id="nbHours" class="common-input mb-20 form-control" type="number"> -->
                  </div>

                  <div class="col-lg-12">
                    <!-- <button onclick="validateRequest()" class="genric-btn primary" style="float: right;">Valider</button> -->
                    <button class="genric-btn primary" id="submit" style="float: right;">Valider la demande</button>

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



      document.getElementById("landing1").style.display = "none";
      document.getElementById("landing2").style.display = "none";

      document.getElementById("provisioning1").style.display = "none";
      document.getElementById("provisioning2").style.display = "none";

      document.getElementById("parking1").style.display = "none";
      document.getElementById("parking2").style.display = "none";

      document.getElementById("cleaning1").style.display = "none";
      document.getElementById("cleaning2").style.display = "none";

      document.getElementById("weather1").style.display = "none";
      document.getElementById("weather2").style.display = "none";

      function showLanding(){
        if (document.getElementById('landing').checked){
          document.getElementById("landing").value=1;
          document.getElementById("landing1").style.display = "block";
          document.getElementById("landing2").style.display = "block";
        } else {
          document.getElementById("landing").value=0;
          document.getElementById("landing1").style.display = "none";
          document.getElementById("landing2").style.display = "none";
        }
      }

      function showProvisioning(){
        if (document.getElementById('provisioning').checked){
          document.getElementById("provisioning").value=1;
          document.getElementById("provisioning1").style.display = "block";
          document.getElementById("provisioning2").style.display = "block";
        } else {
          document.getElementById("provisioning").value=0;
          document.getElementById("provisioning1").style.display = "none";
          document.getElementById("provisioning2").style.display = "none";
        }
      }

      function showParking(){
        if (document.getElementById('parking').checked){
          document.getElementById("parking").value=1;
          document.getElementById("parking1").style.display = "block";
          document.getElementById("parking2").style.display = "block";
        } else {
          document.getElementById("parking").value=0;
          document.getElementById("parking1").style.display = "none";
          document.getElementById("parking2").style.display = "none";
        }
      }

      function showCleaning(){
        if (document.getElementById('cleaning').checked){
          document.getElementById("cleaning").value=1;
          document.getElementById("cleaning1").style.display = "block";
          document.getElementById("cleaning2").style.display = "block";
        } else {
          document.getElementById("cleaning").value=0;
          document.getElementById("cleaning1").style.display = "none";
          document.getElementById("cleaning2").style.display = "none";
        }
      }

      function showWeather(){
        if (document.getElementById('weather').checked){
          document.getElementById("weather").value=1;
          document.getElementById("weather1").style.display = "block";
          document.getElementById("weather2").style.display = "block";
        } else {
          document.getElementById("weather").value=0;
          document.getElementById("weather1").style.display = "none";
          document.getElementById("weather2").style.display = "none";
        }
      }

</script>
<script>
//       window.onload = function() {
//
//         var option = {
//           url: '../api/activity/getActivityType.php',
//           dataType: "text",
//           type: "POST",
//           success: function(data, status, xhr){
//             let activity = JSON.parse(xhr.responseText);
//             let optionElement;
//             for ( let i = 0; i < activity.length; i++){
//               optionElement = document.createElement("option");
//               optionElement.setAttribute( "value", activity[i]['idActivityType']);
//               optionElement.innerHTML = activity[i]['name'];
//               $('#activityList').append(optionElement);
//             }
//             //  console.log();
//           },
//           error: function( xhr, status, error ){
//
//           }
//         };
//         $.ajax(option);
//       };
// // better function
//
// $(function(){
//
//   // Ecoute de la soumission du formulaire
//   $(document).on('click','#submit' ,function(event){
//     event.preventDefault();
//
//     alert('test de click du bouton activity');
//
//   //  var nbHours = $('#nbHours').val();
//
//     var data1 = {
//       activity: $('#activityList').val(),
//       utility: $('#utility').val(),
//       nbHours: $('#nbHours').val()
//     };
//
//
//     $.ajax({
//       url: '../api/activity/activity.php',
//       dataType: 'text',
//       method: "POST",
//       data : {data: JSON.stringify(data1)},
//       // data : {
//       //   nbHours : nbHours
//       // },
//       success: function(data, status, xhr){
//         console.log(data);
//
//         console.log( JSON.stringify(data1));
//       },
//      error: function(xhr, status, error){
//        console.log(JSON.parse(data));
//      //      ;
//      //  if(xhr.status != 200){
//        //  if(xhr.status == 402){
//          console.log(xhr.responseText);
//     //     showError(JSON.parse(xhr.responseText));
//      //			}
//      }
//     })
//   })
// })

      //
      // function showError(error){
      //   for(let i = 0; i < Object.keys(error).length; i++){
      //     switch(error[i]){
      //       case 'dateError':
      //   $('#dateError').show();
      //   break;
      // case 'tooYoung':
      //   $('#tooYoung').show();
      //   break;
      //
      //     }
      //   }
      // }

</script>

</body>
</html>
