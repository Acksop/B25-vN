<?php
require '../variablesApplication.php';
include ("../scriptPHP/connectionBDD.php");
include ("../scriptPHP/courrier.php");
session_start();
$courriel = recuperationAdresseCourrielDepuisArticleEnValidation($_POST['id']);
$corpsArticle = recuperationCorpsArticleEnValidation($_POST['id']);
$titreArticle = recuperationTitreArticleEnValidation($_POST['id']);

envoiCourrierNonValidation($courriel, $titreArticle, $corpsArticle, $_POST['raison']);
suppressionArticleEnValidation($_POST['id']);

header("location: ../index.php?page=validationArticle");
?>
