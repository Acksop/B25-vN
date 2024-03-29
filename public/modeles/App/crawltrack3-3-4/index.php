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
// file: index.php
// ----------------------------------------------------------------------
// Last update: 25/11/2011
// ----------------------------------------------------------------------

// make sure PHP version >= 4.3.2 is used (and even this version is waaaay too old, 29-May-2003)
if (version_compare(PHP_VERSION, '4.3.2', '<'))
    exit("Sorry, CrawlTrack needs at least PHP version 4.3.2 to run ! You are running version " . PHP_VERSION . " \n");
    
    // error_reporting(1);
    
// initialize POST variable
include (dirname(__FILE__) . "/include/post.php");
// initialize array & data
$listlangcrawlt = array();
$numbquery = 0;

// function to measure the time used for the calculation
function getTime()
{
    static $timer = false, $start;
    if ($timer === false) {
        $start = array_sum(explode(' ', microtime()));
        $timer = true;
        return NULL;
    } else {
        $timer = false;
        $end = array_sum(explode(' ', microtime()));
        return round(($end - $start), 3);
    }
}
getTime();
// if already install get all the config datas
if (file_exists(dirname(__FILE__) . '/include/configconnect.php')) {
    // connection file include
    require (dirname(__FILE__) . "/include/configconnect.php");
    // initialize session 'crawlt'
    if ($navig != 7) {
        include dirname(__FILE__) . "/include/sessions.php";
    } else {
        session_start();
    }
    
    $connexion = connectionBDD_Crawltrack();
    $sqlconfig = "SELECT * FROM crawlt_config";
    $requeteconfig = faireUneRequeteOnLine_Crawltrack($sqlconfig, $connexion);
    $nbrresult = exploiterNombreLigneResultatBDD_Crawltrack($requeteconfig);
    // echo $nbrresult;
    if ($nbrresult >= 1) {
        $ligne = exploiterLigneResultatBDD_Crawltrack($requeteconfig);
        $times = $ligne['timeshift'];
        $crawltpublic = $ligne['public'];
        $crawltmail = $ligne['mail'];
        $crawltlastday = $ligne['datelastmail'];
        $crawltdest = $ligne['addressmail'];
        $crawltlang = $ligne['lang'];
        $version = $ligne['version'];
        if ($version > 160) {
            $firstdayweek = $ligne['firstdayweek'];
        }
        if ($version > 171) {
            $datecleaning = $ligne['datelastcleaning'];
        }
        if ($version > 210) {
            $rowdisplay = $ligne['rowdisplay'];
            $order = $ligne['orderdisplay'];
        } else {
            $rowdisplay = 30;
            $order = 0;
        }
        if ($version > 220) {
            $crawltmailishtml = $ligne['typemail'];
            $crawltcharset = $ligne['typecharset'];
        } else {
            $crawltmailishtml = 1;
            $crawltcharset = 1;
        }
        if ($version > 281) {
            $crawltblockattack = $ligne['blockattack'];
            $crawltsessionid = $ligne['sessionid'];
            $crawltincludeparameter = $ligne['includeparameter'];
        } else {
            $crawltblockattack = 0;
            $crawltsessionid = 0;
            $crawltincludeparameter = 1;
        }
    }
    $charset = 1;
} else {
    $charset = 0;
    $crawltcharset = 1;
}
if ($charset == 1) {
    if ($crawltcharset != 1) {
        $crawltlang = $crawltlang . "iso";
    }
}
// for the install we need to give a value to $times
if (! isset($times)) {
    $times = 0;
}
require_once (dirname(__FILE__) . "/include/listlang.php");
if ($charset == 1) {
    deconnectionBDD_Crawltrack($connexion);
}
// language file include
// echo $crawltlang;
if (file_exists(dirname(__FILE__) . "/language/" . $crawltlang . ".php") && in_array($crawltlang, $listlangcrawlt)) {
    require_once (dirname(__FILE__) . "/language/" . $crawltlang . ".php");
} else {
    exit('<h1>No language files available !!!!</h1>');
}

