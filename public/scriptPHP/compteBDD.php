<?php
if (DEV_verificationINCLUSIONS) {
    $page = explode("/", __FILE__);
    $fichier_inclus = array_pop($page);
    echo $fichier_inclus . " >>> OK!";
}

include ('identifiantBDD.php');
require (dirname(__FILE__) . DIRECTORY_SEPARATOR . 'Pear/DB-1.7.14/DB.php');

function connectionBDD()
{
    if (BD_TYPE_CONNECTION == 0) {
        $lienBDD = @mysqli_connect(BD_ADRESSE, BD_USER, BD_PASS, BD_NOM) or exit('erreur de connection...');
        @mysqli_query('SET NAMES utf8');
        @mysqli_set_charset('utf8');
        return $lienBDD;
    } elseif (BD_TYPE_CONNECTION == - 1) {
        $lienBDD = @mysql_connect(BD_ADRESSE, BD_USER, BD_PASS) or exit('erreur de connection...');
        @mysql_select_db(BD_NOM, $lienBDD) or die('Could not select database.');
        @mysql_query('SET NAMES utf8');
        @mysql_set_charset('utf8');
        return $lienBDD;
    } elseif (BD_TYPE_CONNECTION == 1) {
        $lienBDD = pearConnectionBDD();
        return $lienBDD;
    } elseif (BD_TYPE_CONNECTION == 2) {
        $options = array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
        );
        $lienBDD = new PDO(BD_PDO_DSN, BD_USER, BD_PASS, $options);
        return $lienBDD;
    }
}

function temp_connectionBDD($type)
{
    if ($type == 0) {
        $lienBDD = @mysqli_connect(BD_ADRESSE, BD_USER, BD_PASS, BD_NOM) or exit('erreur de connection...');
        return $lienBDD;
    } elseif ($type == - 1) {
        $lienBDD = @mysql_connect(BD_ADRESSE, BD_USER, BD_PASS) or exit('erreur de connection...');
        @mysql_select_db(BD_NOM, $lienBDD) or die('Could not select database.');
        return $lienBDD;
    } elseif ($type == 1) {
        $lienBDD = pearConnectionBDD();
        return $lienBDD;
    } elseif ($type == 2) {
        $options = array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
        );
        $lienBDD = new PDO(BD_PDO_DSN, BD_USER, BD_PASS, $options);
        return $lienBDD;
    }
}

function temp_deconnectionBDD($bdd, $type)
{
    if ($type == 0) {
        mysqli_close($bdd);
    } elseif ($type == - 1) {
        mysql_close($bdd);
    } elseif ($type == 1) {
        $bdd->disconnect();
    } elseif ($type == 2) {
        $bdd = null;
    }
}

function deconnectionBDD($bdd)
{
    if (BD_TYPE_CONNECTION == 0) {
        mysqli_close($bdd);
    } elseif (BD_TYPE_CONNECTION == - 1) {
        mysql_close($bdd);
    } elseif (BD_TYPE_CONNECTION == 1) {
        $bdd->disconnect();
    } elseif (BD_TYPE_CONNECTION == 2) {
        $bdd = null;
    }
}

function pearConnectionBDD()
{
    $bdd = &DB::connect(BD_DSN);
    $bdd->setFetchMode(DB_FETCHMODE_ASSOC);
    if (PEAR::isError($bdd)) {
        die($bdd->getMessage());
    }
    return $bdd;
}