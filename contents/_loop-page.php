<?php
	get_template_part( 'partials/_h-page' );
	if ( have_posts() ) while ( have_posts() ) : the_post(); 
?>
	<article <?php post_class( 'page' ); ?>>
		
		<header>
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		</header>
		<div class="content">
			<?php the_content(); ?>
		</div>

	</article>
<?php endwhile; ?>