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
// file: admin.php
// ----------------------------------------------------------------------
// Last update: 25/11/2011
// ----------------------------------------------------------------------
if (! defined('IN_CRAWLT')) {
    exit('<h1>Hacking attempt !!!!</h1>');
}
//echo '<h1>Hacking attempt !!!!</h1>';
// do not modify
define('IN_CRAWLT_ADMIN', TRUE);
// database connection
$connexion = connectionBDD_Crawltrack();

// query to know the actual session id in the table
$sql = "SELECT sessionid FROM crawlt_sessionid";
$requete = faireUneRequeteOnLine_Crawltrack($sql, $connexion);
$nbrresult = exploiterNombreLigneResultatBDD_Crawltrack($requete);
if ($nbrresult >= 1) {
    while ($ligne = exploiterLigneResultatBDD_Crawltrack_row($requete)) {
        $listsessionid[] = $ligne[0];
    }
} else {
    $listsessionid = array();
}

// website list query
if ($_SESSION['rightsite'] == 0) {
    $sql = "SELECT id_site, name, url 
	FROM crawlt_site";
} else {
    $siteright = $_SESSION['rightsite'];
    $sql = "SELECT id_site, name, url 
	FROM crawlt_site	
	WHERE id_site = '" . sql_quote($siteright) . "'";
}

// request to get the sites datas
$requete = faireUneRequeteOnLine_Crawltrack($sql, $connexion);
$nbrresult = exploiterNombreLigneResultatBDD_Crawltrack($requete);
if ($nbrresult >= 1) {
    while ($ligne = exploiterLigneResultatBDD_Crawltrack_row($requete)) {
        $listsite[] = $ligne[0];
        $namesite[$ligne[0]] = $ligne[1];
        $urlsite[$ligne[0]] = $ligne[2];
    }
}
// to check crawltrack.php file used (with or without visitor counting
$checkcrawltrack = file_get_contents(dirname(__FILE__) . '/../crawltrack.php');
if (preg_match("/No-visitor-CrawlTrack/i", $checkcrawltrack)) {
    $novisitorcrawltrack = 1;
} else {
    $novisitorcrawltrack = 0;
}

