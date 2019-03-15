<?php
echo "<script src='scriptJS/afficherCacherDIV.js' type='text/javascript'></script>";

$req_descriptif = recuperationDescriptifArtisans($id_artiste);
$descriptif = exploiterLigneResultatBDD($req_descriptif);
$articles = recuperationArticlesArtisans($_SESSION['id_utilisateur']);
$article = array(
    'id_article' => '',
    'image' => '',
    'libelle' => '',
    'description' => '',
    'prix' => ''
);

// --Visibilit� de la page personnelle de l'association

echo "<div class='conteneurGrand'>" . "<h2 class='legende'>Propri&eacute;t&eacute;s de la page publique :</h2><br /><br />";
echo "<table border='0' width='100%'><tr valign='middle'><td class='titreTableau'>";
echo "VISIBILIT&Eacute;E DE LA PAGE PUBLIQUE:</td>";
echo "<td class='utilisateurs'>";
if ($artiste['voir_tweets'] == 0) {
    echo "Priv&eacute;e";
} else {
    echo "Publique";
}
echo "</td><td class='utilisateurs'>" . "<form name='modifInfoArtisans' method='post' action='controlleurs/traitementModifInfoArtiste.php'>" . "<input type='hidden' name='voir_tweets' value='" . $artiste['voir_tweets'] . "'/>" . "<button type='submit' class='btn_modif'><img src='./images/picto-modifierCircle_up.gif' onMouseOut='this.src=btn_modif_up;' onMouseDown='this.src=btn_modif_down;' onMouseOver='this.src=btn_modif_hover;' alt='Changer?' /></button>" . "</form>";
echo "</td></tr></table></div><br />";

// --- LE LOGO - Début
echo "<a name='ancre_logo'></a>";
echo "<script language='javascript'>" . "
	function AfficheBanniereDL(){
		cacherDIV('ajoutLOGO');
		afficherDIV('BanDL');
	}
	function AfficheFormLOGO(){
		cacherDIV('assocLOGO');
		cacherDIV('btn_modifierLOGO');
		afficherDIV('ajoutLOGO');
	}
	function AfficheLogo(){
		cacherDIV('ajoutLOGO');
		afficherDIV('assocLOGO');
		afficherDIV('btn_modifierLOGO');
	}
	btn_modif_down = new Image();
	btn_modif_down = 'images/picto-modifier_down.gif';
	btn_modif_up = new Image();
	btn_modif_up = 'images/picto-modifier_up.gif';
	btn_modif_hover = new Image();
	btn_modif_hover = 'images/picto-modifier_hover.gif';
	btn_suppr_down = new Image();
	btn_suppr_down = 'images/picto-supprimer_down.gif';
	btn_suppr_up = new Image();
	btn_suppr_up = 'images/picto-supprimer_up.gif';
	btn_suppr_hover = new Image();
	btn_suppr_hover = 'images/picto-supprimer_hover.gif';
	
	</script>
	";
echo "<div class='conteneurGrand'>" . "<h2 class='legende'>Logo-Type" . "<div id='btn_modifierLOGO' class='btn' style='float:left;'  onClick='AfficheFormLOGO();'><img id='btn' style='float:left;' src='images/picto-modifier_up.gif' onMouseOver='javascript:this.src=btn_modif_hover;' onMouseOut='javascript:this.src=btn_modif_up;' onMouseDown='javascript:this.src=btn_modif_down;'></div>" . "</h2><br />";
echo "<div class='conteneurGrandInterieur' id='ajoutLOGO' ";
if ($descriptif['logo'] != '') {
    echo "style='display:none;'><h3 class='legende'> Changer de LogoType:</h3>";
} else {
    echo "><h3 class='legende'> Ajouter le logo:</h3>";
}
echo "<form enctype='multipart/form-data' action='controlleurs/traitementArtisansAjoutLOGO.php' method='POST'>" . "<input type='hidden' name='MAX_FILE_SIZE' value='2097152'/>" . "<input type='file' size='20' name='Image' class='tweet' />(max 2Mo)" . "<br/>" . "<span style='float:right;'>";
if ($descriptif['logo'] != '') {
    echo "<input type='submit' value='Modifier' class='tweet' onClick='AfficheBanniereDL()'/>" . "&nbsp;" . "<input type='button' value='[Annuler]' class='tweetReset' onClick='AfficheLogo()' />";
} else {
    echo "<input type='submit' value='Ajouter' class='tweet' onClick='AfficheBanniereDL()'/>";
}
echo "</span>" . "<input type='hidden' name='id_utilisateur' value='" . $_SESSION['id_utilisateur'] . "'/>" . "<input type='hidden' name='type' value='" . $_SESSION['type_compte'] . "'/>" . "</form>" . "</div>" . "<div id='BanDL' style='background: gray; display:none;'><img src='images/upload.gif' height='120px' width='500px' alt='banniere de telechargements'/></div>";
if ($descriptif['logo'] != '') {
    echo "<div id='assocLOGO' class='conteneurGrandInterieur'><img src='" . RADIEURAE_SVN_PATH . $descriptif['logo'] . "' alt='{$artiste['pseudo']}'/></div>";
}
echo "</div>";
// -- LE LOGO - Fin

