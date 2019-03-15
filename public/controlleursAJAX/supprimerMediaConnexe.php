<?php
header("Content-Type: text/plain");
require '../variablesApplication.php';
include ("../scriptPHP/connectionBDD.php");
include ("../scriptPHP/arrondis.php");

$prochain = recuperationNbProchainBUZZArtiste($_GET['id'], $_GET['idA'], 3);
$precedent = recuperationNbPrecedentBUZZArtiste($_GET['id'], $_GET['idA'], 3);

if ($prochain != 0) {
    $TweetPlus = recuperationProchainBUZZArtiste($_GET['id'], $_GET['idA'], 3);
    $dataPlus = exploiterLigneResultatBDD_row($TweetPlus);
}
if ($precedent != 0) {
    $TweetMoins = recuperationPrecedentBUZZArtiste($_GET['id'], $_GET['idA'], 3);
    $dataMoins = exploiterLigneResultatBDD_row($TweetMoins);
}

suppressionTweetArtiste($_GET['id'], 3);
$plusDMedias = FALSE;

if ($precedent >= 1) {
    $precedent = recuperationNbPrecedentBUZZArtiste($dataMoins[0], $_GET['idA'], 3);
    $tweet = recuperationTweetArtiste($dataMoins[0], 3);
    $data = exploiterLigneResultatBDD($tweet);
    if ($precedent != 0) {
        $nouveauPrecedent = recuperationPrecedentBUZZArtiste($dataMoins[0], $_GET['idA'], 3);
        $dataMoins = exploiterLigneResultatBDD_row($nouveauPrecedent);
    }
} else 
    if ($prochain >= 1) {
        $prochain = recuperationNbProchainBUZZArtiste($dataPlus[0], $_GET['idA'], 3);
        $tweet = recuperationTweetArtiste($dataPlus[0], 3);
        $data = exploiterLigneResultatBDD($tweet);
        if ($prochain != 0) {
            $nouveauSuivant = recuperationProchainBUZZArtiste($dataPlus[0], $_GET['idA'], 3);
            $dataPlus = exploiterLigneResultatBDD_row($nouveauSuivant);
        }
    } else {
        $plusDMedias = TRUE;
    }

if ($plusDMedias == FALSE) {
    echo "\n" . "<table width='100%' align='center' border='0' cellpadding='0' cellspacing='0'>" . "<tr><td>" . 
    // ."<img src='images/coinHGgris.png' border='0px'/>"
    "</td><td>" . "</td>" . "<td>" . 
    // ."<img src='images/coinHDgris.png' border='0px'/>"
    "</tr><tr>" . "<td width='45px'>";
    if ($precedent != 0) {
        echo "<a id='naviguationMediaConnexe_Prec' href='javascript:;' onClick='AJAXChangerMediaConnexe(" . $dataMoins[0] . ");'><img src='images/flecheg_up.gif' alt='Fleche_gauche' width='45px' height='420px' onMouseOver='this.src=btn_MediaConnexe_G_down' onMouseOut='this.src=btn_MediaConnexe_G_up' onMouseDown='this.src=btn_MediaConnexe_G_hover' /></a>";
    } else {
        echo "<img style='visibility:hidden;' src='images/flecheg_up.gif' alt='Fleche_gauche' width='45px' height='420px'/>";
    }
    echo "</td>" . "<td>" . 

    check_ChaineDeCaracteresDownload($data['codeConnexe']) . 

    "</td>" . "<td width='45px'>";
    if ($prochain != 0) {
        echo "<a id='naviguationMediaConnexe_Suiv' href='javascript:;' onClick='AJAXChangerMediaConnexe(" . $dataPlus[0] . ");'>" . "<img src='images/fleched_up.gif' alt='Fleche_droite' width='45px' height='420px' onMouseOver='this.src=btn_MediaConnexe_D_down' onMouseOut='this.src=btn_MediaConnexe_D_up' onMouseDown='this.src=btn_MediaConnexe_D_hover' /></a>";
    } else {
        echo "<img style='visibility:hidden' src='images/fleched_up.gif' alt='Fleche_droite' width='45px' height='420px' />";
    }
    
    echo "</td></tr>" . "<tr><td>" . 
    // ."<img src='images/coinBGgris.png' border='0px'/>"
    "</td><td>";
    
    echo "<p style='width:615px' ><tt>" . utf8_encode(check_ChaineDeCaracteresDownload($data['text'])) . "</tt>";
    if ($_GET['abs'] == 1) {
        echo "&nbsp;&nbsp; / &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a id='navigationImage' href='javascript:;' onClick='AJAXSupprimerMediaConnexe(" . $data['id_buzz'] . ");'>Supprimer?</a>";
    }
    echo "</p>";
    
    echo "</td>" . "<td>" . 
    // ."<img src='images/coinBDgris.png' border='0px'/>"
    "</td>" . "</tr>";
    
    echo "</table>";
}

