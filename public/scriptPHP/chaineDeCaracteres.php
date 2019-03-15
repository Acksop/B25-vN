<?php
if (DEV_verificationINCLUSIONS) {
    $page = explode("/", __FILE__);
    $fichier_inclus = array_pop($page);
    echo $fichier_inclus . " >>> OK!";
}

include_once dirname(__FILE__) . '/directives_B4NG.php';

function normalise_ChaineDeCaracteresDownload($chaine)
{
    // $chaine = filter_var($chaine, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    return remplacerAccents($chaine);
    // return $chaine;
}

// ---- Fonction permettant de changer tout caractère accentué par son équivalent non accentué
function sansAccents($Texte) {
    $accents = array(
    				"À","Á","Â","Ã","Ä","Å","à","á","â","ã","ä","å","Ò",
                    "Ó","Ô","Õ","Ö","Ø","ò","ó","ô","õ","ö","ø","È","É",
    				"Ê","Ë","è","é","ê","ë","Ç","ç","Ì","Í","Î","Ï","ì",
                    "í","î","ï","Ù","Ú","Û","Ü","ù","ú","û","ü","ÿ","Ñ",
                    "ñ",
    				"'"," ","&");
    $noaccents = array(
                    "A","A","A","A","A","A","a","a","a","a","a","a","O",
                    "O","O","O","O","O","o","o","o","o","o","o","E","E",
                    "E","E","e","e","e","e","C","c","I","I","I","I","i",
                    "i","i","i","U","U","U","U","u","u","u","u","y","N",
                    "n",
                    "_","_","_");

    $Texte = str_replace( $accents,$noaccents,$Texte);
    return $Texte;
}

function chaineAleatoire()
{
    $base = 'abcdefghijklmnopqrstuvwxyz0123456789';
    $chaine = '';
    for ($i = 0; $i < 5; $i ++) {
        $chaine .= $base[rand(0, 35)];
    }
    return $chaine;
}

function fp_addslashes($T)
{
    if (get_magic_quotes_gpc() == 1)
        return $T;
    else
        return addslashes($T);
}

function fp_stripslashes($T)
{
    if (get_magic_quotes_gpc() == 1)
        return stripslashes($T);
    else
        return $T;
}

function check_ChaineDeCaracteresUpload($chaine)
{
    $temp_link = mysqli_connect(BD_ADRESSE, BD_USER, BD_PASS, BD_NOM);
    $chaine = fp_stripslashes($chaine);
    if (function_exists('mysqli_real_escape_string')) {
        $chaine = mysqli_real_escape_string($temp_link, $chaine);
    } elseif (function_exists('mysqli_escape_string')) {
        $chaine = mysqli_escape_string($temp_link, $chaine);
    } else {
        $chaine = normalise_ChaineDeCaracteresDownload(fp_addslashes($chaine));
    }
    mysqli_close($temp_link);
    return $chaine;
}

function check_ChaineDeCaracteresUpload_OnLine($chaine)
{
    $chaine = fp_stripslashes($chaine);
    if (function_exists('mysqli_real_escape_string')) {
        $chaine = mysql_real_escape_string($chaine);
    } elseif (function_exists('mysqli_escape_string')) {
        $chaine = mysql_escape_string($chaine);
    } else {
        $chaine = fp_addslashes($chaine);
    }
    return $chaine;
}

function check_ChaineDeCaracteresDownload($chaine)
{
    if (get_magic_quotes_gpc() == 1) {
        return stripslashes($chaine);
    } else {
        return $chaine;
    }
}

function HTML_ChaineDeCaracteres($chaine)
{
    return (htmlspecialchars($chaine, ENT_QUOTES));
}

function fp_htmlok($T)
{
    return htmlentities($T);
}

