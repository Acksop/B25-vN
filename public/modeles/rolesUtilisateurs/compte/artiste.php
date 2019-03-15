<?php
echo "<a name='ancre_tweet'/>";
echo "<div class='conteneurGrand'>" . "<h2 class='legende'>Personnalit&eacute;e de l'Artiste :</h2><br/>";

AfficherFormulaireDeTweet();

echo "<div class='conteneurGrandInterieur'>" . "<h3 class='legende'>Propri&eacute;t&eacute;s de la page personnelle :<h3>";
echo "<table border='0' width='100%'><tr valign='middle'><td class='titreTableau'>";
echo "VISIBILIT&Eacute;E DE LA PAGE PERSONNELLE:</td>";
echo "<td class='utilisateurs'>";
if ($artiste['voir_tweets'] == 0) {
    echo "Priv&eacute;e";
} else {
    echo "Publique";
}
echo "</td><td class='utilisateurs'>" . "<form name='modifInfoArtiste' method='post' action='controlleurs/traitementModifInfoArtiste.php'>" . "<input type='hidden' name='voir_tweets' value='" . $artiste['voir_tweets'] . "'/>" . "<button type='submit' class='btn_modif'><img src='./images/picto-modifierCircle_up.gif' onMouseOut='this.src=btn_modif_up;' onMouseDown='this.src=btn_modif_down;' onMouseOver='this.src=btn_modif_hover;' alt='Changer?' /></button>" . "</form>";
echo "</td></tr><tr><td class='titreTableau'>";
echo "TYPE D'AFFICHAGE DE LA PAGE PERSONNELLE:</td>";
echo "<td class='utilisateurs'>";
if ($artiste['affichage_tweets'] == 0) {
    echo "Mur de billets ( Mesure&Ocirc;M&egrave;tre )";
} else {
    echo "Tableau des derniers billets ( Tablo&icirc;d )";
}
echo "</td><td class='utilisateurs'>" . "<form name='modifInfoArtiste' method='post' action='controlleurs/traitementModifInfoArtiste.php'>" . "<input type='hidden' name='affichage_tweets' value='" . $artiste['affichage_tweets'] . "'/>" . "<button type='submit' class='btn_modif'><img src='./images/picto-modifierCircle_up.gif' class='btn' onClick='submit();' onMouseOut='this.src=btn_modif_up;' onMouseDown='this.src=btn_modif_down;' onMouseOver='this.src=btn_modif_hover;' alt='Changer?' /></button>" . "</form>";
echo "</td></tr></table></div></div>";