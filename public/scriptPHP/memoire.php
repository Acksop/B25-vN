<?php
if (DEV_verificationINCLUSIONS) {
    $page = explode("/", __FILE__);
    $fichier_inclus = array_pop($page);
    echo $fichier_inclus . " >>> OK!";
}

global $fichierLogMemoire;

function ecrireFichier__logs_memoire__Debut($ip, $page, $debut, $debut_utilisation_memoire, $debut_de_pic_memoire)
{
    global $fichierLogMemoire;
    $fichierLogMemoire = "logs_memoire/log_" . $dateFormat . "_" . $i;
    // -------------------------------------------------
    // Ecriture d'un fichier logs en deux parties permettant de connaitre les pages les plus demand�es et leurs cas d'utilisation memoire
    
    $dateFormat = date("m-d-Y");
    $i = 0;
    $flag_1ere_creation = true;
    $temps_debut_human = time_elapsed_millisecs($debut);
    
    // Cas du premier_fichier_des logs qui se cr��e... Au lancement de cette page sur le serveur
    if (! file_exists($fichierLogMemoire)) {
        $fichier_log_a_remplir = fopen($fichierLogMemoire, "a");
        $chaineAInserer = "\n\nDEBUT REQUETE SERVEUR : " . $_SERVER['REQUEST_TIME'] . " VENANT de " . $ip . " pour la PAGE: " . $page . "\n-\t Memoire_Utilis� au D�but: " . $debut_utilisation_memoire . " (" . lectureHumaineOctet($debut_utilisation_memoire) . ") - " . $debut_de_pic_memoire . " (" . lectureHumaineOctet($debut_de_pic_memoire) . ")" . "\n-\t D�but de calcul: " . $temps_debut_human . " - \t Request_time: " . $debut;
        fputs($fichier_log_a_remplir, $chaineAInserer);
        // fwrite($fichier_log_a_remplir);
        fclose($fichier_log_a_remplir);
        $flag_1ere_creation = false;
    }
    
    while ($flag_1ere_creation) {
        // r�allocation du nouveau fichier de log en cas de taille sup�rieure � $taille_max
        $fichierLogMemoire = "./logs_memoire/log_" . $dateFormat . "_" . $i;
        $taille = filesize($fichierLogMemoire);
        $tailleMax = 1024 * 1024; // 1M - 1024Ko - 1024* 1024Ko
        if ($taille < $tailleMax) {
            $fichier_log_a_remplir = fopen($fichierLogMemoire, "a");
            $chaineAInserer = "\n\nDEBUT REQUETE SERVEUR : " . $_SERVER['REQUEST_TIME'] . " VENANT de " . $ip . " pour la ---- PAGE: " . $page . "\n-\t Memoire_Utilis� au D�but: " . $debut_utilisation_memoire . " (" . lectureHumaineOctet($debut_utilisation_memoire) . ") - debut_de_pic_memoire (" . lectureHumaineOctet($debut_de_pic_memoire) . ")" . "\n-\t D�but de calcul: " . $temps_debut_human . " - \t Request_time: " . $debut;
            fputs($fichier_log_a_remplir, $chaineAInserer);
            // alias de fputs:: fwrite($fichier_log_a_remplir,$chaineAInserer);
            fclose($fichier_log_a_remplir);
            break;
        }
        $i ++;
    }
}

function ecrireFichier__logs_memoire__Fin($ip, $page, $debut, $fin, $debut_utilisation_memoire, $debut_de_pic_memoire, $fin_utilisation_memoire, $fin_de_pic_memoire)
{
    global $fichierLogMemoire;
    $consommation_temps_totale = $fin - $debut;
    $consommation_temps_totale_human = time_elapsed_millisecs($consommation_temps_totale);
    $temps_fin_human = time_elapsed_millisecs($fin);
    $fin_utilisation_memoire = memory_get_usage();
    $fin_de_pic_memoire = memory_get_peak_usage();
    $consommation_memoire_totale = $fin_utilisation_memoire - $debut_utilisation_memoire;
    $consommation_memoire_totale_human = lectureHumaineOctet($consommation_memoire_totale);
    $consommation_pic_memoire_totale = $fin_de_pic_memoire - $debut_de_pic_memoire;
    $consommation_pic_memoire_totale_human = lectureHumaineOctet($consommation_pic_memoire_totale);
    
    $fichier_log_a_remplir = fopen($fichierLogMemoire, "a");
    $chaineAInserer = "\n\nFIN REQUETE SERVEUR : " . $_SERVER['REQUEST_TIME'] . " VENANT de" . $ip . " pour la ---- PAGE:" . $page . "\n-\t Memoire_Utilis� � la fin: " . $fin_utilisation_memoire . " (" . lectureHumaineOctet($fin_utilisation_memoire) . ") - " . fin_de_pic_memoire . " (" . lectureHumaineOctet($fin_de_pic_memoire) . ")" . "\n-\t Fin de calcul: " . $temps_fin_human . " - \t Request_time: " . $fin . "\n-\t M�moire Consomm�e : " . $consommation_memoire_totale . " (" . $consommation_memoire_totale_human . ") - " . $consommation_pic_memoire_totale . " (" . $consommation_pic_memoire_totale_human . ")" . "\n-\t Temps Consomm�e   : " . $consommation_temps_totale_human . " - \t en Ms : " . $consommation_temps_totale;
    
    fputs($fichier_log_a_remplir, $chaineAInserer);
    // Alias de fputs:: fwrite($fichier_log_a_remplir,$chaineAInserer);
    fclose($fichier_log_a_remplir);
}