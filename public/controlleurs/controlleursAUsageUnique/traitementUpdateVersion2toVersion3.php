<?php
include('../scriptPHP/requeteBDD.php');
/*Differences de Structures
	articles.image => varchar(150)
	articlesEnAttentes.image => varchar(150)
	articlesEnValidations.image => varchar(150)
	connectes.derniere => int(20)
	journalistes.signature => varchar(25)
	Tchat.valide => int(2)
*/

//CHANGEMENT DE COMMENTAIRES: Alerte_H4XOR

$sql1 = "DROP TABLE Alerte_H4X0R ;";
$sql2 = "CREATE TABLE IF NOT EXISTS `Alerte_H4X0R` (
  `id_alerte` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) NOT NULL COMMENT '1: brute force , 2: duplication d''identité,3: intrusion page var, 4:erreurVideo',
  `date` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `IP1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `IP2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `compte` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_alerte`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=0 ;";

//MODIFICATIONS DES TABLES EXISTANTES: artiste_tweet_* ; associations_tweet_* ; artistes ; associations ; utilisateur(s) ;
//					AVEC RÉINSERTIONS: artistes ; associations ; utilisateur(s) ;

$sql10 = "DROP TABLE artiste_tweet_image ;";
$sql20 = "CREATE TABLE IF NOT EXISTS `artiste_tweet_image` (
  `id_tweet` int(11) NOT NULL AUTO_INCREMENT,
  `id_buzz` int(11) NOT NULL,
  `nomImage` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `original` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `text` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_tweet`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=0 ;";
$sql11 = "DROP TABLE association_tweet_image ;";
$sql21 = "CREATE TABLE IF NOT EXISTS `association_tweet_image` (
  `id_tweet` int(11) NOT NULL AUTO_INCREMENT,
  `id_buzz` int(11) NOT NULL,
  `nomImage` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `original` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `text` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_tweet`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=0 ;";

$sql12 = "DROP TABLE artiste_tweet_son ;";
$sql22 = "CREATE TABLE IF NOT EXISTS `artiste_tweet_son` (
  `id_tweet` int(11) NOT NULL AUTO_INCREMENT,
  `id_buzz` int(11) NOT NULL,
  `nomMp3` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `son` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `text` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_tweet`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=0 ;";
$sql13 = "DROP TABLE association_tweet_son ;";
$sql23 = "CREATE TABLE IF NOT EXISTS `association_tweet_son` (
  `id_tweet` int(11) NOT NULL AUTO_INCREMENT,
  `id_buzz` int(11) NOT NULL,
  `nomMp3` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `son` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `text` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_tweet`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=0 ;";

$sql14 = "DROP TABLE artiste_tweet_video ;";
$sql24 = "CREATE TABLE IF NOT EXISTS `artiste_tweet_video` (
  `id_tweet` int(11) NOT NULL AUTO_INCREMENT,
  `id_buzz` int(11) NOT NULL,
  `adresseMedia` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `codeConnexe` text COLLATE utf8_unicode_ci NOT NULL,
  `text` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_tweet`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=0 ;";
