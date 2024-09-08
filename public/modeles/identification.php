<?php

global $header_title,$header_description,$header_identifier_url,$header_keywords;
$header_title = "Besan&ccedil;on 25 - La porte d'entr&eacute;e de l&apos;espace priv&eacute;e la Plate-forme";
$header_description = "La page d&apos;identification du Besan&ccedil;on 25";
$header_identifier_url = "besancon25.fr/identification";
$header_keywords = "Besan&ccedil;on, Besancon, 25000, 25, espace priv&eacute;, compte, identification";


function LancerAffichageDuCorps(){
	echo "<script language='javascript'>"
		."btn_mdp_down = new Image();
		btn_mdp_down = 'images/mdp_down.png';
		btn_mdp_up = new Image();
		btn_mdp_up = 'images/mdp_up.png';
		btn_mdp_hover = new Image();
		btn_mdp_hover = 'images/mdp_hover.png';
		btn_inscrip_down = new Image();
		btn_inscrip_down = 'images/inscription_down.png';
		btn_inscrip_up = new Image();
		btn_inscrip_up = 'images/inscription_up.png';
		btn_inscrip_hover = new Image();
		btn_inscrip_hover = 'images/inscription_hover.png';
		</script>";
	echo "<table border='0' align='center'>"
	."<form name='utilisateur' method='post' action='controlleurs/traitementConnexion.php'>"
	."<tr><td class='utilisateurs'>"
	."IDENTIFIANT:"
	."</td><td class='utilisateurs'>"
	."<input name='identifiant' type='text'/>"
	."</td></tr><tr><td class='utilisateurs'>"
	."MOT DE PASSE:"
	."</td><td class='utilisateurs'>"
	."<input name='motDePasse' type='password'/>"
	."</td></tr><tr><td colspan='2'>"
	."<input type='submit' value='Acceder au compte'/>"
	."</form>"
	."</td></tr>"
	."<tr><td>"
	."<a href='index.php?page=oubliMdp'><img src='images/mdp_up.png' onMouseOver='javascript:this.src=btn_mdp_hover;' onMouseOut='javascript:this.src=btn_mdp_up;' onMouseDown='javascript:this.src=btn_mdp_down;'></a>"
	."</td><td>"
	."<a href='index.php?page=inscription'><img src='images/inscription_up.png' onMouseOver='javascript:this.src=btn_inscrip_hover;' onMouseOut='javascript:this.src=btn_inscrip_up;' onMouseDown='javascript:this.src=btn_inscrip_down;'</a>"
	."</td></tr><tr><td colspan='2'><img src='images/mdp_inscription_perso.png'></td></tr>";
	if(isset($_GET['erreur'])){
		switch($_GET['erreur']){
		case 1:
			echo "<tr><td colspan='2' width='150' align='center' class='utilisateurs'>"
			."Erreur de login et/ou de pass...."
			."</td></tr>";
		break;
		case 2:
			echo "<tr><td colspan='2' width='150' align='center' class='utilisateurs'>"
			."Vous avez &eacute;t&eacute; temporairement suspendu du service de Besan&ccedil;on25...."
			."</td></tr>";
		break;
		case 3:
			echo "<tr><td colspan='2' width='150' align='center' class='utilisateurs'>"
			."Vous avez &eacute;t&eacute; banni du service de Besan&ccedil;on25...."
			."</td></tr>";
		break;
		case 4:
			echo "<tr><td colspan='2' width='150' align='center' class='utilisateurs'>"
			."Vous &ecirc;tes d&eacute;inscrit du service de Besan&ccedil;on25...."
			."</td></tr>";
		break;
		case 5:
			echo "<tr><td colspan='2' width='150' align='center' class='utilisateurs'>"
			."Tentative de Connection Erron&eacute;....<br>Service Besan&ccedil;on25 indisponible...."
			."</td></tr>";
		break;
		default:
		}
	}
	echo "</table>";
}