<?php
// Gestion de l'envoi du mail
if (isset($_POST['nom'])) {
	
	// on chope les champs saisi
	$nom = trim($_POST['nom']);	
	$adrMail = trim($_POST['adrMail']);
	$objet = trim($_POST['objet']);
	$message = trim($_POST['message']);

	// Je fais différentes vérifs
	$erreur = false;
	$msgErreur = "Les champs suivants sont obligatoires: <br/>";
	if (strlen($nom) == 0) {
		$msgErreur .= "- Nom<br/>";
		$erreur = true;
	}
	
	if (strlen($adrMail) == 0) {
		$msgErreur .= "- Adresse email<br/>";
		$erreur = true;
	}
	
	if (strlen($objet) == 0) {
		$msgErreur .= "- Objet du message<br/>";
		$erreur = true;
	}

	if (strlen($message) == 0) {
		$msgErreur .= "- Le message<br/>";
		$erreur = true;
	}

	if (strlen($adrMail) > 0) {
		/* Expression régulière permettant de vérifier si le
		 * format d'une adresse e-mail est correct */
		$regex_mail = '/^[-+.\w]{2,64}@[-.\w]{2,64}\.[-.\w]{2,6}$/i';
		if (!preg_match($regex_mail, $adrMail)) {
			$msgErreur = "L'adresse eMail est incorrecte.";
			$erreur = true;
		}
	}
	
	if ($erreur) {
		$_SESSION["MAIL_OK"] = false;
		$_SESSION["MSG_ERREUR"] = $msgErreur;
	
	} else {
		
		// preparation du mail
		$sujet = "Un message a été envoyé depuis la rubrique 'Contact'";
// 		$destinataire = "sebastien67.pernot@yahoo.fr;jr.ludmann@gmail.com";
		$destinataire = "contact@as-evan.fr";
		$corps = "Message de: \n" . $nom . " (" . $adrMail. ")\n\n" 
				. "Objet du message : " . $objet . "\n\n"
				. $message;	
		
		// Envoi du mail
		if (mail($destinataire, $sujet, $corps)) {
			$_SESSION["MAIL_OK"] = true;
			unset($_POST);
		} else {
			echo ("Votre message n'a pas été envoyé pour d'obscures raisons techniques...<br/>Veuillez nous en excuser et réessayer un peu plus tard.");
		}
	}	
}
?>

<?php

// Gestion des retours de vérification
 
if (isset($_SESSION["MAIL_OK"])) {
	if ($_SESSION["MAIL_OK"] == false) {
		// Erreur lors de la saisie du formulaire
		echo("<div class=\"erreur\">");
		echo($_SESSION["MSG_ERREUR"]);
		echo("</div><br/>");
	}
	else {
		// OK. Mail envoyé
		echo("<div class=\"traitementOK\">");
		echo("Votre message a bien été envoyé...");
		echo("</div><br/>");
	}
}
?>

<form action="<?php echo($_SERVER['PHP_SELF'])?>" method="POST">
	Votre nom:<br/>
	<input type="text" style="width: 100%" name="nom" value="<?php echo (isset($_POST['nom'])) ? $nom : '' ?>"/><br/>				
	Votre email:<br/>
	<input type="text" style="width: 100%" name="adrMail" value="<?php echo (isset($_POST['adrMail'])) ? $adrMail : '' ?>"/><br/>
	Objet du message:<br/>
	<input type="text" style="width: 100%" name="objet" value="<?php echo (isset($_POST['objet'])) ? $objet : '' ?>"/><br/><br/>
	Votre message:<br/>
	<textarea cols="29" rows="4" name="message"><?php echo (isset($_POST['message'])) ? $message : '' ?></textarea><br/>
	<input type="submit" value="Envoyer" />
</form>
<?php 
unset($_SESSION["MAIL_OK"]); 
?>