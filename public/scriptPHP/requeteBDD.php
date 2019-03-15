<?php
if (DEV_verificationINCLUSIONS) {
    $page = explode("/", __FILE__);
    $fichier_inclus = array_pop($page);
    echo $fichier_inclus . " >>> OK!";
}

include ('compteBDD.php');

function faireUneRequeteOffLine($sql)
{
    $bdd = connectionBDD();
    if (BD_TYPE_CONNECTION == 0) {
        if (DEBUG == 'TRUE') {
            $req = mysqli_query($bdd, $sql) or die('Erreur SQL !<br>' . $sql . '<br>' . mysqli_error());
        } else {
            $req = mysqli_query($bdd, $sql);
        }
    } elseif (BD_TYPE_CONNECTION == - 1) {
        if (DEBUG == 'TRUE') {
            $req = mysql_query($sql, $bdd) or die('Erreur SQL !<br>' . $sql . '<br>' . mysql_error());
        } else {
            $req = mysql_query($sql, $bdd);
        }
    } elseif (BD_TYPE_CONNECTION == 1) {
        $req = faireUneRequetePear_offLine($sql, $bdd);
    } elseif (BD_TYPE_CONNECTION == 2) {
        
        $req = $bdd->prepare($sql);
        $req->execute();
    }
    deconnectionBDD($bdd);
    return $req;
}

function faireUneRequeteOnLine($sql, $bdd)
{
    if (BD_TYPE_CONNECTION == 0) {
        if (DEBUG == 'TRUE') {
            $req = mysqli_query($bdd, $sql) or die('Erreur SQL !<br>' . $sql . '<br>' . mysqli_error());
        } else {
            $req = mysqli_query($bdd, $sql);
        }
    } elseif (BD_TYPE_CONNECTION == - 1) {
        if (DEBUG == 'TRUE') {
            $req = mysql_query($sql, $bdd) or die('Erreur SQL !<br>' . $sql . '<br>' . mysql_error());
        } else {
            $req = mysql_query($sql, $bdd);
        }
    } elseif (BD_TYPE_CONNECTION == 1) {
        $req = faireUneRequetePear_offLine($sql, $bdd);
    } elseif (BD_TYPE_CONNECTION == 2) {
        
        $req = $bdd->prepare($sql);
        $req->execute();
    }
    return $req;
}

function faireUneRequetePear_offLine($sql, $bdd)
{
    $res = & $bdd->query($sql);
    if (DEBUG == 'TRUE' && PEAR::isError($res)) {
        die($res->getMessage());
    }
    return $res;
}