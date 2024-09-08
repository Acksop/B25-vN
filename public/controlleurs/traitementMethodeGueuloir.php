<?php
start_session();
check_session();
check_admin_session();
	
include("../scriptPHP/connectionBDD.php");
$sql = "UPDATE B25_preferences SET gueuloir='".$_GET['methode']."'";
$req = faireUneRequeteOffline($sql);
header("location: ../index.php?page=compte");
?>
