<?php
function AfficheFormAjoutUtilisateur(){
	//--
	check_session();
	//--
	echo "<table border='0' align='center'>"
		."<form name='inscription' method='post' action='controlleurs/traitementInscriptionTousTypes.php'>"
		."<tr><td class='utilisateurs'>"
		."IDENTIFIANT CHOISI:"
		."</td><td class='utilisateurs'>"
		."<input name='identifiant' type='text'/>"
		."</td></tr><tr><td class='utilisateurs'>"
		."MOT DE PASSE CHOISIT:"
		."</td><td class='utilisateurs'>"
		."<input name='motDePasse1' type='password'/>"
		."</td></tr><tr><td class='utilisateurs'>"
		."ENTRER A NOUVEAU LE MOT DE PASSE CHOISIT:"
		."</td><td class='utilisateurs'>"
		."<input name='motDePasse2' type='password'/>"
		."</td></tr><tr><td class='utilisateurs'>"
		."COURRIEL:"
		."</td><td class='utilisateurs'>"
		."<input name='courriel' type='text'/>"
		."</td></tr><tr><td class='utilisateurs'>"
		."TYPE DE COMPTE:"
		."</td><td class='utilisateurs'>"
		."<select name='type'>"
		."<option value='1'>Journaliste</option>"
		."<option value='2'>Artiste </option>"
		."<option value='4'>Artisans </option>"
		."<option value='3'>Association</option>"
		."<option value='5'>Groupe Musical</option>"
		."</select>"
		."</td></tr><tr><td colspan='2'>"
		."<input type='submit' value='Inscription'/>"
		."</td></tr>"
		."</form>";
		if(isset($_GET['erreur'])){
			switch($_GET['erreur']){
			case 1:
				echo "<tr><td colspan='2' width='150' align='center' class='utilisateurs'>"
					."L'identifiant est d&eacute;j&agrave; utilis&eacute;, veuillez bien en choisir un autre..."
					."</td></tr>";
			break;
			case 2:
				echo "<tr><td colspan='2' width='150' align='center' class='utilisateurs'>"
					."Veuillez v&eacute;rifier vos mots de passes..."
					."</td></tr>";
				
			break;
			default:
			}
		}
		echo "</table>";
}