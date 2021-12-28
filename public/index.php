<?php
$debut_memoire = memory_get_usage();
$debut = $_SERVER['REQUEST_TIME'];
$dateFormat = date("m-d-Y");
include ('fonctionCourante.php');
include ('scriptPHP/memoire.php');
session_start();
connectes();
$ip = $_SERVER['REMOTE_ADDR'];
//statistiques CrawlTrack
global $crawltsite;$crawltsite=8;
include("modeles/App/crawltrack3-3-4/crawltrack.php");

// initialisation de la variable page pour eviter les erreurs 404
if (! isset($_GET['page'])) {
    $page = "index";
} else {
    $page = $_GET['page'];
}
// chargement des variables pour un meilleur réferencement
ChargerVariablesInitialesHeader($page);
// chargement du modele et de ses fonctions pour la page courante
ChargerModeleEtFonctionsDeLaPage($page);
// convertir les variables du header pour que Google les affichent lisiblement
ConvertirVariablesHeader($page);
?>

<!DOCTYPE HTML >
<html>
<head>
<title><?php echo $header_title ?></title>
<!-- ------------------------------------------------------------------------------------------------------------------------------------ -->
<!--						BALISES DE META-RECHERCHES								-->
<META charset="UTF-8">

<!-- 																				 -->

<META NAME="Category" CONTENT="Plate-forme">
<META NAME="Publisher" CONTENT="INFO[ARTS]MEDIA">
<META NAME="Copyright" CONTENT="© - 2010 - Info[ARTS]Media">
<META NAME="Expires" CONTENT="Never Maybe!">
<META NAME="Distribution" CONTENT="Global">
<META NAME='Description' lang='fr'
	CONTENT="<?php echo $header_description ?>">
<META NAME='Identifier-URL'
	CONTENT="<?php echo $header_identifier_url ?>">
<META NAME='Keywords' lang='fr' CONTENT="<?php echo $header_keywords ?>">
<META NAME="Author" CONTENT="Emmanuel ROY & More ...">
<META NAME="Reply-to" CONTENT="contact@besancon25.info">
<META NAME="Date-Creation-yyyymmdd" CONTENT="20090317">
<META NAME="Date-Revision-yyyymmdd" CONTENT="20100712">
<META NAME="Revisit-After" CONTENT="30 days">
<META NAME="Robots" CONTENT="index, nofollow">
<META NAME="viewport" CONTENT="width=device-width, initial-scale=1">
<META NAME="GOOGLEBOT" CONTENT="NOARCHIVE">
<!--																	-->
<!-- ------------------------------------------------------------------------------------------------------------------------------------ -->
<!--																	-->
<META HTTP-EQUIV="Content-Language" CONTENT="fr">
<META HTTP-EQUIV="Refresh" CONTENT="NO">
<link REL="shortcut icon" HREF="images/logoo.ico" />
<link rel="alternate" type="application/rss+xml"
	href="fluxRSS.php?flux=RSS"
	title="Flux RSS du (B25) - La plate-forme des Artistes,Artisans,Groupes et Associations">
<link rel="alternate" type="application/rss+xml"
	href="fluxRSS.php?flux=ATOM"
	title="Flux ATOM du (B25) - La plate-forme des Artistes,Artisans,Groupes et Associations">
<!--																	-->
<!-- ------------------------------------------------------------------------------------------------------------------------------------ -->

<?php PositionneCSS(); ?>


</head>

<body>
<div id='en-tete' class='entete'>
<?php

