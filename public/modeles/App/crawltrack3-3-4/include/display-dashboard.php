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
// file: display-dashboard.php
// ----------------------------------------------------------------------
// Last update: 22/11/2011
// ----------------------------------------------------------------------
if (! defined('IN_CRAWLT')) {
    exit('<h1>Hacking attempt !!!!</h1>');
}
// initialize array
$count = array();
$countperiod = array();
$linkname = array();
$nbrerrorattack = 0;
$nbrerrorcrawler = 0;
$nbrerrordirect = 0;
$nbrerrorextern = 0;
$nbrerrorintern = 0;
$nbrcss = 0;
$nbrsql = 0;
$tablinkexalead = array();
$tabpageexalead = array();
$tabpagemsn = array();
$tablinkyahoo = array();
$tabpageyahoo = array();
$tablinkdelicious = array();
$tablinkgoogle = array();
$tabpagegoogle = array();
$values2 = array();
$visitgoogle = 0;
$visitgooglebot = 0;
$visitgoogleimage = 0;
$visitgoogleadsense = 0;
$visitmsn = 0;
$visityahoo = 0;
$visityandex = 0;
$visitexalead = 0;
$visityandex = 0;
$visitbaidu = 0;
$visitaol = 0;
$UVlast7days = array();
$UVlast30days = array();
// cache name
$crawlencode = urlencode($crawler);

$cachename = $navig . $period . $site . $order . $crawlencode . $displayall . $firstdayweek . $localday . $graphpos . $crawltlang;

// start the caching
cache($cachename);
// database connection
$connexion = connectionBDD_Crawltrack();

// date for the mysql query
if ($period >= 10) {
    $datetolookfor = " date >'" . sql_quote($daterequest) . "' 
    AND  date <'" . sql_quote($daterequest2) . "'";
} else {
    $datetolookfor = " date >'" . sql_quote($daterequest) . "'";
}
// include menu
cadreDebut();
include (dirname(__FILE__) . "/menumain.php");
include (dirname(__FILE__) . "/menusite.php");
include (dirname(__FILE__) . "/timecache.php");
cadreFin();
// clean table from crawler entry
include (dirname(__FILE__) . "/cleaning-crawler-entry.php");
// include visitors calculation file
include (dirname(__FILE__) . "/visitors-calculation.php");
if ($totalvisitor > 0) {
    if ($visitsendgoogle > 0) {
        $values2[$language['google']] = $visitsendgoogle;
    }
    if ($visitsendgoogleimage > 0) {
        $values2[$language['googleimage']] = $visitsendgoogleimage;
    }
    if ($visitsendmsn > 0) {
        $values2[$language['msn']] = $visitsendmsn;
    }
    if ($visitsendyahoo > 0) {
        $values2[$language['yahoo']] = $visitsendyahoo;
    }
    if ($visitsendask > 0) {
        $values2[$language['ask']] = $visitsendask;
    }
    if ($visitsendexalead > 0) {
        $values2[$language['baidu']] = $visitsendexalead;
    }
    if ($visitsendyandex > 0) {
        $values2[$language['yandex']] = $visitsendyandex;
    }
    if ($visitsendaol > 0) {
        $values2[$language['aol']] = $visitsendaol;
    }
    if ($visitsendother > 0) {
        $values2[$language['website']] = $visitsendother;
    }
    if ($visitdirect > 0) {
        $values2[$language['direct']] = $visitdirect;
    }
    arsort($values2);
} else {
    $values2 = array();
}
// crawler calculation-----------------------------------------------------------------------------------------------
if ($period == 3 || ($period >= 200 && $period < 300) || $period >= 1000 || ($period >= 100 && $period < 200) || ($period >= 300 && $period < 400)) {
    // query to have the number of Crawler visits
    $sql = "SELECT crawler_name, COUNT(id_visit) 
    FROM crawlt_visits
    INNER JOIN crawlt_crawler
    ON crawlt_visits.crawlt_crawler_id_crawler=crawlt_crawler.id_crawler
    WHERE DATE(crawlt_visits.date) ='" . sql_quote($daterequestseo) . "'
    AND crawlt_site_id_site='" . sql_quote($site) . "'
    AND crawler_name IN ('GoogleBot','MSN Bot','Slurp Inktomi (Yahoo)','YandexBot','Exabot','Baiduspider','Bingbot','Google-Adsense','Google-Image') 
    GROUP BY  crawler_name";
    $requete = faireUneRequeteOnLine_Crawltrack($sql, $connexion);
    while ($ligne = exploiterLigneResultatBDD_Crawltrack_row($requete)) {
        if ($ligne[0] == 'GoogleBot') {
            $visitgooglebot = $ligne[1];
        } elseif ($ligne[0] == 'MSN Bot' || $ligne[0] == 'Bingbot') {
            $visitmsn = $ligne[1] + $visitmsn;
        } elseif ($ligne[0] == 'Slurp Inktomi (Yahoo)') {
            $visityahoo = $ligne[1];
        } elseif ($ligne[0] == 'YandexBot') {
            $visityandex = $ligne[1];
        } elseif ($ligne[0] == 'Exabot') {
            $visitexalead = $ligne[1];
        } elseif ($ligne[0] == 'Baiduspider') {
            $visitbaidu = $ligne[1];
        } elseif ($ligne[0] == 'Google-Image') {
            $visitgoogleimage = $ligne[1];
        } elseif ($ligne[0] == 'Google-Adsense') {
            $visitgoogleadsense = $ligne[1];
        }
    }
    $visitgoogle = $visitgoogleadsense + $visitgoogleimage + $visitgooglebot;
} else {
    // query to have the number of Crawler visits
    $sql = "SELECT crawler_name, COUNT( id_visit) 
    FROM crawlt_visits
    INNER JOIN crawlt_crawler
    ON crawlt_visits.crawlt_crawler_id_crawler=crawlt_crawler.id_crawler
    WHERE DATE(crawlt_visits.date) >='" . sql_quote($daterequestseo) . "'
    AND crawlt_visits.crawlt_site_id_site='" . sql_quote($site) . "'
    AND crawler_name IN ('GoogleBot','MSN Bot','Slurp Inktomi (Yahoo)','YandexBot','Exabot','Baiduspider','Bingbot','Google-Adsense','Google-Image')
    GROUP BY crawler_name";
    $requete = faireUneRequeteOnLine_Crawltrack($sql, $connexion);
    while ($ligne = exploiterLigneResultatBDD_Crawltrack_row($requete)) {
        if ($ligne[0] == 'GoogleBot') {
            $visitgooglebot = $ligne[1];
        } elseif ($ligne[0] == 'MSN Bot' || $ligne[0] == 'Bingbot') {
            $visitmsn = $ligne[1] + $visitmsn;
        } elseif ($ligne[0] == 'Slurp Inktomi (Yahoo)') {
            $visityahoo = $ligne[1];
        } elseif ($ligne[0] == 'YandexBot') {
            $visityandex = $ligne[1];
        } elseif ($ligne[0] == 'Exabot') {
            $visitexalead = $ligne[1];
        } elseif ($ligne[0] == 'Baiduspider') {
            $visitbaidu = $ligne[1];
        } elseif ($ligne[0] == 'Google-Image') {
            $visitgoogleimage = $ligne[1];
        } elseif ($ligne[0] == 'Google-Adsense') {
            $visitgoogleadsense = $ligne[1];
        }
    }
    $visitgoogle = $visitgoogleadsense + $visitgoogleimage + $visitgooglebot;
}
// query to count the total number of pages viewed ,total number of visits and total number of crawler
$sqlstats2 = "SELECT COUNT(DISTINCT crawlt_pages_id_page), COUNT(DISTINCT crawler_name), COUNT(id_visit) 
  FROM crawlt_visits
  INNER JOIN crawlt_crawler
  ON crawlt_visits.crawlt_crawler_id_crawler=crawlt_crawler.id_crawler
  AND $datetolookfor         
  AND crawlt_visits.crawlt_site_id_site='" . sql_quote($site) . "'";
