<?php
if (DEV_verificationINCLUSIONS) {
    $page = explode("/", __FILE__);
    $fichier_inclus = array_pop($page);
    echo $fichier_inclus . " >>> OK!";
}

function cadreDossierDebut()
{
    echo "    <table border='0' align='center' cellpadding='0' cellspacing='0'>" . "<tr><td width='5px' height='5px'>" . "<img src='images/coinHGgris.png' border='0px'/>" . "</td>" . "<td width='100%' height='5px' class='gris'>" . "</td>" . "<td width='5px' height='5px'>" . "<img src='images/coinHDgris.png' border='0px'/>" . "</td></tr>" . "<tr><td width='5px' height='5px' class='gris'>" . "</td><td width='100%' border='0' height='100%' class='fondgris'>";
}

function cadreDossierFin()
{
    echo "   </td><td width='5px' height='5px' class='gris'>" . "</td></tr>" . "<tr><td width='5px' height='5px'>" . "<img src='images/coinBGgris.png' border='0px'/>" . "</td>" . "<td width='100%' height='5px' class='gris'>" . "</td>" . "<td width='5px' height='5px'>" . "<img src='images/coinBDgris.png' border='0px'/>" . "</td>" . "</tr>" . "</table>";
}

function cadreDebut()
{
    echo "    <table style='padding: 10px;' border='0' cellpadding='0' cellspacing='0'>" . "<tr><td width='5px' height='5px'>" . "<img src='images/coinHGgris.png' border='0px'/>" . "</td>" . "<td width='100%' height='5px' class='gris'>" . "</td>" . "<td width='5px' height='5px'>" . "<img src='images/coinHDgris.png' border='0px'/>" . "</td></tr>" . "<tr><td width='5px' height='100%' class='gris'>" . "</td><td style='padding: 15px;' width='100%' border='0' height='100%' class='fondgris'>";
}

function cadreFin()
{
    echo "   </td><td width='5px' height='100%' class='gris'>" . "</td></tr>" . "<tr><td width='5px' height='5px'>" . "<img src='images/coinBGgris.png' border='0px'/>" . "</td>" . "<td width='100%' height='5px' class='gris'>" . "</td>" . "<td width='5px' height='5px'>" . "<img src='images/coinBDgris.png' border='0px'/>" . "</td>" . "</tr>" . "</table>";
}

function cadreMultiplesDebut($type)
{
    switch ($type) {
        case 0:
            // avec les tableaux + bitmap
            cadreAlignCentrerDebut();
            break;
        case 1:
            // avec les tableaux + vectoriel
            cadreVectorielAlignCentrerDebut();
            break;
        case 2:
            // avec des div + dessins CSS
            cadreDIVCSSAlignCentrerDebut();
            break;
        case 3:
            // avec la propriété border-image
            cadreDIVCSSBorderImageAlignCentrerDebut();
            break;
        case 4:
            // avec :before et :after et une image en SVG
            cadreDIVBeforAfterSVGDebut();
            break;
        case 5:
            // avec :before et :after et une image en SVG
            cadreDIVBeforAfterSVGSupplementaireDebut();
            break;
    }
}

function cadreMultiplesFin($type)
{
    switch ($type) {
        case 0:
            // avec les tableaux + bitmap
            cadreAlignCentrerFin();
            break;
        case 1:
            // avec les tableaux + vectoriel
            cadreVectorielAlignCentrerFin();
            break;
        case 2:
            // avec des div + dessins CSS
            cadreDIVCSSAlignCentrerFin();
            break;
        case 3:
            // avec la propriété border-image
            cadreDIVCSSBorderImageAlignCentrerFin();
            break;
        case 4:
            // avec :before et :after et une image en SVG
            cadreDIVBeforAfterSVGFin();
            break;
        case 5:
            // avec :before et :after et une image en SVG
            cadreDIVBeforAfterSVGSupplementaireFin();
            break;
    }
}

function cadreDIVCSSAlignCentrerDebut()
{
    echo "<div class='cadre'>" . "<div class='bordH'></div>" . "<div class='contenuEnCadre'>";
    return;
}

function cadreDIVCSSAlignCentrerFin()
{
    echo "</div>" . "<div class='bordB'></div>" . "</div>";
    return;
}

function cadreDIVCSSBorderImageAlignCentrerDebut()
{
    echo "<div class='cadreImage'>";
    return;
}

function cadreDIVCSSBorderImageAlignCentrerFin()
{
    echo "</div>";
    return;
}

function cadreDIVBeforAfterSVGDebut()
{
    echo "<div class='cadreImageSVG'>";
    return;
}

function cadreDIVBeforAfterSVGFin()
{
    echo "</div>";
    return;
}

function cadreDIVBeforAfterSVGSupplementaireDebut()
{
    echo "<div class='cadreImageSupSVG'>";
    return;
}

function cadreDIVBeforAfterSVGSupplementaireFin()
{
    echo "</div>";
    return;
}

function cadreAlignCentrerDebut()
{
    echo "    <table align='center' border='0' cellpadding='0' cellspacing='0'>" . "<tr><td width='5px' height='5px'>" . "<img src='images/coinHGgris.png' border='0px'/>" . "</td>" . "<td width='100%' height='5px' class='gris'>" . "</td>" . "<td width='5px' height='5px'>" . "<img src='images/coinHDgris.png' border='0px'/>" . "</td></tr>" . "<tr><td width='5px' height='100%' class='gris'>" . "</td><td width='100%' border='0' height='100%' class='fondgris'>";
}

function cadreAlignCentrerFin()
{
    echo "   </td><td width='5px' height='100%' class='gris'>" . "</td></tr>" . "<tr><td width='5px' height='5px'>" . "<img src='images/coinBGgris.png' border='0px'/>" . "</td>" . "<td width='100%' height='5px' class='gris'>" . "</td>" . "<td width='5px' height='5px'>" . "<img src='images/coinBDgris.png' border='0px'/>" . "</td>" . "</tr>" . "</table>";
}

function cadreVectorielAlignCentrerDebut()
{
    echo "    <table align='center' border='0' cellpadding='0' cellspacing='0'>" . "<tr><td width='5px' height='5px'>" . "<img src='images/coinHGgris.svg' border='0px'/>" . "</td>" . "<td width='100%' height='5px' class='gris'>" . "</td>" . "<td width='5px' height='5px'>" . "<img src='images/coinHDgris.svg' border='0px'/>" . "</td></tr>" . "<tr><td width='5px' height='100%' class='gris'>" . "</td><td width='100%' border='0' height='100%' class='fondgris'>";
}

function cadreVectorielAlignCentrerFin()
{
    echo "   </td><td width='5px' height='100%' class='gris'>" . "</td></tr>" . "<tr><td width='5px' height='5px'>" . "<img src='images/coinBGgris.svg' border='0px'/>" . "</td>" . "<td width='100%' height='5px' class='gris'>" . "</td>" . "<td width='5px' height='5px'>" . "<img src='images/coinBDgris.svg' border='0px'/>" . "</td>" . "</tr>" . "</table>";
}

?>
