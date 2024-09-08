<?php
include("../scriptPHP/connectionBDD.php");
session_start();

$uid = $_SESSION['id_utilisateur'];
$i=1;
$id_adresse = "adresse_".$i;
while(isset($_POST[$id_adresse])){
	if($_POST[$id_adresse] != ''){
		$adresse = check_ChaineDeCaracteresUpload(HTML_ChaineDeCaracteres($_POST[$id_adresse]));
		ajoutLienAsso($adresse,$uid);
	}
	$i++;
	$id_adresse = "adresse_".$i;
}
header("location: ../index.php?page=compte#ancre_Lien");
?>
