<?php

	require_once 'archi/Constantes.php';
	require_once 'archi/objetsMetiers/ObjetRacine.php';
	
	/**
	 * Représente une activité dans une journée
	 * 
	 * @author SebDeux
	 *
	 */
	class Activite extends ObjetRacine {
		
		private $libelle;
		private $tag;
		
		private $important = false;
		private $evangelisation = false;
		private $info = false;
		
		/**
		 * Constructeur par défaut
		 * 
		 * Reçoit un libellé d'activité comme paramètre
		 */
		function Activite($value) {
			
			// génération d'un identifiant
			parent::ObjetRacine();
			
			// Activité importante
			if (strpos($value, "{!}") !== FALSE) {
				// prévoir un genre d'enum pour le tag, si possible
				$this->important = true;
				$value = str_ireplace("{!}", "", $value);
			}
			
			if (strpos($value, "{evan}") !== FALSE) {
				// prévoir un genre d'enum pour le tag, si possible
				$this->evangelisation = true;
				$value = str_ireplace("{evan}", "", $value);
			}
			
			if (strpos($value, "{info}") !== FALSE) {
				// prévoir un genre d'enum pour le tag, si possible
				$this->info = true;
				$value = str_ireplace("{info}", "", $value);
			}
			
			$this->libelle = trim($value);
		}
		
		function getLibelle() {
			return $this->libelle;
		}
		
		function isImportant() {
			return $this->important;
		}
		
		function isEvangelisation() {
			return $this->evangelisation;
		}
		
		function isInfo() {
			return $this->info;
		}
	}
	
	/**
	 * Représente un item dans le planning du mois
	 * 
	 * @author SebDeux
	 */
	class Journee extends ObjetRacine {
		
		private $nomJour;
		private $numeroJour;
		private $activites = array();
		
		function Journee() {
			// constructeur par défaut
			parent::ObjetRacine();			
		}
		
		function preciseLeJour($jourLu) {
			$this->nomJour = ucfirst(trim(substr($jourLu, 0, strpos($jourLu, ' '))));
			$this->numeroJour = trim(substr($jourLu, strpos($jourLu, ' ')));
		}

		/**
		 * Ajoute les activités/évènements de la journée
		 * 
		 * @param $lesActivites
		 */
		function preciseActivites($chaineTrouvee) {

			if (strpos($chaineTrouvee, '\\')) {
				$tableauActivites = explode('\\', $chaineTrouvee);
				foreach ($tableauActivites as $activiteTrouvee) {
					$activite = new Activite($activiteTrouvee);
					array_push($this->activites, $activite);
				}
			} else {
				$activite = new Activite($chaineTrouvee);
				array_push($this->activites, $activite);
			}
		}
		
		function getNomDuJour() {
			return $this->nomJour;
		}

		function getNumeroDuJour() {
			return $this->numeroJour;
		}
		
		function getTableauActivites() {
			return $this->activites;
		}
		
		function __toString() {
			return $this->getNumeroDuJour() . " " . $this->getNomDuJour();					
		}
	}

	/**
	 * Classe qui represente un mois du planning
	 * Elle contient une liste d'objets Journee
	 * 
	 * @author SebDeux
	 *
	 */
	class PlanningMois {
		
		private $mois;
		
		// Contient un tableau d'objets @Journee 
		private $journees = array();
		
		private $incomplet = false;
		
		function PlanningMois() {
			// Constructeur par défaut
		}
		
		// Il peut arriver que le planning mensuel soit partiellement completé
		function setIncomplet($boolean) {
			$this->incomplet = $boolean;
		}		
		function isIncomplet() {
			return $this->incomplet;
		}
		
		function setMois($moisTrouve) {
			
			$moisTrouve = str_replace("[", "", $moisTrouve);
			$moisTrouve = str_replace("]", "", $moisTrouve);
			
			$this->mois = ucfirst($moisTrouve);
		}
		
		function getMois() {
			return $this->mois;
		}
		
		
		function ajouteJournee($journee) {
			array_push($this->journees, $journee);
		}
		
		/**
		 * retourne le tableau des objets Journée du mois
		 * lus dans le fichier planning
		 */
		function getListeJournee() {
			return $this->journees;
		}
	}
	

	/**
	 * Conteneur des planning de chaque mois
	 * ainsi que les parametres lus dans le fichier planning.ini
	 * 
	 * On lui délègue 
	 * - le renvoi de l'objet PlanningMois du mois concerné
	 * - Le calcul des mois précédents/suivants
	 * 
	 * Enter description here ...
	 * @author SebDeux
	 *
	 */
	class PlanningAnnee {
		
		// tableau à 2 dimensions des parametres lus dans le fichier planning.ini
		private $parametres = array();
		
		// Contient un tableau d'objets PlanningMois 
		private $tableauPlanning = array();
		
		// Chaine de caractère
		// Calculé lors de l'instanciation de l'objet
		// Celui-ci peut être modifié grâce au setter qui va bien
		private $moisEnCours = null; 
		
		function PlanningAnnee() {
			// Constructeur par défaut
			// on va instancier le mois en cours avec la vraie valeur
			$this->moisEnCours = Constantes::$MOIS_ANNEE_PLANNING[(int) date("n") ];			
		}
		
		function setMoisEnCours($mois) {
			$this->moisEnCours = $mois;
		}
		
		function getMoisEnCours() {
			return $this->moisEnCours;
		}
		
		function ajoutePlanningMensuel($planningDuMois) {
			array_push($this->tableauPlanning, $planningDuMois);
		}
		
		function ajouteParametre($cle, $valeur) {
			$this->parametres[$cle] = $valeur;
		}
		
		function getParametre($cle) {
			return $this->parametres[$cle];
		}
		
		function getPlanningDuMois() {
			foreach ($this->tableauPlanning as $planning) {
				if ($planning->getMois() == $this->getMoisEnCours()) {
					$planningDuMois = $planning;
					return $planningDuMois;
					break;
				}
			}
		}
		
		/**
		 * cherche le mois précédent par rapport à $this->mois
		 * retourne une chaine de caractere. "" si début de l'année
		 */
		function getNomMoisPrecedent() {
			$i = 1;
			while (($this->moisEnCours != Constantes::$MOIS_ANNEE_PLANNING[$i]) && ($i < 12)) {
				$i++;
			}
			return Constantes::$MOIS_ANNEE_PLANNING[$i-1];
		}
		
		/**
		 * cherche le mois précédent par rapport à $this->mois
		 * retourne une chaine de caractere. "" si fin de l'année
		 */
		function getNomMoisSuivant() {
			$i = 1;
			while (($this->moisEnCours != Constantes::$MOIS_ANNEE_PLANNING[$i]) && ($i < 12)) {
				$i++;
			}
			return Constantes::$MOIS_ANNEE_PLANNING[$i+1];
		}
		
	}
?>