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
            <span class="lnr lnr-arrow-right"></span> <a href="activityRequest.html">
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
                    <input name="utility" placeholder="1:ecole 2:voyage" id="utility" class="common-input mb-20 form-control" required="" type="number">
                    <input name="nbHours" placeholder="nombre d'heures" id="nbHours" class="common-input mb-20 form-control" required="" type="number">
                  </div>

                  <div class="col-lg-12">
                    <button onclick="validateRequest()" class="genric-btn primary" style="float: right;">Valider</button>
                  </div>
                  <?php
                  // PHP program to illustrate
                  // date_diff() function
      //            $dateentre = $_POST['dateRequest'];
        //          echo $dateentre;
                  // creates DateTime objects

                  // $date1 = ('2017-06-28');
                  // $date2 = ('2017-06-24');
                  // $datetime1 = date_create($date1);
                  // $datetime2 = date_create($date2);
                  //
                  // $diff = date_diff($datetime1, $datetime2);
                  // echo $diff->format('%a days');

// //verification de date future et valide pour activité :

$date = ('2020-05-08');
$datetime = date_create($date);

	if(strtotime($date) > time()){
	 echo 'OK';
 }else{
	 echo 'PASOK';
}

//entre le 15 avril et le 15 octobre
echo $datetime->format('md');
$datemd = $datetime->format('md');

if(($datemd >= '0415') && ($datemd <= '1015')) {
	echo 'Ouvert tous les jours';
}
else
{
    echo 'Hors-saison ouvert samedi, dimanche et jf';
    if((check_weekend($datetime) == 1)){
	echo 'Nous sommes un jour férié, samedi ou dimanche !! OK !!';
    }else{
	echo 'Nous sommes un jour normal, PAS OK !!';
    }

}

// verifier si jour = samedi, dimanche
//6 = Samedi ou 7 = Dimanche
function check_weekend($value) {
    $dateDay = $value->format('N');
    if ($dateDay == "6" || $dateDay == "7") return 1;
    else return 0;
    }


$date22 = "2020-12-25";
echo $date22;


  $date23 = explode("-", $date22);
  //explode pour mettre la date du jour en format numerique: 31/05/2009  -> 31052009
  echo $date23[0];
  echo $date23[1];
  echo $date23[2];
  // concaténation pour inverser l'ordre: 12052006 -> 20060512
 $date24 = $date23[1]. ',' .$date23[2]. ',' .$date23[0];



// $dateMktime =  "mktime(0, 0, 0, $date22('m') , $date22('d'), $date22('Y'))";

//echo $dateMktime;
//echo $dateMktime;

 echo jour_ferie(mktime(0,0,0,$date23[1],$date23[2],$date23[0]));
     function jour_ferie($timestamp)
  {
    $jour = date("d", $timestamp);
    $mois = date("m", $timestamp);
    $annee = date("Y", $timestamp);
    $EstFerie = 0;
    // dates fériées fixes
    if($jour == 1 && $mois == 1) $EstFerie = 1; // 1er janvier
    if($jour == 1 && $mois == 5) $EstFerie = 1; // 1er mai
    if($jour == 8 && $mois == 5) $EstFerie = 1; // 8 mai
    if($jour == 14 && $mois == 7) $EstFerie = 1; // 14 juillet
    if($jour == 15 && $mois == 8) $EstFerie = 1; // 15 aout
    if($jour == 1 && $mois == 11) $EstFerie = 1; // 1 novembre
    if($jour == 11 && $mois == 11) $EstFerie = 1; // 11 novembre
    if($jour == 25 && $mois == 12) $EstFerie = 1; // 25 décembre
    // fetes religieuses mobiles
    $pak = easter_date($annee);
    $jp = date("d", $pak);
    $mp = date("m", $pak);
    if($jp == $jour && $mp == $mois){ $EstFerie = 1;} // Pâques
    $lpk = mktime(date("H", $pak), date("i", $pak), date("s", $pak), date("m", $pak)
    , date("d", $pak) +1, date("Y", $pak) );
    $jp = date("d", $lpk);
    $mp = date("m", $lpk);
    if($jp == $jour && $mp == $mois){ $EstFerie = 1; }// Lundi de Pâques
    $asc = mktime(date("H", $pak), date("i", $pak), date("s", $pak), date("m", $pak)
    , date("d", $pak) + 39, date("Y", $pak) );
    $jp = date("d", $asc);
    $mp = date("m", $asc);
    if($jp == $jour && $mp == $mois){ $EstFerie = 1;}//ascension
    $pe = mktime(date("H", $pak), date("i", $pak), date("s", $pak), date("m", $pak),
     date("d", $pak) + 49, date("Y", $pak) );
    $jp = date("d", $pe);
    $mp = date("m", $pe);
    if($jp == $jour && $mp == $mois) {$EstFerie = 1;}// Pentecôte
    $lp = mktime(date("H", $asc), date("i", $pak), date("s", $pak), date("m", $pak),
     date("d", $pak) + 50, date("Y", $pak) );
    $jp = date("d", $lp);
    $mp = date("m", $lp);
    if($jp == $jour && $mp == $mois) {$EstFerie = 1;}// lundi Pentecôte
    // Samedis et dimanches
    $jour_sem = jddayofweek(unixtojd($timestamp), 0);
    if($jour_sem == 0 || $jour_sem == 6) $EstFerie = 1;
    // ces deux lignes au dessus sont à retirer si vous ne désirez pas faire
    // apparaitre les
    // samedis et dimanches comme fériés.
    return $EstFerie;
  }






                  // $date1 =  new DateTime('07-13-2020');
                  // echo $date1;
                  // $date2 =  new DateTime('07-19-2020');
                  // echo $date2;

          //        $now = new DateTime();

                  // calculates the difference between DateTime objects
                //  $interval = date_diff($datetime1, $datetime2);

                  // printing result in days format
                //  echo $interval->format('%R%a days');

                  // $dateRequest = date_create($dateRequest);
                  // if (checkdate($dateRequest->format('m'), $dateRequest->format('d'), $dateRequest->format('Y'))){
                  //     $dateMin = date_create(date("m-d-Y")); //today
                  //     if($dateMin > $dateRequest){
                  //         echo "errrrr";
                  //     }
                  //     else echo "good";
                  // }


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
          activity: $('#activityList').val(),
          utility: $('#utility').val(),
          nbHours: $('#nbHours').val()
        };



        var option = {
          url: '../api/activity/activityRequest.php',
          dataType: 'text',
          type: "POST",
          data: {data: JSON.stringify(data1)},
          success: function(data, status, xhr){
            //console.log( JSON.stringify(data1));
          },
          error: function(xhr, status, error){

            if(xhr.status != 200){
          //    console.log( JSON.stringify(data1));

          //    console.log(xhr.responseText);
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
        $('#dateError').show();
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
