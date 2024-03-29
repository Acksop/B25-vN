<?php
// ----------------------------------------------------------------------
// CrawlTrack 3.2.6
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
// file: display-hacking.php
// ----------------------------------------------------------------------
// Last update: 12/09/2010
// ----------------------------------------------------------------------
if (! defined('IN_CRAWLT')) {
    exit('<h1>Hacking attempt !!!!</h1>');
}
if ($period >= 1000) {
    $cachename = "permanent-" . $navig . "-" . $site . "-" . $crawltlang . "-" . date("Y-m-d", (strtotime($reftime) - ($shiftday * 86400)));
} elseif ($period >= 100 && $period < 200) // previous month
{
    $cachename = "permanent-month" . $navig . "-" . $site . "-" . $crawltlang . "-" . date("Y-m", mktime(0, 0, 0, $monthrequest, $dayrequest, $yearrequest));
} elseif ($period >= 200 && $period < 300) // previous year
{
    $cachename = "permanent-year" . $navig . "-" . $site . "-" . $crawltlang . "-" . date("Y", mktime(0, 0, 0, $monthrequest, $dayrequest, $yearrequest));
} else {
    $cachename = $navig . $period . $site . $firstdayweek . $localday . $graphpos . $crawltlang;
}
// start the caching
cache($cachename);
// database connection
$connexion = connectionBDD_Crawltrack();

// include menu
cadreAlignCentrerDebut();
include (dirname(__FILE__) . "/menumain.php");
include (dirname(__FILE__) . "/menusite.php");
include (dirname(__FILE__) . "/timecache.php");
cadreAlignCentrerFin();
// mysql query-----------------------------------------------------------------------------------------------
// date for the mysql query
if ($period >= 10) {
    $datetolookfor = " date >'" . sql_quote($daterequest) . "' 
    AND  date <'" . sql_quote($daterequest2) . "'";
} else {
    $datetolookfor = " date >'" . sql_quote($daterequest) . "'";
}
$sqlstats = "SELECT  date 
FROM crawlt_visits
WHERE  crawlt_crawler_id_crawler='65500'
AND $datetolookfor       
AND crawlt_visits.crawlt_site_id_site='" . sql_quote($site) . "'
ORDER BY date";
$requetestats = faireUneRequeteOnLine_Crawltrack($sqlstats, $connexion);
$nbrresult = exploiterNombreLigneResultatBDD_Crawltrack($requetestats);
$sqlstats2 = "SELECT  date 
FROM crawlt_visits
WHERE crawlt_crawler_id_crawler='65501'
AND $datetolookfor       
AND crawlt_visits.crawlt_site_id_site='" . sql_quote($site) . "'
ORDER BY date";
$requetestats2 = faireUneRequeteOnLine_Crawltrack($sqlstats2, $connexion);
$nbrresult2 = exploiterNombreLigneResultatBDD_Crawltrack($requetestats2);
// attack which has given an error 404
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
        if ($ligne[0] == '65500') {
            $nbrresult = $nbrresult + $ligne[1];
        } elseif ($ligne[0] == '65501') {
            $nbrresult2 = $nbrresult2 + $ligne[1];
        }
    }
}
// mysql connexion close
deconnectionBDD_Crawltrack($connexion);
$testip = 0;
if ($nbrresult >= 1 || $nbrresult2 >= 1) {
    // display---------------------------------------------------------------------------------------------------------
    echo "<br />";
    echo "<div class=\"content2\"><br>\n";
    cadreAlignCentrerDebut();
    // graph
    echo "<div align='center'onmouseover=\"javascript:montre();\">\n";
    echo "<img src=\"" . $pathFromRootToCrawltrackImages . "graphs/page-graph.php?nbrpageview=$nbrresult&amp;nbrpagestotal=$nbrresult2&amp;crawltlang=$crawltlang&amp;navig=$navig\" alt=\"graph\" style=\"border:0; width:500px; height:200px\">\n";
    echo "</div><br>\n";
    // summary table display
    echo "<div class='tableau' align='center' onmouseout=\"javascript:montre();\">\n";
    echo "<table   cellpadding='0px' cellspacing='0' width='700px'>\n";
    echo "<tr><th class='tableau1' width='50%'>\n";
    echo "" . $language['hacking3'] . "\n";
    echo "</th>\n";
    echo "<th class='tableau2'>\n";
    echo "" . $language['hacking4'] . "\n";
    echo "</th></tr>\n";
    echo "<tr><td class='tableau3'><a href=\"index.php?" . $varGetIncludePageWithRedirection . "navig=18&amp;period=$period&amp;site=$site\">" . numbdisp($nbrresult) . "</a></td>\n";
    echo "<td class='tableau5'><a href=\"index.php?" . $varGetIncludePageWithRedirection . "navig=19&amp;period=$period&amp;site=$site\">" . numbdisp($nbrresult2) . "</a></td></tr>\n";
    echo "</table></div>\n";
    if ($crawltblockattack == 1) {
        echo "<h2>" . $language['attack-blocked'] . "</h2>\n";
    } else {
        echo "<h2><span class=\"alert2\">" . $language['attack-no-blocked'] . "</span></h2>\n";
    }
    if ($period != 5) {
        // graph
        echo "<div class='graphvisits' >\n";
        // mapgraph
        include dirname(__FILE__) . "/mapgraph.php";
        echo "<img src=\"" . $pathFromRootToCrawltrackImages . "graphs/visit-graph.php?crawltlang=$crawltlang&amp;period=$period&amp;navig=$navig&amp;graphname=$graphname\" USEMAP=\"#visit\" alt=\"graph\" border=\"0\">\n";
        echo "</div>\n";
        echo "<div class='imprimgraph'>\n";
        echo "&nbsp;<br><br><br><br><br><br><br><br></div>\n";
    }
    echo "<p align='center'>*" . $language['404_no_in_graph2'] . "</p>\n";
    echo "<div><br>\n";
    cadreAlignCentrerFin();
} else// case no visits
{
    echo "<div class=\"content2\"><br>\n";
    cadreAlignCentrerDebut();
    echo "<div class='tableaularge' align='center'>\n";
    echo "<h1>" . $language['no_hacking'] . "</h1>\n";
    echo "<br>\n";
}
cadreAlignCentrerFin();
