<?php
header("Content-Type: text/plain");
include("../scriptPHP/connectionBDD.php");

$id_buzz = $_GET['id'];
suppressionBUZZ($_GET['id']);

//cette commande pose des problèmes de securité
//elle peut être commandé depuis n'importe quel site du fait de son GET venant de murInscrit.php
// ajouter un controle de l'ip de la date et un controle du sit'e referent
// afin de le positionner dans les alerte HAXOR
}