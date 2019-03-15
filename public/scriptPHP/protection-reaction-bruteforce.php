<?php
if (DEV_verificationINCLUSIONS) {
    $page = explode("/", __FILE__);
    $fichier_inclus = array_pop($page);
    echo $fichier_inclus . " >>> OK!";
}

function encrypterCleMap($time, $ip, $token)
{
    
    // creation de la cl� map selon le temps et l'ip ainsi qu'un token
    // echo "IP : ".$ip."<br/>";
    // echo "TIME : ".$time."<br/>";
    $time_inv = invertionCaracteres($time);
    $ip_en_chiffre_acoller = explode('.', $ip);
    $dimension_ip = strlen($ip_en_chiffre_acoller[0]) . "" . strlen($ip_en_chiffre_acoller[1]) . "" . strlen($ip_en_chiffre_acoller[2]) . "" . strlen($ip_en_chiffre_acoller[3]);
    $dimension_ip_inv = invertionCaracteres($dimension_ip);
    $ip_en_chiffre_acoller_add_taille = $dimension_ip . implode($ip_en_chiffre_acoller);
    $ip_en_chiffre_acoller = implode($ip_en_chiffre_acoller);
    
    $ip_inv = invertionCaracteres($ip_en_chiffre_acoller);
    $ip_inv_add_taille = invertionCaracteres($ip_en_chiffre_acoller_add_taille);
    
    // echo "DIMENSION_IP_INV : ".$dimension_ip_inv."<br/>";
    
    // echo "IP_EN_CHIFFRE_ACCOLLER : ".$ip_en_chiffre_acoller."<br/>";
    // echo "IP_EN_CHIFFRE_ACCOLLER_TAILLE : ".$ip_en_chiffre_acoller_add_taille."<br/>";
    // echo "IP_INV : ".$ip_inv."<br/>";
    // echo "IP_INV_TAILLE : ".$ip_inv_add_taille."<br/>";
    
    // echo "TIME_INV : ".$time_inv."<br/>";
    
    $ip_tab_inv = preg_split('//', $ip_inv_add_taille, - 1, PREG_SPLIT_NO_EMPTY);
    $time_tab_inv = preg_split('//', $time_inv, - 1, PREG_SPLIT_NO_EMPTY);
    $taille_ip = count($ip_tab_inv) - 4;
    $taille_time = count($time_tab_inv);
    
    // echo "TAILLE_IP : ".$taille_ip."<br/>";
    // echo "TAILLE_TIME : ".$taille_time."<br/>";
    
    $clemap = '';
    for ($i = 0; ($i < $taille_ip && $i < $taille_time); $i ++) {
        $clemap .= $ip_tab_inv[0] . $time_tab_inv[0];
        $ip_tab_inv = expulserPremierElement($ip_tab_inv);
        $time_tab_inv = expulserPremierElement($time_tab_inv);
    }
    // echo "CLEMAP : ".$clemap."<br/>";
    $clemap .= implode($ip_tab_inv);
    // echo "CLEMAP : ".$clemap."<br/>";
    $clemap .= implode($time_tab_inv);
    // echo "CLEMAP : ".$clemap."<br/>";
    $clemap .= $token;
    // echo "CLEMAP : ".$clemap."<br/>";
    $clemap .= $taille_ip . $taille_time;
    // echo "CLEMAP : ".$clemap."<br/>";
    
    $ip_taille_tab = preg_split('//', $taille_ip, - 1, PREG_SPLIT_NO_EMPTY);
    $time_taille_tab = preg_split('//', $taille_time, - 1, PREG_SPLIT_NO_EMPTY);
    
    $taille_caracteres_ip = count($ip_taille_tab);
    $taille_caracteres_time = count($time_taille_tab);
    
    $taille_caracteres_time_itx = preg_split('//', $taille_caracteres_time, - 1, PREG_SPLIT_NO_EMPTY);
    $cleFibonnaci = '';
    for ($i = 0; $taille_caracteres_time_itx > 1; $i ++) {
        $time_taille_tab_itx = preg_split('//', $taille_caracteres_time_itx, - 1, PREG_SPLIT_NO_EMPTY);
        $taille_caracteres_time_itx = count($time_taille_tab_itx);
        $taille_caracteres_time .= $taille_caracteres_time_itx;
        // echo $i."_";
        if ($i >= 0) {
            $cleFibonacci .= '1';
        }
    }
    // echo "FIBONACCI:".$taille_caracteres_ip.'|'.$taille_caracteres_time.'|'.$cleFibonacci."<br/>";
    $cleNumeraire = $taille_caracteres_time . $cleFibonacci;
    // echo "CLEMAP_numeraire : ".$cleNumeraire."<br/>";
    $cleNumeraire = encrypter_Cesar($cleNumeraire, 4);
    // echo "CLEMAP_numeraire_encrypt : ".$cleNumeraire."<br/>";
    
    // echo "CLEMAP : ".$clemap."<br/>";
    $clemap_encrypt = encrypter_Cesar($clemap, 3);
    // echo "CLEMAP_encrypt : ".$clemap_encrypt."<br/>";
    $clemap_encrypt = $clemap_encrypt . $cleNumeraire;
    // echo "ENTIRE_CLEMAP_encrypt : ".$clemap_encrypt."<br/>";
    $clemap_encrypt_with_ip_dimension = $dimension_ip_inv . $clemap_encrypt;
    // echo "ENTIRE_CLEMAP_encrypt_WITH_DIMENSION_INV : ".$clemap_encrypt_with_ip_dimension."<br/>";
    $clemap_with_ip_dimension_encrypt = encrypter_Cesar($clemap_encrypt_with_ip_dimension, 3);
    // echo "ENTIRE_CLEMAP_encrypt_WITH_DIMENSION_INV_encrypt : ".$clemap_with_ip_dimension_encrypt."<br/>";
    
    return $clemap_with_ip_dimension_encrypt;
}

