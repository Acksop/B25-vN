<?php
session_start();
include_once('../scriptPHP/connectionBDD.php');
include_once('../scriptPHP/chaineDeCaracteres.php');

//quel est le lib a changer?
$ancre = '#ancre_formulaire';
if(isset($_POST['nom'])){
	$nom = check_ChaineDeCaracteresUpload($_POST['nom']);
	$nom = HTML_ChaineDeCaracteres($_POST['nom']);
	modifierInfoArtiste($nom,'nom',$_SESSION['id_utilisateur']);
}else if(isset($_POST['description'])){
	$description = check_ChaineDeCaracteresUpload($_POST['description']);
	$description = HTML_ChaineDeCaracteres($_POST['description']);
	modifierInfoArtiste($description,'description',$_SESSION['id_utilisateur']);
}else if(isset($_POST['telephone'])){
	$telephone = check_ChaineDeCaracteresUpload($_POST['telephone']);
	$telephone = HTML_ChaineDeCaracteres($_POST['telephone']);
	modifierInfoArtiste($telephone,'telephone',$_SESSION['id_utilisateur']);
}else if(isset($_POST['voir_telephone'])){
	($_POST['voir_telephone']==0)?$voir_telephone=1:$voir_telephone=0;
	modifierInfoArtiste($voir_telephone,'voir_telephone',$_SESSION['id_utilisateur']);
}else if(isset($_POST['email'])){
	$email = check_ChaineDeCaracteresUpload($_POST['email']);
	$email = HTML_ChaineDeCaracteres($_POST['email']);
	modifierInfoArtiste($email,'email',$_SESSION['id_utilisateur']);
}else if(isset($_POST['pseudo'])){
	$pseudo = check_ChaineDeCaracteresUpload($_POST['pseudo']);
	$pseudo = HTML_ChaineDeCaracteres($_POST['pseudo']);
	modifierInfoArtiste($pseudo,'pseudo',$_SESSION['id_utilisateur']);
}else if(isset($_POST['prenom'])){
	$prenom = check_ChaineDeCaracteresUpload($_POST['prenom']);
	$prenom = HTML_ChaineDeCaracteres($_POST['prenom']);
	modifierInfoArtiste($prenom,'prenom',$_SESSION['id_utilisateur']);
}else if(isset($_POST['siteInterWeb'])){
	$siteInterWeb = check_ChaineDeCaracteresUpload($_POST['siteInterWeb']);
	$siteInterWeb = HTML_ChaineDeCaracteres($_POST['siteInterWeb']);
	modifierInfoArtiste($siteInterWeb,'siteInterWeb',$_SESSION['id_utilisateur']);
}else if(isset($_POST['site_web_only'])){
	($_POST['site_web_only']==0)?$site_web_only=1:$site_web_only=0;
	modifierInfoArtiste($site_web_only,'site_web_only',$_SESSION['id_utilisateur']);
}else if(isset($_POST['voir_courriel'])){
	($_POST['voir_courriel']==0)?$voir_courriel=1:$voir_courriel=0;
	modifierInfoArtiste($voir_courriel,'voir_courriel',$_SESSION['id_utilisateur']);
}else if(isset($_POST['voir_tweets'])){
	($_POST['voir_tweets']==0)?$voir_tweets=1:$voir_tweets=0;
	modifierInfoArtiste($voir_tweets,'voir_tweets',$_SESSION['id_utilisateur']);
	$ancre = '#ancre_tweet';
}else if(isset($_POST['affichage_tweets'])){
	($_POST['affichage_tweets']==0)?$affichage_tweets=1:$affichage_tweets=0;
	modifierInfoArtiste($affichage_tweets,'affichage_tweets',$_SESSION['id_utilisateur']);
	$ancre = '#ancre_tweet';
}
	header("location: ../index.php?page=compte{$ancre}");

?>
