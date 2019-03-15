<?php

global $header_title,$header_description,$header_identifier_url,$header_keywords;

if(isset($_GET['id'])){
$pseudo = recuperationPseudoArtisteOuArtisanFromIDArtiste($_GET['id']);
$description = recuperationDescriptionArtisteOuArtisanFromIDArtiste($_GET['id']);
}else{
$pseudo = "Artisans Inconnu";
$description = "Sans Travail Fixe";
}
$header_title = "Besançon 25 - Page publique de présentation de l'Artisanat ({$description}) par {$pseudo} sur la Plate-forme";
$header_description = "Présentation de l'Artisanat: {$description} par {$pseudo} sur Besançon 25";
$header_identifier_url = "besancon25.fr/presentation_du_{$_GET['id']}eme_artisan";
$header_keywords = "Besançon, Besancon, 25000, 25, artisan, mur, présentation, articles, prix, réservation, réservations, créations, objets, art, réalisations";


function LancerAffichageDuCorps(){
	
if(!isset($_GET['id'])){return;};

	
	$id_artiste = $_GET['id'];
	$artisans = exploiterLigneResultatBDD(recuperationInfoArtisteFromID($id_artiste));
	$descriptif = exploiterLigneResultatBDD(recuperationDescriptifArtisans($id_artiste));
	$articles = recuperationArticlesArtisansFromId($id_artiste);
	
	echo "<div style'B25-cadre-inverse'>";
	echo "<h1 style='margin: 0px 0px 0px 30px ; width:100%;'>&laquo; <span class='pseudo'> {$artisans['pseudo']} </span> &raquo;</h1>";
	echo "<p style='margin: 0px 0px 0px 75px ;'>site Web: {$artisans['siteInterWeb']}<br /><b>tel:</b> {$artisans['telephone']}</p>";
	if($descriptif['logo'] != '' && $descriptif['descriptif'] != ''){
		
		echo "<span class='logotype'><img class='image-description-association' src='".RADIEURAE_SVN_PATH.$descriptif['logo']."' alt='{$artisans['nom']}'/></span>";
		echo "{$descriptif['descriptif']}";
	}else{
		echo "<p class='utilisateurs'>Vous devez mettre un logo et une description pour pouvoir vous pr&eacute;senter.</p>";
	}
	echo "</div>";
	echo "<br /><br />";
	echo "<div style'B25-cadre-inverse'>";
	echo "<h1 style='margin: 0px 0px 0px 100px ;'><span style='color:grey;'>&raquo; Ses Cr&eacute;ations : </span></h1><center>";
	echo "<div class='conteneurGrandArticle'>";
	$kelColonne = -1;
	$nbArticlesParColonnes = (int) (exploiterNombreLigneResultatBDD($articles)/3);
	$nbArticlesEnPlus = exploiterNombreLigneResultatBDD($articles)%3;
	$nbArticlesColonne = array( $nbArticlesParColonnes , $nbArticlesParColonnes , $nbArticlesParColonnes );
	if($nbArticlesEnPlus > 0){
		$nbArticlesColonne[0] = $nbArticlesParColonnes + 1;
	}
	if($nbArticlesEnPlus > 1){
		$nbArticlesColonne[1] = $nbArticlesParColonnes + 1;
	}

	while($article = exploiterLigneResultatBDD($articles)){
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
			echo "<br /><div id='article_{$article['id_article']}' class='conteneurArticleInterieur'>"
					."<center><img src='".RADIEURAE_SVN_PATH.$article['image']."' alt='{$article['libelle']}'/>"
					."<p class='titre' align='center'>{$article['libelle']}</p>"
					."<p class='article'>{$article['description']}</p>"
					."<p class='titre' style='float:right;'>{$article['prix']}&nbsp;&#128;</p>"
					."<br /><br /><br /></center>"
					."</div>";
			$nbArticlesColonne[$kelColonne]--;
		}
		if ($nbArticlesColonne[$kelColonne] == 0){
			echo "</center></div>";
		}
	}
	echo "</div><center>";
	echo "</div>";
}