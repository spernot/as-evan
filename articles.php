<?php

/**
 *
 *
 * @version $Id$
 * @copyright 2011
 */

require_once('./archi/ContexteUtilisateur.php');

verificationSessionUtilisateur();

// Je pr�cise sur quelle page je suis
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
			La Bible n'est pas un livre, mais un recueil de 66 livres �crits par environ 40 auteurs sur environ 1500 ans ...
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
			Comment t'appelles-tu ? Dieu lui r�ponds : "je suis celui qui suis" ...
			<br/>
			Yahv� ... je suis la vie m�me, l'�ternel pr�sent, celui qui sera ce qu'il est et a toujours �t�, celui qui existe par lui-m�me et par qui tout existe ...
			<br/>
			Les noms de Dieu dans l'ancien testament sont nombreux : chacun d'eux nous r�v�le un trait de caract�re de celui qui peut satisfaire tous les besoins de l'homme ...
			</a>
			<br/>&nbsp;
			<hr/>
		</div>
		
	

		<div class="titreSectionArticle">
			J&eacute;sus-Christ
		</div>
		<div class="resumeSectionArticle">
			<a class="lienArticle" href="PDF/articles/Jesus-Christ.pdf" target="_blank">
			J�sus est son nom d'homme ... Christ est son titre, qui vient du grec Christos traduction de l'h�breu "messie" qui signifie "oint".
			<br/>
			J�sus �tait un nom certainement courant, c'est pour cela que la bible parle de J�sus-Christ sous entendu J�sus le Christ (le messie, l'oint de Dieu).
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
			L'homme est le produit d'un acte sp�cial de la volont� divine : "L'Eternel Dieu forma l'homme de la poussi�re de la terre, il souffla dans ses narines un souffle de vie et l'homme devint une �me vivante." Gen�se 2:7 ...
			<br/>
			"Dieu cr�a l'homme � son image, il le cr�a � l'image de Dieu, il cr�a l'homme et la femme." Gen�se 1:27 ... Ce que Dieu dit ici il ne le dit d'aucune autre cr�ature ...
			</a>
			<br/>&nbsp;
			<hr/>
		</div>

		<div class="titreSectionArticle">
			Le p&eacute;ch&eacute;
		</div>
		<div class="resumeSectionArticle">
			<a class="lienArticle" href="PDF/articles/le_peche.pdf" target="_blank">
			Dans la Bible le mot p�ch� signifie manquer le but. C'est ce qui, dans la disposition, les desseins et le comportement des cr�atures de Dieu est contraire � la volont� r�v�l�e de Dieu ...
			<br/>
			Manquer sur un point, c'est �tre coupable envers toute la loi : Jacques 2:10 'Car quiconque observe toute la loi, mais p�che contre un seul commandement, devient coupable de tous" ...
			</a>
			<br/>&nbsp;
			<hr/>
		</div>

		<div class="titreSectionArticle">
			La repentance
		</div>
		<div class="resumeSectionArticle">
			<a class="lienArticle" href="PDF/articles/la_repentance.pdf" target="_blank">
			Quand un homme passe par la repentance il est pr�t � ce que l'oeuvre de Dieu se fasse dans son coeur.
			<br/>
			Jacques 5:16  "Confessez donc vos p�ch�s les uns aux autres, et priez les uns pour les autres, afin que vous soyez gu�ris. La pri�re agissante du juste a une grande efficacit�."
			<br/>
			Proverbes 28:13 "Celui qui cache ses transgressions ne prosp�re point, Mais celui qui les avoue et les d�laisse obtient mis�ricorde" ...
			</a>
			
			<br/>&nbsp;
			<hr/>
		</div>

		<div class="titreSectionArticle">
			Le salut
		</div>
		<div class="resumeSectionArticle">
			<a class="lienArticle" href="PDF/articles/le_salut.pdf" target="_blank">
			Le dictionnaire 'le petit robert' d�finit ainsi le mot salut: "Le fait d'�chapper � la mort, au danger, de garder ou de retrouver un �tat heureux, prosp�re".
			<br/>
			Dans la bible le mot s'applique surtout au processus par lequel Dieu nous d�livre de la condamnation pour nous accorder la vie �ternelle ...
			<br/>
			Tous les hommes pourraient �tre sauv�s, mais seuls ceux qui auront cru qui seront effectivement sauv�s ...
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