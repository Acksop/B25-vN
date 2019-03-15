<?php

global $header_title,$header_description,$header_identifier_url,$header_keywords;
$header_title = "Besan&ccedil;on 25 - L&apos;e Hors-S&eacute;rie au sujet d'une religion";
$header_description = "Le hors-série#2 de Besan&ccedil;on 25";
$header_identifier_url = "besancon25.fr/hors-serie1";
$header_keywords = "Besan&ccedil;on, Besancon, 25000, 25, hors-serie, Religion, Attentats";


function LancerAffichageDuCorps(){
	
	echo "<br />";
	AfficherDossier();
	echo "<br />";
	AfficherArticles();
	echo "<br />";
}

function AfficherDossier(){
$sql = "SELECT * FROM dossiers WHERE dossiers.id_dossier='11'";
$req = faireUneRequeteOffline($sql);
$data = exploiterLigneResultatBDD($req);
cadreDossierDebut();
	if($data != 0){
		echo "<p class='titreDossier'>".$data['titre']."</p>"
			."<p class='corpsDossier'>".$data['corps']."</p>"
			."<p align='right' class='date'>Derni&egrave;re &eacute;dition ".$data['date_Modif']."</p>"
			."<p align='right' class='date'><b>Mis en ligne ".$data['date_misEnLigne']."</b></p>"
			."<p align='right' class='post'>Auteur:&nbsp;&nbsp;".recuperationAuteur($data['id_utilisateur'])."</p>";
			ajouterLectureDossierAfficher($data['id_dossier']);
			if(isset($_SESSION['type_compte'])){
				if( $_SESSION['type_compte'] == '0' ){
					echo "<center>Il y a actuellement ".recuperationNbDossierAValider()." Dossiers a <a href='index.php?page=validationArticle'>valider</a>...</center>";
					echo "<center><a href='index.php?page=choixDossier'>Choisir le BON dossier &agrave; afficher ?</a></center>";
				}
			}
			
	}else{
		echo "Pas de dossiers &agrave; lire...";
}
cadreDossierFin();
}

function AfficherArticles(){
	cadreAlignCentrerDebut();
	echo "<table border='0' align='center'>"
	."<tr>";
	$sql = "SELECT * FROM articles WHERE (articles.id_article='9' OR articles.id_article='11' OR articles.id_article='8' OR articles.id_article='37')";
	$req_articles = faireUneRequeteOffLine($sql);
	while($article = exploiterLigneResultatBDD($req_articles)){
		AjouterLectureArticleAfficher($article['id_article']);
		echo "<td valign='top' align='center' class='article' >"
			."<img src='images/articles/".$article['image']."' width='200px' height='500px'>"
			."<hr/><p align='left' class='titre'>".check_ChaineDeCaracteresDownload($article['titre'])."</p><hr/>"
			."<p align='center' class='article'>".check_ChaineDeCaracteresDownload($article['corps'])."</p><hr/>"
			."<p align='right' class='article'>Id&eacute;ologie:&nbsp;&nbsp;".recuperationIdeologie($article['id_ideologie'])."</p>"
			."<p align='right' class='article'>Th&ecirc;me:&nbsp;&nbsp;".recuperationTheme($article['id_theme'])."</p>"
			."<p align='right' class='date'>".$article['date']."</p>"
			."<p align='right' class='article'><a href='index.php?page=reactionArticle&id=".$article['id_article']."'>".calculNbCommentairesArticle($article['id_article'])." commentaire(s) <img src='images/commentaires.gif' width='15px' heigth='15px'></a></p>"
			."<p align='right' class='post'>Auteur:&nbsp;&nbsp;".recuperationAuteur($article['id_utilisateur'])."</p>";
		if( isset($_SESSION['type_compte'])){
			if($_SESSION['type_compte'] == '0'){
				echo "<p> Lu ".AfficheNbLectureArticle($article['id_article'])." fois...</p> "
					."<p> Visit&eacute; par ".AfficheNbVisitesUniqueArticle($article['id_article'])." Poste(s)/IP(s) diff&eacute;rent(e)s ...</p>"
					."<p> Selectionn&eacute; ".AfficheNbClicksArticle($article['id_article'])." fois pour commentaires.</p>";
				echo "<form method='get' action='controlleurs/traitementSuppressionArticle.php'>"
				."<input type='hidden' name='id' value='".$article['id_article']."'/><input type='submit' value='Supprimer'/>"
				."</form>";
				echo "<a href='index.php?page=correctionArticle&id=".$article['id_article']."'>Corriger La(Les) faute(s)</a>";
			}else{
				if($_SESSION['id_utilisateur'] == $article['id_utilisateur']){
					echo "<p> Lu ".AfficheNbLectureArticle($article['id_article'])." fois...</p> "
					."<p> Selectionn&eacute; ".AfficheNbClicksArticle($article['id_article'])." fois pour commentaires.</p>";
					echo "<form method='get' action='controlleurs/traitementSuppressionArticle.php'>"
					."<input type='hidden' name='id' value='".$article['id_article']."'/><input type='submit' value='Supprimer'/>"
					."</form>";
					echo "<a href='index.php?page=correctionArticle&id=".$article['id_article']."'>Corriger La(Les) faute(s)</a>";
				}
			}
		}
	
		echo "</td>";
	
	}
	echo "</tr></table>";
	cadreAlignCentrerFin();
}
