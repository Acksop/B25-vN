<?php
if (DEV_verificationINCLUSIONS) {
    $page = explode("/", __FILE__);
    $fichier_inclus = array_pop($page);
    echo $fichier_inclus . " >>> OK!";
}

if (! function_exists('ajouterZero')) {

    function ajouterZero($nb)
    {
        if ($nb < 10) {
            return '0' . $nb;
        }
        return $nb;
    }
}

function choixVersion($version)
{
    setcookie('versionIHM', $version, time() + 3600 * 24 * 365, '/', '');
    return (0);
}

function choixCouleur($couleur)
{
    setcookie('couleurIHM', $couleur, time() + 3600 * 24 * 365, '/', '');
    return (0);
}

function choixBandeauAnim($fond)
{
    setcookie('bandeauAnim', $fond, time() + 3600 * 24 * 365, '/', '');
    return (0);
}

function choixInterface($interface)
{
    setcookie('interfaceIHM', $interface, time() + 3600 * 24 * 365, '/', '');
    return (0);
}

function choixGlyph($glyph)
{
    setcookie('typographie', $glyph, time() + 3600 * 24 * 365, '/', '');
    return (0);
}

function choixTailleLecture($taille)
{
    setcookie('tailleLecture', $taille, time() + 3600 * 24 * 365, '/', '');
    return (0);
}

function CheckPreferencesInterfaces($int)
{
    if (isset($_COOKIE['interfaceIHM'])) {
        if (recuperationCookieInterface() == $int) {
            echo " checked";
        }
    } else {
        if ($int == 3) {
            echo " checked";
        }
    }
    return;
}

function CheckPreferencesBandeauAnim($int)
{
    if (isset($_COOKIE['bandeauAnim'])) {
        if (recuperationCookieBandeauAnim() == $int) {
            echo " checked";
        }
    } else {
        if ($int == 3) {
            echo " checked";
        }
    }
    return;
}

function CheckPreferencesCouleur($int)
{
    if (isset($_COOKIE['couleurIHM'])) {
        if (recuperationCouleurInterface() == $int) {
            echo " checked";
        }
    } else {
        if ($int == 1) {
            echo " checked";
        }
    }
    return;
}

function CheckPreferencesPolices($int)
{
    if (isset($_COOKIE['typographie'])) {
        if (recuperationCookieGlyph() == $int) {
            echo " checked";
        }
    } else {
        if ($int == 0) {
            echo " checked";
        }
    }
    return;
}

function CheckPreferencesCaracteres($int)
{
    if (isset($_COOKIE['tailleLecture'])) {
        if (recuperationCookieTailleLecture() == $int) {
            echo " checked";
        }
    } else {
        if ($int == 3) {
            echo " checked";
        }
    }
    return;
}

function CheckPreferencesVersion($int)
{
    if (isset($_COOKIE['versionIHM'])) {
        if (recuperationVersionInterface() == $int) {
            echo " checked";
        }
    } else {
        if ($int == 1) {
            echo " checked";
        }
    }
    return;
}

function recuperationVersionInterface()
{
    if (isset($_COOKIE['versionIHM'])) {
        return ($_COOKIE['versionIHM']);
    } else {
        return 2;
    }
    ;
}

function recuperationCouleurInterface()
{
    if (isset($_COOKIE['couleurIHM'])) {
        return ($_COOKIE['couleurIHM']);
    } else {
        return 8;
    }
    ;
}

function recuperationCookieInterface()
{
    if (isset($_COOKIE['interfaceIHM'])) {
        return ($_COOKIE['interfaceIHM']);
    } else {
        return 5;
    }
    ;
}

function recuperationCookieBandeauAnim()
{
    if (isset($_COOKIE['bandeauAnim'])) {
        return ($_COOKIE['bandeauAnim']);
    } else {
        return 0;
    }
    ;
}

function recuperationCookieGlyph()
{
    if (isset($_COOKIE['typographie'])) {
        return ($_COOKIE['typographie']);
    } else {
        return 1;
    }
    ;
}

function recuperationCookieTailleLecture()
{
    if (isset($_COOKIE['tailleLecture'])) {
        return ($_COOKIE['tailleLecture']);
    } else {
        return 3;
    }
    ;
}

?>
