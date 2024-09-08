<?php

function creationFluxRSS(){
	//destruction de l'ancien fichier
	$detruit = unlink("../fluxRSS.xml");

	//ouverture et ecriture de fichier
	$XML_RSS = fopen("../fluxRSS.xml","a");
	if($XML_RSS){
		//Balise de base de Syndication de FLUX
		fputs($XML_RSS,html_entity_decode("<?xml version='1.0' encoding='iso-8859-1'?>\n"
					."<?xml-stylesheet type='text/xsl' href='./fluxRSS.xslt'?>"
					."<!DOCTYPE entityHTML SYSTEM './entityHTML.dtd'>\n"
					."<rss version='2.0'>\n"
					."<channel>\n\n"
					."<title>A Besan&ccedil;on 25 - La plate-Forme des Artistes, Artisans et Associations de Besan&ccedil;on</title>\n"
					."<link>http://besancon25.fr</link>\n"
					."<description> News-FEED des 4 derniers articles parus de la plate-forme</description>\n\n",ENT_QUOTES,'ISO8859-1'));
		//recuperation des articles courants
		$req_articles = recuperationArticle();
		$numArticle=0;
		while($article = mysql_fetch_assoc($req_articles)){
			$numArticle++;	
			fputs($XML_RSS,html_entity_decode("<item>\n"
						."<title>".check_ChaineDeCaracteresDownload($article['titre'])."</title>\n"
						."<link>http://besancon25.fr/index.php?page=articles</link>\n"
						."<guid isPermaLink='false'>Article ".$numArticle." sur 4</guid>\n"
						."<description>".check_ChaineDeCaracteresDownload($article['corps'])."</description>\n"
						."<pubDate>".transformationDateArticlePourRSS($article['date'])."</pubDate>\n"
						."</item>\n\n",ENT_QUOTES,'ISO8859-1'));
		}
		fputs($XML_RSS,"</channel>\n</rss>");
		//fermeture fichier XML
		fclose($XML_RSS);
	}else{
		return 0;
	}
	return;
}

?>
