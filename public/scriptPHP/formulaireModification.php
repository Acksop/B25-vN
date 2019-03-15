<?php
if (DEV_verificationINCLUSIONS) {
    $page = explode("/", __FILE__);
    $fichier_inclus = array_pop($page);
    echo $fichier_inclus . " >>> OK!";
}

function ecrireFormulairePremiereVisiteAsso()
{
    echo "<form name='modifInfoAsso' method='post' action='controlleurs/traitementModifInfoAssoPremiereVisite.php'>" . "<table border='0' width='100%'><tr><td class='utilisateurs'>" . "<tr><td class='titreTableau'>" . "NOM DE L'ASSOCIATION: </td>" . "<td class='utilisateurs'><input name='nom' type='text' size='50' class='btn_modif'/></td>" . "</td></tr>" . "<tr><td class='titreTableau'>DESCRIPTION : </td>" . "<td class='utilisateurs'><input name='description' type='text' size='50' class='btn_modif'/>" . "</td></tr>" . "<tr><td class='titreTableau'>TELEPHONE : </td>" . "<td class='utilisateurs'><input name='telephone' type='text' size='50' class='btn_modif'/>" . "</td></tr>" . "<tr><td class='titreTableau'>COURRIEL : </td>" . "<td class='utilisateurs'><input name='email' type='text' size='50' class='btn_modif'/>" . "</td></tr>" . "<tr><td class='titreTableau'>SITE WEB-INTERNET : </td>" . "<td class='utilisateurs'><input name='siteInterWeb' type='text' size='50' class='btn_modif'/>" . "</td></tr>" . "<tr><td class='titreTableau'>ADRESSE LOCALE : </td>" . "<td class='utilisateurs'><input name='adresse' type='text' size='50' class='btn_modif'/></td>" . "</td></tr>" . "<tr><td class='titreTableau'>CODE POSTAL : </td>" . "<td class='utilisateurs'><input name='codePostal' type='text' size='50' class='btn_modif'/></td>" . "</td></tr>" . "<tr><td class='titreTableau'>VILLE NATALE : </td>" . "<td class='utilisateurs'><input name='ville' type='text' size='50' class='btn_modif'/></td>" . "</td></tr>" . "<tr><td colspan='2'>" . "<input type='submit' value='Valider les informations'/>" . "</td></tr>" . "</table>" . "</form>";
}

function ecrireFormulaireChangementAsso($libelle, $valeur)
{
    if ($libelle == 'nom') {
        $libelleSubmit = 'le Nom';
        echo "NOM :";
    } else 
        if ($libelle == 'description') {
            $libelleSubmit = 'la description';
            echo "DESCRIPTION :";
        } else 
            if ($libelle == 'telephone') {
                $libelleSubmit = 'le telephone';
                echo "TELEPHONE :";
            } else 
                if ($libelle == 'email') {
                    $libelleSubmit = 'le courriel';
                    echo "COURRIEL :";
                } else 
                    if ($libelle == 'siteInterWeb') {
                        $libelleSubmit = 'le site InterWeb';
                        echo "SITE WEB-INTERNET :";
                    } else 
                        if ($libelle == 'adresse') {
                            $libelleSubmit = "l&#39;adresse";
                            echo "ADRESSE LOCALE :";
                        } else 
                            if ($libelle == 'codePostal') {
                                $libelleSubmit = 'le code Postal';
                                echo "CODE POSTAL :";
                            } else 
                                if ($libelle == 'ville') {
                                    $libelleSubmit = 'la ville';
                                    echo "VILLE NATALE :";
                                }
    $valeur = HTML_ChaineDeCaracteres(supprimerCommmandeBangDansUneChaine($valeur));
    echo "</td><form name='modifInfoAsso' method='post' action='controlleurs/traitementModifInfoAsso.php'><td class='utilisateurs'>" . "<input name='{$libelle}' type='text' value='{$valeur}' size='38'/>" . "</td><td class='utilisateurs'>" . "<input type='submit' value='Changer {$libelleSubmit}' class='btn_modif'/>" . "</form>";
    return 0;
}

