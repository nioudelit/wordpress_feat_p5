let pages = [];
let toutesLesPages = document.querySelectorAll(".papage");
const nombrePages = toutesLesPages.length;


function getPages(){
    for (let i = 0; i < nombrePages; i++) {
      pages.push(new Page(i));
    }
}

class Page{
    constructor(ordreBoucle){
      this.ordreBoucle = ordreBoucle;
    }
    
    dessiner() {
      let coco = toutesLesPages[this.ordreBoucle];
      let mama = document.getElementById("main");
  
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
    }
  }
  
