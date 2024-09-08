<?php

setlocale(LC_TIME, 'fr_FR');

function AfficheDate(){
	//recuperation de la date
	$nomjour=date("l");
	$jour=date("d");
	$nommois=date("m");
	$annee=date("Y"); 
	$heure=date("H");
	$minutes=date("i");
	//on change les variable pour que ca ressemble a quelquechose enfin, pour que les textes soient en Francais
	$nomjour=JourFrancais($nomjour);
	$nommois=MoisFrancais($nommois);
	$date =  $nomjour." ".$jour." ".$nommois." ".$annee." - ".$heure.":".$minutes;
	return $date;
}

function AfficheDateArticle(){
	//recuperation de la date
	$nomjour=date("l");
	$jour=date("d");
	$nommois=date("m");
	$annee=date("Y"); 
	$heure=date("H");
	$minutes=date("i");
	//on change les variable pour que ca ressemble a quelquechose enfin, pour que les textes soient en Francais
	$nomjour=JourFrancais($nomjour);
	$nommois=MoisFrancais($nommois);
	$date =  "le ".$nomjour." ".$jour." ".$nommois." ".$annee." &agrave; ".$heure.":".$minutes;
	return $date;
}

function AfficheDateCommentaire($dateTimeStamp){
	return convertionDateFormatDeLecture($dateTimeStamp);
}

function choixNumFinDeMois($mois,$annee){
	$dernierJourMois = mktime(12,0,0,$mois+1,0,$annee);
	$jour = getDate($dernierJourMois);
	return $jour['mday'];
}

function calculJourDebutSemaine($annee,$mois,$semaine){
	$premierJourMois = mktime(12,0,0,$mois,1,$annee);
	$premierJour = getdate($premierJourMois);
	$jourSemDebutMois = $premierJour['mday'];
	$premierJourAffiche = mktime(12,0,0,$mois,1-$jourSemDebutMois,$annee);
	$jourCourant = getdate($premierJourAffiche+($semaine*7*24*3600));
	return $jourCourant['mday'];
}

function calculJourFinSemaine($annee,$mois,$semaine){
	$premierJourMois = mktime(12,0,0,$mois,1,$annee);
	$premierJour = getdate($premierJourMois);
	$jourSemDebutMois = $premierJour['mday'];
	$premierJourAffiche = mktime(12,0,0,$mois,1-$jourSemDebutMois,$annee);
	$jourCourant = getdate($premierJourAffiche+($semaine*7*24*3600)+(6*24*3600));
	return $jourCourant['mday'];

}

function calculMoisDebutSemaine($annee,$mois,$semaine){
	$premierJourMois = mktime(12,0,0,$mois,1,$annee);
	$premierJour = getdate($premierJourMois);
	$jourSemDebutMois = $premierJour['mday'];
	$premierJourAffiche = mktime(12,0,0,$mois,1-$jourSemDebutMois,$annee);
	$jourCourant = getdate($premierJourAffiche+($semaine*7*24*3600));
	return $jourCourant['mon'];
}

function calculMoisFinSemaine($annee,$mois,$semaine){
	$premierJourMois = mktime(12,0,0,$mois,1,$annee);
	$premierJour = getdate($premierJourMois);
	$jourSemDebutMois = $premierJour['mday'];
	$premierJourAffiche = mktime(12,0,0,$mois,1-$jourSemDebutMois,$annee);
	$jourCourant = getdate($premierJourAffiche+($semaine*7*24*3600)+(6*24*3600));
	return $jourCourant['mon'];
}

function calculAnneeFinSemaine($annee,$mois,$semaine){
	$premierJourMois = mktime(12,0,0,$mois,1,$annee);
	$premierJour = getdate($premierJourMois);
	$jourSemDebutMois = $premierJour['mday'];
	$premierJourAffiche = mktime(12,0,0,$mois,1-$jourSemDebutMois,$annee);
	$jourCourant = getdate($premierJourAffiche+($semaine*7*24*3600)+(6*24*3600));
	return $jourCourant['year'];
}

