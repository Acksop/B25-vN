<?php
function envoiEmail($adresse){
	$TO = $adresse;
	$subject = "Lettre aux entreprises de la région du Jura";
	$headers  = 	"From: administrateur@infoartsmedia.fr \r\n"
			."MIME-Version: 1.0" . "\r\n"
			."Content-type: text/html; charset=iso-8859-1" . "\r\n";
	$message = "
	<html>
		<head>
		<title>Info[Arts]Media - Lettre de contact</title>
		</head>
		<body>
			<p align='center'><img src='http://infoartsmedia.info/logo.jpg'/></p>
			<p align='center'>Ayant r&eacute;cemment cr&eacute;er mon auto-entreprise dans le domaine du multim&eacute;dia et de l'informatique, je me permet de vous solliciter. J'utilise les syst&egrave;mes d'exploitations Windows depuis la version 3.1 et plus r&eacute;cemment Linux pour le d&eacute;veloppement Web et sp&eacute;cialement pour sa technologie LAMP (Linux Apache MySQL PHP).</p>
			<p align='center'>Je suis en mesure d'apprendre &agrave; utiliser &agrave; d'autres personnes les services internets ainsi que les programmes de traitement de texte et surtout de r&eacute;soudre les probl&egrave;mes li&eacute;s à leurs utilisations.  En cons&eacute;quence en cas d'une surcharge de travail ou de travaux ponctuels je pourrais me proposer &agrave; votre service. N'h&eacute;sitez pas &agrave; faire appel &agrave; moi.</p>
			<p align='right'>Voici mon curriculum Vitae:</p>
	<table border='0' width='750' align='center' cellpadding='10'>
	<th colspan='2'>
		Emmanuel ROY
	</th>
	<tr>
		<td>
			31B, avenue de l'Observatoire</br>R&eacute;sidence LE GALLIL&Eacute;</br>25000 BESA&Ccedil;ON
		</td>

		<td>
			22, rue de la sous-pr&eacute;fecture</br>39100 DOLE
		</td>
	</tr>
	<tr>
		<td>
		Tel: 06 62 10 57 00
		</br></br>
		Courriel:
		</br>

		emmanuel11.roy@gmail.com
		</br>
		emmanuel11.roy@laposte.net
		</td>
	</tr>
	<tr>
		<td>04/10/1982</td><td>Permis B</td> 
	</tr>
	<tr>

	<td colspan='2'>
	</br></br></br>
	<h2>FORMATION :</h2>
	<hr>
	<table border='0' width='100%' cellspacing='15'>
	<tr>
		<td>2004-2008</td>
		<td>Mod&eacute;lisation et R&eacute;vision des langages en Licence informatique &agrave; l'UFR ST de Besan&ccedil;on,</td>

	</tr>
	<tr>
		<td>2001-2004</td>
		<td>Conception et r&eacute;alisation de produits multim&eacute;dia &agrave; l'IUT  Services et R&eacute;seaux de Communication de Montb&eacute;liard,</td>
	</tr>

	<tr>
		<td>2000-2001</td>
		<td>1ere ann&eacute;e en classe pr&eacute;paratoire aux grandes &eacute;coles à l'Universit&eacute; de Technologie de Belfort-Montbéliard (UTBM),</td>
	</tr>
	<tr>

		<td>Année 2000</td>
		<td>Obtention d'un baccalaur&eacute;at Scientifique option Math&eacute;matiques et Sciences de l'ing&eacute;nieur, Mention Assez Bien,</td>
	</tr>
	<tr>
		<td>Langues</td>
		<td>Anglais : Lu, &Eacute;crit, Parl&eacute; ;</br>Allemand : Niveau Bac</td>

	</tr>
	</table>
	</br></br>
	<h2>EXPERIENCE :</h2>
	<hr>
	<ul>
	<li>Stage de Professionnel <font style='font-size: 10px;'>(D&eacute;couverte d'Entreprise &Eacute;trang&egrave;re)</font> chez Trin&ocirc;me.inc (Canada - Province Qu&eacute;bec - Vile Montr&eacute;al)</li>

	<li>Stage de fin de Licence Informatique au sein de l'EMF1 (Etat-Major de Besan&ccedil;on)</li>
	<li>Stage ouvrier au sein de l'entreprise PSA Peugeot-Citro&euml;n &agrave; Sochaux,</li>
	<li>Design et cr&eacute;ation de divers graphismes pour quelques associations,</li>
	<li>Cr&eacute;ations de sites simples pour diff&eacute;rentes agences,</li>

	<li>Illustrations, logos, ic&ocirc;nes pour diverses utilisations :     Vitrophanies, flyers,...</li>
	</ul>
	</br></br>
	<h2>LANGAGES INFORMATIQUES ABORDES</h2>
	<hr>
	<ul>
	<li>Langages Webs: HTML, CSS, JavaScript (ECMA), PHP ;</li>

	<li>Langages objets: Java, C++ ;</li>
	<li>Langages formels: Scheme, Prolog ;</li>
	<li>Langages Syst&egrave;mes: C ;</li>
	<li>Langages Propriétaires: ActionScript 2.0/3.0, Director, AuthorWare ;</li>
	</ul>
	</br></br>

	<h2>REALISATIONS :</h2>
	<hr>
	<ul>
	<li>Livre interactif en flash,</li>
	<li>CD interactif sur le film « The Matrix »,</li>
	<li>Agenda journalier/Mensuel interactif,</li>
	<li>Site personnel interne Web 1.0 et 2.0,</li>

	<li>Montages photo,</li>
	<li>Illustrations personnelles,</li>
	<li>Animations artistiques.</li>
	<li>Cr&eacute;ation de l'Entreprise INFO[MEDIA]BESAN&Ccedil;ON.</li>
	</ul>
	</br></br>

	<h2>TRAVAIL TEMPORAIRE :</h2>
	<hr>
	<ul>
	<li>Animateur dans une colonie de vacances pour Poly-Handicap&eacute;s au Domaine de Suech <font style='font-size: 10px;'>du 01/08/10 au 13/08/10</font></li>
	<li>Standardiste &agrave; l'accueil clientèle des Galleries LAFAYETTE de Besan&ccedil;on <font style='font-size: 10px;'>du 02/12/09 au 12/12/09</font>,</li>

	<li>Agent d'entretien, Concierge, Gardien Remplaçant de la m&eacute;diath&egrave;que Pierre-Bayle Besançon <font style='font-size: 10px;'>dur&eacute;e : 1an</font>,</li>
	<li>Aide cuisine dans un restaurant (mise en place d'entrée, préparation des aliments),</li>
	<li>Mise en rayon, chez « Monsieur 2 Euros » et chez Carrefour,</br>
	<li>Retour des invendus au FORUM Besançon,</li>

	<li>Vente de produits multim&eacute;dia au FORUM Besançon,</li>
	<li>Distribution de journaux chez ADREXO Besançon,</li>
	<li>Ramassage des abricots à MERCUROL (Dr&ocirc;me),</li>
	<li>Plongeur au CROUS Montb&eacute;liard et Besançon.</li>
	</ul>

	</br></br>
	<h2>CENTRES D'INTER&Ecirc;TS :</h2>
	<hr>
	<ul>
	<li>Dessins,</li>
	<li>Illustrations au crayon de papier,</li>
	<li>Photographies (portraits, paysages, exp&eacute;rimentales, macros),</li>

	<li>Sports Extr&ecirc;mes (snow-board, VTT, roller, ...).</li>
	</td>	
	</tr>
	</table>
	
	<p align='right'>Dans l'attente de vous rencontrer, recevez, Monsieur, Madame, mes sincères salutations.</p>
	<p align='left'>Emmanuel ROY - Info[Arts]Media - 2011</p>
	
	</body>
	</html>
		";
	mail( $TO, $subject, $message, $headers);
}

switch($_POST['destinataire']){
	case 0:
	//test mise en forme
	$emails = array('contact@infoartsmedia.fr');
	break;
	case 1:
	//Jura
	$emails = array('boutique@platinium-informatique.com','olivier.becoulet@sosinformatique-39.fr','info@topsolutions.fr','info@absysinformatique.fr','ascavannaconsulting@orange.fr','cm.telecom.reseaux@wanadoo.fr','dole.bureau@wanadoo.fr','greta.lons-champagnole@ac-besancon.fr','contact@jbinformatique.com');
	break;
	case 2:
	//Doubs
	$emails = array('micro-depannage@wanadoo.fr','contact@jbinformatique.com','j2m@j2mservices.fr','contact@copierepro.fr','essor-besancon@essor-info.fr','CLMinfos@cegedim.fr','comete-systeme@club-internet.fr','info@daimon-media.fr','buroinfo@buroinfo.fr','brule..philippe@baib.fr','aprogsys@aprogsys.com','contact@afyle.fr','contact@atelias.fr','contact@atelias.fr','akkus@akkus.net','contact@ans-timas.com','contact@acorline.com','atuacom@actuacom.fr','2as.informatique@free.fr','afodis@afodis.fr','aid25@orange.fr','ordicars@sno.fr','millot.t@gmaail.com','stournot@sttelecom.fr','contact90@wagnersas.fr','adrien@abradaclic.fr','fcs@fcsinfo.com','lionel@fm-informatique.com','idpc@wanadoo.fr','ideologic@ideologic.fr');
	break;
	case 3:
	//Lons-Le-Saunier
	$emails = array();
	break;
	case 4:
	//Vesoul
	$emails = array();
	break;
	case 5:
	//Dijon
	$emails = array();
	break;
	default:
}
//visualisation des courriels
	echo "<html><head><title>Campagne courriel Entreprises...</title></head><body><p align='left'><b>Envoi des courriels de campagne à:</b></p><p>";
	foreach($emails as $valeur){
		envoiEmail($valeur);
		echo $valeur."<br/>";
	}
	echo "</p><p align='left'><a href='index.php?envoi=oui'>RETOUR</a></p></body></html>";
	//fin de visualisation des courriels
//header("location: index.php?envoi=oui");
?>
