<?php

global $header_title,$header_description,$header_identifier_url,$header_keywords;
$nom = recuperationNomAssociationOuGroupeFromIDAssociation($_GET['id']);
$description = recuperationDescriptionAssociationOuGroupeFromIDAssociation($_GET['id']);
$header_title = "Besan&ccedil;on 25 - Page publique de pr&eacute;sentation de l&apos;Association {$nom} ({$description}) sur la Plate-forme";
$header_description = "Pr&eacute;sentation de l&apos;Activit&eacute;: {$description} par l&apos;Association :{$nom} sur Besan&ccedil;on 25";
$header_identifier_url = "besancon25.fr/presentation_de_la_{$_GET['id']}eme_association";
$header_keywords = "Besan&ccedil;on, Besancon, 25000, 25, artisan, mur, pr&eacute;sentation, articles, prix, r&eacute;servation, r&eacute;servations, cr&eacute;ations, objets, art, r&eacute;alisations";


include_once("scriptPHP/easyGoogleMap/GoogleMap.php");
include_once("scriptPHP/easyGoogleMap/JSMin.php");

function LancerAffichageDuCorps(){

	global $adresseBDDGoogleMap;

	$MAP_OBJECT = new GoogleMapAPI();
	$MAP_OBJECT->_minify_js = isset($_REQUEST["min"])?FALSE:TRUE;
	$MAP_OBJECT->setDSN($adresseBDDGoogleMap);

	$id_association = $_GET['id'];
	$association = mysql_fetch_assoc(recuperationInfoAssoFromID($id_association));
	$liensAssociation = recuperationLiensWebAsso($id_association);
	$descriptif = mysql_fetch_assoc(recuperationDescriptifAsso($id_association));
	
	cadreAlignCentrerDebut();
	echo "<h1 style='margin: 0px 0px 0px 30px ;'>&laquo; <span style='color:#FFFFFF'> {$association['nom']} </span> &raquo;</h1>";
	echo "<p style='margin: 0px 0px 0px 75px ;'>{$association['adresse']}<br />{$association['codePostal']}&nbsp;&nbsp;&nbsp;{$association['ville']}<br /><b>tel:</b> {$association['telephone']}</p>";
	if($descriptif['logo'] != '' && $descriptif['descriptif'] != ''){
		
		echo "<span style='float:right; margin: 15px;'><img src='".SVNRADIEURAE_PATH.$descriptif['logo']."' alt='{$association['nom']}'/></span>";
		echo "{$descriptif['descriptif']}";
	}else{
		echo "<p class='utilisateurs'>Vous devez mettre un logo et une description pour pouvoir vous pr&eacute;senter.</p>";
	}
	cadreAlignCentrerFin();
	echo "<br /><br />";
	if(mysql_num_rows($liensAssociation) > 0){
		cadreAlignCentrerDebut();
		echo "<h3>Lien(s) Choisi(s) par {$association['nom']} </h3>";
			include_once('scriptPHP/simplehtmldom_1_5/simple_html_dom.php');
		while( $lien = mysql_fetch_row($liensAssociation)){
				//$titrePageExterieureB25 = recuperationTitrePageExterieure($lien[2]);
				$url = file_get_html($lien[2]);
				if($url === FALSE){
				 echo "<p style='float:left; padding: 5px; margin: 2px;' class='utilisateursInverse'>Le scan de ce lien HyperTexte est bloqu&eacute; (erreur HTTP dont l'admin du (B25) aimerais bien afficher le code) &lg;&lg;&lg; <a href='{$lien[2]}'>Voir la teneur de cette source?</a>";
				 continue;
				}
				$urltitre = $url->find('title',0);
				if(isset($urltitre)){
					$titrePageExterieureB25 = decoder_UTF8($urltitre->innertext);
				}else{
					$titrePageExterieureB25 = "";
				}
				$imagePageExterieureB25 = $url->find('img');
				//print_r($imagePageExterieureB25[0]);
				if(isset($imagePageExterieureB25[0])){
					$nb_images = count($imagePageExterieureB25);
					//print_r($imagePageExterieureB25);
	
					$parcours = genererParcoursAleatoire($nb_images);
					//print_r($parcours);
					//$num= $parcours[10];
					$i = 0;
					$j = 0;
					$tab_images = array();
					do{
						$num = $parcours[$i];
						$i++;
						if( $imagePageExterieureB25[$num]->alt != '' || ( $imagePageExterieureB25[$num]->heigth != '' && $imagePageExterieureB25[$num]->width != '' )){
							$tab_images[] = $num;
							$j++;
							if($j == 3){
								$flag = false;
							}else{
								$flag = true;
							}
						}else{
							$flag = true;
						}
					}while( $flag && $i < $nb_images);
		
					$addresseValideImagePageExterieure = array();
					for($i = 0 ; $i < count($tab_images) ; $i++){
						$addresseValideImagePageExterieure[] = trouverAddresseValidePageExterieure($imagePageExterieureB25[$tab_images[$i]]->src,$lien[2]);
					}
					$Hauteur = 75;
					for($i = 0 ; $i < count($tab_images) ; $i++){
						if($imagePageExterieureB25[$tab_images[$i]]->heigth != '' && $imagePageExterieureB25[$tab_images[$i]]->width != ''){
							$tab_largeur[] = $imagePageExterieureB25[$tab_images[$i]]->width * ($Hauteur/$imagePageExterieureB25[$tab_images[$i]]->heigth);
						}else{
							$tab_largeur[] = 100;
					}
					}
					echo "<p style='float:left; padding: 5px; margin: 2px;' class='utilisateursInverse'><a href='{$lien[2]}'>{$titrePageExterieureB25}</a>"
						."<span style='float:right; margin: 5px;'>";
					for($i = 0 ; $i < count($tab_images) ; $i++){	
						echo "<img style='margin:2px;' src='{$addresseValideImagePageExterieure[$i]}' width='{$tab_largeur[$i]}' height='{$Hauteur}' />";
					}
					echo "</span>";
				}
					echo "<br /><i><span style='color:#00AA00'>{$lien[2]}</span></i>"
					."<br />...".decouperChaine(decoder_UTF8(encoderPourSite($url->plaintext)),600)."...</p>";
			}
			
		cadreAlignCentrerFin();
	}
	echo "<br /><br />";
	cadreAlignCentrerDebut();
	echo "<center><br />";
	
	$adresse = utf8_encode(html_entity_decode($association['adresse'])).", ".utf8_encode(html_entity_decode($association['codePostal'])).", ".utf8_encode(html_entity_decode($association['ville']));
	//echo $adresse;
	$descriptionGoogle = "<p class='utilisateur'>{$association['nom']}<br />{$association['description']}<br />{$association['telephone']}<br />{$association['email']}<br />";
	$descriptionGoogle .= "</p>";
	//echo $descriptionGoogle;
	$MAP_OBJECT->addMarkerByAddress($adresse,"", $descriptionGoogle,"","","");
	
	$MAP_OBJECT->setHeight('250');
	$MAP_OBJECT->setWidth('900');
	$MAP_OBJECT->enableStreetViewControls();
	
	echo $MAP_OBJECT->getHeaderJS();
	echo $MAP_OBJECT->getMapJS();
	echo $MAP_OBJECT->printOnLoad();
	echo $MAP_OBJECT->printMap();
	//echo $MAP_OBJECT->printSidebar();
	echo "<br /></center>";
	cadreAlignCentrerFin();

}
function recuperationTitrePageExterieure($lien){
	
	libxml_use_internal_errors(true);

	$doc  = new DOMDocument();
	$doc->loadHTMLFile($lien);

	libxml_clear_errors();

	$title = $doc->getElementsByTagName('title');

	//BASE-CODE FROM http://www.php.net/manual/fr/domdocument.loadhtmlfile.php

	if (!is_null($title)) {
	  foreach ($title as $element) {
	    //echo "<br/>". $element->nodeName. " : ";

	    $nodes = $element->childNodes;

	    foreach ($nodes as $node) {
	      $tab_title[] = $node->nodeValue. "\n";
	    }
	  }
	}	
		return HTML_ChaineDeCaracteres(decoder_UTF8($tab_title[0]));

}
function decoder_UTF8($texte){
	/*while (preg_match("#[��]#", $texte)){
		$texte = utf8_decode($texte);
	}*/
	return utf8_decode($texte);
}

