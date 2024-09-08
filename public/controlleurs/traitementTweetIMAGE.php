<?php
session_start();
include "../../localisation_Domaines_externes_B25.php";
include "../scriptPHP/connectionBDD.php";
include "../scriptPHP/objets/Fichiers_classes.php";

$id = $_SESSION['id_utilisateur'];
$type = $_SESSION['type_compte'];
$repertoire_destination = SVNRADIEURAE_DIR."upload_utilisateurs/".$_SESSION['repertoire']."/images/";

$Fichier = new Fichier( $_FILES['Image'] , $repertoire_destination , 0 , 1 , 700 , 1, 0);
$Fichier->ecritureSurLeServeur();

$corps = check_ChaineDeCaracteresUpload(ajoutBaliseHREFText(HTML_ChaineDeCaracteres($_POST['tweet'])));
$image = "upload_utilisateurs/".$_SESSION['repertoire']."/images/".$Fichier->nom;
$original = "upload_utilisateurs/".$_SESSION['repertoire']."/images/originals/".$Fichier->nom;
$NomOriginal = HTML_ChaineDeCaracteres(check_ChaineDeCaracteresUpload($Fichier->nomOriginal));

$erreurDL = $Fichier->erreurs;

if($erreurDL == 0){

	if($type == 2 || $type == 4){
		$id_artiste = recuperationIDartisteOffLine($id);
		$id_buzz = ajouterBUZZArtiste($id_artiste,1);
		ajouterTweetIMAGEArtiste($id_buzz,$corps,$image,$original,$NomOriginal);
	}else{
		$id_association = recuperationIDassociationOffLine($id);
		$id_buzz = ajouterBUZZAssociation($id_association,1);
		ajouterTweetIMAGEAssociation($id_buzz,$corps,$image,$original,$NomOriginal);
	}
	header("location: ../index.php?page=compte");

}else{

	header("location: ../index.php?page=erreurDLTweet&type={$Fichier->erreurs}&fichier={$_FILES['Image']['name']}");

}


?>
