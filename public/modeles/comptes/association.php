<?php
echo "<script src='scriptJS/afficherCacherDIV.js' type='text/javascript'></script>";

//--Visibilit� de la page personnelle de l'association

echo "<div class='conteneurGrand'>"
	."<h2 class='legende'>Propri&eacute;t&eacute;s de la page publique :</h2><br /><br />";
echo "<table border='0' width='100%'><tr valign='middle'><td class='titreTableau'>";
echo "VISIBILIT&Eacute;E DE LA PAGE PUBLIQUE:</td>";
	echo "<td class='utilisateurs'>";
	if($association['voir_Page']==0){
		echo "Priv&eacute;e";
	}else{
		echo "Publique";
	}
	echo "</td><td class='utilisateurs'>"
		."<form name='modifInfoAssociation' method='post' action='controlleurs/traitementModifInfoAsso.php'>"
		."<input type='hidden' name='voir_Page' value='".$association['voir_Page']."'/>"
		."<button type='submit' class='btn_modif'><img src='./images/picto-modifierCircle_up.gif' onMouseOut='this.src=btn_modif_up;' onMouseDown='this.src=btn_modif_down;' onMouseOver='this.src=btn_modif_hover;' alt='Changer?' /></button>"
		."</form>";
echo "</td></tr></table></div><br />";

//--- LE LOGO - D�but
echo "<a name='ancre_logo'/>";
echo "<script language='javascript'>"
	."
	function AfficheBanniereDL(){
		cacherDIV('ajoutLOGO');
		afficherDIV('BanDL');
	}
	function AfficheFormLOGO(){
		cacherDIV('assocLOGO');
		cacherDIV('btn_modifierLOGO');
		afficherDIV('ajoutLOGO');
	}
	function AfficheLogo(){
		cacherDIV('ajoutLOGO');
		afficherDIV('assocLOGO');
		afficherDIV('btn_modifierLOGO');
	}
	btn_modif_down = new Image();
	btn_modif_down = 'images/picto-modifier_down.gif';
	btn_modif_up = new Image();
	btn_modif_up = 'images/picto-modifier_up.gif';
	btn_modif_hover = new Image();
	btn_modif_hover = 'images/picto-modifier_hover.gif';
	btn_suppr_down = new Image();
	btn_suppr_down = 'images/picto-supprimer_down.gif';
	btn_suppr_up = new Image();
	btn_suppr_up = 'images/picto-supprimer_up.gif';
	btn_suppr_hover = new Image();
	btn_suppr_hover = 'images/picto-supprimer_hover.gif';
	
	</script>
	";
echo "<div class='conteneurGrand'>"
	."<h2 class='legende'>Logo-Type"
	."<div id='btn_modifierLOGO' class='btn' style='float:left;'  onClick='AfficheFormLOGO();'><img id='btn' style='float:left;' src='images/picto-modifier_up.gif' onMouseOver='javascript:this.src=btn_modif_hover;' onMouseOut='javascript:this.src=btn_modif_up;' onMouseDown='javascript:this.src=btn_modif_down;'></div>"
	."</h2><br />";
echo "<div class='conteneurGrandInterieur' id='ajoutLOGO' ";
if($descriptif['logo'] != ''){
	echo "style='display:none;'><h3 class='legende'> Changer de LogoType:</h3>";
}else{
	echo "><h3 class='legende'> Ajouter le logo:</h3>";
}
echo "<form enctype='multipart/form-data' action='controlleurs/traitementAssociationAjoutLOGO.php' method='POST'>"
	."<input type='hidden' name='MAX_FILE_SIZE' value='2097152'/>"
	."<input type='file' size='20' name='Image' class='tweet' />(max 2Mo)"
	."<br/>"
	."<span style='float:right;'>";
if($descriptif['logo'] != ''){
	echo "<input type='submit' value='Modifier' class='tweet' onClick='AfficheBanniereDL()'/>"
	."&nbsp;"
	."<input type='button' value='[Annuler]' class='tweetReset' onClick='AfficheLogo()' />";
}else{
	echo "<input type='submit' value='Ajouter' class='tweet' onClick='AfficheBanniereDL()'/>";
}
echo "</span>"
	."<input type='hidden' name='id_utilisateur' value='".$_SESSION['id_utilisateur']."'/>"
	."<input type='hidden' name='type' value='".$_SESSION['type_compte']."'/>"
	."</form>"
	."</div>"
	."<div id='BanDL' style='background: gray; display:none;'><img src='images/upload.gif' height='120px' width='500px' alt='banni�re de t�l�chargements'/></div>";
