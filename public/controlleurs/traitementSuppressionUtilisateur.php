<?php
	include("../scriptPHP/connectionBDD.php");
	include("../scriptPHP/repertoire.php");
	session_start();
	supprimerUtilisateur($_POST['id']);
	supprimerRepertoiresUtilisateur($_POST['pseudo']);
	header("location: ../index.php?page=gestionUtilisateur");
?>
