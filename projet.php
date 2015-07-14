<?php

/**
 *
 *
 * @version $Id$
 * @copyright 2011
 */

require_once('./archi/ContexteUtilisateur.php');

verificationSessionUtilisateur();

// Je précise sur quelle page je suis
$_SESSION['pageActuelle'] = 'projet';


// Recherche des news encore active actuellement
$contexteUtlisateur = getContexteUtilisateur();
$projetManager = $contexteUtlisateur->getProjetManager();

$numPageProjet = 0;
if (isset($_GET["p"])) {
	$var = $_GET["p"];
	
	// On chope la valeur entiere du parametre
	$numPageProjet = intval($var);

	// on s'arrange pour que le numéro de page fourni cadre avec le nombre de page du projet
	if ($numPageProjet > $projetManager->nombrePageProjet()-1) {
		$numPageProjet = $projetManager->nombrePageProjet()-1;
	}
	else if ($numPageProjet < 0) {
		$numPageProjet = 0;
	}		
}

$projet = $projetManager->getProjet();
$page = $projet->listePages[$numPageProjet];
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<?php
	include('./include/_meta.php');
	?>

	<title>Assembl&eacute;e &eacute;vang&eacute;lique du Neudorf</title>

	<link rel="stylesheet" href="<?php echo(getAliasURI()) ?>/css/commun2.css?d=<?php echo date('dm'); ?>">

</head>
<body>

	<?php
	include('./include/_entete.php');
	?>

	<div class="cadrePrincipal">
		<br/>
		<div class="titreSection">
			<?php echo($projet->titre)?>
		</div>
		<div class="resumeSection">
			
			<!-- Affichage de l'image de la page -->
			<img src="<?php echo(getAliasURI()) ?>/images/projet/<?php echo($projet->repertoire)?>/<?php echo($page->image)?>?d=<?php echo date('dm'); ?>" />
			<br/>
			
			<!-- Navigation entre les pages -->
			<div>
				<?php 
					// gestion page précédente
					if ($numPageProjet > 0) {
						$hrefPrec = $_SERVER['PHP_SELF']."?p=".($numPageProjet-1);
						echo("&nbsp;");
						echo("<a href='".$hrefPrec."' class='lien'>");
						echo("&lt;&nbsp;Précédent");
						echo("</a>");
					}
					
					// gestion page suivante
					if ($numPageProjet < $projetManager->nombrePageProjet()-1) {
						$hrefPrec = $_SERVER['PHP_SELF']."?p=".($numPageProjet+1);
						echo("&nbsp;");
						echo("<a href='".$hrefPrec."' class='lien'>");
						echo("Suivant&nbsp;&gt;");
						echo("</a>");
					}
				?>
			</div>
			
			<!-- gestion des différentes informations du projet -->
			<!-- gestion de la description de la page -->
			<?php if (isset($page->descriptif)) { ?>
				<div style="font-weight: normal;">
					<?php echo($page->descriptif)?>
				</div>
				<br/>
			<?php } ?>
			
			<!-- gestion des nouvelles -->
			<?php if (isset($page->nouvelles)) { ?>
				<div style="font-weight: normal;">
					<br/>
					<u>Nouvelles du projet:</u><br/>
					<table>
					<?php 
					foreach ($page->nouvelles as $nouvelle) {
						echo "<tr>";
						echo "<td style=\"width: 30%\">";
						echo $nouvelle["date"];
						echo "</td>";
						echo "<td>";
						echo $nouvelle["descriptif"];
						echo "</td>";
						echo "</tr>";
					}
					
					?>
					</table>
				</div>
			<?php } ?>
			
			<!-- gestion de la barre d'avancement -->
			<?php 
			if (isset($page->avancement)) { 
				$descriptif = $page->avancement["descriptif"];
				$objectif = intval($page->avancement["objectif"]);
				$etatActuel = intval($page->avancement["actuel"]);
				$pourcentage = $etatActuel / $objectif * 100;
			?>
				<div style="font-weight: normal;">
					<br/>
					<u>Avancement:</u><br/>
					<?php 
					if (isset($descriptif))
						echo $descriptif;
					?>
					<br/>
					<div style="width: 50%">
						<div style="display: inline;">
						<table style="width: 30%; border: 1px solid green; border-collapse:collapse;">
							<tr>
								<td style="width: <?php echo $pourcentage?>%; color: white; background-color: #FF1C27;">
									<?php echo $etatActuel?>
								</td>
								<td>&nbsp;</td>
							</tr>
						</table>
						</div>
						<div style="display: inline;">
						<span><?php echo $objectif?></span>
						</div>
					</div>
				</div>
			<?php } ?>
			
			<!-- Gestion des liens -->
			<?php 
			if (isset($page->lien)) { 
			?>
				<div style="font-weight: normal;">
				<br/>
				<?php echo $page->lien["descriptif"]; ?>
				<a class="lien" href="<?php echo $page->lien["url"]?>" target="_blank">lien</a>
				</div>
			<?php 
			}
			?>
			<br/>
			<br/>
			<br/>
			
			
		</div>
	</div>
	
	<?php
	include('./include/_piedPage.php');
	?>
	
</body>
</html>