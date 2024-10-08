<?php
//----------------------------------------------------------------------
//  CrawlTrack 3.2.8
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
// file: testcrawlersuppress.php
//----------------------------------------------------------------------
//  Last update: 12/02/2011
//----------------------------------------------------------------------
if (!defined('IN_CRAWLT_ADMIN')) {
	exit('<h1>Hacking attempt !!!!</h1>');
}
if (isset($_POST['suppresscrawler'])) {
	$suppresscrawler = (int)$_POST['suppresscrawler'];
} else {
	$suppresscrawler = 0;
}
if ($suppresscrawler == 1) {
	//crawler suppression
	//database connection
	$connexion = mysql_connect($crawlthost, $crawltuser, $crawltpassword) or die("MySQL connection to database problem");
	$selection = mysql_select_db($crawltdb) or die("MySQL database selection problem");
	
	//database query to suppress the crawler
	$sqlstats = "SELECT * FROM crawlt_crawler WHERE crawler_name ='Test-Crawltrack'";
	$requetestats = db_query($sqlstats, $connexion);
	$nbrresult = mysql_num_rows($requetestats);
	if ($nbrresult >= 1) {
		while ($ligne = mysql_fetch_object($requetestats)) {
			$testcrawltrackid = $ligne->id_crawler;
		}
		$sqldelete = "DELETE FROM crawlt_crawler WHERE id_crawler= '" . sql_quote($testcrawltrackid) . "'";
		$requetedelete = db_query($sqldelete, $connexion);
		$sqldelete2 = "DELETE FROM crawlt_visits WHERE crawlt_crawler_id_crawler= '" . sql_quote($testcrawltrackid) . "'";
		$requetedelete2 = db_query($sqldelete2, $connexion);
		
		//database query to optimize the table
		$sqloptimize = "OPTIMIZE TABLE crawlt_visits";
		$requeteoptimize = db_query($sqloptimize, $connexion);
		
	//determine the path to the nocache file
		/*if (isset($_SERVER['PATH_TRANSLATED']) && !empty($_SERVER['PATH_TRANSLATED'])) {
			$path = dirname($_SERVER['PATH_TRANSLATED']);
		} elseif (isset($_SERVER['SCRIPT_FILENAME']) && !empty($_SERVER['SCRIPT_FILENAME'])) {
			$path = dirname($_SERVER['SCRIPT_FILENAME']);
		} else {
			$path = '.';
		}
		*/
		$path = dirname(__FILE__);
		$filename = $path . '/nocache.php';
		
		//chmod the directory
		@chmod($path , 0777);
		//suppress the files
		unlink($filename);
		//recreate the new file to put back caching
		@$content.= "<?php\n";
		@$content.= "\$nocachetest=0;\n";
		@$content.= "?>\n";
		if ($file = fopen($filename, "w")) {
			fwrite($file, $content);
			fclose($file);
		}
		@chmod($path , 0755);
		
		//empty the cache table
		$sqlcache = "TRUNCATE TABLE crawlt_cache";
		$requetecache = db_query($sqlcache, $connexion);
		mysql_close($connexion);
		if ($requetedelete && $requetedelete2) {
			echo "<br><br><h1>" . $language['crawler_suppress_ok'] . "</h1>\n";
			echo "<div class=\"form\">\n";
			echo "<form action=\"index.php".$varPostFormIncludePageWithRedirection."\" method=\"POST\" >\n";
			echo "<input type=\"hidden\" name ='navig' value='6'>\n";
			echo "<input name='ok' type='submit'  value='OK' size='20'>\n";
			echo "</form>\n";
			echo "</div><br><br>\n";
		} else {
			echo "<br><br><h1>" . $language['crawler_suppress_no_ok'] . "</h1>\n";
			echo "<div class=\"form\">\n";
			echo "<form action=\"index.php".$varPostFormIncludePageWithRedirection."\" method=\"POST\" >\n";
			echo "<input type=\"hidden\" name ='navig' value='6'>\n";
			echo "<input name='ok' type='submit'  value='OK' size='20'>\n";
			echo "</form>\n";
			echo "</div><br><br>\n";
		}
	} else {
		echo "<br><br><h1>" . $language['crawler_test_no_exist'] . "</h1>\n";
	}
} else {
	//display
	echo "<br><br><h1>" . $language['crawler_test_suppress'] . "</h1>\n";
	echo "<div class=\"form\">\n";
	echo "<form action=\"index.php".$varPostFormIncludePageWithRedirection."\" method=\"POST\" >\n";
	echo "<input type=\"hidden\" name ='navig' value='6'>\n";
	echo "<input type=\"hidden\" name ='validform' value=\"12\">";
	echo "<input type=\"hidden\" name ='suppresscrawler' value=\"1\">\n";
	echo "<input type=\"hidden\" name ='crawlertosuppress' value=\"Test-CrawlTrack\">\n";
	echo "<table class=\"centrer\">\n";
	echo "<tr>\n";
	echo "<td colspan=\"2\">\n";
	echo "<input name='ok' type='submit'  value=' " . $language['yes'] . " ' size='20'>\n";
	echo "</td>\n";
	echo "</tr>\n";
	echo "</table>\n";
	echo "</form>\n";
	echo "</div>";
	echo "<div class=\"form\">\n";
	echo "<form action=\"index.php".$varPostFormIncludePageWithRedirection."\" method=\"POST\" >\n";
	echo "<input type=\"hidden\" name ='navig' value='6'>\n";
	echo "<input type=\"hidden\" name ='suppresscrawler' value=\"0\">\n";
	echo "<table class=\"centrer\">\n";
	echo "<tr>\n";
	echo "<td colspan=\"2\">\n";
	echo "<input name='ok' type='submit'  value=' " . $language['no'] . " ' size='20'>\n";
	echo "</td>\n";
	echo "</tr>\n";
	echo "</table>\n";
	echo "</form>\n";
	echo "</div>";
	echo "<br><br>\n";
}
?>
