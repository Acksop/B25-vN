<?php
//----------------------------------------------------------------------
//  CrawlTrack 3.3.2
//----------------------------------------------------------------------
// Crawler Tracker for website
//----------------------------------------------------------------------
// Author: Jean-Denis Brun
//----------------------------------------------------------------------
// Website: www.crawltrack.net
//----------------------------------------------------------------------
// That script is distributed under GNU GPL license
//----------------------------------------------------------------------
// file: french.php
//----------------------------------------------------------------------
//  Last update: 17/11/2011
//----------------------------------------------------------------------
global $language;
$language= array();
//installation
$language['install']="Installation";
$language['welcome_install'] ="Bienvenue sur CrawlTrack, l'installation va se faire simplement en 3 &eacute;tapes.";
$language['menu_install_1']="1) Saisie des donn&eacute;es de connexion.";
$language['menu_install_2']="2) Param&eacute;trage des sites &agrave; auditer.";
$language['menu_install_3']="3) Cr&eacute;ation du compte administrateur.";
$language['go_install']="Installer";
$language['step1_install'] ="Veuillez saisir dans le formulaire ci-dessous les informations concernant les identifiants de connexion &agrave; la base de donn&eacute;es. Une fois le formulaire valid&eacute;, les tables et  le fichier de connexion vont &ecirc;tre automatiquement cr&eacute;&eacute;s.";
$language['step1_install_login_mysql']="Identifiant MySQL";
$language['step1_install_password_mysql']="Mot de passe MySQL";
$language['step1_install_host_mysql']="Serveur MySQL";
$language['step1_install_database_mysql']="Base MySQL";
$language['step1_install_table_mysql']="Pr&eacute;fixe des tables";
$language['step1_install_ok'] ="Fichier de connexion OK.";
$language['step1_install_ok2'] ="Cr&eacute;ation des tables OK.";
$language['step1_install_no_ok'] ="Il manque des informations pour cr&eacute;er les tables et le fichier de connexion, veuillez v&eacute;rifier les infos saisies dans le formulaire et revalider apr&egrave;s correction.";
$language['step1_install_no_ok2'] ="Le fichier n'a pas pu &ecirc;tre cr&eacute;&eacute;, v&eacute;rifier que le r&eacute;pertoire est en CHMOD 777.";
$language['step1_install_no_ok3'] ="Un probl&egrave;me est survenu lors de la cr&eacute;ation des tables, essayer de nouveau la proc&eacute;dure.";
$language['back_to_form'] ="Retour au formulaire de saisie";
$language['retry'] ="Essayer de nouveau";
$language['step2_install_no_ok']="La connexion &agrave; la base n'a pas pu s'effectuer, veuillez v&eacute;rifier les donn&eacute;es saisies.";
$language['step3_install_no_ok']="La s&eacute;lection de la base n'a pas pu s'effectuer, veuillez v&eacute;rifier les donn&eacute;es saisies.";
$language['step4_install']="Suite";
//site creation
//modified in 1.5.0
$language['set_up_site']="Veuillez noter ci-dessous le nom et l'url du site &agrave; auditer, le nom est celui qui sera utilis&eacute; pour identifier le site lors de l'utilisation de CrawlTrack. L'url du site doit &ecirc;te sous la forme :www.example.com (sans http :// au d&eacute;but ni / &agrave; la fin).";
$language['site_name']="Nom du site :";
//modified in 2.0.0
$language['site_no_ok']="Vous devez entrer un nom et une url de site.";
$language['site_ok']="Le site a &eacute;t&eacute; ajout&eacute; &agrave; la base de donn&eacute;es.";
$language['new_site']="Ajouter un autre site";
//tag creation
$language['tag']="Tag &agrave; ins&eacute;rer dans vos pages";
//modified in 2.3.0
$language['create_tag']="<p><b>Comment utiliser le tag CrawlTrack :</b><br><ul id=\"listtag\">
<li>le tag Crawltrack est un fichier php, vous devez le mettre sur une page en .php</li>
<li>le tag CrawlTrack doit &ecirc;tre entre les balises &#60;?php et ?&#62, si il n'y a pas ce type de balises sur votre page, vous devez les ajouter avant et apr&egrave;s le tag.</li>
<li>si votre site n'utilise pas des pages en .php, voir documentation sur www.crawltrack.net.</li>
<li>le mieux pour la protection anti piratage est que le tag CrawlTrack soit la premi&egrave;re chose sur votre page juste apr&egrave;s la balise &#60;?php.</li>
<li>si vous utiliser un CMS ou un forum, aller voir sur www.crawltrack.net/fr/doccms.php pour trouver la meilleurs solution pour placer le tag.</li>
<li>le tag CrawlTrack sera parfaitement invisible sur vos pages (y compris dans le code source).</li>
<li>si pour aider au d&eacute;veloppement de CrawlTrack vous souhaiter mettre un logo avec un lien vers www.crawltrack.net, vous trouverez plus bas des mod&egrave;les que vous pouvez mettre n'importe o&ugrave; sur vos pages.</li>
<li>pour toutes autres questions, voir la documentation sur www.crawltrack.net ou utiliser le forum de support sur le m&ecirc;me site.</li></ul></p><br>" ;
$language['site_name2']="Nom du site";
//modified in 1.5.0
$language['local_tag']="Tag standard, &agrave; utiliser pour un site h&eacute;berg&eacute; sur le m&ecirc;me serveur que CrawlTrack. ";
$language['non_local_tag']="Tag &agrave; utiliser si le site est h&eacute;berg&eacute; sur un autre serveur que Crawltrack, attention il faut dans ce cas que les fonctions fsockopen et fputs soit activ&eacute;es sur votre h&eacute;bergement.";
//login set_up
$language['admin_creation']="Cr&eacute;ation du compte administrateur";
$language['admin_setup']="Veuillez saisir ci-dessous l'identifiant et le mot de passe qui seront utilis&eacute;s par l'administrateur.";
$language['user_creation']="Cr&eacute;ation du compte utilisateur";
$language['user_setup']="Veuillez saisir ci-dessous l'identifiant et le mot de passe qui seront utilis&eacute;s par l'utilisateur.";
$language['user_site_creation']="Cr&eacute;ation du compte utilisateur-site";
$language['user_site_setup']="Veuillez saisir ci-dessous l'identifiant et le mot de passe qui seront utilis&eacute;s par l'utilisateur-site.";
$language['admin_rights']="L'administrateur a acc&egrave;s &agrave; la zone de configuration ainsi qu'aux stats de tous les sites audit&eacute;s.";
$language['login']="Identifiant";
$language['password']="Mot de passe";
$language['valid_password']="Saisissez une deuxi&egrave;me fois votre mot de passe.";
$language['login_no_ok']="Il manque des informations ou les mots de passe saisies sont diff&eacute;rents, veuillez v&eacute;rifier les infos saisies dans le formulaire et revalider apr&egrave;s correction.";
$language['login_ok']="Le compte a &eacute;t&eacute; cr&eacute;&eacute;.";
$language['login_no_ok2']="Un probl&egrave;me est survenu lors de la cr&eacute;ation du compte, essayer de nouveau la proc&eacute;dure.";
$language['login_user']="Cr&eacute;er un compte utilisateur";
$language['login_user_what']="Un utilisateur a acc&egrave;s &agrave; l'ensemble des stats des sites";
$language['login_user_site']="Cr&eacute;er un compte utilisateur-site";
$language['login_user_site_what']="Un utilisateur-site a acc&egrave;s aux stats d'un seul site";
//modified in 1.5.0
$language['login_finish']="L'installation est termin&eacute;e.N'oubliez pas de mettre le tag (disponible page outils <img src=\"./images/wrench.png\" width=\"16\" height=\"16\" border=\"0\" > ) sur les pages de votre site.";
//access
$language['restrited_access']="L'acc&egrave;s aux statistiques est prot&eacute;g&eacute;.";
$language['enter_login']="Veuillez saisir ci-dessous votre identifiant et votre mot de passe.";
//display
$language['crawler_name']="Robots";
//modifi&eacute; en 3.0.0
$language['nbr_visits']="Hits";
$language['nbr_pages']="Pages vues";
$language['date_visits']="Derni&egrave;re visite";
$language['display_period']="P&eacute;riode &eacute;tudi&eacute;e :";
$language['today']="Jour";
$language['days']="Semaine";
$language['month']="Mois";
$language['one_year']="Ann&eacute;e";
$language['no_visit']="Il n'y a pas eu de visite.";
$language['page']="Pages";
//modified in 1.5.0
$language['admin']="Outils";
$language['nbr_tot_visits']="Total hits";
$language['nbr_tot_pages']="Total pages vues";
$language['nbr_tot_crawlers']="Nbre de robots";
$language['visit_per-crawler']="D&eacute;tail des visites";
$language['100_visit_per-crawler']="D&eacute;tail des visites (affichage limit&eacute; &agrave; %d lignes).";
$language['user_agent']="User agent";
$language['Origin']="Utilisateur";
$language['help']="Aide";
//search
$language['search']="Recherche";
$language['search2']="Rechercher";
$language['search_crawler']="un robot";
$language['search_user_agent']="un user-agent";
$language['search_page']="une page";
$language['search_user']="un utilisateur de robot";
$language['go_search']="Chercher";
$language['result_crawler']="Voici les robots qui correspondent &agrave; votre recherche.";
$language['result_ua']="Voici les user-agents qui correspondent &agrave; votre recherche.";
$language['result_page']="Voici les pages qui correspondent &agrave; votre recherche.";
$language['result_user']="Voici les utilisateurs qui correspondent &agrave; votre recherche.";
$language['result_user_crawler']="Voici les robots de cet utilisateur.";
$language['result_user_1']="Utilisateur :&nbsp;";
$language['result_crawler_1']="Mot recherch&eacute; :&nbsp;";
$language['no_answer']="Il n'y a pas de r&eacute;ponse correspondant &agrave; votre recherche.";
$language['to_many_answer']="Il y a plus de 100 r&eacute;ponses (affichage limit&eacute; &agrave; 100 lignes).";
//admin
$language['user_create']="Cr&eacute;er un nouveau compte utilisateur.";
$language['user_site_create']="Cr&eacute;er un nouveau compte utilisateur-site.";
$language['new_site']="Ajouter un site &agrave; auditer.";
$language['see_tag']="Voir les tags &agrave; ins&eacute;rer.";
$language['new_crawler']="Ajouter un nouveau robot.";
$language['crawler_creation']="Veuillez compl&ecirc;ter le formulaire ci-dessous avec les donn&eacute;es du nouveau robot."; 
$language['crawler_name2']="Nom du robot :";
$language['crawler_user_agent']="User agent :";
$language['crawler_user']="Utilisateur du robot :";
$language['crawler_url']="Adresse de l'utilisateur (sous la forme http ://www.example.com)";
$language['crawler_url2']="Adresse de l'utilisateur :";
$language['crawler_no_ok']="Il manque des informations, veuillez v&eacute;rifier les infos saisies dans le formulaire et revalider apr&egrave;s correction.";
$language['exist']="Ce robot existe d&eacute;j&agrave; dans la base de donn&eacute;es";
$language['exist_data']="Voici les informations le concernant dans la base :";
$language['crawler_no_ok2']="Un probl&egrave;me est survenu lors de la cr&eacute;ation du robot, essayer de nouveau la proc&eacute;dure.";
$language['crawler_ok']="Le robot a &eacute;t&eacute; ajout&eacute; &agrave; la base de donn&eacute;es.";
$language['user_suppress']="Supprimer un compte utilisateur ou utilisateur-site.";
$language['user_list']="Liste des logins utilisateurs et utilisateur-sites";
$language['suppress_user']="Supprimer ce compte";
$language['user_suppress_validation']="Etes vous s&ucirc;r de vouloir supprimer ce compte?";
$language['yes']="Oui";
$language['no']="Non";
$language['user_suppress_ok']="Le compte a &eacute;t&eacute; supprim&eacute; avec succ&egrave;s.";
$language['user_suppress_no_ok']="Un probl&egrave;me est survenu lors de la suppression du compte, essayer de nouveau la proc&eacute;dure.";
$language['site_suppress']="Supprimer un site.";
$language['site_list']="Liste des sites";
$language['suppress_site']="Supprimer ce site";
$language['site_suppress_validation']="Etes vous s&ucirc;r de vouloir supprimer ce site?";
$language['site_suppress_ok']="Le site a &eacute;t&eacute; supprim&eacute; avec succ&egrave;s.";
$language['site_suppress_no_ok']="Un probl&egrave;me est survenu lors de la suppression du site, essayer de nouveau la proc&eacute;dure.";
$language['crawler_suppress']="Supprimer un robot.";
$language['crawler_list']="Liste des robots";
$language['suppress_crawler']="Supprimer ce robot";
$language['crawler_suppress_validation']="Etes vous s&ucirc;r de vouloir supprimer ce robot?";
$language['crawler_suppress_ok']="Le robot a &eacute;t&eacute; supprim&eacute; avec succ&egrave;s.";
$language['crawler_suppress_no_ok']="Un probl&egrave;me est survenu lors de la suppression du robot, essayer de nouveau la proc&eacute;dure.";
$language['crawler_test_creation']="Cr&eacute;er un robot de test.";
$language['crawler_test_suppress']="Supprimer le robot de test.";
$language['crawler_test_text']="Une fois le robot de test cr&eacute;&eacute;, allez visiter votre site avec l'ordinateur et le navigateur utilis&eacute;s pour cr&eacute;er le robot."; 
$language['crawler_test_text2']="Si tout va bien, votre visite apparaitra dans CrawlTrack comme &eacute;tant celle du robot Test-Crawltrack. N'oubliez pas ensuite de supprimer ce robot de test.";
$language['crawler_test_no_exist']="Le robot de test n'existe pas dans la base de donn&eacute;es.";
$language['exist_site']="Ce site existe d&eacute;j&agrave; dans la base de donn&eacute;es";
$language['exist_login']="Ce login existe d&eacute;j&agrave; dans la base de donn&eacute;es";
//1.2.0
$language['update_title']="Mise &agrave; jour de la liste de robots.";
$language['update_crawler']="Mettre &agrave; jour la liste de robots.";
$language['list_up_to_date']="Il n'y a pas de mise &agrave; jour disponible actuellement.";
$language['update_ok']="La mise &agrave; jour s'est bien pass&eacute;e.";
$language['crawler_add']="robots ont &eacute;t&eacute; ajout&eacute;s &agrave; la base de donn&eacute;es";
$language['no_access']="La mise &agrave; jour en ligne ne fonctionne pas.<br><br>Pour mettre &agrave; jour veuillez cliquer sur le lien ci-dessous pour t&eacute;l&eacute;charger la derni&egrave;re liste de robot, placez le fichier crawlerlist.php dans le r&eacute;pertoire include de CrawlTrack et relancez la proc&eacute;dure de mise &agrave; jour.";
$language['no_access2']="La liaison avec CrawlTrack.net a &eacute;chou&eacute;, veuillez r&eacute;essayer ult&eacute;rieurement.";
$language['download_update']="Si vous avez d&eacute;j&agrave; t&eacute;l&eacute;charg&eacute; et upload&eacute; sur votre site la liste de robot, cliquez sur le bouton ci-dessous pour faire la mise &agrave; jour.";
$language['download']="T&eacute;l&eacute;charger la liste de robot";
$language['your_list']="La liste que vous utilisez est :";
$language['crawltrack_list']="La liste disponible sur Crawltrack.net est :";
$language['no_update']="Ne pas mettre &agrave; jour la liste.";
$language['no_crawler_list']="Le fichier crawlerlist.php n'est pas pr&eacute;sent dans votre r&eacute;pertoire include";
//1.3.0
$language['use_user_agent']="La d&eacute;tection peux se faire par le user agent ou par l'IP. Vous devez donc mettre l'une ou l'autre des informations.";
$language['user_agent_or_ip']="User agent ou IP";
$language['crawler_ip']="IP :";
$language['table_mod_ok']="Modification de la table crawlt_crawler OK.";
$language['files_mod_ok']="Modification des fichiers configconnect.php et crawltrack.php OK.";
$language['update_crawltrack_ok']="La mise &agrave; jour de CrawlTrack est termin&eacute;e, vous utilisez maintenant la version :";
$language['table_mod_no_ok']="La modification  de la table crawlt_crawler n'a pas pu se faire.";
$language['files_mod_no_ok']="Il y a eu un probl&egrave;me lors de la mise &agrave; jour des fichiers configconnect.php et crawltrack.php.";
$language['update_crawltrack_no_ok']="La mise &agrave; jour de CrawlTrack n'a pas pu se faire.";
//modified in 2.3.0
$language['no_logo']="Pas de logo.";
//modified in 1.5.0

