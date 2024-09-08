<?php
	include("../scriptPHP/connectionBDD.php");
	session_start();
	suppressionArticleArtisans($_POST['id_article']);
	header("location: ../index.php?page=compte#ancre_articles");
	