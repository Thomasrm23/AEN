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

						<li><a href=\"serviceRequest.html\">Commander un service</a></li>
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
						<li><a href=\"accountMember.html\">Mon compte</a></li>

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
						<li><a href=\"activityHistoryAll.html\">Consulter les activités</a></li>
						<li><a href=\"planning.html\">Consulter le planning</a></li>
						<li><a href=\"\">Consulter les membres</a></li>
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


			switch ($type['type']){

				case 1:
					echo $headerCustomer;
					break;
				case 2:
					echo $headerMember;
					break;
				case 3:
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