function encoderPourSite($texte){ 
	if( mb_detect_encoding($texte,"UTF-8, ISO-8859-1, GBK")!="UTF-8"){ 
		return  iconv("gbk","utf-8",$texte); 
	} else { 
		return $texte; 
	} 
} 

function decouperChaine($texte,$nbCaracteres){
	$taille = strlen($texte);
	$debutMax = $taille - $nbCaracteres;
	if($debutMax < 0) $debutMax = 0;
	$debut = rand(0,$debutMax);
	return substr($texte,$debut,$nbCaracteres);
}
function trouverAddresseValidePageExterieure($adresse, $sourceLien){
	if(preg_match("@^(?:http://)@",$adresse)){
		return $adresse;
	}else{
		preg_match('@^(?:http://)?([^/]+)@i',$sourceLien, $matches);
		$host = $matches[1];
		return "http://".$host."/".$adresse;
	}
}
function genererParcoursAleatoire($combien){
	$tableau = array();
	for($i = 0 ; $i < $combien ; $i++){
		array_push($tableau, $i);
	}
	for ($i = 0 ; $i < $combien*3  ; $i++){
		$alea = rand(0,$combien-1);
		$temp = $tableau[$alea];
		$tableau[$alea] = $tableau[$i%$combien];
		$tableau[$i%$combien] = $temp;	
	}
	return $tableau;
}
