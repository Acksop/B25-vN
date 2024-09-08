<?php

global $header_title,$header_description,$header_identifier_url,$header_keywords;
$pseudo = recuperationPseudoArtisteOuArtisanFromIDArtiste($_GET['id']);
$description = recuperationDescriptionArtisteOuArtisanFromIDArtiste($_GET['id']);
$header_title = "Besan&ccedil;on 25 - Page publique de pr&eacute;sentation de l&apos;Artisanat ({$description}) par {$pseudo} sur la Plate-forme";
$header_description = "Pr&eacute;sentation de l&apos;Artisanat: {$description} par {$pseudo} sur Besan&ccedil;on 25";
$header_identifier_url = "besancon25.fr/presentation_du_{$_GET['id']}eme_artisan";
$header_keywords = "Besan&ccedil;on, Besancon, 25000, 25, artisan, mur, pr&eacute;sentation, articles, prix, r&eacute;servation, r&eacute;servations, cr&eacute;ations, objets, art, r&eacute;alisations";


function LancerAffichageDuCorps(){
	$id_artiste = $_GET['id'];
	$artisans = mysql_fetch_assoc(recuperationInfoArtisteFromID($id_artiste));
	$descriptif = mysql_fetch_assoc(recuperationDescriptifArtisans($id_artiste));
	$articles = recuperationArticlesArtisansFromId($id_artiste);
	
	cadreAlignCentrerDebut();
	echo "<h1 style='margin: 0px 0px 0px 30px ;'>&laquo; <span style='color:#FFFFFF'> {$artisans['pseudo']} </span> &raquo;</h1>";
	echo "<p style='margin: 0px 0px 0px 75px ;'>site Web: {$artisans['siteInterWeb']}<br /><b>tel:</b> {$artisans['telephone']}</p>";
	if($descriptif['logo'] != '' && $descriptif['descriptif'] != ''){
		
		echo "<span style='float:right; margin: 15px;'><img src='".SVNRADIEURAE_PATH.$descriptif['logo']."' alt='{$artisans['nom']}'/></span>";
		echo "{$descriptif['descriptif']}";
	}else{
		echo "<p class='utilisateurs'>Vous devez mettre un logo et une description pour pouvoir vous pr&eacute;senter.</p>";
	}
	cadreAlignCentrerFin();
	echo "<br /><br />";
	cadreAlignCentrerDebut();
	echo "<h1 style='margin: 0px 0px 0px 100px ;'><span style='color:grey;'>&raquo; Ses Cr&eacute;ations : </span></h1><center>";
	echo "<div class='conteneurGrandArticle'>";
	$kelColonne = -1;
	$nbArticlesParColonnes = (int) (mysql_num_rows($articles)/3);
	$nbArticlesEnPlus = mysql_num_rows($articles)%3;
	$nbArticlesColonne = array( $nbArticlesParColonnes , $nbArticlesParColonnes , $nbArticlesParColonnes );
	if($nbArticlesEnPlus > 0){
		$nbArticlesColonne[0] = $nbArticlesParColonnes + 1;
	}
	if($nbArticlesEnPlus > 1){
		$nbArticlesColonne[1] = $nbArticlesParColonnes + 1;
	}
	//print_r($nbArticlesEnPlus);
	//print_r($nbArticlesColonne);
	while($article = mysql_fetch_assoc($articles)){
		if ( $kelColonne == -1 ){
			echo "<div class='conteneurArticle'><center>";
			$kelColonne++;
		}else{
			if($nbArticlesColonne[$kelColonne] == 0){
				echo "<div class='conteneurArticle'><center>";
				$kelColonne++;
			}
		}
		if($article['image'] != ''){
			echo "<br /><div id='article_{$article['id_article']}' class='conteneurArticleInterieur'><center><img src='".SVNRADIEURAE_PATH.$article['image']."' alt='{$article['libelle']}'/><p class='titre' align='center'>{$article['libelle']}</p><p class='article'>{$article['description']}</p><p class='titre' style='float:right;'>{$article['prix']}&nbsp;&#128;</p><br /><br /><br /></center></div>";
			$nbArticlesColonne[$kelColonne]--;
		}
		if ($nbArticlesColonne[$kelColonne] == 0){
			echo "</center></div>";
		}
	}
	echo "</div><center>";
	cadreAlignCentrerFin();
}