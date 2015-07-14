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
					<li>Elle a �t� fond�e en 1994 par des chr�tiens qui ont eu le d�sir de fonder une �glise. </li>
					<li>Elle s'inscrit dans le cadre du mouvement �vang�lique, mais elle est ind�pendante de toute organisation ou mouvement religieux.</li>
				</ul>
			</div>
	
			<div class="titreSectionPresentation">
				Nous croyons
			</div>
			<div class="resumeSectionPresentation">
				<ul>
					<li>Que la Bible est la Parole de Dieu.</li>
					<li>Que J�sus-Christ est Dieu.</li>
					<li>Que le salut se trouve en J�sus-Christ seul.</li>
					<li>Que c'est par la foi et non par les oeuvres que l'on obtient ce salut.</li>
				</ul>
			</div>
	
			<div class="titreSectionPresentation">
				Notre but
			</div>
			<div class="resumeSectionPresentation">
				<ul>
					<li>Pr�senter le salut en J�sus-Christ.</li>
					<li>Exhorter tout chr�tien v�ritable � aimer, suivre et servir J�sus-Christ notre Seigneur.</li>
				</ul>
			</div>
	
			<div class="titreSectionPresentation">
				Nous ne pensons pas
			</div>
			<div class="resumeSectionPresentation">
				<ul>
					<li>Que notre �glise soit la meilleure.</li>
					<li>Qu'une quelconque religion puisse sauver.</li>
				</ul>
			</div>
	
			<div class="titreSectionPresentation">
				Nos activit&eacute;s
			</div>
			<div class="resumeSectionPresentation">
				<ul>
					<li>Culte le dimanche matin � 10h00.</li>
					<li>R�union d'enfants, le dimanche matin � 10h00.</li>
					<li>R�union de pri�re ou d'�tude biblique, le jeudi � 20h15.</li>
					<li>R�union de dames, le premier mercredi de chaque mois.</li>
					<li>Stand biblique, le samedi au Neudorf.</li>
					<li>R�unions d'�vang�lisation, trois fois par an.</li>
					<li>Une sortie d'�glise tout un week-end, une fois par an.</li>
					<li>R�union des groupes de jeunes.</li>
				</ul>
			</div>
	
			<div class="titreSectionPresentation">
				Membres de l'�glise
			</div>
			<div class="resumeSectionPresentation">
				Pour �tre membre, il faut en faire la demande aupr�s du comit� qui, au cours d'un entretien, pr�sente le fonctionnement de l'�glise ainsi que ses orientations spirituelles.<br/>
				Pour �tre membres, il faut :
				<ul>
					<li>�tre majeur;</li>
					<li>s'�tre converti � J�sus-Christ;</li>
					<li>participer � la vie de l'�glise;</li>
					<li>�tre en accord avec les principes de foi de l'&eacute;glise.</li>
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