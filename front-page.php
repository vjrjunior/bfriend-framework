<?php
  get_header();

    get_template_part( 'partials/_slideshow' );
    get_template_part('partials/_wrap-start');
  	  the_content();
  	get_template_part('partials/_wrap-end');

  get_footer();