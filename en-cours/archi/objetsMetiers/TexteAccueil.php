<?php

	require_once 'archi/objetsMetiers/ObjetRacine.php';

	/**
	 * Interface des objets à afficher dans la section Bulletin/Edito de l'accueil
	 * 
	 * Pour l'instant, les classes filles ne doivent implémenter que la function 
	 * de retour du mois concerné par l'Edito/Bulletin
	 */
	interface TexteAccueil {
		
		/**
		 * Le mois concerné par l'Actualité
		 * A implémenter dans les classes filles
		 */
		public function getMois();
		
		/**
		 * Le titre de l'actualité
		 * A implémenter dans les classes filles
		 */
		function getTitre();
				
		/**
		 * Les attributs relatif à chaque objet
		 * 
		 * @param $nom
		 * @param $valeur
		 */
		function setAttribut($nom, $valeur);
		
		/**
		 * Permet d'ajouter du texte au texte existant
		 * A implémenter dans les classes filles
		 * 
		 * @param $texte
		 */
		function ajouteTexte($texte);
	}


	/**
	 * Représente l'Edito d'un mois donné avec toutes ses propriétés
	 * 
	 * @author SebDeux
	 *
	 */
	class Edito implements TexteAccueil {
		
		var $attributs = array();
		
		function Edito() {
			// Constructeur vide
		}
		
		/**
		 * Un seul setter, parce que c'est suffisant
		 * 
		 * @param $nom
		 * @param $valeur
		 */
		function setAttribut($nom, $valeur) {
			$this->attributs[$nom] = $valeur;
		}
		
		/**
		 * (non-PHPdoc)
		 * @see archi/objetsMetiers/TexteAccueil::ajouteTexte()
		 */
		function ajouteTexte($texte) {
			$this->attributs["texte"] .= "[rl]".$texte;
		}
		
		/**
		 * (non-PHPdoc)
		 * @see archi/objetsMetiers/Actualite::getTitre()
		 */
		function getTitre() {
			return $this->attributs["titre"];
		}
		
		/**
		 * (non-PHPdoc)
		 * @see archi/objetsMetiers/Actualite::getMois()
		 */
		function getMois() {
			return $this->attributs["mois"];
		}
		
		/*
		 * Attributs à définir par la suite
		 * 
		function getLivre() {
			return $this->attributs["livre"];
		}
		
		function getAuteur() {
			return $this->attributs["auteur"];
		}
		*/
		/**
		 * retourne le texte de l'édito passablement reformatté
		 * 
		 * @param $afficherTout est à true si on veut afficher l'édito en entier.
		 */
		function getTexteEdito($afficherTout) {
			$texteEdito = $this->attributs["texte"];
			
			// on remplace les [rl] par des retour à la ligne html
			$texteEdito = str_replace("[rl]", "<br/>", $texteEdito);
			
			
			if ($afficherTout == false) {
				// Si on ne veut pas tout afficher, on tronque le texte à 1000 caracteres
				// et on ajoute ... à la fin du texte
				$texteEdito = trim(substr($texteEdito, 0, 1000));
				
				// comme on est surement tombé au milieu d'un mot, on va couper jusqu'au dernier espace
				$texteEdito = trim(substr($texteEdito, 0, strrpos($texteEdito, " ")));
				
				// Puis on ajoute '...' à la fin
				$texteEdito .= "...";
			}
			
			return $texteEdito;
		}
		
		
		function __toString() {
			return '[' . $this->getAuteur() . ', '
			. $this->getLivre() . ', '
			. $this->getMois() . ', '
			. $this->getTitre() . ']';
		}
	}
	
	
	/**
	 * Représente le texte du bulletin mensuel édité par l'église
	 * 
	 */
	class Bulletin implements TexteAccueil {
		
		var $attributs = array();
		
		function Bulletin() {
			// Constructeur vide
		}
		
		/**
		 * (non-PHPdoc)
		 * @see archi/objetsMetiers/TexteAccueil::setAttribut()
		 */
		function setAttribut($nom, $valeur) {
			$this->attributs[$nom] = $valeur;
		}
		
		/**
		 * (non-PHPdoc)
		 * @see archi/objetsMetiers/TexteAccueil::ajouteTexte()
		 */
		function ajouteTexte($texte) {
			$this->attributs["texte"] .= "[rl]".$texte;
		}
		
		/**
		 * (non-PHPdoc)
		 * @see archi/objetsMetiers/Actualite::getTitre()
		 */
		function getTitre() {
			return $this->attributs["titre"];
		}
		
		/**
		 * (non-PHPdoc)
		 * @see archi/objetsMetiers/Actualite::getMois()
		 */
		function getMois() {
			return $this->attributs["mois"];
		}
		
		function getLivre() {
			return $this->attributs["livre"];
		}
		
		function getAuteur() {
			if (isset($this->attributs["auteur"])) {
				return $this->attributs["auteur"];
			}
			return "";
		}
		
		/**
		 * retourne le texte de l'édito passablement reformatté
		 * 
		 * @param $afficherTout est à true si on veut afficher l'édito en entier.
		 */
		function getTexteBulletin($afficherTout) {
			$texteBulletin = $this->attributs["texte"];
			
			// on remplace les [rl] par des retour à la ligne html
			$texteBulletin = str_replace("[rl]", "<br/>", $texteBulletin);
			
			
			if ($afficherTout == false) {
				// Si on ne veut pas tout afficher, on tronque le texte à 1000 caracteres
				// et on ajoute ... à la fin du texte
				$texteBulletin = trim(substr($texteBulletin, 0, 1000));
				
				// comme on est surement tombé au milieu d'un mot, on va couper jusqu'au dernier espace
				$texteBulletin = trim(substr($texteBulletin, 0, strrpos($texteBulletin, " ")));
				
				// Puis on ajoute '...' à la fin
				$texteBulletin .= "...";
			}
			
			return $texteBulletin;
		}
		
		
		function __toString() {
			return '[' . $this->getAuteur() . ', '
			. $this->getLivre() . ', '
			. $this->getMois() . ', '
			. $this->getTitre() . ']';
		}
	}
	
	
	/**
	 * Conteneur des textes à afficher dans l'accueil
	 * 
	 * On lui délègue
	 * - L'affichage de l'Edito/Bulletin du mois 
	 * - le calcul de la priorité du texte à afficher
	 */
	class ConteneurTexteAccueil {
		
		private $tableauTexteAccueil = array();
				
		// Chaine de caractère
		private $moisEnCours = null;
		
		public function ConteneurTexteAccueil() {
			// Constructeur par défaut
			// Calcul du mois en cours
			$this->moisEnCours = Constantes::$MOIS_ANNEE[(int) date("n") - 1 ];
		}
		
		
		public function ajoute($texteAccueil) {
			array_push($this->tableauTexteAccueil, $texteAccueil);
		}
		
		/**
		 * Retourne un objet qui implémente TexteAccueil pour le mois en cours
		 * Avec une préférence à définir dans un prochain temps...
		 */
		public function getActualiteAAfficher() {
			
			// parcours du tableau des texte à affiche dans l'accueil
			// on retourne celui qui correspond au mois en cours
			foreach ($this->tableauTexteAccueil as $texteAccueil) {			
				if ($this->moisEnCours == $texteAccueil->getMois()) {
					return $texteAccueil;
				}
			}			
		}
	}
?>