<?php


/**
 * Retourne l'url actuelle sans le nom de la classe php
 *
 * @param nom
 */
function getVraieUrl($Postparam, $nomFic) {
	
	$url = "http://".$Postparam['SERVER_NAME'];
	$composantsURI = explode("/", $Postparam['REQUEST_URI']);
	
	for ($i=1; $i < count($composantsURI)-1; $i++) {
		$url .= "/".$composantsURI[$i];
	}

	return $url.$nomFic;
}

function getRepertoires() {
	
	$listeRep = array();
	if ($handle = opendir('.')) {
		while (false !== ($entry = readdir($handle))) {
			if (!is_dir($entry))
				continue;
	
			if ($entry != "." && $entry != "..") {
				array_push($listeRep, $entry);
			}
		}
	}
	return $listeRep;
}




?>