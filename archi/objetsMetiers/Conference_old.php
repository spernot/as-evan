<?php

	require_once 'archi/objetsMetiers/ObjetRacine.php';

	/**
	 * Classe qui contient les attributs de chaque fichier
	 * 
	 * @author SebDeux
	 *
	 */
	class AttributsFichier extends ObjetRacine {
		
		private $attributs = array();
		
		// Construteur par défaut
		function AttributsFichier() {
			// génération d'un identifiant
			parent::ObjetRacine();
		}
		
		// getter et setter
		function setNouvelAttributFichier($nom, $valeur) {
			$this->attributs[$nom] = $valeur;
		}
		
		function getURI() {
			return $this->attributs["URI"];
		}
		
		function getNomFichier() {
			return $this->attributs["nomFichier"];
		}
		
		function getLibelle() {
			return $this->attributs["libelle"];
		}
		
		function getType() {
			return $this->attributs["type"];
		}
		
		function __toString() {
			return '[' . $this->getURI() . ', '
			. $this->getNomFichier() . ', '
			. $this->getLibelle() . ']';
		}
	}

	/**
	 * définition d'une classe qui va bien pour stocker/afficher
	 * les attributs de chaque conférence
	 * 
	 */
	class Conference extends ObjetRacine {
		//Attributs
		private $attributs = array();
		private $listeFichier = array(); // en fait, c'est un tableau puisque le type 'List' n'existe pas en php
		private $index = 0;
		
		// Constructeur par défaut
		public function Conference() {
			// génération d'un identifiant
			parent::ObjetRacine();
		}
		
		
		// ajout de fichiers de conférence
		public function ajouteFichier($attributsFichier) {
			array_push($this->listeFichier, $attributsFichier);
		}
		
		// les getter/setter qui vont bien
		public function getListeFichiers() {
			return $this->listeFichier;
		}
		
		public function setNouvelAttributConference($nom, $valeur) {
			$this->attributs[$nom] = $valeur;
		}
			
		public function getAuteur() {
			return $this->attributs["auteur"];
		}
		
		public function getIcone() {
			if (isset($this->attributs["icone"]))
				return $this->attributs["icone"];
			else
				return "anonyme.png";
		}
		
		// Utile pour les comparaisons
		public function getDateDebut() {
			$d = DateTime::createFromFormat("Y-m-d", $this->attributs['dateDebut']);
			if ($d == false)
				die("date de début '".$this->attributs['dateDebut']."' non valide pour être une date");
			return $d;
		}
		
		public function getDateEvenement() {
			return $this->attributs["date"];
		}
		
		public function getTitreConference() {
			return $this->attributs["titreConference"];
		}		
		
		public function getTypeConference() {
			return $this->attributs["type"];
		}
		
		/**
		 * Retrouve un objet AttributsFichier à partir de son identifiant
		 * 
		 * @param String $id
		 * @return unknown
		 */
		public function getAttributsFichier($id) {
			foreach ($this->listeFichier as $att) {
				if (strcmp($id, $att->getId()) == 0) {
					return $att;
				}
			}
		}
		
		function __toString() {
			return '[' . $this->getAuteur() . ', '
			. $this->getIcone() . ', '
			. $this->getDateEvenement() . ', '
			. $this->getTitreConference() . ']';
		}
	}
	
	
	/**
	 * Conteneur de conférence
	 * On lui délègue:
	 * - le tri des conférences
	 * - le futur filtre par auteur/date (pour l'instant, on renvoie tout)
	 * 
	 */
	class ConteneurConferences {
		
		private $tableauConferences = array();
		
		/**
		 * Constructeur par défaut
		 */
		public function ConteneurConferences() {
			// rien de particulier
		}
		
		public function ajouteConference($conference) {
			array_push($this->tableauConferences, $conference);
		}
		
		public function getTableauConferences() {
			
			// tri du tableau des conférences avant de le retourner
			usort($this->tableauConferences, array($this, 'compare'));			
			return $this->tableauConferences;
		}
		
		/**
		 * Wrapper pour retrouver un fichier depuis son Id
		 * 
		 * @param String $id
		 */
		public function getAttributsFichier($id) {
			foreach ($this->tableauConferences as $conference) {
				$att = $conference->getAttributsFichier($id);
				if ($att != null)
					return $att;
			}
		}
		
		/**
		 * tri les conférence par ordre croissant de leur date
		 * 
		 * @param unknown_type $a
		 * @param unknown_type $b
		 */
		public static function compare($a, $b) {
			if (!isset($a))
				return 0;
				
			if (!isset($b))
				return 0;
				
			$dateNewsA = $a->getDateDebut()->format('Ymd');
			$dateNewsB = $b->getDateDebut()->format('Ymd');
			
			// Je veux l'ordre inverse
			return strcmp($dateNewsB, $dateNewsA);
		}
	}
	
?>