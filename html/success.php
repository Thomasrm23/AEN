<?php
  if(!empty($_GET['id']) && !empty($_GET['cardHolder'])) {
    $GET = filter_var_array($_GET, FILTER_SANITIZE_STRING);

    $id = $GET['id'];
    $cardHolder = $GET['cardHolder'];

  } else {
    header('Location: paymentContribution.php');
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <title>Merci</title>
</head>
<body>
  <div class="container mt-4">
    <h2>Merci <?php echo $cardHolder; ?></h2><br>
    <h4>Votre paiement a bien été effectué.</h4><br>
    <h5>Vous êtes maintenant membre de l'aéroclub d'Evreux</h5>
    <hr>
    <p>L'ID de votre transaction est <?php echo $id; ?></p>
    <p><a href="index.html" class="btn btn-light mt-2">Revenir sur le site</a></p>
  </div>
</body>
</html>
