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
// file: adminsitesuppress.php
// ----------------------------------------------------------------------
// Last update: 12/02/2011
// ----------------------------------------------------------------------
if (! defined('IN_CRAWLT_ADMIN')) {
    exit('<h1>Hacking attempt !!!!</h1>');
}
// initialize array
$pageid = array();
$pageid2 = array();
$namesite = array();
$siteid = array();
$crawlttablepage = array();
if (isset($_POST['suppresssite'])) {
    $suppresssite = (int) $_POST['suppresssite'];
} else {
    $suppresssite = 0;
}
if (isset($_POST['suppresssiteok'])) {
    $suppresssiteok = (int) $_POST['suppresssiteok'];
} else {
    $suppresssiteok = 0;
}
if ($suppresssite == 1) {
    if (isset($_POST['sitetosuppress'])) {
        $sitetosuppress = $_POST['sitetosuppress'];
    } else {
        header("Location:./index.php" . $varPostFormIncludePageWithRedirection . "");
        exit();
    }
    if (isset($_POST['idsitetosuppress'])) {
        $idsitetosuppress = (int) $_POST['idsitetosuppress'];
    } else {
        header("Location:./index.php" . $varPostFormIncludePageWithRedirection . "");
        exit();
    }
    if ($suppresssiteok == 1) {
        // database connection
        $connexion = connectionBDD_Crawltrack();
        
        // empty the cache table
        $sqlcache = "TRUNCATE TABLE crawlt_cache";
        $requetecache = faireUneRequeteOnLine_Crawltrack($sqlcache, $connexion);
        // site suppression
        
        // database query to suppress the site
        $sqldelete = "DELETE FROM crawlt_site WHERE name= '" . sql_quote($sitetosuppress) . "'";
        $requetedelete = faireUneRequeteOnLine_Crawltrack($sqldelete, $connexion);
        
        // database query to suppress the site visits in the visit table
        $sqldelete2 = "DELETE FROM crawlt_visits WHERE crawlt_site_id_site= '" . sql_quote($idsitetosuppress) . "'";
        $requetedelete2 = faireUneRequeteOnLine_Crawltrack($sqldelete2, $connexion);
        
        // database query to optimize the table
        $sqloptimize = "OPTIMIZE TABLE crawlt_visits";
        $requeteoptimize = faireUneRequeteOnLine_Crawltrack($sqloptimize, $connexion);
        
        // database query to list the pages no more used in visit table
        $sql = "SELECT id_page FROM  crawlt_pages
			LEFT OUTER JOIN crawlt_visits
			ON crawlt_visits.crawlt_pages_id_page=crawlt_pages.id_page 
			WHERE crawlt_visits.crawlt_pages_id_page IS NULL";
        $requete = faireUneRequeteOnLine_Crawltrack($sql, $connexion);
        $nbrresult = exploiterNombreLigneResultatBDD_Crawltrack($requete);
        if ($nbrresult >= 1) {
            while ($ligne = exploiterLigneResultatBDD_Crawltrack_row($requete)) {
                $crawlttablepage[] = $ligne[0];
            }
            $crawltlistpage = implode("','", $crawlttablepage);
            
            // database query to suppress the data in page table
            $sqldelete3 = "DELETE FROM crawlt_pages WHERE id_page IN ('$crawltlistpage')";
            $requetedelete3 = faireUneRequeteOnLine_Crawltrack($sqldelete3, $connexion);
            
            // database query to optimize the table
            $sqloptimize2 = "OPTIMIZE TABLE crawlt_pages";
            $requeteoptimize2 = faireUneRequeteOnLine_Crawltrack($sqloptimize2, $connexion);
        }
        deconnectionBDD_Crawltrack($connexion);
        if ($requetedelete && $requetedelete2) {
            echo "<br><br><h1>" . $language['site_suppress_ok'] . "</h1>\n";
            echo "<div class=\"form\">\n";
            echo "<form action=\"index.php" . $varPostFormIncludePageWithRedirection . "\" method=\"POST\" >\n";
            echo "<input type=\"hidden\" name ='navig' value='6'>\n";
            echo "<input name='ok' type='submit'  value='OK' size='20'>\n";
            echo "</form>\n";
            echo "</div><br><br>\n";
        } else {
            echo "<br><br><h1>" . $language['site_suppress_no_ok'] . "</h1>\n";
            echo "<div class=\"form\">\n";
            echo "<form action=\"index.php" . $varPostFormIncludePageWithRedirection . "\" method=\"POST\" >\n";
            echo "<input type=\"hidden\" name ='navig' value='6'>\n";
            echo "<input name='ok' type='submit'  value='OK' size='20'>\n";
            echo "</form>\n";
            echo "</div><br><br>\n";
        }
    } else {
        // validation of suppression
        
        // display
        $sitetosuppress = stripslashes($sitetosuppress);
        $sitetosuppressdisplay = htmlentities($sitetosuppress);
        echo "<br><br><h1>" . $language['site_suppress_validation'] . "</h1>\n";
        echo "<h1>" . $language['site_name'] . "&nbsp;$sitetosuppressdisplay</h1>\n";
        echo "<div class=\"form\">\n";
        echo "<form action=\"index.php" . $varPostFormIncludePageWithRedirection . "\" method=\"POST\" >\n";
        echo "<input type=\"hidden\" name ='navig' value='6'>\n";
        echo "<input type=\"hidden\" name ='validform' value=\"9\">";
        echo "<input type=\"hidden\" name ='suppresssite' value=\"1\">\n";
        echo "<input type=\"hidden\" name ='suppresssiteok' value=\"1\">\n";
        echo "<input type=\"hidden\" name ='sitetosuppress' value=\"$sitetosuppress\">\n";
        echo "<input type=\"hidden\" name ='idsitetosuppress' value=\"$idsitetosuppress\">\n";
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
        echo "<input type=\"hidden\" name ='validform' value=\"9\">";
        echo "<input type=\"hidden\" name ='suppresssite' value=\"0\">\n";
        echo "<input type=\"hidden\" name ='suppresssiteok' value=\"0\">\n";
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
    
    // database query to get site list
    $sqldeletesite = "SELECT * FROM crawlt_site";
    $requetedeletesite = faireUneRequeteOnLine_Crawltrack($sqldeletesite, $connexion);
    $nbrresult = exploiterNombreLigneResultatBDD_Crawltrack($requetedeletesite);
    if ($nbrresult >= 1) {
        while ($ligne = exploiterLigneResultatBDD_Crawltrack($requetedeletesite)) {
            $idsite = $ligne['id_site'];
            $sitename = $ligne['name'];
            $namesite[$idsite] = $sitename;
            $siteid[$sitename] = $idsite;
        }
        
        // display
        echo "<br><br><h1>" . $language['site_suppress'] . "</h1>\n";
        echo "<div class='tableau' align='center'>\n";
        echo "<table   cellpadding='0px' cellspacing='0' width='450px'>\n";
        echo "<tr><th class='tableau2' colspan='2'>\n";
        echo "" . $language['site_list'] . "\n";
        echo "</th></tr>\n";
        foreach ($namesite as $site1) {
            $site1display = htmlentities($site1);
            echo "<tr><td class='tableau3' width='300px'>\n";
            echo "" . $site1display . "\n";
            echo "</td><td class='tableau4'>\n";
            echo "<form action=\"index.php" . $varPostFormIncludePageWithRedirection . "\" method=\"POST\" >\n";
            echo "<input type=\"hidden\" name ='period' value=\"$period\">\n";
            echo "<input type=\"hidden\" name ='navig' value=\"$navig\">\n";
            echo "<input type=\"hidden\" name ='validform' value=\"9\">\n";
            echo "<input type=\"hidden\" name ='suppresssite' value=\"1\">\n";
            echo "<input type=\"hidden\" name ='sitetosuppress' value=\"$site1\">\n";
            echo "<input type=\"hidden\" name ='idsitetosuppress' value=\"" . $siteid[$site1] . "\">\n";
            echo "<input type='submit' class='button4' value='" . $language['suppress_site'] . "'>\n";
            echo "</form>\n";
            echo "</td></tr>\n";
        }
        echo "</table></div>\n";
        echo "<br><br>\n";
    } else {
        // display
        echo "<br><br><h1>" . $language['site_suppress'] . "</h1>\n";
        echo "<div class='tableau' align='center'>\n";
        echo "<table   cellpadding='0px' cellspacing='0' width='450px'>\n";
        echo "<tr><th class='tableau2' colspan='2'>\n";
        echo "" . $language['site_list'] . "\n";
        echo "</th></tr>\n";
        echo "</table></div>\n";
        echo "<br><br>\n";
    }
    deconnectionBDD_Crawltrack($connexion);
}
?>
