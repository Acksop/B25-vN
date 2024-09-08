<?php
function AfficheArchivesArticles(){
	
	$nbArticles = recuperationNbArticles();
	echo "<div id='carousselDesArticles'>";
	for($i=0; $i<=$nbArticles; $i=$i+4 ){
	
		echo "<div id='ArticlesPar4'>";
		cadreAlignCentrerDebut();
		echo "<table border='0' align='center'>"
		."<tr>";
		$req_articles = recuperationArticleLimitMinTotal($i);
		while($article = mysql_fetch_assoc($req_articles)){
			AjouterLectureArticleAfficher($article['id_article']);
			echo "<td valign='top' align='center' class='article' width='200px'>"
				."<img src='images/articles/".$article['image']."' width='200px' height='500px'>"
				."<hr/><p align='left' class='titre'>".check_ChaineDeCaracteresDownload($article['titre'])."</p><hr/>"
				."<p align='center' class='article'>".check_ChaineDeCaracteresDownload($article['corps'])."</p><hr/>"
				."<p align='right' class='article'>Id&eacute;ologie:&nbsp;&nbsp;".recuperationIdeologie($article['id_ideologie'])."</p>"
				."<p align='right' class='article'>Th&ecirc;me:&nbsp;&nbsp;".recuperationTheme($article['id_theme'])."</p>"
				."<p align='right' class='date'>".$article['date']."</p>"
				."<p align='right' class='article'><a href='index.php?page=reactionArticle&id=".$article['id_article']."'>".calculNbCommentairesArticle($article['id_article'])." commentaire(s) <img src='images/commentaires.gif' width='15px' heigth='15px'></a></p>"
				."<p align='right' class='post'>Auteur:&nbsp;&nbsp;".recuperationAuteur($article['id_utilisateur'])."</p>";
			if( isset($_SESSION['type_compte'])){
				if($_SESSION['type_compte'] == '0'){
					echo "<p> Lu ".AfficheNbLectureArticle($article['id_article'])." fois...</p> ";
					echo "<form method='get' action='controlleurs/traitementSuppressionArticle.php'>"
					."<input type='hidden' name='id' value='".$article['id_article']."'/><input type='submit' value='Supprimer'/>"
					."</form>";
					echo "<a href='index.php?page=correctionArticle&id=".$article['id_article']."'>Corriger La(Les) faute(s)</a>";
				}else{
					if($_SESSION['id_utilisateur'] == $article['id_utilisateur']){
						echo "<p> Lu ".AfficheNbLectureArticle($article['id_article'])." fois...</p> ";
						echo "<form method='get' action='controlleurs/traitementSuppressionArticle.php'>"
						."<input type='hidden' name='id' value='".$article['id_article']."'/><input type='submit' value='Supprimer'/>"
						."</form>";
						echo "<a href='index.php?page=correctionArticle&id=".$article['id_article']."'>Corriger La(Les) faute(s)</a>";
					}
				}
			}
	
			echo "</td>";
		}
		echo "</tr></table>";
		cadreAlignCentrerFin();	
		echo"	</div>";
		}
	echo "</div>";

}