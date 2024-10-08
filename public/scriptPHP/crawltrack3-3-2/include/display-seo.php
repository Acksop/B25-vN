<?php
//----------------------------------------------------------------------
//  CrawlTrack 3.3.1
//----------------------------------------------------------------------
// Crawler Tracker for website
//----------------------------------------------------------------------
// Author: Jean-Denis Brun
//----------------------------------------------------------------------
// Code cleaning: Philippe Villiers
//----------------------------------------------------------------------
// Website: www.crawltrack.net
//----------------------------------------------------------------------
// That script is distributed under GNU GPL license
//----------------------------------------------------------------------
// file: display-seo.php
//----------------------------------------------------------------------
//  Last update: 29/10/2011
//----------------------------------------------------------------------
if (!defined('IN_CRAWLT')) {
	exit('<h1>Hacking attempt !!!!</h1>');
}
//initialize array and variable
$tablinkgoogle = array();
$tabpagegoogle = array();
if ($period >= 1000) {
	$cachename = "permanent-" . $navig . "-" . $site . "-".$crawltlang . "-" . date("Y-m-d", (strtotime($reftime) - ($shiftday * 86400)));
} elseif ($period >= 100 && $period < 200) //previous month
{
	$cachename = "permanent-month" . $navig . "-" . $site . "-".$crawltlang . "-" . date("Y-m", mktime(0, 0, 0, $monthrequest, $dayrequest, $yearrequest));
} elseif ($period >= 200 && $period < 300) //previous year
{
	$cachename = "permanent-year" . $navig . "-" . $site . "-".$crawltlang . "-" . date("Y", mktime(0, 0, 0, $monthrequest, $dayrequest, $yearrequest));
} else {
	$cachename = $navig . $period . $site . $firstdayweek . $localday . $graphpos . $crawltlang;
}
//start the caching
cache($cachename);
//database connection
$connexion = mysql_connect($crawlthost, $crawltuser, $crawltpassword) or die("MySQL connection to database problem");
$selection = mysql_select_db($crawltdb) or die("MySQL database selection problem");
//include menu
cadreAlignCentrerDebut();
include (dirname(__FILE__)."/menumain.php");
include (dirname(__FILE__)."/menusite.php");
include (dirname(__FILE__)."/timecache.php");
cadreAlignCentrerFin();
echo "<br />";
//request to get the msn and yahoo positions data and the number of Delicious bookmarks and  Delicious keywords
if ($period >= 10) {
	$sqlseo = "SELECT   linkyahoo, pageyahoo, pagemsn, nbrdelicious,tagdelicious, linkexalead, pageexalead, linkgoogle, pagegoogle FROM crawlt_seo_position
    WHERE  id_site='" . sql_quote($site) . "'
    AND  date >='" . sql_quote($daterequestseo) . "' 
    AND  date <'" . sql_quote($daterequest2seo) . "'        
    ORDER BY date";
} else {
	$sqlseo = "SELECT  linkyahoo, pageyahoo, pagemsn, nbrdelicious,tagdelicious, linkexalead, pageexalead, linkgoogle, pagegoogle FROM crawlt_seo_position
    WHERE  id_site='" . sql_quote($site) . "' 
    AND  date >='" . sql_quote($daterequestseo) . "'        
    ORDER BY date";
}
$requeteseo = db_query($sqlseo, $connexion);
$nbrresult = mysql_num_rows($requeteseo);
if ($nbrresult >= 1) {
	$i = 1;
	while ($ligneseo = mysql_fetch_row($requeteseo)) {
		$tablinkgoogle[] = $ligneseo[7];
		$tabpagegoogle[] = $ligneseo[8];
	}

	//preparation of values for display
	if ($period == 0 || $period >= 1000) {
		$linkgoogle = numbdisp($tablinkgoogle[0]);
		$pagegoogle = numbdisp($tabpagegoogle[0]);
	} else {
		$linkgoogle = numbdisp($tablinkgoogle[0]) . " --> " . numbdisp($tablinkgoogle[($nbrresult - 1) ]);
		$pagegoogle = numbdisp($tabpagegoogle[0]) . " --> " . numbdisp($tabpagegoogle[($nbrresult - 1) ]);
	}
}
//mysql connexion close
mysql_close($connexion);
cadreAlignCentrerDebut();
//display
echo "<div class=\"content2\"><br><hr>\n";
//backling and index page table
echo "<div class='tableaularge' align='center'>\n";
echo "<table   cellpadding='0px' cellspacing='0' width='100%'>\n";
echo "<tr onmouseover=\"javascript:montre();\">\n";
echo "<th class='utilisateurs' colspan=\"3\">\n";
echo "" . $language['searchengine'] . "\n";
echo "</th></tr><tr>\n";
echo "<th class='tableau1' width=\"20%\" >\n";
echo "&nbsp;\n";
echo "</th>\n";
echo "<th class='utilisateursInverse'  width=\"40%\">\n";
echo "" . $language['nbr_tot_link'] . "\n";
echo "</th>\n";
echo "<th class='utilisateursInverse' width=\"40%\">\n";
echo "" . $language['nbr_tot_pages_index'] . "\n";
echo "</th></tr>\n";
echo "<tr><td class='tableau3g'>&nbsp;&nbsp;&nbsp;<a href=\"http://www.google.com\">" . $language['google'] . "</a>\n";
if ($period == 0 && ($linkgoogle == 0 || $pagegoogle == 0)) {
	echo "<a href=\"".$pathFromSiteIndexToCrawltrackIndex."php/searchenginespositionrefresh.php?retry=google&amp;navig=$navig&amp;period=$period&amp;site=$site&amp;crawler=$crawlencode&amp;graphpos=$graphpos\"><img src=\"scriptPHP/crawltrack3-3-2/images/refresh.png\" width=\"16\" height=\"16\" border=\"0\" ></a></td>\n";
} else {
	echo "</td>\n";
}
if (($tablinkgoogle[0] == $tablinkgoogle[($nbrresult - 1) ]) && $tablinkgoogle[0] == 0) {
	echo "<td class='tableau3' >-</td>\n";
} else {
	echo "<td class='tableau3'>" . $linkgoogle . "</td>\n";
}
if (($tabpagegoogle[0] == $tabpagegoogle[($nbrresult - 1) ]) && $tabpagegoogle[0] == 0) {
	echo "<td class='tableau5'>-</td></tr>\n";
} else {
	echo "<td class='tableau5'>" . $pagegoogle . "</td></tr>\n";
}

