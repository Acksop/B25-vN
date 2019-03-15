<?php
check_session();

function LancerAffichageDuCorps()
{
    include ('scriptPHP/w-code/wcode.inc.php');
    include ('scriptPHP/w-code/wcode.implementation.php');
    echo wcode_javascript();
    echo wcode_css();
    if (isset($_GET['id'])) {
        $data = exploiterLigneResultatBDD(recuperationDossierTemporaire($_GET['id']));
    } else {
        $data = array(
            'titre' => '',
            'bbcode' => '',
            'corps' => '',
            'date' => '',
            'description' => '',
            'id_utilisateur' => '',
            'id_dossier' => ''
        );
    }
    $wcode = $data['bbcode'];
    $wcode = check_ChaineDeCaracteresDownload($wcode);
    $wc = new wcode();
    $wc->charger_configuration("scriptPHP/w-code/wcode.config.php");
    $wc->definir_code($wcode);
    $r = $wc->lire_code();
    
    if (! isset($_GET['testMiseEnPage'])) {
        echo "<form method='post' name='dossier' action='controlleurs/traitementDossiers.php'>" . "<h2 class='utilisateurs'>&Eacute;criture d'un Dossier:</h3>" . "<table border='0'><tr><td class='ecritureInverse'>" . "Titre: </td><td class='ecriture'><input type='text' name='titre' size='100' value='" . $data['titre'] . "'>" . "</td></tr><tr><td class='ecritureInverse'>" . "Description sommaire du dossier:</td><td class='ecriture'><input type='text' name='description' size='100' value='" . $data['description'] . "'>" . "</td></tr><tr><td class='ecriture' colspan='2'>";
        echo wcode_editeur("dossier", "corps", $wcode);
        echo "</td></tr><tr><td colspan='2'>";
        echo "<input type='submit' class='btn_dossiers' name='save' value='Tester la mise en page du dossier!' />";
        if (isset($_POST['reecriture'])) {
            echo "<input type='hidden' name='reecriture' value='oui'/>" . "<input type='hidden' name='validation_id' value='" . $data['id_dossier'] . "'/>";
        }
        echo "</tr></td></table>";
        echo "</form>";
    } else {
        cadreDossierDebut();
        echo "<p class='titreDossier'>" . $data['titre'] . "</p>";
        echo "<p class='corpsDossier'>";
        if ($r) {
            echo $wc->code_html;
            echo "</p><center>";
            echo "<form method='post' style='display:inline;' action='index.php?page=ecritureDossier&id=" . $data['id_dossier'] . "#corpsPage'>" . "<input type='hidden' name='reecriture' value='oui'/>" . "<input type='submit' class='btn_dossiers' value='Modifier?' />" . "</form>";
            echo "<form method='post' style='display:inline;' action='controlleurs/traitementDossiers.php'>" . "<input type='hidden' name='validation_id' value='" . $data['id_dossier'] . "'/>" . "<input type='submit' class='btn_dossiers' value='Envoyer &agrave; valider?' />" . "</form>";
            echo "<form method='post' style='display:inline;' action='index.php?page=compte'>" . "<input type='submit' class='btn_dossiers' value='Sauvegarder et Stopper l&acute;&eacute;dition ?' />" . "</form></center>";
        } else {
            echo "<img src='scriptPHP/w-code/wcode_images/erreur.gif' /> :: <b>" . $wc->erreur . "</b></p><pre>" . $wc->code_faux . "</pre>";
            echo "<form method='post' action='index.php?page=ecritureDossier&id=" . $data['id_dossier'] . "#corpsPage'>" . "<input type='hidden' name='reecriture' value='oui'/>" . "<input type='submit' class='btn_dossiers' value='Modifier!' />" . "</form>";
        }
        echo "<p align='right' class='date'>" . $data['date_Modif'] . "</p>" . "<p align='right' class='post'>Auteur:&nbsp;&nbsp;" . recuperationAuteur($data['id_utilisateur']) . "</p>";
        echo "</p>";
        cadreDossierFin();
    }
}