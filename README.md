# Wordpress + P5.js 

## Un thème sobre 🙏🏽

**L'idée**: créer un thème Wordpress assez vide et pourvoir modéliser et afficher les articles ou les pages via [p5.js](https://p5js.org/reference/). L'ensemble de l'espace du site est un canevas animé et interactif. À chaque page, à chaque article, nous pouvons attribuer des caractéristques graphiques spécifiques selon leur catégorie ou leurs étiquettes.

**Pourquoi ?** Pour pouvoir créer un site ou un blog en considérant les articles ou les pages non pas comme une suite de liens ou d'images pointant vers des articles ou des pages (comme un blog classique); mais en les considérant comme des objets graphiques, pouvant être assujettis à du mouvement, générés aléatoirement, soumis à des interactions avec la souris, etc. Bref profiter des fonctionnalité de p5.js avec la structure dynamique php de Wordpress. Ainsi, avec wp ft. p5, il faut considérer le blog ou le site comme un canevas interactif où pages et articles sont, en quelque sorte, les *protagonistes* du paysage.

Ce petit thème n'est cependant pas une boite d'effets prêt à l'emploi. Chaque effet voulu doit être codé. Par exemple, si l'on veut qu'une page ou un article avec l'étiquette «infini» par exemple, ait la forme un cercle qui suit le mouvement d'un leminscate (∞) autour de la souris, il faudra, quelque part dans le code, ajouter quelque chose comme:

```
if(tag[i] == "infini"){
        X = sin(frameCount/10) * 10 + mouseX;
        Y = sin(frameCount/10) * cos(frameCount/10) * 100 + mouseY;
      }
```

### Exemples:

