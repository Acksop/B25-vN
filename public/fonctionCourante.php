<?php


require dirname(__FILE__) . "/../localisation_Domaines_externes_B25.php";
require dirname(__FILE__) . "/../identifiants_GoogleAdress_B25.php";

define('SCRIPTPHPPATH',dirname(__FILE__) . "/scriptPHP");


require SCRIPTPHPPATH.'/connectionBDD.php';
require SCRIPTPHPPATH.'/arrondis.php';
require SCRIPTPHPPATH.'/formulaireModification.php';
require SCRIPTPHPPATH.'/repertoire.php';
require SCRIPTPHPPATH.'/cookies.php';
require SCRIPTPHPPATH.'/composants.php';
require SCRIPTPHPPATH.'/nbConnect.php';
require SCRIPTPHPPATH.'/sessions.php';
require SCRIPTPHPPATH.'/tweet.php';
require SCRIPTPHPPATH.'/alertesIntrusions.php';
require SCRIPTPHPPATH.'/cryptographie.php';
include SCRIPTPHPPATH.'/exceptions.php';

function AfficheSousMenu(){
echo "<ul id='sousmenu'>";
	if(!isset($_SESSION['id_utilisateur'])){
		echo "<li><a href='index.php?page=identification'>Mon Compte</a>&nbsp;&nbsp;&nbsp;&nbsp;//&nbsp;&nbsp;&nbsp;&nbsp;<a href='index.php?page=preferences'>Mes Pr&eacute;f&eacute;rences d'affichage(s)</a></li>";
	}else{
		echo "<li>Bonjour <a href='index.php?page=compte'>".$_SESSION['identifiant']."</a>&nbsp;&nbsp;&nbsp;&nbsp;//&nbsp;&nbsp;&nbsp;&nbsp;<a href='index.php?page=preferences'>Mes Pr&eacute;f&eacute;rences d'affichage(s)</a>&nbsp;&nbsp;&nbsp;&nbsp;//&nbsp;&nbsp;&nbsp;&nbsp;<a href='controlleurs/traitementDeconnexion.php'>Se D&eacute;connecter</a></li>";
	}
	echo 	"<li><span id='HeureDate'>".AfficheDate()."</span>&nbsp;&nbsp;&nbsp;&nbsp;//&nbsp;&nbsp;&nbsp;&nbsp;<a href='./FluxRSS.php?flux=RSS'><img src='./images/feed-icon-16x16.png'></a></li>"
		."</ul>";
	return;
}

function AfficheIcone(){
echo "<script type='text/javascript' language='javascript'>\n"
		."

		
		btn_logoNET_gauche = new Image();
		btn_logoNET_gauche = 'images/besancon25.net_gauche.png';
		btn_logoNET_droite = new Image();
		btn_logoNET_droite = 'images/besancon25.net_droite.png';
		btn_logoCOM_gauche = new Image();
		btn_logoCOM_gauche = 'images/besancon25.com_gauche.png';
		btn_logoCOM_droite = new Image();
		btn_logoCOM_droite = 'images/besancon25.com_droite.png';
		btn_logoFR_gauche = new Image();
		btn_logoFR_gauche = 'images/besancon25.fr_gauche.png';
		btn_logoFR_droite = new Image();
		btn_logoFR_droite = 'images/besancon25.fr_droite.png';
		
		function survolCOM( comment ){
			//alert('ok!');
			var gauche = selectionnerDIVimage('logo_gauche');
			var droite = selectionnerDIVimage('logo_droite');
		
			if( comment ){
				gauche.src=btn_logoCOM_gauche;
				droite.src=btn_logoCOM_droite;
			}else{
				gauche.src=btn_logoFR_gauche;
				droite.src=btn_logoFR_droite;
			}
			return;
		}
		
		function survolNET( comment ){
			//alert('ok!');
			var gauche = selectionnerDIVimage('logo_gauche');
			var droite = selectionnerDIVimage('logo_droite');
		
			if( comment ){
				gauche.src=btn_logoNET_gauche;
				droite.src=btn_logoNET_droite;
			}else{
				gauche.src=btn_logoFR_gauche;
				droite.src=btn_logoFR_droite;
			}
			return;
		}
		
		function selectionnerDIVimage(elem){
			if ( document.getElementById && document.getElementById( elem ) ){
				 Pdiv = document.getElementById( elem );
			}
			    // Pour les veilles versions
			else if ( document.all && document.all[ elem ] ){
				Pdiv = document.all[ elem ];
			}
			    // Pour les tr�s veilles versions
			else if ( document.layers && document.layers[ elem ] ){
				Pdiv = document.layers[ elem ];
			}
			else{
				return false;
			}
			return Pdiv;
		}

		</script>\n";
echo "<div class='logoMenu'>";
echo "\n	<center>"
	."\n		";
echo '<img style="cursor: pointer;" border="0" id="logo_gauche" height="400px" width="140" src="images/besancon25.fr_gauche.png" onMouseOver="survolCOM(true)" onMouseOut="survolCOM(false)" onClick="javascript:window.location.href=';
echo "'".PAGEB25COM."';";
echo '" >';
echo '<img style="cursor: pointer;" border="0" id="logo_droite" height="400px" width="140" src="images/besancon25.fr_droite.png" onMouseOver="survolNET(true)" onMouseOut="survolNET(false)" onClick="javascript:window.location.href=';
echo "'".PAGEB25NET."';";
echo '" >';
echo "\n	</center>";
echo "\n</div>";
return;
}

