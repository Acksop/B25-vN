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
// file: display-one-keyword.php
// ----------------------------------------------------------------------
// Last update: 12/11/2011
// ----------------------------------------------------------------------
if (! defined('IN_CRAWLT')) {
    exit('<h1>Hacking attempt !!!!</h1>');
}
// initialize array
$visitkeywordgoogle = array();
$visitkeywordgoogleimage = array();
$visitkeywordYahoo = array();
$visitkeywordMSN = array();
$visitkeywordask = array();
$visitkeywordexalead = array();
$visitkeywordyandex = array();
$visitkeywordaol = array();
$visitkeyword = array();
$visitkeyworddisplay = array();
$positioncd = array();
$positionstart = array();
$position = array();
$countvisithost = array();
$crawlencode = urlencode($crawler);
$nbrresultgoogle = 0;
$nbrresultMSN = 0;
$nbrresultYahoo = 0;
$nbrresultgoogleimage = 0;
$nbrresultask = 0;
$nbrresultexalead = 0;
$nbrresultyandex = 0;
$nbrresultaol = 0;
// collect post data
if (isset($_POST['choosekeyword'])) {
    $choosekeyword = (int) $_POST['choosekeyword'];
} else {
    $choosekeyword = 0;
}

if ($choosekeyword == 1) {
    if (isset($_POST['askkeyword'])) {
        $askkeyword = (int) $_POST['askkeyword'];
    } else {
        $askkeyword = 0;
    }
    if (isset($_POST['baidukeyword'])) {
        $baidukeyword = (int) $_POST['baidukeyword'];
    } else {
        $baidukeyword = 0;
    }
    if (isset($_POST['googlekeyword'])) {
        $googlekeyword = (int) $_POST['googlekeyword'];
    } else {
        $googlekeyword = 0;
    }
    if (isset($_POST['googleimagekeyword'])) {
        $googleimagekeyword = (int) $_POST['googleimagekeyword'];
    } else {
        $googleimagekeyword = 0;
    }
    if (isset($_POST['msnkeyword'])) {
        $msnkeyword = (int) $_POST['msnkeyword'];
    } else {
        $msnkeyword = 0;
    }
    if (isset($_POST['yahookeyword'])) {
        $yahookeyword = (int) $_POST['yahookeyword'];
    } else {
        $yahookeyword = 0;
    }
    if (isset($_POST['yandexkeyword'])) {
        $yandexkeyword = (int) $_POST['yandexkeyword'];
    } else {
        $yandexkeyword = 0;
    }
    if (isset($_POST['aolkeyword'])) {
        $aolkeyword = (int) $_POST['aolkeyword'];
    } else {
        $aolkeyword = 0;
    }
} else {
    $askkeyword = 1;
    $baidukeyword = 1;
    $googlekeyword = 1;
    $googleimagekeyword = 1;
    $msnkeyword = 1;
    $yahookeyword = 1;
    $yandexkeyword = 1;
    $aolkeyword = 1;
}

$cachename = $navig . $period . $site . $order . $rowdisplay . $crawlencode . $displayall . $firstdayweek . $localday . $graphpos . $crawltlang . $askkeyword . $baidukeyword . $googlekeyword . $googleimagekeyword . $msnkeyword . $yahookeyword . $yandexkeyword . $aolkeyword;

// start the caching
cache($cachename);
// database connection
$connexion = connectionBDD_Crawltrack();

