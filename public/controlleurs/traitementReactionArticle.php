<?php
require '../variablesApplication.php';
include ("../scriptPHP/connectionBDD.php");
session_start();
if (isset($_SESSION['identifiant'])) {
    $pseudo = $_SESSION['identifiant'];
} else {
    $pseudo = HTML_ChaineDeCaracteres(check_ChaineDeCaracteresUpload($_POST['Pseudo']));
}
$ip = $_SERVER['REMOTE_ADDR'];
$commentaire = HTML_ChaineDeCaracteres(check_ChaineDeCaracteresUpload($_POST['commentaire']));
// insertion Dans la base de Données
$sql = "INSERT INTO articlesCommentaires(id_article,Pseudo,Corps_commentaire,Ip) VALUES ('" . $_POST['id_article'] . "','" . $pseudo . "','" . $commentaire . "','" . $ip . "')";
$req = faireUneRequeteOffLine($sql);
header("location: ../index.php?page=ArticleReaction&id=" . $_POST['id_article']);

?>
