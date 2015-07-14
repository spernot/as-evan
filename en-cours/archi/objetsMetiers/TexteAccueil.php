<?php

	require_once 'archi/objetsMetiers/ObjetRacine.php';

	/**
	 * Interface des objets � afficher dans la section Bulletin/Edito de l'accueil
	 * 
	 * Pour l'instant, les classes filles ne doivent impl�menter que la function 
	 * de retour du mois concern� par l'Edito/Bulletin
	 */
	interface TexteAccueil {
		
		/**
		 * Le mois concern� par l'Actualit�
		 * A impl�menter dans les classes filles
		 */
		public function getMois();
		
		/**
		 * Le titre de l'actualit�
		 * A impl�menter dans les classes filles
		 */
		function getTitre();
				
		/**
		 * Les attributs relatif � chaque objet
		 * 
		 * @param $nom
		 * @param $valeur
		 */
		function setAttribut($nom, $valeur);
		
		/**
		 * Permet d'ajouter du texte au texte existant
		 * A impl�menter dans les classes filles
		 * 
		 * @param $texte
		 */
		function ajouteTexte($texte);
	}


	/**
	 * Repr�sente l'Edito d'un mois donn� avec toutes ses propri�t�s
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
		 * Attributs � d�finir par la suite
		 * 
		function getLivre() {
			return $this->attributs["livre"];
		}
		
		function getAuteur() {
			return $this->attributs["auteur"];
		}
		*/
		/**
		 * retourne le texte de l'�dito passablement reformatt�
		 * 
		 * @param $afficherTout est � true si on veut afficher l'�dito en entier.
		 */
		function getTexteEdito($afficherTout) {
			$texteEdito = $this->attributs["texte"];
			
			// on remplace les [rl] par des retour � la ligne html
			$texteEdito = str_replace("[rl]", "<br/>", $texteEdito);
			
			
			if ($afficherTout == false) {
				// Si on ne veut pas tout afficher, on tronque le texte � 1000 caracteres
				// et on ajoute ... � la fin du texte
				$texteEdito = trim(substr($texteEdito, 0, 1000));
				
				// comme on est surement tomb� au milieu d'un mot, on va couper jusqu'au dernier espace
				$texteEdito = trim(substr($texteEdito, 0, strrpos($texteEdito, " ")));
				
				// Puis on ajoute '...' � la fin
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
	 * Repr�sente le texte du bulletin mensuel �dit� par l'�glise
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
		 * retourne le texte de l'�dito passablement reformatt�
		 * 
		 * @param $afficherTout est � true si on veut afficher l'�dito en entier.
		 */
		function getTexteBulletin($afficherTout) {
			$texteBulletin = $this->attributs["texte"];
			
			// on remplace les [rl] par des retour � la ligne html
			$texteBulletin = str_replace("[rl]", "<br/>", $texteBulletin);
			
			
			if ($afficherTout == false) {
				// Si on ne veut pas tout afficher, on tronque le texte � 1000 caracteres
				// et on ajoute ... � la fin du texte
				$texteBulletin = trim(substr($texteBulletin, 0, 1000));
				
				// comme on est surement tomb� au milieu d'un mot, on va couper jusqu'au dernier espace
				$texteBulletin = trim(substr($texteBulletin, 0, strrpos($texteBulletin, " ")));
				
				// Puis on ajoute '...' � la fin
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
	 * Conteneur des textes � afficher dans l'accueil
	 * 
	 * On lui d�l�gue
	 * - L'affichage de l'Edito/Bulletin du mois 
	 * - le calcul de la priorit� du texte � afficher
	 */
	class ConteneurTexteAccueil {
		
		private $tableauTexteAccueil = array();
				
		// Chaine de caract�re
		private $moisEnCours = null;
		
		public function ConteneurTexteAccueil() {
			// Constructeur par d�faut
			// Calcul du mois en cours
			$this->moisEnCours = Constantes::$MOIS_ANNEE[(int) date("n") - 1 ];
		}
		
		
		public function ajoute($texteAccueil) {
			array_push($this->tableauTexteAccueil, $texteAccueil);
		}
		
		/**
		 * Retourne un objet qui impl�mente TexteAccueil pour le mois en cours
		 * Avec une pr�f�rence � d�finir dans un prochain temps...
		 */
		public function getActualiteAAfficher() {
			
			// parcours du tableau des texte � affiche dans l'accueil
			// on retourne celui qui correspond au mois en cours
			foreach ($this->tableauTexteAccueil as $texteAccueil) {			
				if ($this->moisEnCours == $texteAccueil->getMois()) {
					return $texteAccueil;
				}
			}			
		}
	}
?>