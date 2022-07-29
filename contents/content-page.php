<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
	<article <?php post_class( 'p__page container' ); ?>>
		
		<header>
			<?php the_title( '<h1 class="s-title">', '</h1>' ); ?>
    </header>
    
		<div class="p__content">
			<?php the_content(); ?>
		</div>

	</article>
<?php endwhile; ?>