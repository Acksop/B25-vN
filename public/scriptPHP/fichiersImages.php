<?php
if (DEV_verificationINCLUSIONS) {
    $page = explode("/", __FILE__);
    $fichier_inclus = array_pop($page);
    echo $fichier_inclus . " >>> OK!";
}

function testExtentionImages($chaine)
{
    $Fexp = explode(".", $chaine);
    if ($Fexp[1] == "jpg" || $Fexp[1] == "JPG" || $Fexp[1] == "gif" || $Fexp[1] == "GIF" || $Fexp[1] == "png" || $Fexp[1] == "PNG") {
        return true;
    } else {
        return false;
    }
    return (0);
}

function redimensionnementImage($Source, $Destination, $Largeur)
{
    $Tab = getimagesize($Source);
    $SrcLarge = $Tab[0];
    $SrcHaut = $Tab[1];
    if ($Tab[2] == 1)
        $Src = imagecreatefromGIF($Source);
    elseif ($Tab[2] == 2)
        $Src = imagecreatefromJPEG($Source);
    elseif ($Tab[2] == 3)
        $Src = imagecreatefromPNG($Source);
    else
        exit('Format non supporté');
        
        // ----------------------------------------------------------
        // Allocation de l'image destination
    $DestLarge = $Largeur;
    $DestHaut = $SrcHaut * ($Largeur / $SrcLarge);
    $ImgDest = imagecreatetruecolor($DestLarge, $DestHaut);
    
    // ----------------------------------------------------------
    // Copie de la source
    imagecopyresampled($ImgDest, $Src, 0, 0, 0, 0, $DestLarge, $DestHaut, $SrcLarge, $SrcHaut);
    
    // ----------------------------------------------------------
    // Ecriture de l'image sur le disque
    imagejpeg($ImgDest, $Destination, 60);
    
    // ----------------------------------------------------------
    // Libération mémoire
    imagedestroy($Src);
    imagedestroy($ImgDest);
    return;
}

?>
