<?php
require '../variablesApplication.php';
session_start();
include_once ("../scriptPHP/connectionBDD.php");
if (isset($_GET['validateFromCompte']) && $_GET['validateFromCompte'] == 1) {
    $id = $_SESSION['id_utilisateur'];
    if ($_SESSION['type_compte'] == 2 || $_SESSION['type_compte'] == 4 || $_SESSION['type_compte'] == 6) {
        $data[0] = 2;
    } else {
        $data[0] = 2;
    }
} else 
    if (isset($_GET['desactivateFromCompte']) && $_GET['desactivateFromCompte'] == 1) {
        $id = $_SESSION['id_utilisateur'];
        if ($_SESSION['type_compte'] == 2 || $_SESSION['type_compte'] == 4 || $_SESSION['type_compte'] == 6) {
            $data[0] = 0;
        } else {
            $data[0] = 0;
        }
    } else {
        $id = $_POST['id'];
        $sql = "SELECT statut FROM utilisateur WHERE id_utilisateur = '" . $_POST['id'] . "'";
        $req = faireUneRequeteOffLine($sql);
        $data = exploiterLigneResultatBDD_row($req);
        $data[0] ++;
        $data[0] = $data[0] % 6;
        if ($data[0] == 0) {
            $data[0] = 1;
        }
    }
$sql = "UPDATE utilisateur SET statut= '" . $data[0] . "' WHERE id_utilisateur = '" . $id . "'";
faireUneRequeteOffLine($sql);
if (isset($_GET['validateFromCompte']) || isset($_GET['desactivateFromCompte'])) {
    header("location: ../");
} else {
    header("location: ../index.php?page=gestionUtilisateur");
}
?>
