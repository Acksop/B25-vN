<?php
include_once("GoogleMap.php");
include_once("JSMin.php");

$MAP_OBJECT = new GoogleMapAPI(); $MAP_OBJECT->_minify_js = isset($_REQUEST["min"])?FALSE:TRUE;
//$MAP_OBJECT->setDSN("mysql://dbo446012612:3MR&G00GL3@db446012612.db.1and1.com/db446012612");
$MAP_OBJECT->addMarkerByAddress("31b,rue de l'Observatoire 25000 BESANCON","Mon Adresse", " ROY Emmanuel 3eme étage");
$MAP_OBJECT->setHeight('250');
$MAP_OBJECT->setWidth('600');
$MAP_OBJECT->enableStreetViewControls();
?>
<html>
<head>
<?=$MAP_OBJECT->getHeaderJS();?>
<?=$MAP_OBJECT->getMapJS();?>
</head>
<body>
<?=$MAP_OBJECT->printOnLoad();?>
<?=$MAP_OBJECT->printMap();?>
<?=$MAP_OBJECT->printSidebar();?>
</body>
</html>