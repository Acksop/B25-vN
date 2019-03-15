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

$sql36 = "INSERT INTO `artistes` (`id_artiste`, `nom`, `prenom`, `pseudo`, `telephone`, `voir_telephone`, `site_web_only`, `voir_tweets`, `affichage_tweets`, `nb_affichage_tweet`, `description`, `email`, `siteInterWeb`, `id_utilisateur`) VALUES
	(7, 'ROY', 'Emmanuel', 'Manol&#039;s', '0662105700', 0, 1, 0, 0, 0, 'Musicien Amateur , Peintre Amateur , VJ Amateur', 'acksop@gmail.com', 'trooltower.infoartsmedia.fr', 2),
	(9, 'THERR', 'Florian', 'Flopy', '0645578149', 1, 1, 0, 0, 0, 'Musicien Amateur', 'flopy25000@hotmail.fr', 'unilever.besancon25.fr', 5),
	(10, 'JEANNOT', 'Claire', 'Shiatsu25', '0685655414', 1, 0, 0, 0, 0, 'Shiatsu (humain) et Shiatsu pour chevaux', 'claire-shiatsu@live.fr', 'http://shiatsu25.fr/', 7),
	(11, 'THONI', 'Irene', 'Irene', '0678106722', 0, 0, 0, 0, 0, 'photo réaliste', 'irene.thoni@gmail.com', 'invertebrae.com', 8),
	(12, 'Perdu?', '', 'Where are you thru ?', '', 1, 0, 0, 0, 0, '', '', 'dijon21.com', 2010),
	(13, 'LAMBERT', 'Greg', 'Tineuil', '0610457430', 1, 0, 0, 0, 0, 'Musicien amateur', 'lambert_gregory@hotmail.f', 'invertebrae.com', 10),
	(15, '', '', '', '', 1, 0, 0, 0, 0, '', '', '', 18),
	(17, 'PERRIN', 'Jérèmy', 'Jejen', '0638862887', 1, 0, 0, 0, 0, 'Reïki', 'jejenvibes@hotmail.fr', '', 2035),
	(18, 'COULON', 'RAPHAEL', 'Héyoka', '0630429688', 1, 0, 0, 0, 0, 'Lutherie,ébénisterie acoustique,création d&#039;oeuvre d&#039;art sur bois', '0630429688@orange.fr', '', 2039),
	(19, 'Boucard', 'vincent', 'Flashbouc', '0662?#@{![', 1, 1, 0, 0, 0, 'Lien pluridisciplinaire', 'vincent.boucard@live.fr', 'flashbouc.com', 2050);";

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

$sql37 = "INSERT INTO `associations` (`id_association`, `nom`, `description`, `telephone`, `email`, `siteInterWeb`, `adresse`, `codePostal`, `ville`, `id_utilisateur`) VALUES
	(6, 'Brin d&#039;air', 'Education Environnement, et plus encore...', '0689287357', 'asso.brindair@yahoo.fr', '', '1bis rue de la république', 63720, 'ENNEZAT', 3),
	(9, 'GENEPI', 'Groupement Etudiant National d&#039;Enseignement aux Personnes Incarcérées', '0682188714', 'genepi-besancon@no-log.org', 'genepi.fr', '5 rue Louis Pergaud', 25000, 'Besançon', 16),
	(10, 'Maha Ayanam', 'Théâtre et échanges culturels', '0682930648', 'mahaayanam@gmail.com', '', '11 rue Péclet', 25000, 'Besançon', 17),
	(11, 'AGEFC (Association Gabonaise des Étudiants de Franche-Comté)', 'Promotion de la culture gabonaise, intégration dans la franche comté, découverte estudiantine.', '0659223407', 'bureau@agefc.fr', 'www.agefc.fr', '36 A, avenue de l&#039;observatoire ', 25000, 'Besançon', 18),
	(14, '', '', '', '', '', '', 0, '', 18),
	(17, 'As Andorinhas', 'groupe folklorique portugais', '0603025584', 'lindadossantos@hotmail.fr', 'http://as-andorinhas.new.fr/', 'maison pour tous,\r\nSur la Place Cassin', 25000, 'Besançon', 2042),
	(16, 'Théâtre des Sources', 'Création, Résidence, diffusion', '06.33.03.14.76', 'theatre.des.sources@free.fr', 'http://theatre.des.sources.free.fr', '19-D , Rue du chapitre', 25000, 'Besançon', 2041),
	(18, 'LES HIBISCUS', 'PROMOTION CULTURE ANTILLAISE', '0683230535', 'crican00007@orange.fr', '', 'AVE DUCAT - MAISON DE QUARTIER ST FERJEUX', 25000, 'BESANCON', 2043),
	(19, 'Trivial Compost', 'Solutions pour un compostage Urbain', '09.51.81.35.63', 'trivialcompost@gmail.com', 'http://trivialcompost.canalblog.com', '13, rue de la liberté', 25000, 'Besançon', 2044),
	(20, 'Le Citron Vert', 'Musiques Electroniques', '09 51 31 02 21', 'lcv.communication@gmail.com', 'www.lecitronvert.org', '58 rue Battant', 25000, 'Besancon', 2045),
	(21, 'AMEB', 'Association Multiculturelle des Étudiants de Besançon', '', 'DiscussionsAMEB@yahoogroupes.fr', '', '', 25000, 'BESANÇON', 2047),
	(22, 'orchestre universitaire de Besançon', 'orchestre et jazz au campus', '03 81 57 30 86', 'orchestre.universitaire@univ-fcomte.fr', 'http://orchestre.assos.univ-fcomte.fr/ ', '36 a av. de l&#039;observatoire', 25030, 'besancon cedex', 2049),
	(23, 'THEATRE DE LA MENTEUSE', 'ASSOCIATION RECHERCHE SUR LE THEATRE', '0381833941 ', 'thea.menteuse@orange.fr', '', '4 A faubourg tarragnoz', 25000, '', 2052),
	(24, '', '', '0', 'anniepaillard@hotmail.fr', '', '', 0, '', 2053);";

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

