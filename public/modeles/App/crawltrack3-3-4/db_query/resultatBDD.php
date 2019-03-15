<?php
include (dirname(__FILE__) . '/requeteBDD.php');

function exploiterLigneResultatBDD_Crawltrack($res)
{
    global $lienBDD_Crawltrack;
    if (BD_CRAWLTRACK_TYPE_CONNECTION == 0) {
        $data = mysqli_fetch_assoc($res);
    } elseif (BD_CRAWLTRACK_TYPE_CONNECTION == - 1) {
        $data = mysql_fetch_assoc($res);
    } elseif (BD_CRAWLTRACK_TYPE_CONNECTION == 1) {
        $data = $res->fetchRow(DB_FETCHMODE_ASSOC);
    } elseif (BD_CRAWLTRACK_TYPE_CONNECTION == 2) {
        $data = $res->fetch(PDO::FETCH_ASSOC);
    }
    if ($data == NULL) {
        $data = FALSE;
    }
    return $data;
}

function exploiterLigneResultatBDD_Crawltrack_row($res)
{
    global $lienBDD_Crawltrack;
    if (BD_CRAWLTRACK_TYPE_CONNECTION == 0) {
        $data = mysqli_fetch_row($res);
    } elseif (BD_CRAWLTRACK_TYPE_CONNECTION == - 1) {
        $data = mysql_fetch_row($res);
    } elseif (BD_CRAWLTRACK_TYPE_CONNECTION == 1) {
        $data = $res->fetchRow(DB_FETCHMODE_ORDERED);
    } elseif (BD_CRAWLTRACK_TYPE_CONNECTION == 2) {
        $data = $res->fetch(PDO::FETCH_NUM);
    }
    if ($data == NULL) {
        $data = FALSE;
    }
    return $data;
}

function exploiterNombreLigneResultatBDD_Crawltrack($res)
{
    global $lienBDD_Crawltrack;
    if (BD_CRAWLTRACK_TYPE_CONNECTION == 0) {
        $data = mysqli_num_rows($res);
    } elseif (BD_CRAWLTRACK_TYPE_CONNECTION == - 1) {
        $data = mysql_num_rows($res);
    } elseif (BD_CRAWLTRACK_TYPE_CONNECTION == 1) {
        if (DEBUG == 'TRUE' && PEAR::isError($res)) {
            // TODO: afficher la requete qui provoque l'erreur quitte a jouter des variables dans PEAR:DB::
            die($res->getMessage());
        }
        $data = $res->numRows();
    } elseif (BD_CRAWLTRACK_TYPE_CONNECTION == 2) {
        $data = $res->rowCount();
    }
    if ($data == NULL) {
        $data = 0;
    } elseif ($data == FALSE) {
        $data = 0;
    }
    return $data;
}