echo "</table><br>\n";
echo "</div><br>\n";
if ($period != 5) {
	//graph
	echo "<center><div class='graphvisits'>\n";
	//mapgraph
	$typegraph = 'link';
	include dirname(__FILE__)."/mapgraph2.php";
	echo "<img src=\"".$pathFromRootToCrawltrackImages."graphs/seo-graph.php?typegraph=$typegraph&amp;crawltlang=$crawltlang&amp;period=$period&amp;graphname=$graphname\" usemap=\"#seolink\" border=\"0\" alt=\"graph\" >\n";
	echo "&nbsp;</div><br>\n";
	echo "<div class='imprimgraph'>\n";
	echo "&nbsp;<br><br><br><br><br><br><br><br><br><br><br><br><br><br></div>\n";
	//graph
	echo "<div class='graphvisits'>\n";
	//mapgraph
	$typegraph = 'page';
	include dirname(__FILE__)."/mapgraph2.php";
	echo "<img src=\"".$pathFromRootToCrawltrackImages."graphs/seo-graph.php?typegraph=$typegraph&amp;crawltlang=$crawltlang&amp;period=$period&amp;graphname=$graphname\" usemap=\"#seopage\" border=\"0\" alt=\"graph\" >\n";
	echo "&nbsp;</div><br>\n";
	echo "<div class='imprimgraph'>\n";
	echo "&nbsp;<br><br><br><br></div></center>\n";
} else {
	echo "</div>\n";
}
cadreAlignCentrerFin();
