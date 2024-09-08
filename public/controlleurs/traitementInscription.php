<?php
session_start();
include "../../localisation_Domaines_externes_B25.php";
include('../scriptPHP/connectionBDD.php');
include_once('../scriptPHP/sessions.php');
include_once('../scriptPHP/date.php');
include_once('../scriptPHP/repertoire.php');


$login=$_POST['identifiant'];
$pass=$_POST['motDePasse1'];
$pass2=$_POST['motDePasse2'];
$email=$_POST['courriel'];
if(!isset($_POST['type'])){
	$type = 2;
}else{
	$type=$_POST['type'];
	if($type==0){
		$type=2;
		AlerteSecuriteInscriptionSU();
	}
}

if(existe_Log($login) == true){
	header("location: ../index.php?page=inscription&erreur=1");
}else{
	if($pass != $pass2){
		header("location: ../index.php?page=inscription&erreur=2");
	}else{
		$date = AfficheDate();
		$repertoirePersonnel = chaineAleatoire().recupererDatePourNouveauRepertoireUtilisateur();
		$id_utilisateur = inscriptionSite($login,$pass,$repertoirePersonnel,$email,$type,$date);
		//------------------------------------
		//creations des répertoires personnels
		creerRepertoiresUtilisateur($repertoirePersonnel);
		//------------------------------------
		session_register("id_utilisateur");
		$_SESSION['id_utilisateur']=$id_utilisateur;
		$_SESSION['identifiant']=$_POST['identifiant'];
		$_SESSION['type_compte']=$type;
		$_SESSION['NoFailleOnLine']=TRUE;
		header("location: ../index.php?page=compte&lecture=1");
	}
}
