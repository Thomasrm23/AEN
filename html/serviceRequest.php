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
 // var_dump($serviceList);

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
                    <div style="">
                    <p id="serviceDateP" style="display:flex; margin-bottom:1rem;">Date et heure de passage :</p>
                    <input name="serviceDate" id="serviceDate" style="margin-bottom:1rem;" class="common-input mb-20 form-control" type="datetime-local">
                    <div>
                    <p id="basedP" style="display:flex; margin-bottom:0;">Votre avion est-il basé à cet aérodrome ?</p>
                    <div id="based" class="common-input mb-20 form-control" style="display:flex; border: 0px;">
                      <input name="basedChoice" class="basedChoice" id="basedChoice"  type="radio" value="1"><label style="display:flex; align-items:flex-end; padding-left:5px; padding-right:50px;" for="basedChoice">Oui</label><br>
                      <input name="basedChoice" class="basedChoice" id="notBasedChoice" type="radio" value="2"><label style="display:flex; align-items:flex-end; padding-left:5px;" for="notBasedChoice">Non</label><br>
                    </div>

                    <div class="common-input mb-20 form-control" style="display:flex;">
                      <input name="landing" placeholder="" id="landing" type="checkbox"
                        value="0" onclick="showLanding()"><label style="display:flex; align-items:flex-end; padding-left:10px;" for="landing"><?php echo $serviceList[0]['name']?></label>
                    </div>

                      <!-- <input name="planeType" placeholder="Type d'avion" id="planeType" class="common-input mb-20 form-control" type="text"> -->

                      <p id="planeTypeP" style="display:flex; margin-bottom:0;">Type d'avion :</p>
                      <div id="planeType" class="common-input mb-20 form-control" style="display:flex; border: 0px;">
                        <input name="planeTypeChoice" id="turbine"  type="radio" class="planeTypeChoice" value="1" ><label style="display:flex; align-items:flex-end; padding-left:5px; padding-right:50px;" for="turbine">Turbine</label><br>
                        <input name="planeTypeChoice" id="reacteur" type="radio" class="planeTypeChoice" value="2"><label style="display:flex; align-items:flex-end; padding-left:5px;" for="reacteur">Réacteur</label><br>
                      </div>

                      <input name="markupDuration" placeholder="Durée de marquage (unité de 30 minutes)" id="markupDuration" class="common-input mb-20 form-control" type="text">

                      <div class="common-input mb-20 form-control" style="display:flex;">
                      <input name="provisioning" placeholder="" id="provisioning" type="checkbox"
                        value="0" onclick="showProvisioning()"><label style="display:flex; align-items:flex-end; padding-left:10px;" for="provisioning"><?php echo $serviceList[1]['name']?></label>
                    </div>
                      <input name="provisioning1" placeholder="champ 1" id="provisioning1" class="common-input mb-20 form-control" type="text">
                      <input name="provisioning2" placeholder="champ 2" id="provisioning2" class="common-input mb-20 form-control" type="text">

                      <div class="common-input mb-20 form-control" style="display:flex;">
                      <input name="parking" placeholder="" id="parking" type="checkbox"
                        value="0" onclick="showParking()"><label style="display:flex; align-items:flex-end; padding-left:10px;" for="parking"><?php echo $serviceList[2]['name']?></label>
                    </div>
                      <input name="parking1" placeholder="champ 1" id="parking1" class="common-input mb-20 form-control" type="text">
                      <input name="parking2" placeholder="champ 2" id="parking2" class="common-input mb-20 form-control" type="text">

                      <div class="common-input mb-20 form-control" style="display:flex;">
                      <input name="cleaning" placeholder="" id="cleaning" type="checkbox"
                        value="0" onclick="showCleaning()"><label style="display:flex; align-items:flex-end; padding-left:10px;" for="cleaning"><?php echo $serviceList[3]['name']?></label>
                    </div>
                      <input name="cleaning1" placeholder="champ 1" id="cleaning1" class="common-input mb-20 form-control" type="text">
                      <input name="cleaning2" placeholder="champ 2" id="cleaning2" class="common-input mb-20 form-control" type="text">

                      <div class="common-input mb-20 form-control" style="display:flex;">
                      <input name="weather" placeholder="" id="weather" type="checkbox"
                        value="0" onclick="showWeather()"><label style="display:flex; align-items:flex-end; padding-left:10px;" for="weather"><?php echo $serviceList[4]['name']?></label>
                    </div>
                      <input name="weather1" placeholder="champ 1" id="weather1" class="common-input mb-20 form-control" type="text">
                      <input name="weather2" placeholder="champ 2" id="weather2" class="common-input mb-20 form-control" type="text">


          <!--          <select type="text" class="common-input mb-20 form-control" name="utility" id="utility">
                      <option>Utilisation de l'avion</option>
                      <option value="ECOLE">ECOLE</option>
                      <option value="VOYAGE">VOYAGE</option>
                    </select> -->

                  </div>

                  <div class="col-lg-12">
                    <!-- <button onclick="validateRequest()" class="genric-btn primary" style="float: right;">Valider</button> -->
                    <button class="genric-btn primary" id="submit" style="float: right;">Valider la commande</button>
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

      <script src="../js/isCo.js"></script>


      <script type="text/javascript">





      // let basedChoice;
      //
      //
      // if (document.getElementById('basedChoice').checked) {
      //   console.log("check 1");
      //   basedChoice = document.getElementById('basedChoice').value;
      // }
      // if (document.getElementById('notBasedChoice').checked) {
      //   console.log("check 2");
      //
      //   basedChoice = document.getElementById('notBasedChoice').value;
      // }
      // console.log(basedChoice);



      document.getElementById("planeType").style.display = "none";
      document.getElementById("planeTypeP").style.display = "none";
      // document.getElementById("based").style.display = "none";
      // document.getElementById("basedP").style.display = "none";
      document.getElementById("markupDuration").style.display = "none";

      document.getElementById("provisioning1").style.display = "none";
      document.getElementById("provisioning2").style.display = "none";

      document.getElementById("parking1").style.display = "none";
      document.getElementById("parking2").style.display = "none";

      document.getElementById("cleaning1").style.display = "none";
      document.getElementById("cleaning2").style.display = "none";

      document.getElementById("weather1").style.display = "none";
      document.getElementById("weather2").style.display = "none";

      function getBasedChoice(){

        var basedChoice;

        if (document.getElementById('basedChoice').checked) {
          basedChoice = document.getElementById('basedChoice').value;
        }
        if (document.getElementById('notBasedChoice').checked) {
          basedChoice = document.getElementById('notBasedChoice').value;
        }
         return basedChoice;
        // console.log("based :");
        // console.log(basedChoice);
      }
      function getPlaneType(){

        var planetype;
        if (document.getElementById('turbine').checked) {
          planetype = document.getElementById('turbine').value;
        }
        if (document.getElementById('reacteur').checked) {
          planetype = document.getElementById('reacteur').value;
        }
         return planetype;
        // console.log("planetype :");
        // console.log(planetype);
      }

      function showLanding(){
        if (document.getElementById('landing').checked){
          document.getElementById("landing").value=1;
          document.getElementById("planeType").style.display = "flex";
          document.getElementById("planeTypeP").style.display = "flex";
          document.getElementById("markupDuration").style.display = "block";
          //
          // var selectedOption = $("input:radio[name=planeType]:checked").val();
          // console.log(selectedOption);

        } else {
          document.getElementById("landing").value=0;
          document.getElementById("turbine").checked=false;
          document.getElementById("reacteur").checked=false;
          document.getElementById("markupDuration").value="";
          document.getElementById("planeType").style.display = "none";
          document.getElementById("planeTypeP").style.display = "none";
          document.getElementById("markupDuration").style.display = "none";
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
// better function

$(function(){

  // Ecoute de la soumission du formulaire
  $(document).on('click','#submit' ,function(event){
    event.preventDefault();

    alert('test de click du bouton commander');

    planeType = getPlaneType();
    basedChoice = getBasedChoice();

    var data1 = {
      serviceDate: $('#serviceDate').val(),
      landing: $('#landing').val(),
      planeTypeChoice: planeType,
      basedChoice: basedChoice,
      markupDuration: $('#markupDuration').val()
    };


    $.ajax({
      url: '../api/service/addServiceRequest.php',
      dataType: 'text',
      method: "POST",
      data : {data: JSON.stringify(data1)},
      // data : {
      //   nbHours : nbHours
      // },
      success: function(data, status, xhr){
        // console.log(data);
        // console.log(data1);

      //  console.log( JSON.stringify(data1));
      },
     error: function(xhr, status, error){
        // console.log(JSON.parse(data1));
     console.log(data);
     //  if(xhr.status != 200){
       //  if(xhr.status == 402){
         console.log(xhr.responseText);
    //     showError(JSON.parse(xhr.responseText));
     //			}
     }
    })
  })
})


      function showError(error){
        for(let i = 0; i < Object.keys(error).length; i++){
          switch(error[i]){
            case 'datePassed':
              $('#datePassed').show();
              break;
            case 'dateInvalid':
              $('#dateInvalid').show();
              break;
            case 'basedNotSet':
              $('#basedNotSet').show();
              break;
            case 'ErreurInsertServiceRequest':
              $('#ErreurInsertServiceRequest').show();
              break;
            case 'ErreurInsertLineRequest':
              $('#ErreurInsertLineRequest').show();
              break;
            case 'planeTypeNotSet':
              $('#planeTypeNotSet').show();
              break;
            case 'ErreurInsertLanding':
              $('#ErreurInsertLanding').show();
              break;

          }
        }
      }

</script>

</body>
</html>
