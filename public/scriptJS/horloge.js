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

function remplaceZero(nb) 
{
	return (nb > 9) ? '' + nb : '0' + nb;
}

function Horloge_Start() 
{
	horloge = new Date;
	jour=['Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'];
	mois=['Janvier','F&eacute;vier','Mars','Avril','Mai','Juin','Juillet','Ao&ucirc;t','Septembre','Octobre','Novembre','D&eacute;cembre'];
	var annee = horloge.getUTCFullYear();
	var joursNumero = horloge.getUTCDate();
	var joursd = horloge.getUTCDay();
	var moisd = horloge.getUTCMonth();
	jours = jour[joursd];
	mois = mois[moisd];

	var horloge_print;
	horloge_print = jours + ' ' + remplaceZero(joursNumero) + ' ' + mois + ' ' + annee + ' - ' + remplaceZero(horloge.getHours()) + ':' + remplaceZero(horloge.getMinutes());
	var heureDate;
	heureDate = selectionnerDIV('HeureDate');
	heureDate.innerHTML = horloge_print;

	setTimeout('Horloge_Start()',500);
}

Horloge_Start();

