<?php
header("Content-Type: text/plain; charset=iso-8859-1");
header("Charset: ISO-8859-1");
include("../scriptPHP/connectionBDD.php");

$prochain = recuperationNbProchainBUZZArtiste($_GET['id'],$_GET['idA'],3);
$precedent = recuperationNbPrecedentBUZZArtiste($_GET['id'],$_GET['idA'],3);

if($prochain != 0){
	$TweetPlus = recuperationProchainBUZZArtiste($_GET['id'],$_GET['idA'],3);
	$dataPlus = mysql_fetch_row($TweetPlus);
}
if($precedent != 0){
	$TweetMoins = recuperationPrecedentBUZZArtiste($_GET['id'],$_GET['idA'],3);
	$dataMoins = mysql_fetch_row($TweetMoins);
}

$tweet = recuperationTweetArtiste($_GET['id'],3);
$data = mysql_fetch_assoc($tweet);

echo "<table><tr><td valign='top'>";
if($precedent != 0){
	echo "<a id='naviguationMediaConnexe_Prec' href='javascript:;' onClick='AJAXChangerMediaConnexe(".$dataMoins[0].");'><img src='images/flecheg_up.gif' alt='Fleche_gauche' width='45px' height='420px' onMouseOver='this.src=btn_MediaConnexe_G_down' onMouseOut='this.src=btn_MediaConnexe_G_up' onMouseDown='this.src=btn_MediaConnexe_G_hover' /></a></td><td>";
}else{
	echo "<img style='visibility:hidden;' src='images/flecheg_up.gif' alt='Fleche_gauche' width='45px' height='420px'/></td><td>";
}
echo check_ChaineDeCaracteresDownload($data['codeConnexe']);
if($prochain != 0){
	echo "</td><td valign='top'><a id='naviguationMediaConnexe_Suiv' href='javascript:;' onClick='AJAXChangerMediaConnexe(".$dataPlus[0].");'><img src='images/fleched_up.gif' alt='Fleche_droite' width='45px' height='420px' onMouseOver='this.src=btn_MediaConnexe_D_down' onMouseOut='this.src=btn_MediaConnexe_D_up' onMouseDown='this.src=btn_MediaConnexe_D_hover' /></a></td>";
}else{
	echo "</td><td><img style='visibility:hidden' src='images/fleched_up.gif' alt='Fleche_droite' width='45px' height='420px' /></td>";
}
echo "</td></tr><tr><td colspan='3' class='utilisateurs' >";
echo "<p style='width:615px' ><span style='float:left;'><tt>".check_ChaineDeCaracteresDownload($data['text'])."</tt></span>";
if( $_GET['abs'] == 1 ){
	echo "<span style='float:right;'><a id='navigationImage' href='javascript:;' onClick='AJAXSupprimerMediaConnexe(".$data['id_buzz'].");'>Supprimer?</a></span>";
}
echo "</p>";
echo "</td></tr></table>";

?>
