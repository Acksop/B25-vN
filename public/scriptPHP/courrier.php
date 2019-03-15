<?php

if(DEV_verificationINCLUSIONS){
	$page = explode("/",__FILE__);
	$fichier_inclus = array_pop($page);
	echo $fichier_inclus." >>> OK!";
	}


include_once("chaineDeCaracteres.php");

function emailValide($email){
	// Auteur : bobocop (arobase) bobocop (point) cz
	// Traduction des commentaires par mathieu

	// Le code suivant est la version du 2 mai 2005 qui respecte les RFC 2822 et 1035
	// http://www.faqs.org/rfcs/rfc2822.html
	// http://www.faqs.org/rfcs/rfc1035.html

	$atom   = '[-a-z0-9!#$%&\'*+\\/=?^_`{|}~]';   // caractères autorisés avant l'arobase
	$domain = '([a-z0-9]([-a-z0-9]*[a-z0-9]+)?)'; // caractères autorisés après l'arobase (nom de domaine)
		                       
	$regex = '/^' . $atom . '+' .   // Une ou plusieurs fois les caractères autorisés avant l'arobase
	'(\.' . $atom . '+)*' .         // Suivis par zéro point ou plus
		                        // séparés par des caractères autorisés avant l'arobase
	'@' .                           // Suivis d'un arobase
	'(' . $domain . '{1,63}\.)+' .  // Suivis par 1 à 63 caractères autorisés pour le nom de domaine
		                        // séparés par des points
	$domain . '{2,63}$/i';          // Suivi de 2 à 63 caractères autorisés pour le nom de domaine

	// test de l'adresse e-mail
	if (preg_match($regex, $email)) {
	    return true;
	} else {
	    return false;
	}
}

/**************************************************************************************************************/
/******************* TEST COTÉ SERVEUR POUR L'ENVOI DU MESSAGE    *********************************************/

function envoiCourrierRecuperation($adresse,$Mdp,$identifiant){
	$TO = $adresse;
	$subject = "Demande de R&eacute;cup&eacute;ration d'identifiant et de mot de passe - Besan&ccedil;on25.fr ";
	$h  = "From: robot_bdd@besancon25.fr";

	$message = "Voici vos identifiant de connection sur la Plate-Forme des artistes et des associations de Besan&ccedil;on:"
		."\n identifiant :   ".$identifiant
		."\n mot de passe:   ".$Mdp
		."\n\n Veuillez ne pas r&eacute;pondre à ce message, il est envoyer automatiquement depuis la plate-forme besan&ccedil;on25.fr"
		."\n Gardez pr&eacute;cieusement ces informations, il vous serviront en cas d'oubli, si vous ne changez pas de Mot de Passe apr&egrave;s."
		."\n\nSign&eacute;: LE ROBOT DE BESANCON 25... (^_^)";

	//echo $TO.",".$subject.",".$message.",".$h;
	mail($TO, $subject, $message, $h);
}
function envoiCourrierEditionArticle($courriel,$ancienTitreArticle,$ancienCorpsArticle,$titreArticle,$corpsArticle,$raison){
	$TO = $courriel;
	$subject = "Article En Attente";
	$headers  = 	"From: robot_bdd@besancon25.fr \r\n"
			."MIME-Version: 1.0" . "\r\n"
			."Content-type: text/html; charset=iso-8859-1" . "\r\n";
	$message = "
	<html>
		<head>
		<title>Article en Attente de validation par l'auteur</title>
		</head>
		<body>
		<h1>Votre article &agrave; d&ucirc; &ecirc;tre &eacute;diter pour pouvoir appara&icirc;tre sur la Plate-Forme des artistes et des associations de Besan&ccedil;on, il a besoin de votre autorisation pour pouvoir appara&icric;tre ...<h1>
		<h2>RAISON(S) :</h2><h3>".$raison."</h3>
		
		<h2>ANCIENNE VERSION DE L'ARTICLE:</h2>
			<h3>titre:</h3><h4>".check_ChaineDeCaracteresDownload($ancienTitreArticle)."</h4>
			<h3>contenu:</h3><h4>".check_ChaineDeCaracteresDownload($ancienCorpsArticle)."</h4>
		<hr noshade='noshade' size='5' />
		<h2>NOUVELLE VERSION DE L'ARTICLE:</h2>
			<h3>titre:</h3><h4>".check_ChaineDeCaracteresDownload($titreArticle)."</h4>
			<h3>contenu:</h3><h4>".check_ChaineDeCaracteresDownload($corpsArticle)."</h4>
		<h2>Ne soyez pas vex&eacute;(e)... Vous pouvez valider l'&eacute;dition en vous rendant sur votre <a href='http://besancon25.fr?page=identification'>compte</a> </h2>
		<h1>Sign&eacute;: LE ROBOT DE BESANCON 25... (^_^)</h1>
		</body>
	</html>
		";
	//echo $message;
	mail($TO, $subject, $message, $headers);
}

