<?php
require '../variablesApplication.php';
session_start();
include ("../scriptPHP/connectionBDD.php");
$sql = "UPDATE Tchat SET corpsDuTexte = '" . check_ChaineDeCaracteresUpload($_POST['corpsDuTexte']) . "' WHERE id_dialogue = '" . $_POST['id'] . "'";
$req = faireUneRequeteOffLine($sql);
header("location: ../index.php?page=gestionGueuloir");
?>
