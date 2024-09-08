<?php 
/*TODO : put a variablesApplicationFile to standardize traitements and all other things :) Must be the first modification*/
date_default_timezone_set('Europe/Paris');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
/**/

$debut_memoire = memory_get_usage();
$debut = $_SERVER['REQUEST_TIME'];
$dateFormat = date("m-d-Y");

include('fonctionCourante.php');
include('scriptPHP/memoire.php');

session_start();
//connectes();
$ip = $_SERVER['REMOTE_ADDR'];

//statistiques CrawlTrack
global $crawltsite;$crawltsite=1;
//include("scriptPHP/crawltrack3-3-2/crawltrack.php");

//TODO: modifier l'instanciation de la variable page par un réécriture des liens et une traduction de l'URL
// dans cette même fonction réévaluer les variables _GET en fonction du lien de la page .
// par exemple les variable venant de CrawlTrack
// $page = Url::traductionURL();

//initialisation de la variable page pour eviter les erreurs 404
if(!isset($_GET['page'])){
	$page = "index";
}else{
	$page = $_GET['page'];
}
//chargement des variables pour un meilleur réferencement
ChargerVariablesInitialesHeader($page);
//chargement du modele et de ses fonctions pour la page courante
ChargerModeleEtFonctionsDeLaPage($page);
//convertir les variables du header pour que Google les affichent lisiblement
ConvertirVariablesHeader($page);
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html/loose.dtd">
<html>
<head>
<title><?php echo $header_title ?></title>
	<!-- ------------------------------------------------------------------------------------------------------------------------------------ -->
	<!--						BALISES DE META-RECHERCHES								-->
	
	<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
	
	<!-- 																				 -->
	
	<META NAME="Category" CONTENT="Plate-forme">
	<META NAME="Publisher" CONTENT="INFO[ARTS]MEDIA">
	<META NAME="Copyright" CONTENT="© - 2010 - Info[ARTS]Media">
	<META NAME="Expires" CONTENT="Never Maybe!">
	<META NAME="Distribution" CONTENT="Global">
	<META NAME='Description' lang='fr' CONTENT="<?php echo $header_description ?>">
	<META NAME='Identifier-URL' CONTENT="<?php echo $header_identifier_url ?>">
	<META NAME='Keywords' lang='fr' CONTENT="<?php echo $header_keywords ?>">		
	<META NAME="Author" CONTENT="Emmanuel ROY & More ...">
	<META NAME="Reply-to" CONTENT="contact@besancon25.info">
	<META NAME="Date-Creation-yyyymmdd" CONTENT="20090317">
	<META NAME="Date-Revision-yyyymmdd" CONTENT="20100712">
	<META NAME="Revisit-After" CONTENT="30 days">
	<META NAME="Robots" CONTENT="index, nofollow">
	<META NAME="GOOGLEBOT" CONTENT="NOARCHIVE">
	<!--																	-->
	<!-- ------------------------------------------------------------------------------------------------------------------------------------ -->
	<!--																	-->
	<META HTTP-EQUIV="Content-Language" CONTENT="fr">
	<META HTTP-EQUIV="Refresh" CONTENT="NO">
	<link REL="shortcut icon" HREF="images/logoo.ico" />
	<link rel="alternate" type="application/rss+xml" href="fluxRSS.php?flux=RSS" title="Flux RSS du (B25) - La plate-forme des Artistes,Artisans,Groupes et Associations">
	<link rel="alternate" type="application/rss+xml" href="fluxRSS.php?flux=ATOM" title="Flux ATOM du (B25) - La plate-forme des Artistes,Artisans,Groupes et Associations">
	<!--																	-->
	<!-- ------------------------------------------------------------------------------------------------------------------------------------ -->
<?php PositionneCSS(); ?>
<script type='text/javascript' src='scriptJS/ajax.js'></script>
<script type='text/javascript' src='scriptJS/horloge.js'></script>
</head>

<body onLoad='Horloge_Start()'>

<div class='menu'>
	<?php AfficheMenu(); ?>
</div>

<div class='sousmenu'>
	<?php AfficheSousMenu(); ?>
</div>

<div class='imagebd'>
	
	<!-- Cette animation Impressionnante à été créée par Justin Windle en Javascript
			Elle est disponible a l'adresse http://soulwire.co.uk/experiments/recursion-toy/
			All my thanks to Him - Merci! pour tes expérimentations :) !
			Contactez le à l'adresse : justin@soulwire.co.uk <justin@soulwire.co.uk>;
	-->
	
	<canvas style="position:relative;left:-300px; top:-400px;" id="canvas" width="800" height="600"></canvas>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
		<script src="scriptPHP/Recursion-Toy-master/js/lib/DAT.GUI.min.js"></script>
		<script src="scriptPHP/Recursion-Toy-master/js/lib/RAF.js"></script>
		<script src="scriptPHP/Recursion-Toy-master/js/recursion.js"></script>
