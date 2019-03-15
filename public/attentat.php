<!DOCTYPE HTML>
﻿<html>
<head>
<title>Besan&ccedil;on 25 - La plate-Forme des artistes/Artisans et des groupes/Associations de Besan&ccedil;on - v1.5c - &alpha; version</title>
	<!---------------------------------------------------------------------------------------------------------------------------------------->
	<!--						BALISES DE META-RECHERCHES								-->
	<META NAME="Category" CONTENT="Plate-forme">
	<META NAME="Publisher" CONTENT="INFO[ARTS]MEDIA">
	<META NAME="Copyright" CONTENT="© - 2010 - Info[ARTS]Media">
	<META NAME="Expires" CONTENT="Never Maybe!">
	<META NAME="Description" CONTENT="Site communautaire pour les artistes/Artisans - Groupes/Associations et (bient&ocirc;t) Collectifs/Sportifs de Besan&ccedil;on">
	<META NAME="Distribution" CONTENT="Global">
	<META NAME="Identifier-URL" CONTENT="<?php echo $_SERVER['HTTP_HOST']; ?>">
	<META NAME="Keywords" CONTENT="Journal, Doubs, Besançon, Besancon, 25000, 25, artiste, artistes, artisant, artisants, association, associations, article, articles, dossier, dossiers, arts, art">
	<META NAME="Author" CONTENT="Emmanuel ROY & More ...">
	<META NAME="Reply-to" CONTENT="contact@besancon25.info">
	<META NAME="Date-Creation-yyyymmdd" CONTENT="20151111">
	<META NAME="Date-Revision-yyyymmdd" CONTENT="20170927">
	<META NAME="Revisit-After" CONTENT="30 days">
	<META NAME="Robots" CONTENT="index, nofollow">
	<META NAME="GOOGLEBOT" CONTENT="NOARCHIVE">
	<!--																	-->
	<!---------------------------------------------------------------------------------------------------------------------------------------->
	<!--																	-->
	<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
	<META HTTP-EQUIV="Content-Language" CONTENT="fr">
	<META HTTP-EQUIV="Refresh" CONTENT="NO">
	<link REL="shortcut icon" HREF="images/logoo.ico" />
	<link REL="icon" NAME="Shortcut Icon" HREF="images/logoo.ico" />
	<!--																	-->
	<!---------------------------------------------------------------------------------------------------------------------------------------->
</head>
<body>
<?php

switch($_SERVER['HTTP_HOST']){
	case 'besancon25.biz':
	$tld = 'BIZ';
	break;
	case 'besancon25.net':
	$tld = 'NET';
	break;
	case 'besancon25.fr':
	$tld = 'FR';
	break;
	case 'besancon25.com':
	$tld = 'COM';
	break;
	case 'besancon25.info':
	$tld = 'INFO';
	break;
	default:
	$tld = 'FR';
}
$rand = rand(0,5);
if( $rand > 2 ){
	$rand2 = rand(0,5);
	switch($rand2){
		case 0:
		$tld = 'BIZ';
		break;
		case 1:
		$tld = 'NET';
		break;
		case 2:
		$tld = 'FR';
		break;
		case 3:
		$tld = 'COM';
		break;
		case 4:
		$tld = 'INFO';
		break;
		case 5:
		$tld = 'FR';
	}
}
?>

<img src='./<?php echo $tld; ?> - logo de fermeture.png' style='position: absolute; top: -35%; left: 50%;' alt='les logo-contre-attentats de besancon25' width='50%' />

<img src='http://besancon25.fr/images/Hors-serie/CharlieHebdo-Attentat07012015/iamcharlie_1.gif' style='position: absolute; left: 15%; top: 15%;' alt='le deuxième gif animé en l'honneur des victimes de charlie-hebdo'  />

<img src='http://besancon25.fr/images/Hors-serie/CharlieHebdo-Attentat07012015/iamcharlie_2.gif' style='position: absolute; left: 30%; top: 15%;' alt='le troisième gif animé en l'honneur des victimes de charlie-hebdo'  />

<img src='http://besancon25.fr/images/Hors-serie/CharlieHebdo-Attentat07012015/iamcharlie_4.gif' style='position: absolute; left: 45%; top: 15%;' alt='le quatrième gif animé en l'honneur des victimes de charlie-hebdo'  />


<div style='position: absolute; top: 75%; text-align: left; '>
<h1 style='text-decoration: underline; '> En Deuil ... </h1>
<h6>En raison des &eacute;v&egrave;nements arriv&eacute; en cette date du 11 Novembre 2015 ( qui se souvient de la vraie date des attentats de NewYork ? ) Besan&ccedil;on25 ferme sa plate-forme durant une dur&eacute;e ind&eacute;termin&eacute;e .</h6>
</div>
<!--<div style='position: absolute; top: 90%; text-align: left; '>
<p><a href='http://www.wiwiannuaire.com'><img src='http://www.wiwiannuaire.com/wiwiannuaire-88x15.png' alt='Annuaire'></a>
</div></p>-->

<!-- Global Site Tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-43709598-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments)};
  gtag('js', new Date());

  gtag('config', 'UA-43709598-1');
</script>


</body>
</html>
