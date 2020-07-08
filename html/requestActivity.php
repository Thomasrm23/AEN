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
            Réserver une activité
          </h1>
          <p class="link-nav"><a href="index.html">Accueil </a>
            <span class="lnr lnr-arrow-right"></span> <a href="requestActivity.html">
              Réserver une activité</a></p>
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
                    <div>

                      <select type="text" class="common-input mb-20 form-control" name="activity" id="activityList">
                        <option value="">Votre activité</option>
                      </select>
                    </div>
                    <input name="dateRequest" placeholder="Date souhaitée" id="dateRequest" class="common-input mb-20 form-control" required="" type="date">
                  </div>

                  <div class="col-lg-12">
                    <button onclick="validateRequest()" class="genric-btn primary" style="float: right;">Valider</button>
                  </div>
                  <?php
//                   // PHP program to illustrate
//                   // date_diff() function
// $dateentre = $_POST['dateRequest'];
// echo $dateentre;
//                   // creates DateTime objects
//               //    $datetime1 = date_create('2017-06-28');
//                   $datetime1 = date_create($_POST['dateRequest']);
//                   $datetime2 = date_create('2020-06-28');
//
//                   // calculates the difference between DateTime objects
//                   $interval = date_diff($datetime1, $datetime2);
//
//                   // printing result in days format
//                   echo $interval->format('%R%a days');
//
//                   $dateRequest = date_create($dateRequest);
//                   if (checkdate($dateRequest->format('m'), $dateRequest->format('d'), $dateRequest->format('Y'))){
//                       $dateMin = date_create(date("m-d-Y")); //today
//                       if($dateMin > $dateRequest){
//                           echo "errrrr";
//                       }
//                       else echo "good";
//                   }
//

                  ?>

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

      window.onload = function() {

        var option = {
          url: '../api/activity/getActivity.php',
          dataType: "text",
          type: "POST",
          data: {},
          success: function(data, status, xhr){
            let activity = JSON.parse(xhr.responseText);
            let optionElement;
            for ( let i = 0; i < activity.length; i++){
              optionElement = document.createElement("option");
              optionElement.setAttribute( "value", activity[i]['idActivity']);
              optionElement.innerHTML = activity[i]['name'];
              $('#activityList').append(optionElement);
            }
            //  console.log();
          },
          error: function( xhr, status, error ){

          }
        };
        $.ajax(option);
      };


      function validateRequest(){

        var data1 = {
          dateRequest: $('#dateRequest').val(),
          activity: $('#activityList').val()
        };



        var option = {
          url: '../api/activity/requestActivity.php',
          dataType: 'text',
          type: "POST",
          data: {data: JSON.stringify(data1)},
          success: function(data, status, xhr){
            console.log( JSON.stringify(data1));
          },
          error: function(xhr, status, error){

            if(xhr.status != 200){
              console.log( JSON.stringify(data1));

              console.log(xhr.responseText);
              /*	showError(JSON.parse(xhr.responseText));*/
            }

          }
        };

        $.ajax(option);
      }


      function showError(error){
        for(let i = 0; i < Object.keys(error).length; i++){
          switch(error[i]){
            case 'dateError':
        $('#errorDate').show();
        break;
      case 'tooYoung':
        $('#tooYoung').show();
        break;

          }
        }
      }

</script>

</body>
</html>
