<?php
// --
check_session();
// --

global $header_title, $header_description, $header_identifier_url, $header_keywords;
$header_title = "Besançon 25 - La gestion des comptes privés appartenant à la Plate-forme";
$header_description = "Une des interfaces de gestion de Besançon 25";
$header_identifier_url = "besancon25.fr/gestion_utilisateurs";
$header_keywords = "Besançon, Besancon, 25000, 25, interface de gestion, espace privé";

function LancerAffichageDuCorps()
{
    echo "<script language='javascript'>" . "
	btn_suppr_down = new Image();
	btn_suppr_down = 'images/picto-supprimer_down.gif';
	btn_suppr_up = new Image();
	btn_suppr_up = 'images/picto-supprimer_up.gif';
	btn_suppr_hover = new Image();
	btn_suppr_hover = 'images/picto-supprimer_hover.gif';

	btn_modif_down = new Image();
	btn_modif_down = 'images/picto-modifierCircle_down.gif';
	btn_modif_up = new Image();
	btn_modif_up = 'images/picto-modifierCircle_up.gif';
	btn_modif_hover = new Image();
	btn_modif_hover = 'images/picto-modifierCircle_hover.gif';

	</script>
	<script src='scriptJS/sorttable.js'></script>
	";
    
    echo "<table border='0' align='center'>" . "<h1 class='utilisateurs'>Gestion des Utilisateurs:</h1>";
    if (! isset($_POST['triID'])) {
        if (! isset($_SESSION['triID'])) {
            $tri = array(
                1,
                0,
                0,
                0
            );
        } else {
            $tri = array(
                $_SESSION['triID'],
                $_SESSION['triPseudo'],
                $_SESSION['triType'],
                $_SESSION['triStatut']
            );
        }
    } else {
        $_SESSION['triID'] = $_POST['triID'];
        $_SESSION['triPseudo'] = $_POST['triPseudo'];
        $_SESSION['triType'] = $_POST['triType'];
        $_SESSION['triStatut'] = $_POST['triStatut'];
        $tri = array(
            $_POST['triID'],
            $_POST['triPseudo'],
            $_POST['triType'],
            $_POST['triStatut']
        );
    }
    AfficheTousLesUtilisateurs($_SESSION['type_compte'], $tri);
    echo "</table>";
}

