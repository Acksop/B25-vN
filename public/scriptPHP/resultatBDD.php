<?php
if (DEV_verificationINCLUSIONS) {
    $page = explode("/", __FILE__);
    $fichier_inclus = array_pop($page);
    echo $fichier_inclus . " >>> OK!";
}

include ('requeteBDD.php');

function exploiterLigneResultatBDD($res)
{
   
    if (BD_TYPE_CONNECTION == 0) {
        $data = mysqli_fetch_assoc($res);
    } elseif (BD_TYPE_CONNECTION == - 1) {
        $data = mysql_fetch_assoc($res);
    } elseif (BD_TYPE_CONNECTION == 1) {
        $data = $res->fetchRow(DB_FETCHMODE_ASSOC);
    } elseif (BD_TYPE_CONNECTION == 2) {
        $data = $res->fetch(PDO::FETCH_ASSOC);
    }
    
    if ($data == NULL) {
        $data = FALSE;
    }else{
        foreach($data as $key => $value){
            $data[$key] = check_ChaineDeCaracteresDownload($value);
        }
    }
    
    return $data;
}

function exploiterLigneResultatBDD_row($res)
{

    if (BD_TYPE_CONNECTION == 0) {
        $data = mysqli_fetch_row($res);
    } elseif (BD_TYPE_CONNECTION == - 1) {
        $data = mysql_fetch_row($res);
    } elseif (BD_TYPE_CONNECTION == 1) {
        $data = $res->fetchRow(DB_FETCHMODE_ORDERED);
    } elseif (BD_TYPE_CONNECTION == 2) {
        $data = $res->fetch(PDO::FETCH_NUM);
    }
    
    if ($data == NULL) {
        $data = FALSE;
    }else{
        foreach($data as $key => $value){
            $data[$key] = check_ChaineDeCaracteresDownload($value);
        }
    }
    
    return $data;
}

function exploiterNombreLigneResultatBDD($res)
{
    if (BD_TYPE_CONNECTION == 0) {
        $data = mysqli_num_rows($res);
    } elseif (BD_TYPE_CONNECTION == - 1) {
        $data = mysql_num_rows($res);
    } elseif (BD_TYPE_CONNECTION == 1) {
        if (DEBUG == 'TRUE' && PEAR::isError($res)) {
            die($res->getMessage());
        }
        $data = $res->numRows();
    } elseif (BD_TYPE_CONNECTION == 2) {
        $data = $res->rowCount();
    }
    if ($data == NULL) {
        $data = 0;
    } elseif ($data == FALSE) {
        $data = 0;
    }
    return $data;
}