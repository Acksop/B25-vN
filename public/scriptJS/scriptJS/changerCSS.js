function selectionnerDIV(elem){
	if ( document.getElementById && document.getElementById( elem ) ){
		 Pdiv = document.getElementById( elem );
	}
	    // Pour les veilles versions
	else if ( document.all && document.all[ elem ] ){
		Pdiv = document.all[ elem ];
	}
	    // Pour les trés veilles versions
	else if ( document.layers && document.layers[ elem ] ){
		Pdiv = document.layers[ elem ];
	}
	else{
		return false;
	}
	return Pdiv;
}
function changerTailleTexte(taille){
	var CSS_lecture = selectionnerDIV("lecture");
	CSS_lecture.disabled = true;
	CSS_lecture.href = "stylesCSS/lecture0"+taille+".css";
	CSS_lecture.disabled = false;
}
function changerInterFace(type){
	var CSS_interface = selectionnerDIV("interface");
	CSS_interface.disabled = true;
	CSS_interface.href = "stylesCSS/interface"+type+".css";
	CSS_interface.disabled = false;
}
function changerTypographie(type){
	var CSS_typographie = selectionnerDIV("typographie");
	CSS_typographie.disabled = true;
	CSS_typographie.href = "stylesCSS/typographie"+type+".css";
	CSS_typographie.disabled = false;
}