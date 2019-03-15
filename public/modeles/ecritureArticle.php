<?php
check_session();

function LancerAffichageDuCorps()
{
    ecrireScriptJSTinyMCE();
    ecrireScriptJSArtsMedia();
    echo "<form method='get' action='controlleurs/traitementArticle.php'>" . "<h1 class='utilisateurs'>&Eacute;criture d'un article:</h1>" . "<table><tr><td colspan='2' class='utilisateurs'>" . "<p align='left'>Titre: <input type='text' name='titre' size='80'></p>" . "</td></tr><tr><td width='600px' class='utilisateurs'>" . "<!-- Gets replaced with TinyMCE, remember HTML in a textarea should be encoded -->" . "<textarea id='elm1' name='elm1' rows='15' cols='80' style='width: 100%'>" . "</textarea>" . "</td><td width='100px' class='utilisateursInverse'>" . "<div id='Animation' style='font-size:8px;'>Initialisation...</div>" . "</td></tr><tr><td colspan='2' valign='top' align='left'>" . "<input type='submit' name='save' value='Envoyer article &agrave; la validation' />" . "<input type='reset' name='reset' value='R&eacute;&eacute;crire tout!' />" . "</td></tr></table>" . "</form>";
}