<?php

require_once 'ClassUtil.php';

// Authentification
$valid_passwords = array ("Thierry" => "Jupiter");
$valid_users = array_keys ( $valid_passwords );

// Nécessaire sur le serveur d'appli
if (isset ( $_SERVER ['REMOTE_USER'] )) {
	list ( $_SERVER ['PHP_AUTH_USER'], $_SERVER ['PHP_AUTH_PW'] ) = explode ( ':', base64_decode ( substr ( $_SERVER ['REMOTE_USER'], 6 ) ) );
}

$user = $_SERVER ['PHP_AUTH_USER'];
$pass = $_SERVER ['PHP_AUTH_PW'];

$validated = (in_array ( $user, $valid_users )) && ($pass == $valid_passwords [$user]);

if (! $validated) {
	header ( 'WWW-Authenticate: Basic realm="My Realm"' );
	header ( 'HTTP/1.0 401 Unauthorized' );
	
	die ( "Not authorized" );
}



// Ensuisse, on commence à jouer

// Parcours des repertoires
$listeRep = getRepertoires();

// Récupération des params postés
$orateur = null;
if (isset($_POST) && isset($_POST['Orateur'])) {
	$orateur = trim($_POST['Orateur']);
}

// upload proprement dit
$urlFichierUpload = null;
if (isset($_FILES) && isset($_FILES['fichier'])) {
	// gestion des erreurs de transfert
	if ($_FILES['fichier']['error'] > 0)
		die ("Erreur lors du transfert...");

	$nom = '/'.$orateur.'/'.$_FILES['fichier']['name'];
	$resultat = move_uploaded_file($_FILES['fichier']['tmp_name'],'.'.$nom);
	if ($resultat) {
		echo "Transfert réussi! Youhouuu";

		$urlFichierUpload = getVraieUrl($_SERVER, $nom);
	}
}

?>


<html>
<head>
<!-- L'ajax, c'est bien -->
<script type="text/javascript" src="ajax.js"></script>

</head>

<body style="font-family: Calibri, sans-serif;">
	<div
		style="width: 600px; margin: auto; border: 1px solid gray; padding: 5px;">
		<br /> <label style="font-weight: bold;">Gestion de contenu pour la
			formation Esdras 7:10</label> <br /> <br />
		<form method="post" action="gestionContenus.php"
			enctype="multipart/form-data">

			<br /> <label for="fichier">Fichier à uploader :</label> <input
				type="file" name="fichier" id="fichier" size="50" /> <br /> <label
				for="titre">Concernant l'orateur :</label> <select id="Orateur"
				name="Orateur">
		     	<?php foreach ($listeRep as $rep) { ?>
		     	<option value="<?php echo $rep ?>"><?php echo $rep ?></option>
		     	<?php } ?>
		     </select> <br /> <br /> <input type="submit" name="submit"
				value="Envoyer le fichier" /> <br /> <br />
		     <?php if (isset($urlFichierUpload)) { ?>
		     <label for="urlFichier">URL du document uploadé :</label> <input
				type="text" size="80" value="<?php echo $urlFichierUpload ?>" />
		     <?php } ?>
		     <br /> <br />

		</form>
	</div>

</body>


</html>
