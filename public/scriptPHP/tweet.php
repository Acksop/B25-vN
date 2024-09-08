<?php
function AfficherFormulaireDeTweet(){
	echo "<a name='Tweet'/>";
	//scriptCSS

	//scriptJS
	echo "<script src='scriptJS/afficherCacherDIV.js' type='text/javascript'></script>";
	echo "<script language='javascript'>"
		."
		function AfficheTweetTXT(){
			cacherDIV('TweetIMG');
			cacherDIV('TweetMP3');
			cacherDIV('TweetVDO');
			afficherDIV('TweetTXT');
		}
		function AfficheTweetMP3(){
			cacherDIV('TweetIMG');
			cacherDIV('TweetTXT');
			cacherDIV('TweetVDO');
			afficherDIV('TweetMP3');
		}
		function AfficheTweetIMG(){
			cacherDIV('TweetTXT');
			cacherDIV('TweetMP3');
			cacherDIV('TweetVDO');
			afficherDIV('TweetIMG');
		}
		function AfficheTweetVDO(){
			cacherDIV('TweetIMG');
			cacherDIV('TweetMP3');
			cacherDIV('TweetTXT');
			afficherDIV('TweetVDO');
		}
		function AfficheBanniereDL(){
			cacherDIV('TweetIMG');
			cacherDIV('TweetTXT');
			cacherDIV('TweetMP3');
			cacherDIV('TweetVDO');
			afficherDIV('BanDL');
		}
		"
		."</script>";



	//scriptHTML5
		//menu des Tweets
	echo "<table border='0' bgcolor='white' width='100%'>"
		."<tr>"
		."<th align='center'><a href='javascript:AfficheTweetTXT();'>Humeur</a></th>"
		."<th align='center'><a href='javascript:AfficheTweetIMG();'>Image</a></th>"
		."<th align='center'><a href='javascript:AfficheTweetMP3();'>Musique</a></th>"
		."<th align='center'><a href='javascript:AfficheTweetVDO();'>Vid&eacute;o Connexe</a></th>"
		."</tr><tr>"
		."<td colspan='4' width='100%'>";

		//tweetTXT
	echo "<div class='utilisateurs' id='TweetTXT' style='display: block;' ><p align='left'><form action='controlleurs/traitementTweetTXT.php' method='POST'>"
		."<p class='utilisateurs'>Tweeter ?</p>"
		."<input type='text' placeholder='Exprimez Vous ?!?' class='tweet' name='tweet' size='100'/>"
				."<p align='right'><input type='submit' value='Partager' class='btn_modif'/></p>"
		."</form></div>";
		//tweetImage
	echo "<div class='utilisateurs' id='TweetIMG' style='display: none;' ><form enctype='multipart/form-data' action='controlleurs/traitementTweetIMAGE.php' method='POST'>"
		."<input type='hidden' name='MAX_FILE_SIZE' value='20971520'/>"
		."<p align='left'><input type='file' size='70' name='Image' class='tweet' />(max 20Mo)</p>"
		."<p align='right'><input type='submit' value='Partager une Image' class='btn_modif' onClick='AfficheBanniereDL()'/></p>"
		."<p class='utilisateurs'>Commentaire(s) :</p><br/>"
		."<input type='text' placeholder='Exprimez Vous ?!?' class='tweet' name='tweet' size='100'/>"
		."</form>"
		."</div>";
		//tweetMP3
	echo "<div class='utilisateurs' id='TweetMP3' style='display: none;' ><form enctype='multipart/form-data' action='controlleurs/traitementTweetMP3.php' method='POST'>"
		."<input type='hidden' name='MAX_FILE_SIZE' value='20971520'/>"
		."<p align='left'><input type='file' size='70' name='Musique' class='tweet'/>(max 20Mo)</p>"
		."<p align='right'><input type='submit' value='Partager un Son' class='btn_modif' onClick='AfficheBanniereDL()'/></p>"
		."<p class='utilisateurs'>Commentaire(s) :</p><br/>"
		."<input type='text' placeholder='Exprimez Vous ?!?' class='tweet' name='tweet' size='100'/>"
		."</form>"
		."</div>";
		//tweetVideo
	echo "<div class='utilisateurs' id='TweetVDO' style='display: none;' ><form action='controlleurs/traitementTweetMEDIAConnexe.php' method='POST'>"
		."<p align='left'><input type='text' size='75' placeholder='http://www.youtube.com/watch?v=E9Tb4TMibk0' name='media' class='tweet'/>(URL Youtube ou DailyMotion)</p>"
		."<p align='right'><input type='submit' value='Partager une Vid&eacute;o' class='btn_modif'/></p>"
		."<p class='utilisateurs'>Commentaire(s) :</p><br/>"
		."<input type='text' placeholder='Exprimez Vous ?!?' class='tweet' name='tweet' size='100'/>"
		."</form></div>";
	
	echo "</td></tr><tr><td colspan='4' width='500px'>"
		."<div id='BanDL' style='background: gray; display:none;'><img src='images/upload.gif' height='120px' width='500px' alt='bannière de téléchargements'/></div>"
		."</td></tr></table>";
}

?>
