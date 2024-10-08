<?php
//----------------------------------------------------------------------
//  CrawlTrack 3.3.0
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
// file: display-pages-visitors.php
//----------------------------------------------------------------------
//  Last update: 07/04/2011
//----------------------------------------------------------------------
if (!defined('IN_CRAWLT')) {
	exit('<h1>Hacking attempt !!!!</h1>');
}
//initialize array
$nbrcrawlerpage = array();
$nbvisits2 = array();
$lastdatedisplay = array();
$nbrtotpages = 0;
$listpage = array();
$crawlencode = urlencode($crawler);

$cachename = $navig . $period . $site . $order.$rowdisplay . $crawlencode . $displayall . $firstdayweek . $localday . $graphpos . $crawltlang;

//start the caching
cache($cachename);
//database connection
$connexion = mysql_connect($crawlthost, $crawltuser, $crawltpassword) or die("MySQL connection to database problem");
$selection = mysql_select_db($crawltdb) or die("MySQL database selection problem");
//include menu
cadreDebut();
include (dirname(__FILE__)."/menumain.php");
include (dirname(__FILE__)."/menusite.php");
include (dirname(__FILE__)."/timecache.php");
cadreFin();
//clean table from crawler entry
include (dirname(__FILE__)."/cleaning-crawler-entry.php");
//include visitors calculation file
include (dirname(__FILE__)."/visitors-calculation.php");
//date for the mysql query
if ($period >= 10) {
	$datetolookfor = " date >'" . sql_quote($daterequest) . "' 
    AND  date <'" . sql_quote($daterequest2) . "'";
} else {
	$datetolookfor = " date >'" . sql_quote($daterequest) . "'";
}
//query  to list the page viewed and to count the number of visits per page and to have the date of last visit for each pages
if ($nottoomuchip == 1) {
	$sqlstats = "SELECT  crawlt_id_page,   COUNT(id_visit),
  MAX(UNIX_TIMESTAMP(date)-($times*3600)), MIN(UNIX_TIMESTAMP(date)-($times*3600)), url_page
  FROM crawlt_visits_human
  INNER JOIN crawlt_pages
  ON crawlt_visits_human.crawlt_id_page=crawlt_pages.id_page  
  WHERE $datetolookfor    
  AND crawlt_visits_human.crawlt_site_id_site='" . sql_quote($site) . "' 
  AND crawlt_ip IN ('$crawltlistip')
  AND  crawlt_visits_human.crawlt_error =0  
  GROUP BY crawlt_id_page";
} else {
	$sqlstats = "SELECT  crawlt_id_page,   COUNT(id_visit),
  MAX(UNIX_TIMESTAMP(date)-($times*3600)), MIN(UNIX_TIMESTAMP(date)-($times*3600)), url_page
  FROM crawlt_visits_human
  INNER JOIN crawlt_pages
  ON crawlt_visits_human.crawlt_id_page=crawlt_pages.id_page
  WHERE $datetolookfor    
  AND crawlt_visits_human.crawlt_site_id_site='" . sql_quote($site) . "' 
  AND  crawlt_visits_human.crawlt_error =0   
  GROUP BY crawlt_id_page";
}
$requetestats = db_query($sqlstats, $connexion);
$nbrresult = mysql_num_rows($requetestats);
if ($nbrresult >= 1) {
	$onlyarchive = 0;
	while ($ligne = mysql_fetch_row($requetestats)) {
		$nbvisits2[$ligne[0]] = $ligne[1];
		$lastdatedisplay[$ligne[0]] = $ligne[2];
		$firstdatedisplay[$ligne[0]] = $ligne[3];
		$listpage[$ligne[0]] = $ligne[4];
	}
	$nbrtotpages = count($listpage);
	//query for bounce rate per page
	$sql = "SELECT  crawlt_id_page, crawlt_ip
  FROM crawlt_visits_human
  WHERE $datetolookfor    
  AND crawlt_site_id_site='" . sql_quote($site) . "'";
	$requete = db_query($sql, $connexion);
	while ($ligne = mysql_fetch_row($requete)) {
		if (in_array($ligne[1], $listiponevisit)) {
			$nbonevisits[$ligne[0]] = @$nbonevisits[$ligne[0]] + 1;
		}
	}
//mysql connexion close
mysql_close($connexion);
	//display----------------------------------------------------------------------------------------------------
	cadreDebut();
	echo "<div class='tableau' align='center'>\n";
	echo "<table  cellpadding='0px' cellspacing='0' width='550px'>\n";
	echo "<tr style='background-color: grey;' ><th>\n";
	echo "" . $language['nbr_pages'] . "\n";
	echo "</th>\n";
	echo "<th>\n";
	echo "" . $language['visitors'] . "\n";
	echo "</th></tr>\n";
	echo "<tr style='background-color: white;' ><td align='center'>" . numbdisp($nbrpage) . "</td>\n";
	echo "<td align='center'>" . numbdisp($nbrvisitor) . "</td></tr>\n";
	echo "</table></div><br>\n";
	if ($period != 5) {
		//graph
		echo "<div class='graphvisits'>\n";
		//mapgraph
		include dirname(__FILE__)."/mapgraph.php";
		echo "<center><img src=\"".$pathFromRootToCrawltrackImages."graphs/visit-graph.php?crawltlang=$crawltlang&period=$period&navig=$navig&graphname=$graphname\" USEMAP=\"#visit\" alt=\"graph\" width=\"700\" height=\"300\"  border=\"0\"/></center>\n";
		echo "</div>\n";
		echo "<div class='imprimgraph'>\n";
		echo "&nbsp;<br><br><br><br><br><br></div>\n";
	}
	cadreFin();
	cadreDebut();
	//change text if more than x crawlers	and display limited (value of x can be change in function.php,,it's displaynumber)
	if ($nbrtotpages >= $rowdisplay && $displayall == 'no' && $period != 5) {
		echo "<h2>";
		printf($language['100_visit_per-crawler'], $rowdisplay);
		$crawlencode = urlencode($crawler);
		echo "<span class=\"smalltext\"><a href=\"index.php?".$varGetIncludePageWithRedirection."&navig=$navig&period=$period&site=$site&crawler=$crawlencode&order=$order&displayall=yes&graphpos=$graphpos\">" . $language['show_all'] . "</a></span></h2>";
	} else {
		echo "<h2>" . $language['visit_per-crawler'] . "</h2>\n";
	}
	cadreFin();
	echo "<div style='position:relative;top:-20px;class='tableaularge' align='center'>\n";
	cadreDebut();
	echo "<table cellpadding='0px' cellspacing='0' width='100%'>\n";
	if ($order == 3) {
		echo "<tr style='background-color: grey;' ><th class='tableau1' colspan=\"2\">\n";
		echo "<form action=\"index.php".$varPostFormIncludePageWithRedirection."\" method=\"POST\" >\n";
		echo "<input type=\"hidden\" name ='order' value=\"3\">\n";
		echo "<input type=\"hidden\" name ='period' value=\"$period\">\n";
		echo "<input type=\"hidden\" name ='graphpos' value=\"$graphpos\">\n";
		echo "<input type=\"hidden\" name ='navig' value=\"$navig\">\n";
		echo "<input type=\"hidden\" name ='crawler' value=\"$crawler\">\n";
		echo "<input type=\"hidden\" name ='site' value=\"$site\">\n";
		echo "<input type='submit' class='orderselect' value='" . $language['nbr_pages'] . "'>\n";
		echo "</form>\n";
		echo "</th>\n";
	} else {
		echo "<tr style='background-color: grey;'><th class='tableau1' colspan=\"2\">\n";
		echo "<form action=\"index.php".$varPostFormIncludePageWithRedirection."\" method=\"POST\" >\n";
		echo "<input type=\"hidden\" name ='order' value=\"3\">\n";
		echo "<input type=\"hidden\" name ='period' value=\"$period\">\n";
		echo "<input type=\"hidden\" name ='graphpos' value=\"$graphpos\">\n";
		echo "<input type=\"hidden\" name ='navig' value=\"$navig\">\n";
		echo "<input type=\"hidden\" name ='crawler' value=\"$crawler\">\n";
		echo "<input type=\"hidden\" name ='site' value=\"$site\">\n";
		echo "<input type='submit' class='order' value='" . $language['nbr_pages'] . "'>\n";
		echo "</form>\n";
		echo "</th>\n";
	}
	if ($order == 2) {
		if ($period == 5) {
			echo "<th class='tableau2' >\n";
		} else {
			echo "<th class='tableau1' >\n";
		}
		echo "<form action=\"index.php".$varPostFormIncludePageWithRedirection."\" method=\"POST\" >\n";
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
		if ($period == 5) {
			echo "<th class='tableau2' >\n";
		} else {
			echo "<th class='tableau1' >\n";
		}
		echo "<form action=\"index.php".$varPostFormIncludePageWithRedirection."\" method=\"POST\" >\n";
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
	echo "<th class='tableau12'>\n";
	echo $language['bounce_rate'];
	echo "</th>\n";
	if ($period != 5) {
		if ($order == 4) {
			echo "<th class='tableau1'>\n";
			echo "<form action=\"index.php".$varPostFormIncludePageWithRedirection."\" method=\"POST\" >\n";
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
			echo "<form action=\"index.php".$varPostFormIncludePageWithRedirection."\" method=\"POST\" >\n";
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
			echo "<form action=\"index.php".$varPostFormIncludePageWithRedirection."\" method=\"POST\" >\n";
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
			echo "<form action=\"index.php".$varPostFormIncludePageWithRedirection."\" method=\"POST\" >\n";
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
	} else {
		echo "</tr>\n";
	}
	if ($order == 0) {
		arsort($lastdatedisplay);
		$sorttab = $lastdatedisplay;
	} elseif ($order == 2) {
		arsort($nbvisits2);
		$sorttab = $nbvisits2;
	} elseif ($order == 3) {
		asort($listpage);
		$sorttab = $listpage;
	} elseif ($order == 4) {
		asort($firstdatedisplay);
		$sorttab = $firstdatedisplay;
	}
	//counter for alternate color lane
	$comptligne = 2;
	foreach ($sorttab as $key => $value) {
		if ($comptligne < ($rowdisplay + 2) || $displayall == 'yes') {
			//calculation of averagetime between visits
			$deltadate = $lastdatedisplay[$key] - $firstdatedisplay[$key];
			if ($deltadate == 0) {
				$deltatime = '?';
			} else {
				$deltatime = $deltadate / ($nbvisits2[$key] - 1);
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
					} elseif ($hour != 0 && $minutes == 0) {
						$minutesdisplay = "00mn ";
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
			$crawldisplay = crawltcutkeyword($listpage[$key], '30');
			$crawlencode = urlencode($listpage[$key]);
			//to avoid problem if the url is enter in the database with http://
			if (!preg_match('#^http://#i', $urlsite[$site])) {
				$urlpage = "http://" . $urlsite[$site] . $listpage[$key];
			} else {
				$urlpage = $urlsite[$site] . $listpage[$key];
			}
			if ($comptligne % 2 == 0) {
				echo "<tr style='background-color: white;'><td";
				echo ">&nbsp;&nbsp;" . $crawldisplay;
				echo "<img src=\"".$pathFromRootToCrawltrackImages."images/help.png\" width=\"16\" height=\"16\" border=\"0\" title=\"" . $listpage[$key] . "\" alt=\"" . $listpage[$key] . "\">\n";
				echo "</td>\n";
				echo "<td width=\"8%\">\n";
				echo "<a href='" . $urlpage . "' rel='nofollow'><img src=\"".$pathFromRootToCrawltrackImages."images/page.png\" width=\"16\" height=\"16\" border=\"0\" ></a>\n";
				echo "</td> \n";
				if ($period != 5) {
					if (!isset($nbonevisits[$key])) {
						$nbonevisits[$key] = 0;
					}
					echo "<td align='center'>" . numbdisp($nbvisits2[$key]) . "</td>\n";
					echo "<td align='center'>" . numbdisp(($nbonevisits[$key] / $nbvisits2[$key]) * 100, 1) . " %</td>\n";
					echo "<td align='center'>" . date("d/m/Y", $firstdatedisplay[$key]) . "<br>" . date("G:i", $firstdatedisplay[$key]) . "</td>\n";
					echo "<td align='center'>" . date("d/m/Y", $lastdatedisplay[$key]) . "<br>" . date("G:i", $lastdatedisplay[$key]) . "</td>\n";
					echo "<td align='center'>" . $deltatime . "</td></tr>\n";
				} else {
					echo "<td align='center'>" . numbdisp($nbvisits2[$key]) . "</td>\n";
					echo "</tr> \n";
				}
			} else {
				echo "<tr><td class='tableau30g'";
				echo ">&nbsp;&nbsp;" . $crawldisplay;
				echo "<img src=\"".$pathFromRootToCrawltrackImages."images/help.png\" width=\"16\" height=\"16\" border=\"0\" title=\"" . $listpage[$key] . "\" alt=\"" . $listpage[$key] . "\">\n";
				echo "</td>\n";
				echo "<td class='tableau60' width=\"8%\">\n";
				echo "<a href='" . $urlpage . "' rel='nofollow'><img src=\"".$pathFromRootToCrawltrackImages."images/page.png\" width=\"16\" height=\"16\" border=\"0\" ></a>\n";
				echo "</td> \n";
				if ($period != 5) {
					if (!isset($nbonevisits[$key])) {
						$nbonevisits[$key] = 0;
					}
					echo "<td align='center'>" . numbdisp($nbvisits2[$key]) . "</td>\n";
					echo "<td align='center'>" . numbdisp(($nbonevisits[$key] / $nbvisits2[$key]) * 100, 1) . " %</td>\n";
					echo "<td align='center'>" . date("d/m/Y", $firstdatedisplay[$key]) . "<br>" . date("G:i", $firstdatedisplay[$key]) . "</td>\n";
					echo "<td align='center'>" . date("d/m/Y", $lastdatedisplay[$key]) . "<br>" . date("G:i", $lastdatedisplay[$key]) . "</td>\n";
					echo "<td align='center'>" . $deltatime . "</td></tr>\n";
				} else {
					echo "<td align='center'>" . numbdisp($nbvisits2[$key]) . "</td>\n";
					echo "</tr> \n";
				}
			}
		}
		$comptligne++;
	}

	echo "</table>";
	cadreFin();
} else
//case no visits
{
	echo "<div class=\"content2\"><br><hr>\n";
	echo "<h1>" . $language['no_visit'] . "</h1>\n";
	echo "<br>\n";
}
