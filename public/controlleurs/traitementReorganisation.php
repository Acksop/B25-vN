<?php
require '../variablesApplication.php';
include ("../scriptPHP/connectionBDD.php");

function recuperationIDassociation($id_utilisateur, $bdd)
{
    $sql = "SELECT id_association FROM associations WHERE id_utilisateur = '" . $id_utilisateur . "'";
    $req = faireUneRequeteOnline($sql, $bdd);
    $data = exploiterLigneResultatBDD_row($req);
    return $data[0];
}

function recuperationIDartiste($id_utilisateur, $bdd)
{
    $sql = "SELECT id_artiste FROM artistes WHERE id_utilisateur = '" . $id_utilisateur . "'";
    $req = faireUneRequeteOnline($sql, $bdd);
    $data = exploiterLigneResultatBDD_row($req);
    return $data[0];
}

function recuperationIDjournaliste($id_utilisateur, $bdd)
{
    $sql = "SELECT id_journaliste FROM journalistes WHERE id_utilisateur = '" . $id_utilisateur . "'";
    $req = faireUneRequeteOnline($sql, $bdd);
    $data = exploiterLigneResultatBDD_row($req);
    return $data[0];
}

function recuperationIDarticles($id_utilisateur, $bdd)
{
    $sql = "SELECT id_article FROM articles WHERE id_utilisateur = '" . $id_utilisateur . "'";
    $req = faireUneRequeteOnline($sql, $bdd);
    return $req;
}

function recuperationIDarticlesEnValidations($id_utilisateur, $bdd)
{
    $sql = "SELECT id_article FROM articlesEnValidations WHERE id_utilisateur = '" . $id_utilisateur . "'";
    $req = faireUneRequeteOnline($sql, $bdd);
    return $req;
}

function recuperationIDdossiers($id_utilisateur, $bdd)
{
    $sql = "SELECT id_dossier FROM dossiers WHERE id_utilisateur = '" . $id_utilisateur . "'";
    $req = faireUneRequeteOnline($sql, $bdd);
    return $req;
}

function recuperationIDdossiersEnValidations($id_utilisateur, $bdd)
{
    $sql = "SELECT id_dossier FROM dossiersEnValidations WHERE id_utilisateur = '" . $id_utilisateur . "'";
    $req = faireUneRequeteOnline($sql, $bdd);
    return $req;
}

function modifierIDsutilisateur($id_utilisateur, $type_compte, $nouvel_id, $bdd)
{
    switch ($type_compte) {
        case 0:
            // echo "no way;";
            break;
        case 1:
            $id_temp = recuperationIDjournaliste($id_utilisateur, $bdd);
            $sql = "UPDATE journalistes SET id_utilisateur = '" . $nouvel_id . "' WHERE id_journaliste='" . $id_temp . "'";
            $id_temp = recuperationIDarticles($id_utilisateur, $bdd);
            while ($data = exploiterLigneResultatBDD_row($id_temp)) {
                $sql2 = "UPDATE articles SET id_utilisateur= '" . $nouvel_id . "' WHERE id_article='" . $data[0] . "'";
                faireUneRequeteOnLine($sql2, $bdd);
            }
            $id_temp = recuperationIDarticlesEnValidations($id_utilisateur, $bdd);
            while ($data = exploiterLigneResultatBDD_row($id_temp)) {
                $sql3 = "UPDATE articlesEnValidations SET id_utilisateur= '" . $nouvel_id . "' WHERE id_article='" . $data[0] . "'";
                faireUneRequeteOnLine($sql3, $bdd);
            }
            $id_temp = recuperationIDdossiers($id_utilisateur, $bdd);
            while ($data = exploiterLigneResultatBDD_row($id_temp)) {
                $sql4 = "UPDATE dossiers SET id_utilisateur= '" . $nouvel_id . "' WHERE id_dossier='" . $data[0] . "'";
                faireUneRequeteOnLine($sql4, $bdd);
            }
            $id_temp = recuperationIDdossiersEnValidations($id_utilisateur, $bdd);
            while ($data = exploiterLigneResultatBDD_row($id_temp)) {
                $sql5 = "UPDATE dossiersEnValidation SET id_utilisateur= '" . $nouvel_id . "' WHERE id_dossier='" . $data[0] . "'";
                faireUneRequeteOnLine($sql5, $bdd);
            }
            faireUneRequeteOnLine($sql, $bdd);
            break;
        case 2:
        case 4:
            $id_temp = recuperationIDartiste($id_utilisateur, $bdd);
            $sql = "UPDATE artistes SET id_utilisateur = '" . $nouvel_id . "' WHERE id_artiste='" . $id_temp . "'";
            faireUneRequeteOnLine($sql, $bdd);
            break;
        case 3:
        case 5:
            $id_temp = recuperationIDassociation($id_utilisateur, $bdd);
            $sql = "UPDATE associations SET id_utilisateur = '" . $nouvel_id . "' WHERE id_association='" . $id_temp . "'";
            faireUneRequeteOnLine($sql, $bdd);
            break;
    }
    return (0);
}

