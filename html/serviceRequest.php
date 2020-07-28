tariffType<?php
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
                    <p id="serviceDateP" style="display:flex; margin-bottom:1rem;">Date et heure de passage :</p>
                    <input name="serviceDate" id="serviceDate" style="margin-bottom:1rem;" class="common-input mb-20 form-control" type="datetime-local">
                    <div>
                    <p style="display:flex; margin-bottom:0;">Votre avion est-il basé à cet aérodrome ?</p>
                    <div class="common-input mb-20 form-control" style="display:flex; border: 0px;">
                      <input name="basedChoice" id="basedChoice"  type="radio" value="1" onclick="showBased()"><label style="display:flex; align-items:flex-end; padding-left:5px; padding-right:50px;" for="basedChoice">Oui</label><br>
                      <input name="basedChoice" id="notBasedChoice" type="radio" value="2" onclick="showNotBased()"><label style="display:flex; align-items:flex-end; padding-left:5px;" for="notBasedChoice">Non</label><br>
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

                      <select type="text" class="common-input mb-20 form-control" name="acousticGroup" id="acousticGroup">
                        <option>Groupe acoustique de l'avion</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5a">5a</option>
                        <option value="5b">5b</option>
                      </select>
                      <!-- modifff -->
                      <p id="dayweekP1" style="display:flex; margin-bottom:0;">Tarif :</p>
                      <div id="dayweekDiv1" class="common-input mb-20 form-control" style="display:flex; border: 0px;">
                        <input name="dayweekWS" id="dayweekW"  type="radio" value="W"><label style="display:flex; align-items:flex-end; padding-left:5px; padding-right:50px;" for="dayweekW">Week-end</label><br>
                        <input name="dayweekWS" id="dayweekS" type="radio" value="S"><label style="display:flex; align-items:flex-end; padding-left:5px;" for="dayweekS">Semaine</label><br>
                      </div>


                      <p id="dayweekP2" style="display:flex; margin-bottom:0;">Tarif :</p>
                      <div id="dayweekDiv2" class="common-input mb-20 form-control" style="display:flex; border: 0px;">
                        <input name="dayweekMU" id="dayweekM"  type="radio" value="M" ><label style="display:flex; align-items:flex-end; padding-left:5px; padding-right:50px;" for="dayweekM">Mensuel</label><br>
                        <input name="dayweekMU" id="dayweekU" type="radio" value="U"><label style="display:flex; align-items:flex-end; padding-left:5px;" for="dayweekU">Unité</label><br>
                      </div>


                      <input name="markupDuration" placeholder="Durée de marquage (unité de 30 minutes)" id="markupDuration" class="common-input mb-20 form-control" type="text">

                      <div class="common-input mb-20 form-control" style="display:flex;">
                        <input name="provisioning" placeholder="" id="provisioning" type="checkbox"
                        value="0" onclick="showProvisioning()"><label style="display:flex; align-items:flex-end; padding-left:10px;" for="provisioning"><?php echo $serviceList[1]['name']?></label>
                      </div>
                      <!-- <input name="petroleList" placeholder="Type de produit pétrolier" id="petroleList" class="common-input mb-20 form-control" type="text"> -->

                      <select type="text" class="common-input mb-20 form-control" name="petroleList" id="petroleList">
                        <option value="">Votre produit pétrolier</option>
                      </select>
                      <input name="quantity" placeholder="Quantité de carburant (en litres)" id="quantity" class="common-input mb-20 form-control" type="number">


                      <div class="common-input mb-20 form-control" style="display:flex;">
                      <input name="parking" placeholder="" id="parking" type="checkbox"
                        value="0" onclick="showParking()"><label style="display:flex; align-items:flex-end; padding-left:10px;" for="parking"><?php echo $serviceList[2]['name']?></label>
                      </div>

                      <p id="parkingTypeP" style="display:flex; margin-bottom:0;">Type de parking :</p>
                      <div id="parkingType" class="common-input mb-20 form-control" style="display:flex; border: 0px;">
                        <input name="parkingTypeChoice" id="covered"  type="radio" value="COV" onclick="showCovered()"><label style="display:flex; align-items:flex-end; padding-left:5px; padding-right:50px;" for="covered">Sous abris</label><br>
                        <input name="parkingTypeChoice" id="outside" type="radio" value="OUT" onclick="showOutside()"><label style="display:flex; align-items:flex-end; padding-left:5px;" for="outside">Extérieur</label><br>
                      </div>

                      <p id="tariffTypeP" style="display:flex; margin-bottom:0;">Tarif :</p>
                      <div id="tariffType" class="common-input mb-20 form-control" style="display:flex; border: 0px;">
                        <input name="tariffTypeChoice" id="mensuel"  type="radio" value="M" ><label style="display:flex; align-items:flex-end; padding-left:5px; padding-right:50px;" for="mensuel">Mensuel</label><br>
                        <input name="tariffTypeChoice" id="journalier" type="radio" value="J"><label style="display:flex; align-items:flex-end; padding-left:5px;" for="journalier">Journalier</label><br>
                      </div>

                      <input name="groundArea" placeholder="Surface" id="groundArea" class="common-input mb-20 form-control" type="number">

                      <input name="mass" placeholder="Masse (en kgs)" id="mass" class="common-input mb-20 form-control" type="number">

                      <p id="beginDateP" style="display:flex; margin-bottom:1rem;">Date du début de stationnement :</p>
                      <input name="beginDate" id="beginDate" style="margin-bottom:1rem;" class="common-input mb-20 form-control" type="date">


                      <p id="endDateP" style="display:flex; margin-bottom:1rem;">Date de la fin du stationnement :</p>
                      <input name="endDate" id="endDate" style="margin-bottom:1rem;" class="common-input mb-20 form-control" type="date">
                      <!-- <input name="tariffType" placeholder="Type de parking choisi" id="tariffType" class="common-input mb-20 form-control" type="text"> -->
                      <!-- <input name="parking2" placeholder="champ 2" id="parking2" class="common-input mb-20 form-control" type="text"> -->

                      <div class="common-input mb-20 form-control" style="display:flex;">
                      <input name="cleaning" placeholder="" id="cleaning" type="checkbox"
                        value="0" onclick="showCleaning()"><label style="display:flex; align-items:flex-end; padding-left:10px;" for="cleaning"><?php echo $serviceList[3]['name']?></label>
                      </div>

                      <div class="common-input mb-20 form-control" style="display:flex;">
                      <input name="weather" placeholder="" id="weather" type="checkbox"
                        value="0" onclick="showWeather()"><label style="display:flex; align-items:flex-end; padding-left:10px;" for="weather"><?php echo $serviceList[4]['name']?></label>
                      </div>


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


      document.getElementById("planeType").style.display = "none";
      document.getElementById("planeTypeP").style.display = "none";
      document.getElementById("acousticGroup").style.display = "none";
      document.getElementById("dayweekP1").style.display = "none";
      document.getElementById("dayweekDiv1").style.display = "none";
      document.getElementById("dayweekP2").style.display = "none";
      document.getElementById("dayweekDiv2").style.display = "none";
      document.getElementById("markupDuration").style.display = "none";

      document.getElementById("petroleList").style.display = "none";
      document.getElementById("quantity").style.display = "none";

      document.getElementById("parkingType").style.display = "none";
      document.getElementById("parkingTypeP").style.display = "none";
      document.getElementById("tariffType").style.display = "none";
      document.getElementById("tariffTypeP").style.display = "none";
      document.getElementById("groundArea").style.display = "none";
      document.getElementById("mass").style.display = "none";
      document.getElementById("endDateP").style.display = "none";
      document.getElementById("endDate").style.display = "none";
      document.getElementById("beginDate").style.display = "none";
      document.getElementById("beginDateP").style.display = "none";


      function showBased(){
        if ((document.getElementById('basedChoice').checked) && (document.getElementById('parking').checked) && (document.getElementById('covered').checked)) {
          document.getElementById("tariffType").style.display = "flex";
          document.getElementById("tariffTypeP").style.display = "flex";
        }
        if ((document.getElementById('basedChoice').checked) && (document.getElementById('landing').checked)) {
        document.getElementById("dayweekP2").style.display = "flex";
        document.getElementById("dayweekDiv2").style.display = "flex";
        document.getElementById("dayweekP1").style.display = "none";
        document.getElementById("dayweekDiv1").style.display = "none";
        document.getElementById("dayweekW").checked=false;
        document.getElementById("dayweekS").checked=false;
        }
      }
      function showNotBased(){
        if (document.getElementById('notBasedChoice').checked) {
          document.getElementById("tariffType").style.display = "none";
          document.getElementById("tariffTypeP").style.display = "none";
          document.getElementById("mensuel").checked=false;
          document.getElementById("journalier").checked=false;
          document.getElementById("dayweekP2").style.display = "none";
          document.getElementById("dayweekDiv2").style.display = "none";
          document.getElementById("dayweekU").checked=false;
          document.getElementById("dayweekM").checked=false;

        if ((document.getElementById('notBasedChoice').checked) && (document.getElementById('landing').checked)) {
          document.getElementById("dayweekP1").style.display = "flex";
          document.getElementById("dayweekDiv1").style.display = "flex";
        }
        }
      }

      function showCovered(){
        if (document.getElementById('covered').checked){
          document.getElementById("mass").style.display = "block";
        }
        if ((document.getElementById('covered').checked) && (document.getElementById('basedChoice').checked)){
          document.getElementById("tariffType").style.display = "flex";
          document.getElementById("tariffTypeP").style.display = "flex";
        }
      }

      function showOutside(){
        if (document.getElementById('outside').checked){
        document.getElementById("mass").style.display = "none";
        document.getElementById("tariffType").style.display = "none";
        document.getElementById("tariffTypeP").style.display = "none";
        document.getElementById("mensuel").checked=false;
        document.getElementById("journalier").checked=false;

        }
      }

      function showLanding(){
        if ((document.getElementById('basedChoice').checked) && (document.getElementById('landing').checked)) {
          document.getElementById("dayweekP2").style.display = "flex";
          document.getElementById("dayweekDiv2").style.display = "flex";
        }

        if ((document.getElementById('notBasedChoice').checked) && (document.getElementById('landing').checked)) {
          document.getElementById("dayweekP1").style.display = "flex";
          document.getElementById("dayweekDiv1").style.display = "flex";
        }

        if (document.getElementById('landing').checked){
          document.getElementById("landing").value=1;
          document.getElementById("planeType").style.display = "flex";
          document.getElementById("planeTypeP").style.display = "flex";
          document.getElementById("acousticGroup").style.display = "flex";
          document.getElementById("markupDuration").style.display = "block";


        } else {
          document.getElementById("landing").value=0;
          document.getElementById("turbine").checked=false;
          document.getElementById("reacteur").checked=false;
          document.getElementById("markupDuration").value="";
          document.getElementById("planeType").style.display = "none";
          document.getElementById("planeTypeP").style.display = "none";
          document.getElementById("acousticGroup").style.display = "none";
          document.getElementById("markupDuration").style.display = "none";
          document.getElementById("dayweekP1").style.display = "none";
          document.getElementById("dayweekDiv1").style.display = "none";
          document.getElementById("dayweekP2").style.display = "none";
          document.getElementById("dayweekDiv2").style.display = "none";


        }
      }

      function showProvisioning(){
        if (document.getElementById('provisioning').checked){
          document.getElementById("provisioning").value=1;
          document.getElementById("petroleList").style.display = "block";
          document.getElementById("quantity").style.display = "block";

        } else {
          document.getElementById("provisioning").value=0;
          document.getElementById("petroleList").value="";
          document.getElementById("quantity").value = "";
          document.getElementById("petroleList").style.display = "none";
          document.getElementById("quantity").style.display = "none";
        }
      }

      function showParking(){
        if ((document.getElementById('basedChoice').checked) && (document.getElementById('parking').checked) && (document.getElementById('covered').checked)) {
          document.getElementById("tariffType").style.display = "flex";
          document.getElementById("tariffTypeP").style.display = "flex";
        }
        if (document.getElementById('parking').checked){
          document.getElementById("parking").value=1;
          document.getElementById("parkingType").style.display = "flex";
          document.getElementById("parkingTypeP").style.display = "flex";
          document.getElementById("groundArea").style.display = "flex";
          document.getElementById("beginDate").style.display = "flex";
          document.getElementById("beginDateP").style.display = "flex";
          document.getElementById("endDate").style.display = "flex";
          document.getElementById("endDateP").style.display = "flex";
        } else {
          document.getElementById("parking").value=0;
          document.getElementById("covered").checked=false;
          document.getElementById("outside").checked=false;
          document.getElementById("journalier").checked=false;
          document.getElementById("mensuel").checked=false;
          document.getElementById("groundArea").value = "";
          document.getElementById("mass").value = "";
          document.getElementById("beginDate").value="";
          document.getElementById("endDate").value="";

          document.getElementById("parkingType").style.display = "none";
          document.getElementById("parkingTypeP").style.display = "none";
          document.getElementById("tariffType").style.display = "none";
          document.getElementById("tariffTypeP").style.display = "none";
          document.getElementById("groundArea").style.display = "none";
          document.getElementById("mass").style.display = "none";
          document.getElementById("beginDate").style.display = "none";
          document.getElementById("beginDateP").style.display = "none";
          document.getElementById("endDate").style.display = "none";
          document.getElementById("endDateP").style.display = "none";
        }
      }

      function showCleaning(){
        if (document.getElementById('cleaning').checked){
          document.getElementById("cleaning").value=1;
        } else {
          document.getElementById("cleaning").value=0;
        }
      }

      function showWeather(){
        if (document.getElementById('weather').checked){
          document.getElementById("weather").value=1;
        } else {
          document.getElementById("weather").value=0;
        }
      }



      function getBasedChoice(){

        var getBasedChoice;

        if (document.getElementById('basedChoice').checked) {
          getBasedChoice = document.getElementById('basedChoice').value;
        }
        if (document.getElementById('notBasedChoice').checked) {
          getBasedChoice = document.getElementById('notBasedChoice').value;
        }
         return getBasedChoice;
      }

      function getPlaneType(){

        var getPlaneType;
        if (document.getElementById('turbine').checked) {
          getPlaneType = document.getElementById('turbine').value;
        }
        if (document.getElementById('reacteur').checked) {
          getPlaneType = document.getElementById('reacteur').value;
        }
         return getPlaneType;
      }

      function getTariffType(){

        var getTariffType;
        if (document.getElementById('mensuel').checked) {
          getTariffType = document.getElementById('mensuel').value;
        }
        else if (document.getElementById('journalier').checked) {
          getTariffType = document.getElementById('journalier').value;
        }
        // else if (document.getElementById('covered').checked){
        //   getTariffType = "J";
        // }
        else {
          getTariffType = "S";
        }

        return getTariffType;
      }

      function getParkingType(){

        var getParkingType;
        if (document.getElementById('covered').checked) {
          getParkingType = document.getElementById('covered').value;
        }
        if (document.getElementById('outside').checked) {
          getParkingType = document.getElementById('outside').value;
        }
        return getParkingType;
      }


      function getDayweek(){

        var getDayweek;
        if (document.getElementById('dayweekW').checked) {
          getDayweek = document.getElementById('dayweekW').value;
        }
        if (document.getElementById('dayweekS').checked) {
          getDayweek = document.getElementById('dayweekS').value;
        }
        if (document.getElementById('dayweekU').checked) {
          getDayweek = document.getElementById('dayweekU').value;
        }
        if (document.getElementById('dayweekM').checked) {
          getDayweek = document.getElementById('dayweekM').value;
        }
         return getDayweek;
      }

