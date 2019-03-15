<?php
// creation de la session ... inclusion du code ... verification de la session connectée...
session_start();
// les lignes de codes a executer
$chemin = explode("/", $_GET['videoChoisie']);
$nomFichier = array_pop($chemin);
array_pop($chemin);
array_pop($chemin);
$chemin = implode("/", $chemin);
$chemin .= "/TEMP/" . $nomFichier;
@rename($_GET['videoChoisie'], $chemin);
header("location: formulaireVideo.php");
?>	