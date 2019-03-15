<?php
if (! (isset($page) && $page == "index")) {
    
    global $header_title, $header_description, $header_identifier_url, $header_keywords;
    if (isset($_GET['type'])) {
        if ($_GET['type'] == 3) {
            $selectionAnnuaireTitleEtDescription = "des Associations incrites";
            $selectionAnnuaireIdentifier = "associations";
        } elseif ($_GET['type'] == 5) {
            $selectionAnnuaireTitleEtDescription = "des Groupes Musicaux incrits";
            $selectionAnnuaireIdentifier = "groupesMusicaux";
        }
    } else {
        $selectionAnnuaireTitleEtDescription = "des Associations et des Groupes Musicaux incrits";
        $selectionAnnuaireIdentifier = "associations_groupesMusicaux";
    }
    
    $header_title = "Besan&ccedil;on 25 - Listes {$selectionAnnuaireTitleEtDescription} sur la Plate-forme";
    $header_description = "Micro-annuaire {$selectionAnnuaireTitleEtDescription} du Besan&ccedil;on 25";
    $header_identifier_url = "besancon25.fr/annuaire_" . $selectionAnnuaireIdentifier;
    $header_keywords = "Besan&ccedil;on, Besancon, 25000, 25, association, associations, groupes musicaux, groupe musical, page personnelle, inscrits";
}
include_once ("scriptPHP/easyGoogleMap/GoogleMap.php");
include_once ("scriptPHP/easyGoogleMap/JSMin.php");

if (function_exists("LancerAffichageDuCorps")) {

    function AfficherPageAssociations()
    {
        LancerAffichageDesAssociations();
    }
} else {

    function LancerAffichageDuCorps()
    {
        LancerAffichageDesAssociations();
    }
}

