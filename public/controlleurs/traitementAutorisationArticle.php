<?php
	include("../scriptPHP/connectionBDD.php");
	session_start();
	insertionArticleAutoriser($_GET['id']);
	header("location: ../index.php?page=autorisationArticle");
?>
