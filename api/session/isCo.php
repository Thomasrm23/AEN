<?php

require_once __DIR__ . '/../DataBaseManager.php';
require_once __DIR__ . '/../manager/AccountManager.php';


$manager = new DataBaseManager();
$accountManager = new AccountManager($manager);

$header = "
	<div class=\"container main-menu\">
			<div class=\"row align-items-center justify-content-between d-flex\">
				<div id=\"logo\">
					<a href=\"index.php\"><img src=\"../images/logo.png\" title=\"\" /></a>
				</div>
				<nav id=\"nav-menu-container\">
					<ul class=\"nav-menu\">
						<li><a href=\"index.php\">Accueil</a></li>
						<li><a href=\"index.php\">About</a></li>
            <li class=\"menu-has-children\"><a href=\"\">Inscription</a>
							<ul>
								<li><a href=\"registerCustomer.html\">Client</a></li>
								<li><a href=\"registerMember.html\">Membre</a></li>
							</ul>
						</li>
						<li><a href=\"login.html\">Connexion</a></li>
						<li class=\"menu-has-children\"><a href=\"\">Pages</a>
							<ul>
								<li><a href=\"index.php\">Schedule</a></li>
								<li><a href=\"index.php\">Courses</a></li>
								<li><a href=\"index.php\">Elements</a></li>
							</ul>
						</li>
						<li><a href=\"index.php\">Langue</a></li>
					</ul>
				</nav>
			</div>
		</div>
";

session_start();

if(isset($_SESSION['token'])){
    $isCo = $accountManager->isCo($_SESSION['token']);
    if ($isCo == 1){
        if ($accountManager->verifAdmin($_SESSION['token']) != 1)
        {
            echo $headerIsCo;
            http_response_code(200);
            die();
        }
        else{
            echo $headerAdmin;
            http_response_code(200);
            die();
        }
    }
    else{
        echo $header;
        http_response_code(400);
        die();
    }
}else{
    echo $header;
    //http_response_code(400);
    die();
}


?>
