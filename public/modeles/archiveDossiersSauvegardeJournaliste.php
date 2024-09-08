<?php
check_session();

function AfficheDossierSauvegarde(){
$sql = "SELECT * FROM dossiersTemporaires WHERE id_utilisateur = '{$_SESSION['id_utilisateur']}'";
$res = faireUneRequeteOffline($sql);
echo "<table align='center'>";
while($data = mysql_fetch_assoc($res)){
	echo "<tr><td class='utilisateurs'>";
		echo "<p class='titre'>".$data['titre']."</p>"
			."<p class='corps'><b>Description :</b><br />".$data['description']."</p>"
			."<p class='date'>Ouvert ".$data['date_Crea']."</p>"
			."<p class='date'><u><b>Derni&egrave;re</b> Modification </u>&nbsp;".$data['date_Modif']."</p>";
		echo "<td class='utilisateurs'>"
				."<form method='post' action='index.php?page=modificationDossierSauvegarder'>"
				."<input type='hidden' name='id' value='".$data['id_dossier']."'>"
				."<input type='hidden' name='modification' value='oui'>"
				."<input type='submit' class='btn_dossiers' value='Modifier?'/>"
				."</form>"
			."</td>";
		echo "<td class='utilisateursInverse'>"
				."<form method='post' action='controlleurs/traitementSuppressionDossierSauvegarder.php'>"
				."<input type='hidden' name='id' value='".$data['id_dossier']."'>"
				."<input type='submit' class='btn_dossiers' value='Supprimer?'/>"
				."</form>"
			."</td>";
	echo "</tr>";
}
echo "</table>";
}