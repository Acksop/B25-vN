<?php
include '../../scriptPHP/requeteBDD.php';

$sql1 = "CREATE TABLE IF NOT EXISTS `artisans_articles` (
  `id_article` int(11) NOT NULL AUTO_INCREMENT,
  `id_artiste` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image_tailleX` int(11) NOT NULL,
  `image_tailleY` int(11) NOT NULL,
  `libelle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `prix` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_article`),
  UNIQUE KEY `id_artiocle` (`id_article`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=0 ;";
$sql2 = "CREATE TABLE IF NOT EXISTS `artisans_descriptif` (
  `id_artiste` int(11) NOT NULL,
  `logo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `logo_tailleX` int(11) NOT NULL,
  `logo_tailleY` int(11) NOT NULL,
  `descriptif` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
$sql3 = "CREATE TABLE IF NOT EXISTS `groupes_albums` (
  `id_album` int(11) NOT NULL AUTO_INCREMENT,
  `id_association` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image_tailleX` int(11) NOT NULL,
  `image_tailleY` int(11) NOT NULL,
  `libelle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `annee` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `style` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_album`),
  UNIQUE KEY `id_album` (`id_album`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=0 ;";
$sql4 = "CREATE TABLE IF NOT EXISTS `groupes_albums_musiques` (
  `id_musique` int(11) NOT NULL AUTO_INCREMENT,
  `id_album` int(11) NOT NULL,
  `nomFichier` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `musique` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `titre` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_musique`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=0 ;";

faireUneRequeteOffLine($sql1);
faireUneRequeteOffLine($sql2);
faireUneRequeteOffLine($sql3);
faireUneRequeteOffLine($sql4);