</script>
<script>
window.onload = function() {

            var option = {
              url: '../api/service/getPetroleProduct.php',
                dataType: "text",
                type: "POST",
                data: {},
                success: function(data, status, xhr){
                    let petrole = JSON.parse(xhr.responseText);
                    let optionElement;
                    for ( let i = 0; i < petrole.length; i++){
                        optionElement = document.createElement("option");
                        optionElement.setAttribute( "value", petrole[i]['idPetroleProduct']);
                        optionElement.innerHTML = petrole[i]['name'];
                        $('#petroleList').append(optionElement);

                    }
                },
                error: function( xhr, status, error ){

                }
            };
            $.ajax(option);
        };



$(function(){

  // Ecoute de la soumission du formulaire
  $(document).on('click','#submit' ,function(event){
    event.preventDefault();

    alert('test de click du bouton commander');

    getBasedChoice = getBasedChoice();
    getPlaneType = getPlaneType();

    getParkingType = getParkingType();
    getTariffType = getTariffType();

    getDayweek = getDayweek();

    var data1 = {
      serviceDate: $('#serviceDate').val(),
      basedChoice: getBasedChoice,

      landing: $('#landing').val(),
      planeTypeChoice: getPlaneType,
      acousticGroup: $('#acousticGroup').val(),
      dayweek: getDayweek,
      markupDuration: $('#markupDuration').val(),

      provisioning: $('#provisioning').val(),
      petrole: $('#petroleList').val(),
      quantity: $('#quantity').val(),

      parking: $('#parking').val(),
      parkingType: getParkingType,
      tariffType: getTariffType,
      groundArea: $('#groundArea').val(),
      mass: $('#mass').val(),
      beginDate: $('#beginDate').val(),
      endDate: $('#endDate').val(),

      cleaning: $('#cleaning').val(),
      weather: $('#weather').val()
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
         console.log(data);
         console.log(data1);

        console.log( JSON.stringify(data1));
      },
     error: function(xhr, status, error){
        // console.log(JSON.parse(data1));
     // console.log(data);
     //  if(xhr.status != 200){
       //  if(xhr.status == 402){
       console.log( JSON.stringify(data1));

         // console.log(xhr.responseText);
         showError(JSON.parse(xhr.responseText));
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
            case 'ErreurInsertLineRequestLanding':
              $('#ErreurInsertLineRequestLanding').show();
              break;
            case 'planeTypeNotSet':
              $('#planeTypeNotSet').show();
              break;
            case 'ErreurInsertLanding':
              $('#ErreurInsertLanding').show();
              break;
            case 'ErreurInsertLineRequestProvisioning':
              $('#ErreurInsertLineRequestProvisioning').show();
              break;
            case 'ErreurInsertProvisioning':
              $('#ErreurInsertProvisioning').show();
              break;
            case 'ErreurInsertLineRequestParking':
              $('#ErreurInsertLineRequestParking').show();
              break;
            case 'ErreurInsertParking':
              $('#ErreurInsertParking').show();
              break;
          }
        }
      }

</script>

</body>
</html>
