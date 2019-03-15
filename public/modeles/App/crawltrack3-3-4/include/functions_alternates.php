<?php

// Function to remove http(s) at beginning of URLs
if (! function_exists('strip_protocol')) {

    function strip_protocol($url = '')
    {
        return preg_replace("/^https?:\/\/(.+)$/i", "\\1", $url);
    }
}

// mysql escape function
if (! function_exists("crawlt_sql_quote")) {

    function crawlt_sql_quote($value)
    {
        $temp_link = mysqli_connect(BD_CRAWLTRACK_ADRESSE, BD_CRAWLTRACK_USER, BD_CRAWLTRACK_PASS, BD_CRAWLTRACK_NOM);
        if (get_magic_quotes_gpc()) {
            $value = stripslashes($value);
        }
        // check if this function exists
        if (function_exists("mysqli_real_escape_string")) {
            $value = mysqli_real_escape_string($temp_link, $value);
            ;
        }         // for PHP version < 4.3.0 use addslashes
        else {
            $value = addslashes($value);
        }
        mysqli_close($temp_link);
        return $value;
    }
}
// function url treatment (base on phpMyVisites processParams function)
if (! function_exists("crawlturltreatment")) {

    function crawlturltreatment($url)
    {
        global $crawltlistsessionid, $crawltsessionid, $crawltincludeparameter;
        if ($crawltsessionid == 0 && $crawltincludeparameter == 1) {
            $toReturn = $url;
        } elseif ($crawltincludeparameter == 0) {
            $explodeurl = explode("?", $url);
            $toReturn = $explodeurl[0];
        } else {
            $url2 = ltrim($url, "/");
            $urltreated = 0;
            $parseurl = parse_url('http://site.com/' . $url2);
            if (isset($parseurl['query'])) {
                $chaine = $parseurl['query'];
                if (strpos($chaine, '&amp;')) {
                    $queryEx = explode('&amp;', $chaine);
                    $separator = '&amp;';
                } else {
                    $queryEx = explode('&', $chaine);
                    $separator = '&';
                }
                $return = $parseurl['path'] . '?';
                foreach ($queryEx as $value) {
                    $varAndValue = explode('=', $value);
                    // include only parameters
                    if (sizeof($varAndValue) >= 2 && in_array($varAndValue[0], $crawltlistsessionid)) {
                        $urltreated = 1;
                    } elseif (sizeof($varAndValue) >= 2) {
                        $return .= $varAndValue[0] . "=";
                        for ($i = 1; $i < sizeof($varAndValue); $i ++) {
                            $return .= $varAndValue[$i] . "=";
                        }
                        $return = rtrim($return, "=") . $separator;
                    }
                }
                if (substr($return, strlen($return) - strlen($separator)) == $separator && $urltreated == 1) {
                    $toReturn = substr($return, 0, strlen($return) - strlen($separator));
                } elseif (substr($return, strlen($return) - 1) == '?' && $urltreated == 1) {
                    $toReturn = substr($return, 0, strlen($return) - 1);
                } elseif ($urltreated == 0) {
                    $toReturn = $url;
                }
            } else {
                $toReturn = $url;
            }
        }
        return $toReturn;
    }
}
// function browser identification
if (! function_exists("crawltbrowserid")) {

    function crawltbrowserid($ua)
    {
        if (preg_match("/MSIE 7/i", $ua)) {
            $browser = 5;
        } elseif (preg_match("/Firefox/i", $ua)) {
            $browser = 2;
        } elseif (preg_match("/MSIE 6/i", $ua)) {
            $browser = 4;
        } elseif (preg_match("/MSIE 8/i", $ua)) {
            $browser = 6;
        } elseif (preg_match("/MSIE 9/i", $ua)) {
            $browser = 24;
        } elseif (preg_match("/MSIE 5/i", $ua)) {
            $browser = 3;
        } elseif (preg_match("/Opera Mini/i", $ua)) {
            $browser = 22;
        } elseif (preg_match("/Opera/i", $ua)) {
            $browser = 9;
        } elseif (preg_match("/Chrome/i", $ua)) {
            $browser = 1;
        } elseif (preg_match("/Nokia/i", $ua)) {
            $browser = 21;
        } elseif (preg_match("/iPad/i", $ua)) {
            $browser = 23;
        } elseif (preg_match("/iPod/i", $ua)) {
            $browser = 19;
        } elseif (preg_match("/iPhone/i", $ua)) {
            $browser = 18;
        } elseif (preg_match("/Android/i", $ua)) {
            $browser = 20;
        } elseif (preg_match("/Safari/i", $ua)) {
            $browser = 10;
        } elseif (preg_match("/MSIE 4/i", $ua)) {
            $browser = 7;
        } elseif (preg_match("/PlayStation Portable/i", $ua)) {
            $browser = 8;
        } elseif (preg_match("/OmniWeb/i", $ua)) {
            $browser = 11;
        } elseif (preg_match("/BrowseX/i", $ua)) {
            $browser = 12;
        } elseif (preg_match("/MultiZilla/i", $ua)) {
            $browser = 13;
        } elseif (preg_match("/SeaMonkey/i", $ua)) {
            $browser = 14;
        } elseif (preg_match("/K-meleon/i", $ua)) {
            $browser = 15;
        } elseif (preg_match("/Camino/i", $ua)) {
            $browser = 16;
        } elseif (preg_match("/Konqueror/i", $ua)) {
            $browser = 17;
        } else {
            $browser = 0;
        }
        return $browser;
    }
}
