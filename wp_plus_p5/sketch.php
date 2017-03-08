<script>

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

</script>
