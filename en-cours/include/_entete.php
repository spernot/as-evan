<?php



	/**
	 * déclaration de constantes bien utiles
	 */
	class ConstantesEntete {
		public static $NOM_MENU = array('index', 'presentation', 'planning',
			'contact', 'articles', 'informations', 'ecouteretvoir', 'liens');
		public static $COULEUR_MENU_SELECTION = array("#1AA8EA;", "#FF0000;", "#FEBD0B;", 
			"#1AA8EA;", "#E66125;", "#75487C;", "#7DCB2C;", "#0A6B7C;");
		public static $COULEUR_POLICE = array("white", "white;", "white;", 
			"white;", "white;", "white;", "white;", "white");
		public static $IMAGE_ENTETE = array("bandeAccueil.png", "bandePresentation.png", "bandeAgenda.png", 
			"bandeContact.png", "bandeArticles.png", "bandeNews.png", "bandeMedia.png", "bandeAccueil.png");
	}
	
	/**
	 * Prend en charge la gestion des onglets du menu de chaque page
	 * 
	 * @param $index
	 * 
	 * retourne la class CSS + gère la couleur de police de chaque lien du menu
	 */
	function gestionClassMenu($index) {
		
		$nomMenu = ConstantesEntete::$NOM_MENU[$index];
		
		if ($_SESSION['pageActuelle'] == $nomMenu) {
			echo('"lienMenuSelection"');
			echo(' style="background-color: '.ConstantesEntete::$COULEUR_MENU_SELECTION[$index]);
			if (ConstantesEntete::$COULEUR_POLICE[$index] == "") {
				//rien
			}
			else {
				echo(' color: '.ConstantesEntete::$COULEUR_POLICE[$index]);
			}
			echo('"');
			
		} else {
			echo('"lienMenu"');
		}
	}

	/**
	 * prend en charge l'aimge d'entete de chaque page
	 * 
	 * renvoie l'URL vers la bonne image suivant le nom de la page stocké dans la session
	 */
	function gestionImageEntete() {
		
		$urlImage = "/imagesMieux/entete/";

		// Le menu ou je me trouve
		$menuActuel = $_SESSION['pageActuelle'];		
		
		// recherche de l'index du menu depuis le nom du menu
		$i = 0;
		foreach (ConstantesEntete::$NOM_MENU as $nomMenu) {
			if ($nomMenu == $menuActuel) {
				// Concaténation du nom de l'image à l'url déjà construite
				$urlImage .= ConstantesEntete::$IMAGE_ENTETE[$i];
			}
			$i++;
		}
		return $urlImage;
	}
?>
	<?php include_once '_ga.php';?>

	
	
		<div class="enteteCommune">
			<!-- image de l'accueil (qui peut être différentes suivant la page où l'utilisateur se trouve -->	
			<img src="<?php echo(getAliasURI().gestionImageEntete()) ?>" />
		</div>
		
		<!-- Les différents menus accessibles -->
		<div class="menu" >
			<a class=<?php gestionClassMenu(0);?> href="index.php">Accueil</a>
			<a class=<?php gestionClassMenu(1);?> href="presentation.php">Pr&eacute;sentation</a>
			<a class=<?php gestionClassMenu(2);?> href="planning.php">Planning</a>
			<a class=<?php gestionClassMenu(3);?> href="contact.php">Contact</a>
			<a class=<?php gestionClassMenu(4);?> href="articles.php">Articles</a>
			<a class=<?php gestionClassMenu(5);?> href="informations.php">Actualité</a>
			<a class=<?php gestionClassMenu(6);?> href="ecouterEtVoir.php">Multimédia</a>
			<a class=<?php gestionClassMenu(7);?> href="liens.php">liens</a>
		</div>
	