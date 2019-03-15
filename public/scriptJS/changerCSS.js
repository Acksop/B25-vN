function changerInterFace(type,version){
	document.getElementById("interface").href = "stylesCSS/v2."+version+"/interface"+type+".css";
	document.getElementById("menu").href = "stylesCSS/v2."+version+"/menu"+type+".css";
	
	var menuEmpiler;
	menuEmpiler = getCookie('statusMenu');

	var dtExpire = new Date();
 	dtExpire.setTime(dtExpire.getTime() + 3600*1000);
 	
 	var choixPreferenceActif;
 	choixPreferenceActif = getCookie('ChoixPreferenceActif');
 	
	if( choixPreferenceActif != 1 ){
		setCookie('ChoixPreferenceActif', '1', dtExpire, '/' );
	}
	
	var ancienneInterface;
	ancienneInterface = getCookie('ChoixAncienneInterface');
	
	if( ancienneInterface == null ){
		ancienneInterface = getCookie('interfaceIHM');	
	}
	
	if(version == '2'){		
		//Quelle est l'interface qui va apparaitre
		if( type >= 10 ){
			//selon le type evolu� de l'interface pr�cedente on fait quoi ?
			if(ancienneInterface >= 10 ){
				//selon si le menu est empiler ou non on fait quoi ?
				if( menuEmpiler == 0 ) {
				
				}else{
					document.getElementById("interfaceMenu").href = "stylesCSS/v2."+version+"/interface"+type+"_menuEmpiler.css";
				}
			}else{
				if( menuEmpiler == 0 ) {
					afficherDIV('btn_empilerMenu');
					//suivant si ce n'est pas la premi�re fois que l'on teste une interface diff�rente, on fait quoi ?
					if(choixPreferenceActif == 1){
					
					}else{
					
					}
				}else{
					afficherDIV('btn_depilerMenu');
					var CSS_menuEmpiler;
					CSS_menuEmpiler = document.createElement("link");
					CSS_menuEmpiler.id = "interfaceMenu";
					CSS_menuEmpiler.type = "text/css";
					CSS_menuEmpiler.rel = "stylesheet";
					CSS_menuEmpiler.href = "stylesCSS/v2."+version+"/interface"+type+"_menuEmpiler.css";
					CSS_menuEmpiler = document.head.appendChild( CSS_menuEmpiler );
					if(choixPreferenceActif == 1){
					
					}else{
					
					}
				}
			}
		}else if( type < 10 ){
			if( ancienneInterface >= 10 ){
				var CSS_menuEmpiler;
				CSS_menuEmpiler = document.getElementById("interfaceMenu");
				if( CSS_menuEmpiler != null ){
					document.head.removeChild( CSS_menuEmpiler ) ;
				}
				if( menuEmpiler == 0 ){
					cacherDIV('btn_depilerMenu');
					cacherDIV('btn_empilerMenu');
				}else{
					cacherDIV('btn_depilerMenu');
					cacherDIV('btn_empilerMenu');
				}
			}else{	
				if( menuEmpiler == 0 ) {
					if(choixPreferenceActif == 1){
					
					}else{
					
					}
				}else if ( menuEmpiler == 1 ){
					var CSS_menuEmpiler;
					CSS_menuEmpiler = document.getElementById("interfaceMenu");
					if( CSS_menuEmpiler != null ){
						document.head.removeChild( CSS_menuEmpiler ) ;
					}
				}
			}
		}
	}
	setCookie('ChoixAncienneInterface', type , dtExpire, '/' );
	//on affiche le gueuloir ou pas
	if(ancienneInterface >= 10 || ancienneInterface == 6 || ancienneInterface == 9){
		if(type >= 10 || type == 6 || type == 9){
			if( (ancienneInterface == 9 || ancienneInterface == 11) && (type == 10 || type == 6 || type == 12) ){
				cacherDIV('permanent-gueuloir-gauche');
				afficherDIV('permanent-gueuloir-droite');
			}else{
				cacherDIV('permanent-gueuloir-droite');
				afficherDIV('permanent-gueuloir-gauche');
			}
			//nothing
		}else{
			if( ancienneInterface == 9 || ancienneInterface == 11){
				cacherDIV('permanent-gueuloir-gauche');
			}else{
				cacherDIV('permanent-gueuloir-droite');
			}
		}
	}else{
		if(type >= 10 || type == 6 || type == 9){
			if(type == 11 || type == 9){
				afficherDIV('permanent-gueuloir-gauche');
			}else{
				afficherDIV('permanent-gueuloir-droite');
			}
		}else{
			//nothing
		}
	}
}
function changerTypographie(type){
	document.getElementById("typographie").href = "stylesCSS/typographie"+type+".css";
}
function changerTailleTexte(taille){
	document.getElementById("lecture").href = "stylesCSS/lecture0"+taille+".css";
}
function changerVersion(police,ihm,taille,version){

		document.getElementById("couleur").href = "stylesCSS/v"+version+"/couleur.css";
		document.getElementById("lecture").href = "stylesCSS/lecture0"+taille+".css";
		document.getElementById("typographie").href = "stylesCSS/typographie"+police+".css";
		document.getElementById("interface").href = "stylesCSS/v"+version+"/interface"+ihm+".css";
		document.getElementById("menu").href = "stylesCSS/v"+version+"/menu"+ihm+".css";
}
function changerCouleurFondMenu(hex_couleur){
	document.getElementById("limiteur").style = "background-color: "+hex_couleur+";";
}
function changerImageFondMenu(int_saison){
	switch(int_saison){
	case '0':
		document.getElementById("AnimFond").src = 'images/animations/printemps-5.gif';
	break;
	case '1':
		document.getElementById("AnimFond").src = 'images/animation/nuages-01.gif';
	break;
	case '2':
		document.getElementById("AnimFond").src = 'images/animations/img_calm_09.gif';
	break;
	case '3':
		document.getElementById("AnimFond").src = 'images/animations/vid08sec.gif';
	break;
	case '4':
		document.getElementById("AnimFond").src = 'images/animations/brouillard-2.gif';
	break;
	case '5':
		document.getElementById("AnimFond").src = 'images/animations/photo-708.gif';
	break;
	case '6':
		document.getElementById("AnimFond").src = 'images/animations/nuit-2.gif';
	break;
	case '7':
		document.getElementById("AnimFond").src = 'images/animations/vid-lesfeuilles1.gif';
	break;
	default:
		document.getElementById("AnimFond").src = 'images/animations/vid01sec.gif';
	}
	var dtExpire = new Date();
 	dtExpire.setTime(dtExpire.getTime() + 3600*1000);
	setCookie('bandeauAnim', int_saison , dtExpire, '/' );
}