if($descriptif['logo'] != ''){
	echo "<div id='assocLOGO' class='conteneurGrandInterieur'><img src='".SVNRADIEURAE_PATH.$descriptif['logo']."' alt='{$association['nom']}'/></div>";
}
echo "</div>";

//-- LE LOGO - Fin

//-- LA DESCRIPTION - D�but
echo "<a name='ancre_descriptif'/>";
ecrireScriptJSTinyMCE();
echo "<script language='javascript'>"
	."
	function AfficheFormDescriptif(){
		cacherDIV('descriptifAsso');
		cacherDIV('btn_descriptif');
		afficherDIV('ajoutDescriptif');
	}
	function AfficheDescriptif(){
		cacherDIV('ajoutDescriptif');
		afficherDIV('descriptifAsso');
		afficherDIV('btn_descriptif');
	}				
	</script>
	";	

if($descriptif['descriptif'] == '' ){
	$drapeauAjout = TRUE;
	$descriptif_asso = "";
}else{
	$descriptif_asso = check_ChaineDeCaracteresDownload($descriptif['descriptif']);
	$drapeauAjout = FALSE;
}
echo "<div class='conteneurGrand'>"
	."<h2 class='legende'>Descriptif / Mission"
	."<div id='btn_descriptif' class='btn' style='float:left;' onClick='AfficheFormDescriptif();'><img alt='Changer descriptif?' style='float:left;' src='images/picto-modifier_up.gif' onMouseOver='javascript:this.src=btn_modif_hover;' onMouseOut='javascript:this.src=btn_modif_up;' onMouseDown='javascript:this.src=btn_modif_down;'></div>"
	."</h2><br />";

echo "<div id='ajoutDescriptif' class='conteneurGrandInterieur' ";
if($drapeauAjout){
	echo ">";
	echo "<h3 class='legende'>Ajouter un descriptif:</h3>";
}else{
	echo " style='display:none;'>";
	echo "<h3 class='legende'>Modifier le descriptif:</h3>";
}
echo "<form method='post' action='controlleurs/traitementAssociationAjoutDescriptif.php'>";
echo "<!-- Gets replaced with TinyMCE, remember HTML in a textarea should be encoded -->"
	."<textarea id='elm1' name='elm1' style='width: 100%; height: 400px;'>"
	.$descriptif_asso
	."</textarea>"
	."<br/>"
	."<span style='float:right;'>";
	if($drapeauAjout){					
		echo "<input type='submit' name='save' class='tweet' value='[Valider]' />";
	}else{
		echo "<input type='submit' name='save' class='tweet' value='[Modifier]' />"
		."&nbsp;"
		."<input type='button' value='[Annuler]' class='tweetReset' onClick='AfficheDescriptif()' />";
	}
	echo "</span></form>"
	."</div>";
if(!$drapeauAjout){
	echo "<div id='descriptifAsso' class='utilisateurs' style='padding:10px;margin:10px;'>{$descriptif_asso}</div>";
}
	echo "</div>";

//-- LA DESCRIPTION - Fin

//-- LES STATUS - D�but
echo "<a name='ancre_Status'/>";
echo "<script  language='javascript'>"
	."
	btn_ajoutBureau_down = new Image();
	btn_ajoutBureau_down = 'images/picto-ajouterBureau_down.gif';
	btn_ajoutBureau_up = new Image();
	btn_ajoutBureau_up = 'images/picto-ajouterBureau_up.gif';
	btn_ajoutBureau_hover = new Image();
	btn_ajoutBureau_hover = 'images/picto-ajouterBureau_hover.gif';	
	</script>
	";
echo "<div id='ajoutStatus' class='conteneurGrand'>"
	."<h2 align='left' class='legende'>Bureau</h2>"
	."<table border='0' width='900px'>";
	if(mysql_num_rows($req_status) != 0){
		echo "<tr><th></th><th>Identit&eacute;e</th><th>Courriel</th><th></th></tr>";
	}
	if( isset($_GET['modif']) ){
		($_GET['modif'] == 'president')?$forceModifPresident = 1:$forceModifPresident = 0;
		($_GET['modif'] == 'vicePresident')?$forceModifVicePresident = 1:$forceModifVicePresident = 0;
		($_GET['modif'] == 'tresorier')?$forceModifTresorier = 1:$forceModifTresorier = 0;
		($_GET['modif'] == 'secretaire')?$forceModifSecretaire = 1:$forceModifSecretaire = 0;
	}else{
		$forceModifPresident = 0;
		$forceModifVicePresident = 0;
		$forceModifTresorier = 0;
		$forceModifSecretaire = 0;
	}
	ecrireFormulaireChangementStatusAsso('president',$status['president'],$status['courriel_president'],$forceModifPresident);
	ecrireFormulaireChangementStatusAsso('vicePresident',$status['vicePresident'],$status['courriel_vicePresident'],$forceModifVicePresident);
	ecrireFormulaireChangementStatusAsso('tresorier',$status['tresorier'],$status['courriel_tresorier'],$forceModifTresorier);
	ecrireFormulaireChangementStatusAsso('secretaire',$status['secretaire'],$status['courriel_secretaire'],$forceModifSecretaire);
	echo "</table>"
	."</div>";

