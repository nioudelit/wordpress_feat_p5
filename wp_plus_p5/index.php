<?php get_header(); ?>
<section id="main">

  <!--//DEBUT AFFICHER CONTENU PAGE -->
  <?php
    $nombrePages = wp_count_posts('page')->publish;
    $pages = get_pages();
    foreach($pages as $page) :
        //get_the_title($page);
        echo "<div class=\"papage\">";
        echo "<a href=\"". get_page_link($id) . "\">". get_the_title($page) . "</a>";
        setup_postdata($page);
        echo  the_content() . "</div>";
    endforeach;
  ?>
  <!-- -FIN AFFICHER CONTENU PAGES- -->

  <?php get_template_part('loop'); ?>
  <?php previous_posts_link(); ?>
  <?php next_posts_link(); ?>
</section>

<?php
	  //SKETCH.

	  include("sketch.php");
		include("paysage.php");

?>

<?php get_footer(); ?>

<!-- JQUERY (Facultatif…)-->
<script>
$(function(){
   //alert('jQuery est prêt !');
  $(".papage").draggable();
});
</script>
