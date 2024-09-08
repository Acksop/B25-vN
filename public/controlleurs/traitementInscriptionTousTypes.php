<?php
session_start();
include "../../localisation_Domaines_externes_B25.php";
include_once('../scriptPHP/connectionBDD.php');
include_once('../scriptPHP/sessions.php');
include_once('../scriptPHP/repertoire.php');
include_once('../scriptPHP/date.php');


$login=$_POST['identifiant'];
$pass=$_POST['motDePasse1'];
$pass2=$_POST['motDePasse2'];
$email=$_POST['courriel'];
$type=$_POST['type'];

if(existe_Log($login) == true){
	header("location: ../index.php?page=ajoutUtilisateur&erreur=1");
}else{
	if($pass != $pass2){
		header("location: ../index.php?page=ajoutUtilisateur&erreur=2");
	}else{
		$date = AfficheDate();
		$repertoirePersonnel = chaineAleatoire().recupererDatePourNouveauRepertoireUtilisateur();
		$id_utilisateur = inscriptionSite($login,$pass,$repertoirePersonnel,$email,$type,$date);
		//creations des répertoires personnels
		creerRepertoiresUtilisateur($repertoirePersonnel);
		//actualisation de la page
		header("location: ../index.php?page=compte");
	}
}
?>