//-- LES STATUS - Fin
//-- LES MEMBRES - D�but
echo "<a name='ancre_Membre' />";
echo "<script language='javascript'>"
	."
	function AfficheFormAjoutMembre(){
		afficherDIV('formAjoutMembre');
		cacherDIV('btn_ajoutMembre');
	}
	function AfficheBtnAjoutMembre(){
		cacherDIV('formAjoutMembre');
		afficherDIV('btn_ajoutMembre');	
	}
	function AfficheFormModification(id,identite,courriel){
		afficherDIV('formModifMembre');
		cacherDIV('tableauMembre');
		cacherDIV('btn_ajoutMembre');
		cacherDIV('formAjoutMembre');
		
		DIVModif = selectionnerDIV('modifMembre');
		CHAMPInput = DIVModif.getElementsByTagName('input');
		CHAMPInput[0].setAttribute('value',identite);
		CHAMPInput[1].setAttribute('value',courriel);
		CHAMPInput[2].setAttribute('value',id);
		
	}
	function AfficheTableauMembre(){
		cacherDIV('formModifMembre');
		afficherDIV('tableauMembre');
		afficherDIV('btn_ajoutMembre');
	}
	function AjoutInputMembre(){
		DIVajout = selectionnerDIV('formMembre');
		CHAMPInput = DIVajout.getElementsByTagName('input');
		NvxSaut = document.createElement('br');
		NvxChamp1 = document.createElement('input');
		NvxChamp2 = document.createElement('input');
		NvxChamp3 = document.createElement('label');
		NvxChamp4 = document.createElement('label');
		NumChamps = CHAMPInput.length/2 + 1;
		NvxChamp1.setAttribute('type','text');
		NvxChamp2.setAttribute('type','text');
		NvxChamp3.setAttribute('for','membre_'+NumChamps);
		NvxChamp4.setAttribute('for','courriel_'+NumChamps);
		NvxChamp3.innerHTML = 'Identit&eacute; :';
		NvxChamp4.innerHTML = 'Courriel :';
		NvxChamp1.setAttribute('name','membre_'+NumChamps);
		NvxChamp2.setAttribute('name','courriel_'+NumChamps);
		DIVajout.appendChild(NvxSaut);
		DIVajout.appendChild(NvxChamp3);
		DIVajout.appendChild(NvxChamp1);
		DIVajout.appendChild(NvxChamp4);
		DIVajout.appendChild(NvxChamp2);
	}
	btn_ajoutMembre_down = new Image();
	btn_ajoutMembre_down = 'images/picto-ajouterMembre_down.gif';
	btn_ajoutMembre_up = new Image();
	btn_ajoutMembre_up = 'images/picto-ajouterMembre_up.gif';
	btn_ajoutMembre_hover = new Image();
	btn_ajoutMembre_hover = 'images/picto-ajouterMembre_hover.gif';	
	</script>
	";
echo "<div class='conteneurGrand'>"
	."<h2 align='left' class='legende'>Membres</h2>"
	."<div id='btn_ajoutMembre' class='btn' onMouseDown='AfficheFormAjoutMembre()' style='float:right;'>"
		."<img src='images/picto-ajouterMembre_up.gif' onMouseOver='javascript:this.src=btn_ajoutMembre_hover;' onMouseOut='javascript:this.src=btn_ajoutMembre_up;' onMouseDown='javascript:this.src=btn_ajoutMembre_down;' alt='Ajouter un Membre'>"
	."</div><br />";
