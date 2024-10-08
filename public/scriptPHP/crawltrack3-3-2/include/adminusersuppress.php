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
// file: adminusersuppress.php
//----------------------------------------------------------------------
//  Last update: 12/02/2011
//----------------------------------------------------------------------
if (!defined('IN_CRAWLT_ADMIN')) {
	exit('<h1>Hacking attempt !!!!</h1>');
}
//initialize array
$loginuser = array();
if (isset($_POST['suppressuser'])) {
	$suppressuser = (int)$_POST['suppressuser'];
} else {
	$suppressuser = 0;
}
if (isset($_POST['suppressuserok'])) {
	$suppressuserok = (int)$_POST['suppressuserok'];
} else {
	$suppressuserok = 0;
}
if ($suppressuser == 1) {
	if (isset($_POST['logintosuppress'])) {
		$logintosuppress = $_POST['logintosuppress'];
	} else {
		header("Location:./index.php".$varPostFormIncludePageWithRedirection."");
		exit;
	}
	if ($suppressuserok == 1) {
		//login suppression
		
		//database connection
		$connexion = mysql_connect($crawlthost, $crawltuser, $crawltpassword) or die("MySQL connection to database problem");
		$selection = mysql_select_db($crawltdb) or die("MySQL database selection problem");
		
		//database query to suppress the login
		$sqldelete = "DELETE FROM crawlt_login WHERE crawlt_user= '" . sql_quote($logintosuppress) . "'";
		$requetedelete = db_query($sqldelete, $connexion);
		if ($requetedelete) {
			echo "<br><br><h1>" . $language['user_suppress_ok'] . "</h1>\n";
			echo "<div class=\"form\">\n";
			echo "<form action=\"index.php".$varPostFormIncludePageWithRedirection."\" method=\"POST\" >\n";
			echo "<input type=\"hidden\" name ='navig' value='6'>\n";
			echo "<input name='ok' type='submit'  value='OK' size='20'>\n";
			echo "</form>\n";
			echo "</div><br><br>\n";
		} else {
			echo "<br><br><h1>" . $language['user_suppress_no_ok'] . "</h1>\n";
			echo "<div class=\"form\">\n";
			echo "<form action=\"index.php".$varPostFormIncludePageWithRedirection."\" method=\"POST\" >\n";
			echo "<input type=\"hidden\" name ='navig' value='6'>\n";
			echo "<input name='ok' type='submit'  value='OK' size='20'>\n";
			echo "</form>\n";
			echo "</div><br><br>\n";
		}
	mysql_close($connexion);
	} else {
		//validation of suppression
		
		//display
		$logintosuppress = stripslashes($logintosuppress);
		$logintosuppressdisplay = htmlentities($logintosuppress);
		echo "<br><br><h1>" . $language['user_suppress_validation'] . "</h1>\n";
		echo "<h1>" . $language['login'] . ":&nbsp;$logintosuppressdisplay</h1>\n";
		echo "<div class=\"form\">\n";
		echo "<form action=\"index.php".$varPostFormIncludePageWithRedirection."\" method=\"POST\" >\n";
		echo "<input type=\"hidden\" name ='navig' value='6'>\n";
		echo "<input type=\"hidden\" name ='validform' value=\"8\">";
		echo "<input type=\"hidden\" name ='suppressuser' value=\"1\">\n";
		echo "<input type=\"hidden\" name ='suppressuserok' value=\"1\">\n";
		echo "<input type=\"hidden\" name ='logintosuppress' value=\"$logintosuppress\">\n";
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
		echo "<input type=\"hidden\" name ='validform' value=\"8\">";
		echo "<input type=\"hidden\" name ='suppressuser' value=\"0\">\n";
		echo "<input type=\"hidden\" name ='suppressuserok' value=\"0\">\n";
		echo "<table class=\"centrer\">\n";
		echo "<tr>\n";
		echo "<td colspan=\"2\">\n";
		echo "<input name='ok' type='submit'  value=' " . $language['no'] . " ' size='20'>\n";
		echo "</td>\n";
		echo "</tr>\n";
		echo "</table>\n";
		echo "</form>\n";
		echo "</div><br><br>";
	}
} else {
	//database connection
	$connexion = mysql_connect($crawlthost, $crawltuser, $crawltpassword) or die("MySQL connection to database problem");
	$selection = mysql_select_db($crawltdb) or die("MySQL database selection problem");
	
	//database query to get user list
	$sqldeleteuser = "SELECT * FROM crawlt_login WHERE admin=0";
	$requetedeleteuser = db_query($sqldeleteuser, $connexion);
	$nbrresult = mysql_num_rows($requetedeleteuser);
	if ($nbrresult >= 1) {
		while ($ligne = mysql_fetch_object($requetedeleteuser)) {
			$idlogin = $ligne->id_login;
			$userlogin = $ligne->crawlt_user;
			$loginuser[$idlogin] = $userlogin;
		}
		mysql_close($connexion);
		//display
		echo "<br><br><h1>" . $language['user_suppress'] . "</h1>\n";
		echo "<div class='tableau' align='center'>\n";
		echo "<table   cellpadding='0px' cellspacing='0' width='550px'>\n";
		echo "<tr><th class='tableau2' colspan='2'>\n";
		echo "" . $language['user_list'] . "\n";
		echo "</th></tr>\n";
		foreach ($loginuser as $user1) {
			$user1display = htmlentities($user1);
			echo "<tr><td class='tableau3' width='300px'>\n";
			echo "" . $user1display . "\n";
			echo "</td><td class='tableau4'>\n";
			echo "<form action=\"index.php".$varPostFormIncludePageWithRedirection."\" method=\"POST\" >\n";
			echo "<input type=\"hidden\" name ='period' value=\"$period\">\n";
			echo "<input type=\"hidden\" name ='navig' value=\"$navig\">\n";
			echo "<input type=\"hidden\" name ='validform' value=\"8\">\n";
			echo "<input type=\"hidden\" name ='suppressuser' value=\"1\">\n";
			echo "<input type=\"hidden\" name ='logintosuppress' value=\"$user1\">\n";
			echo "<input type='submit' class='button4' value='" . $language['suppress_user'] . "'>\n";
			echo "</form>\n";
			echo "</td></tr>\n";
		}
		echo "</table></div>\n";
		echo "<br><br>\n";
	} else {
		echo "<br><br><h1>" . $language['user_suppress'] . "</h1>\n";
		echo "<div class='tableau' align='center'>\n";
		echo "<table   cellpadding='0px' cellspacing='0' width='450px'>\n";
		echo "<tr><th class='tableau2' colspan='2'>\n";
		echo "" . $language['user_list'] . "\n";
		echo "</th></tr>\n";
		echo "</table></div>\n";
		echo "<br><br>\n";
	}
}
?>
