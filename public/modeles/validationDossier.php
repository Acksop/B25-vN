<?php

// --
check_session();
// --
function LancerAffichageDuCorps()
{
    echo $nbValidation = recuperationNbDossierAValider();
    echo "<h2 class='utilisateurs'>il y a " . $nbValidation . " <i>Dossiers</i> &agrave; valider...</h2>";
    if ($nbValidation) {
        include ('scriptPHP/w-code/wcode.inc.php');
        include ('scriptPHP/w-code/wcode.implementation.php');
        echo wcode_javascript();
        echo wcode_css();
        if (isset($_GET['id'])) {
            $data = exploiterLigneResultatBDD(recuperationDossierAValider($_GET['id']));
        } else {
            $data = exploiterLigneResultatBDD(recuperationPremierDossierAValider());
        }
        $wcode = $data['bbcode'];
        $wcode = check_ChaineDeCaracteresDownload($wcode);
        $wc = new wcode();
        $wc->charger_configuration("scriptPHP/w-code/wcode.config.php");
        $wc->definir_code($wcode);
        $reponse = $wc->lire_code();
        
        if (isset($_GET['modification'])) {
            echo "<form method='post' name='dossier' action='controlleurs/traitementValidationDossier.php'>" . "<h3>Modification d'un Dossier:</h3>" . "<p align='left'>Titre: <input type='text' name='titre' size='80' value='" . $data['titre'] . "'></p>" . "<p align='left'>Description sommaire du dossier:<input type='text' name='description' size='100' value='" . $data['description'] . "'></p>";
            echo wcode_editeur("dossier", "corps", $wcode);
            echo "<input type='submit' class='btn_dossiers' name='save' value='V&eacute;rifier la mise en page du dossier!' />";
            if (isset($_POST['reecriture'])) {
                echo "<input type='hidden' name='reecriture' value='oui'/>" . "<input type='hidden' name='validation_id' value='" . $data['id_dossier'] . "'/>";
            }
            echo "</form>";
        } else {
            if (isset($data)) {
                cadreDossierDebut();
                echo "<p class='titreDossier'>" . $data['titre'] . "</p>";
                echo "<p class='corpsDossier'>";
                if ($reponse) {
                    echo $wc->donner_html();
                    echo "<center>";
                    echo "<form method='post' style='display:inline;' action='index.php?page=validationDossier&id=" . $data['id_dossier'] . "&modification=oui'>" . "<input type='hidden' name='reecriture' value='oui'/>" . "<input type='submit' class='btn_dossiers' value='&Eacute;diter ?' />" . "</form>";
                    echo "<form method='post' style='display:inline;' action='controlleurs/traitementValidationDossier.php'>" . "<input type='hidden' name='validation_id' value='" . $data['id_dossier'] . "'/>" . "<input type='submit' class='btn_dossiers' value='Valider et Archiver?' />" . "</form>";
                    echo "<form method='post' style='display:inline;' action='controlleurs/traitementSuppressionValidationDossier.php'>" . "<input type='hidden' name='validation_id' value='" . $data['id_dossier'] . "'/>" . "<input type='submit' class='btn_dossiers' value='Supprimer ?' />" . "</form></center>";
                } else {
                    echo "<img src='scriptPHP/wcode_images/erreur.gif' /> :: <b>" . $wc->erreur . "</b></p><pre>" . $wc->code_faux . "</pre>";
                    echo "<form method='post' style='display:inline;' action='index.php?page=validationDossier&id=" . $data['id_dossier'] . "&modification=oui'>" . "<input type='hidden' name='reecriture' value='oui'/>" . "<input type='submit' class='btn_dossiers' value='Modifier!' />" . "</form>";
                }
                echo "<p align='right' class='date'>" . $data['date_Modif'] . "</p>" . "<p align='right' class='post'>Auteur:&nbsp;&nbsp;" . recuperationAuteur($data['id_utilisateur']) . "</p>";
                echo "</p>";
                cadreDossierFin();
            }
        }
    }
}