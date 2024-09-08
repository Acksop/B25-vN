<?php include('../fonctionCourante.php');session_start();check_session();?>
<html>
<head>
<title>Campagne Emailling Besancon25.fr</title>
<?php
echo "<link type='text/css' rel='stylesheet' href='../stylesCSS/baseCorps.css'>";
echo "<link type='text/css' rel='stylesheet' href='../stylesCSS/baseMenus.css'>";
echo "<link type='text/css' rel='stylesheet' href='../stylesCSS/interface05.css'>";
echo "<link type='text/css' rel='stylesheet' href='../stylesCSS/lecture03.css'>";
echo "<link type='text/css' rel='stylesheet' href='../stylesCSS/typographie01.css'>";
?>
</head>
<body>
<div class='menu'>
<?php
echo "<div class='logoMenu'>";
echo "<center><img src='../besancon25.png' width='240px' height='400px'></center>";
echo "</div>";
echo "<div class='boutonsMenu'>";
echo "<ul id='menu'>"
	."<li><a href='../index.php?page=accueil' >Accueil</a></li>"
	."<li><a href='../index.php?page=artistes' >Artistes et Artisants</a></li>"
	."<li><a href='../index.php?page=associations' >Associations</a></li>"
	."<li><a href='../index.php?page=articles' >Articles</a></li>"
	."<li><a href='../index.php?page=dossiers' >Dossiers</a></li>"
	."</ul>";
echo "</div>";
?>
</div>
<div class='corps'>
<?php
if(isset($_GET['envoi'])){
echo	"Le(les) Message(s) ont &eacute;t&eacute; envoy&eacute;s...";
}else{
echo	"<table style='padding-left: 25px;'>
		<form method='post' action='traitementEmailAssociations.php'>
		<input type='hidden' name='test' value='0' />
	<tr><td class='utilisateursInverse'>Courriel Pour les associations vers administrateur@besancon25.fr</td>
	<td class='utilisateurs'><input type='submit' value='Envoyer' /></td></tr>
		</form>
		<form method='post' action='traitementEmailAssociations.php'>
		<input type='hidden' name='test' value='1' />
	<tr><td class='utilisateursInverse'>Campagne de courriel vers les associations &eacute;tudiantes de Besan&ccedil;on.</td>
	<td class='utilisateurs'><input type='submit' value='Envoyer' /></td></tr>
		<form method='post' action='traitementEmailAssociations.php'>
		<input type='hidden' name='test' value='2' />
	<tr><td class='utilisateursInverse'>Campagne de courriel vers les associations \\\\RUBRIQUE CULTURE ET COMMUNICATION// de Besan&ccedil;on.</td>
	<td class='utilisateurs'><input type='submit' value='Envoyer' /></td></tr>
		</form>
		<form method='post' action='traitementEmailEntreprises.php'>
		<input type='hidden' name='destinataire' value='0' />
	<tr><td class='utilisateursInverse'>Courriel pour les entreprises vers Laposte.net</td>
	<td class='utilisateurs'><input type='submit' value='Envoyer' /></td></tr>
		</form>
		<form method='post' action='traitementEmailEntreprises.php'>
		<input type='hidden' name='destinataire' value='1' />
	<tr><td class='utilisateursInverse'>Campagne de courriel vers les entreprises du Jura.</td>
	<td class='utilisateurs'><input type='submit' value='Envoyer' /></td></tr>
		</form>
		<form method='post' action='traitementEmailEntreprises.php'>
		<input type='hidden' name='destinataire' value='2' />
	<tr><td class='utilisateursInverse'>Campagne de courriel vers les enreprises du Doubs.</td>
	<td class='utilisateurs'><input type='submit' value='Envoyer' /></td></tr>
		</form>
		<form method='post' action='traitementEmailEntreprises.php'>
		<input type='hidden' name='destinataire' value='3' />
	<tr><td class='utilisateursInverse'>Campagne de courriel vers les enreprises de Lons-Le-Saunier.</td>
	<td class='utilisateurs'><input type='submit' value='Envoyer' /></td></tr>
		</form>
		<form method='post' action='traitementEmailEntreprises.php'>
		<input type='hidden' name='destinataire' value='4' />
	<tr><td class='utilisateursInverse'>Campagne de courriel vers les enreprises du Vesoul.</td>
	<td class='utilisateurs'><input type='submit' value='Envoyer' /></td></tr>
		</form>
		<form method='post' action='traitementEmailEntreprises.php'>
		<input type='hidden' name='destinataire' value='5' />
	<tr><td class='utilisateursInverse'>Campagne de courriel vers les enreprises du Dijon.</td>
	<td class='utilisateurs'><input type='submit' value='Envoyer' /></td></tr>
		</form>
		<form method='post' action='traitementEmailVoeuxPlateForme.php'>
		<input type='hidden' name='destinataire' value='1' />
		<input type='hidden' name='type' value='NOEL' />
	<tr><td class='utilisateursInverse'>Carte de NOEL vers Administrateur@besancon25.fr</td>
	<td class='utilisateurs'><input type='submit' value='Envoyer' /></td></tr>
		</form>
		<form method='post' action='traitementEmailVoeuxPlateForme.php'>
		<input type='hidden' name='destinataire' value='1' />
		<input type='hidden' name='type' value='VOEUX' />
	<tr><td class='utilisateursInverse'>Carte de Voeux 2013 vers Administrateur@besancon25.fr</td>
	<td class='utilisateurs'><input type='submit' value='Envoyer' /></td></tr>
		</form>
		<form method='post' action='traitementEmailVoeuxPlateForme.php'>
		<input type='hidden' name='destinataire' value='2' />
		<input type='hidden' name='type' value='NOEL' />
	<tr><td class='utilisateursInverse'>Carte de NOEL vers les Incrits du (B25)</td>
	<td class='utilisateurs'><input type='submit' value='Envoyer' /></td></tr>
		</form>
		<form method='post' action='traitementEmailVoeuxPlateForme.php'>
		<input type='hidden' name='destinataire' value='2' />
		<input type='hidden' name='type' value='VOEUX' />
	<tr><td class='utilisateursInverse'>Carte de Voeux 2013 vers les Incrits du (B25)</td>
	<td class='utilisateurs'><input type='submit' value='Envoyer' /></td></tr>
		</form>
		<form method='post' action='traitementEmailArtisans.php'>
		<input type='hidden' name='artisans' value='0' />
	<tr><td class='utilisateursInverse'>Courriels-test artisans d'Arts et M&eacute;tiers du Doubs vers Administrateur@besancon25.fr</td>
	<td class='utilisateurs'><input type='submit' value='Envoyer' /></td></tr>
		</form>
		<form method='post' action='traitementEmailArtisans.php'>
		<input type='hidden' name='artisans' value='1' />
	<tr><td class='utilisateursInverse'>Campagne de Courriel vers les Artisans d'Arts du Doubs(B25)</td>
	<td class='utilisateurs'><input type='submit' value='Envoyer' /></td></tr>
		</form>
		<form method='post' action='traitementEmailArtisans.php'>
		<input type='hidden' name='artisans' value='2' />
	<tr><td class='utilisateursInverse'>Campagne de Courriel vers les Artisans-M&eacute;tiers du Doubs(B25)</td>
	<td class='utilisateurs'><input type='submit' value='Envoyer' /></td></tr>
		</form>
	</table>";
}
?>
</div>
<div class='imagebd'><img src='../images/fondbd.gif' width='1024' height='768' /></div>
<div class='limiteur'>&nbsp;</div>
</body>
</html>
