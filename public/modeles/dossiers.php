<?php

global $header_title,$header_description,$header_identifier_url,$header_keywords;
$header_title = "Besan&ccedil;on 25 - L&apos;Article actuel de la Plate-forme";
$header_description = "Le dossier actuel de Besan&ccedil;on 25";
$header_identifier_url = "besancon25.fr/article_long";
$header_keywords = "Besan&ccedil;on, Besancon, 25000, 25, article, dossier, article long";


function LancerAffichageDuCorps(){
$data = mysql_fetch_assoc(recuperationDossieraAfficher());
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