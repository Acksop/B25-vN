<?php
header("Content-Type: text/plain ; charset=iso-8859-1");
include "../../localisation_Domaines_externes_B25.php";
include("../scriptPHP/connectionBDD.php");
include("../scriptPHP/arrondis.php");

$prochain = recuperationNbProchainBUZZArtiste($_GET['id'],$_GET['idA'],1);
$precedent = recuperationNbPrecedentBUZZArtiste($_GET['id'],$_GET['idA'],1);

if($prochain != 0){
	$TweetPlus = recuperationProchainBUZZArtiste($_GET['id'],$_GET['idA'],1);
	$dataPlus = mysql_fetch_row($TweetPlus);
}
if($precedent != 0){
	$TweetMoins = recuperationPrecedentBUZZArtiste($_GET['id'],$_GET['idA'],1);
	$dataMoins = mysql_fetch_row($TweetMoins);
}

$tweet = recuperationTweetArtiste($_GET['id'],1);
$data = mysql_fetch_assoc($tweet);


cadreAlignCentrerDebut();
echo "<p class='utilisateurs' style='background-color: #BBB; width:930px;'><br/><img src='".SVNRADIEURAE_PATH.$data['image']."' alt='".$data['nomImage']."'/><br/><br/>";
if($precedent != 0){
	echo "<span style='float:left;'><a id='naviguationImage_Prec' href='javascript:;' onClick='AJAXChangerImage(".$dataMoins[0].");'>&lt;&lt;&lt;&lt;</a></span>";
}else{
	echo "<span style='float:left;'>&lt;&lt;&lt;&lt;</span>";
}
echo "<span style='float: center;'><tt>".check_ChaineDeCaracteresDownload($data['text'])."</tt>";
if ($_GET['abs'] == 1){
	echo "&nbsp;&nbsp;<a id='navigationImage' href='javascript:;' onClick='AJAXSupprimerImage(".$data['id_buzz'].");'>Supprimer?</a>";
}
echo "</span>";
if($prochain != 0){
	echo "<span style='float:right;'><a id='naviguationImage_Suiv' href='javascript:;' onClick='AJAXChangerImage(".$dataPlus[0].");'>&gt;&gt;&gt;&gt;</a></span>";
}else{
	echo "<span style='float:right;'>&gt;&gt;&gt;&gt;</span>";
}
echo "</p>";
cadreAlignCentrerFin();

?>
