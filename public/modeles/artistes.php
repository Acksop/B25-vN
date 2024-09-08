<?php

global $header_title,$header_description,$header_identifier_url,$header_keywords;
if($_GET['type'] == 2){
	$selectionAnnuaireTitleEtDescription = "des Artistes";
	$selectionAnnuaireIdentifier = "artistes";
}elseif($_GET['type'] == 4){
	$selectionAnnuaireTitleEtDescription = "des Artisans";
	$selectionAnnuaireIdentifier = "artisans";
}else{
	$selectionAnnuaireTitleEtDescription = "des Artistes et des Artisans";
	$selectionAnnuaireIdentifier = "artistes_artisans";
}
$header_title = "Besan&ccedil;on 25 - Listes {$selectionAnnuaireTitleEtDescription} incrits sur la Plate-forme";
$header_description = "Micro-annuaire {$selectionAnnuaireTitleEtDescription} du Besan&ccedil;on 25";
$header_identifier_url = "besancon25.fr/annuaire_{$selectionAnnuaireIdentifier}";
$header_keywords = "Besan&ccedil;on, Besancon, 25000, 25, artiste, artistes, artisans, artisan, page personnelle, inscrits";


function LancerAffichageDuCorps(){
	echo "<center><table border='0' bgcolor='white' width='700px'><tr>";
	if(isset($_GET['type'])){
		if($_GET['type'] == "tous"){
			echo "<th bgcolor='gray'>";
		}else{
			echo "<th>";
		}
	echo "<a href='index.php?page=artistes&type=tous'>tous</a></th>";
	if($_GET['type'] == "2"){
			echo "<th bgcolor='gray'>";
		}else{
			echo "<th>";
		}
	echo "<a href='index.php?page=artistes&type=2'>Artistes</a></th>";
	if($_GET['type'] == "4"){
			echo "<th bgcolor='gray'>";
		}else{
			echo "<th>";
		}
	echo "<a href='index.php?page=artistes&type=4'>Artisans</a></th>";
	}else{
	echo "<th bgcolor='gray'>"
	."<a href='index.php?page=artistes&type=tous'>tous</a></th>"
	."<th>"
	."<a href='index.php?page=artistes&type=2'>Artistes</a></th>"
	."<th>"
	."<a href='index.php?page=artistes&type=4'>Artisans</a></th>";
	}
	echo "</tr></table><center><br/>";

	if(isset($_GET['type'])){
		afficheTousLesArtistes($_GET['type']);
	}else{
		afficheTousLesArtistes("tous");
	}
}