$requetestats2 = faireUneRequeteOnLine_Crawltrack($sqlstats2, $connexion);
$ligne2 = exploiterLigneResultatBDD_Crawltrack_row($requetestats2);
$nbrtotpages = $ligne2[0];
$nbrtotcrawlers = $ligne2[1];
$nbrtotvisits = $ligne2[2];
// Indexation calculation----------------------------------------------------------------------------------------
// query to get the msn and yahoo positions data and the number of Delicious bookmarks and Delicious keywords
if ($period >= 10) {
    $sqlseo = "SELECT   linkyahoo, pageyahoo,  pagemsn, nbrdelicious, linkexalead, pageexalead, linkgoogle, pagegoogle
    FROM crawlt_seo_position
    WHERE  id_site='" . sql_quote($site) . "'
    AND  date >='" . sql_quote($daterequestseo) . "' 
    AND  date <'" . sql_quote($daterequest2seo) . "'        
    ORDER BY date";
} else {
    $sqlseo = "SELECT  linkyahoo, pageyahoo,  pagemsn, nbrdelicious, linkexalead, pageexalead, linkgoogle, pagegoogle
    FROM crawlt_seo_position
    WHERE  id_site='" . sql_quote($site) . "' 
    AND  date >='" . sql_quote($daterequestseo) . "'        
    ORDER BY date";
}
$requeteseo = faireUneRequeteOnLine_Crawltrack($sqlseo, $connexion);
$nbrresult = exploiterNombreLigneResultatBDD_Crawltrack($requeteseo);
if ($nbrresult >= 1) {
    while ($ligneseo = exploiterLigneResultatBDD_Crawltrack_row($requeteseo)) {
        $tablinkgoogle[] = $ligneseo[6];
        $tabpagegoogle[] = $ligneseo[7];
    }
    // preparation of values for display
    if ($period == 0 || $period >= 1000) {
        $linkgoogle = numbdisp($tablinkgoogle[($nbrresult - 1)]);
        $pagegoogle = numbdisp($tabpagegoogle[($nbrresult - 1)]);
    } else {
        $linkgoogle = numbdisp($tablinkgoogle[0]) . " --> " . numbdisp($tablinkgoogle[($nbrresult - 1)]);
        $pagegoogle = numbdisp($tabpagegoogle[0]) . " --> " . numbdisp($tabpagegoogle[($nbrresult - 1)]);
    }
} else {
    $valueindexationend = 0;
    $valueindexationbeginning = 0;
    $linkgoogle = 0;
    $pagegoogle = 0;
}
// Hacking attempts calculation-----------------------------------------------------------------------------------
$sql = "SELECT crawlt_crawler_id_crawler, COUNT(id_visit) 
FROM crawlt_visits
WHERE crawlt_crawler_id_crawler IN ('65500','65501')
AND $datetolookfor       
AND crawlt_visits.crawlt_site_id_site='" . sql_quote($site) . "'
GROUP BY crawlt_crawler_id_crawler";
$requete = faireUneRequeteOnLine_Crawltrack($sql, $connexion);
while ($ligne = exploiterLigneResultatBDD_Crawltrack_row($requete)) {
    if ($ligne[0] == 65500) {
        $nbrcss = $ligne[1];
    }
    if ($ligne[0] == 65501) {
        $nbrsql = $ligne[1];
    }
}
// download calculation----------------------------------------------------------------------------------------------
// query to have the total since beginning
if ($period >= 10) {
    $sql = "SELECT link, SUM(count) 
    FROM crawlt_download
    WHERE  idsite='" . sql_quote($site) . "'
    AND  date <'" . sql_quote($daterequest2seo) . "'
    GROUP BY link";
} else {
    $sql = "SELECT link, SUM(count) 
    FROM crawlt_download
    WHERE  idsite='" . sql_quote($site) . "'
    GROUP BY link";
}
$requete = faireUneRequeteOnLine_Crawltrack($sql, $connexion);
$num_rows = exploiterNombreLigneResultatBDD_Crawltrack($requete);
if ($num_rows > 0) {
    while ($ligne = exploiterLigneResultatBDD_Crawltrack_row($requete)) {
        $explodelink = explode('/', $ligne[0]);
        $countexplode = count($explodelink) - 1;
        if ($explodelink[$countexplode] != "") {
            $linkname[$ligne[0]] = $explodelink[$countexplode];
            $count[$linkname[$ligne[0]]] = $ligne[1] + @$count[$linkname[$ligne[0]]];
            $countperiod[$linkname[$ligne[0]]] = 0;
        }
    }
} else {
    $count = array();
    $countperiod = array();
    $linkname = array();
}
// query to have the number for the period
if ($period >= 10) {
    $sql = "SELECT link, count 
    FROM crawlt_download
    WHERE  idsite='" . sql_quote($site) . "'
    AND  date >='" . sql_quote($daterequestseo) . "' 
    AND  date <'" . sql_quote($daterequest2seo) . "'";
} else {
    $sql = "SELECT link, count 
    FROM crawlt_download
    WHERE  idsite='" . sql_quote($site) . "'
    AND  date >='" . sql_quote($daterequestseo) . "'";
}
$requete = faireUneRequeteOnLine_Crawltrack($sql, $connexion);
$num_rows = exploiterNombreLigneResultatBDD_Crawltrack($requete);
if ($num_rows > 0) {
    while ($ligne = exploiterLigneResultatBDD_Crawltrack_row($requete)) {
        $explodelink = explode('/', $ligne[0]);
        $countexplode = count($explodelink) - 1;
        $linkname[$ligne[0]] = $explodelink[$countexplode];
        $countperiod[$linkname[$ligne[0]]] = @$countperiod[$linkname[$ligne[0]]] + $ligne[1];
    }
}
arsort($count);
// error 404 calculation------------------------------------------------------------------------------------------------
// attack
if ($period >= 10) {
    $sql = "SELECT attacktype, count 
    FROM crawlt_error
    WHERE  idsite='" . sql_quote($site) . "'
    AND  date >='" . sql_quote($daterequestseo) . "' 
    AND  date <'" . sql_quote($daterequest2seo) . "'
    GROUP BY attacktype";
} else {
    $sql = "SELECT attacktype, count 
    FROM crawlt_error
    WHERE  idsite='" . sql_quote($site) . "'
    AND  date >='" . sql_quote($daterequestseo) . "'
    GROUP BY attacktype";
}
$requete = faireUneRequeteOnLine_Crawltrack($sql, $connexion);
$num_rows = exploiterNombreLigneResultatBDD_Crawltrack($requete);
if ($num_rows > 0) {
    while ($ligne = exploiterLigneResultatBDD_Crawltrack_row($requete)) {
        $nbrerrorattack = $nbrerrorattack + $ligne[1];
        if ($ligne[0] == '65500') {
            $nbrcss = $nbrcss + $ligne[1];
        } elseif ($ligne[0] == '65501') {
            $nbrsql = $nbrsql + $ligne[1];
        }
    }
}
// crawler
$sql = "SELECT  COUNT(id_visit) 
FROM crawlt_visits
WHERE  $datetolookfor       
AND crawlt_visits.crawlt_site_id_site='" . sql_quote($site) . "'
AND crawlt_error='1'";
$requete = faireUneRequeteOnLine_Crawltrack($sql, $connexion);
$num_rows = exploiterNombreLigneResultatBDD_Crawltrack($requete);
if ($num_rows > 0) {
    $ligne = exploiterLigneResultatBDD_Crawltrack_row($requete);
    $nbrerrorcrawler = $ligne[0];
}
// visitors external link
$sql = "SELECT COUNT(id_visit) 
FROM crawlt_visits_human
INNER JOIN crawlt_referer
ON  crawlt_visits_human.crawlt_id_referer=crawlt_referer.id_referer
AND $datetolookfor       
AND crawlt_visits_human.crawlt_site_id_site='" . sql_quote($site) . "'
AND Substring(referer From 1 For " . $lengthurl . ") != '" . sql_quote($hostsite) . "'
AND crawlt_id_referer !='0'
AND crawlt_error='1'";
$requete = faireUneRequeteOnLine_Crawltrack($sql, $connexion);
$num_rows = exploiterNombreLigneResultatBDD_Crawltrack($requete);
if ($num_rows > 0) {
    $ligne = exploiterLigneResultatBDD_Crawltrack_row($requete);
    $nbrerrorextern = $ligne[0];
}
// query to get error from visitor direct
$sql = "SELECT crawlt_id_page FROM crawlt_visits_human
WHERE $datetolookfor       
AND crawlt_visits_human.crawlt_site_id_site='" . sql_quote($site) . "'
AND crawlt_error='1'
AND crawlt_id_referer=''";
$requete = faireUneRequeteOnLine_Crawltrack($sql, $connexion);
$nbrerrordirect = exploiterNombreLigneResultatBDD_Crawltrack($requete);
// query to get error from visitors internal link
$sql = "SELECT COUNT(id_visit) 
FROM crawlt_visits_human
INNER JOIN crawlt_referer
ON  crawlt_visits_human.crawlt_id_referer=crawlt_referer.id_referer
AND $datetolookfor       
AND crawlt_visits_human.crawlt_site_id_site='" . sql_quote($site) . "'
AND Substring(referer From 1 For " . $lengthurl . ") = '" . sql_quote($hostsite) . "'
AND crawlt_error='1'";
$requete = faireUneRequeteOnLine_Crawltrack($sql, $connexion);
$ligne = exploiterLigneResultatBDD_Crawltrack_row($requete);
$nbrerrorintern = $ligne[0];
// graph preparation
// count the total number of hits
if ($period >= 10) {
    $sql = "SELECT  SUM(count) 
    FROM crawlt_hits
    WHERE  date >='" . sql_quote($daterequestseo) . "' 
    AND  date <'" . sql_quote($daterequest2seo) . "'
    AND idsite='" . sql_quote($site) . "'";
} else {
    $sql = "SELECT SUM(count)  
    FROM crawlt_hits
    WHERE date >='" . sql_quote($daterequestseo) . "'
    AND idsite='" . sql_quote($site) . "'";
}
$requete = faireUneRequeteOnLine_Crawltrack($sql, $connexion);
$num_rows = exploiterNombreLigneResultatBDD_Crawltrack($requete);
if ($num_rows > 0) {
    $ligne = exploiterLigneResultatBDD_Crawltrack_row($requete);
    $totalhits = $ligne[0];
} else {
    $totalhits = 0;
}
if (($nbrpage + $nbrtotvisits + $nbrcss + $nbrsql + $totalhits) > 0) {
    $values['visitors'] = $nbrpage;
    $values['other'] = $totalhits - $nbrpage;
    // prepare data to be transferred to graph file
    $datatransferttograph = addslashes(urlencode(serialize($values)));
    // insert the values in the graph table
    $piegraphname = "charge2-" . $cachename;
    // check if this graph already exists in the table
    $sql = "SELECT name  FROM crawlt_graph
              WHERE name= '" . sql_quote($piegraphname) . "'";
    $requete = faireUneRequeteOnLine_Crawltrack($sql, $connexion);
    $nbrresult = exploiterNombreLigneResultatBDD_Crawltrack($requete);
    if ($nbrresult >= 1) {
        $sql2 = "UPDATE crawlt_graph SET graph_values='" . sql_quote($datatransferttograph) . "'
                WHERE name= '" . sql_quote($piegraphname) . "'";
    } else {
        $sql2 = "INSERT INTO crawlt_graph (name,graph_values) VALUES ( '" . sql_quote($piegraphname) . "','" . sql_quote($datatransferttograph) . "')";
    }
    $requete2 = faireUneRequeteOnLine_Crawltrack($sql2, $connexion);
}
// Evolution calculation------------------------------------------------------------------------------
// query to get unique visitor for the last 30 days
$datelocal2 = date("Y-m-d", (strtotime("today") - ($times * 3600)));
$daterequestUV = date("Y-m-d", (strtotime($datelocal2) - 604800));
$daterequestUV2 = date("Y-m-d", (strtotime($datelocal2) - 2592000));
$sql = "SELECT FROM_UNIXTIME(UNIX_TIMESTAMP(date)-($times*3600), '%d-%m-%Y'), count(DISTINCT crawlt_ip) 
FROM crawlt_visits_human
LEFT OUTER JOIN crawlt_referer
ON crawlt_visits_human.crawlt_id_referer=crawlt_referer.id_referer
WHERE  (date >='" . crawlt_sql_quote($daterequestUV2) . "'
AND date <'" . crawlt_sql_quote($datelocal2) . "'
AND crawlt_site_id_site='" . crawlt_sql_quote($site) . "'
AND  crawlt_id_crawler='0'
AND  crawlt_id_referer='0')
OR (date >='" . crawlt_sql_quote($daterequestUV2) . "' 
AND date <'" . crawlt_sql_quote($datelocal2) . "' 
AND crawlt_site_id_site='" . crawlt_sql_quote($site) . "'
AND  crawlt_id_crawler IN ('1','2','3','4','5','6','7','8'))
OR (date >='" . crawlt_sql_quote($daterequestUV2) . "' 
AND date <'" . crawlt_sql_quote($datelocal2) . "'  
AND crawlt_site_id_site='" . crawlt_sql_quote($site) . "'
AND  crawlt_id_crawler='0'
$notinternalreferercondition
AND referer !='' )
GROUP BY FROM_UNIXTIME(UNIX_TIMESTAMP(date)-($times*3600), '%d-%m-%Y')
ORDER BY date";
$requete = faireUneRequeteOnLine_Crawltrack($sql, $connexion);
while ($ligne = exploiterLigneResultatBDD_Crawltrack_row($requete)) {
    if (strtotime($ligne[0]) >= strtotime($daterequestUV)) {
        $UVlast7days[] = $ligne[1];
        $UVlast30days[] = $ligne[1];
    } else {
        $UVlast30days[] = $ligne[1];
    }
}
if (count($UVlast7days) > 6) {
    include (dirname(__FILE__) . "/regression.php");
    // short term
    $evolutionuniquevisitorST = GetEvol($UVlast7days);
    if ($evolutionuniquevisitorST >= 0) {
        $evolutionuniquevisitorSTD = "<span id='green'>+ " . numbdisp($evolutionuniquevisitorST, 2) . " %</span>";
    } else {
        $evolutionuniquevisitorSTD = "<span id='red'>" . numbdisp($evolutionuniquevisitorST, 2) . " %</span>";
    }
    // long term
    if (count($UVlast30days) > 29) {
        $evolutionuniquevisitorLT = GetEvol($UVlast30days);
        if ($evolutionuniquevisitorLT >= 0) {
            $evolutionuniquevisitorLTD = "<span id='green'>+ " . numbdisp($evolutionuniquevisitorLT, 2) . " %</span>";
        } else {
            $evolutionuniquevisitorLTD = "<span id='red'>" . numbdisp($evolutionuniquevisitorLT, 2) . " %</span>";
        }
    } else {
        $evolutionuniquevisitorLTD = "<span id='green'> N/A </span>";
        $evolutionuniquevisitorLT = 0;
    }
} else {
    $evolutionuniquevisitorSTD = "<span id='green'> N/A </span>";
    $evolutionuniquevisitorLTD = "<span id='green'> N/A </span>";
    $evolutionuniquevisitorST = 0;
    $evolutionuniquevisitorLT = 0;
}
deconnectionBDD_Crawltrack($connexion);
// display----------------------------------------------------------------------------------------------------
echo "<div>\n";
echo "<div align='center'>\n";
echo "<table>\n";
echo "<tr><td id='dashboard1' width='50%'>\n";