//modified in 2.0.0


//1.4.0
$language['time_set_up']="D&eacute;calage horaire";
$language['server_time']="Date et heure du serveur =";
$language['local_time']="Date et heure locale=";
$language['time_difference']="Diff&eacute;rence en heures entre l'heure du serveur et l'heure locale=";
$language['time_server']="Vous utilisez actuellement l'heure du serveur, voulez vous que les donn&eacute;es soient affich&eacute;es en utilisant votre heure locale ?";
$language['time_local']="Vous utilisez actuellement l'heure locale, voulez vous que les donn&eacute;es soient affich&eacute;es en utilisant votre heure du serveur ?";
$language['decal_ok']="CrawlTrack, utilisera maintenant votre heure locale; vous pouvez &agrave; tout moment revenir en heure serveur";
$language['nodecal_ok']="CrawlTrack, utilisera maintenant l'heure du serveur; vous pouvez &agrave; tout moment revenir en heure locale";
$language['need_javascript']="Vous devez activer javascript pour utiliser cette fonctionnalit&eacute;.";
//1.5.0 
$language['origin']="Provenance";
$language['crawler_ip_used']="IP utilis&eacute;es";
$language['crawler_country']="Pays d'origine";
$language['other']="Autres";
$language['pc-page-view']="Part du site visit&eacute;e";
$language['pc-page-noview']="Part du site non visit&eacute;e";
$language['print']="Imprimer";
$language['ip_suppress_ok']="Les visites ont &eacute;t&eacute; supprim&eacute;e avec succ&egrave;s.";
$language['ip_suppress_no_ok']="Un probl&egrave;me est survenu lors de la suppression des visites, essayer de nouveau la proc&eacute;dure.";
$language['no_ip']="Il n'y a pas eu d'IP enregistr&eacute;e sur la p&eacute;riode.";
$language['ip_suppress_validation']="Cette IP a &eacute;t&eacute; utilis&eacute;e par plusieurs robots diff&eacute;rents, il y a donc un doute sur l'origine r&eacute;elle de ces 
visites.Voulez vous supprimer les visites correspondantes &agrave; cette IP de la base?";
$language['ip_suppress_validation2']="Etes vous s&ucirc;r de vouloir supprimer les visites venant de cette IP de la base de donn&eacute;es?";
$language['ip_suppress_validation3']="Si vous voulez interdire l'acc&egrave;s &agrave; votre site depuis cette IP, ajoutez la ligne suivante dans votre fichier .htaccess 
&agrave; la racine de votre site :";
$language['ip_suppress']="Supprimer une IP";
$language['diff-day-before']="par rapport &agrave; la veille";
$language['daily-stats']="Statistiques journali&egrave;res";
$language['top-crawler']="Robot le plus actif :";
$language['stat-access']="Voir les statistiques d&eacute;taill&eacute;es";
$language['stat-crawltrack']="Ces donn&eacute;es sont enregistr&eacute;es grâce &agrave; :";
$language['nbr-pages-top-crawler']="Il a visit&eacute;";
$language['of-site']="du site";
$language['mail']="Recevoir un r&eacute;sum&eacute; journalier par Email.";
$language['set_up_mail']="Si vous voulez recevoir un r&eacute;sum&eacute; journalier de vos statistiques par Email, entrez ci-dessous votre adresse Email.";
$language['email-address']="Adresse Email :";
$language['address_no_ok']="L'adresse que vous avez saisie n'est pas correcte.";
$language['set_up_mail2']="L'envoi du r&eacute;sum&eacute; journalier par Email est actuellement activ&eacute;. Voulez vous le d&eacute;sactiver?";
$language['update']="La modification a &eacute;t&eacute; prise en compte";
$language['no-visits-day-before']="Il n'y a pas eu de visites hier.";
$language['search_ip']="Localiser une adresse IP";
$language['ip']="Adresse IP";
$language['maxmind']="La g&eacute;olocalisation a &eacute;t&eacute; faite en utilisant la base de donn&eacute;es GeoLite cr&eacute;&eacute;e par Maxmind disponible &agrave; l'adresse suivante :";
$language['ip_no_ok']="L'adresse IP que vous avez saisie n'est pas correcte.";
$language['public']="Mettre les statistiques en acc&egrave;s libre.";
$language['public-set-up2']="L'acc&egrave;s aux statistiques est actuellement libre, voulez vous le prot&eacute;ger par mot de passe?";
$language['public-set-up']="L'acc&egrave;s aux statistiques est actuellement prot&eacute;g&eacute; par mot de passe, voulez vous le rendre libre?";
$language['public2']="Seul l'acc&egrave;s &agrave; la page Outils restera prot&eacute;g&eacute;e par votre mot de passe";
$language['admin_protected']="L'acc&egrave;s &agrave; la page Outils est prot&eacute;g&eacute;.";
$language['no_data_to_suppress']="Il n'y a pas de donn&eacute;es &agrave; archiver pour la p&eacute;riode demand&eacute;e.";
$language['data_suppress3']="L'archivage des donn&eacute;es permet de r&eacute;duire la taille de la base de donn&eacute;es, mais en contre partie
les donn&eacute;es correspondantes ne sont plus accessibles dans les pages de statistiques. Apr&egrave;s l'archivage, vous trouverez dans le dossier archive les fichiers permettant en cas de besoin de remettre les donn&eacute;es dans la base en utilisant phpMyAdmin.";
$language['archive']="Archives";
$language['month2']="Mois";
$language['top_visits']="Top 3 en nombre de visites";
$language['top_pages']="Top 3 en nombre de pages vues";
$language['no-archive']="Il n'y a pas de donn&eacute;es archiv&eacute;es.";
$language['use-archive']="Attention une partie des donn&eacute;es a &eacute;t&eacute; archiv&eacute;e, ces valeurs sont donc tronqu&eacute;es.";
$language['url_update']="Mettre &agrave; jour les donn&eacute;es des sites";
$language['set_up_url']="Compl&eacute;tez le tableau ci-dessous en mettant les urls des sites sous la forme : www.example.com (sans http :// au d&eacute;but ni / &agrave; la fin)."; 
$language['site_url']="Url du site :";
//1.6.0
$language['page_cache']="Dernier calcul : ";
//1.7.0
$language['step1_install_no_ok4']="Un probl&egrave;me est survenu lors du remplissage de la table des IP, cela arrive sur certain h&eacute;bergements car cette table comporte plus de 78 000 enregistrements. Vous pouvez soit essayer de nouveau la proc&eacute;dure, soit continuer sans cette table. Dans ce cas les pays d'origine des robots ne pourront pas &ecirc;tre d&eacute;termin&eacute;s. Sur la page 'Probl&egrave;mes connus' de la documentation sur www.crawltrack.net vous trouverez un moyen pour remplir la table des IP manuellement. ";
$language['show_all']="Voir toutes les lignes";
$language['from']="du";
$language['to']="au";
$language['firstweekday-title']="Choix du 1er jour de la semaine";
$language['firstweekday-set-up2']="Le premier jour de la semaine est actuellement le lundi, voulez vous changer pour le dimanche?";
$language['firstweekday-set-up']="Le premier jour de la semaine est actuellement le dimanche, voulez vous changer pour le lundi?";
$language['01']="Janvier";
$language['02']="F&eacute;vrier";
$language['03']="Mars";
$language['04']="Avril";
$language['05']="Mai";
$language['06']="Juin";
$language['07']="Juillet";
$language['08']="Ao&ucirc;t";
$language['09']="Septembre";
$language['10']="Octobre";
$language['11']="Novembre";
$language['12']="D&eacute;cembre";
$language['day0']="Lundi";
$language['day1']="Mardi";
$language['day2']="Mercredi";
$language['day3']="Jeudi";
$language['day4']="Vendredi";
$language['day5']="Samedi";
$language['day6']="Dimanche";
//2.0.0
$language['ask']="Ask";
$language['google']="Google";
$language['msn']="Bing";  //change for 3.1.1
$language['yahoo']="Yahoo";
$language['delicious']="Del.icio.us";
$language['index']="Indexation";
$language['keyword']="Mots clefs";
$language['entry-page']="Pages d'entr&eacute;e";
$language['searchengine']="Moteur de recherche";
$language['social-bookmark']="Social bookmarks";
$language['tag']="Tags";
$language['nbr_tot_bookmark']="Bookmarks";
$language['nbr_tot_link']="Liens vers votre site";
$language['nbr_tot_pages_index']="Pages index&eacute;es";
$language['nbr_visits_crawler']="Nombre de visites du robot";


