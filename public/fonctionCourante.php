<?php
require dirname(__FILE__) . "/../localisation_Domaines_externes_B25.php";
require dirname(__FILE__) . "/../identifiants_GoogleAdress_B25.php";

require dirname(__FILE__) . '/variablesApplication.php';

require SCRIPTPHPPATH . '/connectionBDD.php';
require SCRIPTPHPPATH . '/arrondis.php';
require SCRIPTPHPPATH . '/formulaireModification.php';
require SCRIPTPHPPATH . '/repertoire.php';
require SCRIPTPHPPATH . '/cookies.php';
require SCRIPTPHPPATH . '/composants.php';
require SCRIPTPHPPATH . '/nbConnect.php';
require SCRIPTPHPPATH . '/sessions.php';
require SCRIPTPHPPATH . '/tweet.php';
require SCRIPTPHPPATH . '/alertesIntrusions.php';
require SCRIPTPHPPATH . '/cryptographie.php';
include SCRIPTPHPPATH . '/exceptions.php';
include SCRIPTPHPPATH . '/mobile.php';

function AfficheSousMenu()
{
    $mobile = detection_mobile();
    echo "<ul id='sousmenu'>";
    if (! isset($_SESSION['id_utilisateur'])) {
        echo "<li><a href='index.php?page=inscription'>S'inscrire (à Mon Compte!)</a>&nbsp;&nbsp;&nbsp;&nbsp;//&nbsp;&nbsp;&nbsp;&nbsp;<a href='index.php?page=identification'> SE CONNECTER </a>";
        if (! $mobile) {
            echo "</li><li>&nbsp;&nbsp;&nbsp;&nbsp;<a href='index.php?page=preferences'>Mes Pr&eacute;f&eacute;rences d'affichage(s)</a>";
        }
        echo "</li>";
    } else {
        echo "<li>Bonjour <a href='index.php?page=compte'>" . $_SESSION['identifiant'] . "</a>&nbsp;&nbsp;&nbsp;&nbsp;";
        if (! $mobile) {
            echo "//&nbsp;&nbsp;&nbsp;&nbsp;" . "<a href='index.php?page=preferences'>Mes Pr&eacute;f&eacute;rences d'affichage(s)</a>&nbsp;&nbsp;&nbsp;&nbsp;//&nbsp;&nbsp;&nbsp;&nbsp;<a href='controlleurs/traitementDeconnexion.php'>Se D&eacute;connecter</a>";
        }
        echo "</li>";
    }
    if (! $mobile) {
        echo "<li><span id='HeureDate'>" . AfficheDate() . "</span>&nbsp;&nbsp;&nbsp;&nbsp;//&nbsp;&nbsp;&nbsp;&nbsp;<a href='./FluxRSS.php?flux=RSS'><img src='./images/feed-icon-16x16.png'></a></li>";
    }
    echo "</ul>";
    return;
}

function AfficheJSIcone()
{
    echo "<script type='text/ECMAscript' language='ECMAscript' src='./scriptJS/survolIcone.js'></script>";
    return;
}

function AfficheMenu()
{
    echo "\n<div id='nav' class='boutonsMenu'>";
    echo "\n	<ul id='menu'>";
    
    if (! isset($_GET['page']) || ($_GET['page'] === "accueil")) {
        echo "\n		<li><a href='http://wikini.besancon25.fr' >Informations Compl&eacute;mentaires <img src='images/aide_B25.gif' alt='Wikini explicatifs des tenants et aboutissants de la plate-forme (en stade de compl&eacute;ment incomplet.)' /></a></li>";
    } else {
        echo "\n		<li><a href='index.php?page=accueil' >Accueil</a></li>";
    }
    
    echo "\n		<li><a href='index.php?page=artistes' >Artistes et Artisans</a></li>" . "\n		<li><a href='index.php?page=associations' >Associations et Groupes</a></li>";
    
    if (isset($_SESSION['type_compte'])) {
        echo "\n		<li><a href='index.php?page=articles' >Articles</a></li>";
    }
    
    echo "\n		<li><a href='index.php?page=dossiers' >Dossiers</a></li>";
    
    echo "\n	</ul>" . "\n</div>\n";
    
    return;
}

