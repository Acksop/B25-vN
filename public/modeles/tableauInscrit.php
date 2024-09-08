<?php

global $header_title,$header_description,$header_identifier_url,$header_keywords;
$pseudo = recuperationPseudoArtisteOuArtisanFromIDArtiste($_GET['id']);
$type_compte = array( "","","l&apos;Artiste","l&apos;Association","l&apos;Artisan","du Groupe Musical" );
$header_title = "Besan&ccedil;on 25 - Page publique de {$type_compte[$_GET['type']]} : {$pseudo} sur la Plate-forme";
$header_description = "Tableau public de {$type_compte[$_GET['type']]} : {$pseudo} sur Besan&ccedil;on 25";
$header_identifier_url = "besancon25.fr/{$_GET['id']}eme_tableau_public_du_{$_GET['type']}eme_type";
$header_keywords = "Besan&ccedil;on, Besancon, 25000, 25, artiste, association, groupe musical, artisan, tableau, humeur, vid&eacute;, images, musiques, compositions, graphique, mise en sc&egrave;ne";


function LancerAffichageDuCorps(){

	echo "<script src='scriptJS/afficherCacherDIV.js' type='text/javascript'></script>";
	
	$id_inscrit = $_GET['id'];
	IncrementerLectureTweetArtiste($id_inscrit);
	$type_inscrit = $_GET['type'];

	//test permettant de reconna�tre une personne apte a faire des modifications de gestion sur son compte.
	if(isset($_SESSION['NoFailleOnLine'])){
		$id_artiste = recuperationIDartisteOffLine($_SESSION['id_utilisateur']);
		if( $id_artiste == $id_inscrit ){
			$admin = 1;
		}else{
			$admin = 0;
		}
	}else{
		$admin = 0;
	}

	//echo "<script src='scriptJS/ajax.js' type='text/javascript'></script>";
	echo "<script language='javascript'>"
		."
		function AJAXChangerMediaConnexe( id_buzz ){
		var xhr = createXHR();
		xhr.onreadystatechange = function(){
			document.getElementById('block_media_connexe').innerHTML = 'En Attente de r�ponse du serveur ...';
			if(xhr.readyState == 4){
				if(xhr.status == 200){
					document.getElementById('block_media_connexe').innerHTML = xhr.responseText;			
				}else{
					document.getElementById('block_media_connexe').innerHTML = 'Error:  ' + xhr.status + ' // ' + xhr.statusText;
				}
			}
		};
	
		xhr.open( 'GET' , 'controlleursAJAX/mediaConnexeSuivant.php?id=' + id_buzz +'&idA={$_GET['id']}&abs={$admin}', true);
		//xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		xhr.send(null); 
		}
		function AJAXSupprimerMediaConnexe( id_buzz ){
		var xhr = createXHR();
		xhr.onreadystatechange = function(){
			document.getElementById('block_media_connexe').innerHTML = 'En Attente de r�ponse du serveur ...';
			if(xhr.readyState == 4){
				if(xhr.status == 200){
					document.getElementById('block_media_connexe').innerHTML = xhr.responseText;				
				}else{
					document.getElementById('block_media_connexe').innerHTML = 'Error:  ' + xhr.status + ' // ' + xhr.statusText;
				}
			}
		};
	
		xhr.open( 'GET' , 'controlleursAJAX/supprimerMediaConnexe.php?id=' + id_buzz +'&idA={$_GET['id']}&abs={$admin}', true);
		//xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		xhr.send(null); 
		}
		function AJAXChangerMediasSonores( nbMediaSonore ){
		var xhr = createXHR();
		xhr.onreadystatechange = function(){
			document.getElementById('block_sonore').innerHTML = 'En Attente de r�ponse du serveur ...';
			if(xhr.readyState == 4){
				if(xhr.status == 200){
					document.getElementById('block_sonore').innerHTML = xhr.responseText;				
				}else{
					document.getElementById('block_sonore').innerHTML = 'Error:  ' + xhr.status + ' // ' + xhr.statusText;
				}
			}
		};
		xhr.open( 'GET' , 'controlleursAJAX/mediasSonoresSuivant.php?nb=' + nbMediaSonore +'&idA={$_GET['id']}&abs={$admin}', true);
		//xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		xhr.send(null); 
		}
		function AJAXSupprimerMediaSonore( nbMediaSonore , id_buzz ){
		var xhr = createXHR();
		xhr.onreadystatechange = function(){
			document.getElementById('block_sonore').innerHTML = 'En Attente de r�ponse du serveur ...';
			if(xhr.readyState == 4){
				if(xhr.status == 200){
					document.getElementById('block_sonore').innerHTML = xhr.responseText;				
				}else{
					document.getElementById('block_sonore').innerHTML = 'Error:  ' + xhr.status + ' // ' + xhr.statusText;
				}
			}
		};
		xhr.open( 'GET' , 'controlleursAJAX/supprimerMediaSonore.php?nb=' + nbMediaSonore + '&id=' + id_buzz + '&idA={$_GET['id']}&abs={$admin}', true);
		//xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		xhr.send(null); 
		}
		function AJAXChangerImage( id_buzz ){
		var xhr = createXHR();
		xhr.onreadystatechange = function(){
			document.getElementById('block_image').innerHTML = 'En Attente de r�ponse du serveur ...';
			if(xhr.readyState == 4){
				if(xhr.status == 200){
					document.getElementById('block_image').innerHTML = xhr.responseText;				
				}else{
					document.getElementById('block_image').innerHTML = 'Error:  ' + xhr.status + ' // ' + xhr.statusText;
				}
			}
		};
		xhr.open( 'GET' , 'controlleursAJAX/mediaImageSuivant.php?id=' + id_buzz + '&idA={$_GET['id']}&abs={$admin}', true);
		//xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		xhr.send(null); 
		}
		function AJAXSupprimerImage( id_buzz ){
		var xhr = createXHR();
		xhr.onreadystatechange = function(){
			document.getElementById('block_image').innerHTML = 'En Attente de r�ponse du serveur ...';
			if(xhr.readyState == 4){
				if(xhr.status == 200){
					document.getElementById('block_image').innerHTML = xhr.responseText;				
				}else{
					document.getElementById('block_image').innerHTML = 'Error:  ' + xhr.status + ' // ' + xhr.statusText;
				}
			}
		};
	
		xhr.open( 'GET' , 'controlleursAJAX/supprimerMediaImage.php?id=' + id_buzz +'&idA={$_GET['id']}&abs={$admin}', true);
		//xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		xhr.send(null); 
		}
		"
		."
			//pr�chargement des images pour un RollOver !un vrai!
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
			
		"
		."</script>";
		
	if($type_inscrit == 2 || $type_inscrit == 4){
		//Artiste et Artisans
		$buzzHumeur = recuperationDernierBUZZArtiste($id_inscrit,0);
		$buzzImage = recuperationDernierBUZZArtiste($id_inscrit,1);
		$buzzSonore = recuperation7DerniersBUZZArtiste($id_inscrit,2,0);
		$buzzConnexe = recuperationDernierBUZZArtiste($id_inscrit,3);
		
		$nbBUZZImage = recuperationNbBUZZArtiste($id_inscrit,1);
		$nbBUZZSonore = recuperationNbBUZZArtiste($id_inscrit,2);
		$nbBUZZConnexe = recuperationNbBUZZArtiste($id_inscrit,3);
		
		
		if($buzzHumeur != NULL){
			$data = mysql_fetch_row($buzzHumeur);
			$tweet = recuperationTweetArtiste($data['0'],$data['3']);
			$data2 = mysql_fetch_assoc($tweet);
			//echo "<div id='block_humeur' style='position:absolute; left:45px; top:-25px;'>";
			echo "<span id='block_humeur' align='center'>";
			cadreAlignCentrerDebut();
			echo "<p class='utilisateurs'><tt>".check_ChaineDeCaracteresDownload($data2['text'])."</tt></p>";
			cadreAlignCentrerFin();
			//echo "</div>";
			echo "</span><br>";
		}
		if($buzzConnexe != NULL && $nbBUZZConnexe != 0){
			$data = mysql_fetch_row($buzzConnexe);
			$tweet = recuperationTweetArtiste($data['0'],$data['3']);
			$data2 = mysql_fetch_assoc($tweet);
			echo "<div class='utilisateurs' id='block_media_connexe' style='float:left;'>";
			echo "<span id='block_media_connexe' align='left'>";
			echo "<table border='0' align='center'><tr><td width='45' valign='top'>"
				."<img style='visibility:hidden;' src='images/flecheg_up.gif' alt='Fleche_gauche' width='45px' height='420px'/>"
				."</td><td width='560'>"
				.check_ChaineDeCaracteresDownload($data2['codeConnexe']);
			if($nbBUZZConnexe > 1){
				$idTweetSuivant = recuperationProchainBUZZArtiste($data['0'],$data['1'],$data['3']);
				$data = mysql_fetch_row($idTweetSuivant);
				echo "</td><td width='45' valign='top'><a id='naviguationLienConnexe' href='javascript:;' onClick='AJAXChangerMediaConnexe(".$data[0].");'><img src='images/fleched_up.gif' alt='Fleche_droite' width='45px' height='420px' onMouseOver='this.src=btn_MediaConnexe_D_down' onMouseOut='this.src=btn_MediaConnexe_D_up' onMouseDown='this.src=btn_MediaConnexe_D_hover' /></a>";
			}else{
				echo "</td><td><img style='visibility:hidden;' src='images/fleched_up.gif' alt='Fleche_droite' width='45px' height='420px'/>";
			}
			echo "</td></tr><tr><td colspan='3' class='utilisateursInverse' >";
			echo "<p style='width:615px' ><span style='float:left;'><tt>".check_ChaineDeCaracteresDownload($data2['text'])."</tt></span>";
				if( $admin == 1 ){
					echo "<span style='float:right;'><a id='navigationImage' href='javascript:;' onClick='AJAXSupprimerMediaConnexe(".$data2['id_buzz'].");'>Supprimer?</a></span>";
				}
				echo "</p>";
			echo "</td></tr></table>";			
			echo "</div>";
			//echo "</span>";
		}
		
		if($buzzSonore != NULL && $nbBUZZSonore != 0){
			echo "<div id='block_sonore' style='float:rigth;'>";
			//echo "<br><br><span id='block_sonore' align='right'>";
			cadreAlignCentrerDebut();
			while($data = mysql_fetch_row($buzzSonore)){;
				$tweet = recuperationTweetArtiste($data['0'],$data['3']);
				$data2 = mysql_fetch_assoc($tweet);
				echo "<br/><p class='utilisateurs' style='width:300px;'>"
					."<object type='application/x-shockwave-flash' id='mplayer476bf6c9c6489' data='lecteurMp3/mplayer.swf' wmode='transparent' height='24' width='290'><br><param name='movie' value='lecteurMp3/mplayer.swf'>"
					."<param name='FlashVars' value='playerID=mplayer476bf6c9c6489&amp;bg=0xF8F8F8&amp;leftbg=0xebebeb&amp;lefticon=0x666666&amp;rightbg=0xAAAAAA&amp;rightbghover=0xBBBBBB&amp;righticon=0xFFFFFF&amp;righticonhover=0xFFFFFF&amp;text=0x4f5458&amp;slider=0xAAAAAA&amp;track=0xFFFFFF&amp;border=0x666666&amp;loader=0xebebeb&amp;soundFile=".SVNRADIEURAE_PATH.$data2['son']."'><param name='quality' value='high'><param name='menu' value='false'><param name='wmode' value='transparent'></object>"			
					."<br/>"
					."<span style='float:left;'><b>".check_ChaineDeCaracteresDownload($data2['nomMp3'])."</b></span>";
					if($admin == 1){
						echo "<span style='float:right;'><a id='navigationSupprimerLien' href='javascript:;' onClick='AJAXSupprimerMediaSonore(0,{$data2['id_buzz']});'>[X]</a></span>";
					}
					echo "<br/><tt>".check_ChaineDeCaracteresDownload($data2['text'])."</tt></p><br/>";
			}
			if($nbBUZZSonore > 7){
			echo "<br/><p class='utilisateurs' style='width:300px;'><a id='naviguationLienConnexeSuivant' href='javascript:;' onClick='AJAXChangerMediasSonores(7);'> Suite</a></p>";
			}
			
			cadreAlignCentrerFin();
			echo "</div>";
			//echo "</span>";
		}


		if($buzzImage != NULL && $nbBUZZImage != 0){
			$data = mysql_fetch_row($buzzImage);
			$tweet = recuperationTweetArtiste($data['0'],$data['3']);
			$data2 = mysql_fetch_assoc($tweet);
			
			echo "<div style='clear:left; 'id='block_image'>";
			cadreAlignCentrerDebut();
			echo "<center><p style='background-color: #BBB;'><br/><img src='".SVNRADIEURAE_PATH.$data2['image']."' alt='".$data2['nomImage']."'/><br/><br/>"
			."<span style='float:left;'>&lt;&lt;&lt;&lt;</span>"
			."<span style='float:center;'><tt>".check_ChaineDeCaracteresDownload($data2['text'])."</tt>";
			if( $admin == 1 ){
					echo "&nbsp;&nbsp;<a id='navigationImage' href='javascript:;' onClick='AJAXSupprimerImage(".$data2['id_buzz'].");'>Supprimer?</a>";
			}
			echo "</span>";
			if($nbBUZZImage > 1){
				$idTweetSuivant = recuperationProchainBUZZArtiste($data['0'],$data['1'],$data['3']);
				$data = mysql_fetch_row($idTweetSuivant);
				echo "<span style='float:right;'><a id='navigationImage' href='javascript:;' onClick='AJAXChangerImage(".$data[0].");'>&gt;&gt;&gt;&gt;</a></span>";
			}else{
				echo "<span style='float:right;'>&gt;&gt;&gt;&gt;</span>";
			}
			echo "</p></center>";
			cadreAlignCentrerFin();
			echo "</div>";
		}
		
		
		
	}else{
		//Associations et Groupes
		
		
	}
}