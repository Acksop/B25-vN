<?php
global $header_title, $header_description, $header_identifier_url, $header_keywords;

if (isset($_GET['nom'])) {
    $id = recuperationIDAssociationOuGroupeFromNom($_GET['nom']);
    if ($id == '404') {
        header("location: /erreurs/erreur.php?num=4");
    }
} else {
    $id = $_GET['id'];
}

$nom = recuperationNomAssociationOuGroupeFromIDAssociation($id);
$description = recuperationDescriptionAssociationOuGroupeFromIDAssociation($id);
$header_title = "Besançon 25 - Page publique de présentation du groupe {$nom} ({$description}) sur la Plate-forme";
$header_description = "Présentation de l'Élaboration Musicale: {$description} par le Groupe : {$nom} sur Besançon 25";
$header_identifier_url = "besancon25.fr/presentation_du_{$id}eme_groupe";
$header_keywords = "Besan&ccedil;on, Besancon, 25000, 25, groupe, mur, pr&eacute;sentation, extraits, prix, r&eacute;servation, r&eacute;servations, cr&eacute;ations, musique, musical, musicaux, sonore, sonores, art, r&eacute;alisations";

include_once ("scriptPHP/easyGoogleMap/GoogleMap.php");
include_once ("scriptPHP/easyGoogleMap/JSMin.php");

function LancerAffichageDuCorps()
{
    $MAP_OBJECT = new GoogleMapAPI();
    $MAP_OBJECT->_minify_js = isset($_REQUEST["min"]) ? FALSE : TRUE;
    $MAP_OBJECT->setDSN(DSNBDDGOOGLEMAP);
    
    echo <<<EOD
			<style>
			 #colonne1, #colonne2, #colonne3 {
					    float: left;
					    width: 280px;
					    margin: 0 35px 0 0;
					}
			 .conteneurArticleInterieur{
			 			clear: both;
			 }
			</style>
