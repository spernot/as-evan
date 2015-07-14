<?php


require_once 'archi/objetsMetiers/PlanningAnnee.php';



/**
 * Affiche les balises HTML de chaque section du planning sp�cialement pour le dimanche
 * C'est une sorte de tag...
 *
 * @param unknown_type $jour
 * @param unknown_type $activites
 */
function afficheDebutTagSpecheulDimanche($journee) {
	$nomJour = $journee->getNomDuJour();
	$numeroJour = $journee->getNumeroDuJour();

	// Attention! Il peut y avoir plusieurs lignes!
	$lesActivites = $journee->getTableauActivites();
	
	echo("<div class='entreePlanning dimanche'>");
	echo("<div class='jourGauche dimanche'>");
	echo("<span class='nomJourGauche'>".$nomJour."</span><br/>");
	echo("<span class='numJourGauche'>".str_pad($numeroJour, 2, "0", STR_PAD_LEFT)."</span>");
	
	// Ajout d'un saut de ligne par activit�
	gestionTailleDivJour($lesActivites);
	
	echo("</div>");
	echo("<div class='contenu dimanche'>");

	

	// Parcours + affichage des diff�rentes lignes avec retour chariot en prime
	affichageActivites($journee);
}

/**
 * Affiche les balises HTML de chaque section du planning
 * C'est une sorte de tag...
 *
 * @param unknown_type $jour
 * @param unknown_type $activites
 */
function afficheDebutTagEntree($journee) {

	$nomJour = $journee->getNomDuJour();
	$numeroJour = $journee->getNumeroDuJour();

	if ($nomJour == Constantes::$DIMANCHE) {
		
		afficheDebutTagSpecheulDimanche($journee);
		
	}
	else {

		// Attention! Il peut y avoir plusieurs lignes!
		$lesActivites = $journee->getTableauActivites();
		
		echo("<div class='entreePlanning'>");
		echo("<div class='jourGauche'>");
		echo("<span class='nomJourGauche'>".$nomJour."</span><br/>");
		echo("<span class='numJourGauche'>".str_pad($numeroJour, 2, "0", STR_PAD_LEFT)."</span>");
		// Ajout d'un saut de ligne par activit�
		gestionTailleDivJour($lesActivites);
		echo("</div>");
		echo("<div class='contenu'>");

		// Parcours + affichage des diff�rentes lignes avec retour chariot en prime
		affichageActivites($journee);
//		echo("</div>");
	}
}

function affichageActivites($journee) {
	
	$lesActivites = $journee->getTableauActivites();
	
	foreach ($lesActivites as $activite) {
		
		if (strlen(trim($activite->getLibelle())) == 0)
			continue;
		
		echo("<div >&nbsp;");
		if ($activite->isImportant()) {
			echo("<img src='".getAliasURI()."/images/agendaAttention.png' />&nbsp;");
		}
		else if ($activite->isInfo()) {
			echo("<img src='".getAliasURI()."/images/agendaInfo.png' />&nbsp;");
		} else {
			echo("<img src='".getAliasURI()."/images/vide.png' />&nbsp;");
		}
		echo($activite->getLibelle());
		echo("</div><br/>");
	}
}

/**
 * Ajoute une section 'Dimanche' si:
 * - $jourPrecedent est null mais le couple (num�ro du jour � afficher + indice jour jour) permet l'affichage d'un dimanche 
 * - $jourAAfficher est diff�rent de 'Dimanche'
 * - indice de $jourPrecedent >= indice de $jourAAfficher 
 * note: l'indice du jour est pris dans la variable: $_SESSION['joursDeLaSemaine']
 * 
 * @param String $jourPrecedent
 * @param String $jourAAfficher
 * @param String $culte
 * 
 * 
 */
