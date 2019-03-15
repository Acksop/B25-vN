<?php
//----------------------------------------------------------------------
//  CrawlTrack 3.3.2
//----------------------------------------------------------------------
// Crawler Tracker for website
//----------------------------------------------------------------------
// Author: Jean-Denis Brun
//----------------------------------------------------------------------
// Code cleaning: Philippe Villiers
//----------------------------------------------------------------------
// Website: www.crawltrack.net
//----------------------------------------------------------------------
// That script is distributed under GNU GPL license
//----------------------------------------------------------------------
// file: configconnect.base.php
//----------------------------------------------------------------------
//  Last update: 10/11/2011
//----------------------------------------------------------------------
//PATHS VARIABLES
//used with $_GET path
global $varGetIncludePageWithRedirection,$varPostFormIncludePageWithRedirection,$pathFromSiteIndexToCrawltrackIndex,$pathFromRootToCrawltrackImages;
$getVarPage = 'VARPAGE';
$getVarPageValue = 'NOMPAGE';
if($getVarPageValue != '' && $getVarPage != ''){
$varGetIncludePageWithRedirection = $getVarPage.'='.$getVarPageValue.'&';
//used with $_POST form path
$varPostFormIncludePageWithRedirection = '?'.$getVarPage.'='.$getVarPageValue;
}else{
$varPostFormIncludePageWithRedirection = $varGetIncludePageWithRedirection = '';
}
//used with form path to controllers
$pathFromSiteIndexToCrawltrackIndex = 'PATH_CT';
//used with images and graphs
$pathFromRootToCrawltrackImages = 'PATH_CT';

//test using ROOT Crawltrack or Integrated MVC Crawltrack
	if($pathFromSiteIndexToCrawltrackIndex != ''){
		$url = parse_url($_SERVER['REQUEST_URI']);
		if( strpos($url['path'],$pathFromSiteIndexToCrawltrackIndex) !== FALSE ){
			if(!isset($_SESSION['inMVC'])){
			$varPostFormIncludePageWithRedirection = $varGetIncludePageWithRedirection = $pathFromSiteIndexToCrawltrackIndex = $pathFromRootToCrawltrackImages = '';
			}
		}
	}

global $crawltuser,$crawltpassword,$crawltdb,$crawlthost,$secret_key;

$crawltuser='USER';
$crawltpassword='PASSWORD';
$crawltdb='DATABASE';
$crawlthost='HOST';
$secret_key='SECRETSENTENCE';
?>
