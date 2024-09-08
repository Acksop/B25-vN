++ NEW ++ CRAWLTRACK 3-3-3 
Addition by Acksop ( acksop@yahoo.fr )

Int�gration simplifi� sur les sites de type MVC standard ( index.php?VARPAGE=NOMPAGE )
Double utilisation possible lors d'une int�gration MVC standard ( en root: http://hostname.tld/path/to/crawltrack/index.php )
								( int�gr�: http://hostname.tld/index.php?VARPAGE=VARCRAWLTRACKPAGE )

Actions r�alis�es:
******************

 -- Red�finition de tous les chemins include par la variable dirname(__FILE__) afin de permettre une simplicit� de manipulation
 -- Redefinition de tous les chemins de liens ( qu'ils soient en POST ou en GET ) des pages ./include/ et controlleurs ./php/ par l'instantiation de variables � l'installation VARPAGE VARCRAWLTRACKPAGE et PATHtoCRAWLTRACKFromINDEX ( *chemin_CT* )
 -- Redefinition de tous les chemins d'image et de graphs par l'instantiation d'une variable de chemin
 -- Modification de configconnect.php et crawltrack.php
 -- Ajout de variables et de tests de chemin serveurs au sein de configconnect.php
 -- modification du fichier index.php afin d'obtenir une double utlisation de crawltrack : int�gr� au MVC et en rootPath
 -- Ajout d'un fichier sessions.php ( �vite les duplication de codes )
 -- Ajout d'une variable de session 'inMVC' permettant de conna�tre lors de la premi�re utilisation si l'index, le header et le footer fonctionne en rootPath ou int�gr� � un MVC
 -- suppression des fonctions de sessions d�pr�ci�es
 
 **( relicat de l'int�gration au [B25] )**
 
 -- Ajout de fonctions d'affichage ( 2 diff�rents cadre de coins arrondis ) >> functions_alternate_display.php
 -- modification de certains styles d'affichage ainsi que d'une routine permettant la mise en place de lignes de couleurs altern�es
 -- 				TODO: int�grer la routine � toutes les pages afin d'optimiser la vitesse de traitement
 -- Ajout d'une feuille de style personnelle >> alternate_style.css
 -- Ajout des fichiers menumain_original.php et menusite_original.php li�s directement aux menumain.php et menusite.php ; modifi�s lors de l'int�gration au [B25] puis rajout� afin de garder le menu original de crawltrack
 -- 
 
 Installation :
 **************
 
 Lancez l'installation de crawltrack en acc�dant � la page index.php en rootPath, modifiez les variables disponible lors du choix de la BDD, au pire vous pourrez toujours les changer manuellement sur le fichier ./include/configconnect.php
 Puis modifiez la page de deconnexion dans l'index.php � la ligne 180-181 pour la faire coincider avec votre page d'acceuil MVC.












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

-Premi�re installation:

Une fois les fichier upload�s sur votre site, il suffit d'entrer l'adresse de votre crawltrack
dans votre navigateur et de suivre les instructions pour installer Crawltrack.
Vous trouverez des informations plus d�taill�es sur le site officiel: http://www.crawltrack.net/fr

-Mise � jour � partir d'une version pr�c�dente:

Uploadez sur votre site les nouveaux fichiers, en prenant garde de ne pas �craser le fichier crawltrack.php � la racine
du r�pertoire crawltrack et le fichier configconnect.php dans le r�pertoire include.
C'est tout ce que vous avez � faire. Vos donn�es sont conserv�es, seul la configuration sera mise � jour.

Si vous utilisiez le deuxi�me tag (le plus long, avec la requ�te http) d'une version avant la 3.0.0, il faut remplacer
le tag Crawltrack sur vos pages pour pouvoir utiliser cette version.

Une fois CrawlTrack install�, n'oubliez pas d'inscrire votre site dans l'annuaire des utilisateurs de Crawltrack:
http://www.crawltrack.net/user-list/french.html
