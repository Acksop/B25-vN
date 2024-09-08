<?php

if($pathFromSiteIndexToCrawltrackIndex == ''){
	session_start();
}
if (!isset($_SESSION['flag'])) {
	$_SESSION['flag'] = true;
}

//var used to stabilize connect on the formal referer page ( used 3/4 times in ../php/login.php and header.php )

if (!isset($_SESSION['inMVC'])) {

	if($pathFromSiteIndexToCrawltrackIndex == ''){
		$_SESSION['inMVC'] = 0;
	}else{
		$_SESSION['inMVC'] = 1;
	}
}
//print_r($_SESSION);