$language['100_lines']="Affichage limit&eacute; &agrave; %d lignes.";
$language['8days']="Depuis 8 jours";
$language['close']="Fermer la fen&ecirc;tre";
$language['date']="Date";
$language['modif_site']="Modifier le nom o&ugrave; l'url d'un site.";
$language['site_url2']="Url du site";
$language['modif_site2']="Modifier les donn&eacute;es de ce site.";
$language['n/a']="N/A";
$language['no-info-day-before']="Pas d'information pour la veille";
$language['data_human_suppress_ok']="Les donn&eacute;es ont &eacute;t&eacute; supprim&eacute;es avec succ&egrave;s.";
$language['data_human_suppress_no_ok']="Un probl&egrave;me est survenu lors de la suppression des donn&eacute;es, essayer de nouveau la proc&eacute;dure.";
$language['data_human_suppress_validation']="Etes vous s&ucirc;r de vouloir supprimer toutes les &nbsp;";
$language['data_human_suppress']="Suppression des donn&eacute;es les plus anciennes de la table des visites d'internautes (mots clefs et pages d'entr&eacute;es).";
$language['data_human_suppress2']="Supprimer les";
$language['one_year_human_data']="donn&eacute;es vieilles de plus d'un an";
$language['six_months_human_data']="donn&eacute;es vieilles de plus de six mois";
$language['one_month_human_data']="donn&eacute;es vieilles de plus d'un mois";
$language['data_human_suppress3']="La suppresion des donn&eacute;es permet de r&eacute;duire la taille de la base de donn&eacute;es, mais en contre partie
les donn&eacute;es correspondantes ne sont plus accessibles dans les pages de statistiques. Il est donc conseiller de ne faire la suppression que si il faut absolument r&eacute;duire la taille 
la base de donn&eacute;es; les donn&eacute;es supprim&eacute;es n'&eacute;tant absolument pas r&eacute;cup&eacute;rables.";
$language['no_data_human_to_suppress']="Il n'y a pas de donn&eacute;es &agrave; supprimer pour la p&eacute;riode demand&eacute;e.";
$language['choose_language']="Choisissez votre langue.";
//2.1.0
$language['since_beginning']="Tout";
//2.2.0
$language['admin_database']="Voir la taille de la base de donn&eacute;es";
$language['table_name']="Nom de la table";
$language['nbr_of_data']="Nombre d'enregistrements";
$language['table_size']="Taille de la table";
$language['database_size']="Taille de la base de donn&eacute;es";
$language['total']="Total :";
$language['mailsubject']="R&eacute;sum&eacute; journalier CrawlTrack";
$language['beginmonth']="Depuis le d&eacute;but du mois";
$language['evolution']="Evolution par rapport &agrave;";
$language['lastthreemonths']="3 derniers mois";
$language['set_up_mail3']="Vous utilisez actuellement les adresses suivantes :";
$language['set_up_mail4']="Ajouter une adresse";
$language['set_up_mail5']="Entrez ci-dessous l'adresse Email suppl&eacute;mentaire.";
$language['set_up_mail6']="Supprimer une ou plusieurs adresses";
$language['set_up_mail7']="Supprimer les adresses s&eacute;lectionn&eacute;es";
$language['chmod_no_ok']="Le fichier crawltrack.php n'a pas pu &ecirc;tre modifi&eacute;, mettez  le r&eacute;pertoire de CrawlTrack en CHMOD 777 et relancez la mise &agrave; jour. N'oubliez pas ensuite pour des raisons de s&eacute;curit&eacute; de le remettre en CHMOD 711.";
$language['display_parameters']="Param&egrave;tres d'affichage";
$language['ordertype']="Classement :";
$language['orderbydate']="par date et heure de visite";
$language['orderbypagesview']="par nombre de pages vues";
$language['orderbyvisites']="par nombre de visites";
$language['orderbyname']="par ordre alphab&eacute;tique";
$language['numberrowdisplay']="Nombre de lignes affich&eacute;es :";
//2.2.1
$language['french']="Français";
$language['english']="Anglais";
$language['german']="Allemand";
$language['spanish']="Espagnol";
$language['turkish']="Turc";
$language['dutch']="Hollandais";
//2.3.0
$language['hacking']="Attaques";
$language['hacking2']="Tentatives de piratage";
$language['hacking3']="Injection de code";
$language['hacking4']="Injection SQL";
$language['no_hacking']="CrawlTrack n'a pas d&eacute;tect&eacute; de tentatives";
$language['attack_detail']="D&eacute;tail des attaques qui n'ont pas donn&eacute;es une erreur 404";
$language['attack']="Param&egrave;tres utilis&eacute;s pour les tentatives d'injection de code";
$language['attack_sql']="Param&egrave;tres utilis&eacute;s pour les tentatives d'injection SQL";
$language['bad_site']="Fichier/script que le hacker a tent&eacute; d'injecter";
$language['bad_sql']="Requ&egrave;te sql que le hacker a tent&eacute; d'injecter";
$language['bad_url']="Url demand&eacute;es";
$language['hacker']="Attaquants";
$language['date_hacking']="Heures";
$language['unknown']="Inconnu";
$language['danger']="Vous pouvez &ecirc;tre expos&eacute; si vous utilisez un de ces scripts";
$language['attack_number_display']="D&eacute;tails des attaques qui n'ont pas donn&eacute;es une erreur 404 (affichage limit&eacute; &agrave; %d attaquants).";
$language['update_attack']="Mettre &agrave; jour la liste des attaques."; 
$language['no_update_attack']="Ne pas mettre &agrave; jour la liste des attaques.";
$language['update_title_attack']="Mise &agrave; jour de la liste des attaques.";
$language['attack_type']="Type d'attaque";
$language['parameter']="Param&egrave;tre";
$language['script']="Script";
$language['attack_add']="attaques ont &eacute;t&eacute; ajout&eacute;es &agrave; la base de donn&eacute;es";
$language['no_access_attack']="La mise &agrave; jour en ligne ne fonctionne pas.<br><br>Pour mettre &agrave; jour veuillez cliquer sur le lien ci-dessous pour t&eacute;l&eacute;charger la derni&egrave;re liste d'attaques, placez le fichier attacklist.php dans le r&eacute;pertoire include de CrawlTrack et relancez la proc&eacute;dure de mise &agrave; jour.";
$language['download_update_attack']="Si vous avez d&eacute;j&agrave; t&eacute;l&eacute;charg&eacute; et upload&eacute; sur votre site la liste d'attaques, cliquez sur le bouton ci-dessous pour faire la mise &agrave; jour.";
$language['download_attack']="T&eacute;l&eacute;charger la liste d'attaques.";
$language['no_attack_list']="Le fichier attacklist.php n'existe pas dans votre r&eacute;pertoire include.";
$language['change_password']="Changer votre mot de passe";
$language['old_password']="Mot de passe actuel";
$language['new_password']="Nouveau mot de passe";
$language['valid_new_password']="Entrer une deuxi&egrave;me fois votre nouveau mot de passe.";
$language['goodsite_update']="Mettre &agrave; jour la liste de sites de confiance";
$language['goodsite_list']="Sites de confiance";
$language['goodsite_list2']="Un lien vers un de ces sites pr&eacute;sent dans une url n'est pas consid&eacute;r&eacute; comme une attaque.";
$language['goodsite_list3']="Liste actuelle des sites de confiance";
$language['suppress_goodsite']="Supprimer ce site de la liste.";
$language['goodsite_suppress_validation']="Etes vous s&ucirc;r de vouloir supprimer ce site?";
$language['good_site']="Site de confiance";
$language['goodsite_suppress_ok']="Le site a &eacute;t&eacute; supprim&eacute; avec succ&egrave;s.";
$language['goodsite_suppress_no_ok']="Un probl&egrave;me est survenu lors de la suppression du site, essayer de nouveau la proc&eacute;dure.";
$language['list_empty']="Il n'y a pas de site de confiance";
$language['add_goodsite']="Ajouter un site de confiance dans la liste";
$language['goodsite_no_ok']="Vous devez entrer une url de site.";
$language['attack-blocked']="Toutes ces attaques ont &eacute;t&eacute; bloqu&eacute;es par CrawlTrack comme demand&eacute;";
$language['attack-no-blocked']="Attention, votre CrawlTrack n'est pas param&egrave;tr&eacute; pour bloquer ces attaques (voir page outils)";
$language['attack_parameters']="Param&egrave;tres de protection anti-piratage";
$language['attack_action']="Action en cas de d&eacute;tection d'une attaque";
$language['attack_block']="L'enregistrer et la bloquer";
$language['attack_no_block']="Seulement l'enregistrer";
$language['attack_block_alert']="Avant de choisir le bloquage des attaques, ce qui est le mieux pour la s&eacute;curit&eacute; de votre site, lisez la documentation (sur www.crawltrack.net) pour 
&ecirc;tre s&ucirc;r qu'il n'y aura pas de probl&egrave;me avec vos visiteurs normaux.";
$language['crawltrack-backlink']="CrawlTrack est gratuit, si vous l'appr&eacute;cier et voulez le faire connaitre pourquoi ne pas mettre un lien vers www.crawltrack.net sur vos pages?<br>Si vous choisissez
l'option pas de logo, ce lien sera invisible. Vous avez ci-dessous deux options pour chaque logo, une en php et la deuxi&egrave;me en html. Vous pouvez mettre ce lien &agrave; n'importe quelle position sur vos pages.";
$language['session_id_parameters']="Traitement des identifiants de session";
$language['remove_session_id']="Retirer les identifiants de session des url";
$language['session_id_alert']="Enlever les identifiants de session des url, va &eacute;viter les entr&eacute;es multiples dans la table des pages si vous avez un script qui ajoute des identifiants de session dans l'url.";
$language['session_id_used']="Identifiants de session utilis&eacute;s";
//3.0.0
$language['webmaster_dashboard']="Tableau de bord du webmaster";
$language['summary']="R&eacute;sum&eacute; tous sites";
$language['charge']="Charge serveur";
$language['unidentified']="Non identifi&eacute;s";
$language['display_period2']="Choix p&eacute;riode";
$language['visitors']="Visiteurs";
$language['unique_visitors']="Visiteurs uniques";
$language['visits']="Visites";
$language['nbr_tot_visits2']="Total visites";
$language['nbr_tot_visits3']="Total";
$language['referer']="Affluents";
$language['website']="Sites internets & autres moteurs";
$language['website2']="sites";
$language['website3']="Sites internet";
$language['country']="pays";
$language['direct']="Entr&eacute;es directes";
$language['average_pages']="Pages vues par visites";
$language['stats_visitors']="Statistiques visiteurs";
$language['count_in_stats']="Ne pas compter vos propres visites dans les sites suivants :";
$language['stats_visitors_other_domain']="Si l'un des sites concern&eacute; est h&eacute;berg&eacute; sur un autre serveur (utilisation du tag 
le plus long); il faut copier le fichier crawltsetcookie.php (vous le trouverez dans le r&eacute;pertoire php de CrawlTrack) &agrave; la racine de ce site avant de cliquer sur OK pour que votre choix puisse &ecirc;tre pris en compte.";
$language['main_crawlers']="Robots principaux";
$language['magnifier']="Faire une recherche dans la base de donn&eacute;es de CrawlTrack";
$language['refresh']="Vider le cache et recalculer les donn&eacute;es";
$language['wrench']="Acc&egrave;der &agrave; la page d'administration de votre CrawlTrack";
$language['printer']="Imprimer la page en cours";
$language['information']="Documentation sur www.crawltrack.net";
$language['help']="A propos de CrawlTrack";
$language['cross']="Se d&eacute;connecter";
$language['home']="Retour &agrave; l'accueil";
$language['badreferer']="Etes vous sur de vouloir mettre ce domaine dans la liste des spammeurs de referer? Une fois celui-ci ajouter dans cette liste, les visites venant de ce domaine ne seront plus prises en compte par CrawlTrack.";
$language['spamreferer']="Mettre ce domaine dans la liste des spammeurs";
$language['badreferer_update']="Mettre &agrave; jour la liste de sites spammeurs de referer";
$language['add_badreferer']="Ajouter un site spammeur de referer dans la liste";
$language['listbadreferer_empty']="Il n'y a pas de site spammeur de referer";
$language['badreferer_list']="Sites spammeurs de referer";
$language['badreferer_list2']="Les visites venant de ces sites ne seront pas prises en compte par CrawlTrack.";
$language['badreferer_list3']="Liste actuelle des sites spammeurs de referer";
$language['badreferer_site']="Site spammeurs de referer";