// include menu
cadreAlignCentrerDebut();
include (dirname(__FILE__) . "/menumain.php");
include (dirname(__FILE__) . "/menusite.php");
include (dirname(__FILE__) . "/timecache.php");
cadreAlignCentrerFin();
// clean table from crawler entry
include (dirname(__FILE__) . "/cleaning-crawler-entry.php");
// limite to
if ($displayall == 'no') {
    $limitquery = 'LIMIT ' . $rowdisplay;
} else {
    $limitquery = '';
}
// date for the mysql query
if ($period >= 10) {
    $datetolookfor = " date >'" . sql_quote($daterequest) . "' 
	AND  date <'" . sql_quote($daterequest2) . "'";
} else {
    $datetolookfor = " date >'" . sql_quote($daterequest) . "'";
}
// date for mysql query for keyword position one month ago (5 days sample)
$daterequest3 = date("Y-m-d H:i:s", (strtotime($daterequest) - (35 * 86400)));
$daterequest4 = date("Y-m-d H:i:s", (strtotime($daterequest) - (30 * 86400)));
$datetolookfor2 = " date >'" . sql_quote($daterequest3) . "' AND  date <'" . sql_quote($daterequest4) . "'";
// date for mysql query for keyword position two monthes ago (5 days sample)
$daterequest5 = date("Y-m-d H:i:s", (strtotime($daterequest) - (65 * 86400)));
$daterequest6 = date("Y-m-d H:i:s", (strtotime($daterequest) - (60 * 86400)));
$datetolookfor3 = " date >'" . sql_quote($daterequest5) . "' AND  date <'" . sql_quote($daterequest6) . "'";
// date for mysql query for keyword position three monthes ago (5 days sample)
$daterequest7 = date("Y-m-d H:i:s", (strtotime($daterequest) - (95 * 86400)));
$daterequest8 = date("Y-m-d H:i:s", (strtotime($daterequest) - (90 * 86400)));
$datetolookfor4 = " date >'" . sql_quote($daterequest7) . "' AND  date <'" . sql_quote($daterequest8) . "'";
// query to have the keyword for Google
if ($googlekeyword == 1) {
    $sqlgoogle = "SELECT  url_page, count(DISTINCT CONCAT(crawlt_ip, crawlt_browser))
FROM crawlt_visits_human
INNER JOIN crawlt_pages
ON crawlt_visits_human.crawlt_id_page=crawlt_pages.id_page 
INNER JOIN crawlt_keyword
ON crawlt_visits_human.crawlt_keyword_id_keyword=crawlt_keyword.id_keyword
WHERE  $datetolookfor
AND crawlt_site_id_site='" . sql_quote($site) . "'
AND keyword='" . sql_quote($crawler2) . "' 
AND crawlt_id_crawler= '1'    
GROUP BY url_page";
    $requetegoogle = faireUneRequeteOnLine_Crawltrack($sqlgoogle, $connexion);
    $nbrresultgoogle = exploiterNombreLigneResultatBDD_Crawltrack($requetegoogle);
    if ($nbrresultgoogle >= 1) {
        while ($ligne = exploiterLigneResultatBDD_Crawltrack_row($requetegoogle)) {
            $visitkeywordgoogle[$ligne[0]] = $ligne[1];
        }
    }
}
// query to have the keyword for Google-Image
if ($googleimagekeyword == 1) {
    $sqlgoogleimage = "SELECT  url_page, count(DISTINCT CONCAT(crawlt_ip, crawlt_browser))
FROM crawlt_visits_human
INNER JOIN crawlt_pages
ON crawlt_visits_human.crawlt_id_page=crawlt_pages.id_page 
INNER JOIN crawlt_keyword
ON crawlt_visits_human.crawlt_keyword_id_keyword=crawlt_keyword.id_keyword
WHERE  $datetolookfor
AND crawlt_site_id_site='" . sql_quote($site) . "'
AND keyword='" . sql_quote($crawler2) . "' 
AND crawlt_id_crawler= '6'    
GROUP BY url_page";
    $requetegoogleimage = faireUneRequeteOnLine_Crawltrack($sqlgoogleimage, $connexion);
    $nbrresultgoogleimage = exploiterNombreLigneResultatBDD_Crawltrack($requetegoogleimage);
    if ($nbrresultgoogleimage >= 1) {
        while ($ligne = exploiterLigneResultatBDD_Crawltrack_row($requetegoogleimage)) {
            $visitkeywordgoogleimage[$ligne[0]] = $ligne[1];
        }
    }
}
// query to get google referer to details position in google per host
$sqlgoogle2 = "SELECT  referer 
FROM crawlt_visits_human
INNER JOIN crawlt_keyword
ON crawlt_visits_human.crawlt_keyword_id_keyword=crawlt_keyword.id_keyword
LEFT OUTER JOIN crawlt_referer
ON crawlt_visits_human.crawlt_id_referer=crawlt_referer.id_referer
WHERE  $datetolookfor
AND crawlt_site_id_site='" . sql_quote($site) . "'
AND keyword ='" . sql_quote($crawler2) . "' 
AND crawlt_id_crawler= '1'";
$requetegoogle2 = faireUneRequeteOnLine_Crawltrack($sqlgoogle2, $connexion);
$nbrresult = exploiterNombreLigneResultatBDD_Crawltrack($requetegoogle2);
if ($nbrresult >= 1) {
    while ($ligne = exploiterLigneResultatBDD_Crawltrack_row($requetegoogle2)) {
        $listreferergoogle[] = $ligne[0];
    }
    foreach ($listreferergoogle as $value) {
        $referertreatment = parse_url($value);
        parse_str($referertreatment['query'], $tabvar);
        $listhost[$referertreatment['host']] = $referertreatment['host'];
        $countvisithost[$referertreatment['host']] = @$countvisithost[$referertreatment['host']] + 1;
        if (isset($tabvar['cd'])) {
            if (isset($positioncd[$referertreatment['host']])) {
                if ($tabvar['cd'] < $positioncd[$referertreatment['host']]) {
                    $positioncd[$referertreatment['host']] = $tabvar['cd'];
                }
            } else {
                $positioncd[$referertreatment['host']] = $tabvar['cd'];
            }
        } elseif (isset($tabvar['start'])) {
            if (isset($positionstart[$referertreatment['host']])) {
                if ($tabvar['start'] < $positionstart[$referertreatment['host']]) {
                    $positionstart[$referertreatment['host']] = $tabvar['start'];
                }
            } else {
                $positionstart[$referertreatment['host']] = $tabvar['start'];
            }
        }
    }
    foreach ($listhost as $value) {
        if (isset($positioncd[$value]) && ! isset($positionstart[$value])) {
            $position[$value] = $positioncd[$value];
        } elseif (! isset($positioncd[$value]) && isset($positionstart[$value])) {
            $position[$value] = $positionstart[$value] . " &#8804; ? &#8804; " . ($positionstart[$value] + 9);
        } elseif (isset($positioncd[$value]) && isset($positionstart[$value])) {
            if ($positioncd[$value] < ($positionstart[$value] + 10)) {
                $position[$value] = $positioncd[$value];
            } else {
                $position[$value] = $positionstart[$value] . " &#8804; ? &#8804; " . ($positionstart[$value] + 9);
            }
        } else {
            $position[$value] = "-";
        }
    }
    arsort($countvisithost);
}
// query to get google referer to details position in google per host one month ago
$sqlgoogle3 = "SELECT  referer 
FROM crawlt_visits_human
INNER JOIN crawlt_keyword
ON crawlt_visits_human.crawlt_keyword_id_keyword=crawlt_keyword.id_keyword
LEFT OUTER JOIN crawlt_referer
ON crawlt_visits_human.crawlt_id_referer=crawlt_referer.id_referer
WHERE  $datetolookfor2
AND crawlt_site_id_site='" . sql_quote($site) . "'
AND keyword ='" . sql_quote($crawler2) . "' 
AND crawlt_id_crawler= '1'";
$requetegoogle3 = faireUneRequeteOnLine_Crawltrack($sqlgoogle3, $connexion);
$nbrresult = exploiterNombreLigneResultatBDD_Crawltrack($requetegoogle3);
if ($nbrresult >= 1) {
    while ($ligne = exploiterLigneResultatBDD_Crawltrack_row($requetegoogle3)) {
        $listreferergoogle3[] = $ligne[0];
    }
    foreach ($listreferergoogle3 as $value) {
        $referertreatment = parse_url($value);
        parse_str($referertreatment['query'], $tabvar);
        $listhost3[$referertreatment['host']] = $referertreatment['host'];
        if (isset($tabvar['cd'])) {
            if (isset($positioncd3[$referertreatment['host']])) {
                if ($tabvar['cd'] < $positioncd3[$referertreatment['host']]) {
                    $positioncd3[$referertreatment['host']] = $tabvar['cd'];
                }
            } else {
                $positioncd3[$referertreatment['host']] = $tabvar['cd'];
            }
        } elseif (isset($tabvar['start'])) {
            if (isset($positionstart3[$referertreatment['host']])) {
                if ($tabvar['start'] < $positionstart3[$referertreatment['host']]) {
                    $positionstart3[$referertreatment['host']] = $tabvar['start'];
                }
            } else {
                $positionstart3[$referertreatment['host']] = $tabvar['start'];
            }
        }
    }
    foreach ($listhost3 as $value) {
        if (isset($positioncd3[$value]) && ! isset($positionstart3[$value])) {
            $position3[$value] = $positioncd3[$value];
        } elseif (! isset($positioncd3[$value]) && isset($positionstart3[$value])) {
            $position3[$value] = $positionstart3[$value] . " &#8804; ? &#8804; " . ($positionstart3[$value] + 9);
        } elseif (isset($positioncd3[$value]) && isset($positionstart3[$value])) {
            if ($positioncd3[$value] < ($positionstart3[$value] + 10)) {
                $position3[$value] = $positioncd3[$value];
            } else {
                $position3[$value] = $positionstart3[$value] . " &#8804; ? &#8804; " . ($positionstart3[$value] + 9);
            }
        } else {
            $position3[$value] = "-";
        }
    }
}
// query to get google referer to details position in google per host two monthes ago
$sqlgoogle4 = "SELECT  referer 
FROM crawlt_visits_human
INNER JOIN crawlt_keyword
ON crawlt_visits_human.crawlt_keyword_id_keyword=crawlt_keyword.id_keyword
LEFT OUTER JOIN crawlt_referer
ON crawlt_visits_human.crawlt_id_referer=crawlt_referer.id_referer
WHERE  $datetolookfor3
AND crawlt_site_id_site='" . sql_quote($site) . "'
AND keyword ='" . sql_quote($crawler2) . "' 
AND crawlt_id_crawler= '1'";
$requetegoogle4 = faireUneRequeteOnLine_Crawltrack($sqlgoogle4, $connexion);
$nbrresult = exploiterNombreLigneResultatBDD_Crawltrack($requetegoogle4);
if ($nbrresult >= 1) {
    while ($ligne = exploiterLigneResultatBDD_Crawltrack_row($requetegoogle4)) {
        $listreferergoogle4[] = $ligne[0];
    }
    foreach ($listreferergoogle4 as $value) {
        $referertreatment = parse_url($value);
        parse_str($referertreatment['query'], $tabvar);
        $listhost4[$referertreatment['host']] = $referertreatment['host'];
        if (isset($tabvar['cd'])) {
            if (isset($positioncd4[$referertreatment['host']])) {
                if ($tabvar['cd'] < $positioncd4[$referertreatment['host']]) {
                    $positioncd4[$referertreatment['host']] = $tabvar['cd'];
                }
            } else {
                $positioncd4[$referertreatment['host']] = $tabvar['cd'];
            }
        } elseif (isset($tabvar['start'])) {
            if (isset($positionstart4[$referertreatment['host']])) {
                if ($tabvar['start'] < $positionstart4[$referertreatment['host']]) {
                    $positionstart4[$referertreatment['host']] = $tabvar['start'];
                }
            } else {
                $positionstart4[$referertreatment['host']] = $tabvar['start'];
            }
        }
    }
    foreach ($listhost4 as $value) {
        if (isset($positioncd4[$value]) && ! isset($positionstart4[$value])) {
            $position4[$value] = $positioncd4[$value];
        } elseif (! isset($positioncd4[$value]) && isset($positionstart4[$value])) {
            $position4[$value] = $positionstart4[$value] . " &#8804; ? &#8804; " . ($positionstart4[$value] + 9);
        } elseif (isset($positioncd4[$value]) && isset($positionstart4[$value])) {
            if ($positioncd4[$value] < ($positionstart4[$value] + 10)) {
                $position4[$value] = $positioncd4[$value];
            } else {
                $position4[$value] = $positionstart4[$value] . " &#8804; ? &#8804; " . ($positionstart4[$value] + 9);
            }
        } else {
            $position4[$value] = "-";
        }
    }
}
// query to get google referer to details position in google per host three monthes ago
$sqlgoogle5 = "SELECT  referer 
FROM crawlt_visits_human
INNER JOIN crawlt_keyword
ON crawlt_visits_human.crawlt_keyword_id_keyword=crawlt_keyword.id_keyword
LEFT OUTER JOIN crawlt_referer
ON crawlt_visits_human.crawlt_id_referer=crawlt_referer.id_referer
WHERE  $datetolookfor4
AND crawlt_site_id_site='" . sql_quote($site) . "'
AND keyword ='" . sql_quote($crawler2) . "' 
AND crawlt_id_crawler= '1'";
$requetegoogle5 = faireUneRequeteOnLine_Crawltrack($sqlgoogle5, $connexion);
$nbrresult = exploiterNombreLigneResultatBDD_Crawltrack($requetegoogle5);
if ($nbrresult >= 1) {
    while ($ligne = exploiterLigneResultatBDD_Crawltrack_row($requetegoogle5)) {
        $listreferergoogle5[] = $ligne[0];
    }
    foreach ($listreferergoogle5 as $value) {
        $referertreatment = parse_url($value);
        parse_str($referertreatment['query'], $tabvar);
        $listhost5[$referertreatment['host']] = $referertreatment['host'];
        if (isset($tabvar['cd'])) {
            if (isset($positioncd5[$referertreatment['host']])) {
                if ($tabvar['cd'] < $positioncd5[$referertreatment['host']]) {
                    $positioncd5[$referertreatment['host']] = $tabvar['cd'];
                }
            } else {
                $positioncd5[$referertreatment['host']] = $tabvar['cd'];
            }
        } elseif (isset($tabvar['start'])) {
            if (isset($positionstart5[$referertreatment['host']])) {
                if ($tabvar['start'] < $positionstart5[$referertreatment['host']]) {
                    $positionstart5[$referertreatment['host']] = $tabvar['start'];
                }
            } else {
                $positionstart5[$referertreatment['host']] = $tabvar['start'];
            }
        }
    }
    foreach ($listhost5 as $value) {
        if (isset($positioncd5[$value]) && ! isset($positionstart5[$value])) {
            $position5[$value] = $positioncd5[$value];
        } elseif (! isset($positioncd5[$value]) && isset($positionstart5[$value])) {
            $position5[$value] = $positionstart5[$value] . " &#8804; ? &#8804; " . ($positionstart5[$value] + 9);
        } elseif (isset($positioncd5[$value]) && isset($positionstart5[$value])) {
            if ($positioncd5[$value] < ($positionstart5[$value] + 10)) {
                $position5[$value] = $positioncd5[$value];
            } else {
                $position5[$value] = $positionstart5[$value] . " &#8804; ? &#8804; " . ($positionstart5[$value] + 9);
            }
        } else {
            $position5[$value] = "-";
        }
    }
}