function reorganisationUtilisateurs()
{
    $id_2_base = recuperationIDBase();
    $bdd = connectionBDD();
    $sql = "DELETE FROM dossiersTemporaires";
    $sql0 = "DELETE FROM utilisateur";
    $sql1 = "SELECT * FROM utilisateur WHERE id_utilisateur < '" . $id_2_base . "' ORDER BY id_utilisateur ASC";
    $sql2 = "SELECT * FROM utilisateur WHERE id_utilisateur > '" . $id_2_base . "' ORDER BY id_utilisateur ASC";
    $sql3 = "SELECT * FROM utilisateur WHERE id_utilisateur = '" . $id_2_base . "'";
    faireUneRequeteOnLine($sql, $bdd);
    $req1 = faireUneRequeteOnLine($sql1, $bdd);
    $req2 = faireUneRequeteOnLine($sql2, $bdd);
    $req3 = faireUneRequeteOnLine($sql3, $bdd);
    faireUneRequeteOnLine($sql0, $bdd);
    $i = 1;
    while ($data = exploiterLigneResultatBDD($req1)) {
        $sqlFinal = "INSERT INTO utilisateur VALUES( " . "'" . $i . "'," . "'" . check_ChaineDeCaracteresUpload_OnLine(check_ChaineDeCaracteresDownload($data['pseudo'])) . "'," . "'" . check_ChaineDeCaracteresUpload_OnLine(check_ChaineDeCaracteresDownload($data['password'])) . "'," . "'" . $data['dateInscription'] . "'," . "'" . $data['dateDerniereConnexion'] . "'," . "'" . $data['nbConnexions'] . "'," . "'" . $data['type_compte'] . "'," . "'" . $data['statut'] . "')";
        modifierIDsUtilisateur($data['id_utilisateur'], $data['type_compte'], $i, $bdd);
        faireUneRequeteOnLine($sqlFinal, $bdd);
        $i ++;
    }
    while ($data = exploiterLigneResultatBDD($req2)) {
        $sqlFinal = "INSERT INTO utilisateur VALUES( " . "'" . $i . "'," . "'" . check_ChaineDeCaracteresUpload_OnLine(check_ChaineDeCaracteresDownload($data['pseudo'])) . "'," . "'" . check_ChaineDeCaracteresUpload_OnLine(check_ChaineDeCaracteresDownload($data['password'])) . "'," . "'" . $data['dateInscription'] . "'," . "'" . $data['dateDerniereConnexion'] . "'," . "'" . $data['nbConnexions'] . "'," . "'" . $data['type_compte'] . "'," . "'" . $data['statut'] . "')";
        modifierIDsUtilisateur($data['id_utilisateur'], $data['type_compte'], $i, $bdd);
        faireUneRequeteOnLine($sqlFinal, $bdd);
        $i ++;
    }
    $alea = rand(0, 2);
    $data = exploiterLigneResultatBDD($req3);
    modifierIDsUtilisateur($data['id_utilisateur'], 1, $i, $bdd);
    modifierIDsUtilisateur($data['id_utilisateur'], 2, $i, $bdd);
    modifierIDsUtilisateur($data['id_utilisateur'], 3, $i, $bdd);
    switch ($data['type_compte']) {
        case 0:
            // Le compte de TEST est super-utilisateur No--WAY , théoriquement impossible
            break;
        case 1: // journaliste
            $sqlFinal = "INSERT INTO utilisateur VALUES('" . $i . "','','','19 janvier 2038 3:14:07 GMT','0000-00-00 00:00:00', '0','2','" . $alea . "')";
            break;
        case 2: // artiste
            $sqlFinal = "INSERT INTO utilisateur VALUES('" . $i . "','','','19 janvier 2038 3:14:07 GMT','0000-00-00 00:00:00','0','3','" . $alea . "')";
            break;
        case 3: // association
            $sqlFinal = "INSERT INTO utilisateur VALUES('" . $i . "','','','19 janvier 2038 3:14:07 GMT','0000-00-00 00:00:00','0','4','" . $alea . "')";
            break;
        case 4: // artisans
            $sqlFinal = "INSERT INTO utilisateur VALUES('" . $i . "','','','19 janvier 2038 3:14:07 GMT','0000-00-00 00:00:00','0','5','" . $alea . "')";
            break;
        case 5: // groupe
            $sqlFinal = "INSERT INTO utilisateur VALUES('" . $i . "','','','19 janvier 2038 3:14:07 GMT','0000-00-00 00:00:00','0','1','" . $alea . "')";
            break;
        default: // Artiste
            $sqlFinal = "INSERT INTO utilisateur VALUES('" . $i . "','','','19 janvier 2038 3:14:07 GMT','0000-00-00 00:00:00','0','2','0')";
    }
    faireUneRequeteOnline($sqlFinal, $bdd);
    deconnectionBDD($bdd);
    return (0);
}
session_start();
reorganisationUtilisateurs();
header("location: ../index.php?page=compte");