<div class="container">
	<div class="row">

		<div class="col-md-8">
      <?php
        if ( have_posts() ) {
          while ( have_posts() ) {
            the_post();
            _loop('loop-index');
          }
        } else {
          _content('content-none');
        }
      ?>
		</div>

		<?php get_sidebar(); ?>

	</div>
</div>