function FermerFormulaireImage() {
  if (FenetreInsertionImage != null && !FenetreInsertionImage.closed) FenetreInsertionImage.close();
}
function FermerFormulaireNews() {
  if (FenetreChoix != null && !FenetreChoix.closed) FenetreChoix.close();
}
function FermerFormulaireMp3() {
  if (FenetreInsertionMp3 != null && !FenetreInsertionMp3.closed) FenetreInsertionMp3.close();
}
function AfficheFormTelechargement(){
document.getElementById("formulaire").style.display='none';
document.getElementById("telechargementEnCours").style.display='block';
}
