function Horloge_Start() 
{
	Horloge = new Date;
	jour=['Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'];
	mois=['Janvier','F&eacute;vier','Mars','Avril','Mai','Juin','Juillet','Ao&ucirc;t','Septembre','Octobre','Novembre','D&eacute;cembre'];
	var annee = Horloge.getUTCFullYear();
	var joursNumero = Horloge.getUTCDay();
	var joursSemaine = Horloge.getDay();
	var moisd = Horloge.getMonth();
	jours = jour[joursSemaine];
	mois = mois[moisd];

	Horloge_print = jours + ' 'joursNumero + ' ' + mois + ' ' + annee + ' - ' + remplaceZero(Horloge.getHours()) + ':' + remplaceZero(Horloge.getMinutes());
	document.getElementById('HeureDate').innerHTML = Horloge_print;

}
function remplaceZero(nb) 
{
	return (nb > 9) ? '' + nb : '0' + nb;
}
setTimeout('Horloge_Start()',1000);