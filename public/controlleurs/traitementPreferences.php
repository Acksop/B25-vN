<?php
require '../variablesApplication.php';
session_start();
include ("../scriptPHP/cookies.php");

choixInterface($_POST['interface']);
choixBandeauAnim($_POST['bandeauAnim']);
choixGlyph($_POST['polices']);
choixTailleLecture($_POST['tailleLecture']);
choixCouleur($_POST['couleurIHM']);
choixVersion($_POST['versionIHM']);

header("location: ../index.php?page=preferences")?>

