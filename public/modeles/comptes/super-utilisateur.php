<?php
echo getenv("HTTP_X_FORWARDED_FOR");
echo $_SERVER['HTTP_X_FORWARDED_FOR'];
print_r($_SERVER);


echo "<h3 class='utilisateurs'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Type du compte de test actuel: ".recuperationTypeCompteTest()
		."<form method='POST' action='controlleurs/traitementModificationCompteTest.php' style='float:right;'>"
		."<input type='submit' value='modifier' />"
		."</form>"
	."</h3>"
	."<ul class='preferences'>"
	."<li>Peut <a href='index.php?page=ajoutUtilisateur'>AJOUTER</a> un nouvel utilisateur.</li>"
	."<li>Peut <a href='index.php?page=gestionUtilisateur'>G&Eacute;RER</a> les ".recuperationNouveauxUtilisateurs()." nouveaux utilisateurs, ainsi que les anciens...</li>"
	."<li>Peut <a href='index.php?page=relierDesComptes'>LIER</a> son compte &agrave; d'autres compte pour une meilleure gestion</li>"
	."<ul>"
	."<li>Peut accepter ou refuser l'inscription d'un nouveau membre avec envoi d'un mail &agrave; la validation pour l'activation du compte</li>"
	."<li>Peut <a href='index.php?page=reorganisation'>r&eacute;organiser la base mysql</a> pour <span style='text-decoration: line-through;'>r&eacute;activer la r&eacute;cup&eacute;ration des mots de passes</span>..."
	."<li><span style='text-decoration: line-through;'>Peut <a href='#'>RECONSTRUIRE LE FLUX RSS</a> du site...</span><i>Ceci est mainenant programm&eacute; depuis le 17/12/2012 de fa&ccedil; automatique ...</i>"
	."<li><span style='text-decoration: line-through;'>Peut kicker/bannir des utlisateurs</span> pour mauvais comportement avec envoi d'un mail donnant le pretexte et la duree</li>"
	."<li><span style='text-decoration: line-through;'>Peut r&eacute;tablir les utilisateurs dans le site d'un CLICK</span> avec envoi de mail</li>"
	."<li><span style='text-decoration: line-through;'>Peut afficher les pr&eacute;f&eacute;rences de chaque utilisateurs afin d'en savoir plus sur la personne</span></li>"
	."<li><span style='text-decoration: line-through;'>Peut ordonner par type ou liste alphab&eacute;tique descendente ou ascendente les utilisateurs pour une recherche plus simple</span></li>"
	."<li>Peut faire une recherche par nom, pr&eacute;nom, surnom &agrave; l'aide d'un champs texte et d'une requ&ecirc;te SQL renvoyant les r&eacute;sultats les plus pertinents</li>"
	."</ul>"
	."<li>Peut tout modifier/supprimer par navigation/interface administrateur</li>"
	."<ul>"
	."<li><span style='text-decoration: line-through;'>Peut modifier/supprimer un article qui devient trop contestataire ou trop envahissant</span></li>"
	."<li>Peut <a href='index.php?page=gestionGueuloir'>G&Eacute;RER</a> les ".recuperationNbNouveauxMessages()." derniers messages du gueuloir</li>"
	."<ul>"
	."<li><span style='text-decoration: line-through;'>Peut changer la m&ecirc;thode d'action:</span>".RecuperationMethodeGueuloir()."<span style='text-decoration: line-through;'> sur les messages du Gueuloir </span>( <a href='./controlleurs/traitementMethodeGueuloir.php?methode=0'>Avec</a> ou <a href='./controlleurs/traitementMethodeGueuloir.php?methode=1'>Sans</a> Validation )</li>"
	."<li><span style='text-decoration: line-through;'>Peut modifier avant de valider les nouveaux messages sur le gueuloir...</span></li>"
	."<li>Peut ajouter un flus RSS pour les annonces du gueuloir et choisir une remise en page sur &agrave; un nombre calcul&eacute; de visites d'acceuil du site.</li>"
	."<li><span style='text-decoration: line-through;'>Peut supprimer les messages les plus anciens pour ne pas encombrer la base de donn&eacute;es</span></li>"
	."<ul>"
	."<li>Peut choisir de laisser par un formulaire un nombre souhaiter de message anciens</li>"
	."<li>Peut choisir de mettre en sauvegarde une discutions en Web-public</li>"
	."<li>Peut a terme avoir un envoi d'email interne sur les profils ( _message/pages de FACEBOOK_ )</li>"
	."</ul>"
	."</ul>"
	."</ul>"
	."<li><a href='index.php?page=validationArticle'>G&Egrave;RE</a> les ".recuperationNbArticlesEnValidation()." ARTICLES des journalistes </li>"
	."<ul>"
	."<li><span style='text-decoration: line-through;'>Peut refuser un des articles en validation et donner la cause par Courriel au Journaliste</span></li>"
	."<li><span style='text-decoration: line-through;'>Peut corriger les fautes d'orthographes sans en avertir le journaliste</span></li>"
	."<li><span style='text-decoration: line-through;'>Peut valider les articles pour les positionner sur le site</span> avec NOTIFICATION par Courriel</li>"
	."<li><span style='text-decoration: line-through;'>Peut &eacute;diter les articles en validation et ainsi les positionner en attente sur le compte du journaliste avec une notification Courriel</span></li>"
	."<li><span style='text-decoration: line-through;'>Peut choisir l'image particuli&egrave;re de l'article en validation</span></li>"
	."</ul>"
	."<li><a href='index.php?page=validationDossier'>Corrige et Valide/Supprime</a> les ".recuperationNbDossierAValider()." DOSSIERS, et <a href='index.php?page=choixDossier'>choisit le dossier d'archive</a> &agrave; afficher sur le site.</li>"
	."<ul>"
	."<li>Peut <a href='emailling/index.php'>faire une campagne d'email</a></li>"
	."<li>Peut <a href='".PAGEB25COM."index.php?page=validationAnnonce_utilisateur'>Valider</a> les ".recuperationNbAnnoncesAValider()." nouvelles annonces de Besancon25.com</li>"
	."<li>Peut <a href='".PAGEB25NET."index.php?page=validationEvenement_utilisateur&cle=".calculCleMapEvenementEnAttenteDeValidations()."'>Valider</a> les ".recuperationNbEvenementsAValider()." nouveaux evenements de Besancon25.net</li>"
	."<li>Peut supprimer/<span style='text-decoration: line-through;'>modifier</span> un dossier du listing parce que trop ancien</li>"
	."<li>Peut lister toutes les images des repertoires par utilisateurs et les supprimer si besoin est.</li>"
	."<li>Peut lister toutes les mp3 des repertoires par utilisateurs et les supprimer si besoin est.</li>"
	."</ul>"
	."</ul>"
	."<ul class='preferences'>";
	if( estCompteRelier($_SESSION['id_utilisateur']) ){
		echo "<li><b>Ce compte est reli&eacute; au(x) compte(s):</b></li>";
		AfficherLesComptesRelies($_SESSION['id_utilisateur']);
	}
	echo "</ul></p>";

