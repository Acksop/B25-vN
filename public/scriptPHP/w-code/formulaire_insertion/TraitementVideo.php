<?php
$videoChoisie = substr($_POST['videoChoisie'], 7);
echo "<script language='JavaScript'>" . "opener.wcode_videoInsere('dossier','corps','" . $videoChoisie . "')" . "</script>";
echo "<script language='JavaScript'>" . "window.close();" . "</script>";
?>	