function LancerAffichageDesAssociations()
{
    $MAP_OBJECT = new GoogleMapAPI();
    $MAP_OBJECT->_minify_js = isset($_REQUEST["min"]) ? FALSE : TRUE;
    $MAP_OBJECT->setDSN(DSNBDDGOOGLEMAP);
    
    echo "<script type='text/javascript' src='http://www.websnapr.com/js/websnapr.js'></script>";
    
    echo "<style>
				@media ( min-width : 1101px ){
					
				}
				@media ( min-width : 541px ) and ( max-width: 1100px ){
					table.data_asso { width: 95%; border-spacing:5px; }
					th.data_asso { display: block; width: 100%;}
					tr.data_asso { display: block; width: 90%; border: 5px solid white; padding:15px;margin-bottom:10px;}
					td.data_asso { display: block; align: left; border: none; margin: 5px;}
				}
				@media ( max-width: 540px ){
					table.data_asso { width: 95%; border-spacing:5px; }
					th.data_asso { display: block; width: 100%;}
					tr.data_asso { display: block; width: 90%; border: 5px solid white; padding:15px;margin-bottom:10px;}
					td.data_asso { display: block; align: left; border: none; margin: 5px;}
				}
			</style>

		";
    
    echo "<br /><br />";
    
    echo "<center><table border='0' class='navigationListe' width='100%'><tr>";
    if (isset($_GET['type'])) {
        if ($_GET['type'] == "tous") {
            echo "<th bgcolor='gray'>";
        } else {
            echo "<th>";
        }
        echo "<a href='index.php?page=associations&type=tous'>tous</a></th>";
        if ($_GET['type'] == "3") {
            echo "<th bgcolor='gray'>";
        } else {
            echo "<th>";
        }
        echo "<a href='index.php?page=associations&type=3'>Associations</a></th>";
        if ($_GET['type'] == "5") {
            echo "<th bgcolor='gray'>";
        } else {
            echo "<th>";
        }
        echo "<a href='index.php?page=associations&type=5'>Groupes Musicaux</a></th>";
    } else {
        echo "<th bgcolor='gray'>" . "<a href='index.php?page=associations&type=tous'>tous</a></th>" . "<th>" . "<a href='index.php?page=associations&type=3'>Associations</a></th>" . "<th>" . "<a href='index.php?page=associations&type=5'>Groupes Musicaux</a></th>";
    }
    echo "</tr></table><br/>";
    
    if (isset($_GET['type'])) {
        $type = $_GET['type'];
    } else {
        $type = "tous";
    }
    
    echo "<script type='text/javascript'>
	btn_Mur_down = new Image();
	btn_Mur_down = 'images/picto-page-asso_down.gif';
	btn_Mur_up = new Image();
	btn_Mur_up = 'images/picto-page-asso.gif';
	btn_Mur_hover = new Image();
	btn_Mur_hover = 'images/picto-page-asso_hover.gif';
	btn_Groupe_down = new Image();
	btn_Groupe_down = 'images/picto-page-groupe_down.gif';
	btn_Groupe_up = new Image();
	btn_Groupe_up = 'images/picto-page-groupe.gif';
	btn_Groupe_hover = new Image();
	btn_Groupe_hover = 'images/picto-page-groupe_hover.gif';
	</script>
	";
    
    $sql1 = "SELECT * FROM utilisateur";
    $req1 = faireUneRequeteOffline($sql1);
    echo "<table class='data_asso' border='0'>";
    $i = 0;
    
    $tableauAdresse = array();
    
    while ($data = exploiterLigneResultatBDD($req1)) {
        if ($type == "tous") {
            if ($data['type_compte'] == 3 || $data['type_compte'] == 5) {
                echo "<tr>";
                $i ++;
                if ($i % 2 == 1) {
                    $class = "utilisateurs data_asso";
                } else {
                    $class = "utilisateursInverse data_asso";
                }
                $sql2 = "SELECT * FROM associations WHERE id_utilisateur ='" . $data['id_utilisateur'] . "'";
                $req2 = faireUneRequeteOffline($sql2);
                $data2 = exploiterLigneResultatBDD_row($req2);
                $data2[6] = correctionAdresseInterWeb($data2[6]);
                if ($data2[6] == "http://") {
                    $data2[6] = "";
                }
                $adresseGoogle = html_entity_decode($data2[8]) . ", " . html_entity_decode($data2[9]) . " " . html_entity_decode($data2[10]);
                $tableauAdresse[] = html_entity_decode($data2[8]) . ", " . html_entity_decode($data2[9]) . " " . html_entity_decode($data2[10]);
                $descriptionGoogle = "<p class='utilisateur'>{$data2[2]}<br />{$data2[3]}<br />{$data2[4]}<br />{$data2[5]}<br />";
                if ($data2[7] == 1) {
                    if ($data['type_compte'] == 3) {
                        $descriptionGoogle .= "<a href='index.php?page=presentationAssociation&id={$data2[0]}'><img src='images/picto-page-asso.gif' heigth='25' width='25' onMouseOver='this.src=btn_Mur_down' onMouseOut='this.src=btn_Mur_up' onMouseDown='this.src=btn_Mur_hover'>Voir la Page de pr&eacute;sentation du (B25) ?</a>";
                    } else {
                        $descriptionGoogle .= "<a href='index.php?page=presentationGroupe&id={$data2[0]}'><img src='images/picto-page-groupe.gif' heigth='25' width='25' onMouseOver='this.src=btn_Groupe_down' onMouseOut='this.src=btn_Groupe_up' onMouseDown='this.src=btn_Groupe_hover'>Voir la Page de pr&eacute;sentation du (B25) ?</a>";
                    }
                }
                $descriptionGoogle .= "</p>";
                $associationGoogleMap = $MAP_OBJECT->addMarkerByAddress($adresseGoogle, "", $descriptionGoogle, "", "", "");
                echo "<td class='" . $class . "'>" . $data2[2];
                if ($associationGoogleMap !== false) {
                    $MAP_OBJECT->addMarkerOpener($associationGoogleMap, "association" . $i);
                    echo "<a href='#googleMap' id='association" . $i . "'><img src='images/localisationGoogle.png' width='30' height='15' alt='Localiser association sur la carte ?' /></a>";
                }
                if (isset($_COOKIE['interfaceIHM'])) {
                    if ($_COOKIE['interfaceIHM'] == 7 || $_COOKIE['interfaceIHM'] >= 10 || $_COOKIE['interfaceIHM'] == 8 || $_COOKIE['interfaceIHM'] == 6 || $_COOKIE['interfaceIHM'] == 5 || $_COOKIE['interfaceIHM'] == 4) {
                        echo "</td><td class='" . $class . "'>" . $data2[3] . "<br /><br /><b><i>tel:</b></i> " . $data2[4] . "<br /><b><i>courriel:</b></i> " . $data2[5] . "<br /><b><i>Adresse Postale:</b></i> " . $data2[8] . " " . $data2[9] . " " . $data2[10] . "</td><td class='" . $class . "'>";
                        if ($data2[6] !== "" && $data2[6] !== "http://") {
                            $nb = rand(1, 2);
                            switch ($nb) {
                                case 1:
                                    // echo "<script type='text/javascript'>wsr_snapshot('".$data2[6]."', 'K0Wk52JnMZ2N', 's');</script>";
                                    echo "<img src='http://api.thumbalizr.com/?url=$data2[6]&width=250' alt='capture visuelle du site $data2[6]'>";
                                    break;
                                case 2:
                                    echo "<img src='http://wimg.ca/$data2[6]' alt='capture visuelle du site $data2[6]'>";
                                    break;
                                case 3:
                                    grabOrPutIMGonHTML($data2[6]);
                                    break;
                            }
                            echo "<br/><a href='" . $data2[6] . "'>" . $data2[6] . "</a>";
                        }
                        echo "</td>";
                    } elseif ($_COOKIE['interfaceIHM'] == 1 || $_COOKIE['interfaceIHM'] == 2 || $_COOKIE['interfaceIHM'] == 3) {
                        echo "</td><td class='" . $class . "'>" . $data2[3] . "</td><td class='" . $class . "'>" . $data2[4] . "</td><td class='" . $class . "'>" . $data2[5] . "</td>";
                        echo "</tr><tr><td class='" . $class . "'><a href='" . $data2[6] . "'>" . $data2[6] . "</a></td><td class='" . $class . "'>";
                        if ($data2[6] !== "" && $data2[6] !== "http://") {
                            $nb = rand(1, 2);
                            switch ($nb) {
                                case 1:
                                    // echo "<script type='text/javascript'>wsr_snapshot('".$data2[6]."', 'K0Wk52JnMZ2N', 's');</script>";
                                    echo "<img src='http://api.thumbalizr.com/?url=$data2[6]&width=250' alt='capture visuelle du site $data2[6]'>";
                                    break;
                                case 2:
                                    echo "<img src='http://wimg.ca/$data2[6]' alt='capture visuelle du site $data2[6]'>";
                                    break;
                                case 3:
                                    grabOrPutIMGonHTML($data2[6]);
                                    break;
                            }
                            echo "<br/><a href='" . $data2[6] . "'>" . $data2[6] . "</a>";
                        }
                        echo "</td><td class='" . $class . "'>" . $data2[8] . " " . $data2[9] . " " . $data2[10] . "</td>";
                    } else {
                        echo "</td><td class='" . $class . "'>" . $data2[3] . "</td><td class='" . $class . "'>" . $data2[4] . "</td><td class='" . $class . "'>" . $data2[5] . "</td><td class='" . $class . "'><a href='" . $data2[6] . "'>" . $data2[6] . "</a></td><td class='" . $class . "'>";
                        if ($data2[6] !== "" && $data2[6] !== "http://") {
                            $nb = rand(1, 3);
                            switch ($nb) {
                                case 1:
                                    // echo "<script type='text/javascript'>wsr_snapshot('".$data2[6]."', 'K0Wk52JnMZ2N', 's');</script>";
                                    echo "<img src='http://api.thumbalizr.com/?url=$data2[6]&width=250' alt='capture visuelle du site $data2[6]'>";
                                    break;
                                case 2:
                                    echo "<img src='http://wimg.ca/$data2[6]' alt='capture visuelle du site $data2[6]'>";
                                    break;
                                case 3:
                                    grabOrPutIMGonHTML($data2[6]);
                                    break;
                            }
                            echo "<br/><a href='" . $data2[6] . "'>" . $data2[6] . "</a>";
                        }
                        echo "</td><td class='" . $class . "'>" . $data2[8] . " " . $data2[9] . " " . $data2[10] . "</td>";
                    }
                } else {
                    echo "</td><td class='" . $class . "'>" . $data2[3] . "<br /><br /><b><i>tel:</b></i> " . $data2[4] . "<br /><b><i>courriel:</b></i> " . $data2[5] . "<br /><b><i>Adresse Postale:</b></i> " . $data2[8] . " " . $data2[9] . " " . $data2[10] . "</td><td class='" . $class . "'>";
                    if ($data2[6] !== "" && $data2[6] !== "http://") {
                        $nb = rand(1, 2);
                        switch ($nb) {
                            case 1:
                                // echo "<script type='text/javascript'>wsr_snapshot('".$data2[6]."', 'K0Wk52JnMZ2N', 's');</script>";
                                echo "<img src='http://api.thumbalizr.com/?url=$data2[6]&width=250' alt='capture visuelle du site $data2[6]'>";
                                break;
                            case 2:
                                echo "<img src='http://wimg.ca/$data2[6]' alt='capture visuelle du site $data2[6]'>";
                                break;
                            case 3:
                                grabOrPutIMGonHTML($data2[6]);
                                break;
                        }
                        echo "<br/><a href='" . $data2[6] . "'>" . $data2[6] . "</a>";
                    }
                    echo "</td>";
                }
                if ($data2[7] == 1) {
                    echo "</td><td class='" . $class . "'>";
                    if ($data['type_compte'] == 3) {
                        echo "<a href='index.php?page=presentationAssociation&id={$data2[0]}'><img src='images/picto-page-asso.gif' heigth='25' width='25' onMouseOver='this.src=btn_Mur_down' onMouseOut='this.src=btn_Mur_up' onMouseDown='this.src=btn_Mur_hover'></a>";
                    } else {
                        echo "<a href='index.php?page=presentationGroupe&id={$data2[0]}'><img src='images/picto-page-groupe.gif' heigth='25' width='25' onMouseOver='this.src=btn_Groupe_down' onMouseOut='this.src=btn_Groupe_up' onMouseDown='this.src=btn_Groupe_hover'></a>";
                    }
                    echo "</td>";
                }
                echo "</tr>";
            }
        } else {
            if ($data['type_compte'] == (int) $type) {
                echo "<tr>";
                $i ++;
                if ($i % 2 == 1) {
                    $class = "utilisateurs data_asso";
                } else {
                    $class = "utilisateursInverse data_asso";
                }
                $sql2 = "SELECT * FROM associations WHERE id_utilisateur ='" . $data['id_utilisateur'] . "'";
                $req2 = faireUneRequeteOffline($sql2);
                $data2 = exploiterLigneResultatBDD_row($req2);
                $data2[6] = correctionAdresseInterWeb($data2[6]);
                if ($data2[6] == "http://") {
                    $data2[6] = "";
                }
                
                $adresseGoogle = html_entity_decode($data2[8]) . ", " . html_entity_decode($data2[9]) . " " . html_entity_decode($data2[10]);
                $descriptionGoogle = "<p class='utilisateur'>{$data2[2]}<br />{$data2[3]}<br />{$data2[4]}<br />{$data2[5]}<br />";
                if ($data2[7] == 1) {
                    if ($data['type_compte'] == 3) {
                        $descriptionGoogle .= "<a href='index.php?page=presentationAssociation&id={$data2[0]}'><img src='images/picto-page-asso.gif' heigth='25' width='25' onMouseOver='this.src=btn_Mur_down' onMouseOut='this.src=btn_Mur_up' onMouseDown='this.src=btn_Mur_hover'>Voir la Page de pr&eacute;sentation du (B25) ?</a>";
                    } else {
                        $descriptionGoogle .= "<a href='index.php?page=presentationGroupe&id={$data2[0]}'><img src='images/picto-page-groupe.gif' heigth='25' width='25' onMouseOver='this.src=btn_Groupe_down' onMouseOut='this.src=btn_Groupe_up' onMouseDown='this.src=btn_Groupe_hover'>Voir la Page de pr&eacute;sentation du (B25) ?</a>";
                    }
                }
                $descriptionGoogle .= "</p>";
                $associationGoogleMap = $MAP_OBJECT->addMarkerByAddress($adresseGoogle, "", $descriptionGoogle);
                
                echo "<td class='" . $class . "'>" . $data2[2];
                if ($associationGoogleMap !== false) {
                    $MAP_OBJECT->addMarkerOpener($associationGoogleMap, "association" . $i);
                    echo "<a href='#googleMap' id='association" . $i . "'><img src='images/localisationGoogle.png' width='30' height='15' alt='Localiser association sur la carte ?' /></a>";
                }
                if ($_COOKIE['interfaceIHM'] == 7 || $_COOKIE['interfaceIHM'] == 8 || $_COOKIE['interfaceIHM'] >= 10) {
                    echo "</td><td class='" . $class . "'>" . $data2[3] . "<br /><br /><b><i>tel:</b></i> " . $data2[4] . "<br /><b><i>courriel:</b></i> " . $data2[5] . "<br /><b><i>Adresse Postale:</b></i> " . $data2[8] . " " . $data2[9] . " " . $data2[10] . "</td><td class='" . $class . "'>";
                    if ($data2[6] !== "" && $data2[6] !== "http://") {
                        $nb = rand(1, 2);
                        switch ($nb) {
                            case 1:
                                // echo "<script type='text/javascript'>wsr_snapshot('".$data2[6]."', 'K0Wk52JnMZ2N', 's');</script>";
                                echo "<img src='http://api.thumbalizr.com/?url=$data2[6]&width=250' alt='capture visuelle du site $data2[6]'>";
                                break;
                            case 2:
                                echo "<img src='http://wimg.ca/$data2[6]' alt='capture visuelle du site $data2[6]'>";
                                break;
                            case 3:
                                grabOrPutIMGonHTML($data2[6]);
                                break;
                        }
                        echo "<br/><a href='" . $data2[6] . "'>" . $data2[6] . "</a>";
                    }
                    echo "</td>";
                } else {
                    echo "</td><td class='" . $class . "'>" . $data2[3] . "</td><td class='" . $class . "'>" . $data2[4] . "</td><td class='" . $class . "'>" . $data2[5] . "</td><td class='" . $class . "'><a href='" . $data2[6] . "'>" . $data2[6] . "</a></td><td class='" . $class . "'>";
                    if ($data2[6] !== "" && $data2[6] !== "http://") {
                        $nb = rand(1, 2);
                        switch ($nb) {
                            case 1:
                                // echo "<script type='text/javascript'>wsr_snapshot('".$data2[6]."', 'K0Wk52JnMZ2N', 's');</script>";
                                echo "<img src='http://api.thumbalizr.com/?url=$data2[6]&width=250' alt='capture visuelle du site $data2[6]'>";
                                break;
                            case 2:
                                echo "<img src='http://wimg.ca/$data2[6]' alt='capture visuelle du site $data2[6]'>";
                                break;
                            case 3:
                                grabOrPutIMGonHTML($data2[6]);
                                break;
                        }
                        echo "</td>";
                    }
                    echo "</tr>";
                }
            }
        }
    }
    echo "</table>";
    
    if ($type == "tous" || $type == 3) {
        echo "<br /><br /><br />";
        $MAP_OBJECT->setHeight('500');
        if (detection_mobile()) {
            $width = 240;
        } else {
            $width = 700;
        }
        $MAP_OBJECT->setWidth($width);
        $MAP_OBJECT->enableStreetViewControls();
        
        cadreAlignCentrerDebut();
        echo "<a name='googleMap'></a>";
        echo "<center><br />";
        echo $MAP_OBJECT->getHeaderJS();
        echo $MAP_OBJECT->getMapJS();
        echo $MAP_OBJECT->printOnLoad();
        echo $MAP_OBJECT->printMap();
        // echo $MAP_OBJECT->printSidebar();
        echo "<br /></center>";
        cadreAlignCentrerFin();
    }
    echo "<center />";
}
