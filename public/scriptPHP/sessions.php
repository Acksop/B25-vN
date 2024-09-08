<?php
include_once("connectionBDD.php");

function existe_Log($login){

	$login = addslashes($login);
	$resultat = faireUneRequeteOffLine("SELECT pseudo FROM utilisateur WHERE pseudo = '".$login."'");
	if(mysql_num_rows($resultat) == 0){
		$existe = false;
	}else{
		$existe = true;
	}
	return $existe;

}

function updateDerniereSession($id_utilisateur){
	$resultat = faireUneRequeteOffLine("SELECT nbConnexions FROM utilisateur WHERE id_utilisateur = '$id_utilisateur'");
	$data = mysql_fetch_row($resultat);
	$cpt = $data[0] + 1 ;
	$date = recupererTimeStampCourant();
	$resultat = faireUneRequeteOffLine("UPDATE utilisateur SET nbConnexions='$cpt',dateDerniereConnexion='$date' WHERE id_utilisateur = '$id_utilisateur'");
	return ;
}

function rechercherUtilisateur($login,$pass){

	$login = addslashes($login);
	$pass = addslashes($pass);
	$resultat = faireUneRequeteOffLine("SELECT id_utilisateur,statut FROM utilisateur WHERE pseudo = '".$login."' AND password = '".$pass."'");
	if(mysql_num_rows($resultat) == 0){
		$usr_id=-1;
	}else{
		$tableauReponse = mysql_fetch_assoc($resultat);
		if($tableauReponse['statut'] == 3){
			$usr_id = -2;
		} elseif ($tableauReponse['statut'] == 4){
			$usr_id = -3;
		} elseif ($tableauReponse['statut'] == 5){
			$usr_id = -4;
		} else {
			$usr_id = $tableauReponse['id_utilisateur'];
		}
	}
	return $usr_id;
	
}

function rechercherRepertoire($id){
	$sql = "SELECT repertoirePersonnel FROM utilisateur WHERE id_utilisateur = '".$id."'";
	$req = faireUneRequeteOffLine($sql);
	$data = mysql_fetch_row($req);
	return $data[0];
}

function rechercherTypeDeCompte($id){

	$sql = "SELECT type_compte FROM utilisateur WHERE id_utilisateur='".$id."'"; 
	$req = faireUneRequeteOffLine($sql);
	$tableauReponse = mysql_fetch_row($req);
	return $tableauReponse[0];

}

function rechercherStatusCompte($id){

	$sql = "SELECT statut FROM utilisateur WHERE id_utilisateur='".$id."'";
	$req = faireUneRequeteOffLine($sql);
	$tableauReponse = mysql_fetch_row($req);
	return $tableauReponse[0];

}

function check_session(){

	if(!isset($_SESSION['id_utilisateur'])){
		if($_SESSION['NoFailleOnLine']==FALSE){
			header("location: index.php");
		}
	}

}
function check_admin_session(){

	if(!isset($_SESSION['id_utilisateur'])){
		if($_SESSION['type_compte']!=0){
			header("location: index.php?page=erreurH4x0R");
		}
		if($_SESSION['NoFailleOnLine']==FALSE){
			header("location: index.php");
		}
	}

}
function deconnection_session(){

	//destruction de toutes les variables de sessions
	session_unset();
	$_SESSION['NoFailleOnLine']=FALSE;
	//destruction de la session
	session_destroy();
	
}
?>
