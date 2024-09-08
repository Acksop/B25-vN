<?php

include('compteBDD.php');

function faireUneRequeteOffLine($sql){
connectionBDD();
if(DEBUG == 'TRUE'){
	$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
}else{
	$req = mysql_query($sql);
}
mysql_close();
return $req;
}

function faireUneRequeteOnLine($sql){
if(DEBUG == 'TRUE'){
	$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
}else{
	$req = mysql_query($sql);
}
return $req;
}

?>
