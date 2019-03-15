<?php

if(DEV_verificationINCLUSIONS){
	$page = explode("/",__FILE__);
	$fichier_inclus = array_pop($page);
	echo $fichier_inclus." >>> OK!";
	}



function encrypter_generique($data){
	if ($data === ''){
		return '';
	}
	/* Charge un chiffrement */
	$td = mcrypt_module_open(MCRYPT_XTEA, '', 'ofb', '');
	
	/* Crée le VI et détermine la taille de la clé */
	//$iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
	$iv = '02500250';
	
	/* Crée la clé */
	$key = '(B25)-Besancon25';
	
	/* Intialise le chiffrement */
	mcrypt_generic_init($td, $key, $iv);
	
	/* Encrypte */
	$encrypted = mcrypt_generic( $td , $data );
	
	/* Libère le gestionnaire de chiffrement */
	mcrypt_generic_deinit($td);
	mcrypt_module_close($td);
	return rtrim($encrypted,"\0");

//return utf8_encode($data);
}
function decrypter_generique($data){
	if ($data === ''){
		return '';
	}
	/* Charge un chiffrement */
	$td = mcrypt_module_open(MCRYPT_XTEA, '', 'ofb', '');
	
	/* Crée le VI et détermine la taille de la clé */
	//$iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
	$iv = '02500250';
	
	/* Crée la clé */
	$key = '(B25)-Besancon25';
	
	/* Intialise le chiffrement */
	mcrypt_generic_init($td, $key, $iv);
	
	/* Decrypte */
	$decrypted = mdecrypt_generic( $td , $data );
	
	/* Libère le gestionnaire de chiffrement */
	mcrypt_generic_deinit($td);
	mcrypt_module_close($td);
	
	return $decrypted;

//return utf8_decode($data);
}

