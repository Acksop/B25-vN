<?php
function envoiEmail($adresse){
	$TO = $adresse;
	$subject = "Un nouveau site qui peut devenir utile pour les associations de Besancon";
	$headers  = 	"From: administrateur@besancon25.fr \r\n"
			."MIME-Version: 1.0" . "\r\n"
			."Content-type: text/html; charset=iso-8859-1" . "\r\n";
	$message = "
	<html>
		<head>
		<title>Besancon25 - La plate-Forme des artistes et des associations de Besan&ccedil;on ouvre ses portes.</title>
		</head>
		<body>
			<p align='center'><a href='http://besancon25.fr'><img src='http://besancon25.fr/besancon25.png'/></a></p>
			<p align='center'>Un site tout nouveau viens d'ouvrir ses portes, il s'agit d'une plate-Forme d'&eacute;change pour les artistes/artisants et associations de Besan&ccedil;on</p>
			<p align='center'>Ce courriel vous est adress&eacute; car vous &ecirc;tes une association  de Besan&ccedil;on. Pour que le site &eacute;volue, il a besoin de votre inscription, cela ne prends pas beaucoup de temps: juste une adresse email et cinq minutes de renseignement.</p>
			<p align='center'>Il permettra &agrave; terme de pr&eacute;senter les derni&egrave;res actions des associations sur la page de garde du site. Actuellement vous pouvez poster des &eacute;v&egrave;nements qui se trouve sur le <a href='http://besancon25.net'>.NET</a> du site. Si vous &ecirc;tes int&eacute;ress&eacute; renvoyez un courriel pour que la modification se fasse plus rapidement.</p>
			<p align='center'>A bient&ocirc;t sur <a href='http://besancon25.fr'>Besan&ccedil;on 25</a></p>
			<p align='right'>L'administrateur</p>
		</body>
	</html>
		";
	mail( $TO, $subject, $message, $headers);
}

	//visualisation des courriels
	echo "<html><head><title>Campagne courriel Associations...</title></head><body><p align='left'><b>Envoi des courriels de campagne �:</b></p><p>";
	switch($_POST['test']){
		case 0:
		$emails = array('administrateur@besancon25.fr');
		break;
		case 1:
		$emails = array('assocges@gmail.com','adoc.fcomte@gmail.com','kokocinell@caramail.com','campusbesancon@wanadoo.fr','meslouh.othman@caramail.com','voinot@lifc.univ-fcomte.fr','besace@ens2m.fr','forestchristine@yahoo.fr','gala@ens2m.fr','linda.dally@edu.univ-fcomte.fr','mathieu.baf@gmail.fr','contact@comet.asso.fr','epistemes@afneus.org','association-attome@femto-st.fr','jerome.noir@hotmail.fr','sportstaps@yahoo.fr','gerard.messin@univ-fcomte.fr','tsrt_chb@yahoo.fr','sounvi@hotmail.fr','jrmaillot@yahoo.fr','salsamoondo@free.fr','malkitsigani@no-log.org','kaya.asso@gmail.com','isf.besancon@gmail.com','humabio@yahoo.fr','asso_essi@hotmail.fr','ansukarama@hotmail.com','association_guinee25@yahoo.fr','chouirefaomar@yahoo.fr','abesi.assos@hotmail.fr','ju_touyard@hotmail.com','linsen1983@gmail.com','tufc@univ-fcomte.fr','phedre@noos.fr','pangaya25@hotmail.fr','orchestre.universitaire@univ-fcomte.fr','liphisa_liphisa@yahoo.com','ludiarti@neuf.fr','interferences.secretaire@yahoo.fr','gbu.besancon@free.fr','delabriseaudeluge@free.fr','batslesmasques@gmail.com','projet-aurore@univ-fcomte.fr','contact@apacabesancon.com','chorale.universitaire@univ-fcomte.fr','besacagefc@yahoo.fr','seck.aicha@hotmail.fr','aeibes@hotmail.com','paulineharris53@yahoo.fr','lois.forster@laposte.net');
		break;
		case 2:
		$emails = array('artaide@wanadoo.fr','la.decotheque@free.fr','dicietdailleurs25@orange.fr','j.j.w@orange.fr','grigrilantigris@orange.fr','intermedgeo@gmail.com','lesamisdebourgeois@wanadoo.fr','salvador.stephane@free.fr','pavedanslamare@wanadoo.fr','contact@apacabesancon.com','franck.labourier@free.fr','roger.journot.ccppo@orange.fr','accueil@pbtristan.fr','decarache@hotmail.fr','francois-alexandre.guyot@voila.fr','phedre@noos.fr','geradbruot@orange.fr','tissot.jerome@free.fr','latelierdeladanse@laposte.net','lacavernedesmaries@wanadoo.fr','asso@cie-courant-dair.com','info@compagnie-pernette.com','ass.hanabi@wanadoo.fr','almadelflamenco@yahoo.fr','dacel.danse@gmail.com','clubdedansezoe@voila.fr','duendeflamenco25@free.fr','infotdk@club-internet.fr','salsamoondo.asso@gmail.com','contact@culture-besancon.fr','contact@sequanux.org','francois-alexandre.guyot@voila.fr','presidence@akt-radio.com','campusbesancon@wanadoo.fr','info@radio-shalom-besancon.com','rcf.besancon@wanadoo.fr','jp.bonjour@orange.fr','sedac@orange.fr','jean.vernerey@orange.fr','jacquot.claude@numericable.com','fedac@orange.fr','c.philbert@wanadoo.fr','u.n.c.25@orange.fr','locatelli.rene@wanadoo.fr','paulineharris53@yahoo.fr','jacques.m.fontaine@gmail.com','jilali.fellaou@free.fr','guy.challiol@wanadoo.fr','marc.dahan@univ-fcomte.fr','lindadossantos@hotmail.fr','chouirefoamar@yahoo.frsvalgro@hotmail.com','cma.25@hotmail.com','assan.abderamane@laposte.net','samiramouss@wanadoo.fr','assportugaise@aol.com','jacqueline.poux@laposte.net','ecoledechinois@univ-fcomte.fr','josiane.degrey@sfr.fr','latinoamericalli@voila.fr','fcquebec@voila.fr','crican07@orange.fr','97-ka@live.fr','circolo-sarde-su-tirsu@laposte.net','mkoubi@free.fr','wassi_na_wagnou@yahoo.fr','christinepatrick.rougeot@orange.fr','martine.coutier@wanadoo.fr','j@jcauge.com','contact@cppr-fr.com','contact@questions-de-gout.fr','foltete-d@club-internet.fr','pmagnien@9online.fr','art-et-restauration@wanadoo.fr','germainetillion-rencontre@orange.fr','lionel.francois@besancon.fr','ducros.pascal@gmail.com','michele.manchet@wanadoo.fr','grenierb22@yahoo.fr','funibregille@yahoo.fr','contact@fems.asso.fr','fortisarcheo@yahoo.fr','ma.fc@wanadoo.fr','petites.cites.comtoises@orange.fr','daniel.weber@aliceadsl.fr','j-m-d.pinel@orange.fr','jean_louis.clade@wandoo.fr','lefacteurdhistoires@ornage.fr','contact@aafc.fr','jean-gerad.theobald@wanadoo.fr','franche-comte@lespetisdebrouillards.orgs','sfmc@obs-besancon.fr','jacques.breton21@laposte.net','demon.cec@orange.fr','contact@enfants-espoir.net','annie.pousse@dbmail.com','m-otilia@free.fr','daniel.jozan@orange.fr','chenestrels@free.fr','chorale.universitaire@univ-fcomte.fr','tonnerre.jacques@wanadoo.fr','secretaire@laconcorde-saintferjeux.fr','michelbrigandat@aol.com','presidence@harmonie-besancon.asso.fr','alain.chevillard@wanadoo.fr','claire.dolibeau@ac-besancon.fr','mogobeassociation@yahoo.fr','ateliermusical@yahoo.fr','anne.blanc-velotte@laposte.net','choeurcorps@wandoo.fr','michel.card1@laposte.net','contact@caem-planoise.asso.fr','grillet.coccinote@voila.fr','fagggg.guyot@gmail.com','famfc@wanadoo.fr','fmfc@wanadoo.fr','ce.0250008y@ac-besancon.fr','jyp.homestudio@orange.fr','pklinguer@numeo.fr','simba_rex@hotmail.com','contact@festival-besancon.com','guit-art-info@sfr.fr','medialto@tele2.fr','acuche@wanadoo.fr','daniele.berger25@orange.fr','orchestre.universitaire@univ-fcomte.fr','r_dumoulin_1@hotmail.com','gaugler25@orange.fr','aspro.impro@gmail.com','contact@studio-zebre.com','attil25@hotmail.com','contact@austin-newcomers.com','batslesmasques@gmail.com','cfdt.1ermai@voila.fr','selim.chanard@gmail.com','interferences25@orange.fr','jmf.franchecomte@lesjmf.org','contact@lebastion.org','chapeau.paille@wanadoo.fr','contact@lecitronvert.org','info@grenouilles-de-salem.com','mightyworms@gamil.com','tennisoap@yahoo.fr','jodom.michel@libertysurf.fr','uppertone25@yahoo.fr','contact@xnroll.fr','25b@advbs.fr','bibmalades-sj@chu-besancon.fr','culturel.urfolfc@orange.fr','terrespeuplesafrique@voila.fr','therese.jardiniere@iteo.org','jacqueline.lbl@wandoo.fr','asso.entrepot@gmail.com','lautodidacte@lautodidacte.lautre.net','mvtpaix25@free.fr','martine.coutier@wanadoo.fr','crlfc@wanadoo.fr','info@croqlivre.asso.fr','manu.cebe@wanadoo.fr','adrienouadrienne@yahoo.fr','prod5etoile@yahoo.fr','postmaster@lamaisonchauffante.com','contact@culture-action.org','m-s-k@live.fr','dec.autorise@gmail.com','acte_9@yahoo.fr','cie.alatienne@yahoo.fr','aline@hommevert.com','altps@hotmail.fr','bouillotteetcompagnie@laposte.net','lacompagniedesmimes@wanadoo.fr','ciepetitmaximum@gmail.com','compagnie_keichad@yahoo.fr','entre-terre-et-ciel@hotmail.fr','koalaproduction@orange.fr','la.chamade@free.fr','patrick.melior@free.fr','cie.gbec@free.fr','genreationk7@gmail.com','info@passe-muraille.org','la-grosse-entreprise@wanadoo.fr','v.filliozat@free.fr','tsrt_chb@yahoo.fr','bouti-conte@wanadoo.fr','grainedevie@worldonline.fr','cieka@hotmail.com','livredecontes@wanadoo.fr','valkyrira@yahoo.fr','ludiarti@hotmail.fr','theatre.bacchus@wanadoo.fr','laude.bernard@orange.fr','cieldubrouillard@gmail.com','compagnieducolibri@free.fr','compagnie.embarquez@gmail.com','infos@intempestifs.fr','compagnielts@orange.fr','ciemalanoche@yahoo.fr','teralunacompagnie@yahoo.fr','infos@theatre-contemporai.net','dindesetcompagnie@hotmail.fr','ch.lyet@wandoo.fr','ludiarti@hotmail.fr','thea.menteuse@orange.fr','theatre.espace@wanadoo.fr','bouvret.jeanrene@laposte.net','theatre.des.sources@free.fr','marie.chabauty@gmail.com','theatre.lephilpat@orange.fr','tufc@univ-fcomte.fr');
		break;
	}
	
	//recuperation des courriels des inscrits pour eviter l'envoi de duplicata
	$emailsInscrit = array();
	$ids = array();
	$sql1 = "SELECT email,id_utilisateur FROM artistes";
	$sql2 = "SELECT email,id_utilisateur FROM associations";
	$sql3 = "SELECT email,id_utilisateur FROM journalistes";
	$data = faireUneRequeteOffLine($sql1);
	while ( $resultat = mysql_fetch_row($data) ){
		if($resultat[0] != ""){
			$emailsInscrit[] = $resultat[0];
			$ids[] = $resultat[1];
		}
	}
	$data = faireUneRequeteOffLine($sql2);
	while ( $resultat = mysql_fetch_row($data) ){
		if($resultat[0] != ""){
			$emailsInscrit[] = $resultat[0];
			$ids[] = $resultat[1];
		}
	}
	$data = faireUneRequeteOffLine($sql3);
	while ( $resultat = mysql_fetch_row($data) ){
		if($resultat[0] != ""){
			$emailsInscrit[] = $resultat[0];
			$ids[] = $resultat[1];
		}
	}
	
	//envoi des courriels
	foreach($emails as $valeur){
		if(!in_array($valeur , $emailsInscrit)){
			envoiEmail($valeur);
			echo $valeur."--> OK! <br />";
		}else{
			echo $valeur."--> INSCRIT! <br />";
		}
}
	echo "</p><p align='left'><a href='index.php?envoi=oui'>RETOUR</a></p></body></html>";
