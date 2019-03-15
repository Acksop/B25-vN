<?php
header("Content-Type: text/plain ; charset=UTF-8");
require '../variablesApplication.php';
include ("../scriptPHP/connectionBDD.php");

$id_artiste = $_POST['idA'];
$num_bloc_prochain = $_POST['index'] + 1;
$num_bloc_actuel = $_POST['index'];
$nb_buzz_par_div = 10;
$nb_buzz_sur_nouvelle_page = $nb_buzz_par_div * $num_bloc_prochain;
$nb_buzz_sur_ancienne_page = $nb_buzz_par_div * $num_bloc_actuel;
$i = $nb_buzz_sur_ancienne_page;

$admin = $_POST['abs'];

$buzz = recuperationDesDerniersBUZZArtiste($id_artiste, $nb_buzz_sur_ancienne_page, $nb_buzz_par_div);
$nb_buzz_total = recuperationNbBUZZTotalArtiste($id_artiste);

while ($data = exploiterLigneResultatBDD($buzz)) {
    $tweet = recuperationTweetArtiste($data['id_buzz'], $data['type']);
    $data2 = exploiterLigneResultatBDD($tweet);
    switch ($data['type']) {
        case 0:
            echo "<div id='block_BUZZ_{$i}' class='bloc_murUtilisateur'>";
            echo "<p class='murUtilisateurs'><tt>" . check_ChaineDeCaracteresDownload($data2['text']) . "</tt></p>";
            echo "</div>";
            break;
        case 1:
            echo "<div id='block_BUZZ_{$i}' class='bloc_murUtilisateur'>";
            echo "<center><p class='murUtilisateurs'><img src='" . RADIEURAE_SVN_PATH . $data2['image'] . "' alt='" . $data2['nomImage'] . "'/><br/><tt>" . check_ChaineDeCaracteresDownload($data2['text']) . "</tt>";
            if ($admin == 1) {
                echo "<span style='float:right;'><a href='javascript:;' onClick='AJAXSupprimerBUZZ({$data['id_buzz']},{$i});'>Supprimer?</a></span>";
            }
            echo "</p></center>";
            echo "</div>";
            break;
        case 2:
            echo "<div id='block_BUZZ_{$i}' class='bloc_murUtilisateur'>";
            echo "<center><p class='murUtilisateurs'>";
            echo "<object type='application/x-shockwave-flash' id='mplayer476bf6c9c6489' data='lecteurMp3/mplayer.swf' wmode='transparent' height='24' width='290'><br><param name='movie' value='lecteurMp3/mplayer.swf'><param name='FlashVars' value='playerID=mplayer476bf6c9c6489&amp;bg=0xF8F8F8&amp;leftbg=0xebebeb&amp;lefticon=0x666666&amp;rightbg=0xd20560&amp;rightbghover=0x2c7d9c&amp;righticon=0xFFFFFF&amp;righticonhover=0xFFFFFF&amp;text=0x4f5458&amp;slider=0xd20560&amp;track=0xFFFFFF&amp;border=0x666666&amp;loader=0xebebeb&amp;soundFile={$data2['son']}'><param name='quality' value='high'><param name='menu' value='false'><param name='wmode' value='transparent'></object>";
            echo "<b>" . check_ChaineDeCaracteresDownload($data2['nomMp3']) . "</b><br/><tt>" . check_ChaineDeCaracteresDownload($data2['text']) . "</tt>";
            if ($admin == 1) {
                echo "<span style='float:right;'><a href='javascript:;' onClick='AJAXSupprimerBUZZ({$data['id_buzz']},{$i});'>Supprimer?</a></span>";
            }
            echo "</p></center>";
            echo "</div>";
            break;
        case 3:
            echo "<div id='block_BUZZ_{$i}' class='bloc_murUtilisateur'>";
            echo "<center><p class='murUtilisateurs'>" . check_ChaineDeCaracteresDownload($data2['codeConnexe']) . "<br/><tt>" . check_ChaineDeCaracteresDownload($data2['text']) . "</tt>";
            if ($admin == 1) {
                echo "<span style='float:right;'><a href='javascript:;' onClick='AJAXSupprimerBUZZ({$data['id_buzz']},{$i});'>Supprimer?</a></span>";
            }
            echo "</p></center>";
            echo "</div>";
            break;
        default:
    }
    $i ++;
}
// echo "</div>";
if ($nb_buzz_total > ($nb_buzz_sur_nouvelle_page + $nb_buzz_par_div)) {
    echo "<div id='block{$num_bloc_prochain}_mur'><span style='float:right;'><a href='javascript:;' onClick='AJAXAugmenterMur({$num_bloc_prochain});'>Do you wanna More ? </a></span>";
}

?>
