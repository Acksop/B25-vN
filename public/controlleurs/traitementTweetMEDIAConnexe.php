<?php
session_start();
require '../variablesApplication.php';
include ("../scriptPHP/connectionBDD.php");
include ('../scriptPHP/alertesIntrusions.php');

// Attention script Pourri !

$id = $_SESSION['id_utilisateur'];
$type = $_SESSION['type_compte'];
$UrlMediaConnexe = $_POST['media'];

$corps = check_ChaineDeCaracteresUpload(ajoutBaliseHREFText(HTML_ChaineDeCaracteres($_POST['tweet'])));

$erreur = 0;
$decoupageUrl = explode("/", $UrlMediaConnexe);

if ($decoupageUrl[2] == "www.dailymotion.com") {
    
    $idMedia = explode("_", $decoupageUrl[4]);
    $adMedia = explode("#", $decoupageUrl[4]);
    if (isset($adMedia[1])) {
        $adMedia = explode("=", $adMedia[1]);
        if (isset($adMedia[1])) {
            $idMedia = $adMedia[1];
        }
    } else {
        $idMedia = $idMedia[0];
    }
    $embedCode = "<iframe frameborder='0' width='560' height='420' src='http://www.dailymotion.com/embed/video/" . $idMedia . "?width=560&theme=cappuccino&foreground=%23E8D9AC&highlight=%23FFF6D9&background=%23493D27&hideInfos=1'></iframe>";
} else 
    if ($decoupageUrl[2] == "www.youtube.com") {
        
        $idMedia = explode("=", $decoupageUrl[3]);
        $embedCode = "<iframe width='560' height='420' src='http://www.youtube.com/embed/" . $idMedia[1] . "?rel=0' frameborder='0' allowfullscreen></iframe>";
    } else 
        if ($decoupageUrl[2] == "www.metacafe.com") {
            
            $idMedia = $decoupageUrl[4];
            $adMedia = $decoupageUrl[4] . "/" . $decoupageUrl[5] . ".swf";
            $embedCode = "<embed flashVars='playerVars=autoPlay=no' src='http://www.metacafe.com/fplayer/" . $adMedia . "' width='560' height='420' wmode='transparent' allowFullScreen='true' allowScriptAccess='always' name='Metacafe_" . $idMedia . "' pluginspage='http://www.macromedia.com/go/getflashplayer' type='application/x-shockwave-flash'></embed>";
        } else 
            if ($decoupageUrl[2] == "videos.arte.tv") {
                
                $adMedia = explode(".", $decoupageUrl[5]);
                $idMedia = explode("-", $adMedia[0]);
                $adMedia = $idMedia[0] . "%2D" . $idMedia[1];
                $idMedia = $idMedia[1];
                
                $embedCode = "<object classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000' codebase='http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=10,0,0,0' id='playerArte' allowScriptAccess='always' width='560' height='420' ><param name='allowFullScreen' value='true' /><param name='allowScriptAccess' value='always' /><param name='quality' value='high'><param name='movie' value='http://videos.arte.tv/videoplayer.swf?admin=false&autoPlay=true&localizedPathUrl=http%3A%2F%2Fvideos%2Earte%2Etv%2Fcae%2Fstatic%2Fflash%2Fplayer%2F&mode=prod&configFileUrl=http%3A%2F%2Fvideos%2Earte%2Etv%2Fcae%2Fstatic%2Fflash%2Fplayer%2Fconfig%2Exml&videoId={$idMedia}&lang=fr&videorefFileUrl=http%3A%2F%2Fvideos%2Earte%2Etv%2Ffr%2Fdo%5Fdelegate%2Fvideos%2F{$adMedia}%2Cview%2CasPlayerXml%2Exml&embed=true&autoPlay=false'><embed src='http://videos.arte.tv/videoplayer.swf?admin=false&autoPlay=true&localizedPathUrl=http%3A%2F%2Fvideos%2Earte%2Etv%2Fcae%2Fstatic%2Fflash%2Fplayer%2F&mode=prod&configFileUrl=http%3A%2F%2Fvideos%2Earte%2Etv%2Fcae%2Fstatic%2Fflash%2Fplayer%2Fconfig%2Exml&videoId={$idMedia}&lang=fr&videorefFileUrl=http%3A%2F%2Fvideos%2Earte%2Etv%2Ffr%2Fdo%5Fdelegate%2Fvideos%2F{$adMedia}%2Cview%2CasPlayerXml%2Exml&embed=true&autoPlay=false' width='560' height='420' allowFullScreen='true' name='playerArte' quality='high' allowScriptAccess='always' pluginspage='http://www.macromedia.com/go/getflashplayer' type='application/x-shockwave-flash'></embed></object>";
            } else 
                if ($decoupageUrl[2] == "www.vimeo.com") {
                    
                    $idMedia = $decoupageUrl[3];
                    
                    $embedCode = "<iframe src='http://player.vimeo.com/video/{$idMedia}?title=0&amp;byline=0&amp;portrait=0&amp;color=ff9933' width='560' height='420' frameborder='0' webkitAllowFullScreen allowFullScreen></iframe>";
                } else 
                    if ($decoupageUrl[2] == "www.allocine.fr") {
                        
                        $idMedia = explode("=", $decoupageUrl[7]);
                        $idMedia = $idMedia[1];
                        
                        $embedCode = "<object width='560px' height='420px'><param name='movie' value='http://www.allocine.fr/blogvision/{$idMedia}'></param><param name='allowFullScreen' value='true'></param><param name='allowScriptAccess' value='always'></param><embed src='http://www.allocine.fr/blogvision/{$idMedia}' type='application/x-shockwave-flash' width='560px' height='420px' allowFullScreen='true' allowScriptAccess='always'/></object>'";
                    } else 
                        if ($decoupageUrl[2] == "www.uvioo.com") {
                            
                            $idMedia = explode("=", $decoupageUrl[4]);
                            $idMedia = $idMedia[3];
                            
                            $embedCode = <<<EOD
<center><embed type="application/x-shockwave-flash" src="http://www.uvioo.com/videoplayer.swf" width="560" height="400" style="undefined" id="mymovie" name="mymovie" bgcolor="#333333" quality="high" menu="true" allowfullscreen="true" allowscriptaccess="always" flashvars="xmlPath=http://www.uvioo.com/settingvideo_d.xml&amp;imagePath=http://www.uvioo.com/images/logo_rouge_uvioo.jpg&amp;videoPath=$idMedia&amp;videoPathHd=$idMedia&amp;videoDefaultQuality=medium&amp;videoTitle=&lt;b&gt;UVioO&lt;/b&gt;&amp;videoDescription=UVioO.com"><br />
<a href="http://www.uvioo.com/video?m=Acksop&so=yt&v=$idMedia">Retrouvez cette vid&eacute;o et bien d'autres sur Uvioo</a></center>
EOD;
                        } else {
                            
                            $erreur = 1;
                            AlerteSecuriteUpdateVideoConnexe($UrlMediaConnexe, $id);
                        }

if ($erreur == 1) {
    header("location: ../index.php?page=erreurDLTweet&type=-10&fichier=" . $UrlMediaConnexe);
} else {
    
    $embedCode = check_ChaineDeCaracteresUpload($embedCode);
    $UrlMediaConnexe = HTML_ChaineDeCaracteres(check_ChaineDeCaracteresUpload($UrlMediaConnexe));
    
    if ($type == 2 || $type == 4) {
        $id_artiste = recuperationIDartisteOffLine($id);
        $id_buzz = ajouterBUZZArtiste($id_artiste, 3);
        ajouterTweetMEDIAConnexeArtiste($id_buzz, $corps, $UrlMediaConnexe, $embedCode);
    } else {
        $id_association = recuperationIDassociationOffLine($id);
        $id_buzz = ajouterBUZZAssociation($id_association, 3);
        ajouterTweetMEDIAConnexeAssociation($id_buzz, $corps, $UrlMediaConnexe, $embedCode);
    }
    
    header("location: ../index.php?page=compte");
}

