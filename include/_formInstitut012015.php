<br/>

<?php

// Gestion de l'envoi du mail
if (isset($_POST['nom'])) {
	
	// on chope les champs saisi
	$nom = trim($_POST['nom']);
	$prenom = trim($_POST['prenom']);
	
	$age = trim($_POST['age']);
	$adresse = trim($_POST['adresse']);
	$codePostal = trim($_POST['codePostal']);
	$ville = trim($_POST['ville']);
	$telephone = trim($_POST['telephone']);
	$adrMail = trim($_POST['mel']);
	
	$membreEglise = trim($_POST['membreEglise']);
	$nomResponsable = trim($_POST['nomResponsable']);
	$telResponsable = trim($_POST['telResponsable']);
	
	$complInfo = trim($_POST['complInfo']);


	// Je fais différentes vérifs
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
		$msgErreur .= "- Téléphone<br/>";
		$erreur = true;
	}
	
	if (strlen($adrMail) == 0) {
		$msgErreur .= "- Adresse mail<br/>";
		$erreur = true;
	}
	
// 	if (strlen($dhDepart) == 0 || strlen($dhArrivee) == 0) {
// 		$msgErreur .= "- Date et heure d'arrivée/départ<br/>";
// 		$erreur = true;
// 	}
	
	
	if (strlen($adrMail) > 0) {
		// Super expression régulière permettant de vérifier si le
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
		$sujet = "Inscription à la formation Esdras 7:10";
		$destinataire = "tjupiter@gmail.com";
// 		$destinataire = "sebastien67.pernot@yahoo.fr";
		$corps = "Inscription de: \n" . $nom . " " . $prenom . " (" . $adrMail
				. ")\n" . "Age : " . $age . "\n"
				. "téléphone : " . $telephone . "\n";
		
	
		if (strlen($complInfo) > 0)
			$corps .= "\nComplément d'information : " . $complInfo . "\n";
	
		// Envoi du mail
		if (mail($destinataire, $sujet, $corps)) {
			$_SESSION["MAIL_OK"] = true;
			unset($_POST);
			
			// Ensuisse, enregistrement des données dans un fichier qui va bien
			try{
				$fp = fopen ("institut012015.csv", "a");
				
				// Construction de la chaine de données à enregistrer
				$enreg = "\"".$nom."\";"
					."\"".$prenom."\";"
					."\"".$adresse." ".$codePostal." ".$ville."\";"
					."\"".$age."\";"
					."\"".$telephone."\";"
					."\"".$adrMail."\";"
					."\"".$membreEglise."\";"
					."\"".$nomResponsable."\";"
					."\"".$telResponsable."\";"
					."\"".$complInfo."\";\n";
				
				fputs ($fp, $enreg);
				fclose ($fp);
			} catch (Exception $e) {
				// Rien
			}
			
		} else {
			// Erreur lors de l'envoi du mail. On en informe l'utilisateur fatalement paniqué...
			$_SESSION["MAIL_OK"] = false;
			$_SESSION["MSG_ERREUR"] = "Le mail d'inscription n'a pas été envoyé pour d'obscures raisons...<br/>Mais ne vous découragez pas!";
		}
	}	
}
?>

<?php

// Gestion des retours de vérification
 
if (isset($_SESSION["MAIL_OK"])) {
	
	echo("<a name=\"msg\"></a>");
	
	if ($_SESSION["MAIL_OK"] == false) {
		// Erreur lors de la saisie du formulaire
		echo("<br/><br/>");
		echo("<div class=\"erreur\">");
		echo($_SESSION["MSG_ERREUR"]);
		echo("</div><br/>");
	}
	else {
		// OK. Mail envoyé
		echo("<div class=\"traitementOK\">");
		echo("L'inscription a bien été envoyée. Vous serez contacté(e) d'ici peu.");
		echo("</div><br/>");
	}
}
?>

<form action="<?php echo($_SERVER['PHP_SELF'])?>#msg" method="POST">
<div>
	Formulaire d'inscription à la formation Esdras 7:10
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
			<td>Age</td>
			<td><input type="number" name="age" value="<?php echo (isset($_POST['age'])) ? $age : '' ?>"/></td>
		</tr>
		<tr>
			<td>Adresse</td>
			<td><input type="text" name="adresse" value="<?php echo (isset($_POST['adresse'])) ? $adresse : '' ?>"/></td>
		</tr>
		<tr>
			<td>Code postal / ville</td>
			<td>
				<input type="text" name="codePostal" value="<?php echo (isset($_POST['codePostal'])) ? $codePostal : '' ?>"/>
				/<input type="text" name="ville" value="<?php echo (isset($_POST['ville'])) ? $ville : '' ?>"/>
			</td>
		</tr>
		<tr>
			<td>Téléphone</td>
			<td><input type="text" name="telephone" value="<?php echo (isset($_POST['telephone'])) ? $telephone : '' ?>"/></td>
		</tr>
		<tr>
			<td>Email</td>
			<td><input type="email" name="mel" value="<?php echo (isset($_POST['mel'])) ? $adrMail : '' ?>"/></td>
		</tr>
		
		<tr>
			<td>Membre de l'église de:</td>
			<td><input type="text" name="membreEglise" value="<?php echo (isset($_POST['membreEglise'])) ? $membreEglise : '' ?>"/></td>
		</tr>
		<tr>
			<td>Nom et téléphone d'un responsable de l'église:</td>
			<td>
				<input type="text" name="nomResponsable" value="<?php echo (isset($_POST['nomResponsable'])) ? $nomResponsable : '' ?>"/>
				-<input type="text" name="telResponsable" value="<?php echo (isset($_POST['telResponsable'])) ? $telResponsable : '' ?>"/>
			</td>
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
