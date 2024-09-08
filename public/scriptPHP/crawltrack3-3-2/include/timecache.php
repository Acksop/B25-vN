<?php
//----------------------------------------------------------------------
//  CrawlTrack 3.2.6
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
// file: timecache.php
//----------------------------------------------------------------------
//  Last update: 12/09/2010
//----------------------------------------------------------------------
echo "<br /><br /><div style='display:inline; float:right;' >\n";

//to display the cache hour
$timecache = time() - ($times * 3600);
$timecache = date("H:i", $timecache);
echo "<span style='font-size: 9px;margin-right: 25px;'>" . $language['page_cache'] . $timecache . " </span>\n";
if (isset($_SESSION['userlogin']) && !empty($_SESSION['userlogin'])) {
	echo $language['connect'] . "&nbsp;";
} else {
	echo "<span style='font-size: 12px;font-weight:bold;margin-right: 25px;''><a href=\"index.php?".$varGetIncludePageWithRedirection."navig=$navig&amp;period=$period&amp;site=$site&amp;crawler=$crawlencode&amp;graphpos=$graphpos&amp;logitself=1\">" . $language['connect_you'] . "</a></span>";
}
echo "</div>\n";
?>
