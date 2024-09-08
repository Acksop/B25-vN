<?php

include_once('date.php');
include_once('chaineDeCaracteres.php');
include('requeteBDD.php');

function inscriptionSite($login,$pass,$repertoire,$courriel,$type,$date){
	$sql = "INSERT INTO utilisateur(pseudo,password,repertoirePersonnel,type_compte,dateInscription) VALUES('{$login}','{$pass}','{$repertoire}','{$type}','{$date}')";
	faireUneRequeteOffline($sql);
	$resultat = faireUneRequeteOffline("SELECT id_utilisateur FROM utilisateur WHERE pseudo = '".$login."' AND password = '".$pass."'");
	$tableauReponse = mysql_fetch_assoc($resultat);
	$usr_id = $tableauReponse['id_utilisateur'];
	if($type=='1'){
		faireUneRequeteOffline("INSERT INTO journalistes(email,id_utilisateur) VALUES('".$courriel."','".$usr_id."')");
	}else if($type=='2' || $type=='4'){
		faireUneRequeteOffline("INSERT INTO artistes(email,id_utilisateur) VALUES('".$courriel."','".$usr_id."')");
	}else if($type=='3' || $type=='5'){
		faireUneRequeteOffline("INSERT INTO associations(email,id_utilisateur) VALUES('".$courriel."','".$usr_id."')");
	}
	return $usr_id;
}



function recuperationDialogue(){
//$sql = "SELECT * FROM Tchat ORDER BY id_dialogue DESC LIMIT 20";
$sql = "SELECT * FROM Tchat ORDER BY id_dialogue DESC";
return faireUneRequeteOffline($sql);
}


function insertionDialogue($corps){
//récuperation des preferences
$sql = "SELECT gueuloir FROM B25_preferences";
$req = faireUneRequeteOffLine($sql);
$preference_gueuloir = mysql_fetch_row($req);
//insertions du message
$heure=date("H");
$minutes=date("i");
$heure_insert = $heure.":".$minutes;
$message_insert = $corps;

$sql = "INSERT INTO Tchat(date,corpsDuTexte,valide) VALUES('".$heure_insert."','".check_ChaineDeCaracteresUpload(ajoutBaliseHREFText(HTML_ChaineDeCaracteres($message_insert)))."','".$preference_gueuloir[0]."')";
$req = faireUneRequeteOffline($sql);
return;
}

function RecuperationMethodeGueuloir(){
$sql = "SELECT gueuloir FROM B25_preferences";
$req = faireUneRequeteOffLine($sql);
$preference_gueuloir = mysql_fetch_row($req);
if($preference_gueuloir[0] == 0){
	return "<B>Gueuloir!</B>";
}else{
	return "<B>Tchat!</B>";
}
}

function recuperationNbNouveauxMessages(){
$sql = "SELECT id_dialogue FROM Tchat WHERE valide = '0' ORDER BY id_dialogue DESC";
$data = faireUneRequeteOffLine($sql);
return mysql_num_rows($data);
}

/**************************************************************************************************************************************************************ANNONCES*/


function calculCleMapAnnoncesUtilisateur($id_artiste){
	$sql = "SELECT cle FROM petiteAnnoncesEnLecture WHERE id_artiste='".$id_artiste."'";
	$req = faireUneRequeteOffLine($sql);
	$cle = 0;
	$itx = 1;
	while($data = mysql_fetch_assoc( $req )){
		$cle = $cle + ($itx*$data['cle']);
		$itx *= -1;
	}
	return $cle;
}

function calculCleMapAnnoncesEnAttentesUtilisateur($id_artiste){
	$sql = "SELECT cle FROM petiteAnnoncesEnValidations WHERE id_artiste='".$id_artiste."'";
	$req = faireUneRequeteOffLine($sql);
	$cle = 0;
	$itx = 1;
	while($data = mysql_fetch_assoc($req)){
		$cle = $cle + ($itx*$data['cle']);
		$itx *= -1;
	}
	return $cle;
}


function recuperationNbAnnoncesActivesUtilisateur($id_artiste){
	$sql = "SELECT * FROM petiteAnnoncesEnLecture WHERE id_artiste='".$id_artiste."'";
	$req = faireUneRequeteOffLine($sql);
	return mysql_num_rows($req);
}

function recuperationNbAnnoncesEnAttenteUtilisateur($id_artiste){
	$sql = "SELECT * FROM petiteAnnoncesEnValidations WHERE id_artiste='".$id_artiste."'";
	$req = faireUneRequeteOffLine($sql);
	return mysql_num_rows($req);
}

function recuperationNbAnnoncesAValider(){
	$sql = "SELECT * FROM petiteAnnoncesEnValidations";
	$req = faireUneRequeteOffLine($sql);
	return mysql_num_rows($req);
}

/***********************************************************************************************************************************************************ÉVÈNEMENTS*/


function calculCleMapEvenementsUtilisateur($id_association){
	$sql = "SELECT cle FROM evenementsActifs WHERE id_association='".$id_association."'";
	$req = faireUneRequeteOffLine($sql);
	$cle = 0;
	$itx = 1;
	while($data = mysql_fetch_assoc($req)){
		$cle = $cle + ($itx*$data['cle']);
		$itx *= -1;
	}
	return $cle;
}
function calculCleMapEvenementsEnAttentesUtilisateur($id_association){
	$sql = "SELECT cle FROM evenementsEnValidation WHERE id_association='".$id_association."'";
	$req = faireUneRequeteOffLine($sql);
	$cle = 0;
	$itx = 1;
	while($data = mysql_fetch_assoc($req)){
		$cle = $cle + ($itx*$data['cle']);
		$itx *= -1;
	}
	return $cle;
}
function calculCleMapEvenementEnAttenteDeValidations(){
	$sql = "SELECT cle FROM evenementsEnValidation ";
	$req = faireUneRequeteOffLine($sql);
	$cle = 0;
	$itx = 1;
	while($data = mysql_fetch_assoc($req)){
		$cle = $cle + ($itx*$data['cle']);
		$itx *= -1;
	}
	return $cle;
}

function recuperationNbEvenementsActivesUtilisateur($id_association){
	$sql = "SELECT * FROM evenementsActifs WHERE id_association='".$id_association."'";
	$req = faireUneRequeteOffLine($sql);
	return mysql_num_rows($req);
}

function recuperationNbEvenementsEnAttenteUtilisateur($id_association){
	$sql = "SELECT * FROM evenementsEnValidation WHERE id_association='".$id_association."'";
	$req = faireUneRequeteOffLine($sql);
	return mysql_num_rows($req);
}

function recuperationNbEvenementsAValider(){
	$sql = "SELECT * FROM evenementsEnValidation";
	$req = faireUneRequeteOffLine($sql);
	return mysql_num_rows($req);
}

/******************************************************************************************************************************************************************ARTICLES*/
function AjouterClickArticle($id){
	//compteur d'affichage des reactions � un article
	$sql = "SELECT nbClicks FROM articles WHERE id_article='{$id}'";
	$req = faireUneRequeteOffLine($sql);
	$data = mysql_fetch_row($req);
	$nbClick = $data[0] + 1;
	$sql = "UPDATE articles SET nbClicks='{$nbClick}' WHERE id_article='{$id}'";
	faireUneRequeteOffLine($sql);
	return;
}


