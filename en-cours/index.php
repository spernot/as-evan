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

// Je pr�cise sur quelle page je suis
setPageActuelle('index');

// Cr�ation d'un contexteUtilisateur 
// + lecture et mise en session du fichier d'accueil
if (!isset($_SESSION['ContexteUtilisateur'])) {
	$contexte = new ContexteUtilisateur();
	majContexteUtilisateur($contexte);
}

// on r�cup�re le texte � afficher dans l'accueil
$contexteUtlisateur = getContexteUtilisateur();
$actualite = $contexteUtlisateur->getTexteAccueil();

// Je regarde si je veux aqfficher l'edito en entier
$afficherTexteEnEntier = false;
if (isset($_GET["suiteTexte"]))
	$afficherTexteEnEntier = true;

// Ensuite, je recherche les news � afficher
//$contexteUtlisateur->getNewsAccueil();
$tableauNews = $contexteUtlisateur->getNewsAccueil();

?>

<!DOCTYPE HTML>
<html>
<head>
	<?php
	include('./include/_meta.php');
	?>

	<title>Assembl&eacute;e &Eacute;vang&eacute;lique du Neudorf</title>

	<link rel="stylesheet" href="<?php echo(getAliasURI()) ?>/css/commun.css">
	<link rel="stylesheet" href="<?php echo(getAliasURI()) ?>/css/popupBulletin.css">
	
</head>
<body>

 	<div class="cadrePrincipal"> 

	<?php
	include('./include/_entete.php');
	?>
	
	
		<br/>	
		<div class="versetAccueil">
			<span class="texteVerset">" Recommande ton sort � l'&Eacute;ternel, mets en Lui ta confiance, et Il agira "</span><br/> <span class="referenceVerset">Psaumes 37:5</span>&nbsp;
		</div>
		<br/>
		
		<table class="centree">
			<tr>
				
				<?php 
				// Premi�re tuile: on affiche la premi�re news trouv�e
				foreach ($tableauNews as $news) {	?>
					<td class="tuile">
						<a class="lienImage" href="informations.php#<?php echo($news->getId())?>">
							<img src="<?php echo(getAliasURI()) ?>/images/news/<?php echo($news->getImage()) ?>" />						
						</a>
					</td>
				<?php
					// On s'arr�te � la premi�re news.
					break; 
				} ?>
				
				<?php 
				// Sinon, on affiche la tuile d'acc�s au bulletin du mois
				if (count($tableauNews) == 0) { ?>	
				<td class="tuile">
					<a class="lienImage" href="#" id="openBulletin">
						<img src="<?php echo(getAliasURI()) ?>/imagesMieux/newsDuMois.png" />
					</a>
				</td>
				<?php } ?>
				
				<td class="tuile">
					<a class="lienImage" href="presentation.php">
					<img src="<?php echo(getAliasURI()) ?>/imagesMieux/qui.png" />
					</a>	
				</td>
				<td class="tuile">
					<a class="lienImage" href="planning.php">
					<img src="<?php echo(getAliasURI()) ?>/imagesMieux/ceMoisCi.png" />
					</a>
				</td>
			</tr>
			<tr>
				<td class="tuile">
					<a class="lienImage" href="contact.php">
					<img src="<?php echo(getAliasURI()) ?>/imagesMieux/uneQuestion.png" />
					</a>
				</td>
				<td class="tuile">
					<a class="lienImage" href="ecouterEtVoir.php">
					<img src="<?php echo(getAliasURI()) ?>/imagesMieux/ecouterEtVoir.png" />
					</a>
				</td>
				
				<?php 
				// S'il existe des news, on affiche la tuile d'acc�s au bulletin du mois � la fin
				if (count($tableauNews) > 0) { ?>	
				<td class="tuile">
					<a class="lienImage" href="#" id="openBulletin">
						<img src="<?php echo(getAliasURI()) ?>/imagesMieux/newsDuMois.png" />
					</a>
				</td>
				<?php } else { 
					// Sinon, on affiche une case vide ?>
					<td style="border: 10px solid white;">&nbsp;</td>
				<?php } ?>
			</tr>
		</table>
		
		<br/>
		
<!--		<div style="clear: both">&nbsp;<br/><br/></div>-->

		<div id="bulletin" class="popupBulletin" >
	  		<?php tagBulletin($actualite, true);?>
		</div>
	
	</div>
	
	<?php
	include('./include/_piedPage.php');
	?>
	
	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="<?php echo(getAliasURI()) ?>/js/popupBulletin.js"></script>
	
</body>
</html>