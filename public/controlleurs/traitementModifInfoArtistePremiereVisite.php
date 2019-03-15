<?php
require '../variablesApplication.php';
session_start();
include_once ('../scriptPHP/connectionBDD.php');
include_once ('../scriptPHP/chaineDeCaracteres.php');

// on coupe l'arbre d'un coup avec plusieurs petits coup de machette ??

$nom = check_ChaineDeCaracteresUpload($_POST['nom']);
$nom = HTML_ChaineDeCaracteres($nom);
modifierInfoArtiste($nom, 'nom', $_SESSION['id_utilisateur']);
$description = HTML_ChaineDeCaracteres($_POST['description']);
$description = traduireDesPartiesDeChaineEnCommmandesBang($description);
$description = check_ChaineDeCaracteresUpload($description);
modifierInfoArtiste($description, 'description', $_SESSION['id_utilisateur']);
$telephone = check_ChaineDeCaracteresUpload($_POST['telephone']);
$telephone = HTML_ChaineDeCaracteres($telephone);
modifierInfoArtiste($telephone, 'telephone', $_SESSION['id_utilisateur']);
$email = check_ChaineDeCaracteresUpload($_POST['email']);
$email = HTML_ChaineDeCaracteres($email);
modifierInfoArtiste($email, 'email', $_SESSION['id_utilisateur']);
$pseudo = check_ChaineDeCaracteresUpload($_POST['pseudo']);
$pseudo = HTML_ChaineDeCaracteres($pseudo);
modifierInfoArtiste($pseudo, 'pseudo', $_SESSION['id_utilisateur']);
$prenom = check_ChaineDeCaracteresUpload($_POST['prenom']);
$prenom = HTML_ChaineDeCaracteres($prenom);
modifierInfoArtiste($prenom, 'prenom', $_SESSION['id_utilisateur']);
$siteInterWeb = check_ChaineDeCaracteresUpload($_POST['siteInterWeb']);
$siteInterWeb = HTML_ChaineDeCaracteres($siteInterWeb);
modifierInfoArtiste($siteInterWeb, 'siteInterWeb', $_SESSION['id_utilisateur']);
header("location: ../index.php?page=compte#ancre_formulaire");

?>
