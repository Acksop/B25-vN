<?php
include ('../../scriptPHP/repertoire.php');
include ('../../scriptPHP/connectionBDD.php');

$sql = "SELECT * FROM utilisateur";
$req = faireUneRequeteOffLine($sql);

while ($data = mysql_fetch_assoc($req)) {
    if ($data['repertoirePersonnel'] == '') {
        $nouveauNomRepertoirePersonnel = chaineAleatoire() . recupererDatePourNouveauRepertoireUtilisateur();
        $sql = "UPDATE utilisateur SET repertoirePersonnel = '{$nouveauNomRepertoirePersonnel}' WHERE id_utilisateur='{$data['id_utilisateur']}'";
        faireUneRequeteOffLine($sql);
        recreerRepertoiresUtilisateur($nouveauNomRepertoirePersonnel);
    } else {
        recreerRepertoiresUtilisateur($data['repertoirePersonnel']);
    }
    
    echo $data['pseudo'] . "<br/>";
}

// ERREUR D'ENCODAGE ENTRE PHP ET LINUX ...___... CORRIGE PAR UN NOM DE REPERTOIRE DIFFERENTS DU LOGIN-IN

// header("location: ../index.php");
?>
