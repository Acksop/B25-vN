<?php
require '../variablesApplication.php';
session_start();
include ('../scriptPHP/sessions.php');
include ('../scriptPHP/alertesIntrusions.php');
$id_utilisateur = rechercherUtilisateur($_POST['identifiant'], $_POST['motDePasse']);
// compteur de tentatives de connections
$itx = incrementerTentativesConnection();
if ($itx < 100) {
    // acc�s normal
    if ($id_utilisateur == - 1) {
        header("location: ../index.php?page=identification&erreur=1");
    } elseif ($id_utilisateur == - 2) {
        // utilisateur kické
        header("location: ../index.php?page=identification&erreur=2");
    } elseif ($id_utilisateur == - 3) {
        // utilisateur banni
        header("location: ../index.php?page=identification&erreur=3");
    } elseif ($id_utilisateur == - 4) {
        // utilisateur désincrit
        header("location: ../index.php?page=identification&erreur=4");
    } else {
        // session_register("id_utilisateur");
        $_SESSION['id_utilisateur'] = $id_utilisateur;
        $_SESSION['identifiant'] = $_POST['identifiant'];
        $_SESSION['repertoire'] = rechercherRepertoire($id_utilisateur);
        $_SESSION['NoFailleOnLine'] = TRUE;
        $type_compte = rechercherTypeDeCompte($id_utilisateur);
        $status_compte = rechercherStatusCompte($id_utilisateur);
        $_SESSION['status_compte'] = $status_compte;
        $_SESSION['type_compte'] = $type_compte;
        $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
        
        $nbConnexionCompte = rechercherNbConnexionCompte($id_utilisateur);
        if ($nbConnexionCompte > 1) {
            $sql = "DELETE FROM estRelierA WHERE idCompte2 = '-1' AND idCompte1 = '" . $id_utilisateur . "'";
            $req = faireUneRequeteOffLine($sql);
        }
        if($id_utilisateur == 1 && $type_compte == 0){
            //les variables de SESSION de Crawltrack
             $_SESSION['userlogin'] = 'root';
             $_SESSION['clearcache'] = 0;
             $_SESSION['rightspamreferer'] = 1;
             $_SESSION['rightadmin'] = 1;
             $_SESSION['cookie'] = 1;
             $_SESSION['cleaning'] = 1;
             $_SESSION['rightsite'] = 0;
        }
        updateDerniereSession($id_utilisateur);
        header("location: ../index.php?page=compte");
    }
} else {
    // acharnement
    AlerteSecuriteBruteForce($_POST['identifiant'], $_POST['motDePasse']);
    header("location: ../index.php?page=identification&erreur=5");
}
?>
