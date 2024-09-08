<?php
	include("../scriptPHP/connectionBDD.php");
	session_start();
	$idCompte1 = $_GET['id1'];
	$idCompte2 = $_GET['id2'];
	
	$sql = "DELETE FROM estRelierA WHERE idCompte1 = '{$idCompte1}' AND idCompte2 = '{$idCompte2}'";
	faireUneRequeteOffLine($sql);
	
	header('location: ../index.php?page=compte');