function calculMois($mois,$inc){
	if ($mois==1 && $inc==-1){
		return 12;
	}
	if ($mois==12 && $inc==1){
		return 1;
	}
	return $mois+$inc;
}
function calculAnneeMois($annee,$mois,$inc){
	if ($mois==1 && $inc==-1){
		return $annee-1;
	}
	if ($mois==12 && $inc==1){
		return $annee+1;
	}
	return $annee;
}

function AfficheCalendrier($annee,$mois){
	$premierJourMois = mktime(12,0,0,$mois,1,$annee);
	$dernierJourMois = mktime(12,0,0,$mois+1,0,$annee);
	$premierJour = getdate($premierJourMois);
	$jourSemDebutMois = $premierJour['wday'];
	$dernierJour = getdate($dernierJourMois);
	$jourSemFinMois = $dernierJour['wday'];
	$premierJourAffiche = mktime(12,0,0,$mois,1-$jourSemDebutMois,$annee);
	$dernierJourAffiche = mktime(12,0,0,$mois+1,6-$jourSemFinMois,$annee);
	echo "<table border='0' bgcolor='white' align='center'><tr class='jour'>";
	echo "<td class='semaine'>###</td><td class='entete'>Dim</td><td class='entete'>Lun</td><td class='entete'>Mar</td><td class='entete'>Mer</td><td class='entete'>Jeu</td><td class='entete'>Ven</td><td class='entete'>Sam</td>";
	echo "</tr>";
	$nbsem = round(($dernierJourAffiche-$premierJourAffiche)/(24*7*3600));
	for($i=0;$i<=$nbsem-1;$i++){
		echo "<tr>";
		for($j=0;$j<7;$j++){
			$jourCourant = getdate($premierJourAffiche+($i*7*24*3600)+($j*24*3600));
				//recherche de la base de données des enregistrements
				$req="SELECT id_evenement FROM evenementsActifs WHERE dateEvenement >= '".$annee."-".$mois."-".$jourCourant['mday']." 00:00:00' AND dateEvenement <= '".$annee."-".$mois."-".$jourCourant['mday']." 23:59:59'";
				$resultat= faireUneRequeteOffLine($req);
				$data = mysql_fetch_row($resultat);
			if($j==0){
			echo "<td align='center' class='semaine'><a href='index.php?Mois=".$mois."&Annee=".$annee."&semaineMois=".$i."'>".strftime('%U',$premierJourAffiche+($i*7*24*3600))."</a></td>";
			}
			echo "<td align='center'".
			(($jourCourant['mon']==$mois)?" class='mois' ":" class='grise' ").
			(($data[0]!=NULL&&$jourCourant['mon']==$mois)?" background='images/box_clear.gif' ":"").
			"><a href='index.php?Mois=".$jourCourant['mon']."&Annee=".$jourCourant['year']."&Jour=".$jourCourant['mday']."'>".$jourCourant['mday']."</a></td>";
		}
		echo "</tr>";
	}
	echo "</table>";
}

function convertionDateFormatDeLecture($date0){
	$date1 = explode(" ", $date0);
	$date11 = explode("-",$date1[0]);
	$date12 =explode (":",$date1[1]);
	$date = mktime($date12[0],$date12[1],$date12[2],$date11[1],$date11[2],$date11[0]);
	$nomjour=date("l",$date);
	$jour=date("d",$date);
	$nommois=date("m",$date);
	$annee=date("Y",$date); 
	$heure=date("H",$date);
	$minutes=date("i",$date);
	$date2 =  $jour."/".$nommois."/".$annee." - ".$heure.":".$minutes;
	return $date2;
}

function recupererTimeStampCourant(){
	$date = date('Y-m-d H:i:s');
	return $date;
}

function recupererDatePourNouveauRepertoireUtilisateur(){
	return date('Y-m-d--H');
}

function JourFrancais($nomjour){
	 switch ($nomjour)
	{
	case "Monday":
	return "Lundi";
	break;
	case "Tuesday":
	return "Mardi";
	break;
	case "Wednesday":
	return "Mercredi";
	break;
	case "Thursday":
	return "Jeudi";
	break;
	case "Friday":
	return "Vendredi";
	break;
	case "Saturday":
	return "Samedi";
	break;
	case "Sunday":
	return "Dimanche";
	break;
	}
}