cadreDebut();

// visitors------------------------------------------------------------------------------------------------------
echo "&nbsp;&nbsp;<a href=\"index.php?" . $varGetIncludePageWithRedirection . "navig=20&amp;period=$period&amp;site=$site&amp;crawler=$crawlencode&amp;graphpos=$graphpos\"><img src=\"" . $pathFromRootToCrawltrackImages . "images/group.png\" style=\"border:0; width:16px; height:16px\" alt=\"" . $language['visitors'] . "\">&nbsp;&nbsp;<b>" . $language['visitors'] . "</b></a><br><br>\n";
// summary table display
echo "<div align='center'>\n";
echo "<table  cellpadding='0px' cellspacing='0' width='100%'>\n";
echo "<tr style='background-color: grey;'><th>\n";
echo "" . $language['visits'] . "\n";
echo "</th>\n";
echo "<th>\n";
echo "" . $language['unique_visitors'] . "\n";
echo "</th>\n";
echo "<th>\n";
echo "" . $language['nbr_pages'] . "\n";
echo "</th>\n";
echo "<th>\n";
echo "" . $language['bounce_rate'] . "\n";
echo "</th></tr>\n";
echo "<tr><td align='center'>" . numbdisp($totalvisitor) . "</td>\n";
echo "<td align='center'>" . numbdisp($nbrvisitor) . "</td>\n";
echo "<td align='center'>" . numbdisp($nbrpage) . "</td>\n";
if ($nbrvisitor > 0) {
    $bouncerate = numbdisp(($onepage / $nbrvisitor) * 100, 1) . " %";
} else {
    $bouncerate = "N/A";
}
echo "<td align='center'>" . $bouncerate . "</td></tr>\n";
echo "</table><br>\n";
echo "<table cellpadding='0px' cellspacing='0' width='100%'>\n";
echo "<tr style='background-color: grey;'>\n";
echo "<th>\n";
echo "" . $language['referer'] . "\n";
echo "</th>\n";
echo "<th>\n";
echo "" . $language['visits'] . "\n";
echo "</th></tr>\n";
// counter for alternate color lane
$comptligne = 2;
foreach ($values2 as $key => $value) {
    if ($comptligne % 2 == 0) {
        echo "<tr style='background-color: white;'><td>&nbsp;&nbsp;" . $key . "</td>\n";
        echo "<td >" . numbdisp($value) . "&nbsp;&nbsp;(" . numbdisp(($value / $totalvisitor) * 100, 1) . "%)</td></tr>\n";
    } else {
        echo "<tr><td>&nbsp;&nbsp;" . $key . "</td>\n";
        echo "<td >" . numbdisp($value) . "&nbsp;&nbsp;(" . numbdisp(($value / $totalvisitor) * 100, 1) . "%)</td></tr>\n";
    }
    $comptligne ++;
}
echo "</table></div><br>\n";

