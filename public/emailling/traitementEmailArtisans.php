<?php
function envoiEmailArtisansArts($adresse){
	$TO = $adresse;
	$subject = "Un site qui peut devenir utile pour les artisans de Besancon";
	$headers  = 	"From: L'administrateur du B25 <administrateur@besancon25.fr> \r\n"
			."MIME-Version: 1.0" 						. "\r\n"
			."Content-type: text/html; charset=iso-8859-1" 			. "\r\n"
			."Content-Transfer-Encoding: 8bit" 				. "\r\n"
			."Reply-To: apropos@besancon25.fr" 				. "\r\n"
			."Return-Path: administrateur@besancon25.fr"			. "\r\n"
			."Priority: normal"						. "\r\n"
			."X-Priority:3"							. "\r\n" //de 1 à 5
			."X-Sender: <www.besancon25.fr>"				. "\r\n"
			."Content-Description: Pr&eacute;sentation du (B25)"		. "\r\n";
			
	$message = "
	<html>
		<head>
		<title>Besancon25 - La plate-Forme des artistes/artisans et des associations/Groupes musicaux de Besan&ccedil;on vous ouvre ses portes.</title>
		</head>
		<body>
			<p align='center'><a href='http://besancon25.fr/index.php?page=inscription'><img src='http://besancon25.fr/besancon25.png'/></a></p>
			<p align='center'>Bonjour, ce courriel vous est adress&eacute; car vous &ecirc;tes un artisan d'ART de Besan&ccedil;on.</p>
			<p align='center'>le (B25) vous ouvre ses portes, il s'agit d'une plate-Forme d'&eacute;change pour les artistes/artisans et associations de Besan&ccedil;on ; afin que le site &eacute;volue, il a besoin de votre inscription, mais cela ne prends pas beaucoup de temps: juste une adresse email et quelques minutes de renseignements.</p>
			<p align='center'>&Agrave; l'heure actuelle la plate-forme vous permet, en tant qu'Artisan,d'<b>appara&icirc;tre</b> au sein d'une liste r&eacute;pertoriant:<br />votre nom et pr&eacute;nom,<br />la description de votre m&eacute;tier d'Art,<br />votre num&eacute;ro de t&eacute;l&eacute;phone,<br /> votre adresse administrative et votre adresse virtuelle ou courriel,<br />ainsi que votre Site Internet.<br /><br />d'avoir <b>une page personnelle</b> accessible publiquement, selon votre volont&eacute;, vous pr&eacute;sentant: vous et vos r&eacute;alisations.</p>
			<br /><br />
			<p align='center'>Vous avez aussi la possibilit&eacute; de d&eacute;poser vos <a href='http://besancon25.com/index.php?page=ecritureAnnonce'>annonces<img src='http://besancon25.fr/images/picto-lien.jpeg' width='15px' height='15px' /></a> sur le .COM de la plate-forme.<br />Celles-ci sont libres et gratuites mais soumises &agrave;  validation.</p>
			<p align='center'>Dans le cas o&ugrave; vous voudriez communiquer un &eacute;venement auquel vous participez,<br /> il vous suffit de le d&eacute;clarer sur <a href='http://besancon25.net/index.php?page=ecritureEvenement'>l'agenda <img src='http://besancon25.fr/images/picto-lien.jpeg' width='15px' height='15px' /></a>( le .NET de la plate-forme ).</p>
			<p align='center'>Si vous &ecirc;tes int&eacute;ress&eacute;, ou si vous avez des questions, n'h&eacute;sitez pas &agrave; envoyez un <a href='mailto:renseignements@besancon25.fr'>courriel </a>.</p>
			<br />
			<p align='center'>A bient&ocirc;t sur <a href='http://besancon25.biz'>Besan&ccedil;on 25<img src='http://besancon25.fr/images/picto-lien.jpeg' width='15px' height='15px' /></a></p>
			<p align='right'>L'administrateur</p>
		</body>
	</html>
		";
	mail( $TO, $subject, $message, $headers);
}

