<?php
global $header_title, $header_description, $header_identifier_url, $header_keywords;
$header_title = "Besançon 25 - Commentaires d'une brève de la Plate-forme";
$header_description = "Ajouter un commentaire sur un article bref de Besançon 25";
$header_identifier_url = "besancon25.fr/reagir_a_la_{$_GET['id']}eme_breve";
$header_keywords = "Besançon, Besancon, 25000, 25, breve, article, reaction, commentaire, commentateur, internaute, intervenaute, articles, reactions, commentaires, commentateurs, internautes, intervenautes, lecteur, lecteurs, journalistes, journaliste";

$ip = $_SERVER['REMOTE_ADDR'];
$time = $_SERVER['REQUEST_TIME'];
$token = encrypter_Cesar("B25", 19);

function LancerAffichageDuCorps()
{
    echo "<style>
    
				@media ( min-width : 1101px ){
			
				}
				@media ( min-width : 741px ) and ( max-width: 1100px ){
					table.data_article { width: 75%; }
					th.data_article { display: block; width: 100%;}
					tr.data_article { margin: 50px; display: block; width: 100%; border: 5px solid white;}
					td.data_article { display: block; align: left; border: none;}
				}
				@media ( max-width: 740px ){
					table.data_article { width: 75%; }
					th.data_article { display: block; width: 100%;}
					tr.data_article { margin: auto 5px; display: block; width: 100%; border: 5px solid white;}
					td.data_article { display: block; align: left; border: none;}
				}
			</style>
";
    
    if (! isset($_GET['id'])) {
        return;
    }
    AjouterClickArticle($_GET['id']);
    echo "<table class='data_article' border='0' width='100%'><tr class='data_article'><td class='data_article'>";
    cadreAlignCentrerDebut();
    AfficheArticle($_GET['id']);
    cadreAlignCentrerFin();
    echo "</td><td valign='top' class='data_article'><a name='formulaire'>";
    AfficheFormReaction($_GET['id']);
    AfficheCommentairesArticle($_GET['id']);
    echo "</td></tr></table>";
}

function AfficheArticle($id)
{
    echo "<table border='0' align='center'>" . "<tr>";
    $req_articles = recuperationArticleParId($id);
    while ($article = exploiterLigneResultatBDD($req_articles)) {
        echo "<td valign='top' align='center' class='article' >" . "<img src='images/articles/{$article['image']}' width='200px' height='500px'>" . "<hr/><p align='left' class='titre'>" . check_ChaineDeCaracteresDownload($article['titre']) . "</p><hr/>" . "<p align='center' class='article'>" . check_ChaineDeCaracteresDownload($article['corps']) . "</p><hr/>" . "<p align='right' class='article'>Id&eacute;ologie:&nbsp;&nbsp;" . recuperationIdeologie($article['id_ideologie']) . "</p>" . "<p align='right' class='article'>Th&ecirc;me:&nbsp;&nbsp;" . recuperationTheme($article['id_theme']) . "</p>" . "<p align='right' class='date'>" . $article['date'] . "</p>" . "<p align='right' class='post'>Auteur:&nbsp;&nbsp;" . recuperationAuteur($article['id_utilisateur']) . "</p>";
        if (isset($_SESSION['type_compte'])) {
            if ($_SESSION['type_compte'] == '0') {
                echo "<p> Lu " . AfficheNbLectureArticle($article['id_article']) . " fois...</p> " . "<p> Selectionn&eacute; " . AfficheNbClicksArticle($article['id_article']) . " fois pour commentaires.</p>" . "<p> Visit&eacute; par " . AfficheNbVisitesUniqueArticle($article['id_article']) . " Poste(s)/IP(s) diff&eacute;rent(e)s ...</p>";
                echo "<form method='get' action='controlleurs/traitementSuppressionArticle.php'>" . "<input type='hidden' name='id' value='{$article['id_article']}'/><input type='submit' value='Supprimer'/>" . "</form>";
                echo "<a href='index.php?page=correctionArticle&id={$article['id_article']}'>Corriger La(Les) faute(s)</a>";
            } else {
                if ($_SESSION['id_utilisateur'] == $article['id_utilisateur']) {
                    echo "<p> Lu " . AfficheNbLectureArticle($article['id_article']) . " fois...</p> " . "<p> Selectionn&eacute; " . AfficheNbClicksArticle($article['id_article']) . " fois pour commentaires.</p>";
                    echo "<form method='get' action='controlleurs/traitementSuppressionArticle.php'>" . "<input type='hidden' name='id' value='{$article['id_article']}'/><input type='submit' value='Supprimer'/>" . "</form>";
                    echo "<a href='index.php?page=correctionArticle&id={$article['id_article']}'>Corriger La(Les) faute(s)</a>";
                }
            }
        }
        
        echo "</td>";
    }
    echo "</tr></table>";
}

