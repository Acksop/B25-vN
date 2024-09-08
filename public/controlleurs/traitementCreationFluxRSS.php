<?php
include("../scriptPHP/fluxRSS.php");
include("../scriptPHP/connectionBDD.php");
creationFluxRSS();
header("location: ../index.php?page=compte");
?>
