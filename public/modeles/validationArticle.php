<?php
// --
check_session();
// --
function LancerAffichageDuCorps()
{
    echo "<table border='0' align='center'>" . "<tr>";
    $req_articlesEnValidation = recuperationArticlesEnValidation();
    while ($articleEnValidation = exploiterLigneResultatBDD($req_articlesEnValidation)) {
        echo "<td valign='top' align='center' class='article' width='200px'>" . "<img src='images/articles/" . $articleEnValidation['image'] . "' width='200px' height='500px'>" . "<hr/><p align='left' class='titre'>" . check_ChaineDeCaracteresDownload($articleEnValidation['titre']) . "</p><hr/>" . "<p align='center' class='article'>" . check_ChaineDeCaracteresDownload($articleEnValidation['corps']) . "</p><hr/>" . "<p align='right' class='article'>Id&eacute;ologie:&nbsp;&nbsp;" . recuperationIdeologie($articleEnValidation['id_ideologie']) . "</p>" . "<p align='right' class='article'>Th&ecirc;me:&nbsp;&nbsp;" . recuperationTheme($articleEnValidation['id_theme']) . "</p>" . "<p align='right' class='date'>" . $articleEnValidation['date'] . "</p>" . "<p align='right' class='post'>Auteur:&nbsp;&nbsp;" . recuperationAuteur($articleEnValidation['id_utilisateur']) . "</p>" . "<form method='get' action='controlleurs/traitementValidationArticle.php'>" . "<input type='hidden' name='id' value='" . $articleEnValidation['id_article'] . "'/><input type='submit' value='Valider'/>" . "</form>" . "<a href='index.php?page=raisonSuppressionArticleEnValidation&id=" . $articleEnValidation['id_article'] . "'>Supprimer</a></br>" . "<a href='index.php?page=raisonEditionArticleEnValidation&id=" . $articleEnValidation['id_article'] . "'>&Eacute;diter le texte</a></br>" . "<a href='index.php?page=correctionArticleEnValidation&id=" . $articleEnValidation['id_article'] . "'>Corriger Les Fautes</a>" . "</td>";
    }
    echo "</tr></table>";
}
