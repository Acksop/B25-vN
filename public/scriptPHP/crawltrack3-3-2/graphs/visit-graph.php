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
// file: visit-graph.php
//----------------------------------------------------------------------
// this graph is made with artichow    website: www.artichow.org
//----------------------------------------------------------------------
//  Last update: 18/11/2011
//----------------------------------------------------------------------
error_reporting(0);
//initialize array
$listlangcrawlt = array();

//get graph infos
$graphname = urlencode($_GET['graphname']);
$period = $_GET['period'];
$navig = $_GET['navig'];

//database connection
include ("../include/configconnect.php");
$connexion = mysql_connect($crawlthost, $crawltuser, $crawltpassword) or die("MySQL connection to database problem");
$selection = mysql_select_db($crawltdb) or die("MySQL database selection problem");

//get the listlang files
include ("../include/listlang.php");
//get the functions files
$times = 0; //give value just to avoid error in functions.php
$firstdayweek = 'Monday'; //give value just to avoid error in functions.php
include ("../include/functions.php");

//get graph values
if (file_exists("../cachecloseperiod/$graphname.gz")) {
	$fgz = @fopen("../cachecloseperiod/$graphname.gz", "r");
	$data = fread($fgz, filesize("../cachecloseperiod/$graphname.gz"));
	fclose($fgz);
	$data = gzuncompress($data);
	$datatransfert = unserialize(urldecode(stripslashes($data)));
} else {
	$sql = "SELECT   graph_values FROM crawlt_graph
		WHERE  name='" . sql_quote($graphname) . "'";
	$requete = mysql_query($sql, $connexion) or die("MySQL query error");
	$nbrresult = mysql_num_rows($requete);
	if ($nbrresult >= 1) {
		$ligne = mysql_fetch_assoc($requete);
		$data = $ligne['graph_values'];
	} else {
		exit('<h1>No Graph values available !!!!</h1>');
	}
	$datatransfert = unserialize(urldecode(stripslashes($data)));
}
mysql_close($connexion);
$graphnameexplode = explode('-', $graphname);
if ($graphnameexplode[1] == 'permanent') {
	$fp = fopen("../cachecloseperiod/$graphname.gz", 'w');
	fwrite($fp, gzcompress($data));
	fclose($fp);
}
if ($graphnameexplode[0] == 'visitshours') {
	$graphvisithours = 1;
} else {
	$graphvisithours = 0;
}

//get language to use
$crawltlang = $_GET['crawltlang'];
if (($crawltlang == 'russian' && !file_exists('./artichow/font/simsun.ttf')) || $crawltlang == 'bulgarian' || $crawltlang == 'turkish') {
	$crawltlang = 'english';
}

//language file include
if (file_exists("../language/" . $crawltlang . ".php") && in_array($crawltlang, $listlangcrawlt)) {
	include ("../language/" . $crawltlang . ".php");
} else {
	exit('<h1>No language files available !!!!</h1>');
}

//legend text
if ($navig == 17 || $navig == 18 || $navig == 19) {
	$legend1 = $language['hacking'];
	$legend2 = $language['crawler_ip_used'];
} elseif ($navig == 21) {
	$legend1 = $language['nbr_pages'];
} elseif ($graphvisithours == 1) {
	$legend1 = $language['nbr_visits'];
} else {
	$legend1 = $language['nbr_visits'];
	$legend2 = $language['nbr_pages'];
	$legend3 = $language['crawler_name'];
}
foreach ($datatransfert as $key => $value) {
	if($key<24)
		{
		$axex[] = $key;
		}
}

//graph creation
//create table for graph
if ($graphvisithours == 1) {
	foreach ($axex as $data) {
		$visit[] = $datatransfert[$data];
		$data2=$data + 100;
		$visitaverage[]=$datatransfert[$data2];
	}
} else {
	foreach ($axex as $data) {
		$cutdata = explode("-", $datatransfert[$data]);
		$page2[] = $cutdata[0];
		$visit[] = $cutdata[1];
		$crawl[] = $cutdata[2];
	}
}

//test to see if ttf font is available
$fontttf = gd_info();
if (@$fontttf['FreeType Linkage'] == 'with freetype') {
	$ttf = 'ok';
} else {
	$ttf = 'no-ok';
}
require_once ("artichow/BarPlot.class.php");
require_once ("artichow/LinePlot.class.php");
$graph = new Graph(700, 300);
$group = new PlotGroup();
$group->setBackgroundColor(new Color(173, 216, 230, 60));
$group->setSpace(2, 2, 0.1, 0);
if ($period == 2 || $period == 3 || ($period >= 100 && $period < 300)) {
	$group->setPadding(50, 20, 30, 100);
} else {
	$group->setPadding(50, 20, 30, 60);
}

