<?php

	ini_set('upload_max_filesize', '100M');
	ini_set('post_max_size', '100M');
	ini_set('max_execution_time', 0);

	// Authentification
	$valid_passwords = array ("Thierry" => "Brunck");
	$valid_users = array_keys($valid_passwords);

	// Nécessaire sur le serveur d'appli
	if (isset($_SERVER['REMOTE_USER'])) {
		list($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']) = explode(':', base64_decode(substr($_SERVER['REMOTE_USER'], 6)));
	}	
	
	$user = $_SERVER['PHP_AUTH_USER'];
	$pass = $_SERVER['PHP_AUTH_PW'];

	$validated = (in_array($user, $valid_users)) && ($pass == $valid_passwords[$user]);

	if (!$validated) {
  		header('WWW-Authenticate: Basic realm="My Realm"');
  		header('HTTP/1.0 401 Unauthorized');
  		
  		die ("Not authorized");
	}
	
	// upload proprement dit 
	
	if (isset($_FILES) && isset($_FILES['fichier'])) {
		// gestion des erreurs de transfert
		if ($_FILES['fichier']['error'] > 0) 
			die ("Erreur lors du transfert...");
		
		
		$extensions_valides = array( 'ogg' , 'mp3' , 'wav' );
		$extension_upload = strtolower(  substr(  strrchr($_FILES['fichier']['name'], '.')  ,1)  );
		if (! in_array($extension_upload,$extensions_valides) ) 
			die ("Extension ".$extension_upload." non prise en charge");
		
		$nom = "./download_".$_FILES['fichier']['name'];
		$resultat = move_uploaded_file($_FILES['fichier']['tmp_name'],$nom);
		if ($resultat) { 
			echo "Transfert réussi! Youhouuu";
			
			// création d'un fragment de fichier
			$monfichier = fopen("./download_".$_FILES['fichier']['name'].".ini", 'a+');
			
			fputs($monfichier,"[Fichier]\n");
			fputs($monfichier,"URI = /sonVideo/_A_REMPLACER_/".$_FILES['fichier']['name']."\n");
			fputs($monfichier,"nomFichier = ".$_FILES['fichier']['name']."\n");
			fputs($monfichier,"libelle = ".$_POST['titre']."\n");
			fputs($monfichier,"[/Fichier]\n");
			
			// on ferme le fichier
			fclose($monfichier);
			
		}
	}
?>



<html>


<body style="font-family: Calibri, sans-serif;">
	<div style="width: 600px; height: 200px; margin: auto; border: 1px solid gray; padding: 5px;">
		<br/>
		<label style="font-weight: bold;">Upload cool de fichier</label>
		<br/>
		<br/>
		<form method="post" action="uploadFichier.php" enctype="multipart/form-data">
		     <label for="titre">titre du fichier :</label>
		     <input type="text" name="titre" value="Titre..." id="titre" size="50" />
		     <br/>
		     <label for="fichier">Fichier :</label>
		     <input type="file" name="fichier" id="fichier" size="50" />
		     <br />
		     <br />
		     <input type="submit" name="submit" value="Envoyer le fichier" />
		</form>
<!-- 		</div> -->
	</div>
	
</body>


</html>