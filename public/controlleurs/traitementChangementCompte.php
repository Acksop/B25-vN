<?php
session_start();
include('../scriptPHP/connectionBDD.php');
$_SESSION['id_utilisateur'] = $_GET['id'];

$sql = "SELECT id_utilisateur,repertoirePersonnel,pseudo,type_compte,statut FROM utilisateur WHERE id_utilisateur = '".$_GET['id']."'";
$req = faireUneRequeteOffLine($sql);
$resultat = mysql_fetch_row($req);

$_SESSION['identifiant'] = $resultat[2];
$_SESSION['type_compte'] = $resultat[3];
$_SESSION['status_compte'] = $resultat[4];
$_SESSION['repertoire'] = $resultat[1];

header("location: ../index.php?page=compte");
