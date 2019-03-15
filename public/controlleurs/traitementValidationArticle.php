<?php
session_start();
require '../variablesApplication.php';

include ("../scriptPHP/connectionBDD.php");
include ("../scriptPHP/fluxRSS.php");

insertionValidationArticle($_GET['id']);
creationFluxRSS();
header("location: ../index.php?page=articles");
?>
