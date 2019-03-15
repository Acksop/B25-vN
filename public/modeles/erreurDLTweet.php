<?php

function LancerAffichageDuCorps()
{
    $erreurDL = $_GET['type'];
    $name = $_GET['fichier'];
    
    if ($erreurDL == 1 || $erreurDL == 2) {
        echo "<p class='utilisateurs'>La taille de " . $name . " est trop grande</p>";
    } elseif ($erreurDL == 3) {
        echo "<p class='utilisateurs'>Fichier " . $name . " partiellement upload&eacute;</p>";
    } elseif ($erreurDL == 4) {
        echo "<p class='utilisateurs'>Fichier " . $name . " introuvable</p>";
    } elseif ($erreurDL == - 1) {
        echo "<p class='utilisateurs'>Vous avez tent&eacute; de <B>H4ck3r</B> le serveur, dommage pour vous ...</p>";
        // recuperation IP H4XOR
        AlerteSecuriteDLImage();
    } elseif ($erreurDL == - 2) {
        echo "<p class='utilisateurs'>Ce fichier n'est pas valide</p>";
    } elseif ($erreurDL == - 3) {
        echo "<p class='utilisateurs'>Le transfert sur le serveur &eacute;t&eacute; interrompu</p>";
    } elseif ($erreurDL == - 4) {
        echo "<p class='utilisateurs'>Le transfert sur le serveur &agrave; &eacute;chou&eacute;</p>";
    } elseif ($erreurDL == - 5) {
        echo "<p class='utilisateurs'>&Ecirc;tes-vous s&ucirc;r d'avoir choisi un Fichier sur votre disque ?</p>";
    } elseif ($erreurDL == - 6) {
        echo "<p class='utilisateurs'>Le redimentionnement de votre image sur le serveur &agrave; &eacute;chou&eacute;</p>";
    } elseif ($erreurDL == - 10) {
        echo "<p class='utilisateurs'>L'adresse du M&eacute;dia connexe :: " . $name . " :: que vous avez mis n'est pas reconnue ...</p>";
    } else {
        echo "<p class='utilisateurs'>Erreur Inconnue lors du t&eacute;l&eacute;chargement de " . $name . "</p>";
    }
}