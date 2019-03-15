<?php
include (dirname(__FILE__) . '/compteBDD.php');

// function to count the number of mysql query
function db_query($sql, $lienBDD)
{
    global $numbquery, $lienBDD_Crawltrack;
    $numbquery ++;
    return faireUneRequeteOnLine_Crawltrack($sql, $lienBDD_Crawltrack);
}

function faireUneRequeteOffLine_Crawltrack($sql)
{
    $bdd = connectionBDD();
    if (BD_CRAWLTRACK_TYPE_CONNECTION == 0) {
        if (DEBUG == 'TRUE') {
            $req = mysqli_query($bdd, $sql) or die('Erreur SQL !<br>' . $sql . '<br>' . mysqli_error());
        } else {
            $req = mysqli_query($bdd, $sql);
        }
    } elseif (BD_CRAWLTRACK_TYPE_CONNECTION == - 1) {
        if (DEBUG == 'TRUE') {
            $req = mysql_query($sql, $bdd) or die('Erreur SQL !<br>' . $sql . '<br>' . mysql_error());
        } else {
            $req = mysql_query($sql, $bdd);
        }
    } elseif (BD_CRAWLTRACK_TYPE_CONNECTION == 1) {
        $req = faireUneRequetePear_Crawltrack_offLine($sql, $bdd);
    } elseif (BD_CRAWLTRACK_TYPE_CONNECTION == 2) {
        
        $req = $bdd->prepare($sql);
        $req->execute();
        
        // $req = $bdd->query($sql);
    }
    deconnectionBDD($bdd);
    return $req;
}

function faireUneRequeteOnLine_Crawltrack($sql, $bdd)
{
    if (BD_CRAWLTRACK_TYPE_CONNECTION == 0) {
        if (DEBUG == 'TRUE') {
            $req = mysqli_query($bdd, $sql) or die('Erreur SQL !<br>' . $sql . '<br>' . mysqli_error());
        } else {
            $req = mysqli_query($bdd, $sql);
        }
    } elseif (BD_CRAWLTRACK_TYPE_CONNECTION == - 1) {
        if (DEBUG == 'TRUE') {
            $req = mysql_query($sql, $bdd) or die('Erreur SQL !<br>' . $sql . '<br>' . mysql_error());
        } else {
            $req = mysql_query($sql, $bdd);
        }
    } elseif (BD_CRAWLTRACK_TYPE_CONNECTION == 1) {
        $req = faireUneRequetePear_Crawltrack_offLine($sql, $bdd);
    } elseif (BD_CRAWLTRACK_TYPE_CONNECTION == 2) {
        $req = $bdd->prepare($sql);
        $req->execute();
        
        // $req = $bdd->query($sql);
    }
    return $req;
}

function faireUneRequetePear_Crawltrack_offLine($sql, $bdd)
{
    $res = & $bdd->query($sql);
    if (DEBUG == 'TRUE' && PEAR::isError($res)) {
        die($res->getMessage());
    }
    return $res;
}
