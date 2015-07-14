<br/>

<?php

// Gestion de l'envoi du mail
if (isset($_POST['nom'])) {
	
	// on chope les champs saisi
	$nom = trim($_POST['nom']);
	$prenom = trim($_POST['prenom']);
	$complInfo = trim($_POST['complInfo']);
	$adrMail = trim($_POST['mel']);

	// Je fais différentes vérifs
	$erreur = false;
	$msgErreur = "Les champs suivants sont obligatoires: <br/>";
	if (strlen($nom) == 0 || strlen($prenom) == 0) {
		$msgErreur .= "- Nom et prenom<br/>";
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
		$sujet = "Inscription à l'atelier greffe";
		$destinataire = "tjupiter@gmail.com";
// 		$destinataire = "sebastien67.pernot@yahoo.fr";
		$corps = "Inscription de: \nNom: " . $nom . "\nPrénom: " . $prenom . "\n mail: " . $adrMail . "\n";
		$corps .= "Question/infos compl: " . $complInfo;	
		
		// Envoi du mail
		if (mail($destinataire, $sujet, $corps)) {
			$_SESSION["MAIL_OK"] = true;
			unset($_POST);
		} else {
			echo ("le mail d'inscription n'a pas été envoyé pour d'obscures raisons...<br/>Mais ne vous découragez pas!");
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
		echo("L'inscription a bien été envoyée...");
		echo("</div><br/>");
	}
}
?>

<form action="<?php echo($_SERVER['PHP_SELF'])?>" method="POST">
<div>
	<table style="border: 0px;">
		<tr>
			<td>Nom</td>
			<td><input type="text" name="nom" value="<?php echo (isset($_POST['nom'])) ? $nom : '' ?>"/></td>
		</tr>
		<tr>
			<td>Prénom</td>
			<td><input type="text" name="prenom" value="<?php echo (isset($_POST['prenom'])) ? $prenom : '' ?>"/></td>
		</tr>
		<tr>
			<td>Email</td>
			<td><input type="email" name="mel" value="<?php echo (isset($_POST['mel'])) ? $adrMail : '' ?>"/></td>
		</tr>
		<tr>
			<td>Question / infos complémentaires</td>
			<td><textarea rows="5" cols="50" name="complInfo" ><?php echo (isset($_POST['complInfo'])) ? $complInfo : '' ?></textarea></td>
		</tr>
	</table>
	
	<input type="submit" value="Envoyer l'inscription">
</div>
</form>
<?php 
unset($_SESSION["MAIL_OK"]); 
?>
