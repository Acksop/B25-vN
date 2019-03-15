<?php
header("Content-Type: text/plain");
require '../variablesApplication.php';
include ("../scriptPHP/connectionBDD.php");

$id_buzz = $_GET['id'];
suppressionBUZZ($_GET['id']);

echo "&nbsp; enlevé! BUZZ!";


