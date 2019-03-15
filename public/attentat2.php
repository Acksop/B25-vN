<?php
session_start();
$time = getmicrotime();
if(!isset($_SESSION['TIME_REFRESH'])){
	$_SESSION['TIME_REFRESH'] = $time;
}
if($_SESSION['TIME_REFRESH'] < $time){
	$_SESSION['TIME_REFRESH'] = 0;
}
?>
<html>
<head>
<title>Besan&ccedil;on 25 - La plate-Forme des artistes/Artisans et des
	groupes/Associations de Besan&ccedil;on - v1.5c - &alpha; version</title>
<!---------------------------------------------------------------------------------------------------------------------------------------->
<!--						BALISES DE META-RECHERCHES								-->
<META NAME="Category" CONTENT="Plate-forme">
<META NAME="Publisher" CONTENT="INFO[ARTS]MEDIA">
<META NAME="Copyright" CONTENT="© - 2010 - Info[ARTS]Media">
<META NAME="Expires" CONTENT="Never Maybe!">
<META NAME="Description"
	CONTENT="Site communautaire pour les artistes/Artisans - Groupes/Associations et (bient&ocirc;t) Collectifs/Sportifs de Besan&ccedil;on">
<META NAME="Distribution" CONTENT="Global">
<META NAME="Identifier-URL"
	CONTENT="<?php echo $_SERVER['HTTP_HOST']; ?>">
<META NAME="Keywords"
	CONTENT="Journal, Doubs, Besançon, Besancon, 25000, 25, artiste, artistes, artisant, artisants, association, associations, article, articles, dossier, dossiers, arts, art">
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

switch ($_SERVER['HTTP_HOST']) {
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
?>

<img src='./<?php echo $tld; ?> - logo de fermeture.png'
		style='position: absolute; top: 25%; left: 50%;'
		alt='les logo-contre-attentats de besancon25' width='20%' />
<div style='position: absolute; top: 75%; text-align: left;'>
	<h1 style='text-decoration: underline;'>En Deuil ...</h1>
	<h6>En raison des &eacute;v&egrave;nements arriv&eacute; en cette date <br/>
	 du 11-14 Novembre 2015 <br/>
	Ainsi que les attentats terroristes islamistes extrème ayant perdurer <br/>
	 après cette date ( Nice, Bruxelles, Berlin, ...) <br/>
 	( qui se souvient de la vraie date des attentats de NewYork ? ) <br/>
 	<!-- 11/11/2001 https://fr.wikipedia.org/wiki/Attentats_du_11_septembre_2001 -->
 	 <br/>
 	 Besançon25 ferme une de ses interface durant une durée indéterminée . <br/>
<pre>
<?php
if($_SESSION['TIME_REFRESH'] < $time){
	echo "Il se peut-&ecirc;tre que cette section de plate-forme peut &ecirc;tre lié à une ...
	 <!-- action manifestante aléatoire ou/et encore plein d'autre trypique de phrase du genre (no GiveUp F5 for less) ! -->	  ... en cours.";
}
if($_SESSION['TIME_REFRESH'] == $time){
	echo "
	Le texte peut changer fréquemment,
	 n’est peut-être pas à jour et peut manquer de recul.
	  N’oubliez pas que, dans nombre de systèmes,
	   toute personne est présumée innocente tant que sa culpabilité
	    n’a pas été légalement et définitivement établie,
	     mais aussi que l'inverse est possible...

	N’hésitez pas à participer/gueuler ni à citer/lier vos sources.

	 →  Dernière modification de cette page: voir 'les sources de c'te heure'.
	 
	 il se pourrait qu'une interface de contournement soit mise en place
	  pour les plus féru des astuces du web.............
	 
	";
}
if( $_SESSION['TIME_REFRESH'] == 0){

	echo "
	   Si si c'est bien celle là !
	   
	Sur l'Wikini, voir aussi :
	 
	Drolerie ou pas drolerie,
	 Humour ou pas Humour,
	  Merdissime ou pas,
	   y a des trucs pire sur Internet
	   !! quant elle sera faite ! sinon rabattez vous sur ville de dragons (^_^) !
	";
}
?>
Évidemment le cout de cette section de plate-forme, ni de l'un de ses ancien satellites
	( 
	<a href='http://besancon25.com/'>COMMERCIAL selon les termes de l'AFNIC</a>
	 et
	<a href='http://besancon25.net/'>NETWORK selon les termes de l'AFNIC</a>
	) n'est plus évaluable
	<br>
	donc certaines fonctionnalités para&icirc; &ecirc;tre GRATOS,
	 mais la véritable interface viable pour un projet comme
	  celui là est déjà en ligne sur l'adresse native
	   de ce projet de grande envergure.
</pre>
<div style='position: absolute; top: -33px; text-align: left; '>
<p><a href='http://www.wiwiannuaire.com'><img src='http://www.wiwiannuaire.com/wiwiannuaire-88x15.png' alt='Annuaire'></a>
</div>
<div style='position: absolute; top: 0px; text-align: left; '>
<p><a href='http://www.google.com'><img src='./logo_google_top.jpg' alt='Analytics'></a>
</div>

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
