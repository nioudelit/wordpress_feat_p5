<?php get_header(); ?>

<div class="main">
  <?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>

      <div class="article_seul">
        <h1 class="article_titre_seul"><?php the_title(); ?></h1>

        <p class="article_info_seul">
          <?php the_date(); ?> | <?php the_category(', '); ?> | <?php the_author(); ?>.
        </p>

        <div class="article_contenu">
          <?php the_content(); ?>
        </div>
 
      </div>

    <?php endwhile; ?>
  <?php endif; ?>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>