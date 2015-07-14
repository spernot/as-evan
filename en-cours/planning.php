<?php

/**
 *
 *
 * @version $Id$
 * @copyright 2011
 */

//

// Import de fonctions bien pratiques
require_once('./archi/ContexteUtilisateur.php');
require_once './archi/PlanningUtil.php';

verificationSessionUtilisateur();


// Je précise sur quelle page je suis
setPageActuelle('planning');

// stockage du planning dans la session utilisateur
$contexteUtilisateur = getContexteUtilisateur();
$planningDeLAnnee = $contexteUtilisateur->getPlanning();

// Si celui-ci est passé dans le get, alors je le prend en compte
if (isset($_GET["moisEnCours"]))
	$planningDeLAnnee->setMoisEnCours($_GET["moisEnCours"]);

// parcours du tableau pour récuperer le planning du mois en cours
$planningDuMois = $planningDeLAnnee->getPlanningDuMois();

// Récuperation de quelques variables qui nous interessent
$annee = $planningDeLAnnee->getParametre("annee");
$culte = $planningDeLAnnee->getParametre("culte");

?>

<!DOCTYPE HTML>
<html>
	<head>
	<?php
		include('./include/_meta.php');
	?>

	<title>Assembl&eacute;e &eacute;vang&eacute;lique du Neudorf</title>

	<link rel="stylesheet" href="./css/commun.css">
	<link rel="stylesheet" href="./css/planning.css">

</head>
<body>

	<div class="cadrePrincipal"> 
		<?php
		include('./include/_entete.php');
		?>
	
		<br/><br/><br/>		
		
		<div class="gauche">
			<span style="margin-left: 10px; font-size: 1.5em; color: #FEBD0B;"><?php echo($planningDuMois->getMois()." ".$annee); ?></span>
		</div>
		<div class="droite">
			<div class="navigation">
			
			<?php 
			$moisPrec = $planningDeLAnnee->getNomMoisPrecedent();
			$moisSuiv = $planningDeLAnnee->getNomMoisSuivant();			
			?>

			<!-- Gestion du mois précédent -->
			<?php if (strlen($moisPrec) > 0) { ?>			
				<a class="lienPlanning"	href="<?php 			
				echo($_SERVER['PHP_SELF']."?moisEnCours=".$moisPrec) ?>"><img src="<?php echo(getAliasURI()) ?>/images/flecheGauche" /> <?php echo($moisPrec) ?></a>			
			<?php } ?>
			
			&nbsp;&nbsp;
			
			<!-- Gestion du mois suivant -->
			<?php if (strlen($moisSuiv) > 0) { ?>
				<a class="lienPlanning"	href="<?php 			
				echo($_SERVER['PHP_SELF']."?moisEnCours=".$moisSuiv) ?>"> <?php echo($moisSuiv) ?> <img src="<?php echo(getAliasURI()) ?>/images/flecheDroite" /></a>
			<?php } ?>
			</div>
		</div>
		<br />
		<br/>


				<?php
				
				$journeePrecedente = null;
				
				foreach ($planningDuMois->getListeJournee() as $journee) {
					
					if (!$planningDuMois->isIncomplet())
						// La gestion de l'affichage des dimanches ne se fait que sur un planning complet
						gestionAffichageDimancheClassique($journeePrecedente, $journee, $culte);
						
					afficheDebutTagEntree($journee);
					afficheFinTagEntree();
					
					$journeePrecedente = $journee;
				}
				
				if (!$planningDuMois->isIncomplet())
					// La gestion de l'affichage des dimanches ne se fait que sur un planning complet
					gestionAffichageDimancheFinMois($journeePrecedente, $planningDeLAnnee->getMoisEnCours(), $annee, $culte);
				

				?>
		
		<div style="clear: both">&nbsp;<br/></div>
	
	</div>
	<?php
	include('./include/_piedPage.php');
	?>
	
</body>
</html>
