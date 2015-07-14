<?php

/**
 *
 *
 * @version $Id$
 * @copyright 2011
 */

require_once('archi/ContexteUtilisateur.php');
require_once 'archi/AccueilUtil.php';

// initialisation de ma session
if (!isset($_SESSION)) {
	session_start() ;
}

// Je précise sur quelle page je suis
setPageActuelle('index');

// Création d'un contexteUtilisateur 
// + lecture et mise en session du fichier d'accueil
if (!isset($_SESSION['ContexteUtilisateur'])) {
	$contexte = new ContexteUtilisateur();
	majContexteUtilisateur($contexte);
}

// on récupère le texte à afficher dans l'accueil
$contexteUtlisateur = getContexteUtilisateur();
$actualite = $contexteUtlisateur->getTexteAccueil();

// Je regarde si je veux aqfficher l'edito en entier
$afficherTexteEnEntier = false;
if (isset($_GET["suiteTexte"]))
	$afficherTexteEnEntier = true;

// Ensuite, je recherche les news à afficher
//$contexteUtlisateur->getNewsAccueil();
$tableauNews = $contexteUtlisateur->getNewsAccueil();

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<?php
	include('./include/_meta.php');
	?>

	<title>Assembl&eacute;e &Eacute;vang&eacute;lique du Neudorf</title>

	<link rel="stylesheet" href="<?php echo(getAliasURI()) ?>/css/commun2.css?d=<?php echo date('dm'); ?>">
<!-- 	<script type="text/javascript" src="./js/jQuery.js"></script> -->
</head>
<body>
	<?php
	include('./include/_entete.php');
	?>
	<div class="cadrePrincipal">
		<br/>	
		<div class="titrePage" style="font-family: calibri, helvetica, times, 'HelveticaNeue-Light', 'Helvetica Neue Light', 'Helvetica Neue', 'Helvetica';">
			<span style="font-weight: normal; font-size: 1.3em;">"Recommande ton sort à l'&Eacute;ternel, mets en Lui ta confiance, et Il agira"</span><br/> <span style="font-weight: normal; padding-left: 0.5em;">Psaumes 37:5</span>&nbsp;
		</div>
		<br/>
		<div class="accueilGauche">
		
			<div class="resumeSectionEdito" style="margin-left: 15px;">
			
				<?php 
				// On boucle sur toutes les news trouvées
				foreach ($tableauNews as $news) {	?>
					<a class="lienImage" href="informations.php#<?php echo($news->getId())?>">
						<img src="<?php echo(getAliasURI()) ?>/images/news/<?php echo($news->getImage()) ?>" />						
					</a>
					<br/>
					<br/>
					<br/>
				<?php } ?>
			</div>
			
			<br/>
			<hr/>
			<div class="titreSectionEdito">
				Bulletin du mois
			</div>
			<div class="resumeSectionEdito">
				
				<?php 
				
				if (isset($actualite)) {
				
					if ($actualite instanceof Bulletin) {
						
						tagBulletin($actualite, $afficherTexteEnEntier);
						
					}
					else if ($actualite instanceof Edito) {
						
						// Rien pour l'instant, mais le tag adéquat viendra
						// une fois que je saurais quoi mettre dedans
					}
				} else {
					// Il peut arriver que le texte du mois ne soit pas encore renseigné.					
					echo("Il n'y a pas encore de bulletin renseigné pour ce mois-ci.");					
				}
				?>	
			</div>
		</div>
		<div class="accueilDroite">
			
			<a class="lienImage" href="presentation.php">
				<img alt="" src="<?php echo(getAliasURI()) ?>/images/qui.png">
			</a>
			<br/><br/>
			<a class="lienImage" href="planning.php">
				<img alt="" src="<?php echo(getAliasURI()) ?>/images/ceMoisCi.png">
			</a>
			<br/><br/>
			<a class="lienImage" href="ecouterEtVoir.php">
				<img alt="" src="<?php echo(getAliasURI()) ?>/images/ecouterEtVoir.png">
			</a>
			<br/><br/>
			<a class="lienImage" href="contact.php">
				<img alt="" src="<?php echo(getAliasURI()) ?>/images/uneQuestion.png">
			</a>
			<br/><br/>
			<a class="lienImage" href="statsSondage.html" target="_blank">
				<img alt="" src="<?php echo(getAliasURI()) ?>/images/sondages.png">
			</a>
			
		</div>
		
		<div style="clear: both">&nbsp;<br/><br/></div>
	</div>
	
	<?php
	include('./include/_piedPage.php');
	?>
	
</body>
</html>