<?php
	include("../scriptPHP/connectionBDD.php");
	session_start();
	suppressionAlbumGroupe($_POST['id_album']);
	header("location: ../index.php?page=compte#ancre_album");
	