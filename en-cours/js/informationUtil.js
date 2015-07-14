/**
	*
	* Fonction utile pour montrer le contexte des versets bibliques
	* présents dans les articles
	*
	* Prend comme parametre d'entrée le nom de la div à afficher/masquer
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