<?php
require "../../../variablesApplication.php";
// on regarde la session utilisateur
session_start();
// ---- repertoire a ouvrir ---------------------------------
$NomRep = RADIEURAE_REP_PATH . "upload_utilisateurs/" . $_SESSION['repertoire'] . "/musiques";
$NomSVN = RADIEURAE_SVN_PATH . "upload_utilisateurs/" . $_SESSION['repertoire'] . "/musiques";
// affichage du code html
echo "<html>";
echo "<head>";
echo "<title>Besan&ccedil;on 25 - La plate-Forme des artistes et des associations de Besan&ccedil;on - v1.00b - beta version</title>";
echo "<link type='text/css' rel='stylesheet' href='../../../besancon25.css'>";
echo "</head>";
echo "<script type='text/javascript' src='fonctions.js'></script>";
echo "<body bgcolor='gray' text='#000000' onunload='FermerFormulaireMp3()'>";
// creation du tableau contenant le menu et l'horloge et accessoirement un sous tableau(voir ci-dessous)
echo "<h1>Les fichiers Musicaux disponibles <img src='../../../images/aide_B25.gif' width='20' height='20' border='0' alt='" . $NomRep . "' /> </h1>";
echo "<table width='490px' border='0' height='100%' >";
echo " <tr><td>";
echo "<form name='choixMp3' method='POST' action='TraitementMp3.php'>";

AfficherLesMp3Disponibles($NomRep, $NomSVN);

echo "<input type='submit' value='choisir' />";
echo "</form>";
echo "</td></tr>";
echo "<tr><td>" . "<div class='formulaire' id='formulaire'>" . "<table border='0' height='100' width='200' class='fondCouleurSecondaire' align='center'>" . "<tr><td>" . " <p>" . "</p><p align ='center'>" . "<form enctype='multipart/form-data' method='post' action='TraitementInsertionMp3.php'>" . "<input type='hidden' name='MAX_FILE_SIZE' value='2097152'>" . "<p class='Titre'>Fichier Musical � telecharger sur le SERVEUR:</p><input type='file' name='Fichier'><BR>(max 2Mo)" . "<input type='submit' name='btnUpload' value='T�l�charger' onClick='AfficheFormTelechargement();'>" . "</p>" . "</form>" . "</td></tr>" . "</table>" . "</div>" . "<div style='display:none' class='telechargementEnCours' id='telechargementEnCours'>" . "<table border='0' height='100' width='200' align='center'>" . "<tr><td>" . "<img name='telechargementEnCours' src='../../../images/upload.jpg' />" . "</td></tr>" . "</table>" . "</div>";

echo "</td></tr></table></body></html>";

function AfficherLesMp3Disponibles($NomRep, $NomSVN)
{
    
    // ---- tableau contenant le nom des fichiers ---------------
    $TabFichierMp3 = array();
    $TabFichierInconnus = array();
    $TabTousFichier = array();
    
    // --- ouverture du r�pertoire courant-----------------------
    $Rep = @opendir($NomRep);
    if (! $Rep)
        exit("Erreur dans l'ouverture du r�pertoire");
        // --- boucle de lecture ------------------------------------
    while (false !== ($Fichier = @readdir($Rep))) {
        // on evite d'afficher le repertoire courant et le repertoire pr�c�dent
        if ($Fichier == '.' || $Fichier == '..')
            continue;
        array_push($TabTousFichier, $Fichier);
    }
    // --- fermeture du r�pertoire courant----------------------
    @closeDir($Rep);
    
    // --- Tri des fichiers et des dossiers du repertoire courant
    foreach ($TabTousFichier as $Fichier) {
        // on utilise pas de repertoires ici
        if (! is_dir($NomRep . '/' . $Fichier)) {
            // on met les fichiers trouv�s dans leurs tableaux respectifs
            $Fexp = explode(".", $Fichier);
            if ($Fexp[1] == "mp3" || $Fexp[1] == "wav") {
                array_push($TabFichierMp3, $Fichier);
            } else {
                array_push($TabFichierInconnus, $Fichier);
            }
        }
    }
    /**
     * *******************************************************
     */
    // --- Affichage des FICHIERS trouv�s ----------------------
    // creation du formulaire d'envoi
    echo "<table border='0' class='fondCouleurSecondaire'>";
    for ($i = 0; $i < sizeof($TabFichierMp3); $i ++) {
        echo "<tr>";
        echo "<td>";
        
        echo "<input type='radio' name='mp3Choisi' value='" . "http://" . $NomSVN . "/" . $TabFichierMp3[$i] . "' ";
        if ($i == 0)
            echo "checked='checked' ";
        echo "/>";
        echo "</td><td>";
        echo "<a href='" . $NomSVN . "/" . $TabFichierMp3[$i] . "'>" . $TabFichierMp3[$i] . "</a>&nbsp;";
        echo "</td><td>";
        echo "<a href='TraitementSuppressionMp3.php?mp3Choisi=" . $NomRep . "/" . $TabFichierMp3[$i] . "' ><img src='../../../images/btn_supprimerMp3s.jpg' width='100' height='20' border='0' /></a>";
        // creation du formulaire de suppression
        // echo "<form name='SuppressionMp3_{$i}' method='POST' action='TraitementSuppressionMp3.php'>";
        // echo "<input type='hidden' name='mp3Choisi' value='".$NomRep."/".$TabFichierMp3[$i]."' />";
        // echo "<input type='image' src='../../../images/btn_supprimerMp3s.jpg' onClick='javascript:document.submit();' width='100' height='20' border='0' />";
        // echo "</form>";
        // -------------------------------------
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";
}
