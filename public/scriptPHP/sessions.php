<?php
if (DEV_verificationINCLUSIONS) {
    $page = explode("/", __FILE__);
    $fichier_inclus = array_pop($page);
    echo $fichier_inclus . " >>> OK!";
}

include_once ("connectionBDD.php");

function existe_Log($login)
{
    $login = check_ChaineDeCaracteresUpload($login);
    $resultat = faireUneRequeteOffLine("SELECT pseudo FROM utilisateur WHERE pseudo = '" . $login . "'");
    if (exploiterNombreLigneResultatBDD($resultat) == 0) {
        $existe = false;
    } else {
        $existe = true;
    }
    return $existe;
}

function updateDerniereSession($id_utilisateur)
{
    $resultat = faireUneRequeteOffLine("SELECT nbConnexions FROM utilisateur WHERE id_utilisateur = '$id_utilisateur'");
    $data = exploiterLigneResultatBDD_row($resultat);
    $cpt = $data[0] + 1;
    $date = recupererTimeStampCourant();
    $resultat = faireUneRequeteOffLine("UPDATE utilisateur SET nbConnexions='$cpt',dateDerniereConnexion='$date' WHERE id_utilisateur = '$id_utilisateur'");
    return;
}

function rechercherUtilisateur($login, $pass)
{
    $login = check_ChaineDeCaracteresUpload($login);
    $pass = check_ChaineDeCaracteresUpload($pass);
    $resultat = faireUneRequeteOffLine("SELECT id_utilisateur,statut FROM utilisateur WHERE pseudo = '" . $login . "' AND password = '" . $pass . "'");
    if (exploiterNombreLigneResultatBDD($resultat) == 0) {
        $usr_id = - 1;
    } else {
        $tableauReponse = exploiterLigneResultatBDD($resultat);
        if ($tableauReponse['statut'] == 3) {
            $usr_id = - 2;
        } elseif ($tableauReponse['statut'] == 4) {
            $usr_id = - 3;
        } elseif ($tableauReponse['statut'] == 5) {
            $usr_id = - 4;
        } else {
            $usr_id = $tableauReponse['id_utilisateur'];
        }
    }
    return $usr_id;
}

function rechercherRepertoire($id)
{
    $sql = "SELECT repertoirePersonnel FROM utilisateur WHERE id_utilisateur = '" . $id . "'";
    $req = faireUneRequeteOffLine($sql);
    $data = exploiterLigneResultatBDD_row($req);
    return $data[0];
}

function rechercherNbConnexionCompte($id)
{
    $sql = "SELECT nbConnexions FROM utilisateur WHERE id_utilisateur = '" . $id . "'";
    $req = faireUneRequeteOffLine($sql);
    $data = exploiterLigneResultatBDD_row($req);
    return $data[0];
}

function rechercherTypeDeCompte($id)
{
    $sql = "SELECT type_compte FROM utilisateur WHERE id_utilisateur='" . $id . "'";
    $req = faireUneRequeteOffLine($sql);
    $tableauReponse = exploiterLigneResultatBDD_row($req);
    return $tableauReponse[0];
}

function estAdministrateurOuPas($id)
{
    return ($_SESSION['type_compte'] == '0');
}

function rechercherStatusCompte($id)
{
    $sql = "SELECT statut FROM utilisateur WHERE id_utilisateur='" . $id . "'";
    $req = faireUneRequeteOffLine($sql);
    $tableauReponse = exploiterLigneResultatBDD_row($req);
    return $tableauReponse[0];
}

function rechercherCourriel($email)
{
    
    // JOINTURE
    $sql1 = "SELECT artistes.id_utilisateur,artistes.pseudo,artistes.email,utilisateur.pseudo FROM artistes,utilisateur WHERE artistes.email='" . $email . "' AND artistes.id_utilisateur = utilisateur.id_utilisateur";
    $req1 = faireUneRequeteOffLine($sql1);
    $sql2 = "SELECT associations.id_utilisateur,associations.nom,associations.email,utilisateur.pseudo FROM associations,utilisateur WHERE associations.email='" . $email . "' AND associations.id_utilisateur = utilisateur.id_utilisateur";
    $req2 = faireUneRequeteOffLine($sql2);
    
    $res = array();
    while ($data = exploiterLigneResultatBDD_row($req1)) {
        $res[$data[0]] = $data[1];
    }
    
    while ($data = exploiterLigneResultatBDD_row($req2)) {
        $res[$data[0]] = $data[1];
    }
    
    return $res;
}

function existeCourriel($email)
{
    if (est_de_taille(rechercherCouriel($res) > 0)) {
        return TRUE;
    } else {
        return FALSE;
    }
}

function check_session()
{
    if (! isset($_SESSION['id_utilisateur'])) {
        if ($_SESSION['NoFailleOnLine'] == FALSE) {
            header("location: index.php");
        }
    }
}

function deconnection_session()
{
    
    // destruction de toutes les variables de sessions
    session_unset();
    $_SESSION['NoFailleOnLine'] = FALSE;
    // destruction de la session
    session_destroy();
}
?>
