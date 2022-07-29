<div class="container">
	<div class="row">

		<div class="col-12">
			<?php _partial( '_h-search' ); ?>
		</div>

		<div class="col-md-8">
      <?php
        if ( have_posts() ) {
          while ( have_posts() ) {
            the_post();
            _loop('loop-results');
          }
        } else {
          _content('content-none');
        }
      ?>
		</div>

		<?php get_sidebar(); ?>

	</div>
</div>