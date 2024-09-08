<?php

session_start();
include "../../localisation_Domaines_externes_B25.php";
include("../scriptPHP/connectionBDD.php");
include("../scriptPHP/objets/Fichiers_classes.php");

$id = $_POST['id_utilisateur'];
if(isset($_POST['id_album'])){
	$id_album = $_POST['id_album'];
}else{
	$id_album = '';
}
$libelle = check_ChaineDeCaracteresUpload($_POST['libelle']);
$description = check_ChaineDeCaracteresUpload($_POST['description']);
$annee = check_ChaineDeCaracteresUpload($_POST['annee']);
$style = check_ChaineDeCaracteresUpload($_POST['style']);

if($_FILES['image'] != NULL && $_FILES['image']['name'] !== ''){
	
	$repertoire_destination = SVNRADIEURAE_DIR."upload_utilisateurs/".$_SESSION['repertoire']."/images/";
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

	modifierAlbumGroupe($id_album,$image,$largeur,$hauteur,$libelle,$description,$annee,$style,$id);
	header("location: ../index.php?page=compte#ancre_album_{$id_album}");

}else{

	header("location: ../index.php?page=erreurDLTweet&type={$Fichier->erreurs}&fichier={$_FILES['Image']['name']}");

}


?>
