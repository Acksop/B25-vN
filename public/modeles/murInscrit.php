<?php
global $header_title, $header_description, $header_identifier_url, $header_keywords;

if (isset($_GET['pseudo'])) {
    $id = recuperationIDArtisteOuArtisanFromPseudo($_GET['pseudo']);
    $type = recuperationTypeCompteFromIDArtiste($id);
} else {
    $id = $_GET['id'];
    $type = $_GET['type'];
}

$pseudo = recuperationPseudoArtisteOuArtisanFromIDArtiste($id);
$type_compte = array(
    "",
    "",
    "l'Artiste",
    "l'Association",
    "l'Artisan",
    "du Groupe Musical"
);
$header_title = "Besançon 25 - Page publique de {$type_compte[$type]} : {$pseudo} sur la Plate-forme";
$header_description = "Mur public de {$type_compte[$type]} : {$pseudo} sur Besançon 25";
$header_identifier_url = "besancon25.fr/{$id}eme_mur_public_du_{$type}eme_type";
$header_keywords = "Besançon, Besancon, 25000, 25, artiste, association, groupe musical, artisan, mur, humeur, vidé, images, musiques, compositions, graphique, mise en scène";

function LancerAffichageDuCorps()
{
    echo "<script src='scriptJS/afficherCacherDIV.js' type='text/javascript'></script>";
    
    if (isset($_GET['pseudo'])) {
        $id_inscrit = recuperationIDArtisteouArtisanFromPseudo($_GET['pseudo']);
        $type_inscrit = recuperationTypeCompteFromIDArtiste($id_inscrit);
    } else {
        $id_inscrit = $_GET['id'];
        $type_inscrit = $_GET['type'];
    }
    
    $nb_buzz_page = 10;
    IncrementerLectureTweetArtiste($id_inscrit);
    // test permettant de reconna�tre une personne apte a faire des modifications de gestion sur son compte.
    if (isset($_SESSION['NoFailleOnLine'])) {
        $id_artiste = recuperationIDartisteOffLine($_SESSION['id_utilisateur']);
        if ($id_artiste == $id_inscrit) {
            $admin = 1;
        } else {
            $admin = 0;
        }
    } else {
        $admin = 0;
    }
    
    // echo "<script src='scriptJS/ajax.js' type='text/javascript'></script>";
    echo "<script language='javascript'>" . "
		function AJAXAugmenterMur( page ){
		var xhr = createXHR();
		xhr.onreadystatechange = function(){
			document.getElementById('block' + page + '_mur').innerHTML = 'En Attente de réponse du serveur ...';
			if(xhr.readyState == 4){
				if(xhr.status == 200){
					document.getElementById('block' + page + '_mur').innerHTML = xhr.responseText;				
				}else{
					document.getElementById('block' + page + '_mur').innerHTML = 'Error:  ' + xhr.status + ' // ' + xhr.statusText;
				}
			}
		};
	
		var params = 'index=' + page + '&idA={$id_inscrit}&abs={$admin}';
		xhr.open( 'POST' , 'controlleursAJAX/postMurSuivant.php', true);
		xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		xhr.setRequestHeader('Content-length', params.length);
        xhr.setRequestHeader('Connection', 'close');
        xhr.send(params);
		}
";
if( $admin ){
    echo "
       function AJAXSupprimerBUZZ( id , idBlock ){
		var xhr = createXHR();
		xhr.onreadystatechange = function(){
			if(xhr.readyState == 4){
				if(xhr.status == 200){
					document.getElementById( 'block_BUZZ_' + idBlock ).style.display = 'none';				
				}
			}
		};
	
		xhr.open( 'GET' , 'controlleursAJAX/suppressionBUZZ.php?&id=' + id , true);
		xhr.send(null);
		
		}
		
		";
}
echo "</script>";
    
    if ($type_inscrit == 2 || $type_inscrit == 4) {
        // Artiste et Artisans
        $buzz = recuperationDesDerniersBUZZArtiste($id_inscrit, 0, $nb_buzz_page);
        $nb_buzz = recuperationNbBUZZTotalArtiste($id_inscrit);
        cadreAlignCentrerDebut();
        echo "<div id='block0_mur'>";
        $i = 0;
        while ($data = exploiterLigneResultatBDD($buzz)) {
            $tweet = recuperationTweetArtiste($data['id_buzz'], $data['type']);
            $data2 = exploiterLigneResultatBDD($tweet);
            switch ($data['type']) {
                case 0:
                    // Buzz humeur
                    echo "<div id='block_BUZZ_{$i}' class='bloc_murUtilisateur'>";
                    echo "<p class='murUtilisateurs'><tt>" . check_ChaineDeCaracteresDownload($data2['text']) . "</tt></p>";
                    echo "</div>";
                    break;
                case 1:
                    // Image
                    echo "<div id='block_BUZZ_{$i}' class='bloc_murUtilisateur'>";
                    echo "<center><p class='murUtilisateurs'><img src='" . RADIEURAE_SVN_PATH . $data2['image'] . "' alt='" . $data2['nomImage'] . "'/><br/><tt>" . check_ChaineDeCaracteresDownload($data2['text']);
                    if ($admin == 1) {
                        echo "<span style='float:right;'><a href='javascript:;' onClick='AJAXSupprimerBUZZ({$data['id_buzz']},{$i});'>Supprimer?</a></span>";
                    }
                    echo "</tt></p></center>";
                    echo "</div>";
                    break;
                case 2:
                    // Son
                    echo "<div id='block_BUZZ_{$i}' class='bloc_murUtilisateur'>";
                    echo "<p class='murUtilisateurs'>";
                    echo "<object type='application/x-shockwave-flash' id='mplayer476bf6c9c6489' data='lecteurMp3/mplayer.swf' wmode='transparent' height='24' width='290'><br><param name='movie' value='lecteurMp3/mplayer.swf'><param name='FlashVars' value='playerID=mplayer476bf6c9c6489&amp;bg=0xF8F8F8&amp;leftbg=0xebebeb&amp;lefticon=0x666666&amp;rightbg=0xd20560&amp;rightbghover=0x2c7d9c&amp;righticon=0xFFFFFF&amp;righticonhover=0xFFFFFF&amp;text=0x4f5458&amp;slider=0xd20560&amp;track=0xFFFFFF&amp;border=0x666666&amp;loader=0xebebeb&amp;soundFile=" . RADIEURAE_SVN_PATH . $data2['son'] . "'><param name='quality' value='high'><param name='menu' value='false'><param name='wmode' value='transparent'></object>";
                    echo "<b>" . check_ChaineDeCaracteresDownload($data2['nomMp3']) . "</b><br/><tt>" . check_ChaineDeCaracteresDownload($data2['text']);
                    if ($admin == 1) {
                        echo "<span style='float:right;'><a href='javascript:;' onClick='AJAXSupprimerBUZZ({$data['id_buzz']},{$i});'>Supprimer?</a></span>";
                    }
                    echo "</tt></p>";
                    echo "</div>";
                    break;
                case 3:
                    // Vid�o
                    echo "<div id='block_BUZZ_{$i}' class='bloc_murUtilisateur'>";
                    echo "<center><p class='murUtilisateurs'>" . check_ChaineDeCaracteresDownload($data2['codeConnexe']) . "<br/><tt>" . check_ChaineDeCaracteresDownload($data2['text']) . "</tt>";
                    if ($admin == 1) {
                        echo "<span style='float:right;'><a href='javascript:;' onClick='AJAXSupprimerBUZZ({$data['id_buzz']},{$i});'>Supprimer?</a></span>";
                    }
                    echo "</p></center>";
                    echo "</div>";
                    break;
                default:
            }
            $i ++;
        }
        echo "</div>";
        if ($nb_buzz > $nb_buzz_page) {
            echo "<div id='block1_mur'><span style='float:right;'><a href='javascript:;' onClick='AJAXAugmenterMur(1);'>Do you wanna More?</a></span></div>";
        }
        cadreAlignCentrerFin();
    } else {
        // Associations et Groupes
    }
}
