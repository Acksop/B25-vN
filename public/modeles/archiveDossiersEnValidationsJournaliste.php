<?php
check_session();

function LancerAffichageDuCorps(){
$sql = "SELECT * FROM dossiersEnValidations WHERE id_utilisateur = '{$_SESSION['id_utilisateur']}'";
$res = faireUneRequeteOffline($sql);
echo "<table>";
while($data = exploiterLigneResultatBDD($res)){
	echo "<tr><td class='utilisateurs'>";
		echo "<p class='titre'>".$data['titre']."</p>"
			."<p class='corps'><b>Description :</b><br />".$data['description']."</p>"
			."<p class='date'>Ouvert ".$data['date_Crea']."</p>"
			."<p class='date'><b>Derni&egrave;re </b>Modification ".$data['date_Modif']."</p>"
			."<p class='date'><u><b>En attente de Validation depuis </b></u>&nbsp;".$data['date_miseEnValid']."</p>";
		echo "<td class='utilisateursInverse'><form method='post' action='index.php?page=modificationDossierEnAttente&id=".$data['id_dossier']."&modification=oui'>"
				."<input class='btn_dossiers' type='submit' value='Modifier?'/>"
				."</form></td>";
		echo "</tr>";
}
echo "</table>";
}