$language['goodreferer']="Etes vous sur de vouloir mettre ce domaine dans la liste des sites qui ont un lien vers votre site? Une fois celui-ci ajouter dans cette liste, les visites venant de ce domaine seront prises en compte par CrawlTrack sans nouveau contrôle.";
$language['goodreferer2']="Mettre ce domaine dans la liste des sites qui ont un lien vers votre site";

$language['goodreferer_update']="Mettre &agrave; jour la liste des sites qui ont un lien vers votre site";
$language['add_goodreferer']="Ajouter un site qui a un lien vers votre site dans la liste";
$language['listgoodreferer_empty']="Il n'y a pas de site qui ont un lien vers votre site";
$language['goodreferer_list']="Sites qui ont un lien vers votre site";
$language['goodreferer_list2']="Les visites venant de ces sites seront prises en compte par CrawlTrack sans nouveau contrôle.";
$language['goodreferer_list3']="Liste actuelle des sites qui ont un lien vers votre site";
$language['goodreferer_site']="Site qui a un lien vers votre site";

$language['download']="T&eacute;l&eacute;chargements";
$language['file']="Fichier";
$language['download_period']="Sur la p&eacute;riode";
$language['download_link']="Compteur de t&eacute;l&eacute;chargements";
$language['download_link2']="<b>Pour que vos t&eacute;l&eacute;chargements soient compt&eacute;s par CrawlTrack :</b><br><br>
-le fichier propos&eacute; en t&eacute;l&eacute;chargement doit &ecirc;tre h&eacute;berg&eacute; sur un des sites suivis par CrawlTrack.<br>
-le lien de t&eacute;l&eacute;chargement(pour un fichier dont l'adresse est http ://www.example.com/dossier/fichier.zip) doit &ecirc;tre de la forme :";
$language['download_link3']="http ://www.example.com/dossier/fichier.zip";
$language['download_link4']="C'est tout, aucune autre manipulation n'est n&eacute;cessaire.";
$language['error']="Erreurs 404";
$language['number']="Nombre";
$language['outer-referer']="Liens externes";
$language['inner-referer']="Liens internes";
$language['error-attack']="Dont tentatives de piratage";
$language['total_hacking']="Nombre total d'attaques";
$language['error_hacking']="Attaques qui ont donn&eacute;es une erreur 404";
$language['error_page']="Url demand&eacute;es";
$language['crawler_error']="D&eacute;tail des erreurs 404 venant de robots";
$language['direct_error']="D&eacute;tail des erreurs 404 dues &agrave; une arriv&eacute;e directe";
$language['extern_error']="D&eacute;tail des erreurs 404 dues &agrave; un lien externe au site";
$language['intern_error']="D&eacute;tail des erreurs 404 dues &agrave; un lien interne au site";
$language['error_referer']="Url d'origine";
$language['404_no_in_graph']="Ces attaques ne sont pas prises en compte pour le nombre d'Ip, le graphe et le tableau de d&eacute;tail.";
$language['404_no_in_graph2']="Les attaques qui ont abouties &agrave; une erreur 404 n'apparaissent pas sur le graphe.";
$language['exalead']="Exalead";
$language['connect']="Vous &ecirc;tes identifi&eacute;";
$language['connect_you']="S'identifier";
$language['notcheck']="Lien non v&eacute;rifi&eacute;, clickez sur 'V&eacute;rifier les liens' pour lancer la v&eacute;rification.";
$language['checklink']="V&eacute;rifier les liens";
$language['linkok']="Lien valid&eacute;";
$language['first_date_visits']="Premi&egrave;re visite";
$language['next_visits']="Prochaine visite";
$language['data_suppress']="R&eacute;duire la taille de la base de donn&eacute;es."; //modified in 3.0.0
$language['data_suppress2']="Supprimer ";
$language['other_bot']="toutes les visites de robot sauf celles de Ask Jeeves/Teoma, Exabot, Googlebot, MSN Bot et Slurp Inktomi (Yahoo)";
$language['one_year_data']="toutes les visites de robot vieilles de plus d'un an";
$language['six_months_data']="toutes les visites de robot vieilles de plus de six mois";
$language['five_months_data']="toutes les visites de robot vieilles de plus de cinq mois";
$language['four_months_data']="toutes les visites de robot vieilles de plus de quatre mois";
$language['three_months_data']="toutes les visites de robot vieilles de plus de trois mois";
$language['two_months_data']="toutes les visites de robot vieilles de plus de deux mois";
$language['one_month_data']="toutes les visites de robot vieilles de plus d'un mois";
$language['one_year_data_human']="toutes les donn&eacute;es visiteurs vieilles de plus d'un an";
$language['six_months_data_human']="toutes les donn&eacute;es visiteurs vieilles de plus de six mois";
$language['five_months_data_human']="toutes les donn&eacute;es visiteurs vieilles de plus de cinq mois";
$language['four_months_data_human']="toutes les donn&eacute;es visiteurs vieilles de plus de quatre mois";
$language['three_months_data_human']="toutes les donn&eacute;es visiteurs vieilles de plus de trois mois";
$language['two_months_data_human']="toutes les donn&eacute;es visiteurs vieilles de plus de deux mois";
$language['one_month_data_human']="toutes les donn&eacute;es visiteurs vieilles de plus d'un mois";
$language['attack_data']="toutes les donn&eacute;es concernant les tentatives de piratages";
$language['oldest_data']="La donn&eacute;e la plus ancienne date du &nbsp;";
$language['no_data']="Il n'y a pas de donn&eacute;e dans la table des visites.";
$language['no_data_to_suppress']="Il n'y a pas de donn&eacute;es &agrave; supprimer pour la p&eacute;riode demand&eacute;e.";
$language['data_suppress3']="Attention!!! La suppression des donn&eacute;es permet de r&eacute;duire la taille de la base de donn&eacute;es, mais en contre partie les donn&eacute;es sont irr&eacute;m&eacute;diablement perdues.";
$language['data_suppress_ok']="Les donn&eacute;es ont &eacute;t&eacute; supprim&eacute;es avec succ&egrave;s.";
$language['data_suppress_no_ok']="Un probl&egrave;me est survenu lors de la suppression des donn&eacute;es, essayer de nouveau la proc&eacute;dure.";
$language['data_suppress_validation']="Etes vous s&ucirc;r de vouloir supprimer toutes les &nbsp;";
$language['deltatime']="Fr&eacute;quence de visite";
$language['nbr_tot_visit_seo']="Origine des visites";
$language['url_parameters']="Param&egrave;tres dans les url";
$language['remove_parameter']="Retirer les param&egrave;tres des url";
$language['remove_parameter_alert']="Enlever les param&egrave;tres des url, va &eacute;viter que la table des pages ne grossisse &eacute;xag&eacute;r&eacute;ment, par contre toute url du type : www.example.com/index.php?article=225 ne sera plus enregistr&eacute;e que sous la forme www.example.com/index.php ce qui donnera moins de d&eacute;tails sur les pages visit&eacute;es.";
$language['bookmark']="Utilisez cette adresse pour mettre cette page dans vos favoris";
$language['evolution']="Tendance nombre de visiteurs uniques";
$language['perday']="par jour";
$language['shortterm']="7 derniers jours :";
$language['longterm']="30 derniers jours :";
$language['bounce_rate']="Taux de rebond";
$language['visit_summary']="Visites cumul&eacute;es sur l'ensemble des sites";
$language['data']="Donn&eacute;es";
$language['index']="Index";
$language['sponsorship']="Ils supportent CrawlTrack :";
//3.1.0
$language['browser']="Navigateurs";
$language['visitor-browser']="Navigateurs utilis&eacute;s par les visiteurs";
$language['hits-per-hour']="Hits par heure";
$language['russian']="Russe";
//3.1.2
$language['besponsor']="Utilisez CrawlTrack pour faire connaitre vos produits et services &agrave; des milliers de webmasters.";
$language['ad-on-crawltrack']="<a href=\"http://www.ad42.com/zone.aspx?idz=6690&ida=-1\" target=\"_blank\">Et si vous utilisiez CrawlTrack pour faire connaitre vos produits et services &agrave; des milliers de webmasters?</a>";
//3.2.0
$language['baidu']="Baidu";
$language['googleposition']="Position<br>dans Google";
$language['position']="Position actuelle";
$language['positiononemonth']="Position il y a un mois";
$language['positiontwomonth']="Position il y a deux mois";
$language['positionthreemonth']="Position il y a trois mois";
$language['googledetail']="D&eacute;tail position dans Google et nombre de hits correspondant";
//3.2.3
$language['bulgarian']="Bulgare";
//3.2.8
$language['italian']="Italien";
$language['two_year_data']="toutes les visites de robot vieilles de plus de deux ans";
$language['two_year_data_human']="toutes les donn&eacute;es visiteurs vieilles de plus de deux ans";
//3.3.1
$language['googleimage']="Google-Images";
//3.3.2
$language['yandex']="Yandex";
$language['aol']="Aol";
$language['no_visitors_stats']="Compter seulement les robots";
$language['no_visitors_stats2']="Ne compter aucune visite";
$language['no_cookie']="Vous devez param&ecirc;trer votre navigateur pour accepter les cookies";
//country code
$country = array(
"ad" => "Andorre",
"ae" => "Emirats Arabes Unis",
"af" => "Afghanistan",
"ag" => "Antigua et Barbuda",
"ai" => "Anguilla",
"al" => "Albanie",
"am" => "Arm&eacute;nie",
"an" => "Antilles Neerlandaises",
"ao" => "Angola",
"ap" => "Asie/Pacifique",
"aq" => "Antarctique",
"ar" => "Argentine",
"as" => "American Samoa",
"at" => "Autriche",
"au" => "Australie",
"aw" => "Aruba",
"az" => "Azerbaidjan",
"ba" => "Bosnie Herz&eacute;govine",
"bb" => "Barbade",
"bd" => "Bangladesh",
"be" => "Belgique",
"bf" => "Burkina Faso",
"bg" => "Bulgarie",
"bh" => "Bahrein",
"bi" => "Burundi",
"bj" => "B&eacute;nin",
"bm" => "Bermudes",
"bn" => "Brunei",
"bo" => "Bolivie",
"br" => "Br&eacute;sil",
"bs" => "Bahamas",
"bt" => "Bhoutan",
"bw" => "Botswana",
"by" => "Bi&eacute;lorussie",
"bz" => "B&eacute;lize",
"ca" => "Canada",
"cd" => "R&eacute;p. d&eacute;m. du Congo",
"cf" => "R&eacute;p Centrafricaine",
"cg" => "Congo",
"ch" => "Suisse",
"ci" => "Côte d'Ivoire",
"ck" => "Cook (&icirc;les)",
"cl" => "Chili",
"cm" => "Cameroun",
"cn" => "Chine",
"co" => "Colombie",
"cr" => "Costa Rica",
"cs" => "Serbie et Mont&eacute;n&eacute;gro",    
"cu" => "Cuba",
"cv" => "Cap Vert",
"cx" => "Christmas (&icirc;le)",
"cy" => "Chypre",
"cz" => "Tch&eacute;quie",
"de" => "Allemagne",
"dj" => "Djibouti",
"dk" => "Danemark",
"dm" => "Dominique",
"do" => "R&eacute;p Dominicaine",
"dz" => "Alg&eacute;rie",
"ec" => "Equateur",
"ee" => "Estonie",
"eg" => "Egypte",
"er" => "Erythr&eacute;e",
"es" => "Espagne",
"et" => "Ethiopie",
"fi" => "Finlande",
"fj" => "Fidji",
"fk" => "Malouines (&icirc;les)",
"fm" => "Micron&eacute;sie",
"fo" => "Faroe (&icirc;les)",
"fr" => "France",
"ga" => "Gabon",
"gb" => "Grande Bretagne",   
"gd" => "Grenade",
"ge" => "G&eacute;orgie",
"gf" => "Guyane Française",
"gg" => "Guernesey",
"gh" => "Ghana",
"gi" => "Gibraltar",
"gl" => "Groenland",
"gm" => "Gambie",
"gn" => "Guin&eacute;e",
"gp" => "Guadeloupe",
"gq" => "Guin&eacute;e Equatoriale",
"gr" => "Gr&egrave;ce",
"gs" => "G&eacute;orgie du sud",
"gt" => "Guatemala",
"gu" => "Guam",
"gw" => "Guin&eacute;e-Bissau",
"gy" => "Guyana",
"hk" => "Hong Kong",
"hn" => "Honduras",
"hr" => "Croatie",
"ht" => "Haiti",
"hu" => "Hongrie",
"id" => "Indon&eacute;sie",
"ie" => "Irlande",
"il" => "Isra&euml;l",
"im" => "Ile de Man",
"in" => "Inde",
"io" => "Ter. Brit. Oc&eacute;an Indien",
"iq" => "Iraq",
"ir" => "Iran",
"is" => "Islande",
"it" => "Italie",
"je" => "Jersey",
"jm" => "Jama&iuml;que",
"jo" => "Jordanie",
"jp" => "Japon",
"ke" => "Kenya",
"kg" => "Kirghizistan",
"kh" => "Cambodge",
"ki" => "Kiribati",
"km" => "Comores",
"kn" => "Saint Kitts et Nevis",
"kr" => "Cor&eacute;e du sud",
"kw" => "Kowe&iuml;t",
"ky" => "Ca&iuml;manes (&icirc;les)",
"kz" => "Kazakhstan",
"la" => "Laos",
"lb" => "Liban",
"lc" => "Sainte Lucie",
"li" => "Liechtenstein",
"lk" => "Sri Lanka",
"lr" => "Liberia",
"ls" => "Lesotho",
"lt" => "Lituanie",
"lu" => "Luxembourg",
"lv" => "Lettonie",
"ly" => "Libye",
"ma" => "Maroc",
"mc" => "Monaco",
"md" => "Moldavie",
"me" => "Mont&eacute;n&eacute;gro",
"mg" => "Madagascar",
"mh" => "Marshall (&icirc;les)",
"mk" => "Mac&eacute;doine",
"ml" => "Mali",
"mm" => "Myanmar",
"mn" => "Mongolie",
"mo" => "Macao",
"mp" => "Mariannes du nord (&icirc;les)",
"mq" => "Martinique",
"mr" => "Mauritanie",
"mt" => "Malte",
"mu" => "Maurice (&icirc;le)",
"mv" => "Maldives",
"mw" => "Malawi",
"mx" => "Mexique",
"my" => "Malaisie",
"mz" => "Mozambique",
"na" => "Namibie",
"nc" => "Nouvelle Cal&eacute;donie",
"ne" => "Niger",
"nf" => "Norfolk (&icirc;le)",
"ng" => "Nig&eacute;ria",
"ni" => "Nicaragua",
"nl" => "Pays Bas",
"no" => "Norv&egrave;ge",
"np" => "N&eacute;pal",
"nr" => "Nauru",
"nu" => "Niue",
"nz" => "Nouvelle Z&eacute;lande",
"om" => "Oman",
"pa" => "Panama",
"pe" => "P&eacute;rou",
"pf" => "Polyn&eacute;sie Française",
"pg" => "Papouasie Nvelle Guin&eacute;e",
"ph" => "Philippines",
"pk" => "Pakistan",
"pl" => "Pologne",
"pm" => "Saint Pierre et Miquelon",
"pr" => "Porto Rico",
"ps" => "Territoires Palestiniens",   
"pt" => "Portugal",
"pw" => "Palau",
"py" => "Paraguay",
"qa" => "Qatar",
"re" => "R&eacute;union (&icirc;le de la)",
"ro" => "Roumanie",
"ru" => "Russie",
"rs" => "Russie",
"rw" => "Rwanda",
"sa" => "Arabie Saoudite",
"sb" => "Salomon (&icirc;les)",
"sc" => "Seychelles",
"sd" => "Soudan",
"se" => "Su&egrave;de",
"sg" => "Singapour",
"sh" => "St. H&eacute;l&egrave;ne",
"si" => "Slov&eacute;nie",
"sj" => "Svalbard/Jan Mayen (&icirc;les)",
"sk" => "Slovaquie",
"sl" => "Sierra Leone",
"sm" => "Saint-Marin",
"sn" => "S&eacute;n&eacute;gal",
"so" => "Somalie",
"sr" => "Suriname",
"st" => "Sao Tome et Principe",
"sv" => "Salvador",
"sy" => "Syrie",
"sz" => "Swaziland",
"tc" => "Turques-et-Ca&iuml;ques (&icirc;les)",
"td" => "Tchad",
"tf" => "Territoires Fr du sud",
"tg" => "Togo",
"th" => "Thailande",
"tj" => "Tadjikistan",
"tk" => "Tokelau",
"tl" => "Timor Leste",   
"tm" => "Turkm&eacute;nistan",
"tn" => "Tunisie",
"to" => "Tonga",
"tr" => "Turquie",
"tt" => "Trinit&eacute; et Tobago",
"tv" => "Tuvalu",
"tw" => "Taiwan",
"tz" => "Tanzanie",
"ua" => "Ukraine",
"ug" => "Ouganda",
"us" => "&eacute;tats-Unis",
"uy" => "Uruguay",
"uz" => "Ouzb&eacute;kistan",
"va" => "Vatican",
"vc" => "St Vincent et les Grenadines",
"ve" => "Venezuela",
"vg" => "Vierges Brit. (&icirc;les)",
"vi" => "Vierges USA (&icirc;les)",
"vn" => "Vi&ecirc;t Nam",
"vu" => "Vanuatu",
"wf" => "Wallis et Futuna",
"ws" => "Western Samoa",
"ye" => "Yemen",
"yt" => "Mayotte",
"za" => "Afrique du Sud",
"zm" => "Zambie",
"zw" => "Zimbabwe",
"xx" => "Inconnu",
"a2" => "Inconnu",
"eu" => "Union Europ&eacute;enne",  
);
?>
