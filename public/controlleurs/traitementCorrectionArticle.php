<?php
require '../variablesApplication.php';
include ("../scriptPHP/connectionBDD.php");
session_start();
modificationArticle($_GET['id'], $_GET['titre'], $_GET['elm1'], $_GET['image']);
header("location: ../index.php?page=articles");
?>