// query to have the keyword for Yahoo
if ($yahookeyword == 1) {
    $sqlYahoo = "SELECT  url_page, count(DISTINCT CONCAT(crawlt_ip, crawlt_browser)) 
FROM crawlt_visits_human
INNER JOIN crawlt_pages
ON crawlt_visits_human.crawlt_id_page=crawlt_pages.id_page
INNER JOIN crawlt_keyword
ON crawlt_visits_human.crawlt_keyword_id_keyword=crawlt_keyword.id_keyword 
WHERE  $datetolookfor
AND crawlt_site_id_site='" . sql_quote($site) . "'
AND keyword='" . sql_quote($crawler2) . "'
AND crawlt_id_crawler= '2'    
GROUP BY url_page";
    $requeteYahoo = faireUneRequeteOnLine_Crawltrack($sqlYahoo, $connexion);
    $nbrresultYahoo = exploiterNombreLigneResultatBDD_Crawltrack($requeteYahoo);
    if ($nbrresultYahoo >= 1) {
        while ($ligne = exploiterLigneResultatBDD_Crawltrack_row($requeteYahoo)) {
            $visitkeywordYahoo[$ligne[0]] = $ligne[1];
        }
    }
}
// query to have the keyword for MSN
if ($msnkeyword == 1) {
    $sqlMSN = "SELECT  url_page, count(DISTINCT CONCAT(crawlt_ip, crawlt_browser))
FROM crawlt_visits_human
INNER JOIN crawlt_pages
ON crawlt_visits_human.crawlt_id_page=crawlt_pages.id_page
INNER JOIN crawlt_keyword
ON crawlt_visits_human.crawlt_keyword_id_keyword=crawlt_keyword.id_keyword 
WHERE  $datetolookfor 
AND crawlt_site_id_site='" . sql_quote($site) . "'
AND keyword='" . sql_quote($crawler2) . "'
AND crawlt_id_crawler= '3'    
GROUP BY url_page";
    $requeteMSN = faireUneRequeteOnLine_Crawltrack($sqlMSN, $connexion);
    $nbrresultMSN = exploiterNombreLigneResultatBDD_Crawltrack($requeteMSN);
    if ($nbrresultMSN >= 1) {
        while ($ligne = exploiterLigneResultatBDD_Crawltrack_row($requeteMSN)) {
            $visitkeywordMSN[$ligne[0]] = $ligne[1];
        }
    }
}
// query to have the keyword for Ask
if ($askkeyword == 1) {
    $sqlask = "SELECT  url_page, count(DISTINCT CONCAT(crawlt_ip, crawlt_browser))
FROM crawlt_visits_human
INNER JOIN crawlt_pages
ON crawlt_visits_human.crawlt_id_page=crawlt_pages.id_page
INNER JOIN crawlt_keyword
ON crawlt_visits_human.crawlt_keyword_id_keyword=crawlt_keyword.id_keyword 
WHERE  $datetolookfor 
AND crawlt_site_id_site='" . sql_quote($site) . "'
AND keyword='" . sql_quote($crawler2) . "'
AND crawlt_id_crawler= '4'    
GROUP BY url_page";
    $requeteask = faireUneRequeteOnLine_Crawltrack($sqlask, $connexion);
    $nbrresultask = exploiterNombreLigneResultatBDD_Crawltrack($requeteask);
    if ($nbrresultask >= 1) {
        while ($ligne = exploiterLigneResultatBDD_Crawltrack_row($requeteask)) {
            $visitkeywordask[$ligne[0]] = $ligne[1];
        }
    }
}
// request to have the keyword for Baidu
if ($baidukeyword == 1) {
    $sqlexalead = "SELECT  url_page, count(DISTINCT CONCAT(crawlt_ip, crawlt_browser))
FROM crawlt_visits_human
INNER JOIN crawlt_pages
ON crawlt_visits_human.crawlt_id_page=crawlt_pages.id_page
INNER JOIN crawlt_keyword
ON crawlt_visits_human.crawlt_keyword_id_keyword=crawlt_keyword.id_keyword 
WHERE  $datetolookfor 
AND crawlt_site_id_site='" . sql_quote($site) . "'
AND keyword='" . sql_quote($crawler2) . "'
AND crawlt_id_crawler= '5'    
GROUP BY url_page";
    $requeteexalead = faireUneRequeteOnLine_Crawltrack($sqlexalead, $connexion);
    $nbrresultexalead = exploiterNombreLigneResultatBDD_Crawltrack($requeteexalead);
    if ($nbrresultexalead >= 1) {
        while ($ligne = exploiterLigneResultatBDD_Crawltrack_row($requeteexalead)) {
            $visitkeywordexalead[$ligne[0]] = $ligne[1];
        }
    }
}
// request to have the keyword for Yandex
if ($yandexkeyword == 1) {
    $sqlyandex = "SELECT  url_page, count(DISTINCT CONCAT(crawlt_ip, crawlt_browser))
FROM crawlt_visits_human
INNER JOIN crawlt_pages
ON crawlt_visits_human.crawlt_id_page=crawlt_pages.id_page
INNER JOIN crawlt_keyword
ON crawlt_visits_human.crawlt_keyword_id_keyword=crawlt_keyword.id_keyword 
WHERE  $datetolookfor 
AND crawlt_site_id_site='" . sql_quote($site) . "'
AND keyword='" . sql_quote($crawler2) . "'
AND crawlt_id_crawler= '7'    
GROUP BY url_page";
    $requeteyandex = faireUneRequeteOnLine_Crawltrack($sqlyandex, $connexion);
    $nbrresultyandex = exploiterNombreLigneResultatBDD_Crawltrack($requeteyandex);
    if ($nbrresultyandex >= 1) {
        while ($ligne = exploiterLigneResultatBDD_Crawltrack_row($requeteyandex)) {
            $visitkeywordyandex[$ligne[0]] = $ligne[1];
        }
    }
}
// request to have the keyword for Aol
if ($aolkeyword == 1) {
    $sqlaol = "SELECT  url_page, count(DISTINCT CONCAT(crawlt_ip, crawlt_browser))
FROM crawlt_visits_human
INNER JOIN crawlt_pages
ON crawlt_visits_human.crawlt_id_page=crawlt_pages.id_page
INNER JOIN crawlt_keyword
ON crawlt_visits_human.crawlt_keyword_id_keyword=crawlt_keyword.id_keyword 
WHERE  $datetolookfor 
AND crawlt_site_id_site='" . sql_quote($site) . "'
AND keyword='" . sql_quote($crawler2) . "'
AND crawlt_id_crawler= '8'    
GROUP BY url_page";
    $requeteaol = faireUneRequeteOnLine_Crawltrack($sqlaol, $connexion);
    $nbrresultaol = exploiterNombreLigneResultatBDD_Crawltrack($requeteaol);
    if ($nbrresultaol >= 1) {
        while ($ligne = exploiterLigneResultatBDD_Crawltrack_row($requeteaol)) {
            $visitkeywordaol[$ligne[0]] = $ligne[1];
        }
    }
}
// calculation of total number of entry per keyword
$visitkeyword = array();
if ($nbrresultgoogle >= 1) {
    foreach ($visitkeywordgoogle as $key => $value) {
        $visitkeyword[$key] = $value;
    }
}
if ($nbrresultgoogleimage >= 1) {
    foreach ($visitkeywordgoogleimage as $key => $value) {
        $visitkeyword[$key] = @$visitkeyword[$key] + $value;
    }
}
if ($nbrresultYahoo >= 1) {
    foreach ($visitkeywordYahoo as $key => $value) {
        $visitkeyword[$key] = @$visitkeyword[$key] + $value;
    }
}
if ($nbrresultMSN >= 1) {
    foreach ($visitkeywordMSN as $key => $value) {
        $visitkeyword[$key] = @$visitkeyword[$key] + $value;
    }
}
if ($nbrresultask >= 1) {
    foreach ($visitkeywordask as $key => $value) {
        $visitkeyword[$key] = @$visitkeyword[$key] + $value;
    }
}
if ($nbrresultexalead >= 1) {
    foreach ($visitkeywordexalead as $key => $value) {
        $visitkeyword[$key] = @$visitkeyword[$key] + $value;
    }
}
if ($nbrresultyandex >= 1) {
    foreach ($visitkeywordyandex as $key => $value) {
        $visitkeyword[$key] = @$visitkeyword[$key] + $value;
    }
}
if ($nbrresultaol >= 1) {
    foreach ($visitkeywordaol as $key => $value) {
        $visitkeyword[$key] = @$visitkeyword[$key] + $value;
    }
}
// mysql connexion close
deconnectionBDD_Crawltrack($connexion);
arsort($visitkeyword);
// display
echo "<div class=\"content2\"><br>\n";
cadreAlignCentrerDebut();

