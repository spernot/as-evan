<?php

	function tagBulletin($bulletin, $afficherTexteEnEntier) {

//		echo("<div style='overflow: scroll'>");
		echo($bulletin->getTexteBulletin($afficherTexteEnEntier));
		
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
//		echo("</div>");
	} 
?>