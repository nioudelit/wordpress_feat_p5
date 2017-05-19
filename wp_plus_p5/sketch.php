<script>

function setup(){
  createCanvas(windowWidth, windowHeight);
  initArt();
  for(var i = 0; i < nombrePages; i++){
      pages[i].dessiner();
  }
}

function draw(){
  background(cos(frameCount/100) * 255, sin(frameCount/100) * 255, cos(sin(frameCount/100)) * 255);
  ellipse(mouseX, mouseY, 30, 30);
  for(var i = 0; i < nombreArticles; i++){
     art[i].dessinerAfficher();
  }
}

</script>