function remplacerAccents($chaine)
{
    // $chaine = encoder_UTF8($chaine);
    $chaine = str_replace('é', '&eacute;', $chaine);
    $chaine = str_replace('è', '&egrave;', $chaine);
    $chaine = str_replace('ë', '&euml;', $chaine);
    $chaine = str_replace('ê', '&ecirc;', $chaine);
    $chaine = str_replace('ç', '&ccedil;', $chaine);
    $chaine = str_replace('Ç', '&Ccedil;', $chaine);
    $chaine = str_replace('à', '&agrave;', $chaine);
    // $chaine = str_replace('','&aeacute;',$chaine);
    $chaine = str_replace('â', '&circ;', $chaine);
    $chaine = str_replace('ä', '&uml;', $chaine);
    $chaine = str_replace('î', '&icirc;', $chaine);
    $chaine = str_replace('ï', '&iuml;', $chaine);
    $chaine = str_replace('ù', '&ugrave;', $chaine);
    $chaine = str_replace('û', '&ucirc;', $chaine);
    $chaine = str_replace('ü', '&uuml;', $chaine);
    $chaine = str_replace('É', '&Eacute;', $chaine);
    $chaine = str_replace('Ê', '&Ecirc;', $chaine);
    $chaine = str_replace('È', '&Egrave;', $chaine);
    $chaine = str_replace('Ë', '&Euml;', $chaine);
    $chaine = str_replace('À', '&Agrave;', $chaine);
    // $chaine = str_replace('','&Aeacute;',$chaine);
    $chaine = str_replace('Â', '&Acirc;', $chaine);
    $chaine = str_replace('Ä', '&Auml;', $chaine);
    $chaine = str_replace('Î', '&Icirc;', $chaine);
    $chaine = str_replace('Ï', '&Iuml;', $chaine);
    $chaine = str_replace('Ù', '&Ugrave;', $chaine);
    $chaine = str_replace('Û', '&Ucirc;', $chaine);
    $chaine = str_replace('Ü', '&Uuml;', $chaine);
    return remplacerGuillemets($chaine);
}

function remplacerGuillemets($chaine)
{
    $chaine = str_replace("'", "&#39;", $chaine);
    $chaine = str_replace('"', '&#34;', $chaine);
    // return decoder_HTML_ChaineDeCaracteres($chaine);
    return $chaine;
}

function correctionAdresseInterWeb($chaine)
{
    $sousChaine = substr($chaine, 0, 7);
    if ($sousChaine == "http://") {
        return $chaine;
    } else {
        return "http://" . $chaine;
    }
}

function ajoutBaliseHREFText($chaine)
{
    // ATTENTION: fctÃ‚Â° rÃƒÂ©cursive ! Et c'est ma mimine qui la fait !
    $a = strpos($chaine, "http://", 0);
    if ($a) {
        $b = strpos($chaine, " ", $a);
        if (! $b) {
            $b = strlen($chaine);
        }
        $z = $b - $a;
        $c = substr($chaine, $a, $z);
        $d = substr($chaine, 0, $a);
        $y = strlen($chaine);
        $x = $y - $b;
        $e = substr($chaine, $b, $x);
        $w = strlen($c);
        $chaine = $d . "<a href='{$c}'>" . $c . "</a>" . ajoutBaliseHREFText($e);
        return $chaine;
    } else {
        return $chaine;
    }
}

function conversionEtOrdonancementMemoire($debut, $fin, $debut_pic, $fin_pic)
{
    $comparaison_memoire = $fin - $debut;
    $comparaison_pic = $fin_pic = $debut_pic;
    $conparaison_memoire = invertionComplexeTexteFormat($comparaison_memoire);
    $conparaison_pic = invertionComplexeTexteFormat($comparaison_pic);
    return "Zone Stable:" . lectureHumaineOctet($debut) . " / " . lectureHumaineOctet($fin) . " |  Zone instable:" . lectureHumaineOctet($debut_pic) . " / " . lectureHumaineOctet($fin_pic) . " |__|-***^^''^^***-|__|  Consommation: . " . lectureHumaineOctet($comparaison_memoire) . " / " . lectureHumaineOctet($comparaison_pic);
}

