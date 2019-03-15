<?php
if (! (isset($page) && $page == "index")) {
    
    global $header_title, $header_description, $header_identifier_url, $header_keywords;
    $header_title = "Besançon 25 - Les 4 dernières brèves la Plate-forme";
    $header_description = "Les 4 derniers brefs articles du Besançon 25";
    $header_identifier_url = "besancon25.fr/articles_brefs";
    $header_keywords = "Besançon, Besancon, 25000, 25, journalistes, brèves, bref, articles, article, informations, thèmes, rédaction";
}

if (function_exists("LancerAffichageDuCorps")) {

    function AfficherPageArticles()
    {
        LancerAffichageDesArticles();
    }
} else {

    function LancerAffichageDuCorps()
    {
        LancerAffichageDesArticles();
    }
}

function LancerAffichageDesArticles()
{
    echo <<<'EOF'
	<style type='text/css'>
	.articles{
		display:table;
		border-spacing: 5px;
		padding: 15px 2px;
		margin: auto;
		witdh: 100%;
		align: center;
	}
	.articles-row{
		vertical-align:top;
		border-spacing: 5px;
		margin:5px;
	}
	.article-cell{
		border-spacing: 5px;
		margin: 5px;
		height: 100%;
		min-width: 250px;
		border: 1px dotted white;
		padding: 10px;
		text-align: center;
	}
	@media ( min-width : 1101px ){
		.article-cell { display: table-cell; }
		.articles-row { display: table-cell; }
	}
	@media ( min-width : 641px ) and ( max-width: 1100px ){
		.article-cell { display: table-cell;}
		.articles-row { display: table-row;}
	}
	@media ( max-width: 640px ){
		.article-cell { display: block }
	}
	</style>
EOF;
    
    echo "<br /><br /><br />";
    echo "<div class='articles B25-cadre' style='width:100%;'>";
    $req_articles = recuperationArticle();
    $i = 0;
    while ($article = exploiterLigneResultatBDD($req_articles)) {
        AjouterLectureArticleAfficher($article['id_article']);
        if ($i % 2 == 0) {
            echo "<div class='articles-row'>";
        }
        echo "<div class='article-cell'>" . "<img src='images/articles/" . $article['image'] . "' width='200px' height='500px'>" . "<hr/><p align='left' class='titre'>" . $article['titre'] . "</p><hr/>" . "<p align='center' class='article'>" . $article['corps'] . "</p><hr/>" . "<p align='right' class='article'>Id&eacute;ologie:&nbsp;&nbsp;" . recuperationIdeologie($article['id_ideologie']) . "</p>" . "<p align='right' class='article'>Th&ecirc;me:&nbsp;&nbsp;" . recuperationTheme($article['id_theme']) . "</p>" . "<p align='right' class='date'>" . $article['date'] . "</p>" . "<p align='right' class='article'><a href='index.php?page=ArticleReaction&id=" . $article['id_article'] . "'>" . calculNbCommentairesArticle($article['id_article']) . " commentaire(s) <img src='images/commentaires.gif' width='15px' heigth='15px'></a></p>" . "<p align='right' class='post'>Auteur:&nbsp;&nbsp;" . recuperationAuteur($article['id_utilisateur']) . "</p>";
        if (isset($_SESSION['type_compte'])) {
            if ($_SESSION['type_compte'] == '0') {
                echo "<p> Lu " . AfficheNbLectureArticle($article['id_article']) . " fois...</p> " . "<p> Visit&eacute; par " . AfficheNbVisitesUniqueArticle($article['id_article']) . " Poste(s)/IP(s) diff&eacute;rent(e)s ...</p>" . "<p> Selectionn&eacute; " . AfficheNbClicksArticle($article['id_article']) . " fois pour commentaires.</p>";
                echo "<form method='post' action='controlleurs/traitementSuppressionArticle.php'>" . "<input type='hidden' name='id' value='" . $article['id_article'] . "'/>" . "<input type='hidden' name='pagePrecedente' value='articles'/>" . "<input type='submit' value='Supprimer'/>" . "</form>";
                echo "<a href='index.php?page=ArticleCorrection&id=" . $article['id_article'] . "'>Corriger La(Les) faute(s)</a>";
            } else {
                if ($_SESSION['id_utilisateur'] == $article['id_utilisateur']) {
                    echo "<p> Lu " . AfficheNbLectureArticle($article['id_article']) . " fois...</p> " . "<p> Selectionn&eacute; " . AfficheNbClicksArticle($article['id_article']) . " fois pour commentaires.</p>";
                    echo "<form method='post' action='controlleurs/traitementSuppressionArticle.php'>" . "<input type='hidden' name='id' value='" . $article['id_article'] . "'/>" . "<input type='hidden' name='pagePrecedente' value='articles'/>" . "<input type='submit' value='Supprimer'/>" . "</form>";
                    echo "<a href='index.php?page=ArticleCorrection&id=" . $article['id_article'] . "'>Corriger La(Les) faute(s)</a>";
                }
            }
        }
        
        echo "</div>";
        if ($i % 2 == 1) {
            echo "</div>";
        }
        $i ++;
    }
    echo "</div>";
}
