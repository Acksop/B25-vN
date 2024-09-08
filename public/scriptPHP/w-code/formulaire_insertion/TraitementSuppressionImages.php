<?php
session_start();
//les lignes de codes a executer
@unlink($_POST['imageChoisie']);
@unlink($_POST['ApercuimageChoisie']);
header("location: formulaireImage.php");
?>	
