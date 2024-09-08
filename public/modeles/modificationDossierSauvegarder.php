<?php
//--
check_session();
//--
function AfficheFormModificationDossier(){
	include('scriptPHP/w-code/wcode.inc.php');
	include('scriptPHP/w-code/wcode.implementation.php');
	echo wcode_javascript();
	echo wcode_css();
	
	if(!isset($_POST['id'])){
		return(0);
	}
	$data = recuperationDossier($_POST['id']);
	$data = mysql_fetch_assoc($data);
	
	$wcode = $data['bbcode'];
	$wcode = check_ChaineDeCaracteresDownload($wcode);
	$wc = new wcode();
	$wc->charger_configuration("scriptPHP/w-code/wcode.config.php");
	$wc->definir_code($wcode);
	$r = $wc->lire_code();

print_r($wcode);

	if(isset($_POST['modification'])){
		//modification du dossier
		echo "<form method='post' name='dossier' action='controlleurs/traitementModificationDossierSauvegarder.php'>"
		."<h3>Modification d'un Dossier:</h3>"
		."<p align='left'>Titre: <input type='text' name='titre' size='80' value='".$data['titre']."'></p>"
		."<p align='left'>Description sommaire du dossier:<input type='text' name='description' size='100' value='".$data['description']."'></p>";
		echo wcode_editeur("dossier","corps",$wcode);
		echo "<input type='submit' class='btn_dossiers name='save' value='V&eacute;rifier la mise en page du dossier!' />"
			."<input type='hidden' name='reecriture' value='oui'/>"
			."<input type='hidden' name='validation_id' value='".$data['id_dossier']."'/>";
		echo "</form>";
	}else{
		//affichage de la mise en page pour la lecture
		cadreDossierDebut();
		echo "<p class='titreDossier'>".$data['titre']."</p>";
		echo "<p class='corpsDossier'>";
		 if ($r){
				echo $wc->donner_html();
				echo "</p><center><form style='display:inline;' method='post' action='index.php?page=modificationDossierSauvegarder&id=".$data['id_dossier']."&modification=oui'>"
				."<input type='submit' class='btn_dossiers' value='Modifier?' />"
				."</form>";
				echo "<form style='display:inline;' method='post' action='controlleurs/traitementDossiers.php'>"
					."<input type='hidden' name='validation_id' value='".$data['id_dossier']."'/>"
					."<input type='submit' class='btn_dossiers' value='Envoyer &agrave; valider?' />"
					."</form>";
				echo "<form style='display:inline;' method='post' action='index.php?page=compte'>"
					."<input type='submit' class='btn_dossiers' value='Sauvegarder et Stopper l&acute;&eacute;dition?' />"
					."</form>";
		 } else {
				echo "<img src='scriptPHP/wcode_images/erreur.gif' /> :: <b>".$wc->erreur."</b></p><pre>".$wc->code_faux."</pre>";
				echo "<form method='post' action='index.php?page=modificationDossierSauvegarder&id=".$data['id_dossier']."&modification=oui'>"
				."<input type='submit' class='btn_dossiers' value='Modifier!' />"
				."</form>"
				."</center>";
		 }
		 echo "<p align='right' class='date'>".$data['date_Modif']."</p>"
			."<p align='right' class='post'>Auteur:&nbsp;&nbsp;".recuperationAuteur($data['id_utilisateur'])."</p>";
		echo "</p>";
		cadreDossierFin();
	}
}