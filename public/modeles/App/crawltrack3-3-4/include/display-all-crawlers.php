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
// file: display-all-crawlers.php
// ----------------------------------------------------------------------
// Last update: 22/11/2011
// ----------------------------------------------------------------------
if (! defined('IN_CRAWLT')) {
    exit('<h1>Hacking attempt !!!!</h1>');
}
// initialize array
$nbrcrawlerpage = array();
$nbvisits = array();
$lastdatedisplay = array();
$firstdatedisplay = array();
$values = array();
$listcrawler = array();

// cache name
$crawlencode = urlencode($crawler);
if ($period >= 1000) // previous days
{
    $cachename = "permanent-" . $navig . "-" . $site . "-" . $crawlencode . "-" . $order . "-" . $rowdisplay . "-" . $crawltlang . "-" . $displayall . "-" . date("Y-m-d", (strtotime($reftime) - ($shiftday * 86400)));
} elseif ($period >= 100 && $period < 200) // previous month
{
    $cachename = "permanent-month" . $navig . "-" . $site . "-" . $crawlencode . "-" . $order . "-" . $rowdisplay . "-" . $crawltlang . "-" . $displayall . "-" . date("Y-m", mktime(0, 0, 0, $monthrequest, $dayrequest, $yearrequest));
} elseif ($period >= 200 && $period < 300) // previous year
{
    $cachename = "permanent-year" . $navig . "-" . $site . "-" . $crawlencode . "-" . $order . "-" . $rowdisplay . "-" . $crawltlang . "-" . $displayall . "-" . date("Y", mktime(0, 0, 0, $monthrequest, $dayrequest, $yearrequest));
} else {
    $cachename = $navig . $period . $site . $order . $rowdisplay . $crawlencode . $displayall . $firstdayweek . $localday . $graphpos . $crawltlang;
}

// start the caching
cache($cachename);
// database connection

$connexion = connectionBDD_Crawltrack();

// include menu
cadreDebut();
include (dirname(__FILE__) . "/menumain.php");
include (dirname(__FILE__) . "/menusite.php");
include (dirname(__FILE__) . "/timecache.php");
cadreFin();

// date for the mysql query
if ($period >= 10) {
    $datetolookfor = " date >'" . sql_quote($daterequest) . "' 
    AND  date <'" . sql_quote($daterequest2) . "'";
} else {
    $datetolookfor = " date >'" . sql_quote($daterequest) . "'";
}

// query to count the number of page per crawler and to list the crawler and to count the number of visits per crawler and to have the date of last visit for each crawler
$sqlstats = "SELECT crawler_name, COUNT(DISTINCT crawlt_pages_id_page),  COUNT(id_visit) ,   
	MAX(UNIX_TIMESTAMP(date)-($times*3600)), MIN(UNIX_TIMESTAMP(date)-($times*3600)) 
	FROM crawlt_visits
	INNER JOIN crawlt_crawler
	ON crawlt_visits.crawlt_crawler_id_crawler=crawlt_crawler.id_crawler
	WHERE $datetolookfor    
	AND crawlt_site_id_site='" . sql_quote($site) . "' 
	GROUP BY crawler_name";
