<?php
require '../variablesApplication.php';
include ("../scriptPHP/connectionBDD.php");
include ("../scriptPHP/courrier.php");
session_start();
$auteur = recuperationAuteur($_SESSION['id_utilisateur']);
$ancienCorpsArticle = recuperationCorpsArticleEnAttente($_POST['id']);
$ancienTitreArticle = recuperationTitreArticleEnAttente($_POST['id']);
$corpsArticle = $_POST['corps'];
$titreArticle = $_POST['titre'];

envoiCourrierArticleAValider($auteur, $ancienTitreArticle, $ancienCorpsArticle, $titreArticle, $corpsArticle, $_POST['raison']);
insertionArticleEnValidation($corpsArticle, $titreArticle);

suppressionArticleEnAttente($_POST['id']);

header("location: ../index.php?page=autorisationArticle");
?>
