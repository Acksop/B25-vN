<?php
session_start();
include("../scriptPHP/connectionBDD.php");
include_once("../scriptPHP/chaineDeCaracteres.php");

$id = $_SESSION['id_utilisateur'];
$type = $_SESSION['type_compte'];
$corps = check_ChaineDeCaracteresUpload(ajoutBaliseHREFText(HTML_ChaineDeCaracteres($_POST['tweet'])));

if($type == 2 || $type == 4){
	$id_artiste = recuperationIDartisteOffLine($id);
	$id_buzz = ajouterBUZZArtiste($id_artiste,0);
	ajouterTweetTXTArtiste($id_buzz,$corps);
}else{
	$id_association = recuperationIDassociationOffLine($id);
	$id_buzz = ajouterBUZZAssociation($id_association,0);
	ajouterTweetTXTAssociation($id_buzz,$corps);
}

header("location: ../index.php?page=compte");

?>
