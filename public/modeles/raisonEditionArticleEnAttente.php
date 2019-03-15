<?php
// --
check_session();
// --
function LancerAffichageDuCorps()
{
    ecrireScriptJSTinyMCE();
    ecrireScriptJSArtsMedia();
    $data = recuperationArticleEnAttentePourModification($_GET['id']);
    $data = exploiterLigneResultatBDD($data);
    echo "<form method='post' action='controlleurs/traitementEditionArticleEnAttente.php'>" . "<h1 class='utilisateurs'>&Eacute;dition de l&apos;article:</h1>" . "<table><tr><td width='600px' class='utilisateurs'>" . '<p align="left">Titre: <input type="text" name="titre" size="80" value="' . $data['titre'] . '"></p>' . "<!-- Gets replaced with TinyMCE, remember HTML in a textarea should be encoded -->" . "<textarea id='elm1' name='corps' rows='15' cols='80' style='width: 100%'>" . check_ChaineDeCaracteresDownload($data['corps']) . "</textarea>" . "</td><td width='100px' class='utilisateursInverse'>" . "<div id='Animation' style='font-size:8px;'>Initialisation...</div>" . "</td></tr><tr><td colspan='2' valign='top' align='left' class='utilisateursInverse'>" . "<h1 class='utilisateurs'>Raison(s) de l'&Eacute;dition de l'article</h1>" . "<textarea name='raison' rows='15' cols='80' style='width: 100%'>" . "</textarea>" . "</td></tr><tr><td colspan='2' valign='top' >" . "<input type='submit' name='save' value='Envoyer l&apos;article &eacute;dit&eacute; &agrave; une nouvelle validation (avec Courriel)' />" . "<input type='hidden' name='id' value='" . $data['id_article'] . "'>" . "<input type='reset' name='reset' value='R&eacute;&eacute;crire tout!' />" . "</td></tr></table>" . "</form>";
}