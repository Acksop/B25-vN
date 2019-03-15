<?php
// creation de la session ... inclusion du code ... verification de la session connect�e...
session_start();
// les lignes de codes a executer
$chemin = explode("/", $_GET['mp3Choisi']);
$nomFichier = array_pop($chemin);
array_pop($chemin);
array_pop($chemin);
$chemin = implode("/", $chemin);
$chemin .= "/TEMP/" . $nomFichier;
@rename($_GET['mp3Choisi'], $chemin);
// @unlink($_GET['mp3Choisi']);
// @unlink($_POST['mp3Choisi']);
header("location: formulaireMp3.php");
?>	
