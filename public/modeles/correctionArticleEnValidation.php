<?php
// --
check_session();
// --
function LancerAffichageDuCorps()
{
    ecrireScriptJSTinyMCEAdvanced();
    ecrireScriptJSArtsMedia();
    ecriceScriptJSNavigationSelect();
    $data = recuperationArticleEnValidationPourModification($_GET['id']);
    $data = exploiterLigneResultatBDD($data);
    echo "<form method='get' action='controlleurs/traitementCorrectionArticleEnValidation.php'>" . "<h1 class='utilisateurs'>Correction d'un article:</h1>" . "<table><tr><td class='utilisateurs'>" . "<p align='left'>Image: <select name='image' id='image' onchange='naviguerApercu(this)'>";
    listerContenuRepertoireImageArticle('images/articles/');
    echo "</select>" . "</td><td class='utilisateursInverse' align='center'><img id='apercu' src='images/articles/" . $data['image'] . "' height='200px' width='100px'></td></tr><tr>" . "</td></tr><tr><td width='600px' class='utilisateurs'>" . '<p align="left">Titre: <input type="text" name="titre" size="80" value="' . $data['titre'] . '"></p>' . "<!-- Gets replaced with TinyMCE, remember HTML in a textarea should be encoded -->" . "<textarea id='elm1' name='elm1' rows='15' cols='80' style='width: 100%'>" . check_ChaineDeCaracteresDownload($data['corps']) . "</textarea>" . "</td><td width='100px' class='utilisateursInverse'>" . "<div id='Animation' style='font-size:8px;'>Initialisation...</div>" . "</td></tr><tr><td colspan='2' valign='top' align='left'>" . "<input type='submit' name='save' value='Tester la correction de l&apos;article' />" . "<input type='hidden' name='id' value='" . $data['id_article'] . "'>" . "<input type='reset' name='reset' value='R&eacute;&eacute;crire tout!' />" . "</td></tr></table>" . "</form>";
}