echo "<br /><br />";

// -- LA DESCRIPTION - Début
echo "<a name='ancre_descriptif'></a>";
ecrireScriptJSTinyMCE();
echo "<script language='javascript'>" . "
	function AfficheFormDescriptif(){
		cacherDIV('descriptifAsso');
		cacherDIV('btn_descriptif');
		afficherDIV('ajoutDescriptif');
	}
	function AfficheDescriptif(){
		cacherDIV('ajoutDescriptif');
		afficherDIV('descriptifAsso');
		afficherDIV('btn_descriptif');
	}				
	</script>
	";

if ($descriptif['descriptif'] == '') {
    $drapeauAjout = TRUE;
    $descriptif_artisans = "";
} else {
    $descriptif_artisans = check_ChaineDeCaracteresDownload($descriptif['descriptif']);
    $drapeauAjout = FALSE;
}
echo "<div class='conteneurGrand'>" . "<h2 class='legende'>Descriptif / Mission" . "<div id='btn_descriptif' class='btn' style='float:left;' onClick='AfficheFormDescriptif();'><img alt='Changer descriptif?' style='float:left;' src='images/picto-modifier_up.gif' onMouseOver='javascript:this.src=btn_modif_hover;' onMouseOut='javascript:this.src=btn_modif_up;' onMouseDown='javascript:this.src=btn_modif_down;'></div>" . "</h2><br />";

echo "<div id='ajoutDescriptif' class='conteneurGrandInterieur' ";
if ($drapeauAjout) {
    echo ">";
    echo "<h3 class='legende'>Ajouter un descriptif:</h3>";
} else {
    echo " style='display:none;'>";
    echo "<h3 class='legende'>Modifier le descriptif:</h3>";
}
echo "<form method='post' action='controlleurs/traitementArtisansAjoutDescriptif.php'>";
echo "<!-- Gets replaced with TinyMCE, remember HTML in a textarea should be encoded -->" . "<textarea id='elm1' name='elm1' style='width: 100%; height: 400px;'>" . $descriptif_artisans . "</textarea>" . "<br/>" . "<span style='float:right;'>";
if ($drapeauAjout) {
    echo "<input type='submit' name='save' class='tweet' value='[Valider]' />";
} else {
    echo "<input type='submit' name='save' class='tweet' value='[Modifier]' />" . "&nbsp;" . "<input type='button' value='[Annuler]' class='tweetReset' onClick='AfficheDescriptif()' />";
}
echo "</span></form>" . "</div>";
if (! $drapeauAjout) {
    echo "<div id='descriptifAsso' class='utilisateurs' style='padding:10px;margin:10px;'>{$descriptif_artisans}</div>";
}
echo "</div>";

// -- LA DESCRIPTION - Fin

echo "<br /><br /><br /><br />";

// --- LES ARTICLES - D�but

echo "<script type='text/javascript'>" . "
		function AfficheBanniereDL_ARTICLE(num){
			var DIV1 = 'ajoutARTICLE_' + num;
			var DIV2 = 'BanDL_ARTICLE_' + num;
			cacherDIV(DIV1);
			afficherDIV(DIV2);
		}
		function AfficheFormARTICLE(num){
			var DIV1 = 'article_' + num;
			var DIV2 = 'btn_modifierArticle_' + num;
			var DIV3 = 'ajoutARTICLE_' + num; 
			cacherDIV(DIV1);
			cacherDIV(DIV2);
			afficherDIV(DIV3);
		}
		function AfficheARTICLE(num){
			var DIV1 = 'article_' + num;
			var DIV2 = 'btn_modifierArticle_' + num;
			var DIV3 = 'ajoutARTICLE_' + num;
			cacherDIV(DIV3);
			afficherDIV(DIV1);
			afficherDIV(DIV2);
		}
		</script>
		";
