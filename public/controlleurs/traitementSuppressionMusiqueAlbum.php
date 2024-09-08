<?php
	session_start();
	include("../scriptPHP/connectionBDD.php");
	suppressionMusiqueAlbumGroupe($_GET['id']);
	header("location: ../index.php?page=compte#ancre_albums");
?>
