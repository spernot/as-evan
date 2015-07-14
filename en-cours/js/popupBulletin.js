	
	// Affichage d'une popup pour le bulletin mensuel
	// Ajout d'une fonction sur le lien du bulletin
	jQuery(function($){
							   		   
		// définition d'une fonction pour le lien d'affichage du bulletin  
		$('#openBulletin').on('click', function() {
			var popID = "bulletin";

			$('#' + popID).fadeIn().prepend('<a href="#" class="close"><img src="/en-cours/imagesMieux/btnClose.png" class="btnClose" title="Close Window" alt="Close" /></a>');

			// Petits ajustements en conformité avec le CSS
			var popMargTop = ($('#' + popID).height() + 80) / 2;
			var popMargLeft = ($('#' + popID).width() + 80) / 2;
			
			//Application des marges au popup
			$('#' + popID).css({ 
				'margin-top' : -popMargTop,
				'margin-left' : -popMargLeft
			});
			
			//On sombre le fond
			$('body').append('<div id="fade"></div>');
			$('#fade').css({'filter' : 'alpha(opacity=80)'}).fadeIn(); 
			
			return false;
		});
		
		
		//fermeture du popup + suppression de l'assombrissement du fond
		$('body').on('click', 'a.close, #fade', function() { //au clic sur le bouton close ou au clic sur le fond
			$('#fade , .popupBulletin').fadeOut(function() {
				$('#fade, a.close').remove();  
			});
			
			return false;
		});
	
		
	});