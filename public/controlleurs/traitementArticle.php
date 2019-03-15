<?php
require '../variablesApplication.php';
include("../scriptPHP/connectionBDD.php");
include("../scriptPHP/alertesIntrusions.php");
session_start();
if(!isset($_SESSION['id_utilisateur'])){
	AlerteSecuriteAdresseAgile("ÉcritureArticle");
	$uid = 0;
}else{
	$uid = $_SESSION['id_utilisateur'];
}
$titre = $_GET['titre'];
$corps = $_GET['elm1'];
insertionArticleEnValidation($corps,$titre,$uid);
header("location: ../index.php?page=compte");
?>