function AjouterLectureArticleAfficher($id){
	//Compteur d'affichage
$sql = "SELECT nbLectures FROM articles WHERE id_article='{$id}'";
$req = faireUneRequeteOffLine($sql);
$data = mysql_fetch_row($req);
$nbLecture = $data[0] + 1;
$sql = "UPDATE articles SET nbLectures='{$nbLecture}' WHERE id_article='{$id}'";
faireUneRequeteOffLine($sql);
	//Compteur Visite unique (par IPs)
$sql = "SELECT * FROM articles_VisitesUniques WHERE id_article='{$id}' AND ip_visiteur='{$_SERVER['REMOTE_ADDR']}'";
$data = mysql_num_rows(faireUneRequeteOffLine($sql));
if($data == 0){
	$sql = "INSERT INTO articles_VisitesUniques(ip_visiteur,id_article) VALUES ('{$_SERVER['REMOTE_ADDR']}','{$id}')";
	faireUneRequeteOffLine($sql);
}

return;
}

function AfficheNbVisitesUniqueArticle($id){
	$sql = "SELECT ip_visiteur FROM articles_VisitesUniques WHERE id_article='{$id}'";
	$data = mysql_num_rows(faireUneRequeteOffline($sql));
	return $data;
}

function AfficheNbClicksArticle($id){
$sql = "SELECT nbClicks FROM articles WHERE id_article='".$id."'";
$req = faireUneRequeteOffLine($sql);
$data = mysql_fetch_row($req);
return $data[0];
}

function AfficheNbLectureArticle($id){
$sql = "SELECT nbLectures FROM articles WHERE id_article='".$id."'";
$req = faireUneRequeteOffLine($sql);
$data = mysql_fetch_row($req);
return $data[0];
return;
}

function recuperationNbArticles(){
$sql = "SELECT * FROM articles ORDER BY id_article";
$req = faireUneRequeteOffline($sql);
return mysql_num_rows($req);
}
function recuperationArticleLimitMinTotal($min){
$sql = "SELECT * FROM articles ORDER BY id_article DESC LIMIT ".$min.",4";
return faireUneRequeteOffline($sql);
}

function recuperationArticle(){
$sql = "SELECT * FROM articles ORDER BY id_article DESC LIMIT 4";
return faireUneRequeteOffline($sql);
}

function recuperationArticleParId($id){
$sql = "SELECT * FROM articles WHERE id_article = '".$id."'";
return faireUneRequeteOffline($sql);
}

function recuperationDernierArticle(){
$sql = "SELECT * FROM articles ORDER BY id_article DESC LIMIT 1";
return faireUneRequeteOffline($sql);
}

function recuperationNbArticlesValide($id_utilisateur){
$sql = "SELECT id_article FROM articles WHERE id_utilisateur='".$id_utilisateur."' ORDER BY id_article DESC";
$data = faireUneRequeteOffLine($sql);
return mysql_num_rows($data);
}

function recuperationArticleEcritParJournaliste($id_utilisateur){
$sql = "SELECT * FROM articles WHERE id_utilisateur='".$id_utilisateur."'";
return faireUneRequeteOffline($sql);
}

function recuperationArticlesEnValidation(){
$sql = "SELECT * FROM articlesEnValidations ORDER BY id_article DESC";
return faireUneRequeteOffline($sql);
}
function recuperationNbArticlesEnValidation(){
$sql = "SELECT id_article FROM articlesEnValidations ORDER BY id_article DESC";
$data = faireUneRequeteOffLine($sql);
return mysql_num_rows($data);
}

function recuperationArticlesEnAttente($id_utilisateur){
$sql = "SELECT * FROM articlesEnAttentes WHERE id_utilisateur = '".$id_utilisateur."' ORDER BY id_article DESC";
return faireUneRequeteOffline($sql);
}
function recuperationNbAutorisationsArticles($id_utilisateur){
$sql = "SELECT id_article FROM articlesEnAttentes WHERE id_utilisateur = '".$id_utilisateur."' ORDER BY id_article DESC";
$data = faireUneRequeteOffLine($sql);
return mysql_num_rows($data);
}

function suppressionArticle($id_article){
$sql = "DELETE FROM articles WHERE id_article = '".$id_article."'";
$req = faireUneRequeteOffline($sql);
return;
}
function suppressionArticleEnAttente($id_article){
$sql = "DELETE FROM articlesEnAttentes WHERE id_article = '".$id_article."'";
$req = faireUneRequeteOffline($sql);
return;
}
function suppressionArticleEnValidation($id_article){
$sql = "DELETE FROM articlesEnValidations WHERE id_article = '".$id_article."'";
$req = faireUneRequeteOffline($sql);
return;
}

function recuperationArticlePourModification($id_article){
$sql = "SELECT * FROM articles WHERE id_article = '".$id_article."'";
$req = faireUneRequeteOffline($sql);
return $req;
}
function recuperationArticleEnValidationPourModification($id_article){
$sql = "SELECT * FROM articlesEnValidations WHERE id_article = '".$id_article."'";
$req = faireUneRequeteOffline($sql);
return $req;
}
function recuperationArticleEnAttentePourModification($id_article){
$sql = "SELECT * FROM articlesEnAttentes WHERE id_article = '".$id_article."'";
$req = faireUneRequeteOffline($sql);
return $req;
}

function modificationArticle($id_article,$titre,$corps,$image){
$sql = "UPDATE articles SET image='".$image."', titre ='".check_ChaineDeCaracteresUpload($titre)."', corps ='".check_ChaineDeCaracteresUpload($corps)."' WHERE id_article = '".$id_article."'";
$req = faireUneRequeteOffline($sql);
return;
}

function correctionArticleEnValidation($id_article,$titre,$corps,$image){
$sql = "UPDATE articlesEnValidations SET image='".$image."', titre ='".check_ChaineDeCaracteresUpload($titre)."', corps ='".check_ChaineDeCaracteresUpload($corps)."' WHERE id_article = '".$id_article."'";
$req = faireUneRequeteOffline($sql);
return;
}

function correctionArticleEnAttente($id_article,$titre,$corps,$image){
$sql = "UPDATE articlesEnAttentes SET image='".$image."', titre ='".check_ChaineDeCaracteresUpload($titre)."', corps ='".check_ChaineDeCaracteresUpload($corps)."' WHERE id_article = '".$id_article."'";
$req = faireUneRequeteOffline($sql);
return;
}

function insertionArticleEnValidation($corps,$titre,$uid){
$heure_insert = AfficheDateArticle();
$titre_insert = HTML_ChaineDeCaracteres(check_ChaineDeCaracteresUpload($titre));
$article_insert = check_ChaineDeCaracteresUpload($corps);
$sql = "INSERT INTO articlesEnValidations(id_utilisateur,date,titre,corps,image) VALUES('$uid','$heure_insert','$titre_insert','$article_insert','carre-carre.jpg')";
$req = faireUneRequeteOffline($sql);
return;
}

function insertionArticleEnAttente($id_utilisateur,$corps,$titre,$image){
$heure_insert = AfficheDateArticle();
$titre_insert = HTML_ChaineDeCaracteres(check_ChaineDeCaracteresUpload($titre));
$article_insert = check_ChaineDeCaracteresUpload($corps);
$sql = "INSERT INTO articlesEnAttentes(id_utilisateur,date,titre,corps,image) VALUES('".$id_utilisateur."','".$heure_insert."','".$titre_insert."','".$article_insert."','".$image."')";
$req = faireUneRequeteOffline($sql);
return;
}

