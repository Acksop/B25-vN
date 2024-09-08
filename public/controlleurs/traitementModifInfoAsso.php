<?php
session_start();
include_once('../scriptPHP/connectionBDD.php');
include_once('../scriptPHP/chaineDeCaracteres.php');

//quel est le lib a changer?
if(isset($_POST['nom'])){
	$nom = HTML_ChaineDeCaracteres(check_ChaineDeCaracteresUpload($_POST['nom']));
	modifierInfoAsso($nom,'nom',$_SESSION['id_utilisateur']);
}else if(isset($_POST['description'])){
	$description = HTML_ChaineDeCaracteres(check_ChaineDeCaracteresUpload($_POST['description']));
	modifierInfoAsso($description,'description',$_SESSION['id_utilisateur']);
}else if(isset($_POST['telephone'])){
	$telephone = HTML_ChaineDeCaracteres(check_ChaineDeCaracteresUpload($_POST['telephone']));
	modifierInfoAsso($telephone,'telephone',$_SESSION['id_utilisateur']);
}else if(isset($_POST['email'])){
	$email = HTML_ChaineDeCaracteres(check_ChaineDeCaracteresUpload($_POST['email']));
	modifierInfoAsso($email,'email',$_SESSION['id_utilisateur']);
}else if(isset($_POST['siteInterWeb'])){
	$siteInterWeb = HTML_ChaineDeCaracteres(check_ChaineDeCaracteresUpload($_POST['siteInterWeb']));
	modifierInfoAsso($siteInterWeb,'siteInterWeb',$_SESSION['id_utilisateur']);
}else if(isset($_POST['adresse'])){
	$adresse = HTML_ChaineDeCaracteres(check_ChaineDeCaracteresUpload($_POST['adresse']));
	modifierInfoAsso($adresse,'adresse',$_SESSION['id_utilisateur']);
}else if(isset($_POST['codePostal'])){
	$codePostal = HTML_ChaineDeCaracteres(check_ChaineDeCaracteresUpload($_POST['codePostal']));
	modifierInfoAsso($codePostal,'codePostal',$_SESSION['id_utilisateur']);
}else if(isset($_POST['ville'])){
	$ville = HTML_ChaineDeCaracteres(check_ChaineDeCaracteresUpload($_POST['ville']));
	modifierInfoAsso($ville,'ville',$_SESSION['id_utilisateur']);
}else if(isset($_POST['voir_Page'])){
	($_POST['voir_Page']==0)?$voir_Page=1:$voir_Page=0;
	modifierInfoAsso($voir_Page,'voir_Page',$_SESSION['id_utilisateur']);
}
	if(isset($_POST['voir_Page'])){
		header("location: ../index.php?page=compte");
	}else{
		header("location: ../index.php?page=compte#ancre_formulaire");
	}

?>
