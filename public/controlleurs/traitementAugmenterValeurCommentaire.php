<?php
session_start();
include("../scriptPHP/connectionBDD.php");

$id_commentaire = $_GET['id_commentaire'];
$id_article = $_GET['id_article'];

$rate = recuperationValeurCommentaire($id_commentaire);
$rate = $rate + 1;
modifierValeurCommentaire($id_commentaire,$rate);

header("location: ../index.php?page=reactionArticle&id=".$id_article."#formulaire");
?>