function envoiEmailArtisansMetier($adresse){
	$TO = $adresse;
	$subject = "Expertisez votre présence sur Internet";
	$headers  = 	"From: Votre contact Info[ARTS]Media <contact@infoartsmedia.fr> \r\n"
	."MIME-Version: 1.0" 								. "\r\n"
	."Content-type: text/html; charset=iso-8859-1" 					. "\r\n"
	."Content-Transfer-Encoding: 8bit" 						. "\r\n"
	."Reply-To: apropos@infoartsmedia.fr" 						. "\r\n"
	."Return-Path: contact@infoartsmedia.fr"					. "\r\n"
	."Priority: normal"								. "\r\n"
	."X-Priority:3"									. "\r\n" //de 1 à 5
	."X-Sender: <www.infoartsmedia.com>"						. "\r\n"
	."Content-Description: Pr&eacute;sentation des services"			. "\r\n";
		
	$message = "
	<html>
	<head>
	<title>Info[ARTS]Media vous offre une expertise de votre pr&eacute;sence sur Internet</title>
	</head>
	<body>
	<p align='center'><img src='http://infoartsmedia.info/logo.jpg'/></p>
	<br />
	<p align='center'>Bonjour,</p>
	<br />
	<p align='center'>Ayant r&eacute;cemment repris mon auto-entreprise dans le domaine du multim&eacute;dia et de l'informatique, je me permet de vous solliciter pour une <b>expertise gratuite et sans engagements de votre part</b>, sur l'&eacute;tat de votre pr&eacute;sence sur le r&eacute;seau Web d'internet...</p>
	<p align='center'>Je r&eacute;alise des blogs, vitrines, sites informatifs et portails internet &agrave; la commande sur la base d'un contrat de r&eacute;alisation et d'une convention d'h&eacute;bergement. Je peux &eacute;galement vous proposer une <b>analyse gratuite</b> de votre besoin sous la forme d'un questionnaire dans le cas o&ugrave; vous seriez en demande de ce type de prestations.</p>
	<p align='center'>Si vous &ecirc;tes int&eacute;ress&eacute;, ou si vous avez des questions, n'h&eacute;sitez pas &agrave; <a href='mailto:renseignements@infoartsmedia.fr'>m'envoyez un courriel</a>.</p>
	<p align='right'>Emmanuel ROY</p>
	<hr /><br /><br /><br /><br /><br /><br /><br /><i>
	<p align='center'>Je me permet par la m&ecirc;me occasion de vous pr&eacute;senter succintement <a href='http://besancon25.info'>la plate-forme du (B25)<img src='http://besancon25.fr/images/picto-lien.jpeg' width='15px' height='15px' /></a>,<br /> que je d&eacute;veloppe depuis maintenant pr&egrave;s de 3 ans: <br /><br />Il s'agit d'une plate-forme d'&eacute;change pour les artistes/artisans et associations de Besan&ccedil;on permetant un meilleur r&eacute;f&eacute;rencement au sein d'un micro-annuaire, qui offre une page personnelle et param&egrave;trable aux inscrits. De plus, le (B25) offre la possibilit&eacute; de d&eacute;poser des petites-annonces et des &eacute;venements &agrave; n'importe internaute de la r&eacute;gion bisontine.</p>
	<br />
	<p align='center'>A bient&ocirc;t sur <a href='http://besancon25.biz'>Besan&ccedil;on 25<img src='http://besancon25.fr/images/picto-lien.jpeg' width='15px' height='15px' /></a></p></i>

	</body>
	</html>
	";
	mail( $TO, $subject, $message, $headers);
}

//courte v&eacute;rification pour eviter un envoi multiple par rafraichissement de la page

