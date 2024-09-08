<?php
include("../scriptPHP/connectionBDD.php");
session_start();

$identite = check_ChaineDeCaracteresUpload(HTML_ChaineDeCaracteres($_POST['membre']));
$courriel = check_ChaineDeCaracteresUpload(HTML_ChaineDeCaracteres($_POST['courriel']));
$id = $_POST['id'];
modifMembreAsso($identite,$courriel,$id);

header("location: ../index.php?page=compte#ancre_Membre");
