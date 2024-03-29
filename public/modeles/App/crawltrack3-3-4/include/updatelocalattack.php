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
// file: updatelocalattack.php
// ----------------------------------------------------------------------
// Last update: 12/09/2010
// ----------------------------------------------------------------------
if (! defined('IN_CRAWLT_ADMIN')) {
    exit('<h1>Hacking attempt !!!!</h1>');
}
// initialize array
$updatelistua = array();
$updatelistname = array();
$updatelisturl = array();
$updatelistuser = array();
$listcrawler = array();
$crawlernameadd = array();
$crawleruaadd = array();
if (file_exists(dirname(__FILE__) . '/attacklist.php')) {
    include (dirname(__FILE__) . "/attacklist.php");
    
    // databaseconnection
    $connexion = connectionBDD_Crawltrack();
    
    // query to get the actual liste id
    $sqlupdate = "SELECT * FROM crawlt_update_attack";
    $requeteupdate = faireUneRequeteOnLine_Crawltrack($sqlupdate, $connexion);
    $idlastupdate = 0;
    while ($ligne = exploiterLigneResultatBDD_Crawltrack($requeteupdate)) {
        $update = $ligne['update_id'];
        if ($update > $idlastupdate) {
            $idlastupdate = $update;
        }
    }
    // test to know is the crawler list is up to date.
    if ($idlist == $idlastupdate) {
        // the list is up to date
        echo "<br><br><h1>" . $language['list_up_to_date'] . "</h1><br><br>";
    } else {
        $tabdata = explode("crawltototrack", $attacklist);
        $nbr = count($tabdata) / 4;
        // we treat the file content
        $i = 0;
        for ($j = 1; $j <= $nbr; $j ++) {
            $updatelistid[$j] = $tabdata[$i];
            $i = $i + 1;
            $updatelistattack[$j] = $tabdata[$i];
            $i = $i + 1;
            $updatelistscript[$j] = $tabdata[$i];
            $i = $i + 1;
            $updatelisttype[$j] = $tabdata[$i];
            $i = $i + 1;
        }
        $sqlexist = "SELECT * FROM crawlt_attack";
        $requeteexist = faireUneRequeteOnLine_Crawltrack($sqlexist, $connexion);
        while ($ligne = exploiterLigneResultatBDD_Crawltrack($requeteexist)) {
            $attackid = $ligne['id_attack'];
            $listattack[] = $attackid;
        }
        $nbrdata = count($updatelistid);
        $nbrupdate = 0;
        
        for ($k = 1; $k <= $nbrdata; $k ++) {
            $id = $updatelistid[$k];
            $attack = $updatelistattack[$k];
            $script = $updatelistscript[$k];
            $type = $updatelisttype[$k];
            if (in_array($id, $listattack)) {} else {
                $sqlinsert = "INSERT INTO crawlt_attack (id_attack,attack, script, type)
								VALUES ('" . sql_quote($id) . "','" . sql_quote($attack) . "','" . sql_quote($script) . "','" . sql_quote($type) . "')";
                $requeteinsert = faireUneRequeteOnLine_Crawltrack($sqlinsert, $connexion);
                $nbrupdate = $nbrupdate + 1;
                $crawlernameadd[] = $attack;
                $crawleruaadd[] = $script;
                $crawlertypeadd[] = $type;
            }
        }
        echo "<h1><br><br>$nbrupdate&nbsp;" . $language['attack_add'] . "<br></h1>";
        $sqlinsertid = "INSERT INTO crawlt_update_attack (update_id) VALUES ('" . sql_quote($idlist) . "')";
        $requeteinsertid = faireUneRequeteOnLine_Crawltrack($sqlinsertid, $connexion);
        
        echo "<div align='center'><table cellpadding='0px' cellspacing='0' width='750px'><tr><td class='tableau1'>" . $language['parameter'] . "</td><td class='tableau1'>" . $language['script'] . "</td><td class='tableau2'>" . $language['attack_type'] . "</td></tr>\n";
        for ($l = 0; $l < $nbrupdate; $l ++) {
            $crawlnamedisplay = htmlentities($crawlernameadd[$l]);
            $crawluadisplay = htmlentities($crawleruaadd[$l]);
            $crawltypedisplay = htmlentities($crawlertypeadd[$l]);
            if ($l % 2 == 0) {
                echo "<tr><td class='tableau3'>$crawlnamedisplay</td>\n";
                echo "<td class='tableau3'>$crawluadisplay</td>\n";
                echo "<td class='tableau5'>$crawltypedisplay</td></tr>\n";
            } else {
                echo "<tr><td class='tableau30'>$crawlnamedisplay</td>\n";
                echo "<td class='tableau30'>$crawluadisplay</td>\n";
                echo "<td class='tableau50'>$crawltypedisplay</td></tr>\n";
            }
        }
        echo "</tr></table></div><br><br>";
    }
    deconnectionBDD_Crawltrack($connexion);
} else {
    echo "<br><br><h1>" . $language['no_attack_list'] . "</h1><br>";
}
?>
