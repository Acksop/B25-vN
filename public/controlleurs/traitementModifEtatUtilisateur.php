<?php
	session_start();
	include_once("../scriptPHP/connectionBDD.php");
	$sql = "SELECT statut FROM utilisateur WHERE id_utilisateur = '".$_POST['id']."'";
	$req = faireUneRequeteOffLine($sql);
	$data = mysql_fetch_row($req);
	$data[0]++;
	$data[0] = $data[0]%6;
	if($data[0] == 0){
		$data[0]=1;
	}
	$sql = "UPDATE utilisateur SET statut= '".$data[0]."' WHERE id_utilisateur = '".$_POST['id']."'";
	faireUneRequeteOffLine($sql);
	header("location: ../index.php?page=gestionUtilisateur");
?>