cadreFin();

echo "</td>\n";
echo "<td id='dashboard2'>\n";

cadreDebut();

// crawlers-------------------------------------------------------------------------------------------------------
echo "&nbsp;&nbsp;<a href=\"index.php?" . $varGetIncludePageWithRedirection . "navig=1&amp;period=$period&amp;site=$site&amp;crawler=$crawlencode&amp;graphpos=$graphpos\"><img src=\"" . $pathFromRootToCrawltrackImages . "images/bug.png\" style=\"border:0; width:16px; height:16px\" alt=\"" . $language['crawler_name'] . "\">&nbsp;&nbsp;<b>" . $language['crawler_name'] . "</b></a><br><br>\n";
// summary table display
echo "<div align='center'>\n";
echo "<table cellpadding='0px' cellspacing='0' width='100%'>\n";
echo "<tr style='background-color: grey;'><th >\n";
echo "" . $language['nbr_tot_crawlers'] . "\n";
echo "</th>\n";
echo "<th>\n";
echo "" . $language['nbr_tot_visits'] . "\n";
echo "</th>\n";
echo "<th>\n";
echo "" . $language['nbr_pages'] . "\n";
echo "</th></tr>\n";
echo "<tr><td align='center'>" . numbdisp($nbrtotcrawlers) . "</td>\n";
echo "<td align='center'>" . numbdisp($nbrtotvisits) . "</td>\n";
echo "<td align='center'>" . numbdisp($nbrtotpages) . "</td></tr>\n";
echo "</table><br>\n";
echo "<table   cellpadding='0px' cellspacing='0' width='100%'>\n";
echo "<tr style='background-color: grey;'>\n";
echo "<th>\n";
echo "" . $language['main_crawlers'] . "\n";
echo "</th>\n";
echo "<th>\n";
echo "" . $language['nbr_tot_visits'] . "\n";
echo "</th></tr>\n";
echo "<tr style='background-color: white;'><td align='center'>" . $language['baidu'] . "</td>\n";
echo "<td align='center'>" . numbdisp($visitbaidu) . "</td></tr>\n";
echo "<tr><td align='center'>" . $language['msn'] . "</td>\n";
echo "<td align='center'>" . numbdisp($visitmsn) . "</td></tr>\n";
echo "<tr style='background-color: white;'><td align='center'>" . $language['google'] . "</td>\n";
echo "<td align='center'>" . numbdisp($visitgoogle) . "</td></tr>\n";
echo "<tr><td align='center'>" . $language['yahoo'] . "</td>\n";
echo "<td align='center'>" . numbdisp($visityahoo) . "</td></tr>\n";
echo "<tr style='background-color: white;'><td align='center'>" . $language['yandex'] . "</td>\n";
echo "<td align='center'>" . numbdisp($visityandex) . "</td></tr>\n";
echo "</table></div><br>\n";

