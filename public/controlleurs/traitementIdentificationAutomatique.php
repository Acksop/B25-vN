<?php
require '../variablesApplication.php';
session_start();
include '../scriptPHP/cryptographie.php';
include '../scriptPHP/sessions.php';
include '../scriptPHP/alertesIntrusions.php';

// fonction primaire Grruik ! permettant de sortir exactement les données encryptées
//

$urlParts = explode('.php?l=', $_SERVER['REQUEST_URI']);
$loginParts = explode('&m=', $urlParts[1]);

$inputLoginEncrypted = base64_decode($loginParts[0]);
$inputPassWordEncrypted = base64_decode($loginParts[1]);
// echo $inputLoginEncrypted."<br />";
// echo $inputPassWordEncrypted;

// test sur les chaines de caract�res vides

if ($inputLoginEncrypted != '') {
    $inputLoginEncrypted = decrypter_generique($inputLoginEncrypted);
}
if ($inputPassWordEncrypted != '') {
    $inputPassWordEncrypted = decrypter_generique($inputPassWordEncrypted);
}
$id_utilisateur = rechercherUtilisateur($inputLoginEncrypted, $inputPassWordEncrypted);

// $id_utilisateur = rechercherUtilisateur(decrypter_generique($inputLoginEncrypted),decrypter_generique($inputPassWordEncrypted));

// compteur de tentatives de connections
$itx = incrementerTentativesConnection();
if ($itx < 100) {
    // acc�s normal
    if ($id_utilisateur == - 1) {
        header("location: ../index.php?page=identification&erreur=1");
    } elseif ($id_utilisateur == - 2) {
        // utilisateur kick�
        header("location: ../index.php?page=identification&erreur=2");
    } elseif ($id_utilisateur == - 3) {
        // utilisateur banni
        header("location: ../index.php?page=identification&erreur=3");
    } elseif ($id_utilisateur == - 4) {
        // utilisateur d�sincrit
        header("location: ../index.php?page=identification&erreur=4");
    } else {
        // session_register("id_utilisateur");
        $_SESSION['id_utilisateur'] = $id_utilisateur;
        $_SESSION['identifiant'] = $inputLoginEncrypted;
        $_SESSION['repertoire'] = rechercherRepertoire($id_utilisateur);
        $_SESSION['NoFailleOnLine'] = TRUE;
        $type_compte = rechercherTypeDeCompte($id_utilisateur);
        $status_compte = rechercherStatusCompte($id_utilisateur);
        $SESSION['status_compte'] = $status_compte;
        $_SESSION['type_compte'] = $type_compte;
        $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
        updateDerniereSession($id_utilisateur);
        header("location: ../index.php?page=compte");
    }
} else {
    
    deconnection_session();
    // acharnement
    AlerteSecuriteBruteForce($_POST['identifiant'], $_POST['motDePasse']);
    header("location: ../index.php");
}


