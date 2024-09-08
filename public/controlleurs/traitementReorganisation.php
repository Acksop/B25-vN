<?php

include("../scriptPHP/connectionBDD.php");

function recuperationIDassociation($id_utilisateur){
$sql = "SELECT id_association FROM associations WHERE id_utilisateur = '".$id_utilisateur."'";
$req = faireUneRequeteOnline($sql);
$data = mysql_fetch_row($req);
return $data[0];
}

function recuperationIDartiste($id_utilisateur){
$sql = "SELECT id_artiste FROM artistes WHERE id_utilisateur = '".$id_utilisateur."'";
$req = faireUneRequeteOnline($sql);
$data = mysql_fetch_row($req);
return $data[0];
}

function recuperationIDjournaliste($id_utilisateur){
$sql = "SELECT id_journaliste FROM journalistes WHERE id_utilisateur = '".$id_utilisateur."'";
$req = faireUneRequeteOnline($sql);
$data = mysql_fetch_row($req);
return $data[0];
}

function recuperationIDarticles($id_utilisateur){
$sql = "SELECT id_article FROM articles WHERE id_utilisateur = '".$id_utilisateur."'";
$req = faireUneRequeteOnline($sql);
return $req;
}

function recuperationIDarticlesEnValidations($id_utilisateur){
$sql = "SELECT id_article FROM articlesEnValidations WHERE id_utilisateur = '".$id_utilisateur."'";
$req = faireUneRequeteOnline($sql);
return $req;
}

function recuperationIDdossiers($id_utilisateur){
$sql = "SELECT id_dossier FROM dossiers WHERE id_utilisateur = '".$id_utilisateur."'";
$req = faireUneRequeteOnline($sql);
return $req;
}

function recuperationIDdossiersEnValidations($id_utilisateur){
$sql = "SELECT id_dossier FROM dossiersEnValidations WHERE id_utilisateur = '".$id_utilisateur."'";
$req = faireUneRequeteOnline($sql);
return $req;
}

function modifierIDsutilisateur($id_utilisateur,$type_compte,$nouvel_id){
	switch($type_compte){
		case 0:
			//echo "no way;";
		break;
		case 1:
			$id_temp = recuperationIDjournaliste($id_utilisateur);
			$sql = "UPDATE journalistes SET id_utilisateur = '".$nouvel_id."' WHERE id_journaliste='".$id_temp."'";
			$id_temp = recuperationIDarticles($id_utilisateur);
			while($data = mysql_fetch_row($id_temp)){
				$sql2 = "UPDATE articles SET id_utilisateur= '".$nouvel_id."' WHERE id_article='".$data[0]."'";
				faireUneRequeteOnLine($sql2);
			}
			$id_temp = recuperationIDarticlesEnValidations($id_utilisateur);
			while($data = mysql_fetch_row($id_temp)){
				$sql3 = "UPDATE articlesEnValidations SET id_utilisateur= '".$nouvel_id."' WHERE id_article='".$data[0]."'";
				faireUneRequeteOnLine($sql3);
			}
			$id_temp = recuperationIDdossiers($id_utilisateur);
			while($data = mysql_fetch_row($id_temp)){
				$sql4 = "UPDATE dossiers SET id_utilisateur= '".$nouvel_id."' WHERE id_dossier='".$data[0]."'";
				faireUneRequeteOnLine($sql4);
			}
			$id_temp = recuperationIDdossiersEnValidations($id_utilisateur);
			while($data = mysql_fetch_row($id_temp)){
				$sql5 = "UPDATE dossiersEnValidation SET id_utilisateur= '".$nouvel_id."' WHERE id_dossier='".$data[0]."'";
				faireUneRequeteOnLine($sql5);
			}
			faireUneRequeteOnLine($sql);
		break;
		case 2:
		case 4:
			$id_temp = recuperationIDartiste($id_utilisateur);
			$sql = "UPDATE artistes SET id_utilisateur = '".$nouvel_id."' WHERE id_artiste='".$id_temp."'";
			faireUneRequeteOnLine($sql);
		break;
		case 3:
		case 5:
			$id_temp = recuperationIDassociation($id_utilisateur);
			$sql = "UPDATE associations SET id_utilisateur = '".$nouvel_id."' WHERE id_association='".$id_temp."'";
			faireUneRequeteOnLine($sql);
		break;
	}
	return(0);
}