cadreFin();

echo "</td></tr><tr>\n";
echo "<td id='dashboard7'>\n";

cadreDebut();

// unique visitors number tendancy-----------------------------------------------------------------------------------
echo "&nbsp;&nbsp;<img src=\"" . $pathFromRootToCrawltrackImages . "images/chart_curve.png\" style=\"border:0; width:16px; height:16px\" alt=\"" . $language['evolution'] . "\">&nbsp;&nbsp;<b>" . $language['evolution'] . "</b><br /><br />";
echo "<img src=\"" . $pathFromRootToCrawltrackImages . "graphs/tendance-graph.php?tendance7=$evolutionuniquevisitorST&amp;tendance30=$evolutionuniquevisitorLT\" alt=\"graph\" style=\"border:0; width:480px; height:220px\">\n";
echo "<br /><br /><div id='evolution'>\n";
echo $language['longterm'] . " " . $evolutionuniquevisitorLTD . " " . $language['perday'] . "<br>";
echo $language['shortterm'] . " " . $evolutionuniquevisitorSTD . " " . $language['perday'] . "<br>";
echo "</div>\n";

cadreFin();

echo "</td>\n";
echo "<td id='dashboard8'>\n";

cadreDebut();

// server charge------------------------------------------------------------------------------------------------------
echo "&nbsp;&nbsp;<img src=\"" . $pathFromRootToCrawltrackImages . "images/server.png\" style=\"border:0; width:16px; height:16px\" alt=\"" . $language['charge'] . "\">&nbsp;&nbsp;<b>" . $language['charge'] . "</b> ( " . numbdisp($totalhits) . " " . $language['nbr_visits'] . " )<br>";
if (($nbrpage + $nbrtotvisits + $nbrcss + $nbrsql) > 0) {
    echo "<img src=\"" . $pathFromRootToCrawltrackImages . "graphs/crawler-graph.php?graphname=$piegraphname&amp;crawltlang=$crawltlang\" alt=\"graph\" style=\"border:0; width:480px; height:220px\">\n";
} else {
    echo "&nbsp;";
}

