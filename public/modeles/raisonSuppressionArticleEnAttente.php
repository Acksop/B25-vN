<?php
//--
check_session();
//--

function LancerAffichageDuCorps(){
	echo	"<table><tr><td width='600px' class='utilisateurs'>
	<h1 class='utilisateurs'>Raison(s) de la supression</h1>
	<form method='post' action='controlleurs/traitementSuppressionArticleEnAttente.php'>
	<textarea name='raison' rows='15' cols='80' style='width: 100%'>
	</textarea>
	</td></tr><tr><td class='utilisateursInverse'>
	<input type='hidden' name='id' value='{$_GET['id']}'/>
	<input type='submit' value='Supprimer & Envoyer Courriel de raison'/>
	</form>
	</td></tr></table>";

}