function PositionneCSS()
{
    echo "\n" . "<link type='text/css' rel='stylesheet' href='stylesCSS/baseCorps.css'>";
    echo "\n" . "<link type='text/css' rel='stylesheet' href='stylesCSS/baseMenus.css'>";
    if (! isset($_COOKIE['versionIHM'])) {
        $version = "2.1";
    } else {
        $version = "2." . $_COOKIE['versionIHM'];
    }
    if (isset($_COOKIE['interfaceIHM'])) {
        echo "\n" . "<link id='interface' type='text/css' rel='stylesheet' href='stylesCSS/v" . $version . "/interface" . ajouterZero($_COOKIE['interfaceIHM']) . ".css'>";
        // echo "\n" . "<link id='menu' type='text/css' rel='stylesheet' href='stylesCSS/v".$version."/menu".ajouterZero($_COOKIE['interfaceIHM']).".css'>";
        echo "\n" . "<link id='couleur' type='text/css' rel='stylesheet' href='stylesCSS/v" . $version . "/couleurs.css'>";
    } else {
        $rand = rand(1, 4);
        echo "\n" . "<link id='interface' type='text/css' rel='stylesheet' href='stylesCSS/v2.1/interface01.css'>";
        // echo "\n" . "<link id='menu' type='text/css' rel='stylesheet' href='stylesCSS/v2.1/menu01.css'>";
        echo "\n" . "<link id='couleur' type='text/css' rel='stylesheet' href='stylesCSS/v2.1/couleurs.css'>";
    }
    if (isset($_COOKIE['tailleLecture'])) {
        echo "\n" . "<link id='lecture' type='text/css' rel='stylesheet' href='stylesCSS/lecture" . ajouterZero($_COOKIE['tailleLecture']) . ".css'>";
    } else {
        echo "\n" . "<link id='lecture' type='text/css' rel='stylesheet' href='stylesCSS/lecture02.css'>";
    }
    if (isset($_COOKIE['typographie'])) {
        echo "\n" . "<link id='typographie' type='text/css' rel='stylesheet' href='stylesCSS/typographie" . ajouterZero($_COOKIE['typographie']) . ".css'>";
    } else {
        echo "\n" . "<link id='typographie' type='text/css' rel='stylesheet' href='stylesCSS/typographie08.css'>";
    }
    echo "\n" . "<link type='text/css' rel='stylesheet' href='stylesCSS/menu-mobile.css' media='all'>";
    echo "\n" . "<link type='text/css' rel='stylesheet' href='stylesCSS/baseCorps-under1100px.css'>";
    echo "\n" . "<link type='text/css' rel='stylesheet' href='stylesCSS/baseCorps-under640px.css'>";
    echo "\n" . "<link type='text/css' rel='stylesheet' href='stylesCSS/responsive-navigation.css'>";
    echo "\n" . "<link type='text/css' rel='stylesheet' href='stylesCSS/cadre.css'>";
    return;
}

function PositionneJS()
{
    echo "<script type='text/javascript' src='scriptJS/ajax.js'></script>";
    echo "<script type='text/javascript' src='scriptJS/cookie.js'></script>";
    
    echo "<script type='text/javascript' src='scriptJS/selectionnerDIV.js'></script>";
    
    echo "<script type='text/javascript' src='scriptJS/horloge.js'></script>";
    echo "<script type='text/javascript' src='scriptJS/afficherCacherDIV.js'></script>";
    
    echo "<script type='text/javascript' src='scriptJS/changerCSS.js'></script>";
    
    echo "<script type='text/javascript' src='scriptJS/classList.js'></script>";
    
    // echo "<script type='text/javascript' src='scriptJS/live.js'></script>";
    // echo "<script type='text/javascript' src='scriptJS/mobile-menu.js'></script>";
    return;
}

function AffichePage($page)
{
    
    // chargement de la fonction d'affichage
    if ($page == "index") {
        AfficheIndex();
    } else 
        if ($page == "statistiques") {
            include 'modeles/App/crawltrack3-3-4/index.php';
        } else {
            LancerAffichageDuCorps();
        }
    return;
}

