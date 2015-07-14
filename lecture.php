<?php

require_once 'archi/ContexteUtilisateur.php';

if (!isset($_GET['lienDownload']))
	return;

if (strlen(trim($_GET['lienDownload'])) == 0)
	return;

$idFichier = trim($_GET['lienDownload']);

// recherche du conteneur de conférence
session_start();
$contexteUtilisateur = getContexteUtilisateur();
$attributsFichier = $contexteUtilisateur->getAttributsFichier($idFichier);

$full_path = ".".$attributsFichier->getURI();
$file_name = basename($full_path);
 
$date = gmdate(DATE_RFC1123);
 
header('Pragma: public');
header('Cache-Control: must-revalidate, pre-check=0, post-check=0, max-age=0');
 
header('Content-Tranfer-Encoding: none');
header('Content-Length: '.filesize($full_path));
header('Content-Type: audio/x-mpeg, audio/x-mpeg-3, audio/mpeg3, audio/mpeg; name="'.$file_name.'"');
header('Content-Disposition: attachment; filename="'.$file_name.'"');
 
header('Date: '.$date);
header('Expires: '.gmdate(DATE_RFC1123, time()+1));
header('Last-Modified: '.gmdate(DATE_RFC1123, filemtime($full_path)));
ob_clean();
flush();
readfile($full_path);
exit; // nécessaire pour être certain de ne pas envoyer de fichier corrompu

?>