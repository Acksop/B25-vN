<?php

global $header_title,$header_description,$header_identifier_url,$header_keywords;
$header_title = "Besan&ccedil;on 25 - Le formulaire d&apos;inscription &agrave; un l&apos;espace priv&eacute;e sur la Plate-forme";
$header_description = "Inscription au Besan&ccedil;on 25";
$header_identifier_url = "besancon25.fr/inscription";
$header_keywords = "Besan&ccedil;on, Besancon, 25000, 25, espace priv&eacute;, compte, inscription, artisans, artiste, associations, groupe, musicaux, artisan, artistes, association, groupes, musical";


function LancerAffichageDuCorps(){
	echo "<script src='scriptJS/afficherCacherDIV.js' type='text/javascript'></script>";
	
	echo "<h1 class='utilisateurs'>&raquo; Vous &ecirc;tes ? </h1>";
	
	echo "<table border='0' align='center'><tr>"
		."<td><img style='cursor: pointer;' id='btn_artiste' src='images/picto-compte-artiste.gif' width='150' height='150' onClick='affichageInscription(2)' /></td>"
		."<td><img style='cursor: pointer;' id='btn_artisans' src='images/picto-compte-artisans.gif' width='150' height='150' onClick='affichageInscription(4)' /></td>"
		."<td><img style='cursor: pointer;' id='btn_groupe' src='images/picto-compte-groupe.gif' width='150' height='150' onClick='affichageInscription(5)' /></td>"
		."<td><img style='cursor: pointer;' id='btn_association' src='images/picto-compte-association.gif' width='150' height='150' onClick='affichageInscription(3)' /></td>"
		."</tr></table><br /><br />";
	
	echo "<div id='inscription'>"
	."<form name='form_inscription' method='post' action='controlleurs/traitementInscription.php'>";
	
	echo "<noscript><table border='0' align='center'>"
		."<tr><td class='utilisateursInverse' style='width:285px;'>"
		."TYPE DE COMPTE:"
		."</td><td class='utilisateursInverse' style='padding:15px;width:230px;'>"
		."<select class='tweet' name='type'>"
		."<option value='2'>Artiste </option>"
		."<option value='4'>Artisans </option>"
		."<option value='3'>Association</option>"
		."<option value='5'>Groupe Musical</option>"
		."</select>"
		."</td></tr></table><br /></noscript>";
				
	echo "<table border='0' align='center'>"
		."<tr><td class='utilisateurs'>"
		."IDENTIFIANT CHOISI:"
		."</td><td class='utilisateurs' style='padding:15px'>"
		."<input class='tweet' name='identifiant' type='text'/>"
		."</td></tr><tr><td class='utilisateurs'>"
		."MOT DE PASSE CHOISI:"
		."</td><td class='utilisateurs' style='padding:15px'>"
		."<input class='tweet' name='motDePasse1' type='password'/>"
		."</td></tr><tr><td class='utilisateurs'>"
		."CONFIRMATION DU MOT DE PASSE :"
		."</td><td class='utilisateurs' style='padding:15px'>"
		."<input class='tweet' name='motDePasse2' type='password'/>"
		."</td></tr><tr><td class='utilisateurs'>"
		."COURRIEL:"
		."</td><td class='utilisateurs' style='padding:15px'>"
		."<input class='tweet' name='courriel' type='text'/>"
		."</td></tr>"
		."<tr><td colspan='2' align='right'>"
		."<div id='hiddenInput'></div>"
		."<input class='tweet' type='submit' value='Inscription'/>"
		."</td></tr>"
		."</form>";
		if(isset($_GET['erreur'])){
			switch($_GET['erreur']){
			case 1:
				echo "<tr><td colspan='2' width='150' align='center' class='utilisateurs'>"
					."L'identifiant est d&eacute;j&agrave; utilis&eacute;, veuillez bien en choisir un autre..."
					."</td></tr>";
			break;
			case 2:echo "<tr><td colspan='2' width='150' align='center' class='utilisateurs'>"
					."Veuillez v&eacute;rifier vos mots de passes..."
					."</td></tr>";
				
			break;
			default:
			}
		}
	echo "</table></div>";
	
	echo "<script  type='text/javascript' language='javascript'>"
	."
	cacherDIV('inscription');
	
	btn_artiste_disabled = new Image();
	btn_artiste_disabled = 'images/picto-compte-artiste_disabled.gif';
	btn_artisans_disabled = new Image();
	btn_artisans_disabled = 'images/picto-compte-artisans_disabled.gif';
	btn_groupe_disabled = new Image();
	btn_groupe_disabled = 'images/picto-compte-groupe_disabled.gif';
	btn_association_disabled = new Image();
	btn_association_disabled = 'images/picto-compte-association_disabled.gif';
	
	btn_artiste = new Image();
	btn_artiste = 'images/picto-compte-artiste.gif';
	btn_artisans = new Image();
	btn_artisans = 'images/picto-compte-artisans.gif';
	btn_groupe = new Image();
	btn_groupe = 'images/picto-compte-groupe.gif';
	btn_association = new Image();
	btn_association = 'images/picto-compte-association.gif';
	
	
	function affichageInscription( typeCompte ){
		afficherDIV('inscription');
		
		switch( typeCompte ){
			case 2:
				selectionnerDIVimage('btn_artiste').src = btn_artiste;
				selectionnerDIVimage('btn_artisans').src = btn_artisans_disabled;
				selectionnerDIVimage('btn_groupe').src = btn_groupe_disabled;
				selectionnerDIVimage('btn_association').src = btn_association_disabled;
			break;
			case 4:
				selectionnerDIVimage('btn_artiste').src = btn_artiste_disabled;
				selectionnerDIVimage('btn_artisans').src = btn_artisans;
				selectionnerDIVimage('btn_groupe').src = btn_groupe_disabled;
				selectionnerDIVimage('btn_association').src = btn_association_disabled;
			break;
			case 3:
				selectionnerDIVimage('btn_artiste').src = btn_artiste_disabled;
				selectionnerDIVimage('btn_artisans').src = btn_artisans_disabled;
				selectionnerDIVimage('btn_groupe').src = btn_groupe_disabled;
				selectionnerDIVimage('btn_association').src = btn_association;
			break;
			case 5:
				selectionnerDIVimage('btn_artiste').src = btn_artiste_disabled;
				selectionnerDIVimage('btn_artisans').src = btn_artisans_disabled;
				selectionnerDIVimage('btn_groupe').src = btn_groupe;
				selectionnerDIVimage('btn_association').src = btn_association_disabled;
			break;
			

		}
		
		DIVinscription = selectionnerDIV('hiddenInput');
		DIVinscription.innerHTML = '';
		InputHidden = document.createElement('input');
		InputHidden.setAttribute('type','hidden');
		InputHidden.setAttribute('name','type');
		InputHidden.setAttribute('value', typeCompte);
		DIVinscription.appendChild(InputHidden);

		return;
	}
	
	</script>
	";
}
