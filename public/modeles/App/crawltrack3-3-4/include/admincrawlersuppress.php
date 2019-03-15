<?php
// ----------------------------------------------------------------------
// CrawlTrack 3.2.8
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
// file: admincrawlersuppress.php
// ----------------------------------------------------------------------
// Last update: 12/02/2011
// ----------------------------------------------------------------------
if (! defined('IN_CRAWLT_ADMIN')) {
    exit('<h1>Hacking attempt !!!!</h1>');
}
if (isset($_POST['suppresscrawler'])) {
    $suppresscrawler = (int) $_POST['suppresscrawler'];
} else {
    $suppresscrawler = 0;
}
if (isset($_POST['suppresscrawlerok'])) {
    $suppresscrawlerok = (int) $_POST['suppresscrawlerok'];
} else {
    $suppresscrawlerok = 0;
}
if ($suppresscrawler == 1) {
    if (isset($_POST['crawlertosuppress'])) {
        $crawlertosuppress = $_POST['crawlertosuppress'];
    } else {
        header("Location:./index.php" . $varPostFormIncludePageWithRedirection . "");
        exit();
    }
    if (isset($_POST['idcrawlertosuppress'])) {
        $idcrawlertosuppress = (int) $_POST['idcrawlertosuppress'];
    } else {
        header("Location:./index.php" . $varPostFormIncludePageWithRedirection . "");
        exit();
    }
    if ($suppresscrawlerok == 1) {
        // crawler suppression
        // database connection
        $connexion = connectionBDD_Crawltrack();
        
        // database query to suppress the crawler
        $sqldelete = "DELETE FROM crawlt_crawler WHERE id_crawler= '" . sql_quote($idcrawlertosuppress) . "'";
        $requetedelete = faireUneRequeteOnLine_Crawltrack($sqldelete, $connexion);
        $sqldelete2 = "DELETE FROM crawlt_visits WHERE crawlt_crawler_id_crawler= '" . sql_quote($idcrawlertosuppress) . "'";
        $requetedelete2 = faireUneRequeteOnLine_Crawltrack($sqldelete2, $connexion);
        
        // database query to optimize the table
        $sqloptimize = "OPTIMIZE TABLE crawlt_visits";
        $requeteoptimize = faireUneRequeteOnLine_Crawltrack($sqloptimize, $connexion);
        
        // empty the cache table
        $sqlcache = "TRUNCATE TABLE crawlt_cache";
        $requetecache = faireUneRequeteOnLine_Crawltrack($sqlcache, $connexion);
        if ($requetedelete && $requetedelete2) {
            echo "<br><br><h1>" . $language['crawler_suppress_ok'] . "</h1>\n";
            echo "<div class=\"form\">\n";
            echo "<form action=\"index.php" . $varPostFormIncludePageWithRedirection . "\" method=\"POST\" >\n";
            echo "<input type=\"hidden\" name ='navig' value='6'>\n";
            echo "<input name='ok' type='submit'  value='OK' size='20'>\n";
            echo "</form>\n";
            echo "</div><br><br>\n";
        } else {
            echo "<br><br><h1>" . $language['crawler_suppress_no_ok'] . "</h1>\n";
            echo "<div class=\"form\">\n";
            echo "<form action=\"index.php" . $varPostFormIncludePageWithRedirection . "\" method=\"POST\" >\n";
            echo "<input type=\"hidden\" name ='navig' value='6'>\n";
            echo "<input name='ok' type='submit'  value='OK' size='20'>\n";
            echo "</form>\n";
            echo "</div><br><br>\n";
        }
        deconnectionBDD_Crawltrack($connexion);
    } else {
        // validation of suppression
        // display
        $crawlertosuppress = stripslashes($crawlertosuppress);
        $crawlertosuppressdisplay = htmlentities($crawlertosuppress);
        echo "<br><br><h1>" . $language['crawler_suppress_validation'] . "</h1>\n";
        echo "<h1>" . $language['crawler_name'] . ":&nbsp;$crawlertosuppressdisplay</h1>\n";
        echo "<div class=\"form\">\n";
        echo "<form action=\"index.php" . $varPostFormIncludePageWithRedirection . "\" method=\"POST\" >\n";
        echo "<input type=\"hidden\" name ='navig' value='6'>\n";
        echo "<input type=\"hidden\" name ='validform' value=\"10\">";
        echo "<input type=\"hidden\" name ='suppresscrawler' value=\"1\">\n";
        echo "<input type=\"hidden\" name ='suppresscrawlerok' value=\"1\">\n";
        echo "<input type=\"hidden\" name ='crawlertosuppress' value=\"$crawlertosuppress\">\n";
        echo "<input type=\"hidden\" name ='idcrawlertosuppress' value=\"$idcrawlertosuppress\">\n";
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
        echo "<form action=\"index.php" . $varPostFormIncludePageWithRedirection . "\" method=\"POST\" >\n";
        echo "<input type=\"hidden\" name ='navig' value='6'>\n";
        echo "<input type=\"hidden\" name ='validform' value=\"10\">";
        echo "<input type=\"hidden\" name ='suppresscrawler' value=\"0\">\n";
        echo "<input type=\"hidden\" name ='suppresscrawlerok' value=\"0\">\n";
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
    // database connection
    $connexion = connectionBDD_Crawltrack();
    
    // database query to get crawler list
    $sqldeletecrawler = "SELECT * FROM crawlt_crawler";
    $requetedeletecrawler = faireUneRequeteOnLine_Crawltrack($sqldeletecrawler, $connexion);
    $nbrresult = exploiterNombreLigneResultatBDD_Crawltrack($requetedeletecrawler);
    if ($nbrresult >= 1) {
        while ($ligne = exploiterLigneResultatBDD_Crawltrack($requetedeletecrawler)) {
            $idcrawler = $ligne['id_crawler'];
            $crawlername = $ligne['crawler_name'];
            $crawlerua = $ligne['crawler_user_agent'];
            $crawlerip = $ligne['crawler_ip'];
            $namecrawler[$idcrawler] = $crawlername;
            if (! empty($crawlerua)) {
                $uacrawler[$idcrawler] = $crawlerua;
            } else {
                $uacrawler[$idcrawler] = $crawlerip;
            }
        }
        deconnectionBDD_Crawltrack($connexion);
        asort($namecrawler);
        $current = current($namecrawler);
        do {
            $listidcrawler[] = key($namecrawler);
        } while ($current = next($namecrawler));
        // display
        echo "<br><br><h1>" . $language['crawler_suppress'] . "</h1>\n";
        echo "<div class='tableau' align='center' width='550px'>\n";
        echo "<table   cellpadding='0px' cellspacing='0' width='550px'>\n";
        echo "<tr><th class='tableau2' colspan='3'>\n";
        echo "" . $language['crawler_list'] . "\n";
        echo "</th></tr>\n";
        $colorOne = 1;
        $classOne = array(
            'utilisateurs',
            'utilisateursInverse'
        );
        foreach ($listidcrawler as $crawler1) {
            
            echo "<tr><td class='" . $classOne[$colorOne] . "' width='15%'>\n";
            echo "" . $namecrawler[$crawler1] . "\n";
            echo "</td><td class='" . $classOne[$colorOne] . "' width='70%'>\n";
            $ua = "$uacrawler[$crawler1]";
            $long = strlen($ua);
            if ($long > 80) {
                $ua = substr("$uacrawler[$crawler1]", 0, 80);
                $ua = $ua . "...";
            }
            $uadisplay = htmlentities($ua);
            
            echo "$uadisplay\n";
            echo "</td><td class='" . $classOne[$colorOne] . "' width='15%'>\n";
            echo "<form action=\"index.php" . $varPostFormIncludePageWithRedirection . "\" method=\"POST\" >\n";
            echo "<input type=\"hidden\" name ='period' value=\"$period\">\n";
            echo "<input type=\"hidden\" name ='navig' value=\"$navig\">\n";
            echo "<input type=\"hidden\" name ='validform' value=\"10\">\n";
            echo "<input type=\"hidden\" name ='suppresscrawler' value=\"1\">\n";
            echo "<input type=\"hidden\" name ='crawlertosuppress' value=\"" . $namecrawler[$crawler1] . "\">\n";
            echo "<input type=\"hidden\" name ='idcrawlertosuppress' value=\"$crawler1\">\n";
            echo "<input type='submit' class='button45' value='" . $language['suppress_crawler'] . "'>\n";
            echo "</form>\n";
            echo "</td></tr>\n";
            ($colorOne == 0) ? $colorOne = 1 : $colorOne = 0;
        }
        echo "</table></div>\n";
        echo "<br><br>\n";
    } else {
        // display
        echo "<br><br><h1>" . $language['crawler_suppress'] . "</h1>\n";
        echo "<div class='tableau' align='center' width='550px'>\n";
        echo "<table   cellpadding='0px' cellspacing='0' width='550px'>\n";
        echo "<tr><th class='tableau2' colspan='3'>\n";
        echo "" . $language['crawler_list'] . "\n";
        echo "</th></tr>\n";
        echo "</table></div>\n";
        echo "<br><br>\n";
    }
}
?>
