<?php

function AfficheFormGestionUtilisateur()
{
    // --
    check_session();
    // --
    
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

function afficheTousLesUtilisateurs($admin, $tri)
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
        "34393E",
        "556627",
        "B9121B",
        "046380"
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
    echo "<table border='0'>";
    $i = 0;
    echo "<tr>";
    $futurTriID = ($tri[0] + 1) % 3;
    $futurTriPseudo = ($tri[1] + 1) % 3;
    $futurTriType = ($tri[2] + 1) % 3;
    $futurTriStatut = ($tri[3] + 1) % 3;
    echo "<td align='center'><form action='index.php?page=gestionUtilisateur' method='POST'>" . "<input type='hidden' name='triID' value='" . $futurTriID . "'>" . "<input type='hidden' name='triPseudo' value='" . $tri[1] . "'>" . "<input type='hidden' name='triType' value='" . $tri[2] . "'>" . "<input type='hidden' name='triStatut' value='" . $tri[3] . "'>" . "<input type='submit' value='" . $indiceTri[$tri[0]] . "'></form></td>";
    echo "<td align='center'><form action='index.php?page=gestionUtilisateur' method='POST'>" . "<input type='hidden' name='triID' value='" . $tri[0] . "'>" . "<input type='hidden' name='triPseudo' value='" . $futurTriPseudo . "'>" . "<input type='hidden' name='triType' value='" . $tri[2] . "'>" . "<input type='hidden' name='triStatut' value='" . $tri[3] . "'>" . "<input type='submit' value='" . $indiceTri[$tri[1]] . "'></form></td>";
    echo "<td align='center'><form action='index.php?page=gestionUtilisateur' method='POST'>";
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
    echo "<td align='center'><form action='index.php?page=gestionUtilisateur' method='POST'>" . "<input type='hidden' name='triID' value='" . $tri[0] . "'>" . "<input type='hidden' name='triPseudo' value='" . $tri[1] . "'>" . "<input type='hidden' name='triType' value='" . $futurTriType . "'>" . "<input type='hidden' name='triStatut' value='" . $tri[3] . "'>" . "<input type='submit' value='" . $indiceTri[$tri[2]] . "'></form></td>";
    echo "<td align='center'><form action='index.php?page=gestionUtilisateur' method='POST'>" . "<input type='hidden' name='triID' value='" . $tri[0] . "'>" . "<input type='hidden' name='triPseudo' value='" . $tri[1] . "'>" . "<input type='hidden' name='triType' value='" . $tri[2] . "'>" . "<input type='hidden' name='triStatut' value='" . $futurTriStatut . "'>" . "<input type='submit' value='" . $indiceTri[$tri[3]] . "'></form></td>";
    echo "<td colspan='2' class='utilisateurs' align='right'>&lt;&lt;&lt; Action de Tri</td>";
    echo "</tr>";
    while ($data = mysql_fetch_assoc($req)) {
        $i ++;
        if ($i % 2 == 1) {
            $class = "utilisateurs";
        } else {
            $class = "utilisateursInverse";
        }
        echo "<tr>";
        if ($data['type_compte'] != 0) {
            echo "<td class='" . $class . "'>" . $data['id_utilisateur'] . "</td>" . "<td class='" . $class . "' style='text-align:left;'><a class='info' onclick='return false' href='#'>" . $data['pseudo'] . "<span>";
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
            
            $repPerso = "upload_utilisateurs/" . $data['repertoirePersonnel'];
            
            echo "</span></a></td>" . "<td class='" . $class . "'>" . $data['dateInscription'] . "</td>" . "<td class='" . $class . "'>" . $type[$data['type_compte']] . "</td>" . "<td class='" . $class . "' style='background-color:#" . $couleur[$data['statut']] . ";'>" . $status[$data['statut']] . "</td>";
            $droits = afficheDroitDossierUtilisateur($repPerso);
            if ($droits == 'drwxr-xr-x') {
                $dircolor = 3;
            } else 
                if ($droits == 'u---------') {
                    $dircolor = 4;
                } else {
                    $dircolor = 2;
                }
            echo "<td class='" . $class . "' style='background-color:#" . $couleur[$dircolor] . ";'>" . $data['repertoirePersonnel'] . "<br />" . $droits . "</td>";
            if ($admin == 0) {
                echo "<td><form method='POST' action='controlleurs/traitementSuppressionUtilisateur.php'>" . "<input type='hidden' name='id' value='" . $data['id_utilisateur'] . "'>" . "<input type='hidden' name='pseudo' value='" . $data['pseudo'] . "'>" . "<button type='submit' style='width:33px;heigth:100%;' class='btn_modif'><img src='./images/picto-supprimer_up.gif' onMouseOut='this.src=btn_suppr_up;' onMouseDown='this.src=btn_suppr_down;' onMouseOver='this.src=btn_suppr_hover;' alt='supprimer?' /></button>" . "</form></td>";
                echo "<td><form method='POST' action='controlleurs/traitementModifEtatUtilisateur.php'>" . "<input type='hidden' name='id' value='" . $data['id_utilisateur'] . "'>" . "<button type='submit' style='width:60px;heigth:100%;' class='btn_modif'><img src='./images/picto-modifierCircle_up.gif' onMouseOut='this.src=btn_modif_up;' onMouseDown='this.src=btn_modif_down;' onMouseOver='this.src=btn_modif_hover;' alt='Changer?' /></button>" . "</form></td>";
            }
        }
        echo "</tr>";
    }
    echo "</table>";
    return;
}