function ecrireFormulaireChangementStatusAsso($libelle, $nom, $courriel, $obligationModif)
{
    if ($obligationModif == 1) {
        echo "<form name='modifStatusAsso' method='post' action='controlleurs/traitementAssociationAjoutStatus.php'>";
    }
    echo "<tr><td class='titreTableau' valign='middle'>";
    if ($libelle == 'president') {
        $libelleSubmit = 'le pr&eacute;sident';
        $libelleTitre = "PR&Eacute;SIDENT :";
    } else 
        if ($libelle == 'vicePresident') {
            $libelleSubmit = 'le vice-pr&eacute;sident';
            $libelleTitre = "VICE-PR&Eacute;SIDENT :";
        } else 
            if ($libelle == 'tresorier') {
                $libelleSubmit = 'le tr&eacute;sorier';
                $libelleTitre = "TR&Eacute;SORIER :";
            } else 
                if ($libelle == 'secretaire') {
                    $libelleSubmit = 'le secr&eacute;taire';
                    $libelleTitre = "SECR&Egrave;TAIRE :";
                }
    $libelle1 = $libelle . "_nom";
    $libelle2 = $libelle . "_courriel";
    $nom = HTML_ChaineDeCaracteres($nom);
    $courriel = HTML_ChaineDeCaracteres($courriel);
    if ($obligationModif == 1) {
        if ($nom == '' && $courriel == '') {
            echo "<input type='submit' class='btn_modif' value='Ajouter " . $libelleSubmit . "'/>";
        } else {
            echo "<input type='submit' class='btn_modif' value='Changer " . $libelleSubmit . "'/>";
        }
        echo "</td><td class='utilisateurs'>" . "<input name={$libelle1} type='text' value='{$nom}' placeholder='Nom Pr&eacute;nom' size='25'/>" . "</td><td class='utilisateurs'>" . "<input name={$libelle2} type='text' value='{$courriel}' placeholder='Courriel' size='20'/>" . "</td><td class='utilisateurs'>";
        echo "</form>";
    } else {
        echo $libelleTitre;
        echo "</td><td class='utilisateurs'>" . $nom . "</td><td class='utilisateurs'>" . $courriel . "</td><td>" . "<a border='0' href='index.php?page=compte&modif={$libelle}#ancre_Status'>";
        if ($nom == '' && $courriel == '') {
            echo "<img alt='Ajouter' style='float:left;' src='images/picto-ajouterBureau_up.gif' onMouseOver='javascript:this.src=btn_ajoutBureau_hover;' onMouseOut='javascript:this.src=btn_ajoutBureau_up;' onMouseDown='javascript:this.src=btn_ajoutBureau_down;'>";
        } else {
            echo "<img alt='Modifier' style='float:left;' src='images/picto-modifier_up.gif' onMouseOver='javascript:this.src=btn_modif_hover;' onMouseOut='javascript:this.src=btn_modif_up;' onMouseDown='javascript:this.src=btn_modif_down;'>";
        }
        echo "</a></form>";
    }
    echo "</td></tr>";
    return;
}

function ecrireFormulairePremiereVisiteArtiste()
{
    echo "<form name='modifInfoArtiste' method='post' action='controlleurs/traitementModifInfoArtistePremiereVisite.php'>" . "<table border='0' width='100%'><tr><td class='utilisateurs'>" . "<tr><td class='titreTableau'>" . "NOM DE L'ARTISTE ou DE L'ARTISANT: </td>" . "<td class='utilisateurs'><input name='nom' type='text' size='50' class='btn_modif'/></td>" . "</td></tr>" . "<tr><td class='titreTableau'>PRENOM : </td>" . "<td class='utilisateurs'><input name='prenom' type='text' size='50' class='btn_modif'/></td>" . "</td></tr>" . "<tr><td class='titreTableau'>PSEUDO : </td>" . "<td class='utilisateurs'><input name='pseudo' type='text' size='50' class='btn_modif'/>" . "</td></tr>" . "<tr><td class='titreTableau'>DESCRIPTION DE L'ART ou DE L'ARTISANAT: </td>" . "<td class='utilisateurs'><input name='description' type='text' size='50' class='btn_modif'/>" . "</td></tr>" . "<tr><td class='titreTableau'>TELEPHONE : </td>" . "<td class='utilisateurs'><input name='telephone' type='text' size='50' class='btn_modif'/>" . "</td></tr>" . "<tr><td class='titreTableau'>COURRIEL : </td>" . "<td class='utilisateurs'><input name='email' type='text' size='50' class='btn_modif'/>" . "</td></tr>" . "<tr><td class='titreTableau'>SITE INTERNET-WEB : </td>" . "<td class='utilisateurs'><input name='siteInterWeb' type='text' size='50' class='btn_modif'/>" . "</td></tr><tr><td colspan='2'>" . "<input type='submit' value='Valider les informations'/>" . "</td></tr>" . "</table>" . "</form>";
}