function ChargerVariablesInitialesHeader($page)
{
    // initialisation
    global $header_title, $header_description, $header_identifier_url, $header_keywords;
    $header_title = "Besançon 25 - La plate-Forme des artistes/Artisans et des groupes/Associations de Besançon - v3.0c - &#948; version";
    $header_description = "si t'enlève la cedille ca fait gars con ! medic! --- Site communautaire pour les artistes/Artisans et les Groupes/Associations de Besançon";
    $header_identifier_url = "besancon25.fr";
    $header_keywords = "Journal, Doubs, Besan&ccedil;on, Besancon, 25000, 25, artiste, artistes, artisant, artisants, association, associations, article, articles, dossier, dossiers, arts, art";
    return;
}

function ChargerModeleEtFonctionsDeLaPage($page)
{
    // chargement du modele contenant la fonction d'affichage
    if (isset($page)) {
        if (file_exists('modeles/' . $page . '.php')) {
            include 'modeles/' . $page . '.php';
        }
    }
    return;
}

function ConvertirVariablesHeader($page)
{
    global $header_title, $header_description, $header_identifier_url, $header_keywords;
    $header_title = html_entity_decode(str_replace("&apos;", "'", $header_title), ENT_QUOTES, "ISO-8859-15");
    $header_description = html_entity_decode(str_replace("&apos;", "'", $header_description), ENT_QUOTES, "ISO-8859-15");
    $header_identifier_url = html_entity_decode(str_replace("&apos;", "'", $header_identifier_url), ENT_QUOTES, "ISO-8859-15");
    $header_keywords = html_entity_decode(str_replace("&apos;", "'", $header_keywords), ENT_QUOTES, "ISO-8859-15");
    return;
}

function AfficheIndex()
{
    echo "<center>";
    
    /**
     * *********************************************************************
     */
    /**
     * CELLULE DES ARTICLES D'ACCEUIL
     *
     * echo "<div class='accueil' style='width:100%;'>"
     * ."<div class='accueil-row'><div class='accueil-cell'>"
     * ."<p bgcolor='#CCCCCC' valign='top' align='left' style='display:block;float:left;'>"
     * ."&nbsp;&nbsp;<img src='images/dernierArticleParu.gif'/>"
     * ."</p>";
     * AfficheDernierArticle();
     * echo "</div></div>";
     */
    
    /**
     * *********************************************************************
     */
    /**
     * CELLULE DES EXPLICATIONS D'ACCEUIL
     */
    
    AfficheExplications();
    
    /**
     * *********************************************************************
     */
    /**
     * CELLULES du gueuloir
     */
    
    $interface = recuperationCookieInterface();
    // if($interface != 6 && $interface != 9 && $interface != 10 && $interface != 11 && $interface != 12){
    AfficheGueuloir();
    // }
    echo "</center>";
    
    include dirname(__FILE__) . DIRECTORY_SEPARATOR . "modeles/artistes.php";
    LancerAffichageDuCorps();
    include dirname(__FILE__) . DIRECTORY_SEPARATOR . "modeles/associations.php";
    LancerAffichageDesAssociations();
    include dirname(__FILE__) . DIRECTORY_SEPARATOR . "modeles/articles.php";
    LancerAffichageDesArticles();
    include dirname(__FILE__) . DIRECTORY_SEPARATOR . "modeles/dossiers.php";
    LancerAffichageDuDossier();
}

