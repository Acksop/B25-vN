<?php
global $header_title, $header_description, $header_identifier_url, $header_keywords;
$header_title = "Besançon 25 - Votre compte privé sur la Plate-forme";
$header_description = "Votre espace personnel sur Besançon 25";
$header_identifier_url = "besancon25.fr/compte_personnel";
$header_keywords = "Besan&ccedil;on, Besancon, 25000, 25, compte personnel, espace privé";

$dossier = Array();
$dossier = explode(".", __FILE__);
array_pop($dossier);
$chemin = implode(".", $dossier);
$chemin = explode("/", $chemin);
$nom_fichier_courant = array_pop($chemin);

global $repertoire_roles_utilisateurs;
$repertoire_roles_utilisateurs = implode(DIRECTORY_SEPARATOR, $chemin) . DIRECTORY_SEPARATOR . "rolesUtilisateurs" . DIRECTORY_SEPARATOR . $nom_fichier_courant . DIRECTORY_SEPARATOR;

function LancerAffichageDuCorps()
{
    global $repertoire_roles_utilisateurs;
    echo "<h1 class='utilisateurs'>Mes Pr&eacute;f&eacute;rences ";
    
    $status_compte = array(
        "Nouveau",
        "en Cours",
        "Admis",
        "kick&eacute;",
        "banni",
        "d&eacute;sinscrit"
    );
    $couleur_status = array(
        "FFFFFF",
        "999999",
        "CCCCCC",
        "00FF00",
        "FF0000",
        "0000FF"
    );
    
    echo "<script language='javascript'>" . "
	btn_modif_down = new Image();
	btn_modif_down = 'images/picto-modifierCircle_down.gif';
	btn_modif_up = new Image();
	btn_modif_up = 'images/picto-modifierCircle_up.gif';
	btn_modif_hover = new Image();
	btn_modif_hover = 'images/picto-modifierCircle_hover.gif';
	</script>
	";
    
    if (isset($_SESSION['NoFailleOnLine'])) {
        switch ($_SESSION['type_compte']) {
            case - 1:
                /**
                 * ***********************************************************************************************************************************************************SUPER UTILE
                 */
                echo "super-utilisateur .</h1>";
                echo $repertoire_roles_utilisateurs . 'super-utilisateur-limited.php';
                include $repertoire_roles_utilisateurs . 'super-utilisateur-limited.php';
                break;
            case 0:
                /**
                 * ***********************************************************************************************************************************************************SUPER UTILE
                 */
                echo "super-utilisateur .</h1>";
                echo $repertoire_roles_utilisateurs . 'super-utilisateur.php';
                include $repertoire_roles_utilisateurs . 'super-utilisateur.php';
                break;
            case 1:
                /**
                 * **********************************************************************************************************************************************************JOURNALISTES
                 */
                echo "journaliste .</h1>";
                $req_journaliste = recuperationInfoJournaliste($_SESSION['id_utilisateur']);
                $journaliste = exploiterLigneResultatBDD($req_journaliste);
                echo "<div class='conteneurGrand'>" . "<h2 class='legende'>Utilisation :</h2>" . "<ul class='preferences'>" . "<li>Peut proposer des <a href='index.php?page=ecritureArticle#corpsPage'>articles</a> soumis a validation</li>" . "<ul>" . "<li>Les articles ne sont compos&eacute;s que d'une image dessin&eacute;e au crayon puis scann&eacute;e</li>" . "<li>Les articles ne sont formes par rien d'autre qu'un texte succint pouvant avoir des liens hypertextes.</li>" . "<li>Peut envoyer les articles qu'il a &eacute;crit, &agrave; la validation du r&eacute;dacteur en chef pour qu'il soit mis en ligne</li>" . "<ul>" . "<li>Vous avez <a href='index.php?page=autorisationArticle#corpsPage'>" . recuperationNbAutorisationsArticles($_SESSION['id_utilisateur']) . " ARTICLES</a> en attente....</li>" . "<li>Vous avez &eacute;crit <a href='index.php?page=archiveArticlesJournaliste#corpsPage'>" . recuperationNbArticlesValide($_SESSION['id_utilisateur']) . " ARTICLES</a> visible sur le site.</li>" . "<li>Peut administrer les commentaires associ&eacute;s &agrave; ses &eacute;crits (Articles seulement...)</li>" . "</ul>" . "</ul>" . "<li>Peut proposer des <a href='index.php?page=ecritureDossier#corpsPage'>dossiers</a> soumis a validation</li>" . "<ul>" . "<li>Les dossiers sont composes de texte formates HTML,d'images, de son et de video[link&eacute;es]</li>" . "<ul>" . "<li>Vous avez <a href='index.php?page=archiveDossiersJournaliste'>" . recuperationNbDossiersArchiver($_SESSION['id_utilisateur']) . " DOSSIER(S)</a> archiv&eacute;(s) sur le site...</li>" . "<li>Vous avez <a href='index.php?page=archiveDossiersEnValidationsJournaliste'>" . recuperationNbDossiersEnValidation($_SESSION['id_utilisateur']) . " DOSSIER(S)</a> en attente de validation(s) sur le site...</li>" . "<li>Vous &ecirc:tes en train d'&eacute;crire <a href='index.php?page=archiveDossiersSauvegardeJournaliste'>" . recuperationNbDossiersSauvegarder($_SESSION['id_utilisateur']) . " DOSSIER(S)</a> en attente de finalisation(s)...</li>" . "</ul>" . "</ul>" . "<li>Peut <a href='index.php?page=ajoutUtilisateur'>cr&eacute;&eacute;r</a> un compte pour des artistes ou des associations int&egrave;r&eacute;ss&eacute;s ou pour des amis qui veulent participer en tant que journalistes.</li>" . "<li>Peut <a href='index.php?page=relierDesComptes'>LIER</a> son compte journaliste &agrave; d'autres compte pour une meilleure gestion</li>" . "<li>Peut annuler son compte, mais laisse les articles/dossiers &eacute;crits et valide dans les archives.</li>" . "</ul>";
                if (estCompteRelier($_SESSION['id_utilisateur'])) {
                    echo "<ul class='preferences'>" . "<li><b>Ce compte est reli&eacute; au(x) compte(s):</b></li>";
                    AfficherLesComptesRelies($_SESSION['id_utilisateur']);
                    echo "</ul>";
                }
                
                $courriels = rechercherCourriel($journaliste['email']);
                if (est_de_taille($courriels) > 1) {
                    echo "<ul><li>Ce compte possède la même adresse courriel que " . est_de_taille($courriels) . " compte(s)</li></ul>";
                    /*
                     * foreach($courriels as $cle => $valeurs){
                     * echo "<br /> - ".valeurs;
                     * }
                     */
                } else {
                    echo "<p>Ce compte possède une unique adresse courriel !</p>";
                }
                echo "</div>";
                
                if (isset($_GET['modif'])) {
                    $modif = $_GET['modif'];
                    $valeur = $_GET['valeur'];
                } else {
                    $modif = "";
                    $valeur = "";
                }
                echo "<a name='ancre_formulaire'>&nbsp;</a>";
                echo "<div class='conteneurGrand'>" . "<h2 class='legende'>Renseignements G&eacute;n&eacute;raux :</h2>" . "<h6 style='text-align:right;color:goldenrod;'>Ces renseignements n'apparaissent nul part sur le <a href='http://besancon25.fr/index.php'>site</a> car les journalistes ne sont pas &ecirc;tre r&eacute;f&eacute;renc&eacute;s sur un liste publique.<br/>Ils sont donc pas n&eacute;cessaire pour que le compte soit valid&eacute;, mais c'est toujours mieux de les remplir." . "</h6>";
                echo "<table border='0' width='100%'><tr><td class='titreTableau'>";
                if ($journaliste['nom'] == "" || $modif == "nom") {
                    if ($modif != "nom") {
                        ecrireFormulaireChangementJournaliste("nom", '');
                    } else {
                        ecrireFormulaireChangementJournaliste("nom", $valeur);
                    }
                } else {
                    echo "NOM DU JOURNALISTE: </td><td class='utilisateurs'>" . $journaliste['nom'] . "</td><td class='utilisateurs'><a href='index.php?page=compte&modif=nom&valeur=" . $journaliste['nom'] . "#ancre_formulaire'>Modifier</a>";
                }
                echo "</td></tr><tr><td class='titreTableau'>";
                if ($journaliste['prenom'] == "" || $modif == "prenom") {
                    if ($modif != "prenom") {
                        ecrireFormulaireChangementJournaliste("prenom", '');
                    } else {
                        ecrireFormulaireChangementJournaliste("prenom", $valeur);
                    }
                } else {
                    echo "PRENOM DU JOURNALISTE: </td><td class='utilisateurs'>" . $journaliste['prenom'] . "</td><td class='utilisateurs'><a href='index.php?page=compte&modif=prenom&valeur=" . $journaliste['prenom'] . "#ancre_formulaire'>Modifier</a>";
                }
                echo "</td></tr><tr><td class='titreTableau'>";
                if ($journaliste['surnom'] == "" || $modif == "surnom") {
                    if ($modif != "surnom") {
                        ecrireFormulaireChangementJournaliste("surnom", '');
                    } else {
                        ecrireFormulaireChangementJournaliste("surnom", $valeur);
                    }
                } else {
                    echo "PSEUDO DU JOURNALISTE: </td><td class='utilisateurs'>" . $journaliste['surnom'] . "</td><td class='utilisateurs'><a href='index.php?page=compte&modif=surnom&valeur=" . $journaliste['surnom'] . "#ancre_formulaire'>Modifier</a>";
                }
                echo "</td></tr><tr><td class='titreTableau'>";
                if ($journaliste['rencontre'] == "" || $modif == "rencontre") {
                    if ($modif != "rencontre") {
                        ecrireFormulaireChangementJournaliste("rencontre", '');
                    } else {
                        ecrireFormulaireChangementJournaliste("rencontre", $valeur);
                    }
                } else {
                    echo "RENCONTRE AVEC LE JOURNALISTE: </td><td class='utilisateurs'>" . $journaliste['rencontre'] . "</td><td class='utilisateurs'><a href='index.php?page=compte&modif=rencontre&valeur=" . $journaliste['rencontre'] . "#ancre_formulaire'>Modifier</a>";
                }
                echo "</td></tr><tr><td class='titreTableau'>";
                if ($journaliste['geolocalisation'] == "" || $modif == "geolocalisation") {
                    if ($modif != "geolocalisation") {
                        ecrireFormulaireChangementJournaliste("geolocalisation", '');
                    } else {
                        ecrireFormulaireChangementJournaliste("geolocalisation", $valeur);
                    }
                } else {
                    echo "POSITION G&Eacute;OGRAPHIQUE ACTUELLE: </td><td class='utilisateurs'>" . $journaliste['geolocalisation'] . "</td><td class='utilisateurs'><a href='index.php?page=compte&modif=geolocalisation&valeur=" . $journaliste['geolocalisation'] . "#ancre_formulaire'>Modifier</a>";
                }
                echo "</td></tr><tr><td class='titreTableau'>";
                if ($journaliste['signature'] == "" || $modif == "signature") {
                    if ($modif != "signature") {
                        ecrireFormulaireChangementJournaliste("signature", '');
                    } else {
                        ecrireFormulaireChangementJournaliste("signature", $valeur);
                    }
                } else {
                    echo "TELEPHONE DU JOURNALISTE: </td><td class='utilisateurs'>" . traduireLesCommandesBangDelaChaine($journaliste['signature']) . "</td><td class='utilisateurs'><a href='index.php?page=compte&modif=signature&valeur=" . $journaliste['signature'] . "#ancre_formulaire'>Modifier</a>";
                }
                echo "</td></tr><tr><td class='titreTableau'>";
                if ($journaliste['email'] == "" || $modif == "email") {
                    if ($modif != "email") {
                        ecrireFormulaireChangementJournaliste("email", '');
                    } else {
                        ecrireFormulaireChangementJournaliste("email", $valeur);
                    }
                } else {
                    echo "COURRIEL DU JOURNALISTE: </td><td class='utilisateurs'>" . $journaliste['email'] . "</td><td class='utilisateurs'><a href='index.php?page=compte&modif=email&valeur=" . $journaliste['email'] . "#ancre_formulaire'>Modifier</a>";
                }
                echo "</td></tr></table></div>";
                break;
            case 2:
            case 4:
                /**
                 * ***************************************************************************************************************************************************************ARTISTES
                 */
                $id_artiste = recuperationIDartisteOffLine($_SESSION['id_utilisateur']);
                $req_artiste = recuperationInfoArtiste($_SESSION['id_utilisateur']);
                $artiste = exploiterLigneResultatBDD($req_artiste);
                
                if ($_SESSION['type_compte'] == 2) {
                    echo "artiste ." . "<span style='float:right;font-size:10px;'>" . "Voir la page Personnelle sous la forme : " . "<a href='index.php?page=tableauInscrit&id={$id_artiste}&type={$_SESSION['type_compte']}'>Tablo&icirc;d ?</a>" . " ou <a href='index.php?page=murInscrit&id={$id_artiste}&type={$_SESSION['type_compte']}'>Mesure&Ocirc;M&egrave;tre ?</a>" . "</span></h1>";
                    
                    echo "<center>";
                    include $repertoire_roles_utilisateurs . 'artiste.php';
                } else {
                    echo "artisans." . "<span style='float:right;font-size:10px;'>" . "<a href='index.php?page=presentationArtisans&id={$id_artiste}'>Voir la page Personnelle?</a>" . "</span></h1>";
                    echo "<center>";
                    include $repertoire_roles_utilisateurs . 'artisans.php';
                }
                
                echo "<br /><br /><br /><br /><br />";
                
                echo "<div class='conteneurGrand'>" . "<h2 class='legende'>Utilisation :</h2>" . "<ul class='preferences'>" . "<li>Peut ecrire des <a href='" . PAGEB25COM . "index.php?page=ecritureAnnonce&id=" . $id_artiste . "'>annonces pour vendre</a> ses objets d'arts.</li>" . "<li>Peut <a href='" . PAGEB25COM . "index.php?page=voirAnnonces_utilisateur&id=" . $id_artiste . "&cleMap=" . calculCleMapAnnoncesUtilisateur($id_artiste) . "'>visualiser et/ou supprimer</a> ses " . recuperationNbAnnoncesActivesUtilisateur($id_artiste) . " Petites-Annonces actives .</li>" . "<li>Peut <a href='" . PAGEB25COM . "index.php?page=voirAnnoncesEnAttentes_utilisateur&id=" . $id_artiste . "&cleMap=" . calculCleMapAnnoncesEnAttentesUtilisateur($id_artiste) . "'>&eacute;diter</a> ses " . recuperationNbAnnoncesEnAttenteUtilisateur($id_artiste) . " Petites-Annonces en attente de validation.</li>" . "<li>Peut ecrire sur son compte autant de billet qu'il le souhaite</li>" . "<li>Peut modifier ses preferences</li>" . "<ul>" . "<li>Peut creer des cat&eacute;gories pour ses billets</li>" . "<li>Peut creer/modifier ses billets &agrave; volont&eacute;</li>" . "<li>Peut effectuer une modification de son css, par un formulaire precis enregistr&eacute; dans un dossier &agrave; son nom</li>" . "<li>Peut ajouter 100~ images dans le m&ecirc;me dossier, pour ecrire les billets</li>" . "<li>Peut ajouter des fichiers musicaux dans le m&ecirc;me dossier, pour ecrire des billets</li>" . "</ul>";
                echo "<li>Peut annuler son compte, mais laisse les images,les fichiers musicaux et le css sur le serveur.</li>" . "</ul>";
                if (estCompteRelier($_SESSION['id_utilisateur'])) {
                    echo "<ul class='preferences'>" . "<li><b>Ce compte est reli&eacute; au(x) compte(s):</b></li>";
                    AfficherLesComptesRelies($_SESSION['id_utilisateur']);
                    echo "</ul>";
                }
                
                $courriels = rechercherCourriel($artiste['email']);
                if (est_de_taille($courriels) > 1) {
                    echo "<ul><li>Ce compte possède la même adresse courriel que " . est_de_taille($courriels) . " compte(s)</li></ul>";
                    /*
                     * foreach($courriels as $cle => $valeurs){
                     * echo "<br /> - ".valeurs;
                     * }
                     */
                } else {
                    echo "<p>Ce compte possède une unique adresse courriel !</p>";
                }
                echo "</div>";
                
                echo "<br /><br />";
                
                echo "<div class='conteneurGrand'>" . "<h2 class='legende'>Renseignements G&eacute;n&eacute;raux :</h2>" . "<h6 style='text-align:right;color:darkred;'>Ces renseignements sont ceux qui apparaissent dans la <a href='./index.php?page=artistes'>liste</a> accessible sur l'interface publique du site.<br />Ils sont n&eacute;cessaire pour que le compte soit valid&eacute;...<br />Votre compte a le statut :" . "<span style='color:#" . $couleur_status[$_SESSION['status_compte']] . ";'>" . $status_compte[$_SESSION['status_compte']] . "</span>" . "<br /><a href='controlleurs/traitementModifEtatUtilisateur.php?validateFromCompte=1'>Valider le compte?</>" . "<br /><a href='controlleurs/traitementModifEtatUtilisateur.php?desactivateFromCompte=1'>Desactiver le compte?</>" . "</h6>";
                echo "<a name='ancre_formulaire'>&nbsp;</a>";
                if (isset($_GET['lecture'])) {
                    ecrireFormulairePremiereVisiteArtiste();
                } else {
                    if (isset($_GET['modif'])) {
                        $modif = $_GET['modif'];
                        $valeur = $_GET['valeur'];
                    } else {
                        $modif = "";
                        $valeur = "";
                    }
                    echo "<table border='0' width='100%'><tr><td class='titreTableau'>";
                    if ($artiste['nom'] == "" || $modif == "nom") {
                        if ($modif != "nom") {
                            ecrireFormulaireChangementArtiste("nom", '');
                        } else {
                            ecrireFormulaireChangementArtiste("nom", $valeur);
                        }
                    } else {
                        echo "NOM : </td><td class='utilisateurs'>" . $artiste['nom'] . "</td><td class='utilisateurs'><a href='index.php?page=compte&modif=nom&valeur=" . $artiste['nom'] . "#ancre_formulaire'>Modifier</a>";
                    }
                    echo "</td></tr><tr><td class='titreTableau'>";
                    if ($artiste['prenom'] == "" || $modif == "prenom") {
                        if ($modif != "prenom") {
                            ecrireFormulaireChangementArtiste("prenom", '');
                        } else {
                            ecrireFormulaireChangementArtiste("prenom", $valeur);
                        }
                    } else {
                        echo "PRENOM : </td><td class='utilisateurs'>" . $artiste['prenom'] . "</td><td class='utilisateurs'><a href='index.php?page=compte&modif=prenom&valeur=" . $artiste['prenom'] . "#ancre_formulaire'>Modifier</a>";
                    }
                    echo "</td></tr><tr><td class='titreTableau'>";
                    if ($artiste['description'] == "" || $modif == "description") {
                        if ($modif != "description") {
                            ecrireFormulaireChangementArtiste("description", '');
                        } else {
                            ecrireFormulaireChangementArtiste("description", $valeur);
                        }
                    } else {
                        echo "DESCRIPTION DE L'ART ou DE L'ARTISANAT: </td><td class='utilisateurs'>" . traduireLesCommandesBangDelaChaine($artiste['description']) . "</td><td class='utilisateurs'><a href='index.php?page=compte&modif=description&valeur=" . $artiste['description'] . "#ancre_formulaire'>Modifier</a>";
                    }
                    echo "</td></tr><tr><td class='titreTableau'>";
                    if ($artiste['telephone'] == "" || $modif == "telephone") {
                        if ($modif != "telephone") {
                            ecrireFormulaireChangementArtiste("telephone", '');
                        } else {
                            ecrireFormulaireChangementArtiste("telephone", $valeur);
                        }
                    } else {
                        echo "T&Eacute;LEPHONE : </td><td class='utilisateurs'>" . $artiste['telephone'] . "</td><td class='utilisateurs'><a href='index.php?page=compte&modif=telephone&valeur=" . $artiste['telephone'] . "#ancre_formulaire'>Modifier</a>";
                    }
                    echo "</td></tr><tr><td class='titreTableau'>";
                    echo "VISIBILIT&Eacute;E DU NUM&Eacute;RO DE T&Eacute;LEPHONE :</td>";
                    echo "<td class='utilisateurs'>";
                    if ($artiste['voir_telephone'] == 0) {
                        echo "invisible";
                    } else {
                        echo "visible";
                    }
                    echo "</td><td class='utilisateurs'>" . "<form name='modifInfoArtiste' method='post' action='controlleurs/traitementModifInfoArtiste.php'>" . "<input type='hidden' name='voir_telephone' value='" . $artiste['voir_telephone'] . "#formulaire'/>" . "<button type='submit' class='btn_modif'><img src='./images/picto-modifierCircle_up.gif' onMouseOut='this.src=btn_modif_up;' onMouseDown='this.src=btn_modif_down;' onMouseOver='this.src=btn_modif_hover;' alt='Changer?' /></button>" . "</form>";
                    
                    echo "<tr><td class='titreTableau'>";
                    echo "VISIBILIT&Eacute;E DE TOUTES LES COORDONN&Eacute;ES :</td>";
                    echo "<td class='utilisateurs'>";
                    if ($artiste['site_web_only'] == 1) {
                        echo "invisible";
                    } else {
                        echo "visible";
                    }
                    echo "</td><td class='utilisateurs'>" . "<form name='modifInfoArtiste' method='post' action='controlleurs/traitementModifInfoArtiste.php'>" . "<input type='hidden' name='site_web_only' value='" . $artiste['site_web_only'] . "'/>" . "<button type='submit' class='btn_modif'><img src='./images/picto-modifierCircle_up.gif' onMouseOut='this.src=btn_modif_up;' onMouseDown='this.src=btn_modif_down;' onMouseOver='this.src=btn_modif_hover;' alt='Changer?' /></button>" . "</form>";
                    echo "</td></tr><tr><td class='titreTableau'>";
                    echo "VISIBILIT&Eacute;E DU COURRIEL :</td>";
                    echo "<td class='utilisateurs'>";
                    if ($artiste['voir_courriel'] == 0) {
                        echo "invisible";
                    } else {
                        echo "visible";
                    }
                    echo "</td><td class='utilisateurs'>" . "<form name='modifInfoArtiste' method='post' action='controlleurs/traitementModifInfoArtiste.php'>" . "<input type='hidden' name='voir_courriel' value='" . $artiste['voir_courriel'] . "'/>" . "<button type='submit' class='btn_modif'><img src='./images/picto-modifierCircle_up.gif' onMouseOut='this.src=btn_modif_up;' onMouseDown='this.src=btn_modif_down;' onMouseOver='this.src=btn_modif_hover;' alt='Changer?' /></button>" . "</form>";
                    echo "</td></tr><tr><td class='titreTableau'>";
                    if ($artiste['pseudo'] == "" || $modif == "pseudo") {
                        if ($modif != "pseudo") {
                            ecrireFormulaireChangementArtiste("pseudo", '');
                        } else {
                            ecrireFormulaireChangementArtiste("pseudo", $valeur);
                        }
                    } else {
                        echo "PSEUDO : </td><td class='utilisateurs'>" . $artiste['pseudo'] . "</td><td class='utilisateurs'><a href='index.php?page=compte&modif=pseudo&valeur=" . $artiste['pseudo'] . "#ancre_formulaire'>Modifier</a>";
                    }
                    echo "</td></tr><tr><td class='titreTableau'>";
                    if ($artiste['email'] == "" || $modif == "email") {
                        if ($modif != "email") {
                            ecrireFormulaireChangementArtiste("email", '');
                        } else {
                            ecrireFormulaireChangementArtiste("email", $valeur);
                        }
                    } else {
                        echo "COURRIEL : </td><td class='utilisateurs'>" . $artiste['email'] . "</td><td class='utilisateurs'><a href='index.php?page=compte&modif=email&valeur=" . $artiste['email'] . "#ancre_formulaire'>Modifier</a>";
                    }
                    echo "</td></tr><tr><td class='titreTableau'>";
                    if ($artiste['siteInterWeb'] == "" || $modif == "siteInterWeb") {
                        if ($modif != "siteInterWeb") {
                            ecrireFormulaireChangementArtiste("siteInterWeb", '');
                        } else {
                            ecrireFormulaireChangementArtiste("siteInterWeb", $valeur);
                        }
                    } else {
                        echo "SITE WEB-INTERNET : </td><td class='utilisateurs'>" . $artiste['siteInterWeb'] . "</td><td class='utilisateurs'><a href='index.php?page=compte&modif=siteInterWeb&valeur=" . $artiste['siteInterWeb'] . "#ancre_formulaire'>Modifier</a>";
                    }
                    echo "</td></tr><tr><td class='utilisateurs'>";
                    echo "</td></tr></table>";
                }
                echo "</div>";
                
                echo "</center>";
                break;
            case 3:
            case 5:
                /**
                 * ***********************************************************************************************************************************************************ASSOCIATIONS
                 */
                $id_association = recuperationIDassociationOffLine($_SESSION['id_utilisateur']);
                $req_association = recuperationInfoAsso($_SESSION['id_utilisateur']);
                $association = exploiterLigneResultatBDD($req_association);
                
                if ($_SESSION['type_compte'] == 3) {
                    
                    $req_descriptif = recuperationDescriptifAsso($id_association);
                    $descriptif = exploiterLigneResultatBDD($req_descriptif);
                    $req_status = recuperationStatusAsso($id_association);
                    $status = exploiterLigneResultatBDD($req_status);
                    $req_membres = recuperationMembresAsso($id_association);
                    $nbMembres = exploiterNombreLigneResultatBDD($req_membres);
                    $req_liens = recuperationLiensWebAsso($id_association);
                    $nbLiens = exploiterNombreLigneResultatBDD($req_liens);
                    
                    echo "association ." . "<span style='float:right;font-size:10px;'>" . "<a href='index.php?page=presentationAssociation&id={$id_association}'>Voir la page de pr&eacute;sentation</a>" . "</span></h1>";
                    
                    include $repertoire_roles_utilisateurs . 'association.php';
                } else {
                    echo "groupe.</h1>";
                    
                    $req_descriptif = recuperationDescriptifAsso($id_association);
                    $descriptif = exploiterLigneResultatBDD($req_descriptif);
                    
                    include $repertoire_roles_utilisateurs . 'groupe.php';
                }
                
                echo "<div class='conteneurGrand'>" . "<h2 class='legende'>Utilisation :</h2>" . "<ul class='preferences'>" . "<li>Peut &eacute;crire sur son compte autant de billet qu'il le souhaite</li>" . "<li>Peut ecrire des <a href='" . PAGEB25NET . "index.php?page=ecritureEvenement&id=" . $id_association . "'>&eacute;v&egrave;nements</a> pour pr&eacute;senter ses activit&eacute;s.</li>" . "<li>Peut <a href='" . PAGEB25NET . "index.php?page=voirEvenements_utilisateur&id=" . $id_association . "&cleMap=" . calculCleMapEvenementsUtilisateur($id_association) . "'>visualiser et/ou supprimer</a> ses " . recuperationNbEvenementsActivesUtilisateur($id_association) . " &Eacute;v&egrave;nements actifs .</li>" . "<li>Peut <a href='" . PAGEB25NET . "index.php?page=voirEvenementsEnAttentes_utilisateur&id=" . $id_association . "&cleMap=" . calculCleMapEvenementsEnAttentesUtilisateur($id_association) . "'>&eacute;diter</a> ses " . recuperationNbEvenementsEnAttenteUtilisateur($id_association) . " &Eacute;v&egrave;nements en attente de validation.</li>" . 

                "<li>Peut modifier ses pref&ecirc;rences</li>" . "<ul>" . "<li><span style='text-decoration: line-through;'>Peut afficher son logo, sa mission, ses membres et ses coordonn&eacute;es en haut du blog</span></li>" . "<li>Peut effectuer une modification de son css, par un formulaire pr&eacute;cis enregistr&eacute; dans un dossier &agrave; son nom</li>" . "<li>Peut ajouter 100~ images dans le m&ecirc;me dossier, pour &eacute;crire les billets</li>" . "<li>Peut ajouter des fichiers musicaux dans le m&ecirc;me dossier, pour &eacute;crire des billets</li>" . "</ul>";
                echo "<li>Peut annuler son compte, mais laisse les images,les fichiers musicaux et le css sur le serveur.</li>" . "</ul>";
                if (estCompteRelier($_SESSION['id_utilisateur'])) {
                    echo "<ul class='preferences'>" . "<li><b>Ce compte est reli&eacute; au(x) compte(s):</b></li>";
                    AfficherLesComptesRelies($_SESSION['id_utilisateur']);
                    echo "</ul>";
                }
                $courriels = rechercherCourriel($association['email']);
                if (est_de_taille($courriels) > 1) {
                    echo "<ul><li>Ce compte possède la même adresse courriel que " . est_de_taille($courriels) . " compte(s)</li></ul>";
                    /*
                     * foreach($courriels as $cle => $valeurs){
                     * echo "<br /> - ".valeurs;
                     * }
                     */
                } else {
                    echo "<p>Ce compte possède une unique adresse courriel !</p>";
                }
                echo "</div>";
                
                echo "<div class='conteneurGrand'>" . "<h2 class='legende'>Renseignements G&eacute;n&eacute;raux :</h2>" . "<h6 style='text-align:right;color:white;'>Ces renseignements sont ceux qui apparaissent dans la <a href='./index.php?page=associations'>liste</a> accessible sur l'interface publique du site.<br/>Ils sont n&eacute;cessaire pour que le compte soit valid&eacute;...<br />Votre compte a le statut :" . "<span style='color:#" . $couleur_status[$_SESSION['status_compte']] . ";'>" . $status_compte[$_SESSION['status_compte']] . "</span>" . "<br /><a href='controlleurs/traitementModifEtatUtilisateur.php?validateFromCompte=1'>Valider le compte?</>" . "<br /><a href='controlleurs/traitementModifEtatUtilisateur.php?desactivateFromCompte=1'>Desactiver le compte?</>" . "</h6>";
                echo "<a name='ancre_formulaire'/>";
                if (isset($_GET['lecture'])) {
                    ecrireFormulairePremiereVisiteAsso();
                } else {
                    if (isset($_GET['modif']) && isset($_GET['valeur'])) {
                        $modif = $_GET['modif'];
                        $valeur = $_GET['valeur'];
                    } else {
                        $modif = "";
                        $valeur = "";
                    }
                    echo "<table border='0' width='100%'><tr><td class='titreTableau'>";
                    if ($association['nom'] == "" || $modif == "nom") {
                        if ($modif != "nom") {
                            ecrireFormulaireChangementAsso("nom", '');
                        } else {
                            ecrireFormulaireChangementAsso("nom", $valeur);
                        }
                    } else {
                        echo "NOM : </td><td class='utilisateurs'>" . $association['nom'] . "</td><td class='utilisateurs'><a href='index.php?page=compte&modif=nom&valeur=" . $association['nom'] . "#ancre_formulaire'>Modifier</a>";
                    }
                    echo "</td></tr><tr><td class='titreTableau'>";
                    if ($association['description'] == "" || $modif == "description") {
                        if ($modif != "description") {
                            ecrireFormulaireChangementAsso("description", '');
                        } else {
                            ecrireFormulaireChangementAsso("description", $valeur);
                        }
                    } else {
                        echo "DESCRIPTION : </td><td class='utilisateurs'>" . traduireLesCommandesBangDelaChaine($association['description']) . "</td><td class='utilisateurs'><a href='index.php?page=compte&modif=description&valeur=" . $association['description'] . "#ancre_formulaire'>Modifier</a>";
                    }
                    echo "</td></tr><tr><td class='titreTableau'>";
                    if ($association['telephone'] == "" || $modif == "telephone") {
                        if ($modif != "telephone") {
                            ecrireFormulaireChangementAsso("telephone", '');
                        } else {
                            ecrireFormulaireChangementAsso("telephone", $valeur);
                        }
                    } else {
                        echo "TELEPHONE : </td><td class='utilisateurs'>" . $association['telephone'] . "</td><td class='utilisateurs'><a href='index.php?page=compte&modif=telephone&valeur=" . $association['telephone'] . "#ancre_formulaire'>Modifier</a>";
                    }
                    echo "</td></tr><tr><td class='titreTableau'>";
                    if ($association['email'] == "" || $modif == "email") {
                        if ($modif != "email") {
                            ecrireFormulaireChangementAsso("email", '');
                        } else {
                            ecrireFormulaireChangementAsso("email", $valeur);
                        }
                    } else {
                        echo "COURRIEL : </td><td class='utilisateurs'>" . $association['email'] . "</td><td class='utilisateurs'><a href='index.php?page=compte&modif=email&valeur=" . $association['email'] . "#ancre_formulaire'>Modifier</a>";
                    }
                    echo "</td></tr><tr><td class='titreTableau'>";
                    if ($association['siteInterWeb'] == "" || $modif == "siteInterWeb") {
                        if ($modif != "siteInterWeb") {
                            ecrireFormulaireChangementAsso("siteInterWeb", '');
                        } else {
                            ecrireFormulaireChangementAsso("siteInterWeb", $valeur);
                        }
                    } else {
                        echo "SITE INTERNET : </td><td class='utilisateurs'>" . $association['siteInterWeb'] . "</td><td class='utilisateurs'><a href='index.php?page=compte&modif=siteInterWeb&valeur=" . $association['siteInterWeb'] . "#ancre_formulaire'>Modifier</a>";
                    }
                    echo "</td></tr><tr><td class='titreTableau'>";
                    if ($association['adresse'] == "" || $modif == "adresse") {
                        if ($modif != "adresse") {
                            ecrireFormulaireChangementAsso("adresse", '');
                        } else {
                            ecrireFormulaireChangementAsso("adresse", $valeur);
                        }
                    } else {
                        echo "ADRESSE LOCALE : </td><td class='utilisateurs'>" . $association['adresse'] . "</td><td class='utilisateurs'><a href='index.php?page=compte&modif=adresse&valeur=" . $association['adresse'] . "#ancre_formulaire'>Modifier</a>";
                    }
                    echo "</td></tr><tr><td class='titreTableau'>";
                    if ($association['codePostal'] == "" || $modif == "codePostal") {
                        if ($modif != "codePostal") {
                            ecrireFormulaireChangementAsso("codePostal", '');
                        } else {
                            ecrireFormulaireChangementAsso("codePostal", $valeur);
                        }
                    } else {
                        echo "CODE POSTAL : </td><td class='utilisateurs'>" . $association['codePostal'] . "</td><td class='utilisateurs'><a href='index.php?page=compte&modif=codePostal&valeur=" . $association['codePostal'] . "#ancre_formulaire'>Modifier</a>";
                    }
                    echo "</td></tr><tr><td class='titreTableau'>";
                    if ($association['ville'] == "" || $modif == "ville") {
                        if ($modif != "ville") {
                            ecrireFormulaireChangementAsso("ville", '');
                        } else {
                            ecrireFormulaireChangementAsso("ville", $valeur);
                        }
                    } else {
                        echo "VILLE : </td><td class='utilisateurs'>" . $association['ville'] . "</td><td class='utilisateurs'><a href='index.php?page=compte&modif=ville&valeur=" . $association['ville'] . "#ancre_formulaire'>Modifier</a>";
                    }
                    echo "</td></tr></table>";
                }
                echo "</div>";
                
                break;
            default:
                echo "utilisateur par default...";
        }
    } else {
        /**
         * *************************************************************************************************************************************************************H4X0R
         */
        echo "Votre compte PIRATE ?!!!!!? .</h1>" . "<ul class='preferences'>" . "<li>Peut lire les billets des artistes, associations ainsi que les articles et les dossiers des journalistes</li>" . "<li>Peut t&eacute;l&eacute;charger le CMS - OpenJournaliste - Sous-licence</li>" . "<ul>" . "<li>Peut demander &agrave; travailler avec la communaut&eacute;e</li>" . "<li>Peut envoyer un mail &agrave; l'administrateur du site pour devenir journaliste &agrave; son tour</li>" . "<li>Peut avoir acc&egrave;s aux <a href='index.php?page=archives'>archives</a> des articles...</li>" . "<li>Peut acc&egrave;der &agrave; l' InterWeboGraphie du site.</li>" . "</ul>" . "<li>Peut chier partout, m&ecirc;me sur les murs si &ccedil;a lui chante! </li>" . "</ul>";
        AlerteSecuriteAdresseForce();
    }
}
