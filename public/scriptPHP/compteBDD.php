<?php
include('identifiantBDD.php');

function connectionBDD(){
	$bdd =	@mysql_connect(BD_ADRESSE,BD_USER,BD_PASS) or exit('erreur de connection...');
			@mysql_select_db(BD_NOM)or exit('pb de Base de données...');
}
?>