$sql38 = "INSERT INTO `utilisateur` (`id_utilisateur`, `pseudo`, `password`, `dateInscription`, `dateDerniereConnexion`, `nbConnexions`, `type_compte`, `statut`) VALUES
	(1, 'Acksop', '&zoneA0', 'Jeudi 1 janvier 1970', '0000-00-00 00:00:00', 0, 0, 1),
	(2, 'Manols', '&Eff(e)ctL0w', 'Vendredi 18 Juin 2010 - 03:04', '0000-00-00 00:00:00', 0, 2, 1),
	(3, 'brindair', 'mina', 'Vendredi 18 Juin 2010 - 03:05', '0000-00-00 00:00:00', 0, 3, 1),
	(4, 'arthunosaure', 'thcni', 'Vendredi 18 Juin 2010 - 03:05', '0000-00-00 00:00:00', 0, 1, 1),
	(5, 'flopy', 'guitare', 'Mardi 29 Juin 2010 - 19:05', '0000-00-00 00:00:00', 0, 2, 1),
	(6, 'effectlow', 'flyingflo', 'Mercredi 30 Juin 2010 - 08:50', '0000-00-00 00:00:00', 0, 1, 1),
	(7, 'Shiatsu25', 'plume', 'Mercredi 30 Juin 2010 - 14:03', '0000-00-00 00:00:00', 0, 4, 1),
	(8, 'irene', 'playmobil', 'Lundi 05 Juillet 2010 - 20:23', '0000-00-00 00:00:00', 0, 2, 1),
	(9, 'Faberi', 'fabio-bobo', 'Mardi 06 Juillet 2010 - 20:40', '0000-00-00 00:00:00', 0, 1, 1),
	(10, 'Tineuil', 'wriggles', 'Vendredi 8 Juillet 2010', '0000-00-00 00:00:00', 0, 2, 1),
	(11, 'folken', 'animesanctuary', 'Vendredi 09 Juillet 2010 - 02:09', '0000-00-00 00:00:00', 0, 1, 1),
	(12, 'Mayorem', '&R3m4nu11', 'lundi 4 octobre 1982 3:14:07', '0000-00-00 00:00:00', 0, 1, 1),
	(13, 'Arthur', 'maltese', 'Jeudi 02 Septembre 2010 - 00:04', '0000-00-00 00:00:00', 0, 1, 1),
	(14, 'LadinDenis', 'azerty01', 'Jeudi 09 Septembre 2010 - 13:55', '0000-00-00 00:00:00', 0, 1, 1),
	(15, 'Butterfly', 'azerty02', 'Jeudi 09 Septembre 2010 - 13:56', '0000-00-00 00:00:00', 0, 1, 1),
	(16, 'génépi de besac', 'macvin', 'Mercredi 29 Septembre 2010 - 10:35', '0000-00-00 00:00:00', 0, 3, 1),
	(17, 'Maha Ayanam', 'vesantio', 'Mercredi 29 Septembre 2010 - 10:41', '0000-00-00 00:00:00', 0, 3, 1),
	(18, 'agefc', '20102011', 'Samedi 16 Octobre 2010 - 11:06', '0000-00-00 00:00:00', 0, 3, 1),
	(2043, 'LESHIBISCUS', '1984', 'Mercredi 22 Juin 2011 - 07:53', '0000-00-00 00:00:00', 0, 3, 1),
	(20, 'Gaouelle', 'azerty', 'Dimanche 07 Novembre 2010 - 16:37', '0000-00-00 00:00:00', 0, 1, 1),
	(21, 'Gui', 'floriane', 'Mardi 16 Novembre 2010 - 16:12', '0000-00-00 00:00:00', 0, 1, 1),
	(22, 'Flo', 'fresard', 'Mardi 23 Novembre 2010 - 02:36', '0000-00-00 00:00:00', 0, 1, 1),
	(24, 'titi', 'anarchie', 'Mardi 22 Mars 2011 - 09:36', '0000-00-00 00:00:00', 0, 1, 2),
	(25, 'Sana', 'cigare25', 'Mercredi 23 Mars 2011 - 16:42', '0000-00-00 00:00:00', 0, 1, 1),
	(26, 'dvb', 'dvb', 'Lundi 28 Mars 2011 - 13:11', '0000-00-00 00:00:00', 0, 1, 1),
	(2042, 'andorinhas', 'andorinhasdu25', 'Mardi 21 Juin 2011 - 20:06', '0000-00-00 00:00:00', 0, 3, 1),
	(29, '', '', '19 janvier 2038 3:14:07 GMT', '0000-00-00 00:00:00', 0, 1, 1),
	(2035, 'Jejen', 'vibes', 'Samedi 23 Avril 2011 - 13:14', '0000-00-00 00:00:00', 0, 4, 1),
	(2036, 'PômPaul', 'pomme', 'Vendredi 06 Mai 2011 - 10:36', '0000-00-00 00:00:00', 0, 1, 1),
	(2037, 'Taadj', 'Tiébo', 'Mercredi 25 Mai 2011 - 13:06', '0000-00-00 00:00:00', 0, 1, 1),
	(2038, 'Nina', 'ninouille', 'Jeudi 09 Juin 2011 - 00:54', '0000-00-00 00:00:00', 0, 1, 1),
	(2039, 'héyoka', 'freefight', 'Mardi 14 Juin 2011 - 18:05', '0000-00-00 00:00:00', 0, 4, 1),
	(2040, 'Lucy', 'FIMU', 'Mardi 14 Juin 2011 - 18:49', '0000-00-00 00:00:00', 0, 1, 1),
	(2041, 'Théâtre des Sources', 'coyotte', 'Mardi 21 Juin 2011 - 17:24', '0000-00-00 00:00:00', 0, 3, 1),
	(2044, 'TrivialCompost', 'vermicompost*01', 'Mercredi 22 Juin 2011 - 15:41', '0000-00-00 00:00:00', 0, 3, 0),
	(2045, 'lecitronvert', '232323', 'Jeudi 23 Juin 2011 - 10:09', '0000-00-00 00:00:00', 0, 3, 1),
	(2047, 'ameb', 'ameb', 'Vendredi 24 Juin 2011 - 05:33', '0000-00-00 00:00:00', 0, 3, 0),
	(2048, 'D''Gil', 'cigigi', 'Vendredi 24 Juin 2011 - 14:55', '0000-00-00 00:00:00', 0, 1, 1),
	(2049, 'OUBFC', 'OUBFC', 'Mardi 05 Juillet 2011 - 09:37', '0000-00-00 00:00:00', 0, 3, 1),
	(2050, 'flashbouc', 'flashbouc', 'Samedi 20 Ao&ucirc;t 2011 - 15:17', '0000-00-00 00:00:00', 0, 2, 1),
	(2052, 'THEATRE DE LA MENTEUSE', '0655', 'Mardi 06 Septembre 2011 - 10:33', '0000-00-00 00:00:00', 0, 3, 1),
	(2053, 'Association Art Monie', 'harmoniedomi25', 'Vendredi 09 Septembre 2011 - 21:55', '0000-00-00 00:00:00', 0, 3, 0),
	(2054, 'Théosophe', 'Battant', 'Vendredi 21 Octobre 2011 - 03:04', '0000-00-00 00:00:00', 0, 1, 0);";

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
$requetesINSERT = array($sql36,$sql37,$sql38,$sql10000);

foreach($requetesDROP as $valeur){
	faireUneRequeteOffLine($valeur);
	echo $valeur;
}
foreach($requetesCREATE as $valeur){
	faireUneRequeteOffLine($valeur);
	echo $valeur;
}

foreach($requetesINSERT as $valeur){
	faireUneRequeteOffLine($valeur);
	echo $valeur;
}

//ERREUR D'ENCODAGE ENTRE PHP ET MySQL...___...

//header("location: ../index.php");
?>
