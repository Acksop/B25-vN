<?php

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
	//$key = '(B25)-Besancon25';
	$key = 'xpress-crypto';
	
	/* Intialise le chiffrement */
	@mcrypt_generic_init($td, $key, $iv);
	
	/* Encrypte */
	$encrypted = @mcrypt_generic( $td , $data );
	
	/* Libère le gestionnaire de chiffrement */
	mcrypt_generic_deinit($td);
	mcrypt_module_close($td);
	return rtrim($encrypted,'\0');

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
	//$key = '(B25)-Besancon25';
	$key = 'xpress-crypto';
	
	/* Intialise le chiffrement */
	@mcrypt_generic_init($td, $key, $iv);
	
	/* Decrypte */
	$decrypted = @mdecrypt_generic( $td , $data );
	
	/* Libère le gestionnaire de chiffrement */
	mcrypt_generic_deinit($td);
	mcrypt_module_close($td);
	
	return $decrypted;

//return utf8_decode($data);
}