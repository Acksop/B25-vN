<?php
header("Content-Type: text/plain; charset=utf-8");
require '../scriptPHP/connectionBDD.php';
$req_dialogue = recuperationDialogue();
$i = 0;
echo "<li style='list-style-type: none;'>";
	while($dialogue = mysql_fetch_assoc($req_dialogue)){ 
		if($dialogue['valide']==1){
			echo "<ul align='left' class='Tchat'><B>".$dialogue['date'].": </B>&nbsp;&nbsp;";
			echo html_entity_decode(htmlentities(check_ChaineDeCaracteresDownload($dialogue['corpsDuTexte'])), ENT_QUOTES, "UTF-8")."</ul>";
		if($i >20) break;
		$i++;
		}
	}
echo "</li>";