function AfficheMenu(){
AfficheIcone();
echo "\n<div class='boutonsMenu'>";
echo "\n	<ul id='menu'>";


if( !isset($_GET['page'])  || ($_GET['page'] === "accueil" ) ){
	echo "\n		<li><a href='http://wikini.besancon25.fr' >Informations Compl&eacute;mentaires <img src='images/aide_B25.gif' alt='Wikini explicatifs des tenants et aboutissants de la plate-forme (en stade de compl&eacute;ment incomplet.)' /></a></li>";
}else{
	echo "\n		<li><a href='index.php?page=accueil' >Accueil</a></li>";
}

echo "\n		<li><a href='index.php?page=artistes' >Artistes et Artisans</a></li>"
	."\n		<li><a href='index.php?page=associations' >Associations et Groupes</a></li>";

if(isset($_SESSION['type_compte'])){
	echo "\n		<li><a href='index.php?page=articles' >Articles</a></li>";
}

echo "\n		<li><a href='index.php?page=dossiers' >Dossiers</a></li>"
	."\n	</ul>";
echo "\n</div>";
	return;
}
function AfficheSondage($question){
	$data = recuperationQuestionSondage($question);
	$data2 = recuperationReponseCorrespondante($question);
	echo "<div>"
		.""
		."</div>";
}

function PositionneCSS(){
echo "<link type='text/css' rel='stylesheet' href='stylesCSS/baseCorps.css'>";
echo "<link type='text/css' rel='stylesheet' href='stylesCSS/baseMenus.css'>";
choixCSScookie();
echo "<script type='text/javascript' src='scriptJS/live.js'></script>";
echo "<script type='text/javascript' src='scriptJS/changerCSS.js'></script>";
return;
}

