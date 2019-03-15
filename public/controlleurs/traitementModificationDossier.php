<?php
require '../variablesApplication.php';
include ("../scriptPHP/connectionBDD.php");
session_start();
if (isset($_POST['reecriture'])) {
    include ('../scriptPHP/w-code/wcode.inc.php');
    $wc = new wcode();
    $wc->charger_configuration("wcode.config.php");
    $wc->definir_code($_POST['corps']);
    $r = $wc->lire_code();
    modificationDossier($_POST['validation_id'], HTML_ChaineDeCaracteres($_POST['titre']), HTML_ChaineDeCaracteres($_POST['description']), check_ChaineDeCaracteresUpload($wc->code_html), check_ChaineDeCaracteresUpload($wc->code));
    header("location:../index.php?page=modificationDossier&id=" . $_POST['validation_id']);
} else {
    header("location:../index.php?page=compte");
}
?>
