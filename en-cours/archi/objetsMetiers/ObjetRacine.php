<?php


	/**
	 * Classe m�re des objets metiers
	 * D�fini des m�thodes de gestion d'identifiant
	 * 
	 * @author SebDeux
	 *
	 */
	class ObjetRacine {
		
		private $idObjet = null;

		public function ObjetRacine() {
			// g�n�ration de l'identifiant de l'objet
			$this->generateRandomId();
		}
		
		public function getId() {
			return $this->idObjet;
		}

		public function setId($id) {
			$this->idObjet = $id;
		}
		
		function generateRandomId($length = 20, $letters = '1234567890azertyuiopqsdfghjklmwxcvbn')	{
			$s = '';
			$lettersLength = strlen($letters)-1;
			 
			for($i = 0 ; $i < $length ; $i++)
			{
				$s .= $letters[rand(0,$lettersLength)];
			}
			
			$this->setId($s);
		}

	}

	
	
	

?>