function insertionArticleAutoriser($id_article){
	$sql = "SELECT * FROM articlesEnAttentes WHERE id_article = '".$id_article."'";
	$req = faireUneRequeteOffline($sql);
	$data = mysql_fetch_assoc($req);
	$sql = "INSERT INTO articlesEnValidations(id_utilisateur,date,titre,corps,image) VALUES('".$data['id_utilisateur']."','".$data['date']."','".check_ChaineDeCaracteresUpload($data['titre'])."','".check_ChaineDeCaracteresUpload($data['corps'])."','".$data['image']."')";
	$req = faireUneRequeteOffline($sql);
	$sql = "DELETE FROM articlesEnAttentes WHERE id_article ='".$id_article."'";
	$req = faireUneRequeteOffline($sql);
	return;
}

function insertionValidationArticle($id_article){
	$sql = "SELECT * FROM articlesEnValidations WHERE id_article = '".$id_article."'";
	$req = faireUneRequeteOffline($sql);
	$data = mysql_fetch_assoc($req);
	$sql = "INSERT INTO articles(id_utilisateur,date,titre,corps,image) VALUES('".$data['id_utilisateur']."','".$data['date']."','".check_ChaineDeCaracteresUpload($data['titre'])."','".check_ChaineDeCaracteresUpload($data['corps'])."','".$data['image']."')";
	$req = faireUneRequeteOffline($sql);
	$sql = "DELETE FROM articlesEnValidations WHERE id_article ='".$id_article."'";
	$req = faireUneRequeteOffline($sql);
	return;
}

function CorrelationArticleJournaliste($id_utilisateur,$id_article){
	$sql = "SELECT id_utilisateur FROM articles WHERE id_article = '".$id_article."'";
	$req = faireUneRequeteOffLine($sql);
	$data = mysql_fetch_row($req);
	return $data[0] == $id_utilisateur;
}

function calculNbCommentairesArticle($id_article){
	$sql = "SELECT id_commentaire FROM articlesCommentaires WHERE id_article = '".$id_article."'";
	$req = faireUneRequeteOffLine($sql);
	return mysql_num_rows($req);
}

function recuperationValeurCommentaire($id_commentaire){
	$sql = "SELECT valeurCommentaire FROM articlesCommentaires WHERE id_commentaire ='".$id_commentaire."'";
	$req = faireUneRequeteOffLine($sql);
	$data = mysql_fetch_row($req);
	return $data[0];
}

function modifierValeurCommentaire($id_commentaire,$rate){
	$sql = "UPDATE articlesCommentaires SET valeurCommentaire = '".$rate."' WHERE id_commentaire='".$id_commentaire."'";
	$req = faireUneRequeteOffLine($sql);
	return;
}
/******************************************************************************************************************************************************************TWEET*/
function IncrementerLectureTweetArtiste($id){
$sql = "SELECT nb_affichage_tweet FROM artistes WHERE id_artiste='".$id."'";
$req = faireUneRequeteOffLine($sql);
$data = mysql_fetch_row($req);
$nbLecture = $data[0] + 1;
$sql = "UPDATE artistes SET nb_affichage_tweet='".$nbLecture."' WHERE id_artiste='".$id."'";
faireUneRequeteOffLine($sql);
return;
}
function ajouterBUZZArtiste($id,$type){
	$sql1 = "INSERT INTO artiste_BUZZ(id_artiste,type) VALUES ('".$id."','".$type."')";
	$sql2 = "SELECT id_buzz FROM artiste_BUZZ WHERE id_artiste = '".$id."' ORDER BY date DESC LIMIT 1";
	$req1 = faireUneRequeteOffline($sql1);
	$req2 = faireUneRequeteOffline($sql2);
	$data = mysql_fetch_row($req2);
	return $data[0];
}
function ajouterTweetTXTArtiste($id,$corps){
	$sql = "INSERT INTO artiste_tweet_txt(text,id_buzz) VALUES ('".$corps."','".$id."')";
	$req = faireUneRequeteOffLine($sql);
	return;
}
function ajouterTweetIMAGEArtiste($id,$corps,$image,$original,$nom){
	$sql = "INSERT INTO artiste_tweet_image(text,image,original,nomImage,id_buzz) VALUES ('".$corps."','".$image."','".$original."','".$nom."','".$id."')";
	$req = faireUneRequeteOffLine($sql);
	return;
}
function ajouterTweetMP3Artiste($id,$corps,$musique,$nom){
	$sql = "INSERT INTO artiste_tweet_son(text,son,nomMp3,id_buzz) VALUES ('".$corps."','".$musique."','".$nom."','".$id."')";
	$req = faireUneRequeteOffLine($sql);
	return;
}
function ajouterTweetMEDIAConnexeArtiste($id,$corps,$adresse,$code){
	$sql = "INSERT INTO artiste_tweet_video(text,adresseMedia,codeConnexe,id_buzz) VALUES ('".$corps."','".$adresse."','".$code."','".$id."')";
	$req = faireUneRequeteOffLine($sql);
	return;
}

function recuperationDesDerniersBUZZArtiste($idArtiste,$limit,$nb){
	$limitPlus = $limit + $nb;
	$sql = "SELECT * FROM artiste_BUZZ WHERE id_artiste = '".$idArtiste."' ORDER BY date DESC LIMIT {$limit},{$limitPlus}";
	$req = faireUneRequeteOffLine($sql);
	return $req;
}
function recuperation7DerniersBUZZArtiste($idArtiste,$typeBUZZ,$limit){
	$limitPlus = $limit + 7 ;
	$sql = "SELECT * FROM artiste_BUZZ WHERE id_artiste = '".$idArtiste."' AND type ='".$typeBUZZ."' ORDER BY date DESC LIMIT {$limit},{$limitPlus}";
	$req = faireUneRequeteOffLine($sql);
	return $req;
}

function recuperationDernierBUZZArtiste($idArtiste,$typeBUZZ){
	$sql = "SELECT * FROM artiste_BUZZ WHERE id_artiste = '".$idArtiste."' AND type ='".$typeBUZZ."' ORDER BY date DESC LIMIT 1";
	$req = faireUneRequeteOffLine($sql);
	return $req;
}

function recuperationPrecedentBUZZArtiste($idBUZZ,$idArtiste,$typeBUZZ){
	$sql = "SELECT * FROM artiste_BUZZ WHERE id_artiste = '".$idArtiste."' AND type ='".$typeBUZZ."' AND id_buzz > '".$idBUZZ."' ORDER BY date ASC LIMIT 1";
	$req = faireUneRequeteOffLine($sql);
	return $req;
}
function recuperationNbPrecedentBUZZArtiste($idBUZZ,$idArtiste,$typeBUZZ){
	$sql = "SELECT * FROM artiste_BUZZ WHERE id_artiste = '".$idArtiste."' AND type ='".$typeBUZZ."' AND id_buzz > '".$idBUZZ."'";
	$req = faireUneRequeteOffLine($sql);
	return mysql_num_rows($req);
}
function recuperationProchainBUZZArtiste($idBUZZ,$idArtiste,$typeBUZZ){
	$sql = "SELECT * FROM artiste_BUZZ WHERE id_artiste = '".$idArtiste."' AND type ='".$typeBUZZ."' AND id_buzz < '".$idBUZZ."' ORDER BY date DESC LIMIT 1";
	$req = faireUneRequeteOffLine($sql);
	return $req;
}
function recuperationNbProchainBUZZArtiste($idBUZZ,$idArtiste,$typeBUZZ){
	$sql = "SELECT * FROM artiste_BUZZ WHERE id_artiste = '".$idArtiste."' AND type ='".$typeBUZZ."' AND id_buzz < '".$idBUZZ."'";
	$req = faireUneRequeteOffLine($sql);
	return mysql_num_rows($req);
}