function envoiCourrierNonValidation($courriel,$titreArticle,$corpsArticle,$raison){
	$TO = $courriel;
	$subject = "Article Non Valid&eacute;";
	$headers  = 	"From: robot_bdd@besancon25.fr \r\n"
			."MIME-Version: 1.0" . "\r\n"
			."Content-type: text/html; charset=iso-8859-1" . "\r\n";
	$message = "
	<html>
		<head>
		<title>Non-Validation d'Article</title>
		</head>
		<body>
		<h1>Votre article n'a pas p&ucirc; &ecirc;tre valid&eacute; sur la Plate-Forme des artistes et des associations de Besan&ccedil;on:<h1>
		<h2>RAISON(S) :</h2><h3>".$raison."</h3>
		
		<h2>VERSION DE L'ARTICLE:</h2>
			<h3>titre:</h3><h4>".check_ChaineDeCaracteresDownload($titreArticle)."</h4>
			<h3>contenu:</h3><h4>".check_ChaineDeCaracteresDownload($corpsArticle)."</h4>
		<h2>Ne soyez pas vex&eacute;(e)... Vous pouvez toujours tenter de re-valider votre article apr&egrave;s modification...</h2>
		<h1>Sign&eacute;: LE ROBOT DE BESANCON 25... (^_^)</h1>
		</body>
	</html>
		";
	//echo $message;
	mail($TO, $subject, $message, $headers);
}
function envoiCourrierArticleAValider($auteur,$ancienTitreArticle,$ancienCorpsArticle,$titreArticle,$corpsArticle,$raison){
	$TO = "administrateur@besancon25.fr";
	$subject = "Article &Agrave; Valider";
	$headers  = 	"From: robot_bdd@besancon25.fr \r\n"
			."MIME-Version: 1.0" . "\r\n"
			."Content-type: text/html; charset=iso-8859-1" . "\r\n";
	$message = "
	<html>
		<head>
		<title>Article en Attente de validation par l'auteur</title>
		</head>
		<body>
		<h1>L'article &agrave; finalement &eacute;t&eacute; &eacute;dit&eacute; par:".$auteur."(L'auteur)<h1>
		<h2>RAISON(S) :</h2><h3>".$raison."</h3>
		
		<h2>ANCIENNE VERSION DE L'ARTICLE:</h2>
			<h3>titre:</h3><h4>".check_ChaineDeCaracteresDownload($ancienTitreArticle)."</h4>
			<h3>contenu:</h3><h4>".check_ChaineDeCaracteresDownload($ancienCorpsArticle)."</h4>
		<hr noshade='noshade' size='5' />
		<h2>NOUVELLE VERSION DE L'ARTICLE:</h2>
			<h3>titre:</h3><h4>".check_ChaineDeCaracteresDownload($titreArticle)."</h4>
			<h3>contenu:</h3><h4>".check_ChaineDeCaracteresDownload($corpsArticle)."</h4>
		<h2>Ne soyez pas vex&eacute;(e)... Vous pouvez valider l'&eacute;dition en vous rendant sur votre <a href='http://besancon25.fr?page=identification'>compte</a> </h2>
		<h1>Sign&eacute;: LE ROBOT DE BESANCON 25... (^_^)</h1>
		</body>
	</html>
		";
	//echo $message;
	mail($TO, $subject, $message, $headers);
}

function envoiCourrierNonAutoriser($auteur,$titreArticle,$corpsArticle,$raison){
	$TO = "administrateur@besancon25.fr";
	$subject = "Article Non Valid&eacute;";
	$headers  = 	"From: robot_bdd@besancon25.fr \r\n"
			."MIME-Version: 1.0" . "\r\n"
			."Content-type: text/html; charset=iso-8859-1" . "\r\n";
	$message = "
	<html>
		<head>
		<title>Non-Validation d'Article</title>
		</head>
		<body>
		<h1>L'article &agrave; finalement &eacute;t&eacute; supprim&eacute; par:".$auteur."(L'auteur)<h1>
		<h2>RAISON(S) :</h2><h3>".$raison."</h3>
		
		<h2>VERSION DE L'ARTICLE:</h2>
			<h3>titre:</h3><h4>".check_ChaineDeCaracteresDownload($titreArticle)."</h4>
			<h3>contenu:</h3><h4>".check_ChaineDeCaracteresDownload($corpsArticle)."</h4>
		<h1>Sign&eacute;: LE ROBOT DE BESANCON 25... (^_^)</h1>
		</body>
	</html>
		";
	//echo $message;
	mail( $TO, $subject, $message, $headers);
}
?>
