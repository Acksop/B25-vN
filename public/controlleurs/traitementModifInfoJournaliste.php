<?php
require '../variablesApplication.php';
session_start();
include_once ('../scriptPHP/connectionBDD.php');
include_once ('../scriptPHP/chaineDeCaracteres.php');

// quel est le lib a changer?
if (isset($_POST['nom'])) {
    $nom = check_ChaineDeCaracteresUpload($_POST['nom']);
    $nom = HTML_ChaineDeCaracteres($nom);
    modifierInfoJournaliste($nom, 'nom', $_SESSION['id_utilisateur']);
} else 
    if (isset($_POST['rencontre'])) {
        $rencontre = check_ChaineDeCaracteresUpload($_POST['rencontre']);
        $rencontre = HTML_ChaineDeCaracteres($rencontre);
        modifierInfoJournaliste($rencontre, 'rencontre', $_SESSION['id_utilisateur']);
    } else 
        if (isset($_POST['geolocalisation'])) {
            $geolocalisation = check_ChaineDeCaracteresUpload($_POST['geolocalisation']);
            $geolocalisation = HTML_ChaineDeCaracteres($geolocalisation);
            modifierInfoJournaliste($geolocalisation, 'geolocalisation', $_SESSION['id_utilisateur']);
        } else 
            if (isset($_POST['signature'])) {
                $signature = HTML_ChaineDeCaracteres($_POST['signature']);
                $signature = traduireDesPartiesDeChaineEnCommmandesBang($signature);
                $signature = check_ChaineDeCaracteresUpload($signature);
                modifierInfoJournaliste($signature, 'signature', $_SESSION['id_utilisateur']);
            } else 
                if (isset($_POST['email'])) {
                    $email = check_ChaineDeCaracteresUpload($_POST['email']);
                    $email = HTML_ChaineDeCaracteres($email);
                    modifierInfoJournaliste($email, 'email', $_SESSION['id_utilisateur']);
                } else 
                    if (isset($_POST['surnom'])) {
                        $surnom = check_ChaineDeCaracteresUpload($_POST['surnom']);
                        $surnom = HTML_ChaineDeCaracteres($surnom);
                        modifierInfoJournaliste($surnom, 'surnom', $_SESSION['id_utilisateur']);
                    } else 
                        if (isset($_POST['prenom'])) {
                            $prenom = check_ChaineDeCaracteresUpload($_POST['prenom']);
                            $prenom = HTML_ChaineDeCaracteres($prenom);
                            modifierInfoJournaliste($prenom, 'prenom', $_SESSION['id_utilisateur']);
                        }
header("location: ../index.php?page=compte#ancre_formulaire");

?>