if (isset($_COOKIE['bandeauAnim'])) {
    switch ($_COOKIE['bandeauAnim']) {
        case '0':
            // $rand = rand(0,5);
            $rand = 5;
            $rand = "-" . $rand;
            if ($rand == 0) {
                $rand = '';
            }
            $src = 'images/animations/printemps' . $rand . '.gif';
            break;
        case '1':
            // $rand = rand(0,1);
            $rand = 1;
            $src = 'images/animations/nuages-' . ajouterZero($rand) . '.gif';
            break;
        case '2':
            // $rand = rand(0,9);
            $rand = 9;
            $src = 'images/animations/img_calm_' . ajouterZero($rand) . '.gif';
            break;
        case '3':
            // $rand = rand(1,6);
            $rand = 8;
            $src = 'images/animations/vid' . ajouterZero($rand) . 'sec.gif';
            break;
        case '4':
            // $rand = rand(1,3);
            $rand = 2;
            $src = 'images/animations/brouillard-' . $rand . '.gif';
            break;
        case '5':
            // $rand = rand(7,8);
            $rand = 7;
            $src = 'images/animations/photo-70' . $rand . '.gif';
            break;
        case '6':
            // $rand = rand(1,2);
            $rand = 2;
            $src = 'images/animations/nuit-' . $rand . '.gif';
            break;
        case '7':
            // $rand = rand(1,2);
            $rand = 2;
            $src = 'images/animations/vid-lesfeuilles' . $rand . '.gif';
            break;
    }
} else {
    // random en fonction de la date
    $src = 'images/animations/img_calm_09.gif';
}
echo "<div style='display:block;position:absolute;top:0px;left;0px;width:100%;'>";
echo "<center>";
echo "<img id='AnimFond' alt='Besançon 25 fait des GIF-animé, et les GIF-animés c'est pour les grands!' style='width:100%;max-width:auto;z-index:70;' src='$src'>";
echo "</center>";
echo "</div>";

echo "<div style='display:block;position:absolute;top:0px;left;0px;width:99%;'>";
echo "<div class='logoMenu'>";
echo "\n	<center>" . "\n		";
echo '<img style="cursor: pointer;" border="0" id="logo_gauche" height="400px" width="140" src="images/besancon25.fr_gauche.png" onMouseOver="survolCOM(true)" onMouseOut="survolCOM(false)" onClick="';
echo 'window.open(';
echo "'" . PAGEB25COM . "');";
echo 'javascript:window.location.href=';
echo "'" . PAGEB25FR . "/index.php';";
echo '" >';
echo '<img style="cursor: pointer;" border="0" id="logo_droite" height="400px" width="140" src="images/besancon25.fr_droite.png" onMouseOver="survolNET(true)" onMouseOut="survolNET(false)" onClick="';
echo 'window.open(';
echo "'" . PAGEB25NET . "');";
echo 'javascript:window.location.href=';
echo "'" . PAGEB25FR . "/index.php';";
echo '" >';
echo "\n	</center>";
echo "</div>";
echo "</div>";
?>
</div>

	<div id='sous-menu' class='sousmenu'>
	<?php AfficheSousMenu(); ?>
</div>

<?php
$interface = recuperationCookieInterface();

$tabCouleur = array(
    "#DC143C",
    "#FF69B4",
    "#FFA500",
    "#FFFF00",
    "#FF00FF",
    "#4B0082",
    "#008000",
    "#48D1CC",
    "#4682B4",
    "#8B4513",
    "#F08080",
    "#FFB6C1",
    "#FF6347",
    "#FFFACD",
    "#DDA0DD",
    "#7B68EE",
    "#90EE90",
    "#9ACD32",
    "#808000",
    "#556B2F",
    "#8FBC8F",
    "#66CDAA",
    "#AFEEEE",
    "#87CEFA",
    "#FFDEAD",
    "#000080"
);
echo "<div id='limiteur' class='limiteur' ";
if(isset($_COOKIE['couleurIHM'])) {
    echo "style='background-color: ".$tabCouleur[$_COOKIE['couleurIHM']].";' ";
}
echo ">";


if ($page == "preferences" || $interface > 9) {
    if (isset($_COOKIE['statusMenu'])) {
        $status_menu = $_COOKIE['statusMenu'];
    } else {
        $status_menu = 0;
    }
    echo "<img id='btn_empilerMenu' src='images/menu_empiler.png' onclick=";
    echo '"javascript:empilerMenu();"';
    if ($interface < 10 || $status_menu == 0) {
        echo " style='display:none;'";
    }
    echo " width='50' height='50' alt='boutons permettant de cacher le haut de page'>";
    echo "<img id='btn_depilerMenu' src='images/menu_depiler.png' onclick=";
    echo '"javascript:depilerMenu();"';
    if ($interface < 10 || $status_menu == 1) {
        echo " style='display:none;'";
    }
    echo " width='50' height='50' alt='boutons permettant de faire apparaitre le haut de page'></div>";
}
echo "</div>";

