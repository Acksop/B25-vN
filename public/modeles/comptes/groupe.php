<?php
echo "<script src='scriptJS/afficherCacherDIV.js' type='text/javascript'></script>";

$albums = recuperationAlbumGroupe($_SESSION['id_utilisateur']);
$album = array(	'id_album' => '0',
				'image' => '',
				'libelle' => '',
				'description' => '',
				'annee' => '',
				'style' => '');

//--- LE LOGO - Début
echo "<a name='ancre_logo'/>";
echo "<script language='javascript'>"
	."
	function AfficheBanniereDL(){
		cacherDIV('ajoutLOGO');
		afficherDIV('BanDL');
	}
	function AfficheFormLOGO(){
		cacherDIV('assocLOGO');
		cacherDIV('btn_modifierLOGO');
		afficherDIV('ajoutLOGO');
	}
	function AfficheLogo(){
		cacherDIV('ajoutLOGO');
		afficherDIV('assocLOGO');
		afficherDIV('btn_modifierLOGO');
	}
	btn_modif_down = new Image();
	btn_modif_down = 'images/picto-modifier_down.gif';
	btn_modif_up = new Image();
	btn_modif_up = 'images/picto-modifier_up.gif';
	btn_modif_hover = new Image();
	btn_modif_hover = 'images/picto-modifier_hover.gif';
	btn_suppr_down = new Image();
	btn_suppr_down = 'images/picto-supprimer_down.gif';
	btn_suppr_up = new Image();
	btn_suppr_up = 'images/picto-supprimer_up.gif';
	btn_suppr_hover = new Image();
	btn_suppr_hover = 'images/picto-supprimer_hover.gif';
	
	</script>
	";
echo "<div class='conteneurGrand'>"
	."<h2 class='legende'>Logo-Type"
	."<div id='btn_modifierLOGO' class='btn' style='float:left;'  onClick='AfficheFormLOGO();'><img id='btn' style='float:left;' src='images/picto-modifier_up.gif' onMouseOver='javascript:this.src=btn_modif_hover;' onMouseOut='javascript:this.src=btn_modif_up;' onMouseDown='javascript:this.src=btn_modif_down;'></div>"
	."</h2><br />";
echo "<div class='conteneurGrandInterieur' id='ajoutLOGO' ";
if($descriptif['logo'] != ''){
	echo "style='display:none;'><h3 class='legende'> Changer de LogoType:</h3>";
}else{
	echo "><h3 class='legende'> Ajouter le logo:</h3>";
}
echo "<form enctype='multipart/form-data' action='controlleurs/traitementAssociationAjoutLOGO.php' method='POST'>"
	."<input type='hidden' name='MAX_FILE_SIZE' value='2097152'/>"
	."<input type='file' size='20' name='Image' class='tweet' />(max 2Mo)"
	."<br/>"
	."<span style='float:right;'>";
if($descriptif['logo'] != ''){
	echo "<input type='submit' value='Modifier' class='tweet' onClick='AfficheBanniereDL()'/>"
	."&nbsp;"
	."<input type='button' value='[Annuler]' class='tweetReset' onClick='AfficheLogo()' />";
}else{
	echo "<input type='submit' value='Ajouter' class='tweet' onClick='AfficheBanniereDL()'/>";
}
echo "</span>"
	."<input type='hidden' name='id_utilisateur' value='".$_SESSION['id_utilisateur']."'/>"
	."<input type='hidden' name='type' value='".$_SESSION['type_compte']."'/>"
	."</form>"
	."</div>"
	."<div id='BanDL' style='background: gray; display:none;'><img src='images/upload.gif' height='120px' width='500px' alt='banni�re de t�l�chargements'/></div>";
if($descriptif['logo'] != ''){
	echo "<div id='assocLOGO' class='conteneurGrandInterieur'><img src='".SVNRADIEURAE_PATH.$descriptif['logo']."' alt='{$association['nom']}'/></div>";
}
echo "</div>";

//-- LE LOGO - Fin

