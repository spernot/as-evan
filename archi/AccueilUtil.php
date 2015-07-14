<?php

	function tagBulletin($bulletin, $afficherTexteEnEntier) {

		echo("<span class='titreBulletin'>".$bulletin->getTitre()."</span><br/><br/>");
		echo($bulletin->getTexteBulletin($afficherTexteEnEntier));
		
		// si l'�dito n'est pas affich� en entier, on ajoute un lien 
		// [Suite...] pour permettre � l'utilisateur d'afficher le tout.
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

		// ensuite, on ajoute les r�f�rences de l'�dito, si elles existent
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