</div>
<div class='limiteur'>&nbsp;</div>
<?php
$interface = recuperationCookieInterface();

if($page == 'preferences' || $interface == 6 || $interface == 9 || $interface == 10 || $interface == 11 || $interface == 12){
	echo"<div class='gueuloir'>";
	AfficheGueuloir();
	echo "</div>";
}

/*	
		$debut_microtime = getmicrotime();
		$debut_utilisation_memoire= memory_get_usage();
		$debut_de_pic_memoire = memory_get_peak_usage();
		
		ecrireFichier__logs_memoire__Debut($ip,$_SERVER['REQUEST_URI'],$debut_microtime,$debut_utilisation_memoire,$debut_de_pic_memoire);
	*/	
?>
<div class='corps'><a name="corpsPage" href="#"></a>
	<div class='contenu'>
		<?php
		 $pic_memoire = memory_get_peak_usage();
		 AffichePage($page);	
		?>
	</div>
	<div class='piedDePage'>
		<center>
		<br /><br /><br /><br />
		<p>Besan&ccedil;on 25 c'est aussi d'autres terminaisons de domaines,et des sous-domaines afin de simplifier l'utilisation du m&eacute;dia Internet:</p>
			<ul>
			<li>Une page r&eacute;serv&eacute;e aux <a href='http://besancon25.com'>petites-annonces</a> des artistes et artisans sur le .com</li>
			<li>Un agenda r&eacute;serv&eacute; aux <a href='http://besancon25.net/index.php'>&eacute;v&egrave;nements</a> des associations et groupes musicaux sur le .net</li>
			<li>Une page de <a href='http://besancon25.biz'>publicit&eacute;s</a> r&eacute;serv&eacute;e aux annonceurs, commerces et m&eacute;c&egrave;nes sur le .biz</li>
			<li>Une page informative sur le porte-feuille des marques <a href='http://unilever.besancon25.fr'>Unilever</a></li>
			</ul>
		</p>		
		<p>
		Besan&ccedil;on 25 est un site &eacute;dit&eacute; par <a href='http://infoartsmedia.fr'>Info[ARTS]Media</a>.
		<br /><br />
		Le serveur est h&eacute;berg&eacute; en contrat avec <a href="https://www.1and1.fr/?kwk=20117144" target="_blank">1 and 1</a> (1&1 Internet SARL / 7, place de la Gare / BP 70109 / 57201 Sarreguemines Cedex ), dans un de ses centres de donn&eacute;es.
		<br />
		Ce site respecte les droits des Internautes r&eacute;gis par les articles de la loi <i>Informatique et Libert&eacute;es</i> accessible sur le site de la <a href='http://www.cnil.fr'>CNIL</a>
		<br />
		Les <a href='http://www.cnil.fr/vos-obligations/sites-web-cookies-et-autres-traceurs/' >"Cookies informatiques"</a> sont uniquements utilis&eacute;s afin que chaque poste-logiciel ait la possibilit&eacute; de choisir sa propre <a href='index.php?page=preferences'>interface</a> .
		</p>
		<table border='0'><tr><td>
		<a href="http://s08.flagcounter.com/more/Uoc8"><img src="http://s08.flagcounter.com/count/Uoc8/bg_CCCCCC/txt_000000/border_CCCCCC/columns_8/maxflags_248/viewers_Visiteurs/labels_0/pageviews_1/flags_0/" alt="Free counters!" border="0"></a>
		</td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td>
		<?php
		AfficheNbConnectes();
		//Calcul du temps de défenestration de la page ... (^_^)
		$fin = getmicrotime(); 
		$fin_memoire = memory_get_usage();
		echo "<h6><font color='#FFFFFF'>G&eacute;n&eacute;ration de la page: </font>"
				."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".time_elapsed_millisecs($fin-$debut)
				."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".lectureHumaineOctet($debut_memoire)."/".lectureHumaineOctet($fin_memoire)." ^^ ".lectureHumaineOctet($pic_memoire)."</h6>"; 
		?>
		</td></tr></table>
		</center>
	</div>
</div>

<?php
/*
		$fin_microtime = getmicrotime();
		$fin_utilisation_memoire = memory_get_usage();
		$fin_de_pic_memoire = memory_get_peak_usage();
		
		ecrireFichier__logs_memoire__Fin($ip,$_SERVER['REQUEST_URI'],$debut_microtime,$fin_microtime,$debut_utilisation_memoire,$debut_de_pic_memoire,$fin_utilisation_memoire,$fin_de_pic_memoire);


<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-43709598-1', 'besancon25.fr');
  ga('send', 'pageview');

</script>
*/
?>
</body>
</html>