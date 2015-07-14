<?php

/**
 *
 *
 * @version $Id$
 * @copyright 2011
 */

require_once('./archi/ContexteUtilisateur.php');
require_once './archi/MultimediaUtil.php';

verificationSessionUtilisateur();

// Je précise sur quelle page je suis
setPageActuelle('ecouteretvoir');

// get des fichiers de conférence dans la session utilisateur
$contexteUtilisateur = getContexteUtilisateur();

// filtre sur le type d'orateur
$orateurExterieur = "oui";
if (isset($_GET["f"])) {
	$orateurExterieur = $_GET["f"];
}

// Recherche des conf avec le filtre
$tableauConferences = $contexteUtilisateur->getConferences($orateurExterieur);


?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<?php
	include('./include/_meta.php');
	?>

	<title>Assembl&eacute;e &eacute;vang&eacute;lique du Neudorf</title>

	<link rel="stylesheet" href="<?php echo(getAliasURI()) ?>/css/commun2.css?d=<?php echo date('dm'); ?>">
	<link rel="stylesheet" href="<?php echo(getAliasURI()) ?>/css/ecouterEtVoir2.css?d=<?php echo date('dm'); ?>">

	<!-- Redéfinition de certains styles -->
	<style type="text/css">
		a.lien {
			color: #5385FF;
			text-decoration: none;
			font-weight: normal;
		}
		a.lien:active{color: #5385FF; text-decoration: none;}
		a.lien:visited{color: #5385FF; text-decoration: none;}
		a.lien:hover{color: black; text-decoration: none;}
	</style>

</head>
<body>

	<?php
	include('./include/_entete.php');
	?>

	<div class="cadrePrincipal">
		<br/>
		<div class="resumeSection" style="text-align: center; border-bottom: 2px solid #BABABA;" >
		<a class="lien" 
			href="<?php echo $_SERVER['PHP_SELF']."?f=oui"?>" 
			style="<?php if ($orateurExterieur == "oui") echo "font-size: 1.2em; color: white; background-color: #7DCB2C; padding: 5px; border-radius: 4px 4px 0 0;" ?>">Orateurs extérieurs</a>&nbsp;
		<a class="lien" 
			href="<?php echo $_SERVER['PHP_SELF']."?f=non"?>" 
			style="<?php if ($orateurExterieur == "non") echo "font-size: 1.2em; color: white; background-color: #7DCB2C; padding: 5px; border-radius: 4px 4px 0 0;" ?>">Orateurs habituels</a>
		</div>
		
		<?php 
			// ensuite, on boucle sur le tableau des conférences disponibles
			foreach ($tableauConferences as $conference) {
				afficherDebutTag($conference);
				afficherFinTag();
			}
			
		?>		
		<br/>
		<br/>
		<br/>
		
		
	</div>

	<?php
	include('./include/_piedPage.php');
	?>

</body>
</html>