function AfficheFormReaction($id)
{
    echo "<div class='utilisateurs'><form method='POST' action='controlleurs/traitementReactionArticle.php'>" . "<input type='hidden' name='id_article' value='{$id}'/>" . 
    // ."<input type='hidden' name='clemap' value='{$clemap_encrypt}'/>"
    "<p class='droite lettrine'>" . "<label style='width:150px;padding:15px'>Pseudo : </label>";
    if (isset($_COOKIE['pseudoInterveunaute'])) {
        $pseudo = $_COOKIE['pseudoInterveunaute'];
        echo "<input class='tweet' type='text' name='Pseudo' value='{$pseudo}' />";
    } else 
        if (!isset($_SESSION['identifiant'])) {
            echo "<input class='tweet' type='text' name='Pseudo'/>";
        }else{
            echo $_SESSION['identifiant'];
        }
    echo "<input type='hidden' name='cleMap' value='0' />";
    echo "<br /><textarea class='tweet' cols='60' rows='4' name='commentaire'></textarea><br/>" . "<input type='submit' class='tweet' value='Commenter l&apos;article'/></p>" . "</form></div>";
}

function AfficheCommentairesArticle($id)
{
    $sql = "SELECT * FROM articlesCommentaires WHERE id_article = '{$id}' ORDER BY valeurCommentaire DESC";
    $req = faireUneRequeteOffLine($sql);
    echo "<div class='utilisateurs'>" . "<table border='0'>";
    while ($commentaires = exploiterLigneResultatBDD($req)) {
        echo "<tr><td width='275px'>" . "<p class='article lettrineInverse'>" . check_ChaineDeCaracteresDownload($commentaires['Corps_commentaire']) . "</p>" . "<p class='post'>{$commentaires['Pseudo']} - " . AfficheDateCommentaire($commentaires['Date']) . "]</p>";
        if (isset($_SESSION['id_utilisateur'])) {
            if (estAdministrateurOuPas($_SESSION['id_utilisateur'])) {
                echo "</td><td><form action='controlleurs/traitementAugmenterValeurCommentaire.php'>" . "<input type='hidden' name='id_article' value='{$id}'/>" . "<input type='hidden' name='id_commentaire' value='{$commentaires['id_commentaire']}'/>" . "<input border=0 src='images/good.png' type='image' value='submit' align='middle'/>" . "</form></td>" . "<td><form action='controlleurs/traitementDecrementerValeurCommentaire.php'>" . "<input type='hidden' name='id_article' value='{$id}'/>" . "<input type='hidden' name='id_commentaire' value='{$commentaires['id_commentaire']}'/>" . "<input border=0 src='images/bad.png' type='image' value='submit' align='middle'/>" . "</form></td>" . "<td><p class='post'>Valeur: [{$commentaires['valeurCommentaire']}] | IP: [{$commentaires['Ip']}]</p>";
            } elseif (CorrelationArticleJournaliste($_SESSION['id_utilisateur'], $id)) {
                echo "</td><td><form action='controlleurs/traitementAugmenterValeurCommentaire.php'>" . "<input type='hidden' name='id_article' value='{$id}'/>" . "<input type='hidden' name='id_commentaire' value='{$commentaires['id_commentaire']}'/>" . "<input border=0 src='images/good.png' type='image' value='submit' align='middle'/>" . "</form></td>" . "<td><form action='controlleurs/traitementDecrementerValeurCommentaire.php'>" . "<input type='hidden' name='id_article' value='{$id}'/>" . "<input type='hidden' name='id_commentaire' value='{$commentaires['id_commentaire']}'/>" . "<input border=0 src='images/bad.png' type='image' value='submit' align='middle'/>" . "</form></td>" . "<td><p class='post'>Valeur: [{$commentaires['valeurCommentaire']}]</p>";
            }
        }
        echo "</td></tr>";
    }
    echo "</td></tr></table><div>";
}
