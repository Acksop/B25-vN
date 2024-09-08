<?php
include("../scriptPHP/connectionBDD.php");
session_start();

$adresse = check_ChaineDeCaracteresUpload(HTML_ChaineDeCaracteres($_POST['adresse']));
$id = $_POST['id'];
modifLienAsso($adresse,$id);

header("location: ../index.php?page=compte#ancre_Lien");
