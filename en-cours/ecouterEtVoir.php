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
$tableauConferences = $contexteUtilisateur->getConferences();


?>

<!DOCTYPE HTML>
<html>
<head>
	<?php
	include('./include/_meta.php');
	?>

	<title>Assembl&eacute;e &eacute;vang&eacute;lique du Neudorf</title>

	<link rel="stylesheet" href="./css/commun.css">
	<link rel="stylesheet" href="./css/ecouterEtVoir.css">

</head>
<body>

	<div class="cadrePrincipal"> 

	<?php
	include('./include/_entete.php');
	?>

		<br/>
		
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