<?php
if (! (isset($page) && $page == "index")) {
    global $header_title, $header_description, $header_identifier_url, $header_keywords;
    $header_title = "Besançon 25 - L'Article actuel de la Plate-forme";
    $header_description = "Le dossier actuel de Besançon 25";
    $header_identifier_url = "besancon25.fr/article_long";
    $header_keywords = "Besançon, Besancon, 25000, 25, article, dossier, article long";
}

if (function_exists("LancerAffichageDuCorps")) {

    function AfficherPageDossier()
    {
        LancerAffichageDuDossier();
    }
} else {

    function LancerAffichageDuCorps()
    {
        LancerAffichageDuDossier();
    }
}

function LancerAffichageDuDossier()
{
    echo "<br /><br /><br />";
    
    $req = recuperationDossieraAfficher();
    $data = exploiterLigneResultatBDD($req);
    
    if ($data != 0) {
        echo "<div class='B25-cadre'>";
        echo "<p class='titreDossier'>" . $data['titre'] . "</p>" . "<p class='corpsDossier'>" . $data['corps'] . "</p>" . "<p align='right' class='date'>Derni&egrave;re &eacute;dition " . $data['date_Modif'] . "</p>" . "<p align='right' class='date'><b>Mis en ligne " . $data['date_misEnLigne'] . "</b></p>" . "<p align='right' class='post'>Auteur:&nbsp;&nbsp;" . recuperationAuteur($data['id_utilisateur']) . "</p>";
        ajouterLectureDossierAfficher($data['id_dossier']);
        if (isset($_SESSION['type_compte'])) {
            if ($_SESSION['type_compte'] == '0') {
                echo "<center>Il y a actuellement " . recuperationNbDossierAValider() . " Dossiers a <a href='index.php?page=validationArticle'>valider</a>...</center>";
                echo "<center><a href='index.php?page=choixDossier'>Choisir le BON dossier &agrave; afficher ?</a></center>";
            }
        }
        echo "</div>";
    } else {
        echo "Pas de dossiers &agrave; lire...";
    }
}

function PositionneMootools()
{
    echo <<<EOD
		
		<script type='text/javascript' src='./scriptJS/mootools-1.2.4.js'></script>
		<script type='text/javascript' src='./scriptJS/Carousel.js'></script>
		<script type='text/javascript' src='./scriptJS/Carousel.Extra.js'></script>
		<script type='text/javascript' src='./scriptJS/PeriodicalExecuter.js'></script>
EOD;
}