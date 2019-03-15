<?php
require '../variablesApplication.php';
include ("../scriptPHP/connectionBDD.php");
session_start();
suppressionArticle($_GET['id']);
header("location: ../index.php?page='articles'");
?>