function decrypter_Cesar($aDeCrypter,$decalage){
$decalage = (36+$decalage)%36;
//echo $decalage."   |";
$caracteres = "1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ";
$aDeCrypter = strtoupper($aDeCrypter);
$tab_code = preg_split('//',$aDeCrypter, -1,PREG_SPLIT_NO_EMPTY);
$PassPhrase = '';
	foreach($tab_code as $elmt){
		$position = strpos($caracteres,$elmt);
		$new_pos = ($position+$decalage)%36;
		$PassPhrase .= substr($caracteres,$new_pos,1);
	}
	return $PassPhrase;
}
function encrypter_Cesar($aCrypter,$decalage){
$decalage = 36 - (36+$decalage)%36;
//echo $decalage."   |";
$caracteres = "1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ";
$aCrypter = strtoupper($aCrypter);
$tab_code = preg_split('//',$aCrypter, -1,PREG_SPLIT_NO_EMPTY);
$PassPhrase = '';
	foreach($tab_code as $elmt){
		$position = strpos($caracteres,$elmt);
		$new_pos = ($position+$decalage)%36;
		$PassPhrase .= substr($caracteres,$new_pos,1);
	}
	return $PassPhrase;
}
function invertionCaracteres($chaine){
	$chaine_tab = preg_split('//',$chaine, -1,PREG_SPLIT_NO_EMPTY);
	$taille_chaine = count($chaine_tab)-1;
	$chaine_inv = '';
	//echo "passe".$taille_chaine;
	for($i = $taille_chaine ; $i >= 0 ; $i--){
		$chaine_inv .= $chaine_tab[$i];
	}
	return $chaine_inv;
}
function expulserDernierElement($tab){
	$taille = count($tab);
	$nouveau_tab = array();
	for($itx = 0 ; $itx < $taille-1 ; $itx++){
		$nouveau_tab[] = $tab[$itx];
		//echo "i:".$itx;
	}
	return $nouveau_tab;
}
function expulserPremierElement($tab){
	$taille = count($tab);
	$nouveau_tab = array();
	for($itx = 1 ; $itx < $taille ; $itx++){
		$nouveau_tab[] = $tab[$itx];
		//echo "i:".$itx;
	}
	return $nouveau_tab;
}
function transformerChaineEnTableau($ChaineCaracteres){
	return preg_split('//',$ChaineCaracteres, -1,PREG_SPLIT_NO_EMPTY);
}
function transformerTableauEnChaine($tableau){
	$chaine = "";
	foreach($tableau as $element){
		$chaine .= $element;
	}
	return $chaine;
}
function encrypterCleMapDialogue($ip , $time , $token){
	$time_inv = invertionCaracteres($time);
	$ip_en_chiffre_acoller = explode('.',$ip);
	$dimension_ip = strlen($ip_en_chiffre_acoller[0])."".strlen($ip_en_chiffre_acoller[1])."".strlen($ip_en_chiffre_acoller[2])."".strlen($ip_en_chiffre_acoller[3]);
	$dimension_ip_inv = invertionCaracteres($dimension_ip);
	$ip_en_chiffre_acoller = implode($ip_en_chiffre_acoller);
	$ip_inv = invertionCaracteres($ip_en_chiffre_acoller);
	$ip_tab_inv = preg_split('//',$ip_inv, -1,PREG_SPLIT_NO_EMPTY);
	$time_tab_inv = preg_split('//',$time_inv, -1,PREG_SPLIT_NO_EMPTY);
	$taille_ip = count($ip_tab_inv);
	$taille_time = count($time_tab_inv);
	$clemap = '';
	for($i = 0; ($i < $taille_ip || $i < $taille_time) ; $i++){
		if($ip_tab_inv != NULL && $time_tab_inv != NULL ){
		$clemap .= $ip_tab_inv[0].$time_tab_inv[0];
		$ip_tab_inv = expulserPremierElement($ip_tab_inv);
		$time_tab_inv = expulserPremierElement($time_tab_inv);
		}else if ($ip_tab_inv == NULL){
		$clemap .= $time_tab_inv[0];
		$time_tab_inv = expulserPremierElement($time_tab_inv);
		}else{
		$clemap .= $ip_tab_inv[0];
		$ip_tab_inv = expulserPremierElement($ip_tab_inv);
		}
	}
	$clemap .= $token;
	$clemap = $dimension_ip.$clemap;
	$taille_caracteres_itx = preg_split('//',$taille_ip, -1,PREG_SPLIT_NO_EMPTY);
	$cleFibonacci = '';
	do{
		$temp = count($taille_caracteres_itx);
		$cleFibonacci .= $temp;
		$taille_caracteres_itx = preg_split('//',$temp, -1,PREG_SPLIT_NO_EMPTY);
	}while ($temp != 1);
	$cleFibonacci_time = $cleFibonacci;
	$clemap .= $taille_time.$cleFibonacci_time;
	$clemap_encrypt = encrypter_Cesar($clemap,4);
	
	return $clemap_encrypt;
}