// to close the menu rollover
echo "<div width='100%' height:'5px' onmouseover=\"javascript:montre();\">&nbsp;</div>\n";
echo "<div class='tableaularge' align='center'>\n";
// display google position
if (count($countvisithost) >= 1) {
    echo "<h2>" . $language['googledetail'] . "</h2><br>";
    echo "<table   cellpadding='0px' cellspacing='0' width='100%'>\n";
    echo "<tr onmouseover=\"javascript:montre();\">\n";
    echo "<th class='tableau1' >\n";
    echo "" . $language['google'] . "\n";
    echo "</th>\n";
    echo "<th class='tableau1' >\n";
    echo "" . $language['nbr_visits'] . "\n";
    echo "</th>\n";
    echo "<th class='tableau1' >\n";
    echo "" . $language['position'] . "\n";
    echo "</th>\n";
    echo "<th class='tableau1' >\n";
    echo "" . $language['positiononemonth'] . "\n";
    echo "</th>\n";
    echo "<th class='tableau1' >\n";
    echo "" . $language['positiontwomonth'] . "\n";
    echo "</th>\n";
    echo "<th class='tableau2' >\n";
    echo "" . $language['positionthreemonth'] . "\n";
    echo "</th></tr>\n";
    // counter for alternate color lane
    $comptligne = 2;
    foreach ($countvisithost as $key => $value) {
        
        if ($crawler2 == '(not provided)') {
            $position[$key] = '-';
            $position3[$key] = '-';
            $position4[$key] = '-';
            $position5[$key] = '-';
        }
        
        if ($comptligne % 2 == 0) {
            echo "<tr><td class='tableau3g'>&nbsp;&nbsp;&nbsp;&nbsp;" . $key . "</td>\n";
            echo "<td class='tableau3'>" . $value . "</td>\n";
            echo "<td class='tableau3'>" . $position[$key] . "</td>\n";
            if (isset($position3[$key])) {
                echo "<td class='tableau3'>" . $position3[$key] . "</td>\n";
            } else {
                echo "<td class='tableau3'>-</td>\n";
            }
            if (isset($position4[$key])) {
                echo "<td class='tableau3'>" . $position4[$key] . "</td>\n";
            } else {
                echo "<td class='tableau3'>-</td>\n";
            }
            if (isset($position5[$key])) {
                echo "<td class='tableau5'>" . $position5[$key] . "</td>\n";
            } else {
                echo "<td class='tableau5'>-</td></tr>\n";
            }
        } else {
            echo "<tr><td class='tableau30g'>&nbsp;&nbsp;&nbsp;&nbsp;" . $key . "</td>\n";
            echo "<td class='tableau30'>" . $value . "</td>\n";
            echo "<td class='tableau30'>" . $position[$key] . "</td>\n";
            if (isset($position3[$key])) {
                echo "<td class='tableau30'>" . $position3[$key] . "</td>\n";
            } else {
                echo "<td class='tableau30'>-</td>\n";
            }
            if (isset($position4[$key])) {
                echo "<td class='tableau30'>" . $position4[$key] . "</td>\n";
            } else {
                echo "<td class='tableau30'>-</td>\n";
            }
            if (isset($position5[$key])) {
                echo "<td class='tableau50'>" . $position5[$key] . "</td></tr>\n";
            } else {
                echo "<td class='tableau50'>-</td></tr>\n";
            }
        }
        $comptligne ++;
    }
    echo "</table><br>\n";
}

