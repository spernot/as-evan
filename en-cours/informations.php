<?php

/**
 *
 *
 * @version $Id$
 * @copyright 2011
 */

require_once('./archi/ContexteUtilisateur.php');

verificationSessionUtilisateur();

// Je pr�cise sur quelle page je suis
$_SESSION['pageActuelle'] = 'informations';


// Recherche des news encore active actuellement
$contexteUtlisateur = getContexteUtilisateur();
$tableauNewsActives = $contexteUtlisateur->getNewsActives();

?>

<!DOCTYPE HTML>
<html>
<head>
	<?php
	include('./include/_meta.php');
	?>

	<title>Assembl&eacute;e &eacute;vang&eacute;lique du Neudorf</title>

	<link rel="stylesheet" href="./css/commun.css">

	<script type="text/javascript" src="./js/informationUtil.js"></script>

</head>
<body>

	<div class="cadrePrincipal"> 

	<?php
	include('./include/_entete.php');
	?>

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
							// on boucle sur les fichiers attach�s � la news 
							foreach ($news->getFichiersAttaches() as $fic) {
								echo("<span style='font-weight: bold;'>".$fic->getTitre().":&nbsp;</span>");
								echo("Cliquez<a href='".getAliasURI().$fic->getUrlFichier()."' class='lienQR' target='_blank'>&nbsp;ici</a>");
								echo("<br/>");
							}
							?>
						</td>
					</tr>
				</table>
				<br/>
				<br/>				
				
				<?php
				// on boucle sur les Q/R renseign�es dans la source idoine 
				foreach ($news->getQuestionsReponses() as $qr) {
					
					// La question
					echo("<a href='#' class='lienQR' onclick='montrerReponse(\"".$qr->getId()."\"); return false;'>");
					echo($qr->getQuestion());
					echo("</a><br/>");

					// la r�ponse
					echo("<div id='".$qr->getId()."' name='".$qr->getId()."' class='reponse'>");
					echo($qr->getReponse());
					echo("</div>");
					
					echo("<br/>");
				}
				?>
				
				
				<?php 
				// On boucle sur les includes � ajouter � la page
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