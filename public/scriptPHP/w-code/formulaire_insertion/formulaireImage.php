<?php
require "../../../variablesApplication.php";
session_start();
include SCRIPTPHPPATH . '/fichiersImages.php';
require SCRIPTPHPPATH . '/sessions.php';
// ---- repertoire a ouvrir ---------------------------------
$NomRep = SVNRADIEURAE_DIR . "upload_utilisateurs/" . $_SESSION['repertoire'] . "/images";
$NomSVN = SVNRADIEURAE_PATH . "upload_utilisateurs/" . $_SESSION['repertoire'] . "/images";

check_session_type(1);

// affichage du code html
echo "<html>";
echo "<head>";
echo "<title>Besançon 25 - La plate-Forme des artistes et des associations de Besançon - v2.00d - beta version</title>";
echo "<META HTTP-EQUIV='Content-Type' CONTENT='text/html; charset=UTF-8'>";
echo "<link type='text/css' rel='stylesheet' href='../../../besancon25.css'>";
echo "</head>";
echo "<script type='text/javascript' src='fonctions.js'></script>";
echo "<body text='#000000' bgcolor='gray' onunload='FermerFormulaireImage()'>";
// creation du tableau contenant le menu et l'horloge et accessoirement un sous tableau(voir ci-dessous)
echo "<h1>Les images disponibles <img src='../../../images/aide_B25.gif' width='20' height='20' border='0' alt='" . $NomRep . "' /> </h1>";
// creation du formulaire d'envoi
echo "<form name='ChoixImages' method='POST' action='TraitementImages.php'>";

AfficherImagesMiniatureEtSuppression($NomRep, $NomSVN);

echo "<input type='submit' value='Choisir' />";
echo "</form>";
echo "</td></tr>";
echo "<tr><td>" . "<div class='formulaire' id='formulaire'>" . "<table border='0' height='100' width='200' align='center'>" . "<tr><td>" . "<p align ='center'>" . "<form enctype='multipart/form-data' method='post' action='TraitementInsertionImages.php'>" . "<input type='hidden' name='MAX_FILE_SIZE' value='2097152'/>" . "<p class='Titre'>Image à telecharger sur le SERVEUR:</p><input type='file' name='Fichier'/><BR>(max 2Mo)" . "<input type='submit' name='btnUpload' value='Télécharger' onClick='AfficheFormTelechargement();'/>" . "</p>" . "</form>" . "</td></tr>" . "</table>" . "</div>" . "<div style='display:none' class='telechargementEnCours' id='telechargementEnCours'>" . "<table border='0' height='100' width='200' align='center'>" . "<tr><td>" . "<img name='telechargementEnCours' src='../../../images/upload.jpg' />" . "</td></tr>" . "</table>" . "</div>";

echo "</td></tr></table></body></html>";