function AfficheExplications()
{
    $rand = 0; // rand(0,1);
    if ($rand == 1) {
        
        echo "<div class='accueil-row'><div class='accueil-cell'>" . "<table border='0'><tr><td valign='top' align='center' class='article' >" . "<img src='images/articles/souveraines.jpg' width='200px' height='500px'>" . "<p align='left' class='titre'>BESANCON 25 </br>&nbsp;&nbsp;&nbsp;- le Ya-Ka-F&ocirc;-Kon</p>" . "<p align='center' class='article'></p><hr/><p align='center' class='article'>Cette Plate-Forme d'annuaire s'adresse &agrave; tous les artistes et associations en mal de devenir ...</br>&Agrave; toutes celles et ceux qui se battent pour se faire conna&icirc;tre et reconna&icirc;tre au sein de Besan&ccedil;on</br>Ici il y a la possiblit&eacute; de se faire appeler pour peu que l'on veuille bien <a href='index.php?page=inscription'>s'incrire</a>.</br>Car si certains peuvent essayer de passer par le systeme du bouche &agrave; oreille, il est quelques-fois plus simple de laisser des coordonn&eacute;es au milieu de toutes les autres, car cela permet de tisser des liens que l'on aurait p&ucirc; peu imaginer.</br>Il ne reste plus qu'alors &agrave; attendre que le bouleversement des mentalit&eacute;s s'op&egrave;re et qu'il devienne un effet boule de neige pour ceux qui auront bien voulu croire en ce site.</br></p>" . "<p align='right' class='date'>le 21/06/2010</p>" . "<p align='right' class='post'>l'Administrateur</p>" . "</td></tr></table>" . "</div>" . "<div class='accueil-cell'>" . "<table border='0'><tr><td valign='top' align='center' class='article' >" . "<img src='images/articles/attentives.jpg' width='200px' height='500px'>" . "<p align='left' class='titre'>BESANCON 25 </br>&nbsp;&nbsp;&nbsp;- le Pourquoi du Comment ?!?</p>" . "<p align='center' class='article'></p><hr/><p align='center' class='article'><b>Pourquoi avoir fait cet annuaire ?</b></br>La premi&egrave;re et la moins couteuse de toutes les communications provient du web d'internet car la culture du libre et du gratuit y est incrite toujours dans les plus charmantes m&eacute;moires de nos programmeurs. Aujourd'hui tout coute le moindre euros que la plupart des artistes n'ont la possibilit&eacute; de payer pour une communication qui ne leurs semblent pas famili&egrave;re ou n&eacute;cessaire. Cet annuaire est gratuit pour tous et toutes qui veulent avoir une place sur ce site.</br><b>Comment participer ?</b></br>Il suffit de s'incrire via le bouton <a href='index.php?page=inscription'>Mon Compte</a> en haut du site puis de remplir vos noms, prenoms, pseudos, num&eacute;ro de t&eacute;l&eacute;phone, et adresse de courriel ainsi que la description de votre art pr&eacute;f&eacute;r&eacute; pour pourvoir appara&icirc;tre sur ce site. Attention tout compte mal-rempli ne sera pas valid&eacute; par l'administrateur...</br></p>" . "<p align='right' class='date'>le 30/06/2010</p>" . "<p align='right' class='post'>l'Administrateur</p>" . "</td></tr></table>" . "</div></div>";
    } else {
        
        echo "<div class='accueil-row'><div class='accueil-cell'><p style='font-variant:small-caps;font-size:large;text-align:right;'><b>BESANCON 25&nbsp;&nbsp;&nbsp;- le Ya-Ka-F&ocirc;-Kon</b></p>" . "<hr /><p style='text-align:justify;font-size:small;'>Cette Plate-Forme d'annuaire collaboratif s'adresse &agrave; tous les artistes et associations en mal de devenir ...<br />&Agrave; toutes celles et ceux qui se battent pour se faire conna&icirc;tre ou reconna&icirc;tre au sein de Besan&ccedil;on<br />Ici il y a la possiblit&eacute; de laisser un contact permettant de se faire appeler pour peu que l'on veuille bien <a href='index.php?page=inscription'>s'incrire</a>.<br />Car si certains peuvent essayer de passer par le systeme du bouche &agrave; oreille, il est quelques-fois plus simple de laisser des coordonn&eacute;es au milieu de toutes les autres, car cela permet de tisser des liens que l'on aurait p&ucirc; peu imaginer.<br />Il ne reste plus qu'alors &agrave; attendre que le bouleversement des mentalit&eacute;s s'op&egrave;re et qu'il devienne un effet boule de neige pour ceux qui auront bien voulu croire aux possibles donn&eacute;s par ces pages.<br /></p>" . "</div>" . "<div class='accueil-cell'><p style='font-variant:small-caps;font-size:large;text-align:right;'><b>BESANCON 25&nbsp;&nbsp;&nbsp;- le Pourquoi du Comment ?!?</b></p>" . "<hr /><p style='text-align:justify;font-size:small;'><span style='display:block;text-align:center;'><i>Pourquoi avoir fait cet annuaire ?</i></span>La premi&egrave;re et la moins couteuse de toutes les communications provient du web car, sur Internet, la culture du libre et du gratuit y est incrite depuis toujours dans les plus anciennes et charmantes m&eacute;moires de nos programmeurs. Aujourd'hui tout coute le moindre &euro;uros que la plupart des artistes n'ont la possibilit&eacute; de payer pour une communication qui ne leurs semblent pas famili&egrave;re ou n&eacute;cessaire. Cet annuaire est un lien gratuit pour toutes et ceux qui veulent avoir une place sur ce site.<br /><br /><span style='display:block;text-align:center;'><i>Comment participer ?</i></span>Il suffit de s'incrire via le bouton <a href='index.php?page=inscription'>Mon Compte</a> en haut du site puis de remplir vos noms, prenoms, pseudos, num&eacute;ro de t&eacute;l&eacute;phone, et adresse de courriel ainsi que la description de votre art pr&eacute;f&eacute;r&eacute; pour pourvoir appara&icirc;tre sur ce site. Attention tout compte mal-rempli ne sera pas valid&eacute; par l'administrateur...<br /></p>" . "</div>" . "</div>";
    }
}

