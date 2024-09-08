<?php
session_start();
include "../../localisation_Domaines_externes_B25.php";
include("../scriptPHP/connectionBDD.php");
include("../scriptPHP/objets/Fichiers_classes.php");

$id = $_SESSION['id_utilisateur'];
$type = $_SESSION['type_compte'];
$repertoire_destination = SVNRADIEURAE_DIR."upload_utilisateurs/".$_SESSION['repertoire']."/musiques/";

$Fichier = new Fichier( $_FILES['Musique'] , $repertoire_destination , 1 , 0 , 700 , 0, 0);
$Fichier->ecritureSurLeServeur();

$corps = check_ChaineDeCaracteresUpload(ajoutBaliseHREFText(HTML_ChaineDeCaracteres($_POST['tweet'])));
$musique = "upload_utilisateurs/".$_SESSION['repertoire']."/musiques/".$Fichier->nom;
$NomOriginal = HTML_ChaineDeCaracteres(check_ChaineDeCaracteresUpload($Fichier->nomOriginal));

$erreurDL = $Fichier->erreurs;

if($erreurDL == 0){

	if($type == 2 || $type == 4){
		$id_artiste = recuperationIDartisteOffLine($id);
		$id_buzz = ajouterBUZZArtiste($id_artiste,2);
		ajouterTweetMP3Artiste($id_buzz,$corps,$musique,$NomOriginal);
	}else{
		$id_association = recuperationIDassociationOffLine($id);
		$id_buzz = ajouterBUZZAssociation($id_association,2);
		ajouterTweetMP3Association($id_buzz,$corps,$musique,$NomOriginal);
	}
	header("location: ../index.php?page=compte");

}else{

	header("location: ../index.php?page=erreurDLTweet&type={$Fichier->erreurs}&fichier={$_FILES['Musique']['name']}");

}


?>
