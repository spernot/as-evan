<?php

	function tagBulletin($bulletin, $afficherTexteEnEntier) {

		echo("<span class='titreBulletin'>".$bulletin->getTitre()."</span><br/><br/>");
		echo($bulletin->getTexteBulletin($afficherTexteEnEntier));
		
		// si l'édito n'est pas affiché en entier, on ajoute un lien 
		// [Suite...] pour permettre à l'utilisateur d'afficher le tout.
		if (!$afficherTexteEnEntier) {
			$hrefSuite = $_SERVER['PHP_SELF']."?suiteTexte=vrai";
						
			echo("&nbsp;");
			echo("<a href='".$hrefSuite."' class='lien'>");
			echo("[Suite...]");
			echo("</a>");					
		}

		echo("<br/>");
		echo("<br/>");
		echo("<span class='referenceBulletin'>");

		// ensuite, on ajoute les références de l'édito, si elles existent
		if ($bulletin->getLivre() != null) {
			echo("Extrait du livre '");
			echo($bulletin->getLivre());
			echo("'");
							
			if ($bulletin->getAuteur() != null) {
				echo(" de ");
				echo($bulletin->getAuteur());
			}
		}
										
		echo("</span>");
		
		
		
	} 


?>