function recuperationNbBUZZTotalArtiste($idArtiste){
	$sql = "SELECT * FROM artiste_BUZZ WHERE id_artiste = '".$idArtiste."' ORDER BY date DESC ";
	$req = faireUneRequeteOffLine($sql);
	return mysql_num_rows($req);
}
function recuperationNbBUZZArtiste($idArtiste,$typeBUZZ){
	$sql = "SELECT * FROM artiste_BUZZ WHERE id_artiste = '".$idArtiste."' AND type ='".$typeBUZZ."' ORDER BY date DESC ";
	$req = faireUneRequeteOffLine($sql);
	return mysql_num_rows($req);
}


function recuperationTweetArtiste($id,$type){
	switch ($type){
		case 0;
			$sql = "SELECT * FROM artiste_tweet_txt WHERE id_buzz = '".$id."'";
		break;
		case 1:
			$sql = "SELECT * FROM artiste_tweet_image WHERE id_buzz = '".$id."'";
		break;
		case 2:
			$sql = "SELECT * FROM artiste_tweet_son WHERE id_buzz = '".$id."'";
		break;
		case 3:
			$sql = "SELECT * FROM artiste_tweet_video WHERE id_buzz = '".$id."'";
		break;
		default:
	}
	$req = faireUneRequeteOffLine($sql);
	return $req;
}
function suppressionTweetArtiste($id,$type){
	switch($type){
		case 0;
			$sql = "DELETE FROM artiste_tweet_txt WHERE id_buzz = '".$id."'";
		break;
		case 1:
			$sql = "DELETE FROM artiste_tweet_image WHERE id_buzz = '".$id."'";
		break;
		case 2:
			$sql = "DELETE FROM artiste_tweet_son WHERE id_buzz = '".$id."'";
		break;
		case 3:
			$sql = "DELETE FROM artiste_tweet_video WHERE id_buzz = '".$id."'";
		break;
		default:
	}
	$sql2 = "DELETE FROM artiste_BUZZ WHERE id_buzz ='".$id."'";
	faireUneRequeteOffLine($sql);
	faireUneRequeteOffLine($sql2);
	return 0;
}
function suppressionBUZZ($id){
	$sql = "SELECT type FROM artiste_BUZZ WHERE id_buzz ='".$id."'";
	$req = faireUneRequeteOffLine($sql);
	$data = mysql_fetch_row($req);
	$type = $data[0];
	switch($type){
		case 0;
			$sql = "DELETE FROM artiste_tweet_txt WHERE id_buzz = '".$id."'";
		break;
		case 1:
			$sql = "DELETE FROM artiste_tweet_image WHERE id_buzz = '".$id."'";
		break;
		case 2:
			$sql = "DELETE FROM artiste_tweet_son WHERE id_buzz = '".$id."'";
		break;
		case 3:
			$sql = "DELETE FROM artiste_tweet_video WHERE id_buzz = '".$id."'";
		break;
		default:
	}
	$sql2 = "DELETE FROM artiste_BUZZ WHERE id_buzz ='".$id."'";
	faireUneRequeteOffLine($sql);
	faireUneRequeteOffLine($sql2);
	return 0;
}



function ajouterBUZZAssociation($id,$type){
	$sql1 = "INSERT INTO association_BUZZ(id_artiste,type) VALUES ('".$id."','".$type."')";
	$sql2 = "SELECT id_buzz FROM association_BUZZ WHERE id_artiste = '".$id."' ORDER BY date DESC LIMIT 1";
	$req = faireUneRequeteOffline($sql1);
	$req = faireUneRequeteOffline($sql2);
	$data = mysql_fetch_row($req);
	return $data[0];
}
function ajouterTweetTXTAssociation($id,$corps){
	$sql = "INSERT INTO association_tweet_txt(text,id_buzz) VALUES ('".$corps."','".$id."')";
	$req = faireUneRequeteOffLine($sql);
	return;
}
function ajouterTweetIMAGEAssociation($id,$corps,$image,$original,$nom){
	$sql = "INSERT INTO association_tweet_image(text,image,original,nomImage,id_buzz) VALUES ('".$corps."','".$image."','".$original."','".$nom."','".$id."')";
	$req = faireUneRequeteOffLine($sql);
	return;
}
function ajouterTweetMP3Association($id,$corps,$musique,$nom){
	$sql = "INSERT INTO association_tweet_son(text,son,nomMp3,id_buzz) VALUES ('".$corps."','".$musique."','".$nom."','".$id."')";
	$req = faireUneRequeteOffLine($sql);
	return;
}
function ajouterTweetMEDIAConnexeAssociation($id,$corps,$adresse,$code){
	$sql = "INSERT INTO association_tweet_video(text,adresseMedia,codeConnexe,id_buzz) VALUES ('".$corps."','".$adresse."','".$code."','".$id."')";
	$req = faireUneRequeteOffLine($sql);
	return;
}

/******************************************************************************************************************************************************************DOSSIERS*/
function recuperationNbDossiersArchiver($id_utilisateur){
	$sql = "SELECT id_dossier FROM dossiers WHERE id_utilisateur = '{$id_utilisateur}'";
	return mysql_num_rows(faireUneRequeteOffline($sql));
}
function recuperationNbDossiersEnValidation($id_utilisateur){
	$sql = "SELECT id_dossier FROM dossiersEnValidations WHERE id_utilisateur = '{$id_utilisateur}'";
	return mysql_num_rows(faireUneRequeteOffline($sql));
}
function recuperationNbDossiersSauvegarder($id_utilisateur){
	$sql = "SELECT id_dossier FROM dossiersTemporaires WHERE id_utilisateur = '{$id_utilisateur}'";
	return mysql_num_rows(faireUneRequeteOffline($sql));
}
function recuperationNbDossierAValider(){
$sql = "SELECT * FROM dossiersEnValidations";
return mysql_num_rows(faireUneRequeteOffline($sql));
}

function recuperationDossierTemporaire($id){
$sql = "SELECT * FROM dossiersTemporaires WHERE id_dossier='".$id."'";
return faireUneRequeteOffline($sql);
}

function insertionDossierTemporaire($titre,$description,$corps,$bbcode,$date){
$sql = "INSERT INTO dossiersTemporaires(id_utilisateur,titre,date_Crea,date_Modif,description,corps,bbcode) VALUES('".$_SESSION['id_utilisateur']."','".$titre."','".$date."','".$date."','".$description."','".$corps."','".$bbcode."')";
faireUneRequeteOffline($sql);
$sql = "SELECT id_dossier FROM dossiersTemporaires WHERE date_Crea='".$date."' AND titre='{$titre}'";
return faireUneRequeteOffline($sql);
}

function modificationDossierTemporaire($id,$titre,$description,$corps,$bbcode,$date){
$sql = "UPDATE dossiersTemporaires SET titre = '".$titre."',date_Modif = '".$date."',description = '".$description."',corps = '".$corps."',bbcode = '".$bbcode."'WHERE id_dossier = '".$id."'";
faireUneRequeteOffline($sql);
return;
}

function modificationDossierEnValidation($id,$titre,$description,$corps,$bbcode,$date){
$sql = "UPDATE dossiersEnValidations SET titre = '".$titre."',date_Modif = '".$date."',description = '".$description."',corps = '".$corps."',bbcode = '".$bbcode."'WHERE id_dossier = '".$id."'";
faireUneRequeteOffline($sql);
return;
}

function modificationDossier($id,$titre,$description,$corps,$bbcode){
$sql = "UPDATE dossiers SET titre = '".$titre."',date_Modif = '".AfficheDateArticle()."',description = '".$description."',corps = '".$corps."',bbcode = '".$bbcode."'WHERE id_dossier = '".$id."'";
faireUneRequeteOffline($sql);
return;
}

