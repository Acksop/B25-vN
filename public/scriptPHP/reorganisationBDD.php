<?php

function afficheFormulaireReorganisation()
{
    echo "<form name='reorganisation' method='post' action='controlleurs/traitementReorganisation.php'>" . "<p class='utilisateurs'>R&Eacute;ORGANISATION DE " . recuperationNbUtilisateuraReorganiser() . " UTILISATEUR(S)...</p>" . "<input type='submit' value='A FAIRE & OK ?'/>" . "</form><br/>";
    return;
}

function afficheFormulaireUpdateVersion2toVersion3()
{
    echo "<form name='changementDeVersion' method='post' action='controlleurs/controlleursAUsageUnique/traitementUpdateVersion2toVersion3.php'>" . "<p class='utilisateurs'>PASSER DE LA VERSION 2.00 À LA VERSION 3.00</p>" . "<button type='submit'>A FAIRE & OK ?</button>" . "</form><br/>";
    return;
}

function afficheFormulaireReconstructionUploadUtilisateurs()
{
    echo "<form name='changementDeVersion' method='post' action='controlleurs/controlleursAUsageUnique/traitementReconstructionRepertoireUtilisateurs.php'>" . "<p class='utilisateurs'>Reconstruire Repertoire Utilisateurs</p>" . "<button type='submit'>OK ?</button>" . "</form><br/>";
    return;
}
?>