echo "<h2>" . $language['entry-page'] . "</h2><br>";

echo "<div width='70%' align='center'><form action=\"index.php" . $varPostFormIncludePageWithRedirection . "\" method=\"POST\"  style=\" font-size:13px; font-weight:bold; color: #003399;
		font-family: Verdana,Geneva, Arial, Helvetica, Sans-Serif; \">\n";
echo "<input type=\"hidden\" name ='navig' value=\"16\">\n";
echo "<input type=\"hidden\" name ='site' value=\"" . $site . "\">\n";
echo "<input type=\"hidden\" name ='period' value=\"" . $period . "\">\n";
echo "<input type=\"hidden\" name ='graphpos' value=\"" . $graphpos . "\">\n";
echo "<input type=\"hidden\" name ='crawler' value=\"" . $crawler . "\">\n";
echo "<input type=\"hidden\" name ='choosekeyword' value=\"1\">\n";
echo "<table>";
if ($aolkeyword == 1) {
    echo "<tr><td>" . $language['aol'] . "</td><td><input type=\"checkbox\" name=\"aolkeyword\" value=\"1\" checked></td>\n";
} else {
    echo "<tr><td>" . $language['aol'] . "</td><td><input type=\"checkbox\" name=\"aolkeyword\" value=\"1\"></td>\n";
}
if ($askkeyword == 1) {
    echo "<td>&nbsp;&nbsp;&nbsp;" . $language['ask'] . "</td><td><input type=\"checkbox\" name=\"askkeyword\" value=\"1\" checked></td>\n";
} else {
    echo "<td>&nbsp;&nbsp;&nbsp;" . $language['ask'] . "</td><td><input type=\"checkbox\" name=\"askkeyword\" value=\"1\"></td>\n";
}
if ($baidukeyword == 1) {
    echo "<td>&nbsp;&nbsp;&nbsp;" . $language['baidu'] . "</td><td><input type=\"checkbox\" name=\"baidukeyword\" value=\"1\" checked></td>\n";
} else {
    echo "<td>&nbsp;&nbsp;&nbsp;" . $language['baidu'] . "</td><td><input type=\"checkbox\" name=\"baidukeyword\" value=\"1\"></td>\n";
}
if ($msnkeyword == 1) {
    echo "<td>&nbsp;&nbsp;&nbsp;" . $language['msn'] . "</td><td><input type=\"checkbox\" name=\"msnkeyword\" value=\"1\" checked></td>\n";
} else {
    echo "<td>&nbsp;&nbsp;&nbsp;" . $language['msn'] . "</td><td><input type=\"checkbox\" name=\"msnkeyword\" value=\"1\"></td>\n";
}
if ($googlekeyword == 1) {
    echo "<td>&nbsp;&nbsp;&nbsp;" . $language['google'] . "</td><td><input type=\"checkbox\" name=\"googlekeyword\" value=\"1\" checked></td>\n";
} else {
    echo "<td>&nbsp;&nbsp;&nbsp;" . $language['google'] . "</td><td><input type=\"checkbox\" name=\"googlekeyword\" value=\"1\"></td>\n";
}
if ($googleimagekeyword == 1) {
    echo "<td>&nbsp;&nbsp;&nbsp;" . $language['googleimage'] . "</td><td><input type=\"checkbox\" name=\"googleimagekeyword\" value=\"1\" checked></td>\n";
} else {
    echo "<td>&nbsp;&nbsp;&nbsp;" . $language['googleimage'] . "</td><td><input type=\"checkbox\" name=\"googleimagekeyword\" value=\"1\"></td>\n";
}
if ($yahookeyword == 1) {
    echo "<td>&nbsp;&nbsp;&nbsp;" . $language['yahoo'] . "</td><td><input type=\"checkbox\" name=\"yahookeyword\" value=\"1\" checked></td>\n";
} else {
    echo "<td>&nbsp;&nbsp;&nbsp;" . $language['yahoo'] . "</td><td><input type=\"checkbox\" name=\"yahookeyword\" value=\"1\"></td>\n";
}
if ($yandexkeyword == 1) {
    echo "<td>&nbsp;&nbsp;&nbsp;" . $language['yandex'] . "</td><td><input type=\"checkbox\" name=\"yandexkeyword\" value=\"1\" checked></td>\n";
} else {
    echo "<td>&nbsp;&nbsp;&nbsp;" . $language['yandex'] . "</td><td><input type=\"checkbox\" name=\"yandexkeyword\" value=\"1\"></td>\n";
}
echo "<td>&nbsp;&nbsp;&nbsp;<input name='ok' type='submit'  value=' OK ' size='20' ></td></tr>\n";