?>

<div id='corps' class='corps'>
		<a name="corpsPage" href="#"></a>

		<div id='contenu' style='width: 100%;' class='contenu'>
            <?php
                $pic_memoire_a = memory_get_peak_usage();
                AffichePage($page);
                $pic_memoire_b = memory_get_peak_usage();
            ?>
		</div>
		
		<div id='AMAZING_BG_Effect' class='image3d'>
			
		<!-- Follow http://threejs.org/ -->

			<script src="scriptJS/three/three.min.js"></script>

			<script src="scriptJS/three/controls/TrackballControls.js"></script>
			<script src="scriptJS/three/effects/AsciiEffect.js"></script>

			<script src="scriptJS/three/renderers/Projector.js"></script>
			<script src="scriptJS/three/renderers/CanvasRenderer.js"></script>

			<script src="scriptJS/three/fonts/helvetiker_regular.typeface.js"></script>

			<script src="scriptJS/three/libs/stats.min.js"></script>

			<script>

			var container, stats;

			var camera, controls, scene, renderer;

			var sphere, plane;

			var start = Date.now();

			init();
			animate();

			function init() {

				var width = window.innerWidth*0.87 || 2;
				var height = window.innerHeight*0.9 || 2;
				
				
				
				container = document.createElement( 'div' );
				document.getElementById('AMAZING_BG_Effect').appendChild( container );

				//var info = document.createElement( 'div' );
				//info.style.position = 'absolute';
				//info.style.top = '10px';
				//info.style.width = '100%';
				//info.style.textAlign = 'center';
				//info.innerHTML = 'Drag to change the view';
				//container.appendChild( info );

				camera = new THREE.PerspectiveCamera( 70, width / height, 1, 1000 );
				camera.position.y = 150;
				camera.position.z = 550;

				//controls = new THREE.TrackballControls( camera );

				scene = new THREE.Scene();

				var light = new THREE.PointLight( 0xffffff );
				light.position.set( 500, 500, 500 );
				scene.add( light );

				var light = new THREE.PointLight( 0xffffff, 0.25 );
				light.position.set( - 500, - 500, - 500 );
				scene.add( light );
				
				var labelB25 = new THREE.TextGeometry( 'B25', {
								size: '150',
								height: '75',
								font: 'helvetiker'
							});

				material = new THREE.MeshLambertMaterial( { shading: THREE.FlatShading } );

				b25 = new THREE.Mesh( 
					labelB25,
					material
					);
				
				b25.position.x = - 100;
				b25.position.y = 0;
				
				scene.add( b25 );

				//over skate-board
				
				tail = new THREE.Mesh (
					new THREE.CylinderGeometry( 100 , 100 , 2 , 8 , 8 , false , Math.PI, Math.PI  ),
					material
					);
				tail.position.x = -250;
				tail.position.y = 15;
				tail.rotation.x = 0.2;
				tail.rotation.z = -0.3;
				
				board = new THREE.Mesh (
					new THREE.BoxGeometry( 500 , 200, 2 , 2 , 2 , 2),
					material
					);
				board.position.x = 0;
				board.position.y = 15;
				board.rotation.x = Math.PI*0.5 + 0.2;
				
				front = new THREE.Mesh (
					 new THREE.CylinderGeometry( 100 , 100 , 2 , 8 , 8 , false , 0 , Math.PI, Math.PI ),
					material
					);
				front.position.x = 250;
				front.position.y = 15;
				front.rotation.x = 0.2;
				front.rotation.z = 0.3;
				
				overBack = new THREE.Mesh (
					 new THREE.CylinderGeometry( 80 , 80 , 20 , 8 , 8 , false , 0 , 2*Math.PI ),
					material
					);
				overBack.position.x = -165;
				overBack.position.y = 0;
				overBack.rotation.x = 0.2;
				overFront = new THREE.Mesh (
					 new THREE.CylinderGeometry( 80 , 80 , 20 , 8 , 8 , false , 0 , 2*Math.PI ),
					material
					);
				overFront.position.x = 165;
				overFront.position.y = 0;
				overFront.rotation.x = 0.2;
				
				overskate = new THREE.Group();
				overskate.add(tail);
				overskate.add(board);
				overskate.add(front);
				overskate.add(overBack);
				overskate.add(overFront);				
				
				scene.add(overskate);
				
				//Jumping sphere

				sphere = new THREE.Mesh( 
						new THREE.SphereGeometry( 100, 8, 4 ), 
						new THREE.MeshLambertMaterial( { shading: THREE.FlatShading } )
					);
				
				sphere.position.x = - 350;
				sphere.position.y = 0;
				
				//var merged = new THREE.Geometry();
				//merged.merge( b25.geometry, b25.matrix );
				//merged.merge( B25sphere.geometry, B25sphere.matrix );

				//var sphere = new THREE.Mesh(merged, material);
					
				scene.add( sphere );

				// Plane

				//plane = new THREE.Mesh( 
				//		new THREE.PlaneBufferGeometry( 400, 400 ),
				//		new THREE.MeshBasicMaterial( { color: 0xe0e0e0 } )
				//	);
				//plane.position.y = - 200;
				//plane.rotation.x = - Math.PI / 2;
				//scene.add( plane );

				renderer = new THREE.CanvasRenderer();
				renderer.setClearColor( 0xf0f0f0 );
				renderer.setSize( width, height );
				//container.appendChild( renderer.domElement );

				effect = new THREE.AsciiEffect( renderer );
				effect.setSize( width, height );
				container.appendChild( effect.domElement );

				//stats = new Stats();
				//stats.domElement.style.position = 'absolute';
				//stats.domElement.style.top = '0px';
				//container.appendChild( stats.domElement );

				//

				window.addEventListener( 'resize', onWindowResize, false );

			}

			function onWindowResize() {

				camera.aspect = window.innerWidth / window.innerHeight;
				camera.updateProjectionMatrix();

				renderer.setSize( window.innerWidth, window.innerHeight );
				effect.setSize( window.innerWidth, window.innerHeight );

			}

			//

			function animate() {

				requestAnimationFrame( animate );

				render();
				//stats.update();

			}

			function render() {

				var timer = Date.now() - start;

				b25.rotation.y =  Math.cos( timer * 0.002 ) *  0.7;
				b25.rotation.x = Math.abs( Math.cos( timer * 0.003 ) ) *  0.1;

				sphere.position.y = Math.abs( Math.sin( timer * 0.002 ) ) * 250;
				sphere.rotation.x = timer * 0.0003;
				sphere.rotation.z = timer * 0.0002;

				overskate.rotation.y = timer * 0.0002;
				overskate.position.y = 275 + Math.cos( timer ) * 0.05;
			
				//controls.update();

				effect.render( scene, camera );

			}

		</script>
		</div>

		<div
			style='position: relative; width: 100%; height: 100px; display: block; overflow: hidden; background-color: transparent;'>
			&nbsp;
			<div
				style="position: relative; top: -65%; left: -25%; transform: rotate(-3deg); position: relative; bottom: 0px; margin-bottom: 0px; background-color: transparent; background: url(images/line-up-3.png); background-repeat: repeat-x; width: 150%; height: 125px;"></div>
			&nbsp;
		</div>

		<div class='hashtags'>
	
			<br /><br />					<br /><br /> 			<br /><br />      							  <br />
			<br />		<br />						<br />			<br />									    <br />
			<br />		<br />						<br />			<br />									  <br />
			<br /><br />							<br />				<br /><br /> 						<br />
			<br />		<br />				<br />								<br />					  <br />
			<br />		<br />			<br />			 						<br />					<br />
			<br />		<br />			<br />			 						<br />				  <br />
			<br /><br />					<br /><br /> 			<br /><br />					<br />
			
		</div>

	</div>



	<div class='piedDePage'>
	 <div class='fromBottom'>
	   <div class='toBottom'>
		<center>
			&nbsp; <br />
			<br />
			<br />
			<br />
        <!-- Cette animation Impressionnante à été créée par Justin Windle en Javascript
				Elle est disponible a l'adresse http://soulwire.co.uk/experiments/recursion-toy/
				All my thanks to Him - Merci! pour tes expérimentations :) !
				
		-->

		<canvas class='imageRacine' id="canvas"></canvas>

		<script
			src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
		<script src="scriptJS/Recursion-Toy-master/js/lib/DAT.GUI.min.js"></script>
		<script src="scriptJS/Recursion-Toy-master/js/lib/RAF.js"></script>
		<script src="scriptJS/Recursion-Toy-master/js/recursion.js"></script>
		
			<p>Besan&ccedil;on 25 c'est aussi d'autres terminaisons de
				domaines,et des sous-domaines afin de simplifier l'utilisation du
				m&eacute;dia Internet:</p>
			<ul>
				<li>Une page r&eacute;serv&eacute;e aux <a
					href='http://besancon25.com'>petites-annonces</a> des artistes et
					artisans sur le .com
				</li>
				<li>Un agenda r&eacute;serv&eacute; aux <a
					href='http://besancon25.net/index.php'>&eacute;v&egrave;nements</a>
					des associations et groupes musicaux sur le .net
				</li>
				<li>Une page de <a href='http://besancon25.biz'>publicit&eacute;s</a>
					r&eacute;serv&eacute;e aux annonceurs, commerces et
					m&eacute;c&egrave;nes sur le .biz
				</li>
				<li>Une page informative sur le porte-feuille des marques <a
					href='http://unilever.besancon25.fr'>Unilever</a></li>
			</ul>
			</p>
			<p>
				Besan&ccedil;on 25 est un site &eacute;dit&eacute; par <a
					href='http://infoartsmedia.fr'>Info[ARTS]Media</a>. <br />
				<br /> Le serveur est h&eacute;berg&eacute; en contrat avec <a
					href="https://www.1and1.fr/?kwk=20117144" target="_blank">1 and 1</a>
				(1&1 Internet SARL / 7, place de la Gare / BP 70109 / 57201
				Sarreguemines Cedex ), dans un de ses centres de donn&eacute;es. <br />
				Ce site respecte les droits des Internautes r&eacute;gis par les
				articles de la loi <i>Informatique et Libert&eacute;es</i>
				accessible sur le site de la <a href='http://www.cnil.fr'>CNIL</a> <br />
				Les <a
					href='http://www.cnil.fr/vos-obligations/sites-web-cookies-et-autres-traceurs/'>"Cookies
					informatiques"</a> sont uniquements utilis&eacute;s afin que chaque
				poste-logiciel ait la possibilit&eacute; de choisir sa propre <a
					href='index.php?page=preferences'>interface</a> .
			</p>
		<?php if( !detection_mobile() ){ ?>

			<table border='0'>
				<tr>
					<td><a href="http://s08.flagcounter.com/"><img
							src="http://s08.flagcounter.com/count//bg_CCCCCC/txt_000000/border_CCCCCC/columns_8/maxflags_248/viewers_Visiteurs/labels_0/pageviews_1/flags_0/"
							alt="Free counters!" border="0"></a></td>
					<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
					<td>
            			<?php
                AfficheNbConnectes();
                // Calcul du temps de défenestration de la page ... (^_^)
                $fin = getmicrotime();
                $fin_memoire = memory_get_usage();
                echo "<h6><font color='#FFFFFF'>G&eacute;n&eacute;ration de la page: </font>" . "<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . time_elapsed_millisecs($fin - $debut) . "<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . lectureHumaineOctet($debut_memoire) . "/" . lectureHumaineOctet($fin_memoire) . "<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . lectureHumaineOctet($pic_memoire_a) . " ^^ " . lectureHumaineOctet($pic_memoire_b) . "</h6>";
                ?>
			</td>
				</tr>
			</table>
		
		<?php } ?>
		&nbsp;
			<div style="position: relative; bottom: -45px; background: url(images/line-up.png); width: 100%; height: 50px;"></div>
		</center>
	  </div>		
	 </div>
    </div>

<?php PositionneJS(); AfficheJSIcone(); ?>

</body>
</html>
