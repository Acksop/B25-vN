<?php
global $header_title, $header_description, $header_identifier_url, $header_keywords;
$header_title = "Besançon 25 - Vos préférences d'affichage des Menus sur la Plate-forme ( Une manières de penser à plus de 88 Miles/h...)";
$header_description = "Les différents affichages du Besançon 25 ";
$header_identifier_url = "besancon25.fr/preferences";
$header_keywords = "Besan&ccedil;on, Besancon, 25000, 25, preferences, preferences, IHM, Interface Homme Machine, affichage, graphisme";

function LancerAffichageDuCorps()
{
    // fonction permettant de récupérer la version de l'interface active...
    $version = recuperationVersionInterface();
    // tableau contenant toutes les couleurs de l'interface:
    $tabCouleur = array(
        "#DC143C",
        "#FF69B4",
        "#FFA500",
        "#FFFF00",
        "#FF00FF",
        "#4B0082",
        "#008000",
        "#48D1CC",
        "#4682B4",
        "#8B4513",
        "#F08080",
        "#FFB6C1",
        "#FF6347",
        "#FFFACD",
        "#DDA0DD",
        "#7B68EE",
        "#90EE90",
        "#9ACD32",
        "#808000",
        "#556B2F",
        "#8FBC8F",
        "#66CDAA",
        "#AFEEEE",
        "#87CEFA",
        "#FFDEAD",
        "#000080"
    );
    // tableau contenant toutes les polices de caractères du site
    $tabPolices = Array(
        "Arial",
        "Comic Sans MS",
        "Verdana",
        "Helvetica",
        "Monospace",
        "Georgia",
        "Symbol",
        "Times new roman",
        "Segoe Script",
        "Impact",
        "Webdings",
        "Garuda"
    );
    $tabFonts = Array(
        "arial",
        "Comic Sans MS",
        "Verdana",
        "Helvetica",
        "Monospace",
        "Georgia",
        "Symbol, Symbol Normal",
        "Times New Roman",
        "Segoe Script",
        "Impact",
        "Webdings",
        "Garuda"
    );
    
    echo "<div class='B25-cadre-inverse' align='center'>";
    echo "<a name='IHM'></a>";
    echo "<h2 class='titre lettrine'>Mes Preferences convernant l'IHM - Interface Homme Machine</h2>" . "<form method='post' name='changementPreferences' action='controlleurs/traitementPreferences.php'>";
    
    echo "<p align='right'>Vous pouvez choisir, comment doit &ecirc;tre affich&eacute; " . "les diff&eacute;rents &eacute;l&eacute;ments du site Besan&ccedil;on25, ainsi que" . " la police et la taille des caract&egrave;res du texte.<br />&nbsp;</p>";
    
    echo "<p class='utilisateursInverse' align='right'>Changement imm&eacute;diat de la version du CSS de la navigation...</p>" . "<center>" . 
    //
    // Version Color CSS IHM
    //
    "<div class='data_preferences utilisateurs table-mobile-cell' width='33%' onClick='javascript:document.getElementById(\"version1\").checked = true;document.forms[\"changementPreferences\"].submit();'>" . "<input class='preferences-radio' id='version1' type='radio' name='versionIHM' value='1' ";
    CheckPreferencesVersion(1);
    echo "><label for='version1' onClick='javascript:'><p style='width: 148px;  height: 48px;  display: inline-block;  -webkit-mask: url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/18515/heart.svg) no-repeat 50% 50%;  mask: url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/18515/heart.svg) no-repeat 50% 50%;  -webkit-mask-size: cover;  mask-size: cover; background-color: White'>&nbsp;&nbsp;&nbsp;</p></label></input>" . "</div>" . 

    "<div class='data_preferences utilisateurs table-mobile-cell' width='33%' onClick='javascript:document.getElementById(\"version2\").checked = true;document.forms[\"changementPreferences\"].submit();'>" . "<input class='preferences-radio' id='version2' type='radio' name='versionIHM' value='2'";
    CheckPreferencesVersion(2);
    echo "><label for='version2' onClick='javascript:'><p style='width: 148px;  height: 48px;  display: inline-block;  -webkit-mask: url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/18515/heart.svg) no-repeat 50% 50%;  mask: url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/18515/heart.svg) no-repeat 50% 50%;  -webkit-mask-size: cover;  mask-size: cover; background-color: LightGrey'>&nbsp;&nbsp;&nbsp;</p></label></input>" . "</div>" . 

    "<div class='data_preferences utilisateurs table-mobile-cell' width='33%' onClick='javascript:document.getElementById(\"version3\").checked = true;document.forms[\"changementPreferences\"].submit();'>" . "<input class='preferences-radio' id='version3' type='radio' name='versionIHM' value='3'";
    CheckPreferencesVersion(3);
    echo "><label for='version3' onClick='javascript:'><p style='width: 148px;  height: 48px;  display: inline-block;  -webkit-mask: url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/18515/heart.svg) no-repeat 50% 50%;  mask: url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/18515/heart.svg) no-repeat 50% 50%;  -webkit-mask-size: cover;  mask-size: cover; background-color: Gray'>&nbsp;&nbsp;&nbsp;</p></label></input>" . "</div>" . 

    "<div class='data_preferences utilisateurs table-mobile-cell' width='33%' onClick='javascript:document.getElementById(\"version4\").checked = true;document.forms[\"changementPreferences\"].submit();'>" . "<input class='preferences-radio' id='version4' type='radio' name='versionIHM' value='4'";
    CheckPreferencesVersion(4);
    echo "><label for='version4' onClick='javascript:'><p style='width: 148px;  height: 48px;  display: inline-block;  -webkit-mask: url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/18515/heart.svg) no-repeat 50% 50%;  mask: url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/18515/heart.svg) no-repeat 50% 50%;  -webkit-mask-size: cover;  mask-size: cover; background-color: DimGray'>&nbsp;&nbsp;&nbsp;</p></label></input>" . "</div>" . 

    "</center>";
    echo "<p class='utilisateursInverse' align='right'>Changement imm&eacute;diat de l'image de menu-calme de l'interface...</p>" . "<center>" . "<div class='table-mobile'>"."<div class='table-mobile-row'><div class='data_preferences utilisateurs table-mobile-cell' width='25%' onClick='javascript:document.getElementById(\"fond0\").checked = true;' >" . "<input class='preferences-radio' id='fond0' type='radio' name='bandeauAnim' value='0' onClick='changerImageFondMenu(\"0\")' ";
    CheckPreferencesBandeauAnim(0);
    echo "><label for='fond0' onClick='changerImageFondMenu(\"0\")' ><img src='images/preferences/printemps.gif' width='110px' heigth='150px' alt='fond 1 de décoration de l'interface'/></label></input>" . "</div>" . "<div class='data_preferences utilisateurs table-mobile-cell' width='25%' onClick='javascript:document.getElementById(\"fond1\").checked = true;' >" . "<input class='preferences-radio' id='fond1' type='radio' name='bandeauAnim' value='1' onClick='changerImageFondMenu(\"1\")' ";
    CheckPreferencesBandeauAnim(1);
    echo "><label for='fond1' onClick='changerImageFondMenu(\"1\")' ><img src='images/preferences/nuages.gif' width='110px' heigth='150px' alt='fond 1 de décoration de l'interface'/></label></input>" . "</div>" . "<div class='data_preferences utilisateurs table-mobile-cell' width='25%' onClick='javascript:document.getElementById(\"fond2\").checked = true;' >" . "<input class='preferences-radio' id='fond2' type='radio' name='bandeauAnim' value='2' onClick='changerImageFondMenu(\"2\")' ";
    CheckPreferencesBandeauAnim(2);
    echo "><label for='fond2' onClick='changerImageFondMenu(\"2\")' ><img src='images/preferences/automne.gif' width='110px' heigth='150px' alt='fond 1 de décoration de l'interface'/></label></input>" . "</div>" . "<div class='data_preferences utilisateurs table-mobile-cell' width='25%' onClick='javascript:document.getElementById(\"fond3\").checked = true;' >" . "<input class='preferences-radio' id='fond3' type='radio' name='bandeauAnim' value='3' onClick='changerImageFondMenu(\"3\")' ";
    CheckPreferencesBandeauAnim(3);
    echo "><label for='fond3' onClick='changerImageFondMenu(\"3\")' ><img src='images/preferences/neige.gif' width='110px' heigth='150px' alt='fond 1 de décoration de l'interface'/></label></input>" . "</div></div><div class='data_preferences table-mobile-row'>" . "<div class='data_preferences utilisateurs table-mobile-cell' width='25%' onClick='javascript:document.getElementById(\"fond4\").checked = true;' >" . "<input class='preferences-radio' id='fond4' type='radio' name='bandeauAnim' value='4' onClick='changerImageFondMenu(\"4\")' ";
    CheckPreferencesBandeauAnim(4);
    echo "><label for='fond4' onClick='changerImageFondMenu(\"4\")' ><img src='images/preferences/brouillard.gif' width='110px' heigth='150px' alt='fond 1 de décoration de l'interface'/></label></input>" . "</div>" . "<div class='data_preferences utilisateurs table-mobile-cell' width='25%' onClick='javascript:document.getElementById(\"fond5\").checked = true;' >" . "<input class='preferences-radio' id='fond5' type='radio' name='bandeauAnim' value='5' onClick='changerImageFondMenu(\"5\")' ";
    CheckPreferencesBandeauAnim(5);
    echo "><label for='fond5' onClick='changerImageFondMenu(\"5\")' ><img src='images/preferences/fond-vent-automne.png' width='110px' heigth='150px' alt='fond 1 de décoration de l'interface'/></label></input>" . "</div>" . "<div class='data_preferences utilisateurs table-mobile-cell' width='25%' onClick='javascript:document.getElementById(\"fond6\").checked = true;' >" . "<input class='preferences-radio' id='fond6' type='radio' name='bandeauAnim' value='6' onClick='changerImageFondMenu(\"6\")' ";
    CheckPreferencesBandeauAnim(6);
    echo "><label for='fond6' onClick='changerImageFondMenu(\"6\")' ><img src='images/preferences/nuit.gif' width='110px' heigth='150px' alt='fond 1 de décoration de l'interface'/></label></input>" . "</div>" . "<div class='data_preferences utilisateurs table-mobile-cell' width='25%' onClick='javascript:document.getElementById(\"fond7\").checked = true;' >" . "<input class='preferences-radio' id='fond7' type='radio' name='bandeauAnim' value='7' onClick='changerImageFondMenu(\"7\")' ";
    CheckPreferencesBandeauAnim(7);
    echo "><label for='fond7' onClick='changerImageFondMenu(\"7\")' ><img src='images/preferences/fond-feuilles-automne.png' width='110px' heigth='150px' alt='fond 1 de décoration de l'interface'/></label></input>" . "</div></div></div>" . "</center>";
    echo "<p class='utilisateursInverse' align='right'>Changement imm&eacute;diat de la constante-couleur de l'interface...</p>" . "<center>" . 
    // couleur IHM
    "<div class='data_preferences table-mobile'>" . "<div class='data_preferences table-mobile-row'>";
    
    for ($i = 0; $i < 26; $i ++) {
        
        echo "<div class='data_preferences utilisateursInverse table-mobile-cell'>" . "<input class='preferences-radio' id='couleur" . $i . "' type='radio' name='couleurIHM' value='" . $i . "' onClick='changerCouleurFondMenu(\"" . $tabCouleur[$i] . "\")' ";
        CheckPreferencesCouleur($i);
        echo "><label for='couleur" . $i . "' onClick='changerCouleurFondMenu(\"" . $tabCouleur[$i] . "\")' ><span style='color:" . $tabCouleur[$i] . ";'>&#9632;</span></label></input>" . "</div>";
        if ($i % 9 == 8) {
            echo "</div><div class='data_preferences table-mobile-row'>";
        }
    }
    echo "</div>" . "</div>" . "</center>" . 
    
    // interface IHM
    "<p class='utilisateursInverse' align='right'>Changement imm&eacute;diat de l'interface modulaire...</p>" . "<center>" . 

    "<div class='data_preferences table-mobile'>" . "<div class='data_preferences table-mobile-row'>";
    
    for ($i = 1; $i < 4; $i ++) {
        
        echo "<div class='data_preferences utilisateursInverse table-mobile-cell' onChange='javascript: document.getElementById(\"interface" . $i . "\").checked = true;changerInterFace(\"" . ajouterZero($i) . "\",\"" . $version . "\");'>" . "<input class='preferences-radio' id='interface" . $i . "' type='radio' name='interface' value='" . $i . "' ";
        CheckPreferencesInterfaces($i);
        echo "></input><label for='interface" . $i . "'><img src='images/picto-preferences/" . ajouterZero($i) . ".png' width='60px' heigth='60px' alt='interface num&eacute;ro $i'/></label>" . "</div>";
        if ($i != 12 && $i % 3 == 0) {
            echo "</div><div class='data_preferences table-mobile-row'>";
        }
    }
    echo "</div>" . "</div>" . "</center>" . 
    
    // Polices GLYPHS
    "<p class='utilisateursInverse' align='right'>Changement imm&eacute;diat des polices typographiques de l'interface...</p>" . "<center>" . 

    "<div class='data_preferences table-mobile'>" . "<div class='data_preferences table-mobile-row'>";
    
    for ($j = 0; $j < 12; $j ++) {
        
        $i = $j + 1;
        echo "<div class='data_preferences utilisateursInverse table-mobile-cell'>" . "<input class='preferences-text' id='police" . $i . "' type='radio' name='polices' value='" . $i . "' onClick='changerTypographie(\"" . ajouterZero($i) . "\",\"" . $version . "\")' ";
        CheckPreferencesPolices($i);
        echo "><label for='police" . $i . "' onClick='changerTypographie(\"" . ajouterZero($i) . "\")'><font face='" . $tabFonts[$j] . "'>" . $tabPolices[$j] . "</font></label></input>" . "</div>";
        if ($i != 12 && $i % 3 == 0) {
            echo "</div><div class='data_preferences table-mobile-row'>";
        }
    }
    echo "</div>" . "</div>" . "</center>" . 
    
    // Tailles Polices
    "<p class='utilisateursInverse' align='right'>Changement imm&eacute;diat de la taille des polices typographiques de l'interface...</p>" . "<center>" . "<div class='data_preferences table-mobile'>" . "<div class='data_preferences table-mobile-row'>" . "<div class='data_preferences utilisateursInverse table-mobile-cell' onClick='javascript:document.getElementById(\"taillepolice1\").checked = true;changerTailleTexte(1);' >" . "<input class='preferences-taille' id='taillepolice1' type='radio' name='tailleLecture' value='1'";
    CheckPreferencesCaracteres(1);
    echo "><label for='taillepolice1'><img style='max-width:none;' src='images/picto-preferences/text08.gif' width='30px' heigth='30px' alt='Trés Petite taille'/></label></input>" . "</div><div class='data_preferences utilisateursInverse table-mobile-cell' onClick='javascript:document.getElementById(\"taillepolice2\").checked = true;changerTailleTexte(2);'>" . "<input class='preferences-taille' id='taillepolice2' type='radio' name='tailleLecture' value='2'";
    CheckPreferencesCaracteres(2);
    echo "><label for='taillepolice2'><img style='max-width:none;' src='images/picto-preferences/text10.gif' width='30px' heigth='30px' alt='Petite taille'/></label></input>" . "</div><div class='data_preferences utilisateursInverse table-mobile-cell' onClick='javascript:document.getElementById(\"taillepolice3\").checked = true; changerTailleTexte(3);'>" . "<input class='preferences-taille' id='taillepolice3' type='radio' name='tailleLecture' value='3'";
    CheckPreferencesCaracteres(3);
    echo "><label for='taillepolice3'><img style='max-width:none;' src='images/picto-preferences/text12.gif' width='30px' heigth='30px' alt='Taille Standard'/></label></input>" . "</div><div class='data_preferences utilisateursInverse table-mobile-cell'onClick='javascript:document.getElementById(\"taillepolice4\").checked = true;changerTailleTexte(4);'>" . "<input class='preferences-taille' id='taillepolice4' type='radio' name='tailleLecture' value='4' ";
    CheckPreferencesCaracteres(4);
    echo "><label for='taillepolice4'><img style='max-width:none;' src='images/picto-preferences/text14.gif' width='30px' heigth='30px' alt='Grande taille'/></label></input>" . "</div><div class='data_preferences utilisateursInverse table-mobile-cell' onClick='javascript:document.getElementById(\"taillepolice5\").checked = true;changerTailleTexte(5);'>" . "<input class='preferences-taille' id='taillepolice5' type='radio' name='tailleLecture' value='5'";
    CheckPreferencesCaracteres(5);
    echo "><label for='taillepolice5'><img style='max-width:none;' src='images/picto-preferences/text16.gif' width='30px' heigth='30px' alt='Trés Grande taille'/></label></input>" . "</div>" . "</div>" . "</div>" . 

    "<br /><br /><br />" . 

    "<left>" . "<input type='submit' class='btn_modif_preferences' witdh='500px' value=\"Choisir et enregister l'interface ? pour la retrouver plus tard ...\"/>" . "</form>" . "</left>" . 

    "</div>";
    return (0);
}