$requetestats = faireUneRequeteOnLine_Crawltrack($sqlstats, $connexion);
$nbrresult = exploiterNombreLigneResultatBDD_Crawltrack($requetestats);
if ($nbrresult >= 1) {
    $onlyarchive = 0;
    while ($ligne = exploiterLigneResultatBDD_Crawltrack_row($requetestats)) {
        if ($ligne[0] != 65500 && $ligne[0] != 65501) {
            if ($ligne[0] == 'MSN Bot' || $ligne[0] == 'Bingbot') {
                $ligne[0] = 'MSN Bot - Bingbot';
            }
            $nbrcrawlerpage[$ligne[0]] = @$nbrcrawlerpage[$ligne[0]] + $ligne[1];
            $nbvisits[$ligne[0]] = @$nbvisits[$ligne[0]] + $ligne[2];
            if ($ligne[3] > @$lastdatedisplay[$ligne[0]]) {
                $lastdatedisplay[$ligne[0]] = $ligne[3];
            }
            if ($ligne[4] <= @$firstdatedisplay[$ligne[0]] || ! isset($firstdatedisplay[$ligne[0]])) {
                $firstdatedisplay[$ligne[0]] = $ligne[4];
            }
            $listcrawler[$ligne[0]] = $ligne[0];
        }
    }
    $requetestats=NULL;
    
    // query to count the total number of pages viewed ,total number of visits and total number of crawler
    $sqlstats2 = "SELECT COUNT(DISTINCT crawlt_pages_id_page), COUNT(DISTINCT crawler_name), COUNT(id_visit) 
		FROM crawlt_visits
		INNER JOIN crawlt_crawler
		ON crawlt_visits.crawlt_crawler_id_crawler=crawlt_crawler.id_crawler
		AND $datetolookfor         
		AND crawlt_visits.crawlt_site_id_site='" . sql_quote($site) . "'";
    $requetestats2 = faireUneRequeteOnLine_Crawltrack($sqlstats2, $connexion);
    $ligne2 = exploiterLigneResultatBDD_Crawltrack_row($requetestats2);
    $requetestats=NULL;
    
    $nbrtotpages = $ligne2[0];
    $nbrtotcrawlers = $ligne2[1];
    $nbrtotvisits = $ligne2[2];
    // treatment to prepare the display of the top 5 and group the other in the 'Other' category in the crawler graph
    arsort($nbvisits);
    $i = 0;
    foreach ($nbvisits as $crawler => $value) {
        if ($i < 5) {
            if (strlen("$crawler") > 15) {
                $values[substr("$crawler", 0, 15) . "..."] = $value;
            } else {
                $values[$crawler] = $value;
            }
        } else {
            $values['other'] = @$values['other'] + $value;
        }
        $i ++;
    }
    
    // prepare data to be transferred to graph file
    $datatransferttograph = addslashes(urlencode(serialize($values)));
    // insert the values in the graph table
    $piegraphname = "crawler-" . $cachename;
    
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
    deconnectionBDD_Crawltrack($connexion);
    // display----------------------------------------------------------------------------------------------------
    cadreAlignCentrerDebut();
    if ($graphpos == 0) {
        // graph
        echo "<div align=\"center\">\n";
        echo "<a href=\"index.php?" . $varGetIncludePageWithRedirection . "navig=$navig&amp;graphpos=1&amp;period=$period&site=$site&amp;crawler=$crawlencode\">\n";
        echo "<img src=\"" . $pathFromRootToCrawltrackImages . "graphs/crawler-graph.php?graphname=$piegraphname&crawltlang=$crawltlang\" alt=\"graph0\" style=\"border:0; width:450px; height:200px\">\n";
        echo "</a>\n";
        echo "</div>\n";
    }
    // summary table display
    echo "<div class='tableau' align='center' onmouseout=\"javascript:montre();\">\n";
    echo "<table   cellpadding='0px' cellspacing='0' width='550px'>\n";
    echo "<tr style='background-color:grey;'><th class='tableau1' >\n";
    echo "" . $language['nbr_tot_crawlers'] . "\n";
    echo "</th>\n";
    echo "<th class='tableau1'>\n";
    echo "" . $language['nbr_tot_visits'] . "\n";
    echo "</th>\n";
    echo "<th class='tableau2'>\n";
    echo "" . $language['nbr_tot_pages'] . "\n";
    echo "</th></tr>\n";
    echo "<tr><td class='tableau3'>" . numbdisp($nbrtotcrawlers) . "</td>\n";
    echo "<td class='tableau3'>" . numbdisp($nbrtotvisits) . "</td>\n";
    echo "<td class='tableau5'>" . numbdisp($nbrtotpages) . "</td></tr>\n";
    echo "</table></div><br>\n";
    if ($period != 5) {
        // graph
        echo "<div class='graphvisits' >\n";
        // mapgraph
        include dirname(__FILE__) . "/mapgraph.php";
        echo "<img src=\"" . $pathFromRootToCrawltrackImages . "graphs/visit-graph.php?crawltlang=$crawltlang&period=$period&navig=$navig&graphname=$graphname\" USEMAP=\"#visit\" alt=\"graph1\"  style=\"border:0; width:700px; height:300px\">\n";
        echo "</div>\n";
        echo "<div class='imprimgraph'>\n";
        echo "&nbsp;<br><br><br><br><br><br></div>\n";
    }
    if ($graphpos == 1) {
        // graph
        echo "<br><h2>" . $language['crawler_name'] . "</h2>\n";
        echo "<div align=\"center\">\n";
        echo "<a href=\"index.php?" . $varGetIncludePageWithRedirection . "navig=$navig&graphpos=0&period=$period&site=$site&crawler=$crawlencode\">\n";
        echo "<img src=\"" . $pathFromRootToCrawltrackImages . "graphs/crawler-graph.php?graphname=$piegraphname&crawltlang=$crawltlang\" alt=\"graph2\"  style=\"border:0; width:450px; height:200px\">\n";
        echo "</a>\n";
        echo "</div>\n";
    }
    // change text if more than x crawlers and display limited (value of x can be change in function.php,,it's displaynumber)
    if ($nbrtotcrawlers >= $rowdisplay && $displayall == 'no') {
        echo "<br><h2>";
        printf($language['100_visit_per-crawler'], $rowdisplay);
        echo "<br>\n";
        $crawlencode = urlencode($crawler);
        echo "<span class=\"smalltext\"><a href=\"index.php?" . $varGetIncludePageWithRedirection . "navig=$navig&period=$period&site=$site&crawler=$crawlencode&order=$order&displayall=yes&graphpos=$graphpos\">" . $language['show_all'] . "</a></span></h2>";
    } else {
        echo "<h2>" . $language['visit_per-crawler'] . "</h2>\n";
    }
    echo "<div class='tableau' align='center'>\n";
    echo "<table   cellpadding='0px' cellspacing='0' width='100%'>\n";
    if ($order == 3) {
        echo "<tr><th class='tableau1'>\n";
        echo "<form action=\"index.php" . $varPostFormIncludePageWithRedirection . "\" method=\"POST\" >\n";
        echo "<input type=\"hidden\" name ='order' value=\"3\">\n";
        echo "<input type=\"hidden\" name ='period' value=\"$period\">\n";
        echo "<input type=\"hidden\" name ='graphpos' value=\"$graphpos\">\n";
        echo "<input type=\"hidden\" name ='navig' value=\"$navig\">\n";
        echo "<input type=\"hidden\" name ='crawler' value=\"$crawler\">\n";
        echo "<input type=\"hidden\" name ='site' value=\"$site\">\n";
        echo "<input type='submit' class='orderselect' value='" . $language['crawler_name'] . "'>\n";
        echo "</form>\n";
        echo "</th>\n";
    } else {
        echo "<tr><th class='tableau1'>\n";
        echo "<form action=\"index.php" . $varPostFormIncludePageWithRedirection . "\" method=\"POST\" >\n";
        echo "<input type=\"hidden\" name ='order' value=\"3\">\n";
        echo "<input type=\"hidden\" name ='period' value=\"$period\">\n";
        echo "<input type=\"hidden\" name ='graphpos' value=\"$graphpos\">\n";
        echo "<input type=\"hidden\" name ='navig' value=\"$navig\">\n";
        echo "<input type=\"hidden\" name ='crawler' value=\"$crawler\">\n";
        echo "<input type=\"hidden\" name ='site' value=\"$site\">\n";
        echo "<input type='submit' class='order' value='" . $language['crawler_name'] . "'>\n";
        echo "</form>\n";
        echo "</th>\n";
    }
    if ($order == 2) {
        echo "<th class='tableau1'>\n";
        echo "<form action=\"index.php" . $varPostFormIncludePageWithRedirection . "\" method=\"POST\" >\n";
        echo "<input type=\"hidden\" name ='order' value=\"2\">\n";
        echo "<input type=\"hidden\" name ='period' value=\"$period\">\n";
        echo "<input type=\"hidden\" name ='graphpos' value=\"$graphpos\">\n";
        echo "<input type=\"hidden\" name ='navig' value=\"$navig\">\n";
        echo "<input type=\"hidden\" name ='crawler' value=\"$crawler\">\n";
        echo "<input type=\"hidden\" name ='site' value=\"$site\">\n";
        echo "<input type='submit' class='orderselect' value='" . $language['nbr_visits'] . "'>\n";
        echo "</form>\n";
        echo "</th>\n";
    } else {
        echo "<th class='tableau1'>\n";
        echo "<form action=\"index.php" . $varPostFormIncludePageWithRedirection . "\" method=\"POST\" >\n";
        echo "<input type=\"hidden\" name ='order' value=\"2\">\n";
        echo "<input type=\"hidden\" name ='period' value=\"$period\">\n";
        echo "<input type=\"hidden\" name ='graphpos' value=\"$graphpos\">\n";
        echo "<input type=\"hidden\" name ='navig' value=\"$navig\">\n";
        echo "<input type=\"hidden\" name ='crawler' value=\"$crawler\">\n";
        echo "<input type=\"hidden\" name ='site' value=\"$site\">\n";
        echo "<input type='submit' class='order' value='" . $language['nbr_visits'] . "'>\n";
        echo "</form>\n";
        echo "</th>\n";
    }
    if ($order == 1) {
        echo "<th class='tableau1'>\n";
        echo "<form action=\"index.php" . $varPostFormIncludePageWithRedirection . "\" method=\"POST\" >\n";
        echo "<input type=\"hidden\" name ='order' value=\"1\">\n";
        echo "<input type=\"hidden\" name ='period' value=\"$period\">\n";
        echo "<input type=\"hidden\" name ='graphpos' value=\"$graphpos\">\n";
        echo "<input type=\"hidden\" name ='navig' value=\"$navig\">\n";
        echo "<input type=\"hidden\" name ='crawler' value=\"$crawler\">\n";
        echo "<input type=\"hidden\" name ='site' value=\"$site\">\n";
        echo "<input type='submit' class='orderselect' value='" . $language['nbr_pages'] . "'>\n";
        echo "</form>\n";
        echo "</th>\n";
        echo "</th>\n";
    } else {
        echo "<th class='tableau1'>\n";
        echo "<form action=\"index.php" . $varPostFormIncludePageWithRedirection . "\" method=\"POST\" >\n";
        echo "<input type=\"hidden\" name ='order' value=\"1\">\n";
        echo "<input type=\"hidden\" name ='period' value=\"$period\">\n";
        echo "<input type=\"hidden\" name ='graphpos' value=\"$graphpos\">\n";
        echo "<input type=\"hidden\" name ='navig' value=\"$navig\">\n";
        echo "<input type=\"hidden\" name ='crawler' value=\"$crawler\">\n";
        echo "<input type=\"hidden\" name ='site' value=\"$site\">\n";
        echo "<input type='submit' class='order' value='" . $language['nbr_pages'] . "'>\n";
        echo "</form>\n";
        echo "</th>\n";
    }
    if ($order == 4) {
        echo "<th class='tableau1'>\n";
        echo "<form action=\"index.php" . $varPostFormIncludePageWithRedirection . "\" method=\"POST\" >\n";
        echo "<input type=\"hidden\" name ='order' value=\"4\">\n";
        echo "<input type=\"hidden\" name ='period' value=\"$period\">\n";
        echo "<input type=\"hidden\" name ='graphpos' value=\"$graphpos\">\n";
        echo "<input type=\"hidden\" name ='navig' value=\"$navig\">\n";
        echo "<input type=\"hidden\" name ='crawler' value=\"$crawler\">\n";
        echo "<input type=\"hidden\" name ='site' value=\"$site\">\n";
        echo "<input type='submit' class='orderselect' value='" . $language['first_date_visits'] . "'>\n";
        echo "</form>\n";
        echo "</th>\n";
        echo "</th>\n";
    } else {
        echo "<th class='tableau1'>\n";
        echo "<form action=\"index.php" . $varPostFormIncludePageWithRedirection . "\" method=\"POST\" >\n";
        echo "<input type=\"hidden\" name ='order' value=\"4\">\n";
        echo "<input type=\"hidden\" name ='period' value=\"$period\">\n";
        echo "<input type=\"hidden\" name ='graphpos' value=\"$graphpos\">\n";
        echo "<input type=\"hidden\" name ='navig' value=\"$navig\">\n";
        echo "<input type=\"hidden\" name ='crawler' value=\"$crawler\">\n";
        echo "<input type=\"hidden\" name ='site' value=\"$site\">\n";
        echo "<input type='submit' class='order' value='" . $language['first_date_visits'] . "'>\n";
        echo "</form>\n";
        echo "</th>\n";
    }
    if ($order == 0) {
        echo "<th class='tableau1'>\n";
        echo "<form action=\"index.php" . $varPostFormIncludePageWithRedirection . "\" method=\"POST\" >\n";
        echo "<input type=\"hidden\" name ='order' value=\"0\">\n";
        echo "<input type=\"hidden\" name ='period' value=\"$period\">\n";
        echo "<input type=\"hidden\" name ='graphpos' value=\"$graphpos\">\n";
        echo "<input type=\"hidden\" name ='navig' value=\"$navig\">\n";
        echo "<input type=\"hidden\" name ='crawler' value=\"$crawler\">\n";
        echo "<input type=\"hidden\" name ='site' value=\"$site\">\n";
        echo "<input type='submit' class='orderselect' value='" . $language['date_visits'] . "'>\n";
        echo "</form>\n";
        echo "</th>\n";
    } else {
        echo "<th class='tableau1'>\n";
        echo "<form action=\"index.php" . $varPostFormIncludePageWithRedirection . "\" method=\"POST\" >\n";
        echo "<input type=\"hidden\" name ='order' value=\"0\">\n";
        echo "<input type=\"hidden\" name ='period' value=\"$period\">\n";
        echo "<input type=\"hidden\" name ='graphpos' value=\"$graphpos\">\n";
        echo "<input type=\"hidden\" name ='navig' value=\"$navig\">\n";
        echo "<input type=\"hidden\" name ='crawler' value=\"$crawler\">\n";
        echo "<input type=\"hidden\" name ='site' value=\"$site\">\n";
        echo "<input type='submit' class='order' value='" . $language['date_visits'] . "'>\n";
        echo "</form>\n";
        echo "</th>\n";
    }
    echo "<th class='tableau2'>\n";
    echo $language['deltatime'];
    echo "</th></tr>\n";
    if ($order == 0) {
        arsort($lastdatedisplay);
        $sorttab = $lastdatedisplay;
    } elseif ($order == 1) {
        arsort($nbrcrawlerpage);
        $sorttab = $nbrcrawlerpage;
    } elseif ($order == 2) {
        $sorttab = $nbvisits;
    } elseif ($order == 3) {
        asort($listcrawler);
        $sorttab = $listcrawler;
    } elseif ($order == 4) {
        arsort($firstdatedisplay);
        $sorttab = $firstdatedisplay;
    }
    
    // counter for alternate color lane
    $comptligne = 2;
    foreach ($sorttab as $key => $value) {
        if ($comptligne < ($rowdisplay + 2) || $displayall == 'yes') {
            $crawldisplay = htmlentities($key);
            $nbrpage = $nbrcrawlerpage[$key];
            
            // calculation of averagetime between visits
            $deltadate = $lastdatedisplay[$key] - $firstdatedisplay[$key];
            if ($deltadate == 0) {
                $deltatime = '?';
            } else {
                $deltatime = $deltadate / ($nbvisits[$key] - 1);
                $hour = floor($deltatime / 3600);
                if ($hour == 0) {
                    $hourdisplay = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                } else {
                    $hourdisplay = $hour . "hr ";
                }
                $reste = $deltatime % 3600;
                $minutes = floor($reste / 60);
                if (strlen($minutes) == 1) {
                    if ($hour == 0 && $minutes == 0) {
                        $minutesdisplay = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                    } elseif ($hour == 0 && $minutes != 0) {
                        $minutesdisplay = $minutes . "mn ";
                    } elseif ($hour != 0 && $minutes != 0) {
                        $minutesdisplay = "0" . $minutes . "mn ";
                    }
                } else {
                    $minutesdisplay = $minutes . "mn ";
                }
                $secondes = $reste % 60;
                if (strlen($secondes) == 1 && ($minutes != 0 || $hour != 0)) {
                    $secondesdisplay = "0" . $secondes . "s";
                } else {
                    $secondesdisplay = $secondes . "s";
                }
                $deltatime = $hourdisplay . $minutesdisplay . $secondesdisplay;
            }
            
            if ($comptligne % 2 == 0) {
                echo "<tr style='background-color:white;'><td class='tableau3'><a href='index.php?" . $varGetIncludePageWithRedirection . "navig=2&period=" . $period . "&site=" . $site . "&crawler=" . $key . "&graphpos=" . $graphpos . "'>" . $crawldisplay . "</a></td>\n";
                echo "<td class='tableau3'>" . numbdisp($nbvisits[$key]) . "</td>\n";
                echo "<td class='tableau3'>" . numbdisp($nbrpage) . "</td> \n";
                echo "<td class='tableau3'>" . date("d/m/Y", $firstdatedisplay[$key]) . "<br>" . date("G:i", $firstdatedisplay[$key]) . "</td>\n";
                echo "<td class='tableau3'>" . date("d/m/Y", $lastdatedisplay[$key]) . "<br>" . date("G:i", $lastdatedisplay[$key]) . "</td>\n";
                echo "<td class='tableau5'>" . $deltatime . "</td></tr>\n";
            } else {
                echo "<tr><td class='tableau30'><a href='index.php?" . $varGetIncludePageWithRedirection . "navig=2&period=" . $period . "&site=" . $site . "&crawler=" . $key . "&graphpos=" . $graphpos . "'>" . $crawldisplay . "</a></td>\n";
                echo "<td class='tableau30'>" . numbdisp($nbvisits[$key]) . "</td>\n";
                echo "<td class='tableau30'>" . numbdisp($nbrpage) . "</td> \n";
                echo "<td class='tableau30'>" . date("d/m/Y", $firstdatedisplay[$key]) . "<br>" . date("G:i", $firstdatedisplay[$key]) . "</td>\n";
                echo "<td class='tableau30'>" . date("d/m/Y", $lastdatedisplay[$key]) . "<br>" . date("G:i", $lastdatedisplay[$key]) . "</td>\n";
                echo "<td class='tableau50'>" . $deltatime . "</td></tr>\n";
            }
        }
        $comptligne ++;
    }
    echo "</table>\n";
    echo "<br>\n";
    cadreAlignCentrerFin();
} else// case no visits
{
    cadreAlignCentrerDebut();
    echo "<center><h1>" . $language['no_visit'] . "</h1></center>\n";
    cadreAlignCentrerFin();
}
