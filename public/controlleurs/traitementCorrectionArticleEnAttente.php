<?php
include("../scriptPHP/connectionBDD.php");
session_start();
correctionArticleEnAttente($_GET['id'],$_GET['titre'],$_GET['elm1'],$_GET['image']);
header("location: ../index.php?page=autorisationArticle");
?>
