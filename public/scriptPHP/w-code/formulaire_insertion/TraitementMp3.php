<?php
$mp3Choisi = substr($_POST['mp3Choisi'],7);
echo "<script language='JavaScript'>"
	."opener.wcode_mp3Insere('dossier','corps','".$mp3Choisi."')"
	."</script>";
echo "<script language='JavaScript'>"
	."window.close();"
	."</script>";
?>	
