<?php
session_start();
require '../variablesApplication.php';

include ("../scriptPHP/connectionBDD.php");
include ("../scriptPHP/fluxRSS.php");

if (isset($_POST['reecriture'])) {
    include ('../scriptPHP/w-code/wcode.inc.php');
    $wc = new wcode();
    $wc->charger_configuration("../scriptPHP/w-code/wcode.config.php");
    $wc->definir_code($_POST['corps']);
    $r = $wc->lire_code();
    modificationDossierEnValidation($_POST['validation_id'], HTML_ChaineDeCaracteres($_POST['titre']), HTML_ChaineDeCaracteres($_POST['description']), check_ChaineDeCaracteresUpload($wc->code_html), check_ChaineDeCaracteresUpload($wc->code));
    header("location:../index.php?page=validationDossier&id=" . $_POST['validation_id']);
} else {
    insertionValidationDossier($_POST['validation_id']);
    creationFluxRSS();
    header("location:../index.php?page=dossiers");
}
?>
