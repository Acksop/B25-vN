<?php
session_start();
require '../variablesApplication.php';
require '../scriptPHP/tableau.php';
header("Content-Type: text/plain; charset=utf-8");
$id = $_GET['id'];
// $id = '0';
$key = ini_get("session.upload_progress.prefix") . $id;
// var_dump($_SESSION[$key]);
// affiche_tableau_associatif($_SESSION[$key]);
if (isset($_SESSION[$key])) {
    $percent_upload = round(($_SESSION[$key]["bytes_processed"] / $_SESSION[$key]["content_length"]) * 100);
    echo $percent_upload;
} else {
    echo '100';
}