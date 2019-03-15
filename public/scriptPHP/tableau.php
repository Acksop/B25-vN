<?php
if (DEV_verificationINCLUSIONS) {
    $page = explode("/", __FILE__);
    $fichier_inclus = array_pop($page);
    echo $fichier_inclus . " >>> OK!";
}

function affiche_tableau_associatif($tableau_associatif)
{
    echo "Array (" . "<br />";
    foreach ($tableau_associatif as $cle => $valeur) {
        echo "&nbsp;&nbsp;&nbsp;[$cle] => $valeur<br />";
    }
    echo ")" . "<br/>";
    return;
}

function affiche_tableau_associatif_rec($tableau_associatif)
{
    echo "Array (" . "<br />";
    foreach ($tableau_associatif as $cle => $valeur) {
        echo "&nbsp;&nbsp;&nbsp;[$cle] => " . affiche_tableau_associatif_rec($valeur) . "<br />";
    }
    echo ")" . "<br/>";
    return;
}

function egalité_entre_tableau($tab1, $tab2)
{
    $foo = serialize($tab1);
    $bar = serialize($tab2);
    if ($foo == $bar)
        return true;
}

function affiche_tableau_pre($tableau_associatif)
{
    echo "<pre>";
    print_r($tableau_associatif);
    echo "</pre>";
    return;
}

function generer_tableau_numerique_melanger($combien)
{
    $tableau = array();
    for ($i = 0; $i < $combien; $i ++) {
        array_push($tableau, $i);
    }
    for ($i = 0; $i < $combien * 3; $i ++) {
        $alea = rand(0, $combien - 1);
        $temp = $tableau[$alea];
        $tableau[$alea] = $tableau[$i % $combien];
        $tableau[$i % $combien] = $temp;
    }
    return $tableau;
}

function generer_tableau_numeroter_numerique($taille)
{
    $tableau = array();
    for ($i = 0; $i < $taille; $i ++) {
        array_push($tableau, $i);
    }
    return $tableau;
}

function array_is_empty($array)
{
    $i = 0;
    foreach ($array as $value) {
        ++ $i;
    }
    if ($i != 0) {
        return true;
    } else {
        return false;
    }
}

function est_de_taille($tableau)
{
    return count($tableau);
}
// -> Afin de pouvoir modifier en temps rél la ligne de code numéroté affiché dans
/*      la balise alt des logoo images d'inscriptions, ce TODO doit être réalisé
 * 
 * TODO: realiser un fonction de remplacement d'un valeur définie comme itérative
//          exemple: 
//              $tab = array(VAL,VAL,VAL);
//          devient
//              $tab = Array(1,2,3);
// 
 * piste: array_replace utilisé dans le W-code de vodkaist --> Codes-sources
 *  
 * 
 */
