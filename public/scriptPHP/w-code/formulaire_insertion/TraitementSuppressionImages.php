<?php
session_start();
// les lignes de codes a executer
$chemin = explode("/", $_GET['imageChoisie']);
$nomFichier = array_pop($chemin);
array_pop($chemin);
array_pop($chemin);
$chemin = implode("/", $chemin);
$chemin .= "/TEMP/" . $nomFichier;
// echo $_GET['imageChoisie']."<br />".$chemin;

@copy($_GET['imageChoisie'], $chemin);
@unlink($_GET['imageChoisie']);
@unlink($_GET['ApercuimageChoisie']);
// @unlink($_POST['imageChoisie']);
// @unlink($_POST['ApercuimageChoisie']);
header("location: formulaireImage.php");
?>	
