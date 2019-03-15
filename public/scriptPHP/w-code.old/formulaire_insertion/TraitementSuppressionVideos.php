<?php
// creation de la session ... inclusion du code ... verification de la session connect�e...
session_start();
// les lignes de codes a executer
$chemin = explode("/", $_GET['videoChoisie']);
$nomFichier = array_pop($chemin);
array_pop($chemin);
array_pop($chemin);
$chemin = implode("/", $chemin);
$chemin .= "/TEMP/" . $nomFichier;
@rename($_GET['videoChoisie'], $chemin);
// @unlink($_GET['videoChoisie']);
// @unlink($_POST['mp3Choisi']);
header("location: formulaireVideo.php");
?>	