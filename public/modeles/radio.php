<?php
global $header_title, $header_description, $header_identifier_url, $header_keywords;
$header_title = "Besançon 25 - Lesradios connectées sur la Plate-forme";
$header_description = "Les différentes radios du Besançon 25 ";
$header_identifier_url = "besancon25.fr/radio";
$header_keywords = "Besan&ccedil;on, Besancon, 25000, 25, preferences, preferences, IHM, Interface Homme Machine, affichage, graphisme";

function LancerAffichageDuCorps()
{
    ?>
<script type='text/javascript'>
	function open_radio_pop_up(){
	 var Option = 'width=460,height=160,scrollbars=no';
	 FenetreChoix = window.open("lecteurMp3/xspf_nomad/pop_up.html","Les Radios Fran&ccedil;aises sur une Pop-Up du (B25)",Option);
	}
	btn_Radio_PopUp_down = new Image();
	btn_Radio_PopUp_down = 'images/picto-popUp_Radios_down.png';
	btn_Radio_PopUp_up = new Image();
	btn_Radio_PopUp_up = 'images/picto-popUp_Radios.png';
	btn_Radio_PopUp_hover = new Image();
	btn_Radio_PopUp_hover = 'images/picto-popUp_Radios_hover.png';

	</script>
<?php
    
    // etat des premiers script pour une intégration avec le lecteur Windows Media Player
    
    /*
     * echo "<a href='http://www.linuxpedia.fr/doku.php/flux_radio'> Liste des flux radio a int�grer...</a>
     *
     * <object id='mediaplayer'
     * classid='clsid:6bf52a52-394a-11d3-b153-00c04f79faa6'
     * type='application/x-oleobject' width='597' height='59'>
     * <param name='url' value='http://gisv3.tv-radio.com/station/france_bleu_besancon_mp3/france_bleu_besancon_mp3-32k.m3u' />
     * <param name='autostart' value='1' />
     * <param name='showcontrols' value='1' />
     * <param name='stretchtofit' value='0' />
     * <param name='enablecontextmenu' value='0' />
     * <param name='ShowStatusBar' value='1'>
     * <embed
     * src='http://gisv3.tv-radio.com/station/france_bleu_besancon_mp3/france_bleu_besancon_mp3-32k.m3u' width='250'
     * height='250'
     * autostart='1' type='application/x-mplayer2'
     * pluginspage='http://www.microsoft.com/Windows/MediaPlayer/'
     * transparentatstart='0'
     * animationatstart='0'
     * showcontrols='1'
     * autosize='0'
     * displaysize='0'
     * showtracker='0'
     * ShowStatusBar='1'></embed>
     * </object>
     *
     * <br />";
     */
    ?>
<center>
	<a href="#" onclick="open_radio_pop_up();"><img
		src='images/picto-popUp_Radios.png' height='100' width='100'
		onMouseOver='this.src=btn_Radio_PopUp_down'
		onMouseOut='this.src=btn_Radio_PopUp_up'
		onMouseDown='this.src=btn_Radio_PopUp_hover'></a> <br />
	<br />
	<embed src="lecteurMp3/xspf_nomad/player.swf" bgcolor="0x000000"
		allowscriptaccess="always" allowfullscreen="true"
		flashvars="&amp;backcolor=0xFFFFFF&amp;frontcolor=0x000000&amp;lightcolor=0x000000&amp;playlist=right&amp;playlistfile=lecteurMp3/xspf_nomad/playlist.xml&amp;playlistsize=260&amp;plugins=viral-2d&amp;repeat=list&amp;screencolor=0x000000"
		height="515" width="600">

</center>
<?php
}
