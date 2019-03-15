<?php
header("Content-Type: text/plain; charset=UTF-8");
header("Charset: UTF-8");

require '../variablesApplication.php';
require '../scriptPHP/connectionBDD.php';

// affichage des anciens et des pseudo-nouveaux messages...
$sql = "SELECT * FROM Tchat ORDER BY id_dialogue DESC LIMIT 100";
$req_dialogue = faireUneRequeteOffline($sql);
$i = 0;
while ($dialogue = exploiterLigneResultatBDD($req_dialogue)) {
    echo "<li style='list-style-type:none;'";
    if ($dialogue['valide'] == 1) {
        echo "<ul><B>" . $dialogue['date'] . ": </B>&nbsp;&nbsp;";
        echo $dialogue['corpsDuTexte'] . "</ul>";
        if ($i > 20)
            break;
        ++$i;
    }
    echo "</li>";
}