//-- LA DESCRIPTION - Début
echo "<a name='ancre_descriptif'/>";
ecrireScriptJSTinyMCE();
echo "<script language='javascript'>"
	."
	function AfficheFormDescriptif(){
		cacherDIV('descriptifAsso');
		cacherDIV('btn_descriptif');
		afficherDIV('ajoutDescriptif');
	}
	function AfficheDescriptif(){
		cacherDIV('ajoutDescriptif');
		afficherDIV('descriptifAsso');
		afficherDIV('btn_descriptif');
	}				
	</script>
	";	

if($descriptif['descriptif'] == '' ){
	$drapeauAjout = TRUE;
	$descriptif_asso = "";
}else{
	$descriptif_asso = check_ChaineDeCaracteresDownload($descriptif['descriptif']);
	$drapeauAjout = FALSE;
}
echo "<div class='conteneurGrand'>"
	."<h2 class='legende'>Descriptif / Mission"
	."<div id='btn_descriptif' class='btn' style='float:left;' onClick='AfficheFormDescriptif();'><img alt='Changer descriptif?' style='float:left;' src='images/picto-modifier_up.gif' onMouseOver='javascript:this.src=btn_modif_hover;' onMouseOut='javascript:this.src=btn_modif_up;' onMouseDown='javascript:this.src=btn_modif_down;'></div>"
	."</h2><br />";

echo "<div id='ajoutDescriptif' class='conteneurGrandInterieur' ";
if($drapeauAjout){
	echo ">";
	echo "<h3 class='legende'>Ajouter un descriptif:</h3>";
}else{
	echo " style='display:none;'>";
	echo "<h3 class='legende'>Modifier le descriptif:</h3>";
}
echo "<form method='post' action='controlleurs/traitementAssociationAjoutDescriptif.php'>";
echo "<!-- Gets replaced with TinyMCE, remember HTML in a textarea should be encoded -->"
	."<textarea id='elm1' name='elm1' style='width: 100%; height: 400px;'>"
	.$descriptif_asso
	."</textarea>"
	."<br/>"
	."<span style='float:right;'>";
	if($drapeauAjout){					
		echo "<input type='submit' name='save' class='tweet' value='[Valider]' />";
	}else{
		echo "<input type='submit' name='save' class='tweet' value='[Modifier]' />"
		."&nbsp;"
		."<input type='button' value='[Annuler]' class='tweetReset' onClick='AfficheDescriptif()' />";
	}
	echo "</span></form>"
	."</div>";
if(!$drapeauAjout){
	echo "<div id='descriptifAsso' class='utilisateurs' style='padding:10px;margin:10px;'>{$descriptif_asso}</div>";
}
	echo "</div>";

//-- LA DESCRIPTION - Fin
echo "<br /><br /><br /><br />";
	
//--- LES ALBUMS - Début

echo "<script type='text/javascript'>"
		."
		function AfficheBanniereDL_ALBUM(num){
			var DIV1 = 'ajoutALBUM_' + num;
			var DIV2 = 'ALBUM_' + num;
			var DIV3 = 'BanDL_ALBUM_' + num;
			cacherDIV(DIV1)
			cacherDIV(DIV2);
			afficherDIV(DIV3);
		}
		function AfficheFormALBUM(num){
			var DIV1 = 'ALBUM_' + num;
			var DIV2 = 'btn_modifierALBUM_' + num;
			var DIV3 = 'ajoutALBUM_' + num; 
			cacherDIV(DIV1);
			cacherDIV(DIV2);
			afficherDIV(DIV3);
		}
		function AfficheALBUM(num){
			var DIV1 = 'ALBUM_' + num;
			var DIV2 = 'btn_modifierALBUM_' + num;
			var DIV3 = 'ajoutALBUM_' + num;
			cacherDIV(DIV3);
			afficherDIV(DIV1);
			afficherDIV(DIV2);
		}
		</script>
		";
