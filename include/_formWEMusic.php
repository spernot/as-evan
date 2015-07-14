<br/>

<?php

// Gestion de l'envoi du mail
if (isset($_POST['hebergement'])) {
	
	// on chope les champs saisi
	$nom = trim($_POST['nom']);
	$prenom = trim($_POST['prenom']);
	$adresse = trim($_POST['adresse']);
	$dtNaissance = trim($_POST['dtNaissance']);
	$telephone = trim($_POST['numTel']);
	$adrMail = trim($_POST['mel']);
	$hebergement = $_POST['hebergement'];
	$voix = $_POST['voix'];
	$instrument = trim($_POST['instrument']);
	$nomEglise = trim($_POST['nomEglise']);

	// Je fais différentes vérifs
	$erreur = false;
	$msgErreur = "Les champs suivants sont obligatoires: <br/>";
	if (strlen($nom) == 0 || strlen($prenom) == 0) {
		$msgErreur .= "- Nom et prenom<br/>";
		$erreur = true;
	}

	if (strlen($adresse) == 0 && strlen($adrMail) == 0) {
		$msgErreur .= "- l'adresse ou le mail<br/>";
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
		$sujet = "Inscription au WE musique";
		$destinataire = "helene.hirschler@gmail.com";
// 		$destinataire = "sebastien67.pernot@yahoo.fr";
		$corps = "Inscription de: \n" . $nom . " " . $prenom . " (" . $adrMail
				. ")\n" . $adresse . "\n" . "né(e) le " . $dtNaissance . "\n"
				. "téléphone: " . $telephone . "\n" . "voix: " . $voix . "\n";
		if ($hebergement == "Oui")
			$corps .= "\n Je souhaite être hébergé sur place. \n";
		else
			$corps .= "\n Je ne souhaite pas être hébergé. \n";
	
		if (strlen($instrument) > 0)
			$corps .= "\n Je joue des instruments suivants: " . $instrument . "\n";
	
		if (strlen($nomEglise) > 0)
			$corps .= "\n je fréquente l'église de " . $nomEglise;
	
		
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
			<td>Adresse</td>
			<td><textarea rows="3" cols="40" name="adresse" ><?php echo (isset($_POST['adresse'])) ? $adresse : '' ?></textarea></td>
		</tr>
		<tr>
			<td>Né(e) le</td>
			<td><input type="text" name="dtNaissance" value="<?php echo (isset($_POST['dtNaissance'])) ? $dtNaissance : '' ?>" /></td>
		</tr>
		<tr>
			<td>Téléphone</td>
			<td><input type="text" name="numTel" value="<?php echo (isset($_POST['numTel'])) ? $telephone : '' ?>"/></td>
		</tr>
		<tr>
			<td>Email</td>
			<td><input type="email" name="mel" value="<?php echo (isset($_POST['mel'])) ? $adrMail : '' ?>"/></td>
		</tr>
		<tr>
			<td>Je souhaite être hébergé(e)</td>
			<td><input type="radio" name="hebergement" value="Oui" checked="checked"/>Oui<br/>
				<input type="radio" name="hebergement" value="Non" <?php echo( isset($_POST['hebergement']) && $hebergement == "Non" ? 'checked="checked"' : '') ?> />Non</td>
		</tr>
		<tr>
			<td>Je chante</td>
			<td><input type="radio" name="voix" value="Soprano" checked="checked"/>Soprano<br/>
				<input type="radio" name="voix" value="Alto" <?php echo( isset($_POST['voix']) && $voix == "Alto" ? 'checked="checked"' : '') ?>/>Alto<br/>
				<input type="radio" name="voix" value="Tenor" <?php echo( isset($_POST['voix']) && $voix == "Tenor" ? 'checked="checked"' : '') ?>/>Tenor<br/>
				<input type="radio" name="voix" value="Basse" <?php echo( isset($_POST['voix']) && $voix == "Basse" ? 'checked="checked"' : '') ?>/>Basse<br/></td>
		</tr>
		<tr>
			<td>Je joue d'un instrument</td>
			<td><input type="text" name="instrument" value="<?php echo (isset($_POST['instrument'])) ? $instrument : '' ?>" /></td>
		</tr>
		<tr>
			<td>Je fréquente l'église de</td>
			<td><input type="text" name="nomEglise" value="<?php echo (isset($_POST['nomEglise'])) ? $nomEglise : '' ?>" /></td>
		</tr>
	</table>
	
	<input type="submit" value="Envoyer l'inscription">
</div>
</form>
<?php 
unset($_SESSION["MAIL_OK"]); 
?>
