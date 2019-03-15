<?php
require '../variablesApplication.php';
session_start();
include("../scriptPHP/connectionBDD.php");
include("../scriptPHP/objets/Fichiers_classes.php");

$id = $_POST['id_utilisateur'];
if(isset($_POST['id_article'])){
	$id_article = $_POST['id_article'];
}else{
	$id_article = '';
}
$libelle = check_ChaineDeCaracteresUpload($_POST['libelle']);
$description = check_ChaineDeCaracteresUpload($_POST['description']);
$prix = check_ChaineDeCaracteresUpload($_POST['prix']);
if($_FILES['image'] != NULL && $_FILES['image']['name'] !== ''){
	
	$repertoire_destination = RADIEURAE_REP_PATH."upload_utilisateurs/".$_SESSION['repertoire']."/images/";
	$Fichier = new Fichier( $_FILES['image'] , $repertoire_destination , 0 , 1 , 250 , 1, 0);
	
	$Fichier->ecritureSurLeServeur();
	
	$image = "upload_utilisateurs/".$_SESSION['repertoire']."/images/".$Fichier->nom;
	$largeur = $Fichier->tailleX;
	$hauteur = $Fichier->tailleY;
	$erreurDL = $Fichier->erreurs;
}else{
	$image = "";
	$largeur = "";
	$hauteur = "";	
	$erreurDL = 0;	
}

if($erreurDL == 0){

	//modifierInfoAsso($image,"logo",$id);
	modifierArticleArtisans($id_article,$image,$largeur,$hauteur,$libelle,$description,$prix,$id);
	header("location: ../index.php?page=compte#ancre_article_{$id_article}");

}else{

	header("location: ../index.php?page=erreurDLTweet&type={$Fichier->erreurs}&fichier={$_FILES['Image']['name']}");

}


?>
