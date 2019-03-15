<?php
global $header_title, $header_description, $header_identifier_url, $header_keywords;
if (isset($_GET['type']) && $_GET['type'] == 2) {
    $selectionAnnuaireTitleEtDescription = "des Artistes";
    $selectionAnnuaireIdentifier = "artistes";
} elseif (isset($_GET['type']) && $_GET['type'] == 4) {
    $selectionAnnuaireTitleEtDescription = "des Artisans";
    $selectionAnnuaireIdentifier = "artisans";
} else {
    $selectionAnnuaireTitleEtDescription = "des Artistes et des Artisans";
    $selectionAnnuaireIdentifier = "artistes_artisans";
}
$header_title = "Besançon 25 - Listes {$selectionAnnuaireTitleEtDescription} incrits sur la Plate-forme";
$header_description = "Micro-annuaire {$selectionAnnuaireTitleEtDescription} du Besançon 25";
$header_identifier_url = "besancon25.fr/annuaire_{$selectionAnnuaireIdentifier}";
$header_keywords = "Besançon, Besancon, 25000, 25, artiste, artistes, artisans, artisan, page personnelle, inscrits";

if (function_exists("LancerAffichageDuCorps")) {

    function AfficherPageArtistes()
    {
        LancerAffichageDesArtistes();
    }
} else {

    function LancerAffichageDuCorps()
    {
        LancerAffichageDesArtistes();
        // LancerWebAppGeolocalisationHTML5Google();
    }
}

function LancerAffichageDesArtistes()
{
    echo "<br /><br />";
    echo "<style>
				
				@media ( min-width : 1101px ){
					
				}
				@media ( min-width : 541px ) and ( max-width: 1100px ){
					table.data_artistes { width: 75%; }
					th.data_artistes { display: block; width: 100%;}
					tr.data_artistes { margin: 50px; display: block; width: 90%; border: 5px solid white;}
					td.data_artistes { display: block; align: left; border: none;}
				}
				@media ( max-width: 540px ){
					table.data_artistes { width: 75%; }
					th.data_artistes { display: block; width: 100%;}
					tr.data_artistes { margin: auto 5px; display: block; width: 100%; border: 5px solid white;}
					td.data_artistes { display: block; align: left; border: none;}
				}
			</style>
";
    
    echo "<center><table border='0' class='navigationListe' width='100%'><tr>";
    if (isset($_GET['type'])) {
        if ($_GET['type'] == "tous") {
            echo "<th bgcolor='gray' class='data_artistes'>";
        } else {
            echo "<th>";
        }
        echo "<a href='index.php?page=artistes&type=tous'>tous</a></th>";
        if ($_GET['type'] == "2") {
            echo "<th bgcolor='gray' class='data_artistes'>";
        } else {
            echo "<th>";
        }
        echo "<a href='index.php?page=artistes&type=2'>Artistes</a></th>";
        if ($_GET['type'] == "4") {
            echo "<th bgcolor='gray' class='data_artistes'>";
        } else {
            echo "<th>";
        }
        echo "<a href='index.php?page=artistes&type=4'>Artisans</a></th>";
    } else {
        echo "<th bgcolor='gray' class='data_artistes'>" . "<a href='index.php?page=artistes&type=tous'>tous</a></th>" . "<th>" . "<a href='index.php?page=artistes&type=2'>Artistes</a></th>" . "<th>" . "<a href='index.php?page=artistes&type=4'>Artisans</a></th>";
    }
    echo "</tr></table><center><br/>";
    
    if (isset($_GET['type'])) {
        afficheTousLesArtistes($_GET['type']);
    } else {
        afficheTousLesArtistes("tous");
    }
}

