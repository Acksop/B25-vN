<?php
// --
check_session();
// --
function LancerAffichageDuCorps()
{
    $sql = "SELECT * FROM dossiers";
    $res = faireUneRequeteOffline($sql);
    echo "<table>";
    while ($data = exploiterLigneResultatBDD($res)) {
        echo "<tr>";
        echo "<td class='utilisateurs'>" . $data['titre'] . "</td>" . "<td class='utilisateurs'><p>Cr&eacute;&eacute; " . $data['date_Crea'] . "</p><p>Modifi&eacute; " . $data['date_Modif'] . "</p><p>Valid&eacute; {$data['date_Validation']}</td>" . "<td class='utilisateurs'>" . $data['description'] . "</td>" . "<td class='utilisateurs'>";
        if ($data['visible'] == 1) {
            echo "En Lecture";
        } else {
            echo "&nbsp;";
        }
        echo "</td><td class='utilisateurs'>" . $data['nbLecture'] . " lectures</td>";
        
        if ($_SESSION['type_compte'] == 0) {
            echo "<td class='utilisateursInverse'><form method='post' action='controlleurs/traitementDossieraMettreEnLecture.php'>" . "<input type='hidden' name='id' value='" . $data['id_dossier'] . "'/>" . "<input type='submit' class='tweet' value='Mettre En Lecture!'/>" . "</form>";
            echo "<form method='post' action='index.php?page=modificationDossier&id=" . $data['id_dossier'] . "&modification=oui'>" . "<input type='submit' class='btn_dossiers' value='Modifier?'/>" . "</form></td>";
        }
        echo "</tr>";
    }
    echo "</table>";
    return;
}
