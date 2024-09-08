# B25-V1.5 build with MVC---Procedural

Cette coquille-template complète est le fruit d'un travail qui n'est plus disponible sur les toiles du réseau des réseaux, il est aussi le fruit d'un travail d'archarné pendant près de 5ans avec toutes les casquettes possibles et imaginables qu'ils sont possible d'imaginer lorsque l'on crééé un site informatique depuis une simple page vide. Réellement personne ne m'a aidé sur le long terme, programmatiquement parlant....

Il est installable sur un poste en local afin de comprendre comment le B25.fr a été codé mais n'est plus maintenu, veuiller choisir la vN si vous voulez participer au projet...

Les fichiers SQL des bases de données utilisées sont dans le dossier `/version1` ce sont les fichiers `dump*`... Vous remarquerez peut être que le B25 utilise 3 bases de données, une pour les maps Google (http://bradwedell.com/php-google-maps-api/), une autre pour les statistiques Crawltrack (projet qui est malheureusement maintenant abandonné -- http://www.crawltrack.fr/), et la dernière pour le site lui-même.

Afin de réaliser les connexions Mysql avec le programme vous devrez modifier les fichers contenant les identifiants de chaque base de données dans le dossier `/version1`, ces fichiers commencent par `identifiants*`.

Le dossier `/radieurae` doit-être disponible sur un virtual host. Tout comme que le dossier `/version1/public/` .

Le dossier `/radieurae` contient les upload-utilisateurs de la plate-forme et le dossier `/version1/public` contient lui la version 1.5 (aussi nommé 3.0c en raison du nombre d'interfaces) du site-mère original.

Il vous faudra aussi réferencer les FQDN de la radieurae dans le fichier `/version1/localisation_Domaines_externes_B25.php`, et si vous ne changez pas l'emplacement du dossier `/radieurae`vous n'aurez pas besoin de modifier la constante SVNRADIEURAE_DIR.

Enfin vous devrez dans ce même fichier (`/version1/localisation_Domaines_externes_B25.php` ) référencer le FQDN local du virtualhost du FR que vous avez précédemment créé. Je vous conseille vivement des FQDN du type `v1.besancon25.local` et `radieaurae.besancon25.local` . Les `.dev` étant dépréciés depuis 2016, voir même avant...

Cette version du projet est disponible gratuitement pour celui qui souhaitera tenter l'expérience de programmation de groupe autour du B25.

Afin de travailler sur la vN (https://github.com/Acksop/B25-vN) : il vous suffit de copier le dossier `version1/public` à la place du précédent. C'est un peu hasardeux mais c'est comme çà. Pour les plus courageux vous pouvez cloner le dépot du vN à coté de  `/version1` et ajouter les fichiers identifiants manquants, qui sont quasiment les mêmes. Et s'il y a erreur, je suis disposé à la corriger.


> ## **La plate-forme du B25**
> 
> est un **annuaire unique** pour les artistes, artisans, associations,
> groupe musicaux **de Besançon et de ses
> alentours**.   Elle s'articule autour d'une présentation simple et
> personnalisable d'une page personnelle différente pour chaque
> catégorie d'acteur socio-économique Bisontins.

![Souris de Noël](https://besançon25.fr/images/NouvelAn/2015/sourisDeNoel.png)


## Remerciements 


Remerciement Javascript:

>  - SortTable http://www.kryogenix.org/code/browser/sorttable/
>  - MooTools 1.2.4 http://mootools.net
>  - MootoolsCarousel , MootoolsPeriodicalExecuter  https://github.com/tbela99
>  - LiveJs http://livejs.com
>  - JsChart http://jscharts.com
>  - Ajax-xHR https://www.xul.fr/Objet-XMLHttpRequest.php
>  - Recursion Toy http://soulwire.co.uk/experiments/recursion-toy/

Remerciement PHP

>  - Crawltrack 3-3-2 http://www.crawltrack.fr/ 
>  - EasyGoogleMap http://bradwedell.com/php-google-maps-api/ 
>  - SimpleHtmlDom https://simplehtmldom.sourceforge.io/
>  - TinyMCE https://www.tiny.cloud/
>  - W-code  https://codes-sources.commentcamarche.net/source/30779-wcode-mise-en-forme-a-la-bbcode

Remerciement CSS

> - Gabarit Elephorm CSS [Florens Verschelde](https://fvsch.com/)
> > http://blog.elephorm.com/apprendre-xhtml-css/
> > https://fvsch.com/gabarits-html/html/

Remerciement Personnel:

> - Nicolas GAINON pour son idée originale
> - Florian VENTURI pour son petit plus


Vous pouvez aussi consulter la documentation fonctionnelle de cette version du B25, sur la page dédié à celle-ci à l'adresse suivante : https://wikini.besançon25.fr/wakka.php?wiki=SiteMere ...


Mes sincères salutations à ceux qui voudront bien s'y intéresser...
