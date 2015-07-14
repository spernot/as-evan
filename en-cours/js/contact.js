		var nomsDiv = ["presentationContact", "responsable", "gratuit", "assister"];

		// Comme son nom l'indique, hein...
		function montrerDiv(idDiv) {
			 for (var i=0; i<=nomsDiv.length; i=i+1) {
			 	var div = document.getElementById(nomsDiv[i]);
				var image = document.getElementById('point'+i);

				if (!div) {
					// Avec certaine version de IE, on peut se retrouver ici...
					div = document.getElementsByName(nomsDiv[i])[0];
					image = document.getElementsByName('point'+i)[0];
				}

				if (!div) {
					// Dans le pire des cas, on ne fait rien...
					return;
				}

				// Bien, maintenant on va cacher toutes les div sauf celle que je veux afficher
				if (nomsDiv[i] == idDiv) {
					div.style.visibility = 'visible';
					div.style.position = 'relative';

					// et j'affiche aussi le point bleu du lien que je viens de cliquer
					image.style.visibility = 'visible';
					image.style.position = 'relative';

				} else {
					div.style.visibility = 'hidden';
					div.style.position = 'absolute';

					//je cache tous les autres pouints bleus
					image.style.visibility = 'hidden';
					image.style.position = 'absolute';
				}
			}
		}