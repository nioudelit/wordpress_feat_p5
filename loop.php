<?php if (have_posts()) : ?>
  <?php while (have_posts()) : the_post(); ?>

    <article id="<?php the_ID(); ?>" <?php post_class(); ?> data-titre="<?php the_title(); ?>" data-url="<?php the_permalink(); ?>" data-categorie="<?php $category = get_the_category(); echo $category[0]->cat_name; ?>" data-tags="<?php $posttags = get_the_tags(); if ($posttags) { foreach($posttags as $tag) { echo $tag->name . '*'; } }?>">

      <h3 class="article_titre">
        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
      </h3>

	<!-- IMAGE ALA UNE -->
	<?php 
	$imageData = wp_get_attachment_image_src(get_post_thumbnail_id ( $post_ID ), 'medium'); ?>
	<img class="minitature" src="<?php echo $imageData[0]; ?>"/>

       <div id="content_<?php the_ID(); ?>"><?php the_content(); ?></div>
	
    </article>

  <?php endwhile; ?>
  <?php else : ?>
  <p class="nothing">
    OOPS! On dirait qu'il n'y a rien !…
  </p>
<?php endif; ?>
