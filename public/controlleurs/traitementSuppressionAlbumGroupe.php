<?php
require '../variablesApplication.php';

// TODO: ajouter le deplacement du fichier image dans le dossier TEMP des radieurae

include ("../scriptPHP/connectionBDD.php");
session_start();
suppressionAlbumGroupe($_POST['id_album']);
header("location: ../index.php?page=compte#ancre_album");
	