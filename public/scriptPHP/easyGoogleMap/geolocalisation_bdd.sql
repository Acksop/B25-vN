--
-- Table structure for table `geolocalisation`
--

CREATE TABLE IF NOT EXISTS `geolocalisation` (
  `geo_id` int(11) NOT NULL auto_increment,
  `geo_statut` int(11) NOT NULL default '0',
  `geo_date` datetime NOT NULL,
  `geo_pos` varchar(128) character set latin1 collate latin1_general_ci NOT NULL,
  `geo_adresse` varchar(128) character set latin1 collate latin1_general_ci NOT NULL,
  `geo_titre` varchar(64) character set latin1 collate latin1_general_ci NOT NULL,
  `geo_description` text character set latin1 collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`geo_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;