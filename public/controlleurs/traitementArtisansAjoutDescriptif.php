<?php
include("../scriptPHP/connectionBDD.php");
session_start();

$uid = $_SESSION['id_utilisateur'];
$corps = check_ChaineDeCaracteresUpload($_POST['elm1']);

modifierDescriptifArtisans($uid,$corps);
header("location: ../index.php?page=compte#ancre_descriptif");

?>