function afficheTousLesArtistes($type){
echo "<script>
	btn_Mur_down = new Image();
	btn_Mur_down = 'images/picto-mur_down.gif';
	btn_Mur_up = new Image();
	btn_Mur_up = 'images/picto-mur.gif';
	btn_Mur_hover = new Image();
	btn_Mur_hover = 'images/picto-mur_hover.gif';
	btn_Tab_down = new Image();
	btn_Tab_down = 'images/picto-page-tableau_down.gif';
	btn_Tab_up = new Image();
	btn_Tab_up = 'images/picto-page-tableau.gif';
	btn_Tab_hover = new Image();
	btn_Tab_hover = 'images/picto-page-tableau_hover.gif';
	btn_Artisans_down = new Image();
	btn_Artisans_down = 'images/picto-page-artisans_down.gif';
	btn_Artisans_up = new Image();
	btn_Artisans_up = 'images/picto-page-artisans.gif';
	btn_Artisans_hover = new Image();
	btn_Artisans_hover = 'images/picto-page-artisans_hover.gif';
	</script>
	";
	
$sql1 = "SELECT * FROM utilisateur";
$req1 = faireUneRequeteOffline($sql1);
echo "<table border='0'>";
	$i=0;
	while($data = mysql_fetch_assoc($req1)){
		if($type == "tous"){
		if($data['type_compte'] == 2 || $data['type_compte'] == 4){
			echo "<tr>";
			if($data['statut']==2){
				$i++;
				if ($i%2 == 1){
				$class = "utilisateurs";
				}else{
				$class = "utilisateursInverse";
				}
				$sql2 = "SELECT * FROM artistes WHERE id_utilisateur ='".$data['id_utilisateur']."'";
				$req2 = faireUneRequeteOffline($sql2);
				$data2 = mysql_fetch_assoc($req2);
				
				if($data2['site_web_only'] == 0){
					echo "<td class='".$class."'>".$data2['nom']."</td><td class='".$class."'>".$data2['prenom']."</td><td class='".$class."'>";
				}else{
					echo "<td class='".$class."'>&nbsp;</td><td class='".$class."'>&nbsp;</td><td class='".$class."'>";
				}
				$data2['siteInterWeb'] = correctionAdresseInterWeb($data2['siteInterWeb']);
				if ($data2['siteInterWeb'] != ""){
					echo "<a href='".$data2['siteInterWeb']."'>";
				}
				echo $data2['pseudo'];
				if ($data2['siteInterWeb'] != ""){
					echo "</a>";
				}
				echo "</td><td class='".$class."'>";
				
				if($data2['site_web_only'] == 0){
					if($data2['voir_telephone'] == 1){
						echo $data2['telephone'];
					}else{
						echo "&nbsp;";
					}
				}else{
					echo "&nbsp;";
				}
				
				echo "</td><td class='".$class."'>".$data2['description'];
				if($data2['site_web_only'] == 0){
					if($data2['voir_courriel'] == 1){
						echo "</td><td class='".$class."'>".$data2['email']."</td>";
					}else{
						echo "</td><td class='".$class."'>&nbsp;</td>";
					}
				}else{
					echo "</td><td class='".$class."'>&nbsp;</td>";
				}
				
				if($data2['voir_tweets'] == 1){
					echo "</td><td>";
					if($data['type_compte'] == 2 ){
						if($data2['affichage_tweets'] == 0){
							echo "<a href='index.php?page=tableauInscrit&id={$data2['id_artiste']}&type={$data['type_compte']}'><img src='images/picto-page-tableau.gif' heigth='25' width='25' onMouseOver='this.src=btn_Tab_down' onMouseOut='this.src=btn_Tab_up' onMouseDown='this.src=btn_Tab_hover'></a>";
						}else{
							echo "<a href='index.php?page=murInscrit&id={$data2['id_artiste']}&type={$data['type_compte']}'><img src='images/picto-mur.gif' heigth='25' width='25' onMouseOver='this.src=btn_Mur_down' onMouseOut='this.src=btn_Mur_up' onMouseDown='this.src=btn_Mur_hover'></a>";
						}
					}else{
						echo "<a href='index.php?page=presentationArtisans&id={$data2['id_artiste']}'><img src='images/picto-page-artisans.gif' heigth='25' width='25' onMouseOver='this.src=btn_Artisans_down' onMouseOut='this.src=btn_Artisans_up' onMouseDown='this.src=btn_Artisans_hover'></a>";
					}
					echo "</td>";
				}
			}	
			echo "</tr>";
		}
		}else{
		if($data['type_compte'] == (int)($type)){
			echo "<tr>";
			if($data['statut']==2){
				$i++;
				if ($i%2 == 1){
				$class = "utilisateurs";
				}else{
				$class = "utilisateursInverse";
				}
				$sql2 = "SELECT * FROM artistes WHERE id_utilisateur ='".$data['id_utilisateur']."'";
				$req2 = faireUneRequeteOffline($sql2);
				$data2 = mysql_fetch_assoc($req2);
				
				if($data2['site_web_only'] == 0){
					echo "<td class='".$class."'>".$data2['nom']."</td><td class='".$class."'>".$data2['prenom']."</td><td class='".$class."'>";
				}else{
					echo "<td class='".$class."'>&nbsp;</td><td class='".$class."'>&nbsp;</td><td class='".$class."'>";
				}
				$data2['siteInterWeb'] = correctionAdresseInterWeb($data2['siteInterWeb']);
				if ($data2['siteInterWeb'] != ""){
					echo "<a href='".$data2['siteInterWeb']."'>";
				}
				echo $data2['pseudo'];
				if ($data2['siteInterWeb'] != ""){
					echo "</a>";
				}
				echo "</td><td class='".$class."'>";
				
				if($data2['site_web_only'] == 0){
					if($data2['voir_telephone'] == 1){
						echo $data2['telephone'];
					}else{
						echo "&nbsp;";
					}
				}else{
					echo "&nbsp;";
				}
				
				echo "</td><td class='".$class."'>".$data2['description'];
				if($data2['site_web_only'] == 0){
					if($data2['voir_courriel'] == 1){
						echo "</td><td class='".$class."'>".$data2['email']."</td>";
					}else{
						echo "</td><td class='".$class."'>&nbsp;</td>";
					}
				}else{
					echo "</td><td class='".$class."'>&nbsp;</td>";
				}
				
				
				if($data2['voir_tweets'] == 1){
					echo "</td><td>";
					if($data['type_compte'] == 2 ){
						if($data2['affichage_tweets'] == 0){
							echo "<a href='index.php?page=tableauInscrit&id={$data2['id_artiste']}&type={$data['type_compte']}'><img src='images/picto-page-tableau.gif' heigth='25' width='25' onMouseOver='this.src=btn_Tab_down' onMouseOut='this.src=btn_Tab_up' onMouseDown='this.src=btn_Tab_hover'></a>";
						}else{
							echo "<a href='index.php?page=murInscrit&id={$data2['id_artiste']}&type={$data['type_compte']}'><img src='images/picto-mur.gif' heigth='25' width='25' onMouseOver='this.src=btn_Mur_down' onMouseOut='this.src=btn_Mur_up' onMouseDown='this.src=btn_Mur_hover'></a>";
						}
					}else{
						echo "<a href='index.php?page=presentationArtisans&id={$data2['id_artiste']}'><img src='images/picto-page-artisans.gif' heigth='25' width='25' onMouseOver='this.src=btn_Artisans_down' onMouseOut='this.src=btn_Artisans_up' onMouseDown='this.src=btn_Artisans_hover'></a>";
					}
					echo "</td>";
				}
			}	
			echo "</tr>";
		}
		}
	}
	echo "</table>";
	return;
}