function AfficheTousLesUtilisateurs($admin, $tri)
{
    $type = array(
        "super-utilisateur",
        "journaliste",
        "artiste",
        "association",
        "artisans",
        "groupe musical"
    );
    $status = array(
        "Nouveau",
        "en Cours",
        "Admis",
        "kick&eacute;",
        "banni",
        "d&eacute;sinscrit"
    );
    $couleur = array(
        "FFFFFF",
        "FF5B2B",
        "046380",
        "556627",
        "B9121B",
        "34393E"
    );
    $ordonancement = array(
        "dateInscription ASC",
        "id_utilisateur ASC",
        "id_utilisateur DESC",
        "",
        "pseudo ASC",
        "pseudo DESC",
        "",
        "type_compte ASC",
        "type_compte DESC",
        "",
        "statut ASC",
        "statut DESC"
    );
    $indiceTri = array(
        "&harr;",
        "&darr;",
        "&uarr;"
    );
    if ($tri[2] != 0) {
        if ($tri[1] != 0) {
            if ($tri[3] != 0) {
                $sql = "SELECT * FROM utilisateur ORDER BY " . $ordonancement[(6 + $tri[2])] . "," . $ordonancement[(3 + $tri[1])] . "," . $ordonancement[(9 + $tri[3])] . "," . $ordonancement[$tri[0]];
            } else {
                $sql = "SELECT * FROM utilisateur ORDER BY " . $ordonancement[(6 + $tri[2])] . "," . $ordonancement[(3 + $tri[1])] . "," . $ordonancement[$tri[0]];
            }
        } else {
            if ($tri[3] != 0) {
                $sql = "SELECT * FROM utilisateur ORDER BY " . $ordonancement[(6 + $tri[2])] . "," . $ordonancement[(9 + $tri[3])] . "," . $ordonancement[$tri[0]];
            } else {
                $sql = "SELECT * FROM utilisateur ORDER BY " . $ordonancement[(6 + $tri[2])] . "," . $ordonancement[$tri[0]];
            }
        }
    } else {
        if ($tri[1] != 0) {
            if ($tri[3] != 0) {
                $sql = "SELECT * FROM utilisateur ORDER BY " . $ordonancement[(3 + $tri[1])] . "," . $ordonancement[(9 + $tri[3])] . "," . $ordonancement[$tri[0]];
            } else {
                $sql = "SELECT * FROM utilisateur ORDER BY " . $ordonancement[(3 + $tri[1])] . "," . $ordonancement[$tri[0]];
            }
        } else {
            if ($tri[3] != 0) {
                $sql = "SELECT * FROM utilisateur ORDER BY " . $ordonancement[(9 + $tri[3])] . "," . $ordonancement[$tri[0]];
            } else {
                $sql = "SELECT * FROM utilisateur ORDER BY " . $ordonancement[$tri[0]];
            }
        }
    }
    $req = faireUneRequeteOffline($sql);
    echo "<table border='0' class='sortable'>";
    $i = 0;
    echo "<thead><tr>";
    $futurTriID = ($tri[0] + 1) % 3;
    $futurTriPseudo = ($tri[1] + 1) % 3;
    $futurTriType = ($tri[2] + 1) % 3;
    $futurTriStatut = ($tri[3] + 1) % 3;
    echo "<td align='center' bgcolor='white'><form action='index.php?page=gestionUtilisateur' method='POST'>" . "<input type='hidden' name='triID' value='" . $futurTriID . "'>" . "<input type='hidden' name='triPseudo' value='" . $tri[1] . "'>" . "<input type='hidden' name='triType' value='" . $tri[2] . "'>" . "<input type='hidden' name='triStatut' value='" . $tri[3] . "'>" . "ID" . "<input type='submit' value='" . $indiceTri[$tri[0]] . "'></form></td>";
    echo "<td align='center' bgcolor='white'><form action='index.php?page=gestionUtilisateur' method='POST'>" . "<input type='hidden' name='triID' value='" . $tri[0] . "'>" . "<input type='hidden' name='triPseudo' value='" . $futurTriPseudo . "'>" . "<input type='hidden' name='triType' value='" . $tri[2] . "'>" . "<input type='hidden' name='triStatut' value='" . $tri[3] . "'>" . "Pseudo ou Login" . "<input type='submit' value='" . $indiceTri[$tri[1]] . "'></form></td>";
    echo "<td align='center' bgcolor='white'><form action='index.php?page=gestionUtilisateur' method='POST'>Date d'Inscription";
    if ($tri == array(
        0,
        0,
        0,
        0
    )) {
        echo "<input type='submit' value='&Dagger;'>";
    } else {
        echo "<input type='submit' value='&dagger;'>";
    }
    echo "</form></td>";
    echo "<td align='center' bgcolor='white'><form action='index.php?page=gestionUtilisateur' method='POST'>" . "<input type='hidden' name='triID' value='" . $tri[0] . "'>" . "<input type='hidden' name='triPseudo' value='" . $tri[1] . "'>" . "<input type='hidden' name='triType' value='" . $futurTriType . "'>" . "<input type='hidden' name='triStatut' value='" . $tri[3] . "'>" . "Compte" . "<input type='submit' value='" . $indiceTri[$tri[2]] . "'></form></td>";
    echo "<td align='center' bgcolor='white'><form action='index.php?page=gestionUtilisateur' method='POST'>" . "<input type='hidden' name='triID' value='" . $tri[0] . "'>" . "<input type='hidden' name='triPseudo' value='" . $tri[1] . "'>" . "<input type='hidden' name='triType' value='" . $tri[2] . "'>" . "<input type='hidden' name='triStatut' value='" . $futurTriStatut . "'>" . "Validit&eacute;e" . "<input type='submit' value='" . $indiceTri[$tri[3]] . "'></form></td>";
    echo "<td colspan='2' class='utilisateurs' align='right'>&lt;&lt;&lt; Action de Tri</td>";
    echo "</tr></thead>";
    while ($data = exploiterLigneResultatBDD($req)) {
        // on saute le super-utilisateur afin qu'il ne soit pas afficher dans les gestionnaire des utilisateurs
        if ($data['type_compte'] == 0)
            continue (1);
        $i++;
        if ($i % 2 == 1) {
            $class = "utilisateurs";
        } else {
            $class = "utilisateursInverse";
        }
        echo "<tr>";
        if ($data['type_compte'] !== 0) {
            echo "<td class='" . $class . "'>" . $data['id_utilisateur'] . "</td>" . "<td class='" . $class . "' style='text-align:left;'><a href='" . afficheLienConnexionTransparente($data['id_utilisateur']) . "'><img src='images/picto-cadenas.jpeg' width='15px' height='15px' /></a>&nbsp;<a class='info' onclick='return false' href='#'>" . $data['pseudo'] . "<span>";
            switch ($data['type_compte']) {
                case 1:
                    $sql = "SELECT * FROM journalistes WHERE id_utilisateur ='" . $data['id_utilisateur'] . "'";
                    break;
                case 2:
                    $sql = "SELECT * FROM artistes WHERE id_utilisateur ='" . $data['id_utilisateur'] . "'";
                    break;
                case 3:
                    $sql = "SELECT * FROM associations WHERE id_utilisateur ='" . $data['id_utilisateur'] . "'";
                    break;
                case 4:
                    $sql = "SELECT * FROM artistes WHERE id_utilisateur ='" . $data['id_utilisateur'] . "'";
                    break;
                case 5:
                    $sql = "SELECT * FROM associations WHERE id_utilisateur ='" . $data['id_utilisateur'] . "'";
                    break;
                default:
                    $sql = "";
            }
            $req2 = faireUneRequeteOffLine($sql);
            $data2 = mysql_fetch_row($req2);
            switch ($data['type_compte']) {
                case 1:
                    echo $data2[1] . "<br />" . $data2[2] . "<br />" . $data2[3] . "<br />" . $data2[6] . "<br />" . $data2[7] . "<br />" . $data2[4] . "<br /><br />" . $data2[5];
                    break;
                case 2:
                    echo $data2[1] . "<br />" . $data2[2] . "<br />" . $data2[3] . "<br />" . $data2[11] . "<br />" . $data2[12] . "<br />" . $data2[13] . "<br/>nb d'Affichage de la page personnelle:" . $data2[10] . "<br /><br/>" . $data2[4];
                    break;
                case 3:
                    echo $data2[2] . "<br />" . $data2[5] . "<br />" . $data2[3] . "<br />" . $data2[6] . "<br />" . $data2[6] . "<br />" . $data2[7] . $data2[8] . "<br /><br />" . $data2[4];
                    break;
                case 4:
                    echo $data2[1] . "<br />" . $data2[2] . "<br />" . $data2[3] . "<br />" . $data2[11] . "<br />" . $data2[12] . "<br />" . $data2[13] . "<br/>nb d'Affichage de la page personnelle:" . $data2[10] . "<br /><br />" . $data2[4];
                    break;
                case 5:
                    echo $data2[2] . "<br />" . $data2[5] . "<br />" . $data2[3] . "<br />" . $data2[6] . "<br />" . $data2[6] . "<br />" . $data2[7] . $data2[8] . "<br /><br />" . $data2[4];
                    break;
                default:
                    echo "T'es l'admin coco !";
            }
            
            $repPerso = RADIEURAE_REP_PATH . "upload_utilisateurs/" . $data['repertoirePersonnel'];
            
            echo "<br />Non-Connecté depuis :" . $data['dateDerniereConnexion'] . "<br />Nb de Connexion à l'interface:" . $data['nbConnexions'] . "<br />";
            /*
             * echo $repPerso;
             * echo "<pre style='font-size: xxx-small'>";
             * print_r($data);
             * echo "</pre>";
             */
            
            echo "</span></a></td>" . 

            "<td class='" . $class . "'>" . $data['dateInscription'] . "</td>" . "<td class='" . $class . "'>" . $type[$data['type_compte']] . "</td>" . "<td class='" . $class . "' style='background-color:#" . $couleur[$data['statut']] . ";'>" . $status[$data['statut']] . "</td>";
            $droits = afficheDroitDossierUtilisateur($repPerso);
            if ($droits == 'drwxr-xr-x') {
                $dircolor = 5;
            } else 
                if ($droits == 'u---------') {
                    $dircolor = 3;
                } else {
                    $dircolor = 1;
                }
            echo "<td class='" . $class . "' style='background-color:#" . $couleur[$dircolor] . ";'>" . $data['repertoirePersonnel'] . "<br />" . $droits . "</td>";
            if ($admin == 0) {
                if ($_SESSION['type_compte'] == 0) {
                    echo "<td><form method='POST' action='controlleurs/traitementSuppressionUtilisateur.php'>" . "<input type='hidden' name='id' value='" . $data['id_utilisateur'] . "'>" . "<input type='hidden' name='pseudo' value='" . $data['pseudo'] . "'>" . "<button type='submit' style='width:33px;heigth:100%;' class='btn_modif'><img src='./images/picto-supprimer_up.gif' onMouseOut='this.src=btn_suppr_up;' onMouseDown='this.src=btn_suppr_down;' onMouseOver='this.src=btn_suppr_hover;' alt='supprimer?' /></button>" . "</form></td>";
                }
                echo "<td><form method='POST' action='controlleurs/traitementModifEtatUtilisateur.php'>" . "<input type='hidden' name='id' value='" . $data['id_utilisateur'] . "'>" . "<button type='submit' style='width:60px;heigth:100%;' class='btn_modif'><img src='./images/picto-modifierCircle_up.gif' onMouseOut='this.src=btn_modif_up;' onMouseDown='this.src=btn_modif_down;' onMouseOver='this.src=btn_modif_hover;' alt='Changer?' /></button>" . "</form></td>";
            }
        }
        echo "</tr>";
    }
    echo "</table>";
    return;
}
