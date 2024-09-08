<?php
include("../scriptPHP/date.php");
include("../scriptPHP/connectionBDD.php");
session_start();
if(!isset($_POST['validation_id'])){
	include('../scriptPHP/w-code/wcode.inc.php');
	$wc = new wcode();
	$wc->charger_configuration("../scriptPHP/w-code/wcode.config.php");
	$wc->definir_code($_POST['corps']);
	$r = $wc->lire_code();
	//echo $_POST['titre'].$_POST['description'].$wc->code_html.$wc->code;
	$data = insertionDossierTemporaire(HTML_ChaineDeCaracteres($_POST['titre']),HTML_ChaineDeCaracteres($_POST['description']),check_ChaineDeCaracteresUpload($wc->code_html),check_ChaineDeCaracteresUpload($wc->code),AfficheDateArticle());
	$data = mysql_fetch_row($data);
	header("location:../index.php?page=ecritureDossier&testMiseEnPage=1&id=".$data[0]);
}else{
	if(isset($_POST['reecriture'])){
		include('../scriptPHP/w-code/wcode.inc.php');
		$wc = new wcode();
		$wc->charger_configuration("../scriptPHP/w-code/wcode.config.php");
		$wc->definir_code($_POST['corps']);
		$r = $wc->lire_code();
		//echo $_POST['titre'].$_POST['description'].$wc->code_html.$wc->code;
		modificationDossierTemporaire($_POST['validation_id'],HTML_ChaineDeCaracteres($_POST['titre']),HTML_ChaineDeCaracteres($_POST['description']),check_ChaineDeCaracteresUpload($wc->code_html),check_ChaineDeCaracteresUpload($wc->code),AfficheDateArticle());
		header("location:../index.php?page=ecritureDossier&testMiseEnPage=1&id=".$_POST['validation_id']);
	}else{
		insertionDossierEnValidation($_POST['validation_id']);
		header("location:../index.php?page=dossiers");
	}
}
?>
