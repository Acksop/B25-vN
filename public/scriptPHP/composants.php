<?php

function ecrireScriptJSTinyMCE(){

/************************************************************************************************/
/*	."<!-- Gets replaced with TinyMCE, remember HTML in a textarea should be encoded -->"	*/
/*	."<textarea id='elm1' name='elm1' rows='15' cols='80' style='width: 100%'>"		*/
/*	."</textarea>"										*/
/************************************************************************************************/

echo 	"	<!-- TinyMCE -->
	<script type='text/javascript' src='scriptPHP/tiny_mce/tiny_mce.js'></script>
	<script type='text/javascript'>
		tinyMCE.init({
			mode : 'textareas',
			theme : 'simple'
		});
	</script>
	<!-- /TinyMCE -->
	";
	return;
}

function ecrireScriptJSTinyMCEAdvanced(){

/************************************************************************************************/
/*	."<!-- Gets replaced with TinyMCE, remember HTML in a textarea should be encoded -->"	*/
/*	."<textarea id='elm1' name='elm1' rows='15' cols='80' style='width: 100%'>"		*/
/*	."</textarea>"										*/
/************************************************************************************************/

echo 	"	<!-- TinyMCE -->
	<script type='text/javascript' src='scriptPHP/tiny_mce/tiny_mce.js'></script>
	<script type='text/javascript'>
		tinyMCE.init({
			mode : 'textareas',
			theme : 'advanced',
	theme_advanced_buttons1 :'bold,italic,underline,|,justifyleft,justifycenter,justifyright,justifyfull,|,link,unlink,image,forecolor,formatselect,fontselect,fontsizeselect,removeformat',
			theme_advanced_buttons2 : 'bullist,numlist,|,outdent,indent,link,unlink,image,forecolor,backcolor,|,hr,removeformat,sub,sup,|,charmap,ltr,rtl',
			theme_advanced_buttons3 : ''
		});
	</script>
	<!-- /TinyMCE -->
	";
	return;
}

function ecrireScriptJSArtsMedia(){

/********************************************************************************/
/*	."<div id='Animation' style='font-size:8px;'>Initialisation...</div>"	*/
/********************************************************************************/

echo	"<!-- ArtsMedia -->
	<script type='text/javascript'>
		window.setInterval('AnimationTxt()', 1000);
		var compteur = 0;
		var caractere = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		var ecar = 0;
		function AnimationTxt() {
			compteur++;
			var chaine = '';
			for(i=1 ; i<=compteur ; i++){
				chaine += caractere.charAt(ecar);
				if(i%16==0){
					chaine += '<br>';
				}
			}
			if(compteur == 240){
				chaine = '';
				ecar++;
				ecar = ecar%26;
				compteur = 0;
				
			}
			if (document.getElementById){
				document.getElementById('Animation').innerHTML = chaine;
			}
		}		
	</script>
	<!-- /ArtsMedia -->
	";
	return;
}

function ecriceScriptJSNavigationSelect(){

echo	"<!-- Navigation par s&eacute;lection pour aper&ccedil;u de l'image de l'article -->
	<script type='text/javascript'>
		function naviguerApercu(composantSelect){
			var image = composantSelect.options[composantSelect.selectedIndex].value;
			if (image){
				var srcImage = 'images/articles/'+image;
				document.getElementById('apercu').src = srcImage;
			}
		}
	</script>
	<!-- /Navigation par s&eactue;lection pour aper&ccedil;u de l'image de l'article -->
	";
	return;
}

?>
