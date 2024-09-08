<?php

// ---- Fonction permettant de changer tout caractère accentué par son équivalent non accentué
function sansAccents($Texte) {
	$accents = array("À","Á","Â","Ã","Ä","Å","à","á","â","ã","ä","å","Ò","Ó","Ô","Õ","Ö","Ø","ò","ó","ô","õ","ö","ø","È","É",
	"Ê","Ë","è","é","ê","ë","Ç","ç","Ì","Í","Î","Ï","ì","í","î","ï","Ù","Ú","Û","Ü","ù","ú","û","ü","ÿ","Ñ","ñ",
	"'"," ","&");
	$noaccents = array
("A","A","A","A","A","A","a","a","a","a","a","a","O","O","O","O","O","O","o","o","o","o","o","o","E","E",
	"E","E","e","e","e","e","C","c","I","I","I","I","i","i","i","i","U","U","U","U","u","u","u","u","y","N","n",
	"_","_","_");
	
	$Texte = str_replace( $accents,$noaccents,$Texte);
 	return $Texte;
}

function chaineAleatoire(){
	$base = 'abcdefghijklmnopqrstuvwxyz0123456789';
	$chaine = '';
	for($i=0 ; $i<5 ; $i++){
		$chaine .= $base[rand(0,35)];
	}
	return $chaine;
}

function fp_addslashes ($T) {
	if (get_magic_quotes_gpc() == 1) return $T;
	else return addslashes($T);
}

function  fp_stripslashes($T) {
	if (get_magic_quotes_gpc() == 1) return stripslashes($T);
	else return $T;
}

function check_ChaineDeCaracteresUpload($chaine){
	connectionBDD();
	$chaine = fp_stripslashes($chaine);
	if (function_exists('mysql_real_escape_string')) {
		$chaine = mysql_real_escape_string($chaine);
 	} elseif (function_exists('mysql_escape_string')) {
		$chaine = mysql_escape_string($chaine);
	} else {
		$chaine = fp_addslashes($chaine);
	}
	mysql_close();
	return $chaine;
	
}
function check_ChaineDeCaracteresUpload_OnLine($chaine){
	$chaine = fp_stripslashes($chaine);
	if (function_exists('mysql_real_escape_string')) {
		$chaine = mysql_real_escape_string($chaine);
 	} elseif (function_exists('mysql_escape_string')) {
		$chaine = mysql_escape_string($chaine);
	} else {
		$chaine = fp_addslashes($chaine);
	}
	return $chaine;
	
}

function check_ChaineDeCaracteresDownload($chaine){
	if (get_magic_quotes_gpc() == 1){
		return stripslashes($chaine);
	}else{
		return $chaine;
	}
}

function remplacerAccents($chaine){
	$chaine = str_replace('é','&eacute;',$chaine);
	$chaine = str_replace('è','&egrave;',$chaine);
	$chaine = str_replace('ë','&euml;',$chaine);
	$chaine = str_replace('à','&agrave;',$chaine);
	$chaine = str_replace('î','&icirc;',$chaine);
	$chaine = str_replace('ï','&iuml;',$chaine);
	$chaine = str_replace('ù','&ugrave;',$chaine);
	$chaine = str_replace('ü','&uuml;',$chaine);
	$chaine = str_replace('É','&Eacute;',$chaine);
	$chaine = str_replace('È','&Egrave;',$chaine);
	$chaine = str_replace('Ë','&Euml;',$chaine);
	$chaine = str_replace('À','&Agrave;',$chaine);
	$chaine = str_replace('Î','&Icirc;',$chaine);
	$chaine = str_replace('Ï','&Iuml;',$chaine);
	$chaine = str_replace('Ù','&Ugrave;',$chaine);
	$chaine = str_replace('Ü','&Uuml;',$chaine);
	return $chaine;
}

function HTML_ChaineDeCaracteres($chaine){
	return (htmlspecialchars($chaine,ENT_QUOTES));
}
function fp_htmlok($T) {
	return htmlentities($T);
}
function remplacerGuillemets($chaine){
	$chaine = str_replace("'","&#39;",$chaine);
	$chaine = str_replace('"','&quot;',$chaine);
	return $chaine;
}
function correctionAdresseInterWeb($chaine){
	$sousChaine = substr($chaine, 0, 7);
	if($sousChaine == "http://"){
		return $chaine;
	}else{
		return "http://".$chaine;
	}
}
function ajoutBaliseHREFText($chaine){
	//ATTENTION: fct° récursive ! Et c'est ma mimine qui la fait !
	$a = strpos($chaine,"http://",0);
	if($a){
	$b = strpos($chaine," ",$a);
	if(!$b){
		$b = strlen($chaine);
	}
	$z = $b-$a;
	$c = substr($chaine,$a,$z);
	$d = substr($chaine,0,$a);
	$y = strlen($chaine);
	$x = $y-$b;
	$e = substr($chaine,$b,$x);
	$w = strlen($c);
	$chaine = $d."<a href='{$c}'>".$c."</a>".ajoutBaliseHREFText($e);
	return $chaine;
	}else{
	return $chaine;
	}
}

