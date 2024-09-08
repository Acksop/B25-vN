<?php
// Fichier : wcode.inc.php
// Version : 0.4
// Auteur : Alexandre SALOME
// Site WEB : http://wodkaist.free.fr
/////////////////////////////////////////////////

// Classe wcode_element
// Une balise WCode est composé de 5 choses : nom, valeur, contenu, code correspondant & balise fermée
 class wcode_element {
     public $nom = '';             // Nom de la balise
     public $valeur = '';          // Valeur de la balise
             // Il faut savoir que la variable $contenu est une liste de wcode_element ou un texte
             // Pour les effrayés de la recursivité, sachez qu'il s'arrête à la balise la plus élementaire : la balise P
     public $contenu = '';         // Contenu de la balise
     public $code_html = '';       // Code HTML avec %VALEUR% et %CONTENU% ou %FONCTION%
     public $erreur = '';          // Message en cas d'erreur
     public $ferme = false;
     public $retour_ligne = false;

     // definir : Chaine, Chaine, Chaine, Chaine --> Rien
     // Définit les valeurs du wcode_element
     public function definir($n,$v,$c,$ch){
        $this->nom = $n;
        $this->valeur = $v;
        $this->contenu = $c;
        $this->code_html = $ch;
     }

     // donner_html : Rien ----> Chaine
     // Donne le code HTML du wcode_element
     public function donner_html(){
        if ( $this->nom == 'p' ){
                if ($this->retour_ligne) return nl2br(htmlentities(stripslashes($this->contenu)));
                else return htmlentities(stripslashes($this->contenu));
        } else {
                if ($this->code_html==='%FONCTION%'){
                                $fonction_a_appeler = "wcode_".$this->nom;
                                return $fonction_a_appeler(htmlentities(stripslashes($this->valeur)),$this->contenu->donner_html());
                }
                $retour = str_replace(Array("%VALEUR%","%CONTENU%"),Array(htmlentities(stripslashes($this->valeur)),$this->contenu->donner_html()),$this->code_html);
								$wcode_CODE_INCREMENTIEL = 0;
                if (strpos($retour,'%CODE%')!=false){
                        $wcode_CODE_INCREMENTIEL++;
                        $retour = str_replace('%CODE%',$wcode_CODE_INCREMENTIEL,$retour);
                }
                return $retour;
        }

        }
 }

 class wcode{

     // Variables de la classe
     var $status_smileys = false;       // Status des smileys
     var $status_balises = false;       // Status des balises
     var $smileys = Array();            // Liste des smileys
     var $balises = Array();            // Liste des balises
     var $code = '';                    // WCode brut
     var $liste_elements = Array();     // Liste des éléments
     var $code_travail = '';            // WCode de travail : Détruit au fur et à mesure de la lecture
     var $code_html = '';               // Le code HTML
     var $erreur = '';                  // Erreur renvoyée
     var $code_faux = '';               // Code HTML pour visualiser l'erreur
     var $retour_ligne = true;          // Retour à la ligne !?



     // erreur : Chaine, Chaine ----------> Rien
     // Signaler une erreur et mettre en évidence le code faux
     function erreur($message,$code_faux){
        $this->erreur = $message;
        $p = strpos($this->code,$code_faux);
        $this->code_faux = nl2br(htmlentities(substr($this->code,0,$p))
                                .'<span id="fluo">'.htmlentities($code_faux).'</span>'
                                .htmlentities(substr($this->code,$p+strlen($code_faux))));

     }
     // status_smileys : Booléen -----------> Rien
     //         Définit le status des smileys
     function status_smileys($s){ $this->status_smileys = $s; }

     // ct_len : Rien ----------------> Entier
     //         Renvoie la longueur de $this->code_travail
     function ct_len(){ return strlen($this->code_travail); }

     // ct_retirer : Entier(i) -----------> Chaine
     //         Retire les i premiers caractères de $code_travail et les renvoie
     function ct_retirer($i){
        $retour = substr($this->code_travail,0,$i);
        $this->code_travail = substr($this->code_travail,$i);
        return $retour;
     }

     // ct_lire : Entier(i) -----------> Chaine
     //         Renvoie les i premiers caractères de $code_travail
     function ct_lire($i){ return substr($this->code_travail,0,$i); }

     // status_balises : Booléen -----------> Rien
     //         Définit le status des balises
     function status_balises($s){ $this->status_balises = $s; }

     // definir_code : Chaîne -----------> Rien
     //         Définit le WCode à analyser
     function definir_code($c){ $this->code = $c; }

     // donner_html : Rien -------------> Chaîne
     //         Renvoie le code HTML
     function donner_html(){
        return $this->code_html;
     }

     // charger_configuration : Chaine -----------> Rien
     //         Charge la configuration d'un fichier
     function charger_configuration($fichier){
         if (!file_exists($fichier)) return false;
         include_once($fichier);
         $this->balises = $wcode_balises;
         $this->smileys = $wcode_smileys;
         $this->status_balises($wcode_balises_status);
         $this->status_smileys($wcode_smileys_status);
         return true;
     }

     // lire_code : Rien -----------> Booléen
     //         Renvoie le résultat de l'analyse du code
     function lire_code(){
        // Nous voici donc dans la partie principale du programme
        // Ici, nous n'avons que la variable $code ainsi que les paramètres de configuration
        // Nous allons la copier dans une variable de travail
        $this->code_travail = $this->code;

        // Commençons par remplacer tous les smileys par leurs équivalents image
        if ($this->status_smileys){
			foreach($this->smileys as $smiley){
				$this->code_travail = str_replace($smiley[0],'[img='.$smiley[1].']',$this->code_travail);
			}
		}

        // Ensuite, il faut lire le code...
        while ($this->code_travail!=''){
                if ($this->ct_lire(1)==='[') $o = $this->lire_balise();
                else $o = $this->lire_texte();
                if ($o->erreur!=''){
                  $this->erreur($o->erreur,$o->code);
                  return false;
                }
         $this->liste_elements[] = $o;
        }
        $this->code_html = '';
        foreach($this->liste_elements as $e){ $this->code_html .= $e->donner_html(); }
        return true;

     }

     // lire_texte : Rien ----------> wcode_element
     function lire_texte(){
        $contenu = '';
        while ($this->ct_lire(1)!='[' && $this->ct_len()!=0){
                if ($this->ct_lire(1)==='\\') $contenu .= $this->ct_retirer(2);
                else $contenu .= $this->ct_retirer(1);
        }
        $obj = new wcode_element();
        $obj->definir('p','',$contenu,'');
        $obj->retour_ligne = $this->retour_ligne;
        
        return $obj;
    }

     // lire_balise : Rien ---------------> wcode_element
     //  Prélève du code de travail la balise et la renvoie en wcode_element
     function lire_balise(){
        $nom = '';      // On initialise les valeurs de travail !
        $valeur = '';
        $contenu = '';
        $this->ct_retirer(1);
        // Vérifions que y'en a encore
        if ($this->ct_len()===0){
                $obj = new wcode_element();
                $obj->erreur = 'Fin de code inattendue !';
                $obj->code = '[';
                return $obj;
        }

        // Maintenant lisons le nom de la balise
        while($this->ct_lire(1)!="="&&$this->ct_lire(1)!="]"&&$this->ct_len()!=0){
                if ($this->ct_lire(1)==='\\') $nom .= $this->ct_retirer(2);
                else $nom .= $this->ct_retirer(1);
        }


        // Pourquoi s'est-il arrêté ?
        if ($this->ct_len()===0){
                $obj = new wcode_element();
                $obj->erreur = 'Fin de code inattendue !';
                $obj->code = '['.$nom;
                return $obj;
        }

        // S'il s'est arrêté sur un =, alors Il y a une valeur à lire
        if ($this->ct_lire(1)==='='){
                $this->ct_retirer(1);
                while($this->ct_lire(1)!="]"&&$this->ct_len()!=0){
                        if ($this->ct_lire(1)==='\\') $valeur .= $this->ct_retirer(2);
                        else $valeur .= $this->ct_retirer(1);
                }
                // Pourquoi s'est-il arrêté ?
                if ($this->ct_len()===0){
                        $obj = new wcode_element();
                        $obj->erreur = 'Fin de code inattendue !';
                        $obj->code = '['.$nom.'='.$valeur;
                        return $obj;
                }
        }

        // On retire le ] !
        $this->ct_retirer(1);

        // Ici, on va vérifier que la balise existe, et le cas échéant, vérifier l'expression de la valeur
        $trouve = false;
        foreach($this->balises as $balise){
                if ($balise[0]===$nom){
                        $regex_valeur = $balise[1];
                        $code_html = $balise[2];
                        $ferme = $balise[3];
                        $retour_ligne = $balise[4];
                        $trouve = true;
                }
        }
        if (!$trouve){
                $obj = new wcode_element();
                $obj->erreur = 'Balise "'.$nom.'" inconnue !';
                if ($valeur!='') $obj->code = '['.$nom.'='.$valeur.']';
                else $obj->code = '['.$nom.']';
                return $obj;
        }

        // S'il y a REGEX de valeur
        if ($regex_valeur!=''){
                // Vérifier la valeur
                if (preg_match("/".$regex_valeur."/",$valeur) == 0){
                        $obj = new wcode_element();
                        $obj->erreur = 'La valeur de la balise "'.$nom.'" n\'est pas correcte !';
                        if ($valeur!='') $obj->code = '['.$nom.'='.$valeur.']';
                        else $obj->code = '['.$nom.']';
                        return $obj;
                }
        }

        if ($ferme){
        // Voici une petite explication simple de la technique utilisée :
                      // On va avancer dans le code caractère par caractère, jusqu'à temps d'avoir autant de balises
                      // d'ouverture que de balises de fermeture !
                      // Cat d'arrêt : $x === $this->ct_len();
              $balise_fermeture = '[/'.$nom.']';
              if ($regex_valeur==='') $balise_ouverture = '\\['.$nom.'\\]';
              else $balise_ouverture = '\\['.$nom.'='.$regex_valeur.'\\]';;
              $x = strlen($balise_fermeture); // Commencer à 1 c'est inutile !
              $ouvertures = preg_match_all("/".$balise_ouverture."/",$this->ct_lire($x),$ouv)+1;
              $fermetures = count(explode($balise_fermeture,$this->ct_lire($x)))-1;
              while (($ouvertures!=$fermetures || substr($this->ct_lire($x),$x-strlen($balise_fermeture)) != $balise_fermeture) && $x <= $this->ct_len()){
                      $x++;
                      $ouvertures = preg_match_all("/".$balise_ouverture."/",$this->ct_lire($x),$ouv)+1;
                      $fermetures = count(explode($balise_fermeture,$this->ct_lire($x)))-1;
              }
              // Toujours pas fermé cette -*#Nùp' de balise ?!
              if ($ouvertures!=$fermetures){
                              $contenu = $this->ct_retirer($x);
                              $obj = new wcode_element();
                              $obj->erreur = "Une balise ".$nom." n'est pas fermée !";
                              if ($valeur!='') $obj->code = '['.$nom.'='.$valeur.']'.$contenu;
                              else $obj->code = '['.$nom.']'.$contenu;
                              return $obj;
              }
              $contenu = $this->ct_retirer($x-strlen($balise_fermeture));
              $this->ct_retirer(strlen($balise_fermeture));
        }

        // Ici, on a le nom, la valeur, on sait qu'ils sont bons... Mais le contenu ... ?
         $obj_contenu = new wcode();
         $obj_contenu->balises = $this->balises;
         $obj_contenu->status_balises = true;
         $obj_contenu->definir_code($contenu);
         $obj_contenu->retour_ligne = $retour_ligne;
         $ret = $obj_contenu->lire_code();
         if (!$ret){
                        $obj = new wcode_element();
                        $obj->erreur = $obj_contenu->erreur;
                        if ($valeur!='') $obj->code = '['.$nom.'='.$valeur.']'.$contenu;
                        else $obj->code = '['.$nom.']'.$contenu;
                        return $obj;
         }
         // En théorie, ici, le contenu est bon !
         $obj = new wcode_element();
         $obj->definir($nom,$valeur,$obj_contenu,$code_html);
         $obj->ferme = $ferme;
         $obj->retour_ligne = $retour_ligne;
         return $obj;
     }



 }

?>
