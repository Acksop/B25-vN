<?php
//creation de la session ... inclusion du code ... verification de la session connect�e...
session_start();
//les lignes de codes a executer
@unlink($_POST['mp3Choisi']);
header("location: formulaireMp3.php");
?>	