EOD;
    
    if (isset($_GET['nom'])) {
        $id_association = recuperationIDAssociationOuGroupeFromNom($_GET['nom']);
    } else {
        $id_association = $_GET['id'];
    }
    
    $association = exploiterLigneResultatBDD(recuperationInfoAssoFromID($id_association));
    $albums = recuperationAlbumGroupeFromId($id_association);
    $album = array(
        'id_album' => '0',
        'image' => '',
        'libelle' => '',
        'description' => '',
        'annee' => '',
        'style' => ''
    );
    $descriptif = exploiterLigneResultatBDD(recuperationDescriptifAsso($id_association));
    
    cadreAlignCentrerDebut();
    echo "<h1 style='margin: 0px 0px 0px 30px ;'>&laquo; <span style='color:#FFFFFF'> {$association['nom']} </span> &raquo;</h1>";
    echo "<p style='margin: 0px 0px 0px 75px ;'>STUDIO DE PRODUCTION : <br />{$association['adresse']}<br />{$association['codePostal']}&nbsp;&nbsp;&nbsp;{$association['ville']}<br /><b>tel:</b> {$association['telephone']}</p>";
    if ($descriptif['logo'] != '' && $descriptif['descriptif'] != '') {
        
        echo "<span class='logotype' ><img class='image-description-association' src='" . SVNRADIEURAE_PATH . $descriptif['logo'] . "' alt='" . remplacerGuillemets($association['nom']) . "'/></span>";
        echo "{$descriptif['descriptif']}";
    } else {
        echo "<p class='utilisateurs'>Vous devez mettre un logo et une description pour pouvoir vous pr&eacute;senter.</p>";
    }
    cadreAlignCentrerFin();
    echo "<br /><br />";
    
    cadreAlignCentrerDebut();
    echo "<center><br />";
    
    $adresse = utf8_encode(html_entity_decode($association['adresse'])) . ", " . utf8_encode(html_entity_decode($association['codePostal'])) . ", " . utf8_encode(html_entity_decode($association['ville']));
    $descriptionGoogle = "<p class='utilisateur'>{$association['nom']}<br />{$association['description']}<br />{$association['telephone']}<br />{$association['email']}<br />";
    $descriptionGoogle .= "</p>";
    $MAP_OBJECT->addMarkerByAddress($adresse, "", $descriptionGoogle, "", "", "");
    
    $MAP_OBJECT->setHeight('250');
    $MAP_OBJECT->setWidth('900');
    $MAP_OBJECT->enableStreetViewControls();
    
    echo $MAP_OBJECT->getHeaderJS();
    echo $MAP_OBJECT->getMapJS();
    echo $MAP_OBJECT->printOnLoad();
    echo $MAP_OBJECT->printMap();
    // echo $MAP_OBJECT->printSidebar();
    echo "<br /></center>";
    cadreAlignCentrerFin();
    
    // Affichages des extraits des albums
    
    echo "<br /><br />";
    
    $i = 0;
    $j = 0;
    echo "<a name='ancre_albums'></a>";
    cadreAlignCentrerDebut();
    $rand = rand(0, 5);
    if ($rand == 2) {
        $rand = 4;
    }
    while ($album = exploiterLigneResultatBDD($albums)) {
        $j = $i % 3;
        $j ++;
        $bloc = "colonne" . $j;
        /*
         * if ($j == 0){
         * //echo "<div class=''>";
         *
         * }
         */
        
        echo "<div id='$bloc'>" . "<a name='ancre_album_{$album['id_album']}'></a>" . "<h2 class='legende'>";
        echo "Album n&deg;{$i}";
        echo "</h2><br />";
        echo "<div class='conteneurArticleInterieur' id='extraits_ALBUM_{$album['id_album']}' >";
        echo "<div id='ALBUM_{$album['id_album']}' class='conteneurArticleInterieur'>" . "<center><img src='" . SVNRADIEURAE_PATH . $album['image'] . "' alt='{$album['libelle']}'/>" . "<p class='titre' align='center'>{$album['libelle']}</p>" . "<p class='article'>{$album['description']}</p>" . "<p class='titre' style='float:right; width: 250px'>{$album['style']} - Ann&eacute;e {$album['annee']}&nbsp;</p>";
        
        cadreMultiplesDebut($rand);
        $musiques = recuperationMusiquesAlbum($album['id_album']);
        while ($musique = exploiterLigneResultatBDD($musiques)) {
            
            echo "<p class='utilisateurs' style='position: relative; left: 0px; width: 290px;'>" . "<object type='application/x-shockwave-flash' id='mplayer476bf6c9c6489' data='./lecteurMp3/mplayer.swf' wmode='transparent' height='24' width='290'><br><param name='movie' value='./lecteurMp3/mplayer.swf'>" . "<param name='FlashVars' value='playerID=mplayer476bf6c9c6489&amp;bg=0xF8F8F8&amp;leftbg=0xebebeb&amp;lefticon=0x666666&amp;rightbg=0xAAAAAA&amp;rightbghover=0xBBBBBB&amp;righticon=0xFFFFFF&amp;righticonhover=0xFFFFFF&amp;text=0x4f5458&amp;slider=0xAAAAAA&amp;track=0xFFFFFF&amp;border=0x666666&amp;loader=0xebebeb&amp;soundFile=" . SVNRADIEURAE_PATH . $musique['musique'] . "'><param name='quality' value='high'>" . "<param name='menu' value='false'><param name='wmode' value='transparent'>" . "</object>";
            echo "<span style='float: center;'><tt>" . check_ChaineDeCaracteresDownload($musique['titre']) . "</tt></span>" . "</p>";
        }
        cadreMultiplesFin($rand);
        // ."<br /><br /><br /><br /><br />"
        echo "</center>" . "</div>" . "</div>";
        /*
         * if ($j == 2){
         * echo "</div>";
         * }
         */
        $i ++;
        echo "</div>";
    }
    /*
     * if ($j !== 2){
     * echo "</div>";
     * }
     */
    cadreAlignCentrerFin();
}