function AfficheGueuloir()
{
    echo "<div class='cadreGueuloir gueuloir-cell'>";
    
    /**
     * *********************************************************************
     */
    /**
     * AFFICHAGE DU BANDEAU DE TITRE DE LA PLATE-FORME
     */
    
    echo " <p align='center' class='sous-titre'>Un sujet &agrave; traiter ?<br/>Une nouvelle &agrave; annoncer?</p>" . "<p align='center' class='titre'><b>Utilisez le gueuloir!</b></p>" . "<p align='right'><span id='gueuloirActualisation'><img src='images/gueuloir/publish.png' alt='Actualisation'></span></p>";
    
    /**
     * *********************************************************************
     */
    
    echo " <br />";
    
    /**
     * *********************************************************************
     */
    /**
     * AFFICHAGE DU JAVASCRIPT POUR L'ACTUALISATION
     */
    
    echo "<script language='javascript'>" . "
		function AJAXActualiserGueuloir(){
		var xhr = createXHR();
		xhr.onreadystatechange = function(){
			document.getElementById('gueuloirActualisation').innerHTML = '<img src=\'images/gueuloir/publish.png\' alt=\'Actualisation\'>';
			if(xhr.readyState == 4){
				if(xhr.status == 200){
					document.getElementById('Gueuloir').innerHTML = xhr.responseText;
					document.getElementById('gueuloirActualisation').innerHTML = '<img src=\'images/gueuloir/world.png\' alt=\'En Attente ...\'>';			
				}else{
					document.getElementById('gueuloirActualisation').innerHTML = '<img src=\'images/gueuloir/world.png\' alt=\'En Attente ...\'>';
				}
			}
		};
	
		xhr.open( 'GET' , 'controlleursAJAX/actualisationGueuloir.php', true);
		xhr.send(null); 
		}
		setInterval('AJAXActualiserGueuloir()',60000);
		" . "</script>";
    
    /**
     * *********************************************************************
     */
    /**
     * AFFICHAGE DE L'INTERFACE DE DIALOGUE
     */
    
    echo "<div id='Gueuloir'>";
    // affichage des anciens messages...
    $sql = "SELECT * FROM Tchat ORDER BY id_dialogue DESC LIMIT 100";
    $req_dialogue = faireUneRequeteOffline($sql);
    $i = 0;
    while ($dialogue = exploiterLigneResultatBDD($req_dialogue)) {
        echo "<li style='list-style-type:none;'";
        if ($dialogue['valide'] == 1) {
            echo "<ul><B>" . $dialogue['date'] . ": </B>&nbsp;&nbsp;";
            echo $dialogue['corpsDuTexte'] . "</ul>";
            if ($i > 20)
                break;
            ++$i;
        }
        echo "</li>";
    }
    echo "</div>";
    /**
     * *********************************************************************
     */
    
    echo "<br /><br /><br />";
    
    /**
     * *********************************************************************
     */
    echo "</div><div class='cadreGueuloir'>";
    /**
     * formulaire d'envoi de messages...
     */
    echo "<span id='formEnvoiGueuloir'>";
    
    echo "<form action='controlleurs/traitementDialogue.php' method='POST'>" . "<center>" . "<a name='gueuloir'>" . "<p align='center' class='titre'>Fa&icirc;tes-nous part de vos bon-plans !" . "<br /><br />Ou mettez-les sur le " . "<a href='" . PAGEB25NET . "'>.NET-&eacute;v&egrave;nementiel</a>" . " ou le <a href='" . PAGEB25COM . "'>.COM-petitesAnnonces</a></p>" . "<p align='center' class='sous-titre'> Ou pas !</p>" . "::: <input type='text' name='corpsDuTexte' size='25' /> ::: " . "<input type='submit' value='Parler' /></a></center>" . "</form>";
    echo "</span>";
    
    /**
     * *********************************************************************
     */
    echo "<br /><br /><br />";
    
    echo "</div>";
}

