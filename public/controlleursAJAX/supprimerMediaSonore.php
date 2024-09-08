<?php
header("Content-Type: text/plain");
include "../../localisation_Domaines_externes_B25.php";
include("../scriptPHP/connectionBDD.php");
include("../scriptPHP/arrondis.php");

$data = recuperationTweetArtiste($_GET['id'],2);
$data = mysql_fetch_assoc($data);
$adresseOriginal = SVNRADIEURAE_DIR.$data['son'];
$adresse = explode("/", $data['son']);
$nomMp3 = array_pop($adresse);
$adresseCopie = SVNRADIEURAE_DIR."upload_utilisateurs/TEMP/".$nomMp3;
copy($adresseOriginal,$adresseCopie);
unlink($adresseOriginal);

suppressionTweetArtiste($_GET['id'],2);
$plusDMedias = FALSE;

$id_artiste = $_GET['idA'];
$nbMediaSonore = recuperationNbBUZZArtiste($id_artiste,2);

$pageCourante = $_GET['nb'];

if($nbMediaSonore == 0){
	$plusDMedias = TRUE;
}elseif($nbMediaSonore == $pageCourante){
	$pageCourante -= 7; 
}

$buzzSonore = recuperation7DerniersBUZZArtiste($id_artiste,2,$pageCourante);
if($plusDMedias == FALSE){
	cadreAlignCentrerDebut();
	while($data = mysql_fetch_row($buzzSonore)){;
		$tweet = recuperationTweetArtiste($data['0'],$data['3']);
		$data2 = mysql_fetch_assoc($tweet);
		echo "<br/><p class='utilisateurs' style='width:300px;'>"
			."<object type='application/x-shockwave-flash' id='mplayer476bf6c9c6489' data='lecteurMp3/mplayer.swf' wmode='transparent' height='24' width='290'><br><param name='movie' value='lecteurMp3/mplayer.swf'>"
			."<param name='FlashVars' value='playerID=mplayer476bf6c9c6489&amp;bg=0xF8F8F8&amp;leftbg=0xebebeb&amp;lefticon=0x666666&amp;rightbg=0xd20560&amp;rightbghover=0x2c7d9c&amp;righticon=0xFFFFFF&amp;righticonhover=0xFFFFFF&amp;text=0x4f5458&amp;slider=0xd20560&amp;track=0xFFFFFF&amp;border=0x666666&amp;loader=0xebebeb&amp;soundFile=".SVNRADIEURAE_PATH.$data2['son']."'><param name='quality' value='high'><param name='menu' value='false'><param name='wmode' value='transparent'></object><br/><span style='float:left;'><b>"			
			.check_ChaineDeCaracteresDownload($data2['nomMp3'])."</b></span>";
			if($_GET['abs'] == 1){
				echo "<span style='float:right;'><a id='navigationSupprimerLien' href='javascript:;' onClick='AJAXSupprimerMediaSonore({$pageCourante},{$data2['id_buzz']});'>[X]</a></span>";
			}
			echo "<br/><tt>".check_ChaineDeCaracteresDownload($data2['text'])."</tt></p><br/>";
	}

	if($pageCourante >= 7){
		$pagePrecedente = $pageCourante - 7;
		echo "<br/><p class='utilisateurs' style='width:300px;'><a id='navigationLienConnexeRetour' href='javascript:;' onClick='AJAXChangerMediasSonores({$pagePrecedente});'> Retour</a></p>";
	}
	if($nbMediaSonore > $pageCourante + 7){
		$pageSuivante = $pageCourante + 7;
		echo "<br/><p class='utilisateurs' style='width:300px;'><a id='navigationLienConnexeSuite' href='javascript:;' onClick='AJAXChangerMediasSonores({$pageSuivante});'> Suite</a></p>";
	}
	cadreAlignCentrerFin();
}
?>