function gestionAffichageDimancheClassique($journeePrecedente, $journee, $culte) {

	// Cas particulier du premier jour du mois (qui n'est pas d�j� renseign� dans le planning)
	// il est peut-�tr possible d'inserer un dimanche... on va calculer �a...
	$premierDimanche = FALSE; 
	if ($journeePrecedente == null) {
		$numJourAAficher = intval($journee->getNumeroDuJour());
		$numJourPremierDimanche = $numJourAAficher - (getIndiceDuJour($journee->getNomDuJour()) + 1);
		
		if ($numJourPremierDimanche > 0) {
			
			// On peut afficher un dimanche car son num�ro de jour est sup�rieur � 0! Joie!
			// Construisons la variable qui va bien afin de continuer la fonction actuel comme si de rien n'�tait...
			$journeePrecedente = new Journee();
			$journeePrecedente->preciseLeJour(Constantes::$DIMANCHE." " . $numJourPremierDimanche);
			$journeePrecedente->preciseActivites($culte);
			$premierDimanche = TRUE;			
		}
		else {
			return;
		}
	}	
	
	// On capitalize les chaines de caractere trouv�es
	$nomJourPrecedent = $journeePrecedente->getNomDuJour();
	$nomJourAAfficher = $journee->getNomDuJour();
	
	// pour tous les autres cas
	// Si le jour � afficher est un dimanche, on ne s'occupe de rien
	if ($nomJourPrecedent == Constantes::$DIMANCHE && !$premierDimanche) {
		return;
	}
	
	if (getIndiceDuJour($nomJourPrecedent) >= getIndiceDuJour($nomJourAAfficher)) {
		// Je dois afficher un dimanche interm�diaire!
		// Il me faut le num�ro de jour du dimanche � afficher
		
		$numJourPrecedent = intval($journeePrecedente->getNumeroDuJour());
		
		// qui est pr�cis�ment = $numJourPrecedent + (6-indiceJourPrecedent)
		$numJourDimanche = $numJourPrecedent + (6 - getIndiceDuJour($nomJourPrecedent));
		
		$dimanche = new Journee();
		$dimanche->preciseLeJour(Constantes::$DIMANCHE." " . $numJourDimanche);
		$dimanche->preciseActivites($culte);
		
		// et on affiche le tag sp�cifique au dimanche
		afficheDebutTagSpecheulDimanche($dimanche);
		afficheFinTagEntree();
	}
		
}

/**
 * Ajoute une section 'Dimanche' en fin de mois si:
 * - $jourPrecedent n'est pas null 
 * - num�ro de $jourPrecedent ne d�passe pas le mois 
 * note: l'indice du jour est pris dans la variable: $_SESSION['joursDeLaSemaine']
 * 
 * @param String $jourPrecedent
 * @param String $jourAAfficher
 * @param String $culte
 */
function gestionAffichageDimancheFinMois($journeePrecedente, $moisEnCours, $anneeEnCours, $culte) {

	if ($journeePrecedente == null)	{
		return;
	}
	
	// Cas particulier du dernier jour du mois (qui n'est pas d�j� renseign� dans le planning)
	// il est peut-�tr possible d'ajouter un dimanche... on va calculer �a...
	$numJourPrecedent = intval($journeePrecedente->getNumeroDuJour());
	$numJourDernierDimanche = $numJourPrecedent + (6 - getIndiceDuJour($journeePrecedente->getNomDuJour()));

	if ($numJourDernierDimanche < 32 
			&& $numJourPrecedent != $numJourDernierDimanche) {
			
		// on va checker la date par le systeme, histoire de ne pas afficher n'importe quoi
		if (checkdate(getIndiceMoisEnCours($moisEnCours), $numJourDernierDimanche,  intval($anneeEnCours))) {

			// et on affiche le tag sp�cifique au dimanche
			$journee = new Journee();
			$journee->preciseLeJour(Constantes::$DIMANCHE." " . $numJourDernierDimanche);
			$journee->preciseActivites($culte);			
			afficheDebutTagSpecheulDimanche($journee);
			afficheFinTagEntree();
		}
	}
}

/**
 * Ajout des sauts de ligne dans la div du jour 
 * en fonction du nombre d'activit� du jour
 * 
 * @param $activites
 */
function gestionTailleDivJour($lesActivites) {
// 	$premiereligne = true;
// 	foreach ($lesActivites as $activite) {
// 		if (!$premiereligne)
// 			echo("<span class='sautDeLigne'><br/></span>");
		
// 		$premiereligne = false;
// 	}
}

/**
 * retourne l'indice du jour pass� en parametre
 * 
 * @param $nomJour
 */
function getIndiceDuJour($nomJour) {
	$i = 0;
	foreach (Constantes::$JOURS_SEMAINE as $j) {
		
		if ($j == $nomJour)
			return $i;
		else		
			$i++;
	}
	
	return -1;
}

/**
 * retourne l'indice du jour pass� en parametre
 * 
 * @param $nomJour
 */
function getIndiceMoisEnCours($mois) {
	$i = 0;
	foreach (Constantes::$MOIS_ANNEE_PLANNING as $j) {
		
		if ($j == $mois)
			return $i;
		else		
			$i++;
	}
	
	return -1;
}


/**
 * La fin de la section affich�e plus haut..; des fois qu'il y ait encore
 * des choses � afficher entre ces 2 sections...
 */
function afficheFinTagEntree() {
	echo("</div></div>");
}




?>