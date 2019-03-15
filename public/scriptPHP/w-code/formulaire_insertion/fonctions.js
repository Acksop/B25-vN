function FermerFormulaireImage() {
  if (FenetreInsertionImage != null && !FenetreInsertionImage.closed) FenetreInsertionImage.close();
}
function FermerFormulaireNews() {
  if (FenetreChoix != null && !FenetreChoix.closed) FenetreChoix.close();
}
function FermerFormulaireMp3() {
  if (FenetreInsertionMp3 != null && !FenetreInsertionMp3.closed) FenetreInsertionMp3.close();
}
function FermerFormulaireVideo() {
	  if (FenetreInsertionVideo != null && !FenetreInsertionVideo.closed) FenetreInsertionVideo.close();
	}

function AfficheFormTelechargement(){
document.getElementById("formulaire").style.display='none';
document.getElementById("telechargementEnCours").style.display='block';
}

//traitement aasynchrone PHP>HTML>JAVASCRIPT>AJAX>PHP
//Cette fonction utilise le PECL uploadprogress
// see : http://blog.debrouillonet.org/TIC/index.php/post/2010/08/03/test-hlc
// and : http://stackoverflow.com/questions/16770187/php-pecl-uploadprogress-status

function AfficheFormTelechargementVideo( id ){
	document.getElementById("formulaire").style.display='none';
	document.getElementById("telechargementEnCours").style.display='block';
	LancerProgressionUpload();
	//var timerUpload=setInterval('EnvoyerUpload()', 5);
	}