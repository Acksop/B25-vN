<?php
session_start();
include('../scriptPHP/sessions.php');
$id_utilisateur = rechercherUtilisateur($_POST['identifiant'],$_POST['motDePasse']);
	if ($id_utilisateur == -1){
		header("location: ../index.php?page=relierDesComptes&erreur=1");
	} else {
		$sql = "INSERT INTO estRelierA(idCompte1,idCompte2) VALUES ('".$id_utilisateur."','".$_SESSION['id_utilisateur']."')";
		$req = faireUneRequeteOffLine($sql);
		header("location: ../index.php?page=compte");
	}
