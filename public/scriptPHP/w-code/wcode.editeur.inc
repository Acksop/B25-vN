
<div class="wcode_editeur">
	<table>
		<tr>
			<td width="700"></td>
			<td width="350"></td>
		</tr>
		<tr class="outils">
			<td><a href="#"
				onclick="wcode_encadrer('%%FORMULAIRE%%','%%CHAMP%%','g','');"><img
					alt="" src="scriptPHP/w-code/wcode_images/bouton_g.gif" border="0"
					title="Gras" /></a> <a href="#"
				onclick="wcode_encadrer('%%FORMULAIRE%%','%%CHAMP%%','i','');"><img
					alt="" src="scriptPHP/w-code/wcode_images/bouton_i.gif" border="0"
					title="Italique" /></a> <a href="#"
				onclick="wcode_encadrer('%%FORMULAIRE%%','%%CHAMP%%','s','');"><img
					alt="" src="scriptPHP/w-code/wcode_images/bouton_s.gif" border="0"
					title="Soulign�" /></a> <img
				src="scriptPHP/w-code/wcode_images/separation.gif" alt="" /> <a
				href="#"
				onclick="wcode_encadrer('%%FORMULAIRE%%','%%CHAMP%%','fluo','');"><img
					alt="" src="scriptPHP/w-code/wcode_images/bouton_fluo.gif"
					border="0" title="Fluo" /></a> <a href="#"
				onclick="wcode_panneau('couleur');"><img alt=""
					src="scriptPHP/w-code/wcode_images/bouton_couleur.gif" border="0"
					title="Changer la couleur" /></a> <a href="#"
				onclick="wcode_panneau('taille');"><img alt=""
					src="scriptPHP/w-code/wcode_images/bouton_taille.gif" border="0"
					title="Changer la taille" /></a> <img
				src="scriptPHP/w-code/wcode_images/separation.gif" alt="" /> <a
				href="#" onclick="wcode_lien('%%FORMULAIRE%%','%%CHAMP%%');"><img
					alt="" src="scriptPHP/w-code/wcode_images/bouton_lien.gif"
					border="0" title="Lien" /></a> <a href="#"
				onclick="wcode_email('%%FORMULAIRE%%','%%CHAMP%%');"><img alt=""
					src="scriptPHP/w-code/wcode_images/bouton_email.gif" border="0"
					title="E-mail" /></a> <img
				src="scriptPHP/w-code/wcode_images/separation.gif" alt="" /> <a
				href="#" onclick="wcode_image();"><img alt=""
					src="scriptPHP/w-code/wcode_images/bouton_image.gif" border="0"
					title="Image" /></a> <img
				src="scriptPHP/w-code/wcode_images/separation.gif" alt="" /> <a
				href="#" onclick="wcode_mp3();"><img alt=""
					src="scriptPHP/w-code/wcode_images/bouton_mp3.gif" border="1"
					title="Extraits Musicaux" /></a> <img
				src="scriptPHP/w-code/wcode_images/separation.gif" alt="" /> <a
				href="#" onclick="wcode_video();"><img alt=""
					src="scriptPHP/w-code/wcode_images/bouton_video.gif" border="1"
					title="Extraits Vid�os" /></a> <img
				src="scriptPHP/w-code/wcode_images/separation.gif" alt="" /> <a
				href="#" onclick="wcode_afficher_aide();"><img alt=""
					src="scriptPHP/w-code/wcode_images/aide.gif" border="0"
					title="Afficher l'aide" /></a> <a href="#"
				onclick="wcode_encadrer('%%FORMULAIRE%%','%%CHAMP%%','aligner','gauche');"><img
					alt="" src="scriptPHP/w-code/wcode_images/bouton_gauche.gif"
					border="0" title="Aligner � gauche" /></a> <a href="#"
				onclick="wcode_encadrer('%%FORMULAIRE%%','%%CHAMP%%','aligner','centre');"><img
					alt="" src="scriptPHP/w-code/wcode_images/bouton_centre.gif"
					border="0" title="Aligner au centre" /></a> <a href="#"
				onclick="wcode_encadrer('%%FORMULAIRE%%','%%CHAMP%%','aligner','droite');"><img
					alt="" src="scriptPHP/w-code/wcode_images/bouton_droite.gif"
					border="0" title="Aligner � droite" /></a> <a href="#"
				onclick="wcode_encadrer('%%FORMULAIRE%%','%%CHAMP%%','aligner','justifier');"><img
					alt="" src="scriptPHP/w-code/wcode_images/bouton_justifier.gif"
					border="0" title="Justifier" /></a> <img
				src="scriptPHP/w-code/wcode_images/separation.gif" alt="" /> <a
				href="#"
				onclick="wcode_encadrer('%%FORMULAIRE%%','%%CHAMP%%','exposant','');"><img
					alt="" src="scriptPHP/w-code/wcode_images/bouton_exposant.gif"
					border="0" title="Exposant" /></a> <a href="#"
				onclick="wcode_encadrer('%%FORMULAIRE%%','%%CHAMP%%','indice','');"><img
					alt="" src="scriptPHP/w-code/wcode_images/bouton_indice.gif"
					border="0" title="Indice" /></a> <img
				src="scriptPHP/w-code/wcode_images/separation.gif" alt="" /> <a
				href="#" onclick="wcode_panneau('liste');"><img alt=""
					src="scriptPHP/w-code/wcode_images/bouton_liste.gif" border="0"
					title="Liste" /></a> <a href="#"
				onclick="wcode_inserer('%%FORMULAIRE%%','%%CHAMP%%','[hr]');"><img
					alt="" src="scriptPHP/w-code/wcode_images/bouton_hr.gif" border="0"
					title="Barre Horizontale" /></a></td>
			<td rowspan="2" valign="top">%%PANNEAUX%% &nbsp;</td>
		</tr>
		<tr class="outils">
			<td height="500"><textarea style='width: 95%; height: 95%' rows="500"
					cols="500" name="%%CHAMP%%" id="wcode_champ"
					onchange="wcode_reloadapercu()">%%VALEUR%%</textarea></td>
		</tr>
	</table>

</div>
<script type="text/javascript">
 wcode_tout_masquer();
 </script>