function insertionDossierEnValidation($id_dossier){
	$sql = "SELECT * FROM dossiersTemporaires WHERE id_dossier = '".$id_dossier."'";
	$req = faireUneRequeteOffline($sql);
	$data = mysql_fetch_assoc($req);
	$sql = "INSERT INTO dossiersEnValidations(id_utilisateur,titre,date_Crea,date_Modif,date_miseEnValid,description,corps,bbcode) VALUES('".$data['id_utilisateur']."','".check_ChaineDeCaracteresUpload($data['titre'])."','".$data['date_Crea']."','".$data['date_Modif']."','".AfficheDateArticle()."','".check_ChaineDeCaracteresUpload($data['description'])."','".check_ChaineDeCaracteresUpload($data['corps'])."','".check_ChaineDeCaracteresUpload($data['bbcode'])."')";
	$req = faireUneRequeteOffline($sql);
	$sql = "DELETE FROM dossiersTemporaires WHERE id_dossier ='".$id_dossier."'";
	$req = faireUneRequeteOffline($sql);
	return;
}

function insertionValidationDossier($id_dossier){
	$sql = "SELECT * FROM dossiersEnValidations WHERE id_dossier = '".$id_dossier."'";
	$req = faireUneRequeteOffline($sql);
	$data = mysql_fetch_assoc($req);
	$sql = "INSERT INTO dossiers(id_utilisateur,titre,date_Crea,date_Modif,date_miseEnValid,date_Validation,description,corps,bbcode) VALUES('".$data['id_utilisateur']."','".check_ChaineDeCaracteresUpload($data['titre'])."','".$data['date_Crea']."','".$data['date_Modif']."','".$data['date_miseEnValid']."','".AfficheDateArticle()."','".check_ChaineDeCaracteresUpload($data['description'])."','".check_ChaineDeCaracteresUpload($data['corps'])."','".check_ChaineDeCaracteresUpload($data['bbcode'])."')";
	$req = faireUneRequeteOffline($sql);
	$sql = "DELETE FROM dossiersEnValidations WHERE id_dossier ='".$id_dossier."'";
	$req = faireUneRequeteOffline($sql);
	return;
}

function suppressionValidationDossier($id_dossier){
	$sql = "DELETE FROM dossiersEnValidations WHERE id_dossier = '".$id_dossier."'";
	faireUneRequeteOffline($sql);
	return;
}

function recuperationDossierAValider($id_dossier){
$sql = "SELECT * FROM dossiersEnValidations WHERE id_dossier = '".$id_dossier."'";
return faireUneRequeteOffline($sql);
}

function recuperationPremierDossierAValider(){
$sql = "SELECT * FROM dossiersEnValidations LIMIT 1";
return faireUneRequeteOffline($sql);
}

function recuperationDossieraAfficher(){
$sql = "SELECT * FROM dossiers WHERE visible = '1'";
return faireUneRequeteOffline($sql);
}

function recuperationDossier($id_dossier){
$sql = "SELECT * FROM dossiers WHERE id_dossier = '".$id_dossier."'";
return faireUneRequeteOffline($sql);
}
function recuperationDossierEnAttente($id_dossier){
$sql = "SELECT * FROM dossiersEnValidations WHERE id_dossier = '".$id_dossier."'";
return faireUneRequeteOffline($sql);
}

function ajouterLectureDossierAfficher($id_dossier){
$sql = "SELECT nbLecture FROM dossiers WHERE id_dossier ='".$id_dossier."'";
$data = mysql_fetch_row(faireUneRequeteOffline($sql));
$nb = $data[0]+1;
$sql = "UPDATE dossiers SET nbLecture = '".$nb."' WHERE id_dossier='".$id_dossier."'";
faireUneRequeteOffline($sql);
return;
}

function modificationDossierEnLecture($id_dossier){
$sql = "UPDATE dossiers SET visible = '0' WHERE visible ='1'";
faireUneRequeteOffline($sql);
$sql = "UPDATE dossiers SET visible = '1',date_misEnLigne='".AfficheDateArticle()."' WHERE id_dossier='".$id_dossier."'";
faireUneRequeteOffline($sql);
return;
}
/*********************************************************************************************************************************************************GUETTEUR SPÉCIAUX*/

function recuperationTypeCompteTest(){
$type = array("superUtilisateur","journaliste","artiste","association","artisans","groupe Musical");
$sql = "SELECT type_compte FROM utilisateur WHERE pseudo='' and password='' ";
$req = faireUneRequeteOffline($sql);
$data = mysql_fetch_row($req);
return $type[$data[0]];
}

function recuperationCorpsArticleEnValidation($id_article){
	$sql = "SELECT corps FROM articlesEnValidations WHERE id_article='".$id_article."'";
	$req = faireUneRequeteOffLine($sql);
	$data = mysql_fetch_row($req);
	return $data[0];
}

function recuperationTitreArticleEnValidation($id_article){
	$sql = "SELECT titre FROM articlesEnValidations WHERE id_article='".$id_article."'";
	$req = faireUneRequeteOffLine($sql);
	$data = mysql_fetch_row($req);
	return $data[0];
}

function recuperationCorpsArticleEnAttente($id_article){
	$sql = "SELECT corps FROM articlesEnAttentes WHERE id_article='".$id_article."'";
	$req = faireUneRequeteOffLine($sql);
	$data = mysql_fetch_row($req);
	return $data[0];
}

function recuperationTitreArticleEnAttente($id_article){
	$sql = "SELECT titre FROM articlesEnAttentes WHERE id_article='".$id_article."'";
	$req = faireUneRequeteOffLine($sql);
	$data = mysql_fetch_row($req);
	return $data[0];
}

function recuperationIdArtisteDepuisIdUtilisateur($id_utilisateur){
	$sql = "SELECT id_artiste FROM artistes WHERE id_utilisateur='".$id_utlisateur."'";
	$req = faireUneRequeteOffLine($sql);
	$data = mysql_fetch_row($req);
	return $data[0];
}

function recuperationAdresseCourrielDepuisArticleEnValidation($id_article){
	$sql = "SELECT id_utilisateur FROM articlesEnValidations WHERE id_article='".$id_article."'";
	$req = faireUneRequeteOffLine($sql);
	$data = mysql_fetch_row($req);
	$sql = "SELECT type_compte FROM utilisateur WHERE id_utilisateur='".$data[0]."'";
	$req = faireUneRequeteOffLine($sql);
	$data2 = mysql_fetch_row($req);
	switch($data2[0]){
		case 1:
		$sql = "SELECT email FROM journalistes WHERE id_utilisateur='".$data[0]."'";
		break;
		case 2:
		$sql = "SELECT email FROM artistes WHERE id_utilisateur='".$data[0]."'";
		break;
		case 3:
		$sql = "SELECT email FROM associations WHERE id_utilisateur='".$data[0]."'";
		break;	
	}
	$req = faireUneRequeteOffLine($sql);
	$data = mysql_fetch_row($req);
	return $data[0];
}

function recuperationUtilisateurArticleEnValidation($id_article){
	$sql = "SELECT id_utilisateur FROM articlesEnValidations WHERE id_article='".$id_article."'";
	$req = faireUneRequeteOffLine($sql);
	$data = mysql_fetch_row($req);
	return $data[0];
}

/*********************************************************************************************************************************************************GUETTEUR ARTICLES*/