$sql15 = "DROP TABLE association_tweet_video ;";
$sql25 = "CREATE TABLE IF NOT EXISTS `association_tweet_video` (
  `id_tweet` int(11) NOT NULL AUTO_INCREMENT,
  `id_buzz` int(11) NOT NULL,
  `adresseMedia` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `codeConnexe` text COLLATE utf8_unicode_ci NOT NULL,
  `text` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_tweet`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=0 ;";

$sql16 = "DROP TABLE artistes ;";
$sql26 = "CREATE TABLE IF NOT EXISTS `artistes` (
  `id_artiste` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `pseudo` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `telephone` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `voir_telephone` int(1) NOT NULL DEFAULT '1' COMMENT '0:invisible 1:visible',
  `site_web_only` int(1) NOT NULL DEFAULT '0' COMMENT '1: site web only 0:all coord',
  `voir_tweets` int(1) NOT NULL DEFAULT '0' COMMENT '0:invisible sur la liste 1:visible',
  `affichage_tweets` int(1) NOT NULL DEFAULT '0' COMMENT '0:mur de billets 1:tableau',
  `nb_affichage_tweet` int(11) NOT NULL DEFAULT '0' COMMENT 'Nb d''affichage de la page',
  `description` tinytext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `siteInterWeb` varchar(255) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  PRIMARY KEY (`id_artiste`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;";

$sql17 = "DROP TABLE associations ;";
$sql27 = "CREATE TABLE `associations` (
  `id_association` int(11) NOT NULL auto_increment,
  `nom` varchar(100) character set utf8 collate utf8_unicode_ci NOT NULL,
  `description` tinytext character set utf8 collate utf8_unicode_ci NOT NULL,
  `telephone` varchar(25) character set utf8 collate utf8_unicode_ci NOT NULL,
  `email` varchar(255) character set utf8 collate utf8_unicode_ci NOT NULL,
  `siteInterWeb` varchar(255) character set utf8 collate utf8_unicode_ci NOT NULL,
  `adresse` tinytext character set utf8 collate utf8_unicode_ci NOT NULL,
  `codePostal` int(5) NOT NULL,
  `ville` varchar(255) character set utf8 collate utf8_unicode_ci NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  PRIMARY KEY  (`id_association`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;";

$sql18 = "DROP TABLE utilisateur ;";
$sql28 = "CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'A encoder en base(64)',
  `dateInscription` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `dateDerniereConnexion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `nbConnexions` int(11) NOT NULL DEFAULT '0',
  `type_compte` int(11) NOT NULL COMMENT '0:superutilisateur ; 1:journaliste ; 2:artiste ; 3:association ; 4:Artisans ; 5:Groupe',
  `statut` int(11) NOT NULL COMMENT '0: admis ; 1: kické ; 2:banni ; 3:déinscrit',
  PRIMARY KEY (`id_utilisateur`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2043 ;";

//CREATION DES TABLES N'EXISTANT PAS : association_*
//			AVEC UNE INSERTION : Brind'AIR

$sql10001 = "CREATE TABLE IF NOT EXISTS `association_descriptif` (
  `id_association` int(11) NOT NULL,
  `logo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `logo_tailleX` int(11) NOT NULL,
  `logo_tailleY` int(11) NOT NULL,
  `descriptif` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";

$sql10002 = "CREATE TABLE IF NOT EXISTS `association_liensWeb` (
  `id_lien` int(11) NOT NULL AUTO_INCREMENT,
  `id_association` int(11) NOT NULL,
  `libelle_lienWeb` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_lien`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;";

$sql10003 = "CREATE TABLE IF NOT EXISTS `association_membres` (
  `id_membre` int(11) NOT NULL AUTO_INCREMENT,
  `id_association` int(11) NOT NULL,
  `membre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `courriel` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_membre`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;";

$sql10004 = "CREATE TABLE IF NOT EXISTS `association_status` (
  `id_association` int(11) NOT NULL,
  `president` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `courriel_president` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `vicePresident` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `courriel_vicePresident` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tresorier` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `courriel_tresorier` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `secretaire` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `courriel_secretaire` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";

$sql10000 = "INSERT INTO `association_descriptif` (`id_association`, `logo`, `logo_tailleX`, `logo_tailleY`, `descriptif`) VALUES
(6, '', 0, 0, '<p><strong>&ndash; Interventions aupr&egrave;s des &eacute;coles maternelles et primaires:</strong><br />Dans un premier temps, nous avons envoy&eacute; aux directeurs de 40 &eacute;coles des lettres<br />expliquant nos projets. Nous avons choisi un p&eacute;rim&egrave;tre de 20km de rayon autour d''Ennezat.<br />Un lyc&eacute;e agricole se trouve sur la commune d''Ennezat. Une discussion avec une enseignante, nous<br />encourage &agrave; r&eacute;fl&eacute;chir &agrave; des actions pouvant &ecirc;tre men&eacute;es avec les jeunes.<br /><strong>&ndash; Interventions loisirs:</strong><br />Pour l''&eacute;t&eacute; 2011, nous souhaitons proposer un camp itin&eacute;rant en Auvergne avec public<br />adolescent pour 15 jours .et un camp pour la tranche d''age 9/12 ans.<br />Les accueils collectifs de mineurs vont &ecirc;tre sollicit&eacute; pour r&eacute;aliser des interventions.<br /><strong>&ndash; La newsletter</strong><br />Un courrier d''information sera envoy&eacute; a tous les adh&eacute;rents deux fois par an.<br /><strong>&ndash; La notion d''&eacute;change:</strong><br />Nous souhaitons participer &agrave; des &eacute;changes de savoir, de savoir faire, en proposant des<br />sorties, des partenariats entre associations, des &eacute;v&eacute;nements...<br /><strong>&ndash; les march&eacute;s:</strong><br />Un stand de l''association sur les march&eacute;s permettrait de diffuser des plaquettes<br />d''information, proposer des animations direct avec le grand public et la vente des revues. C''est aussi<br />un bon moyen de promouvoir l''association.<br />La construction d''un chevalet sera n&eacute;cessaire pour pr&eacute;senter les revues, ou autres documents.<br /><strong>&ndash; Outils p&eacute;dagogique:</strong><br />La cr&eacute;ation de supports d''animation sera n&eacute;cessaire pour les interventions.<br />Le mus&eacute;um d''Histoire Naturel de Clermont-Ferrand peut nous pr&ecirc;ter du mat&eacute;riel et une salle.<br />La direction de la Jeunesse des Sports et de la Coh&eacute;sion Social peut aussi nous pr&ecirc;ter des malles<br />p&eacute;dagogiques.<br /><strong>&ndash; Communication :</strong><br />La cr&eacute;ation d''un calicot servira pour se pr&eacute;senter lors d''&eacute;v&eacute;nementiels, pour afficher notre<br />pr&eacute;sence sur les march&eacute;s. Il pourrait se r&eacute;aliser avec la participation d''Emmanuel R.<br />Un d&eacute;pliant est en cours de r&eacute;alisation avec l''aide d''&Eacute;milie. Il pr&eacute;sentera l''association avec<br />son histoire, son but, ses actions... C''est la base de notre communication.</p>\r\n<p><br /><span style=''text-decoration: underline;''>Nous souhaitons mettre en place un site internet pour l''ann&eacute;e 2011. Il nous servira &agrave;</span><br /><span style=''text-decoration: underline;''>communiquer et pr&eacute;senter diverses informations au public et aux adh&eacute;rents.</span></p>');";

$requetesDROP = array($sql1,$sql10,$sql11,$sql12,$sql13,$sql14,$sql15,$sql16,$sql17,$sql18);
$requetesCREATE = array($sql2,$sql20,$sql21,$sql22,$sql23,$sql24,$sql25,$sql26,$sql27,$sql28,$sql10001,$sql10002,$sql10003,$sql10004);


foreach($requetesDROP as $valeur){
	faireUneRequeteOffLine($valeur);
	echo $valeur;
}
foreach($requetesCREATE as $valeur){
	faireUneRequeteOffLine($valeur);
	echo $valeur;
}

//ERREUR D'ENCODAGE ENTRE PHP ET MySQL...___...

//header("location: ../index.php");
?>