if (!isset($_COOKIE['sent']))
{
	//pas d'envois pendant 2 minutes en cas de rafraifissement...
	setcookie('sent', '1', time() + 120);
	
//visualisation des courriels
	echo "<html><head><title>Campagne courriel Associations...</title></head><body><p align='left'><b>Envoi des courriels de campagne pour les artisans suivants :</b></p><p>";
	switch($_POST['artisans']){
		case 0:
		$emails = array('administrateur@besancon25.fr');
		foreach($emails as $valeur){
			envoiEmailArtisansArts($valeur);
			envoiEmailArtisansMetier($valeur);
			echo $valeur."--> OK!<br/>";
		}
		break;
		case 1:
		$emails = array('a.braun.joaillier@laposte.net','latelier.eglantine00@orange.fr','contact@obertino.com','bouillon@coincendre.com','etoffe-creation@orange.fr','msaghattchi@yahoo.fr','alain.trouttet@voila.fr','emmanuellechauveau@orange.fr','contact@emaux-creations.com','lowelectricguitars@gmail.com','estellecuinet@wanadoo.fr','bijouterie-avotreimage-morteau.com','arnoldhuot@msn.com','soleilroyal@wanadoo.fr','info@atelierfbgris.com','atelier.image.design@orange.fr','j.billey@mageos.com','brasserie.e2m@gmail.com','mazaniello@cartoneco.fr','pchaney@wanadoo.fr','griffartis@orange.fr','g.pierron@cm-doubs.fr','gimbel.nathalie@wanadoo.fr','louise.faindt@yahoo.fr','pafender@wanadoo.fr','fanny.dauge@labricosphere.com','laperlerare@amagalerie.com','lcb@ylae.fr','etienne.saillard@libertysurf.fr','alain.ricot@hotmail.fr','contact@lecriollo.com','lesmateriologues@wanadoo.fr','maurice.beaufort@wanadoo.fr','manu@miz-o-point.fr','mon.desir25@gmail.com','nanni.pizza@yahoo.fr','laurentbruno228@neuf.fr','szennoud@yahoo.fr','liechti.gil@hotmail.com','sellerie.tapisserie.fred@gmail.com','contact@services-a-domiciles.com','contact@theoucafe.fr','claudine.de.barba@wanadoo.fr','vaudri.elec@orange.fr','atelierbeatrice@yahoo.fr','gaetan.vitali@gmail.com','jacques.perrey@hotmail.fr','lacoste.j@wanadoo.fr','christophe.erny.543@orange.fr','gravure.gillmann@orange.fr','pretresarl@wanadoo.fr','omahe@hotmail.fr','vuedesalpes@orange.fr','contact@fonderies-val-de-saone.com','b.patois@amagalerie.com','f.souville@fef-fantasy.org','contact@atelier-nicolas-autin.com','estelle-meunier@orange.fr','contact@cordeline.com','crealice90@gmail.com','metiersdart.ornans@yahoo.fr','contact@fanny-dauge-mosaiste.com','ojardinsucre@yahoo.fr','vincy25@orange.fr','jacquotfrancois@sfr.fr','gravure.glllmann@orange.fr','christine.mongenet@wanadoo.fr','elodie.famel@free.fr','laetitiagelas@free.fr','psp@psp-peugeot.com','philippe.lebru@utinam.fr','vincentdeniset@yahoo.fr','prototype@a-little-world.com','elisabeth.le-gros-bottcher@orange.fr','tiphainejakino@aol.com','atelierdececile@wanadoo.fr','maryan39@wanadoo.fr','apecheur@sfr.fr','annethiellet@wanadoo.fr','letitiagelas@voila.fr','info@bois-lutherie.com','chrisitne.bistchene@sfr.fr','terreetcouleurs@voila.fr','info@atelierdessavoirfaire.fr','atelier.de.creations@wanadoo.fr','carol@artisans-de-madagascar.fr');
		foreach($emails as $valeur){
			envoiEmailArtisansArts($valeur);
			echo $valeur."--> OK!<br/>";
		}
		break;
		case 2:
		$emails = array('jflallement@wanadoo.fr','agmlabbaci@yahoo.fr','abcmaconnerie@free.fr','acinox@orange.fr','lgreusard@adeoinformatique.com','enajjar17a@hotmail.com','franck.mahieux@wanadoo.fr','aictechnologie123@orange.fr','pascal.dumay@air-expert.fr','air-expert@air-expert.fr','ajfermetures@free.fr','perrinyvan@gmail.com','allodepannage25@orange.fr','amequetzalamestudio@hotmail.fr','amorosini.p@voila.fr','raphael.simonyan@gmail.com','atelier.sgabello@free.fr','bee.bien.etreelectrique@live.fr','bernard.guyon025@orange.fr','contact@saone-auto.fr','biguenet.nicolas@neuf.fr','gwaleau@wanadoo.fr','jpbbouclans@club-internet.fr','scieriebarret@laposte.net','nicolas.bondenet196@orange.fr','bordatp@wanadoo.fr','borduresinnovation@hotmail.fr','therese.boussi@orange.fr','boutesco@wanadoo.fr','c.j25@orange.fr','christelle.bergier@wanadoo.fr','location-campingcar@wanadoo.fr','henriotsp@aol.com','bcdprodcommercial@gmail.com','cdtt.canillo@orange.fr','info@cdtt.fr','contact@chabert-electricite.fr','champvans-tp@wanadoo.fr','cheminees.salomon@wanadoo.fr','artijane@free.fr','contact@arti-show.fr','ateliercheznous@hotmail.fr','jfizet@ateliercreationjf.com','atelier.nelly.braud@orange.fr','vcuny@wanadoo.fr','atelierdes3portes@orange.fr','ligneadomus@gmail.com','acolisson@bluewin.ch','d.clergeot@yahoo.fr','cpae@abelic.com','rsm1@orange.fr','culturelec@wanadoo.fr','dfdst@hotmail.fr','david.varlet3@wanadoo.fr','laure.lumi&egrave;re@orange.fr','contact@decapdoux.fr','deco-chalet-vieux-bois@laposte.net','h2o@decoupe.eu','didier.chaudot@wanadoo.fr','contact@toiture-chaudot.fr','frederic.didier@orange.fr','contact@didierjacquot-photographe.com','giorgio.deriu@wanadoo.fr','drezetreth@wanadoo.fr','levieux25220@hotmail.fr','yann@e2m-mecanique.com','romain@e2m-mecanique.com','infos@ecodoubio.fr','contact@ecorenov.com','ecrindebois@gmail.com','florent.drezet@hotmail.fr','entreprisebessonnet@yahoo.fr','christassart@tele2.fr','erap-auto@wanadoo.fr','espacecopie25@wanadoo.fr','estevenement@wanadoo.fr','etatdesiege@hotmail.fr','nicolas.mathieu18@wanadoo.fr','fil.gros@orange.fr','contact@ebenisterielaseve.fr','info@eurotol.com','ets.ferniot@orange.fr','chevreux.flo@wanadoo.fr','nad-vecreations@orange.fr','laurent.guignaud@wanadoo.fr','frederic.schmerber@orange.fr','commercial@gaiffe.fr','darbo-tuning@iptec.fr','fil.gauthier@orange.fr','dadye.g@hotmail.fr','christophe-grandvuillemin@orange.fr','vgoguely@wanadoo.fr','griffdange@gmail.com','gcb25@orange.fr','','gwd25@orange.fr','c.hayeck@free.fr','homelec@sfr.fr','mardis23@hotmail.com','imprimerie.baumann@wanadoo.fr','linstitut.boheme@orange.fr','isa.beaute@orange.fr','linstant25@orange.fr','labonheure.nicolas@orange.fr','contact@ylae.fr','contact@les-cles-administratives.fr','michelbernardadam@laposte.net','marcel.duret@wanadoo.fr','maisonsjardinspropres@orange.fr','horloge.moncozet@gmail.com','mdbatiservices@hotmail.fr','mcunin@hotmail.fr','info@pimas.fr','mdeo@wanadoo.fr','menuiserie.bertin@wanadoo.fr','boiteux.jm@wanadoo.fr','fredblondey@orange.fr','franck-chenu@wanadoo.fr','menuiserievonin@orange.fr','1001recup@gmail.com','contact@mobex-design.fr','nascars@live.fr','patisseriedelacitadelle@orange.fr','peigney.seb@free.fr','auto.pernot@wanadoo.fr','didier.pesenti@gmail.com','mickael.piralli@wanadoo.fr','planete.trophee@wanadoo.fr','jeanningros.patrick@free.fr','rosellopat@gmail.com','rs@pneudiag.fr','bague035@orange.fr','nicolas.frayon@gmail.com','delosy@free.fr','rouchepeinture@yahoo.fr','accueil@rouhier.fr','tp.roussey@orange.fr','roy.patissier.traiteur@wanadoo.fr','jeannot.jm@wanadoo.fr','eric.fallaix@wanadoo.fr','salomon.trike@orange.fr','batifacades@hotmail.fr','bruno-morel@wanadoo.fr','sarldelfils@free.fr','liechti.gil.@hotmail.com','yann-guerin@club-internet.fr','frink@wanadoo.fr','laiterie.lizon@wanadoo.fr','sarlpetrement@orange.fr','bailly-grandvaux.noel@wanadoo.fr','franco.diviesto@free.fr','slidermotos@orange.fr','joseph@smfacades.fr','bj86@wanadoo.fr','stenpro@cegetel.net','taxi-paquelet@laposte.net','contact@technologis25.fr','contact@therco-ind.fr','therco@wanadoo.fr');
		foreach($emails as $valeur){
			envoiEmailArtisansMetier($valeur);
			echo $valeur."--> OK!<br/>";
		}
		break;
	}
}
	echo "</p><p align='left'><a href='index.php?envoi=oui'>RETOUR</a></p></body></html>";
//fin de visualisation des courriels
