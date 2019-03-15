if (typeof selectionnerDIV == 'function')
{
	function selectionnerDIV(elem){
		Pdiv = null;
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
}

// targeting navigation
	var n ;
	n = selectionnerDIV('nav');
	// nav initially closed is JS enabled
	n.classList.add('is-closed');
	
	function navi() {
		// when small screen, create a switch button, and toggle navigation class
		if (window.matchMedia("(max-width: 767px)").matches && document.getElementById("toggle-nav")==undefined) {			
			n.insertAdjacentHTML('afterBegin','<button id="toggle-nav"><i class="visually-hidden">Déplier/replier le menu</i></button>');
			t = document.getElementById('toggle-nav');  
			t.onclick=function(){ n.classList.toggle('is-closed');}
		}
		// when big screen, delete switch button, and toggle navigation class
		if (window.matchMedia("(min-width: 768px)").matches && document.getElementById("toggle-nav")) {
			document.getElementById("toggle-nav").outerHTML="";
		}
	}
	navi();
	// when resize or orientation change, reload function
	window.addEventListener('resize', navi);
