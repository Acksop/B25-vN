<?php
// Fichier : wcode.implementation.php
// Version : 0.4
// Auteur : Alexandre SALOME
// Site WEB : http://wodkaist.free.fr
// ///////////////////////////////////////////////

// Fonction pour inclure le fichier Javascript
function wcode_javascript()
{
    return '
        <script type="text/javascript" src="scriptPHP/w-code/wcode.js"></script>
        ';
}

// Fonction pour les CSS
function wcode_css()
{
    return '
<style type="text/css" media="screen" title="Style par d&eacute;faut">
@import url("scriptPHP/w-code/wcode.style.css");
@import url("scriptPHP/w-code/wcode.style.editeur.css");
</style>
';
}

// Fonction pour afficher l'�diteur
function wcode_editeur($formulaire, $champ, $valeur = "")
{
    $code_editeur = file_get_contents("scriptPHP/w-code/wcode.editeur.inc");
    $panneaux = file_get_contents("scriptPHP/w-code/wcode.editeur.panneaux.inc");
    $code_editeur = str_replace("%%PANNEAUX%%", $panneaux, $code_editeur);
    $code_editeur = str_replace("%%FORMULAIRE%%", $formulaire, $code_editeur);
    $code_editeur = str_replace("%%CHAMP%%", $champ, $code_editeur);
    $code_editeur = str_replace("%%VALEUR%%", $valeur, $code_editeur);
    return $code_editeur;
}

?>