function AfficheDernierArticle()
{
    echo "<table border='0' align='center'>" . "<tr>";
    $req_articles = recuperationDernierArticle();
    while ($article = exploiterLigneResultatBDD($req_articles)) {
        AjouterLectureArticleAfficher($article['id_article']);
        echo "<td valign='top' align='center' class='article' >" . "<img src='images/articles/" . $article['image'] . "' width='200px' height='500px'>" . "<hr/><p align='left' class='titre'>" . check_ChaineDeCaracteresDownload($article['titre']) . "</p><hr/>" . "<p align='center' class='article'>" . check_ChaineDeCaracteresDownload($article['corps']) . "</p><hr/>" . "<p align='right' class='article'>Id&eacute;ologie:&nbsp;&nbsp;" . recuperationIdeologie($article['id_ideologie']) . "</p>" . "<p align='right' class='article'>Th&ecirc;me:&nbsp;&nbsp;" . recuperationTheme($article['id_theme']) . "</p>" . "<p align='right' class='date'>" . $article['date'] . "</p>" . "<p align='right' class='article'><a href='index.php?page=reactionArticle&id=" . $article['id_article'] . "'>" . calculNbCommentairesArticle($article['id_article']) . " commentaire(s) <img src='images/commentaires.gif' width='15px' heigth='15px'></a></p>" . "<p align='right' class='post'>Auteur:&nbsp;&nbsp;" . recuperationAuteur($article['id_utilisateur']) . "</p>";
        if (isset($_SESSION['type_compte'])) {
            if ($_SESSION['type_compte'] == '0') {
                echo "<p> Lu " . AfficheNbLectureArticle($article['id_article']) . " fois...</p> " . "<p> Selectionn&eacute; " . AfficheNbClicksArticle($article['id_article']) . " fois pour commentaires.</p>" . "<p> Visit&eacute; par " . AfficheNbVisitesUniqueArticle($article['id_article']) . " Poste(s)/IP(s) diff&eacute;rent(e)s ...</p>";
                echo "<form method='get' action='controlleurs/traitementSuppressionArticle.php'>" . "<input type='hidden' name='id' value='" . $article['id_article'] . "'/><input type='submit' value='Supprimer'/>" . "</form>";
                echo "<a href='index.php?page=correctionArticle&id=" . $article['id_article'] . "'>Corriger La(Les) faute(s)</a>";
            } else {
                if ($_SESSION['id_utilisateur'] == $article['id_utilisateur']) {
                    echo "<p> Lu " . AfficheNbLectureArticle($article['id_article']) . " fois...</p> " . "<p> Selectionn&eacute; " . AfficheNbClicksArticle($article['id_article']) . " fois pour commentaires.</p>";
                    echo "<form method='get' action='controlleurs/traitementSuppressionArticle.php'>" . "<input type='hidden' name='id' value='" . $article['id_article'] . "'/><input type='submit' value='Supprimer'/>" . "</form>";
                    echo "<a href='index.php?page=correctionArticle&id=" . $article['id_article'] . "'>Corriger La(Les) faute(s)</a>";
                }
            }
        }
        
        echo "</td>";
    }
    echo "</tr></table>";
}

