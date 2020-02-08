<!DOCTYPE html>
<html>
  <head <?php language_attributes(); ?>>
    <meta charset="<?php bloginfo('charset'); ?>">
    <title><?php bloginfo('name'); ?><?php wp_title(); ?></title>
    <!--<link href="https://fonts.googleapis.com/css?family=Monda" rel="stylesheet">-->
    <!-- CSS Style -->
    <?php
      wp_enqueue_style('reset', get_template_directory_uri() . '/css/reset.css', array(), NULL, NULL);
      wp_enqueue_style('style', get_template_directory_uri() . '/css/style.css', array(), NULL, NULL);
    ?>

	<!-- BIBLIOTHEQUES JAVASCRIPT site en ligne-->
    <script src="https://cdn.jsdelivr.net/npm/p5@0.10.2/lib/p5.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script><!-- (Facultatif) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script> <!-- (Facultatif) -->

	<!-- FIN JS-->
    <?php wp_head(); ?>
  </head>

  <body <?php body_class(); ?>>
    <section id="grand_espace">
      <header>
        <?php if (is_single()) : ?>
          <p><a href="<?php bloginfo('home'); ?>"><?php bloginfo('name'); ?></a></p>
          <p><?php bloginfo('description'); ?></p>
        <?php else : ?>
          <h1><a href="<?php bloginfo('home'); ?>"><?php bloginfo('name'); ?></a></h1>
          <h2><?php bloginfo('description'); ?></h2>
        <?php endif; ?>
      </header>
