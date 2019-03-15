<?php
// --
check_session();
// --
function LancerAffichageDuCorps()
{
    cadreDossierDebut();
    $req_dialogue = recuperationDialogue();
    while ($dialogue = exploiterLigneResultatBDD($req_dialogue)) {
        echo "<table border='0'><tr><td class='utilisateurs'><b>" . $dialogue['date'] . ": </b></td><td class='utilisateurs'>";
        if ($dialogue['valide'] == 0) {
            echo "<form method='post' action='controlleurs/traitementModificationMessageGueuloir.php'>" . "<textarea name='corpsDuTexte' rows='3' cols='80' style='width: 100%' >" . check_ChaineDeCaracteresDownload($dialogue['corpsDuTexte']) . "</textarea>" . "<input type='hidden' name='id' value='" . $dialogue['id_dialogue'] . "'/>" . "<input type='submit' value='Modifier'/>" . "</form>";
        } else {
            echo "<p align='left' class='TchatSuppression'>" . check_ChaineDeCaracteresDownload($dialogue['corpsDuTexte']) . "</p></td>";
        }
        echo "<td class='utilisateurs' valign='center'>";
        echo "<form method='post' action='controlleurs/traitementSuppressionMessageGueuloir.php'>" . "<input type='hidden' name='id' value='" . $dialogue['id_dialogue'] . "'/>" . "<input type='submit' value='Supprimer'/>" . "</form>";
        if ($dialogue['valide'] == 0) {
            echo "</td><td class='utilisateurs' valign='middle'>";
            echo "<form method='post' action='controlleurs/traitementValidationMessageGueuloir.php'>" . "<input type='hidden' name='id' value='" . $dialogue['id_dialogue'] . "'/>" . "<input type='submit' value='Valider'/>" . "</form>";
        }
        echo "</td></tr></table>";
    }
    cadreDossierFin();
}