<?php
include("../scriptPHP/connectionBDD.php");
insertionDialogue($_GET['corpsDuTexte']);
header("location: ../index.php");
?>
