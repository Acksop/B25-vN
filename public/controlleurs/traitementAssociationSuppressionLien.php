<?php
include("../scriptPHP/connectionBDD.php");
session_start();
suppressionLienAsso($_GET['id']);
header("location: ../index.php?page=compte#ancre_Lien");
?>
