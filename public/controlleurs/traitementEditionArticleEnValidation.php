<?php
include("../scriptPHP/connectionBDD.php");
include("../scriptPHP/courrier.php");
session_start();
	$courriel = recuperationAdresseCourrielDepuisArticleEnValidation($_POST['id']);
	$ancienCorpsArticle = recuperationCorpsArticleEnValidation($_POST['id']);
	$ancienTitreArticle = recuperationTitreArticleEnValidation($_POST['id']);
	$corpsArticle = $_POST['elm1'];
	$titreArticle = $_POST['titre'];
	
	envoiCourrierEditionArticle($courriel,$ancienTitreArticle,$ancienCorpsArticle,$titreArticle,$corpsArticle,$_POST['raison']);
	$id_utilisateur = recuperationUtilisateurArticleEnValidation($_POST['id']);
	insertionArticleEnAttente($id_utilisateur,$corpsArticle,$titreArticle,$_POST['image']);
	
	suppressionArticleEnValidation($_POST['id']);
	
	header("location: ../index.php?page=validationArticle");
?>
