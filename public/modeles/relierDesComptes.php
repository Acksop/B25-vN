<?php
// --
check_session();
// --
function LancerAffichageDuCorps()
{
    echo "<table border='0' align='center'>" . "<form name='inscription' method='post' action='controlleurs/traitementReliageCompte.php'>" . "<tr><td class='utilisateurs'>" . "IDENTIFIANT DU COMPTE A RELIER:" . "</td><td class='utilisateurs'>" . "<input name='identifiant' type='text'/>" . "</td></tr><tr><td class='utilisateurs'>" . "MOT DE PASSE DU COMPTE A RELIER:" . "</td><td class='utilisateurs'>" . "<input name='motDePasse' type='password'/>" . "</td></tr><tr><td colspan='2'>" . "<input type='submit' value='Relier'/>" . "</td></tr>" . "</form>";
    if (isset($_GET['erreur'])) {
        switch ($_GET['erreur']) {
            case 1:
                echo "<tr><td colspan='2' width='150' align='center' class='utilisateurs'>" . "Le compte que vous essayer de relier n'existe pas..." . "</td></tr>";
                break;
            default:
        }
    }
    echo "</table>";
}