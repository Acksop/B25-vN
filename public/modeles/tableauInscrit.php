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
$header_description = "Tableau public de {$type_compte[$type]} : {$pseudo} sur Besançon 25";
$header_identifier_url = "besancon25.fr/{$id}eme_tableau_public_du_{$type}eme_type";
$header_keywords = "Besançon, Besancon, 25000, 25, artiste, association, groupe musical, artisan, tableau, humeur, vidéo, images, musiques, compositions, graphique, mise en scène";

function LancerAffichageDuCorps()
{
    
    // echo "<script src='scriptJS/afficherCacherDIV.js' type='text/javascript'></script>";
    if (isset($_GET['pseudo'])) {
        $id_inscrit = recuperationIDArtisteouArtisanFromPseudo($_GET['pseudo']);
        $type_inscrit = recuperationTypeCompteFromIDArtiste($id_inscrit);
    } else {
        $id_inscrit = $_GET['id'];
        $type_inscrit = $_GET['type'];
    }
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
    
    if ($type_inscrit == 2 || $type_inscrit == 4) {
        // Artiste et Artisans
        $buzzHumeur = recuperationDernierBUZZArtiste($id_inscrit, 0);
        $buzzImage = recuperationDernierBUZZArtiste($id_inscrit, 1);
        $buzzSonore = recuperation7DerniersBUZZArtiste($id_inscrit, 2, 0);
        $buzzConnexe = recuperationDernierBUZZArtiste($id_inscrit, 3);
        
        $nbBUZZImage = recuperationNbBUZZArtiste($id_inscrit, 1);
        $nbBUZZSonore = recuperationNbBUZZArtiste($id_inscrit, 2);
        $nbBUZZConnexe = recuperationNbBUZZArtiste($id_inscrit, 3);
        
        if ($buzzHumeur != NULL) {
            $data = exploiterLigneResultatBDD_row($buzzHumeur);
            $tweet = recuperationTweetArtiste($data['0'], $data['3']);
            $data2 = exploiterLigneResultatBDD($tweet);
            echo "<span id='block_humeur' align='center'>";
            cadreAlignCentrerDebut();
            echo "<p class='utilisateurs'><tt>" . check_ChaineDeCaracteresDownload($data2['text']) . "</tt></p>";
            cadreAlignCentrerFin();
            echo "</span><br />";
        }
        if ($buzzConnexe != NULL && $nbBUZZConnexe != 0) {
            $data = exploiterLigneResultatBDD_row($buzzConnexe);
            $tweet = recuperationTweetArtiste($data['0'], $data['3']);
            $data2 = exploiterLigneResultatBDD($tweet);
            echo "<div class='utilisateurs' id='block_media_connexe' class='B25-cadre' style='float:left;'>";
            echo "    <table width='100%' align='center' border='0' cellpadding='0' cellspacing='0'>" . "<tr><td>" . 
            // ."<img src='images/coinHGgris.png' border='0px'/>"
            "</td><td>" . "</td>" . "<td>" . 
            // ."<img src='images/coinHDgris.png' border='0px'/>"
            "</tr><tr><td>" . "<td width='45px'>" . "<img style='visibility:hidden;' src='images/flecheg_up.gif' alt='Fleche_gauche' width='45px' height='420px'/>" . "</td>" . "</td><td>" . 

            check_ChaineDeCaracteresDownload($data2['codeConnexe']) . 

            "</td>" . "<td width='45px'>";
            if ($nbBUZZConnexe > 1) {
                $idTweetSuivant = recuperationProchainBUZZArtiste($data['0'], $data['1'], $data['3']);
                $data = exploiterLigneResultatBDD_row($idTweetSuivant);
                echo "" . "<a id='naviguationLienConnexe' href='javascript:;' onClick='AJAXChangerMediaConnexe(" . $data[0] . ");'>" . "<img src='images/fleched_up.gif' alt='Fleche_droite' width='45px' height='420px' onMouseOver='this.src=btn_MediaConnexe_D_down' onMouseOut='this.src=btn_MediaConnexe_D_up' onMouseDown='this.src=btn_MediaConnexe_D_hover' />" . "</a>";
            } else {
                echo "<img style='visibility:hidden;' src='images/fleched_up.gif' alt='Fleche_droite' width='45px' height='420px'/>";
            }
            
            echo "</td></tr>" . "<tr><td>" . 
            // ."<img src='images/coinBGgris.png' border='0px'/>"
            "</td><td>" . 

            "<p><tt>" . check_ChaineDeCaracteresDownload($data2['text']) . "</tt>";
            if ($admin == 1) {
                echo "&nbsp;&nbsp; / &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a id='navigationImage' href='javascript:;' onClick='AJAXSupprimerMediaConnexe(" . $data2['id_buzz'] . ");'>Supprimer?</a>";
            }
            echo "</p>";
            
            echo "</td>" . "<td>" . 
            // ."<img src='images/coinBDgris.png' border='0px'/>"
            "</td>" . "</tr>";
            
            echo "</table>";
            
            echo "</div>";
        }
        
        if ($buzzSonore != NULL && $nbBUZZSonore != 0) {
            echo "<div id='block_sonore' style='float:rigth;'>";
            
            cadreAlignCentrerDebut();
            
            while ($data = exploiterLigneResultatBDD_row($buzzSonore)) {
                ;
                $tweet = recuperationTweetArtiste($data['0'], $data['3']);
                $data2 = exploiterLigneResultatBDD($tweet);
                echo "<br/><p class='utilisateurs' style='width:300px;'>" . "<object type='application/x-shockwave-flash' id='mplayer476bf6c9c6489' data='lecteurMp3/mplayer.swf' wmode='transparent' height='24' width='290'><br><param name='movie' value='lecteurMp3/mplayer.swf'>" . "<param name='FlashVars' value='playerID=mplayer476bf6c9c6489&amp;bg=0xF8F8F8&amp;leftbg=0xebebeb&amp;lefticon=0x666666&amp;rightbg=0xAAAAAA&amp;rightbghover=0xBBBBBB&amp;righticon=0xFFFFFF&amp;righticonhover=0xFFFFFF&amp;text=0x4f5458&amp;slider=0xAAAAAA&amp;track=0xFFFFFF&amp;border=0x666666&amp;loader=0xebebeb&amp;soundFile=" . RADIEURAE_SVN_PATH . $data2['son'] . "'><param name='quality' value='high'><param name='menu' value='false'><param name='wmode' value='transparent'></object>" . "<br/>" . "<span style='float:left;'><b>" . check_ChaineDeCaracteresDownload($data2['nomMp3']) . "</b></span>";
                if ($admin == 1) {
                    echo "<span style='float:right;'><a id='navigationSupprimerLien' href='javascript:;' onClick='AJAXSupprimerMediaSonore(0,{$data2['id_buzz']});'>[X]</a></span>";
                }
                echo "<br/><tt>" . check_ChaineDeCaracteresDownload($data2['text']) . "</tt></p><br/>";
            }
            if ($nbBUZZSonore > 7) {
                echo "<br/><p class='utilisateurs' style='width:300px;'><a id='naviguationLienConnexeSuivant' href='javascript:;' onClick='AJAXChangerMediasSonores(7);'> Suite</a></p>";
            }
            
            cadreAlignCentrerFin();
            
            echo "</div>";
        }
        
        if ($buzzImage != NULL && $nbBUZZImage != 0) {
            $data = exploiterLigneResultatBDD_row($buzzImage);
            $tweet = recuperationTweetArtiste($data['0'], $data['3']);
            $data2 = exploiterLigneResultatBDD($tweet);
            
            echo "<div style='clear:both;' id='block_image'>";
            
            echo "<div class='B25-cadre'>";
            
            echo "<center><p style='background-color: #BBB;'><br/><img src='" . RADIEURAE_SVN_PATH . $data2['image'] . "' alt='" . $data2['nomImage'] . "'/><br/><br/>" . "<span style='float:left;'>&lt;&lt;&lt;&lt;</span>" . "<span style='float:center;'><tt>" . check_ChaineDeCaracteresDownload($data2['text']) . "</tt>";
            if ($admin == 1) {
                echo "&nbsp;&nbsp;<a id='navigationImage' href='javascript:;' onClick='AJAXSupprimerImage(" . $data2['id_buzz'] . ");'>Supprimer?</a>";
            }
            echo "</span>";
            if ($nbBUZZImage > 1) {
                $idTweetSuivant = recuperationProchainBUZZArtiste($data['0'], $data['1'], $data['3']);
                $data = exploiterLigneResultatBDD_row($idTweetSuivant);
                echo "<span style='float:right;'><a id='navigationImage' href='javascript:;' onClick='AJAXChangerImage(" . $data[0] . ");'>&gt;&gt;&gt;&gt;</a></span>";
            } else {
                echo "<span style='float:right;'>&gt;&gt;&gt;&gt;</span>";
            }
            echo "</p></center>";
            
            echo "</div>";
            
            echo "</div>";
        }
        
        echo "<script type='text/javascript'>";
        
        echo <<<EOF
		
		loader_video = new Image();
		loader_video = 'images/tweet_loading_videos.gif';
		loader_image = new Image();
		loader_image = 'images/tweet_loading_images.gif';
		loader_son = new Image();
		loader_son = 'images/tweet_loading_sound.gif';
		
		function AJAXChangerMediaConnexe( id_buzz ){
		var xhr = createXHR();
		var div = selectionnerDIV('block_media_connexe');
		xhr.onreadystatechange = function(){
			div.innerHTML = '<img style="cursor: none;" border="0" src="' + loader_video + '" />';
			if(xhr.readyState == 4){
				if(xhr.status == 200){
					div.innerHTML = xhr.responseText;			
				}else{
					div.innerHTML = 'Error:  ' + xhr.status + ' // ' + xhr.statusText;
				}
			}
		};
	
		xhr.open( 'GET' , 'controlleursAJAX/mediaConnexeSuivant.php?id=' + id_buzz +'&idA={$_GET['id']}&abs={$admin}', true);
		//xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		xhr.send(null); 
		}
		
		function AJAXChangerMediasSonores( nbMediaSonore ){
		var xhr = createXHR();
		var div = selectionnerDIV('block_sonore');
		xhr.onreadystatechange = function(){
			div.innerHTML = '<img style="cursor: none;" border="0" src="' + loader_son + '" />';
			if(xhr.readyState == 4){
				if(xhr.status == 200){
					div.innerHTML = xhr.responseText;				
				}else{
					div.innerHTML = 'Error:  ' + xhr.status + ' // ' + xhr.statusText;
				}
			}
		};
		xhr.open( 'GET' , 'controlleursAJAX/mediasSonoresSuivant.php?nb=' + nbMediaSonore +'&idA={$_GET['id']}&abs={$admin}', true);
		//xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		xhr.send(null); 
		}
		
		function AJAXChangerImage( id_buzz ){
		var xhr = createXHR();
		var div = selectionnerDIV('block_image');
		xhr.onreadystatechange = function(){
			div.innerHTML = '<img style="cursor: none;" border="0" src="' + loader_image + '" />';
			if(xhr.readyState == 4){
				if(xhr.status == 200){
					div.innerHTML = xhr.responseText;				
				}else{
					div.innerHTML = 'Error:  ' + xhr.status + ' // ' + xhr.statusText;
				}
			}
		};
		xhr.open( 'GET' , 'controlleursAJAX/mediaImageSuivant.php?id=' + id_buzz + '&idA={$_GET['id']}&abs={$admin}', true);
		//xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		xhr.send(null); 
		}
		
			
			btn_MediaConnexe_G_down = new Image();
			btn_MediaConnexe_G_down = 'images/flecheg_down.gif';
			btn_MediaConnexe_G_hover = new Image();
			btn_MediaConnexe_G_hover = 'images/flecheg_hover.gif';
			btn_MediaConnexe_G_up = new Image();
			btn_MediaConnexe_G_up = 'images/flecheg_up.gif';
			btn_MediaConnexe_D_down = new Image();
			btn_MediaConnexe_D_down = 'images/fleched_down.gif';
			btn_MediaConnexe_D_hover = new Image();
			btn_MediaConnexe_D_hover = 'images/fleched_hover.gif';
			btn_MediaConnexe_D_up = new Image();
			btn_MediaConnexe_D_up = 'images/fleched_up.gif';
		
EOF;
        
        if ($admin) {
            
            echo <<<EOF
	  
	  function AJAXSupprimerMediaConnexe( id_buzz ){
		var xhr = createXHR();
		var div = selectionnerDIV('block_media_connexe');
		xhr.onreadystatechange = function(){
			div.innerHTML = '<img style="cursor: none;" border="0" src="' + loader_video + '" />';
			if(xhr.readyState == 4){
				if(xhr.status == 200){
					div.innerHTML = xhr.responseText;			
				}else{
					div.innerHTML = 'Error:  ' + xhr.status + ' // ' + xhr.statusText;
				}
			}
		};
	
		xhr.open( 'GET' , 'controlleursAJAX/supprimerMediaConnexe.php?id=' + id_buzz +'&idA={$_GET['id']}&abs={$admin}', true);
		//xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		xhr.send(null); 
		}
		
		function AJAXSupprimerImage( id_buzz ){
		var xhr = createXHR();
		var div = selectionnerDIV('block_image');
		xhr.onreadystatechange = function(){
			div.innerHTML = '<img style="cursor: none;" border="0" src="' + loader_image + '" />';
			if(xhr.readyState == 4){
				if(xhr.status == 200){
					div.innerHTML = xhr.responseText;				
				}else{
					div.innerHTML = 'Error:  ' + xhr.status + ' // ' + xhr.statusText;
				}
			}
		};
	
		xhr.open( 'GET' , 'controlleursAJAX/supprimerMediaImage.php?id=' + id_buzz +'&idA={$_GET['id']}&abs={$admin}', true);
		//xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		xhr.send(null); 
		}
		
	  function AJAXSupprimerMediaSonore( nbMediaSonore,id_buzz}{
		var xhr = createXHR();
		var div = selectionnerDIV('block_sonore');
		xhr.onreadystatechange = function(){
			div.innerHTML = '<img style="cursor: none;" border="0" src="' + loader_son + '" />';
			if(xhr.readyState == 4){
				if(xhr.status == 200){
					div.innerHTML = xhr.responseText;				
				}else{
					div.innerHTML = 'Error:  ' + xhr.status + ' // ' + xhr.statusText;
				}
			}
		};
		xhr.open( 'GET' , 'controlleursAJAX/supprimerMediaSonore.php?nb=' + nbMediaSonore + '&id=' + id_buzz + '&idA={$_GET['id']}&abs={$admin}', true);
		//xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		xhr.send(null); 
		}
	    
EOF;
        }
        
        echo "</script>";
    } else {
        // Associations et Groupes
    }
}