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
setPageActuelle('articles');

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<?php
	include('./include/_meta.php');
	?>

	<title>Assembl&eacute;e &eacute;vang&eacute;lique du Neudorf</title>

	<link rel="stylesheet" href="<?php echo(getAliasURI()) ?>/css/commun2.css">

</head>
<body>

	<?php
	include('./include/_entete.php');
	?>

	<div class="cadrePrincipal">
		<br/>
<!--		<div class="titrePage">-->
<!--			Articles &agrave; votre disposition-->
<!--		</div>-->
<!--		<br/>-->

		<div class="titreSectionArticle">
			D&eacute;couverte de la Bible
		</div>
		<div class="resumeSectionArticle">
			<a class="lienArticle" href="PDF/articles/la_bible.pdf" target="_blank">
			La Bible n'est pas un livre, mais un recueil de 66 livres écrits par environ 40 auteurs sur environ 1500 ans ...
			<br/>
			La Bible n'est pas un livre comme les autres. Elle est plus qu'un livre de sagesse, de morale ou d'histoire. Elle est comme elle le dit tant de fois la Parole de Dieu ...
			<br/>
			Que faut-il entendre par inspiration ?
			</a>
			
			<br/>&nbsp;
			<hr/>
		</div>
		

		<div class="titreSectionArticle">
			Qui est Dieu ?
		</div>
		<div class="resumeSectionArticle">
			<a class="lienArticle" href="PDF/articles/Dieu.pdf" target="_blank">
			Comment t'appelles-tu ? Dieu lui réponds : "je suis celui qui suis" ...
			<br/>
			Yahvé ... je suis la vie même, l'éternel présent, celui qui sera ce qu'il est et a toujours été, celui qui existe par lui-même et par qui tout existe ...
			<br/>
			Les noms de Dieu dans l'ancien testament sont nombreux : chacun d'eux nous révèle un trait de caractère de celui qui peut satisfaire tous les besoins de l'homme ...
			</a>
			<br/>&nbsp;
			<hr/>
		</div>
		
	

		<div class="titreSectionArticle">
			J&eacute;sus-Christ
		</div>
		<div class="resumeSectionArticle">
			<a class="lienArticle" href="PDF/articles/Jesus-Christ.pdf" target="_blank">
			Jésus est son nom d'homme ... Christ est son titre, qui vient du grec Christos traduction de l'hébreu "messie" qui signifie "oint".
			<br/>
			Jésus était un nom certainement courant, c'est pour cela que la bible parle de Jésus-Christ sous entendu Jésus le Christ (le messie, l'oint de Dieu).
			<br/>
			Emmanuel ... "Dieu avec nous". Dieu pour nous sauver est venu vers nous ...
			</a>
			<br/>&nbsp;
			<hr/>
		</div>

		<div class="titreSectionArticle">
			L'homme
		</div>
		<div class="resumeSectionArticle">
			<a class="lienArticle" href="PDF/articles/l_homme.pdf" target="_blank">
			L'homme est le produit d'un acte spécial de la volonté divine : "L'Eternel Dieu forma l'homme de la poussière de la terre, il souffla dans ses narines un souffle de vie et l'homme devint une âme vivante." Genèse 2:7 ...
			<br/>
			"Dieu créa l'homme à son image, il le créa à l'image de Dieu, il créa l'homme et la femme." Genèse 1:27 ... Ce que Dieu dit ici il ne le dit d'aucune autre créature ...
			</a>
			<br/>&nbsp;
			<hr/>
		</div>

		<div class="titreSectionArticle">
			Le p&eacute;ch&eacute;
		</div>
		<div class="resumeSectionArticle">
			<a class="lienArticle" href="PDF/articles/le_peche.pdf" target="_blank">
			Dans la Bible le mot péché signifie manquer le but. C'est ce qui, dans la disposition, les desseins et le comportement des créatures de Dieu est contraire à la volonté révélée de Dieu ...
			<br/>
			Manquer sur un point, c'est être coupable envers toute la loi : Jacques 2:10 'Car quiconque observe toute la loi, mais pèche contre un seul commandement, devient coupable de tous" ...
			</a>
			<br/>&nbsp;
			<hr/>
		</div>

		<div class="titreSectionArticle">
			La repentance
		</div>
		<div class="resumeSectionArticle">
			<a class="lienArticle" href="PDF/articles/la_repentance.pdf" target="_blank">
			Quand un homme passe par la repentance il est prêt à ce que l'oeuvre de Dieu se fasse dans son coeur.
			<br/>
			Jacques 5:16  "Confessez donc vos péchés les uns aux autres, et priez les uns pour les autres, afin que vous soyez guéris. La prière agissante du juste a une grande efficacité."
			<br/>
			Proverbes 28:13 "Celui qui cache ses transgressions ne prospère point, Mais celui qui les avoue et les délaisse obtient miséricorde" ...
			</a>
			
			<br/>&nbsp;
			<hr/>
		</div>

		<div class="titreSectionArticle">
			Le salut
		</div>
		<div class="resumeSectionArticle">
			<a class="lienArticle" href="PDF/articles/le_salut.pdf" target="_blank">
			Le dictionnaire 'le petit robert' définit ainsi le mot salut: "Le fait d'échapper à la mort, au danger, de garder ou de retrouver un état heureux, prospère".
			<br/>
			Dans la bible le mot s'applique surtout au processus par lequel Dieu nous délivre de la condamnation pour nous accorder la vie éternelle ...
			<br/>
			Tous les hommes pourraient être sauvés, mais seuls ceux qui auront cru qui seront effectivement sauvés ...
			</a>
			
			<br/>&nbsp;
			<hr/>
		</div>
		
		<br/>
		<br/>
		
	</div>
	
	<?php
	include('./include/_piedPage.php');
	?>
	
</body>
</html>