// Boucle pour la cr�ation et l'affichage des articles de l'artisans
$i = 0;
echo "<a name='ancre_articles'></a>";
echo "<div class='conteneurGrandArticle'>";
do {
    $j = $i % 3;
    if ($j == 0) {
        echo "<div class='conteneurLigneArticle'>";
    }
    echo "<div class='conteneurArticle'>" . "<a name='ancre_article_{$article['id_article']}'></a>" . "<h2 class='legende'>";
    if ($i == 0) {
        echo "Mes Articles";
    } else {
        echo "Article n&deg;{$i}";
        echo "<div id='btn_modifierARTICLE_{$article['id_article']}' class='btn' style='float:left;'  onClick='AfficheFormARTICLE({$article['id_article']});'><img id='btn' style='float:left;' src='images/picto-modifier_up.gif' onMouseOver='javascript:this.src=btn_modif_hover;' onMouseOut='javascript:this.src=btn_modif_up;' onMouseDown='javascript:this.src=btn_modif_down;'></div>";
    }
    echo "</h2><br />";
    echo "<div class='conteneurArticleInterieur' id='ajoutARTICLE_{$article['id_article']}' ";
    if ($article['image'] != '') {
        echo "style='display:none;'><h3 class='legende'> Modifier l'Article:</h3>";
    } else {
        if ($i == 0) {
            echo "><h3 class='legende'> Ajouter Un Article:</h3>";
        } else {
            echo "><h3 class='legende'> Modifier l'Article:</h3>";
        }
    }
    echo "<form enctype='multipart/form-data' action='controlleurs/traitementArtisansAjoutArticle.php' method='POST'>" . "<p class='post' style='float:right;'>(max 10Mo)</p><p class='titre'>Photo de l'article :<br />" . "<input type='hidden' name='MAX_FILE_SIZE' value='10485760'/>" . "<input type='file' size='13' name='image' class='tweet' />" . "<p class='titre' style='width: 250px;'>Etiquette de l'Article: " . "<input type='text' size='25' name='libelle' class='tweet' value='{$article['libelle']}'/>" . "</p>" . "<p class='titre'>Description:<center>" . "<textarea rows='6' cols='25' name='description' class='tweet' />" . $article['description'] . "</textarea></center></p>" . "<p class='titre' style='float:right;'>Prix:" . "<span style='float:right;'><input type='text' size='20' name='prix' class='tweet' style='width:50px;' value='{$article['prix']}'/>" . "&#128;</span></p><br /><br /><br />" . "<span style='clear:right; float:right;'>";
    if ($article['image'] != '') {
        echo "<input type='submit' value='Modifier' class='tweet' onClick='AfficheBanniereDL_ARTICLE({$article['id_article']})'/>" . "&nbsp;" . "<input type='button' value='[Annuler]' class='tweetReset' onClick='AfficheARTICLE({$article['id_article']})' />";
    } else {
        echo "<input type='submit' value='Ajouter' class='tweet' onClick='AfficheBanniereDL_ARTICLE({$article['id_article']})'/>";
    }
    echo "</span>" . "<input type='hidden' name='id_utilisateur' value='" . $_SESSION['id_utilisateur'] . "'/>" . "<input type='hidden' name='id_article' value='" . $article['id_article'] . "'/>" . "<input type='hidden' name='type' value='" . $_SESSION['type_compte'] . "'/>" . "</form>";
    if ($article['libelle'] != '' || $article['description'] != '' || $article['prix'] != '' || $article['image'] != '') {
        echo "<form action='controlleurs/traitementSuppressionArticleArtisans.php' method='POST'>" . "<input type hidden name='id_article' value='{$article['id_article']}' />" . "&nbsp;" . "<input type='submit' value='Supprimer' class='tweet' />" . "</form>";
    }
    echo "</div>" . "<div id='BanDL_ARTICLE_{$article['id_article']}' style='background: gray; display:none;'><img src='images/upload.gif' height='120px' width='500px' alt='banniere de telechargements'/></div>";
    if ($article['image'] != '') {
        echo "<div id='article_{$article['id_article']}' class='conteneurArticleInterieur'><center><img src='" . RADIEURAE_SVN_PATH . $article['image'] . "' alt='{$article['libelle']}'/><p class='titre' align='center'>{$article['libelle']}</p><p class='article'>{$article['description']}</p><p class='titre' style='float:right;'>{$article['prix']}&nbsp;&#128;</p><br /><br /><br /></center></div>";
    }
    echo "</div>";
    if ($j == 2) {
        echo "</div>";
    }
    $i ++;
} while ($article = exploiterLigneResultatBDD($articles));
if ($j !== 2) {
    echo "</div>";
}
echo "</div>";
//-- LES ARTICLES - Fin