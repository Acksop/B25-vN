<?php
session_start();
include_once('../scriptPHP/connectionBDD.php');

$sql = "SELECT type_compte FROM utilisateur WHERE pseudo= '' and password= '' ";
$req = faireUneRequeteOffline($sql);
$data = mysql_fetch_row($req);
$data[0]++;
$data[0] = $data[0]%6;
if ($data[0] == 0){
	$data[0] = 1;
}
$sql = "UPDATE utilisateur SET type_compte = '".$data[0]."' WHERE pseudo = '' and password= '' ";
faireUneRequeteOffline($sql);
header("location: ../index.php?page=compte");
?>
