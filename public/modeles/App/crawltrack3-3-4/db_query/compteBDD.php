<?php
include (dirname(__FILE__) . '/identifiantBDD.php');
require (dirname(__FILE__) . DIRECTORY_SEPARATOR . 'Pear/DB-1.7.14/DB.php');

function connectionBDD_Crawltrack()
{
    global $lienBDD_Crawltrack;
    if (BD_CRAWLTRACK_TYPE_CONNECTION == 0) {
        $lienBDD_Crawltrack = @mysqli_connect(BD_CRAWLTRACK_ADRESSE, BD_CRAWLTRACK_USER, BD_CRAWLTRACK_PASS, BD_CRAWLTRACK_NOM) or exit('erreur de connection...');
        return $lienBDD_Crawltrack;
    } elseif (BD_CRAWLTRACK_TYPE_CONNECTION == - 1) {
        $lienBDD_Crawltrack = @mysql_connect(BD_CRAWLTRACK_ADRESSE, BD_CRAWLTRACK_USER, BD_CRAWLTRACK_PASS) or exit('erreur de connection...');
        @mysql_select_db(BD_CRAWLTRACK_NOM, $lienBDD_Crawltrack) or die('Could not select database.');
        return $lienBDD_Crawltrack;
    } elseif (BD_CRAWLTRACK_TYPE_CONNECTION == 1) {
        $lienBDD = pearConnectionBDD_Crawltrack();
        return $lienBDD;
    } elseif (BD_CRAWLTRACK_TYPE_CONNECTION == 2) {
        $options = array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
        );
        $lienBDD = new PDO(BD_CRAWLTRACK_PDO_DSN, BD_CRAWLTRACK_USER, BD_CRAWLTRACK_PASS, $options);
        return $lienBDD;
    }
}

function deconnectionBDD_Crawltrack($bdd)
{
    global $lienBDD_Crawltrack;
    if (BD_CRAWLTRACK_TYPE_CONNECTION == 0) {
        mysqli_close($lienBDD_Crawltrack);
    } elseif (BD_CRAWLTRACK_TYPE_CONNECTION == - 1) {
        mysql_close($lienBDD_Crawltrack);
    } elseif (BD_CRAWLTRACK_TYPE_CONNECTION == 1) {
        $bdd->disconnect();
    } elseif (BD_CRAWLTRACK_TYPE_CONNECTION == 2) {
        $bdd = null;
    }
}

function pearConnectionBDD_Crawltrack()
{
    $bdd = &DB::connect(BD_CRAWLTRACK_DSN);
    $bdd->setFetchMode(DB_FETCHMODE_ASSOC);
    if (PEAR::isError($bdd)) {
        die($bdd->getMessage());
    }
    return $bdd;
}