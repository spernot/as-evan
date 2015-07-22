<?php

	require_once 'archi/objetsMetiers/Conference.php';

	
	/**
	 * 
	 * Affiche l'ensemble des balises d'une présentation de conférence
	 *  
	 * @param $conference doit être un objet de type Conference.
	 */
	function afficherDebutTag($conference) {
		
		// affichage des attributs de l'évènement
		echo("<div class='titreSectionMultimedia'>");
		echo("<span class='typeContenuMultimedia'>".$conference->getAttribut("type")."</span>");
		echo("<span class='titreContenuMultimedia'>");
		echo($conference->getAttribut("titreConference"));
		echo("</span>");
//		echo('<span sctyle="background-color: #75BC29; color: white; font-size: 0.5em; float:right; margin-right: 20px; margin-top: 10px; padding-left: 1em; padding-right: 1em;">'.$conference->getTypeConference().'</span>');
		echo("</div>");
//		echo('<img class="basSection" src="./images/basSection.png"/>');
		
		echo("<div class='resumeSection'>");
		echo("	<div class='photoGauche'>");
		echo("		<img src='".getAliasURI()."/images/portrait/".$conference->getIcone()."' />");
		echo("	</div>");
		echo("	<div class='presentationDroite'>");
		echo("		Auteur : <span style='font-weight: normal;'>".$conference->getAttribut("auteur")."</span><br/>");
		echo("		Date : <span style='font-weight: normal;'>".$conference->getAttribut("date")."</span><br/>");
		echo("		Orateur extérieur : <span style='font-weight: normal;'>".ucfirst($conference->getAttribut("invite"))."</span><br/>");
		echo("		<br/>");
		echo("	</div>");
		echo("	<div class='contenu'>");
		
		// vérification de la taille de la liste des fichiers dispo
		if (count($conference->getListeFichiers()) == 0) {
			echo("Les fichiers audio seront bientôt disponibles...");
		}
		
		
		// bouclage sur les fichiers de l'évenement
		echo('<table class="fichiersConference">');
		
		$i = 0;
		foreach ($conference->getListeFichiers() as $attributsFichier) {
			$lienRessource = getAliasURI().$attributsFichier->getURI();
			if ($i % 2 == 0)
				echo("<tr>");
			else
				echo("<tr class='impaire'>");
						
			echo("<td style='width:80%'>".$attributsFichier->getLibelle()."&nbsp;");
			if (null !== $attributsFichier->getCommentaire()) {
				echo("<br/>");
				echo("<span style=\"font-weight:normal\">Note: ".$attributsFichier->getCommentaire()."</span>");
			}
			
			echo("</td>");
			echo("<td>");
// 			echo("<object type=\"application/x-shockwave-flash\" 
// 					data=\"".getAliasURI()."/librairieWeb/dewplayer/dewplayer.swf?mp3=".$lienRessource."\"  
// 					width=\"200\" 
// 					height=\"20\"
// 					top=\"20\"
// 					id=\"dewplayer1\">");
			echo("<object type=\"application/x-shockwave-flash\"
					data=\"".getAliasURI()."/librairieWeb/dewplayer/dewplayer.swf?mp3=".getAliasURI()."/lecture.php?lienDownload=".$attributsFichier->getId()."\"
					width=\"200\"
					height=\"20\"
					top=\"20\"
					id=\"dewplayer1\">");
			echo("<param name=\"wmode\" value=\"transparent\" />");
			echo("</object>");
			echo("</td>");
			echo("<td>");			
// 			$hrefDownload = getAliasURI()."/sonVideo/download.php?lienDownload=".$attributsFichier->getURI();
			$hrefDownload = getAliasURI()."/download.php?lienDownload=".$attributsFichier->getId();
			echo("<a href='".$hrefDownload."' class='lien'>Télécharger</a>");
			echo("</td>");
			echo("</tr>");
			$i++;	
		}
		
		echo("</table>");
		echo("</br>");
		echo("<hr/>");
	}
	
	function afficherFinTag() {
		
		echo("</div>");		
		echo("</div>");
	}
	
?>