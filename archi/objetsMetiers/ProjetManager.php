<?php

	require_once 'archi/objetsMetiers/ObjetRacine.php';
	require_once 'archi/Spyc.php';
	
	/**
	 * Un Objet pour chaque page... on ne se complique pas la vie...
	 * 
	 * @author SebDeux
	 */
	class Page extends ObjetRacine {
		
		public $numPage;
		public $image;
		public $titre;
		public $descriptif;
		public $contact;
		public $nouvelles = array(); // tableau de tableau
		public $avancement = array();
		public $lien = array(); 
		
		public function __construct() {
			// génération d'un identifiant
			parent::ObjetRacine();
		}
	}

	/**
	 * Représente un projet avec sa liste de page
	 * 
	 * @author SebDeux
	 *
	 */
	class Projet extends ObjetRacine {
		
		public $titre;
		public $description;
		public $dateEcheance;
		public $dateDebut;
		public $repertoire;
		public $listePages = array(); 
		
		public function __construct() {
			// génération d'un identifiant
			parent::ObjetRacine();
		}
		
	}
	
	/**
	 * Représente un conteneur de projet avec ses méthodes d'acces
	 * 
	 * @author SebDeux
	 *
	 */
	class ProjetManager extends ObjetRacine {

		private $projet;
		
		public function unProjetEstEnCours() {
			return true;
		}
		
		public function nombrePageProjet() {
			return count($this->projet->listePages);
		}
		
		public function ajouteUnProjet($projet) {
			$this->projet = $projet;
		}
		
		public function getProjet() {
			return $this->projet;
		}
	}
?>