<?php
check_session();

function LancerAffichageDuCorps()
{
    $sql = "SELECT * FROM dossiers WHERE id_utilisateur = '{$_SESSION['id_utilisateur']}'";
    $res = faireUneRequeteOffline($sql);
    echo "<table align='center'>";
    while ($data = exploiterLigneResultatBDD($res)) {
        echo "<tr><td class='utilisateurs' width='450px'>";
        echo "<p class='titre'>" . $data['titre'] . "</p>" . "<p class='corps'><b>Description :</b><br />" . $data['description'] . "</p>" . "<p class='date'>Ouvert " . $data['date_Crea'] . "</p>" . "<p class='date'><b>Derni&egrave;re </b>Modification " . $data['date_Modif'] . "</p>" . "<p class='date'><u><b>Valid&eacute; </b></u>&nbsp;" . $data['date_Validation'] . "</p>";
        echo "</td><td class='utilisateurs'>";
        if ($data['visible'] == 1) {
            echo "visible";
        } else {
            echo "&nbsp;";
        }
        echo "</td><td class='utilisateurs'>" . $data['nbLecture'] . " lectures</td>";
        
        echo "<td class='utilisateursInverse'>" . "<form method='post' action='index.php?page=modificationDossier&id=" . $data['id_dossier'] . "&modification=oui'>" . "<input type='submit' class='btn_dossiers' value='&Eacute;diter ?'/></form>" . "<form method='post' action='index.php?page=modificationDossier&id=" . $data['id_dossier'] . "'>" . "<input type='submit' class='btn_dossiers' value='Afficher ?'/></form>" . "</td>";
        echo "</tr>";
    }
    echo "</table>";
}