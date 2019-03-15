<?php
require '../variablesApplication.php';
include("../scriptPHP/connectionBDD.php");
session_start();
suppressionMembreAsso($_GET['id']);
header("location: ../index.php?page=compte#ancre_Membre");
?>
