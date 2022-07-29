<div class="container">
	<div class="row">

		<div class="col-md-8">
      <?php 
        while ( have_posts() ) :
          the_post();
      ?>
        <article <?php post_class( 'p p__single' ); ?> >
        
					<header class="p__single--header">
            <?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
						<figure><?php the_post_thumbnail( 'full', ['class' => 'img-fluid'] ); ?></figure>
						
						<ul class="infos">
              <li class="time"><time><?php the_time('l, d \d\e F \d\e Y'); ?></time></li>
							<li class="author"><?php _e( 'Publicado por', 'bfriend' ); ?> <?php the_author_posts_link(); ?></li>
							<li class="comments"><?php comments_number( '0 comentário', '1 comentário', '% comentários' ); ?></li>
						</ul>
						<p><?php the_author(); ?></p>
					</header>

					<div class="p__single--content">
						<?php the_content(); ?>
					</div>

					<footer class="p__single--footer">
            <?php
              the_category(', ');
							the_tags( __( 'Tags: ', 'bfriend' ), ', ', '<br>');
							_partial('_comments');
						?>
					</footer>

				</article>
			<?php endwhile; ?>
		</div>

		<?php get_sidebar(); ?>
	</div>
</div>