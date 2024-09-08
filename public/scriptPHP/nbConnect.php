<?php

function connectes(){
    // temps en min avant d'être considéré comme inactif 
    $temps = 5; 
            
    // ip du client 
    $ip = $_SERVER['REMOTE_ADDR']; 
    
    // pseudo 
    $pseudo = empty($_SESSION['identifiant']) ? '' : $_SESSION['identifiant']; 
    
    // time actuel 
    $time = time(); 

    // on recherche l'utilisateur 
    $result = faireUneRequeteOffLine("SELECT * FROM connectes WHERE ip='$ip'");  
    // si l'utilisateur n'est pas deja dans la table 
    if(mysql_num_rows($result) == 0){ 
    	//insertion
        $result = faireUneRequeteOffLine("INSERT INTO connectes VALUES ('$ip', '$time', '$pseudo','0')"); 
    }else{ 
	//mise a jour
        $result = faireUneRequeteOffLine("UPDATE connectes SET derniere='$time',pseudo='$pseudo' WHERE ip='$ip'");
    }
    // on verifie que le super-utilisateur n'as pas de connection double
    $result = faireUneRequeteOffline("SELECT * FROM connectes WHERE pseudo='Acksop'");
    if(mysql_num_rows($result) > 1){
    	$ips = array();
    	while($data = mysql_fetch_row($result)){
    	$ips[] = $data[0];
    	}
    	//Alerte de securité, compte super-utilisateur
    	//Accès externe
    	$sql = "INSERT INTO Alerte_H4X0R(type,date,IP1,IP2,compte) VALUES('2','".AfficheDate()."','".$ips[1]."','".$ips[0]."','Super-Utilisateur')";
    	faireUneRequeteOffline($sql);
    }
    
    // temps d'inactivité 
    $time = $time - ($temps*60);
    
    //Semaine Prochaine 7 jours; 24 heures; 60 minutes; 60 secondes , plus tard
    //$nextWeek = time() + (7 * 24 * 60 * 60);
    //print( date(Y-M-D h:m:s , $nextWeek) );

    
    // on supprime ceux qui n'ont pas été connectés depuis assez longtemps 
    $result = faireUneRequeteOffLine("DELETE LOW_PRIORITY FROM connectes WHERE derniere<='$time'");
}

function AfficheNbConnectes(){
	//******************* 
	//Affichage des connectés 
	//*******************                 
	if(isset($_SESSION['type_compte']) && $_SESSION['type_compte']==0){ 
	    $result = faireUneRequeteOffLine("SELECT pseudo FROM connectes WHERE pseudo <> ''");                   
	    if(!$result){
		$stop = 1; 
	    }else{ 
		echo "<h6><font color='#FFFFFF'>Connect&eacute;s:</font><br/>";            
		while($connecte = mysql_fetch_row($result)) 
		    echo $connecte[0] . '<br/>'; 
	    }
	    echo "</h6>";
    	    $result = faireUneRequeteOffLine("SELECT count(*) FROM connectes WHERE pseudo = ''");                 
   	    if($result){ 
		$visiteurs = mysql_fetch_array($result);                   
		echo "<h6><font color='#FFFFFF'>Invit&eacute;s en Lecture:</font><br/>&nbsp;&nbsp;&nbsp;" . $visiteurs[0] ." visiteurs...</h6>"; 
 	    } 
	    echo "</h6>";
	    
	}else if(isset($_SESSION['type_compte']) && $_SESSION['type_compte']==1){ 
	    $result = faireUneRequeteOffLine("SELECT pseudo FROM connectes WHERE pseudo <> ''");                   
	    if(!$result){
		$stop = 1; 
	    }else{ 
		echo "<h6><font color='#FFFFFF'>Connect&eacute;s:</font><br/>";            
		while($connecte = mysql_fetch_row($result)) 
		    echo $connecte[0] . '<br/>'; 
	    }
	    echo "</h6>";
	} else {
	    $result = faireUneRequeteOffLine("SELECT count(*) FROM connectes"); 
		                
	    if($result){ 
		$visiteurs = mysql_fetch_array($result);                   
		echo "<h6><font color='#FFFFFF'>Invit&eacute;s en Lecture:</font><br/>&nbsp;&nbsp;&nbsp;" . $visiteurs[0] ." visiteurs...</h6>"; 
	    } 
	}
}
?>
