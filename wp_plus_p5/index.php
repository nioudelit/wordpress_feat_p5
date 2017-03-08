<?php get_header(); ?>
<section class="main">
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
