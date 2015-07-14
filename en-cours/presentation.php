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
$_SESSION['pageActuelle'] = 'presentation';


?>


<!DOCTYPE HTML>
<html>
<head>
	<?php
	include('./include/_meta.php');
	?>

	<title>Assembl&eacute;e &eacute;vang&eacute;lique du Neudorf</title>

	<link rel="stylesheet" href="./css/commun.css">

</head>
<body>

	<div class="cadrePrincipal"> 
		<?php
		include('./include/_entete.php');
		?>

		<br/>
		<div class="presentationGauche">
			<div class="titreSectionPresentation">
				Nous sommes
			</div>
			<div class="resumeSectionPresentation">
				<ul>
					<li>Une association cultuelle inscrite au tribunal d'instance de Strasbourg.</li>
					<li>Elle a été fondée en 1994 par des chrétiens qui ont eu le désir de fonder une église. </li>
					<li>Elle s'inscrit dans le cadre du mouvement évangélique, mais elle est indépendante de toute organisation ou mouvement religieux.</li>
				</ul>
			</div>
	
			<div class="titreSectionPresentation">
				Nous croyons
			</div>
			<div class="resumeSectionPresentation">
				<ul>
					<li>Que la Bible est la Parole de Dieu.</li>
					<li>Que Jésus-Christ est Dieu.</li>
					<li>Que le salut se trouve en Jésus-Christ seul.</li>
					<li>Que c'est par la foi et non par les oeuvres que l'on obtient ce salut.</li>
				</ul>
			</div>
	
			<div class="titreSectionPresentation">
				Notre but
			</div>
			<div class="resumeSectionPresentation">
				<ul>
					<li>Présenter le salut en Jésus-Christ.</li>
					<li>Exhorter tout chrétien véritable à aimer, suivre et servir Jésus-Christ notre Seigneur.</li>
				</ul>
			</div>
	
			<div class="titreSectionPresentation">
				Nous ne pensons pas
			</div>
			<div class="resumeSectionPresentation">
				<ul>
					<li>Que notre église soit la meilleure.</li>
					<li>Qu'une quelconque religion puisse sauver.</li>
				</ul>
			</div>
	
			<div class="titreSectionPresentation">
				Nos activit&eacute;s
			</div>
			<div class="resumeSectionPresentation">
				<ul>
					<li>Culte le dimanche matin à 10h00.</li>
					<li>Réunion d'enfants, le dimanche matin à 10h00.</li>
					<li>Réunion de prière ou d'étude biblique, le jeudi à 20h15.</li>
					<li>Réunion de dames, le premier mercredi de chaque mois.</li>
					<li>Stand biblique, le samedi au Neudorf.</li>
					<li>Réunions d'évangélisation, trois fois par an.</li>
					<li>Une sortie d'église tout un week-end, une fois par an.</li>
					<li>Réunion des groupes de jeunes.</li>
				</ul>
			</div>
	
			<div class="titreSectionPresentation">
				Membres de l'église
			</div>
			<div class="resumeSectionPresentation">
				Pour être membre, il faut en faire la demande auprès du comité qui, au cours d'un entretien, présente le fonctionnement de l'église ainsi que ses orientations spirituelles.<br/>
				Pour être membres, il faut :
				<ul>
					<li>être majeur;</li>
					<li>s'être converti à Jésus-Christ;</li>
					<li>participer à la vie de l'église;</li>
					<li>être en accord avec les principes de foi de l'&eacute;glise.</li>
				</ul>
			</div>
			<br/><br/>
		</div>
		<div class="presentationDroite">
			<br/>
			<a class="lienImage" href="contact.php">
				<img alt="" src="<?php echo(getAliasURI()) ?>/imagesMieux/uneQuestionSmall.png">
			</a>			
			<br/><br/>
			<a class="lienImage" href="ecouterEtVoir.php">
				<img alt="" src="<?php echo(getAliasURI()) ?>/imagesMieux/ecouterEtVoirSmall.png">
			</a>
			<br/><br/>
			<a class="lienImage" href="planning.php">
				<img alt="" src="<?php echo(getAliasURI()) ?>/imagesMieux/ceMoisCiSmall.png">
			</a>
		</div>
		
		<div class="resumeSectionPresentation">
		&nbsp;
		</div>
	
	</div>
	<?php
	include('./include/_piedPage.php');
	?>
	
</body>
</html>