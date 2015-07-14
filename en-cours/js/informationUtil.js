/**
	*
	* Fonction utile pour montrer le contexte des versets bibliques
	* pr�sents dans les articles
	*
	* Prend comme parametre d'entr�e le nom de la div � afficher/masquer
	*/
	function montrerReponse(idDiv) {
		var div = document.getElementById(idDiv);

		if (!div) {
			// Avec certaine version de IE, on peut se retrouver ici...
			div = document.getElementsByName(idDiv)[0];
		}

		if (!div) {
			return;
		}

		if (div.style.visibility == 'visible') {
			div.style.visibility = 'hidden';
			div.style.position = 'absolute';
		} else {
			div.style.visibility = 'visible';
			div.style.position = 'relative';
		}
	}