function MoisFrancais($nommois){
	 switch ($nommois)
	{
	case 1:
	return "Janvier";
	break;
	case 2:
	return "F&eacute;vrier";
	break;
	case 3:
	return "Mars";
	break;
	case 4:
	return "Avril";
	break;
	case 5:
	return "Mai";
	break;
	case 6:
	return "Juin";
	break;
	case 7:
	return "Juillet";
	break;
	case 8:
	return "Ao&ucirc;t";
	break;
	case 9:
	return "Septembre";
	break;
	case 10:
	return "Octobre";
	break;
	case 11:
	return "Novembre";
	break;
	case 12:
	return "D&eacute;cembre";
	break;
	}
}

function getmicrotime(){ 
    list($usec, $sec) = explode(" ",microtime()); 
    return ((float)$usec + (float)$sec); 
} 

function time_elapsed_millisecs($millisecs){
    $bit = array(
        'y'       => $millisecs / ( 31556926 * 1000 ) % 12,
        'w'       => $millisecs / ( 604800 * 1000 ) % 52,
        'd'       => $millisecs / ( 86400 * 1000 ) % 7,
        'h'      	=> $millisecs / ( 3600 * 1000 ) % 24,
        'm'    		=> $millisecs / ( 60 * 1000 ) % 60,
        's'				=> $millisecs / 1000 % 60,
        'ms'			=> $millisecs % 1000,
        'µs' 			=> $millisecs * 1000 % 1000
        );
        
    foreach($bit as $k => $v)
        if($v > 0)$ret[] = $v . $k;
        
    return join(' ', $ret);
    }
    

function time_elapsed_microsecs($microsecs){
    $bit = array(
        ' year'       	 => $microsecs / ( 31556926 * 1000000 ) % 12,
        ' week'       	 => $microsecs / ( 604800 * 1000000 ) % 52,
        ' day'        	 => $microsecs / ( 86400 * 1000000 ) % 7,
        ' hour'       	 => $microsecs / ( 3600 * 1000000 ) % 24,
        ' minute'   		 => $microsecs / ( 60 * 1000000 ) % 60,
        ' second'   		 => $microsecs / 1000000 % 60,
        ' millisecond'	 => $microsecs / 1000 % 1000,
        ' microseconds'	 => $microsecs % 1000
        );
        
    foreach($bit as $k => $v){
        if($v > 1)$ret[] = $v . $k . 's';
        if($v == 1)$ret[] = $v . $k;
        }
    //array_splice($ret, count($ret)-1, 0, 'and');
    //$ret[] = 'ago.';
    
    return join(' ', $ret);
    }
    

function transformationDateArticlePourRSS($dateArticle){
	$tabDate = explode(" ",$dateArticle);
	//transformation Du jour
	$jour = "Mon";
	if($tabDate[1]==="Lundi"){$jour="Mon";}
	if($tabDate[1]==="Mardi"){$jour="Tue";}
	if($tabDate[1]==="Mercredi"){$jour="Wed";}
	if($tabDate[1]==="Jeudi"){$jour="Thu";}
	if($tabDate[1]==="Vendredi"){$jour="Fri";}
	if($tabDate[1]==="Samedi"){$jour="Sat";}
	if($tabDate[1]==="Dimanche"){$jour="Sun";}
	//transformation du numero de jour
	$numJour = intval($tabDate[2]);
	//transformation du mois
	$mois="Oct";
	if($tabDate[3]==="Janvier"){$mois="Jan";}
	if($tabDate[3]==="F&eacute;vrier"){$mois="Feb";}
	if($tabDate[3]==="Mars"){$mois="Mar";}
	if($tabDate[3]==="Avril"){$mois="Apr";}
	if($tabDate[3]==="Mai"){$mois="May";}
	if($tabDate[3]==="Juin"){$mois="Jun";}
	if($tabDate[3]==="Juillet"){$mois="Jul";}
	if($tabDate[3]==="Ao&ucirc;t"){$mois="Aug";}
	if($tabDate[3]==="Septembre"){$mois="Sep";}
	if($tabDate[3]==="Octobre"){$mois="Oct";}
	if($tabDate[3]==="Novembre"){$mois="Nov";}
	if($tabDate[3]==="D&eacute;cembre"){$mois="Dec";}
	//transformation du Jour
	$annee = $tabDate[4];
	//transformation de l'heure
	
	$timestamp = $annee."-".$mois."-".$numJour." ".$tabDate[6].":00";
	$dateGMT = date('D, d M Y h:i:s O', strtotime ($timestamp));
	//echo $dateGMT;
	return $dateGMT;
	
}

