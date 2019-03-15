<?php
if (DEV_verificationINCLUSIONS) {
    $page = explode("/", __FILE__);
    $fichier_inclus = array_pop($page);
    echo $fichier_inclus . " >>> OK!";
}

/**
 * Ce script PHP permet d'instancier une r��criture d'un zone texte contenues dans la base de donn�e
 * Il est un pr�misce � l'�laboration d'une r��criture de donn�es sous la forme d'actions et de convertisseurs
 *
 * Soit par un language pr�fix�,
 * Ce qui est le cas dans ce fichier
 *
 * soit par un balisage Wiki similaire au Wikini
 *
 * L'instanciation de convertion en entr�e se fait avec la fonction :
 * traduireDesPartiesDeChaineEnCommmandesBang($chaine);
 *
 * L'instanciation d'action (convertion en sortie) se fait avec la fonction :
 * traduireLesCommandesBangDelaChaine($chaine);
 *
 * V0.1:
 * seul les commandes !B25|LINK
 */
function supprimerCommmandeBangDansUneChaine($chaine)
{
    $chaine = supprimerLes_B4NG_Links($chaine);
    return $chaine;
}

function supprimerLes_B4NG_Links($chaine)
{
    $a = strpos($chaine, "!B25|LINK", 0);
    if ($a) {
        $b = strpos($chaine, "!", $a + 1);
        if (! $b) {
            $b = strlen($chaine);
        }
        $b = $b + 1;
        $z = $b - $a;
        $c = substr($chaine, $a, $z);
        $d = substr($chaine, 0, $a);
        $y = strlen($chaine);
        $x = $y - $b;
        $e = substr($chaine, $b, $x);
        $w = strlen($c);
        
        $chaine = $d . supprimerLes_B4NG_Links($e);
        return $chaine;
    } else {
        return $chaine;
    }
}

function traduireDesPartiesDeChaineEnCommmandesBang($chaine)
{
    $chaine = traduireEnUploadLes_B4NG_Links($chaine);
    return $chaine;
}

function traduireEnUploadLes_B4NG_Links($chaine)
{
    $a = strpos($chaine, "http://", 0);
    if ($a) {
        $b = strpos($chaine, " ", $a);
        if (! $b) {
            $b = strlen($chaine);
        }
        $z = $b - $a;
        $c = substr($chaine, $a, $z);
        $d = substr($chaine, 0, $a);
        $y = strlen($chaine);
        $x = $y - $b;
        $e = substr($chaine, $b, $x);
        $w = strlen($c);
        
        $code = "<a href='{$c}'>" . $c . "</a>";
        
        $sql = "SELECT id_bang_link FROM B25_bang_links WHERE adresse='{$c}'";
        if (exploiterNombreLigneResultatBDD(faireUneRequeteOffline($sql)) == 0) {
            $sql = "INSERT INTO B25_bang_links(adresse,code) VALUES('{$c}','" . check_ChaineDeCaracteresUpload($code) . "')";
            $data = faireUneRequeteOffline($sql);
            $sql = "SELECT id_bang_link FROM B25_bang_links WHERE adresse='{$c}'";
            $data = exploiterLigneResultatBDD_row($data);
            $id = $data[0];
        } else {
            $data = faireUneRequeteOffline($sql);
            $data = exploiterLigneResultatBDD_row($data);
            $id = $data[0];
        }
        $chaine = $d . " !B25|LINK|{$id}! " . traduireEnUploadLes_B4NG_Links($e);
        return $chaine;
    } else {
        return $chaine;
    }
}

function traduireLesCommandesBangDelaChaine($chaine)
{
    $chaine = traduireEnDowloadLes_B4NG_Links($chaine);
    return $chaine;
}

function traduireEnDowloadLes_B4NG_Links($chaine)
{
    $a = strpos($chaine, "!B25|LINK", 0);
    if ($a) {
        $b = strpos($chaine, "!", $a + 1);
        if (! $b) {
            $b = strlen($chaine);
        }
        $b = $b + 1;
        $z = $b - $a;
        $c = substr($chaine, $a, $z);
        
        $d = substr($chaine, 0, $a);
        $y = strlen($chaine);
        $x = $y - $b;
        $e = substr($chaine, $b, $x);
        $w = strlen($c);
        
        $b4Ng = explode("|", $c);
        $id_link = $b4Ng[2];
        
        $sql = "SELECT code FROM B25_bang_links WHERE id_bang_link='{$id_link}'";
        $data = faireUneRequeteOffline($sql);
        $data = exploiterLigneResultatBDD_row($data);
        $code = $data[0];
        
        $chaine = $d . $code . traduireEnDowloadLes_B4NG_Links($e);
        return $chaine;
    } else {
        return $chaine;
    }
}

