<?php
require '../variablesApplication.php';
include ("../scriptPHP/sessions.php");
session_start();
check_session();
if (isset($_POST['reecriture'])) {
    include ('../scriptPHP/w-code/wcode.inc.php');
    $wc = new wcode();
    $wc->charger_configuration("wcode.config.php");
    $wc->definir_code($_POST['corps']);
    $r = $wc->lire_code();
    modificationDossierTemporaire($_POST['validation_id'], HTML_ChaineDeCaracteres($_POST['titre']), HTML_ChaineDeCaracteres($_POST['description']), check_ChaineDeCaracteresUpload($wc->code_html), check_ChaineDeCaracteresUpload($wc->code), AfficheDateArticle());
    header("location:../index.php?page=modificationDossierSauvegarder&id=" . $_POST['validation_id']);
} else {
    header("location:../index.php?page=sauvegardeDossiersEnCoursJournaliste");
}
?>