function decrypterCleMapDialogue($clemap_encrypt , $token){
	$decrypt_clemap = decrypter_Cesar($clemap_encrypt,4);
	$decrypt_ip_dimension = array();
	$decrypt_ip_dimension[] = substr($decrypt_clemap, 0, 1);
	$decrypt_ip_dimension[] = substr($decrypt_clemap, 1, 1);
	$decrypt_ip_dimension[] = substr($decrypt_clemap, 2, 1);
	$decrypt_ip_dimension[] = substr($decrypt_clemap, 3, 1);
	$decrypt_taille_ip = $decrypt_ip_dimension[0]+$decrypt_ip_dimension[1]+$decrypt_ip_dimension[2]+$decrypt_ip_dimension[3];
	$decryp_ip_dimension = implode($decrypt_ip_dimension);
	$decrypt_time_dimension = array();
	$decrypt_time_dimension[] = substr($decrypt_clemap, -1, 1);
	$debut_decrypt_time_dimension = -1;
	$derniereOccurence = count($decrypt_time_dimension) - 1;
	do{
		$decrypt_time_dimension[] = substr($decrypt_clemap, $debut_decrypt_time_dimension, (int)$decrypt_time_dimension[$derniereOccurence]);
		$derniereOccurence = count($decrypt_time_dimension) - 1;
		$debut_decrypt_time_dimension -= $decrypt_time_dimension[$derniereOccurence];
		
	}while(strrpos($decrypt_time_dimension[$derniereOccurence],$token) === false);
	$bonneOccurence = count($decrypt_time_dimension) - 2;
	$decrypt_time_dimension = $decrypt_time_dimension[$bonneOccurence];
	$decrypt_clemap = substr($decrypt_clemap,4);
	$decrypt_taille_clemap = (int)$decrypt_taille_ip+$decrypt_time_dimension;
	$decrypt_clemap_unique = substr($decrypt_clemap , 0 , $decrypt_taille_clemap);
	$decrypt_clemap_tab = preg_split('//',$decrypt_clemap_unique, -1,PREG_SPLIT_NO_EMPTY);
	$decrypt_ip = "";
	$decrypt_time = "";
	for($i = 0; ($i < $decrypt_taille_ip && $i < $decrypt_time_dimension) ; $i++){
		$decrypt_ip .= $decrypt_clemap_tab[0];
		$decrypt_time .= $decrypt_clemap_tab[1];
		$decrypt_clemap_tab = expulserPremierElement($decrypt_clemap_tab);
		$decrypt_clemap_tab = expulserPremierElement($decrypt_clemap_tab);
	}
	if ($decrypt_time_dimension > $decrypt_taille_ip){
		$decrypt_time .= implode($decrypt_clemap_tab);
	}else{
		$decrypt_ip .= implode($decrypt_clemap_tab);
	}
	$decrypt_time = invertionCaracteres($decrypt_time);
	$decrypt_ip = invertionCaracteres($decrypt_ip);
	$decrypt_ip_complete = "";
	$temp = 0;
	$decrypt_ip_complete .= substr($decrypt_ip,$temp,$decrypt_ip_dimension[0]);
	$temp += $decrypt_ip_dimension[0];
	$decrypt_ip_complete .= ".".substr($decrypt_ip,$temp,$decrypt_ip_dimension[1]);
	$temp += $decrypt_ip_dimension[1];
	$decrypt_ip_complete .= ".".substr($decrypt_ip,$temp,$decrypt_ip_dimension[2]);
	$temp += $decrypt_ip_dimension[2];
	$decrypt_ip_complete .= ".".substr($decrypt_ip,$temp,$decrypt_ip_dimension[3]);
	$tab_retour = Array($decrypt_time ,$decrypt_ip_complete);
	return $tab_retour;
}

function encoder_block($chaine, $taille_blocks){
	$clemap_tab = preg_split('//',$chaine, -1,PREG_SPLIT_NO_EMPTY);
	$taille_tab = count($clemap_tab);
	$final_clemap_encrypt = "";
	$i = 0;
	do{
		$final_clemap_encrypt .= $clemap_tab[$i];
		if ($i % $taille_blocks == 0){
			$final_clemap_encrypt .= ' ';
		}
		$i++;
	}while ( $i < $taille_tab );
	return $final_clemap_encrypt;
}

function decoder_block($chaine){
	$final_clemap_encrypt_no_block = "";

	//enlever les block de 5
	$decrypt_clemap_tab = preg_split('//',$chaine, -1,PREG_SPLIT_NO_EMPTY);
	$taille_tab = count($decrypt_clemap_tab);
	$i = 0;
	do{
		if ($decrypt_clemap_tab[$i] !== ' '){
		$final_clemap_encrypt_no_block .= $decrypt_clemap_tab[$i];
		}
		$i++;
	}while ( $i < $taille_tab );
	
	return $final_clemap_encrypt_no_block;
}