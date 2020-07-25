<?php

require_once __DIR__ . '/../DataBaseManager.php';
require_once __DIR__ . '/../manager/AccountManager.php';




$manager = new DataBaseManager();
$accountManager = new AccountManager($manager);

$header = "
	<div class=\"container main-menu\">
			<div class=\"row align-items-center justify-content-between d-flex\">
				<div id=\"logo\">
					<a href=\"index.html\"><img src=\"../images/logo.png\" title=\"\" /></a>
				</div>
				<nav id=\"nav-menu-container\">
					<ul class=\"nav-menu\">
						<li><a href=\"index.html\">Accueil</a></li>
						<li><a href=\"aerodrome.html\">Aérodrome</a></li>
						<li><a href=\"flyingClub.html\">Aéroclub</a></li>
						<li><a href=\"loginCustomer.html\">Espace Client</a></li>
						<li><a href=\"loginMember.html\">Espace Membre</a></li>
						<li><a href=\"loginAdmin.html\">Espace Salarié</a></li>
						<li><a href=\"index.html\">Langue</a></li>
					</ul>
				</nav>
			</div>
		</div>
";

$headerCustomer = "
	<div class=\"container main-menu\">
			<div class=\"row align-items-center justify-content-between d-flex\">
				<div id=\"logo\">
					<a href=\"index.html\"><img src=\"../images/logo.png\" title=\"\" /></a>
				</div>
				<nav id=\"nav-menu-container\">
					<ul class=\"nav-menu\">
						<li><a href=\"index.html\">Accueil</a></li>

						<li><a href=\"serviceRequest.php\">Commander un service</a></li>
						<li><a href=\"serviceHistory.html\">Consulter ses commandes</a></li>
						<li><a href=\"accountCustomer.html\">Mon compte</a></li>

						<li><a href=\"\" onclick=\"deco()\">Deconnexion</a>
							<img class='nav-link' style='cursor: pointer' height='30px' width='30px' onclick='deco()' src='../../images/turn-off.png' alt=''>
						</li>
						<li><a href=\"index.html\">Langue</a></li>
					</ul>
				</nav>
			</div>
		</div>
";


$headerMember = "
	<div class=\"container main-menu\">
			<div class=\"row align-items-center justify-content-between d-flex\">
				<div id=\"logo\">
					<a href=\"index.html\"><img src=\"../images/logo.png\" title=\"\" /></a>
				</div>
				<nav id=\"nav-menu-container\">
					<ul class=\"nav-menu\">
						<li><a href=\"index.html\">Accueil</a></li>
						<li><a href=\"activityRequest.html\">Réserver une activité</a></li>
						<li><a href=\"activityHistory.html\">Consulter ses activités</a></li>
						<li><a href=\"accountMember.php\">Mon compte</a></li>

						<li><a href=\"\" onclick=\"deco()\">Deconnexion</a>
							 <img class='nav-link' style='cursor: pointer' height='30px' width='30px' onclick='deco()' src='../../images/turn-off.png' alt=''>
						</li>
						<li><a href=\"index.html\">Langue</a></li>
					</ul>
				</nav>
			</div>
		</div>
";

$headerAdmin = "
	<div class=\"container main-menu\">
			<div class=\"row align-items-center justify-content-between d-flex\">
				<div id=\"logo\">
					<a href=\"index.html\"><img src=\"../images/logo.png\" title=\"\" /></a>
				</div>
				<nav id=\"nav-menu-container\">
					<ul class=\"nav-menu\">
						<li><a href=\"index.html\">Accueil</a></li>
						<li><a href=\"\">Consulter les commandes</a></li>
						<li><a href=\"activityPlan.php\">Planifier les activités</a></li>
						<li><a href=\"calendar.html\">Consulter le planning</a></li>
						<li><a href=\"accountAdmin.php\">Consulter les membres</a></li>
						<li><a href=\"\">Gérer les ressources</a></li>
						<li><a href=\"\">Gérer les tables de paramétrages</a></li>

						<li><a href=\"\" onclick=\"deco()\">Deconnexion</a>
							<img class='nav-link' style='cursor: pointer' height='30px' width='30px' onclick='deco()' src='../../images/turn-off.png' alt=''>
						</li>
						<li><a href=\"index.html\">Langue</a></li>
					</ul>
				</nav>
			</div>
		</div>
";


session_start();

if(isset($_SESSION['token'])){
    $isCo = $accountManager->isCo($_SESSION['token']);

		if ($isCo == 1){
			$type = $accountManager->getTypeFromToken($_SESSION['token']);
			echo $_SESSION['token'];

			$idUser =  $accountManager->getIdFromToken($_SESSION['token']);

			$_SESSION['idUser'] = $idUser;


			switch ($type['type']){
				//client
				case 1:
					$idCustomerArray =  $accountManager->getIdCustomerFromToken($_SESSION['token']);
					$idCustomer = $idCustomerArray['idCustomer'];
					$_SESSION['idCustomer'] = $idCustomer;
					echo $headerCustomer;
					break;

				//membre
				case 2:
					$idMemberArray =  $accountManager->getIdMemberFromToken($_SESSION['token']);
					$idMember = $idMemberArray['idMember'];
					$_SESSION['idMember'] = $idMember;
					echo $headerMember;
					break;

				//salarié
				case 3:
			 	  $_SESSION['idAmin'] = $idUser;
					echo $headerAdmin;
					break;
			}
    }
    else{
        echo $header;
        http_response_code(401);
        die();
    }
}else{
    echo $header;
    //http_response_code(400);
    die();
}


?>