cadreAlignCentrerDebut();
// include menu
include (dirname(__FILE__) . "/menumain.php");
if ($validform == 33) {
    include (dirname(__FILE__) . "/menusite.php");
}
cadreAlignCentrerFin();
echo "<br /><br /><br /><br />";
echo "<div class=\"content\">\n";
if ($crawltlang == 'french' || $crawltlang == 'frenchiso') {
    cadreAlignCentrerDebut();
    ?>
<div align="right">
	<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
		<input type="hidden" name="cmd" value="_s-xclick"> <input
			type="hidden" name="hosted_button_id" value="5631126"> <input
			type="image"
			src="https://www.paypal.com/fr_FR/FR/i/btn/btn_donateCC_LG.gif"
			border="0" name="submit"
			alt="PayPal - la solution de paiement en ligne la plus simple et la plus sécurisée !">
		<img alt="" border="0"
			src="https://www.paypal.com/fr_FR/i/scr/pixel.gif" width="1"
			height="1">
	</form>
</div>
<?php
} else {
    ?>
<div align="right">
	<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
		<input type="hidden" name="cmd" value="_s-xclick"> <input
			type="hidden" name="hosted_button_id" value="5631313"> <input
			type="image"
			src="https://www.paypal.com/en_US/i/btn/btn_donateCC_LG.gif"
			border="0" name="submit"
			alt="PayPal - The safer, easier way to pay online!"> <img alt=""
			border="0" src="https://www.paypal.com/fr_FR/i/scr/pixel.gif"
			width="1" height="1">
	</form>
</div>
<?php
}
if ($_SESSION['rightadmin'] == 1) {
    switch ($validform) {
        case 6:
            include (dirname(__FILE__) . "/adminuser.php");
            break;
        case 7:
            include (dirname(__FILE__) . "/adminusersite.php");
            break;
        case 4:
            include (dirname(__FILE__) . "/adminsite.php");
            break;
        case 3:
            include (dirname(__FILE__) . "/admintag.php");
            break;
        case 2:
            include (dirname(__FILE__) . "/admincrawler.php");
            break;
        case 8:
            include (dirname(__FILE__) . "/adminusersuppress.php");
            break;
        case 9:
            include (dirname(__FILE__) . "/adminsitesuppress.php");
            break;
        case 10:
            include (dirname(__FILE__) . "/admincrawlersuppress.php");
            break;
        case 11:
            include (dirname(__FILE__) . "/testcrawlercreation.php");
            break;
        case 12:
            include (dirname(__FILE__) . "/testcrawlersuppress.php");
            break;
        case 13:
            include (dirname(__FILE__) . "/update.php");
            break;
        case 14:
            include (dirname(__FILE__) . "/updateremote.php");
            break;
        case 15:
            include (dirname(__FILE__) . "/updatelocal.php");
            break;
        case 16:
            include (dirname(__FILE__) . "/logochoice.php");
            break;
        case 17:
            include (dirname(__FILE__) . "/admindatasuppress.php");
            break;
        case 18:
            include (dirname(__FILE__) . "/admintime.php");
            break;
        case 19:
            include (dirname(__FILE__) . "/adminipsuppress.php");
            break;
        case 20:
            include (dirname(__FILE__) . "/adminmail.php");
            break;
        case 21:
            include (dirname(__FILE__) . "/adminpublicstats.php");
            break;
        case 22:
            include (dirname(__FILE__) . "/adminfirstweekday.php");
            break;
        case 23:
            include (dirname(__FILE__) . "/adminmodifsite.php");
            break;
        case 25:
            include (dirname(__FILE__) . "/adminlang.php");
            break;
        case 26:
            include (dirname(__FILE__) . "/admindatabase.php");
            break;
        case 27:
            include (dirname(__FILE__) . "/updateattack.php");
            break;
        case 28:
            include (dirname(__FILE__) . "/updateremoteattack.php");
            break;
        case 29:
            include (dirname(__FILE__) . "/updatelocalattack.php");
            break;
        case 30:
            include (dirname(__FILE__) . "/adminchangepassword.php");
            break;
        case 31:
            include (dirname(__FILE__) . "/admingoodsites.php");
            break;
        case 32:
            include (dirname(__FILE__) . "/adminbadreferer.php");
            break;
        case 33:
            include (dirname(__FILE__) . "/admingoodreferer.php");
            break;
        default:
            switch ($validform) {
                case 96:
                    // update the crawlt_config table
                    $sql = "UPDATE crawlt_config SET typecharset='" . sql_quote($crawltcharset) . "'";
                    $requete = faireUneRequeteOnLine_Crawltrack($sql, $connexion);
                    break;
                case 97:
                    // update the crawlt_config table
                    $sql = "UPDATE crawlt_config SET typemail='" . sql_quote($crawltmailishtml) . "'";
                    $requete = faireUneRequeteOnLine_Crawltrack($sql, $connexion);
                    break;
                case 98:
                    // update the crawlt_config table
                    $sql = "UPDATE crawlt_config SET rowdisplay='" . sql_quote($rowdisplay) . "'";
                    $requete = faireUneRequeteOnLine_Crawltrack($sql, $connexion);
                    break;
                case 99:
                    // update the crawlt_config table
                    $sql = "UPDATE crawlt_config SET orderdisplay='" . sql_quote($order) . "'";
                    $requete = faireUneRequeteOnLine_Crawltrack($sql, $connexion);
                    break;
                case 100:
                    // update the crawlt_config table
                    $sql = "UPDATE crawlt_config SET blockattack='" . sql_quote($crawltblockattack) . "'";
                    $requete = faireUneRequeteOnLine_Crawltrack($sql, $connexion);
                    break;
                case 101:
                    // clear crawlt_sessionid table
                    $sql = "TRUNCATE TABLE crawlt_sessionid";
                    $requete = faireUneRequeteOnLine_Crawltrack($sql, $connexion);
                    $listsessionid = array();
                    // insert new value in the crawlt_sessionid table
                    $value = "";
                    $testsessionid = false;
                    if ($crawltsessionid1 == 1) {
                        $value .= "('PHPSESSID'),";
                        $testsessionid = true;
                        $listsessionid[] = 'PHPSESSID';
                    }
                    if ($crawltsessionid2 == 1) {
                        $value .= "('phpsessid'),";
                        $testsessionid = true;
                        $listsessionid[] = 'phpsessid';
                    }
                    if ($crawltsessionid3 == 1) {
                        $value .= "('ID'),";
                        $testsessionid = true;
                        $listsessionid[] = 'ID';
                    }
                    if ($crawltsessionid4 == 1) {
                        $value .= "('id'),";
                        $testsessionid = true;
                        $listsessionid[] = 'id';
                    }
                    if ($crawltsessionid5 == 1) {
                        $value .= "('SID'),";
                        $testsessionid = true;
                        $listsessionid[] = 'SID';
                    }
                    if ($crawltsessionid6 == 1) {
                        $value .= "('sid'),";
                        $testsessionid = true;
                        $listsessionid[] = 'sid';
                    }
                    if ($crawltsessionid7 == 1) {
                        $value .= "('S'),";
                        $testsessionid = true;
                        $listsessionid[] = 'S';
                    }
                    if ($crawltsessionid8 == 1) {
                        $value .= "('s'),";
                        $testsessionid = true;
                        $listsessionid[] = 's';
                    }
                    if (! $testsessionid) {
                        $crawltsessionid = 0;
                        $listsessionid = array();
                    } elseif ($crawltsessionid == 1) {
                        // update the crawlt_sessionid table
                        $value = rtrim($value, ",");
                        $sql = "INSERT INTO crawlt_sessionid (sessionid) VALUES $value";
                        $requete = faireUneRequeteOnLine_Crawltrack($sql, $connexion);
                    } else {
                        $listsessionid = array();
                    }
                    // update the crawlt_config table
                    $sql = "UPDATE crawlt_config SET sessionid='" . sql_quote($crawltsessionid) . "'";
                    $requete = faireUneRequeteOnLine_Crawltrack($sql, $connexion);
                    break;
                case 102:
                    foreach ($listsite as $idsite) {
                        if (isset($_POST["idsite" . $idsite])) {
                            $valstatsite[$idsite] = (int) $_POST["idsite" . $idsite];
                        } else {
                            $valstatsite[$idsite] = 0;
                        }
                    }
                    foreach ($valstatsite as $key => $cookie) {
                        $domain = urlencode($urlsite[$key]);
                        echo "<img src=\"" . $pathFromSiteIndexToCrawltrackIndex . "/php/crawltsetcookie.php?key=$key&cookie=$cookie\" width=\"1px\" height=\"1px\" border=\"0\" >";
                        if ($domain != $_SERVER["HTTP_HOST"]) {
                            echo "<img src=\"http://$domain/crawltsetcookie.php?key=$key&cookie=$cookie\" width=\"1px\" height=\"1px\" border=\"0\" >";
                        }
                        if ($cookie == 1) {
                            $_COOKIE["crawltrackstats" . $key] = 'nocountinstats';
                        } else {
                            $_COOKIE["crawltrackstats" . $key] = 'countinstats';
                        }
                    }
                    break;
                case 103:
                    // update the crawlt_config table
                    $sql = "UPDATE crawlt_config SET includeparameter='" . sql_quote($crawltincludeparameter) . "'";
                    $requete = faireUneRequeteOnLine_Crawltrack($sql, $connexion);
                    break;
                case 104:
                    // determine the path to the file
                    if (isset($_SERVER['SCRIPT_FILENAME']) && ! empty($_SERVER['SCRIPT_FILENAME'])) {
                        $path = dirname($_SERVER['SCRIPT_FILENAME']);
                    } elseif (isset($_SERVER['DOCUMENT_ROOT']) && ! empty($_SERVER['DOCUMENT_ROOT']) && isset($_SERVER['PHP_SELF']) && ! empty($_SERVER['PHP_SELF'])) {
                        $path = dirname($_SERVER['DOCUMENT_ROOT'] . $_SERVER['PHP_SELF']);
                    } else {
                        $path = '..';
                    }
                    // url calculation
                    $dom = $_SERVER["HTTP_HOST"];
                    $file1 = $_SERVER["PHP_SELF"];
                    $size = strlen($file1);
                    $file1 = substr($file1, - $size, - 9);
                    $url_crawlt = "http://" . $dom . $file1;
                    
                    if ($novisitorcrawltrack == 1 && $novisitor == 0) {
                        // Get the reference file and replace the needed values
                        $ref_file_content = file_get_contents(dirname(__FILE__) . '/data/crawltrack.base.php');
                        // Replace the values
                        $final_file_content = preg_replace('/FILE_PATH/', $path, $ref_file_content);
                        $final_file_content = preg_replace('/URL_CRAWLTRACK/', $url_crawlt, $final_file_content);
                        $crawltrack_filepath = $path . '/crawltrack.php';
                        $filedir = $path;
                        
                        // chmod the directory
                        @chmod($filedir, 0755);
                        if ($file2 = fopen($crawltrack_filepath, "w")) {
                            fwrite($file2, $final_file_content);
                            fclose($file2);
                        }
                        $novisitorcrawltrack = 0;
                    }
                    if ($novisitorcrawltrack == 0 && $novisitor == 1) {
                        // Get the reference file and replace the needed values
                        $ref_file_content = file_get_contents(dirname(__FILE__) . '/data/crawltrack.base-novisitor.php');
                        // Replace the values
                        $final_file_content = preg_replace('/FILE_PATH/', $path, $ref_file_content);
                        $final_file_content = preg_replace('/URL_CRAWLTRACK/', $url_crawlt, $final_file_content);
                        $crawltrack_filepath = $path . '/crawltrack.php';
                        $filedir = $path;
                        
                        // chmod the directory
                        @chmod($filedir, 0755);
                        if ($file2 = fopen($crawltrack_filepath, "w")) {
                            fwrite($file2, $final_file_content);
                            fclose($file2);
                        }
                        $novisitorcrawltrack = 1;
                    }
                    break;
            } // end switch($validform) - 2nd level
            deconnectionBDD_Crawltrack($connexion);
            
            ?>
<h1><?php echo $language['admin'] ?></h1>
<table>
	<tr>
		<td width="550px" valign="top">
			<h5>
				<img
					src="<?php echo $pathFromRootToCrawltrackImages; ?>images/page_white_php.png"
					width="16" height="16" border="0">&nbsp;&nbsp;<a
					href="./index.php?page=statistiques&navig=6&validform=16"><?php echo $language['see_tag'] ?></a>
			</h5>
			<br>
			<h5>
				<img
					src="<?php echo $pathFromRootToCrawltrackImages; ?>images/tick.png"
					width="16" height="16" border="0">&nbsp;&nbsp;<a
					href="./index.php?page=statistiques&navig=6&validform=11"><?php echo $language['crawler_test_creation'] ?></a>
			</h5>
			<h5>
				<img
					src="<?php echo $pathFromRootToCrawltrackImages; ?>images/cancel.png"
					width="16" height="16" border="0">&nbsp;&nbsp;<a
					href="./index.php?page=statistiques&navig=6&validform=12"><?php echo $language['crawler_test_suppress'] ?></a>
			</h5>
			<br>
			<h5>
				<img
					src="<?php echo $pathFromRootToCrawltrackImages; ?>images/transmit_add.png"
					width="16" height="16" border="0">&nbsp;&nbsp;<a
					href="./index.php?page=statistiques&navig=6&validform=13"><?php echo $language['update_crawler'] ?></a>
			</h5>
			<h5>
				<img
					src="<?php echo $pathFromRootToCrawltrackImages; ?>images/transmit_add.png"
					width="16" height="16" border="0">&nbsp;&nbsp;<a
					href="./index.php?page=statistiques&navig=6&validform=27"><?php echo $language['update_attack'] ?></a>
			</h5>
			<h5>
				<img
					src="<?php echo $pathFromRootToCrawltrackImages; ?>images/database_add.png"
					width="16" height="16" border="0">&nbsp;&nbsp;<a
					href="./index.php?page=statistiques&navig=6&validform=31"><?php echo $language['goodsite_update'] ?></a>
			</h5>
			<h5>
				<img
					src="<?php echo $pathFromRootToCrawltrackImages; ?>images/database_add.png"
					width="16" height="16" border="0">&nbsp;&nbsp;<a
					href="./index.php?page=statistiques&navig=6&validform=32"><?php echo $language['badreferer_update'] ?></a>
			</h5>
			<h5>
				<img
					src="<?php echo $pathFromRootToCrawltrackImages; ?>images/database_add.png"
					width="16" height="16" border="0">&nbsp;&nbsp;<a
					href="./index.php?page=statistiques&navig=6&validform=33"><?php echo $language['goodreferer_update'] ?></a>
			</h5>
			<br>
			<h5>
				<img
					src="<?php echo $pathFromRootToCrawltrackImages; ?>images/email.png"
					width="16" height="16" border="0">&nbsp;&nbsp;<a
					href="./index.php?page=statistiques&navig=6&validform=20"><?php echo $language['mail'] ?></a>
			</h5>
			<h5>
				<img
					src="<?php echo $pathFromRootToCrawltrackImages; ?>images/clock.png"
					width="16" height="16" border="0">&nbsp;&nbsp;<a
					href="./index.php?page=statistiques&navig=6&validform=18"><?php echo $language['time_set_up'] ?></a>
			</h5>
			<h5>
				<img
					src="<?php echo $pathFromRootToCrawltrackImages; ?>images/calendar_view_week.png"
					width="16" height="16" border="0">&nbsp;&nbsp;<a
					href="./index.php?page=statistiques&navig=6&validform=22"><?php echo $language['firstweekday-title'] ?></a>
			</h5>
			<h5>
				<img
					src="<?php echo $pathFromRootToCrawltrackImages; ?>images/lock_open.png"
					width="16" height="16" border="0">&nbsp;&nbsp;<a
					href="./index.php?page=statistiques&navig=6&validform=21"><?php echo $language['public'] ?></a>
			</h5>
			<h5>
				<img
					src="<?php echo $pathFromRootToCrawltrackImages; ?>images/language.png"
					width="16" height="16" border="0">&nbsp;&nbsp;<a
					href="./index.php?page=statistiques&navig=6&validform=25"><?php echo $language['choose_language'] ?></a>
			</h5>
			<br>
			<h5>
				<img
					src="<?php echo $pathFromRootToCrawltrackImages; ?>images/user_edit.png"
					width="16" height="16" border="0">&nbsp;&nbsp;<a
					href="./index.php?page=statistiques&navig=6&validform=30"><?php echo $language['change_password'] ?></a>
			</h5>
			<h5>
				<img
					src="<?php echo $pathFromRootToCrawltrackImages; ?>images/user_add.png"
					width="16" height="16" border="0">&nbsp;&nbsp;<a
					href="./index.php?page=statistiques&navig=6&validform=6"><?php echo $language['user_create'] ?></a>
			</h5>
			<h5>
				<img
					src="<?php echo $pathFromRootToCrawltrackImages; ?>images/user_add.png"
					width="16" height="16" border="0">&nbsp;&nbsp;<a
					href="./index.php?page=statistiques&navig=6&validform=7"><?php echo $language['user_site_create'] ?></a>
			</h5>
			<h5>
				<img
					src="<?php echo $pathFromRootToCrawltrackImages; ?>images/world_add.png"
					width="16" height="16" border="0">&nbsp;&nbsp;<a
					href="./index.php?page=statistiques&navig=6&validform=4"><?php echo $language['new_site'] ?></a>
			</h5>
			<h5>
				<img
					src="<?php echo $pathFromRootToCrawltrackImages; ?>images/world_edit.png"
					width="16" height="16" border="0">&nbsp;&nbsp;<a
					href="./index.php?page=statistiques&navig=6&validform=23"><?php echo $language['modif_site'] ?></a>
			</h5>
			<h5>
				<img
					src="<?php echo $pathFromRootToCrawltrackImages; ?>images/database_add.png"
					width="16" height="16" border="0">&nbsp;&nbsp;<a
					href="./index.php?page=statistiques&navig=6&validform=2"><?php echo $language['new_crawler'] ?></a>
			</h5>
			<br>
			<h5>
				<img
					src="<?php echo $pathFromRootToCrawltrackImages; ?>images/user_delete.png"
					width="16" height="16" border="0">&nbsp;&nbsp;<a
					href="./index.php?page=statistiques&navig=6&validform=8"><?php echo $language['user_suppress'] ?></a>
			</h5>
			<h5>
				<img
					src="<?php echo $pathFromRootToCrawltrackImages; ?>images/world_delete.png"
					width="16" height="16" border="0">&nbsp;&nbsp;<a
					href="./index.php?page=statistiques&navig=6&validform=9"><?php echo $language['site_suppress'] ?></a>
			</h5>
			<h5>
				<img
					src="<?php echo $pathFromRootToCrawltrackImages; ?>images/database_delete.png"
					width="16" height="16" border="0">&nbsp;&nbsp;<a
					href="./index.php?page=statistiques&navig=6&validform=10"><?php echo $language['crawler_suppress'] ?></a>
			</h5>
			<h5>
				<img
					src="<?php echo $pathFromRootToCrawltrackImages; ?>images/database_delete.png"
					width="16" height="16" border="0">&nbsp;&nbsp;<a
					href="./index.php?page=statistiques&navig=6&validform=19"><?php echo $language['ip_suppress'] ?></a>
			</h5>
			<br>
			<h5>
				<img
					src="<?php echo $pathFromRootToCrawltrackImages; ?>images/database.png"
					width="16" height="16" border="0">&nbsp;&nbsp;<a
					href="./index.php?page=statistiques&navig=6&validform=26"><?php echo $language['admin_database'] ?></a>
			</h5>
			<h5>
				<img
					src="<?php echo $pathFromRootToCrawltrackImages; ?>images/compress.png"
					width="16" height="16" border="0">&nbsp;&nbsp;<a
					href="./index.php?page=statistiques&navig=6&validform=17"><?php echo $language['data_suppress'] ?></a>
			</h5>
			<br>
		</td>
		<td valign="top" width="450px">
			<?php
            if ($crawltlang == 'french' || $crawltlang == 'frenchiso') {
                echo "<h2>CrawlTrack infos<br /><br /><div style=\"border: 2px solid #003399 ; padding:5px 5px 15px 5px; margin-left:71px; margin-right:71px;\" ><iframe name=\"I1\" src=\"http://www.crawltrack.net/news/crawltrack-news-fr.php\" marginwidth=\"1\" marginheight=\"1\" scrolling=\"auto\" border=\"1\" bordercolor=\"#003399\" frameborder=\"1px\" width=\"300px\" height=\"150px\"></iframe></div></h2>\n";
            } else {
                echo "<h2>CrawlTrack news<br /><br /><div style=\"border: 2px solid #003399 ; padding:5px 5px 15px 5px; margin-left:71px; margin-right:71px;\" ><iframe  name=\"I1\" src=\"http://www.crawltrack.net/news/crawltrack-news-en.php\" marginwidth=\"1\" marginheight=\"1\" scrolling=\"auto\" border=\"1\" bordercolor=\"#003399\" frameborder=\"1px\" width=\"300px\" height=\"150px\"></iframe></div></h2>\n";
            }
            echo "<br><h2>" . $language['stats_visitors'] . "</h2>";
            echo "<div style=\"border: 2px solid #003399 ; padding-left:5px; padding-top:5px; padding-bottom:15px; margin-left:71px; margin-right:71px; font-size:13px; font-weight:bold; color: #003399;
				font-family: Verdana,Geneva, Arial, Helvetica, Sans-Serif;\" >\n";
            echo $language['count_in_stats'];
            echo "<br><br><form action=\"index.php" . $varPostFormIncludePageWithRedirection . "\" method=\"POST\" z-index:0 style=\" font-size:13px; font-weight:bold; color: #003399;
				font-family: Verdana,Geneva, Arial, Helvetica, Sans-Serif; \">\n";
            echo "<input type=\"hidden\" name ='navig' value=\"6\">\n";
            echo "<input type=\"hidden\" name ='validform' value=\"102\">\n";
            echo "<table>";
            foreach ($listsite as $idsite) {
                if (isset($_COOKIE["crawltrackstats" . $idsite]) && $_COOKIE["crawltrackstats" . $idsite] == 'nocountinstats') {
                    echo "<tr><td>" . $namesite[$idsite] . "</td><td><input type=\"checkbox\" name=\"idsite" . $idsite . "\" value=\"1\" checked></td></tr>\n";
                } else {
                    echo "<tr><td>" . $namesite[$idsite] . "</td><td><input type=\"checkbox\" name=\"idsite" . $idsite . "\" value=\"1\"></td></tr>\n";
                }
            }
            echo "</table><div width=\"100%\" align=\"right\"><input class='tweet' name='ok' type='submit'  value=' OK ' size='20' >&nbsp;&nbsp;&nbsp;&nbsp;</div>\n";
            echo "<br><div class=\"smalltext\">" . $language['stats_visitors_other_domain'] . "</div>";
            echo "</form><hr>&nbsp;\n";
            echo $language['no_visitors_stats2'];
            echo "<br><br><form action=\"index.php" . $varPostFormIncludePageWithRedirection . "\" method=\"POST\" z-index:0 style=\" font-size:13px; font-weight:bold; color: #003399;
				font-family: Verdana,Geneva, Arial, Helvetica, Sans-Serif; \">\n";
            echo "<input type=\"hidden\" name ='navig' value=\"6\">\n";
            echo "<input type=\"hidden\" name ='validform' value=\"104\">\n";
            echo "<table>";
            
            if ($novisitorcrawltrack == 1) {
                echo "<tr><td>" . $language['no_visitors_stats'] . "</td><td><input type=\"checkbox\" name=\"novisitor\" value=\"1\" checked></td></tr>\n";
            } else {
                echo "<tr><td>" . $language['no_visitors_stats'] . "</td><td><input type=\"checkbox\" name=\"novisitor\" value=\"1\"></td></tr>\n";
            }
            
            echo "</table><br><div width=\"100%\" align=\"right\"><input class='tweet' name='ok' type='submit'  value=' OK ' size='20' >&nbsp;&nbsp;&nbsp;&nbsp;</div>\n";
            echo "</form></div>&nbsp;\n";
            
            echo "<br><h2>" . $language['display_parameters'] . "</h2>";
            echo "<div style=\"border: 2px solid #003399 ; padding-left:5px; padding-top:5px; padding-bottom:15px; margin-left:71px; margin-right:71px;\" >\n";
            echo "<form action=\"index.php" . $varPostFormIncludePageWithRedirection . "\" method=\"POST\" z-index:0 style=\" font-size:13px; font-weight:bold; color: #003399;
				font-family: Verdana,Geneva, Arial, Helvetica, Sans-Serif;\">\n";
            echo "<input type=\"hidden\" name ='navig' value=\"6\">\n";
            echo "<input type=\"hidden\" name ='validform' value=\"98\">\n";
            echo $language['numberrowdisplay'] . "<br><input name='rowdisplay'  value='$rowdisplay' type='text' maxlength='5' size='5px' style=\" font-size:13px; font-weight:bold; color: #003399;
			font-family: Verdana,Geneva, Arial, Helvetica, Sans-Serif; float:left\"/><input class='tweet'  name='ok' type='submit'  value=' OK ' size='20' style=\" float:left\">\n";
            echo "</form><br><br>\n";
            echo "<form action=\"index.php" . $varPostFormIncludePageWithRedirection . "\" method=\"POST\" z-index:0 style=\" font-size:13px; font-weight:bold; color: #003399;
				font-family: Verdana,Geneva, Arial, Helvetica, Sans-Serif;\">\n";
            echo "<input type=\"hidden\" name ='navig' value=\"6\">\n";
            echo "<input type=\"hidden\" name ='validform' value=\"99\">\n";
            echo "<br />" . $language['ordertype'] . "<select onchange=\"form.submit()\" size=\"1\" name=\"order\"  style=\" font-size:13px; font-weight:bold; color: #003399;
			font-family: Verdana,Geneva, Arial, Helvetica, Sans-Serif; float:left\">\n";
            if ($order == 0) {
                echo "<option value=\"0\" selected style=\" font-size:13px; font-weight:bold; color: #003399;
				font-family: Verdana,Geneva, Arial, Helvetica, Sans-Serif;\">" . $language['orderbydate'] . "</option>\n";
            } else {
                echo "<option value=\"0\" style=\" font-size:13px; font-weight:bold; color: #003399;
				font-family: Verdana,Geneva, Arial, Helvetica, Sans-Serif;\">" . $language['orderbydate'] . "</option>\n";
            }
            if ($order == 2) {
                echo "<option value=\"2\" selected style=\" font-size:13px; font-weight:bold; color: #003399;
				font-family: Verdana,Geneva, Arial, Helvetica, Sans-Serif;\">" . $language['orderbyvisites'] . "</option>\n";
            } else {
                echo "<option value=\"2\" style=\" font-size:13px; font-weight:bold; color: #003399;
				font-family: Verdana,Geneva, Arial, Helvetica, Sans-Serif;\">" . $language['orderbyvisites'] . "</option>\n";
            }
            if ($order == 3) {
                echo "<option value=\"3\" selected style=\" font-size:13px; font-weight:bold; color: #003399;
				font-family: Verdana,Geneva, Arial, Helvetica, Sans-Serif;\">" . $language['orderbyname'] . "</option>\n";
            } else {
                echo "<option value=\"3\" style=\" font-size:13px; font-weight:bold; color: #003399;
				font-family: Verdana,Geneva, Arial, Helvetica, Sans-Serif;\">" . $language['orderbyname'] . "</option>\n";
            }
            echo "</select></form><br>&nbsp;\n";
            echo "<form action=\"index.php" . $varPostFormIncludePageWithRedirection . "\" method=\"POST\" z-index:0 style=\" font-size:13px; font-weight:bold; color: #003399;
				font-family: Verdana,Geneva, Arial, Helvetica, Sans-Serif; \">\n";
            echo "<input type=\"hidden\" name ='navig' value=\"6\">\n";
            echo "<input type=\"hidden\" name ='validform' value=\"97\">\n";
            echo "Email:<br>\n";
            if ($crawltmailishtml == 1) {
                echo "<input type=\"radio\" name=\"typemail\" value=\"1\" checked>HTML &nbsp;&nbsp;\n";
                echo "<input type=\"radio\" name=\"typemail\" value=\"2\">Text\n";
            } else {
                echo "<input type=\"radio\" name=\"typemail\" value=\"1\">HTML &nbsp;&nbsp;\n";
                echo "<input type=\"radio\" name=\"typemail\" value=\"2\" checked>Text\n";
            }
            echo "<input class='tweet' name='ok' type='submit'  value=' OK ' size='20' >\n";
            echo "</form>&nbsp;\n";
            if ($crawltlang != "russian" && $crawltlang != "bulgarian" && $crawltlang != "turkish" && $crawltlang != "italian") {
                echo "<form action=\"index.php" . $varPostFormIncludePageWithRedirection . "\" method=\"POST\" z-index:0 style=\" font-size:13px; font-weight:bold; color: #003399;
			font-family: Verdana,Geneva, Arial, Helvetica, Sans-Serif; \">\n";
                echo "<input type=\"hidden\" name ='navig' value=\"6\">\n";
                echo "<input type=\"hidden\" name ='validform' value=\"96\">\n";
                echo "Charset:<br>\n";
                if ($crawltcharset == 1) {
                    echo "<input type=\"radio\" name=\"charset\" value=\"1\" checked>utf-8 &nbsp;&nbsp;\n";
                    echo "<input type=\"radio\" name=\"charset\" value=\"2\">iso-8859-1\n";
                } else {
                    echo "<input type=\"radio\" name=\"charset\" value=\"1\">utf-8 &nbsp;&nbsp;\n";
                    echo "<input type=\"radio\" name=\"charset\" value=\"2\" checked>iso-8859-1\n";
                }
                echo "<input class='tweet' name='ok' type='submit'  value=' OK ' size='20' >\n";
                echo "</form>\n";
            }
            echo "</div>&nbsp;\n";
            echo "<br><h2>" . $language['attack_parameters'] . "</h2>";
            echo "<div style=\"border: 2px solid #003399 ; padding-left:5px; padding-top:5px; padding-bottom:15px; margin-left:71px; margin-right:71px;\" >\n";
            echo "<form action=\"index.php" . $varPostFormIncludePageWithRedirection . "\" method=\"POST\" z-index:0 style=\" font-size:13px; font-weight:bold; color: #003399;
				font-family: Verdana,Geneva, Arial, Helvetica, Sans-Serif; \">\n";
            echo "<input type=\"hidden\" name ='navig' value=\"6\">\n";
            echo "<input type=\"hidden\" name ='validform' value=\"100\">\n";
            echo $language['attack_action'] . ":<br><br>\n";
            if ($crawltblockattack == 1) {
                echo "<input type=\"radio\" name=\"blockattack\" value=\"1\" checked>" . $language['attack_block'] . " <br>\n";
                echo "<input type=\"radio\" name=\"blockattack\" value=\"0\">" . $language['attack_no_block'] . "\n";
            } else {
                echo "<input type=\"radio\" name=\"blockattack\" value=\"1\">" . $language['attack_block'] . " <br>\n";
                echo "<input type=\"radio\" name=\"blockattack\" value=\"0\" checked>" . $language['attack_no_block'] . "\n";
            }
            echo "<br><div width=\"100%\" align=\"right\"><input class='tweet' name='ok' type='submit'  value=' OK ' size='20' >&nbsp;&nbsp;&nbsp;&nbsp;</div>\n";
            echo "</form>&nbsp;\n";
            echo "<br><p class='date'>" . $language['attack_block_alert'] . "</p>";
            echo "</div>";
            echo "<br><h2>" . $language['url_parameters'] . "</h2>";
            echo "<div style=\"border: 2px solid #003399 ; padding-left:5px; padding-top:5px; padding-bottom:15px; margin-left:71px; margin-right:71px;\" >\n";
            echo "<form action=\"index.php" . $varPostFormIncludePageWithRedirection . "\" method=\"POST\" z-index:0 style=\" font-size:13px; font-weight:bold; color: #003399;
				  font-family: Verdana,Geneva, Arial, Helvetica, Sans-Serif; \">\n";
            echo "<input type=\"hidden\" name ='navig' value=\"6\">\n";
            echo "<input type=\"hidden\" name ='validform' value=\"103\">\n";
            echo $language['remove_parameter'] . ":<br><br>\n";
            if ($crawltincludeparameter == 0) {
                echo "<input type=\"radio\" name=\"includeparameter\" value=\"0\" checked>" . $language['yes'] . " <br>\n";
                echo "<input type=\"radio\" name=\"includeparameter\" value=\"1\">" . $language['no'] . "\n";
            } else {
                echo "<input type=\"radio\" name=\"includeparameter\" value=\"0\">" . $language['yes'] . " <br>\n";
                echo "<input type=\"radio\" name=\"includeparameter\" value=\"1\" checked>" . $language['no'] . "\n";
            }
            echo "<div width=\"100%\" align=\"right\"><input class='tweet' name='ok' type='submit'  value=' OK ' size='20' >&nbsp;&nbsp;&nbsp;&nbsp;</div>\n";
            echo "</form>&nbsp;\n";
            echo "<br><p class='date'>" . $language['remove_parameter_alert'] . "</p>";
            echo "</div>";
            if ($crawltincludeparameter == 1) {
                echo "<br><h2>" . $language['session_id_parameters'] . "</h2>";
                echo "<div style=\"border: 2px solid #003399 ; padding-left:5px; padding-top:5px; padding-bottom:15px; margin-left:71px; margin-right:71px;\" >\n";
                echo "<form action=\"index.php" . $varPostFormIncludePageWithRedirection . "\" method=\"POST\" z-index:0 style=\" font-size:13px; font-weight:bold; color: #003399;
				  font-family: Verdana,Geneva, Arial, Helvetica, Sans-Serif; \">\n";
                echo "<input type=\"hidden\" name ='navig' value=\"6\">\n";
                echo "<input type=\"hidden\" name ='validform' value=\"101\">\n";
                echo $language['remove_session_id'] . ":<br><br>\n";
                if ($crawltsessionid == 1) {
                    echo "<input type=\"radio\" name=\"sessionid\" value=\"1\" checked>" . $language['yes'] . " <br>\n";
                    echo "<input type=\"radio\" name=\"sessionid\" value=\"0\">" . $language['no'] . "\n";
                } else {
                    echo "<input type=\"radio\" name=\"sessionid\" value=\"1\">" . $language['yes'] . " <br>\n";
                    echo "<input type=\"radio\" name=\"sessionid\" value=\"0\" checked>" . $language['no'] . "\n";
                }
                echo "<br><br>" . $language['session_id_used'] . ":";
                echo "<table width=\"100%\"><tr><td width=\"50%\" valign=\"top\">";
                if (in_array('PHPSESSID', $listsessionid)) {
                    echo "<input type=\"checkbox\" name=\"sessionid1\" value=\"1\" checked>PHPSESSID<br>\n";
                } else {
                    echo "<input type=\"checkbox\" name=\"sessionid1\" value=\"1\">PHPSESSID<br>\n";
                }
                if (in_array('phpsessid', $listsessionid)) {
                    echo "<input  type=\"checkbox\" name=\"sessionid2\" value=\"1\" checked>phpsessid<br>\n";
                } else {
                    echo "<input  type=\"checkbox\" name=\"sessionid2\" value=\"1\">phpsessid<br>\n";
                }
                if (in_array('ID', $listsessionid)) {
                    echo "<input type=\"checkbox\" name=\"sessionid3\" value=\"1\" checked>ID<br>\n";
                } else {
                    echo "<input type=\"checkbox\" name=\"sessionid3\" value=\"1\">ID<br>\n";
                }
                if (in_array('id', $listsessionid)) {
                    echo "<input type=\"checkbox\" name=\"sessionid4\" value=\"1\" checked>id<br>\n";
                } else {
                    echo "<input type=\"checkbox\" name=\"sessionid4\" value=\"1\">id<br>\n";
                }
                echo "</td><td valign=\"top\">";
                if (in_array('SID', $listsessionid)) {
                    echo "<input type=\"checkbox\" name=\"sessionid5\" value=\"1\" checked>SID<br>\n";
                } else {
                    echo "<input type=\"checkbox\" name=\"sessionid5\" value=\"1\">SID<br>\n";
                }
                if (in_array('sid', $listsessionid)) {
                    echo "<input type=\"checkbox\" name=\"sessionid6\" value=\"1\" checked>sid<br>\n";
                } else {
                    echo "<input type=\"checkbox\" name=\"sessionid6\" value=\"1\">sid<br>\n";
                }
                if (in_array('S', $listsessionid)) {
                    echo "<input type=\"checkbox\" name=\"sessionid7\" value=\"1\" checked>S<br>\n";
                } else {
                    echo "<input type=\"checkbox\" name=\"sessionid7\" value=\"1\">S<br>\n";
                }
                if (in_array('s', $listsessionid)) {
                    echo "<input type=\"checkbox\" name=\"sessionid8\" value=\"1\" checked>s<br>\n";
                } else {
                    echo "<input type=\"checkbox\" name=\"sessionid8\" value=\"1\">s<br>\n";
                }
                echo "</td></tr></table>";
                echo "<div width=\"100%\" align=\"right\"><input class='tweet' name='ok' type='submit'  value=' OK ' size='20' >&nbsp;&nbsp;&nbsp;&nbsp;</div>\n";
                echo "</form>&nbsp;\n";
                echo "<br><h3>" . $language['session_id_alert'] . "</h3>";
            }
            echo "</div>";
            echo "</td></tr><tr><td colspan=\"2\">";
            echo "<br><h2>" . $language['download_link'] . "</h2>";
            echo "<div style=\"border: 2px solid #003399 ; padding-left:5px; padding-top:5px; padding-bottom:15px; margin-left:10px; margin-right:10px; font-size:13px;color: #003399;
				font-family: Verdana,Geneva, Arial, Helvetica, Sans-Serif;\" >\n";
            echo $language['download_link2'] . "<br><br>";
            $urlexplode = explode('/', $_SERVER['PHP_SELF']);
            echo "http://" . $_SERVER['HTTP_HOST'] . "/" . $urlexplode[1] . "/php/countdownload.php?url=<b>" . $language['download_link3'] . "</b>";
            echo "<br><br>" . $language['download_link4'];
            echo "</div>&nbsp;\n";
            echo "</td></tr></table>";
            break;
    } // end switch($validform) - 1st level
}  // end if ($_SESSION['rightadmin'] == 1)
else {
    if ($validform == 3) {
        include dirname(__FILE__) . "/admintag.php";
    } elseif ($validform == 16) {
        include dirname(__FILE__) . "/logochoice.php";
    } elseif ($validform == 30) {
        include dirname(__FILE__) . "/adminchangepassword.php";
    } else {
        echo "<h1>" . $language['admin'] . "</h1>\n";
		echo "<h5><img src=\"".$pathFromRootToCrawltrackImages."images/page_white_php.png\" width=\"16\" height=\"16\" border=\"0\" >&nbsp;&nbsp;<a href=\"./index.php?".$varGetIncludePageWithRedirection."navig=6&validform=16\">" . $language['see_tag'] . "</a></h5><br><br>\n";
		echo "<h5><img src=\"".$pathFromRootToCrawltrackImages."images/user_edit.png\" width=\"16\" height=\"16\" border=\"0\" >&nbsp;&nbsp;<a href=\"./index.php?".$varGetIncludePageWithRedirection."navig=6&validform=30\">" . $language['change_password'] . "</a></h5>\n";
		echo "<br><br><br><br><br><br><br><br>";
	}
}
cadreAlignCentrerFin();