- [Thème par défaut](http://planplan.xyz/wordpress_ft_p5)
- [Indisciplinarité](http://code.feralj.fr)
- [Webdocu](http://planplan.xyz/wordpress_ft_p5)

## Structure générale du thème 👩‍👩‍👦

Ce thème est basé sur le thème Supersobre, lui même grandement inspiré du thème vierge «bbxdesert». 

Il y a donc le strict minimum par défaut. Même si l'idée ici est de profiter du canvas de p5.js sur toute l'étendue de la page, on pourra réinsérer les balises traditionnelles de wordpress. Je classe ici celles que je juge importantes, relatives au thème. Sinon voir les fonctions de WP [ici](https://codex.wordpress.org/Function_Reference). On pourra, en modifiant quelques lignes de code, réduire l'espace du canevas. Voici comment s'organise les fichiers entre eux.

### HTML/PHP:
#### Pages importantes
**index.php** -- C'est la page d'accueil. Il y a des includes wordpress et des includes php classiques.

**paysage.php** -- Les classes qui récupère les informations relatives aux articles pour le programme p5.js.

**sketch.php** -- C'est le fichier où l'on éditera du code p5.js, entre les balises script. Il y a des classes déjà codées, certaines méthodes pourront être utiles, notamment dans la récupération des articles et de ses informations dans l'espace du canevas. Pour en savoir plus, lisez le détail des classes, dans le chapitre "paysage p5.js".

**single.php** -- Une fois que l'on clique sur un élément de la page, on est envoyé sur le contenu de l'article (en tout cas par défaut). À voir si vous gardez une structure plus modeste pour afficher le contenu ou bien si vous utilisez encore un canevas.

**header.php** -- Ici, toutes les infos HTML nécessaires, les librairies par CDN (dont p5.js), le CSS, etc…

**loop.php** -- La boucle ou l'on affiche tous les messages du blog. Les informations relatives à un article sont contenu dans les attributs *data-*. Elles seront récupérées via JS (paysage.php).

#### Balises WP importantes

- RSS

`<a href="<?php bloginfo('rss2_url'); ?>">S'abonner au flux RSS</a>`

- Afficher extraits articles

`<?php the_excerpt(); ?>`

- Afficher pages (classe relative: "pages")

` <?php wp_list_pages(); ?>`

- Afficher contenu pages (dans index.php)

```php
<?php
	$nombrePages = wp_count_posts('page')->publish;
	$pages = get_pages();
	foreach($pages as $page) :
			//get_the_title($page);
			echo "<div class=\"papage\">";
			echo "<a href=\"". get_page_link($id) . "\">". get_the_title($page) . "</a>";
			setup_postdata($page);
			echo  the_content() . "<div class=\"detruit\"><a href=\"#\">X</a></div></div>";
	endforeach;
?>
```

- Une page comme accueil

`<?php query_posts('pagename=home'); ?>`

- Afficher contenu article entièrement

`<?php the_content(); ?>`

- Afficher tags

```php
<?php $posttags = get_the_tags();
		if ($posttags) {
			foreach($posttags as $tag) {
				echo $tag->name . '*';
			}
		}?>
```

- Afficher Catégorie, date, auteurs

```php
<p class="article_info">
          Publié le <?php the_date(); ?>
          dans <?php the_category(', '); ?>
          par <?php the_author(); ?>.
   </p>
```

- Afficher image de présentation (thumbnail)


```php
<?php
	$imageData = wp_get_attachment_image_src(get_post_thumbnail_id ( $post_ID ), 'medium'); ?>
	<img class="minitature" src="<?php echo $imageData[0]; ?>"/>
```

### CSS:

😡 😡 😡 !!! ATTENTION !!! 😡😡😡

Par défaut tous les articles ne sont pas affichés ! Ils sont cachés par le css: `article{display: none;}`.
On pourra les réafficher via des interactions JS avec *objet*.style.display = "block". La gestion des articles est détaillée plus bas.  Ou bien sur en modifiant le css directement selon la volonté qui animera le manipulateur.

**Identifiants**

- grand_espace (le premier enfant du body qui contient tout le blog)
- main (contient les articles)
- defaultCanvas0 (id du canevas p5)
- `<?php the_ID(); ?>` (renvoie l'id de l'article)
- `content_<?php the_ID(); ?>` (id du contenu de l'article ex: content_42)

**Classes**

1. pages
2. navigation

**Classes dans index.php (accueil):**

- article_titre
- article_info
- article_extrait
- article_contenu

- papage (classe d'une page affichée avec son contenu)

**Classes dans article seul (dans single.php)**

- article\_titre_seul
- article\_info\_seul
- article\_extrait\_seul
- article\_contenu\_seul

!!! ATTENTION !!! Les articles, une fois affichés seuls, ne sont pas cntenus dans des balises articles, mais des div. Ce n'est pas très important, puisque les id et les classes restent les mêmes. Voir dans single.php.

## "Paysage" P5.js

Voilà le cœur du thème. Détails.

### paysage.php

Dans ce fichier il y a la classe Article qui récupère les informations des différents articles. Un objet js étant un article, il y a donc une liste d'objets/articles:

`var art = []`

On récupère sur l'accueil, tous les articles de la page ainsi que leur nombre:

```javascript
var articlesDOM = document.getElementsByTagName('article');
var nombreArticles = articlesDOM.length;
```

La fonction initArt() récupère et inscript dans chacun des objets les informations des articles, placés dans les attributs html *data—* (dans le fichier loop.php)

```javascript
for (var i = 0; i < nombreArticles; i++) {
    var dataTitre = articlesDOM[i].getAttribute("data-titre");
    var dataURL = articlesDOM[i].getAttribute("data-url");
    var dataCategorie = articlesDOM[i].getAttribute("data-categorie");
    var dataTags = articlesDOM[i].getAttribute("data-tags");
    art.push(new Article(articlesDOM[i].id, dataTitre, dataURL, dataCategorie, dataTags, i));
  }
```

Ensuite dans l'objet Article, on place les infos dans des variables globales en sein de l'objet. Rien de notable sauf peut-être pour le traitement des "tags" (ou "étiquettes") wordpress qui sont sous forme de tableau:

```javascript
var tag = splitTokens(tags, "*");
var cardinalTag = tag.length;
```

Pour créer des effets particuliers, il faudra donc créer des méthodes au sein de ce fichier. Un exemple, qui affiche les titre lors du survol des articles modélisés par des cercles. De plus, les articles ont un comportement différent selon les tags qui leur sont assignés :

```javascript
function Article(identifiant, titre, lien, categorie, tags, ordreBoucle){
…
…
…
this.ordreBoucle = ordreBoucle;
this.tags = tags;

var tag = splitTokens(tags, "*");
var cardinalTag = tag.length;

this.dessinerAfficher = function(){

	//SURVOL
    var lArticle = document.getElementById(identifiant);
    var X = ordreBoucle * 40;
    var Y = 100;
    var D = 40;

    if(mouseX >= X - D/2 && mouseX <= X + D/2){
      lArticle.style.display = "block";
      fill(couleur, 0, couleur);

      if(mouseIsPressed){
			window.location = lien;
      }
    } else {
      fill(couleur);
      lArticle.style.display = "none";
    }

    //TAGS
    //Une boucle pour parcourir l'ensemble des tags de l'article
    for(var i = 0; i < cardinalTag; i++){
      if(tag[i] == "froid"){
        X += random(-1, 1);
        Y += random(-1, 1);
        fill(0, 255, 255);
      }
      if(tag[i] == "chaud"){
        fill(255, 0, 0);
        D = cos(frameCount/10) * 100;
      }
      if(tag[i] == "lemniscate"){
        X = sin(frameCount/10) * 10 + mouseX;
		Y = sin(frameCount/10) * cos(frameCount/10) * 100 + mouseY;
      }
    }
    ellipse(X, Y, D, D);
  };
```

### sketch.js

On pourra à la mode de processing, utiliser les fonctions classiques, setup et draw. Cependant, il faudra pour rendre effectif les classes d'articles, utiliser la fonction initArt() dans le setup:

```javascript
function setup(){
  createCanvas(windowWidth, windowHeight);
  initArt();
}

function draw(){
  background(255);
  ellipse(mouseX, mouseY, 30, 30);
  for(var i = 0; i < nombreArticles; i++){
     art[i].dessinerAfficher();
  }
}
```

Et bien entenu afficher tous les objets-articles dans un boucle, comme présenté au dessus.

## Plug-In p5.js

À essayer, le plug-in qui permet de faire des sketchs p5 pour chaque article.

## La même chose avec les pages

- La classe page est similaire…
