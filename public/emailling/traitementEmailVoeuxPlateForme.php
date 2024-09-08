<?php

include('../scriptPHP/cryptographie.php');
include('../scriptPHP/sessions.php');

function envoiEmail($adresse,$id,$type){
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
		<body>";
			if($type == 'VOEUX'){
				$message .= "<p align='center'><a href='http://besancon25.fr'><img src='http://besancon25.fr/images/NouvelAn/2013/carteVoeux2013.png'/></a></p>";
				$message .= "<h1 align='center'>Besan&ccedil;on 25 vous souhaite de joyeuses f&ecirc;tes 2012 <br />et<br /> un heureux Nouvel An 2013</h1>";
			}else{
				$message .= "<p align='center'><a href='http://besancon25.fr'><img src='http://besancon25.fr/images/NouvelAn/2013/carteNoel2012.png'/></a></p>";
				$message .= "<h1 align='center'>Besan&ccedil;on 25 vous souhaite un joyeux No&euml;l</h1>";
			}
			$message .= "<h3 align='center'>Ce courriel vous est adress&eacute; car vous &ecirc;tes inscrit sur la plate-forme de Besan&ccedil;on.<br />Le (B25) a &eacute;volu&eacute;, venez d&eacute;couvrir les nouvelles fonctionnalit&eacute; sur votre <a href='".afficheLienConnexionTransparente($id)."'>compte personnel.<img src='http://besancon25.fr/images/picto-lien.jpeg' width='15px' height='15px' /><img src='http://besancon25.fr/images/picto-cadenas.jpeg' width='15px' height='15px' /></a></h3>";
	$type_compte = rechercherTypeDeCompte($id);
	switch( $type_compte ){
		case 0:
			$message .= "<p align='center'>Vous &ecirc;tes le <b>SUPER-UTILISATEUR</b> !</p>";
		break;
		case 1:
			$message .= "<p align='center'>Vous &ecirc;tes un <b>Journaliste du (B25)</b> !</p>";
			$message .= "<p align='center'><u>Voici les nouveaut&eacute;s :</u></p><br />";
			$message .= "<p align='center'><i>Il y a une nouvelle gestion des dossiers:</i><br /> vous pouvez sauvegarder un dossier en cours d'&eacute;criture, visualiser vos dossiers en cours de validation par le r&eacute;dacteur en chef et consulter la liste de vos dossiers archiv&eacute;s (ainsi qu'&eacute;ventuellement s'il est affich&eacute; &agrave; ce moment l&agrave;!).</p>";
		break;
		case 2:
			$message .= "<p align='center'>Vous &ecirc;tes un <b>Artiste du (B25)</b> !</p>";
			$message .= "<p align='center'><u>Voici les nouveaut&eacute;s :</u></p><br />";
			$message .= "<p align='center'><i>Vous avez enfin une page personnelle:</i><br /> elle peut &ecirc;tre affich&eacute; dans le style d'un blog fB (c'est le mesuro-M&egrave;tre !) ou d'un site commun ( c'est le Tablo&iuml;d ! )</p>";
			$message .= "<p align='center'>Cette page r&eacute;f&eacute;rence tous les Tweets (B25) que vous avez r&eacute;alis&eacute;s :<br />qu'ils soient de vos humeurs, de vos images ou sons (t&eacute;l&eacute;charg&eacute; sur la plate-forme avec une limite de 20Mo),<br /> et/ou de vid&eacute;o connexes ( par le biais de liens YouTube, DailyMotion et quelques autres... Essayez! Vous verrez bien si le lien fonctionne !  )</p>";
		break;
		case 3:
			$message .= "<p align='center'>Vous &ecirc;tes une <b>Association du (B25)</b> !</p>";
			$message .= "<p align='center'><u>Voici les nouveaut&eacute;s :</u></p><br />";
			$message .= "<p align='center'><i>Vous avez enfin une page personnelle:</i><br /> elle permet de d&eacute;crire votre association avec un logo, une description et des liens connexes ( d'autres sites! )<br /> et une carte GoogleMap ( si votre adresse est correctement compris par Google !) vous permettant de situer votre maison m&egrave;re.</p>";
			$message .= "<p align='center'>Vous pouvez aussi enregistrer votre bureau et les membres ( actifs ou pas! ) de votre association.</p>";
		break;
		case 4:
			$message .= "<p align='center'>Vous &ecirc;tes un <b>Artisans du (B25)</b> !</p>";
			$message .= "<p align='center'><u>Voici les nouveaut&eacute;s :</u></p><br />";
			$message .= "<p align='center'><i>Vous avez enfin une page personnelle:</i><br /> elle permet de vous d&eacute;crire avec un logo et une description.<br /> Vous pouvez &eacute;galement y pr&eacute;senter vos articles ou vos prestations en donnant leurs un prix, une image ainsi qu'une courte description. </p>";
		break;
		case 5:
			$message .= "<p align='center'>Vous &ecirc;tes un Groupe Musical du (B25)</b> !</p>";
			$message .= "<p align='center'><u>Il y a des nouveaut&eacute;s :</u> VIENDEZ VOIR !</p><br />";
		break;
	}
	
	
	
			$message .= "<p align='center'>A bient&ocirc;t sur <a href='http://besancon25.fr'>Besan&ccedil;on 25</a></p>
			<br /><br /><br /><br /><br />
			<p align='center'>Et,<i> si vous voulez soutenir le d&eacute;veloppement de la plate-forme:</i> allez &agrave; <a href='http://besancon25.biz'>la page publicitaire</a> et : <i><b>fa&icirc;tes don d'un click !</b></i></p>
			<br /><br /><br />
			<p align='right'>L'administrateur</p>
		</body>
	</html>
		";
	mail( $TO, $subject, $message, $headers);
}
$type = $_POST['type'];
//visualisation des courriels
	echo "<html><head><title>Campagne courriel Associations...</title></head><body><p align='left'><b>Envoi des courriels de campagne �:</b></p><p>";
switch($_POST['destinataire']){
	case 1:
	$emails = array('administrateur@besancon25.fr');
	$ids = array('1');
	break;
	case 2:
	$emails = array();
	$ids = array();
	$sql1 = "SELECT email,id_utilisateur FROM artistes";
	$sql2 = "SELECT email,id_utilisateur FROM associations";
	$sql3 = "SELECT email,id_utilisateur FROM journalistes";
	$data = faireUneRequeteOffLine($sql1);
	while ( $resultat = mysql_fetch_row($data) ){
		if($resultat[0] != ""){
			$emails[] = $resultat[0];
			$ids[] = $resultat[1];
		}
	}
	$data = faireUneRequeteOffLine($sql2);
	while ( $resultat = mysql_fetch_row($data) ){
		if($resultat[0] != ""){
			$emails[] = $resultat[0];
			$ids[] = $resultat[1];
		}
	}
	$data = faireUneRequeteOffLine($sql3);
	while ( $resultat = mysql_fetch_row($data) ){
		if($resultat[0] != ""){
			$emails[] = $resultat[0];
			$ids[] = $resultat[1];
		}
	}
	break;
	}
	$i = 0;
	foreach($emails as $valeur){
		$id = $ids[$i];
		envoiEmail($valeur,$id,$type);
		$i++;
		echo $valeur."<br/>";
}
	echo "</p><p align='left'><a href='index.php?envoi=oui'>RETOUR</a></p></body></html>";
	//fin de visualisation des courriels
//header("location: index.php?envoi=oui");
?>
