<?php

function listerContenuRepertoireImageArticle($NomRepertoire){
	$Repertoire = @opendir($NomRepertoire);
	if (! $Repertoire) exit("Erreur dans l'ouverture du répertoire");

	//--- boucle de lecture ------------------------------------
	while ($Fichier = @readdir($Repertoire)) {
	  if ($Fichier == '.' || $Fichier == '..') continue;
	  echo "<option>".$Fichier."</option>";
	}
	//--- fermeture du répertoire -----------------------------
	@closeDir($Repertoire);
}
function supprimerRepertoire($Rep) {
  if (!@is_dir($Rep)) return false;
  //--- lecture du répertoire 
  $Pointeur = @opendir($Rep);
  while (false!==($Fichier = readdir($Pointeur))) {
    if($Fichier=='.'||$Fichier=='..') continue;
      
    $Element = $Rep.'/'.$Fichier;
    //--- si répertoire appel récursif
    //--- si fichier suppression
    if(@is_dir($Element)) supprimerRepertoire($Element); 
    else @unlink($Element);
  }

  @closeDir($Pointeur);	
  return @rmdir($Rep);
}
function creerRepertoiresUtilisateur($nomRep){
	//chmod("../upload_utilisateurs/", 0777);
	$repertoire_utilisateur = SVNRADIEURAE_DIR."upload_utilisateurs/".$nomRep;
	$mode = 1777;
	mkdir($repertoire_utilisateur,$mode);
	chmod($repertoire_utilisateur, 0755);
	mkdir($repertoire_utilisateur."/images/",$mode);
	chmod($repertoire_utilisateur."/images/", 0755);
	mkdir($repertoire_utilisateur."/musiques/",$mode);
	chmod($repertoire_utilisateur."/musiques/", 0755);
	mkdir($repertoire_utilisateur."/images/originals/",$mode);
	chmod($repertoire_utilisateur."/images/originals/", 0755);
	//chmod("../upload_utilisateurs/", 0755);
}
function recreerRepertoiresUtilisateur($nomRep){
	$repertoire_utilisateur = "../../upload_utilisateurs/".$nomRep;
	$rep1 = $repertoire_utilisateur."/images/";
	$rep2 = $repertoire_utilisateur."/musiques/";
	$rep3 = $repertoire_utilisateur."/images/originals/";
	$mode = 0777;
	if (!@is_dir($repertoire_utilisateur)) @mkdir($repertoire_utilisateur,$mode);
	if (!@is_dir($rep1)) @mkdir($rep1,$mode);
	if (!@is_dir($rep2)) @mkdir($rep2,$mode);
	if (!@is_dir($rep3)) @mkdir($rep3,$mode);
	return;
}
function supprimerRepertoiresUtilisateur($nomRep){
	$repertoire_utilisateur = "../upload_utilisateurs/".$nomRep."/";
	supprimerRepertoire($repertoire_utilisateur);
}

function afficheDroitDossierUtilisateur($directory){
	$perms = fileperms($directory);  
	 
	if (($perms & 0xC000) == 0xC000) { 
	   // Socket
	   $info = 's';  
	} elseif (($perms & 0xA000) == 0xA000) { 
	   // Lien symbolique
	   $info = 'l';  
	} elseif (($perms & 0x8000) == 0x8000) { 
	   // Régulier
	   $info = '-';  
	} elseif (($perms & 0x6000) == 0x6000) { 
	   // Block special
	   $info = 'b';  
	} elseif (($perms & 0x4000) == 0x4000) { 
	   // Dossier
	   $info = 'd';  
	} elseif (($perms & 0x2000) == 0x2000) { 
	   // Caractère spécial
	   $info = 'c';  
	} elseif (($perms & 0x1000) == 0x1000) { 
	   // pipe FIFO
	   $info = 'p';  
	} else { 
	   // Inconnu
	   $info = 'u';  
	}  
	 
	// Autres
	$info .= (($perms & 0x0100) ? 'r' : '-');  
	$info .= (($perms & 0x0080) ? 'w' : '-');  
	$info .= (($perms & 0x0040) ? 
	         (($perms & 0x0800) ? 's' : 'x' ) : 
	         (($perms & 0x0800) ? 'S' : '-'));  
	 
	// Groupe
	$info .= (($perms & 0x0020) ? 'r' : '-');  
	$info .= (($perms & 0x0010) ? 'w' : '-');  
	$info .= (($perms & 0x0008) ? 
	         (($perms & 0x0400) ? 's' : 'x' ) : 
	         (($perms & 0x0400) ? 'S' : '-'));  
	 
	// Tout le monde
	$info .= (($perms & 0x0004) ? 'r' : '-');  
	$info .= (($perms & 0x0002) ? 'w' : '-');  
	$info .= (($perms & 0x0001) ? 
	         (($perms & 0x0200) ? 't' : 'x' ) : 
	         (($perms & 0x0200) ? 'T' : '-'));  
	 
	return $info;  

}

?>
