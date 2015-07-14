<br/>

<?php

// Gestion de l'envoi du mail
if (isset($_POST['nom'])) {
	
	// on chope les champs saisi
	$nom = trim($_POST['nom']);
	$prenom = trim($_POST['prenom']);
	$age = trim($_POST['age']);
	$adrMail = trim($_POST['mel']);
	$telephone = trim($_POST['telephone']);
	$dhArrivee = trim($_POST['dhArrivee']);
	$dhDepart = trim($_POST['dhDepart']);
	$locomotion = trim($_POST['locomotion']);
	$hebergement = trim($_POST['hebergement']);
	$moyenEvan = trim($_POST['moyenEvan']);
	$complInfo = trim($_POST['complInfo']);
	

	// Je fais diff�rentes v�rifs
	$erreur = false;
	$msgErreur = "Les champs suivants sont obligatoires: <br/>";
	if (strlen($nom) == 0 || strlen($prenom) == 0) {
		$msgErreur .= "- Nom et prenom<br/>";
		$erreur = true;
	}

	if (strlen(trim($age)) == 0) {
		$msgErreur .= "- Age<br/>";
		$erreur = true;
	}
	
	if (strlen($telephone) == 0) {
		$msgErreur .= "- T�l�phone<br/>";
		$erreur = true;
	}
	
	if (strlen($dhDepart) == 0 || strlen($dhArrivee) == 0) {
		$msgErreur .= "- Date et heure d'arriv�e/d�part<br/>";
		$erreur = true;
	}
	
	
	if (strlen($adrMail) > 0) {
		// Super expression r�guli�re permettant de v�rifier si le
		// format d'une adresse e-mail est correct
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
		$sujet = "Inscription � l'�vang�lisation";
		$destinataire = "damajup@gmail.com";
// 		$destinataire = "sebastien67.pernot@yahoo.fr";
		$corps = "Inscription de: \n" . $nom . " " . $prenom . " (" . $adrMail
				. ")\n" . $adresse . "\n" . "Age : " . $age . "\n"
				. "t�l�phone : " . $telephone . "\n"
				. "Date d'arriv�e : " . $dhArrivee . "\n"
				. "Date de d�part : " . $dhDepart . "\n"
				. "Moyen de locomotion : " . $locomotion . "\n"
				. "Besoin d'h�bergement : " . $hebergement;
		
		if (strlen($moyenEvan) > 0)
			$corps .= "\nMoyen d�vang�lisation pr�f�r� : " . $moyenEvan;
	
		if (strlen($complInfo) > 0)
			$corps .= "\nCompl�ment d'information : " . $complInfo . "\n";
	
		// Envoi du mail
		if (mail($destinataire, $sujet, $corps)) {
			$_SESSION["MAIL_OK"] = true;
			unset($_POST);
		} else {
			echo ("le mail d'inscription n'a pas �t� envoy� pour d'obscures raisons...<br/>Mais ne vous d�couragez pas!");
		}
	}	
}
?>

<?php

// Gestion des retours de v�rification
 
if (isset($_SESSION["MAIL_OK"])) {
	if ($_SESSION["MAIL_OK"] == false) {
		// Erreur lors de la saisie du formulaire
		echo("<div class=\"erreur\">");
		echo($_SESSION["MSG_ERREUR"]);
		echo("</div><br/>");
	}
	else {
		// OK. Mail envoy�
		echo("<div class=\"traitementOK\">");
		echo("L'inscription a bien �t� envoy�e. Vous serez contact�(e) d'ici peu.");
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
			<td>Pr�nom</td>
			<td><input type="text" name="prenom" value="<?php echo (isset($_POST['prenom'])) ? $prenom : '' ?>"/></td>
		</tr>
		<tr>
			<td>Age</td>
			<td><input type="text" name="age" value="<?php echo (isset($_POST['age'])) ? $age : '' ?>"/></td>
		</tr>
		<tr>
			<td>Email</td>
			<td><input type="email" name="mel" value="<?php echo (isset($_POST['mel'])) ? $adrMail : '' ?>"/></td>
		</tr>
		<tr>
			<td>T�l�phone</td>
			<td><input type="text" name="telephone" value="<?php echo (isset($_POST['telephone'])) ? $telephone : '' ?>"/></td>
		</tr>
		<tr>
			<td>Date et heure d'arriv�e / d�part</td>
			<td><input type="datetime" name="dhArrivee" value="<?php echo (isset($_POST['dhArrivee'])) ? $dhArrivee : '' ?>"/>&nbsp;
				<input type="date" name="dhDepart" value="<?php echo (isset($_POST['dhDepart'])) ? $dhDepart : '' ?>"/>
			</td>
		</tr>
		<tr>
			<td>Moyen de locomotion</td>
			<td><input type="radio" name="locomotion" value="Train" checked="checked"/>Train<br/>
				<input type="radio" name="locomotion" value="Avion" <?php echo( isset($_POST['locomotion']) && $locomotion == "Avion" ? 'checked="checked"' : '') ?>/>Avion<br/>
				<input type="radio" name="locomotion" value="Covoiturage" <?php echo( isset($_POST['locomotion']) && $locomotion == "Covoiturage" ? 'checked="checked"' : '') ?>/>Covoiturage<br/>
				<input type="radio" name="locomotion" value="VoiturePerso" <?php echo( isset($_POST['locomotion']) && $locomotion == "VoiturePerso" ? 'checked="checked"' : '') ?>/>Voiture personnelle<br/>
				<input type="radio" name="locomotion" value="Heliportage" <?php echo( isset($_POST['locomotion']) && $locomotion == "Heliportage" ? 'checked="checked"' : '') ?>/>H�liportage<br/>
			</td>
		</tr>
		<tr>
			<td>Besoin d'h�bergement</td>
			<td><input type="radio" name="hebergement" value="Non" checked="checked"/>Non<br/>
				<input type="radio" name="hebergement" value="Oui" <?php echo( isset($_POST['hebergement']) && $hebergement == "Oui" ? 'checked="checked"' : '') ?>/>Oui<br/>
			</td>
		</tr>
		<tr>
			<td>Moyen d'�vang�lisation pr�f�r�</td>
			<td><input type="text" name="moyenEvan" value="<?php echo (isset($_POST['moyenEvan'])) ? $moyenEvan : '' ?>" size="50"/></td>
		</tr>
		<tr>
			<td>Question / infos compl�mentaires</td>
			<td><textarea rows="5" cols="50" name="complInfo" ><?php echo (isset($_POST['complInfo'])) ? $complInfo : '' ?></textarea></td>
		</tr>
	</table>
	
	
	<input type="submit" value="Envoyer l'inscription">
</div>
</form>
<?php 
unset($_SESSION["MAIL_OK"]); 
?>