function recuperationAuteur($id_utilisateur){
$sql = "SELECT type_compte FROM utilisateur WHERE id_utilisateur='".$id_utilisateur."'";
$data = mysql_fetch_row(faireUneRequeteOffline($sql));
switch ($data[0]){
	case 1:
		$sql = "SELECT surnom FROM journalistes WHERE id_utilisateur = '".$id_utilisateur."'";
		$req = faireUneRequeteOffline($sql);
		$data = mysql_fetch_row($req);
		return $data[0];
	break;
	case 2:
	case 4:
		$sql = "SELECT pseudo FROM artistes WHERE id_utilisateur = '".$id_utilisateur."'";
		$req = faireUneRequeteOffline($sql);
		$data = mysql_fetch_row($req);
		return $data[0];
	break;
	case 3:
	case 5:
		$sql = "SELECT nom FROM associations WHERE id_utilisateur = '".$id_utilisateur."'";
		$req = faireUneRequeteOffline($sql);
		$data = mysql_fetch_row($req);
		return $data[0];
	break;
	default:
		return "le Nain Connu.";
}
return;
}
function recuperationIdeologie($id_ideologie){
$sql = "SELECT libelle FROM Ideologies WHERE Ideologies.id_ideologie = '".$id_ideologie."'";
$req = faireUneRequeteOffline($sql);
$data = mysql_fetch_assoc($req);
return $data['libelle'];
}

function recuperationTheme($id_theme){
$sql = "SELECT libelle FROM Themes WHERE Themes.id_theme = '".$id_theme."'";
$req = faireUneRequeteOffline($sql);
$data = mysql_fetch_assoc($req);
return $data['libelle'];
}

/*ON LINE*******************************************************************************************************GUETTEUR ID anciennement pour la réorganisation de la BDD*/
//Old Functions -- Obsoletes                                           ----------------------------------------------------------------------//
//TODO(v5): Optimiser les scripts, par decoupage et verifications, aussi bien sur le graphisme (mon CSS est pourri) que sur le code(duplications)
function recuperationIDbillets_artistes($id_utilisateur){
$sql = "SELECT id_billet FROM billets_artistes WHERE id_utilisateur = '".$id_utilisateur."'";
$req = faireUneRequeteOnline($sql);
return $req;
}
function recuperationIDbillets_associations($id_utilisateur){
$sql = "SELECT id_billet FROM billets_associations WHERE id_utilisateur = '".$id_utilisateur."'";
$req = faireUneRequeteOnline($sql);
return $req;
}
function recuperationIDarticles_artistes($id_utilisateur){
$sql = "SELECT id_article FROM articles_artistes WHERE id_utilisateur = '".$id_utilisateur."'";
$req = faireUneRequeteOnline($sql);
return $req;
}
function recuperationIDarticles_associations($id_utilisateur){
$sql = "SELECT id_article FROM articles_associations WHERE id_utilisateur = '".$id_utilisateur."'";
$req = faireUneRequeteOnline($sql);
return $req;
}
//-----------                                                          -----------------------------------------------------------------------//

/*OFF LINE***************************************************************************************************************************************************GUETTEUR TOTAL*/

function recuperationIDartisteOffLine($id_utilisateur){
$sql = "SELECT id_artiste FROM artistes WHERE id_utilisateur = '".$id_utilisateur."'";
$req = faireUneRequeteOffline($sql);
$data = mysql_fetch_row($req);
return $data[0];
}

function recuperationIDassociationOffLine($id_utilisateur){
$sql = "SELECT id_association FROM associations WHERE id_utilisateur = '".$id_utilisateur."'";
$req = faireUneRequeteOffline($sql);
$data = mysql_fetch_row($req);
return $data[0];
}

function recuperationPseudoArtisteOuArtisanFromIDArtiste($id_artiste){
	$sql = "SELECT pseudo FROM artistes WHERE id_artiste = '".$id_artiste."'";
	$req = faireUneRequeteOffline($sql);
	$data = mysql_fetch_row($req);
	return $data[0];
}

function recuperationDescriptionArtisteOuArtisanFromIDArtiste($id_artiste){
	$sql = "SELECT description FROM artistes WHERE $id_artiste = '".$id_artiste."'";
	$req = faireUneRequeteOffline($sql);
	$data = mysql_fetch_row($req);
	return $data[0];
}
function recuperationNomAssociationOuGroupeFromIDAssociation($id_association){
	$sql = "SELECT nom FROM associations WHERE $id_association = '".$id_association."'";
	$req = faireUneRequeteOffline($sql);
	$data = mysql_fetch_row($req);
	return $data[0];
}

function recuperationDescriptionAssociationOuGroupeFromIDAssociation($id_association){
	$sql = "SELECT description FROM associations WHERE $id_association = '".$id_association."'";
	$req = faireUneRequeteOffline($sql);
	$data = mysql_fetch_row($req);
	return $data[0];
}

function recuperationInfoAsso($id){
$sql = "SELECT * FROM associations WHERE id_utilisateur = '".$id."'";
$req = faireUneRequeteOffline($sql);
return $req;
}

function recuperationInfoAssoFromID($id){
$sql = "SELECT * FROM associations WHERE id_association = '".$id."'";
$req = faireUneRequeteOffLine($sql);
return $req;
}

function recuperationInfoArtiste($id_artiste){
$sql = "SELECT * FROM artistes WHERE id_utilisateur = '".$id_artiste."'";
$req = faireUneRequeteOffline($sql);
return $req;
}

function recuperationInfoArtisteFromID($id_artiste){
$sql = "SELECT * FROM artistes WHERE id_artiste = '".$id_artiste."'";
$req = faireUneRequeteOffline($sql);
return $req;
}

function recuperationInfoJournaliste($id_artiste){
$sql = "SELECT * FROM journalistes WHERE id_utilisateur = '".$id_artiste."'";
$req = faireUneRequeteOffline($sql);
return $req;
}

function recuperationDescriptifArtisans($id){
	$sql = "SELECT * FROM artisans_descriptif WHERE id_artiste = '{$id}'";
	$req = faireUneRequeteOffLine($sql);
	return $req;
}

function modifierInfoAsso($valeur,$libelle,$id_asso){
$sql = "UPDATE associations SET ".$libelle." = '".$valeur."' WHERE id_utilisateur = '".$id_asso."'";
faireUneRequeteOffline($sql);
return;
}

function recuperationDescriptifAsso($id){
	$sql = "SELECT * FROM association_descriptif WHERE id_association = '{$id}'";
	$req = faireUneRequeteOffLine($sql);
	return $req;
}
function recuperationStatusAsso($id){
	$sql = "SELECT * FROM association_status WHERE id_association = '{$id}'";
	$req = faireUneRequeteOffLine($sql);
	return $req;
}
function recuperationMembresAsso($id){
	$sql = "SELECT * FROM association_membres WHERE id_association = '{$id}'";
	$req = faireUneRequeteOffLine($sql);
	return $req;
}
function recuperationLiensWebAsso($id){
	$sql = "SELECT * FROM association_liensWeb WHERE id_association = '{$id}'";
	$req = faireUneRequeteOffLine($sql);
	return $req;
}

function modifierLogoArtisans($image,$largeur,$hauteur,$id){
$id_artisans = recuperationIDartisteOffLine($id);
$sql = "SELECT * FROM artisans_descriptif WHERE id_artiste = '{$id_artisans}'";
$req = faireUneRequeteOffLine($sql);
$data = mysql_num_rows($req);
if($data == 1){
	$sql = "UPDATE artisans_descriptif SET logo = '{$image}' , logo_tailleX = {$largeur} , logo_tailleY = {$hauteur} WHERE id_artiste = '{$id_artisans}'";
}else{
	$sql = "INSERT INTO artisans_descriptif(id_artiste,logo,logo_tailleX,logo_tailleY) VALUES('{$id_artisans}','{$image}','{$largeur}','{$hauteur}')";
}
faireUneRequeteOffLine($sql);
return;
}