echo "</table></div><br>\n";
if (count($visitkeyword) >= 1) {
    
    echo "<table   cellpadding='0px' cellspacing='0' width='100%'>\n";
    echo "<tr><th class='tableau1' colspan=\"2\" rowspan=\"2\">\n";
    echo "" . $language['entry-page'] . "\n";
    echo "</th>\n";
    echo "<th class='tableau2'colspan=\"8\">\n";
    echo "" . $language['nbr_tot_visit_seo'] . "\n";
    echo "</th></tr>\n";
    echo "<tr>\n";
    echo "<th class='tableau20'>\n";
    echo "" . $language['aol'] . "\n";
    echo "</th>\n";
    echo "<th class='tableau20'>\n";
    echo "" . $language['ask'] . "\n";
    echo "</th>\n";
    echo "<th class='tableau20'>\n";
    echo "" . $language['baidu'] . "\n";
    echo "</th>\n";
    echo "<th class='tableau20'>\n";
    echo "" . $language['msn'] . "\n";
    echo "</th>\n";
    echo "<th class='tableau20'>\n";
    echo "" . $language['google'] . "\n";
    echo "</th>\n";
    echo "<th class='tableau20'>\n";
    echo "" . $language['googleimage'] . "\n";
    echo "</th>\n";
    echo "<th class='tableau20'>\n";
    echo "" . $language['yahoo'] . "\n";
    echo "</th>\n";
    echo "<th class='tableau200'>\n";
    echo "" . $language['yandex'] . "\n";
    echo "</th>\n";
    echo "</tr>\n";
    // counter for alternate color lane
    $comptligne = 2;
    // counter to limite number of datas displayed
    $comptdata = 0;
    foreach ($visitkeyword as $keyword => $value) {
        $crawlencode = urlencode($keyword);
        $keyworddisplay = stripslashes(crawltcutkeyword($keyword, 60));
        if (isset($visitkeywordask[$keyword])) {
            $visitask = $visitkeywordask[$keyword];
        } else {
            $visitask = '-';
        }
        if (isset($visitkeywordgoogle[$keyword])) {
            $visitgoogle = $visitkeywordgoogle[$keyword];
        } else {
            $visitgoogle = '-';
        }
        if (isset($visitkeywordgoogleimage[$keyword])) {
            $visitgoogleimage = $visitkeywordgoogleimage[$keyword];
        } else {
            $visitgoogleimage = '-';
        }
        if (isset($visitkeywordMSN[$keyword])) {
            $visitmsn = $visitkeywordMSN[$keyword];
        } else {
            $visitmsn = '-';
        }
        if (isset($visitkeywordYahoo[$keyword])) {
            $visityahoo = $visitkeywordYahoo[$keyword];
        } else {
            $visityahoo = '-';
        }
        if (isset($visitkeywordexalead[$keyword])) {
            $visitexalead = $visitkeywordexalead[$keyword];
        } else {
            $visitexalead = '-';
        }
        if (isset($visitkeywordyandex[$keyword])) {
            $visityandex = $visitkeywordyandex[$keyword];
        } else {
            $visityandex = '-';
        }
        if (isset($visitkeywordaol[$keyword])) {
            $visitaol = $visitkeywordaol[$keyword];
        } else {
            $visitaol = '-';
        }
        // to avoid problem if the url is enter in the database with http://
        if (! preg_match('#^http://#i', $urlsite[$site])) {
            $urlpage = "http://" . $urlsite[$site] . $keyword;
        } else {
            $urlpage = $urlsite[$site] . $keyword;
        }
        if ($comptligne % 2 == 0) {
            echo "<tr><td class='tableau3g'";
            if ($keywordcut == 1) {
                echo "onmouseover=\"javascript:montre('smenu" . ($comptligne + 9) . "');\"   onmouseout=\"javascript:montre();\"";
            }
            echo ">&nbsp;&nbsp;<a href='index.php?" . $varGetIncludePageWithRedirection . "navig=14&amp;period=" . $period . "&amp;site=" . $site . "&amp;crawler=" . $crawlencode . "&amp;graphpos=" . $graphpos . "' >" . $keyworddisplay . "</a></td>\n";
            echo "<td class='tableau6' width=\"8%\">\n";
            echo "<a href='" . $urlpage . "'><img src=\"" . $pathFromRootToCrawltrackImages . "images/page.png\" width=\"16\" height=\"16\" border=\"0\" ></a>\n";
            echo "</td> \n";
            echo "<td class='tableau3' width=\"6%\">" . numbdisp($visitaol) . "</td>\n";
            echo "<td class='tableau3' width=\"6%\">" . numbdisp($visitask) . "</td>\n";
            echo "<td class='tableau3' width=\"7%\">" . numbdisp($visitexalead) . "</td>\n";
            echo "<td class='tableau3' width=\"6%\">" . numbdisp($visitmsn) . "</td>\n";
            echo "<td class='tableau3' width=\"7%\">" . numbdisp($visitgoogle) . "</td>\n";
            echo "<td class='tableau3' width=\"14%\">" . numbdisp($visitgoogleimage) . "</td>\n";
            echo "<td class='tableau3' width=\"7%\">" . numbdisp($visityahoo) . "</td>\n";
            echo "<td class='tableau5' width=\"7%\">" . numbdisp($visityandex) . "</td></tr>\n";
        } else {
            echo "<tr><td class='tableau30g'";
            if ($keywordcut == 1) {
                echo "onmouseover=\"javascript:montre('smenu" . ($comptligne + 9) . "');\"   onmouseout=\"javascript:montre();\"";
            }
            echo ">&nbsp;&nbsp;<a href='index.php?" . $varGetIncludePageWithRedirection . "navig=14&amp;period=" . $period . "&amp;site=" . $site . "&amp;crawler=" . $crawlencode . "&amp;graphpos=" . $graphpos . "'  >" . $keyworddisplay . "</a></td>\n";
            echo "<td class='tableau60' width=\"8%\">\n";
            echo "<a href='" . $urlpage . "'><img src=\"" . $pathFromRootToCrawltrackImages . "images/page.png\" width=\"16\" height=\"16\" border=\"0\" ></a>\n";
            echo "</td> \n";
            echo "<td class='tableau30' width=\"6%\">" . numbdisp($visitaol) . "</td>\n";
            echo "<td class='tableau30' width=\"6%\">" . numbdisp($visitask) . "</td>\n";
            echo "<td class='tableau30' width=\"7%\">" . numbdisp($visitexalead) . "</td>\n";
            echo "<td class='tableau30' width=\"6%\">" . numbdisp($visitmsn) . "</td>\n";
            echo "<td class='tableau30' width=\"7%\">" . numbdisp($visitgoogle) . "</td>\n";
            echo "<td class='tableau30' width=\"14%\">" . numbdisp($visitgoogleimage) . "</td>\n";
            echo "<td class='tableau30' width=\"7%\">" . numbdisp($visityahoo) . "</td>\n";
            echo "<td class='tableau50' width=\"7%\">" . numbdisp($visityandex) . "</td></tr>\n";
        }
        if ($keywordcut == 1) {
            if ($period == 0 || $period >= 1000) {
                $step = 25;
            } else {
                $step = 30;
            }
            echo "<div id=\"smenu" . ($comptligne + 9) . "\"  style=\"display:none; font-size:14px; font-weight:bold; color:#ff0000; font-family:Verdana,Geneva, Arial, Helvetica, Sans-Serif; text-align:left; border:2px solid navy; position:absolute; top:" . (270 + (($comptligne - 3) * $step)) . "px; left:20px; background:#fff;\">\n";
            echo "&nbsp;" . stripslashes(htmlentities(utf8_decode(urldecode($keyword)))) . "&nbsp;\n";
            echo "</div>\n";
        }
        $comptligne ++;
        if ($displayall == 'no') {
            $comptdata ++;
        }
    }
    echo "</table>\n";
    if (count($visitkeyword) >= $rowdisplay && $displayall == 'no') {
        echo "<h2><span class=\"smalltext\">\n";
        printf($language['100_lines'], $rowdisplay);
        echo "<br>\n";
        $crawlencode = urlencode($crawler);
        echo "<a href=\"index.php?" . $varGetIncludePageWithRedirection . "navig=$navig&period=$period&site=$site&crawler=$crawlencode&order=$order&displayall=yes&graphpos=$graphpos\">" . $language['show_all'] . "</a></span></h2>";
    }
    echo "<br><br><br><br><br>\n";
} else {
    echo "<h1>" . $language['no_visit'] . "</h1>\n";
    echo "<br><br><br><br><br>\n";
}
cadreAlignCentrerFin();
