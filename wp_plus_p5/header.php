<!DOCTYPE html>
<html>
  <head <?php language_attributes(); ?>>
    <meta charset="<?php bloginfo('charset'); ?>">
    <title><?php bloginfo('name'); ?><?php wp_title(); ?></title>
    <link rel="stylesheet" href="http://meyerweb.com/eric/tools/css/reset/reset.css" type="text/css">
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css">
    <!--<link href="https://fonts.googleapis.com/css?family=Monda" rel="stylesheet">-->

	<!-- BIBLIOTHEQUES JAVASCRIPT site en ligne-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/0.5.7/p5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script><!-- (Facultatif) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script> <!-- (Facultatif) -->
    <!--<script src="http://planplan.xyz/javascript/p5.play.js"></script>-->

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