cadreFin();

echo "</td></tr><tr>\n";
echo "<td id='dashboard3'>\n";

cadreDebut();

// indexation-----------------------------------------------------------------------------------------------------
echo "&nbsp;&nbsp;<a href=\"index.php?" . $varGetIncludePageWithRedirection . "navig=11&amp;period=$period&amp;site=$site&amp;crawler=$crawlencode&amp;graphpos=$graphpos\"><img src=\"" . $pathFromRootToCrawltrackImages . "images/report_magnify.png\" style=\"border:0; width:16px; height:16px\" alt=\"" . $language['index'] . "\">&nbsp;&nbsp;<b>" . $language['index'] . "</b></a><br><br>\n";
// backling and index page table
echo "<div align='center'>\n";
echo "<table cellpadding='0px' cellspacing='0' width='100%'>\n";
echo "<tr style='background-color: grey;'><th width=\"20%\" >\n";
echo "&nbsp;\n";
echo "</th>\n";
echo "<th width=\"40%\">\n";
echo "" . $language['nbr_tot_link'] . "\n";
echo "</th>\n";
echo "<th width=\"40%\">\n";
echo "" . $language['nbr_tot_pages_index'] . "\n";
echo "</th></tr>\n";
echo "<tr style='background-color: white;'><td>&nbsp;&nbsp;" . $language['google'] . "\n";
if ($period == 0 && ($linkgoogle == 0 || $pagegoogle == 0)) {
    echo "<a href=\"scriptPHP/crawltrack3-3-2/php/searchenginespositionrefresh.php?retry=google&amp;navig=$navig&amp;period=$period&amp;site=$site&amp;crawler=$crawlencode&amp;graphpos=$graphpos\"><img src=\"./images/refresh.png\" width=\"16\" height=\"16\" border=\"0\" ></a></td>\n";
} else {
    echo "</td>\n";
}
if ((@$tablinkgoogle[0] == @$tablinkgoogle[($nbrresult - 1)]) && @$tablinkgoogle[0] == 0) {
    echo "<td align='center'>-</td>\n";
} else {
    echo "<td align='center'>" . $linkgoogle . "</td>\n";
}
if ((@$tabpagegoogle[0] == @$tabpagegoogle[($nbrresult - 1)]) && @$tabpagegoogle[0] == 0) {
    echo "<td align='center'>-</td></tr>\n";
} else {
    echo "<td align='center'>" . $pagegoogle . "</td></tr>\n";
}
echo "</table><br>\n";

