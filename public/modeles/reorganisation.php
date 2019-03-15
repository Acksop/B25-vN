<?php
// --
check_session();
// --
function LancerAffichageDuCorps()
{
    echo "<p class='utilisateurs'>Il y a " . recuperationNbUtilisateuraReorganiser() . " Utilisateurs &agrave; r&eacute;organiser... ";
    echo "Depuis l'ID: " . recuperationIDBase() . "  !</p>";
    // OLD: A modifier pour que ce soit juste avec les nouvelles tables.
    afficheFormulaireReorganisation();
    // Formulaire de r�organisation de la base de donn�es apr�s toutes les modifications
    // Ne fonctionne pas! probl�me d'encodage!
    // afficheFormulaireUpdateVersion2toVersion3();
}

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