function AffichePage($page){
	
	//chargement de la fonction d'affichage
	if($page=="dossiers"){
		LancerAffichageDuCorps();
	}else if($page=="preferences"){
		LancerAffichageDuCorps();
	}else if($page=="artistes"){
		LancerAffichageDuCorps();
	}else if($page=="associations"){
		LancerAffichageDuCorps();
	}else if($page=="articles"){
		LancerAffichageDuCorps();
	}else if($page=="identification"){
		LancerAffichageDuCorps();
	}else if($page=="compte"){
		LancerAffichageDuCorps();
	}else if($page=="inscription"){
		LancerAffichageDuCorps();
	}else if($page=="oubliMdp"){
		LancerAffichageDuCorps();
	}else if($page=="reactionArticle"){
		LancerAffichageDuCorps();
	}else if($page=="tableauInscrit"){
		LancerAffichageDuCorps();
	}else if($page=="murInscrit"){
		LancerAffichageDuCorps();
	}else if($page=="presentationAssociation"){
		LancerAffichageDuCorps();
	}else if($page=="presentationArtisans"){
		LancerAffichageDuCorps();
		
	}else if($page=="ecritureArticle"){
		AfficheFormEcritureArticle();
	}else if($page=="ecritureDossier"){
		AfficheFormEcritureDossier();
	}else if($page=="validationDossier"){
		AfficheFormValidationDossier();
	}else if($page=="modificationDossier"){
		AfficheFormModificationDossier();
	}else if($page=="modificationDossierEnAttente"){
		AfficheFormModificationDossier();
	}else if($page=="modificationDossierSauvegarder"){
		AfficheFormModificationDossier();
	}else if($page=="archiveDossiersJournaliste"){
		AfficheDossierEcrits();
	}else if($page=="archiveDossiersEnValidationsJournaliste"){
		AfficheDossierEnValidation();
	}else if($page=="archiveDossiersSauvegardeJournaliste"){
			AfficheDossierSauvegarde();
	}else if($page=="choixDossier"){
		AfficheFormChoixDossier();
	}else if($page=="validationArticle"){
		AfficheFormValidationArticle();
	}else if($page=="correctionArticle"){
		AfficheFormCorrectionArticle();
	}else if($page=="autorisationArticle"){
		AfficheFormAutorisationArticle();
	}else if($page=="correctionArticleEnAttente"){
		AfficheFormCorrectionArticleEnAttente();
	}else if($page=="raisonSuppressionArticleEnAttente"){
		AfficheFormExplicationSuppressionArticleEnAttente();
	}else if($page=="raisonEditionArticleEnAttente"){
		AfficheFormExplicationEditionArticleEnAttente();
	}else if($page=="correctionArticleEnValidation"){
		AfficheFormCorrectionArticleEnValidation();
	}else if($page=="raisonSuppressionArticleEnValidation"){
		AfficheFormExplicationSuppressionArticleEnValidation();
	}else if($page=="raisonEditionArticleEnValidation"){
		AfficheFormExplicationEditionArticleEnValidation();
	}else if($page=="archiveArticlesJournaliste"){
		AfficheArchiveArticlesDuJournaliste();
	}else if($page=="ajoutUtilisateur"){
		AfficheFormAjoutUtilisateur();
	}else if($page=="gestionUtilisateur"){
		AfficheFormGestionUtilisateur();
	}else if($page=="gestionGueuloir"){
		AfficheFormGestionGueuloir();
	}else if($page=="reorganisation"){
		AfficheFormReorganisation();
	}else if($page=="relierDesComptes"){
		AfficheFormRelierLesComptes();
	}else if($page=="archives"){
		AfficheArchivesArticles();
	}else if($page=="erreurDLTweet"){
		AfficheErreurDLTweet();
	}else if($page=="statistiques"){
	 include 'scriptPHP/crawltrack3-3-2/index.php';
	}else{
		AfficheIndex();
	}
	return;
}
function ChargerVariablesInitialesHeader($page){
	//initialisation
	global $header_title,$header_description,$header_identifier_url,$header_keywords;
	$header_title = "Besan&ccedil;on 25 - La plate-Forme des artistes/Artisans et des groupes/Associations de Besan&ccedil;on - v3.0c - &#948; version";
	$header_description = "Site communautaire pour les artistes/Artisans et les Groupes/Associations de Besan&ccedil;on";
	$header_identifier_url = "besancon25.fr";
	$header_keywords = "Journal, Doubs, Besan&ccedil;on, Besancon, 25000, 25, artiste, artistes, artisant, artisants, association, associations, article, articles, dossier, dossiers, arts, art";
	return;
}

function ChargerModeleEtFonctionsDeLaPage($page){
	//chargement du modele contenant la fonction d'affichage
	if(isset($page)){
		if( file_exists('modeles/'.$page.'.php')){
			include 'modeles/'.$page.'.php';
		}
	}
	return;
}
function ConvertirVariablesHeader($page){
	global $header_title,$header_description,$header_identifier_url,$header_keywords;
	$header_title = html_entity_decode(str_replace("&apos;","'",$header_title),ENT_QUOTES,"ISO-8859-15");
	$header_description = html_entity_decode(str_replace("&apos;","'",$header_description),ENT_QUOTES,"ISO-8859-15");
	$header_identifier_url = html_entity_decode(str_replace("&apos;","'",$header_identifier_url),ENT_QUOTES,"ISO-8859-15");
	$header_keywords = html_entity_decode(str_replace("&apos;","'",$header_keywords),ENT_QUOTES,"ISO-8859-15");
	return;
}