// Alexa traffic rank
// to avoid problem if the url is enter in the database with http://
$crawlturlsite = strip_protocol($urlsite[$site]);
echo "<br /><table cellpadding='0px' cellspacing='0' width='468px' style=\"margin:auto;\">\n";
echo "<tr><th>\n";
echo "Alexa\n";
echo "</th></tr>\n";
echo "<tr><tdstyle=\"padding:0;\">\n";
echo "<iframe name=\"I1\" src=\"scriptPHP/crawltrack3-3-2/php/alexa.php?url=" . $crawlturlsite . "\" marginwidth=\"0\" marginheight=\"0\" scrolling=\"no\" border=\"no\"  width=\"468px\" height=\"60px\"></iframe></h2>\n";
echo "</td></tr></table><br />";

cadreFin();

echo "</td>\n";
echo "<td id='dashboard4'>\n";

cadreDebut();

// hacking---------------------------------------------------------------------------------------------------------
echo "&nbsp;&nbsp;<a href=\"index.php?" . $varGetIncludePageWithRedirection . "navig=17&amp;period=$period&amp;site=$site&amp;crawler=$crawlencode&amp;graphpos=$graphpos\"><img src=\"" . $pathFromRootToCrawltrackImages . "images/hacker.png\" style=\"border:0; width:16px; height:16px\" alt=\"" . $language['hacking2'] . "\">&nbsp;&nbsp;<b>" . $language['hacking2'] . "</b></a><br><br>";

// summary table display
echo "<div align='center'>\n";
echo "<table cellpadding='0px' cellspacing='0' width='100%'>\n";
echo "<tr style='background-color: grey;'><th width='50%'>\n";
echo "" . $language['hacking3'] . "\n";
echo "</th>\n";
echo "<th>\n";
echo "" . $language['hacking4'] . "\n";
echo "</th></tr>\n";
echo "<tr style='background-color: white;'><td align='center'>" . numbdisp($nbrcss) . "</td>\n";
echo "<td align='center'>" . numbdisp($nbrsql) . "</td></tr>\n";
echo "</table></div>\n";
if ($crawltblockattack == 1 && ($nbrcss + $nbrsql) > 0) {
    echo "<h2>" . $language['attack-blocked'] . "</h2>\n";
} elseif ($crawltblockattack != 1 && ($nbrcss + $nbrsql) > 0) {
    echo "<h2><span  style='background-color: brown;'>" . $language['attack-no-blocked'] . "</span></h2>\n";
}