//visits
if ($navig == 2 || $navig == 4 || $navig == 17 || $navig == 18 || $navig == 19) {
	$plot = new BarPlot($visit, 1, 2);
} elseif ($navig == 21 || $graphvisithours == 1) {
	$plot = new BarPlot($visit, 1, 1);
} else {
	$plot = new BarPlot($visit, 1, 3);
}
$debut = new Color(0, 51, 153);
$fin = new Color(0, 191, 255);
$plot->setBarGradient(new LinearGradient($debut, $fin, 90));
$plot->setXAxisZero(TRUE);
$plot->setSpace(2, 2, 20, 0);
$plot->barShadow->setSize(2);
$plot->barShadow->setPosition(SHADOW_RIGHT_TOP);
$plot->barShadow->setColor(new Color(180, 180, 180, 10));
$plot->barShadow->smooth(TRUE);

//legend
$group->legend->add($plot, $legend1, LEGEND_BACKGROUND);
$group->add($plot);
if ($navig == 4 || $navig == 21 || $graphvisithours == 1) {
} else {
	//pages viewed
	if ($navig == 2) {
		$plot = new BarPlot($page2, 2, 2);
	} elseif ($navig == 17 || $navig == 18 || $navig == 19) {
		$plot = new BarPlot($crawl, 2, 2);
	} else {
		$plot = new BarPlot($page2, 2, 3);
	}
	$debut = new Color(255, 0, 0);
	$fin = new Color(255, 215, 0);
	$plot->setBarGradient(new LinearGradient($debut, $fin, 90));
	$plot->setXAxisZero(TRUE);
	$plot->setSpace(2, 2, 20, 0);
	$plot->barShadow->setSize(2);
	$plot->barShadow->setPosition(SHADOW_RIGHT_TOP);
	$plot->barShadow->setColor(new Color(180, 180, 180, 10));
	$plot->barShadow->smooth(TRUE);
	//legend
	$group->legend->add($plot, $legend2, LEGEND_BACKGROUND);
	$group->add($plot);
}
if ($ttf == 'ok') {
	if ($crawltlang == 'russian') {
		$group->legend->setTextFont(new simsun(8));
	} else {
		$group->legend->setTextFont(new Tuffy(10));
	}
} else {
	$group->legend->setTextFont(new Font(2));
}
if ($navig == 2 || $navig == 17 || $navig == 18 || $navig == 19 || $navig == 21 || $graphvisithours == 1) {
} else {
	//crawler
	if ($navig == 4) {
		$plot = new BarPlot($crawl, 2, 2);
	} else {
		$plot = new BarPlot($crawl, 3, 3);
	}
	$debut = new Color(0, 128, 0);
	$fin = new Color(144, 238, 144);
	$plot->setBarGradient(new LinearGradient($debut, $fin, 90));
	$plot->setXAxisZero(TRUE);
	$plot->setSpace(2, 2, 20, 0);
	$plot->barShadow->setSize(2);
	$plot->barShadow->setPosition(SHADOW_RIGHT_TOP);
	$plot->barShadow->setColor(new Color(180, 180, 180, 10));
	$plot->barShadow->smooth(TRUE);
	//legend
	$group->legend->add($plot, $legend3, LEGEND_BACKGROUND);
	$group->add($plot);
}
$group->legend->setBackgroundColor(new Color(255, 255, 255, 0));


$group->legend->setModel(LEGEND_MODEL_BOTTOM);
$group->legend->setPosition(NULL, 0.87);
if ( ($navig == 23 || $navig == 20) && $graphvisithours == 1) {
	//average line

	$plot = new LinePlot($visitaverage, LINEPLOT_MIDDLE);
	// Change line color
	$plot->setColor(new Color(0, 0, 150));
	// Change mark type

	$plot->setThickness(3);
	$group->add($plot);
	$textlegend = rtrim($language['shortterm'],' :');
	$group->legend->add($plot, $textlegend, LEGEND_LINE);
}

//X axis label
if ($period == 0 || $period >= 1000) {
	for ($i = 0;$i < 24;$i++) {
		$axex[$i] = $axex[$i] . "h";
	}
}
$group->axis->bottom->setLabelText($axex);
if ($ttf == 'ok') {
	$group->axis->left->label->setFont(new Tuffy(8));
	$group->axis->bottom->label->setFont(new Tuffy(8));
} else {
	$group->axis->left->label->setFont(new Font(2));
	$group->axis->bottom->label->setFont(new Font(2));
}
if ($period == 2 || $period == 3 || ($period >= 100 && $period < 300)) {
	$group->axis->bottom->label->setAngle(45);
	if ($ttf == 'ok') {
		$group->axis->bottom->label->move(-10, 0);
	} else {
		$group->axis->bottom->label->move(20, 0);
	}
}
$graph->add($group);
$graph->draw();
?>
