<?php
include("../scriptPHP/connectionBDD.php");
session_start();
correctionArticleEnValidation($_GET['id'],$_GET['titre'],$_GET['elm1'],$_GET['image']);
header("location: ../index.php?page=validationArticle");
?>
