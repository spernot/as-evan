<?php

	require_once 'archi/objetsMetiers/ObjetRacine.php';

	
	class Question extends ObjetRacine {
		private $question;
		private $reponse;
		
		public function Question() {
			// génération d'un identifiant
			parent::ObjetRacine();
		}

		// getter et setter kivonbien
		
		public function getQuestion() {
			return $this->question;
		}
		public function setQuestion($q) {
			$this->question = trim($q);
		}
		
		public function getReponse() {
			return $this->reponse;
		}
		public function setReponse($r) {
			$this->reponse = trim($r);
		}
	}
	
	class FichierAttache extends ObjetRacine {
		private $titre;
		private $urlFichier;
		
		public function FichierAttache() {
			// génération d'un identifiant
			parent::ObjetRacine();
		}
		
		// getter et setter kivonbien
		public function getTitre() {
			return $this->titre;
		}
		public function setTitre($t) {
			$this->titre = trim($t);
		}
		
		public function getUrlFichier() {
			return $this->urlFichier;
		}
		public function setUrlFichier($url) {
			$this->urlFichier = trim($url);
		}
	}
	
	/**
	 * Classe de représentation des news/evenements 
	 * (présents dans l'accueil du site notamment) 
	 * 
	 * @author SebDeux
	 */
	class News extends ObjetRacine {

		// Contient tous les attributs d'une news 
		private $attributs = array();
		
		// contient toutes les Q/R relative à une news
		private $questions = array();
		
		// contient tous les fichiers attachés à la news
		private $fichiersAttaches = array();
		
		// Les fichiers PHP inclus dans la page (c'est moche, mais c'est en attendant...)
		private $include = array();
		
		public function News() {
			// génération d'un identifiant
			parent::ObjetRacine();
		}
		
		public function setNouvelAttribut($nomAttribut, $valeur) {
			$this->attributs[trim($nomAttribut)] = trim($valeur);
		}
		
		public function ajouteQuestionReponse($qr) {
			array_push($this->questions, $qr);
		}
		
		public function ajouteFichierAttache($fichier) {
			array_push($this->fichiersAttaches, $fichier);
		}
		
		public function ajouteInclude($url) {
			array_push($this->include, $url);
		}
		
		/**
		 * Parse la date disponible dans les attributs pour retourner un objet 'Date'
		 */
		public function getDateDebut() {
			$d = DateTime::createFromFormat("Y-m-d", $this->attributs['dateDebut']);
			if ($d == false)
				die("date de début '".$this->attributs['dateDebut']."' non valide pour être une date");
			return $d;
		}
		
		/**
		 * Parse la date disponible dans les attributs pour retourner un objet 'Date'
		 * Au pire, renvoie la date de début
		 */
		public function getDateFin() {
			$dateFin = $this->attributs['dateFin'];
			if (!isset($dateFin))
				$d = $this->getDateDebut();
			else
				$d = DateTime::createFromFormat("Y-m-d", $dateFin);
			
			if ($d == false)
				die("date de fin '".$this->attributs['dateFin']."' non valide pour être une date");
				
			return $d;
		}
		
		public function getImage() {
			return $this->attributs['image'];
		}
		
		public function getImageInformation() {
			return $this->attributs['imageInformation'];
		} 
		
		public function getTitre() {
			return $this->attributs['titre'];
		}
		
		public function getResume() {
			if (isset($this->attributs['resume']))
				return $this->attributs['resume'];
			
			return "";
		}
		
		public function getQuestionsReponses() {
			return $this->questions;
		}
		
		public function getFichiersAttaches() {
			return $this->fichiersAttaches;
		}
		
		public function getIncludes() {
			return $this->include;
		}
		
		/**
		 * Retourne true si la news est importante (et doit être affichée dans l'accueil)
		 */
		public function isImportant() {
			if (isset($this->attributs['important']))
				return $this->attributs['important'] == 'oui';
			
			return false;
		}
	}


	/**
	 * Conteneur de toutes les news disponibles
	 * 
	 * Fourni des méthodes d'accès aux news en cours
	 * 
	 * @author SebDeux
	 */
	class ConteneurNews {
		private $tableauNews = array();
		
		//date du jour. Ce sera le point de repère pour les news actuelles/périmées
		private $dateDuJour;
		
		public function ConteneurNews() {
			
			// màj de la date du jour 
			$this->dateDuJour = date('Ymd');			
		}
		
		public function ajouteNews($news) {
			array_push($this->tableauNews, $news);
		}
		
		
		/**
		 * Compare les dates de chaque jour et renvoie un tableau de news 
		 * non périmées
		 * 
		 * Attention: les news 'Importantes' peuvent être prioritaires 
		 * sur les autres si demandé.
		 */
		public function getNewsActives($lesNewsImportantesSeulement) {
			
			$retourNews = array();
			$retourNewsImportantes = array();
			
			// tri du tableau de news avant son parcours
			usort($this->tableauNews, array($this, 'compare'));
			
			foreach ($this->tableauNews as $news) {
				
				$strDateNews = $news->getDateFin()->format('Ymd');
				
				if ($this->dateDuJour < $strDateNews) {
					// C'est une news à afficher
					// maintenant, on va se préoccuper de son importance
					if ($news->isImportant())
						array_push($retourNewsImportantes, $news);
					
					// de toutes façon, j'ajoute ici toutes les news
					array_push($retourNews, $news);
					
				}	
			}

			// Bien, comme promis, on va renvoyer en priorité les news 
			// importantes, s'il y en a
			if ((count($retourNewsImportantes) > 0) && $lesNewsImportantesSeulement)
				return $retourNewsImportantes;
			else
				// Sinon, on retourne toutes les news pas encore périmées
				return $retourNews;
			
		}

		/**
		 * Fonction de tri pour les News. 
		 * Le tri est effectué par date décroissante
		 * 
		 * @param unknown_type $a
		 * @param unknown_type $b
		 */
		public static function compare($a, $b) {
			if (!isset($a))
				return 0;
				
			if (!isset($b))
				return 0;
				
			$dateNewsA = $a->getDateFin()->format('Ymd');
			$dateNewsB = $b->getDateFin()->format('Ymd');
			
			// Je veux l'ordre inverse
			return strcmp($dateNewsB, $dateNewsA);			
		}
	}
?>