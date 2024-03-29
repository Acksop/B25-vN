<?php
// ----------------------------------------------------------------------
// CrawlTrack 3.3.2
// ----------------------------------------------------------------------
// Crawler Tracker for website
// ----------------------------------------------------------------------
// Author: Jean-Denis Brun
// ----------------------------------------------------------------------
// Code cleaning: Philippe Villiers
// ----------------------------------------------------------------------
// Website: www.crawltrack.net
// ----------------------------------------------------------------------
// That script is distributed under GNU GPL license
// ----------------------------------------------------------------------
// file: login.php
// ----------------------------------------------------------------------
// Last update: 17/11/2011
// Modified for v3-3-4
// use with ../include/config-connect.php
// ----------------------------------------------------------------------
// error_reporting(0);
session_start();
// database connection
include ("../include/configconnect.php");
include ("../include/post.php");
$crawlencode = urlencode($crawler);
// get the functions files
$times = 0;
include ("../include/functions.php");
$connexion = connectionBDD_Crawltrack();

// clear the cache folder at the first entry on crawltrack to avoid to have it oversized
$dir = dir('../cache/');
while (false !== $entry = $dir->read()) {
    // Skip pointers
    if ($entry == '.' || $entry == '..') {
        continue;
    }
    unlink("../cache/$entry");
}
// clear the cachecloseperiod folder if there is more than 200 files in it to avoid to have it oversized
$list = glob("../cachecloseperiod/*.gz");
if (count($list) > 200) {
    $dir = dir('../cachecloseperiod/');
    while (false !== $entry = $dir->read()) {
        // Skip pointers
        if ($entry == '.' || $entry == '..') {
            continue;
        }
        unlink("../cachecloseperiod/$entry");
    }
}
// clear cache table
$sqlcache = "TRUNCATE TABLE crawlt_cache";
$requetecache = faireUneRequeteOnLine_Crawltrack($sqlcache, $connexion);

// clear graph table
$sqlcache = "TRUNCATE TABLE crawlt_graph";
$requetecache = faireUneRequeteOnLine_Crawltrack($sqlcache, $connexion);

// get values
if (isset($_POST['userlogin'])) {
    $userlogin = $_POST['userlogin'];
} else {
    $userlogin = '';
}
if (isset($_POST['userpass'])) {
    $userpass = $_POST['userpass'];
} else {
    $userpass = '';
}
if (isset($_POST['graphpos'])) {
    $graphpos = $_POST['graphpos'];
} else {
    if (isset($_GET['graphpos'])) {
        $graphpos = $_GET['graphpos'];
    } else {
        $graphpos = 0;
    }
}

// mysql query
$sqllogin = "SELECT * FROM crawlt_login";
$requetelogin = faireUneRequeteOnLine_Crawltrack($sqllogin, $connexion) or die("MySQL query error");
if (isset($crawlthost)) // version >= 150
{
    $sqllogin2 = "SELECT public FROM crawlt_config";
    $requetelogin2 = faireUneRequeteOnLine_Crawltrack($sqllogin2, $connexion) or die("MySQL query error");
}
// mysql connexion close
deconnectionBDD_Crawltrack($connexion);
$validuser = 0;
$userpass2 = md5($userpass);
$rightadmin = 0;
$rightsite = '';

while ($ligne = exploiterLigneResultatBDD_Crawltrack($requetelogin)) {
    $user = $ligne['crawlt_user'];
    $passw = $ligne['crawlt_password'];
    $admin = $ligne['admin'];
    $sitelog = $ligne['site'];
    if ($user == $userlogin && $passw == $userpass2) {
        $rightsite = $sitelog;
        $rightadmin = $admin;
        $validuser = 1;
    }
}
if (isset($crawlthost)) // version >= 150
{
    while ($ligne2 = exploiterLigneResultatBDD_Crawltrack($requetelogin2)) {
        $crawltpublic = $ligne2['public'];
    }
} else {
    $crawltpublic = 0;
}
if ($validuser == 1) {
    if (! isset($_SESSION['flag'])) {
        $_SESSION['flag'] = true;
    }
    
    // create token
    // Thanks to François Lasselin (http://blog.nalis.fr/index.php?post/2009/09/28/Securisation-stateless-PHP-avec-un-jeton-de-session-%28token%29-protection-CSRF-en-PHP)
    $validity_time = 1800;
    $token_clair = $secret_key . $_SERVER['HTTP_HOST'] . $_SERVER['HTTP_USER_AGENT'];
    $informations = time() . "-" . $user;
    $token = hash('sha256', $token_clair . $informations);
    setcookie("session_token", $token, time() + $validity_time, '/');
    setcookie("session_informations", $informations, time() + $validity_time, '/');
    
    // we define session variables
    $_SESSION['cookie'] = 1;
    $_SESSION['userlogin'] = $userlogin;
    $_SESSION['rightsite'] = $rightsite;
    $_SESSION['rightadmin'] = $rightadmin;
    $_SESSION['rightspamreferer'] = 1;
    if (! isset($_SESSION['clearcache'])) {
        $_SESSION['clearcache'] = "0";
    }
    /*
     * Afin de changer le mot de passe dans mysql
     * echo $userpass2
     */
    if ($crawltpublic == 1 && $logitself != 1) {
        if (! $_SESSION['inMVC']) {
            header("Location: ../index.php?navig=6&graphpos=$graphpos&nocookie=1");
        } else {
            header("Location: /index.php?{$varGetIncludePageWithRedirection}navig=6&graphpos=$graphpos&nocookie=1");
        }
        exit();
    } else {
        if (! $_SESSION['inMVC']) {
            header("Location: ../index.php?navig=$navig&period=$period&site=$site&crawler=$crawlencode&graphpos=$graphpos&displayall=$displayall&nocookie=1");
        } else {
            header("Location: /index.php?{$varGetIncludePageWithRedirection}navig=$navig&period=$period&site=$site&crawler=$crawlencode&graphpos=$graphpos&displayall=$displayall&nocookie=1");
        }
        exit();
    }
} else {
    if (! $_SESSION['inMVC']) {
        header("Location: ../index.php?navig=6&period=$period&site=$site&crawler=$crawlencode&graphpos=$graphpos&displayall=$displayall");
    } else {
        header("Location: /index.php?{$varGetIncludePageWithRedirection}navig=6&period=$period&site=$site&crawler=$crawlencode&graphpos=$graphpos&displayall=$displayall");
    }
    exit();
}
