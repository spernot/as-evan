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
setPageActuelle('contact');

?>




<!DOCTYPE HTML>
<html>
<head>
	<?php
	include('./include/_meta.php');
	?>

	<title>Assembl&eacute;e &eacute;vang&eacute;lique du Neudorf</title>

	<link rel="stylesheet" href="./css/commun.css">

	<script src="<?php echo(getAliasURI()) ?>/js/contact.js"></script>

</head>
<body>

	<div class="cadrePrincipal"> 

	<?php
	include('./include/_entete.php');
	?>
		<br/>
		<div class="contactGauche">
			<br/>
			<div class="contenuSection">
				<img src="<?php echo(getAliasURI()) ?>/images/pointBleuPetit.png" id="point0" style="position: relative;" />
				<a href="#" class="lien" onclick="montrerDiv('presentationContact')">Notre �glise</a>
				<br/><br/>
				<img src="<?php echo(getAliasURI()) ?>/images/pointBleuPetit.png" id="point1" style="position: absolute; visibility: hidden;" />
				<a href="#" class="lien" onclick="montrerDiv('responsable')">Contacter un responsable</a>
				<br/><br/>
				<img src="<?php echo(getAliasURI()) ?>/images/pointBleuPetit.png" id="point2" style="position: absolute; visibility: hidden;" />
				<a href="#" class="lien" onclick="montrerDiv('gratuit')">Autres possibilit�s</a>				
				<br/>
				<br/>
				<br/>
				<br/>
				<?php include 'include/_formContact.php'; ?>
			</div>
		</div>
		<div class="contactDroite">
			<div id="presentationContact" style="position: relative;">
				<div class="titreSectionContact" style="padding-left: 0px">
					Notre &eacute;glise
				</div>
				<div class="contenuSection">
					<span style="font-weight: bold;">Assembl&eacute;e &eacute;vangelique</span><br/>
					5, rue Baldner<br/>
					67100 Strasbourg<br/>
					<br/>
					<br/>
					<a class="lienImage" href="<?php echo(getAliasURI()) ?>/images/carteLocalZoom.png" target="_blank">
						<img src="<?php echo(getAliasURI()) ?>/images/carteLocal.png" style="width: 100%"/>
					</a>
					<br/>
					<br/>
					<a class="lien" href="<?php echo(getAliasURI()) ?>/images/photoLocal.png" target="_blank">voir photo du local</a>
					<br/>
					<br/>
					<br/>
				</div>
			</div>

			<div id="responsable" style="position: absolute; visibility: hidden;">
				<div class="titreSectionContact" style="padding-left: 0px">
					&nbsp;
				</div>
				<div class="contenuSection">
					Monsieur<br/>
					Thierry JUPITER<br/>
					T�l. : 06.49.66.80.35<br/>
					Email : <a href="mailto:postmaster@as-evan.fr">postmaster@as-evan.fr</a><br/>
				</div>
			</div>

			<div id="gratuit" style="position: absolute; visibility: hidden;">
				<div class="titreSectionContact" style="padding-left: 0px">
					Vous pouvez demander gratuitement
				</div>
				<div class="contenuSection">
					<ul>
						<li>Une Bible</li>
						<li>La brochure " QUESTIONS  FONDAMENTALES "<br/>
    						(qui pr�sente l'essentiel du message biblique et ses effets dans notre vie)</li>
						<li>Une �tude Biblique � domicile sur un sujet � d�finir</li>
						<li>La visite d'un chr�tien de l'�glise.</li>
					</ul>
				</div>
			</div>

			<div id="assister" style="position: absolute; visibility: hidden;">
				<div class="titreSectionContact" style="padding-left: 0px">
					Pour assister &agrave; l'une de nos r&eacute;unions
				</div>
				<br/>
				<div class="contenuSection">
				En venant de Paris, ou en venant de Mulhouse, sur la A35 :
				<ul>
				<li>1) Prendre la sortie n�4 :  "Kehl - Strasbourg - Place de l'Etoile - Neudorf."</li>
				<li>2) Suivre ensuite Neudorf.</li>
				<li>3) Une fois entr� sur la route du Polygone, prendre la deuxi�me rue � gauche, et vous y �tes !</li>
				<li>4) Voici notre adresse exacte : <br/>
						Assembl�e Evang�lique<br/>
						5 rue Baldner<br/>
						67100 STRASBOURG</li>
				</ul>
				<a class="lienImage" href="<?php echo(getAliasURI()) ?>/images/carteLocalZoom.png" target="_blank">
					<img src="<?php echo(getAliasURI()) ?>/images/carteLocal.png" style="width: 100%"/>
				</a>
				<br/>
				</div>				
			</div>
		</div>
		
<!--		<div style="text-align: center">-->
<!--			<img src="<?php echo(getAliasURI()) ?>/images/plan.png" />-->
<!--			<br/>-->
<!--		</div>-->
		<br/><br/>
		<div style="clear: both"></div>
	</div>
	
	<?php
	include('./include/_piedPage.php');
	?>
	
</body>
</html>