//Boucle pour la création et l'affichage des album du groupe ou musicien
$i=0;
echo "<a name='ancre_albums'></a>";
echo "<div class='conteneurGrandArticle'>";
do{
	$j = $i%3;
	if ($j == 0){
		echo "<div class='conteneurLigneArticle'>";
	}
	echo "<div class='conteneurArticle'>"
		."<a name='ancre_album_{$album['id_album']}'></a>"
		."<h2 class='legende'>";
		if($i == 0){
			echo "Mes Albums";
		}else{
			echo "Album n&deg;{$i}";
				echo "<div id='btn_modifierALBUM_{$album['id_album']}' class='btn' style='float:left;'  onClick='AfficheFormALBUM({$album['id_album']});'><img id='btn' style='float:left;' src='images/picto-modifier_up.gif' onMouseOver='javascript:this.src=btn_modif_hover;' onMouseOut='javascript:this.src=btn_modif_up;' onMouseDown='javascript:this.src=btn_modif_down;'></div>";
		}
	echo "</h2><br />";
	echo "<div class='conteneurArticleInterieur' id='ajoutALBUM_{$album['id_album']}' ";
	if($album['image'] != ''){
		echo "style='display:none;'><h3 class='legende'> Modifier l'Article:</h3>";
	}else{
		if($i == 0){
			echo "><h3 class='legende'> Ajouter Un Album:</h3>";
		}else{
			echo "><h3 class='legende'> Modifier l'Album:</h3>";
		}
	}
	echo "<form enctype='multipart/form-data' action='controlleurs/traitementGroupesAjoutAlbum.php' method='POST'>"
		."<p class='post' style='float:right;'>(max 10Mo)</p><p class='titre' style='width:250px;'>Couverture de L'Album :<br />"
		."<input type='hidden' name='MAX_FILE_SIZE' value='10485760'/>"
		."<input type='file' size='14' name='image' class='tweet' />"
		."<p class='titre' style='width: 250px;'>Titre de L'Album : "
		."<input type='text' size='25' name='libelle' class='tweet' value='{$album['libelle']}'/>"
		."</p>"
		."<p class='titre'>Description:<center>"
		."<textarea rows='6' cols='32' name='description' class='tweet' />"
		.$album['description']
		."</textarea></center></p>"
		."<p class='titre' style='float:right; width:250px;'><span style='float:right;'>Style Musical :"
		."<input type='text' size='50' name='style' class='tweet' style='width:100px;' value='{$album['style']}'/>"
		."</span>"
		."<br /><br /><span style='float:right;'>Ann&eacute;e :"
		."<input type='text' size='4' name='annee' class='tweet' style='width:50px;' value='{$album['annee']}'/>"
		."</span></p><br /><br /><br /><br /><br />"
		."<span style='clear:right; float:right;'>";
	if($album['image'] != ''){
		echo "<input type='submit' value='Modifier' class='tweet' onClick='AfficheBanniereDL_ALBUM({$album['id_album']})'/>"
		."&nbsp;"
		."<input type='button' value='[Annuler]' class='tweetReset' onClick='AfficheALBUM({$album['id_album']})' />";
	}else{
		echo "<input type='submit' value='Ajouter' class='tweet' onClick='AfficheBanniereDL_ALBUM({$album['id_album']})'/>";
	}
	echo "</span>"
		."<input type='hidden' name='id_utilisateur' value='".$_SESSION['id_utilisateur']."'/>";
	if($i != 0){
		echo "<input type='hidden' name='id_album' value='".$album['id_album']."'/>";
	}
	echo "<input type='hidden' name='type' value='".$_SESSION['type_compte']."'/>"
		."</form>";
	if($album['libelle'] != '' || $album['description'] != '' || $album['annee'] != '' || $album['style'] != '' || $album['image'] != ''){
		echo "<form action='controlleurs/traitementSuppressionAlbumGroupe.php' method='POST'>"
			."<input type hidden name='id_album' value='{$album['id_album']}' />"
			."&nbsp;"
			."<input type='submit' value='Supprimer' class='tweet' />"
			."</form>";
	}
	echo "</div>"
		."<div id='BanDL_ALBUM_{$album['id_album']}' style='background: gray; display:none;'><img src='images/upload.gif' height='120px' width='500px' alt='banniere de telechargements'/></div>";
	if($album['image'] != ''){
		echo "<div id='ALBUM_{$album['id_album']}' class='conteneurArticleInterieur'>"
			."<center><img src='".SVNRADIEURAE_PATH.$album['image']."' alt='{$album['libelle']}'/>"
			."<p class='titre' align='center'>{$album['libelle']}</p>"
			."<p class='article'>{$album['description']}</p>";
		
		$musiques = recuperationMusiquesAlbum($album['id_album']);
		while ($musique = mysql_fetch_assoc($musiques)){

			echo "<form style='clear:both;' name='supprimer_musique_{$musique['id_musique']}' action='controlleurs/traitementSuppressionMusiqueAlbum.php' method='GET'>";
			echo "<p class='utilisateurs' style='position: relative; left: -25px; width: 290px;'>"
				."<object type='application/x-shockwave-flash' id='mplayer476bf6c9c6489' data='lecteurMp3/mplayer.swf' wmode='transparent' height='24' width='290'><br><param name='movie' value='lecteurMp3/mplayer.swf'>"
				."<param name='FlashVars' value='playerID=mplayer476bf6c9c6489&amp;bg=0xF8F8F8&amp;leftbg=0xebebeb&amp;lefticon=0x666666&amp;rightbg=0xAAAAAA&amp;rightbghover=0xBBBBBB&amp;righticon=0xFFFFFF&amp;righticonhover=0xFFFFFF&amp;text=0x4f5458&amp;slider=0xAAAAAA&amp;track=0xFFFFFF&amp;border=0x666666&amp;loader=0xebebeb&amp;soundFile=".SVNRADIEURAE_PATH.$musique['musique']."'><param name='quality' value='high'><param name='menu' value='false'><param name='wmode' value='transparent'></object>";
				echo "<span style='float: right;'><input type='hidden' name='id' value='{$musique['id_musique']}' />";
				echo "<a href='#' onClick='document.forms[";
				echo '"supprimer_musique_'.$musique['id_musique'].'"';
				echo "].submit();'>[X]</a></span>";
				echo "<span style='float: center;'><tt>".check_ChaineDeCaracteresDownload($musique['titre'])."</tt></span></p>";
				echo "</form>";				
		}
			
		//Formulaire d'ajout de TitreMusical
		echo "<form enctype='multipart/form-data' action='controlleurs/traitementGroupeAjoutAlbumMusique.php' method='POST'>"
		."<div class='conteneurAlbumInterieur'><br />"
		."<p class='post' style='float:right;'>(max 20Mo)</p><center><p class='titre' style='width: 250px;'><b>Ajout d'un titre musical : </b>"
		."<input type='hidden' name='MAX_FILE_SIZE' value='20971520'/>"
		."<input type='hidden' name='id_album' value='{$album['id_album']}'/>"
		."<input type='file' size='10' name='Musique' class='tweet'/></p></center>"
		."<span class='titre' width:290px;'>Titre et/ou Commentaire(s) :<br/>"
		."<input type='text' placeholder='ex: Nom de mon morceau' class='tweet' name='titre' size='20'/></span>"
		."<span style='clear:right; float:right;'><br /><input type='submit' value='Ajouter' class='btn_modif' onClick='AfficheBanniereDL_ALBUM({$album['id_album']})'/></span>"
		."<br /><br /></div></form>";
			
		echo "<p class='titre' style='float:right; width: 250px'>{$album['style']} - Ann&eacute;e {$album['annee']}&nbsp;</p>"
			."<br /><br /><br />"
			."</center>"
			."</div>";
	}
echo "</div>";
if ($j == 2){
	echo "</div>";
	}
$i++;
}while($album = mysql_fetch_assoc($albums));
if ($j !== 2){
	echo "</div>";
	}
echo "</div>";
//-- LES ALBUMS - Fin
	
	