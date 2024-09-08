<?php
session_start();
include('../scriptPHP/connectionBDD.php');
modificationDossierEnLecture($_POST['id']);
header("location:../index.php?page=choixDossier");
?>
