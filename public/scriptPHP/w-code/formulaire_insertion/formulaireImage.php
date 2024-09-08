<?php
include "../../../../localisation_Domaines_externes_B25.php";

session_start();
include("../../../scriptPHP/fichiersImages.php");
include("../../../scriptPHP/connectionBDD.php");
//---- repertoire a ouvrir ---------------------------------
$NomRep = SVNRADIEURAE_DIR."upload_utilisateurs/".$_SESSION['repertoire']."/images";
$CheminExterne = SVNRADIEURAE_PATH."upload_utilisateurs/".$_SESSION['repertoire']."/images";

//affichage du code html
echo "<html>";
echo "<head>";
echo "<title>Besan&ccedil;on 25 - La plate-Forme des artistes et des associations de Besan&ccedil;on - v1.00b - beta version</title>";
echo "<link type='text/css' rel='stylesheet' href='../../../besancon25.css'>";
echo "</head>";
echo "<script type='text/javascript' src='fonctions.js'></script>";
echo "<body text='#000000' bgcolor='gray' onunload='FermerFormulaireImage()'>";
//creation du tableau contenant le menu et l'horloge et accessoirement un sous tableau(voir ci-dessous)
echo "<h2>Les images disponibles</h2>";
//creation du formulaire d'envoi
echo "<form name='ChoixImages' method='POST' action='TraitementImages.php'>";

AfficherImagesMiniatureEtSuppression($NomRep,$CheminExterne);

echo "<input type='submit' value='Choisir' />";
echo "</form>";
echo "</td></tr>";
echo "<tr><td>"
	."<div class='formulaire' id='formulaire'>"
	."<table border='0' height='100' width='200' align='center'>"
	."<tr><td>"
	."<p align ='center'>"
	."<form enctype='multipart/form-data' method='post' action='TraitementInsertionImages.php'>"
	."<input type='hidden' name='MAX_FILE_SIZE' value='2097152'/>"
	."<p class='Titre'>Image à telecharger sur le SERVEUR:</p><input type='file' name='Fichier'/><BR>(max 2Mo)"
	."<input type='submit' name='btnUpload' value='Télécharger' onClick='AfficheFormTelechargement();'/>"
	."</p>"
	."</form>"
	."</td></tr>"
	."</table>"
	."</div>"
	."<div class='telechargementEnCours' id='telechargementEnCours'>"
	."<table border='0' height='100' width='200' align='center'>"
	."<tr><td>"
	."<img name='telechargementEnCours' src='../../../images/upload.jpg' />"
	."</td></tr>"
	."</table>"
	."</div>";
	
echo "</td></tr></table></body></html>";
?>
