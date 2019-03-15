<?php
require '../variablesApplication.php';
include ('../scriptPHP/connectionBDD.php');
include ('../scriptPHP/courrier.php');

$courriel = $_POST['courriel'];
if (emailValide($courriel)) {
    $sql = "SELECT artistes.id_utilisateur FROM artistes WHERE artistes.email='" . $courriel . "'";
    $resultat = faireUneRequeteOffLine($sql);
    if (exploiterNombreLigneResultatBDD($resultat) == 0) {
        $sql = "SELECT associations.id_utilisateur FROM associations WHERE associations.email='" . $courriel . "'";
        $resultat = faireUneRequeteOffLine($sql);
        if (exploiterNombreLigneResultatBDD($resultat) == 0) {
            $sql = "SELECT journalistes.id_utilisateur FROM journalistes WHERE journalistes.email='" . $courriel . "'";
            $resultat = faireUneRequeteOffLine($sql);
            if (exploiterNombreLigneResultatBDD($resultat) == 0) {
                header("location: ../index.php?page=oubliMdp&erreur=1");
            }
        }
    }
    $reponse = exploiterLigneResultatBDD($resultat);
    $sql = "SELECT pseudo,password FROM utilisateur WHERE id_utilisateur='" . $reponse['id_utilisateur'] . "'";
    $resultat = faireUneRequeteOffLine($sql);
    $reponse = exploiterLigneResultatBDD($resultat);
    // -----------------------------------------------------------------------------------------------------echo $courriel." ".$reponse['password'].":".$reponse['pseudo'];
    envoiCourrierRecuperation($courriel, $reponse['password'], $reponse['pseudo']);
    header("location: ../index.php?page=oubliMdp&envoi=1");
} else {
    header("location: ../index.php?page=oubliMdp&erreur=2");
}

?>
