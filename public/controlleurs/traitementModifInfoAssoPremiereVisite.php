<?php
session_start();
include_once('../scriptPHP/connectionBDD.php');
include_once('../scriptPHP/chaineDeCaracteres.php');

//on coupe l'arbre d'un coup avec plusieurs petits coup de machette ??

	$nom = check_ChaineDeCaracteresUpload($_POST['nom']);
	$nom = HTML_ChaineDeCaracteres($_POST['nom']);
	modifierInfoAsso($nom,'nom',$_SESSION['id_utilisateur']);
	$description = check_ChaineDeCaracteresUpload($_POST['description']);
	$description = HTML_ChaineDeCaracteres($_POST['description']);
	modifierInfoAsso($description,'description',$_SESSION['id_utilisateur']);
	$telephone = check_ChaineDeCaracteresUpload($_POST['telephone']);
	$telephone = HTML_ChaineDeCaracteres($_POST['telephone']);
	modifierInfoAsso($telephone,'telephone',$_SESSION['id_utilisateur']);
	$email = check_ChaineDeCaracteresUpload($_POST['email']);
	$email = HTML_ChaineDeCaracteres($_POST['email']);
	modifierInfoAsso($email,'email',$_SESSION['id_utilisateur']);
	$siteInterWeb = check_ChaineDeCaracteresUpload($_POST['siteInterWeb']);
	$siteInterWeb = HTML_ChaineDeCaracteres($_POST['siteInterWeb']);
	modifierInfoAsso($siteInterWeb,'siteInterWeb',$_SESSION['id_utilisateur']);
	$adresse = check_ChaineDeCaracteresUpload($_POST['adresse']);
	$adresse = HTML_ChaineDeCaracteres($_POST['adresse']);
	modifierInfoAsso($adresse,'adresse',$_SESSION['id_utilisateur']);
	$codePostal = check_ChaineDeCaracteresUpload($_POST['codePostal']);
	$codePostal = HTML_ChaineDeCaracteres($_POST['codePostal']);
	modifierInfoAsso($codePostal,'codePostal',$_SESSION['id_utilisateur']);
	$ville = check_ChaineDeCaracteresUpload($_POST['ville']);
	$ville = HTML_ChaineDeCaracteres($_POST['ville']);
	modifierInfoAsso($ville,'ville',$_SESSION['id_utilisateur']);
	header("location: ../index.php?page=compte#ancre_formulaire");

?>
