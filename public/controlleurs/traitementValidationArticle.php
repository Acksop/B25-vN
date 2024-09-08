<?php
	include("../scriptPHP/connectionBDD.php");
	include("../scriptPHP/fluxRSS.php");
	session_start();
	insertionValidationArticle($_GET['id']);
	creationFluxRSS();
	header("location: ../index.php?page=articles");
?>
