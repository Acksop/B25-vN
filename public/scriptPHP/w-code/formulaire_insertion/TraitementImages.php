<?php
$imageChoisie = substr($_POST['imageChoisie'],7);
echo "<script language='JavaScript'>"
	."opener.wcode_imageInsere('dossier','corps','".$imageChoisie."')"
	."</script>";
echo "<script language='JavaScript'>"
	."window.close();"
	."</script>";
?>	