function conversionEtOrdonancementMemoire($debut,$fin,$debut_pic,$fin_pic){
	$comparaison_memoire = $fin - $debut;
	$comparaison_pic = $fin_pic = $debut_pic;
	$conparaison_memoire = invertionComplexeTexteFormat($comparaison_memoire);
	$conparaison_pic = invertionComplexeTexteFormat($comparaison_pic);
	return "Zone Stable:" . lectureHumaineOctet($debut) . " / " . lectureHumaineOctet($fin) . " |  Zone instable:" . lectureHumaineOctet($debut_pic)
		 . " / " . lectureHumaineOctet($fin_pic) . " |__|-***^^''^^***-|__|  Consommation: . "
		 . lectureHumaineOctet($comparaison_memoire) . " / " . lectureHumaineOctet($comparaison_pic);
}

function surchargeHTML_testMemoire($text){
	$tab_text = explode(" |__|-***^^''^^***-|__| ",$tab_text[1]);
	return "<span style='float:left;'>" . $tab_text[0] . "</span>"
		."<span style='float:right;'>" . $tab_text[1] . "</span>";

}

function invertionComplexeTexteFormat($nombreAFormater){
	if ( $nombreAFormater < 0 ){
		$nombreAFormater *= -1;
	}
	return lectureHumaineOctet($nombreAFormater);
}

function lectureHumaineOctet($combien,$itx = 0){
	$tab_lecture = array('o', 'Ko', 'Mo' , 'Go' , 'To');
	$combien_temp = $combien;
	$lectureSup = round($combien /1024 , 3);
	if($lectureSup > 1000){
			$itx++;
			return lectureHumaineOctet($lectureSup,$itx);
	}else if($lectureSup < 0){
		return $combien_temp.$tab_lecture[$itx];
	}
	$itx++;
	return $lectureSup.$tab_lecture[$itx];
}

function testImageMp3Chaine($chaine){
	$positionMp3Chaine = strpos($chaine,"<div><object");
	$positionImageChaine = strpos($chaine,"<img");
	if( $positionMp3Chaine ){
		if( $positionImageChaine ){
			//je teste celle des deux qui est la première
			if($positionMp3Chaine < $positionImageChaine){
				$pos = strpos( $chaine , "</object></div>" , $positionMp3Chaine);
				if($pos == FALSE){
					return TRUE;
				}else{
					return FALSE;
				}
			}else{
				$pos = strpos( $chaine, "/>" , $positionImage );
				if($pos == FALSE){
					return TRUE;
				}else{
					return FALSE;
				}
			}
		}else{
			//je teste le mp3 car c'est le seul
			$pos = strpos( $chaine , "</object></div>" , $positionMp3Chaine);
			if($pos == FALSE){
				return TRUE;
			}else{
				return FALSE;
			}
		}
	//je teste l'image parce que le mp3 n'existe pas...
	}else if( $positionImageChaine ){
		$pos = strpos( $chaine, "/>" , $positionImageChaine );
		if($pos == FALSE){
			return TRUE;
		}else{
			return FALSE;
		}
	}else{
		return FALSE;
	}
}
function positionFinImageMp3Chaine($chaine){
	$positionMp3Chaine = strpos($chaine,"<div><object");
	$positionImageChaine = strpos($chaine,"<img");
	if( $positionMp3Chaine ){
		if( $positionImageChaine ){
			//je teste celle des deux qui est la première
			if($positionMp3Chaine < $positionImageChaine){
				$pos = strpos( $chaine , "</object></div>" , $positionMp3Chaine);
				return $pos+15;
			}else{
				$pos = strpos( $chaine, "/>" , $positionImageChaine );
				return $pos+2;
			}
		}else{
			//je teste le mp3 car c'est le seul
			$pos = strpos( $chaine , "</object></div>" , $positionMp3Chaine);
			return $pos+15;
		}
	//je teste l'image parce que le mp3 n'existe pas...
	}else{
		$pos = strpos( $chaine, "/>" , $positionImageChaine );
		return $pos+2;
	}
}