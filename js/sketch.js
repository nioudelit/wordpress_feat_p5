

function setup(){
  createCanvas(windowWidth, windowHeight);
  initArt();
  for(var i = 0; i < nombrePages; i++){
      pages[i].dessiner();
  }
}

function draw(){
  background(cos(frameCount/100) * 255, sin(frameCount/100) * 255, cos(sin(frameCount/100)) * 255);
  ellipse(mouseX, mouseY, cos(frameCount/200) * 50, cos(frameCount/200) * 50);
  for(var i = 0; i < nombreArticles; i++){
     art[i].dessinerAfficher();
  }
}
