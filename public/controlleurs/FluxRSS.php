<?php
require '../variablesApplication.php';
include ("../scriptPHP/connectionBDD.php");

// d�tection du type de flux demand�
$feed = (isset($_GET['feed'])) ? strtoupper($_GET['feed']) : '';
if (($feed != 'RSS') && ($feed != 'ATOM')) {
    $feed = 'RSS';
} // simple pr�caution ...
                                                              
// ****************************************************
                                                              // ---- Flux RSS

if ($feed == 'RSS') {
    
    $RSS = "<?xml version='1.0' encoding='ISO-8859-15'?>\n" . "<rss version='2.0' xmlns:atom='http://www.w3.org/2005/Atom'>\n" . "<channel>\n\n" . "<title>A Besan�on 25 - La plate-Forme des Artistes, Artisans et Associations de Besan�on</title>\n" . "<link>http://besancon25.fr</link>\n" . "<description> News-FEED des 4 derniers articles parus de la plate-forme</description>\n\n" . 
    // la langue du flux
    "		<language>fr</language>\n" . 
    // la date de publication (qui m'a pos� pas mal de probl�mes)
    "		<pubDate>" . date('D, d M Y H:i:s O') . "</pubDate>\n" . 
    // la date de construction du flux
    "		<lastBuildDate>" . gmdate('D, d M Y H:i:s') . " GMT</lastBuildDate>\n" . 
    // 2 lignes pour l'auteur du document
    "		<managingEditor>no-reply@besancon25.info (B25)</managingEditor>\n" . "		<webMaster>no-reply@besancon25.info (B25)</webMaster>\n" . "		<ttl>4</ttl>\n" . 
    // cette ligne est tr�s importante, elle DOIT �tre l'URL de la page du flux
    "		<atom:link href='http://besancon25.fr/controlleurs/FluxRSS.php?feed=RSS' rel='self' type='application/rss+xml' />" . 
    
    // recuperation des articles courants
    $req_articles = recuperationArticle();
    $numArticle = 0;
    
    while ($article = exploiterLigneResultatBDD($req_articles)) {
        $numArticle ++;
        $RSS .= "<item>\n" . "<title>" . htmlspecialchars(check_ChaineDeCaracteresDownload($article['titre']), ENT_NOQUOTES) . "</title>\n" . "<link>http://besancon25.fr/index.php?page=articles</link>\n" . "<description>" . htmlspecialchars(check_ChaineDeCaracteresDownload($article['corps']), ENT_NOQUOTES) . "</description>\n" . "<pubDate>" . transformationDateArticlePourRSS($article['date']) . "</pubDate>\n" . "<guid isPermaLink='false'>Article " . $numArticle . " sur 4</guid>\n" . "</item>\n\n";
    }
    
    $RSS .= "</channel>\n</rss>";
}

// ****************************************************
// ---- Flux ATOM

if ($feed == 'ATOM') {
    // pour le format ATOM, les commentaires sont sensiblement �quivalents.
    // Seuls changent certaines balises et certains formats (de date notamment).
    
    // On �crit le prologue du flux ATOM 1.0 :
    $RSS .= '<?xml version="1.0" encoding="ISO-8859-15"?>' . "\n";
    $RSS .= '<feed xmlns="http://www.w3.org/2005/Atom" xml:lang="fr">' . "\n";
    
    // pas de channel en ATOM...
    
    // le titre du site (attention aux caract�res sp�ciaux ...)
    $RSS .= '	<title>Besancon25 - La plate-Forme des artistes de Besancon</title>' . "\n";
    // la description du site (attention aux caract�res sp�ciaux ...)
    $RSS .= '	<subtitle>Besancon25 (B25) est un annuaire et une plate-forme de blogging communautaire</subtitle>' . "\n";
    // cette ligne est tr�s importante, elle DOIT �tre l'URL de la page du flux
    $RSS .= '	<link rel="self" href="http://besancon25.fr/FluxRSS.php?feed=ATOM" type="application/atom+xml" />' . "\n";
    
    // la date de publication (qui m'a pos� pas mal de probl�mes)
    $RSS .= '	<updated>' . date('Y-m-d\TH:i:s\Z') . '</updated>' . "\n";
    // pour l'auteur du document
    $RSS .= '	<author>' . "\n";
    $RSS .= '		<name>Emmanuel</name>' . "\n";
    $RSS .= '		<email>no-reply@besancon25.info</email>' . "\n";
    $RSS .= '	</author>' . "\n";
    // l'URL du site
    $RSS .= '	<id>http://www.besancon25.fr</id>' . "\n";
    
    // recuperation des articles courants
    $req_articles = recuperationArticle();
    $numArticle = 0;
    
    while ($article = exploiterLigneResultatBDD($req_articles)) {
        $numArticle ++;
        $RSS .= "<entry>\n" . "<title>" . strip_tags(htmlspecialchars(check_ChaineDeCaracteresDownload($article['titre']), ENT_NOQUOTES)) . "</title>\n" . "<link href='http://besancon25.fr/index.php?page=articles' />\n" . "<id>Article " . $numArticle . " sur 4</id>\n" . "<summary>" . strip_tags(htmlspecialchars(check_ChaineDeCaracteresDownload($article['corps']), ENT_NOQUOTES)) . "</summary>\n" . "<updated>" . transformationDateArticlePourATOM($article['date']) . "</updated>\n" . 
        // ce bloc permet de mettre de la mise en forme dans le flux (XHTML Strict seulement !!!)
        "			<content type='xhtml'>\n" . "			<div xmlns='http://www.w3.org/1999/xhtml'>" . strip_tags(htmlspecialchars(check_ChaineDeCaracteresDownload($article['corps']), ENT_NOQUOTES)) . "</div>\n" . "			</content>\n" . "		</entry>\n";
    }
    
    // et maintenant, on ferme le contenu du flux RSS ...
    $RSS .= '</feed>' . "\n";
}
;

// On envoie les headers XML / no cache
header('Content-Type: text/xml');
header('Expires: ' . gmdate('D, d M Y H:i:s') . ' GMT');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Pragma: public');

// maintenant qu'on a indiqu� au navigateur qu'on lui envoyait du XML,
// on envoie le flux
echo $RSS;
	