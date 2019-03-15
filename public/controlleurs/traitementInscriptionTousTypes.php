<?php
require '../variablesApplication.php';
session_start();
include_once ('../scriptPHP/connectionBDD.php');
include_once ('../scriptPHP/sessions.php');
include_once ('../scriptPHP/repertoire.php');

$login = $_POST['identifiant'];
$pass = $_POST['motDePasse1'];
$pass2 = $_POST['motDePasse2'];
$email = $_POST['courriel'];
$type = $_POST['type'];

if (! testH4X0RChaine($login) || ! testH4X0RChaine($pass) || ! testH4X0RChaine($pass2)) {
    $date = AfficheDate();
    /*
     * $pass = destructionH4x0RChaine($pass);
     * $login = destructionH4x0RChaine($login);
     * $repertoirePersonnel = chaineAleatoire().recupererDatePourNouveauRepertoireUtilisateur();
     * $id_utilisateur = inscriptionSite($login,$pass,$repertoirePersonnel,$email,$type,$date);
     * //------------------------------------
     * //creations des r�pertoires personnels
     * creerRepertoiresUtilisateur($repertoirePersonnel);
     * //------------------------------------
     * session_register("id_utilisateur");
     * $_SESSION['id_utilisateur']=$id_utilisateur;
     * $_SESSION['identifiant']=$_POST['identifiant'];
     * $_SESSION['type_compte']=$type;
     * $_SESSION['NoFailleOnLine']=FALSE;
     */
    header("location: ../index.php?page=inscription&erreur=3");
} else {
    if (existe_Log($login) == true) {
        header("location: ../index.php?page=ajoutUtilisateur&erreur=1");
    } else {
        if ($pass != $pass2) {
            header("location: ../index.php?page=ajoutUtilisateur&erreur=2");
        } else {
            $date = AfficheDate();
            $repertoirePersonnel = chaineAleatoire() . recupererDatePourNouveauRepertoireUtilisateur();
            $id_utilisateur = inscriptionSite($login, $pass, $repertoirePersonnel, $email, $type, $date);
            // creations des répertoires personnels
            creerRepertoiresUtilisateur($repertoirePersonnel);
            // actualisation de la page
            header("location: ../index.php?page=compte");
        }
    }
}
