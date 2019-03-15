<?php
require '../variablesApplication.php';
include ("../scriptPHP/connectionBDD.php");

insertionDialogue($_POST['corpsDuTexte']);
header("location: ../index.php");

function insertionDialogue($corps)
{
    // r�cuperation des preferences
    $sql = "SELECT gueuloir FROM B25_preferences";
    $req = faireUneRequeteOffLine($sql);
    $preference_gueuloir = exploiterLigneResultatBDD_row($req);
    // insertions du message
    $heure = date("H");
    $minutes = date("i");
    $heure_insert = $heure . ":" . $minutes;
    $message_insert = $corps;
    
    $sql = "INSERT INTO Tchat(date,corpsDuTexte,valide) VALUES('" . $heure_insert . "','" . check_ChaineDeCaracteresUpload(ajoutBaliseHREFText(HTML_ChaineDeCaracteres($message_insert))) . "','" . $preference_gueuloir[0] . "')";
    $req = faireUneRequeteOffline($sql);
    return;
}