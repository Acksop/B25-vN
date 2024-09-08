<?php

global $header_title,$header_description,$header_identifier_url,$header_keywords;
$header_title = "Besan&ccedil;on 25 - Le formulaire de r&eacute;cup&eacute;ration du mot de passe de son espace priv&eacute;e sur la Plate-forme";
$header_description = "Retrouvez son mot de passe sur Besan&ccedil;on 25";
$header_identifier_url = "besancon25.fr/recuperation_mot_de_passe";
$header_keywords = "Besan&ccedil;on, Besancon, 25000, 25, espace priv&eacute;, compte, recup&eacute;ration, mot de passe, artisans, artiste, associations, groupe, musicaux, artisan, artistes, association, groupes, musical";


function LancerAffichageDuCorps(){
	if(isset($_GET['envoi'])){
		echo "<p class='utilisateurs'>Vos identifiant de connection vous ont &eacute;t&eacute; envoy&eacute;,v&eacute;rifiez votre courrier dans quelques instant afin de pouvoir enfin vous connecter sur la plate-forme des artistes et des associations de Besan&ccedil;on.</p>";
	}else{
		echo "<form name='recuperationMdp' method='post' action='controlleurs/traitementRecuperationMdp.php'>"
		."<table align='center'>"
		."<tr><td class='utilisateurs' style='padding:15px;'>"
		."VOTRE ADRESSE DE COURRIEL:"
		."</td><td class='utilisateurs' style='width:400px;'>"
		."<input class='tweet' name='courriel' type='text'/>"
		."</td></tr>"
		."<tr><td colspan='2' align='right'>"
		."<input class='tweet' type='submit' value='r&eacute;cup&eacute;rer votre mot de passe'/>"
		."</td><tr>";
		if(isset($_GET['erreur'])){
			switch($_GET['erreur']){
			case 1:
				echo "<tr><td colspan='2' width='150' align='center' class='utilisateurs'>"
					."L'adresse donn&eacute;e ne fait pas partie de la base de donn&eacute;e, veuillez la v&eacute;rifier. "
					."</td></tr>";
			break;
			case 2:
				echo "<tr><td colspan='2' width='150' align='center' class='utilisateurs'>"
					."L'adresse donn&eacute;e n'est pas une adresse de courriel valide, veuillez la v&eacute;rifier. "
					."</td></tr>";
			break;
			default:
			}
		}
		echo "</table>"
		."</form>";
	}
}