function AfficherImagesMiniatureEtSuppression($repertoire, $nomSVN)
{
    // ---- tableau contenant le nom des fichiers ---------------
    $TabFichierImages = array();
    $TabFichierInconnus = array();
    $TabTousFichiers = array();
    
    // --- ouverture du répertoire courant-----------------------
    $Rep = @opendir($repertoire);
    if (! $Rep)
        exit("Erreur dans l'ouverture du r&eacute;pertoire");
        // --- boucle de lecture ------------------------------------
    while (false !== ($Fichier = @readdir($Rep))) {
        // on evite d'afficher le repertoire courant et le repertoire précédent
        if ($Fichier == '.' || $Fichier == '..')
            continue;
        array_push($TabTousFichiers, $Fichier);
    }
    // --- fermeture du répertoire courant----------------------
    @closeDir($Rep);
    
    // --- Tri des fichiers et des dossiers du repertoire courant
    foreach ($TabTousFichiers as $Fichier) {
        // on utilise pas de repertoires ici
        if (! is_dir($repertoire . '/' . $Fichier)) {
            // on met les fichiers trouvés dans leurs tableaux respectifs
            $Fexp = explode(".", $Fichier);
            if ($Fexp[1] == "jpg" || $Fexp[1] == "JPG" || $Fexp[1] == "gif" || $Fexp[1] == "GIF" || $Fexp[1] == "png" || $Fexp[1] == "PNG") {
                array_push($TabFichierImages, $Fichier);
            } else {
                array_push($TabFichierInconnus, $Fichier);
            }
        }
    }
    /**
     * *******************************************************
     */
    // --- Affichage des FICHIERS trouvés ----------------------
    // Creation de deux tableaux contenant les miniatures et les fichiers correspondant pour une verification iterative de leurs existence duale
    $TabImagesRepCourant = array();
    $TabMiniRepCourant = array();
    // tri des fichiers images
    foreach ($TabFichierImages as $Fichier) {
        $Fexp = explode("_", $Fichier);
        if ($Fexp[0] == "&MINI") {
            array_push($TabMiniRepCourant, $Fexp[1]);
        } else {
            array_push($TabImagesRepCourant, $Fexp[0]);
        }
    }
    echo "<table border='0'>";
    for ($i = 0; $i < sizeof($TabImagesRepCourant); $i ++) {
        // recherche itérative de la miniature correspondante a l'image que l'on est en train de regarder.
        $existe = - 1;
        $Fexp = explode(".", $TabImagesRepCourant[$i]);
        for ($j = 0; $j < sizeof($TabMiniRepCourant); $j ++) {
            $Mexp = explode(".", $TabMiniRepCourant[$j]);
            if ($Fexp[0] == $Mexp[0]) {
                // -------DRAPEAU D'EXISTENCE-------------------------
                $existe = $j;
                break;
            }
        }
        // si la miniature n'as pas été trouvée au bout de l'itération
        if ($existe == - 1) {
            // on la créé
            CreerMiniature($repertoire . "/" . $TabImagesRepCourant[$i], $repertoire, $Fexp[0], 100, "&MINI_");
            array_push($TabMiniRepCourant, $Fexp[0] . ".jpg");
            $existe = sizeof($TabMiniRepCourant) - 1;
        }
        
        // Affichage sous forme de tableau
        if ($i % 3 == 0) {
            echo "<tr>";
            $drapeau = false;
        }
        echo "<td>";
        $ImgBalise = getImageSize($repertoire . "/&MINI_" . $TabMiniRepCourant[$existe]);
        echo "<input type='radio' name='imageChoisie' value='http://" . $nomSVN . "/" . $TabImagesRepCourant[$i] . "'";
        if ($i == 0)
            echo "checked='checked'";
        echo " />";
        echo "</td><td>";
        echo "<a href='" . $nomSVN . "/" . $TabImagesRepCourant[$i] . "'>" . "<IMG NAME='Apercu du fichier: " . $TabImagesRepCourant[$i] . "' SRC='" . $nomSVN . "/&MINI_" . $TabMiniRepCourant[$existe] . "' " . $ImgBalise[2] . " BORDER='0'>" . "</a>";
        echo "</td><td>";
        // formulaire de suppression
        echo "<a href='TraitementSuppressionImages.php?imageChoisie=" . $repertoire . "/" . $TabImagesRepCourant[$i] . "&ApercuimageChoisie=" . $repertoire . "/" . $TabMiniRepCourant[$i] . "' ><img src='../../../images/btn_supprimerImages.jpg' width='20' height='100' border='0' /></a>";
        /*
         * echo "<form name='SuppressionImages' method='POST' action='TraitementSuppressionImages.php'>";
         * echo "<input type='hidden' name='imageChoisie' value='".$repertoire."/".$TabImagesRepCourant[$i]."' />";
         * echo "<input type='hidden' name='ApercuimageChoisie' value='".$repertoire."/&MINI_".$TabMiniRepCourant[$i]."' />";
         * echo "<input type='image' src='../../../images/btn_supprimerImages.jpg' width='20' height='100' border='0' />";
         * echo "</form>";
         */
        // fin formulaire
        echo "</td>";
        if ($i % 3 == 2) {
            echo "</tr>";
            $drapeau = true;
        }
    }
    if ($drapeau == false)
        echo "</tr>";
    echo "</table>";
    
    return (0);
}

function CreerMiniature($Source, $Destination, $Lib, $Haut, $LibMini)
{
    $Tab = getimagesize($Source);
    $SrcLarge = $Tab[0];
    $SrcHaut = $Tab[1];
    // echo $Tab[2];
    
    if ($Tab[2] == 1) {
        $Src = imagecreatefromGIF($Source);
    } elseif ($Tab[2] == 2) {
        $Src = imagecreatefromJPEG($Source);
    } elseif ($Tab[2] == 3) {
        $Src = imagecreatefromPNG($Source);
    } else {
        exit('Format non supporté');
    }
    
    // ----------------------------------------------------------
    // Allocation de l'image destination
    $DestHaut = $Haut;
    $DestLarge = $SrcLarge * ($Haut / $SrcHaut);
    $ImgDest = imagecreatetruecolor($DestLarge, $DestHaut);
    
    // ----------------------------------------------------------
    // Copie de la source
    imagecopyresampled($ImgDest, $Src, 0, 0, 0, 0, $DestLarge, $DestHaut, $SrcLarge, $SrcHaut);
    
    // ----------------------------------------------------------
    // Ecriture de l'image sur le disque
    $DestinationMiniature = $Destination . "/" . $LibMini . $Lib . ".jpg";
    imagejpeg($ImgDest, $DestinationMiniature, 60);
    // ----------------------------------------------------------
    // Modification des droits du fichier
    chmod($DestinationMiniature, 0755);
    // ----------------------------------------------------------
    // Libération mémoire
    imagedestroy($Src);
    imagedestroy($ImgDest);
    return;
}