function surchargeHTML_testMemoire($text)
{
    $tab_text = explode(" |__|-***^^''^^***-|__| ", $tab_text[1]);
    return "<span style='float:left;'>" . $tab_text[0] . "</span>" . "<span style='float:right;'>" . $tab_text[1] . "</span>";
}

function testH4X0RChaine($chaine)
{
    // VERIFIER la corrélation de l'encodage des chaines en PHP/SQL
    // ainsi que la provenance de l'encodage (navigateur-butineur des ordinateurs distants)
    if (preg_match('#[\x00-\x1F\x7F-\x9F/\\\\]#', $chaine) == 1) {
        return false;
    }
    return true;
}

function destructionH4x0RChaine($chaine)
{
    // VERIFIER l'encodage des chaines en PHP/SQL et la provenance de l'encodage (butineur)
    return preg_replace('#[\x00-\x1F\x7F-\x9F/\\\\]#', '', $chaine);
}

function invertionComplexeTexteFormat($nombreAFormater)
{
    if ($nombreAFormater < 0) {
        $nombreAFormater *= - 1;
    }
    return lectureHumaineOctet($nombreAFormater);
}

function lectureHumaineOctet($combien, $itx = 0)
{
    $tab_lecture = array(
        'o',
        'Ko',
        'Mo',
        'Go',
        'To'
    );
    $combien_temp = $combien;
    $lectureSup = round($combien / 1024, 3);
    if ($lectureSup > 1000) {
        $itx ++;
        return lectureHumaineOctet($lectureSup, $itx);
    } else 
        if ($lectureSup < 0) {
            return $combien_temp . $tab_lecture[$itx];
        }
    $itx ++;
    return $lectureSup . $tab_lecture[$itx];
}

function testImageMp3Chaine($chaine)
{
    $positionMp3Chaine = strpos($chaine, "<div><object");
    $positionImageChaine = strpos($chaine, "<img");
    if ($positionMp3Chaine) {
        if ($positionImageChaine) {
            // je teste celle des deux qui est la premiÃƒÂ¨re
            if ($positionMp3Chaine < $positionImageChaine) {
                $pos = strpos($chaine, "</object></div>", $positionMp3Chaine);
                if ($pos == FALSE) {
                    return TRUE;
                } else {
                    return FALSE;
                }
            } else {
                $pos = strpos($chaine, "/>", $positionImage);
                if ($pos == FALSE) {
                    return TRUE;
                } else {
                    return FALSE;
                }
            }
        } else {
            // je teste le mp3 car c'est le seul
            $pos = strpos($chaine, "</object></div>", $positionMp3Chaine);
            if ($pos == FALSE) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
        // je teste l'image parce que le mp3 n'existe pas...
    } else 
        if ($positionImageChaine) {
            $pos = strpos($chaine, "/>", $positionImageChaine);
            if ($pos == FALSE) {
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
}

function positionFinImageMp3Chaine($chaine)
{
    $positionMp3Chaine = strpos($chaine, "<div><object");
    $positionImageChaine = strpos($chaine, "<img");
    if ($positionMp3Chaine) {
        if ($positionImageChaine) {
            // je teste celle des deux qui est la premiÃƒÂ¨re
            if ($positionMp3Chaine < $positionImageChaine) {
                $pos = strpos($chaine, "</object></div>", $positionMp3Chaine);
                return $pos + 15;
            } else {
                $pos = strpos($chaine, "/>", $positionImageChaine);
                return $pos + 2;
            }
        } else {
            // je teste le mp3 car c'est le seul
            $pos = strpos($chaine, "</object></div>", $positionMp3Chaine);
            return $pos + 15;
        }
        // je teste l'image parce que le mp3 n'existe pas...
    } else {
        $pos = strpos($chaine, "/>", $positionImageChaine);
        return $pos + 2;
    }
}

if (! function_exists('ajouterZero')) {

    function ajouterZero($int)
    {
        if ($int < 10) {
            return '0' . $int;
        }
        ;
        return $int;
    }
}