function afficheTousLesArtistes($type)
{
    echo "<script>
	btn_Mur_down = new Image();
	btn_Mur_down = 'images/picto-mur_down.gif';
	btn_Mur_up = new Image();
	btn_Mur_up = 'images/picto-mur.gif';
	btn_Mur_hover = new Image();
	btn_Mur_hover = 'images/picto-mur_hover.gif';
	btn_Tab_down = new Image();
	btn_Tab_down = 'images/picto-page-tableau_down.gif';
	btn_Tab_up = new Image();
	btn_Tab_up = 'images/picto-page-tableau.gif';
	btn_Tab_hover = new Image();
	btn_Tab_hover = 'images/picto-page-tableau_hover.gif';
	btn_Artisans_down = new Image();
	btn_Artisans_down = 'images/picto-page-artisans_down.gif';
	btn_Artisans_up = new Image();
	btn_Artisans_up = 'images/picto-page-artisans.gif';
	btn_Artisans_hover = new Image();
	btn_Artisans_hover = 'images/picto-page-artisans_hover.gif';
	</script>
	";
    
    $sql1 = "SELECT artistes.id_utilisateur FROM utilisateur,artistes WHERE utilisateur.id_utilisateur=artistes.id_utilisateur ORDER BY artistes.id_utilisateur DESC";
    $req1 = faireUneRequeteOffline($sql1);
    echo "<table class='data_artistes' border='0'>";
    $i = 0;
    while ($data = exploiterLigneResultatBDD($req1)) {
        $sql3 = "SELECT type_compte, statut FROM utilisateur WHERE id_utilisateur = '" . $data['id_utilisateur'] . "'";
        $req3 = faireUneRequeteOffLine($sql3);
        $data3 = exploiterLigneResultatBDD($req3);
        
        if (($type == "tous" && ($data3['type_compte'] == 2 || $data3['type_compte'] == 4)) || ($type == $data3['type_compte'])) {
            echo "<tr class='data_artistes'>";
            if ($data3['statut'] != 0) {
                $i ++;
                if ($i % 2 == 1) {
                    $class = "utilisateurs data_artistes";
                } else {
                    $class = "utilisateursInverse data_artistes";
                }
                $sql2 = "SELECT * FROM artistes WHERE id_utilisateur ='" . $data['id_utilisateur'] . "'";
                $req2 = faireUneRequeteOffline($sql2);
                $data2 = exploiterLigneResultatBDD($req2);
                
                if ($data2['site_web_only'] == 0) {
                    echo "<td class='" . $class . "'>" . $data2['nom'] . "</td><td class='" . $class . "'>" . $data2['prenom'] . "</td><td class='" . $class . "'>";
                } else {
                    echo "<td class='" . $class . "'>&nbsp;</td><td class='" . $class . "'>&nbsp;</td><td class='" . $class . "'>";
                }
                $data2['siteInterWeb'] = correctionAdresseInterWeb($data2['siteInterWeb']);
                if ($data2['siteInterWeb'] != "") {
                    echo "<a href='" . $data2['siteInterWeb'] . "'>";
                }
                echo $data2['pseudo'];
                if ($data2['siteInterWeb'] != "") {
                    echo "</a>";
                }
                echo "</td><td class='" . $class . "'>";
                
                if ($data2['site_web_only'] == 0) {
                    if ($data2['voir_telephone'] == 1) {
                        echo $data2['telephone'];
                    } else {
                        echo "&nbsp;";
                    }
                } else {
                    echo "&nbsp;";
                }
                
                echo "</td><td class='" . $class . "'>" . $data2['description'];
                if ($data2['site_web_only'] == 0) {
                    if ($data2['voir_courriel'] == 1) {
                        echo "</td><td class='" . $class . "'>" . $data2['email'] . "</td>";
                    } else {
                        echo "</td><td class='" . $class . "'>&nbsp;</td>";
                    }
                } else {
                    echo "</td><td class='" . $class . "'>&nbsp;</td>";
                }
                
                if ($data2['voir_tweets'] == 1) {
                    echo "<td class='" . $class . "'>";
                    if ($data3['type_compte'] == 2) {
                        if ($data2['affichage_tweets'] == 0) {
                            echo "<a href='index.php?page=tableauInscrit&id={$data2['id_artiste']}&type={$data3['type_compte']}'><img src='images/picto-mur.gif' heigth='25' width='25' onMouseOver='this.src=btn_Mur_down' onMouseOut='this.src=btn_Mur_up' onMouseDown='this.src=btn_Mur_hover'></a>";
                        } else {
                            echo "<a href='index.php?page=murInscrit&id={$data2['id_artiste']}&type={$data3['type_compte']}'><img src='images/picto-page-tableau.gif' heigth='25' width='25' onMouseOver='this.src=btn_Tab_down' onMouseOut='this.src=btn_Tab_up' onMouseDown='this.src=btn_Tab_hover'></a>";
                        }
                    } else {
                        echo "<a href='index.php?page=presentationArtisans&id={$data2['id_artiste']}'><img src='images/picto-page-artisans.gif' heigth='25' width='25' onMouseOver='this.src=btn_Artisans_down' onMouseOut='this.src=btn_Artisans_up' onMouseDown='this.src=btn_Artisans_hover'></a>";
                    }
                    echo "</td>";
                }
            }
            echo "</tr>";
        }
    }
    echo "</table>";
    return;
}