function modifierArticleArtisans($id_article,$image,$largeur,$hauteur,$libelle,$description,$prix,$id){
$id_artisans = recuperationIDartisteOffLine($id);
if($id_article !== ''){
	if($image == ''){
		$sql = "UPDATE artisans_articles SET libelle = '{$libelle}', description = '{$description}', prix = '{$prix}' WHERE id_article = '{$id_article}'";
	}else{
		$sql = "UPDATE artisans_articles SET image = '{$image}' , image_tailleX = '{$largeur}' , image_tailleY = '{$hauteur}', libelle = '{$libelle}', description = '{$description}', prix = '{$prix}' WHERE id_article = '{$id_article}'";
	}
}else{
	$sql = "INSERT INTO artisans_articles(id_artiste,image,image_tailleX,image_tailleY,libelle,description,prix) VALUES('{$id_artisans}','{$image}','{$largeur}','{$hauteur}','{$libelle}','{$description}','{$prix}')";
}
faireUneRequeteOffLine($sql);
return;
}

function recuperationArticlesArtisans($id_utilisateur){
$id_artisans = recuperationIDartisteOffLine($id_utilisateur);
$sql = "SELECT * FROM artisans_articles WHERE id_artiste = '{$id_artisans}'";
$req = faireUneRequeteOffLine($sql);
return $req;
}
function recuperationArticlesArtisansFromId($id){
$sql = "SELECT * FROM artisans_articles WHERE id_artiste = '{$id}'";
$req = faireUneRequeteOffLine($sql);
return $req;
}

function suppressionArticleArtisans($id_article){
$sql = "DELETE FROM artisans_articles WHERE id_article = '".$id_article."'";
$req = faireUneRequeteOffline($sql);
return;
}

function modifierAlbumGroupe($id_album,$image,$largeur,$hauteur,$libelle,$description,$annee,$style,$id){
$id_groupe = recuperationIDassociationOffLine($id);

if($id_album !== ''){
	if($image == ''){
		$sql = "UPDATE groupes_albums SET libelle = '{$libelle}', description = '{$description}', annee = '{$annee}', style = '{$style}' WHERE id_album = '{$id_album}'";
	}else{
		$sql = "UPDATE groupes_albums SET image = '{$image}' , image_tailleX = '{$largeur}' , image_tailleY = '{$hauteur}', libelle = '{$libelle}', description = '{$description}', annee = '{$annee}', style = '{$style}' WHERE id_album = '{$id_album}'";
	}
}else{
	$sql = "INSERT INTO groupes_albums(id_association,image,image_tailleX,image_tailleY,libelle,description,annee,style) VALUES('{$id_groupe}','{$image}','{$largeur}','{$hauteur}','{$libelle}','{$description}','{$annee}','{$style}')";
}

faireUneRequeteOffLine($sql);
return;
}

function recuperationAlbumGroupe($id_utilisateur){
$id_groupe = recuperationIDassociationOffLine($id_utilisateur);
$sql = "SELECT * FROM groupes_albums WHERE id_association = '{$id_groupe}'";
$req = faireUneRequeteOffLine($sql);
return $req;
}
function recuperationAlbumGroupeFromId($id){
$sql = "SELECT * FROM groupes_albums WHERE id_association = '{$id}'";
$req = faireUneRequeteOffLine($sql);
return $req;
}

function suppressionAlbumGroupe($id_album){
$sql = "DELETE FROM groupes_albums WHERE id_album = '".$id_album."'";
$req = faireUneRequeteOffline($sql);
return;
}

function ajouterMusiqueAlbumGroupe($id_album,$nom,$musique,$titre){
	$sql = "INSERT INTO groupes_albums_musiques(id_album,nomFichier,musique,titre) VALUES('{$id_album}','{$nom}','{$musique}','{$titre}')";
	$req = faireUneRequeteOffline($sql);
return;
}

function recuperationMusiquesAlbum($id){
	$sql = "SELECT * FROM groupes_albums_musiques WHERE id_album = '{$id}'";
	$req = faireUneRequeteOffLine($sql);
	return $req;	
}

function suppressionMusiqueAlbumGroupe($id_musique){
	$sql = "DELETE FROM groupes_albums_musiques WHERE id_musique = '".$id_musique."'";
	$req = faireUneRequeteOffline($sql);
return;
}

function modifierDescriptifArtisans($id,$corps){
$id_artisans = recuperationIDartisteOffLine($id);
$sql = "SELECT id_artiste FROM artisans_descriptif WHERE id_artiste = '{$id_artisans}'";
$req = faireUneRequeteOffLine($sql);
$data = mysql_num_rows($req);
if($data == 1){
	$sql = "UPDATE artisans_descriptif SET descriptif = '{$corps}' WHERE id_artiste = {$id_artisans}";
}else{
	$sql = "INSERT INTO artisans_descriptif(id_artiste,descriptif) VALUES('{$id_artisans}','{$corps}')";
}
faireUneRequeteOffLine($sql);
return;
}
function modifierLogoAsso($image,$largeur,$hauteur,$id){
$id_assoc = recuperationIDassociationOffLine($id);
$sql = "SELECT * FROM association_descriptif WHERE id_association = '{$id_assoc}'";
$req = faireUneRequeteOffLine($sql);
$data = mysql_num_rows($req);
if($data == 1){
	$sql = "UPDATE association_descriptif SET logo = '{$image}' , logo_tailleX = {$largeur} , logo_tailleY = {$hauteur} WHERE id_association = {$id_assoc}";
}else{
	$sql = "INSERT INTO association_descriptif(id_association,logo,logo_tailleX,logo_tailleY) VALUES('{$id_assoc}','{$image}','{$largeur}','{$hauteur}')";
}
faireUneRequeteOffLine($sql);
return;
}

function modifierDescriptifAsso($id,$corps){
$id_assoc = recuperationIDassociationOffLine($id);
$sql = "SELECT id_association FROM association_descriptif WHERE id_association = '{$id_assoc}'";
$req = faireUneRequeteOffLine($sql);
$data = mysql_num_rows($req);
if($data == 1){
	$sql = "UPDATE association_descriptif SET descriptif = '{$corps}' WHERE id_association = {$id_assoc}";
}else{
	$sql = "INSERT INTO association_descriptif(id_association,descriptif) VALUES('{$id_assoc}','{$corps}')";
}
faireUneRequeteOffLine($sql);
return;
}

function modifierStatusAsso($valeur1,$libelle1,$valeur2,$libelle2,$id){
$id_assoc = recuperationIDassociationOffLine($id);
$sql = "SELECT id_association FROM association_status WHERE id_association = '{$id_assoc}'";
$req = faireUneRequeteOffLine($sql);
$data = mysql_num_rows($req);
if($data == 1){
	$sql = "UPDATE association_status SET {$libelle1} = '{$valeur1}' , {$libelle2} = '{$valeur2}' WHERE id_association = {$id_assoc}";
}else{
	$sql = "INSERT INTO association_status(id_association,{$libelle1},{$libelle2}) VALUES('{$id_assoc}','{$valeur1}','{$valeur2}')";
}
faireUneRequeteOffLine($sql);
return;
}