function ecrireFormulaireChangementArtiste($libelle, $valeur)
{
    if ($libelle == 'nom') {
        $libelleSubmit = 'le nom';
        echo "NOM :";
    } else 
        if ($libelle == 'description') {
            $libelleSubmit = 'la description';
            echo "DESCRIPTION DE L'ART ou DE L'ARTISANAT:";
        } else 
            if ($libelle == 'telephone') {
                $libelleSubmit = 'le telephone';
                echo "TELEPHONE :";
            } else 
                if ($libelle == 'email') {
                    $libelleSubmit = 'le courriel';
                    echo "COURRIEL :";
                } else 
                    if ($libelle == 'prenom') {
                        $libelleSubmit = 'le prenom';
                        echo "PRENOM :";
                    } else 
                        if ($libelle == 'pseudo') {
                            $libelleSubmit = 'le pseudo';
                            echo "PSEUDO :";
                        } else 
                            if ($libelle == 'siteInterWeb') {
                                $libelleSubmit = 'le site InterWeb';
                                echo "SITE INTERNET-WEB :";
                            }
    $valeur = HTML_ChaineDeCaracteres(supprimerCommmandeBangDansUneChaine($valeur));
    echo "</td><form name='modifInfoArtiste' method='post' action='controlleurs/traitementModifInfoArtiste.php'><td class='utilisateurs'>" . "<input name='{$libelle}' type='text' value='{$valeur}' size='38'/>" . "</td><td class='utilisateurs'>" . "<input type='submit' value='Changer {$libelleSubmit}' class='btn_modif' />" . "</form>";
    return 0;
}

function ecrireFormulaireChangementJournaliste($libelle, $valeur)
{
    if ($libelle == 'nom') {
        $libelleSubmit = 'le nom';
        echo "NOM DU JOURNALISTE:";
    } else 
        if ($libelle == 'rencontre') {
            $libelleSubmit = 'la rencontre';
            echo "RENCONTRE AVEC LE JOURNALISTE:";
        } else 
            if ($libelle == 'geolocalisation') {
                $libelleSubmit = 'de localit&eacute;';
                echo "POSITION G&Eacute;OGRAPHIQUE ACTUELLE:";
            } else 
                if ($libelle == 'signature') {
                    $libelleSubmit = 'le telephone';
                    echo "T&Eacute;L&Eacute;PHONE DU JOURNALISTE:";
                } else 
                    if ($libelle == 'email') {
                        $libelleSubmit = 'le courriel';
                        echo "COURRIEL DU JOURNALISTE:";
                    } else 
                        if ($libelle == 'prenom') {
                            $libelleSubmit = 'le prenom';
                            echo "PRENOM DU JOURNALISTE:";
                        } else 
                            if ($libelle == 'surnom') {
                                $libelleSubmit = 'le surnom';
                                echo "SURNOM DU JOURNALISTE:";
                            }
    $valeur = HTML_ChaineDeCaracteres(supprimerCommmandeBangDansUneChaine($valeur));
    echo "</td><form name='modifInfoArtiste' method='post' action='controlleurs/traitementModifInfoJournaliste.php'><td class='utilisateurs'>" . "<input name='{$libelle}' type='text' value='{$valeur}' size='38'/>" . "</td><td class='utilisateurs'>" . "<input type='submit' class='btn_modif' value='Changer {$libelleSubmit}'/>" . "</form>";
    return 0;
}
?>
