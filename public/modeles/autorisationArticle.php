<?php
// --
check_session();
// --
function LancerAffichageDuCorps()
{
    echo "<table border='0' align='center'>" . "<tr>";
    $req_articlesEnAttente = recuperationArticlesEnAttente($_SESSION['id_utilisateur']);
    while ($articleEnAttente = exploiterLigneResultatBDD($req_articlesEnAttente)) {
        echo "<td valign='top' align='center' class='article' width='200px'>" . "<img src='images/articles/" . $articleEnAttente['image'] . "' width='200px' height='500px'>" . "<hr/><p align='left' class='titre'>" . check_ChaineDeCaracteresDownload($articleEnAttente['titre']) . "</p><hr/>" . "<p align='center' class='article'>" . check_ChaineDeCaracteresDownload($articleEnAttente['corps']) . "</p><hr/>" . "<p align='right' class='article'>Id&eacute;ologie:&nbsp;&nbsp;" . recuperationIdeologie($articleEnAttente['id_ideologie']) . "</p>" . "<p align='right' class='article'>Th&ecirc;me:&nbsp;&nbsp;" . recuperationTheme($articleEnAttente['id_theme']) . "</p>" . "<p align='right' class='date'>" . $articleEnAttente['date'] . "</p>" . "<p align='right' class='post'>Auteur:&nbsp;&nbsp;" . recuperationAuteur($articleEnAttente['id_utilisateur']) . "</p>" . "<form method='get' action='controlleurs/traitementAutorisationArticle.php'>" . "<input type='hidden' name='id' value='" . $articleEnAttente['id_article'] . "'/><input type='submit' value='Autoriser'/>" . "</form>" . "<a href='index.php?page=raisonSuppressionArticleEnAttente&id=" . $articleEnAttente['id_article'] . "'>Supprimer</a></br>" . "<a href='index.php?page=raisonEditionArticleEnAttente&id=" . $articleEnAttente['id_article'] . "'>&Eacute;diter le texte</a></br>" . "<a href='index.php?page=correctionArticleEnAttente&id=" . $articleEnAttente['id_article'] . "'>Corriger Les Fautes</a>" . "</td>";
    }
    echo "</tr></table>";
}