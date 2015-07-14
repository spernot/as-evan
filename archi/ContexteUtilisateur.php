<?php

	require_once 'archi/ContextePersistance.php';
	require_once 'archi/objetsMetiers/ObjetRacine.php';

	/**
	 * Le contexte utilisateur contient les variables chargées depuis un fichier
	 * Plus tard, on y retrouvera également l'identifiant utilisateur, son profil etc...
	 * 
	 * Le planning
	 * La liste des conférences
	 * Les données de l'accueil
	 * 
	 * Ce contexte est stocké dans la session utilisateur
	 *
	 * @author SebDeux
	 *
	 */
	class ContexteUtilisateur {
		
		private $planning;
		
		private $projetManager;
		
		private $conteneurConference;
		
		private $conteneurTexteAccueil;
		
		private $conteneurNews;
		
		function ContexteUtilisateur() {
			// constructeur par défaut.
		}		
		
		/**
		 * Renvoi un objet de Type TexteAccueil pour le mois en cours
		 */
		function getTexteAccueil() {
			if (!isset($this->conteneurTexteAccueil)) {
				$this->conteneurTexteAccueil = lectureEditos();
				majContexteUtilisateur($this);
			}			
			return $this->conteneurTexteAccueil->getActualiteAAfficher();
		}
		
		/**
		 * Renvoi un objet de type PlanningAnnee
		 */
		function getPlanning() {
			if (!isset($this->planning)) {
				$this->planning = lirefichierPlanning();
				majContexteUtilisateur($this);
			}
			return $this->planning;
		}
		
		/**
		 * Renvoi un objet de type ProjetManager
		 */
		function getProjetManager() {
			if (!isset($this->projetManager)) {
				//TODO à implémenter
				$this->projetManager = lireFichierProjet();
				majContexteUtilisateur($this);
			}
			return $this->projetManager;
		}
		
		/**
		 * Wrapper qui retrouve un fichier depuis son Id
		 * 
		 * @param String $id
		 */
		function getAttributsFichier($id) {
			if (!isset($this->conteneurConference)) {
				$this->conteneurConference = lireFichierConference();
				majContexteUtilisateur($this);
			}
			return $this->conteneurConference->getAttributsFichier($id);
		}
		
		/**
		 * Renvoi un tableau d'objets Conference
		 * 
		 * On demande à l'objet ConteneurConference de renvoyer le
		 * tableau des conférences à afficher
		 */
		function getConferences($orateurExterieur) {
			if (!isset($this->conteneurConference)) {
				$this->conteneurConference = lireFichierConference();
				majContexteUtilisateur($this);
			}
			return $this->conteneurConference->getTableauConferences($orateurExterieur);
		}
		
		/**
		 * Renvoi un tableau de news active pour l'accueil
		 * 
		 * On demande à l'objet ConteneurNews de renvoyer un tableau des news 
		 * à afficher dans l'accueil (avec une préférence pour les news importantes)
		 */
		function getNewsAccueil() {
			if (!isset($this->conteneurNews)) {
				$this->conteneurNews = lectureNews();				
				majContexteUtilisateur($this);
			}
			return $this->conteneurNews->getNewsActives(true);
		}
		
		
		/**
		 * Renvoi un tableau de news active pour l'accueil
		 * 
		 * On demande à l'objet ConteneurNews de renvoyer un tableau de toutes 
		 * les news non périmées (sans préférences pour l'importance de celles-ci)
		 */
		function getNewsActives() {
			if (!isset($this->conteneurNews)) {
				$this->conteneurNews = lectureNews();				
				majContexteUtilisateur($this);
			}
			return $this->conteneurNews->getNewsActives(false);
		}
		
	}

	/**
	 * Appelée à chaque page php. permet de définir quelle page est acyuellement affichée
	 * Utile pour la classe _menu.php
	 * 
	 * @param $nomPage
	 */
	function setPageActuelle($nomPage) {
		$_SESSION['pageActuelle'] = $nomPage;
	}

	
	/**
	 * redirige vers l'accueil si la session utilisateur n'est pas initialisée
	 */
	function verificationSessionUtilisateur() {
		
		session_start();
		
		if (!isset($_SESSION['ContexteUtilisateur'])) {
			header("location: index.php");
			exit;
		}
	}
	
	/**
	 * Gestion du contexte utilisateur
	 * 
	 * Enter description here ...
	 */
	function getContexteUtilisateur() {
		if (isset($_SESSION['ContexteUtilisateur']))
			return unserialize($_SESSION['ContexteUtilisateur']);
		
		return null;
	}
	
	function majContexteUtilisateur($nouveauContexte) {
		$_SESSION['ContexteUtilisateur'] = serialize($nouveauContexte);
	}
	
	/**
	 * Récupère le contexte de l'URI du site. 
	 * Il n'y a pas de fonction PHP permettant de le récuperer (? bizarre quand même)
	 * 
	 * en dev, il s'agit de l'alias parametré dans le serveur web
	 * en ligne, ce sera (probablement) une chaine vide.
	 */
	function getAliasURI() {
		$aliasURI = "";
		$composantsURI = explode("/", $_SERVER['REQUEST_URI']);
		if (count($composantsURI) == 1) {
			return $aliasURI;
		} else {
			for ($i = 1; $i < count($composantsURI)-1; $i++) {
				$aliasURI = $aliasURI."/".$composantsURI[$i];
			}
		}
		return $aliasURI;
	}
	
?>