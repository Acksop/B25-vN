<?php
	include("../scriptPHP/connectionBDD.php");
	include("../scriptPHP/courrier.php");
	session_start();
	$auteur = recuperationAuteur($_SESSION['id_utilisateur']);
	$corpsArticle = recuperationCorpsArticleEnAttente($_POST['id']);
	$titreArticle = recuperationTitreArticleEnAttente($_POST['id']);
	
	envoiCourrierNonAutoriser($auteur,$titreArticle,$corpsArticle,$_POST['raison']);
	suppressionArticleEnAttente($_POST['id']);
	
	header("location: ../index.php?page=autorisationArticle");
?>
