<?php
require "../../../variablesApplication.php";
session_start();
include SCRIPTPHPPATH . '/fichiersImages.php';
require SCRIPTPHPPATH . '/sessions.php';
// ---- repertoire a ouvrir ---------------------------------
$NomRep = SVNRADIEURAE_DIR . "upload_utilisateurs/" . $_SESSION['repertoire'] . "/videos";
$NomSVN = SVNRADIEURAE_PATH . "upload_utilisateurs/" . $_SESSION['repertoire'] . "/videos";

check_session_type(1);

$unique_id_telechargement = md5(microtime() . rand());
echo $unique_id_telechargement;

// affichage du code html
echo "<html>";
echo "<head>";
echo "<title>Besançon 25 - La plate-Forme des artistes et des associations de Besançon - v2.00d - beta version</title>";
echo "<META HTTP-EQUIV='Content-Type' CONTENT='text/html; charset=UTF-8'>";
echo "<link type='text/css' rel='stylesheet' href='../../../besancon25.css'>";

echo "<script src='../scriptJS/ajax.js' type='text/javascript'></script>";
echo "<script src='../scriptJS/jquery.js' type='text/javascript'></script>";
echo "<style>
		#progress{
		    width: 300px;
		    margin: auto;
		}
		progress{
		    display: inline-block;
		    -moz-box-sizing: border-box;
		         box-sizing: border-box;
		    width: 300px;
		    height: 20px;
		    padding: 3px 3px 2px 3px;
		    background: #333; 
		    background: -webkit-linear-gradient(#2d2d2d,#444);
		    background:    -moz-linear-gradient(#2d2d2d,#444);
		    background:      -o-linear-gradient(#2d2d2d,#444);
		    background:         linear-gradient(#2d2d2d,#444);
		    border: 1px solid rgba(0,0,0,.5);
		    border-radius: 15px;
		    box-shadow: 0 1px 0 rgba(255,255,255,.2);   
		}
		/* Style de la barre pour Firefox*/
		progress::-moz-progress-bar{
		    border-radius:10px;
		    background: #09c;
		    background: 
		      -moz-repeating-linear-gradient(
		        45deg, 
		        rgba(255,255,255,.2) 0,
		        rgba(255,255,255,.2) 10px, 
		        rgba(255,255,255,0) 10px,
		        rgba(255,255,255,0) 20px
		      ),
		      -moz-linear-gradient(
		        rgba(255,255,255,.1) 50%,
		        rgba(255,255,255,0) 60%
		      ),
		      #09c;
		    background: 
		       -moz-repeating-linear-gradient(
		        45deg, 
		        rgba(255,255,255,.2) 0,
		        rgba(255,255,255,.2) 10px, 
		        rgba(255,255,255,0) 10px,
		        rgba(255,255,255,0) 20px
		      ),
		       -moz-linear-gradient(
		        rgba(255,255,255,.1) 50%,
		        rgba(255,255,255,0) 60%
		      ),
		      #09c;
		    background-size: 300px 20px, auto, auto;
		    background-position: -300px 0, top, top;
		    background-position: top right, top, top;
		    box-shadow: 0 1px 0 rgba(255,255,255,.5) inset, 
		                0 -1px 0 rgba(0,0,0,.8) inset,
		                0 0 2px black;
		  
		}
		
		/* Style de la barre pour Chrome*/
		progress::-webkit-progress-bar{
		
		    border-radius:10px;
		    background: transparent;
		    background: 
		      -webkit-repeating-linear-gradient(
		        45deg, 
		        rgba(255,255,255,.2) 0,
		        rgba(255,255,255,.2) 10px, 
		        rgba(255,255,255,0) 10px,
		        rgba(255,255,255,0) 20px
		      ),
		      -webkit-linear-gradient(
		        rgba(255,255,255,.1) 50%,
		        rgba(255,255,255,0) 60%
		      ),
		      #09c;
		    background: 
		      -webkit-repeating-linear-gradient(
		        45deg, 
		        rgba(255,255,255,.2) 0,
		        rgba(255,255,255,.2) 10px, 
		        rgba(255,255,255,0) 10px,
		        rgba(255,255,255,0) 20px
		      ),
		      -webkit-linear-gradient(
		        rgba(255,255,255,.1) 50%,
		        rgba(255,255,255,0) 60%
		      ),
		      #09c;
		    background-size: 300px 20px, auto, auto;
		    background-position: -300px 0, top, top;
		    background-position: top right, top, top;
		    box-shadow: 0 1px 0 rgba(255,255,255,.5) inset, 
		                0 -1px 0 rgba(0,0,0,.8) inset,
		                0 0 2px black;
		  
		}
		}
	</style>";
echo "<script language='javascript'>" . "
		var timerUpload;
		function LancerProgressionUpload(){
			timerUpload=setInterval('EnvoyerUpload()', 500);
		}
		
		function EnvoyerUpload(){
		var xhr = createXHR();
		xhr.onreadystatechange = function(){
			//document.getElementById('donnees').innerHTML = 'Attente...'
				if(xhr.readyState == 4){
					if(xhr.status == 200){
						document.getElementById('progress').innerHTML = ";
echo "'<p>R&eacute;ception des Donn&eacute;es...<b> '+ xhr.responseText + '%</b></p><progress value=\"' + xhr.responseText + '\" min=\"0\" max=\"100\"> ' + xhr.responseText + '%</progress>';
						var width_progress;
						var xhtml_progress_bar;
						width_progress = (250 * (xhr.responseText/100));
						xhtml_progress_bar = document.getElementById('progress_indicator');
						xhtml_progress_bar.style.width = width_progress + 'px';
						document.getElementById('donnees').innerHTML = 'Attente...'
						";
echo "
					}else{
						document.getElementById('donnees').innerHTML = 'Error:  ' + xhr.status + ' // ' + xhr.statusText;
					}
				}
			}
		
		xhr.open( 'GET' , '../../../controlleursAJAX/suivi_du_telechargement_session.php?id={$unique_id_telechargement}', true);
		xhr.send(null);
		}
		</script>
		";
echo "<script type='text/javascript' src='fonctions.js'></script>";
echo "</head>";
echo "<body text='#000000' bgcolor='gray' onunload='FermerFormulaireVideo()'>";
// creation du tableau contenant le menu et l'horloge et accessoirement un sous tableau(voir ci-dessous)
echo "<h1>Les videos disponibles <img src='../../../images/aide_B25.gif' width='20' height='20' border='0' alt='" . $NomRep . "' /> </h1>";
// creation du formulaire d'envoi
echo "<form name='ChoixVideos' method='POST' action='TraitementVideo.php'>";

AfficherLesVideosDisponibles($NomRep, $NomSVN);

echo "<input type='submit' value='Choisir' />";
echo "</form>";
echo "</td></tr>";
echo "<tr><td>" . "<div class='formulaire' id='formulaire'>" . "<table border='0' height='100' width='200' align='center'>" . "<tr><td>" . "<p align ='center'>" . "<form enctype='multipart/form-data' method='post' action='TraitementInsertionVideo.php'>" . "<input type='hidden' name='" . ini_get('session.upload_progress.name') . "' value='{$unique_id_telechargement}' />" . "<input type='hidden' name='MAX_FILE_SIZE' value='8388608'/>" . "<p class='Titre'>Video à telecharger sur le SERVEUR:</p><input type='file' name='Fichier'/><BR>(max 8Mo)" . "<input type='submit' name='btnUpload' value='Télécharger' onClick='AfficheFormTelechargementVideo(\"" . $unique_id_telechargement . "\")'/>" . "</p>" . "</form>" . "</td></tr>" . "</table>" . "</div>" . "<div style='display:none' class='telechargementEnCours' id='telechargementEnCours'>" . "<table border='0' height='100' width='200' align='center'>" . "<tr><td>" . "<div style='display:block;z-index=2;position:relative' id='progress_html4'>" . "	<div style='width:160px;height:158px;padding:2px;background-color:white;border:1px solid black;text-align:center'>" . "		<div id='progress_indicator' style='width:50px;height:148px;background-color:green;'></div>" . "	</div>" . "</div>" . "<img style='display:block;z-index=3;position:relative;top:-150px;left:10px' name='telechargementEnCours' src='../../../images/upload.jpg' />" . "</td></tr>" . "</table>" . "<div id='progress'>" . "<p>Retrieving data...<strong>0%</strong></p>" . "<progress value='5' min='0' max='100'>0%</progress>" . "</div>" . "<div id='donnees'>" . "</div>" . "</div>";

echo "</td></tr></table></body></html>";

function AfficherLesVideosDisponibles($NomRep, $RepSVN)
{
    // ---- tableau contenant le nom des fichiers ---------------
    $TabFichierVideos = array();
    $TabFichierInconnus = array();
    $TabTousFichier = array();
    
    // --- ouverture du répertoire courant-----------------------
    $Rep = @opendir($NomRep);
    if (! $Rep)
        exit("Erreur dans l'ouverture du répertoire");
        // --- boucle de lecture ------------------------------------
    while (false !== ($Fichier = @readdir($Rep))) {
        // on evite d'afficher le repertoire courant et le repertoire précédent
        if ($Fichier == '.' || $Fichier == '..')
            continue;
        array_push($TabTousFichier, $Fichier);
    }
    // --- fermeture du répertoire courant----------------------
    @closeDir($Rep);
    
    print_r($TabTousFichier);
    
    // --- Tri des fichiers et des dossiers du repertoire courant
    foreach ($TabTousFichier as $Fichier) {
        // on utilise pas de repertoires ici
        if (! is_dir($NomRep . '/' . $Fichier)) {
            // on met les fichiers trouvés dans leurs tableaux respectifs
            $Fexp = explode(".", $Fichier);
            if ($Fexp[1] == "avi" || $Fexp[1] == "mp4" || $Fexp[1] == "webm" || $Fexp[1] == "ogv") {
                array_push($TabFichierVideos, $Fichier);
            } else {
                array_push($TabFichierInconnus, $Fichier);
            }
        }
    }
    /**
     * *******************************************************
     */
    // --- Affichage des FICHIERS trouvés ----------------------
    // creation du formulaire d'envoi
    echo "<table border='0' class='fondCouleurSecondaire'>";
    for ($i = 0; $i < sizeof($TabFichierVideos); $i ++) {
        echo "<tr>";
        echo "<td>";
        
        echo "<input type='radio' name='videoChoisie' value='http://" . $RepSVN . "/" . $TabFichierVideos[$i] . "' ";
        if ($i == 0)
            echo "checked='checked' ";
        echo "/>";
        echo "</td><td>";
        echo "<a href='" . $RepSVN . "/" . $TabFichierVideos[$i] . "'>" . $TabFichierVideos[$i] . "</a>&nbsp;";
        echo "</td><td>";
        echo "<a href='TraitementSuppressionVideos.php?videoChoisie=" . $NomRep . "/" . $TabFichierVideos[$i] . "' ><img src='../../../images/btn_supprimerVideos.jpg' width='100' height='20' border='0' /></a>";
        // creation du formulaire de suppression
        /*
         * echo "<form name='mp3' method='POST' action='TraitementSuppressionVideo.php'>";
         * echo "<input type='hidden' name='videoChoisie' value='".$NomRep."/".$TabFichierVideos[$i]."' />";
         * echo "<input type='submit' value='supprimer' />";
         * echo "</form>";
         */
        // -------------------------------------
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";
}
