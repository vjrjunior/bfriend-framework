<?php
  get_header();

    get_template_part('partials/_wrap-start');
    echo '<h1>TEste</h1>';
  	  woocommerce_content();
  	get_template_part('partials/_wrap-end');

  get_footer();