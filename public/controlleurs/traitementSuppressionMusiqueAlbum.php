<?php
require '../variablesApplication.php';

// TODO: Ajouter le deplacement des fichiers musicaux dans le dossiers temp des Radieurae

session_start();
include ("../scriptPHP/connectionBDD.php");
suppressionMusiqueAlbumGroupe($_GET['id']);
header("location: ../index.php?page=compte#ancre_albums");
