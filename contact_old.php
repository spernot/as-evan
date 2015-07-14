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
setPageActuelle('contact');

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<?php
	include('./include/_meta.php');
	?>

	<title>Assembl&eacute;e &eacute;vang&eacute;lique du Neudorf</title>

	<link rel="stylesheet" href="./css/commun.css">

	<script language="javascript">

		var nomsDiv = ["presentationContact", "responsable", "gratuit", "assister"];

		// Comme son nom l'indique, hein...
		function montrerDiv(idDiv) {
			 for (var i=0; i<=nomsDiv.length; i=i+1) {
			 	var div = document.getElementById(nomsDiv[i]);
				var image = document.getElementById('point'+i);

				if (!div) {
					// Avec certaine version de IE, on peut se retrouver ici...
					div = document.getElementsByName(nomsDiv[i])[0];
					image = document.getElementsByName('point'+i)[0];
				}

				if (!div) {
					// Dans le pire des cas, on ne fait rien...
					return;
				}

				// Bien, maintenant on va cacher toutes les div sauf celle que je veux afficher
				if (nomsDiv[i] == idDiv) {
					div.style.visibility = 'visible';
					div.style.position = 'relative';

					// et j'affiche aussi le point bleu du lien que je viens de cliquer
					image.style.visibility = 'visible';
					image.style.position = 'relative';

				} else {
					div.style.visibility = 'hidden';
					div.style.position = 'absolute';

					//je cache tous les autres pouints bleus
					image.style.visibility = 'hidden';
					image.style.position = 'absolute';
				}
			}
		}

	</script>
</head>
<body>

	<?php
	include('./include/_entete.php');
	?>
	<div class="cadrePrincipal">
		<br/>
		<div class="contactGauche">
			<br/>
			<div class="contenuSection">
				<img src="<?php echo(getAliasURI()) ?>/images/pointBleuPetit.png" id="point0" style="position: relative;" />
				<a href="#" class="lien" onclick="montrerDiv('presentationContact')">Notre adresse</a>
				<br/><br/>
				<img src="<?php echo(getAliasURI()) ?>/images/pointBleuPetit.png" id="point3" style="position: absolute; visibility: hidden;" />
				<a href="#" class="lien" onclick="montrerDiv('assister')">Nous rejoindre</a>
				<br/><br/>
				<img src="<?php echo(getAliasURI()) ?>/images/pointBleuPetit.png" id="point1" style="position: absolute; visibility: hidden;" />
				<a href="#" class="lien" onclick="montrerDiv('responsable')">Contacter un responsable</a>
				<br/><br/>
				<img src="<?php echo(getAliasURI()) ?>/images/pointBleuPetit.png" id="point2" style="position: absolute; visibility: hidden;" />
				<a href="#" class="lien" onclick="montrerDiv('gratuit')">Autres possibilités</a>				
				<br/>
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
					Tél. : 06.49.66.80.35<br/>
					Email : <a href="mailto:contact@as-evan.fr">contact@as-evan.fr</a><br/>
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
    						(qui présente l'essentiel du message biblique et ses effets dans notre vie)</li>
						<li>Une étude Biblique à domicile sur un sujet à définir</li>
						<li>La visite d'un chrétien de l'église.</li>
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
				<li>1) Prendre la sortie n°4 :  "Kehl - Strasbourg - Place de l'Etoile - Neudorf."</li>
				<li>2) Suivre ensuite Neudorf.</li>
				<li>3) Une fois entré sur la route du Polygone, prendre la deuxième rue à gauche, et vous y êtes !</li>
				<li>4) Voici notre adresse exacte : <br/>
						Assemblée Evangélique<br/>
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