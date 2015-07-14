<?php

/**
 *
 *
 * @version $Id$
 * @copyright 2011
 */

require_once('./archi/ContexteUtilisateur.php');

verificationSessionUtilisateur();

// Je précise sur quelle page je suis
setPageActuelle('liens');


?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<?php
	include('./include/_meta.php');
	?>

	<title>Assembl&eacute;e &eacute;vang&eacute;lique du Neudorf</title>

	<link rel="stylesheet" href="<?php echo(getAliasURI()) ?>/css/commun2.css?d=<?php echo date('dm'); ?>">

</head>
<body>

	<?php
	include('./include/_entete.php');
	?>

	<div class="cadrePrincipal">
		<br/>
		<div class="titreSectionLien">
			Sites généraux en rapport avec nos convictions
		</div>
		<div class="resumeSectionLien">
			<ul>
				<li>Connaître Dieu personnellement : <a class="lienPageLiens" href="http://www.connaitredieu.com/" target="_blank">[Lien...]</a></li>
				<li>Bibliquest : <a class="lienPageLiens" href="http://www.bibliquest.org/" target="_blank">[lien...]</a></li>
				<li>La Bible online : <a class="lienPageLiens" href="http://www.onlinebible.org/html/fre" target="_blank">[Lien...]</a></li>
				<li>Institut Biblique par internet : <a class="lienPageLiens" href="http://www.bibledoc.com/" target="_blank">[Lien...]</a></li>
				<li>Vigi-Sectes : <a class="lienPageLiens" href="http://www.vigi-sectes.org/" target="_blank">[Lien...]</a></li>
			</ul>
			<hr/>
		</div>
		
		<div class="titreSectionLien">
			Nous soutenons plusieurs œuvres et pasteurs en France
		</div>
		<div class="resumeSectionLien">
			<ul>
				<li>Alliance Baptiste de France : <a class="lienPageLiens" href="http://www.baptiste.info/" target="_blank">[Lien...]</a></li>
				<li>France Pour Christ : <a class="lienPageLiens" href="http://www.francepourchrist.fr/" target="_blank">[lien...]</a></li>
				<li>Eglise Baptiste du Centre-Paris : <a class="lienPageLiens" href="http://ebc.paris.free.fr" target="_blank">[Lien...]</a></li>
				<li>Eglise Baptiste Limoges : <a class="lienPageLiens" href="http://eglisebaptiste.lim.free.fr" target="_blank">[Lien...]</a></li>
				<li>Eglise Baptiste de Toulon Sainte Musse : <a class="lienPageLiens" href="http://www.eebtoulon.com/" target="_blank">[Lien...]</a></li>
				<li>Eglise Baptiste Toulouse : <a class="lienPageLiens" href="http://www.ebtm.fr/" target="_blank">[Lien...]</a></li>
			</ul>
			<hr/>
		</div>
		
		<div class="titreSectionLien">
			Oeuvres jeunesse
		</div>
		<div class="resumeSectionLien">
			<ul>
				<li>Camp Arc-En-Ciel : <a class="lienPageLiens" href="http://camp-arcenciel.fr/" target="_blank">[Lien...]</a></li>
				<li>Vilodec : <a class="lienPageLiens" href="http://www.vilodec.fr/" target="_blank">[lien...]</a></li>
				<li>Tremplin : <a class="lienPageLiens" href="http://vacances.letremplin.org/" target="_blank">[Lien...]</a></li>
				<li>Mathania : <a class="lienPageLiens" href="http://matthania.free.fr/" target="_blank">[Lien...]</a></li>
			</ul>
			<hr/>&nbsp;
		</div>

		
		<br/>
		<br/>
	</div>

	<?php
	include('./include/_piedPage.php');
	?>

</body>
</html>