if($nbMembres != 0){
	echo "<div id='tableauMembre'><table border='0' width='530px'>";
	$class = array('utilisateurs','utilisateursInverse');
	$i=0;
	while($membres = mysql_fetch_assoc($req_membres)){
		echo "<tr><td class=".$class[$i%2].">"
			.$membres['membre']
			."</td><td class=".$class[$i%2].">"
			.$membres['courriel']
			."</td><td>"
			."<a href='./controlleurs/traitementAssociationSuppressionMembre.php?id={$membres['id_membre']}'><img alt='Supprimer' style='float:right;' src='images/picto-supprimer_up.gif' onMouseOver='javascript:this.src=btn_suppr_hover;' onMouseOut='javascript:this.src=btn_suppr_up;' onMouseDown='javascript:this.src=btn_suppr_down;'></a>"
			."&nbsp;"
			."<img alt='Modifier' style='float:right;' class='btn' src='images/picto-modifier_up.gif' onMouseOver='javascript:this.src=btn_modif_hover;' onMouseOut='javascript:this.src=btn_modif_up;' onMouseDown='javascript:this.src=btn_modif_down;' onClick='AfficheFormModification({$membres['id_membre']},\"{$membres['membre']}\",\"{$membres['courriel']}\")' />"
			."</td></tr>";
			$i++;
	}
	echo "</table></div>";
	echo "<div id='formModifMembre' style='display:none;' class='conteneurInterieur'>"
		."<h3 class='legende'>Modification d'un membre : </h3>"
		."<form action='./controlleurs/traitementAssociationModificationMembre.php' method='POST' class='membres'>"
		."<span id='modifMembre'>"
		."<label for='membre'>Identit&eacute; :</label><input type='text' name='membre' placeholder='Nom Pr&eacute;nom' />"
		."<label for='courriel'>Courriel :</label><input type='text' name='courriel' placeholder='courriel' />"
		."<input type='hidden' name='id'>"
		."</span>"
		."<br/><br/><span style='float:right;'>"
		."<input type='submit' name='save' class='tweet' value='[Modifier]' />"
		."&nbsp;"
		."<input type='button' value='[Annuler]' class='tweetReset' onClick='AfficheTableauMembre()' />"
		."</span>"
		."</form></div>";
}
echo "<div id='formAjoutMembre' style='display:none;' class='conteneurInterieur'>"
	."<h3 class='legende'>Ajout de membre(s) : </h3>"
	."<form action='./controlleurs/traitementAssociationAjoutMembre.php' method='POST' class='membres'>"
	."<span style='text-align:left;' id='formMembre'>"
		."<label for='membre_1'>Identit&eacute; :</label><input type='text' name='membre_1' placeholder='Nom Pr&eacute;nom' />"
		."<label for='courriel_1'>Courriel :</label><input type='text' name='courriel_1' placeholder='courriel' />"
	."</span>"
	."<img style='float:right;'src='images/picto-ajouterMembre_up.gif' onMouseOver='javascript:this.src=btn_ajoutMembre_hover;' onMouseOut='javascript:this.src=btn_ajoutMembre_up;' onMouseDown='javascript:this.src=btn_ajoutMembre_down;' onClick='AjoutInputMembre()' alt='Ajouter une Saisie'>"
	."<br/><br/><span style='float:right;'>"
	."<input type='submit' name='save' class='tweet' value='[Valider]' />"
	."&nbsp;"
	."<input type='button' value='[Annuler]' class='tweetReset' onClick='AfficheBtnAjoutMembre()' />"
	."</span>"
	."</form>"
	."</div>";
echo "<br /></div>";
//-- LES MEMBRES - Fin
//-- LES LIENS - D�but
echo "<a name='ancre_Lien'/>";
echo "<script language='javascript'>"
	."
	function AfficheFormAjoutLien(){
		afficherDIV('formAjoutLien');
		cacherDIV('btn_ajoutLien');
	}
	function AfficheBtnAjoutLien(){
		cacherDIV('formAjoutLien');
		afficherDIV('btn_ajoutLien');	
	}
	function AfficheFormModificationLien(id,adresse){
		afficherDIV('formModifLien');
		cacherDIV('tableauLien');
		cacherDIV('btn_ajoutLien');
		cacherDIV('formAjoutLien');
		
		DIVModif = selectionnerDIV('modifLien');
		CHAMPInput = DIVModif.getElementsByTagName('input');
		CHAMPInput[0].setAttribute('value',adresse);
		CHAMPInput[1].setAttribute('value',id);
		
	}
	function AfficheTableauLien(){
		cacherDIV('formModifLien');
		afficherDIV('tableauLien');
		afficherDIV('btn_ajoutLien');
	}
	function AjoutInputLien(){
		DIVajout = selectionnerDIV('formLien');
		CHAMPInput = DIVajout.getElementsByTagName('input');
		NvxSaut = document.createElement('br');
		NvxChamp1 = document.createElement('input');
		NvxChamp2 = document.createElement('label');
		NumChamps = CHAMPInput.length + 1;
		NvxChamp1.setAttribute('type','text');
		NvxChamp1.setAttribute('size','100');
		NvxChamp2.setAttribute('for','adresse_'+NumChamps);
		NvxChamp2.innerHTML = 'Adresse Internet Connexe :';
		NvxChamp1.setAttribute('name','adresse_'+NumChamps);
		DIVajout.appendChild(NvxSaut);
		DIVajout.appendChild(NvxChamp2);
		DIVajout.appendChild(NvxChamp1);
		
	}
	btn_ajoutLien_down = new Image();
	btn_ajoutLien_down = 'images/picto-ajouterLien_down.gif';
	btn_ajoutLien_up = new Image();
	btn_ajoutLien_up = 'images/picto-ajouterLien_up.gif';
	btn_ajoutLien_hover = new Image();
	btn_ajoutLien_hover = 'images/picto-ajouterLien_hover.gif';
	</script>
	";
