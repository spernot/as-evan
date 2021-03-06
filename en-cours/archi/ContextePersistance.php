<?php

	/**
	 * Cette classe est une fa�ade contenant les acc�s au chargement des donn�es 
	 * et qui renvoie, pour la plupart, une conteneur d'objet metier
	 */

	require_once 'archi/objetsMetiers/Conference.php';
	require_once 'archi/objetsMetiers/PlanningAnnee.php';
	require_once 'archi/objetsMetiers/TexteAccueil.php';
	require_once 'archi/objetsMetiers/News.php';
	require_once 'archi/objetsMetiers/ObjetRacine.php';


	
	/**
	 * Lit le fichier 'ecouterEtVoir.ini' et renvoit un tableau de $Conference
	 * Voil�...
	 */
	function lireFichierConference() {
		
		// Construction du chemin absolu du fichier
		$cheminAbsolu = dirname(__FILE__);
		$cheminAbsolu = str_replace("/archi", "", $cheminAbsolu);
		$cheminAbsolu = str_replace("\\archi", "", $cheminAbsolu);

		$nomFichier = $cheminAbsolu."/parametres/ecouterEtVoir.ini";

		// cas d'erreur
		if (!$fp = fopen($nomFichier, "r")) {
			echo "Echec de l'ouverture du fichier ".$nomFichier;
			exit;
		}

		// dans tous les autres cas
		$conteneur = new ConteneurConferences();
		$conference = null;
		$attributsFichier = null;
			
		$sectionListeFichier = false;
			
		while(!feof($fp)) {
			// On r�cup�re une ligne
			$ligne = trim(fgets($fp, 1024));

			if (isLigneVide($ligne))
				continue;

			// Section [Conference]
			if (preg_match("/^\[Conference\]/", $ligne) == 1) {

				$sectionListeFichier = false;
					
				// d�claration d'une instance de conf�rence qui est 
				// imm�diatement ajout� au conteneur qui va bien
				$conference = new Conference();
				$conteneur->ajouteConference($conference);
			}


			// Fin de section Conference
			else if (preg_match("/^\[\/Conference\]/", $ligne) == 1) {
				
				$sectionListeFichier = false;
			}

			// Section [Fichier]
			else if (preg_match("/^\[Fichier\]/", $ligne) == 1) {
					
				$sectionListeFichier = true;
				$attributsFichier = new AttributsFichier();
			}

			// Fin de section [Fichier]
			// je l'ajoute au tableau de fichier d�j� construit
			else if (preg_match("/^\[\/Fichier\]/", $ligne) == 1) {
					
				$sectionListeFichier = false;
				$conference->ajouteFichier($attributsFichier);
					
			} else {
					
				// Dans tous les autres cas, on est dans une section attribut
				// que je vais d�crotiquer et setter dns les diff�rents objets
				$relation = explode(" = ", $ligne);
				if (count($relation) == 2) {
						
					$nomAttribut = trim($relation[0]);
					$valeurAttribut = trim($relation[1]);
						
					if ($sectionListeFichier) {
						$attributsFichier->setNouvelAttributFichier($nomAttribut, $valeurAttribut);
					}
					else {
						$conference->setNouvelAttributConference($nomAttribut, $valeurAttribut);
					}
				}					
			}
		}
		fclose($fp); // On ferme le fichier
		
		return $conteneur;
	}
	
	
	
	/**
	 * Renvoi un objet de type ConteneurTexteAccueil
	 * 
	 */
	function lectureEditos() {
		
		// Construction du chemin absolu du fichier
		$cheminAbsolu = dirname(__FILE__);
		$cheminAbsolu = str_replace("/archi", "", $cheminAbsolu);
		$cheminAbsolu = str_replace("\\archi", "", $cheminAbsolu);

		$nomFichier = $cheminAbsolu."/parametres/accueil.ini";

		if (!$fp = fopen($nomFichier, "r")) {
			echo "Echec de l'ouverture du fichier ".$nomFichier;
			exit;
		}

		$conteneur = new ConteneurTexteAccueil();
		$texteAccueil = null;
		$sectionAttributEdito = false;
		$sectionAttributBulletin = false;
			
		while(!feof($fp)) {
			// On r�cup�re une ligne
			$ligne = trim(fgets($fp, 4096));

			if (isLigneVide($ligne))
				continue;

			
			// Section [Bulletin]
			if (preg_match("/^\[Bulletin\]/", $ligne) == 1) {

				$sectionAttributBulletin = true;
					
				// d�claration d'une instance de Edito et je l'ajoute 
				// directement au conteneur qui va bien
				$texteAccueil = new Bulletin();
				$conteneur->ajoute($texteAccueil);
				
				continue;
			}


			// Fin de section Bulletin
			else if (preg_match("/^\[\/Bulletin\]/", $ligne) == 1) {
					
				$sectionAttributBulletin = false;
					
				continue;
			}

			// Section [Edito]
			if (preg_match("/^\[Edito\]/", $ligne) == 1) {

				$sectionAttributEdito = true;
					
				// d�claration d'une instance de Edito et je l'ajoute 
				// directement au conteneur qui va bien
				$texteAccueil = new Edito();
				$conteneur->ajoute($texteAccueil);
				
				continue;
			}


			// Fin de section Edito
			else if (preg_match("/^\[\/Edito\]/", $ligne) == 1) {
					
				$sectionAttributEdito = false;
					
				continue;
			} 
			
			else {
					
				// Dans tous les autres cas, on est dans une section attribut
				// que je vais d�crotiquer et setter dns les diff�rents objets
				$relation = explode(" = ", $ligne);
				if (count($relation) == 2) {
						
					$nomAttribut = trim($relation[0]);
					$valeurAttribut = trim($relation[1]);
						
					if ($sectionAttributEdito || $sectionAttributBulletin) {
						$texteAccueil->setAttribut($nomAttribut, $valeurAttribut);
					}
				}
				else if (count($relation) == 1) {
					// Je suis dans la section texte.
					// J'ajoute au texte qui existe d�j� la ligne que je viens de trouver
					$texteAccueil->ajouteTexte($ligne);
				}
			}
		}
		fclose($fp); // On ferme le fichier

		return $conteneur;

	}

	/**
	 * Renvoi un objet Conteneur de news
	 *
	 */
	function lectureNews() {

		// Construction du chemin absolu du fichier
		$cheminAbsolu = dirname(__FILE__);
		$cheminAbsolu = str_replace("/archi", "", $cheminAbsolu);
		$cheminAbsolu = str_replace("\\archi", "", $cheminAbsolu);

		$nomFichier = $cheminAbsolu."/parametres/news.ini";

		// Gestion cas limite: le fichier n'a pas �t� trouv�
		if (!$fp = fopen($nomFichier, "r")) {
			echo "Echec de l'ouverture du fichier ".$nomFichier;
			exit;
		}

	
		// Cr�ation du conteneur � retourner
		$conteneur = new ConteneurNews();
		$news = null;
		$question = null;
		$fichierAttache = null;
		$include = null;
		
		$sectionAttributNews = false;
		$sectionQR = false;
		$sectionFichier = false;
		$sectionInclude = false;
			
		while(!feof($fp)) {
			// On r�cup�re une ligne
			$ligne = trim(fgets($fp, 4096));

			if (isLigneVide($ligne))
				continue;


			// Section [News]
			if (preg_match("/^\[News\]/", $ligne) == 1) {

				$sectionQR = false;
				$sectionAttributNews = true;
				$sectionFichier = false;
				$sectionInclude = false;
				
				// d�claration d'une instance de Edito
				$news = new News();
				$conteneur->ajouteNews($news);
			}
			
			// Section [Question]
			else if (preg_match("/^\[Question\]/", $ligne) == 1) {
				
				$sectionAttributNews = false;
				$sectionQR = true;
				$sectionFichier = false;
				$sectionInclude = false;
					
				// d�claration d'une instance de Question
				$question = new Question();
				$news->ajouteQuestionReponse($question);
			}

			// Section [FichierAttache]
			else if (preg_match("/^\[FichierAttache\]/", $ligne) == 1) {
				
				$sectionAttributNews = false;
				$sectionQR = false;
				$sectionFichier = true;
				$sectionInclude = false;
					
				// d�claration d'une instance de fichier attach� � la news
				$fichierAttache = new FichierAttache();
				$news->ajouteFichierAttache($fichierAttache);
			}
			
			// Section [Include]
			else if (preg_match("/^\[Include\]/", $ligne) == 1) {
			
				$sectionAttributNews = false;
				$sectionQR = false;
				$sectionFichier = false;
				$sectionInclude = true;					
			}
			

			// Fin de section News
			else if (preg_match("/^\[\/News\]/", $ligne) == 1) {
				$sectionQR = false;					
				$sectionAttributNews = false;
				$sectionFichier = false;
				$sectionInclude = false;
			} 
			
			// Fin de section [/Question]
			else if (preg_match("/^\[\/Question\]/", $ligne) == 1) {
				
				$sectionAttributNews = true;
				$sectionQR = false;
				$sectionFichier = false;
				$sectionInclude = false;
			}
			
			// Fin de section [/FichierAttache]
			else if (preg_match("/^\[\/FichierAttache\]/", $ligne) == 1) {
				
				$sectionAttributNews = true;
				$sectionQR = false;
				$sectionFichier = false;
				$sectionInclude = false;
			}
			
			// Fin de section [/Include]
			else if (preg_match("/^\[\/Include\]/", $ligne) == 1) {
			
				$sectionAttributNews = true;
				$sectionQR = false;
				$sectionFichier = false;
				$sectionInclude = false;
			}
			
			else {

				if (!$sectionAttributNews && !$sectionQR && !$sectionFichier && !$sectionInclude)
					continue;


				// on est dans une section attribut
				// que je vais d�crotiquer et setter dns les diff�rents objets
				$relation = explode(" = ", $ligne);
				if (count($relation) == 2) {

					$nomAttribut = trim($relation[0]);
					$valeurAttribut = trim($relation[1]);

					if ($sectionAttributNews) {
						$news->setNouvelAttribut($nomAttribut, $valeurAttribut);
					}
					
					else if ($sectionQR) {
						if ($nomAttribut == "q") {
							$question->setQuestion($valeurAttribut);
						}
						else if ($nomAttribut == "r") {
							$question->setReponse($valeurAttribut);
						}
					}
					
					else if ($sectionFichier) {
						if ($nomAttribut == "titre") {
							$fichierAttache->setTitre($valeurAttribut);
						}
						else if ($nomAttribut == "URL") {
							$fichierAttache->setUrlFichier($valeurAttribut);
						}
					}
					
					else if ($sectionInclude) {
						$news->ajouteInclude($valeurAttribut);
					}
				}
			}
		}
		fclose($fp); // On ferme le fichier

		return $conteneur;
	}



	/**
	 * Cette fontion permet de lire le fichier planning.ini et le stocke dans un
	 * tableau tous les mois lus dans le fichier
	 *
	 * Les commentaires et lignes vides sont superbement ignor�es
	 *
	 * @param $nomFichier
	 * @return un tableau PlanningMois[]
	 */
	function lirefichierPlanning() {

		//$tableauRetour = array();

		// Construction du chemin absolu du fichier
		$cheminAbsolu = dirname(__FILE__);
		$cheminAbsolu = str_replace("/archi", "", $cheminAbsolu);
		$cheminAbsolu = str_replace("\\archi", "", $cheminAbsolu);

		$nomFichier = $cheminAbsolu."/parametres/planning.ini";

		// Gestion cas limite: le fichier du planning n'a pas �t� trouv�
		if (!$fp = fopen($nomFichier, "r")) {
			echo "Echec de l'ouverture du fichier ".$nomFichier;
			exit;
		}

		// Sinon, bah, on cr� le conteneur de planning
		$planningDeLAnnee = new PlanningAnnee();
		$planningMois = null;

		$insideSectionParametre = false;

		while(!feof($fp)) {
			// On r�cup�re une ligne
			$ligne = trim(fgets($fp, 1024));

			if (isLigneVide($ligne))
				continue;
				
			// titre de section ?
			// une section commence par [, contient plusieurs caract�res et finit par ]
			if (preg_match("/^[\[]/", $ligne) == 1 /*&& preg_match("/[\]]/", $ligne) == 1*/) {

				if ($ligne == '[Parametres]') {
					// Il s'agit de la section parametre
					$insideSectionParametre = true;
					continue;
				}

				$insideSectionParametre = false;

				// Sinon, il s'agit d'un mois! Bigre!
				// On cree une instance de PlanningMois
				$planningMois = new PlanningMois();
				$planningMois->setMois($ligne);

				// et on le push dans le tableau de retour de fonction
				$planningDeLAnnee->ajoutePlanningMensuel($planningMois);
			}
				
			// si le planning est incomplet, je le pr�cise
			else if ($ligne == "#incomplet#") {
				$planningMois->setIncomplet(true);



				// Dans les autre cas, on a une relation jour <-> activit�
				// et donc un objet Journee
			} else {

				// sauvegarde des parametres du fichier ini
				if ($insideSectionParametre == true) {
					$parametre = explode(" = ", $ligne);
					if (count($parametre) == 2) {
						$planningDeLAnnee->ajouteParametre($parametre[0], $parametre[1]);
					}
					continue;
				}


				// Si je n'ai pas de mois en cours, alors les lignes trouv�e sont des scories
				// que je ne prend pas en compte
				if ($planningMois == null) {
					continue;
				}

				$journee = new Journee();

				// On va d�cortiquer la ligne qu'on vient de lire
				$relation = explode(" = ", $ligne);
				if (count($relation) == 2) {
						
					$journee->preciseLeJour(trim($relation[0]));
					$journee->preciseActivites(trim($relation[1]));
						
					// et on ajoute cette journee au planning du mois
					$planningMois->ajouteJournee($journee);
				}

			}
		}
		fclose($fp); // On ferme le fichier

		// et on sort de l�...
		return $planningDeLAnnee;

	}


	/**
	 * Appel�e partout lors de la lecture des diff�rents fichiers
	 * renvoie true si la ligne est consid�r�e comme vide
	 * 
	 * @param $ligne
	 */
	function isLigneVide($ligne) {
		// si la ligne est vide ou ne contient que des espaces, on passe � la suite
		if (strlen($ligne) == 0) {
			return true;
		}

		// Si la ligne ne contient pas de caractere, on passe � la ligne suivante
		// C'est peut �tre redondant avec le test pr�c�dent,
		// mais on est jamais trop prudent...
		if (preg_match("/[a-zA-Z]/", $ligne) == 0) {
			return true;
		}

		// Si la ligne est un commentaire, on passe � la suite
		if (preg_match("/^;/", $ligne) == 1) {
			return true;
		}
		
		return false;
	} 
	
?>