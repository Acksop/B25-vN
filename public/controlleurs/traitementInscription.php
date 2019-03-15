<?php
require '../variablesApplication.php';
session_start();
include ('../scriptPHP/connectionBDD.php');
include_once ('../scriptPHP/sessions.php');
include_once ('../scriptPHP/date.php');
include_once ('../scriptPHP/courrier.php');
include_once ('../scriptPHP/repertoire.php');

$tabCorrespondanceTypeInscription = Array(
    'AZ123' => '2',
    'QS456' => '3',
    'WX789' => '4',
    'PO987' => '5',
    'ML654' => '6',
    'NB321' => '7',
    'GF357' => '8',
    'HJ159' => '9'
);

$login = check_ChaineDeCaracteresUpload($_POST['identifiant']);
$pass = check_ChaineDeCaracteresUpload($_POST['motDePasse1']);
$pass2 = check_ChaineDeCaracteresUpload($_POST['motDePasse2']);
$email = check_ChaineDeCaracteresUpload($_POST['courriel']);
if (! isset($_POST['type'])) {
    $type = 2;
} else {
    $type = (int) $tabCorrespondanceTypeInscription[$_POST['type']];
    if ($type == '0') {
        $type = 8;
        AlerteSecuriteInscriptionSU();
        header('location:index.php?page=compte');
        die();
    }
}

if (! emailValide($email) || ! testH4X0RChaine($login) || ! testH4X0RChaine($pass) || ! testH4X0RChaine($pass2)) {
    $date = AfficheDate();

    if (! emailValide($email)) {
        header("location: ../index.php?page=inscription&erreur=4");
    } else {
        header("location: ../index.php?page=inscription&erreur=3");
    }
    
} else {
    
    if (existe_Log($login) == true) {
        header("location: ../index.php?page=inscription&erreur=1");
    } else {
        if ($pass != $pass2) {
            header("location: ../index.php?page=inscription&erreur=2");
        } else {
            
            $date = AfficheDate();
            $repertoirePersonnel = chaineAleatoire() . recupererDatePourNouveauRepertoireUtilisateur();
            $id_utilisateur = inscriptionSite($login, $pass, $repertoirePersonnel, $email, $type, $date);
            
            // creations des répertoires personnels
            creerRepertoiresUtilisateur($repertoirePersonnel);
            
            $_SESSION['id_utilisateur'] = $id_utilisateur;
            $_SESSION['identifiant'] = $_POST['identifiant'];
            $_SESSION['type_compte'] = - 1;
            
            $sql = "INSERT INTO estRelierA(idCompte1,idCompte2) VALUES ('" . $id_utilisateur . "','-1')";
            $req = faireUneRequeteOffLine($sql);
            
            $_SESSION['type_compte_user'] = $type;
            $_SESSION['NoFailleOnLine'] = TRUE;
            header("location: ../index.php?page=compte");
        }
    }
}

