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

$titre = check_ChaineDeCaracteresUpload(ajoutBaliseHREFText(HTML_ChaineDeCaracteres($_POST['titre'])));
$musique = "upload_utilisateurs/".$_SESSION['repertoire']."/musiques/".$Fichier->nom;
//variable pas utilisée
//TODO: faire une BDD des uploads pour voir directement ce qui se télécharge sur le serveur !
$NomOriginal = HTML_ChaineDeCaracteres(check_ChaineDeCaracteresUpload($Fichier->nomOriginal));

$erreurDL = $Fichier->erreurs;

if($erreurDL == 0){
	
		$id_album = $_POST['id_album'];
		ajouterMusiqueAlbumGroupe($id_album,$NomOriginal,$musique,$titre);
		header("location: ../index.php?page=compte#ancre_album_{$id_album}");

}else{

	header("location: ../index.php?page=erreurDLTweet&type={$Fichier->erreurs}&fichier={$_FILES['Musique']['name']}");

}


?>
