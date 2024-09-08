<?php
session_start();
include_once('../scriptPHP/connectionBDD.php');
include_once('../scriptPHP/chaineDeCaracteres.php');

if(isset($_POST['president_nom'])){

	$president_nom = check_ChaineDeCaracteresUpload(HTML_ChaineDeCaracteres($_POST['president_nom']));
	$president_courriel = check_ChaineDeCaracteresUpload(HTML_ChaineDeCaracteres($_POST['president_courriel']));
	modifierStatusAsso($president_nom,'president',$president_courriel,'courriel_president',$_SESSION['id_utilisateur']);
	
}else if(isset($_POST['vicePresident_nom'])){
	
	$vicePresident_nom = check_ChaineDeCaracteresUpload(HTML_ChaineDeCaracteres($_POST['vicePresident_nom']));
	$vicePresident_courriel = check_ChaineDeCaracteresUpload(HTML_ChaineDeCaracteres($_POST['vicePresident_courriel']));
	modifierStatusAsso($vicePresident_nom,'vicePresident',$vicePresident_courriel,'courriel_vicePresident',$_SESSION['id_utilisateur']);
	
}else if(isset($_POST['tresorier_nom'])){
	
	$tresorier_nom = check_ChaineDeCaracteresUpload(HTML_ChaineDeCaracteres($_POST['tresorier_nom']));
	$tresorier_courriel = check_ChaineDeCaracteresUpload(HTML_ChaineDeCaracteres($_POST['tresorier_courriel']));
	modifierStatusAsso($tresorier_nom,'tresorier',$tresorier_courriel,'courriel_tresorier',$_SESSION['id_utilisateur']);
	
}else if(isset($_POST['secretaire_nom'])){
	
	$secretaire_nom = check_ChaineDeCaracteresUpload(HTML_ChaineDeCaracteres($_POST['secretaire_nom']));
	$secretaire_courriel = check_ChaineDeCaracteresUpload(HTML_ChaineDeCaracteres($_POST['secretaire_courriel']));
	modifierStatusAsso($secretaire_nom,'secretaire',$secretaire_courriel,'courriel_secretaire',$_SESSION['id_utilisateur']);
	
}
	header("location: ../index.php?page=compte#ancre_Status");

?>
