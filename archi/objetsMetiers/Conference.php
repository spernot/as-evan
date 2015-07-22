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
		function __construct() {
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
		
		function getCommentaire() {
			if (isset($this->attributs["commentaire"]))
				return $this->attributs["commentaire"];
			return null;
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
		public function __construct() {
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
		
		public function getAttribut($attr) {
			return $this->attributs[$attr];
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
			. $this->getAttribut("dateEvenement") . ', '
			. $this->getAttribut("titre") . ']';
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
		public function __construct() {
			// rien de particulier
		}
		
		public function ajouteConference($conference) {
			array_push($this->tableauConferences, $conference);
		}
		
		/**
		 * Renvoi les conferences suivant le type d'orateur
		 * 
		 * @param unknown_type $orateursExterieurs
		 */
		public function getTableauConferences($orateursExterieurs) {
			
			// Filtre des conférences à prendre en compte
			$tableauRetour = array();
			foreach ($this->tableauConferences as $conf) {
//				echo $conf->->getDateDebut();
				if ($conf->getAttribut("invite") == $orateursExterieurs) {
					array_push($tableauRetour, $conf);
				}
			}
			
			// tri du tableau des conférences avant de le retourner
			usort($tableauRetour, array($this, 'compare'));			
			return $tableauRetour;
		}
		
		/**
		 * Methode utile pour retrouver un fichier depuis son Id
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
		public static function compare($confA, $confB) {
			if (!isset($confA))
				return 0;
				
			if (!isset($confB))
				return 0;
				
			$dateNewsA = $confA->getDateDebut()->format('Ymd');
			$dateNewsB = $confB->getDateDebut()->format('Ymd');
			
			// Je veux l'ordre inverse
			return strcmp($dateNewsB, $dateNewsA);
		}
	}
	
?>