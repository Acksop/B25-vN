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
	    // Pour les tr�s veilles versions
	else if ( document.layers && document.layers[ elem ] ){
		Pdiv = document.layers[ elem ];
		PcH = true;
	}
	else{
		PcH = false;
	}
	return Pdiv;
}