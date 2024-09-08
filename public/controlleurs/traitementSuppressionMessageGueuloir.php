<?php
	session_start();
	include("../scriptPHP/connectionBDD.php");
	$sql = "DELETE FROM Tchat WHERE id_dialogue = '".$_POST['id']."'";
	$req = faireUneRequeteOffLine($sql);
	header("location: ../index.php?page=gestionGueuloir");
?>
