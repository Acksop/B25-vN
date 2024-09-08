<?php

function AlerteSecuriteBruteForce($pseudo,$mdp){
	// ip du client 
	$ip = $_SERVER['REMOTE_ADDR'];
	$sql = "INSERT INTO Alerte_H4X0R(type,date,IP1,IP2,compte) VALUES('1','".AfficheDate()."','$ip','$mdp','$pseudo')";
	faireUneRequeteOffLine($sql);
	return;
}

function AlerteSecuriteDLImage(){
	// ip du client 
	$ip = $_SERVER['REMOTE_ADDR'];
	$sql = "INSERT INTO Alerte_H4X0R(type,date,IP1,IP2,compte) VALUES('2','".AfficheDate()."','$ip','DL_Tweet_Image','$pseudo')";
	faireUneRequeteOffLine($sql);
	return;
}
function AlerteSecuriteAdresseForce(){
	//ip du client
	$ip = $_SERVER['REMOTE_ADDR'];
	$ipProxy = getenv("HTTP_X_FORWARDED_FOR");
	$sql = "INSERT INTO Alerte_H4X0R(type,date,IP1,IP2,compte) VALUES('3','".AfficheDate()."','$ip','$ipProxy','Tentative_Intrusion_PHP_page_var')";
	faireUneRequeteOffLine($sql);
	return;
}
function AlerteSecuriteAdresseAgile($page){
	//ip du client
	$ip = $_SERVER['REMOTE_ADDR'];
	$sql = "INSERT INTO Alerte_H4X0R(type,date,IP1,IP2,compte) VALUES('4','".AfficheDate()."','$ip','Tentative_Intrusion_PHP_page_article','$page')";
	faireUneRequeteOffLine($sql);
	return;
}
function AlerteSecuriteUpdateVideoConnexe($adresse,$compte){
	$sql = "INSERT INTO Alerte_H4X0R(type,date,IP1,IP2,compte) VALUES('5','".AfficheDate()."','$adresse','Erreur_Update_Video_connexe','$compte')";
	faireUneRequeteOffLine($sql);
}
function AlerteSecuriteInscriptionSU(){
	$ip = $_SERVER['REMOTE_ADDR'];
	$ipProxy = getenv("HTTP_X_FORWARDED_FOR");
	$sql = "INSERT INTO Alerte_H4X0R(type,date,IP1,IP2,compte) VALUES('6','".AfficheDate()."','$ip','$ipProxy','Tentative_Inscription_SuperUtilisateur')";
	faireUneRequeteOffLine($sql);
}

function incrementerTentativesConnection(){
	// ip du client 
	$ip = $_SERVER['REMOTE_ADDR'];
	// time actuel
	$time = time();
	// on recherche l'utilisateur 
	$result = faireUneRequeteOffLine("SELECT * FROM connectes WHERE ip='$ip'");
	$data = mysql_fetch_row($result);
	// on verifie que la dernière connection ne remonte pas cinq minutes
	$prochaineHeure = $data[1]+60*5;
	if( $time > $prochaineHeure ){
		$itx = 0;
	}else{
		// sinon on ajoute l'iteration
		$itx = $data[3];
		$itx++;
	}
	//mise a jour
        $result = faireUneRequeteOffLine("UPDATE connectes SET derniere='$time',tentativesConnection='$itx' WHERE ip='$ip'");
	return $itx;
}

?>