echo "<div class='conteneurGrand' >"
	."<h2 align='left' class='legende'>Liens Connexes</h2>"
	."<div id='btn_ajoutLien' class='btn' style='float:right;' onMouseDown='AfficheFormAjoutLien()'><img src='images/picto-ajouterLien_up.gif' onMouseOver='javascript:this.src=btn_ajoutLien_hover;' onMouseOut='javascript:this.src=btn_ajoutLien_up;' onMouseDown='javascript:this.src=btn_ajoutLien_down;' alt='Ajouter un LienWeb Connexe'></div>";
if($nbLiens != 0){
	echo "<div id='tableauLien'><table border='0' align='center' width='700px'>";
	$class = array('utilisateurs','utilisateursInverse');
	$i=0;
	while($lien = mysql_fetch_assoc($req_liens)){
		echo "<tr><td class=".$class[$i%2].">"
			.$lien['libelle_lienWeb']
			."</td><td>"
			."<a href='./controlleurs/traitementAssociationSuppressionLien.php?id={$lien['id_lien']}'><img alt='Supprimer' style='float:right;' src='images/picto-supprimer_up.gif' onMouseOver='javascript:this.src=btn_suppr_hover;' onMouseOut='javascript:this.src=btn_suppr_up;' onMouseDown='javascript:this.src=btn_suppr_down;'></a>"
			."&nbsp;"
			."<img alt='Modifier' class='btn' style='float:right;' src='images/picto-modifier_up.gif' onMouseOver='javascript:this.src=btn_modif_hover;' onMouseOut='javascript:this.src=btn_modif_up;' onMouseDown='javascript:this.src=btn_modif_down;' onClick='AfficheFormModificationLien({$lien['id_lien']},\"{$lien['libelle_lienWeb']}\")'>"
			."</td></tr>";
			$i++;
	}
	echo "</table></div>";
	echo "<br /><div id='formModifLien' style='display:none;' class='conteneurGrand'>"
		."<h3 class='legende'>Modification d'un lien Web : </h3>"
		."<form action='./controlleurs/traitementAssociationModificationLien.php' method='POST' class='membres'>"
		."<span id='modifLien'>"
		."<label for='adresse'>Adresse Internet Connexe :</label><input type='text' size='100' name='adresse' placeholder='http:// .... ' />"
		."<input type='hidden' name='id'>"
		."</span><br/><br/><span style='float:right;'>"
		."<input type='submit' name='save' class='tweet' value='[Modifier]' />"
		."&nbsp;"
		."<input type='button' value='[Annuler]' class='tweetReset' onClick='AfficheTableauLien()' />"
		."</span>"
		."</form></div>";
}
echo "<br /><div id='formAjoutLien' style='display:none;' class='conteneurGrand'>"
	."<h3 class='legende'>Ajout de Lien(s) Web : </h3>"
	."<form action='./controlleurs/traitementAssociationAjoutLien.php' method='POST' class='membres'>"
	."<span id='formLien'>"
		."<label for='adresse_1'>Adresse Internet Connexe :</label><input type='text' size='100' name='adresse_1' placeholder='http:// .... ' />"
	."</span>"
	."<span style='float:right;'><img src='images/picto-ajouterLien_up.gif' onMouseOver='javascript:this.src=btn_ajoutLien_hover;' onMouseOut='javascript:this.src=btn_ajoutLien_up;' onMouseDown='javascript:this.src=btn_ajoutLien_down;' onClick='AjoutInputLien()' alt='Ajouter une Saisie'></span>"
	."<br/><br/>"
	."<span style='float:right;'>"
	."<input type='submit' name='save' class='tweet' value='[Valider]' />"
	."&nbsp;"
	."<input type='button' value='[Annuler]' class='tweetReset' onClick='AfficheBtnAjoutLien()' />"
	."</span>"
	."</form>"
	."</div>";
echo "</div>";
//-- LES LIENS - Fin