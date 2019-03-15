<?php
//--
check_session();
//--
function LancerAffichageDuCorps(){
	include(dirname(__FILE__).'/../scriptPHP/w-code/wcode.inc.php');
	include(dirname(__FILE__).'/../scriptPHP/w-code/wcode.implementation.php');
	echo wcode_javascript();
	echo wcode_css();
	if(isset($_GET['id'])){
		$data = exploiterLigneResultatBDD(recuperationDossierEnAttente($_GET['id']));
	}
	$wcode = $data['bbcode'];
	$wcode = check_ChaineDeCaracteresDownload($wcode);
	$wc = new wcode();
	$wc->charger_configuration("wcode.config.php");
	$wc->definir_code($wcode);
	$r = $wc->lire_code();

	if(isset($_GET['modification'])){
		echo "<form method='post' name='dossier' action='controlleurs/traitementModificationDossierEnAttente.php'>"
		."<h3>Modification d'un Dossier:</h3>"
		."<p align='left'>Titre: <input type='text' name='titre' size='80' value='".$data['titre']."'></p>"
		."<p align='left'>Description sommaire du dossier:<input type='text' name='description' size='100' value='".$data['description']."'></p>";
		echo wcode_editeur("dossier","corps",$wcode);
		echo "<input type='submit' class='btn_dossiers' name='save' value='V&eacute;rifier la mise en page du dossier!' />"
			."<input type='hidden' name='reecriture' value='oui'/>"
			."<input type='hidden' name='validation_id' value='".$data['id_dossier']."'/>";
		echo "</form>";
	}else{
		cadreDossierDebut();
		echo "<p class='titreDossier'>".$data['titre']."</p>";
		echo "<p class='corpsDossier'>";
		 if ($r){
				echo $wc->donner_html();
				echo "<center>";
				echo "<form method='post' style='display:inline;' action='index.php?page=modificationDossierEnAttente&id=".$data['id_dossier']."&modification=oui'>"
				."<input type='submit' class='btn_dossiers' value='Modifier ?' />"
				."</form>";
				echo "<form method='post' style='display:inline;' action='index.php?page=compte'>"
					."<input type='submit' class='btn_dossiers' value='Sauvergarder et quitter l&acute;&eacute;dition ?' />"
					."</form></center>";
		 } else {
				echo "<img src='scriptPHP/wcode_images/erreur.gif' /> :: <b>".$wc->erreur."</b></p><pre>".$wc->code_faux."</pre>";
				echo "<form method='post' action='index.php?page=modificationDossier&id=".$data['id_dossier']."&modification=oui'>"
				."<input type='submit' value='Modifier!' />"
				."</form>";
		 }
		 echo "<p align='right' class='date'>".$data['date_Modif']."</p>"
			."<p align='right' class='post'>Auteur:&nbsp;&nbsp;".recuperationAuteur($data['id_utilisateur'])."</p>";
		echo "</p>";
		cadreDossierFin();
	}
}