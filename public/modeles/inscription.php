<?php
global $header_title, $header_description, $header_identifier_url, $header_keywords;
$header_title = "Besançon 25 - Le formulaire d'inscription à un l'espace privée de la Plate-forme du (B25)";
$header_description = "Inscription au [B25]";
$header_identifier_url = "besancon25.fr/inscription";
$header_keywords = "Besançon, Besancon, 25000, 25, espace privé, compte, inscription, artisans, artiste, associations, groupe, musicaux, artisan, artistes, association, groupes, musical";

function LancerAffichageDuCorps()
{
    echo "<script src='scriptJS/afficherCacherDIV.js' type='text/javascript'></script>";
    
    $texteInscription = rand(1, 5);
    
    echo "<h1 class='utilisateurs'>&raquo; ";
    
    switch ($texteInscription) {
        case 1:
            echo "Vous avez l'cot&eacute; d'un ..  ??";
            break;
        case 2:
            echo "Vous &ecirc;tes plut&ocirc;t un ..  ??";
            break;
        case 3:
            echo "Vous voulez devenir un ..  ??";
            break;
        case 4:
            echo "Vous vous sentez l'&acirc;me d'un .. ??";
            break;
        case 5:
            echo "Vous seriez plut&ocirc;t un ..  ??";
            break;
        default:
            echo "Vous &ecirc;tes un .. ?";
    }
    echo "</h1>";
    
    $tabSequence = Array(
        "<td><img alt='ligne de code numero 40' style='cursor: pointer;' id='btn_artiste' src='images/picto-compte-artiste.gif' width='150' height='150' onClick='affichageInscription(;GUILLEMET;AZ123;GUILLEMET;)' /></td>",
        "<td><img alt='ligne de code numero 41' style='cursor: pointer;' id='btn_artisans' src='images/picto-compte-artisans.gif' width='150' height='150' onClick='affichageInscription(;GUILLEMET;WX789;GUILLEMET;)' /></td>",
        "<td><img alt='ligne de code numero 42' style='cursor: pointer;' id='btn_groupe' src='images/picto-compte-groupe.gif' width='150' height='150' onClick='affichageInscription(;GUILLEMET;PO987;GUILLEMET;)' /></td>",
        "<td><img alt='ligne de code numero 43' style='cursor: pointer;' id='btn_association' src='images/picto-compte-association.gif' width='150' height='150' onClick='affichageInscription(;GUILLEMET;QS456;GUILLEMET;)' /></td>"/*,
        /*"<td><img alt='ligne de code numero 44' style='cursor: pointer;' id='btn_sportif' src='images/picto-compte-sportif.gif' width='150' height='150' onClick='affichageInscription(;GUILLEMET;ML654;GUILLEMET;)' /></td>",
        "<td><img alt='ligne de code numero 45' style='cursor: pointer;' id='btn_collectif' src='images/picto-compte-collectif.gif' width='150' height='150' onClick='affichageInscription(;GUILLEMET;HJ159;GUILLEMET;)' /></td>",
        "<td><img alt='ligne de code numero 46' style='cursor: pointer;' id='btn_quidam' src='images/picto-compte-fan-gallerien.gif' width='150' height='150' onClick='affichageInscription(;GUILLEMET;NB321;GUILLEMET;)' /></td>",
        "<td><img alt='ligne de code numero 47' style='cursor: pointer;' id='btn_maison' src='images/picto-compte-maison-collective.gif' width='150' height='150' onClick='affichageInscription(;GUILLEMET;GF357;GUILLEMET;)' /></td>"*/
    );
    $taille = est_de_taille($tabSequence);
    $tabSequenceIndex = generer_tableau_numerique_melanger($taille);
    echo "<table border='0' align='center'><tr>";
    for ($i = 0; $i < $taille; $i ++) {
        echo str_replace(";GUILLEMET;", '"', $tabSequence[$tabSequenceIndex[$i]]);
    }
    echo "</tr><tr><td colspan='4'>";
    if (isset($_GET['erreur'])) {
        switch ($_GET['erreur']) {
            case 1:
                echo "<div class='erreur'>" . "L'identifiant est d&eacute;j&agrave; utilis&eacute;, veuillez bien en choisir un autre..." . "</div>";
                break;
            case 2:
                echo "<div class='erreur'>" . "Veuillez v&eacute;rifier vos mots de passes..." . "</div>";
    
                break;
            case 3:
                echo "<div class='erreur'>" . "Veuillez v&eacute;rifier vos touches de clavier, elles sont sales et pas codifi&eacute;es en H4x0R..." . "</div>";
    
                break;
            default:
        }
    }
    echo "</td></tr></table><br /><br />";
    echo "<div id='inscription'>" . "<form name='form_inscription' method='post' action='controlleurs/traitementInscription.php'>";
    
    echo "<noscript><table border='0' align='center'>" . "<tr><td class='utilisateursInverse' style='width:285px;'>" . "TYPE DE COMPTE:" . "</td><td class='utilisateursInverse' style='padding:15px;width:230px;'>" . "<select class='tweet' name='type'>" . "<option value='AZ123'>Artiste </option>" . "<option value='WX789'>Artisans </option>" . "<option value='ML654'>Sportif</option>" . "<option value='QS456'>Association</option>" . "<option value='PO987'>Groupe Musical</option>" . "<option value='HJ159'>Collectif</option>" . "<option value='NB321'>Fan Quidam Galerian</option>" . "<option value='GF357'>Maison Collective</option>" . "</select>" . "</td></tr></table><br /></noscript>";
    
    echo "<table border='0' align='center'>" . "<tr><td class='utilisateurs'>" . "IDENTIFIANT CHOISI:" . "</td><td class='utilisateurs' style='padding:15px'>" . "<input class='tweet' name='identifiant' type='text'/>" . "</td></tr><tr><td class='utilisateurs'>" . "MOT DE PASSE CHOISI:" . "</td><td class='utilisateurs' style='padding:15px'>" . "<input class='tweet' name='motDePasse1' type='password'/>" . "</td></tr><tr><td class='utilisateurs'>" . "CONFIRMATION DU MOT DE PASSE :" . "</td><td class='utilisateurs' style='padding:15px'>" . "<input class='tweet' name='motDePasse2' type='password'/>" . "</td></tr><tr><td class='utilisateurs'>" . "COURRIEL:" . "</td><td class='utilisateurs' style='padding:15px'>" . "<input class='tweet' name='courriel' type='text'/>" . "</td></tr>" . "<tr><td colspan='2' align='right'>" . "<div id='hiddenInput'></div>" . "<input class='tweet' type='submit' value='Inscription'/>" . "</td></tr>" . "</form>";
    echo "</table></div>";
    
    echo "<script  type='text/javascript' language='javascript'>" . "
	cacherDIV('inscription');
	
	btn_artiste_disabled = new Image();
	btn_artiste_disabled = 'images/picto-compte-artiste_disabled.gif';
	btn_artisans_disabled = new Image();
	btn_artisans_disabled = 'images/picto-compte-artisans_disabled.gif';
	btn_groupe_disabled = new Image();
	btn_groupe_disabled = 'images/picto-compte-groupe_disabled.gif';
	btn_association_disabled = new Image();
	btn_association_disabled = 'images/picto-compte-association_disabled.gif';
	btn_sportif_disabled = new Image();
	btn_sportif_disabled = 'images/picto-compte-sportif_disabled.gif';
	btn_collectif_disabled = new Image();
	btn_collectif_disabled = 'images/picto-compte-collectif_disabled.gif';
	btn_quidam_disabled = new Image();
	btn_quidam_disabled = 'images/picto-compte-fan-gallerien_disabled.gif';
	btn_maison_disabled = new Image();
	btn_maison_disabled = 'images/picto-compte-maison-collective_disabled.gif';
	
	
	
	btn_artiste = new Image();
	btn_artiste = 'images/picto-compte-artiste.gif';
	btn_artisans = new Image();
	btn_artisans = 'images/picto-compte-artisans.gif';
	btn_groupe = new Image();
	btn_groupe = 'images/picto-compte-groupe.gif';
	btn_association = new Image();
	btn_association = 'images/picto-compte-association.gif';
	btn_sportif = new Image();
	btn_sportif = 'images/picto-compte-sportif.gif';
	btn_collectif = new Image();
	btn_collectif = 'images/picto-compte-collectif.gif';
	btn_quidam = new Image();
	btn_quidam = 'images/picto-compte-fan-gallerien.gif';
	btn_maison = new Image();
	btn_maison = 'images/picto-compte-maison-collective.gif';
	
	function affichageInscription( typeCompte ){
		afficherDIV('inscription');
		
		switch( typeCompte ){
			case 'AZ123':
				selectionnerDIVimage('btn_artiste').src = btn_artiste;
				selectionnerDIVimage('btn_artisans').src = btn_artisans_disabled;
				selectionnerDIVimage('btn_groupe').src = btn_groupe_disabled;
				selectionnerDIVimage('btn_association').src = btn_association_disabled;
	            selectionnerDIVimage('btn_sportif').src = btn_sportif_disabled;
				selectionnerDIVimage('btn_collectif').src = btn_collectif_disabled;
	            selectionnerDIVimage('btn_quidam').src = btn_quidam_disabled;
				selectionnerDIVimage('btn_maison').src = btn_maison_disabled;
			break;
			case 'QS456':
				selectionnerDIVimage('btn_artiste').src = btn_artiste_disabled;
				selectionnerDIVimage('btn_artisans').src = btn_artisans_disabled;
				selectionnerDIVimage('btn_groupe').src = btn_groupe_disabled;
				selectionnerDIVimage('btn_association').src = btn_association;
	            selectionnerDIVimage('btn_sportif').src = btn_sportif_disabled;
				selectionnerDIVimage('btn_collectif').src = btn_collectif_disabled;
	            selectionnerDIVimage('btn_quidam').src = btn_quidam_disabled;
				selectionnerDIVimage('btn_maison').src = btn_maison_disabled;
			break;
			case 'WX789':
				selectionnerDIVimage('btn_artiste').src = btn_artiste_disabled;
				selectionnerDIVimage('btn_artisans').src = btn_artisans;
				selectionnerDIVimage('btn_groupe').src = btn_groupe_disabled;
				selectionnerDIVimage('btn_association').src = btn_association_disabled;
	            selectionnerDIVimage('btn_sportif').src = btn_sportif_disabled;
				selectionnerDIVimage('btn_collectif').src = btn_collectif_disabled;
	            selectionnerDIVimage('btn_quidam').src = btn_quidam_disabled;
				selectionnerDIVimage('btn_maison').src = btn_maison_disabled;
			break;
			case 'PO987':
				selectionnerDIVimage('btn_artiste').src = btn_artiste_disabled;
				selectionnerDIVimage('btn_artisans').src = btn_artisans_disabled;
				selectionnerDIVimage('btn_groupe').src = btn_groupe;
				selectionnerDIVimage('btn_association').src = btn_association_disabled;
	            selectionnerDIVimage('btn_sportif').src = btn_sportif_disabled;
				selectionnerDIVimage('btn_collectif').src = btn_collectif_disabled;
	            selectionnerDIVimage('btn_quidam').src = btn_quidam_disabled;
				selectionnerDIVimage('btn_maison').src = btn_maison_disabled;
			break;
	        case 'ML654':
				selectionnerDIVimage('btn_artiste').src = btn_artiste_disabled;
				selectionnerDIVimage('btn_artisans').src = btn_artisans_disabled;
				selectionnerDIVimage('btn_groupe').src = btn_groupe_disabled;
				selectionnerDIVimage('btn_association').src = btn_association_disabled;
	            selectionnerDIVimage('btn_sportif').src = btn_sportif;
				selectionnerDIVimage('btn_collectif').src = btn_collectif_disabled;
	            selectionnerDIVimage('btn_quidam').src = btn_quidam_disabled;
				selectionnerDIVimage('btn_maison').src = btn_maison_disabled;
			break;
	        case 'NB321':
				selectionnerDIVimage('btn_artiste').src = btn_artiste_disabled;
				selectionnerDIVimage('btn_artisans').src = btn_artisans_disabled;
				selectionnerDIVimage('btn_groupe').src = btn_groupe_disabled;
				selectionnerDIVimage('btn_association').src = btn_association_disabled;
	            selectionnerDIVimage('btn_sportif').src = btn_sportif_disabled;
				selectionnerDIVimage('btn_collectif').src = btn_collectif_disabled;
	            selectionnerDIVimage('btn_quidam').src = btn_quidam;
				selectionnerDIVimage('btn_maison').src = btn_maison_disabled;
			break;
	        case 'GF357':
				selectionnerDIVimage('btn_artiste').src = btn_artiste_disabled;
				selectionnerDIVimage('btn_artisans').src = btn_artisans_disabled;
				selectionnerDIVimage('btn_groupe').src = btn_groupe_disabled;
				selectionnerDIVimage('btn_association').src = btn_association_disabled;
	            selectionnerDIVimage('btn_sportif').src = btn_sportif_disabled;
				selectionnerDIVimage('btn_collectif').src = btn_collectif_disabled;
	            selectionnerDIVimage('btn_quidam').src = btn_quidam_disabled;
				selectionnerDIVimage('btn_maison').src = btn_maison;
			break;
	        case 'HJ159':
				selectionnerDIVimage('btn_artiste').src = btn_artiste_disabled;
				selectionnerDIVimage('btn_artisans').src = btn_artisans_disabled;
				selectionnerDIVimage('btn_groupe').src = btn_groupe_disabled;
				selectionnerDIVimage('btn_association').src = btn_association_disabled;
	            selectionnerDIVimage('btn_sportif').src = btn_sportif_disabled;
				selectionnerDIVimage('btn_collectif').src = btn_collectif;
	            selectionnerDIVimage('btn_quidam').src = btn_quidam_disabled;
				selectionnerDIVimage('btn_maison').src = btn_maison_disabled;
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
