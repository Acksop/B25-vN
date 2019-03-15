<?php
require '../variablesApplication.php';
include ("../scriptPHP/date.php");
include ("../scriptPHP/connectionBDD.php");
session_start();
suppressionValidationDossier($_POST['validation_id']);
header("location:../index.php?page=validationDossier");
?>
