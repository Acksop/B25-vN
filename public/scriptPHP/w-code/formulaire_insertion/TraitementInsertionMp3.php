<?php
include "../../../../localisation_Domaines_externes_B25.php";

include("../../chaineDeCaracteres.php");
include("../../fichiersImages.php");
include("../../objets/Fichiers_classes.php");
include("../../alertesIntrusions.php");

session_start();

$repertoire_destination = SVNRADIEURAE_DIR."upload_utilisateurs/".$_SESSION['repertoire']."/musiques/";
$Fichier = new Fichier( $_FILES['Fichier'] , $repertoire_destination , 1 , 0 , 0 , 0, 1);
$Fichier->ecritureSurLeServeur();

$erreurDL = $Fichier->erreurs;

if($erreurDL !== 0){
	
	//affichage du code html
	echo "<html>";
	echo "<head>";
	echo "<title>Besan&ccedil;on 25 - La plate-Forme des artistes et des associations de Besan&ccedil;on - v3.00b - beta version</title>";
	echo "<link type='text/css' rel='stylesheet' href='../../../besancon25.css'>";
	echo "</head>";
	echo "<script type='text/javascript' src='fonctions.js'></script>";
	echo "<body text='#000000' bgcolor='gray' onunload='FermerFormulaireImage()'>";
	
	if($erreurDL == 1 || $erreurDL == 2){
		echo "<p class='utilisateurs'>La taille de ". $name." est trop grande</p>";
	}elseif($erreurDL == 3){
		echo "<p class='utilisateurs'>Fichier ". $name." partiellement upload&eacute;</p>";
	}elseif($erreurDL == 4){
		echo "<p class='utilisateurs'>Fichier ". $name." introuvable</p>";
	}elseif($erreurDL == -1){
	  	echo "<p class='utilisateurs'>Vous avez tent&eacute; de <B>H4ck3r</B> le serveur, dommage pour vous ...</p>";
	  	//recuperation IP H4XOR
	  	AlerteSecuriteDLImage();
	}elseif($erreurDL == -2){
		echo "<p class='utilisateurs'>Ce fichier n'est pas une image valide</p>";
	}elseif($erreurDL == -3){
		echo "<p class='utilisateurs'>Le transfert sur le serveur &eacute;t&eacute; interrompu</p>";
	}elseif($erreurDL == -4){
		echo "<p class='utilisateurs'>Le transfert sur le serveur &agrave; &eacute;chou&eacute;</p>";
	}elseif($erreurDL == -5){
		echo "<p class='utilisateurs'>&Ecirc;tes-vous s&ucirc;r d'avoir choisi une image sur votre disque ?</p>";
	}elseif($erreurDL == -6){
		echo "<p class='utilisateurs'> Le redimentionnement de votre image sur le serveur &agrave; &eacute;chou&eacute;</p>";
	}else{
		echo "<p class='utilisateurs'>Erreur Inconnue lors du t&eacute;l&eacute;chargement de ".$name."</p>";
	}
	
	echo "<br/><img src='../../../images/logoo.gif' width='499px' height='499' /><br/><br/><br/>";
	
  	echo "<a href='formulaireMp3.php'>Revenir a la page de choix des images</a>";
  	
  	echo "</body></html>";
  
}else{
	header("location: formulaireMp3.php");
}
?>

?>