// echo $pathFromSiteIndexToCrawltrackIndex;
require_once (dirname(__FILE__) . "/include/functions.php");
// version id
$versionid = '332';
// do not modify
define('IN_CRAWLT', TRUE);
// if already install
if (file_exists(dirname(__FILE__) . '/include/configconnect.php') && $navig != 15) {
    
    if ($navig == 0) {
        // done !
        $main = (dirname(__FILE__) . "/include/display-dashboard.php");
    } elseif ($navig == 1) {
        $main = (dirname(__FILE__) . "/include/display-all-crawlers.php");
    } elseif ($navig == 2) {
        $main = (dirname(__FILE__) . "/include/display-one-crawler.php");
    } elseif ($navig == 3) {
        $main = (dirname(__FILE__) . "/include/display-all-pages.php");
    } elseif ($navig == 4) {
        $main = (dirname(__FILE__) . "/include/display-one-page.php");
    } elseif ($navig == 5) {
        $main = (dirname(__FILE__) . "/include/search.php");
    } elseif ($navig == 6) {
        $main = (dirname(__FILE__) . "/include/admin.php");
    } elseif ($navig == 7) {
        if ($varGetIncludePageWithRedirection != '') {
            // ces variables sont celles utilisés par Crawltrack pour garder les sessions
            //
            unset($_SESSION['flag']);
            unset($_SESSION['rightsite']);
            unset($_SESSION['cleaning']);
            unset($_SESSION['userlogin']);
            unset($_SESSION['rightadmin']);
            unset($_SESSION['rightspamreferer']);
            unset($_SESSION['clearcache']);
            // changer les lignes suivantes afin d'afficher la page d'index du site dans le MVC
            include 'modeles/index.php';
            AfficheIndex();
            exit();
        } else {
            $main = ("include/index.htm"); // to avoid notice error in Apache logs
                                           // unset($_SESSION); deprecated
            session_unset();
            session_destroy();
            session_write_close();
            header("Location:index.php");
            exit();
        }
    } elseif ($navig == 8) {
        $main = (dirname(__FILE__) . "/include/display-crawlers-info.php");
    } elseif ($navig == 10) {
        $main = (dirname(__FILE__) . "/include/updateurl.php");
    } elseif ($navig == 11) {
        $main = (dirname(__FILE__) . "/include/display-seo.php");
    } elseif ($navig == 12) {
        $main = (dirname(__FILE__) . "/include/display-keyword.php");
    } elseif ($navig == 13) {
        $main = (dirname(__FILE__) . "/include/display-entrypage.php");
    } elseif ($navig == 14) {
        $main = (dirname(__FILE__) . "/include/display-one-entrypage.php");
    }    // 15 is used for installation
    elseif ($navig == 16) {
        $main = (dirname(__FILE__) . "/include/display-one-keyword.php");
    } elseif ($navig == 17) {
        $main = (dirname(__FILE__) . "/include/display-hacking.php");
    } elseif ($navig == 18) {
        $main = (dirname(__FILE__) . "/include/display-hacking-xss.php");
    } elseif ($navig == 19) {
        $main = (dirname(__FILE__) . "/include/display-hacking-sql.php");
    } elseif ($navig == 20) {
        $main = (dirname(__FILE__) . "/include/display-visitors.php");
    } elseif ($navig == 21) {
        $main = (dirname(__FILE__) . "/include/display-pages-visitors.php");
    } elseif ($navig == 22) {
        $main = (dirname(__FILE__) . "/include/display-errors.php");
    } elseif ($navig == 23) {
        $main = (dirname(__FILE__) . "/include/display-summary.php");
    } else {
        $main = (dirname(__FILE__) . "/include/display-dashboard.php");
    }
    
    // IF NO SESSION LOGIN
    if (! isset($_SESSION['userlogin'])) {
        if ($crawltpublic == 1 && $navig != 6 && $logitself != 1) {
            // case free access to the stats
            if (! isset($_SESSION['rightsite'])) {
                // clear the cache folder at the first entry on crawltrack to avoid to have it oversized
                $dir = dir(dirname(__FILE__) . '/cache/');
                while (false !== $entry = $dir->read()) {
                    // Skip pointers
                    if ($entry == '.' || $entry == '..') {
                        continue;
                    }
                    unlink(dirname(__FILE__) . "/cache/$entry");
                }
            }
            // session start 'crawlt'
            if (! isset($_SESSION)) {
                session_name('crawlt');
                session_start();
                $_SESSION['rightsite'] = "0";
            } else {
                $_SESSION['rightsite'] = "0";
            }
            // test to see if version is up-to-date
            if (! isset($version)) {
                $version = 100;
            }
            if ($version == $versionid) {
                include (dirname(__FILE__) . "/include/nocache.php");
                // installation is up-to-date, display stats
                include (dirname(__FILE__) . "/include/header.php");
                include ("$main");
                include (dirname(__FILE__) . "/include/footer.php");
            } else {
                // update the installation
                include (dirname(__FILE__) . "/include/header.php");
                include (dirname(__FILE__) . "/include/updatecrawltrack.php");
                include (dirname(__FILE__) . "/include/footer.php");
            }
        } else {
            
            // get values
            if (isset($_POST['userlogin'])) {
                $userlogin = htmlentities($_POST['userlogin']);
            } else {
                $userlogin = '';
            }
            if (isset($_POST['userpass'])) {
                $userpass = htmlentities($_POST['userpass']);
            } else {
                $userpass = '';
            }
            // access form
            include (dirname(__FILE__) . "/include/header.php");
            echo "<div class=\"content\">\n";
            cadreAlignCentrerDebut();
            if ($crawltpublic == 1 && $logitself != 1) {
                echo "<h1>" . $language['admin_protected'] . "</h1>\n";
            } else {
                echo "<h1>" . $language['restrited_access'] . "</h1>\n";
            }
            
            if ($nocookie == 1) {
                echo "<div class=\"alert2\">" . $language['no_cookie'] . "</div>\n";
            }
            
            echo "<h2>" . $language['enter_login'] . "</h2>\n";
            echo "<div class=\"form\">\n";
            echo "<form action=\"" . $pathFromSiteIndexToCrawltrackIndex . "php/login.php\" method=\"POST\" name=\"login\" >\n";
            echo "<table align=\"left\" width=\"400px\">\n";
            echo "<tr>\n";
            echo "<td >" . $language['login'] . "&nbsp;</td><td><input class='tweet' name='userlogin' type='text' maxlength='20' size='20'/></td></tr>\n";
            echo "</td></tr>\n";
            echo "<tr><td>" . $language['password'] . "&nbsp;</td><td><input class='tweet' name='userpass'  type='password' maxlength='20' size='20'/></td</tr>\n";
            if (isset($lang)) {
                echo "<input type=\"hidden\" name ='lang' value='$lang'>\n";
            } else {
                echo "<input type=\"hidden\" name ='lang' value='$crawltlang'>\n";
            }
            echo "<input type=\"hidden\" name ='graphpos' value=\"$graphpos\">\n";
            echo "<input type=\"hidden\" name ='navig' value=\"$navig\">\n";
            echo "<input type=\"hidden\" name ='period' value=\"$period\">\n";
            echo "<input type=\"hidden\" name ='site' value=\"$site\">\n";
            echo "<input type=\"hidden\" name ='validform' value=\"$validform\">\n";
            echo "<input type=\"hidden\" name ='displayall' value=\"$displayall\">\n";
            echo "<input type=\"hidden\" name ='logitself' value=\"$logitself\">\n";
            echo "<tr><td colspan='2' style='text-align:right;'><input  class='btn_modif' name='ok' type='submit'  value='OK' size='20'></td></tr>\n";
            echo "</table></form>\n";
            echo "<script type=\"text/javascript\"> document.forms[\"login\"].elements[\"userlogin\"].focus()</script>\n";
            echo "<br><br><br><br><br>\n";
            cadreAlignCentrerFin();
            include (dirname(__FILE__) . "/include/footer.php");
        }
    } else {
        // check token
        // Thanks to François Lasselin (http://blog.nalis.fr/index.php?post/2009/09/28/Securisation-stateless-PHP-avec-un-jeton-de-session-%28token%29-protection-CSRF-en-PHP)
        $validity_time = 1800;
        $token_clair = $secret_key . $_SERVER['HTTP_HOST'] . $_SERVER['HTTP_USER_AGENT'];
        $token = hash('sha256', $token_clair . $_COOKIE["session_informations"]);
        
        // echo $main;
        
        if (strcmp($_COOKIE["session_token"], $token) == 0) {
            list ($date, $user) = preg_split('[-]', $_COOKIE["session_informations"]);
            if ($date + $validity_time > time() and $date <= time()) {
                // test to see if version is up-to-date
                if (! isset($version)) {
                    $version = 100;
                }
                if ($version == $versionid) {
                    include (dirname(__FILE__) . "/include/nocache.php");
                    // installation is up-to-date, display stats
                    include (dirname(__FILE__) . "/include/header.php");
                    include ("$main");
                    include (dirname(__FILE__) . "/include/footer.php");
                } else {
                    // update the installation
                    include (dirname(__FILE__) . "/include/header.php");
                    include (dirname(__FILE__) . "/include/updatecrawltrack.php");
                    include (dirname(__FILE__) . "/include/footer.php");
                }
            } else {
                unset($_SESSION['userlogin']);
                $crawlencode = urlencode($crawler);
                header("Location: index.php?{$varGetIncludePageWithRedirection}navig=$navig&period=$period&site=$site&crawler=$crawlencode&graphpos=$graphpos&displayall=$displayall");
                exit();
            }
        } else {
            unset($_SESSION['userlogin']);
            $crawlencode = urlencode($crawler);
            header("Location: index.php?{$varGetIncludePageWithRedirection}navig=$navig&period=$period&site=$site&crawler=$crawlencode&graphpos=$graphpos&displayall=$displayall");
            exit();
        }
    }
} else {
    // display install
    $navig = 15;
    include (dirname(__FILE__) . "/include/header.php");
    include (dirname(__FILE__) . "/include/install.php");
    include (dirname(__FILE__) . "/include/footer.php");
}

if ($navig == 0 || $navig == 1 || $navig == 2 || $navig == 3 || $navig == 4 || $navig == 8 || $navig == 11 || $navig == 12 || $navig == 13 || $navig == 14 || $navig == 16 || $navig == 17 || $navig == 18 || $navig == 19 || $navig == 20 || $navig == 21 || $navig == 22 || $navig == 23) {
    // close the cache function
    close();
    if ($varGetIncludePageWithRedirection != '') {
        if ($navig != 1 && $navig != 3 && $navig != 2 && $navig != 8 && $navig != 11)
            echo "</div>";
    }
} else {
    echo "<br /><br /><br />";
    cadreAlignCentrerDebut();
    echo "<span style='float:right;'>" . $numbquery . " requete(s) MySQL g&eacute;n&eacute;r&eacute;es par PHP en " . getTime() . " secondes.</span>";
    cadreAlignCentrerFin();
    if ($navig == 6 && $varGetIncludePageWithRedirection != '')
        echo "</div>";
}
