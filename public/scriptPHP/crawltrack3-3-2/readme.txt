++ NEW ++ CRAWLTRACK 3-3-3 
Addition by Acksop ( acksop@yahoo.fr )

Intégration simplifié sur les sites de type MVC standard ( index.php?VARPAGE=NOMPAGE )
Double utilisation possible lors d'une intégration MVC standard ( en root: http://hostname.tld/path/to/crawltrack/index.php )
								( intégré: http://hostname.tld/index.php?VARPAGE=VARCRAWLTRACKPAGE )

Actions réalisées:
******************

 -- Redéfinition de tous les chemins include par la variable dirname(__FILE__) afin de permettre une simplicité de manipulation
 -- Redefinition de tous les chemins de liens ( qu'ils soient en POST ou en GET ) des pages ./include/ et controlleurs ./php/ par l'instantiation de variables à l'installation VARPAGE VARCRAWLTRACKPAGE et PATHtoCRAWLTRACKFromINDEX ( *chemin_CT* )
 -- Redefinition de tous les chemins d'image et de graphs par l'instantiation d'une variable de chemin
 -- Modification de configconnect.php et crawltrack.php
 -- Ajout de variables et de tests de chemin serveurs au sein de configconnect.php
 -- modification du fichier index.php afin d'obtenir une double utlisation de crawltrack : intégré au MVC et en rootPath
 -- Ajout d'un fichier sessions.php ( évite les duplication de codes )
 -- Ajout d'une variable de session 'inMVC' permettant de connaître lors de la première utilisation si l'index, le header et le footer fonctionne en rootPath ou intégré à un MVC
 -- suppression des fonctions de sessions dépréciées
 
 **( relicat de l'intégration au [B25] )**
 
 -- Ajout de fonctions d'affichage ( 2 différents cadre de coins arrondis ) >> functions_alternate_display.php
 -- modification de certains styles d'affichage ainsi que d'une routine permettant la mise en place de lignes de couleurs alternées
 -- 				TODO: intégrer la routine à toutes les pages afin d'optimiser la vitesse de traitement
 -- Ajout d'une feuille de style personnelle >> alternate_style.css
 -- Ajout des fichiers menumain_original.php et menusite_original.php liés directement aux menumain.php et menusite.php ; modifiés lors de l'intégration au [B25] puis rajouté afin de garder le menu original de crawltrack
 -- 
 
 Installation :
 **************
 
 Lancez l'installation de crawltrack en accédant à la page index.php en rootPath, modifiez les variables disponible lors du choix de la BDD, au pire vous pourrez toujours les changer manuellement sur le fichier ./include/configconnect.php
 Puis modifiez la page de deconnexion dans l'index.php à la ligne 180-181 pour la faire coincider avec votre page d'acceuil MVC.












Crawltrack 3.3.2

README
------

-First installation:

Once the files upload on your website, you just have to enter your CrawlTrack url in your
browser and follow the instructions to install CrawlTrack.
You will find more details information on the official website : http://www.crawltrack.net

-Upgrade from a previous version:

Upload on your website all the new files, taking care not to destroy the crawltrack.php file at the root
of your crawltrack folder and the configconnect.php file in the include folder.
Thats all what you have to do. You will keep all your datas, just the config will be updated.

If you are using the second tag (the biggest one with http request) from a version before the 3.0.0, you need to replace the tag on your page
to be able to use that version.

Once Crawltrack install, don't forget to add your site to the Crawltrack users directory:
http://www.crawltrack.net/user-list/english.html



LISEZ MOI
---------

-Première installation:

Une fois les fichier uploadés sur votre site, il suffit d'entrer l'adresse de votre crawltrack
dans votre navigateur et de suivre les instructions pour installer Crawltrack.
Vous trouverez des informations plus détaillées sur le site officiel: http://www.crawltrack.net/fr

-Mise à jour à partir d'une version précédente:

Uploadez sur votre site les nouveaux fichiers, en prenant garde de ne pas écraser le fichier crawltrack.php à la racine
du répertoire crawltrack et le fichier configconnect.php dans le répertoire include.
C'est tout ce que vous avez à faire. Vos données sont conservées, seul la configuration sera mise à jour.

Si vous utilisiez le deuxième tag (le plus long, avec la requète http) d'une version avant la 3.0.0, il faut remplacer
le tag Crawltrack sur vos pages pour pouvoir utiliser cette version.

Une fois CrawlTrack installé, n'oubliez pas d'inscrire votre site dans l'annuaire des utilisateurs de Crawltrack:
http://www.crawltrack.net/user-list/french.html