function decrypterCleMap($cleMap)
{
    $ip_post = decrypter_Cesar($clemap_with_ip_dimension_encrypt, 3);
    
    $ip_dimension = array();
    $ip_dimension[] = substr($ip_post, 0, 1);
    $ip_dimension[] = substr($ip_post, 1, 1);
    $ip_dimension[] = substr($ip_post, 2, 1);
    $ip_dimension[] = substr($ip_post, 3, 1);
    $ip_true_one_dimension = implode($ip_dimension);
    
    // echo "_TRUE_DIMENSION_debut : ".$ip_true_one_dimension."<br/>";
    
    $clemap_encrypt_sans_dimension = substr($ip_post, 4);
    // echo "CLEMAP_numeraire_encrypt : ".$clemap_encrypt_sans_dimension."<br/>";
    /**
     * **************************************************
     * decryptage de cle de fibonacci sur la CLEMAP ENCRYPTER:
     */
    
    $clemapNumeraire = decrypter_Cesar($clemap_encrypt_sans_dimension, 4);
    $clemapNumeraire_tab = preg_split('//', $clemapNumeraire, - 1, PREG_SPLIT_NO_EMPTY);
    $clemapNumeraire_tab_taille = count($clemapNumeraire_tab) - 1;
    
    // echo "CLEMAP_numeraire : ".$clemapNumeraire."<br/>";
    
    $i = 1;
    $tempIndice = $clemapNumeraire_tab_taille;
    do {
        $i ++;
    } while ($clemapNumeraire_tab[($clemapNumeraire_tab_taille - $i)] == 1);
    $nbItxFibonacci = $i;
    
    for ($i = 0; $i < ($nbItxFibonacci); $i ++) {
        $clemapNumeraire_tab = expulserDernierElement($clemapNumeraire_tab);
    }
    // echo "CLEMAP_numeraire_reduite : ".implode($clemapNumeraire_tab)."<br/>";
    
    $clemapNumeraire_tab_taille = count($clemapNumeraire_tab) - 1;
    $taille_time_tab = array();
    $fibonacci = 1;
    $nbcaracteres_time_a_supprimer = 0;
    $taille_caracteres_time_itx = '';
    // nb iteration de la boucle de fibonacci pour ...
    for ($j = 0; $j < $fibonacci; $j ++) {
        // echo "j $j passe";
        $taille_caracteres_time_itx = '';
        // ... la recuperation du nombre de caract�res de la variable de temps selon fibonacci
        for ($i = $clemapNumeraire_tab_taille; $i > ($clemapNumeraire_tab_taille - $fibonacci); $i --) {
            $taille_caracteres_time_itx .= $clemapNumeraire_tab[$i];
            $nbcaracteres_time_a_supprimer ++;
            // echo "_i_$i _cN:".$clemapNumeraire_tab[$i]."_";
        }
        $fibonacci = $taille_caracteres_time_itx;
        $taille_time_tab[] = $taille_caracteres_time_itx;
    }
    // print_r($taille_time_tab);
    // echo "INDICE DE FIBONACCI: ".$nbItxFibonacci."<br/>";
    // echo "CLE DE FIBONACCI:".$taille_time_tab[(count($taille_time_tab)-2)]."<br/>";
    // $taille_caracteres_time = $clemapNumeraire_tab[$clemapNumeraire_tab_taille];
    
    $nbCaracteres_a_supprimer_total = $nbItxFibonacci + 1;
    
    /**
     * **************************************************
     * decryptage de la clemap selon la cle de fibonacci
     */
    $clemap = decrypter_Cesar($clemap_encrypt_sans_dimension, 3);
    $clemap_tab = preg_split('//', $clemap, - 1, PREG_SPLIT_NO_EMPTY);
    
    // echo "CLEMAP : ".$clemap."<br/>";
    // print_r($clemap_tab);
    
    for ($i = 0; $i < $nbCaracteres_a_supprimer_total; $i ++) {
        $clemap_tab = expulserDernierElement($clemap_tab);
    }
    // echo "CLEMAP_reduite : ".implode($clemap_tab)."<br/>";
    
    $clemap_tab_taille = count($clemap_tab) - 1;
    $cleFibonacci = $taille_time_tab[($nbItxFibonacci - 1)];
    // echo "CLE DE FIBONACCI:".$taille_time_tab[(count($taille_time_tab)-2)]."<br/>";
    $taille_time = '';
    $nbcaracteres_time_a_supprimer = 0;
    for ($i = $clemap_tab_taille; $i > ($clemap_tab_taille - $cleFibonacci); $i --) {
        $taille_time .= $clemap_tab[$i];
        $nbcaracteres_time_a_supprimer ++;
        // echo "_i {$i} _";
    }
    for ($i = 0; $i < $nbcaracteres_time_a_supprimer; $i ++) {
        $clemap_tab = expulserDernierElement($clemap_tab);
    }
    // echo "CLEMAP_reduite_nb_caracteres_temps : ".implode($clemap_tab)."<br/>";
    $taille_time = invertionCaracteres($taille_time);
    // echo "NB_CARACTERES_TIME:".$taille_time."<br/>";
    
    $clemap_tab_taille = count($clemap_tab) - 1;
    $taille_caracteres_ip = '';
    $nbcaracteres_ip_a_supprimer = 0;
    for ($i = 0; $i < 2; $i ++) {
        $taille_caracteres_ip .= $clemap_tab[($clemap_tab_taille - $i)];
        $nbcaracteres_ip_a_supprimer ++;
        if ($clemap_tab[($clemap_tab_taille - $i)] > 4) {
            break;
        }
    }
    for ($i = 0; $i < $nbcaracteres_ip_a_supprimer; $i ++) {
        $clemap_tab = expulserDernierElement($clemap_tab);
    }
    
    // echo "CLEMAP_reduite_nb_caracteres_ip : ".implode($clemap_tab)."<br/>";
    $taille_ip = invertionCaracteres($taille_caracteres_ip);
    // echo "NB_CARACTERES_IP:".$taille_ip."<br/>";
    
    $clemap_taille = count($clemap_tab);
    
    $token_tab_test = array(
        $clemap_tab[($clemap_taille - 1)],
        $clemap_tab[($clemap_taille - 2)],
        $clemap_tab[($clemap_taille - 3)]
    );
    $token_test = implode($token_tab_test);
    // echo "TOKEN_encrypt_extrait:".$token_test."<br/>";
    
    // on extrait le token
    $clemap_tab = expulserDernierElement(expulserDernierElement(expulserDernierElement($clemap_tab)));
    echo "CLEMAP_reduit_du_token:" . implode($clemap_tab) . "<br/>";
    //
    $ip_inv = '';
    $time_post_with_ip_dimension = '';
    for ($i = 0; ($i < $taille_ip && $i < $taille_time); $i ++) {
        // echo "i_$i ";
        $ip_inv .= $clemap_tab[0];
        $time_post_with_ip_dimension .= $clemap_tab[1];
        $clemap_tab = expulserPremierElement($clemap_tab);
        $clemap_tab = expulserPremierElement($clemap_tab);
    }
    
    if ($taille_ip > $taille_time) {
        $ip_inv .= implode($clemap_tab);
    } else {
        $time_post_with_ip_dimension .= implode($clemap_tab);
    }
    
    // echo "IP_INV: ".$ip_inv."<br/>";
    // echo "TIME_INV: ".$time_post_with_ip_dimension."<br/>";
    $time_post_with_ip_dimension = invertionCaracteres($time_post_with_ip_dimension);
    // echo "TIME: ".$time_post_with_ip_dimension."<br/>";
    
    $ip_post = invertionCaracteres($ip_inv);
    
    // echo "IP: ".$ip_post."<br/>";
    
    $ip_dimension = array();
    $ip_dimension[] = substr($time_post_with_ip_dimension, 0, 1);
    $ip_dimension[] = substr($time_post_with_ip_dimension, 1, 1);
    $ip_dimension[] = substr($time_post_with_ip_dimension, 2, 1);
    $ip_dimension[] = substr($time_post_with_ip_dimension, 3, 1);
    $ip_true_two_dimension = implode($ip_dimension);
    $ip_true_two_dimension = invertionCaracteres($ip_true_two_dimension);
    // echo "_TRUE_DIMENSION_fin : ".$ip_true_two_dimension."<br/>";
    /*
     * if($ip_true_two_dimension == $ip_true_one_dimension){
     * echo "DIMENSION : OK<br/>";
     * }else{
     * echo "DIMENSION : DANGER!<br/>";
     * }
     */
    
    // echo "TIME_with_IP_dimension: ".$time_post_with_ip_dimension."<br/>";
    $time_post_without_ip_dimension = substr($time_post_with_ip_dimension, 4);
    // echo "TIME: ".$time_post_without_ip_dimension."<br/>";
    
    // echo "TOKEN_ROT 13/36:".$token . "--" . $token_test . "<br/>";
    // echo "TOKEN_ROT 0/36:".decrypter_Cesar($token,11) . "--" . decrypter_Cesar($token_test,11) . "<br/>";
    $token_decrypt = invertionCaracteres(decrypter_Cesar($token_test, 11));
    
    // $ip_en_chiffre_acoller = implode($ip_en_chiffre_acoller);
    
    $ip_complete = "";
    $temp = 0;
    $ip_complete .= substr($ip_en_chiffre_acoller, $temp, $ip_dimension[0]);
    $temp += $ip_dimension[0];
    $ip_complete .= "." . substr($ip_en_chiffre_acoller, $temp, $ip_dimension[1]);
    $temp += $ip_dimension[1];
    $ip_complete .= "." . substr($ip_en_chiffre_acoller, $temp, $ip_dimension[2]);
    $temp += $ip_dimension[2];
    $ip_complete .= "." . substr($ip_en_chiffre_acoller, $temp, $ip_dimension[3]);
    
    // echo "IP:".$ip_post . "--" . $ip_en_chiffre_acoller . "--" . $ip_complete . "<br/>";
    
    // echo "TIME:".$time_post_without_ip_dimension . "--" . $time . "<br/>";
    
    /*
     * if($ip_complete === $ip){
     * echo "IP : OK<br/>";
     * }else{
     * echo "IP : DANGER!<br/>";
     * }
     * if($time_post_without_ip_dimension == $time){
     * echo "TIME : OK<br/>";
     * }else{
     * echo "TIME : DANGER!<br/>";
     * }
     */
    $tab = array();
    $tab[] = $ip_complete;
    $tab[] = $time_post_without_ip_dimension;
    $tab[] = $token_decrypt;
    
    return $tab;
}