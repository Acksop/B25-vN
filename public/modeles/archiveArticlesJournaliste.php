<?php
// --
check_session();
// --
function LancerAffichageDuCorps()
{
    cadreAlignCentrerDebut();
    echo "<table border='0' align='center'>" . "<tr>";
    $req_articles = recuperationArticleEcritParJournaliste($_SESSION['id_utilisateur']);
    while ($article = exploiterLigneResultatBDD($req_articles)) {
        echo "<td valign='top' align='center' class='article' >" . "<img src='images/articles/" . $article['image'] . "' width='200px' height='500px'>" . "<hr/><p align='left' class='titre'>" . check_ChaineDeCaracteresDownload($article['titre']) . "</p><hr/>" . "<p align='center' class='article'>" . check_ChaineDeCaracteresDownload($article['corps']) . "</p><hr/>" . "<p align='right' class='article'>Id&eacute;ologie:&nbsp;&nbsp;" . recuperationIdeologie($article['id_ideologie']) . "</p>" . "<p align='right' class='article'>Th&ecirc;me:&nbsp;&nbsp;" . recuperationTheme($article['id_theme']) . "</p>" . "<p align='right' class='date'>" . $article['date'] . "</p>" . "<p align='right' class='article'><a href='index.php?page=ArticleReaction&id=" . $article['id_article'] . "'>" . calculNbCommentairesArticle($article['id_article']) . " commentaire(s) <img src='images/commentaires.gif' width='15px' heigth='15px'></a></p>" . "<p align='right' class='post'>Auteur:&nbsp;&nbsp;" . recuperationAuteur($article['id_utilisateur']) . "</p>" . "<p> Lu " . AfficheNbLectureArticle($article['id_article']) . " fois...</p> " . "<p> Selectionn&eacute; " . AfficheNbClicksArticle($article['id_article']) . " fois pour commentaires.</p>" . "<p> Visit&eacute; par " . AfficheNbVisitesUniqueArticle($article['id_article']) . " Poste(s)/IP(s) diff&eacute;rent(e)s ...</p>" . "<form method='get' action='controlleurs/traitementSuppressionArticle.php'>" . "<input type='hidden' name='id' value='" . $article['id_article'] . "'/><input type='submit' value='Supprimer'/>" . "</form>" . "<a href='index.php?page=ArticleCorrection&id=" . $article['id_article'] . "'>Corriger La(Les) faute(s)</a>";
        echo "</td>";
    }
    echo "</tr></table>";
    cadreAlignCentrerFin();
}