function AfficheIndex(){
	echo "<table border='0'><tr><td>";
	/************************************************************************/
	/**			CELLULE DES ARTICLES D'ACCEUIL			*/
	cadreAlignCentrerDebut();
	echo "<table border='0' align='center'>"
	."<tr>"
	."<td valign='top' align='center' class='article' >"
	."<img src='images/articles/souveraines.jpg' width='200px' height='500px'>"
	."<p align='left' class='titre'>BESANCON 25 </br>&nbsp;&nbsp;&nbsp;- le Ya-Ka-F&ocirc;-Kon</p>"
	."<p align='center' class='article'></p><hr/><p align='center' class='article'>Cette Plate-Forme d'annuaire s'adresse &agrave; tous les artistes et associations en mal de devenir ...</br>&Agrave; toutes celles et ceux qui se battent pour se faire conna&icirc;tre et reconna&icirc;tre au sein de Besan&ccedil;on</br>Ici il y a la possiblit&eacute; de se faire appeler pour peu que l'on veuille bien <a href='index.php?page=inscription'>s'incrire</a>.</br>Car si certains peuvent essayer de passer par le systeme du bouche &agrave; oreille, il est quelques-fois plus simple de laisser des coordonn&eacute;es au milieu de toutes les autres, car cela permet de tisser des liens que l'on aurait p&ucirc; peu imaginer.</br>Il ne reste plus qu'alors &agrave; attendre que le bouleversement des mentalit&eacute;s s'op&egrave;re et qu'il devienne un effet boule de neige pour ceux qui auront bien voulu croire en ce site.</br></p>"
	."<p align='right' class='date'>le 21/06/2010</p>"
	."<p align='right' class='post'>l'Administrateur</p>"
	."</td>"
	."<td>&nbsp;&nbsp;</td>"
	."<td valign='top' align='center' class='article' >"
	."<img src='images/articles/attentives.jpg' width='200px' height='500px'>"
	."<p align='left' class='titre'>BESANCON 25 </br>&nbsp;&nbsp;&nbsp;- le Pourquoi du Comment ?!?</p>"
	."<p align='center' class='article'></p><hr/><p align='center' class='article'><b>Pourquoi avoir fait cet annuaire ?</b></br>La premi&egrave;re et la moins couteuse de toutes les communications provient du web d'internet car la culture du libre et du gratuit y est incrite toujours dans les plus charmantes m&eacute;moires de nos programmeurs. Aujourd'hui tout coute le moindre euros que la plupart des artistes n'ont la possibilit&eacute; de payer pour une communication qui ne leurs semblent pas famili&egrave;re ou n&eacute;cessaire. Cet annuaire est gratuit pour tous et toutes qui veulent avoir une place sur ce site.</br><b>Comment participer ?</b></br>Il suffit de s'incrire via le bouton <a href='index.php?page=inscription'>Mon Compte</a> en haut du site puis de remplir vos noms, prenoms, pseudos, num&eacute;ro de t&eacute;l&eacute;phone, et adresse de courriel ainsi que la description de votre art pr&eacute;f&eacute;r&eacute; pour pourvoir appara&icirc;tre sur ce site. Attention tout compte mal-rempli ne sera pas valid&eacute; par l'administrateur...</br></p>"
	."<p align='right' class='date'>le 30/06/2010</p>"
	."<p align='right' class='post'>l'Administrateur</p>"
	."</td><td bgcolor='#CCCCCC' valign='top'>&nbsp;&nbsp;<img src='images/dernierArticleParu.gif'/></td>"
	."<td>";
	AfficheDernierArticle();
	echo "</td></tr>"
	."</table>";
	cadreAlignCentrerFin();
	$interface = recuperationCookieInterface();
	if($interface != 6 && $interface != 9 && $interface != 10 && $interface != 11 && $interface != 12){
	/************************************************************************/
	echo "</td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td valign='top'>";	
	/************************************************************************/
	/**			CELLULES du gueuloir				*/
	echo "<table border='0' width='300px' height='800px'>"
	."<tr><td width='10px' bgcolor='#AAAAAA'>&nbsp;</td>"
	."<td bgcolor='#DDDDDD' width='280px'>";
	AfficheGueuloir();
	echo "</td><td width='10px' bgcolor='#AAAAAA'>&nbsp;</td>"	
	."</tr></table>";
	/************************************************************************/
	}
	echo "</td></tr></table>";
}