function ajoutMembreAsso($valeur1,$valeur2,$id){
$id_assoc = recuperationIDassociationOffLine($id);
$sql = "INSERT INTO association_membres(id_association,membre,courriel) VALUES('{$id_assoc}','{$valeur1}','{$valeur2}')";
faireUneRequeteOffLine($sql);
return;
}
function suppressionMembreAsso($id){
$sql = "DELETE FROM association_membres WHERE id_membre ='{$id}'";
faireUneRequeteOffLine($sql);
return;
}
function modifMembreAsso($identite,$courriel,$id){
$sql = "UPDATE association_membres SET membre = '{$identite}', courriel ='{$courriel}' WHERE id_membre='{$id}'";
faireUneRequeteOffLine($sql);
return;
}

function ajoutLienAsso($valeur1,$id){
$id_assoc = recuperationIDassociationOffLine($id);
$sql = "INSERT INTO association_liensWeb(id_association,libelle_lienWeb) VALUES('{$id_assoc}','{$valeur1}')";
faireUneRequeteOffLine($sql);
return;
}
function suppressionLienAsso($id){
$sql = "DELETE FROM association_liensWeb WHERE id_lien ='{$id}'";
faireUneRequeteOffLine($sql);
return;
}
function modifLienAsso($adresse,$id){
$sql = "UPDATE association_liensWeb SET libelle_lienWeb = '{$adresse}' WHERE id_lien='{$id}'";
faireUneRequeteOffLine($sql);
return;
}
function ajouterInfosLienAsso($title,$plainText,$image,$id){
$sql = "UPDATE association_liensWeb SET title_pageWeb = '{$title}',plainText_pageWeb = '{$plainText}',image_pageWeb = '{$image}' WHERE id_lien='{$id}'";
faireUneRequeteOffLine($sql);
return;
}


function modifierInfoArtiste($valeur,$libelle,$id_artiste){
$sql = "UPDATE artistes SET ".$libelle." = '".$valeur."' WHERE id_utilisateur = '".$id_artiste."'";
faireUneRequeteOffline($sql);
return;
}

function modifierInfoJournaliste($valeur,$libelle,$id_journaliste){
$sql = "UPDATE journalistes SET ".$libelle." = '".$valeur."' WHERE id_utilisateur = '".$id_journaliste."'";
faireUneRequeteOffline($sql);
return;
}
/**************************************************************************************************************************************************************UTILISATEURS*/

function supprimerUtilisateur($id){
$sql = "SELECT type_compte FROM utilisateur WHERE id_utilisateur='".$id."'";
$req = faireUneRequeteOffline($sql);
$data = mysql_fetch_row($req);
	switch($data[0]){
		case 0:
			//super-utilisateur
		break;
		case 1:
			//journaliste
			$sql1 = "DELETE FROM articles WHERE id_utilisateur='".$id."'";
			$sql2 = "DELETE FROM articlesEnValidations WHERE id_utilisateur='".$id."'";
			$sql3 = "DELETE FROM journalistes WHERE id_utilisateur='".$id."'";
			$sql4 = "DELETE FROM utilisateur WHERE id_utilisateur='".$id."'";
			faireUneRequeteOffline($sql1);
			faireUneRequeteOffline($sql2);
			faireUneRequeteOffline($sql3);
			faireUneRequeteOffline($sql4);
		break;
		case 2:
			//artiste
			$sql1 = "DELETE FROM artistes WHERE id_utilisateur='".$id."'";
			$sql2 = "DELETE FROM utilisateur WHERE id_utilisateur='".$id."'";
			faireUneRequeteOffline($sql1);
			faireUneRequeteOffline($sql2);
		break;
		case 3:
			//association
			$sql1 = "DELETE FROM associations WHERE id_utilisateur='".$id."'";
			$sql2 = "DELETE FROM utilisateur WHERE id_utilisateur='".$id."'";
			faireUneRequeteOffline($sql1);
			faireUneRequeteOffline($sql2);
		break;
		case 4:
			//artisans
			$sql1 = "DELETE FROM artistes WHERE id_utilisateur='".$id."'";
			$sql2 = "DELETE FROM utilisateur WHERE id_utilisateur='".$id."'";
			faireUneRequeteOffline($sql1);
			faireUneRequeteOffline($sql2);
		break;
		case 5:
			//groupe
			$sql1 = "DELETE FROM associations WHERE id_utilisateur='".$id."'";
			$sql2 = "DELETE FROM utilisateur WHERE id_utilisateur='".$id."'";
			faireUneRequeteOffline($sql1);
			faireUneRequeteOffline($sql2);
		break;
		default:
		//echo "connectionBDD.php __supprimerUtilisateur";
	}
	return;
}

function recuperationNbUtilisateuraReorganiser(){
	$id_2_base = recuperationIDBase();
	$sql2 = "SELECT id_utilisateur FROM utilisateur WHERE id_utilisateur > '".$id_2_base."'";
	$data = faireUneRequeteOffline($sql2);
	$countID = mysql_num_rows($data);
	return $countID;
}
function recuperationNouveauxUtilisateurs(){
	$sql = "SELECT id_utilisateur FROM utilisateur WHERE statut='0'";
	$data = faireUneRequeteOffline($sql);
	return mysql_num_rows($data);
}

function recuperationIDBase(){
	$sql = "SELECT id_utilisateur FROM utilisateur WHERE pseudo='' and password=''";
	$data = faireUneRequeteOffline($sql);
	$data_final = mysql_fetch_row($data);
	return $data_final[0];
}

function AfficherLesComptesRelies($id_base){
	$sql = "SELECT * FROM estRelierA WHERE (idCompte1 = '".$id_base."' || idCompte2 = '".$id_base."')";
	$resultat = faireUneRequeteOffLine($sql);
	echo "<ul>";
	while($data = mysql_fetch_row($resultat)){
		if($data[0] == $id_base){
			$sql = "SELECT id_utilisateur,pseudo,type_compte FROM utilisateur WHERE id_utilisateur = '".$data[1]."'";
		}else{
			$sql = "SELECT id_utilisateur,pseudo,type_compte FROM utilisateur WHERE id_utilisateur = '".$data[0]."'";
		}
		$req = faireUneRequeteOffLine($sql);
		$res = mysql_fetch_row($req);
		echo "<li><a href='controlleurs/traitementChangementCompte.php?id=".$res[0]."'>".$res[1]."</a><span style='float:right;'><a href='controlleurs/traitementSuppressionLiaisonCompte.php?id1=".$data[0]."&id2=".$data[1]."'>[X]</a></span></li>";
	}
	echo "</ul>";
}

function estCompteRelier($id_base){
	$sql = "SELECT * FROM estRelierA WHERE (idCompte1 = '".$id_base."' || idCompte2 = '".$id_base."')";
	$resultat = faireUneRequeteOffLine($sql);
	if( mysql_num_rows($resultat) > 0 ){
		return TRUE;
	}else{
		return FALSE;
	}
}

 // fonction nécessitant le scriptPHP 'cryptographie.php'
function afficheLienConnexionTransparente($id){
	$sql = "SELECT pseudo,password FROM utilisateur WHERE id_utilisateur ='".$id."'";
	$resultat = faireUneRequeteOffLine($sql);
	$data = mysql_fetch_row($resultat);
	if ( $data[0] == "" ){
		$l = "";	
	}else{
		$l = base64_encode(encrypter_generique($data[0]));
	}
	if ( $data[1] == "" ){
		$m = "";	
	}else{
		$m = base64_encode(encrypter_generique($data[1]));
	}
	return "http://besancon25.fr/controlleurs/traitementIdentificationAutomatique.php?l={$l}&m={$m}";
	
}

?>
