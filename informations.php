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
$_SESSION['pageActuelle'] = 'informations';


// Recherche des news encore active actuellement
$contexteUtlisateur = getContexteUtilisateur();
$tableauNewsActives = $contexteUtlisateur->getNewsActives();

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<?php
	include('./include/_meta.php');
	?>

	<title>Assembl&eacute;e &eacute;vang&eacute;lique du Neudorf</title>

	<script type="text/javascript" src="<?php echo(getAliasURI()) ?>/js/informationUtil.js"></script>
	<link rel="stylesheet" href="<?php echo(getAliasURI()) ?>/css/commun2.css?d=<?php echo date('dm'); ?>">

</head>
<body>

	<?php
	include('./include/_entete.php');
	?>

	<div class="cadrePrincipal">
		<br/>

		<?php 
		// affichage de toutes les news encore active actuellement
		foreach ($tableauNewsActives as $news) {
		?>
			<a name="<?php echo($news->getId()) ?>" ></a>
			<div class="titreSectionInformation">
				<?php echo($news->getTitre()) ?>
			</div>
			<div class="resumeSection">
				<table border=0>
					<tr style="font-weight: normal;">
						<td>
							<img src="<?php echo(getAliasURI()) ?>/images/news/<?php echo($news->getImageInformation()) ?>" />
						</td>
						<td valign="bottom" style="padding-left: 1em;">
							<?php echo($news->getResume()) ?>
							<br/>
							<br/>
							<br/>
							<?php
							// on boucle sur les fichiers attachés à la news 
							foreach ($news->getFichiersAttaches() as $fic) {
								echo("<span style='font-weight: bold;'>".$fic->getTitre().":&nbsp;</span>");
								echo("<br/>Cliquez<a href='".getAliasURI().$fic->getUrlFichier()."' class='lienQR' target='_blank'>&nbsp;ici</a>");
								echo("<br/>");
							}
							?>
						</td>
					</tr>
				</table>
				<br/>
				<br/>				
				
				<?php
				// on boucle sur les Q/R renseignées dans la source idoine 
				foreach ($news->getQuestionsReponses() as $qr) {
					
					// La question
					echo("<a href='#' class='lienQR' onclick='montrerReponse(\"".$qr->getId()."\"); return false;'>");
					echo($qr->getQuestion());
					echo("</a><br/>");

					// la réponse, en image ou pas.
					echo("<div id='".$qr->getId()."' name='".$qr->getId()."' class='reponse'>");
					if ($qr->getReponseImage() != null) {
						echo("<img src=\"".getAliasURI()."/images/news/".$qr->getReponseImage()."\" >");
					} else {
						echo($qr->getReponse());
					}
					echo("</div>");
					
					echo("<br/>");
				}
				?>
				
				
				<?php 
				// On boucle sur les includes à ajouter à la page
				foreach ($news->getIncludes() as $fichierIncl) {
					include "./include/".$fichierIncl;
				}
				
				?>
				<br/>
				<br/>
				
				<br/>
				<hr/>
			</div>
		<?php 
		}
		?>
		
		<?php if (count($tableauNewsActives) == 0) { ?>	
		<div class="titreSection">
			Diaporama sur l'histoire de la Bible - A voir chez vous sur demande !
		</div>
		<div class="resumeSection">
			<img src="<?php echo(getAliasURI()) ?>/images/diaporama.jpg" />
			<br/>
			<hr/>			
		</div>
		<?php }	?>
		
		<br/>
		<br/>
		
	</div>
	
	<?php
	include('./include/_piedPage.php');
	?>
	
</body>
</html>