function AfficheGueuloir(){
	echo "<br/>";
	cadreAlignCentrerDebut();
	echo" <p align='center' class='sous-titre'>Un sujet &agrave; traiter ?<br/>Une nouvelle &agrave; annoncer?</p>"
		."<p align='center' class='titre'><b>Utilisez le gueuloir!</b></p>"
		."<p align='right'><span id='gueuloirActualisation'><img src='images/gueuloir/publish.png' alt='Actualisation'></span></p>";
	cadreAlignCentrerFin();
	echo" <br/>";
	echo "<script language='javascript'>"
		."
		function AJAXActualiserGueuloir(){
		var xhr = createXHR();
		xhr.onreadystatechange = function(){
			document.getElementById('gueuloirActualisation').innerHTML = '<img src=\'images/gueuloir/publish.png\' alt=\'Actualisation\'>';
			if(xhr.readyState == 4){
				if(xhr.status == 200){
					document.getElementById('Gueuloir').innerHTML = xhr.responseText;
					document.getElementById('gueuloirActualisation').innerHTML = '<img src=\'images/gueuloir/world.png\' alt=\'En Attente ...\'>';			
				}else{
					document.getElementById('gueuloirActualisation').innerHTML = '<img src=\'images/gueuloir/world.png\' alt=\'En Attente ...\'>';
				}
			}
		};
	
		xhr.open( 'GET' , 'controlleursAJAX/actualisationGueuloir.php', true);
		xhr.send(null); 
		}
		setInterval('AJAXActualiserGueuloir()',60000);
		"
		."</script>";
	
	/************************************************************************/
	/**			AFFICHAGE DE L'INTERFACE DE DIALOGUE						*/
	
	cadreAlignCentrerDebut();
	echo "<span id='Gueuloir'>";
	//affichage des anciens messages...
	$req_dialogue = recuperationDialogue();
	$i=0;
	while($dialogue = mysql_fetch_assoc($req_dialogue)){
		echo "<li style='list-style-type:none;'";
		if($dialogue['valide']==1){
			echo "<ul><B>".$dialogue['date'].": </B>&nbsp;&nbsp;";
			echo check_ChaineDeCaracteresDownload($dialogue['corpsDuTexte'])."</ul>"; 
			if($i>20) break;
			++$i;
		}
		echo "</li>";
	}
	echo "</span>";
	cadreAlignCentrerFin();
		echo "<br><br><br>";
	cadreAlignCentrerDebut();
	echo "<span id='formEnvoiGueuloir'>";
	//formulaire d'envoi de messages...
	echo "<form action='controlleurs/traitementDialogue.php' type='GET'>"
		."<center><p align='center' class='titre'>Fa&icirc;tes-nous part de vos bon-plans !"
		."<br /><br />Ou mettez-les sur le "
		."<a href='".PAGEB25NET."'>.NET-&eacute;v&egrave;nementiel</a>"
		." ou le <a href='".PAGEB25COM."'>.COM-petitesAnnonces</a></p>"
		."<p align='center' class='sous-titre'> Ou pas !</p>"
		."::: <input type='text' name='corpsDuTexte' size='25' /> ::: "
		."<center><a name='gueuloir'><input type='submit' value='Parler' /></a><center>"
		."</form>";
	echo "</span>";
	cadreAlignCentrerFin();
	echo "<br>";
	
	/*																		*/
	/************************************************************************/
	
}


function AfficheDernierArticle(){
	echo "<table border='0' align='center'>"
	."<tr>";
	$req_articles = recuperationDernierArticle();
	while($article = mysql_fetch_assoc($req_articles)){
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
					."<p> Selectionn&eacute; ".AfficheNbClicksArticle($article['id_article'])." fois pour commentaires.</p>"
					."<p> Visit&eacute; par ".AfficheNbVisitesUniqueArticle($article['id_article'])." Poste(s)/IP(s) diff&eacute;rent(e)s ...</p>";
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
}