cadreFin();

echo "</td></tr><tr><td id='dashboard5'>\n";

cadreDebut();

// download---------------------------------------------------------------------------------------------------------
echo "&nbsp;&nbsp;<img src=\"" . $pathFromRootToCrawltrackImages . "images/basket_put.png\" style=\"border:0; width:16px; height:16px\" alt=\"" . $language['download'] . "\">&nbsp;&nbsp;<b>" . $language['download'] . "</b><br><br>";
// download table
echo "<div align='center' >\n";
echo "<table   cellpadding='0px' cellspacing='0' width='100%'>\n";
echo "<tr style='background-color: grey;'><th>\n";
echo "" . $language['file'] . "\n";
echo "</th>\n";
echo "<th>\n";
echo "" . $language['download_period'] . "\n";
echo "</th>\n";
echo "<th>\n";
echo "" . $language['nbr_tot_visits3'] . "\n";
echo "</th></tr>\n";
// counter for alternate color lane
$comptligne = 2;
foreach ($count as $key => $value) {
    if ($comptligne % 2 == 0 && $countperiod[$key] > 0) {
        echo "<tr style='background-color: white;'><td>&nbsp;&nbsp;" . crawltcuturl($key, 30) . "</td>\n";
        echo "<td>&nbsp;&nbsp;" . numbdisp($countperiod[$key]) . "</td>\n";
        echo "<td>" . numbdisp($value) . "</td></tr>\n";
    } elseif ($comptligne % 2 == 0 && $countperiod[$key] == 0) {
        echo "<tr><td>&nbsp;&nbsp;" . crawltcuturl($key, 30) . "</td>\n";
        echo "<td>&nbsp;&nbsp;" . numbdisp($countperiod[$key]) . "</td>\n";
        echo "<td>" . numbdisp($value) . "</td></tr>\n";
    } elseif ($comptligne % 2 != 0 && $countperiod[$key] > 0) {
        echo "<tr style='background-color: white;'><td>&nbsp;&nbsp;" . crawltcuturl($key, 30) . "</td>\n";
        echo "<td>&nbsp;&nbsp;" . numbdisp($countperiod[$key]) . "</td>\n";
        echo "<td>" . numbdisp($value) . "</td></tr>\n";
    } else {
        echo "<tr><td>&nbsp;&nbsp;" . crawltcuturl($key, 30) . "</td>\n";
        echo "<td>&nbsp;&nbsp;" . numbdisp($countperiod[$key]) . "</td>\n";
        echo "<td>" . numbdisp($value) . "</td></tr>\n";
    }
    $comptligne ++;
}
echo "</table></div><br>\n";

cadreFin();

echo "</td><td id='dashboard6'>\n";

cadreDebut();

// error 404---------------------------------------------------------------------------------------------------------
echo "&nbsp;&nbsp;<a href=\"index.php?" . $varGetIncludePageWithRedirection . "navig=22&amp;period=$period&amp;site=$site&amp;crawler=$crawlencode&amp;graphpos=$graphpos\"><img src=\"" . $pathFromRootToCrawltrackImages . "images/error.png\" style=\"border:0; width:16px; height:16px\" alt=\"" . $language['error'] . "\">&nbsp;&nbsp;<b>" . $language['error'] . "</b></a><br><br>";
echo "<div align='center'>\n";
echo "<table cellpadding='0px' cellspacing='0' width='100%'>\n";
echo "<tr style='background-color: grey;'><th>\n";
echo "" . $language['origin'] . "\n";
echo "</th>\n";
echo "<th>\n";
echo "" . $language['number'] . "\n";
echo "</th></tr>\n";
echo "<tr style='background-color: white;'><td align='center'>&nbsp;&nbsp;" . $language['hacking2'] . "</td>\n";
echo "<td align='center'>" . numbdisp($nbrerrorattack) . "</td></tr>\n";
echo "<tr><td align='center'>&nbsp;&nbsp;" . $language['crawler_name'] . "</td>\n";
echo "<td align='center'>" . numbdisp($nbrerrorcrawler) . "</td></tr>\n";
echo "<tr style='background-color: white;'><td align='center'>&nbsp;&nbsp;" . $language['direct'] . "</td>\n";
echo "<td align='center'>" . numbdisp($nbrerrordirect) . "</td></tr>\n";
echo "<tr><td align='center'>&nbsp;&nbsp;" . $language['outer-referer'] . "</td>\n";
echo "<td align='center'>" . numbdisp($nbrerrorextern) . "</td></tr>\n";
echo "<tr style='background-color: white;'><td align='center'>&nbsp;&nbsp;" . $language['inner-referer'] . "</td>\n";
echo "<td align='center'>" . numbdisp($nbrerrorintern) . "</td></tr>\n";
echo "</table></div><br>\n";

cadreFin();

echo "</td></tr></table>\n";
echo "</div>\n";
?>
