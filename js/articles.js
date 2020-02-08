//ARTICLES
let articles = [];
let articlesDOM = document.getElementsByTagName('article');
const nombreArticles = articlesDOM.length;

function getArticles(){
    for (let i = 0; i < nombreArticles; i++) {
      let dataTitre = articlesDOM[i].getAttribute("data-titre");
      let  dataURL = articlesDOM[i].getAttribute("data-url");
      let dataCategorie = articlesDOM[i].getAttribute("data-categorie");
      let dataTags = articlesDOM[i].getAttribute("data-tags");
  
      articles.push(new Article(articlesDOM[i].id, dataTitre, dataURL, dataCategorie, dataTags, i));
    }
}

class Article{
    /*RECUPERE INFOS ARTICLES*/
      constructor(identifiant, titre, lien, categorie, tags, ordreBoucle){
        this.identifiant = identifiant
        this.titre = titre;
        this.lien = lien;
        this.categorie = categorie;
        this.ordreBoucle = ordreBoucle;
        this.tags = tags;
        //
        this.tag = splitTokens(tags, "*");
        this.cardinalTag = this.tag.length;
        this.couleur = ordreBoucle / nombreArticles * 255;
    }  
  
    obtenirTitre(){
      console.log(this.titre);
    }
  
    obtenirCategorie(){
      console.log(this.categorie);
    }
  
    clicLien() {
      console.log(this.lien);
    }
  
    dessiner(){
      let coco = document.getElementById(this.identifiant);
      let D = 40;
      let X = this.ordreBoucle * D;
      let Y = 100;
      
  
      if(mouseX >= X - D/2 && mouseX <= X + D/2){
        coco.style.display = "block"; //AFFICHE VIA CSS+JS
        fill(this.couleur, 0, this.couleur);
        if(mouseIsPressed){
             window.location = this.lien;
        }
      } else {
        fill(this.couleur);
        coco.style.display = "none";//AFFICHE VIA CSS+JS
      }
  
      //TAGS
      for(let i = 0; i < this.cardinalTag; i++){
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
    }
  }
