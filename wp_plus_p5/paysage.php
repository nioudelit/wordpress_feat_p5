<script>
//ARTICLES
var art = [];
var articlesDOM = document.getElementsByTagName('article');
var nombreArticles = articlesDOM.length;

//PAGES
var pages = [];
var toutesLesPages = document.querySelectorAll(".papage");
var nombrePages = toutesLesPages.length;

function initArt(){
  //ARTICLES
  for (var i = 0; i < nombreArticles; i++) {
    var dataTitre = articlesDOM[i].getAttribute("data-titre");
    var dataURL = articlesDOM[i].getAttribute("data-url");
    var dataCategorie = articlesDOM[i].getAttribute("data-categorie");
    var dataTags = articlesDOM[i].getAttribute("data-tags");
    art.push(new Article(articlesDOM[i].id, dataTitre, dataURL, dataCategorie, dataTags, i));
  }

  //PAGES
  for (var i = 0; i < nombrePages; i++) {
    pages.push(new Page(i));
  }
}

function Article(identifiant, titre, lien, categorie, tags, ordreBoucle) {
  /*RECUPERE INFOS ARTICLES*/
  this.identifiant = identifiant
  this.titre = titre;
  this.lien = lien;
  this.categorie = categorie;
  this.ordreBoucle = ordreBoucle;
  this.tags = tags;

  var tag = splitTokens(tags, "*");
  var cardinalTag = tag.length;
  /*FIN RECUPERATION INFOS ARTICLE*/

  //TEST
  var couleur = ordreBoucle / nombreArticles * 255;

  this.obtenirTitre = function() {
    console.log(titre);
  };

  this.obtenirCategorie = function() {
    console.log(categorie);
  };

  this.clicLien = function() {
  };

  this.dessinerAfficher = function(){
    var coco = document.getElementById(identifiant);
    var X = ordreBoucle * 40;
    var Y = 100;
    var D = 40;
    if(mouseX >= X - D/2 && mouseX <= X + D/2){
      coco.style.display = "block"; //AFFICHE VIA CSS+JS
      fill(couleur, 0, couleur);
      if(mouseIsPressed){
	       window.location = lien;
      }
    } else {
      fill(couleur);
      coco.style.display = "none";//AFFICHE VIA CSS+JS
    }

    //TAGS
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
}


function Page(ordreBoucle) {
  this.ordreBoucle = ordreBoucle;

  this.dessiner = function() {
    var coco = toutesLesPages[ordreBoucle];
    var mama = document.getElementById("main");

    mama.removeChild(coco);
    document.getElementById("main").appendChild(coco);
    coco.classList.add("papage");
    coco.style.position = "fixed";
    coco.style.left = /*coco.offsetLeft +*/ random(0, width) + "px";
    coco.style.top = /*coco.offsetTop +*/ random(0, height) + "px";
    coco.style.width = "100px";
    coco.style.height = "100px";
    coco.style.overflowY = "hidden";
    coco.style.background = "yellow";
  };
}
</script>
