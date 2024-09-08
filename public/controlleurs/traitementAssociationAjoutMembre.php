<?php
include("../scriptPHP/connectionBDD.php");
session_start();

$uid = $_SESSION['id_utilisateur'];
$i=1;
$id_membre = "membre_".$i;
$id_email = "courriel_".$i;
while(isset($_POST[$id_membre])){
	if($_POST[$id_membre] != '' || $_POST[$id_email] != ''){
		$identite = check_ChaineDeCaracteresUpload(HTML_ChaineDeCaracteres($_POST[$id_membre]));
		$courriel = check_ChaineDeCaracteresUpload(HTML_ChaineDeCaracteres($_POST[$id_email]));
		ajoutMembreAsso($identite,$courriel,$uid);
	}
	$i++;
	$id_membre = "membre_".$i;
	$id_email = "courriel_".$i;
}
header("location: ../index.php?page=compte#ancre_Membre");
?>