function LancerWebAppGeolocalisationHTML5Google()
{
    $ecmaGoogle = <<<EOD

	<script src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
	
	
	<div id='theGeolocationAppWeDoesntCARE'>canvas</div>
	<div id='info' style='font-variant: capitalize;'>info</div>

	
	<script cite="LE Guide COMPLET TITAN - HTML5-CSS3-JAVASCRIPT - MicroApp">
		/*global variables for the app we doesn't care !*/
		
		var telephone;
		var geolocalisationDuTelephonePossibleOuPas;
		geolocalisationDuTelephonePossibleOuPas = false;
		var carte;
		var etiquette;
		etiquette = null;	
	
		function MontreMoiTonDeplacement(position){
			
			/*Coordonnées source et destinations*/
			var source;
			source = new google.maps.LatLng( position.coords.latitude, position.coords.longitude );
			/*var depart = new google.maps.LatLng( position.coords.latitude, position.coords.longitude );
			var arrivee = new google.maps.LatLng(48,2);*/
			
			/*option d'affichage de la carte Google*/
			var option;
			option = { zoom: 8 , center: source , mapTypeId: google.maps.MapTypeId.ROADMAP };
			/*var canvas = selectionnerDIV('theGeolocationAppWeDoesntCARE');*/
			var canvas;
			canvas = document.getElementById('theGeolocationAppWeDoesntCARE');
			
			carte = new google.maps.Map(canvas, option);
			/*ajout de l'arret du suivi en geolocalisation*/
			canvas.addEventListener("mousedown",JarreteOuJeContinueDafficher,false);
			JarreteOuJeContinueDafficher();
				
		}
		
		function gestionnaireDesErreurs(error){
			/*c'est ici que l'on gère les erreur que Google n'arrive pas lui même a gérer ...*/
			switch(error.code){
				case error.MUTAFUCKAERROR:
					cequilfautafficher = 'Erreur Inconnue ';
				break;
				default:
					cequilfautafficher = 'Erreur : '
						 + error.code.toString()
						 + "// Message pour l'abruti qui ne comprends rien a ce qu'est un téléphone,"
						 + 'essaye de faire remonter cette erreur à la source!<br/>'
						 + "signé: l'abruti qui ne comprennais rien aux téléphones.";
			
			}
			window.alert(cequilfautafficher);
			
		}
		
		function MontreMoiLuiQueJeMeDeplace(position){
			/*Coordonnées actuelles*/
			var actuel;
			actuel = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
			
			/*deplacement de l'étiquette-label( MARKER in english )*/
			if(etiquette != NULL){
				etiquette = new google.maps.marker({ position:actuel , map:carte });
			}else{
				etiquette.setPosition(actuel);
			}
			
		}
		
		function JarreteOuJeContinueDafficher(){
			if(geolocalisationDuTelephonePossibleOuPas == false){
				/*le naviguateur supporte la geolocalisation ou pas ?*/
				if( navigator.geolocation == true ){
					telephone = navigator.geolocation.watchPosition(MontreMoiLuiQueJeMeDeplace, gestionnaireDesErreurs);
					/*selectionnerDIV('info').innerHTML = "vous êtes en mode ACTIF avec geolocalisationACTIVE";*/
					document.getElementById('info').innerHTML = "vous êtes en mode ACTIF avec geolocalisationACTIVE";
				}else{
					/*selectionnerDIV('info').innerHTML = "vous êtes en mode PASSIF sans geolocalisationACTIVE.";*/
					document.getElementById('info').innerHTML = "vous êtes en mode PASSIF sans geolocalisationACTIVE.";
				}
				geolocalisationDuTelephonePossibleOuPas = true;
			}else{
				if( navigator.geolocation == true ){
					navigator.geolocation.clearWatch(telephone);
					/*selectionnerDIV('info').innerHTML = "vous êtes en mode ACTIF avec geolocalisationPASSIVE";*/
					document.getElementById('info').innerHTML = "vous êtes en mode ACTIF avec geolocalisationPASSIVE";	
				}else{
					/*selectionnerDIV('info').innerHTML = "vous êtes en mode PASSIF sans geolocalisation.";*/
					document.getElementById('info').innerHTML = "vous êtes en mode PASSIF sans geolocalisation.";
				}
				geolocalisationDuTelephonePossibleOuPas = false;
			}
			/*geolocalisationDuTelephonePossibleOuPas = !geolocalisationDuTelephonePossibleOuPas;*/
		
		}
		
		function JeMetEnRouteLBordel(){
			
			if(navigator.geolocation){
				/*window.alert("Non mais c'est quoi ce ventilo ?");*/
				/*document.write("");*/
				navigator.geolocation.getCurrentPosition(MontreMoiTonDeplacement, gestionnaireDesErreurs);
			}else{
				/*window.alert("32Miles de météorites ?");*/
			}
		}
	
	
	
	JeMetEnRouteLBordel();
	
	</script>

EOD;
    
    $BIGerror = nettoyageDePointDeCode($ecmaGoogle);
    
    if (! $BIGerror) {
        echo "";
    } else {
        echo $ecmaGoogle;
    }
}

function nettoyageDePointDeCode($syntagme)
{
    // on teste si le nom ne contient pas un caractère null qui provoquerais une faille de sécurité
    if (preg_match('#[\x00-\x1F\x7F-\x9F/\\\\]#', $syntagme) == 1) {
        return false;
    }
    return true;
}

