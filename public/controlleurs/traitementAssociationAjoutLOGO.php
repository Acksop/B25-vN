<?php
require '../variablesApplication.php';
session_start();
include("../scriptPHP/connectionBDD.php");
include("../scriptPHP/objets/Fichiers_classes.php");

$id = $_POST['id_utilisateur'];
$repertoire_destination = RADIEURAE_REP_PATH."upload_utilisateurs/".$_SESSION['repertoire']."/images/";

$Fichier = new Fichier( $_FILES['Image'] , $repertoire_destination , 0 , 1 , 700 , 1, 1);
$Fichier->ecritureSurLeServeur();

$image = "upload_utilisateurs/".$_SESSION['repertoire']."/images/".$Fichier->nom;
$largeur = $Fichier->tailleX;
$hauteur = $Fichier->tailleY;

$erreurDL = $Fichier->erreurs;

if($erreurDL == 0){

	modifierLogoAsso($image,$largeur,$hauteur,$id);
	header("location: ../index.php?page=compte#ancre_logo");

}else{

	header("location: ../index.php?page=erreurDLTweet&type={$Fichier->erreurs}&fichier={$_FILES['Image']['name']}");

}


?>
