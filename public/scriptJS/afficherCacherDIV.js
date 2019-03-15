function selectionnerDIV(elem){
	if ( document.getElementById && document.getElementById( elem ) ){
		 Pdiv = document.getElementById( elem );
		 PcH = true;
	}
	    // Pour les veilles versions
	else if ( document.all && document.all[ elem ] ){
		Pdiv = document.all[ elem ];
		PcH = true;
	}
	    // Pour les très veilles versions
	else if ( document.layers && document.layers[ elem ] ){
		Pdiv = document.layers[ elem ];
		PcH = true;
	}
	else{
		PcH = false;
	}
	return Pdiv;
}
function afficherDIV(elem){
  Pdiv = selectionnerDIV(elem);
	Pdiv.style.display='block';
	return;
}
function cacherDIV(elem){
  Pdiv = selectionnerDIV(elem);
	Pdiv.style.display='none';
	return;
}

function ajouterTypeCSS( elem , attrib) {
  Pdiv = selectionnerDIV(elem);
	Pdiv.className += attrib ;
}
/*
 * Fonction permettant de rentrer le menu dans sa tanière 
 */

function empilerMenu(){
	cacherDIV('btn_empilerMenu');
	afficherDIV('btn_depilerMenu');
	
	interface = getCookie('interfaceIHM');
	if(interface == null){
		interface = 10;	
	}
	
	var CSS_menuEmpiler;
	CSS_menuEmpiler = document.createElement("link");
	CSS_menuEmpiler.id = "interfaceMenu";
	CSS_menuEmpiler.type = "text/css";
	CSS_menuEmpiler.rel = "stylesheet";
	CSS_menuEmpiler.href = "stylesCSS/v2/interface"+interface+"_menuEmpiler.css";
	CSS_menuEmpiler = document.head.appendChild( CSS_menuEmpiler );
	
	var dtExpire = new Date();
    dtExpire.setTime(dtExpire.getTime() + 3600*1000);
   
    leCookie = getCookie('CookieApp_CO_LeCookie');
   
    if(leCookie != null && leCookie == 1){
	   setCookie('statusMenu', '1', dtExpire, '/' );
    }

    B25_justCharged = getCookie('B25_landingPage');
   
    if(B25_justCharged == 0){
		  if (window.removeEventListener) {
		      window.removeEventListener("scroll", empilerAutomatiquementMenu, false);
		  } else if (window.detachEvent) {
			  window.detachEvent("scroll", empilerAutomatiquementMenu);
	   	  } else {
	   		  window.onscroll = '';
		  }
    }
  
	if(leCookie != null && leCookie == 1){
		setCookie('B25_landingPage', '1', dtExpire, '/' );
	}
   
}
/*
 * Fonction permettant de rentrer le menu dans sa tanière de façon
 * Automatique en HTML5
 */

function empilerAutomatiquementMenu(){
	cacherDIV('btn_empilerMenu');
	afficherDIV('btn_depilerMenu');
	
	interface = getCookie('interfaceIHM');
	if(interface == null){
		interface = 10;	
	}
	
	var CSS_menuEmpiler;
	CSS_menuEmpiler = document.createElement("link");
	CSS_menuEmpiler.id = "interfaceMenu";
	CSS_menuEmpiler.type = "text/css";
	CSS_menuEmpiler.rel = "stylesheet";
	CSS_menuEmpiler.href = "stylesCSS/v2/interface"+interface+"_menuEmpiler.css";
	CSS_menuEmpiler = document.head.appendChild( CSS_menuEmpiler );
	
	var dtExpire = new Date();
    dtExpire.setTime(dtExpire.getTime() + 3600*1000);
    leCookie = getCookie('CookieApp_CO_LeCookie');
    
    if(leCookie != null && leCookie == 1){
    	setCookie('statusMenu', '1', dtExpire, '/' );
    }
   
   if (window.removeEventListener) {
       window.removeEventListener("scroll", empilerAutomatiquementMenu, false);
   } else if (window.detachEvent) {
       window.detachEvent("scroll", empilerAutomatiquementMenu);
   } else {
       window.onscroll = '';
   }
   
   if(leCookie != null && leCookie == 1){
	   setCookie('B25_landingPage', '1', dtExpire, '/' );
   }
   
}

function depilerMenu(){
	afficherDIV('btn_empilerMenu');
	cacherDIV('btn_depilerMenu');
	
	CSS_menuEmpiler = document.getElementById("interfaceMenu");
	document.head.removeChild( CSS_menuEmpiler ) ;
	
	var dtExpire = new Date();
    dtExpire.setTime(dtExpire.getTime() + 3600*1000);
    
    leCookie = getCookie('CookieApp_CO_LeCookie');
    
    if(leCookie != null && leCookie == 1){
    	setCookie('statusMenu', '0', dtExpire, '/' );
    }

    B25_justCharged = getCookie('B25_landingPage');
   
   if(B25_justCharged == 1){
	   if (window.addEventListener) {
	       window.addEventListener("scroll", empilerAutomatiquementMenu, false);
	   } else if (window.attachEvent) {
	       window.attachEvent("scroll", empilerAutomatiquementMenu);
	   } else {
	       window.onscroll = empilerAutomatiquementMenu;
	   }  
   }
   
   if(leCookie != null && leCookie == 1){
	   setCookie('B25_landingPage', '0', dtExpire, '/' );
   }
}


var dtExpire = new Date();
dtExpire.setTime(dtExpire.getTime() + 3600*1000);
statusMenu = getCookie('statusMenu');
leCookie = getCookie('CookieApp_CO_LeCookie');
if(leCookie != null && leCookie == 1){
	setCookie('B25_landingPage', '1', dtExpire, '/' );
}

interface = getCookie('interfaceIHM');

if(statusMenu == 0 && (interface >= 10 && interface <= 12)){
    if (window.addEventListener) {
        window.addEventListener("scroll", empilerAutomatiquementMenu, false);
        //window.addEventListener("mousewheel", empilerAutomatiquementMenu, false);
        //windows.addEventListener("wheel", empilerAutomatiquementMenu, false);
    } else if (window.attachEvent) {
        window.attachEvent("scroll", empilerAutomatiquementMenu);
        //window.attachEvent("mousewheel", empilerAutomatiquementMenu);
        //windows.attachEvent("wheel", empilerAutomatiquementMenu);
	} else {
		/*
		 * A TESTER SUR DES ANCIEN NAVIGUATEURS MAIS:
		 * normalement ne fonctionne pas car 
		 * onscroll est un evenement HTML5
		 * selon http://www.quirksmode.org/dom/events/scroll.html
		 * il fonctionne sur les butineurs > IE5.5 sur l'élément window
		 */
        window.onscroll = empilerAutomatiquementMenu;
        //window.onmousewheel = empilerAutomatiquementMenu;
        //window.onwheel = empilerAutomatiquementMenu;
	}
}