function transformationDateArticlePourATOM($dateArticle){
	$tabDate = explode(" ",$dateArticle);
	//transformation du numero de jour
	$numJour = intval($tabDate[2]);
	//transformation du mois
	$mois="Oct";
	if($tabDate[3]==="Janvier"){$mois="01";}
	if($tabDate[3]==="F&eacute;vrier"){$mois="02";}
	if($tabDate[3]==="Mars"){$mois="03";}
	if($tabDate[3]==="Avril"){$mois="04";}
	if($tabDate[3]==="Mai"){$mois="05";}
	if($tabDate[3]==="Juin"){$mois="06";}
	if($tabDate[3]==="Juillet"){$mois="07";}
	if($tabDate[3]==="Ao&ucirc;t"){$mois="08";}
	if($tabDate[3]==="Septembre"){$mois="09";}
	if($tabDate[3]==="Octobre"){$mois="10";}
	if($tabDate[3]==="Novembre"){$mois="11";}
	if($tabDate[3]==="D&eacute;cembre"){$mois="12";}
	//transformation du Jour
	$annee = $tabDate[4];

	$timestamp = $annee."-".$mois."-".$numJour." ".$tabDate[6].":00";

	$dateATOM = date('Y-m-d\TH:i:s\Z', strtotime ($timestamp));
	//echo $dateATOM;	
	return $dateATOM;
	
}
function transformationDateArticlePourAffichageDepuisRSS($dateItemRSS){
	$tabDate = explode(" ",$dateItemRSS);
	//transformation Du jour
	$jour = "Mon";
	if($tabDate[0]==="Mon,"){$jour="Lundi";}
	if($tabDate[0]==="Tue,"){$jour="Mardi";}
	if($tabDate[0]==="Wed,"){$jour="Mercredi";}
	if($tabDate[0]==="Thu,"){$jour="Jeudi";}
	if($tabDate[0]==="Fri,"){$jour="Vendredi";}
	if($tabDate[0]==="Sat,"){$jour="Samedi";}
	if($tabDate[0]==="Sun,"){$jour="Dimanche";}
	//transformation du numero de jour
	$numJour = intval($tabDate[1]);
	//transformation du mois
	$mois="Oct";
	if($tabDate[2]==="Jan"){$mois="Janvier";}
	if($tabDate[2]==="Feb"){$mois="F&eacute;vrier";}
	if($tabDate[2]==="Mar"){$mois="Mars";}
	if($tabDate[2]==="Apr"){$mois="Avril";}
	if($tabDate[2]==="May"){$mois="Mai";}
	if($tabDate[2]==="Jun"){$mois="Juin";}
	if($tabDate[2]==="Jul"){$mois="Juillet";}
	if($tabDate[2]==="Aug"){$mois="Ao&ucirc;t";}
	if($tabDate[2]==="Sep"){$mois="Septembre";}
	if($tabDate[2]==="Oct"){$mois="Octobre";}
	if($tabDate[2]==="Nov"){$mois="Novembre";}
	if($tabDate[2]==="Dec"){$mois="D&eacute;cembre";}
	//transformation du Jour
	$annee = $tabDate[3];
	//transformation de l'heure
	$heure = $tabDate[4];
	return $jour." ".$numJour." ".$mois." ".$annee." &agrave; ".$heure ;
	
}

?>
