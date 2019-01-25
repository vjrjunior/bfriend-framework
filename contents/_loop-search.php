<?php get_template_part( 'partials/_h-page' ); ?>

<div class="container">
	<div class="row">

		<div class="col-12">
			<?php get_template_part( 'partials/_header-search' ); ?>
		</div>

		<div class="col-md-8">
			<?php if ( have_posts() ): while( have_posts() ): the_post(); ?>
				<article <?php post_class( 'search' ); ?> >
					<header>
						<figure><?php the_post_thumbnail( 'post-thumb', array( 'class' => 'img-fluid' ) ); ?></figure>
						<p><?php the_category(', '); ?></p>
					</header>

					<div class="content">
						<p><?php echo content(40); ?></p>
						<a href="<?php the_permalink(); ?>" title="Saiba mais sobre: <?php the_title(); ?>">saiba mais</a>
					</div>
				</article>
			<?php endwhile; else: ?>
				<article>
					<h2>Nenhum post encontrado.</h2>
				</article>
			<?php endif; ?>
		</div>

		<?php get_sidebar(); ?>

	</div>
</div>