function reorganisationUtilisateurs(){
	$id_2_base = recuperationIDBase();
	connectionBDD();
	$sql = "DELETE FROM dossiersTemporaires";
	$sql0 = "DELETE FROM utilisateur";
	$sql1 = "SELECT * FROM utilisateur WHERE id_utilisateur < '".$id_2_base."' ORDER BY id_utilisateur ASC";
	$sql2 = "SELECT * FROM utilisateur WHERE id_utilisateur > '".$id_2_base."' ORDER BY id_utilisateur ASC";
	$sql3 = "SELECT * FROM utilisateur WHERE id_utilisateur = '".$id_2_base."'";
	faireUneRequeteOnLine($sql);
	$req1 = faireUneRequeteOnLine($sql1);
	$req2 = faireUneRequeteOnLine($sql2);
	$req3 = faireUneRequeteOnLine($sql3);
	faireUneRequeteOnLine($sql0);
	$i = 1;
	while ($data = mysql_fetch_assoc($req1)){
		$sqlFinal = "INSERT INTO utilisateur VALUES( "
			."'".$i."',"
			."'".check_ChaineDeCaracteresUpload_OnLine(check_ChaineDeCaracteresDownload($data['pseudo']))."',"
			."'".check_ChaineDeCaracteresUpload_OnLine(check_ChaineDeCaracteresDownload($data['password']))."',"
			."'".$data['dateInscription']."',"
			."'".$data['dateDerniereConnexion']."',"
			."'".$data['nbConnexions']."',"
			."'".$data['type_compte']."',"
			."'".$data['statut']."')";
		modifierIDsUtilisateur($data['id_utilisateur'],$data['type_compte'],$i);
		faireUneRequeteOnLine($sqlFinal);
		$i++;
	}
	while ( $data = mysql_fetch_assoc($req2)){
		$sqlFinal = "INSERT INTO utilisateur VALUES( "
			."'".$i."',"
			."'".check_ChaineDeCaracteresUpload_OnLine(check_ChaineDeCaracteresDownload($data['pseudo']))."',"
			."'".check_ChaineDeCaracteresUpload_OnLine(check_ChaineDeCaracteresDownload($data['password']))."',"
			."'".$data['dateInscription']."',"
			."'".$data['dateDerniereConnexion']."',"
			."'".$data['nbConnexions']."',"
			."'".$data['type_compte']."',"
			."'".$data['statut']."')";
		modifierIDsUtilisateur($data['id_utilisateur'],$data['type_compte'],$i);
		faireUneRequeteOnLine($sqlFinal);
		$i++;
	}
	$alea = rand(0,2);
	$data = mysql_fetch_assoc($req3);
	modifierIDsUtilisateur($data['id_utilisateur'],1,$i);
	modifierIDsUtilisateur($data['id_utilisateur'],2,$i);
	modifierIDsUtilisateur($data['id_utilisateur'],3,$i);
	switch ($data['type_compte']){
		case 0:
			 //Le compte de TEST est super-utilisateur No--WAY , théoriquement impossible
		break;
		case 1: //journaliste
		$sqlFinal = "INSERT INTO utilisateur VALUES('".$i."','','','19 janvier 2038 3:14:07 GMT','0000-00-00 00:00:00', '0','2','".$alea."')";
		break;
		case 2: //artiste
		$sqlFinal = "INSERT INTO utilisateur VALUES('".$i."','','','19 janvier 2038 3:14:07 GMT','0000-00-00 00:00:00','0','3','".$alea."')";
		break;
		case 3: //association
		$sqlFinal = "INSERT INTO utilisateur VALUES('".$i."','','','19 janvier 2038 3:14:07 GMT','0000-00-00 00:00:00','0','4','".$alea."')";
		break;
		case 4: //artisans
		$sqlFinal = "INSERT INTO utilisateur VALUES('".$i."','','','19 janvier 2038 3:14:07 GMT','0000-00-00 00:00:00','0','5','".$alea."')";
		break;
		case 5: //groupe
		$sqlFinal = "INSERT INTO utilisateur VALUES('".$i."','','','19 janvier 2038 3:14:07 GMT','0000-00-00 00:00:00','0','1','".$alea."')";
		break;
		default: //Artiste
		$sqlFinal = "INSERT INTO utilisateur VALUES('".$i."','','','19 janvier 2038 3:14:07 GMT','0000-00-00 00:00:00','0','2','0')";
	}
	faireUneRequeteOnline($sqlFinal);
	mysql_close();
	return (0);
}
	session_start();
	reorganisationUtilisateurs();
	header("location: ../index.php?page=compte");
?>
