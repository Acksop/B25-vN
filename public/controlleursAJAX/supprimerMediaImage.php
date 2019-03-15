<?php
header("Content-Type: text/plain; charset=UTF-8");
require '../variablesApplication.php';
include ("../scriptPHP/connectionBDD.php");
include ("../scriptPHP/arrondis.php");

$prochain = recuperationNbProchainBUZZArtiste($_GET['id'], $_GET['idA'], 1);
$precedent = recuperationNbPrecedentBUZZArtiste($_GET['id'], $_GET['idA'], 1);

if ($prochain != 0) {
    $TweetPlus = recuperationProchainBUZZArtiste($_GET['id'], $_GET['idA'], 1);
    $dataPlus = exploiterLigneResultatBDD_row($TweetPlus);
}
if ($precedent != 0) {
    $TweetMoins = recuperationPrecedentBUZZArtiste($_GET['id'], $_GET['idA'], 1);
    $dataMoins = exploiterLigneResultatBDD_row($TweetMoins);
}

$data = recuperationTweetArtiste($_GET['id'], 1);
$data = exploiterLigneResultatBDD($data);
$adresseOriginal = RADIEURAE_REP_PATH . $data['original'];
$adresseFichier = RADIEURAE_REP_PATH . $data['image'];
$adresseCopie = RADIEURAE_REP_PATH . "upload_utilisateurs/TEMP/" . $data['nomImage'];
copy($adresseOriginal, $adresseCopie);
unlink($adresseOriginal);
unlink($adresseFichier);

suppressionTweetArtiste($_GET['id'], 1);

$plusDImages = FALSE;

if ($precedent >= 1) {
    $precedent = recuperationNbPrecedentBUZZArtiste($dataMoins[0], $_GET['idA'], 1);
    $tweet = recuperationTweetArtiste($dataMoins[0], 1);
    $data = exploiterLigneResultatBDD($tweet);
    if ($precedent != 0) {
        $nouveauPrecedent = recuperationPrecedentBUZZArtiste($dataMoins[0], $_GET['idA'], 1);
        $dataMoins = exploiterLigneResultatBDD_row($nouveauPrecedent);
    }
} else 
    if ($prochain >= 1) {
        $prochain = recuperationNbProchainBUZZArtiste($dataPlus[0], $_GET['idA'], 1);
        $tweet = recuperationTweetArtiste($dataPlus[0], 1);
        $data = exploiterLigneResultatBDD($tweet);
        if ($prochain != 0) {
            $nouveauSuivant = recuperationProchainBUZZArtiste($dataPlus[0], $_GET['idA'], 1);
            $dataPlus = exploiterLigneResultatBDD_row($nouveauSuivant);
        }
    } else {
        $plusDImages = TRUE;
    }

if ($plusDImages == FALSE) {
    echo "<div class='B25-cadre'>";
    
    echo "<center><p style='background-color: #BBB;'><br/><img src='" . RADIEURAE_SVN_PATH . $data['image'] . "' alt='" . $data['nomImage'] . "'/><br/><br/>";
    if ($precedent != 0) {
        echo "<span style='float:left;'><a id='naviguationImage_Prec' href='javascript:;' onClick='AJAXChangerImage(" . $dataMoins[0] . ");'>&lt;&lt;&lt;&lt;</a></span>";
    } else {
        echo "<span style='float:left;'>&lt;&lt;&lt;&lt;</span>";
    }
    echo "<span style='float:center;'><tt>" . utf8_encode(check_ChaineDeCaracteresDownload($data['text'])) . "</tt>";
    if ($_GET['abs'] == 1) {
        echo "&nbsp;&nbsp;<a id='navigationImage' href='javascript:;' onClick='AJAXSupprimerImage(" . $data['id_buzz'] . ");'>Supprimer?</a>";
    }
    echo "</span>";
    if ($prochain != 0) {
        echo "<span style='float:right;'><a id='naviguationImage_Suiv' href='javascript:;' onClick='AJAXChangerImage(" . $dataPlus[0] . ");'>&gt;&gt;&gt;&gt;</a></span>";
    } else {
        echo "<span style='float:right;'>&gt;&gt;&gt;&gt;</span>";
    }
    echo "</p></center>";
    
    echo "</div>";
}


